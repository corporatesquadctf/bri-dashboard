<?php

/**
 * 
 */
class Accountplanning extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->load->database();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get_checker($user_id = "", $vcif = ""){
        $this->db->distinct();
        $this->db->select('delegations_checker.*, ACCOUNT_PLANNINGS.CUSTOMER_NAME customer_name,ACCOUNT_PLANNINGS.DOC_STATUS,ACCOUNT_PLANNINGS.YEAR,ACCOUNT_PLANNINGS.ID, VIEW_CUSTOMER_MAPPING.group_name company_name');
        $this->db->from('delegations_checker');
        $this->db->join('ACCOUNT_PLANNINGS', 'delegations_checker.vcif = ACCOUNT_PLANNINGS.vcif', 'left');
        $this->db->join('VIEW_CUSTOMER_MAPPING', 'VIEW_CUSTOMER_MAPPING.vcif = delegations_checker.vcif', 'left');
        $this->db->where('ACCOUNT_PLANNINGS.DOC_STATUS', '2');
        $this->db->where('delegations_checker.status', 1);
        $this->db->where('ACCOUNT_PLANNINGS.ID = delegations_checker.AP_id');
        if ($user_id != ""){
            $this->db->where('delegations_checker.checker_id', $user_id);
        }
        if ($vcif != ""){
            $this->db->where('delegations_checker.vcif', $vcif);
        }

