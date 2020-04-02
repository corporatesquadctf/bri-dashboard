<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Approver extends REST_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->checkTokenMobile();
    $this->load->helper(array(
      'form',
      'url',
      'security'
    ));

    $this->load->model("api/account_planning_menengah/CreateAccountPlanning_model", "CreateAccountPlanning_model");
    $this->load->model("api/account_planning_menengah/ManageAccountPlanning_model", "ManageAccountPlanning_model");
    // $this->load->model("disposisi/account_planning_menengah/Disposisi_model", "Disposisi_model");
    $this->load->model("data_transaction/account_planning_menengah/DataTransaction_model", "DataTransaction_model");
    $this->load->model("MonitoringAccountPlanning_model");
    $this->load->model("PerformanceAccountPlanning_model");
    $this->load->model("ConfirmationAccountPlanningMenengah_model");

    $current_datetime = new DateTime(date('Y-m-d H:i:s'));
    $this->current_year = $current_datetime->format('Y');
    $this->current_date = $current_datetime->format('Y-m-d');
    $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    $this->limit_per_page = 15;
  }
  public function list_post()
  {
    $params = array();

    $userId = $this->post('UserId');
    if (empty($userId)) {
      $this->response([
        'status'    => FALSE,
        'message'   => 'UserId cannot be empty'
      ], REST_Controller::HTTP_BAD_REQUEST);
      return;
    }

    $current_page = $this->post('page') ? $this->post('page') : 1;
    $rowno        = (($current_page - 1) * $this->limit_per_page);

    $total_records = $this->ConfirmationAccountPlanningMenengah_model->getTotalConfirmationAccountPlanning($userId);
    $total_page    = ceil($total_records / $this->limit_per_page);
    if ($total_records > 0) {
      $ap_Tasklist = $this->ConfirmationAccountPlanningMenengah_model->getConfirmationAccountPlanning($userId, $this->limit_per_page, $rowno);
      $i = 0;
      foreach ($ap_Tasklist as $ap_row) {
        $AccountPlanningMenengahId = $ap_row["AccountPlanningMenengahId"];
        $CIF = $ap_row["CIF"];

        $pinjamanAp  = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
        $simpananAp  = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
        $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

        $ap_year_color = "#218FD8";
        if ($ap_row["Year"] != $this->current_year) {
          $ap_year_color = "#F58C38";
        }

        $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
        $ap_Tasklist[$i]["PinjamanTotalAP"] = number_format($pinjamanAp['TotalPinjaman'] / VALUE_PER, 0);
        $ap_Tasklist[$i]["PinjamanRatasAP"] = number_format($pinjamanAp['RatasPinjaman'] / VALUE_PER, 0);
        $ap_Tasklist[$i]["SimpananTotalAP"] = number_format($simpananAp['TotalSimpanan'] / VALUE_PER, 0);
        $ap_Tasklist[$i]["SimpananRatasAP"] = number_format($simpananAp['RatasSimpanan'] / VALUE_PER, 0);
        $ap_Tasklist[$i]["CommentAP"] = $rsCommentAp;
        $i++;
      }
      $params["result"] = $ap_Tasklist;
      $params["total_result"] = $total_records;
      $params["current_page"] = $current_page;
      $params["total_page"] = $total_page;

      $this->response([
        'data'      => $params,
        'status'    => "Success",
        'message'   => 'Success fecht list Account Planning'
      ], REST_Controller::HTTP_OK);
    }

    $this->response([
      'data'    => [],
      'status'  => FALSE,
      'message' => 'No Account Planning were found'
    ], REST_Controller::HTTP_NOT_FOUND);
  }

  public function addResponseApprover_post()
  {
    $userId                    = $this->post('UserId');
    $accountPlanningMenengahId = $this->post("accountPlanningId");
    $documentStatusId          = $this->post("documentStatusId");
    $comment                   = $this->post("comment");
    if (empty($userId) || empty($accountPlanningMenengahId) || empty($documentStatusId)) {
      $this->response([
        'status'    => FALSE,
        'message'   => 'UserId, accountPlanningMenengahId and documentStatusId cannot be empty'
      ], REST_Controller::HTTP_BAD_REQUEST);
      return;
    }

    $accountPlanningStatus = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($accountPlanningMenengahId);
    if ($accountPlanningStatus['DocumentStatusId'] == 2) {
      switch ($documentStatusId) {
        case 3:
          $isApproved = 1;
          break;
        case 4:
          $isApproved = 2;
          break;
        default:
          $isApproved = "";
      }
      $data = array(
        "AccountPlanningMenengahId" => $accountPlanningMenengahId,
        "DocumentStatusId"          => $documentStatusId,
        "Comment"                   => $comment,
        "IsApproved"                => $isApproved,
        "UserId"                    => $userId,
        "CurrentDate"               => $this->current_datetime
      );
      $rsApprovalAccountPlanning = $this->ConfirmationAccountPlanningMenengah_model->approvalAccountPlanning($data);

      $this->response([
        'status'    => 'Success',
        'message'   => $rsApprovalAccountPlanning
      ], REST_Controller::HTTP_OK);
      return;
    } else {
      switch ($documentStatusId) {
        case 3:
          $msg = "Failed to Approve Account Planning";
          break;
        case 4:
          $msg = "Failed to Reject Account Planning";
          break;
        default:
          $msg = "";
      }
      $this->response([
        'status'    => FALSE,
        'message'   => $msg
      ], REST_Controller::HTTP_BAD_REQUEST);
      return;
    }
  }
}
