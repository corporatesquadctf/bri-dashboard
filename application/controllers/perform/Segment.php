<?php

class Segment extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $this->load->database();
    }

    public function index($division_id = "0") {
        $user_id = $_SESSION['USER_ID'];
        $user_role_id = $this->session->get_userdata()['ROLE_ID'];

        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER,
            //USER_ROLE_ADMIN_DIVISI,
            //USER_ROLE_ADMIN_PARAMETER,
            USER_ROLE_BOARD
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        $user_is_restricted_filter_promotes = array(
            USER_ROLE_SUPER_USER,
                //USER_ROLE_ADMIN_DIVISI,
                //USER_ROLE_ADMIN_PARAMETER,
                //USER_ROLE_BOARD
        );

        $user_is_restricted_filter_promote = !in_array($user_role_id, $user_is_restricted_filter_promotes);

        $data = array(
            'segment' => array(),
            'platinum' => array(),
            'gold' => array(),
            'silver' => array(),
            'bronze' => array(),
            'platinum_total' => 0,
            'gold_total' => 0,
            'silver_total' => 0,
            'bronze_total' => 0,
            'total' => 0,
            'platinum_percentage' => 0,
            'gold_percentage' => 0,
            'silver_percentage' => 0,
            'bronze_percentage' => 0
        );

        if ($division_id == "0") {
            $division_id = $_SESSION['DIVISION'];
        };

        if ($division_id != $this->session->get_userdata()['DIVISION'] && $user_is_restricted == false) {
            $data['divisiNow'] = $division_id;
        } else {
            $data['divisiNow'] = $this->session->get_userdata()['DIVISION'];
            $division_id = $this->session->get_userdata()['DIVISION'];
        };

        $data['user_is_restricted'] = $user_is_restricted;
        $data['user_is_restricted_filter_promote'] = $user_is_restricted_filter_promote;

        $pm = (int) date('n', strtotime('-1 months'));
        $pmy = (int) date('Y', strtotime('-1 months'));

        $segment_data = $this->db
                        ->select("VIEW_CUSTOMER_MAPPING.GROUP_NAME AS 'group_name'")
                        ->select("VIEW_CUSTOMER_MAPPING.GROUP_ID AS 'group_id'")
                        ->select("SUM(LABA_RUGI_FTP_SETELAH_MODAL) AS 'profit'")
                        ->select("SUM(fact_kredit_cpa.BAKI_DEBET_RATAS) AS 'outstanding'")
                        ->select("SUM(fact_simpanan_cpa.avrgsaldo) AS 'fee'")
                        ->from('fact_summary_laba_rugi')
                        ->join('VIEW_CUSTOMER_MAPPING', 'VIEW_CUSTOMER_MAPPING.cif = fact_summary_laba_rugi.cifno', 'inner')
                        ->join('fact_kredit_cpa', 'VIEW_CUSTOMER_MAPPING.cif = fact_kredit_cpa.cifno', 'left')
                        ->join('fact_simpanan_cpa', 'VIEW_CUSTOMER_MAPPING.cif = fact_simpanan_cpa.cifno', 'left')
                        ->group_by('VIEW_CUSTOMER_MAPPING.GROUP_NAME')
                        ->group_by('VIEW_CUSTOMER_MAPPING.GROUP_ID')
                        ->get()->result_array();
        $this->db
                ->select("MASTER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                ->select("MASTER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                ->select("MASTER_CLASSIFICATIONS.MIN_PARAMETER AS 'min'")
                ->select("MASTER_CLASSIFICATIONS.MAX_PARAMETER AS 'max'")
                ->select("MASTER_CLASSIFICATIONS.DIVISI AS 'divisi'")
                ->from("MASTER_CLASSIFICATIONS");
        if ($division_id != "all") {
            $this->db->where('MASTER_CLASSIFICATIONS.DIVISI', $division_id);
        } else {
            $this->db->where('MASTER_CLASSIFICATIONS.DIVISI', 1);
        }
        $master_clas = $this->db->where('MASTER_CLASSIFICATIONS.STATUS', 1)
                        ->get()->result();
        if (count($master_clas) == 4) {
            foreach ($master_clas as $mc) {
                if ($mc->cla == 'Platinum') {
                    $pl1 = $mc;
                } else if ($mc->cla == 'Gold') {
                    $pl2 = $mc;
                } else if ($mc->cla == 'Silver') {
                    $pl3 = $mc;
                } else if ($mc->cla == 'Bronze') {
                    $pl4 = $mc;
                }
            }
            foreach ($segment_data as $sg) {
                $super_clas = $this->db
                                ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                                ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                                ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                                ->from("MASTER_SUPER_CLASSIFICATIONS")
                                ->where('group_id', $sg['group_id'])
                                ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                                ->get()->result();

                $temp = $sg['profit'];
                $sg['profit'] = number_format($sg['profit'] / 1000000);
                $sg['outstanding'] = number_format($sg['outstanding'] / 1000000);
                $sg['fee'] = number_format($sg['fee'] / 1000000);

                if (count($super_clas) == 0) {
                    if ($temp > $pl1->min && $data['platinum_total'] <= 9) {
                        $sg['promoted'] = 0;
                        $sg['current'] = 3;
                        $data['platinum'][] = $sg;
                        $data['platinum_total'] += 1;
                        $data['total'] += 1;
                    } else if ($temp > $pl3->min && $temp <= $pl2->min && $data['gold_total'] <= 9) {
                        $sg['promoted'] = 0;
                        $sg['current'] = 2;
                        $data['gold'][] = $sg;
                        $data['gold_total'] += 1;
                        $data['total'] += 1;
                    } else if ($temp >= $pl4->min && $temp <= $pl3->min && $data['silver_total'] <= 9) {
                        $sg['promoted'] = 0;
                        $sg['current'] = 1;
                        $data['silver'][] = $sg;
                        $data['silver_total'] += 1;
                        $data['total'] += 1;
                    } else if ($temp < $pl4->min && $data['bronze_total'] <= 9) {
                        $sg['promoted'] = 0;
                        $sg['current'] = 0;
                        $data['bronze'][] = $sg;
                        $data['bronze_total'] += 1;
                        $data['total'] += 1;
                    }
                } else {
                    $temp99 = strtolower($super_clas[0]->cla);
                    $temp98 = strtolower($super_clas[0]->cla) . '_total';
                    if ($temp98 <= 9) {
                        $arr = ["Bronze", "Silver", "Gold", "Platinum"];
                        $sg['promoted'] = 1;
                        $sg['current'] = 0;
                        foreach ($arr as $key => $ar) {
                            if ($ar == $super_clas[0]->cla) {
                                $sg['current'] = $key;
                                break;
                            }
                        }
                        $data[$temp99][] = $sg;
                        $data[$temp98] += 1;
                        $data['total'] += 1;
                    };
                }
            };
            $data['platinum_percentage'] = number_format($data['platinum_total'] / $data['total'] * 100, 2);
            $data['gold_percentage'] = number_format($data['gold_total'] / $data['total'] * 100, 2);
            $data['silver_percentage'] = number_format($data['silver_total'] / $data['total'] * 100, 2);
            $data['bronze_percentage'] = number_format($data['bronze_total'] / $data['total'] * 100, 2);

            $data['segment'] = $segment_data;
        }
        $data['divisi'] = $division_id;
        $data['masterDivisi'] = $this->db
                        ->select('m.id, m.division_name')
                        ->from('MASTER_DIVISIONS m')
                        ->where('m.DIVISION_TYPE', 1)
                        ->where('m.STATUS', 1)
                        ->get()->result();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/segment.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function promote() {
        $group_id = $this->input->post('group_id');
        $current = $this->input->post('current');
        $desc = $this->input->post('desc');
        $user_id = $_SESSION['USER_ID'];
        $division_id = $_SESSION['DIVISION'];
        $arr = ["Bronze", "Silver", "Gold", "Platinum"];
        $personaln = $_SESSION['PERSONAL_NUMBER'];
        $super_clas = $this->db
                        ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                        ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                        ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                        ->from("MASTER_SUPER_CLASSIFICATIONS")
                        ->where('MASTER_SUPER_CLASSIFICATIONS.GROUP_ID', $group_id)
                        ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                        ->get()->result();
        if (count($super_clas) == 1) {
            $newData = [
                'STATUS' => 0,
                'MODION' => date('Y-m-d H:i:s'),
                'MODIBY' => $_SESSION['USER_ID']
            ];
            $this->insertLog($personaln, "", "Promote Classification", "", json_encode($newData), $desc);
            $super_clas = $this->db
                    ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                    ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                    ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                    ->from("MASTER_SUPER_CLASSIFICATIONS")
                    ->where('MASTER_SUPER_CLASSIFICATIONS.GROUP_ID', $group_id)
                    ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                    ->update("MASTER_SUPER_CLASSIFICATIONS", $newData);
            if ($current < 3) {
                $cla = $arr[$current + 1];
                $newData = [
                    'CLASSIFICATION' => $cla,
                    'GROUP_ID' => $group_id,
                    'DESCRIPTION' => $desc,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'ADDBY' => $_SESSION['USER_ID']
                ];
                $this->insertLog($personaln, "", "Promote Classification", "", json_encode($newData), $desc);
                $updateData = $this->db->insert('MASTER_SUPER_CLASSIFICATIONS', $newData);
            } else {
                echo "SUdah mentok";
            };
        } else {
            if ($current < 3) {
                $cla = $arr[$current + 1];
                $newData = [
                    'CLASSIFICATION' => $cla,
                    'GROUP_ID' => $group_id,
                    'DESCRIPTION' => $desc,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'ADDBY' => $_SESSION['USER_ID']
                ];
                $this->insertLog($personaln, "", "Promote Classification", "", json_encode($newData), $desc);
                $updateData = $this->db->insert('MASTER_SUPER_CLASSIFICATIONS', $newData);
            } else {
                echo "SUdah mentok";
            };
        }
    }

    public function demote() {
        $group_id = $this->input->post('group_id');
        $current = $this->input->post('current');
        $desc = $this->input->post('desc');
        $user_id = $_SESSION['USER_ID'];
        $division_id = $_SESSION['DIVISION'];
        $arr = ["Bronze", "Silver", "Gold", "Platinum"];
        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $super_clas = $this->db
                        ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                        ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                        ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                        ->from("MASTER_SUPER_CLASSIFICATIONS")
                        ->where('MASTER_SUPER_CLASSIFICATIONS.GROUP_ID', $group_id)
                        ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                        ->get()->result();
        if (count($super_clas) == 1) {
            $newData = [
                'STATUS' => 0,
                'MODION' => date('Y-m-d H:i:s'),
                'MODIBY' => $_SESSION['USER_ID']
            ];

            $this->insertLog($personaln, "", "Demote Classification", "", json_encode($newData), $desc);

            $super_clas = $this->db
                    ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                    ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                    ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                    ->from("MASTER_SUPER_CLASSIFICATIONS")
                    ->where('MASTER_SUPER_CLASSIFICATIONS.GROUP_ID', $group_id)
                    ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                    ->update("MASTER_SUPER_CLASSIFICATIONS", $newData);
            if ($current > 0) {
                $cla = $arr[$current - 1];
                $newData = [
                    'CLASSIFICATION' => $cla,
                    'GROUP_ID' => $group_id,
                    'DESCRIPTION' => $desc,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'ADDBY' => $_SESSION['USER_ID']
                ];


                $this->insertLog($personaln, "", "Demote Classification", "", json_encode($newData), $desc);

                $updateData = $this->db->insert('MASTER_SUPER_CLASSIFICATIONS', $newData);
            } else {
                echo "SUdah mentok";
            };
        } else {
            if ($current > 0) {
                $cla = $arr[$current - 1];
                $newData = [
                    'CLASSIFICATION' => $cla,
                    'GROUP_ID' => $group_id,
                    'DESCRIPTION' => $desc,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'ADDBY' => $_SESSION['USER_ID']
                ];

                $this->insertLog($personaln, "", "Demote Classification", "", json_encode($newData), $desc);

                $updateData = $this->db->insert('MASTER_SUPER_CLASSIFICATIONS', $newData);
            } else {
                echo "SUdah mentok";
            };
        }
    }

    public function reset() {
        $group_id = $this->input->post('group_id');
        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $newData = [
            'STATUS' => 0,
            'MODION' => date('Y-m-d H:i:s'),
            'MODIBY' => $_SESSION['USER_ID']
        ];

        $this->insertLog($personaln, "", "Reset Classification", "", json_encode($newData), $desc);

        $super_clas = $this->db
                ->select("MASTER_SUPER_CLASSIFICATIONS.CLASSIFICATION AS 'cla'")
                ->select("MASTER_SUPER_CLASSIFICATIONS.DESCRIPTION AS 'des'")
                ->select("MASTER_SUPER_CLASSIFICATIONS.GROUP_ID AS 'group_id'")
                ->from("MASTER_SUPER_CLASSIFICATIONS")
                ->where('group_id', $group_id)
                ->where('MASTER_SUPER_CLASSIFICATIONS.STATUS', 1)
                ->update("MASTER_SUPER_CLASSIFICATIONS", $newData);
    }

}

?>
