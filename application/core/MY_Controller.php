<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH . 'core/REST_Controller.php');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function insertLog($level, $userId, $action, $msg, $old, $new, $exception) {
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

    public function checkAPInputStatus($AccountPlanningId) {
        $this->load->model('TasklistAccountPlanning_model');
        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);

        if ($account_planning_status['DocumentStatusId'] != 0 && $account_planning_status['DocumentStatusId'] != 1) {
            redirect(base_url('tasklist/AccountPlanning/detail/'.$AccountPlanningId));
        }
    }

    public function isLogin() {
        if (!isset($_SESSION['PERSONAL_NUMBER'])) {
            redirect(base_url());
        } 
    }

    public function checkModule() {
        $this->load->model('Module_model');
        $url = uri_string();

        if ($this->Module_model->checkModule($url) == false) {
            redirect('profile');
        }
        if (!isset($_SESSION['PERSONAL_NUMBER'])) {
            redirect(base_url());
        } 
    }

    public function checkOwner($AccountPlanningId) {
        $this->load->model('Module_model');

        if ($this->Module_model->checkOwner($AccountPlanningId) == false) {
            redirect(base_url('performance/AccountPlanning/view/'.$AccountPlanningId.'/details'));
        }
    }

    public function isOwner($AccountPlanningId) {
        $this->load->model('Module_model');

        return $this->Module_model->checkOwner($AccountPlanningId);
    }

    public function isCST($AccountPlanningId) {
        $this->load->model('Module_model');

        return $this->Module_model->checkCST($AccountPlanningId);
    }

    public function checkCST($AccountPlanningId, $AccountPlanningTab, $AccountPlanningSubTab) {
        $this->load->model('Module_model');

        if ($this->Module_model->checkCST($AccountPlanningId) == false) {
            redirect(base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/details/'.$AccountPlanningTab.'/'.$AccountPlanningSubTab));
        }
    }

    public function checkModuleAcc() {
        $this->load->model('Module_model');

        if ($this->Module_model->checkModuleAcc() == false) {
            redirect('profile');
        }
    }

    public function checkSubRole() {
        $this->load->model('Module_model');

        $sub_role = $_SESSION['SUBROLE_ID'];

        if ($this->Module_model->CheckSub($sub_role) == false) {
            redirect('profile');
        }
    }

    public function checkAccessAcp() {
        $this->load->model('Module_model');
        $url = uri_string();
        $urls = explode("/", $url);
        $vcif = $urls[3];
        $year = $urls[4];


        if ($this->Module_model->check_tasks($vcif, $year) == false) {
            redirect('profile');
        }
    }

    public function checkAccessViewAcp() {
        $this->load->model('Module_model');
        $url = uri_string();
        $urls = explode("/", $url);
        $vcif = $urls[3];
        $year = $urls[4];

        if ($this->Module_model->check_viewtasks($vcif, $year) == false) {
            redirect('profile');
        }
    }

    public function checkViewCPA() {
        $this->load->model('Module_model');
        $url = uri_string();
        $urls = explode("/", $url);

        if ($this->Module_model->check_viewCPA($urls) == false) {
            redirect('profile');
        }
    }

}
