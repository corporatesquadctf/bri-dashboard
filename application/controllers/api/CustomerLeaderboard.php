<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CustomerLeaderboard extends REST_Controller
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
        $this->load->model('DataTransaction_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function index_post()
    {
        $params = array();
        $data = array(
            'group_list' => array()
        );
        $limit_per_page = 15;
        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno = (($current_page - 1) * $limit_per_page);
        $keyword_search = $this->post('searchTxt') ? $this->post('searchTxt') : '';

        $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList($keyword_search);
        $total_page = ceil($total_records / $limit_per_page);

        if ($total_records > 0) {
            $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno, $keyword_search);

            foreach ($group_list as $group_row) {
                $CustomerGroupId = $group_row['CustomerGroupId'];

                $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
                $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
                $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
                $RoRaGroup['RoRa'] = 0;
                $RarocGroup['Raroc'] = 0;
                
                if (!key_exists($CustomerGroupId, $data['group_list'])) {
                    $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
                    if (!empty($group_customer_list)) {
                        foreach ($group_customer_list as $customer_list => $customer_row) {
                            $RarocVCIF['Raroc'][$customer_row['VCIF']] = $this->DataTransaction_model->getRarocPerVCIF($customer_row['VCIF']);
                        }
                        $RarocGroup['Raroc'] = array_sum($RarocVCIF['Raroc']);
                    }

                    $params[] = array(
                        'CustomerGroupName'   => $group_row['CustomerGroupName'],
                        'CustomerGroupId'     => $CustomerGroupId,
                        'PinjamanTotalGroup'  => number_format($pinjamanGroup['TotalPinjaman'] / VALUE_PER, 0),
                        'PinjamanRatasGroup'  => number_format($pinjamanGroup['RatasPinjaman'] / VALUE_PER, 0),
                        'SimpananTotalGroup'  => number_format($simpananGroup['TotalSimpanan'] / VALUE_PER, 0),
                        'SimpananRatasGroup'  => number_format($simpananGroup['RatasSimpanan'] / VALUE_PER, 0),
                        'RoRaGroup'           => number_format($RoRaGroup['RoRa'] / VALUE_PER, 0),
                        'RarocGroup'          => number_format($RarocGroup['Raroc'] / VALUE_PER, 0),
                        'CurrentCPAGroup'     => number_format($cpaGroup['Cpa'] / VALUE_PER, 0),
                        'Logo'                => $group_row['Logo'],
                        'ClassificationId'    => $group_row['ClassificationId'],
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
                    "detail" => "Success Fetch Customer Leaderboard List",
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'data' => [],
                    'status' => FALSE,
                    'message' => 'No Customer Leaderboard were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'No Customer Leaderboard were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function groupCustomerList_post()
    {
        $CustomerGroupId = $this->post('CustomerGroupId');

        $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $GroupCustomerList = array();
        if (!empty($group_customer_list)) {
            foreach ($group_customer_list as $customer_list => $customer_row) {
                $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
                $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
                $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);
                $RoRaVCIF['RoRa']     = 0;
                $RarocVCIF['Raroc'] = 0;

                $GroupCustomerList[$customer_list] = array(
                    'CustomerName'                   => $customer_row['CustomerName'],
                    'VCIF'                           => $customer_row['VCIF'],
                    'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman'] / VALUE_PER, 0),
                    'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman'] / VALUE_PER, 0),
                    'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan'] / VALUE_PER, 0),
                    'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan'] / VALUE_PER, 0),
                    'RoRaVCIF'                        => number_format($RoRaVCIF['RoRa'] / VALUE_PER, 0),
                    'RarocVCIF'                      => number_format($RarocVCIF['Raroc'] / VALUE_PER, 0),
                    'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa'] / VALUE_PER, 0)
                );
            }
        }
        if ($GroupCustomerList) {
            $this->response([
                'data' => $GroupCustomerList,
                'status' => "Success",
                "detail" => "Success Fetch Customer Leaderboard List",
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'No Customer Leaderboard were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function SimpananVcifMonthly_post()
    {
        $VCIF = $this->post('vcif');

        if (!empty($VCIF)) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $group_customer_list = $this->TasklistAccountPlanning_model->getSimpananVcifMonthly($VCIF);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $group_customer_list[0][$d->format('m')];
                if ($group_customer_list[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($group_customer_list[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($group_customer_list[0][$d->format('m')] - $group_customer_list[0][$f->format('m')]) / $group_customer_list[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $simpananYoYoD = $this->TasklistAccountPlanning_model->getSimpananVcifYoYoD($VCIF);

            if ($simpananYoYoD[0]['SaldoTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoTahunLalu']) / $simpananYoYoD[0]['SaldoTahunLalu']) * 100;

            if ($simpananYoYoD[0]['SaldoAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoAkhirTahunLalu']) / $simpananYoYoD[0]['SaldoAkhirTahunLalu']) * 100;

            if ($group_customer_list) {
                $this->response([
                    'data' => $data,
                    "saldoSekarang" => $simpananYoYoD[0]['SaldoSekarang'],
                    "persenYoY" => $persenYoY,
                    "persenYoD" => $persenYoD,
                    'status' => "Success",
                    "detail" => "Success Fetch Customer Leaderboard List",
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'data' => [],
                    'status' => FALSE,
                    'message' => 'No Customer Leaderboard were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            // Set the response and exit
            $this->response([
                'data' => [],
                'status' => FALSE,
                'message' => 'vcif cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function pinjamanVcifMonthly_post()
    {
        $VCIF = $this->post('vcif');

        if ($VCIF) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $getPinjamanVcifMonthly = $this->TasklistAccountPlanning_model->getPinjamanVcifMonthly($VCIF);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $getPinjamanVcifMonthly[0][$d->format('m')];
                if ($getPinjamanVcifMonthly[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($getPinjamanVcifMonthly[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($getPinjamanVcifMonthly[0][$d->format('m')] - $getPinjamanVcifMonthly[0][$f->format('m')]) / $getPinjamanVcifMonthly[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $PinjamanYoYoD = $this->TasklistAccountPlanning_model->getPinjamanVcifYoYoD($VCIF);

            if ($PinjamanYoYoD[0]['PinjamanTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($PinjamanYoYoD[0]['PinjamanSekarang'] - $PinjamanYoYoD[0]['PinjamanTahunLalu']) / $PinjamanYoYoD[0]['PinjamanTahunLalu']) * 100;

            if ($PinjamanYoYoD[0]['PinjamanAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($PinjamanYoYoD[0]['PinjamanSekarang'] - $PinjamanYoYoD[0]['PinjamanAkhirTahunLalu']) / $PinjamanYoYoD[0]['PinjamanAkhirTahunLalu']) * 100;


            $KIKMK = $this->TasklistAccountPlanning_model->getPinjamanVcifKIKMK($VCIF);
            if (!empty($getPinjamanVcifMonthly)) {

                $this->response([
                    "data" => $data,
                    "PinjamanSekarang" => $PinjamanYoYoD[0]['PinjamanSekarang'],
                    "persenYoY" => $persenYoY,
                    "persenYoD" => $persenYoD,
                    "KIKMK" => $KIKMK[0],
                    "status" => "Success",
                    "detail" => "Success Fetch Pinjaman Vcif Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'data' => [],
                    "status" => FALSE,
                    "message" => "No Pinjaman Vcif Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'data' => [],
                "status" => FALSE,
                "message" => "vcif cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function profitabilityVcifMonthly_post()
    {
        $VCIF = $this->post('vcif');

        if ($VCIF) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $getProfitabilityVcifMonthly = $this->TasklistAccountPlanning_model->getProfitabilityVcifMonthly($VCIF);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $getProfitabilityVcifMonthly[0][$d->format('m')];
                if ($getProfitabilityVcifMonthly[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($getProfitabilityVcifMonthly[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($getProfitabilityVcifMonthly[0][$d->format('m')] - $getProfitabilityVcifMonthly[0][$f->format('m')]) / $getProfitabilityVcifMonthly[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $ProfitabilityYoYoD = $this->TasklistAccountPlanning_model->getProfitabilityVcifYoYoD($VCIF);

            if ($ProfitabilityYoYoD[0]['CPATahunLalu'] == 0)
                $persenYoY = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoY = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPATahunLalu']) / $ProfitabilityYoYoD[0]['CPATahunLalu']) * 100;

            if ($ProfitabilityYoYoD[0]['CPAAkhirTahunLalu'] == 0)
                $persenYoD = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoD = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) / $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) * 100;


            if (!empty($getProfitabilityVcifMonthly)) {

                $this->response([
                    "data" => $data,
                    "CPASekarang" => $ProfitabilityYoYoD[0]['CPASekarang'],
                    "persenYoY"         => $persenYoY,
                    "persenYoD"         => $persenYoD,
                    "status" => "Success",
                    "detail" => "Success Fetch Profitability Vcif Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Profitability Vcif Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "vcif cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function simpananGroupMonthly_post()
    {
        $GroupId = $this->post('GroupId');

        if ($GroupId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $getSimpananGroupMonthly = $this->TasklistAccountPlanning_model->getSimpananGroupMonthly($GroupId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $getSimpananGroupMonthly[0][$d->format('m')];
                if ($getSimpananGroupMonthly[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($getSimpananGroupMonthly[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($getSimpananGroupMonthly[0][$d->format('m')] - $getSimpananGroupMonthly[0][$f->format('m')]) / $getSimpananGroupMonthly[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }


            $simpananYoYoD = $this->TasklistAccountPlanning_model->getSimpananGroupYoYoD($GroupId);

            if ($simpananYoYoD[0]['SaldoTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoTahunLalu']) / $simpananYoYoD[0]['SaldoTahunLalu']) * 100;

            if ($simpananYoYoD[0]['SaldoAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoAkhirTahunLalu']) / $simpananYoYoD[0]['SaldoAkhirTahunLalu']) * 100;

            if (!empty($getSimpananGroupMonthly)) {

                $this->response([
                    "data" => $data,
                    "saldoSekarang" => $simpananYoYoD[0]['SaldoSekarang'],
                    "persenYoY" => $persenYoY,
                    "persenYoD" => $persenYoD,
                    "status" => "Success",
                    "detail" => "Success Fetch Simpanan Group Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Simpanan Group Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "GroupId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function pinjamanGroupMonthly_post()
    {
        $GroupId = $this->post('GroupId');

        if ($GroupId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $getPinjamanGroupMonthly = $this->TasklistAccountPlanning_model->getPinjamanGroupMonthly($GroupId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $getPinjamanGroupMonthly[0][$d->format('m')];
                if ($getPinjamanGroupMonthly[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($getPinjamanGroupMonthly[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($getPinjamanGroupMonthly[0][$d->format('m')] - $getPinjamanGroupMonthly[0][$f->format('m')]) / $getPinjamanGroupMonthly[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $PinjamanYoYoD = $this->TasklistAccountPlanning_model->getPinjamanGroupYoYoD($GroupId);

            if ($PinjamanYoYoD[0]['PinjamanTahunLalu'] == 0)
                $persenYoY = '100';
            else
                $persenYoY = (($PinjamanYoYoD[0]['PinjamanSekarang'] - $PinjamanYoYoD[0]['PinjamanTahunLalu']) / $PinjamanYoYoD[0]['PinjamanTahunLalu']) * 100;

            if ($PinjamanYoYoD[0]['PinjamanAkhirTahunLalu'] == 0)
                $persenYoD = '100';
            else
                $persenYoD = (($PinjamanYoYoD[0]['PinjamanSekarang'] - $PinjamanYoYoD[0]['PinjamanAkhirTahunLalu']) / $PinjamanYoYoD[0]['PinjamanAkhirTahunLalu']) * 100;


            $KIKMK = $this->TasklistAccountPlanning_model->getPinjamanGroupKIKMK($GroupId);
            if (!empty($getPinjamanGroupMonthly)) {

                $this->response([
                    "data" => $data,
                    "PinjamanSekarang" => $PinjamanYoYoD[0]['PinjamanSekarang'],
                    "persenYoY" => $persenYoY,
                    "persenYoD" => $persenYoD,
                    "KIKMK" => $KIKMK[0],
                    "status" => "Success",
                    "detail" => "Success Fetch Pinjaman Group Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Pinjaman Group Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "GroupId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function profitabilityGroupMonthly_post()
    {
        $GroupId = $this->post('GroupId');

        if ($GroupId) {
            $d = new DateTime(date('Y-m-d H:i:s'));
            $d->modify('first day of last month');
            $last_month = $d->format('m');
            $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
            $f->modify('first day of last month');

            $getProfitabilityGroupMonthly = $this->TasklistAccountPlanning_model->getProfitabilityGroupMonthly($GroupId);
            for ($i = $last_month; $i > $last_month - 6; $i--) {
                $f->modify('first day of last month');
                $data[$d->format('m')]['pinjaman'] = $getProfitabilityGroupMonthly[0][$d->format('m')];
                if ($getProfitabilityGroupMonthly[0][$f->format('m')] == 0)
                    $persen = '100';
                elseif ($getProfitabilityGroupMonthly[0][$d->format('m')] == 0)
                    $persen = '-100';
                else
                    $persen = (($getProfitabilityGroupMonthly[0][$d->format('m')] - $getProfitabilityGroupMonthly[0][$f->format('m')]) / $getProfitabilityGroupMonthly[0][$f->format('m')]) * 100;

                $data[$d->format('m')]['persen'] = $persen;
                $d->modify('first day of last month');
            }

            $ProfitabilityYoYoD = $this->TasklistAccountPlanning_model->getProfitabilityGroupYoYoD($GroupId);

            if ($ProfitabilityYoYoD[0]['CPATahunLalu'] == 0)
                $persenYoY = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoY = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPATahunLalu']) / $ProfitabilityYoYoD[0]['CPATahunLalu']) * 100;

            if ($ProfitabilityYoYoD[0]['CPAAkhirTahunLalu'] == 0)
                $persenYoD = $ProfitabilityYoYoD[0]['CPASekarang'] < 0 ? '-100' : '100';
            else
                $persenYoD = (($ProfitabilityYoYoD[0]['CPASekarang'] - $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) / $ProfitabilityYoYoD[0]['CPAAkhirTahunLalu']) * 100;


            if (!empty($getProfitabilityGroupMonthly)) {

                $this->response([
                    "data" => $data,
                    "CPASekarang" => $ProfitabilityYoYoD[0]['CPASekarang'],
                    "persenYoY"         => $persenYoY,
                    "persenYoD"         => $persenYoD,
                    "status" => "Success",
                    "detail" => "Success Fetch Profitability Group Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Profitability Group Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "GroupId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function rarocVcifMonthly_post()
    {
        $VCIF = $this->post('vcif');

        if ($VCIF) {

            $getRarocVcifMonthly = $this->TasklistAccountPlanning_model->getRarocVcifMonthly($VCIF);

            if (!empty($getRarocVcifMonthly)) {

                $this->response([
                    "data" => $getRarocVcifMonthly,
                    "status" => "Success",
                    "detail" => "Success Fetch RAROC Vcif Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No RAROC Vcif Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "vcif cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function rarocGroupMonthly_post()
    {
        $GroupId = $this->post('GroupId');

        if ($GroupId) {

            $getRarocGroupMonthly = $this->TasklistAccountPlanning_model->getRarocGroupMonthly($GroupId);

            if (!empty($getRarocGroupMonthly)) {

                $this->response([
                    "data" => $getRarocGroupMonthly,
                    "status" => "Success",
                    "detail" => "Success Fetch Raroc Group Monthly Detail",
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "data" => [],
                    "status" => FALSE,
                    "message" => "No Raroc Group Monthly Detail were found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                "data" => [],
                "status" => FALSE,
                "message" => "GroupId cannot be empty"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
