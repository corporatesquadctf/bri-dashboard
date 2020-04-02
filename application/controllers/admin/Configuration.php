<?php

/**
 * 
 */
class Configuration extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    function index() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/configuration/index.php');
        $this->load->view('layout/footer.php');
    }

    public function get_user() {
        $queryData = $this->db->select('name')
                ->from('USERS')
                ->where('STATUS', 1)
                ->get();
        $data['datauser'] = $queryData->result();
        print_r('<pre>');
        print_r($data);
        die();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/index.php', $data);
        $this->load->view('layout/footer.php');
    }

    function escalation() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/configuration/escalation.php');
        $this->load->view('layout/footer.php');
    }

    public function delegation() {

        $this->checkModule();
        $id_div = $_SESSION['DIVISION'];

        $this->db->select('name,id');
        $this->db->from('users');
        $this->db->where('status', 1);
        $this->db->where('role_id', USER_ROLE_RM);
        $this->db->where('division_id', $id_div);
        $data['delegate_candidates'] = $this->db->get()->result();

        $this->db->distinct();
        $this->db->select('a.vcif, a.maker_id, b.id');
        $this->db->from('delegations_maker a');
        $this->db->join('USERS b', 'b.id = a.maker_id');
        $data['getMaker'] = $this->db->get()->result();


        $data['companies'] = array();

        $this->db->distinct();
        $this->db->select('GROUP_NAME, GROUP_ID');
        $this->db->from('VIEW_CUSTOMER_MAPPING');

        $groups = $this->db->get()->result_array();

        foreach ($groups as $group) {

            $this->db->distinct();
            $this->db->select(<<<SQL
                VIEW_CUSTOMER_MAPPING.company_name, 
                VIEW_CUSTOMER_MAPPING.vcif, 
                delegations_maker.maker_id,
                delegations_maker.division_id,
                users.name
SQL
            );
            $this->db->from('VIEW_CUSTOMER_MAPPING');
            $this->db->join('DELEGATIONS_maker', 'VIEW_CUSTOMER_MAPPING.VCIF = DELEGATIONS_maker.VCIF', 'left');
            $this->db->join('USERS', 'delegations_maker.MAKER_ID = users.id', 'left');
            $this->db->where('VIEW_CUSTOMER_MAPPING.GROUP_ID', $group['GROUP_ID']);

            $delegations_maker = $this->db->get()->result_array();

            foreach ($delegations_maker as $delegation_maker) {

                $vcif = $delegation_maker['vcif'];
                if (!array_key_exists($vcif, $data['companies'])) {
                    $data['companies'][$vcif] = array(
                        'company_name' => $delegation_maker['company_name'],
                        'makers' => array()
                    );
                }
                $data['companies'][$vcif]['makers'][] = array(
                    'maker_id' => $delegation_maker['maker_id'],
                    'name' => $delegation_maker['name'],
                    'division_id' => $delegation_maker['division_id']
                );
            }
        }

        $personal_number = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personal_number, "", "get delegation", "", "", "");
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/configuration/delegation.php', $data);
        $this->load->view('layout/footer.php');
    }

    function edit_delegation() {

        // LOAD GROUP DATA
        $this->db->distinct()
                ->select('GROUP_NAME, GROUP_ID')
                ->from('VIEW_CUSTOMER_MAPPING a');
        $groupData = $this->db->get();
        $queryData = $this->db->select('name,id')
                ->from('USERS')
                ->where('STATUS', 1)
                ->where('ROLE_ID', '10')
                ->get();
        $data['datauser'] = $queryData->result();
        foreach ($groupData->result() as $group) {
            $childData = array();
            // GET COMPANY DATA
            $this->db
                    ->distinct()
                    ->select('COMPANY_NAME, VCIF')
                    ->from('VIEW_CUSTOMER_MAPPING')
                    // ->join('USERS b', 'b.id = a.COMPANY_NAME', 'left')
                    ->where('GROUP_ID', $group->GROUP_ID);
            $companyData = $this->db->get();
            foreach ($companyData->result() as $com) {
                $childData[] = array(
                    'COMPANY_NAME' => $com->COMPANY_NAME,
                    'VCIF' => $com->VCIF
                );
            }

            $data['data'][] = array(
                'GROUP_ID' => $group->GROUP_ID,
                'GROUP_NAME' => $group->GROUP_NAME,
                // 'COMPANY_NAME' => $com->COMPANY_NAME,
                // 'VCIF' 		   => $com->VCIF,
                'CHILD' => $childData
            );
        }

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/configuration/delegation_edit.php', $data);
        $this->load->view('layout/footer.php');
    }

    function insertLog($pers, $name, $action, $ori, $change, $msg) {
        $newData = [
            'personal_number' => $pers,
            'action' => $action,
            'addon' => date('Y-m-d H:i:s'),
            'name' => $name,
            'ori' => $ori,
            'change' => $change,
            'msg' => $msg
        ];
        $updateData = $this->db->insert('LOG', $newData);
    }

    public function delegate() {

        $vcif = $this->input->post('vcif');
        $year_now = date("Y");
        $today = date("Y-m-d H:i:s");
        $userID = $_SESSION['USER_ID'];
        $divID = $_SESSION['DIVISION'];
        $company_name = $this->input->post('company_name');
        $personal_number = $_SESSION['PERSONAL_NUMBER'];

        $maker_ids = $this->input->post('maker_ids');

        if ($vcif) {
            $this->load->model('notification_model');
            $delegations_maker = array();

            foreach ($maker_ids as $maker_id) {
                if ($maker_id != 0) {
                    $delegations_maker[] = array(
                        'status' => 1,
                        'vcif' => $vcif,
                        'maker_id' => $maker_id,
                        'division_id' => $divID,
                        'addon' => $today,
                        'addby' => $userID
                    );
                    $this->notification_model->addNotif($maker_id, $company_name, "Sign to Maker", $vcif, $year_now);
                }
            }
            $temp = $this->db->where('VCIF', $vcif)
                            ->where('YEAR', $year_now)
                            ->where('STATUS', 1)
                            ->get('ACCOUNT_PLANNINGS')->result();

            if (empty($temp)) {
                $temp2 = $this->db->where('VCIF', $vcif)
                                ->get('view_customer_mapping')->result_array()[0];
                $newData = [
                    'VCIF' => $vcif,
                    'customer_name' => $temp2['COMPANY_NAME'],
                    'addon' => $today,
                    'addby' => $userID,
                    'status' => 1,
                    'doc_status' => 0,
                    'YEAR' => $year_now
                ];
                $updateData = $this->db->insert('ACCOUNT_PLANNINGS', $newData);
                $this->insertLog($personal_number, "", "insert account planning", "", json_encode($newData), "");
            }
            $getData = $this->db->where('vcif', $vcif)->where('division_id', $divID)->get('delegations_maker')->result_array()[0];
            $this->insertLog($personal_number, "", "update delegation", json_encode($getData), json_encode($delegations_maker), "");
            //
            $this->db->trans_start();
            //
            $this->db->where('vcif', $vcif);
            $this->db->where('division_id', $divID);
            $this->db->delete('delegations_maker');
            $this->db->insert_batch('delegations_maker', $delegations_maker);
            //
            $this->db->trans_complete();
        }

        redirect('admin/configuration/delegation');
    }

}

?>