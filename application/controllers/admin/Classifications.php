<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Classifications extends MY_Controller {

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
    }

    public function index() {
        $this->load->database();

        $this->checkModule();

        $this->db->select('a.*, b.name MAKER, c.name MODIFIER, d.DIVISION_NAME')
                ->from('MASTER_CLASSIFICATIONS a')
                ->join('USERS b', 'b.id = a.ADDBY', 'left')
                ->join('USERS c', 'c.id = a.MODIBY', 'left')
                ->join('MASTER_DIVISIONS d', 'a.DIVISI = d.ID', 'left')
                ->where('a.STATUS', '1');

        $queryData = $this->db->get()->result();
        $temp = [];
        foreach ($queryData as $q) {
            if ($q->DIVISI == 1) {
                $q->DIVISION_NAME = "All Division";
            };
            $temp[] = $q;
        }
        $data['data'] = $temp;

        $srcdiv = $this->db->distinct()
                ->select('ID, DIVISION_NAME')
                ->from('MASTER_DIVISIONS')
                ->where('STATUS', '1');
        $src = $this->db->get();
        $data['src'] = $src->result();

        $data['masterDivisi'] = $this->db
                        ->select('m.id, m.division_name')
                        ->from('MASTER_DIVISIONS m')
                        ->where('m.STATUS', '1')
                        ->where('m.DIVISION_TYPE', 1)
                        ->get()->result();
        /*
          $temp = new stdClass();
          $temp->id = 1;
          $temp->division_name = "All Division";
          $data['masterDivisi'][] = $temp;
         */

        $master_clas = Array();
        $temp = new stdClass();
        $temp->id = "Platinum";
        $master_clas[] = $temp;
        $temp2 = new stdClass();
        $temp2->id = "Gold";
        $master_clas[] = $temp2;
        $temp3 = new stdClass();
        $temp3->id = "Silver";
        $master_clas[] = $temp3;
        $temp4 = new stdClass();
        $temp4->id = "Bronze";
        $master_clas[] = $temp4;
        $data['master_clas'] = $master_clas;

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get classifications", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/classifications_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function updateData() {
        $this->load->database();

        $today = date("Y-m-d H:i:s");
        $user = $this->input->post('userId');
        $clsId = $this->input->post('clsId');
        $divisi = $this->input->post('divisi');
        $minParam = $this->input->post('minParam');
        $maxParam = $this->input->post('maxParam');
        $clsDesc = $this->input->post('clsDesc');

        if ($clsId) {
            $newData = array(
                'DIVISI' => $divisi,
                'DESCRIPTION' => $clsDesc,
                'MIN_PARAMETER' => $minParam + 0,
                'MAX_PARAMETER' => $maxParam + 0,
                'MODION' => $today,
                'MODIBY' => $user
            );

            $getData = $this->db->where('id', $clsId)->get('MASTER_CLASSIFICATIONS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "update classifications", json_encode($getData), json_encode($newData), "");

            $updateData = $this->db->where('ID', $clsId)->update('MASTER_CLASSIFICATIONS', $newData);
            $data['data'] = $updateData;
            $data['sukses'] = true;
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        } else {
            $data['sukses'] = false;
            $data['msg'] = 'Gagal mengupdate Data';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        }
    }

    public function deleteData() {
        $this->load->database();

        $today = date("Y-m-d H:i:s");
        $user = $this->input->post('userId');
        $clsId = $this->input->post('clsId');

        if ($clsId) {
            $newData = array(
                'STATUS' => 0,
                'MODION' => $today,
                'MODIBY' => $user
            );

            $getData = $this->db->where('id', $clsId)->where('STATUS', 1)->get('MASTER_CLASSIFICATIONS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "delete classifications", json_encode($getData), json_encode($newData), "");

            $updateData = $this->db->where('ID', $clsId)->update('MASTER_CLASSIFICATIONS', $newData);
            $data['data'] = $updateData;
            $data['sukses'] = true;
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        } else {
            $data['sukses'] = false;
            $data['msg'] = 'Gagal Menghapus Data';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        }
    }

    public function insertData() {
        $this->load->database();

        $today = date("Y-m-d H:i:s");
        $user = $this->input->post('userId');
        $cla = $this->input->post('editClsName');
        $divisi = $this->input->post('divisi');
        $minParam = $this->input->post('minParam');
        $maxParam = $this->input->post('maxParam');
        $clsDesc = $this->input->post('clsDesc');
        $banyak = $this->db->where('divisi', $divisi)->where('CLASSIFICATION', $cla)->where('STATUS', 1)->get('MASTER_CLASSIFICATIONS')->result_array();
        $banyak = count($banyak);
        if ($banyak == 0) {
            $newData = array(
                'DIVISI' => $divisi,
                'CLASSIFICATION' => $cla,
                'DESCRIPTION' => $clsDesc,
                'MIN_PARAMETER' => $minParam + 0,
                'MAX_PARAMETER' => $maxParam + 0,
                'ADDON' => $today,
                'ADDBY' => $user
            );
            $updateData = $this->db->where('divisi', $divisi)->where('CLASSIFICATION', $cla)->insert('MASTER_CLASSIFICATIONS', $newData);

            $getData = $this->db->where('divisi', $divisi)->where('CLASSIFICATION', $cla)->get('MASTER_CLASSIFICATIONS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "insert classifications", json_encode($getData), json_encode($newData), "");

            $data['data'] = $updateData;
            $data['sukses'] = true;
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        } else {
            $data['msg'] = "Gagal Menambah Data, karena sudah ada";
            $data['sukses'] = false;
            $data['banyak'] = $banyak;
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($data));
        }
    }
}

?>