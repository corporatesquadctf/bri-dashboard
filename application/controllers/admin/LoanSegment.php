<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class LoanSegment extends MY_Controller {

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
        $this->load->model('Leaderboard_model');
        $this->load->model('TasklistAccountPlanning_model');
    }

    public function index() {
        $this->checkModule();

        $data['LoanSegment'] = $this->Leaderboard_model->getLoanSegment();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/LoanSegment_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertNew() {
        $SegmentName = $this->input->post('SegmentName');
        $AmountEL = NULL;
        if (!empty($this->input->post('AmountEL'))) {
          $AmountEL = str_replace(',', '', $this->input->post('AmountEL'));
        }
        $AmountEAD = NULL;
        if (!empty($this->input->post('AmountEAD'))) {
          $AmountEAD = str_replace(',', '', $this->input->post('AmountEAD'));
        }
        $userId = $this->input->post('currentUser');
        $today = date('Y-m-d H:i:s');

        if ($SegmentName) {
            $newData = [
                'Name' => $SegmentName,
                'AmountEL' => $AmountEL,
                'AmountEAD' => $AmountEAD,
                'IsActive' => '1',
                'CreatedDate' => $today,
                'CreatedBy' => $userId
            ];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            
            $this->insertLog('INFO', $persn, "Insert Loan Segment", "", "", json_encode($newData), "");
            $insertData = $this->TasklistAccountPlanning_model->insertData('SektorEkonomiRaroc', $newData);
            
            echo json_encode($insertData);
            die();
        }
    }

    public function updateData() {
        $SektorEkonomiRarocId = $this->input->post('SektorEkonomiRarocId');
        $editSegmentName = $this->input->post('SegmentName');
        $AmountEL = NULL;
        if (!empty($this->input->post('AmountEL'))) {
          $AmountEL = str_replace(',', '', $this->input->post('AmountEL'));
        }
        $AmountEAD = NULL;
        if (!empty($this->input->post('AmountEAD'))) {
          $AmountEAD = str_replace(',', '', $this->input->post('AmountEAD'));
        }
        $userId = $this->input->post('userId');
        $today = date('Y-m-d H:i:s');

        $this->form_validation->set_rules('editSegmentName', 'Loan Segment Name ', 'required');

        if ($SektorEkonomiRarocId) {
            $newData = [
                'Name' => $editSegmentName,
                'AmountEL' => $AmountEL,
                'AmountEAD' => $AmountEAD,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];
            $getData = $this->Leaderboard_model->getLoanSegmentDetails($SektorEkonomiRarocId);
            $persn = $_SESSION['PERSONAL_NUMBER'];

            $this->insertLog('INFO', $persn, "Update Loan Segment", "", json_encode($getData), json_encode($newData), "");
            $updateData = $this->TasklistAccountPlanning_model->updateData('SektorEkonomiRaroc', $newData, 'SektorEkonomiRarocId', $SektorEkonomiRarocId);

            echo json_encode($updateData);
            die();
        }
    }

    public function deleteData() {

        $SektorEkonomiRarocId = $this->input->post('SektorEkonomiRarocId');
        $userId = $this->input->post('userId');
        $today = date('Y-m-d H:i:s');

        if ($SektorEkonomiRarocId) {
            $newData = [
                'IsActive' => 0,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];
            $getData = $this->Leaderboard_model->getLoanSegmentDetails($SektorEkonomiRarocId);
            $persn = $_SESSION['PERSONAL_NUMBER'];

            $this->insertLog('INFO', $persn, "Update Loan Segment", "", json_encode($getData), json_encode($newData), "");
            $updateData = $this->TasklistAccountPlanning_model->updateData('SektorEkonomiRaroc', $newData, 'SektorEkonomiRarocId', $SektorEkonomiRarocId);

            echo json_encode($updateData);
            die();
        }
    }

    function insertLog($level, $userId, $action, $msg, $old, $new, $exception) {
        $newData = [
            'Level' => $level,
            'LogDate' => date('Y-m-d H:i:s'),
            'CreatedBy' => $userId,
            'Action' => $action,
            'Message' => $msg,
            'OldValue' => $old,
            'NewValue' => $new,
            'Exception' => $exception
        ];
        $updateData = $this->db->insert('LOG', $newData);
    }

}

?>