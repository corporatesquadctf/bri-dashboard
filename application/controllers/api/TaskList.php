<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TaskList extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->model('api/TasklistAccountPlanning_model');
        $this->load->model('MonitoringAccountPlanning_model');
        $this->load->model('PerformanceAccountPlanning_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->month_current = $current_datetime->format('m');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function index_post()
    {

        $userId = $this->post('UserId');
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';
        $searchYear = $this->post('searchYear') ? $this->post('searchYear') : $this->current_year;
        $docStatus = $this->post('docStatus') ? $this->post('docStatus') : '';

        if (empty($userId)) {
            $this->response([
                'status' => $userId,
                'message' => 'userId cannot be empty'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning($userId, $searchYear, $docStatus, $searchTxt);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning($userId, $limit_per_page, $rowno, $searchYear, $docStatus, $searchTxt);

            foreach ($ap_Tasklist as $ap_row) {
                $AccountPlanningId = $ap_row['AccountPlanningId'];

                $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
                $params[] = array(
                    'AccountPlanningId'               => $AccountPlanningId,
                    'logo_uri'                        => $ap_row['Logo'],
                    'company_name'                    => $ap_row['CustomerName'],
                    'company_group'                   => $ap_row['company_group'],
                    'status_ap'                       => $account_planning_status['Status'],
                    'Year'                            => $ap_row['Year'],
                    'CreatedDate'                     => $ap_row['CreatedDate'],
                    'Relationship Monitoring Name'    => $ap_row['RMName'],
                );
            }
        }

        if ($params) {
            $this->response([
                'data' => $params,
                'total_data' => $total_records,
                'current_page' => $current_page,
                'total_page' => $total_page,
                'status' => "Success",
                "detail" => "Success Fetch Account Planning List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'No Account Planning were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function addCheckerSigner_post()
    {
        $accountPlanningId = $this->post('AccountPlanningId');
        $userId            = $this->post('userId');
        $checkerList       = $this->post('checker_per_uker_list');
        $signerList        = $this->post('signer_per_uker_list');

        if(empty($accountPlanningId)||empty($userId)){

        }
        $data_input = array(
            'AccountPlanningId' => $accountPlanningId, 
            'DocumentStatusId'  => 2, 
            'CreatedDate'       => $this->current_datetime, 
            'CreatedBy'         => $userId
        );

        $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_input);

        foreach ($checkerList as $key => $checker_per_uker_list) {
            $data_inputChecker[$key] = array(
                'UserId'            => $checker_per_uker_list, 
                'AccountPlanningId' => $accountPlanningId, 
                'IsActive'          => 1, 
                'IsApproved'        => NULL, 
                'Comment'           => NULL, 
                'CreatedDate'       => $this->current_datetime, 
                'CreatedBy'         => $userId
            );

            $insertCheckerPerRM = $this->TasklistAccountPlanning_model->insertCheckerSignerPerRM('AccountPlanningChecker', $data_inputChecker[$key]);
            if ($insertCheckerPerRM['status'] == 'success') {
                $this->TasklistAccountPlanning_model->addNotif($userId, $checker_per_uker_list, "Account Planning", "Add Account Planning Checker", "You are added as a checker of account planning (" . $accountPlanningId . ")", "confirmation/Checker/view/" . $accountPlanningId);
            }
            if ($insertCheckerPerRM['status'] == 'error')
                break;
        }

        foreach ($signerList as $key => $signer_per_uker_list) {
            $data_inputSigner[$key] = array(
                'UserId'            => $signer_per_uker_list, 
                'AccountPlanningId' => $accountPlanningId, 
                'IsActive'          => 1, 
                'IsApproved'        => NULL, 
                'Comment'           => NULL, 
                'CreatedDate'       => $this->current_datetime, 
                'CreatedBy'         => $userId
            );

            $insertSignerPerRM = $this->TasklistAccountPlanning_model->insertCheckerSignerPerRM('AccountPlanningSigner', $data_inputSigner[$key]);
            if ($insertSignerPerRM['status'] == 'success') {
                $this->TasklistAccountPlanning_model->addNotif($userId, $signer_per_uker_list, "Account Planning", "Add Account Planning Signer", "You are added as a signer of account planning (" . $accountPlanningId . ")", "confirmation/Signer/view/" . $accountPlanningId);
            }
            if ($insertSignerPerRM['status'] == 'error')
                break;
        }

        if ($insertCheckerPerRM['status'] == 'success' && $insertSignerPerRM['status'] == 'success'){
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Submit', 'Submitting account planning', $userId);
            $this->response([
                "data"   => [],
                "status" => "Success",
                "detail" => "Success add Checker Signer",
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "data"   => [],
                "status" => FALSE,
                "detail" => "failed add Checker Signer",
            ], REST_Controller::HTTP_CONFLICT);
        }
    }
    
    public function listCheckerSigner_post()
    {
        $limit_per_page = 99;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';

        $total_records = $this->TasklistAccountPlanning_model->getTotalListCheckerSigner($searchTxt);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $CS = $this->TasklistAccountPlanning_model->getListCheckerSigner($limit_per_page, $rowno, $searchTxt);
            $data['cheker_signer'] = $CS;
            $data['total'] = $total_records;
            $data['total_page'] = $total_page;
            $data['current_page'] = $current_page;

            $this->response([
                'data'   => $data,
                'status' => "Success",
                "detail" => "Success Fetch list Checker Signer",
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'data'   => [],
                'status' => FALSE,
                "detail" => "No Checker or Signer Were Found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function filterTaksList_get()
    {
        $data['search_year'] = array(
            $this->current_year - 1 => $this->current_year - 1,
            $this->current_year => $this->current_year,
            $this->current_year + 1 => $this->current_year + 1
        );
        $data['doc_statuses'] = $this->MonitoringAccountPlanning_model->get_doc_status();

        if ($data) {
            $this->response([
                'data'   => $data,
                'status' => "Success",
                "detail" => "Success Fetch List Filter",
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'data'   => [],
                'status' => FALSE,
                "detail" => "No Doc Status Were Found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
