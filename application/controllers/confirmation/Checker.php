<?php

class Checker extends MY_Controller {

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
		$this->load->model('ConfirmationAccountPlanning_model');
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
		$params['confirmation_user'] = 'Checker';
		$params['history'] = NULL;
	    $limit_per_page = 5;
	    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
	    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
	    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
	    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
	    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
	    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
	    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
	    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

	    $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER);
	    if ($total_records > 0) {   
	      	$ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno);

	      	foreach ($ap_Tasklist as $ap_row) {
		        $CustomerGroupId = $ap_row['CustomerGroupId'];
		        $AccountPlanningId = $ap_row['AccountPlanningId'];
		        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($AccountPlanningId);
				$SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($AccountPlanningId);
		        $ap_year_color = '#218FD8';

		        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
		        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
		        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

		        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
		        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
		        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

		        if ($ap_row['Year'] != $this->current_year) {
		          $ap_year_color = '#F58C38';
		        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningChecker'          => $ap_row['AccountPlanningChecker'],
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'Logo'                            => $ap_row['Logo'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],

		          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

		          'PinjamanTotalAP'                 => number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasAP'                 => number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalAP'                 => number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasAP'                 => number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAAP'                    => number_format($cpaAp['Cpa']/VALUE_PER, 0),

		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'CheckerList'                   	=> $CheckerList,
		          'SignerList'                   	=> $SignerList,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
			}
			$params['row'] = $rowno;

			$config['base_url'] = base_url() . 'confirmation/Checker/page';
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
	    $this->load->view('confirmation/account_planning_confirm.php', $params);
	    $this->load->view('layout/footer.php');
	}
	
	public function page($rowno=0) {
		$this->checkModule();

		$params = array();
		$params['confirmation_user'] = 'Checker';
		$params['history'] = NULL;
		$limit_per_page = 5;
		if($rowno != 0){
		  $rowno = ($rowno-1) * $limit_per_page;
		}
		$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

	    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
	    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
	    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
	    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
	    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
	    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
	    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
	    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

	    $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER);
	    if ($total_records > 0) {   
	      	$ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno);

	      	foreach ($ap_Tasklist as $ap_row) {
		        $CustomerGroupId = $ap_row['CustomerGroupId'];
		        $AccountPlanningId = $ap_row['AccountPlanningId'];
		        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($AccountPlanningId);
				$SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($AccountPlanningId);

		        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
		        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
		        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

		        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
		        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
		        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

		        $ap_year_color = '#218FD8';
		        if ($ap_row['Year'] != $this->current_year) {
		          $ap_year_color = '#F58C38';
		        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningChecker'          => $ap_row['AccountPlanningChecker'],
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'Logo'                            => $ap_row['Logo'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],

		          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

		          'PinjamanTotalAP'                 => number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasAP'                 => number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalAP'                 => number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasAP'                 => number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAAP'                    => number_format($cpaAp['Cpa']/VALUE_PER, 0),

		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'CheckerList'                   	=> $CheckerList,
		          'SignerList'                   	=> $SignerList,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
			}
			$params['row'] = $rowno;

			$config['base_url'] = base_url() . 'confirmation/Checker/page';
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
	    $this->load->view('confirmation/account_planning_confirm.php', $params);
		$this->load->view('layout/footer.php');
	}

	public function search($searchTxt='', $rowno=0) {
	    $this->checkModule();

	    $params = array();
		$params['confirmation_user'] = 'Checker';
		$params['history'] = NULL;

	    if (empty($searchTxt)) {
	      $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
	    }
	    else {
	      $searchTxt = str_replace('_', ' ', $searchTxt);
	    }

	    if(empty(trim($searchTxt))) {
	      header("location:".base_url() . "confirmation/Checker");
	    }

	    $params['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));

	    $limit_per_page = 5;
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $limit_per_page;
	    }
	    $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

	    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
	    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
	    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
	    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
	    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
	    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
	    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
	    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];	

	    $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $searchTxt);
	    if ($total_records > 0) {   
	      	$ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $searchTxt);

	      	foreach ($ap_Tasklist as $ap_row) {
		        $CustomerGroupId = $ap_row['CustomerGroupId'];
		        $AccountPlanningId = $ap_row['AccountPlanningId'];
		        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($AccountPlanningId);
				$SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($AccountPlanningId);

		        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
		        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
		        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

		        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
		        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
		        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

		        $ap_year_color = '#218FD8';
		        if ($ap_row['Year'] != $this->current_year) {
		          $ap_year_color = '#F58C38';
		        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningChecker'          => $ap_row['AccountPlanningChecker'],
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'Logo'                            => $ap_row['Logo'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],

		          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

		          'PinjamanTotalAP'                 => number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasAP'                 => number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalAP'                 => number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasAP'                 => number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAAP'                    => number_format($cpaAp['Cpa']/VALUE_PER, 0),

		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'CheckerList'                   	=> $CheckerList,
		          'SignerList'                   	=> $SignerList,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
			}
			$params['row'] = $rowno;

			$config['base_url'] = base_url() . 'confirmation/Checker/search/'.$params['searchTxt'];
			$config['use_page_numbers'] = TRUE;
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 5;
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
	    $this->load->view('confirmation/account_planning_confirm.php', $params);
		$this->load->view('layout/footer.php');	    	
	}

  	public function view($AccountPlanningId, $AccountPlanningTabType='', $AccountPlanningTab='') {
	    $this->checkModule();
	    // $this->checkAPInputStatus($AccountPlanningId);
	    // $this->checkOwner($AccountPlanningId);

	    $data['confirmation_user'] 	= 'Checker';
	    $data['confirmation_table'] = 'AccountPlanningChecker';
	    $data['confirmation_table_id'] = 'AccountPlanningChecker';
	    $data['confirmation_docstatus_id'] = 2;

	    $ap_breadcrumb_title = 'View';
	    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
	    $ap_tab_get = ($AccountPlanningTab) ? $AccountPlanningTab : 'company_information';
	    $ap_tab_subcontent_get = ($this->uri->segment(7)) ? $this->uri->segment(7) : '';

	    $data['ap_breadcrumb_title']                  = $ap_breadcrumb_title;
	    $data['AccountPlanningId']                    = $AccountPlanningId;
	    $data['AccountPlanningTabType']               = $ap_tab_type_get;
	    $data['AccountPlanningTab']                   = $ap_tab_get;
	    $data['AccountPlanningTabSubcontent']         = $ap_tab_subcontent_get;
	    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);
	    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
	    $data['account_planning']['Clasifications'] = 'Gold';

	    $ap_tabs = array (
	        'company_information'
	        , 'bri_starting_position'
	        , 'client_needs'
	        , 'action_plans'
	        , 'simulation'
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

	    $this->load->view('layout/header.php');
	    $this->load->view('layout/side-nav.php');
	    $this->load->view('layout/top-nav.php');
	    $this->load->view('confirmation/account_planning_detail_confirm.php', $data);
	    // $this->load->view('tasklist/account_planning_ajax.php', $data);
	    $this->load->view('layout/footer.php');
  	}

	public function add_CheckerSignerResponse() {
		if (!empty($this->input->post('confirmation_table_id')) && !empty($this->input->post('AccountPlanningId'))) {
	        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($this->input->post('AccountPlanningId'));
			$CheckerDetail = $this->ConfirmationAccountPlanning_model->getCheckerDetail($this->input->post('AccountPlanningId'), $this->session->PERSONAL_NUMBER);
	        if ($account_planning_status['DocumentStatusId'] == 2 && empty($CheckerDetail['IsApproved'])) {
				$IsApproved = 1;
				$DocumentStatusId = 3;
				if ($this->input->post('confirmation_response') == 'Reject') {
					$IsApproved = 2;
					$DocumentStatusId = 5;
				}
				$data_form = array (
					'ConfirmationTable'               => $this->input->post('ConfirmationTable')
					, 'ConfirmationTableIdField'      => 'AccountPlanningChecker'
					, 'ConfirmationTableIdValue'      => $this->input->post('confirmation_table_id')
				);
	            $data_update = array (
	              'IsApproved'		      => $IsApproved
	              , 'Comment'             => $this->input->post('Comment')
	              , 'ModifiedDate'        => $this->current_datetime
	              , 'ModifiedBy'          => $this->session->PERSONAL_NUMBER
	            );

				$updateData = $this->TasklistAccountPlanning_model->updateData($data_form['ConfirmationTable'], $data_update, $data_form['ConfirmationTableIdField'], $data_form['ConfirmationTableIdValue']);

			    echo json_encode($updateData);

				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($this->input->post('AccountPlanningId'));
				foreach ($CheckerList as $key => $value) {
					if (!empty($value['IsApproved'])) {
						$IsApprovedConfirmed[$key] = $value['IsApproved'];
					}
				}
				$CheckerList_count = count($CheckerList);
				$IsApprovedConfirmed_count = count($IsApprovedConfirmed);

				if ($DocumentStatusId == 5) {
		            $data_insert = array (
		              'DocumentStatusId'		=> $DocumentStatusId
		              , 'AccountPlanningId'     => $this->input->post('AccountPlanningId')
		              , 'Comment'            	=> $this->input->post('Comment')
		              , 'CreatedDate'        	=> $this->current_datetime
		              , 'CreatedBy'          	=> $this->session->PERSONAL_NUMBER
		            );
				}
				elseif ($CheckerList_count == $IsApprovedConfirmed_count) {
		            $data_insert = array (
		              'DocumentStatusId'		=> $DocumentStatusId
		              , 'AccountPlanningId'     => $this->input->post('AccountPlanningId')
		              , 'Comment'            	=> $this->input->post('Comment')
		              , 'CreatedDate'        	=> $this->current_datetime
		              , 'CreatedBy'          	=> $this->session->PERSONAL_NUMBER
		            );
				}

				if (!empty($data_insert)) {
					$insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_insert);
					if($DocumentStatusId == 5)
						$this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->input->post('AccountPlanningId'), 'Approval Checker', 'Rejected by checker: '.$this->input->post('Comment'), $_SESSION['PERSONAL_NUMBER']);
					else
						$this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->input->post('AccountPlanningId'), 'Approval Checker', 'Approved by checker: '. $this->input->post('Comment'), $_SESSION['PERSONAL_NUMBER']);
				}
	        }
	        else {
                $result = array(
                    'status' => 'error',
                    'message'=> 'Approval Failed'
                );
				echo json_encode($result);	        	
	        }
		}
	}

	public function history($rowno=0) {
	    $this->checkModule();

	    $params = array();
		$params['confirmation_user'] = 'Checker';
		$params['history'] = 1;

		$searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";

	    $params['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));

	    $limit_per_page = 5;
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $limit_per_page;
	    }
	    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

	    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
	    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
	    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
	    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
	    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
	    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
	    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
	    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

	    $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $params['searchTxt'], '', '', '', 1);
	    if ($total_records > 0) {   
	      	$ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $params['searchTxt'], '', '', '', 1);

	      	foreach ($ap_Tasklist as $ap_row) {
		        $CustomerGroupId = $ap_row['CustomerGroupId'];
		        $AccountPlanningId = $ap_row['AccountPlanningId'];
		        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($AccountPlanningId);
				$SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($AccountPlanningId);
		        $ap_year_color = '#218FD8';

		        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
		        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
		        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

		        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
		        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
		        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

		        if ($ap_row['Year'] != $this->current_year) {
		          $ap_year_color = '#F58C38';
		        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningChecker'          => $ap_row['AccountPlanningChecker'],
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'Logo'                            => $ap_row['Logo'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],

		          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

		          'PinjamanTotalAP'                 => number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasAP'                 => number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalAP'                 => number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasAP'                 => number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAAP'                    => number_format($cpaAp['Cpa']/VALUE_PER, 0),

		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'CheckerList'                   	=> $CheckerList,
		          'SignerList'                   	=> $SignerList,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
			}
			$params['row'] = $rowno;

			$config['base_url'] = base_url() . 'confirmation/Checker/history';
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
	    $this->load->view('confirmation/account_planning_confirm.php', $params);
	    $this->load->view('layout/footer.php');
	}

	public function history_search($searchTxt='', $rowno=0) {
	    $this->checkModule();

	    $params = array();
		$params['confirmation_user'] = 'Checker';
		$params['history'] = 1;

	    if (empty($searchTxt)) {
	      $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
	    }
	    else {
	      $searchTxt = str_replace('_', ' ', $searchTxt);
	    }

	    if(empty(trim($searchTxt))) {
	      header("location:".base_url() . "confirmation/Checker/history");
	    }

	    $params['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));

	    $limit_per_page = 5;
	    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
	    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
	    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
	    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
	    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
	    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
	    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
	    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

	    $total_records = $this->ConfirmationAccountPlanning_model->getTotalViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $searchTxt, '', '', '', 1);
	    if ($total_records > 0) {   
	      	$ap_Tasklist = $this->ConfirmationAccountPlanning_model->getViewCheckerAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $searchTxt, '', '', '', 1);

	      	foreach ($ap_Tasklist as $ap_row) {
		        $CustomerGroupId = $ap_row['CustomerGroupId'];
		        $AccountPlanningId = $ap_row['AccountPlanningId'];
		        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
		        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
		        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
		        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
				$CheckerList = $this->ConfirmationAccountPlanning_model->getCheckerList($AccountPlanningId);
				$SignerList = $this->ConfirmationAccountPlanning_model->getSignerList($AccountPlanningId);
		        $ap_year_color = '#218FD8';

		        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
		        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
		        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

		        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
		        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
		        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

		        if ($ap_row['Year'] != $this->current_year) {
		          $ap_year_color = '#F58C38';
		        }
		        $params['results'][$AccountPlanningId] = array(
		          'AccountPlanningChecker'          => $ap_row['AccountPlanningChecker'],
		          'AccountPlanningId'               => $AccountPlanningId,
		          'Currency'                        => $ap_row['Currency'],
		          'CreatedDate'                     => $ap_row['CreatedDate'],
		          'Year'                            => $ap_row['Year'],
		          'ap_year_color'                   => $ap_year_color,
		          'CustomerGroupId'                 => $CustomerGroupId,
		          'CustomerName'                    => $ap_row['CustomerName'],
		          'Logo'                            => $ap_row['Logo'],
		          'CustomerGroupName'               => $ap_row['CustomerGroupName'],
		          'RMName'                          => $ap_row['RMName'],
		          'DocumentStatusId'                => $account_planning_status['DocumentStatusId'],
		          'Status'                          => $account_planning_status['Status'],

		          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

		          'PinjamanTotalAP'                 => number_format($pinjamanAp['TotalPinjaman']/VALUE_PER, 0),
		          'PinjamanRatasAP'                 => number_format($pinjamanAp['RatasPinjaman']/VALUE_PER, 0),
		          'SimpananTotalAP'                 => number_format($simpananAp['TotalSimpanan']/VALUE_PER, 0),
		          'SimpananRatasAP'                 => number_format($simpananAp['RatasSimpanan']/VALUE_PER, 0),
		          'CurrentCPAAP'                    => number_format($cpaAp['Cpa']/VALUE_PER, 0),

		          'account_planning_member'         => $account_planning_member,
		          'rm_selected'                     => $rm_selected,
		          'CheckerList'                   	=> $CheckerList,
		          'SignerList'                   	=> $SignerList,
		          'account_planning_vcif_list'      => $account_planning_vcif_list
		        );
			}
			$params['row'] = $rowno;

			$config['base_url'] = base_url() . 'confirmation/Checker/history/'.$params['searchTxt'];
			$config['use_page_numbers'] = TRUE;
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 5;
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
	    $this->load->view('confirmation/account_planning_confirm.php', $params);
	    $this->load->view('layout/footer.php');
	}

}

?>