        return $this->db->get()->result();
    }

    public function get_signer($user_id = "", $vcif = "", $status = 1){
        $this->db->distinct();
        $this->db->select('delegations_signer.*, ACCOUNT_PLANNINGS.CUSTOMER_NAME customer_name,ACCOUNT_PLANNINGS.DOC_STATUS,ACCOUNT_PLANNINGS.YEAR,ACCOUNT_PLANNINGS.ID, VIEW_CUSTOMER_MAPPING.group_name company_name');
        $this->db->from('delegations_signer');
        $this->db->join('ACCOUNT_PLANNINGS', 'delegations_signer.vcif = ACCOUNT_PLANNINGS.VCIF', 'left');
        $this->db->join('VIEW_CUSTOMER_MAPPING', 'VIEW_CUSTOMER_MAPPING.VCIF = delegations_signer.vcif', 'left');
        $this->db->where('ACCOUNT_PLANNINGS.DOC_STATUS', '3');
        $this->db->where('ACCOUNT_PLANNINGS.ID = delegations_signer.AP_id');
        $this->db->where('delegations_signer.status', $status);
        if ($user_id != ""){
            $this->db->where('delegations_signer.signer_id', $user_id);
        }
        if ($vcif != ""){
            $this->db->where('delegations_signer.vcif', $vcif);
        }

        return $this->db->get()->result();
    }

    public function get_maker($vcif = ""){
        $this->db->select('maker_id');
        $this->db->from('delegations_maker');
        if ($vcif != ""){
            $this->db->where('vcif', $vcif);
        }
        return $this->db->get()->result();
    }

    public function change_doc_status($vcif,$number){
        $upData = [
            'DOC_STATUS' => $number
        ];
        $this->db->where('VCIF', $vcif)->where('YEAR', $this->year_current);
        $hasil = $this->db->update('ACCOUNT_PLANNINGS', $upData);
        return $hasil;
    }

    public function change_checker($user_id, $vcif, $approve, $msg=""){
        $checker = $this->get_checker($user_id, $vcif);
        if (!empty($checker)){
            $check_id = $checker[0]->id;
            $status = 0;
            $status_tigger = 0;
            $approve == true ? $status = 2 : $status = 3;
            $upData = [
                'status' => $status,
                'rejected_reason' => $msg
            ];
            $this->db->where('id', $check_id)->update('delegations_checker', $upData);
            $checker2 = $this->get_checker("",$vcif);
            $masih_ada = false;
            foreach ($checker2 as $chk){
                if ($chk->status == 1){$masih_ada = true;};
            };
            if(!$approve){
                $this->notification_model->addNotif($checker[0]->addby, $checker[0]->customer_name, "Checker Rejected", $vcif, date('Y'));
                return $this->change_doc_status($vcif, 5);
            }else{
                $this->notification_model->addNotif($checker[0]->addby, $checker[0]->customer_name, "Checker Approved", $vcif, date('Y'));
                if($masih_ada == false){
                    $this->change_doc_status($vcif, 3);
                    $signer = $this->get_signer("", $vcif, 0);
                    $signData = ['status' => 1];
                    foreach ($signer as $sign){
                        $this->db->where('id', $sign->id)->update('delegations_signer', $signData);
                        $this->notification_model->addNotif($sign->signer_id, $checker[0]->customer_name, "Sign to Signer", $vcif, date('Y'));
                    }
                    return $signer;
                }else{
                    return $checker2;
                }
            }
        }
    }

    public function change_signer($user_id, $vcif, $approve, $msg=""){
        $checker = $this->get_signer($user_id, $vcif, 1);
        if (!empty($checker)){
            $check_id = $checker[0]->id;
            $status = 0;
            $status_tigger = 0;
            $approve == true ? $status = 2 : $status = 3;
            $upData = [
                'status' => $status,
                'rejected_reason' => $msg
            ];
            $this->db->where('id', $check_id)->update('delegations_signer', $upData);
            $checker2 = $this->get_signer("",$vcif, 1);
            $masih_ada = false;
            foreach ($checker2 as $chk){
                if ($chk->status == 1){$masih_ada = true;};
            };
            if(!$approve){
                $this->notification_model->addNotif($checker[0]->addby, $checker[0]->customer_name, "Signer Rejected", $vcif, date('Y'));
                return $this->change_doc_status($vcif, 6);
            }else{
                $this->notification_model->addNotif($checker[0]->addby, $checker[0]->customer_name, "Signer Approved", $vcif, date('Y'));
                $divisions = $this->db->select('division_id, service_name')
                            ->where('vcif', $vcif)
                            ->where('data_year', $this->year_current)
                            ->get('SERVICES')
                            ->result_array();

                //

                foreach ($divisions as $div) {
                $req = array();
                $req_disposisi = array();
                //Get all user division
                $user_id = $this->db->select('id')
                                ->where('division_id', $div['division_id'])
                                ->where('role_id', USER_ROLE_ADMIN_DIVISI)
                                ->get('USERS')
                                ->result();
                foreach($user_id as $us){
                  $newData = [
                    'USER_ID'   => $us->id,
                    'PT' => $checker[0]->customer_name,
                    'VCIF' => $vcif,
                    'COMMENT' => "SERVICE" ." - " . $div['service_name'],
                    'DATA_YEAR' => $this->year_current,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'READ' => 0,
                    'ADDBY' => $_SESSION['USER_ID']
                    ];
                    $req[] = $newData;
                    //check disposisi untuk admin
                    $disposisi = $this->db->select('ID')
                        ->where('VCIF', $vcif)
                        ->where('DATA_YEAR', $this->year_current)
                        ->where('ADDBY', $us->id)
                        ->get('disposisi')
                        ->result();
                    if (count($disposisi) == 0){
                        $newData2 = [
                            'COMPANY_NAME' => $checker[0]->customer_name,
                            'VCIF' => $vcif,
                            'DATA_YEAR' => $this->year_current,
                            'STAFF_ID' => '',
                            'STATUS' => 1,
                            'ADDON' => date('Y-m-d H:i:s'),
                            'ADDBY' => $us->id
                        ];
                        $req_disposisi[] = $newData2;
                    }
                };
                $this->db->insert_batch('NOTIFICATION', $req); 
                $this->db->insert_batch('DISPOSISI', $req_disposisi); 
            }
                if($masih_ada == false){
                    return $this->change_doc_status($vcif, 4);
                }else{
                    return false;
                }
            }
        }
    }

    function saveGroupOverview($data = array()) {
        return $this->db->insert('GROUP_OVERVIEWS', $data);
    }

}

?>