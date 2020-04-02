<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class RMLeaderboard extends REST_Controller
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
        $this->load->model('api/RMLeaderboard_model');
        $this->load->model('Leaderboard_model');
        $this->load->model('PerformanceAccountPlanning_model');
        $this->load->model('MonitoringAccountPlanning_model');
        $this->load->model('DataTransaction_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function index_post()
    {

        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $keyword_search = $this->post('searchTxt') ? $this->post('searchTxt') : '';
        $uker_search = ($this->post('uker_search_box')) ? $this->post('uker_search_box') : "";

        $total_records = $this->Leaderboard_model->getTotalViewRmLeaderboard($keyword_search, $uker_search);
        $total_page = ceil($total_records / $limit_per_page);

        if ($total_records > 0) {
            $rmusers = $this->Leaderboard_model->getViewRmLeaderboard($limit_per_page, $rowno, $keyword_search, $uker_search);

            if ($rmusers) {
                $this->response([
                    'data' => $rmusers,
                    'total_data' => $total_records,
                    'current_page' => $current_page,
                    'total_page' => $total_page,
                    'status' => "Success",
                    "detail" => "Success Fetch Customer Leaderboard List",
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'data' => [],
                    'status' => FALSE,
                    'message' => 'No RM Leaderboard were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'No RM Leaderboard were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function detail_post()
    {
        $params = array();
        $data = array(
            'rmusers' => array()
        );
        $rm_id = $this->post('UserId');
        $rmuser = $this->RMLeaderboard_model->getDetailRM($rm_id);
        $pinjamanPerRM = $this->DataTransaction_model->getLastDataPinjamanPerRM($rm_id);
        $simpananPerRM = $this->DataTransaction_model->getLastDataSimpananPerRM($rm_id);
        $cpaPerRM = $this->DataTransaction_model->getLastDataCpaPerRM($rm_id);

        if ($rmuser) {
            // $AccountPlanningList = $this->Leaderboard_model->getAccountPlanningList($rm_id);
            $AccountPlanningList = $this->Leaderboard_model->getVCIFPerRM($rm_id);
            $VCIFPerUserId = array();
            if (!empty($AccountPlanningList)) {
                foreach ($AccountPlanningList as $customer_list => $customer_row) {
                    $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
                    $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
                    $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);

                    $VCIFPerUserId[$customer_list] = array(
                        'GroupName'                      => $customer_row['GroupName'],
                        'CustomerName'                   => $customer_row['CustomerName'],
                        'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman'] / VALUE_PER, 0),
                        'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman'] / VALUE_PER, 0),
                        'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan'] / VALUE_PER, 0),
                        'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan'] / VALUE_PER, 0),
                        'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa'] / VALUE_PER, 0)
                    );
                }
            }

            $params = array(
                'Detail'                      => $rmuser,
                'VCIFPerUserId'               => $VCIFPerUserId,
                'PinjamanTotalPerRM'          => number_format($pinjamanPerRM['TotalPinjaman'] / VALUE_PER, 0),
                'PinjamanRatasPerRM'          => number_format($pinjamanPerRM['RatasPinjaman'] / VALUE_PER, 0),
                'SimpananTotalPerRM'          => number_format($simpananPerRM['TotalSimpanan'] / VALUE_PER, 0),
                'SimpananRatasPerRM'          => number_format($simpananPerRM['RatasSimpanan'] / VALUE_PER, 0),
                'CurrentCPAPerRM'             => number_format($cpaPerRM['Cpa'] / VALUE_PER, 0),
                'LastAccess'                  => $rmuser[0]['LastAccess']
            );
            $this->response([
                'data' => $params,
                'status' => "Success",
                "detail" => "Success Fetch Customer Leaderboard List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'RM Leaderboard not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function simpananRMMonthly_post()
    {
        $rm_id = $this->post('UserId');

        if ($rm_id) {
            $getSimpananRMMonthly = $this->RMLeaderboard_model->getSimpananRMMonthly($rm_id);
            if (!empty($getSimpananRMMonthly)) {
                $this->response([
                    "data" => $getSimpananRMMonthly,
                    "status" => "Success",
                    "detail" => "Success Fetch Simpanan RM Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Simpanan RM Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "UserId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function pinjamanRMMonthly_post()
    {
        $rm_id = $this->post('UserId');

        if ($rm_id) {
            $getPinjamanRMMonthly = $this->RMLeaderboard_model->getPinjamanRMMonthly($rm_id);
            if (!empty($getPinjamanRMMonthly)) {
                $this->response([
                    "data" => $getPinjamanRMMonthly,
                    "status" => "Success",
                    "detail" => "Success Fetch Pinjaman RM Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Pinjaman RM Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "UserId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function profitabilityRMMonthly_post()
    {
        $rm_id = $this->post('UserId');

        if ($rm_id) {
            $getProfitabilityRMMonthly = $this->RMLeaderboard_model->getProfitabilityRMMonthly($rm_id);
            if (!empty($getProfitabilityRMMonthly)) {
                $this->response([
                    "data" => $getProfitabilityRMMonthly,
                    "status" => "Success",
                    "detail" => "Success Fetch Profitability RM Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Profitability RM Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "UserId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function listUker_get()
    {
        $ukers = $this->MonitoringAccountPlanning_model->get_ukers();

        if (!empty($ukers)) {
            $this->response([
                "data" => $ukers,
                "status" => "Success",
                "detail" => "Success Unit Kerja",
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "No Unit Kerja were found"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
