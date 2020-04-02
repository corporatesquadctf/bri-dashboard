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

    $this->load->model("api/AccountPlanningMenengah_model");
    $this->load->model("data_transaction/account_planning_menengah/DataTransaction_model", "DataTransaction_model");
    $this->load->model("PerformanceAccountPlanning_model");

    $current_datetime = new DateTime(date('Y-m-d H:i:s'));
    $this->current_year = $current_datetime->format('Y');
    $this->month_current = $current_datetime->format('m');
    $this->current_date = $current_datetime->format('Y-m-d');
    $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');

    $this->limit_per_page = 15;

    $this->checkTokenMobile();
  }

  public function index_post()
  {
    $params = array();

    $userId         = $this->post('userId');
    $year           = $this->post('year')        ? $this->post('year')          : $this->current_year;
    $docStatusId    = $this->post('docStatusId') ? $this->post('docStatusId')   : 'all';

    if ($userId) {
      $current_page = $this->post('page') ? $this->post('page') : 1;
      $rowno = (($current_page - 1) * $this->limit_per_page);
      $searchTxt = $this->post('searchTxt') ? $this->post('searchTxt') : '';

      $total_records = $this->AccountPlanningMenengah_model->getTotalAccountPlanning($userId, $year, $docStatusId, $searchTxt);
      $total_page = ceil($total_records / $this->limit_per_page);

      $i = 0;
      if ($total_records > 0) {
        $ap_Tasklist = $this->AccountPlanningMenengah_model->getAccountPlanning($userId, $this->limit_per_page, $rowno, $year, $docStatusId, $searchTxt);

        foreach ($ap_Tasklist as $ap_row) {
          $AccountPlanningMenengahId = $ap_row['AccountPlanningMenengahId'];
          $CIF = $ap_row['CIF'];

          $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($AccountPlanningMenengahId);
          $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
          $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);

          $pinjamanAp['TotalPinjaman'] = number_format($pinjamanAp['TotalPinjaman'] / VALUE_PER, 0);
          $pinjamanAp['RatasPinjaman'] = number_format($pinjamanAp['RatasPinjaman'] / VALUE_PER, 0);
          $simpananAp['TotalSimpanan'] = number_format($simpananAp['TotalSimpanan'] / VALUE_PER, 0);
          $simpananAp['RatasSimpanan'] = number_format($simpananAp['RatasSimpanan'] / VALUE_PER, 0);

          $params[] = array(
            'AccountPlanningMenengahId'  => $AccountPlanningMenengahId,
            'CIF'                        => $CIF,
            'CustomerName'               => $ap_row['CustomerName'],
            'RMName'                     => $ap_row['RMName'],
            'Year'                       => $ap_row['Year'],
            'Status'                     => $account_planning_status['Status'],
            'Pinjaman'                   => $pinjamanAp,
            'Simpanan'                   => $simpananAp,
            'CreatedDate'                => $ap_row['CreatedDate'],
          );
          $i++;
        }
      }

      if ($params) {
        $this->response([
          'data' => $params,
          'status' => "Success",
          "detail" => "Success Fetch Account Planning Menengah List",
          'total_data' => $total_records,
          'current_page' => $current_page,
          'total_page' => $total_page,
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'data' => [],
          'status' => FALSE,
          'message' => 'No Account Planning Menengah were found'
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

  public function detail_post()
  {
    $apMenengahId   = $this->post('apMenengahId');
    $CIF            = $this->post('CIF');

    if ($apMenengahId) {
      $rsDebiturOverview = $this->AccountPlanningMenengah_model->getAccountPlanningDebiturOverview($apMenengahId, $CIF);

      $totalShareholder = $this->AccountPlanningMenengah_model->getTotalShareholder($apMenengahId, $CIF);
      $rsShareholder = $this->AccountPlanningMenengah_model->getAccountPlanningShareholder($apMenengahId, $CIF);

      $indexShareholder = 0;
      foreach ($rsShareholder as $row) {
        $rsShareholder[$indexShareholder]["Portion"] = number_format($row["Value"] * 100 / $totalShareholder, 2);
        $indexShareholder++;
      }

      $rsCoverageMapping = $this->AccountPlanningMenengah_model->getAccountPlanningCoverageMapping($apMenengahId, $CIF);

      if (!$rsCoverageMapping) {
        $rsCoverageMapping[] = array(
          'ClientPosition' => '',
          'ClientName' => '',
          'ContactNumber' => '',
          'OtherInformation' => '',
          'BankPosition' => '',
          'BankPerson' => '',
          'BankContact' => '',
          'Description' => '',
        );
      }

      $rsFundings = $this->AccountPlanningMenengah_model->getFundings($apMenengahId);

      $rsServices = $this->AccountPlanningMenengah_model->getServices($apMenengahId);
      foreach ($rsServices as $row) {
        $ServiceMenengahId = $row->ServiceMenengahId;
        $rsUnitKerjaTag = $this->AccountPlanningMenengah_model->getUnitKerjaTag($ServiceMenengahId);
        $arrUnitKerjaTag = array();
        foreach ($rsUnitKerjaTag as $rows) {
          array_push($arrUnitKerjaTag, $rows->Name);
        }
        $row->UnitKerjaTag = $arrUnitKerjaTag;
      }

      $rsFacilitiesBankingGroup = $this->AccountPlanningMenengah_model->getFacilitiesBankingGroup();
      foreach ($rsFacilitiesBankingGroup as $row) {
        $bankFacilityGroupId = $row->BankFacilityGroupMenengahId;

        $rsFacilitiesBankingItem = $this->AccountPlanningMenengah_model->getFacilitiesBankingItem($bankFacilityGroupId);
        foreach ($rsFacilitiesBankingItem as $rowItem) {
          $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
          $rsEstimatedFinancial = $this->AccountPlanningMenengah_model->getEstimatedFinancial($apMenengahId, $bankFacilityItemId);
          if (!empty($rsEstimatedFinancial)) {
            if ($rsEstimatedFinancial[0]->IDRProjection >= $rsEstimatedFinancial[0]->IDRTarget) {
              if ($rsEstimatedFinancial[0]->IDRTarget != 0) {
                $IDRProgressValue   = number_format(($rsEstimatedFinancial[0]->IDRTarget / $rsEstimatedFinancial[0]->IDRProjection) * 100, 1);
              } else {
                $IDRProgressValue   = 0;
              }
              $IDRProgressBar       = $IDRProgressValue;
            } elseif ($rsEstimatedFinancial[0]->IDRProjection < $rsEstimatedFinancial[0]->IDRTarget) {
              $IDRProgressValue     = 100;
              $IDRProgressBar       = 100;
            }
            if ($rsEstimatedFinancial[0]->ValasProjection >= $rsEstimatedFinancial[0]->ValasTarget) {
              if ($rsEstimatedFinancial[0]->ValasTarget != 0) {
                $ValasProgressValue   = number_format(($rsEstimatedFinancial[0]->ValasTarget / $rsEstimatedFinancial[0]->ValasProjection) * 100, 1);
              } else {
                $ValasProgressValue   = 0;
              }
              $ValasProgressBar     = $ValasProgressValue;
            } elseif ($rsEstimatedFinancial[0]->ValasProjection < $rsEstimatedFinancial[0]->ValasTarget) {
              $ValasProgressValue   = 100;
              $ValasProgressBar     = 100;
            }
            $arrEstimatedFinancial = array(
              "IDRProjection" => $rsEstimatedFinancial[0]->IDRProjection,
              "ValasProjection" => $rsEstimatedFinancial[0]->ValasProjection,
              "IDRTarget" => $rsEstimatedFinancial[0]->IDRTarget,
              "ValasTarget" => $rsEstimatedFinancial[0]->ValasTarget,
              "IDRProgressBar" => $IDRProgressBar,
              "IDRProgressValue" => $IDRProgressValue,
              "ValasProgressBar" => $ValasProgressBar,
              "ValasProgressValue" => $ValasProgressValue
            );
          } else {
            $arrEstimatedFinancial = array(
              "IDRProjection" => 0,
              "ValasProjection" => 0,
              "IDRTarget" => 0,
              "ValasTarget" => 0,
              "IDRProgressBar" => 0,
              "IDRProgressValue" => 0,
              "ValasProgressBar" => 0,
              "ValasProgressValue" => 0
            );
          }
          $rowItem->EstimatedFinancial = $arrEstimatedFinancial;
        }
        $row->FacilitiesBankingItem = $rsFacilitiesBankingItem;

        $rsFacilitiesBankingItemAddition = $this->AccountPlanningMenengah_model->getFacilitiesBankingItemAddition($bankFacilityGroupId);
        foreach ($rsFacilitiesBankingItemAddition as $rowItemAddition) {
          $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
          $rsEstimatedFinancialAddition = $this->AccountPlanningMenengah_model->getEstimatedFinancialAddition($apMenengahId, $bankFacilityItemAdditionId);
          if (!empty($rsEstimatedFinancialAddition)) {
            if ($rsEstimatedFinancialAddition[0]->IDRProjection >= $rsEstimatedFinancialAddition[0]->IDRTarget) {
              if ($rsEstimatedFinancialAddition[0]->IDRTarget != 0) {
                $IDRProgressValue     = number_format(($rsEstimatedFinancialAddition[0]->IDRTarget / $rsEstimatedFinancialAddition[0]->IDRProjection) * 100, 1);
              } else {
                $IDRProgressValue   = 0;
              }
              $IDRProgressBar       = $IDRProgressValue;
            } elseif ($rsEstimatedFinancialAddition[0]->IDRProjection < $rsEstimatedFinancialAddition[0]->IDRTarget) {
              $IDRProgressValue     = 100;
              $IDRProgressBar       = 100;
            }
            if (($rsEstimatedFinancialAddition[0]->ValasProjection >= $rsEstimatedFinancialAddition[0]->ValasTarget) &&
              $rsEstimatedFinancialAddition[0]->ValasProjection != 0
            ) {
              if ($rsEstimatedFinancial[0]->IDRTarget != 0) {
                $ValasProgressValue   = number_format(($rsEstimatedFinancialAddition[0]->ValasTarget / $rsEstimatedFinancialAddition[0]->ValasProjection) * 100, 1);
              } else {
                $ValasProgressValue   = 0;
              }
              $ValasProgressBar     = $ValasProgressValue;
            } elseif ($rsEstimatedFinancialAddition[0]->ValasProjection < $rsEstimatedFinancialAddition[0]->ValasTarget) {
              $ValasProgressValue   = 100;
              $ValasProgressBar     = 100;
            }
            $arrEstimatedFinancialAddition = array(
              "IDRProjection" => $rsEstimatedFinancialAddition[0]->IDRProjection,
              "ValasProjection" => $rsEstimatedFinancialAddition[0]->ValasProjection,
              "IDRTarget" => $rsEstimatedFinancialAddition[0]->IDRTarget,
              "ValasTarget" => $rsEstimatedFinancialAddition[0]->ValasTarget,
              "IDRProgressBar" => $IDRProgressBar,
              "IDRProgressValue" => $IDRProgressValue,
              "ValasProgressBar" => $ValasProgressBar,
              "ValasProgressValue" => $ValasProgressValue
            );
          } else {
            $arrEstimatedFinancialAddition = array(
              "IDRProjection" => 0,
              "ValasProjection" => 0,
              "IDRTarget" => 0,
              "ValasTarget" => 0,
              "IDRProgressBar" => 0,
              "IDRProgressValue" => 0,
              "ValasProgressBar" => 0,
              "ValasProgressValue" => 0
            );
          }
          $rowItemAddition->EstimatedFinancialAddition = $arrEstimatedFinancialAddition;
        }
        $row->FacilitiesBankingItemAddition = $rsFacilitiesBankingItemAddition;
      }

      $rsInitiativeAction = $this->AccountPlanningMenengah_model->getInitiativeAction($apMenengahId);
      foreach ($rsInitiativeAction as $row) {
        $dateTimePeriod = new DateTime(date($row->Period . '-01'));
        $row->DateTimePeriod = $dateTimePeriod->format('F Y');
      }

      $data = array(
        'debiturOverview'   => $rsDebiturOverview,
        'shareholder'       => $rsShareholder,
        'coverageMapping'   => $rsCoverageMapping,
        'fundings'          => $rsFundings,
        'services'          => $rsServices,
        'facilitiesBanking' => $rsFacilitiesBankingGroup,
        'initiativeAction'  => $rsInitiativeAction
      );

      $this->response([
        'data' => $data,
        'status' => "Success",
        "detail" => "Success Fetch Account Planning Menengah Detail",
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        "data" => [],
        "status" => FALSE,
        "message" => "apMenengahId cannot be empty"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function tabungan_post()
  {
    $apMenengahId = $this->post('apMenengahId');
    $data = array();

    if ($apMenengahId) {
      $d = new DateTime(date('Y-m-d H:i:s'));
      $d->modify('first day of last month');
      $last_month = $d->format('m');
      $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
      $f->modify('first day of last month');

      $account_planning_Tabungan = $this->AccountPlanningMenengah_model->getTabunganAccountPlanning($apMenengahId, '');
      for ($i = $last_month; $i > $last_month - 6; $i--) {
        $f->modify('first day of last month');
        $data[$d->format('m')]['Tabungan'] = $account_planning_Tabungan[0][$d->format('m')];
        if ($account_planning_Tabungan[0][$f->format('m')] == 0)
          $persen = '100';
        elseif ($account_planning_Tabungan[0][$d->format('m')] == 0)
          $persen = '-100';
        else
          $persen = (($account_planning_Tabungan[0][$d->format('m')] - $account_planning_Tabungan[0][$f->format('m')]) / $account_planning_Tabungan[0][$f->format('m')]) * 100;

        $data[$d->format('m')]['persen'] = $persen;
        $d->modify('first day of last month');
      }

      $simpananYoYoD = $this->AccountPlanningMenengah_model->getSimpananAccountPlanningYoYoD($apMenengahId);

      if ($simpananYoYoD[0]['SaldoTahunLalu'] == 0)
        $persenYoY = '100';
      else
        $persenYoY = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoTahunLalu']) / $simpananYoYoD[0]['SaldoTahunLalu']) * 100;

      if ($simpananYoYoD[0]['SaldoAkhirTahunLalu'] == 0)
        $persenYoD = '100';
      else
        $persenYoD = (($simpananYoYoD[0]['SaldoSekarang'] - $simpananYoYoD[0]['SaldoAkhirTahunLalu']) / $simpananYoYoD[0]['SaldoAkhirTahunLalu']) * 100;

      if (!empty($account_planning_Tabungan)) {

        $this->response([
          "data"          => $data,
          "persenCasa"    => $simpananYoYoD[0]['Casa'],
          "SaldoSekarang" => $simpananYoYoD[0]['SaldoSekarang'],
          "persenYoY"     => $persenYoY,
          "persenYoD"     => $persenYoD,
          "status"        => "Success",
          "detail"        => "Success Fetch Tabungan Account Planning Menengah ",
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          "data"    => [],
          "status"  => FALSE,
          "message" => "No Simpanan Account Planning Menengah Detail were found"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $this->response([
        "data"    => [],
        "status"  => FALSE,
        "message" => "apMenengahId cannot be empty"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function giro_post()
  {
    $apMenengahId = $this->post('apMenengahId');
    $data = array();

    if ($apMenengahId) {
      $d = new DateTime(date('Y-m-d H:i:s'));
      $d->modify('first day of last month');
      $last_month = $d->format('m');
      $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
      $f->modify('first day of last month');

      $account_planning_Tabungan = $this->AccountPlanningMenengah_model->getTabunganAccountPlanning($apMenengahId, 'GIRO');
      for ($i = $last_month; $i > $last_month - 6; $i--) {
        $f->modify('first day of last month');
        $data[$d->format('m')]['Tabungan'] = $account_planning_Tabungan[0][$d->format('m')];
        if ($account_planning_Tabungan[0][$f->format('m')] == 0)
          $persen = '100';
        elseif ($account_planning_Tabungan[0][$d->format('m')] == 0)
          $persen = '-100';
        else
          $persen = (($account_planning_Tabungan[0][$d->format('m')] - $account_planning_Tabungan[0][$f->format('m')]) / $account_planning_Tabungan[0][$f->format('m')]) * 100;

        $data[$d->format('m')]['persen'] = $persen;
        $d->modify('first day of last month');
      }

      if (!empty($account_planning_Tabungan)) {
        $this->response([
          "data"          => $data,
          "status"        => "Success",
          "detail"        => "Success Fetch Tabungan GIRO Account Planning Menengah ",
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          "data"    => [],
          "status"  => FALSE,
          "message" => "No Simpanan Account Planning Menengah Detail were found"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $this->response([
        "data"    => [],
        "status"  => FALSE,
        "message" => "apMenengahId cannot be empty"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function deposito_post()
  {
    $apMenengahId = $this->post('apMenengahId');
    $data = array();

    if ($apMenengahId) {
      $d = new DateTime(date('Y-m-d H:i:s'));
      $d->modify('first day of last month');
      $last_month = $d->format('m');
      $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
      $f->modify('first day of last month');

      $account_planning_Tabungan = $this->AccountPlanningMenengah_model->getTabunganAccountPlanning($apMenengahId, 'DEPOSITO');
      for ($i = $last_month; $i > $last_month - 6; $i--) {
        $f->modify('first day of last month');
        $data[$d->format('m')]['Tabungan'] = $account_planning_Tabungan[0][$d->format('m')];
        if ($account_planning_Tabungan[0][$f->format('m')] == 0)
          $persen = '100';
        elseif ($account_planning_Tabungan[0][$d->format('m')] == 0)
          $persen = '-100';
        else
          $persen = (($account_planning_Tabungan[0][$d->format('m')] - $account_planning_Tabungan[0][$f->format('m')]) / $account_planning_Tabungan[0][$f->format('m')]) * 100;

        $data[$d->format('m')]['persen'] = $persen;
        $d->modify('first day of last month');
      }

      if (!empty($account_planning_Tabungan)) {

        $this->response([
          "data"          => $data,
          "status"        => "Success",
          "detail"        => "Success Fetch Tabungan Deposito Account Planning Menengah ",
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          "data"    => [],
          "status"  => FALSE,
          "message" => "No Simpanan Account Planning Menengah Detail were found"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $this->response([
        "data"    => [],
        "status"  => FALSE,
        "message" => "apMenengahId cannot be empty"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function pinjaman_post()
  {
    $apMenengahId = $this->post('apMenengahId');
    $data = array();

    if ($apMenengahId) {
      $d = new DateTime(date('Y-m-d H:i:s'));
      $d->modify('first day of last month');
      $last_month = $d->format('m');
      $f = new DateTime(date('Y-m-d H:i:s')); //Bulan Sebelumnya
      $f->modify('first day of last month');

      $account_planning_pinjaman = $this->AccountPlanningMenengah_model->getPinjamanAccountPlanning($apMenengahId);
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

      $PinjamanYoYoD = $this->AccountPlanningMenengah_model->getPinjamanAccountPlanningYoYoD($apMenengahId);

      if ($PinjamanYoYoD[0]['bakidebetTahunLalu'] == 0)
        $persenYoY = '100';
      else
        $persenYoY = (($PinjamanYoYoD[0]['bakidebetSekarang'] - $PinjamanYoYoD[0]['bakidebetTahunLalu']) / $PinjamanYoYoD[0]['bakidebetTahunLalu']) * 100;

      if ($PinjamanYoYoD[0]['bakidebetAkhirTahunLalu'] == 0)
        $persenYoD = '100';
      else
        $persenYoD = (($PinjamanYoYoD[0]['bakidebetSekarang'] - $PinjamanYoYoD[0]['bakidebetAkhirTahunLalu']) / $PinjamanYoYoD[0]['bakidebetAkhirTahunLalu']) * 100;

      $KIKMK = $this->AccountPlanningMenengah_model->getPinjamanAccountPlanningKIKMK($apMenengahId);

      if (!empty($account_planning_pinjaman)) {
        $this->response([
          "data"              => $data,
          "bakidebetSekarang" => $PinjamanYoYoD[0]['bakidebetSekarang'],
          "persenYoY"         => $persenYoY,
          "persenYoD"         => $persenYoD,
          "KIKMK"             => $KIKMK[0],
          "status"            => "Success",
          "detail"            => "Success Fetch Pinjaman Account Planning Menengah ",
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          "data"    => [],
          "status"  => FALSE,
          "message" => "No Pinjaman Account Planning Menengah Detail were found"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $this->response([
        "status"  => FALSE,
        "message" => "apMenengahId cannot be empty"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function filter_get()
  {        
    $data['search_year'] = array(
      $this->current_year - 1 => $this->current_year - 1,
      $this->current_year => $this->current_year,
      $this->current_year + 1 => $this->current_year + 1
    );
    $data['doc_statuses'] = $this->AccountPlanningMenengah_model->get_doc_status();
      
      $this->response([
          "data"   => $data,
          "status" => "Success",
          "detail" => "Success Fetch Document Status",
      ], REST_Controller::HTTP_OK);
  }
}
