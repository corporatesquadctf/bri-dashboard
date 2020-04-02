<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Financialgroups extends CI_Controller {

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

        $this->db->select('
			a.ID info_id,
			a.DETAIL_NAME info_name,
			a.GROUP_ID,
			b.GROUP_NAME,
			a.IS_DEFAULT,
			a.STATUS,
			a.ADDON,
			a.ADDBY,
			a.MODION,
			a.MODIBY
		')->from('FINANCIALHIGHLIGHT_DETAILS a')
                ->join('FINANCIALHIGHLIGHT_GROUPS b', 'a.GROUP_ID = b.ID', 'left')
                ->where('a.STATUS', 1);

        $queryData = $this->db->get();
        $groupData = $this->db->get('FINANCIALHIGHLIGHT_GROUPS');
        $data['data'] = $queryData->result();
        $data['group'] = $groupData->result();
        $data['total'] = $this->db->count_all('FINANCIALHIGHLIGHT_GROUPS');

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get financialgroups", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/financialgroups_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertData() {
        $this->load->database();

        $infoName = $this->input->post('infoName');
        $infoGroup = $this->input->post('infoGroup');
        $isDef = $this->input->post('isDef');
        $userId = $this->input->post('userId');
        $today = date("Y-m-d H:i:s");
        $data = array(
            'DETAIL_NAME' => $infoName,
            'GROUP_ID' => $infoGroup,
            'IS_DEFAULT' => $isDef,
            'ADDON' => $today,
            'ADDBY' => $userId
        );

        if ($infoName != '') {
            if ($infoGroup != 0 || $infoGroup != '') {
                if ($userId != '') {
                    $this->db->insert('FINANCIALHIGHLIGHT_DETAILS', $data);
                    $id = $this->db->insert_id();

                    $q = $this->db->get_where('FINANCIALHIGHLIGHT_DETAILS', array('ID' => $id));

                    $persn = $_SESSION['PERSONAL_NUMBER'];
                    $this->insertLog($persn, "", "insert financialgroups", "", json_encode($data), "");

                    $this->session->set_flashdata('Success', '<br>New Data has been successfully added!');

                    redirect('admin/financialgroups');
                } else {
                    echo "User ID is Null!";
                }
            } else {
                echo "Group ID is not valid or null!";
            }
        } else {
            echo "Information Name is null!";
        }
    }

    public function editData() {
        $this->load->database();

        $infoId = $this->input->post('infoIdEdit');
        $infoName = $this->input->post('infoNameEdit');
        $infoGroup = $this->input->post('infoGroupEdit');
        $isDef = $this->input->post('isDefEdit');
        $userId = $this->input->post('userIdEdit');
        $today = date("Y-m-d H:i:s");
        $data = array(
            'DETAIL_NAME' => $infoName,
            'GROUP_ID' => $infoGroup,
            'IS_DEFAULT' => $isDef,
            'MODION' => $today,
            'MODIBY' => $userId
        );

        if ($infoName != '') {
            if ($infoGroup != 0 || $infoGroup != '') {
                if ($userId != '') {
                    $editData = $this->db->where('ID', $infoId)->update('FINANCIALHIGHLIGHT_DETAILS', $data);
                    $getData = $this->db->where('ID', $infoId)->get('FINANCIALHIGHLIGHT_DETAILS')->result_array()[0];
                    $persn = $_SESSION['PERSONAL_NUMBER'];
                    $this->insertLog($persn, "", "update financialgroups", json_encode($getData), json_encode($data), "");
                    $this->session->set_flashdata('Success', '<br>New Data has been successfully added!');

                    redirect('admin/financialgroups');
                } else {
                    echo "User ID is Null!";
                }
            } else {
                echo "Group ID is not valid or null!";
            }
        } else {
            echo "Information Name is null!";
        }
    }

    public function deleteData() {
        $this->load->database();

        $infoId = $this->input->post('delInfoId');
        $userId = $this->input->post('delUserId');
        $today = date("Y-m-d H:i:s");

        $data = array(
            'STATUS' => 0,
            'MODION' => $today,
            'MODIBY' => $userId
        );


        if ($infoId != '') {
            $deleteData = $this->db->where('ID', $infoId)->update('FINANCIALHIGHLIGHT_DETAILS', $data);
            $getData = $this->db->where('ID', $infoId)->get('FINANCIALHIGHLIGHT_DETAILS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "delete financialgroups", json_encode($getData), json_encode($data), "");

            $this->session->set_flashdata('Success', '<br>Data has been successfully deleted!');

            redirect('admin/financialgroups');
        } else {
            echo "Id is Null";
        }
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

}

?>