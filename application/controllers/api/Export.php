<?php

    use Restserver\Libraries\REST_Controller;

    defined('BASEPATH') or exit('No direct script access allowed');

    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';
    // Load library phpspreadsheet
    require APPPATH .'/libraries/phpspreadsheet/vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet as spreadsheet;
    use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as drawing; // Instead PHPExcel_Worksheet_Drawing
    use PhpOffice\PhpSpreadsheet\Style\Alignment as alignment; // Instead PHPExcel_Style_Alignment
    use PhpOffice\PhpSpreadsheet\Style\Fill as fill; // Instead PHPExcel_Style_Fill
    use PhpOffice\PhpSpreadsheet\Style\Color as color_; //Instead PHPExcel_Style_Color
    use PhpOffice\PhpSpreadsheet\Style\Border;
    // End load library phpspreadsheet
    
    class Export extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->checkTokenMobile();
            $this->load->model('PerformanceAccountPlanning_model');
            $this->load->model('api/TasklistAccountPlanning_model');
            
            $this->load->model('DataTransaction_model');
            $this->load->model('AccountPlanningCalculate_model');

            //$this->load->model("tasklist/account_planning_menengah/ManageAccountPlanning_model","ManageAccountPlanning_model");

            $this->load->model('MonitoringAccountPlanning_model');

            $this->load->model('ProsesKredit_model');

            $current_datetime = new DateTime(date('Y-m-d H:i:s'));
            $this->current_year = $current_datetime->format('Y');

            $d = date("d");
            $m = date("m");
            switch($m){
                case 1: $month = "Januari"; break;
                case 2: $month = "Februari"; break;
                case 3: $month = "Maret"; break;
                case 4: $month = "April"; break;
                case 5: $month = "Mei"; break;
                case 6: $month = "Juni"; break;
                case 7: $month = "Juli"; break;
                case 8: $month = "Agustus"; break;
                case 9: $month = "September"; break;
                case 10: $month = "Oktober"; break;
                case 11: $month = "November"; break;
                case 12: $month = "Desember"; break;
                default: break;
            }
            $y = date("Y");
            $this->exportDate = $d." ".$month." ".$y;
        }

        /* Export Account Planning as PDF */
        public function preview_account_planning_get($AccountPlanningId){
            $this->load->library("pdfgenerator");   
            $data = array();
            
            $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);

            /* Company Information */
            $rsAssignedCompany = $this->TasklistAccountPlanning_model->getSelectedCompanyOption($AccountPlanningId);
            $data['account_planning']['AssignedCompany'] = $rsAssignedCompany;
            for($i=0; $i<count($rsAssignedCompany); $i++){
                $data['account_planning']['GroupOverview'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
                $data['account_planning']['StrategicPlan'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningStrategicPlan($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
                $data['account_planning']['CoverageMapping'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningCoverageMapping($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
            }

            $dataShareholder = $this->PerformanceAccountPlanning_model->getAccountPlanningShareholder($AccountPlanningId);
            $data['account_planning']['Shareholder'] = $dataShareholder;
            $totalPortionShareholder = 0;
            foreach($dataShareholder as $key => $value){
                $totalPortionShareholder += $value['Value'];
            }
            $data['account_planning']['totalPortionShareholder'] = $totalPortionShareholder;
            
            $arrColors = Array(
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
            $iShareholder = 0;
            $totalPortionShareholderPercentage = 0;
            foreach($dataShareholder as $key => $value){
                $data['account_planning']['Shareholder'][$iShareholder]['Color'] = $arrColors[$iShareholder];
                
                $portionPercentage = number_format(($value['Value'] / $totalPortionShareholder) * 100, 2);
                $data['account_planning']['Shareholder'][$iShareholder]['PortionPercentage'] = $portionPercentage;
                $totalPortionShareholderPercentage += $portionPercentage;
                $iShareholder++;
            }
            $data['account_planning']['totalPortionShareholderPercentage'] = $totalPortionShareholderPercentage;
            
            /* Financial Highlight */
            $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

            $data['AccountPlanningId'] = $AccountPlanningId;
            $data['account_planning']['Clasifications'] = 'Platinum';
            $data['account_planning']['AccountPlanningId'] = $AccountPlanningId;
            $data['account_planning']['KursUSD'] = $this->getKursUSD();
            $data['account_planning']['Years'] = Array(  
                                                        date('Y') - 3,
                                                        date('Y') - 2,
                                                        date('Y') - 1
                                                );

            $data['account_planning']['backgroundColors'] = Array(
                    // "",
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
            $data['account_planning']['hoverBackgroundColors'] = Array(
                    // "",
                    "#f3e672", 
                    "#86dfcf", 
                    "#b970f5", 
                    "#75c3f0", 
                    "#fa8d6b", 
                    "#ff99f5", 
                    "#34495E", 
                    "#B370CF", 
                    "#CFD4D8", 
                    "#36CAAB", 
                    "#49A9EA"
            );
            $FinancialHighlightItem = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlightItem();
            foreach ($FinancialHighlightItem as $key => $value) {
                $heading_panel = ' collapse';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $heading_panel = '';
                }
                $tab_panel = ' collapse';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $tab_panel = ' collapse in';
                }
                $expanded_panel = 'false';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $expanded_panel = 'true';
                }

                $dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlight($AccountPlanningId, $value['FinancialHighlightItemId'], $data['account_planning']['Years']);

                //$dataSource = $this->DataLoadOption_model->getFinancialHighlightDataSource($AccountPlanningId, $value['FinancialHighlightGroupId']);

                $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']][0] = array(
                    'FinancialHighlightGroupId'       => $value['FinancialHighlightGroupId']
                    , 'FinancialHighlightGroupName'   => $value['FinancialHighlightGroupName']
                    , 'heading_panel'                 => $heading_panel
                    , 'tab_panel'                     => $tab_panel
                    , 'expanded_panel'                => $expanded_panel
                    //, 'DataSource'                    => $dataSource
                    );

                foreach ($data['account_planning']['Years'] as $keyss => $valuess) {
                    if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][$valuess] = array(
                        'FinancialHighlightId'            => 0
                        , 'Amount'                        => 0
                        , 'ChartAmount'                   => 0
                        , 'Year'                          => $valuess
                        );
                    }
                    else {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$valuess] = array(
                        'FinancialHighlightId'            => 0
                        , 'Amount'                        => 0
                        , 'ChartAmount'                   => 0
                        , 'Year'                          => $valuess
                        );
                    }
                }
                if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                    );
                }
                else {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                    );
                }

                if (is_array($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']])) {
                    if ($value['FinancialHighlightGroupId'] == 3 || $value['FinancialHighlightGroupId'] == 4 || $value['FinancialHighlightGroupId'] == 5 || $value['FinancialHighlightGroupId'] == 6) {
                    foreach ($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] as $keysss => $values) {
                        $ChartAmount = str_replace(',', '', $values['Amount']);
                        if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][0] = array(
                            'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                            , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                            );

                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                            'FinancialHighlightId'            => $values['FinancialHighlightId']
                            , 'Amount'                        => number_format($values['Amount']/VALUE_PER)
                            , 'ChartAmount'                   => $ChartAmount
                            , 'Year'                          => $values['Year']
                            );
                        }
                        else {
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                            'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                            , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                            );
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                            'FinancialHighlightId'            => $values['FinancialHighlightId']
                            , 'Amount'                        => number_format($values['Amount'],2)
                            , 'ChartAmount'                   => $values['Amount']
                            , 'Year'                          => $values['Year']
                            );
                        }
                    }
                    }        
                    else {
                    foreach ($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] as $keysss => $values) {
                        $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                        );
                        $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                        'FinancialHighlightId'            => $values['FinancialHighlightId']
                        , 'Amount'                        => number_format($values['Amount']/VALUE_PER)
                        , 'ChartAmount'                   => $values['Amount']/VALUE_PER
                        , 'Year'                          => $values['Year']
                        );
                    }
                    }        
                }
            }

            $dataBankFacilityItem = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItem();
            foreach ($dataBankFacilityItem as $key => $value) {
                $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
                    // Facilities Banking
                    $dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'BankFacilityId'          => 0
                        , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                        , 'IDRAmount'             => 0
                        , 'IDRRate'               => 0
                        , 'ValasAmount'           => 0
                        , 'ValasRate'             => 0
                    );        
                    if(is_array($dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'BankFacilityId'          => $values['BankFacilityId']
                                , 'BankFacilityItemName'  => $values['BankFacilityItemName']
                                , 'IDRAmount'             => number_format($values['IDRAmount']/VALUE_PER)
                                , 'IDRRate'               => number_format($values['IDRRate'], 2)
                                , 'ValasAmount'           => number_format($values['ValasAmount']/VALUE_PER)
                                , 'ValasRate'             => number_format($values['ValasRate'], 2)
                            );
                        }
                    }

                    //Facilities banking Addition
                    $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {
                            $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'BankFacilityAdditionId'              => 0
                                , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                                , 'IDRAmountAddition'                 => 0
                                , 'IDRRateAddition'                   => 0
                                , 'ValasAmountAddition'               => 0
                                , 'ValasRateAddition'                 => 0
                                , 'BankFacilityAdditionSubmit'        => 'add'
                            );        
                            $dataBankFacilityAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);
                            foreach ($dataBankFacilityAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $BankFacilityAddition) {
                                $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                    'BankFacilityAdditionId'              => $BankFacilityAddition['BankFacilityAdditionId']
                                    , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                    , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                                    , 'IDRAmountAddition'                 => number_format($BankFacilityAddition['IDRAmountAddition']/VALUE_PER)
                                    , 'IDRRateAddition'                   => number_format($BankFacilityAddition['IDRRateAddition'], 2)
                                    , 'ValasAmountAddition'               => number_format($BankFacilityAddition['ValasAmountAddition']/VALUE_PER)
                                    , 'ValasRateAddition'                 => number_format($BankFacilityAddition['ValasRateAddition'], 2)
                                    , 'BankFacilityAdditionSubmit'        => 'edit'
                                );  
                            }
                        }
                    }
                    
                    // Wallet Share
                    $dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'WalletShareId'           => 0
                        , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                        , 'BRINominal'            => 0
                        , 'BRIPortion'            => 0
                        , 'OtherNominal'          => 0
                        , 'OtherPortion'          => 0
                        , 'TotalAmount'           => 0
                    );
                    if (!empty($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $BRINominal = $values['BRINominal'];
                            $TotalAmount = $values['TotalAmount'];
                            if($values['TotalAmount'] == 0){
                                $BRIPortion = 0;
                                $OtherPortion = 0;
                            }else{
                                if($BRINominal > $TotalAmount){
                                    $BRIPortion = 100;
                                    $OtherPortion = 0;
                                }else{
                                    $BRIPortion = ($BRINominal/$TotalAmount)*100;
                                    $OtherPortion = ($values['OtherNominal']/$TotalAmount)*100;
                                }
                            }
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'WalletShareId'           => $values['WalletShareId']
                                , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                                , 'BRINominal'            => number_format($BRINominal/VALUE_PER)
                                , 'BRIPortion'            => number_format($BRIPortion, 2)
                                , 'OtherNominal'          => number_format($values['OtherNominal']/VALUE_PER)
                                , 'OtherPortion'          => $OtherPortion
                                , 'TotalAmount'           => number_format($TotalAmount/VALUE_PER)
                            );
                        }
                    }

                    // Wallet Share Addition
                    $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'WalletShareAdditionId'         => 0
                                , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BRINominalAddition'            => 0
                                , 'BRIPortionAddition'            => 0
                                , 'OtherNominalAddition'          => 0
                                , 'OtherPortionAddition'          => 0
                                , 'TotalAmountAddition'           => 0
                            );

                            $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);
                            foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $WalletShareAddition) {
                            $BRINominal = $WalletShareAddition['BRINominalAddition'];
                            $TotalAmount = $WalletShareAddition['TotalAmountAddition'];
                            if($TotalAmount == 0){
                                $BRIPortion = 0;
                                $OtherPortion = 0;
                            }else{
                                if($BRINominal > $TotalAmount){
                                    $BRIPortion = 100;
                                    $OtherPortion = 0;
                                }else{
                                    $BRIPortion = ($BRINominal/$TotalAmount)*100;
                                    $OtherPortion = ($WalletShareAddition['OtherNominalAddition']/$TotalAmount)*100;
                                }
                            }
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'WalletShareAdditionId'         => $WalletShareAddition["WalletShareAdditionId"]
                                , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BRINominalAddition'            => number_format($BRINominal/VALUE_PER)
                                , 'BRIPortionAddition'            => number_format($BRIPortion, 2)
                                , 'OtherNominalAddition'          => number_format($WalletShareAddition['OtherNominalAddition']/VALUE_PER)
                                , 'OtherPortionAddition'          => $OtherPortion
                                , 'TotalAmountAddition'           => number_format($TotalAmount/VALUE_PER)
                                );
                            }
                        }
                    }

                    // Competition Analysis
                    $dataCompetitionAnalysis[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountCompetitions($AccountPlanningId, $value['BankFacilityItemId']);
                    $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']][0] = array(
                        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                        , 'heading_panel'         => $heading_panel
                        , 'tab_panel'             => $tab_panel
                        , 'expanded_panel'        => $expanded_panel
                        );

                    $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']]['CompetitionAnalysis_detail'][$value['BankFacilityItemId']] = array(
                        'CompetitionAnalysisId'        => 0
                        , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                        , 'BankName1'                 => ''
                        , 'BankName2'                 => ''
                        , 'BankName3'                 => ''
                        );

                    if (is_array($dataCompetitionAnalysis[$value['BankFacilityGroupId']])) {
                        foreach ($dataCompetitionAnalysis as $keys => $values) {
                        $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']]['CompetitionAnalysis_detail'][$value['BankFacilityItemId']] = array(
                            'CompetitionAnalysisId'       => $values['CompetitionAnalysisId']
                            , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                            , 'BankName1'                 => $values['BankName1']
                            , 'BankName2'                 => $values['BankName2']
                            , 'BankName3'                 => $values['BankName3']
                            );
                        }
                    }
                    
                    // Estimated Financial
                    $dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningEstimatedFinancial($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'EstimatedFinancialId'        => 0
                        , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                        , 'IDRProjection'             => 0
                        , 'IDRTarget'                 => 0
                        , 'IDRProgressBar'            => 0
                        , 'IDRProgressValue'          => 0
                        , 'ValasProjection'           => 0
                        , 'ValasTarget'               => 0
                        , 'ValasProgressBar'          => 0
                        , 'ValasProgressValue'        => 0
                        );

                    if (isset($dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $IDRProgressBar       = 0;
                            $IDRProgressValue     = 0;
                            $ValasProgressBar     = 0;
                            $ValasProgressValue   = 0;

                            if ($values['IDRProjection'] > $values['IDRTarget']) {
                                $IDRProgressValue     = number_format(($values['IDRTarget'] / $values['IDRProjection']) * 100, 1);
                                $IDRProgressBar       = $IDRProgressValue;
                            }
                            elseif ($values['IDRProjection'] < $values['IDRTarget']) {
                                $IDRProgressValue     = 100;
                                $IDRProgressBar       = 100;
                            }
                            if ($values['ValasProjection'] > $values['ValasTarget']) {
                                $ValasProgressValue   = number_format(($values['ValasTarget'] / $values['ValasProjection']) * 100, 1);
                                $ValasProgressBar     = $ValasProgressValue;
                            }
                            elseif ($values['ValasProjection'] < $values['ValasTarget']) {
                                $ValasProgressValue   = 100;
                                $ValasProgressBar     = 100;
                            }
                            $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'EstimatedFinancialId'          => $values['EstimatedFinancialId']
                                , 'BankFacilityItemName'        => $value['BankFacilityItemName']
                                , 'IDRProjection'               => number_format($values['IDRProjection']/VALUE_PER)
                                , 'IDRTarget'                   => number_format($values['IDRTarget']/VALUE_PER)
                                , 'IDRProgressBar'              => $IDRProgressBar
                                , 'IDRProgressValue'            => $IDRProgressValue
                                , 'ValasProjection'             => number_format($values['ValasProjection']/VALUE_PER)
                                , 'ValasTarget'                 => number_format($values['ValasTarget']/VALUE_PER)
                                , 'ValasProgressBar'            => $ValasProgressBar
                                , 'ValasProgressValue'          => $ValasProgressValue
                            );
                        }
                    }

                    // Estimated Financial Addition
                    $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {

                            $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'EstimatedFinancialAdditionId'         => 0
                                , 'BankFacilityItemAdditionName'       => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'IDRProjectionAddition'              => 0
                                , 'IDRTargetAddition'                  => 0
                                , 'IDRProgressAdditionBar'             => 0
                                , 'IDRProgressAdditionValue'           => 0
                                , 'ValasProjectionAddition'            => 0
                                , 'ValasTargetAddition'                => 0
                                , 'ValasProgressAdditionBar'           => 0
                                , 'ValasProgressAdditionValue'         => 0
                                );

                            $dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningEstimatedFinancialAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);

                            foreach ($dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $EstimatedFinancialAddition) {
                                $IDRProgressAdditionBar       = 0;
                                $IDRProgressAdditionValue     = 0;
                                $ValasProgressAdditionBar     = 0;
                                $ValasProgressAdditionValue   = 0;

                                if ($EstimatedFinancialAddition['IDRProjectionAddition'] > $EstimatedFinancialAddition['IDRTargetAddition']) {
                                    $IDRProgressAdditionValue     = number_format(($EstimatedFinancialAddition['IDRTargetAddition'] / $EstimatedFinancialAddition['IDRProjectionAddition']) * 100, 1);
                                    $IDRProgressAdditionBar       = $IDRProgressAdditionValue;
                                }
                                elseif ($EstimatedFinancialAddition['IDRProjectionAddition'] < $EstimatedFinancialAddition['IDRTargetAddition']) {
                                    $IDRProgressAdditionValue     = 100;
                                    $IDRProgressAdditionBar       = 100;
                                }
                                if ($EstimatedFinancialAddition['ValasProjectionAddition'] > $EstimatedFinancialAddition['ValasTargetAddition']) {
                                    $ValasProgressAdditionValue   = number_format(($EstimatedFinancialAddition['ValasTargetAddition'] / $EstimatedFinancialAddition['ValasProjectionAddition']) * 100, 1);
                                    $ValasProgressAdditionBar     = $ValasProgressAdditionValue;
                                }
                                elseif ($EstimatedFinancialAddition['ValasProjectionAddition'] < $EstimatedFinancialAddition['ValasTargetAddition']) {
                                    $ValasProgressAdditionValue   = 100;
                                    $ValasProgressAdditionBar     = 100;
                                }


                                $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                    'EstimatedFinancialAdditionId'          => $EstimatedFinancialAddition['EstimatedFinancialAdditionId']
                                    , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                    , 'IDRProjectionAddition'               => number_format($EstimatedFinancialAddition['IDRProjectionAddition']/VALUE_PER)
                                    , 'IDRTargetAddition'                   => number_format($EstimatedFinancialAddition['IDRTargetAddition']/VALUE_PER)
                                    , 'IDRProgressAdditionBar'              => $IDRProgressAdditionBar
                                    , 'IDRProgressAdditionValue'            => $IDRProgressAdditionValue
                                    , 'ValasProjectionAddition'             => number_format($EstimatedFinancialAddition['ValasProjectionAddition']/VALUE_PER)
                                    , 'ValasTargetAddition'                 => number_format($EstimatedFinancialAddition['ValasTargetAddition']/VALUE_PER)
                                    , 'ValasProgressAdditionBar'            => $ValasProgressAdditionBar
                                    , 'ValasProgressAdditionValue'          => $ValasProgressAdditionValue
                                );
                            }
                        }
                    }
                }
            }
            
            if (!empty($data['account_planning_vcif_list'])) {
                foreach ($data['account_planning_vcif_list'] as $key => $valuess) {
                    // Client Needs Funding
                    $data['account_planning']['Funding'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFunding($AccountPlanningId, $valuess['VCIF']);
          
                    // Client Needs Service
                    $dataService = $this->PerformanceAccountPlanning_model->getAccountPlanningService($AccountPlanningId, $valuess['VCIF']);
                    foreach ($dataService as $key => $value) {
                        $TagServiceUnitKerja = $this->PerformanceAccountPlanning_model->getAccountPlanningServiceTag($value['ServiceId']);
                        $data['account_planning']['Service'][$valuess['VCIF']][] = array(
                            'ServiceId'               => $value['ServiceId'],
                            'ServiceName'             => $value['ServiceName'],
                            'ServiceTarget'           => $value['Target'],
                            'ServiceDescription'      => $value['Description'],
                            'TagServiceUnitKerja'     => $TagServiceUnitKerja
                            );
                    }

                    // Initiative Actions
                    $data['account_planning']['InitiativeAction'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningInitiativeAction($AccountPlanningId, $valuess['VCIF']);
                    foreach ($data['account_planning']['InitiativeAction'][$valuess['VCIF']] as $keys => $values) {
                        $dataDateTimePeriod[$keys]['DateTimePeriod'] = new DateTime(date($values['Period'].'-01'));
                        $data['account_planning']['InitiativeAction'][$valuess['VCIF']][$keys]['DateTimePeriod'] = $dataDateTimePeriod[$keys]['DateTimePeriod']->format('F Y');
                    }
                }
            }

            $data['Existing'] = $this->DataTransaction_model->getCpaExisting($AccountPlanningId);
            $data['Projection'] = $this->view_cpa_projection($AccountPlanningId);
            
            $this->load->view("api/account_planning", $data);
        }
        public function print_account_planning_get($AccountPlanningId){
            $this->load->library("pdfgenerator");
            $data = array();
            
            $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);

            /* Company Information */
            $rsAssignedCompany = $this->TasklistAccountPlanning_model->getSelectedCompanyOption($AccountPlanningId);
            $data['account_planning']['AssignedCompany'] = $rsAssignedCompany;
            for($i=0; $i<count($rsAssignedCompany); $i++){
                $data['account_planning']['GroupOverview'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
                $data['account_planning']['StrategicPlan'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningStrategicPlan($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
                $data['account_planning']['CoverageMapping'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningCoverageMapping($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
            }

            $dataShareholder = $this->PerformanceAccountPlanning_model->getAccountPlanningShareholder($AccountPlanningId);
            $data['account_planning']['Shareholder'] = $dataShareholder;
            $totalPortionShareholder = 0;
            foreach($dataShareholder as $key => $value){
                $totalPortionShareholder += $value['Value'];
            }
            $data['account_planning']['totalPortionShareholder'] = $totalPortionShareholder;
            
            $arrColors = Array(
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
            $iShareholder = 0;
            $totalPortionShareholderPercentage = 0;
            foreach($dataShareholder as $key => $value){
                $data['account_planning']['Shareholder'][$iShareholder]['Color'] = $arrColors[$iShareholder];
                
                $portionPercentage = number_format(($value['Value'] / $totalPortionShareholder) * 100, 2);
                $data['account_planning']['Shareholder'][$iShareholder]['PortionPercentage'] = $portionPercentage;
                $totalPortionShareholderPercentage += $portionPercentage;
                $iShareholder++;
            }
            $data['account_planning']['totalPortionShareholderPercentage'] = $totalPortionShareholderPercentage;
            
            /* Financial Highlight */
            $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

            $data['AccountPlanningId'] = $AccountPlanningId;
            $data['account_planning']['Clasifications'] = 'Platinum';
            $data['account_planning']['AccountPlanningId'] = $AccountPlanningId;
            $data['account_planning']['KursUSD'] = $this->getKursUSD();
            $data['account_planning']['Years'] = Array(  
                                                        date('Y') - 3,
                                                        date('Y') - 2,
                                                        date('Y') - 1
                                                );

            $data['account_planning']['backgroundColors'] = Array(
                    // "",
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
            $data['account_planning']['hoverBackgroundColors'] = Array(
                    // "",
                    "#f3e672", 
                    "#86dfcf", 
                    "#b970f5", 
                    "#75c3f0", 
                    "#fa8d6b", 
                    "#ff99f5", 
                    "#34495E", 
                    "#B370CF", 
                    "#CFD4D8", 
                    "#36CAAB", 
                    "#49A9EA"
            );
            $FinancialHighlightItem = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlightItem();
            foreach ($FinancialHighlightItem as $key => $value) {
                $heading_panel = ' collapse';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $heading_panel = '';
                }
                $tab_panel = ' collapse';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $tab_panel = ' collapse in';
                }
                $expanded_panel = 'false';
                if ($value['FinancialHighlightGroupId'] == 1) {
                    $expanded_panel = 'true';
                }

                $dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlight($AccountPlanningId, $value['FinancialHighlightItemId'], $data['account_planning']['Years']);

                //$dataSource = $this->DataLoadOption_model->getFinancialHighlightDataSource($AccountPlanningId, $value['FinancialHighlightGroupId']);

                $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']][0] = array(
                    'FinancialHighlightGroupId'       => $value['FinancialHighlightGroupId']
                    , 'FinancialHighlightGroupName'   => $value['FinancialHighlightGroupName']
                    , 'heading_panel'                 => $heading_panel
                    , 'tab_panel'                     => $tab_panel
                    , 'expanded_panel'                => $expanded_panel
                    //, 'DataSource'                    => $dataSource
                    );

                foreach ($data['account_planning']['Years'] as $keyss => $valuess) {
                    if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][$valuess] = array(
                        'FinancialHighlightId'            => 0
                        , 'Amount'                        => 0
                        , 'ChartAmount'                   => 0
                        , 'Year'                          => $valuess
                        );
                    }
                    else {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$valuess] = array(
                        'FinancialHighlightId'            => 0
                        , 'Amount'                        => 0
                        , 'ChartAmount'                   => 0
                        , 'Year'                          => $valuess
                        );
                    }
                }
                if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                    );
                }
                else {
                    $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                    );
                }

                if (is_array($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']])) {
                    if ($value['FinancialHighlightGroupId'] == 3 || $value['FinancialHighlightGroupId'] == 4 || $value['FinancialHighlightGroupId'] == 5 || $value['FinancialHighlightGroupId'] == 6) {
                    foreach ($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] as $keysss => $values) {
                        $ChartAmount = str_replace(',', '', $values['Amount']);
                        if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24 || $value['FinancialHighlightItemId'] == 25) {
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][0] = array(
                            'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                            , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                            );

                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details2'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                            'FinancialHighlightId'            => $values['FinancialHighlightId']
                            , 'Amount'                        => number_format($values['Amount']/VALUE_PER)
                            , 'ChartAmount'                   => $ChartAmount
                            , 'Year'                          => $values['Year']
                            );
                        }
                        else {
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                            'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                            , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                            );
                            $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                            'FinancialHighlightId'            => $values['FinancialHighlightId']
                            , 'Amount'                        => number_format($values['Amount'],2)
                            , 'ChartAmount'                   => $values['Amount']
                            , 'Year'                          => $values['Year']
                            );
                        }
                    }
                    }        
                    else {
                    foreach ($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] as $keysss => $values) {
                        $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
                        'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
                        , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
                        );
                        $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][$values['Year']] = array(
                        'FinancialHighlightId'            => $values['FinancialHighlightId']
                        , 'Amount'                        => number_format($values['Amount']/VALUE_PER)
                        , 'ChartAmount'                   => $values['Amount']/VALUE_PER
                        , 'Year'                          => $values['Year']
                        );
                    }
                    }        
                }
            }

            $dataBankFacilityItem = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItem();
            foreach ($dataBankFacilityItem as $key => $value) {
                $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']][0] = array(
                    'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                    , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                    , 'heading_panel'         => $heading_panel
                    , 'tab_panel'             => $tab_panel
                    , 'expanded_panel'        => $expanded_panel
                );

                foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
                    // Facilities Banking
                    $dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'BankFacilityId'          => 0
                        , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                        , 'IDRAmount'             => 0
                        , 'IDRRate'               => 0
                        , 'ValasAmount'           => 0
                        , 'ValasRate'             => 0
                    );        
                    if(is_array($dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'BankFacilityId'          => $values['BankFacilityId']
                                , 'BankFacilityItemName'  => $values['BankFacilityItemName']
                                , 'IDRAmount'             => number_format($values['IDRAmount']/VALUE_PER)
                                , 'IDRRate'               => number_format($values['IDRRate'], 2)
                                , 'ValasAmount'           => number_format($values['ValasAmount']/VALUE_PER)
                                , 'ValasRate'             => number_format($values['ValasRate'], 2)
                            );
                        }
                    }

                    //Facilities banking Addition
                    $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {
                            $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'BankFacilityAdditionId'              => 0
                                , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                                , 'IDRAmountAddition'                 => 0
                                , 'IDRRateAddition'                   => 0
                                , 'ValasAmountAddition'               => 0
                                , 'ValasRateAddition'                 => 0
                                , 'BankFacilityAdditionSubmit'        => 'add'
                            );        
                            $dataBankFacilityAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);
                            foreach ($dataBankFacilityAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $BankFacilityAddition) {
                                $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                    'BankFacilityAdditionId'              => $BankFacilityAddition['BankFacilityAdditionId']
                                    , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                    , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                                    , 'IDRAmountAddition'                 => number_format($BankFacilityAddition['IDRAmountAddition']/VALUE_PER)
                                    , 'IDRRateAddition'                   => number_format($BankFacilityAddition['IDRRateAddition'], 2)
                                    , 'ValasAmountAddition'               => number_format($BankFacilityAddition['ValasAmountAddition']/VALUE_PER)
                                    , 'ValasRateAddition'                 => number_format($BankFacilityAddition['ValasRateAddition'], 2)
                                    , 'BankFacilityAdditionSubmit'        => 'edit'
                                );  
                            }
                        }
                    }
                    
                    // Wallet Share
                    $dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'WalletShareId'           => 0
                        , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                        , 'BRINominal'            => 0
                        , 'BRIPortion'            => 0
                        , 'OtherNominal'          => 0
                        , 'OtherPortion'          => 0
                        , 'TotalAmount'           => 0
                    );
                    if (!empty($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $BRINominal = $values['BRINominal'];
                            $TotalAmount = $values['TotalAmount'];
                            if($values['TotalAmount'] == 0){
                                $BRIPortion = 0;
                                $OtherPortion = 0;
                            }else{
                                if($BRINominal > $TotalAmount){
                                    $BRIPortion = 100;
                                    $OtherPortion = 0;
                                }else{
                                    $BRIPortion = ($BRINominal/$TotalAmount)*100;
                                    $OtherPortion = ($values['OtherNominal']/$TotalAmount)*100;
                                }
                            }
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'WalletShareId'           => $values['WalletShareId']
                                , 'BankFacilityItemName'  => $value['BankFacilityItemName']
                                , 'BRINominal'            => number_format($BRINominal/VALUE_PER)
                                , 'BRIPortion'            => number_format($BRIPortion, 2)
                                , 'OtherNominal'          => number_format($values['OtherNominal']/VALUE_PER)
                                , 'OtherPortion'          => $OtherPortion
                                , 'TotalAmount'           => number_format($TotalAmount/VALUE_PER)
                            );
                        }
                    }

                    // Wallet Share Addition
                    $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'WalletShareAdditionId'         => 0
                                , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BRINominalAddition'            => 0
                                , 'BRIPortionAddition'            => 0
                                , 'OtherNominalAddition'          => 0
                                , 'OtherPortionAddition'          => 0
                                , 'TotalAmountAddition'           => 0
                            );

                            $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);
                            foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $WalletShareAddition) {
                            $BRINominal = $WalletShareAddition['BRINominalAddition'];
                            $TotalAmount = $WalletShareAddition['TotalAmountAddition'];
                            if($TotalAmount == 0){
                                $BRIPortion = 0;
                                $OtherPortion = 0;
                            }else{
                                if($BRINominal > $TotalAmount){
                                    $BRIPortion = 100;
                                    $OtherPortion = 0;
                                }else{
                                    $BRIPortion = ($BRINominal/$TotalAmount)*100;
                                    $OtherPortion = ($WalletShareAddition['OtherNominalAddition']/$TotalAmount)*100;
                                }
                            }
                            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'WalletShareAdditionId'         => $WalletShareAddition["WalletShareAdditionId"]
                                , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'BRINominalAddition'            => number_format($BRINominal/VALUE_PER)
                                , 'BRIPortionAddition'            => number_format($BRIPortion, 2)
                                , 'OtherNominalAddition'          => number_format($WalletShareAddition['OtherNominalAddition']/VALUE_PER)
                                , 'OtherPortionAddition'          => $OtherPortion
                                , 'TotalAmountAddition'           => number_format($TotalAmount/VALUE_PER)
                                );
                            }
                        }
                    }

                    // Competition Analysis
                    $dataCompetitionAnalysis[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountCompetitions($AccountPlanningId, $value['BankFacilityItemId']);
                    $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']][0] = array(
                        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
                        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
                        , 'heading_panel'         => $heading_panel
                        , 'tab_panel'             => $tab_panel
                        , 'expanded_panel'        => $expanded_panel
                        );

                    $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']]['CompetitionAnalysis_detail'][$value['BankFacilityItemId']] = array(
                        'CompetitionAnalysisId'        => 0
                        , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                        , 'BankName1'                 => ''
                        , 'BankName2'                 => ''
                        , 'BankName3'                 => ''
                        );

                    if (is_array($dataCompetitionAnalysis[$value['BankFacilityGroupId']])) {
                        foreach ($dataCompetitionAnalysis as $keys => $values) {
                        $data['account_planning']['CompetitionAnalysis'][$value['BankFacilityGroupId']]['CompetitionAnalysis_detail'][$value['BankFacilityItemId']] = array(
                            'CompetitionAnalysisId'       => $values['CompetitionAnalysisId']
                            , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                            , 'BankName1'                 => $values['BankName1']
                            , 'BankName2'                 => $values['BankName2']
                            , 'BankName3'                 => $values['BankName3']
                            );
                        }
                    }
                    
                    // Estimated Financial
                    $dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningEstimatedFinancial($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
                    $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                        'EstimatedFinancialId'        => 0
                        , 'BankFacilityItemName'      => $value['BankFacilityItemName']
                        , 'IDRProjection'             => 0
                        , 'IDRTarget'                 => 0
                        , 'IDRProgressBar'            => 0
                        , 'IDRProgressValue'          => 0
                        , 'ValasProjection'           => 0
                        , 'ValasTarget'               => 0
                        , 'ValasProgressBar'          => 0
                        , 'ValasProgressValue'        => 0
                        );

                    if (isset($dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
                        foreach ($dataEstimatedFinancial[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
                            $IDRProgressBar       = 0;
                            $IDRProgressValue     = 0;
                            $ValasProgressBar     = 0;
                            $ValasProgressValue   = 0;

                            if ($values['IDRProjection'] > $values['IDRTarget']) {
                                $IDRProgressValue     = number_format(($values['IDRTarget'] / $values['IDRProjection']) * 100, 1);
                                $IDRProgressBar       = $IDRProgressValue;
                            }
                            elseif ($values['IDRProjection'] < $values['IDRTarget']) {
                                $IDRProgressValue     = 100;
                                $IDRProgressBar       = 100;
                            }
                            if ($values['ValasProjection'] > $values['ValasTarget']) {
                                $ValasProgressValue   = number_format(($values['ValasTarget'] / $values['ValasProjection']) * 100, 1);
                                $ValasProgressBar     = $ValasProgressValue;
                            }
                            elseif ($values['ValasProjection'] < $values['ValasTarget']) {
                                $ValasProgressValue   = 100;
                                $ValasProgressBar     = 100;
                            }
                            $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
                                'EstimatedFinancialId'          => $values['EstimatedFinancialId']
                                , 'BankFacilityItemName'        => $value['BankFacilityItemName']
                                , 'IDRProjection'               => number_format($values['IDRProjection']/VALUE_PER)
                                , 'IDRTarget'                   => number_format($values['IDRTarget']/VALUE_PER)
                                , 'IDRProgressBar'              => $IDRProgressBar
                                , 'IDRProgressValue'            => $IDRProgressValue
                                , 'ValasProjection'             => number_format($values['ValasProjection']/VALUE_PER)
                                , 'ValasTarget'                 => number_format($values['ValasTarget']/VALUE_PER)
                                , 'ValasProgressBar'            => $ValasProgressBar
                                , 'ValasProgressValue'          => $ValasProgressValue
                            );
                        }
                    }

                    // Estimated Financial Addition
                    $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
                    if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
                        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {

                            $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                'EstimatedFinancialAdditionId'         => 0
                                , 'BankFacilityItemAdditionName'       => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                , 'IDRProjectionAddition'              => 0
                                , 'IDRTargetAddition'                  => 0
                                , 'IDRProgressAdditionBar'             => 0
                                , 'IDRProgressAdditionValue'           => 0
                                , 'ValasProjectionAddition'            => 0
                                , 'ValasTargetAddition'                => 0
                                , 'ValasProgressAdditionBar'           => 0
                                , 'ValasProgressAdditionValue'         => 0
                                );

                            $dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningEstimatedFinancialAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);

                            foreach ($dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $EstimatedFinancialAddition) {
                                $IDRProgressAdditionBar       = 0;
                                $IDRProgressAdditionValue     = 0;
                                $ValasProgressAdditionBar     = 0;
                                $ValasProgressAdditionValue   = 0;

                                if ($EstimatedFinancialAddition['IDRProjectionAddition'] > $EstimatedFinancialAddition['IDRTargetAddition']) {
                                    $IDRProgressAdditionValue     = number_format(($EstimatedFinancialAddition['IDRTargetAddition'] / $EstimatedFinancialAddition['IDRProjectionAddition']) * 100, 1);
                                    $IDRProgressAdditionBar       = $IDRProgressAdditionValue;
                                }
                                elseif ($EstimatedFinancialAddition['IDRProjectionAddition'] < $EstimatedFinancialAddition['IDRTargetAddition']) {
                                    $IDRProgressAdditionValue     = 100;
                                    $IDRProgressAdditionBar       = 100;
                                }
                                if ($EstimatedFinancialAddition['ValasProjectionAddition'] > $EstimatedFinancialAddition['ValasTargetAddition']) {
                                    $ValasProgressAdditionValue   = number_format(($EstimatedFinancialAddition['ValasTargetAddition'] / $EstimatedFinancialAddition['ValasProjectionAddition']) * 100, 1);
                                    $ValasProgressAdditionBar     = $ValasProgressAdditionValue;
                                }
                                elseif ($EstimatedFinancialAddition['ValasProjectionAddition'] < $EstimatedFinancialAddition['ValasTargetAddition']) {
                                    $ValasProgressAdditionValue   = 100;
                                    $ValasProgressAdditionBar     = 100;
                                }


                                $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                                    'EstimatedFinancialAdditionId'          => $EstimatedFinancialAddition['EstimatedFinancialAdditionId']
                                    , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                                    , 'IDRProjectionAddition'               => number_format($EstimatedFinancialAddition['IDRProjectionAddition']/VALUE_PER)
                                    , 'IDRTargetAddition'                   => number_format($EstimatedFinancialAddition['IDRTargetAddition']/VALUE_PER)
                                    , 'IDRProgressAdditionBar'              => $IDRProgressAdditionBar
                                    , 'IDRProgressAdditionValue'            => $IDRProgressAdditionValue
                                    , 'ValasProjectionAddition'             => number_format($EstimatedFinancialAddition['ValasProjectionAddition']/VALUE_PER)
                                    , 'ValasTargetAddition'                 => number_format($EstimatedFinancialAddition['ValasTargetAddition']/VALUE_PER)
                                    , 'ValasProgressAdditionBar'            => $ValasProgressAdditionBar
                                    , 'ValasProgressAdditionValue'          => $ValasProgressAdditionValue
                                );
                            }
                        }
                    }
                }
            }
            
            if (!empty($data['account_planning_vcif_list'])) {
                foreach ($data['account_planning_vcif_list'] as $key => $valuess) {
                    // Client Needs Funding
                    $data['account_planning']['Funding'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFunding($AccountPlanningId, $valuess['VCIF']);
          
                    // Client Needs Service
                    $dataService = $this->PerformanceAccountPlanning_model->getAccountPlanningService($AccountPlanningId, $valuess['VCIF']);
                    foreach ($dataService as $key => $value) {
                        $TagServiceUnitKerja = $this->PerformanceAccountPlanning_model->getAccountPlanningServiceTag($value['ServiceId']);
                        $data['account_planning']['Service'][$valuess['VCIF']][] = array(
                            'ServiceId'               => $value['ServiceId'],
                            'ServiceName'             => $value['ServiceName'],
                            'ServiceTarget'           => $value['Target'],
                            'ServiceDescription'      => $value['Description'],
                            'TagServiceUnitKerja'     => $TagServiceUnitKerja
                            );
                    }

                    // Initiative Actions
                    $data['account_planning']['InitiativeAction'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningInitiativeAction($AccountPlanningId, $valuess['VCIF']);
                    foreach ($data['account_planning']['InitiativeAction'][$valuess['VCIF']] as $keys => $values) {
                        $dataDateTimePeriod[$keys]['DateTimePeriod'] = new DateTime(date($values['Period'].'-01'));
                        $data['account_planning']['InitiativeAction'][$valuess['VCIF']][$keys]['DateTimePeriod'] = $dataDateTimePeriod[$keys]['DateTimePeriod']->format('F Y');
                    }
                }
            }

            $data['Existing'] = $this->DataTransaction_model->getCpaExisting($AccountPlanningId);
            $data['Projection'] = $this->view_cpa_projection($AccountPlanningId);
            $data["ExportDate"] = $this->exportDate;

            //echo json_encode($data); die;
            //$this->load->view("export/print_account_planning", $data);
            $html = $this->load->view("export/print_account_planning", $data, true);
            $filename = "AccountPlanning_".$AccountPlanningId."_".time();
            $this->pdfgenerator->generate($html, $filename, true, "A4", "portrait");
            
        }
        public function savebase64(){
            $accountPlanningId = $this->input->post("accountPlanningId");
            define('UPLOAD_DIR', 'uploads/account_planning/'.$accountPlanningId.'/');
            if(is_dir('uploads/account_planning/'.$accountPlanningId.'/') === false){
                mkdir('uploads/account_planning/'.$accountPlanningId.'/', 0755, true);
            }
            $img = $this->input->post("img");
            $type = $this->input->post("type");
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $type = str_replace(" ","", $type);
            $file = UPLOAD_DIR.$type.'.png';
            file_put_contents($file, $data);
        }
        public function getKursUSD() {
            $url = "http://kurs.web.id/api/v1/bri";
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            curl_setopt($ch, CURLOPT_HEADER, TRUE); 
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        
            $head = curl_exec($ch); 
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        
            curl_error($ch);
            curl_close($ch); 
        
            // echo "14.934";    
        }
        public function view_cpa_projection($AccountPlanningId) {
            
            // CPAProjectionAssumption
            $data['Assumption'] = array(
              'CreditSimulationAssumptionId'                => 0,
              'USDExchanges'                                => 0,
              'USDExchange'                                 => 0,
              'IDRFTPSimpanan'                              => 0,
              'ValasFTPSimpanan'                            => 0,
              'IDRFTPPinjaman'                              => 0,
              'ValasFTPPinjaman'                            => 0
              );
        
            $dataCreditAssumption = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditAssumption($AccountPlanningId);
            if (!empty($dataCreditAssumption)) {
              $data['Assumption'] = array(
                  'CreditSimulationAssumptionId'                => $dataCreditAssumption[0]['CreditSimulationAssumptionId'],
                  'USDExchanges'                                => $dataCreditAssumption[0]['USDExchange'],
                  'USDExchange'                                 => number_format($dataCreditAssumption[0]['USDExchange']),
                  'IDRFTPSimpanan'                              => number_format($dataCreditAssumption[0]['IDRFTPSimpanan'], 2),
                  'ValasFTPSimpanan'                            => number_format($dataCreditAssumption[0]['ValasFTPSimpanan'], 2),
                  'IDRFTPPinjaman'                              => number_format($dataCreditAssumption[0]['IDRFTPPinjaman'], 2),
                  'ValasFTPPinjaman'                            => number_format($dataCreditAssumption[0]['ValasFTPPinjaman'], 2)
                  );
            }
        
            // CPAProjectionSimpanan
            $data['Simpanan'] = $this->AccountPlanningCalculate_model->getCPAProjectionSimpananSum($AccountPlanningId, 3, 1, $data['Assumption']['USDExchanges']);
        
            // CPAProjectionPinjaman
            $data['Pinjaman'] = $this->AccountPlanningCalculate_model->getCPAProjectionPinjamanSum($AccountPlanningId, $data['Assumption']['USDExchanges']);
        
            // CPAProjectionLabaRugi
            $data['LabaRugi'] = $this->AccountPlanningCalculate_model->getCPAProjectionLabaRugiSum($AccountPlanningId, $data['Assumption']['USDExchanges']);
        
            $data['LabaRugi']['PendapatanBunga'] = $data['Pinjaman']['TotalIncomeExpense']; 
            $data['LabaRugi']['PendapatanFTP'] = (($data['Pinjaman']['IDRDailyRatas'] * $data['Assumption']['IDRFTPSimpanan'])/100) + (($data['Pinjaman']['ValasDailyRatas'] * $data['Assumption']['ValasFTPSimpanan'])/100);
            $data['LabaRugi']['TotalPendapatanBunga'] = $data['LabaRugi']['PendapatanBunga'] + $data['LabaRugi']['PendapatanFTP'];
        
            $data['LabaRugi']['BebanBunga'] = $data['Simpanan']['TotalBebanBunga']; 
            $data['LabaRugi']['BebanBungaFTP'] = (($data['Pinjaman']['IDRDailyRatas'] * $data['Assumption']['IDRFTPPinjaman'])/100) + (($data['Pinjaman']['ValasDailyRatas'] * $data['Assumption']['ValasFTPPinjaman'])/100);
            $data['LabaRugi']['TotalBebanBunga'] = $data['LabaRugi']['BebanBunga'] + $data['LabaRugi']['BebanBungaFTP'];
        
            $data['LabaRugi']['NII'] = $data['LabaRugi']['TotalPendapatanBunga'] + $data['LabaRugi']['TotalProvision'] - $data['LabaRugi']['TotalBebanBunga']; 
        
            $data['LabaRugi']['NIIFTP'] = $data['LabaRugi']['TotalPendapatanBunga'] - $data['LabaRugi']['TotalBebanBunga']; 
        
            $data['LabaRugi']['TotalJasaPerkreditan'] = 0; 
            $data['LabaRugi']['TotalJasaSimpanan'] = 0; 
            $data['LabaRugi']['FeeBased'] = $data['LabaRugi']['TotalJasaPerkreditan'] + $data['LabaRugi']['TotalJasaSimpanan'] + $data['LabaRugi']['TotalJasaTransaksi'] + $data['LabaRugi']['TotalJasaTransfer'] + $data['LabaRugi']['TotalProvision']; 
        
            $data['LabaRugi']['TotalBiayaOperasional'] = $data['LabaRugi']['TotalAdministrasi'] + $data['LabaRugi']['TotalOperasional'] + $data['LabaRugi']['TotalPersonalia']; 
        
            $data['LabaRugi']['BiayaPpap'] = $data['LabaRugi']['TotalPpap'] * $data['Pinjaman']['TotalDailyRatas'] / 100; 
        
            $data['LabaRugi']['LabaRugiSebelumModal'] = $data['LabaRugi']['NII'] + $data['LabaRugi']['FeeBased'] - $data['LabaRugi']['TotalBiayaOperasional'] - $data['LabaRugi']['BiayaPpap']; 
        
            $data['LabaRugi']['LabaRugiFtpSeblumModal'] = $data['LabaRugi']['NIIFTP'] + $data['LabaRugi']['FeeBased'] - $data['LabaRugi']['TotalBiayaOperasional'] - $data['LabaRugi']['BiayaPpap']; 
        
            $data['LabaRugi']['LabaRugiSetelahModal'] = $data['LabaRugi']['LabaRugiSebelumModal'] - $data['LabaRugi']['TotalBiayaModal']; 
        
            $data['LabaRugi']['LabaRugiFtpSetelahModal'] = $data['LabaRugi']['LabaRugiFtpSeblumModal'] - $data['LabaRugi']['TotalBiayaModal']; 
            // echo "<pre>";
            // print_r($data);
            // die();
        
            return $data;       
        }

        /* Export Monitoring Account Planning as Excel */
        public function monitoring_account_planning(){
            $status_search = "all";
            $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning('', '', $this->current_year, $status_search);

            if ($total_records > 0) {   
                $limit_per_page = $total_records;
                $rowno = 0;
                $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, '', '', $this->current_year, $status_search);
            }

            for($i=0; $i<count($ap_monitoring); $i++) {
                $Clasified = ($ap_monitoring[$i]['Clasified']) ? $ap_monitoring[$i]['Clasified'] : "Platinum";
                $ap_monitoring[$i]['Clasified'] = $Clasified;
            }
            
            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator('PT. Bank Rakyat Indonesia')
                ->setLastModifiedBy('PT. Bank Rakyat Indonesia')
                ->setTitle('Monitoring Account Planning XLSX Document')
                ->setSubject('Monitoring Account Planning XLSX Document')
                ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Result file');

            // Add Data Header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NAME')
                ->setCellValue('B1', 'TAHUN')
                ->setCellValue('C1', 'CLASSIFICATION')
                ->setCellValue('D1', 'STATUS')
                ->setCellValue('E1', 'PERCENTAGE')
                ->setCellValue('F1', 'CREATED DATE');
            
            //Set Header Style
            //$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            $spreadsheet->getActiveSheet()->getStyle('A1:F1')->getBorders()->getAllBorders()->applyFromArray([
                'borderStyle' => Border::BORDER_MEDIUM, 
                'color' => [ 'rgb' => '000000' ] 
            ]);
            $spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFont()->getColor()->applyFromArray(['argb' => '000000']);
            $spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFill()->applyFromArray([
                'fillType' => Fill::FILL_SOLID, 
                'startColor' => [ 'argb' => 'F3F3F3' ] 
            ]);
            $spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
            //$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            //$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setIndent(1);

            // Miscellaneous glyphs, UTF-8
            $i=2;
            foreach($ap_monitoring as $row) {
                $timestamp = strtotime($row['AccountPlanningAddon']);
 
                // Creating new date format from that timestamp
                $new_date = date("d-m-Y", $timestamp);

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $row['CustomerName'])
                    ->setCellValue('B'.$i, $row['Year'])
                    ->setCellValue('C'.$i, $row['Clasified'])
                    ->setCellValue('D'.$i, $row['Status'])
                    ->setCellValue('E'.$i, $row['ProgressTotal'])
                    ->setCellValue('F'.$i, $new_date);

                $spreadsheet->getActiveSheet()->getStyle('A'.$i.':F'.$i)->getBorders()->getAllBorders()->applyFromArray([
                    'borderStyle' => Border::BORDER_THIN, 
                    'color' => [ 'rgb' => '000000' ] 
                ]);
                    
                $i++;
            }

            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle(date('d-m-Y'));

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Monitoring Account Planning.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        }

        /* Export Surat Permohonan */
        public function surat_permohonan($prosesKreditId){
            $this->load->library("pdfgenerator");
            $data = array();
            
            $data["ExportDate"] = $this->exportDate;

            $rsDetailProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $data["ProsesKredit"] = $rsDetailProsesKredit;

            $rsFasilitasPermohonan = $this->ProsesKredit_model->getFasilitasPermohonan($rsDetailProsesKredit->PipelineId);
            $data["FasilitasPermohonan"] = $rsFasilitasPermohonan;

            $html = $this->load->view("export/surat_permohonan", $data, true);
            $filename = "SuratPermohonan_".$prosesKreditId."_".time();
            $this->pdfgenerator->generate($html, $filename, true, "A4", "portrait");
        }

        /* Export Dokumen LKN */
        public function dokumen_lkn($prosesKreditId){
            $this->load->library("pdfgenerator");
            $data = array();

            $data["ExportDate"] = $this->exportDate;

            $rsDetailProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $data["ProsesKredit"] = $rsDetailProsesKredit;

            //echo json_encode($data); die;

            $html = $this->load->view("export/dokumen_lkn", $data, true);
            $filename = "DokumenLKN_".$prosesKreditId."_".time();
            $this->pdfgenerator->generate($html, $filename, true, "A4", "portrait");
        }

        /* Export Kelengkapan Dokumen */
        public function kelengkapan_dokumen($prosesKreditId){
            $this->load->library("pdfgenerator");
            $data = array();

            $data["ExportDate"] = $this->exportDate;

            $rsDetailProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $data["ProsesKredit"] = $rsDetailProsesKredit;

            $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
            $data["ProsesKreditDocument"] = $rsProsesKreditDocument;

            //echo json_encode($data); die;

            $html = $this->load->view("export/kelengkapan_dokumen", $data, true);
            $filename = "DokumenLKN_".$prosesKreditId."_".time();
            $this->pdfgenerator->generate($html, $filename, true, "A4", "portrait");
        }
    }
