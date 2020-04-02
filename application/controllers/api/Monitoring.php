<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Monitoring extends REST_Controller
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
        $this->load->model('PerformanceAccountPlanning_model');
        $this->load->model('MonitoringAccountPlanning_model');
        $this->load->model('MonitoringRm_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->month_current = $current_datetime->format('m');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function RelationshipManager_post()
    {
        $data = array(
            'rmusers' => array()
        );
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : "2019";

        $total_records = $this->MonitoringRm_model->getTotalViewRelationshipManager($searchTxt);

        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $rmusers = $this->MonitoringRm_model->getViewRelationshipManager($limit_per_page, $rowno, $searchTxt);

            foreach ($rmusers as $rmuser) {
                $rm_id = $rmuser['MonitoringRmId'];
                if (!key_exists($rm_id, $data['rmusers'])) {
                    if ($rmuser['AccountPlanningProgress'] == 0.00) {
                        $AccountPlanningProgress = '0';
                    } else {
                        $AccountPlanningProgress = $rmuser['AccountPlanningProgress'];
                    }

                    $AccountPlanningList = json_decode($rmuser['AccountPlanningList'], TRUE);
                    foreach ($AccountPlanningList as $key => $value) {
                        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($value['ap_id']);
                        $AccountPlanningList[$key]['doc_status'] = $account_planning_status['DocumentStatusId'];
                    }

                    $params[] = array(
                        'RmId' => $rm_id,
                        'RmName' => $rmuser['RmName'],
                        'PersonalNumber' => $rmuser['PersonalNumber'],
                        'Division' => $rmuser['Division'],
                        'LastActivity' => $rmuser['LastActivity'],
                        'Year' => $rmuser['Year'],
                        'AccountPlanningTotal' => $rmuser['AccountPlanningTotal'],
                        'AccountPlanningList' => $AccountPlanningList,
                        'AccountPlanningPublish' => $rmuser['AccountPlanningPublish'],
                        'AccountPlanningWa' => $rmuser['AccountPlanningWa'],
                        'AccountPlanningDraft' => $rmuser['AccountPlanningDraft'],
                        'AccountPlanningReject' => $rmuser['AccountPlanningReject'],
                        'AccountPlanningProgress' => number_format($AccountPlanningProgress, 1)
                    );
                }
            }
        }

        if ($params) {
            $this->response([
                'data' => $params,
                'total_data' => $total_records,
                'current_page' => $current_page,
                'total_page' => $total_page,
                'status' => "Success",
                "detail" => "Success Fetch Monitoring Relationship Manager List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data'  => [],
                'status' => FALSE,
                'message' => 'No Monitoring Relationship Manager were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function AccountPlanning_post()
    {
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';
        $status_search = ($this->input->get('status_search_box')) ? $this->input->get('status_search_box') : "all";

        $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning($searchTxt, '', $this->current_year, $status_search);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, $searchTxt, '', $this->current_year, $status_search);
            $data = array(
                'ap_monitoring' => array()
            );
            foreach ($ap_monitoring as $ap_row) {
                $ap_id = $ap_row['MonitoringAccountPlanningId'];
                if (!key_exists($ap_id, $data['ap_monitoring'])) {
                    if ($ap_row['ProgressTotal'] == 0.00) {
                        $ProgressTotal = '0';
                    } else {
                        $ProgressTotal = $ap_row['ProgressTotal'];
                    }
                    $AccountPlanningCheckerList = $this->MonitoringAccountPlanning_model->getAccountPlanningChecker($ap_row['AccountPlanningId']);
                    $CheckerList = array();
                    foreach ($AccountPlanningCheckerList as $key) {
                        $CheckerList[] = $key['personal_number'] . "/" . $key['Name'];
                    }

                    $AccountPlanningSignerList = $this->MonitoringAccountPlanning_model->getAccountPlanningSigner($ap_row['AccountPlanningId']);
                    $SignerList = array();
                    foreach ($AccountPlanningSignerList as $key) {
                        $SignerList[] = $key['personal_number'] . "/" . $key['Name'];
                    }

                    $AccountPlanningAddon = '';
                    if (!empty(strtotime($ap_row['AccountPlanningAddon']))) {
                        $AccountPlanningAddon = date("j/m/y", strtotime($ap_row['AccountPlanningAddon']));
                    }

                    $AccountPlanningPublish = '';
                    $AccountPlanningPublish_datetime = $this->current_datetime;
                    $dateDiff = '';
                    if ($ap_row['DocumentStatusId'] == 4) {
                        if (!empty(strtotime($ap_row['AccountPlanningPublish']))) {
                            $AccountPlanningPublish = ' - <i class="fa fa-clock" title="Publish" style="color: #5cb85c;"></i> ' . date("j/m/y", strtotime($ap_row['AccountPlanningPublish']));
                            $AccountPlanningPublish_datetime = $ap_row['AccountPlanningPublish'];
                            if (!empty(strtotime($ap_row['AccountPlanningAddon'])) && !empty(strtotime($AccountPlanningPublish_datetime))) {
                                $dateDiff = " : " . $this->dateDiff($ap_row['AccountPlanningAddon'], $AccountPlanningPublish_datetime) . " day(s)";
                            }
                        }
                    }
                    $ap_logo['Logo'] = '';
                    if (!empty($ap_row['GroupId'])) {
                        $ap_logo = $this->MonitoringAccountPlanning_model->get_customer_logo($ap_row['GroupId']);
                    }

                    $SektorUsaha = ($ap_row['SektorUsaha']) ? $ap_row['SektorUsaha'] : "Kelapa Sawit";
                    $Clasified = ($ap_row['Clasified']) ? $ap_row['Clasified'] : "Platinum";
                    $params[] = array(
                        'AccountPlanningId'     => $ap_id,
                        'CustomerName'          => $ap_row['CustomerName'],
                        'Logo'                  => $ap_logo['Logo'],
                        'Vcif'                  => $ap_row['Vcif'],
                        'SektorUsaha'           => $SektorUsaha,
                        'RMName'                => $ap_row['RMName'],
                        'Member'                => json_decode($ap_row['Member'], TRUE),
                        'CheckerList'           => implode("; ", $CheckerList),
                        'SignerList'            => implode("; ", $SignerList),
                        'GroupName'             => $ap_row['GroupName'],
                        'Clasified'             => $Clasified,
                        'DocumentStatusId'      => $ap_row['DocumentStatusId'],
                        'Status'                => $ap_row['Status'],
                        'AccountPlanningAddon'  => $AccountPlanningAddon,
                        'AccountPlanningPublish' => $AccountPlanningPublish,
                        'dateDiff'              => $dateDiff,
                        'current_date'          => $this->current_date,
                        'Year'                  => $ap_row['Year'],
                        'ProgressTotal'         => number_format($ProgressTotal, 1)
                    );
                }
            }
        }

        if ($params) {
            $this->response([
                'data'          => $params,
                'total_data'    => $total_records,
                'current_page'  => $current_page,
                'total_page'    => $total_page,
                'status'        => "Success",
                "detail"        => "Success Fetch Monitoring Account Planning List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data'  => [],
                'status'  => FALSE,
                'message' => 'No Monitoring Account Planning were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function dateDiff($date1, $date2)
    {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);

        $diff = $date2_ts - $date1_ts;

        return round($diff / 86400);
    }
}
