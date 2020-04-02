<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Customer extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation',
            'pagination'
        ));
        $this->load->model('api/TasklistAccountPlanning_model');
        $this->load->model('MonitoringRm_model');
        $this->load->model('PerformanceAccountPlanning_model');

        $this->checkTokenMobile();
    }

    public function index_get()
    {
        $this->response([
            "Api_getAccountPlanningCoverageMapping" => [
                "API_path" => "/coverageMapping",
                "method" => "POST",
            ],
            "status" => "Success",
            "detail" => "Costumer API",
        ], REST_Controller::HTTP_OK);
    }

    public function groupOverview_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $VCIF = $this->post('VCIF');

        if (!empty($AccountPlanningId) && !empty($VCIF)) {
            $groupOverview = $this->TasklistAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId, $VCIF);
            if (!empty($groupOverview)) {
                $this->response([
                    "data" => $groupOverview,
                    "status" => "Success",
                    "detail" => "Success Fetch Account Planning Group Overview Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "detail" => "No Account Planning Group Overview were found",
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "detail" => "AccountPlanningId and VCIF cannot be empty",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function clientNeeds_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $VCIF = $this->post('VCIF');
        $params = array();

        if (!empty($AccountPlanningId) && !empty($VCIF)) {
            $clientNeeds = $this->PerformanceAccountPlanning_model->getAccountPlanningFunding($AccountPlanningId, $VCIF);
            if (!empty($clientNeeds)) {
                foreach ($clientNeeds as $cn_row) {
                    $params[] = array(
                        'FundingId'           => $cn_row['FundingId'],
                        'Kebutuhan_Pendanaan' => $cn_row['FundingNeed'],
                        'Jangka_Waktu'        => $cn_row['TimePeriod'],
                        'Nominal'             => $cn_row['Amount'],
                        'Description'         => $cn_row['Description']
                    );
                }
                $this->response([
                    "data" => $params,
                    "status" => "Success",
                    "detail" => "Success Fetch Account Planning Client Needs Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "detail" => "No Account Planning Client Needs were found",
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "detail" => "AccountPlanningId and VCIF cannot be empty",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function coverageMapping_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $VCIF = $this->post('VCIF');

        if (!empty($AccountPlanningId) && !empty($VCIF)) {
            $coverageMapping = $this->TasklistAccountPlanning_model->getAccountPlanningCoverageMapping($AccountPlanningId, $VCIF);
            if (!empty($coverageMapping)) {
                $this->response([
                    "data" => $coverageMapping,
                    "status" => "Success",
                    "detail" => "Success Fetch Account Planning Coverage Mapping Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "detail" => "No Account Planning Coverage Mapping were found",
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "detail" => "AccountPlanningId and VCIF cannot be empty",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
