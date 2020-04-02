<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Home extends REST_Controller
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
        $this->load->model('api/Home_model');

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->last_year = $today->format('Y') - 1;
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');

        $this->checkTokenMobile();
    }

    public function earned_post()
    {
        $rm_id  = $this->post('UserId');
        $data   = $this->DataTransaction_model->getLastDataCpaPerRM($rm_id);

        $this->response([
            "earned"    => $data,
            "rm_id"     => $rm_id,
            "status"    => "Success",
            "detail"    => "Success Fetch CPA.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }


    public function fundingCasa_post()
    {
        $personalnumber = $this->post('UserId');
        $total  = $this->Home_model->getFundingCasa($personalnumber);

        $this->response([
            "simpanan"  => $total,
            "status"    => "Success",
            "detail"    => "Success Fetch Funding Casa.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

    }

    public function giroMonthly_post()
    {
        $personalnumber = $this->post('UserId');
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->modify('first day of last month');
        $last_month2 = $d->format('m');

        $total         = $this->Home_model->getGiroMonthly($personalnumber);
        $giroLastMonth = $total[0][$last_month];
        $persen        = $total[0][$last_month2]  == 0 ? ".000" : (($total[0][$last_month] - $total[0][$last_month2]) / $total[0][$last_month2]) * 100;

        $this->response([
            "giro"      => $total,
            "lastMonth" => $giroLastMonth,
            "persen"    => $persen,
            "status"    => "Success",
            "detail"    => "Success Fetch Simpanan Giro monthly.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    
    public function depositoMonthly_post()
    {
        $personalnumber = $this->post('UserId');
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->modify('first day of last month');
        $last_month2 = $d->format('m');

        $total         = $this->Home_model->getDepositoMonthly($personalnumber);
        $giroLastMonth = $total[0][$last_month];
        $persen        = $total[0][$last_month2]  == 0 ? ".000" : (($total[0][$last_month] - $total[0][$last_month2]) / $total[0][$last_month2]) * 100;

        $this->response([
            "deposito"  => $total,
            "lastMonth" => $giroLastMonth,
            "persen"    => $persen,
            "status"    => "Success",
            "detail"    => "Success Fetch Simpanan Deposito monthly.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    
    public function simpananMonthly_post()
    {
        $personalnumber = $this->post('UserId');
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->modify('first day of last month');
        $last_month2 = $d->format('m');

        $total         = $this->Home_model->getSimpananMonthly($personalnumber);
        $giroLastMonth = $total[0][$last_month];
        $persen        = $total[0][$last_month2]  == 0 ? ".000" : (($total[0][$last_month] - $total[0][$last_month2]) / $total[0][$last_month2]) * 100;

        $this->response([
            "deposito"  => $total,
            "lastMonth" => $giroLastMonth,
            "persen"    => $persen,
            "status"    => "Success",
            "detail"    => "Success Fetch Simpanan monthly.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    
    public function loanCurrentYear_post()
    {
        $personalnumber     = $this->post('UserId');
        $LoanCurrentYear    = $this->Home_model->getLoanCurrentYear($personalnumber);

        $this->response([
            "TotalPinjaman" => $LoanCurrentYear['TotalPinjaman'],
            "current_year"  => $this->current_year,
            "status"        => "Success",
            "detail"        => "Success Fetch Loan.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function loanMonthly_post()
    {
        $periode       = array();
        $personalnumber         = $this->post('UserId');
        $LoanMonthly            = $this->Home_model->getLoanMonthly($personalnumber);
        $LastDateLoan           = $this->Home_model->getLastDateLoan($personalnumber);
        $LastDateLoan           = $LastDateLoan['Periode'];
        $LastDateLoan           = new DateTime(date($LastDateLoan));
        $periode['currentYear'] = $LastDateLoan->format('Y');
        $periode['currentMonth'] = $LastDateLoan->format('m');

        $LastDateLoan->modify('first day of last month');
        $periode['lastYear']    = $LastDateLoan->format('Y');
        $periode['lastMonth']   = $LastDateLoan->format('m');


        $LoanCurrentYear    = $this->Home_model->getLoanCurrentYear($personalnumber);
        $CurrentlastMonth   = $this->Home_model->getLoanCurrentlastMonth($personalnumber, $periode);
        $persenPinjaman     = $CurrentlastMonth[0]['previous']  == 0 ? 0 : ($CurrentlastMonth[0]['current'] / $CurrentlastMonth[0]['previous']) * 100;

        $this->response([
            "LoanMonthly"       => $LoanMonthly,
            "TotalPinjaman"     => $LoanCurrentYear['TotalPinjaman'],
            "persenPinjaman"    => number_format($persenPinjaman, 1),
            // "current_year"      => $periode,
            "status"            => "Success",
            "detail"            => "Success Fetch Loan.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function modalKerjaMonthly_post()
    {
        $periode       = array();
        $personalnumber             = $this->post('UserId');
        $modalKerjaMonthly          = $this->Home_model->getmodalKerjaMonthly($personalnumber);
        $LastDatemodalKerja         = $this->Home_model->getLastDatemodalKerja($personalnumber);
        $LastDatemodalKerja         = $LastDatemodalKerja['Periode'];
        $LastDatemodalKerja         = new DateTime(date($LastDatemodalKerja));
        $periode['currentYear']     = $LastDatemodalKerja->format('Y');
        $periode['currentMonth']    = $LastDatemodalKerja->format('m');

        $LastDatemodalKerja->modify('first day of last month');
        $periode['lastYear']    = $LastDatemodalKerja->format('Y');
        $periode['lastMonth']   = $LastDatemodalKerja->format('m');


        $modalKerjaCurrentYear  = $this->Home_model->getmodalKerjaCurrentYear($personalnumber);
        $CurrentlastMonth       = $this->Home_model->getmodalKerjaCurrentlastMonth($personalnumber, $periode);
        $persenPinjaman         = $CurrentlastMonth[0]['previous']  == 0 ? 0 : ($CurrentlastMonth[0]['current'] / $CurrentlastMonth[0]['previous']) * 100;

        $this->response([
            "modalKerjaMonthly" => $modalKerjaMonthly,
            "Total"             => $modalKerjaCurrentYear['TotalPinjaman'],
            "persen"            => number_format($persenPinjaman, 1),
            // "current_year"      => $periode,
            "status"            => "Success",
            "detail"            => "Success Fetch modal Kerja.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function investasiMonthly_post()
    {
        $periode       = array();
        $personalnumber            = $this->post('UserId');
        $investasiMonthly          = $this->Home_model->getinvestasiMonthly($personalnumber);
        $LastDateinvestasi         = $this->Home_model->getLastDateinvestasi($personalnumber);
        $LastDateinvestasi         = $LastDateinvestasi['Periode'];
        $LastDateinvestasi         = new DateTime(date($LastDateinvestasi));
        $periode['currentYear']    = $LastDateinvestasi->format('Y');
        $periode['currentMonth']   = $LastDateinvestasi->format('m');

        $LastDateinvestasi->modify('first day of last month');
        $periode['lastYear']    = $LastDateinvestasi->format('Y');
        $periode['lastMonth']   = $LastDateinvestasi->format('m');


        $investasiCurrentYear   = $this->Home_model->getinvestasiCurrentYear($personalnumber);
        $CurrentlastMonth       = $this->Home_model->getinvestasiCurrentlastMonth($personalnumber, $periode);
        $persenPinjaman         = $CurrentlastMonth[0]['previous']  == 0 ? 0 : ($CurrentlastMonth[0]['current'] / $CurrentlastMonth[0]['previous']) * 100;

        $this->response([
            "investasiMonthly"  => $investasiMonthly,
            "Total"             => $investasiCurrentYear['TotalPinjaman'],
            "persen"            => number_format($persenPinjaman, 1),
            // "current_year"      => $periode,
            "status"            => "Success",
            "detail"            => "Success Fetch modal Kerja.",
        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
}
