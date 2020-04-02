<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class PortofolioRm extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->checkTokenMobile();

        $this->load->helper(array(
            "form",
            "url",
            "security"
        ));
        $this->limit_per_page = 15;

        $this->load->model("PortofolioRm_model");
        $this->load->model("api/PortofolioRmApi_model");
        $this->load->model("api/Pipeline_model");
    }

    public function list_post()
    {
        $data = array();
        $user['USER_ID']  = $this->post('UserId');

        if ($this->post("keyword")) {
            $data["keyword"] = $this->post("keyword");
        } else {
            $data["keyword"] = NULL;
        }

        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno        = (($current_page - 1) * $this->limit_per_page);

        $currentYear = date("Y");
        // $currentYear = 2018;
        $lastYear = $currentYear - 1;
        $arrPeriode = array();
        $arrPeriode[] = $lastYear . "-12";
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) $m = "0" . $i;
            else $m = $i;
            $arrPeriode[] = $currentYear . "-" . $m;
        }

        $lastPosition = strtotime("first day of previous month");
        // $month = date("m", $lastPosition);
        // $year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        $totalRecords = $this->PortofolioRm_model->getTotalCustomer($user['USER_ID'], $month, $year, $data["keyword"]);
        $total_page   = ceil($totalRecords / $this->limit_per_page);
        if ($current_page > $total_page) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'No Proses Kredit'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        if ($totalRecords > 0) {
            $rsCustomer = $this->PortofolioRm_model->getAllCustomer($user['USER_ID'], $this->limit_per_page, $rowno, $month, $year, $data["keyword"]);
            foreach ($rsCustomer as $row) {
                $cif = $row->Cif;

                /* Get Data Kredit */
                $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($user['USER_ID'], $cif, $month, $year);
                $totalPlafondKredit = 0;
                foreach ($rsRekeningKredit as $rowRekeningKredit) {
                    $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
                }
                $row->TotalPlafondKredit = $totalPlafondKredit;
            }
            $data["Customer"] = $rsCustomer;
            $data["TotalPortofolio"] = $totalRecords;
            $data["current_page"] = $current_page;
            $data["TotalPage"] = $total_page;
        }

        $this->response([
            'data'      => $data,
            'status'    => "Success",
            'message'   => 'Success fecht list Portofolio RM'
        ], REST_Controller::HTTP_OK);
    }

    public function AverageOutstandingKredit_post()
    {
        $data = array();
        $limitPage = 1;
        $user['USER_ID']  = $this->post('UserId');
        $cif  = $this->post('cif');
        if ($this->post()) {
            $keyword = $this->post("keyword");
        } else {
            $keyword = NULL;
        }
        $data["keyword"] = $keyword;

        $current_page = $this->post('page') ? $this->post('page') : 1;
        $rowno        = (($current_page - 1) * $this->limit_per_page);

        $arrColors = array(
            "#EBD618",
            "#46CEB6",
            "#9522F0",
            "#1998DF",
            "#F86D43",
            "#FF62EF",
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
        );

        //$currentYear = date("Y");
        $currentYear = 2018;
        $lastYear = $currentYear - 1;
        $arrPeriode = array();
        $arrPeriode[] = $lastYear . "-12";
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) $m = "0" . $i;
            else $m = $i;
            $arrPeriode[] = $currentYear . "-" . $m;
        }

        //$lastPosition = strtotime("first day of previous month");
        //$month = date("m", $lastPosition);
        //$year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        $totalRecords = $this->PortofolioRm_model->getTotalCustomer($user['USER_ID'], $month, $year, $keyword);

        if ($totalRecords > 0) {
            $rsCustomer = $this->PortofolioRm_model->getAllCustomer($user['USER_ID'], $limitPage, $rowno, $month, $year, $keyword);
            $arrNoRekeningKredit = array();

            /* Get Data Kredit */
            $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($user['USER_ID'], $cif, $month, $year);
            $totalPlafondKredit = 0;
            $indexRekeningKredit = 0;
            $tglRealisasiMinimum = strtotime(date("Y-m-d"));
            foreach ($rsRekeningKredit as $rowRekeningKredit) {
                $noRekening = $rowRekeningKredit->NoRekening;
                $arrNoRekeningKredit[] = $noRekening;
                $arrOutstandingKredit = array();
                foreach ($arrPeriode as $rowPeriode) :
                    $rsOutstandingKredit = $this->PortofolioRm_model->getOutstandingKredit($user['USER_ID'], $cif, $noRekening, $rowPeriode);
                    if (!empty($rsOutstandingKredit)) {
                        $arrOutstandingKredit[] = $rsOutstandingKredit[0]->PlafonEfektif;
                    } else {
                        $arrOutstandingKredit[] = 0;
                    }
                endforeach;

                $tglRealisasi = strtotime($rowRekeningKredit->TglRealisasi);
                if ($tglRealisasi < $tglRealisasiMinimum) $tglRealisasiMinimum = $tglRealisasi;

                switch ($rowRekeningKredit->JenisPenggunaan) {
                    case 1:
                        $rowRekeningKredit->JenisPenggunaan = "KI";
                        break;
                    case 2:
                        $rowRekeningKredit->JenisPenggunaan = "KMK";
                        break;
                    default:
                        $rowRekeningKredit->JenisPenggunaan = "";
                        break;
                }
                $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
                $rowRekeningKredit->DatasetKredit = $arrOutstandingKredit;
                $rowRekeningKredit->Warna = $arrColors[$indexRekeningKredit];
                $indexRekeningKredit++;
            }

            /* Get Data Simpanan */
            $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);
            $indexRekeningSimpanan = 0;
            foreach ($rsRekeningSimpanan as $rowRekeningSimpanan) {
                $noRekening = $rowRekeningSimpanan->NoRekening;
                $arrInstandingSimpanan = array();
                foreach ($arrPeriode as $rowPeriode) :
                    $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                    if (!empty($rsInstandingSimpanan)) {
                        $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                    } else {
                        $arrInstandingSimpanan[] = 0;
                    }
                endforeach;
                $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
                $rowRekeningSimpanan->Warna = $arrColors[$indexRekeningSimpanan];
                $indexRekeningSimpanan++;
            }

            /* Get Total and Average Outstanding Kredit */
            $arrTotalOutstandingKredit = (object) array();
            $arrAverageOutstandingKredit = (object) array();
            $month = new DateTime(date('Y-m-d H:i:s'));

            for ($i = 0; $i < count($arrPeriode); $i++) {
                $month->modify('first day of last month');
                $last_month = $month->format('m');
                $totalOutstandingKredit = 0;
                foreach ($rsRekeningKredit as $rowRekeningKredit) {
                    $plafonEfektif = $rowRekeningKredit->DatasetKredit[$i];
                    $totalOutstandingKredit += $plafonEfektif;
                }
                $arrTotalOutstandingKredit->$last_month = $totalOutstandingKredit;
                $arrAverageOutstandingKredit->$last_month = number_format(($totalOutstandingKredit / $totalPlafondKredit) * 100, 2);
            }

            $data['TotalOutstandingKredit'] = $arrTotalOutstandingKredit;
            $data['AverageOutstandingKredit'] = $arrAverageOutstandingKredit;
        }
        $this->response([
            'data'      => $data,
            'status'    => "Success",
            'message'   => 'Success fecht list Rekening Pinjaman'
        ], REST_Controller::HTTP_OK);
    }

    public function listRekeningPinjaman_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $cif = $this->post('cif');
        $rowRekening = [];

        // $lastPosition = strtotime("first day of previous month");
        // $month = date("m", $lastPosition);
        // $year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        $rsRekeningKredit = $this->PortofolioRmApi_model->getAllRekeningKredit($user['USER_ID'], $cif, $month, $year);

        if ($rsRekeningKredit) {
            foreach ($rsRekeningKredit as $row) {
                array_push($rowRekening, [
                    "NoRekening" => $row->NoRekening,
                    "JenisPenggunaan" => $row->JenisPenggunaan,
                    "WarnaEWS" => $row->WarnaEWS
                ]);
            }
            // print_r($rsRekeningKredit);
            $data['rsRekeningKredit'] = $rowRekening;
            $this->response([
                'data'      => $data,
                'status'    => "Success",
                'message'   => 'Success fecht list Rekening Pinjaman'
            ], REST_Controller::HTTP_OK);
        }
        $this->response([
            'data'      => [],
            'status'    => FALSE,
            'message'   => 'List Rekening Pinjaman Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
    }

    public function listRekeningSimpanan_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $cif = $this->post('cif');

        // $lastPosition = strtotime("first day of previous month");
        // $month = date("m", $lastPosition);
        // $year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);

        if ($rsRekeningSimpanan) {
            $this->response([
                'data'      => $rsRekeningSimpanan,
                'status'    => "Success",
                'message'   => 'Success fecht list Rekening Simpanan'
            ], REST_Controller::HTTP_OK);
        }
        $this->response([
            'data'      => [],
            'status'    => FALSE,
            'message'   => 'List Rekening Simpanan Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
    }

    public function rekeningKreditDetail_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $cif              = $this->post('cif');
        $noRekening       = $this->post('noRekening');

        if (empty($user['USER_ID']) || empty($cif) || empty($noRekening)) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'UserId, cif, noRekening cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        // $lastPosition = strtotime("first day of previous month");
        // $month = date("m", $lastPosition);
        // $year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        $RekeningKredit = $this->PortofolioRmApi_model->getRekeningKreditDetail($user['USER_ID'], $cif, $month, $year, $noRekening);
        $data['RekeningKredit'] = $RekeningKredit;
        $this->response([
            'data'      => $data,
            'status'    => "Success",
            'message'   => 'Success fecht Detail Rekening Pinjaman'
        ], REST_Controller::HTTP_OK);
    }

    public function outstandingKreditRekening_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $cif              = $this->post('cif');
        $noRekeningKredit = $this->post('noRekening');

        if (empty($user['USER_ID']) || empty($cif) || empty($noRekeningKredit)) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'UserId, cif, noRekening cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        $data = (object) array();
        // $lastPosition = strtotime("first day of previous month");
        // $month = date("m", $lastPosition);
        // $year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;


        //$currentYear = date("Y");
        $currentYear = 2018;
        $lastYear = $currentYear - 1;
        $arrPeriode = array();
        $arrPeriode[] = $lastYear . "-12";
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) $m = "0" . $i;
            else $m = $i;
            $arrPeriode[] = $currentYear . "-" . $m;
        }
        $arrPeriodeLabel = array();
        foreach ($arrPeriode as $row) {
            array_push($arrPeriodeLabel, date("F Y", strtotime($row)));
        }
        $data->Labels = $arrPeriodeLabel;
        $arrNoRekeningKredit = array();

        /* Get Data Kredit */
        $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($user['USER_ID'], $cif, $month, $year);
        $totalPlafondKredit = 0;
        $indexRekeningKredit = 0;
        $tglRealisasiMinimum = strtotime(date("Y-m-d"));
        foreach ($rsRekeningKredit as $rowRekeningKredit) {
            $noRekening = $rowRekeningKredit->NoRekening;
            $arrNoRekeningKredit[] = $noRekening;
            $arrOutstandingKredit = array();
            foreach ($arrPeriode as $rowPeriode) :
                $rsOutstandingKredit = $this->PortofolioRm_model->getOutstandingKredit($user['USER_ID'], $cif, $noRekening, $rowPeriode);
                if (!empty($rsOutstandingKredit)) {
                    $arrOutstandingKredit[] = $rsOutstandingKredit[0]->PlafonEfektif;
                } else {
                    $arrOutstandingKredit[] = 0;
                }
            endforeach;

            $tglRealisasi = strtotime($rowRekeningKredit->TglRealisasi);
            if ($tglRealisasi < $tglRealisasiMinimum) $tglRealisasiMinimum = $tglRealisasi;

            switch ($rowRekeningKredit->JenisPenggunaan) {
                case 1:
                    $rowRekeningKredit->JenisPenggunaan = "KI";
                    break;
                case 2:
                    $rowRekeningKredit->JenisPenggunaan = "KMK";
                    break;
                default:
                    $rowRekeningKredit->JenisPenggunaan = "";
                    break;
            }
            $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
            $rowRekeningKredit->DatasetKredit = $arrOutstandingKredit;
            $indexRekeningKredit++;
            if ($rowRekeningKredit->NoRekening == $noRekeningKredit) {
                $RekeningKredit = $rowRekeningKredit;
            }
        }

        /* Get Data Simpanan */
        $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);
        $indexRekeningSimpanan = 0;
        foreach ($rsRekeningSimpanan as $rowRekeningSimpanan) {
            $noRekening = $rowRekeningSimpanan->NoRekening;
            $arrInstandingSimpanan = array();
            foreach ($arrPeriode as $rowPeriode) :
                $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                if (!empty($rsInstandingSimpanan)) {
                    $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                } else {
                    $arrInstandingSimpanan[] = 0;
                }
            endforeach;
            $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
            $indexRekeningSimpanan++;
        }

        /* Get Total and Average Outstanding Kredit */
        $arrTotalOutstandingKredit = array();
        $arrAverageOutstandingKredit = array();
        for ($i = 0; $i < count($arrPeriode); $i++) {
            $totalOutstandingKredit = 0;
            foreach ($rsRekeningKredit as $rowRekeningKredit) {
                $plafonEfektif = $rowRekeningKredit->DatasetKredit[$i];
                $totalOutstandingKredit += $plafonEfektif;
            }
            $arrTotalOutstandingKredit[] = $totalOutstandingKredit;
            $arrAverageOutstandingKredit[] = number_format(($totalOutstandingKredit / $totalPlafondKredit) * 100, 2);
        }

        /* Calculate Delta Outstanding Kredit */
        $arrTotalDeltaOutstanding = array();
        $totalDelta = 0;
        for ($i = 0; $i < count($arrTotalOutstandingKredit); $i++) {
            if ($i == 0) {
                $selisih = 0;
                $arrTotalDeltaOutstanding[] = 0;
            } else {
                $selisih = $arrTotalOutstandingKredit[$i] - $arrTotalOutstandingKredit[$i - 1];
                $arrTotalDeltaOutstanding[] = $selisih;
            }
            $totalDelta += $selisih;
        }

        $tahunRealisasi = date("Y", $tglRealisasiMinimum);
        $bulanRealisasi = date("m", $tglRealisasiMinimum);
        if ($tahunRealisasi < $year) {
            if ($month == 12) $month = 0;
            $totalBulan = $month + 1;
        } else {
            if ($month == 12) $month = 0;
            $totalBulan = $month - $bulanRealisasi + 1;
        }

        $data->AverageDelta = number_format($totalDelta / $totalBulan, 2);
        $data->RekeningKredit = $RekeningKredit;
        $data->DetailDeltaKredit = $arrTotalDeltaOutstanding;

        $this->response([
            'data'      => $data,
            'status'    => 'Success',
            'message'   => 'Success fecht Outstanding Kredit Rekening ' . $noRekeningKredit
        ], REST_Controller::HTTP_OK);
    }

    public function RekeningSimpananDetail_post()
    {

        $user['USER_ID']    = $this->post('UserId');
        $cif                = $this->post('cif');
        $noRekeningSimpanan = $this->post('noRekening');

        if (empty($user['USER_ID']) || empty($cif) || empty($noRekeningSimpanan)) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'UserId, cif, noRekening cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        //$currentYear = date("Y");
        $currentYear = 2018;
        $lastYear = $currentYear - 1;
        $arrPeriode = array();
        $arrPeriode[] = $lastYear . "-12";
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) $m = "0" . $i;
            else $m = $i;
            $arrPeriode[] = $currentYear . "-" . $m;
        }
        $arrPeriodeLabel = array();
        foreach ($arrPeriode as $row) {
            array_push($arrPeriodeLabel, date("F Y", strtotime($row)));
        }
        $data["Labels"] = $arrPeriodeLabel;

        //$lastPosition = strtotime("first day of previous month");
        //$month = date("m", $lastPosition);
        //$year  = date("Y", $lastPosition);
        $month = 7;
        $year  = 2018;

        /* Get Data Simpanan */
        $rsRekeningSimpanan = $this->PortofolioRmApi_model->getRekeningSimpananDetail($cif, $month, $year, $noRekeningSimpanan);
        $indexRekeningSimpanan = 0;
        foreach ($rsRekeningSimpanan as $rowRekeningSimpanan) {
            $noRekening = $rowRekeningSimpanan->NoRekening;
            $arrInstandingSimpanan = array();
            foreach ($arrPeriode as $rowPeriode) :
                $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                if (!empty($rsInstandingSimpanan)) {
                    $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                } else {
                    $arrInstandingSimpanan[] = 0;
                }
            endforeach;
            $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
            $indexRekeningSimpanan++;
        }

        $row = (object) array();

        $row->DetailRekeningSimpanan = $rsRekeningSimpanan;
        $data["Customer"] = $row;

        $this->response([
            'data'      => $data,
            'status'    => 'Success',
            'message'   => 'Success fecht Detail Rekening Simpanan ' . $noRekeningSimpanan
        ], REST_Controller::HTTP_BAD_REQUEST);
    }
}
