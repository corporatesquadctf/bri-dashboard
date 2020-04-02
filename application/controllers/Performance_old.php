<?php

class Performance_old extends MY_Controller {

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
        $this->load->model('master_model');
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

    function index() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/index.php');
        $this->load->view('layout/footer.php');
    }

    function exec_summary() {
        $this->checkModule();
        $user_role_id = $this->session->get_userdata()['ROLE_ID'];
        $user_division_id = $this->session->get_userdata()['DIVISION'];
        $divisions = $this->master_model->get_seven_divisions();
        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER,
            USER_ROLE_BOARD
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        if ($user_is_restricted) {
            $divisions = array_filter($divisions, function($division) use ($user_division_id) {
                return $division->division_id == $user_division_id;
            });
        }

        $data['divisions'] = $divisions;
        $data['user_is_restricted'] = $user_is_restricted;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/executive_summary_view.php', $data);
        $this->load->view('layout/footer.php');
    }

    function segment() {
        $this->checkModule();
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/segment.php');
        $this->load->view('layout/footer.php');
    }

    public function topbottom($divisions = "0") {
        $this->checkModule();
        $user_role_id = $this->session->get_userdata()['ROLE_ID'];

        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER,
            USER_ROLE_BOARD
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        if ($divisions == "0") {
            $divisions = $_SESSION['DIVISION'];
        };

        if ($divisions != $this->session->get_userdata()['DIVISION'] && $user_is_restricted == false) {
            $data['divisiNow'] = $divisions;
        } else {
            $data['divisiNow'] = $this->session->get_userdata()['DIVISION'];
            $divisions = $this->session->get_userdata()['DIVISION'];
        };

        $data['user_is_restricted'] = $user_is_restricted;

        $today = new DateTime(date('Y-m-d H:i:s'));

        $date_start = date('Ym01', strtotime('-1 month', time()));
        $date_end = $today->format('Ym01');

        $rows = Array();

        $year = date('Y');
        $month = date('m');
        $month--;
        if ($month == 0) {
            $month = 12;
            $year--;
        }

        $data['periode'] = 'Periode ' . date('M Y', strtotime('-1 month', time()));;


        if ($divisions == "all") {
            $query_string = <<<SQL

SELECT nama_nasabah, vcif, 
    sum(kredit) kredit, 
    sum(simpanan) simpanan, 
    sum(jumlah) jumlah
                    
FROM summary_top_bottom

where year = ? and month = ?
   
group by nama_nasabah, vcif
order by sum(jumlah) asc
                    
SQL
            ;
            $rows = $this->db->query($query_string, array($year, $month))->result();
        } else {
            $query_string = <<<SQL
SELECT nama_nasabah, vcif, 
    kredit, 
    simpanan, 
    jumlah
                    
FROM summary_top_bottom
where division = ? and year = ? and month = ?
order by jumlah asc

SQL;
            $rows = $this->db->query($query_string, array($divisions, $year, $month))->result();
        }
        $data['topbottomAsc'] = Array();
        foreach ($rows as $key => $row) {
            if ($key <= 9) {
                $temp = new stdClass();
                $temp->tgl_mulai = $date_start;
                $temp->tgl_selesai = $date_end;
                $temp->nama_nasabah = $row->nama_nasabah;
                $temp->vcif = $row->vcif;
                $temp->kredit = $row->kredit / 1000000;
                $temp->simpanan = $row->simpanan / 1000000;
                $temp->jumlah = $row->jumlah / 1000000;
                $data['topbottomAsc'][] = $temp;
            } else {
                break;
            }
        };

        $data['topbottom'] = Array();
        $banyak = count($rows);
        $i = 0;
        for ($x = $banyak - 1; $x >= 0; $x--) {
            if ($i <= 9) {
                $rows[$x]->kredit = $rows[$x]->kredit / 1000000;
                $rows[$x]->simpanan = $rows[$x]->simpanan / 1000000;
                $rows[$x]->jumlah = $rows[$x]->jumlah / 1000000;
                $data['topbottom'][] = $rows[$x];
            } else {
                break;
            }
            $i++;
        }
        $data['masterDivisi'] = $this->db
                        ->select('m.id, m.division_name')
                        ->from('MASTER_DIVISIONS m')
                        ->where('m.DIVISION_TYPE', 1)
                        ->get()->result();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/topbottom.php', $data);
        $this->load->view('layout/footer.php');
    }

    function customer() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/customer.php');
        $this->load->view('layout/footer.php');
    }

    function company() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/company_info.php');
        $this->load->view('layout/footer.php');
    }

    function company_info() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/company_info.php');
        $this->load->view('layout/footer.php');
    }

    function company_info2() {
        $this->load->view('layout/header.php');
        $this->load->view('performance/company/table/input_simulasi.php');
    }

    function leaderboard() {
        $this->db->select('a.*, b.ROLE_NAME ROLENAME')
                ->from('USERS a')
                ->join('ROLE b', 'b.ID = a.role_id', 'left')
                ->where('a.role_id', '10')
                ->where('a.status', '1');
        $queryData = $this->db->get();
        $queryDataRole = $this->db->get('ROLE');
        $data['data'] = $queryData->result();
        $data['role'] = $queryDataRole->result();
        $data['total'] = $this->db->count_all('USERS');
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "Get performance/leaderboard", "", json_encode($data), "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/leaderboard.php', $data);
        $this->load->view('layout/footer.php');
    }

    function financial_highlight() {
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "Get performance/company/company_information", "", "", "");
        $this->load->view('performance/company/company_information.php');
    }

}

?>