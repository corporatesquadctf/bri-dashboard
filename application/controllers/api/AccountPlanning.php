<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class AccountPlanning extends REST_Controller
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
        $this->load->model('TasklistDisposisi_model');
        $this->load->model('PerformanceAccountPlanning_model');
        $this->load->model('MonitoringAccountPlanning_model');
        // $this->load->model('DataTransaction_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->month_current = $current_datetime->format('m');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function index_post()
    {

        $params = array();
        $limit_per_page = 15;
        $year = $this->post('year') ? $this->post('year') : $this->current_year;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';
        $docStatus = $this->post('docStatus') ? $this->post('docStatus') : '';

        $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning('', $year, $docStatus, $searchTxt);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning('', $limit_per_page, $rowno, $year, $docStatus, $searchTxt);

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
    public function lastYear_post()
    {

        $params = array();
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';

        $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning('', $this->current_year - 1, '', $searchTxt);
        $total_page = ceil($total_records / $limit_per_page);
        if ($total_records > 0) {
            $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning('', $limit_per_page, $rowno, $this->current_year - 1, '', $searchTxt);

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

    public function monitoring_get()
    {
        $status_search = ($this->get('status_search_box')) ? $this->get('status_search_box') : "all";
        $params = array();
        $limit_per_page = 15;
        $current_page = $this->get('page') ? $this->get('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);

        $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning('', '', $this->current_year, $status_search);
        $total_page = ceil($total_records / $limit_per_page);

        if ($total_records > 0) {
            $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, '', '', $this->current_year, $status_search);

            foreach ($ap_monitoring as $ap_row) {
                $AccountPlanningId = $ap_row['AccountPlanningId'];

                $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);

                $params[] = array(
                    'AccountPlanningId'               => $AccountPlanningId,
                    'company_name'                    => $ap_row['CustomerName'],
                    'Relationship Monitoring Name'    => $ap_row['RMName'],
                    'Year'                            => $ap_row['Year'],
                    'status'                       => $ap_row['Status'],
                    'progress'                     => $ap_row['ProgressTotal'],
                    'last_update'                     => $ap_row['AccountPlanningAddon'],
                );
            }
        }
        if ($params) {
            $this->response([
                'data' => $params,
                'current_page' => $current_page,
                'total_page' => $total_page,
                'status' => "Success",
                "detail" => "Success Fetch Account Planning Monitoring",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'No Account Planning Monitoring were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function detail_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $data = array();
        if ($AccountPlanningId) {
            $account_planning_detail = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);

            if (!empty($account_planning_detail)) {
                $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
                $APRecentActivities = $this->TasklistAccountPlanning_model->getAccountPlanningRecentActivities($AccountPlanningId);
                $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
                $data = $account_planning_detail;
                $data['account_planning_member'] = $account_planning_member;
                $data['account_planning_RecentActivities'] = $APRecentActivities;
                $data['account_planning_vcif_list'] = $account_planning_vcif_list;

                $this->response([
                    "data" => $data,
                    // "account_planning_member" => $account_planning_member,
                    "status" => "Success",
                    "detail" => "Success Fetch Account Planning Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Account Planning Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "AccountPlanningId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function lastAndCurrentYear_get()
    {
        $this->response([
            "last_year"     => $this->current_year - 1,
            "current_year"  => intval($this->current_year),
            "status"        => "Success",
            "detail"        => "Success Fetch lastAndCurrentYear",
        ], REST_Controller::HTTP_OK);
    }

    public function filter_get()
    {        
        $year["last_year"]    = $this->current_year - 1;
        $year["current_year"] = intval($this->current_year);
        $data['year']         = $year;
        $data['doc_statuses'] = $this->MonitoringAccountPlanning_model->get_doc_status();
        $data['ukers']        = $this->MonitoringAccountPlanning_model->get_ukers();
        
        $this->response([
            "data"   => $data,
            "status" => "Success",
            "detail" => "Success Fetch Document Status and Unit Kerja",
        ], REST_Controller::HTTP_OK);
    }

    public function simpanan_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $data = array();

        if ($AccountPlanningId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $account_planning_simpananGiro = $this->TasklistAccountPlanning_model->getSimpananGiroAccountPlanning($AccountPlanningId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $Giro[$d->format('m')]['simpanan'] = $account_planning_simpananGiro[0][$d->format('m')];
                if ($account_planning_simpananGiro[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($account_planning_simpananGiro[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($account_planning_simpananGiro[0][$d->format('m')] - $account_planning_simpananGiro[0][$f->format('m')]) / $account_planning_simpananGiro[0][$f->format('m')]) * 100;

                $Giro[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $account_planning_simpananDeposito = $this->TasklistAccountPlanning_model->getSimpananDepositoAccountPlanning($AccountPlanningId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $Deposito[$d->format('m')]['simpanan'] = $account_planning_simpananDeposito[0][$d->format('m')];
                if ($account_planning_simpananDeposito[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($account_planning_simpananDeposito[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($account_planning_simpananDeposito[0][$d->format('m')] - $account_planning_simpananDeposito[0][$f->format('m')]) / $account_planning_simpananDeposito[0][$f->format('m')]) * 100;

                $Deposito[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $simpananYoYoD = $this->TasklistAccountPlanning_model->getSimpananAccountPlanningYoYoD($AccountPlanningId);

            if ($simpananYoYoD[0]['SaldoTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoTahunLalu']) / $simpananYoYoD[0]['SaldoTahunLalu']) * 100;

            if ($simpananYoYoD[0]['SaldoAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoAkhirTahunLalu']) / $simpananYoYoD[0]['SaldoAkhirTahunLalu']) * 100;

            if (!empty($simpananYoYoD)) {

                $this->response([
                    "Giro"          => $Giro,
                    "Deposito"      => $Deposito,
                    "SaldoSekarang" => $simpananYoYoD[0]['SaldoSekarang'],
                    "persenYoY"     => $persenYoY,
                    "persenYoD"     => $persenYoD,
                    "persenCASA"     => $simpananYoYoD[0]['CASA'],
                    "status"        => "Success",
                    "detail"        => "Success Fetch Simpanan Account Planning ",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "status"  => FALSE,
                    "message" => "No Simpanan Account Planning Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "status"  => FALSE,
                "message" => "AccountPlanningId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function pinjaman_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $data = array();

        if ($AccountPlanningId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $account_planning_pinjaman = $this->TasklistAccountPlanning_model->getPinjamanAccountPlanning($AccountPlanningId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $account_planning_pinjaman[0][$d->format('m')];
                if ($account_planning_pinjaman[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($account_planning_pinjaman[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($account_planning_pinjaman[0][$d->format('m')] - $account_planning_pinjaman[0][$f->format('m')]) / $account_planning_pinjaman[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $PinjamanYoYoD = $this->TasklistAccountPlanning_model->getPinjamanAccountPlanningYoYoD($AccountPlanningId);

            if ($PinjamanYoYoD[0]['bakidebetTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($PinjamanYoYoD[0]['bakidebetSekarang'] - $PinjamanYoYoD[0]['bakidebetTahunLalu']) / $PinjamanYoYoD[0]['bakidebetTahunLalu']) * 100;

            if ($PinjamanYoYoD[0]['bakidebetAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($PinjamanYoYoD[0]['bakidebetSekarang'] - $PinjamanYoYoD[0]['bakidebetAkhirTahunLalu']) / $PinjamanYoYoD[0]['bakidebetAkhirTahunLalu']) * 100;

            $KIKMK = $this->TasklistAccountPlanning_model->getPinjamanAccountPlanningKIKMK($AccountPlanningId);

            if (!empty($account_planning_pinjaman)) {
                $this->response([
                    "data"              => $data,
                    "bakidebetSekarang" => $PinjamanYoYoD[0]['bakidebetSekarang'],
                    "persenYoY"         => $persenYoY,
                    "persenYoD"         => $persenYoD,
                    "KIKMK"             => $KIKMK[0],
                    "status"            => "Success",
                    "detail"            => "Success Fetch Pinjaman Account Planning ",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status"  => FALSE,
                    "message" => "No Pinjaman Account Planning Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status"  => FALSE,
                "message" => "AccountPlanningId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function profitability_post()
    {
        $AccountPlanningId = $this->post('AccountPlanningId');
        $data = array();

        if ($AccountPlanningId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $account_planning_profitability = $this->TasklistAccountPlanning_model->getProfitabilityAccountPlanning($AccountPlanningId);

            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $account_planning_profitability[0][$d->format('m')];
                if ($account_planning_profitability[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($account_planning_profitability[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($account_planning_profitability[0][$d->format('m')] - $account_planning_profitability[0][$f->format('m')]) / $account_planning_profitability[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $ProfitabilityYoYoD = $this->TasklistAccountPlanning_model->getProfitabilityAccountPlanningYoYoD($AccountPlanningId);

            if ($ProfitabilityYoYoD[0]['CPATahunLalu'] == 0)
                $persenYoY = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoY = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPATahunLalu']) / $ProfitabilityYoYoD[0]['CPATahunLalu']) * 100;

            if ($ProfitabilityYoYoD[0]['CPAAkhirTahunLalu'] == 0)
                $persenYoD = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoD = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) / $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) * 100;

            if (!empty($account_planning_profitability)) {
                $this->response([
                    "data" => $data,
                    "CPASekarang" => $ProfitabilityYoYoD[0]['CPASekarang'],
                    "persenYoY"         => $persenYoY,
                    "persenYoD"         => $persenYoD,
                    "status" => "Success",
                    "detail" => "Success Fetch profitability Account Planning Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No profitability Account Planning Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "AccountPlanningId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
