<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Approval extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));

        $this->load->model('DataTransaction_model');
        $this->load->model('ConfirmationAccountPlanning_model');
        $this->load->model('PerformanceAccountPlanning_model');
        $this->load->model('api/TasklistAccountPlanning_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
        $this->checkTokenMobile();
    }

    public function checker_post()
    {
        $personalnumber = $this->post('personalnumber');
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $data['confirmation_user']     = 'Checker';
        $data['confirmation_table'] = 'AccountPlanningChecker';
        $data['confirmation_table_id'] = 'AccountPlanningCheckerId';
        $data['confirmation_docstatus_id'] = 2;

        $rowno = (($current_page - 1) * $limit_per_page);
        $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($personalnumber);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($personalnumber, $limit_per_page, $rowno);

            foreach ($ap_Tasklist as $ap_row) {
                $AccountPlanningId = $ap_row['AccountPlanningId'];

                $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
                $params[] = array(
                    'AccountPlanningId'               => $AccountPlanningId,
                    'logo_uri'                        => $ap_row['Logo'],
                    'company_name'                    => $ap_row['CustomerName'],
                    'status_ap'                       => $account_planning_status['Status'],
                    'Year'                            => $ap_row['Year'],
                    'CreatedDate'                     => $ap_row['CreatedDate'],
                    'AccountPlanningChecker'         => $ap_row['AccountPlanningChecker'],
                    'Relationship Monitoring Name'    => $ap_row['RMName'],
                );
            }
        }
        if ($params) {
            $this->response([
                'data'          => $params,
                'confirmation'  => $data,
                'total_data'    => $total_records,
                'current_page'  => $current_page,
                'total_page'    => $total_page,
                'status'        => "Success",
                "detail"        => "Success Fetch Approval Checker Account Planning List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Approval Checker Account Planning were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function signer_post()
    {
        $personalnumber = $this->post('personalnumber');
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $data['confirmation_user']     = 'Signer';
        $data['confirmation_table'] = 'AccountPlanningSigner';
        $data['confirmation_table_id'] = 'AccountPlanningSignerId';
        $data['confirmation_docstatus_id'] = 3;

        $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewSignerAccountPlanning($personalnumber);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewSignerAccountPlanning($personalnumber, $limit_per_page, $rowno);

            foreach ($ap_Tasklist as $ap_row) {
                $AccountPlanningId = $ap_row['AccountPlanningId'];

                $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
                $params[] = array(
                    'AccountPlanningId'               => $AccountPlanningId,
                    'logo_uri'                        => $ap_row['Logo'],
                    'company_name'                    => $ap_row['CustomerName'],
                    'status_ap'                       => $account_planning_status['Status'],
                    'Year'                            => $ap_row['Year'],
                    'CreatedDate'                     => $ap_row['CreatedDate'],
                    'AccountPlanningSignerId'         => $ap_row['AccountPlanningSignerId'],
                    'Relationship Monitoring Name'    => $ap_row['RMName'],
                );
            }
        }
        if ($params) {
            $this->response([
                'data'          => $params,
                'confirmation'  => $data,
                'total_data'    => $total_records,
                'current_page'  => $current_page,
                'total_page'    => $total_page,
                'status'        => "Success",
                "detail"        => "Success Fetch Approval Signer Account Planning List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data'    => [],
                'status'  => FALSE,
                'message' => 'No Approval Signer Account Planning were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function addSignerResponse_post()
    {
        $this->post('confirmation_response');
        $this->post('Comment');
        $this->post('AccountPlanningId');
        $this->post('personalnumber');

        if (!empty($this->post('personalnumber')) && !empty($this->post('AccountPlanningId'))) {
            $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($this->post('AccountPlanningId'));
            $SignerDetail = $this->ConfirmationAccountPlanning_model->getSignerDetail($this->post('AccountPlanningId'), $this->post('personalnumber'));

            if ($account_planning_status['DocumentStatusId'] == 3 && empty($SignerDetail['IsApproved'])) {
                $IsApproved = 1;
                $DocumentStatusId = 4;
                if ($this->post('confirmation_response') == 'Reject') {
                    $IsApproved = 2;
                    $DocumentStatusId = 6;
                }
                $data_form = array(
                    'ConfirmationTable'         => 'AccountPlanningSigner',
                    'ConfirmationTableIdField'  => 'AccountPlanningSignerId',
                    'ConfirmationTableIdValue'  => $SignerDetail['AccountPlanningSignerId']
                );
                $data_update = array(
                    'IsApproved'          => $IsApproved,
                    'Comment'             => $this->post('Comment'),
                    'ModifiedDate'        => $this->current_datetime,
                    'ModifiedBy'          => $this->post('personalnumber')
                );

                $updateData = $this->TasklistAccountPlanning_model->updateData($data_form['ConfirmationTable'], $data_update, $data_form['ConfirmationTableIdField'], $data_form['ConfirmationTableIdValue']);

                // echo json_encode($updateData);

                $SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($this->post('AccountPlanningId'));
                foreach ($SignerList as $key => $value) {
                    if (!empty($value['IsApproved'])) {
                        $IsApprovedConfirmed[$key] = $value['IsApproved'];
                    }
                }
                $SignerList_count = count($SignerList);
                $IsApprovedConfirmed_count = count($IsApprovedConfirmed);

                if ($DocumentStatusId == 6) {
                    $data_insert = array(
                        'DocumentStatusId'       => $DocumentStatusId,
                        'AccountPlanningId'      => $this->post('AccountPlanningId'),
                        'Comment'                => $this->post('Comment'),
                        'CreatedDate'            => $this->current_datetime,
                        'CreatedBy'              => $this->post('personalnumber')
                    );
                } elseif ($SignerList_count == $IsApprovedConfirmed_count) {
                    $data_insert = array(
                        'DocumentStatusId'       => $DocumentStatusId,
                        'AccountPlanningId'      => $this->post('AccountPlanningId'),
                        'Comment'                => $this->post('Comment'),
                        'CreatedDate'            => $this->current_datetime,
                        'CreatedBy'              => $this->post('personalnumber')
                    );
                }

                if (!empty($data_insert)) {
                    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_insert);
                    if ($DocumentStatusId == 6)
                        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->post('AccountPlanningId'), 'Approval Signer', 'Rejected by signer: ' . $this->post('Comment'), $this->post('personalnumber'));
                    else
                        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->post('AccountPlanningId'), 'Approval Signer', 'Approved by signer: ' . $this->post('Comment'), $this->post('personalnumber'));
                }
                if ($this->post('confirmation_response') == 'Reject') {
                    $this->response([
                        'status' => "Success",
                        'message' => 'Account Planning Rejected'
                    ], REST_Controller::HTTP_OK);
                } elseif ($this->post('confirmation_response') == 'Approve') {
                    $this->response([
                        'status' => "Success",
                        'message' => 'Account Planning Approved'
                    ], REST_Controller::HTTP_OK);
                }
            } else {
                // Set the response and exit
                $this->response([
                    'account_planning_status' => $account_planning_status,
                    'SignerDetail' => $SignerDetail,
                    'status' => FALSE,
                    'message' => 'Approval Failed'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'personalnumber, AccountPlanningId and confirmation_response cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function addCheckerResponse_post()
    {
        $this->post('confirmation_response');
        $this->post('Comment');
        $this->post('AccountPlanningId');
        $this->post('personalnumber');

        if (!empty($this->post('personalnumber')) && !empty($this->post('AccountPlanningId')) && !empty($this->post('confirmation_response'))) {
            $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($this->post('AccountPlanningId'));
            $CheckerDetail = $this->ConfirmationAccountPlanning_model->getCheckerDetail($this->post('AccountPlanningId'), $this->post('personalnumber'));

            if ($account_planning_status['DocumentStatusId'] == 2 && empty($CheckerDetail['IsApproved'])) {
                $IsApproved = 1;
                $DocumentStatusId = 3;
                if ($this->post('confirmation_response') == 'Reject') {
                    $IsApproved = 2;
                    $DocumentStatusId = 5;
                }
                $data_form = array(
                    'ConfirmationTable'         => 'AccountPlanningChecker',
                    'ConfirmationTableIdField'  => 'AccountPlanningChecker',
                    'ConfirmationTableIdValue'  => $CheckerDetail['AccountPlanningChecker']
                );
                $data_update = array(
                    'IsApproved'          => $IsApproved,
                    'Comment'             => $this->post('Comment'),
                    'ModifiedDate'        => $this->current_datetime,
                    'ModifiedBy'          => $this->post('personalnumber')
                );

                $updateData = $this->TasklistAccountPlanning_model->updateData($data_form['ConfirmationTable'], $data_update, $data_form['ConfirmationTableIdField'], $data_form['ConfirmationTableIdValue']);

                //echo json_encode($updateData);

                $CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($this->post('AccountPlanningId'));
                foreach ($CheckerList as $key => $value) {
                    if (!empty($value['IsApproved'])) {
                        $IsApprovedConfirmed[$key] = $value['IsApproved'];
                    }
                }
                $CheckerList_count = count($CheckerList);
                $IsApprovedConfirmed_count = count($IsApprovedConfirmed);

                if ($DocumentStatusId == 5) {
                    $data_insert = array(
                        'DocumentStatusId'       => $DocumentStatusId,
                        'AccountPlanningId'      => $this->post('AccountPlanningId'),
                        'Comment'                => $this->post('Comment'),
                        'CreatedDate'            => $this->current_datetime,
                        'CreatedBy'              => $this->post('personalnumber')
                    );
                } elseif ($CheckerList_count == $IsApprovedConfirmed_count) {
                    $data_insert = array(
                        'DocumentStatusId'       => $DocumentStatusId,
                        'AccountPlanningId'      => $this->post('AccountPlanningId'),
                        'Comment'                => $this->post('Comment'),
                        'CreatedDate'            => $this->current_datetime,
                        'CreatedBy'              => $this->post('personalnumber')
                    );
                }

                if (!empty($data_insert)) {
                    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_insert);
                    if ($DocumentStatusId == 5)
                        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->post('AccountPlanningId'), 'Approval Checker', 'Rejected by checker: ' . $this->post('Comment'), $this->post('personalnumber'));
                    else
                        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->post('AccountPlanningId'), 'Approval Checker', 'Approved by checker: ' . $this->post('Comment'), $this->post('personalnumber'));
                }
                if ($this->post('confirmation_response') == 'Reject') {
                    $this->response([
                        'status' => "Success",
                        'message' => 'Account Planning Rejected'
                    ], REST_Controller::HTTP_OK);
                } elseif ($this->post('confirmation_response') == 'Approve') {
                    $this->response([
                        'status' => "Success",
                        'message' => 'Account Planning Approved'
                    ], REST_Controller::HTTP_OK);
                }
            } else {
                // Set the response and exit
                $this->response([
                    'account_planning_status' => $account_planning_status,
                    'CheckerDetail' => $CheckerDetail,
                    'status' => FALSE,
                    'message' => 'Approval Failed'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'personalnumber, AccountPlanningId and confirmation_response cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
