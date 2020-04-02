<?php

/**
 * 
 */
class DivisionRelation extends MY_Controller {

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

    public function index() {

        $this->checkModule();

        $company = $this->db->distinct()
                ->select('GROUP_ID, GROUP_NAME, VCIF, COMPANY_NAME')
                ->from('VIEW_CUSTOMER_MAPPING');
        $comp = $this->db->get();
        $data['company'] = $comp->result();

        $querys = $this->db->distinct()
                ->select('a.*, b.DIVISION_NAME, c.GROUP_NAME, c.COMPANY_NAME')
                ->from('RELATION_DIVISI_VCIF a')
                ->join('MASTER_DIVISIONS b', 'b.ID = a.DIV_ID', 'left')
                ->join('VIEW_CUSTOMER_MAPPING c', 'c.VCIF = a.VCIF', 'left')
                ->where('a.STATUS', '1');
        $divs = $this->db->get();
        $data['relDiv'] = $divs->result();

        $srcdiv = $this->db->distinct()
                ->select('ID, DIVISION_NAME')
                ->from('MASTER_DIVISIONS')
                ->where('STATUS', '1')
                ->where('DIVISION_TYPE', 1);
        $src = $this->db->get();
        $data['src'] = $src->result();

        $personal_number = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personal_number, "", "get delegation relation division", "", "", "");
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/divisiRelasi.php', $data);
        $this->load->view('layout/footer.php');
    }

    function insert() {
        $user_id = $_SESSION['USER_ID'];
        //check if < 2
        $company = $this->input->post('company');
        $div = $this->input->post('division');
        $error = 0;
        $res = $this->db->where('VCIF', $company)->where('STATUS', '1')->get('RELATION_DIVISI_VCIF')->result();
        if (count($res) <= 1) {
            //validasi vcif dan div_id sama
            if (count($res) == 1) {
                if ($div == $res[0]->DIV_ID) {
                    print_r('3');
                    $error = 1;
                };
            };
            if ($error == 0) {
                $data = array(
                    'ADDON' => date('Y-m-d H:i:s'),
                    'ADDBY' => $user_id,
                    'VCIF' => $company,
                    'DIV_ID' => $div,
                    'STATUS' => '1',
                );
                $result = $this->db->insert('RELATION_DIVISI_VCIF', $data);

                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog($persn, "", "insert relation division", "", json_encode($data), "");
                print_r('1');
            }
        } else {
            print_r('2');
        }
    }

    function update() {
        $user_id = $_SESSION['USER_ID'];
        $id = $this->input->post('id');
        $vcif = $this->input->post('vcif');
        $div = $this->input->post('divisi');
        $error = 0;
        $res = $this->db->where('VCIF', $vcif)->where('DIV_ID', $div)->where('STATUS', '1')
                        ->get('RELATION_DIVISI_VCIF')->result();
        if (count($res) > 0) {
            $error = 1;
            print_r('3');
        }
        if ($error == 0) {
            /*
              $res = $this->db->where('ID', $id)->where('STATUS', '1')->get('RELATION_DIVISI_VCIF')->result();
              if ($res[0]->DIV_ID == $div){
              print_r('2');
              }else{ */
            $getData = $this->db->where('DIV_ID', $div)->get('RELATION_DIVISI_VCIF')->result();
            $data = array(
                'DIV_ID' => $div,
            );
            $this->db->where('ID', $id);
            $this->db->update('RELATION_DIVISI_VCIF', $data);

            $persn = $_SESSION['PERSONAL_NUMBER'];

            $this->insertLog($persn, "", "update relation division", json_encode($getData), json_encode($data), "");
            print_r('1');
        }
    }

    public function del() {
        $id = $this->input->post('id');
        $getData = $this->db->where('ID', $id)->where('STATUS', 1)->get('RELATION_DIVISI_VCIF')->result_array()[0];
        $this->db->where('ID', $id);
        $this->db->delete('RELATION_DIVISI_VCIF');

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "delete relation division", json_encode($getData), json_encode($newData), "");
    }

}

?>