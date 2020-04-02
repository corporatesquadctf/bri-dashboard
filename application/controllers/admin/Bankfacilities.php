<?php

/**
 * 
 */
class Bankfacilities extends MY_Controller {

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

        // Load Model
    }

    public function index() {

        $this->load->database();

        $this->checkModule();

        $this->db->select('
			a.id, 
			a.name, 
			a.bankingfacilities_id, 
			b.group_name,
			a.is_default, 
			a.status, 
			a.addon, 
			a.addby, 
			a.modion, 
			a.modiby
			')
                ->from('facilitygroup_details a')
                ->join('m_bankingfacilities b', 'b.id = a.bankingfacilities_id', 'left')
                ->where('a.status', 1);

        $queryData = $this->db->get();
        $groupData = $this->db->get('m_bankingfacilities');
        $data['data'] = $queryData->result();
        $data['group'] = $groupData->result();
        $data['total'] = $this->db->count_all('m_bankingfacilities');
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "Get master_data/bankfacilities", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/bankfacilities_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertDataBank() {
        $this->load->database();

        $infoName = $this->input->post('infoName');
        $infoGroup = $this->input->post('infoGroup');
        $isDef = $this->input->post('isDef');

        $userId = $this->input->post('userId');
        $today = date("Y-m-d H:i:s");
        $data = array(
            'name' => $infoName,
            'bankingfacilities_id' => $infoGroup,
            'is_default' => $isDef,
            'addon' => $today,
            'addby' => $userId
        );
        if ($infoName != '') {
            if ($infoGroup != 0 || $infoGroup != '') {
                if ($userId != '') {
                    $this->db->insert('facilitygroup_details', $data);
                    $id = $this->db->insert_id();
                    $q = $this->db->get_where('facilitygroup_details', array('ID' => $id));
                    $persn = $_SESSION['PERSONAL_NUMBER'];
                    $this->insertLog($persn, "", "Insert admin/bankfacilities", "", json_encode($data), "");

                    $this->session->set_flashdata('Success', '<br>New Data has been successfully added!');

                    redirect('admin/bankfacilities');
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

    public function editDataBank() {
        $this->load->database();

        $infoId = $this->input->post('infoIdEdit');
        $infoName = $this->input->post('infoNameEdit');
        $infoGroup = $this->input->post('infoGroupEdit');
        $isDef = $this->input->post('isDefEdit');

        $userId = $this->input->post('userIdEdit');
        $today = date("Y-m-d H:i:s");
        $data = array(
            'name' => $infoName,
            'bankingfacilities_id' => $infoGroup,
            'is_default' => $isDef,
            'modion' => $today,
            'modiby' => $userId
        );

        if ($infoName != '') {
            if ($infoGroup != 0 || $infoGroup != '') {
                if ($userId != '') {
                    $editData = $this->db->where('ID', $infoId)->update('facilitygroup_details', $data);
                    $getData = $this->db->where('id', $infoId)->get('facilitygroup_details')->result_array()[0];
                    $persn = $_SESSION['PERSONAL_NUMBER'];
                    $this->insertLog($persn, "", "update admin/bankfacilities", json_encode($getData), json_encode($data), "");
                    $this->session->set_flashdata('Success', '<br>New Data has been successfully added!');

                    redirect('admin/bankfacilities');
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
            'status' => 0,
            'modion' => $today,
            'modiby' => $userId
        );

        if ($infoId != '') {
            $getData = $this->db->where('ID', $infoId)->get('facilitygroup_details')->result_array()[0];
            $deleteData = $this->db->where('ID', $infoId)->update('facilitygroup_details', $data);
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "delete admin/bankfacilities", json_encode($getData), json_encode($data), "");
            $this->session->set_flashdata('Success', '<br>Data has been successfully deleted!');

            redirect('admin/bankfacilities');
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