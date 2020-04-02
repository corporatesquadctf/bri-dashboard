<?php

class Approve extends MY_Controller {

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
		$this->load->model('TasklistDisposisi_model');
		$this->load->model('TasklistAccountPlanning_model');
		$this->load->model('ApproveAccountPlanning_model');
		$this->load->model('PerformanceAccountPlanning_model');
		$this->load->model('DataTransaction_model');
		$this->load->model('MonitoringAccountPlanning_model');

		$current_datetime = new DateTime(date('Y-m-d H:i:s'));
		$this->current_year = $current_datetime->format('Y');
		$this->current_date = $current_datetime->format('Y-m-d');
		$this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
	  }

	public function index($rowno=0) {
	    $this->checkModule();

	    $params = array();
	    $limit_per_page = 5;
	    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	    $total_records = $this->ApproveAccountPlanning_model->getTotalViewApproveAccountPlanning($this->session->PERSONAL_NUMBER, '', '', $this->current_year, '');
	    if ($total_records > 0) {   
	      $ap_Tasklist = $this->ApproveAccountPlanning_model->getViewApproveAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, '', '', $this->current_year, '');

	      foreach ($ap_Tasklist as $ap_row) {
	        $CustomerGroupId = $ap_row['CustomerGroupId'];
	        $AccountPlanningId = $ap_row['AccountPlanningId'];
	        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
	        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
	        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
	        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
	        $ap_year_color = '#218FD8';
	        if ($ap_row['Year'] != $this->current_year) {
	          $ap_year_color = '#F58C38';
	        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],
		          'PinjamanTotalGroup'              => number_format($ap_row['PinjamanTotalGroup']),
		          'PinjamanRatasGroup'              => number_format($ap_row['PinjamanRatasGroup']),
		          'SimpananTotalGroup'              => number_format($ap_row['SimpananTotalGroup']),
		          'SimpananRatasGroup'              => number_format($ap_row['SimpananRatasGroup']),
		          'CurrentCPAGroup'                 => number_format($ap_row['CurrentCPAGroup']),
		          'ValueChainGroup'                 => number_format($ap_row['ValueChainGroup']),
		          'PinjamanTotalAP'                 => number_format($ap_row['PinjamanTotalAP']),
		          'PinjamanRatasAP'                 => number_format($ap_row['PinjamanRatasAP']),
		          'SimpananTotalAP'                 => number_format($ap_row['SimpananTotalAP']),
		          'SimpananRatasAP'                 => number_format($ap_row['SimpananRatasAP']),
		          'CurrentCPAAP'                    => number_format($ap_row['CurrentCPAAP']),
		          'ValueChainAP'                    => number_format($ap_row['ValueChainAP']),
		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
	      }
	      $params['row'] = $rowno;

	      $config['base_url'] = base_url() . 'tasklist/AccountPlanning/page';
	      $config['use_page_numbers'] = TRUE;
	      $config['total_rows'] = $total_records;
	      $config['per_page'] = $limit_per_page;
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


	    $this->load->view('layout/header.php');
	    $this->load->view('layout/side-nav.php');
	    $this->load->view('layout/top-nav.php');
	    $this->load->view('tasklist/account_planning_approve.php', $params);
	    $this->load->view('layout/footer.php');
	}
	
	public function page($rowno=0) {
		$this->checkModule();

		$params = array();
		$limit_per_page = 5;
		if($rowno != 0){
		  $rowno = ($rowno-1) * $limit_per_page;
		}
		$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$total_records = $this->TasklistAccountPlanning_model->getTotalViewTasklistAccountPlanning($this->session->PERSONAL_NUMBER, '', '', $this->current_year, '');
		if ($total_records > 0) {   
		  $ap_Tasklist = $this->TasklistAccountPlanning_model->getViewTasklistAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, '', '', $this->current_year, '');

		  foreach ($ap_Tasklist as $ap_row) {
		    $CustomerGroupId = $ap_row['CustomerGroupId'];
		    $AccountPlanningId = $ap_row['AccountPlanningId'];
		    $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		    $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		    $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		    $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
		    $ap_year_color = '#218FD8';
		    if ($ap_row['Year'] != $this->current_year) {
		      $ap_year_color = '#F58C38';
		    }
		    $params['results'][$AccountPlanningId] = array(
		      'AccountPlanningId'               => $AccountPlanningId,
		      'Currency'                        => $ap_row['Currency'],
		      'CreatedDate'                     => $ap_row['CreatedDate'],
		      'Year'                            => $ap_row['Year'],
		      'ap_year_color'                   => $ap_year_color,
		      'CustomerGroupId'                 => $ap_row['CustomerGroupId'],
		      'CustomerName'                    => $ap_row['CustomerName'],
		      'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		      'RMName'                          => $ap_row['RMName'],
		      'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		      'Status'                          => $account_planning_status['Status'],
		      'PinjamanTotalGroup'              => number_format($ap_row['PinjamanTotalGroup']),
		      'PinjamanRatasGroup'              => number_format($ap_row['PinjamanRatasGroup']),
		      'SimpananTotalGroup'              => number_format($ap_row['SimpananTotalGroup']),
		      'SimpananRatasGroup'              => number_format($ap_row['SimpananRatasGroup']),
		      'CurrentCPAGroup'                 => number_format($ap_row['CurrentCPAGroup']),
		      'ValueChainGroup'                 => number_format($ap_row['ValueChainGroup']),
		      'PinjamanTotalAP'                 => number_format($ap_row['PinjamanTotalAP']),
		      'PinjamanRatasAP'                 => number_format($ap_row['PinjamanRatasAP']),
		      'SimpananTotalAP'                 => number_format($ap_row['SimpananTotalAP']),
		      'SimpananRatasAP'                 => number_format($ap_row['SimpananRatasAP']),
		      'CurrentCPAAP'                    => number_format($ap_row['CurrentCPAAP']),
		      'ValueChainAP'                    => number_format($ap_row['ValueChainAP']),
		      'account_planning_member'         => $account_planning_member,
		      'rm_selected'                     => $rm_selected,
		      'account_planning_vcif_list'      => $account_planning_vcif_list
		    );
		  }
		  $params['row'] = $rowno;

		  $config['base_url'] = base_url() . 'tasklist/AccountPlanning/page';
		  $config['use_page_numbers'] = TRUE;
		  $config['total_rows'] = $total_records;
		  $config['per_page'] = $limit_per_page;
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

		$this->load->view('layout/header.php');
		$this->load->view('layout/side-nav.php');
		$this->load->view('layout/top-nav.php');
		$this->load->view('tasklist/account_planning_list.php', $params);
		$this->load->view('layout/footer.php');
	}

	public function detail($AccountPlanningId) {
	    $this->checkModule();
	    // $this->checkStatus($AccountPlanningId);
	    // $this->checkOwner($AccountPlanningId);

	    $ap_tab_get = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'company_information';
	    $ap_tab_subcontent_get = ($this->uri->segment(6)) ? $this->uri->segment(6) : '';

	    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);
	    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

	    $data['account_planning']['Clasifications'] = 'Gold';
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
	    $ap_tabs = array (
	        'company_information'
	        , 'bri_starting_position'
	        , 'client_needs'
	        , 'action_plans'
	        , 'cpa'
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

	    /* Start of Company Information Tab */
	    $rsAssignedCompany = $this->TasklistAccountPlanning_model->getSelectedCompanyOption($AccountPlanningId);
	    $data['account_planning']['AssignedCompany'] = $rsAssignedCompany;
	    //$data['account_planning']['GroupOverview'] = $this->PerformanceAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId);

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
	    
	    for($i=0; $i<count($rsAssignedCompany); $i++){
	      $data['account_planning']['GroupOverview'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
	      $data['account_planning']['StrategicPlan'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningStrategicPlan($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
	      $data['account_planning']['CoverageMapping'][$i] = $this->TasklistAccountPlanning_model->getAccountPlanningCoverageMapping($AccountPlanningId, $rsAssignedCompany[$i]->VCIF);
	      
	      /*
	      $rsBusinessProcess = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 1, $rsAssignedCompany[$i]->VCIF);
	      $rsAssignedCompany[$i]->BusinessProcess = $rsBusinessProcess;
	      
	      $rsCompanyStructure = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 3, $rsAssignedCompany[$i]->VCIF);
	      $rsAssignedCompany[$i]->CompanyStructure = $rsCompanyStructure;
	    
	      */
	      $data['account_planning']['FileStructure']['1'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 1);
	      $data['account_planning']['FileStructure']['2'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 2);
	      $data['account_planning']['FileStructure']['3'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 3);
	    
	    }

	    $rsCSTMember = $this->TasklistAccountPlanning_model->getCSTMember($AccountPlanningId);
	    $data['account_planning']['CSTMember'] = $rsCSTMember;
	    
	    /*
	    $data['account_planning']['FileStructure']['1'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 1, $rsAssignedCompany[$i]->VCIF);
	    $data['account_planning']['FileStructure']['2'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 2);
	    $data['account_planning']['FileStructure']['3'] = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 3, $rsAssignedCompany[$i]->VCIF);
	    */
	    /* End of Company Information Tab */

	    //echo json_encode($data); die();

	    // GroupOverview
	    //$data['account_planning']['GroupOverview'] = $this->PerformanceAccountPlanning_model->getAccountPlanningGroupOverview($AccountPlanningId);

	    // Shareholder
	    /*
	    $dataShareholder = $this->PerformanceAccountPlanning_model->getAccountPlanningShareholder($AccountPlanningId);
	    $data['account_planning']['Shareholder'] = $dataShareholder;
	    foreach ($dataShareholder as $key => $value) {
	      $data['account_planning']['Shareholder2']['labels'][] = $value['Name'];
	      $data['account_planning']['Shareholder2']['Quantity'][] = $value['Quantity'];
	      $data['account_planning']['Shareholder2']['values'][] = $value['Quantity'];
	    }
	    */

	    // FinancialHighlight
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

	      $dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlight($AccountPlanningId, $value['FinancialHighlightItemId']);

	      $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']][0] = array(
	        'FinancialHighlightGroupId'       => $value['FinancialHighlightGroupId']
	        , 'FinancialHighlightGroupName'   => $value['FinancialHighlightGroupName']
	        , 'heading_panel'                 => $heading_panel
	        , 'tab_panel'                     => $tab_panel
	        , 'expanded_panel'                => $expanded_panel
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
	            'FinancialHighlightItemId'              => 0
	            , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
	          );
	      }
	      else {
	        $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']]['FinancialHighlight_details'][$value['FinancialHighlightItemId']][0] = array(
	            'FinancialHighlightItemId'              => 0
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
	                  , 'Amount'                        => number_format($values['Amount'])
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
	      $heading_panel = ' collapse';
	      if ($value['BankFacilityGroupId'] == 1) {
	        $heading_panel = '';
	      }
	      $tab_panel = ' collapse';
	      if ($value['BankFacilityGroupId'] == 1) {
	        $tab_panel = ' collapse in';
	      }
	      $expanded_panel = 'false';
	      if ($value['BankFacilityGroupId'] == 1) {
	        $expanded_panel = 'true';
	      }     

	    // Facilities Banking
	      $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']][0] = array(
	        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
	        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
	        , 'heading_panel'         => $heading_panel
	        , 'tab_panel'             => $tab_panel
	        , 'expanded_panel'        => $expanded_panel
	        );

	      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
	        $dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);

	        $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
	          'BankFacilityId'          => 0
	          , 'BankFacilityItemName'  => $value['BankFacilityItemName']
	          , 'IDRAmount'             => 0
	          , 'IDRRate'               => 0
	          , 'ValasAmount'           => 0
	          , 'ValasRate'             => 0
	          );

	        if (is_array($dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
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

	      // facilities banking Addition
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

	      }
	     
	    // Estimated Financial
	      $data['account_planning']['EstimatedFinancial'][$value['BankFacilityGroupId']][0] = array(
	        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
	        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
	        , 'heading_panel'         => $heading_panel
	        , 'tab_panel'             => $tab_panel
	        , 'expanded_panel'        => $expanded_panel
	        );

	      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
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
	              $IDRProgressValue     = number_format(($values['IDRProjection'] / $values['IDRTarget']) * 100, 1);
	              $IDRProgressBar       = 100;
	            }
	            else if ($values['IDRProjection'] < $values['IDRTarget']) {
	              $IDRProgressValue     = number_format(($values['IDRProjection'] / $values['IDRTarget']) * 100, 1);
	              $IDRProgressBar       = $IDRProgressValue;
	            }
	            if ($values['ValasProjection'] > $values['ValasTarget']) {
	              $ValasProgressValue   = number_format(($values['ValasProjection'] / $values['ValasTarget']) * 100, 1);
	              $ValasProgressBar     = 100;
	            }
	            else if ($values['ValasProjection'] < $values['ValasTarget']) {
	              $ValasProgressValue   = number_format(($values['ValasProjection'] / $values['ValasTarget']) * 100, 1);
	              $ValasProgressBar     = $ValasProgressValue;
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
	                  $IDRProgressAdditionValue     = number_format(($EstimatedFinancialAddition['IDRProjectionAddition'] / $EstimatedFinancialAddition['IDRTargetAddition']) * 100, 1);
	                  $IDRProgressAdditionBar       = 100;
	                }
	                else if ($EstimatedFinancialAddition['IDRProjectionAddition'] < $EstimatedFinancialAddition['IDRTargetAddition']) {
	                  $IDRProgressAdditionValue     = number_format(($EstimatedFinancialAddition['IDRProjectionAddition'] / $EstimatedFinancialAddition['IDRTargetAddition']) * 100, 1);
	                  $IDRProgressAdditionBar       = $IDRProgressAdditionValue;
	                }

	                if ($EstimatedFinancialAddition['ValasProjectionAddition'] > $EstimatedFinancialAddition['ValasTargetAddition']) {
	                  $ValasProgressAdditionValue   = number_format(($EstimatedFinancialAddition['ValasProjectionAddition'] / $EstimatedFinancialAddition['ValasTargetAddition']) * 100, 1);
	                  $ValasProgressAdditionBar     = 100;
	                }
	                else if ($EstimatedFinancialAddition['ValasProjectionAddition'] < $EstimatedFinancialAddition['ValasTargetAddition']) {
	                  $ValasProgressAdditionValue   = number_format(($EstimatedFinancialAddition['ValasProjectionAddition'] / $EstimatedFinancialAddition['ValasTargetAddition']) * 100, 1);
	                  $ValasProgressAdditionBar     = $ValasProgressAdditionValue;
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

	    // Wallet Share
	      $dataWalletShare[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($AccountPlanningId, $value['BankFacilityItemId']);

	      $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']][0] = array(
	        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
	        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
	        , 'heading_panel'         => $heading_panel
	        , 'tab_panel'             => $tab_panel
	        , 'expanded_panel'        => $expanded_panel
	        );

	      $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$value['BankFacilityItemId']] = array(
	        'WalletShareId'           => 0
	        , 'BankFacilityItemName'  => $value['BankFacilityItemName']
	        , 'BRINominal'            => 0
	        , 'BRIPortion'            => 0
	        , 'OtherNominal'          => 0
	        , 'OtherPortion'          => 0
	        , 'TotalAmount'           => 0
	        );

	      if (is_array($dataWalletShare[$value['BankFacilityGroupId']])) {
	        foreach ($dataWalletShare[$value['BankFacilityGroupId']] as $keys => $values) {
	          $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$value['BankFacilityItemId']] = array(
	            'WalletShareId'           => $values['WalletShareId']
	            , 'BankFacilityItemName'  => $value['BankFacilityItemName']
	            , 'BRINominal'            => number_format($values['BRINominal']/VALUE_PER)
	            , 'BRIPortion'            => $values['BRIPortion']
	            , 'OtherNominal'          => number_format($values['OtherNominal']/VALUE_PER)
	            , 'OtherPortion'          => $values['OtherPortion']
	            , 'TotalAmount'           => number_format($values['TotalAmount']/VALUE_PER)
	            );
	        }
	      }

	    // competitionAnalys
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
	    }

	    if (!empty($data['account_planning_vcif_list'])) {
	      foreach ($data['account_planning_vcif_list'] as $key => $valuess) {
	      // Initiative Action
	        $data['account_planning']['InitiativeAction'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningInitiativeAction($AccountPlanningId, $valuess['VCIF']);
	        foreach ($data['account_planning']['InitiativeAction'][$valuess['VCIF']] as $keys => $values) {
	          $dataDateTimePeriod[$keys]['DateTimePeriod'] = new DateTime(date($values['Period'].'-01'));
	          $data['account_planning']['InitiativeAction'][$valuess['VCIF']][$keys]['DateTimePeriod'] = $dataDateTimePeriod[$keys]['DateTimePeriod']->format('F Y');
	        }

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
	      }
	    }

	    $this->load->view('layout/header.php');
	    $this->load->view('layout/side-nav.php');
	    $this->load->view('layout/top-nav.php');
	    $this->load->view('tasklist/account_planning_detail_approve.php', $data);
	    $this->load->view('layout/footer.php');
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


}

?>


