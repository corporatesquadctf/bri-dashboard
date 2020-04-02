<?php
    class Approver extends MY_Controller {
        function __construct() {
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
        
            $this->load->model("tasklist/account_planning_menengah/CreateAccountPlanning_model","CreateAccountPlanning_model");
            $this->load->model("tasklist/account_planning_menengah/ManageAccountPlanning_model","ManageAccountPlanning_model");        
            $this->load->model("disposisi/account_planning_menengah/Disposisi_model","Disposisi_model");
            $this->load->model("data_transaction/account_planning_menengah/DataTransaction_model","DataTransaction_model");
            $this->load->model("MonitoringAccountPlanning_model");
            $this->load->model("PerformanceAccountPlanning_model");
            $this->load->model("ConfirmationAccountPlanningMenengah_model");
            
            $current_datetime = new DateTime(date('Y-m-d H:i:s'));
            $this->current_year = $current_datetime->format('Y');
            $this->current_date = $current_datetime->format('Y-m-d');
            $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
        }
        public function index($rowNo=0) {
            $this->checkModule();
            $params = array();

            $userId = $this->session->PERSONAL_NUMBER;
            $limitPage = 1;

            $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
            $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
            $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
            $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
            $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
            $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

            $total_records = $this->ConfirmationAccountPlanningMenengah_model->getTotalConfirmationAccountPlanning($userId);
            if ($total_records > 0) {
                $ap_Tasklist = $this->ConfirmationAccountPlanningMenengah_model->getConfirmationAccountPlanning($userId, $limitPage, $rowNo);
                $i = 0;
                foreach ($ap_Tasklist as $ap_row) {
                    $AccountPlanningMenengahId = $ap_row["AccountPlanningMenengahId"];
                    $CIF = $ap_row["CIF"];
                    
                    $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
                    $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
                    $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

                    $ap_year_color = "#218FD8";
                    if ($ap_row["Year"] != $this->current_year) {
                        $ap_year_color = "#F58C38";
                    }

                    $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
                    $ap_Tasklist[$i]["PinjamanTotalAP"] = number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0);
                    $ap_Tasklist[$i]["PinjamanRatasAP"] = number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0);
                    $ap_Tasklist[$i]["SimpananTotalAP"] = number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0);
                    $ap_Tasklist[$i]["SimpananRatasAP"] = number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0);
                    $ap_Tasklist[$i]["CommentAP"] = $rsCommentAp;
                    $i++;  
                }
                $params["result"] = $ap_Tasklist;
                //echo json_encode($params); die;
                
                $params['row'] = $rowNo;

                $config['base_url'] = base_url() . 'confirmation/approver/page';
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $total_records;
                $config['per_page'] = $limitPage;
                $config["uri_segment"] = 3;
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tagl_close'] = '</a></li>';
                $config['prev_tag_open'] = '<li class="page-item">';
                $config['prev_tagl_close'] = '</li>';
                $config['first_tag_open'] = '<li class="page-item ">';
                $config['first_tagl_close'] = '</li>';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tagl_close'] = '</a></li>';
                $config['attributes'] = array('class' => 'page-link');

                $this->pagination->initialize($config);

                $params["links"] = $this->pagination->create_links();
            }
            $params['search_box'] = ' style="display: none;"';
            
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('confirmation/account_planning_menengah/account_planning_approval', $params);
            $this->load->view('layout/footer.php');
        }
        public function page($rowNo=1) {
          $this->checkModule();
          $params = array();

          $userId = $this->session->PERSONAL_NUMBER;
          $limitPage = 1;
          $rowNo = ($rowNo-1) * $limitPage;

          $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
          $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
          $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
          $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
          $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
          $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

          $total_records = $this->ConfirmationAccountPlanningMenengah_model->getTotalConfirmationAccountPlanning($userId);
          if ($total_records > 0) {
              $ap_Tasklist = $this->ConfirmationAccountPlanningMenengah_model->getConfirmationAccountPlanning($userId, $limitPage, $rowNo);
              $i = 0;
              foreach ($ap_Tasklist as $ap_row) {
                  $AccountPlanningMenengahId = $ap_row["AccountPlanningMenengahId"];
                  $CIF = $ap_row["CIF"];
                  
                  $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
                  $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
                  $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

                  $ap_year_color = "#218FD8";
                  if ($ap_row["Year"] != $this->current_year) {
                      $ap_year_color = "#F58C38";
                  }

                  $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
                  $ap_Tasklist[$i]["PinjamanTotalAP"] = number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["PinjamanRatasAP"] = number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["SimpananTotalAP"] = number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["SimpananRatasAP"] = number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["CommentAP"] = $rsCommentAp;
                  $i++;  
              }
              $params["result"] = $ap_Tasklist;
              //echo json_encode($params); die;
              
              $params['row'] = $rowNo;

              $config['base_url'] = base_url() . 'confirmation/approver/page';
              $config['use_page_numbers'] = TRUE;
              $config['total_rows'] = $total_records;
              $config['per_page'] = $limitPage;
              $config["uri_segment"] = 4;
              $config['full_tag_open'] = '<ul class="pagination">';
              $config['full_tag_close'] = '</ul>';
              $config['num_tag_open'] = '<li class="page-item">';
              $config['num_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
              $config['cur_tag_close'] = '</a></li>';
              $config['next_tag_open'] = '<li class="page-item">';
              $config['next_tagl_close'] = '</a></li>';
              $config['prev_tag_open'] = '<li class="page-item">';
              $config['prev_tagl_close'] = '</li>';
              $config['first_tag_open'] = '<li class="page-item ">';
              $config['first_tagl_close'] = '</li>';
              $config['last_tag_open'] = '<li class="page-item">';
              $config['last_tagl_close'] = '</a></li>';
              $config['attributes'] = array('class' => 'page-link');

              $this->pagination->initialize($config);

              $params["links"] = $this->pagination->create_links();
          }
          $params['search_box'] = ' style="display: none;"';
          
          $this->load->view('layout/header.php');
          $this->load->view('layout/side-nav.php');
          $this->load->view('layout/top-nav.php');
          $this->load->view('confirmation/account_planning_menengah/account_planning_approval', $params);
          $this->load->view('layout/footer.php');
        }
        public function search($searchTxt='', $rowNo = 0) {
          $this->checkModule();
          $params = array();

          if (empty($searchTxt)) {
            $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
          }
          else {
              $searchTxt = str_replace('_', ' ', $searchTxt);
          }
          $params['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));

          if(empty(trim($searchTxt))) {
              header("location:".base_url() . "confirmation/approver");
          }

          $userId = $this->session->PERSONAL_NUMBER;
          $limitPage = 1;
          if($rowNo != 0){
            $rowNo = ($rowNo-1) * $limitPage;
          }

          $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
          $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
          $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
          $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
          $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
          $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

          $total_records = $this->ConfirmationAccountPlanningMenengah_model->getTotalConfirmationAccountPlanning($userId, $searchTxt);
          if ($total_records > 0) {
              $ap_Tasklist = $this->ConfirmationAccountPlanningMenengah_model->getConfirmationAccountPlanning($userId, $limitPage, $rowNo, $searchTxt);
              $i = 0;
              foreach ($ap_Tasklist as $ap_row) {
                  $AccountPlanningMenengahId = $ap_row["AccountPlanningMenengahId"];
                  $CIF = $ap_row["CIF"];
                  
                  $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
                  $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
                  $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

                  $ap_year_color = "#218FD8";
                  if ($ap_row["Year"] != $this->current_year) {
                      $ap_year_color = "#F58C38";
                  }

                  $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
                  $ap_Tasklist[$i]["PinjamanTotalAP"] = number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["PinjamanRatasAP"] = number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["SimpananTotalAP"] = number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["SimpananRatasAP"] = number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0);
                  $ap_Tasklist[$i]["CommentAP"] = $rsCommentAp;
                  $i++;  
              }
              $params["result"] = $ap_Tasklist;
              //echo json_encode($params); die;
              
              $params['row'] = $rowNo;

              $config['base_url'] = base_url() . 'confirmation/approver/page';
              $config['use_page_numbers'] = TRUE;
              $config['total_rows'] = $total_records;
              $config['per_page'] = $limitPage;
              $config["uri_segment"] = 3;
              $config['full_tag_open'] = '<ul class="pagination">';
              $config['full_tag_close'] = '</ul>';
              $config['num_tag_open'] = '<li class="page-item">';
              $config['num_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
              $config['cur_tag_close'] = '</a></li>';
              $config['next_tag_open'] = '<li class="page-item">';
              $config['next_tagl_close'] = '</a></li>';
              $config['prev_tag_open'] = '<li class="page-item">';
              $config['prev_tagl_close'] = '</li>';
              $config['first_tag_open'] = '<li class="page-item ">';
              $config['first_tagl_close'] = '</li>';
              $config['last_tag_open'] = '<li class="page-item">';
              $config['last_tagl_close'] = '</a></li>';
              $config['attributes'] = array('class' => 'page-link');

              $this->pagination->initialize($config);

              $params["links"] = $this->pagination->create_links();
          }
          $params['search_box'] = ' style="display: none;"';
          
          $this->load->view('layout/header.php');
          $this->load->view('layout/side-nav.php');
          $this->load->view('layout/top-nav.php');
          $this->load->view('confirmation/account_planning_menengah/account_planning_approval', $params);
          $this->load->view('layout/footer.php');
        }
        public function view($accountPlanningMenengahId){
            $this->checkModule();    
            $data = array();
        
            $userId = $this->session->PERSONAL_NUMBER;
            $unitKerjaId = $this->session->DIVISION;
        
            $data["APMenengahId"] = $accountPlanningMenengahId;
            
            $rsDocumentStatus = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($accountPlanningMenengahId);
            
            /* Get Account Planning Menengah Information */
            $rsAPMenengahHeaderInformation = $this->ManageAccountPlanning_model->getAccountPlanningInformation("", $accountPlanningMenengahId);
            $rsAPMenengahHeaderInformation->DocumentStatusId = $rsDocumentStatus["DocumentStatusId"];
            $rsAPMenengahHeaderInformation->Status = $rsDocumentStatus["Status"];
            $data["APMenengahHeaderInformation"] = $rsAPMenengahHeaderInformation;
        
            $displayAction = "no_display";
            if($rsDocumentStatus["DocumentStatusId"] == 0 || $rsDocumentStatus["DocumentStatusId"] == 1){
                $displayAction = "";
            }
            $data["DisplayAction"] = $displayAction;
        
            $rsApprover = $this->ManageAccountPlanning_model->getListApprover($unitKerjaId);
            $data["Approver"] = $rsApprover;
        
            /* Build Tab Input Account Planning */
            $ap_tab_get = ($this->uri->segment(6)) ? $this->uri->segment(6) : 'company_information';
            $ap_tab_subcontent_get = ($this->uri->segment(7)) ? $this->uri->segment(7) : '';
            $ap_tabs = array (
              'company_information'
              , 'bri_starting_position'
              , 'client_needs'
              , 'action_plans'
            );
        
            $ap_tab_contents = array (
              'financial_highlights'
              , 'facilities_banking'
              , 'wallet_share'
              , 'competition_analysis'
              , 'estimated_financial'
              , 'initiatives_action'
            );
        
            foreach ($ap_tabs as $ap_tabs_key => $ap_tabs_value) {
              $data['account_planning']['ap_tab'][$ap_tabs_value] = '';
              $data['account_planning']['ap_tab_content'][$ap_tabs_value] = '';
              if ($ap_tab_get == $ap_tabs_value) {
                $data['account_planning']['ap_tab'][$ap_tabs_value] = 'active';
                $data['account_planning']['ap_tab_content'][$ap_tabs_value] = ' active in';
              }
            }
        
            foreach ($ap_tab_contents as $ap_tab_contents_key => $ap_tab_contents_value) {
              $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = '';
              $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = '';
              if ($ap_tab_subcontent_get == $ap_tab_contents_value) {
                $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = 'active';
                $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = ' active in';
              }
              if (empty($ap_tab_subcontent_get)) {
                if ($ap_tab_contents_value == 'financial_highlights' || $ap_tab_contents_value == 'estimated_financial') {
                  $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = 'active';
                  $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = ' active in';
                }
              }
            }
        
            $data["firstTab"] = $ap_tab_get;
            $data["secondTab"] = $ap_tab_subcontent_get;
        
            //echo json_encode($data); die;
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('confirmation/account_planning_menengah/landing_view', $data);
            $this->load->view('layout/footer.php');
        }
        public function add_response_approver(){
            $this->checkModule();
            $accountPlanningMenengahId = $this->input->post("accountPlanningId");
            $documentStatusId = $this->input->post("documentStatusId");
            $comment = $this->input->post("comment");

            $accountPlanningStatus = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($accountPlanningMenengahId);
            if($accountPlanningStatus['DocumentStatusId'] == 2){
                switch($documentStatusId){
                    case 3: $isApproved = 1; break;
                    case 4: $isApproved = 2; break;
                    default: $isApproved = "";
                }
                $data = array(
                    "AccountPlanningMenengahId" => $accountPlanningMenengahId,
                    "DocumentStatusId" => $documentStatusId,
                    "Comment" => $comment,
                    "IsApproved" => $isApproved,
                    "UserId" => $this->session->PERSONAL_NUMBER,
                    "CurrentDate" => $this->current_datetime
                );
                $rsApprovalAccountPlanning = $this->ConfirmationAccountPlanningMenengah_model->approvalAccountPlanning($data);
                echo json_encode($rsApprovalAccountPlanning);
            }else{
                switch($documentStatusId){
                    case 3: $msg = "Failed to Approve Account Planning"; break;
                    case 4: $msg = "Failed to Reject Account Planning"; break;
                    default: $msg = "";
                }
                $result = array(
                    "status" => "error",
                    "message" => $msg
                );
				      echo json_encode($result);
            }            
        }
        public function services_get_company_information($apMenengahId, $CIF){
            $this->checkModule();
            $data = array();
            $data["apMenengahId"] = $apMenengahId;
        
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
        
            $rsDebiturOverview = $this->ManageAccountPlanning_model->getAccountPlanningDebiturOverview($apMenengahId, $CIF);
            $data["debiturOverview"] = $rsDebiturOverview;
        
            $totalShareholder = $this->ManageAccountPlanning_model->getTotalShareholder($apMenengahId, $CIF);
            $rsShareholder = $this->ManageAccountPlanning_model->getAccountPlanningShareholder($apMenengahId, $CIF);
            $indexShareholder = 0;
            foreach($rsShareholder as $row){
              $rsShareholder[$indexShareholder]["Color"] = $arrColors[$indexShareholder];
              $rsShareholder[$indexShareholder]["Portion"] = number_format($row["Value"] * 100 / $totalShareholder, 2);
              $indexShareholder++;
            }
            $data["shareholder"] = $rsShareholder;
        
            $rsBusinessProcess =  $this->ManageAccountPlanning_model->getAccountPlanningFileStructure($apMenengahId, $CIF, 1);
            $data["businessProcess"] = $rsBusinessProcess;
        
            $rsCompanyStructure =  $this->ManageAccountPlanning_model->getAccountPlanningFileStructure($apMenengahId, $CIF, 3);
            $data["companyStructure"] = $rsCompanyStructure;
        
            $rsStrategicPlan = $this->ManageAccountPlanning_model->getAccountPlanningStrategicPlan($apMenengahId, $CIF);
            $data["strategicPlan"] = $rsStrategicPlan;
        
            $rsCoverageMapping = $this->ManageAccountPlanning_model->getAccountPlanningCoverageMapping($apMenengahId, $CIF);
            $data["coverageMapping"] = $rsCoverageMapping;
            
            echo json_encode($data);
        }
        public function services_get_bri_starting_position($apMenengahId, $CIF){
            $this->checkModule();
            $data = array();
        
            /* Build Data For Financial Highlight */
              $arrYears = array(date('Y') - 3, date('Y') - 2, date('Y') - 1);
              $data["Years"] = $arrYears;
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
              
              $rsFinancialHighlightGroup = $this->ManageAccountPlanning_model->getFinancialHighlightGroup();
              foreach($rsFinancialHighlightGroup as $row){
                $financialHighlightGroupId = $row->FinancialHighlightGroupMenengahId;
                $rsFinancialHighlightItem = $this->ManageAccountPlanning_model->getFinancialHighlightItem($financialHighlightGroupId);
                $indexFinancialHighlightItem = 0;
                foreach($rsFinancialHighlightItem as $rowItem){
                  $arrFinancialHighlight = array();
                  foreach($arrYears as $year){
                    $rsFinancialHighlight = $this->ManageAccountPlanning_model->getFinancialHighlight($apMenengahId, $rowItem->FinancialHighlightItemMenengahId, $year);
                    if(!empty($rsFinancialHighlight)){
                      $arrFinancialHighlight[] = $rsFinancialHighlight[0]->Amount;
                    }else $arrFinancialHighlight[] = 0;            
                  }
                  $rowItem->FinancialHighlight = $arrFinancialHighlight;
                  $rowItem->Color = $arrColors[$indexFinancialHighlightItem];
                  $indexFinancialHighlightItem++;
                }
                $row->FinancialHighlightItem = $rsFinancialHighlightItem;
              }
              $data["FinancialHighlight"] = $rsFinancialHighlightGroup;
            
            /* Build Data For Facilities With Banking, Wallet Share and Competition Analysis */
              $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup();
              //$rsWalletShare = $rsFacilitiesBankingGroup;
              foreach($rsFacilitiesBankingGroup as $row){
                $bankFacilityGroupId = $row->BankFacilityGroupMenengahId;
        
                $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($bankFacilityGroupId);
                foreach($rsFacilitiesBankingItem as $rowItem){
                  $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
                  
                  $rsFacilitiesBanking = $this->ManageAccountPlanning_model->getFacilitiesBanking($apMenengahId, $bankFacilityItemId);
                  if(!empty($rsFacilitiesBanking)){
                    $arrBankFacility = array(
                      "IDRAmount" => $rsFacilitiesBanking[0]->IDRAmount,
                      "IDRRate" => $rsFacilitiesBanking[0]->IDRRate,
                      "ValasAmount" => $rsFacilitiesBanking[0]->ValasAmount,
                      "ValasRate" => $rsFacilitiesBanking[0]->ValasRate
                    );
                    $BRINominal = $rsFacilitiesBanking[0]->IDRAmount + $rsFacilitiesBanking[0]->ValasAmount;
                  }else{
                    $arrBankFacility = array(
                      "IDRAmount" => 0,
                      "IDRRate" => 0,
                      "ValasAmount" => 0,
                      "ValasRate" => 0
                    );
                    $BRINominal = 0;
                  }
                  $rowItem->BankFacility = $arrBankFacility;
        
                  $rsWalletShare = $this->ManageAccountPlanning_model->getWalletShare($apMenengahId, $bankFacilityItemId);
                  if(!empty($rsWalletShare)){
                    if($rsWalletShare[0]->TotalAmount == 0) $BRIPortion = 0;
                    else{
                      $BRIPortion = number_format(($BRINominal / $rsWalletShare[0]->TotalAmount) * 100 , 2);
                    }
                    $arrWalletShare = array(
                      "BRINominal" => $BRINominal,
                      "BRIPortion" => $BRIPortion,
                      "OtherNominal" => $rsWalletShare[0]->OtherNominal,
                      "TotalAmount" => $rsWalletShare[0]->TotalAmount
                    );
                  }else{
                    $arrWalletShare = array(
                      "BRINominal" => 0,
                      "BRIPortion" => 0,
                      "OtherNominal" => 0,
                      "TotalAmount" => 0
                    );
                  }
                  $rowItem->WalletShare = $arrWalletShare;
        
                  $rsCompetitionAnalysis = $this->ManageAccountPlanning_model->getCompetitionAnalysis($apMenengahId, $bankFacilityItemId);
                  if(!empty($rsCompetitionAnalysis)){
                    $arrCompetitionAnalysis = array(
                      "BankId1" => $rsCompetitionAnalysis[0]->BankId1,
                      "BankName1" => $rsCompetitionAnalysis[0]->BankName1,
                      "BankId2" => $rsCompetitionAnalysis[0]->BankId2,
                      "BankName2" => $rsCompetitionAnalysis[0]->BankName2,
                      "BankId3" => $rsCompetitionAnalysis[0]->BankId3,
                      "BankName3" => $rsCompetitionAnalysis[0]->BankName3
                    );
                  }else{
                    $arrCompetitionAnalysis = array(
                      "BankId1" => "",
                      "BankName1" => "",
                      "BankId2" => "",
                      "BankName2" => "",
                      "BankId3" => "",
                      "BankName3" => ""
                    );
                  }
                  $rowItem->CompetitionAnalysis = $arrCompetitionAnalysis;
                }
                $row->FacilitiesBankingItem = $rsFacilitiesBankingItem;
        
                $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($bankFacilityGroupId);
                foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
                  $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
        
                  $rsFacilitiesBankingAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingAddition($apMenengahId, $bankFacilityItemAdditionId);
                  if(!empty($rsFacilitiesBankingAddition)){
                    $arrBankFacilityAddition = array(
                      "IDRAmount" => $rsFacilitiesBankingAddition[0]->IDRAmount,
                      "IDRRate" => $rsFacilitiesBankingAddition[0]->IDRRate,
                      "ValasAmount" => $rsFacilitiesBankingAddition[0]->ValasAmount,
                      "ValasRate" => $rsFacilitiesBankingAddition[0]->ValasRate
                    );
                    $BRINominalAddition = $rsFacilitiesBankingAddition[0]->IDRAmount + $rsFacilitiesBankingAddition[0]->ValasAmount;
                  }else{
                    $arrBankFacilityAddition = array(
                      "IDRAmount" => 0,
                      "IDRRate" => 0,
                      "ValasAmount" => 0,
                      "ValasRate" => 0
                    );
                    $BRINominalAddition = 0;
                  }
                  $rowItemAddition->BankFacilityAddition = $arrBankFacilityAddition;
        
                  $rsWalletShareAddition = $this->ManageAccountPlanning_model->getWalletShareAddition($apMenengahId, $bankFacilityItemAdditionId);
                  if(!empty($rsWalletShareAddition)){
                    if($rsWalletShareAddition[0]->TotalAmount == 0) $BRIPortion = 0;
                    else{
                      $BRIPortion = number_format(($BRINominalAddition / $rsWalletShareAddition[0]->TotalAmount) * 100 , 2);
                    }
                    $arrWalletShareAddition = array(
                      "BRINominal" => $BRINominal,
                      "BRIPortion" => $BRIPortion,
                      "OtherNominal" => $rsWalletShareAddition[0]->OtherNominal,
                      "TotalAmount" => $rsWalletShareAddition[0]->TotalAmount
                    );
                  }else{
                    $arrWalletShareAddition = array(
                      "BRINominal" => 0,
                      "BRIPortion" => 0,
                      "OtherNominal" => 0,
                      "TotalAmount" => 0
                    );
                  }
                  $rowItemAddition->WalletShareAddition = $arrWalletShareAddition;
        
                  $rsCompetitionAnalysisAddition = $this->ManageAccountPlanning_model->getCompetitionAnalysisAddition($apMenengahId, $bankFacilityItemAdditionId);
                  if(!empty($rsCompetitionAnalysisAddition)){
                    $arrCompetitionAnalysisAddition = array(
                      "BankId1" => $rsCompetitionAnalysisAddition[0]->BankId1,
                      "BankName1" => $rsCompetitionAnalysisAddition[0]->BankName1,
                      "BankId2" => $rsCompetitionAnalysisAddition[0]->BankId2,
                      "BankName2" => $rsCompetitionAnalysisAddition[0]->BankName2,
                      "BankId3" => $rsCompetitionAnalysisAddition[0]->BankId3,
                      "BankName3" => $rsCompetitionAnalysisAddition[0]->BankName3
                    );
                  }else{
                    $arrCompetitionAnalysisAddition = array(
                      "BankId1" => "",
                      "BankName1" => "",
                      "BankId2" => "",
                      "BankName2" => "",
                      "BankId3" => "",
                      "BankName3" => ""
                    );
                  }
                  $rowItemAddition->CompetitionAnalysisAddition = $arrCompetitionAnalysisAddition;
                }
                $row->FacilitiesBankingItemAddition = $rsFacilitiesBankingItemAddition;
              }
              $data["FacilitiesBanking"] = $rsFacilitiesBankingGroup;
        
            /* Build Data For Wallet Share */
              echo json_encode($data);
        }
        public function services_get_client_needs($apMenengahId){
            $this->checkModule();
            $data = array();
        
            $rsFundings = $this->ManageAccountPlanning_model->getFundings($apMenengahId);
            $data["Fundings"] = $rsFundings;
        
            $rsServices = $this->ManageAccountPlanning_model->getServices($apMenengahId);
            foreach($rsServices as $row){
              $ServiceMenengahId = $row->ServiceMenengahId;
              $rsUnitKerjaTag = $this->ManageAccountPlanning_model->getUnitKerjaTag($ServiceMenengahId);
              $arrUnitKerjaTag = array();
              foreach($rsUnitKerjaTag as $rows){
                array_push($arrUnitKerjaTag, $rows->Name);
              }
              $row->UnitKerjaTag = $arrUnitKerjaTag;
            }
            $data["Services"] = $rsServices;
        
            echo json_encode($data);
        }
        public function services_get_action_plans($apMenengahId){
            $this->checkModule();
            $data = array();
        
            $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup();
            foreach($rsFacilitiesBankingGroup as $row){
              $bankFacilityGroupId = $row->BankFacilityGroupMenengahId;
        
              $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($bankFacilityGroupId);
              foreach($rsFacilitiesBankingItem as $rowItem){
                $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
                $rsEstimatedFinancial = $this->ManageAccountPlanning_model->getEstimatedFinancial($apMenengahId, $bankFacilityItemId);
                if(!empty($rsEstimatedFinancial)){
                  if ($rsEstimatedFinancial[0]->IDRProjection >= $rsEstimatedFinancial[0]->IDRTarget) {
                    if($rsEstimatedFinancial[0]->IDRTarget != 0){
                      $IDRProgressValue   = number_format(($rsEstimatedFinancial[0]->IDRTarget / $rsEstimatedFinancial[0]->IDRProjection) * 100, 1);
                    }else{
                      $IDRProgressValue   = 0;
                    }
                    $IDRProgressBar       = $IDRProgressValue;
                  }
                  elseif ($rsEstimatedFinancial[0]->IDRProjection < $rsEstimatedFinancial[0]->IDRTarget) {
                    $IDRProgressValue     = 100;
                    $IDRProgressBar       = 100;
                  }
                  if ($rsEstimatedFinancial[0]->ValasProjection >= $rsEstimatedFinancial[0]->ValasTarget) {
                    if($rsEstimatedFinancial[0]->ValasTarget != 0){
                      $ValasProgressValue   = number_format(($rsEstimatedFinancial[0]->ValasTarget / $rsEstimatedFinancial[0]->ValasProjection) * 100, 1);
                    }else{
                      $ValasProgressValue   = 0;
                    }
                    $ValasProgressBar     = $ValasProgressValue;
                  }
                  elseif ($rsEstimatedFinancial[0]->ValasProjection < $rsEstimatedFinancial[0]->ValasTarget) {
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
                }else{
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
        
              $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($bankFacilityGroupId);
              foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
                $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
                $rsEstimatedFinancialAddition = $this->ManageAccountPlanning_model->getEstimatedFinancialAddition($apMenengahId, $bankFacilityItemAdditionId);
                if(!empty($rsEstimatedFinancialAddition)){
                  if ($rsEstimatedFinancialAddition[0]->IDRProjection >= $rsEstimatedFinancialAddition[0]->IDRTarget) {
                    if($rsEstimatedFinancialAddition[0]->IDRTarget != 0){
                      $IDRProgressValue     = number_format(($rsEstimatedFinancialAddition[0]->IDRTarget / $rsEstimatedFinancialAddition[0]->IDRProjection) * 100, 1);
                    }else{
                      $IDRProgressValue   = 0;
                    }
                    $IDRProgressBar       = $IDRProgressValue;
                  }
                  elseif ($rsEstimatedFinancialAddition[0]->IDRProjection < $rsEstimatedFinancialAddition[0]->IDRTarget) {
                    $IDRProgressValue     = 100;
                    $IDRProgressBar       = 100;
                  }
                  if ($rsEstimatedFinancialAddition[0]->ValasProjection >= $rsEstimatedFinancialAddition[0]->ValasTarget) {
                    if($rsEstimatedFinancial[0]->IDRTarget != 0){
                      $ValasProgressValue   = number_format(($rsEstimatedFinancialAddition[0]->ValasTarget / $rsEstimatedFinancialAddition[0]->ValasProjection) * 100, 1);
                    }else{
                      $ValasProgressValue   = 0;
                    }
                    $ValasProgressBar     = $ValasProgressValue;
                  }
                  elseif ($rsEstimatedFinancialAddition[0]->ValasProjection < $rsEstimatedFinancialAddition[0]->ValasTarget) {
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
                }else{
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
            $data["FacilitiesBanking"] = $rsFacilitiesBankingGroup;
        
            $rsInitiativeAction = $this->ManageAccountPlanning_model->getInitiativeAction($apMenengahId);
            foreach($rsInitiativeAction as $row){
              $dateTimePeriod = new DateTime(date($row->Period.'-01'));
              $row->DateTimePeriod = $dateTimePeriod->format('F Y');
            }
            $data["InitiativeAction"] = $rsInitiativeAction;
        
            echo json_encode($data);
        }
    }
?>