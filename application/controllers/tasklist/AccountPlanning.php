<?php 

class AccountPlanning extends MY_Controller {

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
      $this->load->model('ConfirmationAccountPlanning_model');
      $this->load->model('TasklistDisposisi_model');
      $this->load->model('TasklistMyTask_model');
      $this->load->model('TasklistAccountPlanning_model');
      $this->load->model('PerformanceAccountPlanning_model');
      $this->load->model('MonitoringAccountPlanning_model');
      $this->load->model('DataTransaction_model');
      $this->load->model('AccountPlanningCalculate_model');
      $this->load->model('DataLoadOption_model');

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

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_box['all'] = '--- All ---';
    foreach ($doc_statuses as $doc_status) {
      $status_search_box[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_box, '', ' class="form-control col-md-7 col-xs-12" style="width: 50%; min-width:200px"');
    
    $params['current_year'] = $this->current_year;
    $search_year = array('all' => '--- All ---'
                        , $this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year
                        , $this->current_year+1 => $this->current_year+1);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $this->current_year, ' class="form-control col-md-7 col-xs-12" style="width: 25%;min-width: 80px"');
    $params['keyword_search_box'] = '';
    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning($this->session->PERSONAL_NUMBER, $this->current_year);

    if ($total_records > 0) {   

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $this->current_year);

      foreach ($ap_Tasklist as $ap_row) {
        $CustomerGroupId = $ap_row['CustomerGroupId'];
        $AccountPlanningId = $ap_row['AccountPlanningId'];

        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 5 || $account_planning_status['DocumentStatusId'] == 6){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3 || $account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#43a047';
        }

        $params['results'][$AccountPlanningId] = array(
          'AccountPlanningId'               => $AccountPlanningId,
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'CreatedBy'                       => $ap_row['CreatedBy'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
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
          'account_planning_vcif_list'      => $account_planning_vcif_list
        );
      }
      $params['row'] = $rowno;
      $params['current_year'] = $this->current_year;

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
    $params['search_box'] = ' style="display: none;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function search($fYear='',$fDocStatus='',$fSearchTxt='',$rowno=0) {
    $this->checkModule();

    $params = array();
    

    if (empty($fYear)) {
      $fYear = ($this->input->post('tahun_search_box')) ? $this->input->post('tahun_search_box') : "";
    }
    else {
      $fYear = str_replace('_', ' ', $fYear);
    }

    if (empty($fDocStatus) && $fDocStatus<>'0') {
      $fDocStatus = ($this->input->post('status_search_box'));
    }
    else {
      $fDocStatus = str_replace('_', ' ', $fDocStatus);
    }

    if (empty($fSearchTxt)) {
      $fSearchTxt = ($this->input->post('keyword_search_box')) ? $this->input->post('keyword_search_box') : "";
    }
    else {
      $fSearchTxt = trim(str_replace('_', ' ', $fSearchTxt));
    }

    $limit_per_page = 5;
    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $start_index = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_box['all'] = '--- All ---';
    foreach ($doc_statuses as $doc_status) {
      $status_search_box[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_box, $fDocStatus, ' class="form-control col-md-7 col-xs-12" style="width: 50%; min-width:200px"');
    
    $params['current_year'] = $this->current_year;
    $search_year = array('all' => '--- All ---'

                        , $this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year
                        , $this->current_year+1 => $this->current_year+1);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $fYear, ' class="form-control col-md-7 col-xs-12" style="width: 25%;min-width: 80px"');

    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning($this->session->PERSONAL_NUMBER, $fYear, $fDocStatus, $fSearchTxt);
    $params['keyword_search_box'] = $fSearchTxt;
    if ($total_records > 0) {   

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $fYear, $fDocStatus, $fSearchTxt);

      foreach ($ap_Tasklist as $ap_row) {
        $CustomerGroupId = $ap_row['CustomerGroupId'];
        $AccountPlanningId = $ap_row['AccountPlanningId'];

        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 5 || $account_planning_status['DocumentStatusId'] == 6){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3 || $account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#43a047';
        }

        $params['results'][$AccountPlanningId] = array(
          'AccountPlanningId'               => $AccountPlanningId,
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
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
          'account_planning_vcif_list'      => $account_planning_vcif_list
        );
      }
      $params['row'] = $rowno;
      $params['current_year'] = $this->current_year;

      if(empty($fSearchTxt))
          $searchUrl = '_';
      else 
          $searchUrl = $fSearchTxt;

      $config['base_url'] = base_url() . 'tasklist/AccountPlanning/search/'.$fYear.'/'.$fDocStatus.'/'.$searchUrl;
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limit_per_page;
      $config["uri_segment"] = 7;
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
    $params['search_box'] = ' style="display: block;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_list.php', $params);
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

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_box['all'] = '--- All ---';
    foreach ($doc_statuses as $doc_status) {
      $status_search_box[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_box, '', ' class="form-control col-md-7 col-xs-12" style="width: 50%; min-width:200px"');
    
    $params['current_year'] = $this->current_year;
    $search_year = array('all' => '--- All ---'
                        , $this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year
                        , $this->current_year+1 => $this->current_year+1);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $this->current_year, ' class="form-control col-md-7 col-xs-12" style="width: 25%;min-width: 80px"');

    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning($this->session->PERSONAL_NUMBER, $this->current_year);
     $params['keyword_search_box'] = '';
    if ($total_records > 0) {   

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $this->current_year);

      foreach ($ap_Tasklist as $ap_row) {
        $CustomerGroupId = $ap_row['CustomerGroupId'];
        $AccountPlanningId = $ap_row['AccountPlanningId'];

        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
        $account_planning_member = $this->TasklistDisposisi_model->getAccountPlanningMember($AccountPlanningId);
        $rm_selected = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $pinjamanAp = $this->DataTransaction_model->getLastDataPinjamanAccountPlanning($AccountPlanningId);
        $simpananAp = $this->DataTransaction_model->getLastDataSimpananAccountPlanning($AccountPlanningId);
        $cpaAp = $this->DataTransaction_model->getLastDataCpaAccountPlanning($AccountPlanningId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 5 || $account_planning_status['DocumentStatusId'] == 6){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3 || $account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#43a047';
        }

        $params['results'][$AccountPlanningId] = array(
          'AccountPlanningId'               => $AccountPlanningId,
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
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
          'account_planning_vcif_list'      => $account_planning_vcif_list
        );
      }
      $params['row'] = $rowno;
      $params['current_year'] = $this->current_year;

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
    $params['search_box'] = ' style="display: none;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function update_currency($AccountPlanningId, $FinancialHighlightCurrency) {
    $updateData = $this->TasklistAccountPlanning_model->updateData('AccountPlanning', array('FinancialHighlightCurrency' => $FinancialHighlightCurrency), 'AccountPlanningId', $AccountPlanningId);
  }

  public function input_proc() {
    if ($this->session->isCST == 0) {
      $this->checkModule();
      // $this->checkOwner($AccountPlanningId);
    }

    $Years = Array(  
                    date('Y') - 3,
                    date('Y') - 2,
                    date('Y') - 1
            );
    // Delete data
    if (!empty($this->input->post('RemoveId'))) {
      $InputTable = $this->input->post('InputTable');
      if ($this->input->post('DelAddition') == 1) {
        $InputTable = 'BankFacilityAddition';
      }

      foreach ($this->input->post('RemoveId') as $key => $value) {
          $data_delete[$key] = array (
            $this->input->post('IdName')[$key]  => $value
          );

          $deleteData = $this->TasklistAccountPlanning_model->deleteData($InputTable, $data_delete[$key]);
      }
      if ($this->input->post('DelAddition') == 1) {
        foreach ($this->input->post('BankFacilityItemAdditionId') as $key => $value) {
            $data_delete_ItemAddition[$key] = array (
              $this->input->post('BankFacilityItemAdditionId')[$key]  => $value
            );

            $deleteData = $this->TasklistAccountPlanning_model->deleteData('BankFacilityItemAddition', $data_delete_ItemAddition[$key]);
        }
      }

    }
    $AccountPlanningId = $this->input->post('AccountPlanningId');
    // Service
    if ($this->input->post('InputTable') == 'Service') {
      if (!empty($this->input->post('Name'))) {
        foreach ($this->input->post('Name') as $key => $value) {
          if (!empty($value)) {
            $data_input[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'Name'                => $value
              , 'Target'              => $this->input->post('Target')[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'CreatedDate'         => $this->current_datetime
              , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
            $data_edit[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'Name'                => $value
              , 'Target'              => $this->input->post('Target')[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'ModifiedDate'        => $this->current_datetime
              , 'ModifiedBy'          => $this->session->PERSONAL_NUMBER
            );
            $data_form[$key]['Id_name']                 = 'ServiceId';
            $data_form[$key]['InputTable']              = $this->input->post('InputTable');
            $data_form[$key]['ServiceSubmit']           = $this->input->post('ServiceSubmit')[$key];
            if (!empty($this->input->post('ServiceId')[$key])) {
              $data_form[$key]['ServiceId']   = $this->input->post('ServiceId')[$key];
            }

            if ($data_form[$key]['ServiceSubmit'] == 'edit') {
              $result = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['Id_name'], $data_form[$key]['ServiceId']);
              $deleteTagService[$key] = $this->TasklistAccountPlanning_model->deleteData('TagServiceUnitKerja', array($data_form[$key]['Id_name'] => $data_form[$key]['ServiceId']));
            }
            else if ($data_form[$key]['ServiceSubmit'] == 'add') {
              $data_form[$key]['ServiceId'] = $this->TasklistAccountPlanning_model->insertDataGetInputedId($data_form[$key]['InputTable'], $data_input[$key]);
              $result = array(
                  'status' => 'success'
              );
            } 

            if (!empty($this->input->post('ServiceTag')[$key]['ServiceTags'])) {
              foreach ($this->input->post('ServiceTag')[$key]['ServiceTags'] as $keys => $values) {
                if (!empty($values)) {
                  $data_input_tag[$key] = array (
                    'ServiceId'                => $data_form[$key]['ServiceId']
                    , 'UnitKerjaId'            => $values
                  );
                  $insertServiceTag[$key] = $this->TasklistAccountPlanning_model->insertData('TagServiceUnitKerja', $data_input_tag[$key]);
                }
              }
            }

          }
          else {
            $result_error = array(
                'status' => 'error'
                , 'message' => 'Service Name cannot empty'
            );
            echo json_encode($result_error);
            exit();
          }
        }
        echo json_encode($result);
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating services on client needs', $_SESSION['PERSONAL_NUMBER']);
      }
    }
    // Funding
    else if ($this->input->post('InputTable') == 'Funding') {
      if (!empty($this->input->post('FundingNeed'))) {
        foreach ($this->input->post('FundingNeed') as $key => $value) {

          if (!empty($value)) {
            $Amount[$key] = NULL;
            if (!empty($this->input->post('Amount')[$key])) {
              $Amount[$key] = str_replace(',', '', $this->input->post('Amount')[$key]);
            }
            $data_input[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'FundingNeed'         => $value
              , 'TimePeriod'          => $this->input->post('TimePeriod')[$key]
              , 'Amount'              => $Amount[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'CreatedDate'         => $this->current_datetime
              , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
            $data_edit[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'FundingNeed'         => $value
              , 'TimePeriod'          => $this->input->post('TimePeriod')[$key]
              , 'Amount'              => $Amount[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'ModifiedDate'         => $this->current_datetime
              , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );
            $data_form[$key]['Id_name']               = 'FundingId';
            $data_form[$key]['InputTable']            = $this->input->post('InputTable');
            $data_form[$key]['ActionSubmit']          = $this->input->post('FundingSubmit')[$key];
            if (!empty($this->input->post('FundingId')[$key])) {
              $data_form[$key]['FundingId']   = $this->input->post('FundingId')[$key];
            }

            if ($data_form[$key]['ActionSubmit'] == 'edit') {
              $result = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['Id_name'], $data_form[$key]['FundingId']);
            }
            else if ($data_form[$key]['ActionSubmit'] == 'add') {
              $result = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
            } 
          }
          else {
            $result = array(
                'status' => 'error'
                , 'message' => 'Funding Need cannot empty'
            );
          }
        }
        echo json_encode($result);
        // exit();
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating fundings on client needs', $_SESSION['PERSONAL_NUMBER']);
      }
    }
    // InitiativeAction
    else if ($this->input->post('InputTable') == 'InitiativeAction') {
      if (!empty($this->input->post('Name'))) {
        foreach ($this->input->post('Name') as $key => $value) {

          if (!empty($value)) {
            $data_input[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'Name'                => $value
              , 'Period'              => $this->input->post('Period')[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'CreatedDate'         => $this->current_datetime
              , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
            $data_edit[$key] = array (
              'AccountPlanningId'     => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'Name'                => $value
              , 'Period'              => $this->input->post('Period')[$key]
              , 'Description'         => $this->input->post('Description')[$key]
              , 'ModifiedDate'         => $this->current_datetime
              , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );
            $data_form[$key]['Id_name']               = 'InitiativeActionId';
            $data_form[$key]['InputTable']            = $this->input->post('InputTable');
            $data_form[$key]['ActionSubmit']          = $this->input->post('InitiativeActionSubmit')[$key];
            if (!empty($this->input->post('InitiativeActionId')[$key])) {
              $data_form[$key]['InitiativeActionId']   = $this->input->post('InitiativeActionId')[$key];
              // $data_form[$data_form[$key]['InitiativeActionId']]['RemoveId']              = $this->input->post('InitiativeActionId')[$data_form[$key]['InitiativeActionId']];
            }
            // print_r($data_form); die();
            if ($data_form[$key]['ActionSubmit'] == 'edit') {
              $result = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['Id_name'], $data_form[$key]['InitiativeActionId']);
            }
            else if ($data_form[$key]['ActionSubmit'] == 'add') {
              $result = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
            } 
          }
          else {
            $result_error = array(
                'status' => 'error'
                , 'message' => 'Initiatives Name cannot empty'
            );
            echo json_encode($result_error);
            exit();
          }

        }
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating initiatives action plan on action plan', $_SESSION['PERSONAL_NUMBER']);
      }
      echo json_encode($result);
    }

    // CreditSimulationAssumption
    else if ($this->input->post('InputTable') == 'CreditSimulationAssumption') {
      $USDExchange = 0;
      if (!empty($this->input->post('USDExchange'))) {
        $USDExchange = str_replace(',', '', $this->input->post('USDExchange'));
      }
      $IDRFTPSimpanan = 0;
      if (!empty($this->input->post('IDRFTPSimpanan'))) {
        $IDRFTPSimpanan = str_replace(',', '', $this->input->post('IDRFTPSimpanan'));
      }
      $ValasFTPSimpanan = 0;
      if (!empty($this->input->post('ValasFTPSimpanan'))) {
        $ValasFTPSimpanan = str_replace(',', '', $this->input->post('ValasFTPSimpanan'));
      }
      $IDRFTPPinjaman = 0;
      if (!empty($this->input->post('IDRFTPPinjaman'))) {
        $IDRFTPPinjaman = str_replace(',', '', $this->input->post('IDRFTPPinjaman'));
      }
      $ValasFTPPinjaman = 0;
      if (!empty($this->input->post('ValasFTPPinjaman'))) {
        $ValasFTPPinjaman = str_replace(',', '', $this->input->post('ValasFTPPinjaman'));
      }


      $data_form = array (
        'InputTable'              => $this->input->post('InputTable')
        , 'InputTableSubmit'      => $this->input->post('CreditSimulationAssumptionSubmit')
        , 'InputTableIdField'     => 'CreditSimulationAssumptionId'
        , 'InputTableIdValue'     => $this->input->post('CreditSimulationAssumptionId')
      );

      $data_input = array (
        'AccountPlanningId'       => $this->input->post('AccountPlanningId')
        , 'USDExchange'           => $USDExchange
        , 'IDRFTPSimpanan'        => $IDRFTPSimpanan
        , 'ValasFTPSimpanan'      => $ValasFTPSimpanan
        , 'IDRFTPPinjaman'        => $IDRFTPPinjaman
        , 'ValasFTPPinjaman'      => $ValasFTPPinjaman
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

      $data_edit = array (
        'AccountPlanningId'       => $this->input->post('AccountPlanningId')
        , 'USDExchange'           => $USDExchange
        , 'IDRFTPSimpanan'        => $IDRFTPSimpanan
        , 'ValasFTPSimpanan'      => $ValasFTPSimpanan
        , 'IDRFTPPinjaman'        => $IDRFTPPinjaman
        , 'ValasFTPPinjaman'      => $ValasFTPPinjaman
        , 'ModifiedDate'           => $this->current_datetime
        , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
        );

      //echo json_encode($data_form); die;

      if ($data_form['InputTableSubmit'] == 'edit') {
        $updateData = $this->TasklistAccountPlanning_model->updateData($data_form['InputTable'], $data_edit, $data_form['InputTableIdField'], $data_form['InputTableIdValue']);
        echo json_encode($updateData);
      }
      else {
        $insertData = $this->TasklistAccountPlanning_model->insertData($data_form['InputTable'], $data_input);
        echo json_encode($insertData);
      } 
    }

    // FeeTypeId
    if (!empty($this->input->post('FeeTypeId'))) {
      foreach ($this->input->post('FeeTypeId') as $key => $value) {
        // CreditSimulationFee
        if ($this->input->post('InputTable') == 'CreditSimulationFee') {
          
          $IDRAmount[$key] = 0;
          if (!empty($this->input->post('IDRAmount')[$key])) {
            $IDRAmount[$key] = str_replace(',', '', $this->input->post('IDRAmount')[$key]);
          }

          $ValasAmount[$key] = 0;
          if (!empty($this->input->post('ValasAmount')[$key])) {
            $ValasAmount[$key] = str_replace(',', '', $this->input->post('ValasAmount')[$key]);
          }

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('CreditSimulationFeeSubmit')
            , 'InputTableIdField'     => 'CreditSimulationFeeId'
            , 'InputTableIdValue'     => $this->input->post('CreditSimulationFeeId')[$key]
          );

          $data_input[$key] = array (
            'FeeTypeId'             => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'IDRAmount'           => $IDRAmount[$key]
            , 'ValasAmount'         => $ValasAmount[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
          );

          $data_edit[$key] = array (
            'FeeTypeId'             => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'IDRAmount'           => $IDRAmount[$key]
            , 'ValasAmount'         => $ValasAmount[$key]
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
          );

          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
          } 
        }
      }
      if (!empty($updateData)) {
        echo json_encode($updateData);
      }
      elseif (!empty($insertData)) {
        echo json_encode($insertData);
      }
    }

    // New BankFacilityItemAddition
    if (!empty($this->input->post('NewAddition')['BankFacilityItemAdditionName'])) {
      foreach ($this->input->post('NewAddition')['BankFacilityItemAdditionName'] as $key => $value) {
        $IDRAmountAddition[$key] = 0;
        if (!empty($this->input->post('NewAddition')['IDRAmountAddition'][$key])) {
          $IDRAmountAddition[$key] = str_replace(',', '', $this->input->post('NewAddition')['IDRAmountAddition'][$key]);
        }
        
        $ValasAmountAddition[$key] = 0;
        if (!empty($this->input->post('NewAddition')['ValasAmountAddition'][$key])) {
          $ValasAmountAddition[$key] = str_replace(',', '', $this->input->post('NewAddition')['ValasAmountAddition'][$key]);
        }
        
        $IDRRateAddition[$key] = ($this->input->post('NewAddition')['IDRRateAddition'][$key]) ? $this->input->post('NewAddition')['IDRRateAddition'][$key] : 0;
        $ValasRateAddition[$key] = ($this->input->post('NewAddition')['ValasRateAddition'][$key]) ? $this->input->post('NewAddition')['ValasRateAddition'][$key] : 0;

        $data_formNewAddition = array (
          'InputTableItemAddition'          => 'BankFacilityItemAddition'
          , 'InputTableAddition'              => $this->input->post('NewAddition')['InputTableAddition']
          , 'InputTableSubmitAddition'      => $this->input->post('NewAddition')['BankFacilityAdditionSubmit']
        );

        $data_inputNewAdditionItem[$key] = array (
          'Name'                          => $value
          , 'BankFacilityGroupId'         => $this->input->post('BankFacilityGroupId')
          , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
          , 'VCIF'                        => $this->input->post('VCIF')
          , 'CreatedDate'                 => $this->current_datetime
          , 'CreatedBy'                   => $this->session->PERSONAL_NUMBER
          );

        if ($data_formNewAddition['InputTableSubmitAddition'][$key] == 'add') {
          $insertDataNewAdditionItem = $this->TasklistAccountPlanning_model->insertDataGetInputedId($data_formNewAddition['InputTableItemAddition'], $data_inputNewAdditionItem[$key]);

          $data_inputNewAddition[$key] = array (
            'BankFacilityItemAdditionId'    => $insertDataNewAdditionItem
            , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
            , 'VCIF'                        => $this->input->post('VCIF')
            , 'IDRAmountAddition'           => $IDRAmountAddition[$key]
            , 'IDRRateAddition'             => $IDRRateAddition[$key]
            , 'ValasAmountAddition'         => $ValasAmountAddition[$key]
            , 'ValasRateAddition'           => $ValasRateAddition[$key]
            , 'CreatedDate'                 => $this->current_datetime
            , 'CreatedBy'                   => $this->session->PERSONAL_NUMBER
            );

          $insertDataNewAddition = $this->TasklistAccountPlanning_model->insertDataBankFacilities($data_formNewAddition['InputTableAddition'], $data_inputNewAddition[$key],'Addition');

          // Wallet Share
          /*
          $TotalAmountAddition[$key] = $IDRAmountAddition[$key] + $ValasAmountAddition[$key];

          $data_input_walletshare[$key] = array (
            'BankFacilityItemAdditionId'  => $insertDataNewAdditionItem
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'BRINominal'          => $TotalAmountAddition[$key]
            , 'TotalAmountAddition' => $TotalAmountAddition[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );

          $insertData_WalletShare = $this->TasklistAccountPlanning_model->insertData('WalletShareAddition', $data_input_walletshare[$key]);
          */          
          // End Wallet Share
        }

      }

    }

    // BankFacilityItemAddition
    if (!empty($this->input->post('BankFacilityItemAdditionId'))) {
      foreach ($this->input->post('BankFacilityItemAdditionId') as $key => $value) {

        // EstimatedFinancialAddition
        if ($this->input->post('InputTableAddition') == 'EstimatedFinancialAddition') {
          
          $IDRProjectionAddition[$key] = NULL;
          if (!empty($this->input->post('IDRProjectionAddition')[$key])) {
            $IDRProjectionAddition[$key] = str_replace(',', '', $this->input->post('IDRProjectionAddition')[$key]);
          }

          $ValasProjectionAddition[$key] = NULL;
          if (!empty($this->input->post('ValasProjectionAddition')[$key])) {
            $ValasProjectionAddition[$key] = str_replace(',', '', $this->input->post('ValasProjectionAddition')[$key]);
          }

          $IDRTargetAddition[$key] = NULL;
          if (!empty($this->input->post('IDRTargetAddition')[$key])) {
            $IDRTargetAddition[$key] = str_replace(',', '', $this->input->post('IDRTargetAddition')[$key]);
          }
          
          $ValasTargetAddition[$key] = NULL;
          if (!empty($this->input->post('ValasTargetAddition')[$key])) {
            $ValasTargetAddition[$key] = str_replace(',', '', $this->input->post('ValasTargetAddition')[$key]);
          }

          $data_formAddition = array (
            'InputTableAddition'              => $this->input->post('InputTableAddition')
            , 'InputTableSubmitAddition'      => $this->input->post('EstimatedFinancialAdditionSubmit')
            , 'InputTableIdFieldAddition'     => 'EstimatedFinancialAdditionId'
            , 'InputTableIdValueAddition'     => $this->input->post('EstimatedFinancialAdditionId')
          );

          $data_inputAddition[$key] = array (
            'BankFacilityItemAdditionId'    => $value
            , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
            , 'VCIF'                        => $this->input->post('VCIF')
            , 'IDRProjectionAddition'       => $IDRProjectionAddition[$key]
            , 'IDRTargetAddition'           => $IDRTargetAddition[$key]
            , 'ValasProjectionAddition'     => $ValasProjectionAddition[$key]
            , 'ValasTargetAddition'         => $ValasTargetAddition[$key]
            , 'CreatedDate'                 => $this->current_datetime
            , 'CreatedBy'                   => $this->session->PERSONAL_NUMBER
          );

          $data_editAddition[$key] = array (
            'BankFacilityItemAdditionId'    => $value
            , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
            , 'VCIF'                        => $this->input->post('VCIF')
            , 'IDRProjectionAddition'       => $IDRProjectionAddition[$key]
            , 'IDRTargetAddition'           => $IDRTargetAddition[$key]
            , 'ValasProjectionAddition'     => $ValasProjectionAddition[$key]
            , 'ValasTargetAddition'         => $ValasTargetAddition[$key]
            , 'ModifiedDate'                 => $this->current_datetime
            , 'ModifiedBy'                   => $this->session->PERSONAL_NUMBER
          );
          if ($data_formAddition['InputTableSubmitAddition'][$key] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_formAddition['InputTableAddition'], $data_editAddition[$key], $data_formAddition['InputTableIdFieldAddition'], $data_formAddition['InputTableIdValueAddition'][$key]);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_formAddition['InputTableAddition'], $data_inputAddition[$key]);
          } 
        }
        // BankFacilityAddition
        else if ($this->input->post('InputTableAddition') == 'BankFacilityAddition') {
          if (empty($this->input->post('DelAddition'))) {
            
            $IDRAmountAddition[$key] = 0;
            if (!empty($this->input->post('IDRAmountAddition')[$key])) {
              $IDRAmountAddition[$key] = str_replace(',', '', $this->input->post('IDRAmountAddition')[$key]);
            }
            
            $ValasAmountAddition[$key] = 0;
            if (!empty($this->input->post('ValasAmountAddition')[$key])) {
              $ValasAmountAddition[$key] = str_replace(',', '', $this->input->post('ValasAmountAddition')[$key]);
            }
            
            $IDRRateAddition[$key] = ($this->input->post('IDRRateAddition')[$key]) ? $this->input->post('IDRRateAddition')[$key] : 0;
            $ValasRateAddition[$key] = ($this->input->post('ValasRateAddition')[$key]) ? $this->input->post('ValasRateAddition')[$key] : 0;

            // Wallet Share
            /*
            $dataBankFacilityAddition[$key] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($this->input->post('AccountPlanningId'), $value, $this->input->post('VCIF'));

            $TotalAmountAddition[$key] = $IDRAmountAddition[$key] + $ValasAmountAddition[$key];
            $oldTotalAmountAddition[$key] = $this->input->post('oldIDRAmountAddition')[$key] + $this->input->post('oldValasAmountAddition')[$key];

            if(!empty($dataBankFacility[$key])){
              $updateTotalAmountAddition[$key] = $dataBankFacilityAddition[$key][0]['TotalAmount'] + ($TotalAmountAddition[$key] - $oldTotalAmountAddition[$key]);
              $data_edit_walletshare[$key] = array (
                'BankFacilityItemAdditionId'    => $value
                , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
                , 'VCIF'                => $this->input->post('VCIF')
                , 'TotalAmountAddition' => $updateTotalAmountAddition[$key]
                , 'ModifiedDate'        => $this->current_datetime
                , 'ModifiedBy'          => $this->session->PERSONAL_NUMBER
                );

              $updateData_WalletShare = $this->TasklistAccountPlanning_model->updateData('WalletShareAddition', $data_edit_walletshare[$key], 'WalletShareAdditionId', $dataBankFacility[$key][0]['WalletShareAdditionId']);
            }
            else {
              $data_input_walletshare[$key] = array (
                'BankFacilityItemAdditionId'  => $value
                , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
                , 'VCIF'                => $this->input->post('VCIF')
                , 'TotalAmountAddition'         => $TotalAmountAddition[$key]
                , 'CreatedDate'         => $this->current_datetime
                , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
                );

              $insertData_WalletShare = $this->TasklistAccountPlanning_model->insertData('WalletShareAddition', $data_input_walletshare[$key]);
            }
            */
            $dataWalletShareAddition[$key] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($this->input->post('AccountPlanningId'), $value, $this->input->post('VCIF'));
            // End Wallet Share

            $data_formAddition = array (
              'InputTableAddition'              => $this->input->post('InputTableAddition')
              , 'InputTableSubmitAddition'      => $this->input->post('BankFacilityAdditionSubmit')
              , 'InputTableIdFieldAddition'     => 'BankFacilityAdditionId'
              , 'InputTableIdValueAddition'     => $this->input->post('BankFacilityAdditionId')
            );

            $data_inputAddition[$key] = array (
              'BankFacilityItemAdditionId'    => $value
              , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
              , 'VCIF'                        => $this->input->post('VCIF')
              , 'IDRAmountAddition'           => $IDRAmountAddition[$key]
              , 'IDRRateAddition'             => $IDRRateAddition[$key]
              , 'ValasAmountAddition'         => $ValasAmountAddition[$key]
              , 'ValasRateAddition'           => $ValasRateAddition[$key]
              , 'CreatedDate'                 => $this->current_datetime
              , 'CreatedBy'                   => $this->session->PERSONAL_NUMBER
              );

            $data_editAddition[$key] = array (
              'BankFacilityItemAdditionId'    => $value
              , 'AccountPlanningId'           => $this->input->post('AccountPlanningId')
              , 'VCIF'                        => $this->input->post('VCIF')
              , 'IDRAmountAddition'           => $IDRAmountAddition[$key]
              , 'IDRRateAddition'             => $IDRRateAddition[$key]
              , 'ValasAmountAddition'         => $ValasAmountAddition[$key]
              , 'ValasRateAddition'           => $ValasRateAddition[$key]
              , 'ModifiedDate'                 => $this->current_datetime
              , 'ModifiedBy'                   => $this->session->PERSONAL_NUMBER
              );

            if ($data_formAddition['InputTableSubmitAddition'][$key] == 'edit') {
              $updateData = $this->TasklistAccountPlanning_model->updateDataBankFacilities($data_formAddition['InputTableAddition'], $data_editAddition[$key], $data_formAddition['InputTableIdFieldAddition'], $data_formAddition['InputTableIdValueAddition'][$key], $dataWalletShareAddition[$key][0]['WalletShareAdditionId'], 'Addition');
            }
            else {
              $insertData = $this->TasklistAccountPlanning_model->insertDataBankFacilities($data_formAddition['InputTableAddition'], $data_inputAddition[$key], 'Addition');
            } 
          }
        }
        
        // WalletShareAddition
        else if ($this->input->post('InputTableAddition') == 'WalletShareAddition') {
          $BRINominalAddition[$key] = NULL;
          if (!empty($this->input->post('BRINominalAddition')[$key])) {
            $BRINominalAddition[$key] = str_replace(',', '', $this->input->post('BRINominalAddition')[$key]);
          }

          /*
          $OtherNominalAddition[$key] = NULL;
          if (!empty($this->input->post('OtherNominalAddition')[$key])) {
            $OtherNominalAddition[$key] = str_replace(',', '', $this->input->post('OtherNominalAddition')[$key]);
          }
          */
          $TotalAmountAddition[$key] = 0;
          if (!empty($this->input->post('TotalAmountAddition')[$key])) {
            $TotalAmountAddition[$key] = str_replace(',', '', $this->input->post('TotalAmountAddition')[$key]);
          }
          
          /*
          $BRIPortionAddition[$key] = ($this->input->post('BRIPortionAddition')[$key]) ? $this->input->post('BRIPortionAddition')[$key] : NULL;
          $OtherPortionAddition[$key] = ($this->input->post('OtherPortionAddition')[$key]) ? $this->input->post('OtherPortionAddition')[$key] : NULL;

          $data_inputAddition[$key] = array (
            'BankFacilityItemAdditionId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')[$key]
            , 'BRINominalAddition'          => $BRINominalAddition[$key]
            , 'BRIPortionAddition'          => $BRIPortionAddition[$key]
            , 'OtherNominalAddition'        => $OtherNominalAddition[$key]
            , 'OtherPortionAddition'        => $OtherPortionAddition[$key]
            , 'TotalAmountAddition'         => $TotalAmountAddition[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
          */

          $data_formAddition = array (
            'InputTableAddition'              => $this->input->post('InputTableAddition')
            , 'InputTableSubmitAddition'      => $this->input->post('WalletShareAdditionSubmit')
            , 'InputTableIdFieldAddition'     => 'WalletShareAdditionId'
            , 'InputTableIdValueAddition'     => $this->input->post('WalletShareAdditionId')
          );
          $data_inputAddition[$key] = array (
            'BankFacilityItemAdditionId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'BRINominalAddition'          => $BRINominalAddition[$key]
            , 'TotalAmountAddition' => $TotalAmountAddition[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
          $data_editAddition[$key] = array (
            'BankFacilityItemAdditionId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'BRINominalAddition'          => $BRINominalAddition[$key]
            , 'TotalAmountAddition' => $TotalAmountAddition[$key]
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );

          if ($data_formAddition['InputTableSubmitAddition'][$key] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateDataWalletShare($data_formAddition['InputTableAddition'], $data_editAddition[$key], $data_formAddition['InputTableIdFieldAddition'], $data_formAddition['InputTableIdValueAddition'][$key], 'Addition');
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_formAddition['InputTableAddition'], $data_inputAddition[$key]);
          } 
        }

        /*
        // CompetitionAnalysisAddition
        else if ($this->input->post('InputTableAddition') == 'CompetitionAnalysisAddition') {
          $BankIdAddition[$value][1] = ($this->input->post('BankIdAddition')[$value][1]) ? $this->input->post('BankIdAddition')[$value][1] : NULL;
          $BankIdAddition[$value][2] = ($this->input->post('BankIdAddition')[$value][2]) ? $this->input->post('BankIdAddition')[$value][2] : NULL;
          $BankIdAddition[$value][3] = ($this->input->post('BankIdAddition')[$value][3]) ? $this->input->post('BankIdAddition')[$value][3] : NULL;

          $data_input[$key] = array (
            'BankFacilityItemAdditionId'    => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')[$key]
            , 'BankId1Addition'             => $BankIdAddition[$value][1]
            , 'BankId2Addition'             => $BankIdAddition[$value][2]
            , 'BankId3Addition'             => $BankIdAddition[$value][3]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );

          if ($data_formAddition['InputTableSubmitAddition'][$key] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_formAddition['InputTableAddition'], $data_inputAddition[$key], $data_formAddition['InputTableIdFieldAddition'], $data_formAddition['InputTableIdValueAddition'][$key]);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_formAddition['InputTableAddition'], $data_inputAddition[$key]);
          } 
        }
        */
        // CreditSimulationAddition
        else if ($this->input->post('InputTableAddition') == 'CreditSimulationAddition') {

          $IDRPlafondAddition[$key] = 0;
          if (!empty($this->input->post('IDRPlafondAddition')[$key])) {
            $IDRPlafondAddition[$key] = str_replace(',', '', $this->input->post('IDRPlafondAddition')[$key]);
          }
          
          $ValasPlafondAddition[$key] = 0;
          if (!empty($this->input->post('ValasPlafondAddition')[$key])) {
            $ValasPlafondAddition[$key] = str_replace(',', '', $this->input->post('ValasPlafondAddition')[$key]);
          }

          $IDROutstandingAddition[$key] = 0;
          if (!empty($this->input->post('IDROutstandingAddition')[$key])) {
            $IDROutstandingAddition[$key] = str_replace(',', '', $this->input->post('IDROutstandingAddition')[$key]);
          }
          
          $ValasOutstandingAddition[$key] = 0;
          if (!empty($this->input->post('ValasOutstandingAddition')[$key])) {
            $ValasOutstandingAddition[$key] = str_replace(',', '', $this->input->post('ValasOutstandingAddition')[$key]);
          }

          $IDRDailyRatasAddition[$key] = 0;
          if (!empty($this->input->post('IDRDailyRatasAddition')[$key])) {
            $IDRDailyRatasAddition[$key] = str_replace(',', '', $this->input->post('IDRDailyRatasAddition')[$key]);
          }
          
          $ValasDailyRatasAddition[$key] = 0;
          if (!empty($this->input->post('ValasDailyRatasAddition')[$key])) {
            $ValasDailyRatasAddition[$key] = str_replace(',', '', $this->input->post('ValasDailyRatasAddition')[$key]);
          }
          
          $IDRTenorAddition[$key] = ($this->input->post('IDRTenorAddition')[$key]) ? $this->input->post('IDRTenorAddition')[$key] : 0;
          $ValasTenorAddition[$key] = ($this->input->post('ValasTenorAddition')[$key]) ? $this->input->post('ValasTenorAddition')[$key] : 0;
          
          $IDRIndicativeRateAddition[$key] = ($this->input->post('IDRIndicativeRateAddition')[$key]) ? $this->input->post('IDRIndicativeRateAddition')[$key] : 0;
          $ValasIndicativeRateAddition[$key] = ($this->input->post('ValasIndicativeRateAddition')[$key]) ? $this->input->post('ValasIndicativeRateAddition')[$key] : 0;

          $IDRIncomeExpenseAddition[$key] = 0;
          if (!empty($this->input->post('IDRIncomeExpenseAddition')[$key])) {
            $IDRIncomeExpenseAddition[$key] = str_replace(',', '', $this->input->post('IDRIncomeExpenseAddition')[$key]);
          }
          
          $ValasIncomeExpenseAddition[$key] = 0;
          if (!empty($this->input->post('ValasIncomeExpenseAddition')[$key])) {
            $ValasIncomeExpenseAddition[$key] = str_replace(',', '', $this->input->post('ValasIncomeExpenseAddition')[$key]);
          }
          
          $IDRProvisionRateAddition[$key] = ($this->input->post('IDRProvisionRateAddition')[$key]) ? $this->input->post('IDRProvisionRateAddition')[$key] : 0;
          $ValasProvisionRateAddition[$key] = ($this->input->post('ValasProvisionRateAddition')[$key]) ? $this->input->post('ValasProvisionRateAddition')[$key] : 0;

          $IDRProvisionAddition[$key] = 0;
          if (!empty($this->input->post('IDRProvisionAddition')[$key])) {
            $IDRProvisionAddition[$key] = str_replace(',', '', $this->input->post('IDRProvisionAddition')[$key]);
          }
          
          $ValasProvisionAddition[$key] = 0;
          if (!empty($this->input->post('ValasProvisionAddition')[$key])) {
            $ValasProvisionAddition[$key] = str_replace(',', '', $this->input->post('ValasProvisionAddition')[$key]);
          }

          $IDRFeeAddition[$key] = 0;
          if (!empty($this->input->post('IDRFeeAddition')[$key])) {
            $IDRFeeAddition[$key] = str_replace(',', '', $this->input->post('IDRFeeAddition')[$key]);
          }
          
          $ValasFeeAddition[$key] = 0;
          if (!empty($this->input->post('ValasFeeAddition')[$key])) {
            $ValasFeeAddition[$key] = str_replace(',', '', $this->input->post('ValasFeeAddition')[$key]);
          }

          $IDRBebanBungaAddition[$key] = 0;
          if (!empty($this->input->post('IDRBebanBungaAddition')[$key])) {
            $IDRBebanBungaAddition[$key] = str_replace(',', '', $this->input->post('IDRBebanBungaAddition')[$key]);
          }
          
          $ValasBebanBungaAddition[$key] = 0;
          if (!empty($this->input->post('ValasBebanBungaAddition')[$key])) {
            $ValasBebanBungaAddition[$key] = str_replace(',', '', $this->input->post('ValasBebanBungaAddition')[$key]);
          }

          $data_formAddition[$key] = array (
            'InputTableAddition'              => $this->input->post('InputTableAddition')
            , 'InputTableSubmitAddition'      => $this->input->post('CreditSimulationSubmitAddition')
            , 'InputTableIdFieldAddition'     => 'CreditSimulationAdditionId'
            , 'InputTableIdValueAddition'     => $this->input->post('CreditSimulationAdditionId')[$key]
          );

          $data_inputAddition[$key] = array (
            'BankFacilityItemAdditionId'        => $value
            , 'AccountPlanningId'       => $this->input->post('AccountPlanningId')
            , 'IDRPlafondAddition'              => $IDRPlafondAddition[$key]
            , 'ValasPlafondAddition'            => $ValasPlafondAddition[$key]
            , 'IDROutstandingAddition'          => $IDROutstandingAddition[$key]
            , 'ValasOutstandingAddition'        => $ValasOutstandingAddition[$key]
            , 'IDRDailyRatasAddition'           => $IDRDailyRatasAddition[$key]
            , 'ValasDailyRatasAddition'         => $ValasDailyRatasAddition[$key]
            , 'IDRTenorAddition'                => $IDRTenorAddition[$key]
            , 'ValasTenorAddition'              => $ValasTenorAddition[$key]
            , 'IDRIndicativeRateAddition'           => $IDRIndicativeRateAddition[$key]
            , 'ValasIndicativeRateAddition'         => $ValasIndicativeRateAddition[$key]
            , 'IDRIncomeExpenseAddition'            => $IDRIncomeExpenseAddition[$key]
            , 'ValasIncomeExpenseAddition'          => $ValasIncomeExpenseAddition[$key]
            , 'IDRProvisionRateAddition'            => $IDRProvisionRateAddition[$key]
            , 'ValasProvisionRateAddition'          => $ValasProvisionRateAddition[$key]
            , 'IDRProvisionAddition'            => $IDRProvisionAddition[$key]
            , 'ValasProvisionAddition'          => $ValasProvisionAddition[$key]
            , 'IDRFeeAddition'                  => $IDRFeeAddition[$key]
            , 'ValasFeeAddition'                => $ValasFeeAddition[$key]
            , 'IDRBebanBungaAddition'                  => $IDRBebanBungaAddition[$key]
            , 'ValasBebanBungaAddition'                => $ValasBebanBungaAddition[$key]
            , 'CreatedDate'             => $this->current_datetime
            , 'CreatedBy'               => $this->session->PERSONAL_NUMBER
            );

          if ($data_formAddition[$key]['InputTableSubmitAddition'] == 'edit') {
            $result = $this->TasklistAccountPlanning_model->updateData($data_formAddition[$key]['InputTableAddition'], $data_inputAddition[$key], $data_formAddition[$key]['InputTableIdFieldAddition'], $data_formAddition[$key]['InputTableIdValueAddition']);
          }
          else {
            $result = $this->TasklistAccountPlanning_model->insertData($data_formAddition[$key]['InputTableAddition'], $data_inputAddition[$key]);
          }
        }
      }
    }

    // BankFacilityItem
    if (!empty($this->input->post('BankFacilityItemId'))) {
      foreach ($this->input->post('BankFacilityItemId') as $key => $value) {

        // EstimatedFinancial
        if ($this->input->post('InputTable') == 'EstimatedFinancial') {
          
          $IDRProjection[$key] = 0;
          if (!empty($this->input->post('IDRProjection')[$key])) {
            $IDRProjection[$key] = str_replace(',', '', $this->input->post('IDRProjection')[$key]);
          }

          $ValasProjection[$key] = 0;
          if (!empty($this->input->post('ValasProjection')[$key])) {
            $ValasProjection[$key] = str_replace(',', '', $this->input->post('ValasProjection')[$key]);
          }

          $IDRTarget[$key] = 0;
          if (!empty($this->input->post('IDRTarget')[$key])) {
            $IDRTarget[$key] = str_replace(',', '', $this->input->post('IDRTarget')[$key]);
          }
          
          $ValasTarget[$key] = 0;
          if (!empty($this->input->post('ValasTarget')[$key])) {
            $ValasTarget[$key] = str_replace(',', '', $this->input->post('ValasTarget')[$key]);
          }

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('EstimatedFinancialSubmit')[$key]
            , 'InputTableIdField'     => 'EstimatedFinancialId'
            , 'InputTableIdValue'     => $this->input->post('EstimatedFinancialId')[$key]
          );

          $data_input[$key] = array (
            'BankFacilityItemId'    => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'IDRProjection'       => $IDRProjection[$key]
            , 'IDRTarget'           => $IDRTarget[$key]
            , 'ValasProjection'     => $ValasProjection[$key]
            , 'ValasTarget'         => $ValasTarget[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
          );

          $data_edit[$key] = array (
            'BankFacilityItemId'    => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'IDRProjection'       => $IDRProjection[$key]
            , 'IDRTarget'           => $IDRTarget[$key]
            , 'ValasProjection'     => $ValasProjection[$key]
            , 'ValasTarget'         => $ValasTarget[$key]
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
          );
          
          //echo json_encode($data_form); die;
          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
          } 
          $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating estimated financial on action plan', $_SESSION['PERSONAL_NUMBER']);
        }

        // BankFacility
        else if ($this->input->post('InputTable') == 'BankFacility') {

          $IDRAmount[$key] = 0;
          if (!empty($this->input->post('IDRAmount')[$key])) {
            $IDRAmount[$key] = str_replace(',', '', $this->input->post('IDRAmount')[$key]);
          }
          
          $ValasAmount[$key] = 0;
          if (!empty($this->input->post('ValasAmount')[$key])) {
            $ValasAmount[$key] = str_replace(',', '', $this->input->post('ValasAmount')[$key]);
          }
          
          $IDRRate[$key] = ($this->input->post('IDRRate')[$key]) ? $this->input->post('IDRRate')[$key] : 0;
          $ValasRate[$key] = ($this->input->post('ValasRate')[$key]) ? $this->input->post('ValasRate')[$key] : 0;

          // Wallet Share
          /*
          $dataBankFacility[$key] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($this->input->post('AccountPlanningId'), $value, $this->input->post('VCIF'));

          $TotalAmount[$key] = $IDRAmount[$key] + $ValasAmount[$key];
          $oldTotalAmount[$key] = $this->input->post('oldIDRAmount')[$key] + $this->input->post('oldValasAmount')[$key];

          if(!empty($dataBankFacility[$key])){
            $updateTotalAmount[$key] = $dataBankFacility[$key][0]['TotalAmount'] + ($TotalAmount[$key] - $oldTotalAmount[$key]);
            $data_edit_walletshare[$key] = array (
              'BankFacilityItemId'    => $value
              , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'BRINominal'          => $TotalAmount[$key]
              , 'TotalAmount'         => $updateTotalAmount[$key]
              , 'ModifiedDate'        => $this->current_datetime
              , 'ModifiedBy'          => $this->session->PERSONAL_NUMBER
              );

            $updateData_WalletShare = $this->TasklistAccountPlanning_model->updateData('WalletShare', $data_edit_walletshare[$key], 'WalletShareId', $dataBankFacility[$key][0]['WalletShareId']);
          }
          else {
            $data_input_walletshare[$key] = array (
              'BankFacilityItemId'    => $value
              , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
              , 'VCIF'                => $this->input->post('VCIF')
              , 'BRINominal'          => $TotalAmount[$key]
              , 'TotalAmount'         => $TotalAmount[$key]
              , 'CreatedDate'         => $this->current_datetime
              , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
              );

            $insertData_WalletShare = $this->TasklistAccountPlanning_model->insertData('WalletShare', $data_input_walletshare[$key]);
          }
          */ 
          $dataWalletShare[$key] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($this->input->post('AccountPlanningId'), $value, $this->input->post('VCIF'));
          // End Wallet Share

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('BankFacilitySubmit')[$key]
            , 'InputTableIdField'     => 'BankFacilityId'
            , 'InputTableIdValue'     => $this->input->post('BankFacilityId')[$key]
          );

          $data_input[$key] = array (
            'BankFacilityItemId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'IDRAmount'           => $IDRAmount[$key]
            , 'IDRRate'             => $IDRRate[$key]
            , 'ValasAmount'         => $ValasAmount[$key]
            , 'ValasRate'           => $ValasRate[$key]
            , 'LoadFrom'            => 3
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );

          $data_edit[$key] = array (
            'BankFacilityItemId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'IDRAmount'           => $IDRAmount[$key]
            , 'IDRRate'             => $IDRRate[$key]
            , 'ValasAmount'         => $ValasAmount[$key]
            , 'ValasRate'           => $ValasRate[$key]
            , 'LoadFrom'            => 3
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );

          //echo json_encode($data_form); die;
          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateDataBankFacilities($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue'], $dataWalletShare[$key][0]['WalletShareId']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertDataBankFacilities($data_form[$key]['InputTable'], $data_input[$key]);
          } 
          $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating bank facility on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        }

        // WalletShare
        else if ($this->input->post('InputTable') == 'WalletShare') {
          // echo "<pre>";
          // print_r($this->input->post()); die();
          $BRINominal[$key] = NULL;
          if (!empty($this->input->post('BRINominal')[$key])) {
            $BRINominal[$key] = str_replace(',', '', $this->input->post('BRINominal')[$key]);
          }
          
          /*
          $OtherNominal[$key] = NULL;
          if (!empty($this->input->post('OtherNominal')[$key])) {
            $OtherNominal[$key] = str_replace(',', '', $this->input->post('OtherNominal')[$key]);
          }
          */
          $TotalAmount[$key] = 0;
          if (!empty($this->input->post('TotalAmount')[$key])) {
            $TotalAmount[$key] = str_replace(',', '', $this->input->post('TotalAmount')[$key]);
          }
          //echo $TotalAmount[$key]; die;
          
          /*
          $BRIPortion[$key] = ($this->input->post('BRIPortion')[$key]) ? $this->input->post('BRIPortion')[$key] : NULL;
          $OtherPortion[$key] = ($this->input->post('OtherPortion')[$key]) ? $this->input->post('OtherPortion')[$key] : NULL;
          
          $data_input[$key] = array (
            'BankFacilityItemId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')[$key]
            , 'BRINominal'          => $BRINominal[$key]
            , 'BRIPortion'          => $BRIPortion[$key]
            , 'OtherNominal'        => $OtherNominal[$key]
            , 'OtherPortion'        => $OtherPortion[$key]
            , 'TotalAmount'         => $TotalAmount[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
          */

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('WalletShareSubmit')[$key]
            , 'InputTableIdField'     => 'WalletShareId'
            , 'InputTableIdValue'     => $this->input->post('WalletShareId')[$key]
          );
          $data_input[$key] = array (
            'BankFacilityItemId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'BRINominal'          => $BRINominal[$key]
            , 'TotalAmount'         => $TotalAmount[$key]
            // , 'oldTotalAmount'      => $this->input->post('oldTotalAmount')[$key]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );
          $data_edit[$key] = array (
            'BankFacilityItemId'  => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'VCIF'                => $this->input->post('VCIF')
            , 'BRINominal'          => $BRINominal[$key]
            , 'TotalAmount'         => $TotalAmount[$key]
            // , 'oldTotalAmount'      => $this->input->post('oldTotalAmount')[$key]
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );
            //echo json_encode($data_input); die;

          //echo json_encode($data_form); die;
          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateDataWalletShare($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
            // $updateData = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
          } 
          $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating wallet share analysis on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        }        
        
        // CompetitionAnalysis
        else if ($this->input->post('InputTable') == 'CompetitionAnalysis') {
          $BankId[$value][1] = ($this->input->post('BankId')[$value][1]) ? $this->input->post('BankId')[$value][1] : NULL;
          $BankId[$value][2] = ($this->input->post('BankId')[$value][2]) ? $this->input->post('BankId')[$value][2] : NULL;
          $BankId[$value][3] = ($this->input->post('BankId')[$value][3]) ? $this->input->post('BankId')[$value][3] : NULL;

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('CompetitionAnalysisSubmit')
            , 'InputTableIdField'     => 'CompetitionAnalysisId'
            , 'InputTableIdValue'     => $this->input->post('CompetitionAnalysisId')[$key]
          );

          $data_input[$key] = array (
            'BankFacilityItemId'    => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'BankId1'             => $BankId[$value][1]
            , 'BankId2'             => $BankId[$value][2]
            , 'BankId3'             => $BankId[$value][3]
            , 'CreatedDate'         => $this->current_datetime
            , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
            );

          $data_edit[$key] = array (
            'BankFacilityItemId'    => $value
            , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
            , 'BankId1'             => $BankId[$value][1]
            , 'BankId2'             => $BankId[$value][2]
            , 'BankId3'             => $BankId[$value][3]
            , 'ModifiedDate'         => $this->current_datetime
            , 'ModifiedBy'           => $this->session->PERSONAL_NUMBER
            );

          //echo json_encode($data_form); die;
          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
          } 
          $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating competition analysis on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        }
        // CreditSimulation
        else if ($this->input->post('InputTable') == 'CreditSimulation') {

          $IDRPlafond[$key] = 0;
          if (!empty($this->input->post('IDRPlafond')[$key])) {
            $IDRPlafond[$key] = str_replace(',', '', $this->input->post('IDRPlafond')[$key]);
          }
          
          $ValasPlafond[$key] = 0;
          if (!empty($this->input->post('ValasPlafond')[$key])) {
            $ValasPlafond[$key] = str_replace(',', '', $this->input->post('ValasPlafond')[$key]);
          }

          $IDROutstanding[$key] = 0;
          if (!empty($this->input->post('IDROutstanding')[$key])) {
            $IDROutstanding[$key] = str_replace(',', '', $this->input->post('IDROutstanding')[$key]);
          }
          
          $ValasOutstanding[$key] = 0;
          if (!empty($this->input->post('ValasOutstanding')[$key])) {
            $ValasOutstanding[$key] = str_replace(',', '', $this->input->post('ValasOutstanding')[$key]);
          }

          $IDRDailyRatas[$key] = 0;
          if (!empty($this->input->post('IDRDailyRatas')[$key])) {
            $IDRDailyRatas[$key] = str_replace(',', '', $this->input->post('IDRDailyRatas')[$key]);
          }
          
          $ValasDailyRatas[$key] = 0;
          if (!empty($this->input->post('ValasDailyRatas')[$key])) {
            $ValasDailyRatas[$key] = str_replace(',', '', $this->input->post('ValasDailyRatas')[$key]);
          }
          
          $IDRTenor[$key] = 0;
          if (!empty($this->input->post('IDRTenor')[$key])) {
            $IDRTenor[$key] = str_replace(',', '', $this->input->post('IDRTenor')[$key]);
          }

          $ValasTenor[$key] = 0;
          if (!empty($this->input->post('ValasTenor')[$key])) {
            $ValasTenor[$key] = str_replace(',', '', $this->input->post('ValasTenor')[$key]);
          }
          // $IDRTenor[$key] = ($this->input->post('IDRTenor')[$key]) ? $this->input->post('IDRTenor')[$key] : 0;
          // $ValasTenor[$key] = ($this->input->post('ValasTenor')[$key]) ? $this->input->post('ValasTenor')[$key] : 0;
          
          // $IDRIndicativeRate[$key] = ($this->input->post('IDRIndicativeRate')[$key]) ? $this->input->post('IDRIndicativeRate')[$key] : 0;
          // $ValasIndicativeRate[$key] = ($this->input->post('ValasIndicativeRate')[$key]) ? $this->input->post('ValasIndicativeRate')[$key] : 0;

          $IDRIndicativeRate[$key] = 0;
          if (!empty($this->input->post('IDRIndicativeRate')[$key])) {
            $IDRIndicativeRate[$key] = str_replace(',', '', $this->input->post('IDRIndicativeRate')[$key]);
          }

          $ValasIndicativeRate[$key] = 0;
          if (!empty($this->input->post('ValasIndicativeRate')[$key])) {
            $ValasIndicativeRate[$key] = str_replace(',', '', $this->input->post('ValasIndicativeRate')[$key]);
          }

          $IDRIncomeExpense[$key] = 0;
          if (!empty($this->input->post('IDRIncomeExpense')[$key])) {
            $IDRIncomeExpense[$key] = str_replace(',', '', $this->input->post('IDRIncomeExpense')[$key]);
          }
          
          $ValasIncomeExpense[$key] = 0;
          if (!empty($this->input->post('ValasIncomeExpense')[$key])) {
            $ValasIncomeExpense[$key] = str_replace(',', '', $this->input->post('ValasIncomeExpense')[$key]);
          }
          
          $IDRProvisionRate[$key] = ($this->input->post('IDRProvisionRate')[$key]) ? $this->input->post('IDRProvisionRate')[$key] : 0;
          $ValasProvisionRate[$key] = ($this->input->post('ValasProvisionRate')[$key]) ? $this->input->post('ValasProvisionRate')[$key] : 0;

          $IDRProvision[$key] = 0;
          if (!empty($this->input->post('IDRProvision')[$key])) {
            $IDRProvision[$key] = str_replace(',', '', $this->input->post('IDRProvision')[$key]);
          }
          
          $ValasProvision[$key] = 0;
          if (!empty($this->input->post('ValasProvision')[$key])) {
            $ValasProvision[$key] = str_replace(',', '', $this->input->post('ValasProvision')[$key]);
          }

          $IDRFee[$key] = 0;
          if (!empty($this->input->post('IDRFee')[$key])) {
            $IDRFee[$key] = str_replace(',', '', $this->input->post('IDRFee')[$key]);
          }
          
          $ValasFee[$key] = 0;
          if (!empty($this->input->post('ValasFee')[$key])) {
            $ValasFee[$key] = str_replace(',', '', $this->input->post('ValasFee')[$key]);
          }

          $IDRBebanBunga[$key] = 0;
          if (!empty($this->input->post('IDRBebanBunga')[$key])) {
            $IDRBebanBunga[$key] = str_replace(',', '', $this->input->post('IDRBebanBunga')[$key]);
          }
          
          $ValasBebanBunga[$key] = 0;
          if (!empty($this->input->post('ValasBebanBunga')[$key])) {
            $ValasBebanBunga[$key] = str_replace(',', '', $this->input->post('ValasBebanBunga')[$key]);
          }

          $data_form[$key] = array (
            'InputTable'              => $this->input->post('InputTable')
            , 'InputTableSubmit'      => $this->input->post('CreditSimulationSubmit')
            , 'InputTableIdField'     => 'CreditSimulationId'
            , 'InputTableIdValue'     => $this->input->post('CreditSimulationId')[$key]
          );

          $data_input[$key] = array (
            'BankFacilityItemId'        => $value
            , 'AccountPlanningId'       => $this->input->post('AccountPlanningId')
            , 'IDRPlafond'              => $IDRPlafond[$key]
            , 'ValasPlafond'            => $ValasPlafond[$key]
            , 'IDROutstanding'          => $IDROutstanding[$key]
            , 'ValasOutstanding'        => $ValasOutstanding[$key]
            , 'IDRDailyRatas'           => $IDRDailyRatas[$key]
            , 'ValasDailyRatas'         => $ValasDailyRatas[$key]
            , 'IDRTenor'                => $IDRTenor[$key]
            , 'ValasTenor'              => $ValasTenor[$key]
            , 'IDRIndicativeRate'           => $IDRIndicativeRate[$key]
            , 'ValasIndicativeRate'         => $ValasIndicativeRate[$key]
            , 'IDRIncomeExpense'            => $IDRIncomeExpense[$key]
            , 'ValasIncomeExpense'          => $ValasIncomeExpense[$key]
            , 'IDRProvisionRate'            => $IDRProvisionRate[$key]
            , 'ValasProvisionRate'          => $ValasProvisionRate[$key]
            , 'IDRProvision'            => $IDRProvision[$key]
            , 'ValasProvision'          => $ValasProvision[$key]
            , 'IDRFee'                  => $IDRFee[$key]
            , 'ValasFee'                => $ValasFee[$key]
            , 'IDRBebanBunga'                  => $IDRBebanBunga[$key]
            , 'ValasBebanBunga'                => $ValasBebanBunga[$key]
            , 'CreatedDate'             => $this->current_datetime
            , 'CreatedBy'               => $this->session->PERSONAL_NUMBER
            );

          $data_edit[$key] = array (
            'BankFacilityItemId'        => $value
            , 'AccountPlanningId'       => $this->input->post('AccountPlanningId')
            , 'IDRPlafond'              => $IDRPlafond[$key]
            , 'ValasPlafond'            => $ValasPlafond[$key]
            , 'IDROutstanding'          => $IDROutstanding[$key]
            , 'ValasOutstanding'        => $ValasOutstanding[$key]
            , 'IDRDailyRatas'           => $IDRDailyRatas[$key]
            , 'ValasDailyRatas'         => $ValasDailyRatas[$key]
            , 'IDRTenor'                => $IDRTenor[$key]
            , 'ValasTenor'              => $ValasTenor[$key]
            , 'IDRIndicativeRate'           => $IDRIndicativeRate[$key]
            , 'ValasIndicativeRate'         => $ValasIndicativeRate[$key]
            , 'IDRIncomeExpense'            => $IDRIncomeExpense[$key]
            , 'ValasIncomeExpense'          => $ValasIncomeExpense[$key]
            , 'IDRProvisionRate'            => $IDRProvisionRate[$key]
            , 'ValasProvisionRate'          => $ValasProvisionRate[$key]
            , 'IDRProvision'            => $IDRProvision[$key]
            , 'ValasProvision'          => $ValasProvision[$key]
            , 'IDRFee'                  => $IDRFee[$key]
            , 'ValasFee'                => $ValasFee[$key]
            , 'IDRBebanBunga'                  => $IDRBebanBunga[$key]
            , 'ValasBebanBunga'                => $ValasBebanBunga[$key]
            , 'ModifiedDate'             => $this->current_datetime
            , 'ModifiedBy'               => $this->session->PERSONAL_NUMBER
            );

          if ($data_form[$key]['InputTableSubmit'] == 'edit') {
            $updateData = $this->TasklistAccountPlanning_model->updateData($data_form[$key]['InputTable'], $data_edit[$key], $data_form[$key]['InputTableIdField'], $data_form[$key]['InputTableIdValue']);
          }
          else {
            $insertData = $this->TasklistAccountPlanning_model->insertData($data_form[$key]['InputTable'], $data_input[$key]);
          }
        }

      }
      if (!empty($updateData)) {
        echo json_encode($updateData);
      }
      elseif (!empty($insertData)) {
        echo json_encode($insertData);
      }
    }

    // FinancialHighlight
    if (!empty($this->input->post('FinancialHighlightItemId'))) {
      foreach ($this->input->post('FinancialHighlightItemId') as $key => $value) {
        $FinancialHighlightItemId =  $value;
        $AccountPlanningId = $this->input->post('AccountPlanningId');
        foreach ($Years as $keys => $values) {
          $Amount = 0;
          if (!empty($this->input->post('Amount')[$values][$FinancialHighlightItemId])) {
            $Amount = str_replace(',', '', $this->input->post('Amount')[$values][$FinancialHighlightItemId]);
          }
          if ($FinancialHighlightItemId == 3) {
            $Amount1 = str_replace(',', '', $this->input->post('Amount')[$values][1]);
            $Amount2 = str_replace(',', '', $this->input->post('Amount')[$values][2]);
            $Amount = $Amount1 + $Amount2;
          }
          $data_input[$FinancialHighlightItemId][$values] = array (
            'FinancialHighlightItemId'  => $FinancialHighlightItemId
            , 'AccountPlanningId'         => $AccountPlanningId
            , 'Year'                      => $values
            , 'Amount'                    => $Amount
            , 'CreatedDate'               => $this->current_datetime
            , 'CreatedBy'                 => $this->session->PERSONAL_NUMBER
          );
          $data_edit[$FinancialHighlightItemId][$values] = array (
            'FinancialHighlightItemId'  => $FinancialHighlightItemId
            , 'AccountPlanningId'         => $AccountPlanningId
            , 'Year'                      => $values
            , 'Amount'                    => $Amount
            , 'ModifiedDate'               => $this->current_datetime
            , 'ModifiedBy'                 => $this->session->PERSONAL_NUMBER
          );
          if ($this->input->post('FinancialHighlightSubmit') == 'add') {
            $insertData = $this->TasklistAccountPlanning_model->insertDataFinancialHighlight($this->input->post('InputTable'), $data_input[$FinancialHighlightItemId][$values]);
          }
          else {
            $updateData = $this->TasklistAccountPlanning_model->updateDataFinancialHighlight($this->input->post('InputTable'), $data_edit[$FinancialHighlightItemId][$values], 'FinancialHighlightId', $this->input->post('FinancialHighlightId')[$values][$key]);
          }
        }
      }
      $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating financial highlight on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
    }

    // echo "<pre>";
    // print_r($this->input->post());
    // print_r($data_form);
    // print_r($data_input);
    // print_r($data_formAddition);
    // print_r($data_inputAddition);
    // die();
  }

  public function inputform($AccountPlanningId, $AccountPlanningTab, $BankFacilityGroupType, $BankFacilityGroupId, $VCIF='' ) {
    if ($this->session->isCST == 0) {
      $this->checkModule();
      // $this->checkOwner($AccountPlanningId);
    }

    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId']        = $AccountPlanningId;
    $data['AccountPlanningTab']       = $AccountPlanningTab;
    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);
    $data['account_planning']['Years'] = Array(  
                                                $data['account_planning']['Year'] - 3,
                                                $data['account_planning']['Year'] - 2,
                                                $data['account_planning']['Year'] - 1
                                        );
    $data['FinancialHighlight']['Currency'] = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlightCurrency($AccountPlanningId);
    $data['FinancialHighlight']['class_usd1'] = 'primary';
    $data['FinancialHighlight']['class_idr1'] = 'default';
    if ($data['FinancialHighlight']['Currency'] == 'IDR') {
      $data['FinancialHighlight']['class_usd1'] = 'default';
      $data['FinancialHighlight']['class_idr1'] = 'primary';
    }

    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

    // FinancialHighlight
    if ($BankFacilityGroupType == 'financial_highlights') {
      $data['FinancialHighlightGroupType']    = $BankFacilityGroupType;
      $data['FinancialHighlightGroupId']      = $BankFacilityGroupId;
      $data['FinancialHighlightSubmit']       = 'add';

      $FinancialHighlightItem = $this->TasklistAccountPlanning_model->getAccountPlanningFinancialHighlightItem($BankFacilityGroupId);
      $data['FinancialHighlightGroupName']    = $FinancialHighlightItem[0]['FinancialHighlightGroupName'];
      foreach ($FinancialHighlightItem as $key => $value) {
        $inputform_type = 'money';
        if ($value['FinancialHighlightItemId'] == 3) {
          $inputform_type = 'total';
        }
        if ($value['FinancialHighlightItemId'] == 13 || $value['FinancialHighlightItemId'] == 21 || $value['FinancialHighlightItemId'] == 23) {
          $inputform_type = 'portion';
        }
        else if ($value['FinancialHighlightItemId'] == 12 ||  $value['FinancialHighlightItemId'] == 18 || $value['FinancialHighlightItemId'] == 19 || $value['FinancialHighlightItemId'] == 20 || $value['FinancialHighlightItemId'] == 22 || $value['FinancialHighlightItemId'] == 21) {
          $inputform_type = 'portion2';
        }
        $data['inputform'][$BankFacilityGroupType][$value['FinancialHighlightItemId']]= array(
          'FinancialHighlightItemId'              => $value['FinancialHighlightItemId']
          , 'FinancialHighlightItemName'          => $value['FinancialHighlightItemName']
          , 'FinancialHighlight_inputform_type'   => $inputform_type
          );
        foreach ($data['account_planning']['Years'] as $keyss => $valuess) {
          $data['inputform'][$BankFacilityGroupType][$value['FinancialHighlightItemId']][$valuess] = array(
              'Amount'                        => ''
              , 'FinancialHighlightId'        => 0
            );
        }

        $dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningFinancialHighlight($AccountPlanningId, $value['FinancialHighlightItemId'], $data['account_planning']['Years']);
        if (!empty($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']])) {
          foreach ($dataFinancialHighlightItem[$value['FinancialHighlightGroupId']] as $keys => $values) {
            $data['FinancialHighlightSubmit'] = 'edit';
            $data['inputform'][$BankFacilityGroupType][$value['FinancialHighlightItemId']][$values['Year']] = array(
              'Amount'                        => $values['Amount']
              , 'FinancialHighlightId'        => $values['FinancialHighlightId']
              );
          }
        }
      }
    }
    // facilities banking
    else if ($BankFacilityGroupType == 'facilities_banking') {
      $data['BankFacilityGroupType']                    = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                      = $BankFacilityGroupId;
      $data['VCIF']                                     = $VCIF;
      $data['BankFacilitySubmit']                       = 'add';
      $dataBankFacilityItem = $this->TasklistAccountPlanning_model->getAccountPlanningBankFacilityItem($BankFacilityGroupId);
      $data['BankFacilityGroupName']    = $dataBankFacilityItem[0]['BankFacilityGroupName'];

      foreach ($dataBankFacilityItem as $key => $value) {

        $dataBankFacility[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $VCIF);

        $data['CompanyName']               = '';
          $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['BankFacility_detail'][$value['BankFacilityItemId']] = array(
            'BankFacilityId'              => 0
            , 'BankFacilityItemId'        => $value['BankFacilityItemId']
            , 'BankFacilityItemName'      => $value['BankFacilityItemName']
            , 'IDRAmount'                 => 0
            , 'IDRRate'                   => 0
            , 'ValasAmount'               => 0
            , 'ValasRate'                 => 0
            , 'BankFacilitySubmit'        => 'add'
          );

        if (isset($dataBankFacility[$value['BankFacilityGroupId']][0])) {
          $data['CompanyName']                = $dataBankFacility[$value['BankFacilityGroupId']][0]['CompanyName'];
            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['BankFacility_detail'][$value['BankFacilityItemId']] = array(
              'BankFacilityId'                => $dataBankFacility[$value['BankFacilityGroupId']][0]['BankFacilityId']
              , 'BankFacilityItemId'          => $value['BankFacilityItemId']
              , 'BankFacilityItemName'        => $value['BankFacilityItemName']
              , 'IDRAmount'                   => $dataBankFacility[$value['BankFacilityGroupId']][0]['IDRAmount']
              , 'IDRRate'                     => $dataBankFacility[$value['BankFacilityGroupId']][0]['IDRRate']
              , 'ValasAmount'                 => $dataBankFacility[$value['BankFacilityGroupId']][0]['ValasAmount']
              , 'ValasRate'                   => $dataBankFacility[$value['BankFacilityGroupId']][0]['ValasRate']
              , 'BankFacilitySubmit'          => 'edit'
            );
        }

      // facilities banking Addition
        $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $VCIF, $value['BankFacilityGroupId']);


        if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF])) {
          foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF] as $keyssss => $BankFacilityItemAddition) {
            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'BankFacilityAdditionId'              => 0
                , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                , 'IDRAmountAddition'                 => 0
                , 'IDRRateAddition'                   => 0
                , 'ValasAmountAddition'               => 0
                , 'ValasRateAddition'                 => 0
                , 'BankFacilityAdditionSubmit'        => 'add'
              );

            $dataBankFacilityAddition[$value['BankFacilityGroupId']][$VCIF][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $VCIF);

            foreach ($dataBankFacilityAddition[$value['BankFacilityGroupId']][$VCIF][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $BankFacilityAddition) {
              $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                  'BankFacilityAdditionId'              => $BankFacilityAddition['BankFacilityAdditionId']
                  , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                  , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                  , 'IDRAmountAddition'                 => $BankFacilityAddition['IDRAmountAddition']
                  , 'IDRRateAddition'                   => $BankFacilityAddition['IDRRateAddition']
                  , 'ValasAmountAddition'               => $BankFacilityAddition['ValasAmountAddition']
                  , 'ValasRateAddition'                 => $BankFacilityAddition['ValasRateAddition']
                  , 'BankFacilityAdditionSubmit'        => 'edit'
                );

            }

          }
        }

      }
    }
    // Estimated Financial
    else if ($BankFacilityGroupType == 'estimated_financial') {
      $data['BankFacilityGroupType']                    = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                      = $BankFacilityGroupId;
      $data['VCIF']                                     = $VCIF;
      $data['EstimatedFinancialSubmit']                 = 'add';
      $dataBankFacilityItem = $this->TasklistAccountPlanning_model->getAccountPlanningBankFacilityItem($BankFacilityGroupId);
      $data['BankFacilityGroupName']    = $dataBankFacilityItem[0]['BankFacilityGroupName'];

      foreach ($dataBankFacilityItem as $key => $value) {

        $dataEstimatedFinancial[$value['BankFacilityGroupId']] = $this->TasklistAccountPlanning_model->getAccountPlanningEstimatedFinancial($AccountPlanningId, $value['BankFacilityItemId'], $VCIF);

        $data['CompanyName']                = '';
          $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$value['BankFacilityItemId']] = array(
            'EstimatedFinancialId'        => 0
            , 'BankFacilityItemId'        => $value['BankFacilityItemId']
            , 'BankFacilityItemName'      => $value['BankFacilityItemName']
            , 'IDRProjection'             => ''
            , 'IDRTarget'                 => ''
            , 'ValasProjection'           => ''
            , 'ValasTarget'               => ''
            , 'EstimatedFinancialSubmit'  => 'add'
          );

        if (isset($dataEstimatedFinancial[$value['BankFacilityGroupId']][0])) {
          $data['CompanyName']                = $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['CompanyName'];
            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['EstimatedFinancial_detail'][$value['BankFacilityItemId']] = array(
              'EstimatedFinancialId'          => $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['EstimatedFinancialId']
              , 'BankFacilityItemId'          => $value['BankFacilityItemId']
              , 'BankFacilityItemName'        => $value['BankFacilityItemName']
              , 'IDRProjection'               => $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['IDRProjection']
              , 'IDRTarget'                   => $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['IDRTarget']
              , 'ValasProjection'             => $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['ValasProjection']
              , 'ValasTarget'                 => $dataEstimatedFinancial[$value['BankFacilityGroupId']][0]['ValasTarget']
              , 'EstimatedFinancialSubmit'    => 'edit'
            );
        }

      // Estimated Financial Addition
        $dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $VCIF, $value['BankFacilityGroupId']);


        if (isset($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF])) {
          foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']][$VCIF] as $keyssss => $BankFacilityItemAddition) {

            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
              'EstimatedFinancialAdditionId'        => 0
              , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
              , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
              , 'IDRProjectionAddition'             => ''
              , 'IDRTargetAddition'                 => ''
              , 'ValasProjectionAddition'           => ''
              , 'ValasTargetAddition'               => ''
              , 'EstimatedFinancialAdditionSubmit'  => 'add'
              );

            $dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$VCIF][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningEstimatedFinancialAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $VCIF);

            foreach ($dataEstimatedFinancialAddition[$value['BankFacilityGroupId']][$VCIF][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $EstimatedFinancialAddition) {

              $data['EstimatedFinancialAdditionSubmit']       = 'edit';
              $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['EstimatedFinancialAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'EstimatedFinancialAdditionId'           => $EstimatedFinancialAddition['EstimatedFinancialAdditionId']
                , 'BankFacilityItemAdditionName'         => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                , 'BankFacilityItemAdditionId'           => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                , 'IDRProjectionAddition'                => $EstimatedFinancialAddition['IDRProjectionAddition']
                , 'IDRTargetAddition'                    => $EstimatedFinancialAddition['IDRTargetAddition']
                , 'ValasProjectionAddition'              => $EstimatedFinancialAddition['ValasProjectionAddition']
                , 'ValasTargetAddition'                  => $EstimatedFinancialAddition['ValasTargetAddition']
                , 'EstimatedFinancialAdditionSubmit'     => 'edit'
              );
            }
          }
        }
      }
    }
    // Initiative Action
    else if ($BankFacilityGroupType == 'initiatives_action') {
      $data['AccountPlanningSubTab']        = $BankFacilityGroupType;
      $data['CustomerKorporasi']            = $this->PerformanceAccountPlanning_model->getCustomerByVCIF($VCIF);
      $data['CustomerName']                 = $data['CustomerKorporasi']['Name'];
      $data['VCIF']                         = $VCIF;
      $data['InitiativeActionSubmit']       = 'add';

      $data['inputform']['InitiativeAction'][$VCIF] = $this->PerformanceAccountPlanning_model->getAccountPlanningInitiativeAction($AccountPlanningId, $VCIF);
      if (!empty($data['inputform']['InitiativeAction'][$VCIF])) {
        $data['InitiativeActionSubmit']       = 'edit';
      }
    }
    // Fundings
    else if ($BankFacilityGroupType == 'fundings') {
      $data['AccountPlanningSubTab']        = $BankFacilityGroupType;
      $data['CustomerKorporasi']            = $this->PerformanceAccountPlanning_model->getCustomerByVCIF($VCIF);
      $data['CustomerName']                 = $data['CustomerKorporasi']['Name'];
      $data['VCIF']                         = $VCIF;
      $data['FundingSubmit']                = 'add';
      $data['inputform']['Funding'][$VCIF] = $this->PerformanceAccountPlanning_model->getAccountPlanningFunding($AccountPlanningId, $VCIF);
      if (!empty($data['inputform']['Funding'][$VCIF])) {
        $data['FundingSubmit']       = 'edit';
      }
    }
    // services
    else if ($BankFacilityGroupType == 'services') {
      $data['AccountPlanningSubTab']        = $BankFacilityGroupType;
      $data['CustomerKorporasi']            = $this->PerformanceAccountPlanning_model->getCustomerByVCIF($VCIF);
      $data['CustomerName']                 = $data['CustomerKorporasi']['Name'];
      $data['VCIF']                         = $VCIF;
      $data['FundingSubmit']                = 'add';
      $data_uker_list = $this->MonitoringAccountPlanning_model->get_ukers();
      $data['inputform']['Service']['uker_list'][''] = '';
      foreach ($data_uker_list as $uker) {
        $data['inputform']['Service']['uker_list'][$uker['UnitKerjaId']] = $uker['Name'];
      }
      $dataService = $this->PerformanceAccountPlanning_model->getAccountPlanningService($AccountPlanningId, $VCIF);
      foreach ($dataService as $key => $value) {
        $TagServiceUnitKerja = $this->PerformanceAccountPlanning_model->getAccountPlanningServiceTag($value['ServiceId']);
        $TagServiceUnitKerjaId = array();
        foreach ($TagServiceUnitKerja as $keys => $values) {
          $TagServiceUnitKerjaId[$keys] = $values['UnitKerjaId'];
        }

        $data['inputform']['Service']['dataService'][] = array(
            'ServiceId'               => $value['ServiceId'],
            'ServiceName'             => $value['ServiceName'],
            'ServiceTarget'           => $value['Target'],
            'ServiceDescription'      => $value['Description'],
            'data_uker_list'          => $data_uker_list,
            'TagServiceUnitKerja'     => $TagServiceUnitKerja,
            'TagServiceUnitKerjaId'   => $TagServiceUnitKerjaId
            );
      }
    }
    // Wallet Share
    else if ($BankFacilityGroupType == "wallet_share"){
      $data['BankFacilityGroupType']                    = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                      = $BankFacilityGroupId;
      $data['VCIF']                                     = $VCIF;
      $data['WalletSharesSubmit']                       = 'add';
      $dataBankFacilityItem = $this->TasklistAccountPlanning_model->getAccountPlanningBankFacilityItem($BankFacilityGroupId);      
      $data['BankFacilityGroupName']    = $dataBankFacilityItem[0]['BankFacilityGroupName'];

      foreach ($dataBankFacilityItem as $key => $value) {
        // Get Total Amount 
        $rsWalletShare = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($AccountPlanningId, $value['BankFacilityItemId'], $VCIF);
        // echo json_encode($rsWalletShare); die;
        if(!empty($rsWalletShare)){
          $totalAmount    = $rsWalletShare[0]["TotalAmount"];
          $walletShareId  = $rsWalletShare[0]["WalletShareId"];
          $BRINominal     = $rsWalletShare[0]["BRINominal"];
          $BRIPortion     = $rsWalletShare[0]["BRIPortion"];
          $OtherNominal   = $rsWalletShare[0]["OtherNominal"];
          $OtherPortion   = $rsWalletShare[0]["OtherPortion"];
          $walletShareSubmit = "edit";
        }else {
          $totalAmount    = 0;
          $walletShareId  = 0;
          $BRINominal     = 0;
          $BRIPortion     = 0;
          $OtherNominal   = 0;
          $OtherPortion   = 0;
          $walletShareSubmit = "add";
        }


        /* Get IDR and Valas Amount From Facilities With Banking */
        /*

        $rsBankFacility = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $VCIF);
        if(!empty($rsBankFacility)){
          $IDRAmount = $rsBankFacility[0]["IDRAmount"];
          $ValasAmount = $rsBankFacility[0]["ValasAmount"];
          $BRINominal = $IDRAmount + $ValasAmount;
        }else {
          $BRINominal = 0;
        }
        // Calculate Portion and Other Nominal 
        if($totalAmount == 0){
          $BRIPortion = 0;
          $OtherNominal = 0;
          $OtherPortion = 0;
        }else{
          if($BRINominal > $totalAmount){
            $OtherNominal = 0;
            $BRIPortion = 100;
            $OtherPortion = 0;
          }else{
            $OtherNominal = $totalAmount - $BRINominal;
            $BRIPortion = ($BRINominal/$totalAmount)*100;
            $OtherPortion = ($OtherNominal/$totalAmount)*100;
          }
        }
        */
        //echo json_encode($rsBankFacility); die;
        $data['CompanyName'] = '';
        $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['WalletShares_detail'][$value['BankFacilityItemId']] = array(
          'WalletShareId'              => $walletShareId
          , 'BankFacilityItemId'        => $value['BankFacilityItemId']
          , 'BankFacilityItemName'      => $value['BankFacilityItemName']
          , 'BRINominal'                => $BRINominal
          , 'BRIPortion'                => $BRIPortion
          , 'OtherNominal'              => $OtherNominal
          , 'OtherPortion'              => $OtherPortion
          , 'TotalAmount'               => $totalAmount
          , 'WalletShareSubmit'         => $walletShareSubmit
        );
      }

      // echo "<pre>";
      // print_r($rsBankFacility);
      // print_r($data['inputform']); die;

      /* Wallet Share Addition */
      $rsBankFacilityAddition = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $VCIF, $value['BankFacilityGroupId']);
      //echo json_encode($rsBankFacilityAddition); die;
      if (!empty($rsBankFacilityAddition)) {
        foreach ($rsBankFacilityAddition as $keyssss => $BankFacilityItemAddition) {
          $rsWalletShareAddition = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $VCIF);
          if(!empty($rsWalletShareAddition)){
            $totalAmount    = $rsWalletShareAddition[0]["TotalAmountAddition"];
            $walletShareId  = $rsWalletShareAddition[0]["WalletShareAdditionId"];
            $BRINominal     = $rsWalletShareAddition[0]["BRINominalAddition"];
            $BRIPortion     = $rsWalletShareAddition[0]["BRIPortionAddition"];
            $OtherNominal   = $rsWalletShareAddition[0]["OtherNominalAddition"];
            $OtherPortion   = $rsWalletShareAddition[0]["OtherPortionAddition"];
            $walletShareSubmit = "edit";
          }else {
            $totalAmount    = 0;
            $walletShareId  = 0;
            $BRINominal     = 0;
            $BRIPortion     = 0;
            $OtherNominal   = 0;
            $OtherPortion   = 0;
            $walletShareSubmit = "add";
          }

          /*
          if(!empty($rsWalletShareAddition)){
            $totalAmount = str_replace(',', '', $rsWalletShareAddition[0]["TotalAmountAddition"]);
            $walletShareId = str_replace(',', '', $rsWalletShareAddition[0]["WalletShareAdditionId"]);
            $walletShareSubmit = "edit";
          }else {
            $totalAmount = 0;
            $walletShareId = 0;
            $walletShareSubmit = "add";
          }
          $rsBankFacilityAddition = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $VCIF);
          if(!empty($rsBankFacilityAddition)){
            $IDRAmount = str_replace(',', '', $rsBankFacilityAddition[0]["IDRAmountAddition"]);
            $ValasAmount = str_replace(',', '', $rsBankFacilityAddition[0]["ValasAmountAddition"]);
            $BRINominal = $IDRAmount + $ValasAmount;
          }else {
            $BRINominal = 0;
          }
          if($totalAmount == 0){
            $BRIPortion = 0;
            $OtherNominal = 0;
            $OtherPortion = 0;
          }else{
            if($BRINominal > $totalAmount){
              $OtherNominal = 0;
              $BRIPortion = 100;
              $OtherPortion = 0;
            }else{
              $OtherNominal = $totalAmount - $BRINominal;
              $BRIPortion = ($BRINominal/$totalAmount)*100;
              $OtherPortion = ($OtherNominal/$totalAmount)*100;
            }
          }
          */
          $data['inputform'][$BankFacilityGroupType][$value['BankFacilityGroupId']]['WalletSharesAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
            'WalletShareAdditionId'              => $walletShareId
            , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
            , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
            , 'BRINominalAddition'                => $BRINominal
            , 'BRIPortionAddition'                => $BRIPortion
            , 'OtherNominalAddition'              => $OtherNominal
            , 'OtherPortionAddition'              => $OtherPortion
            , 'TotalAmountAddition'               => $totalAmount
            , 'WalletShareSubmitAddition'         => $walletShareSubmit
          );
        }
      }
      //echo json_encode($rBankFacilityAddition); die;

      //echo json_encode($data); die;
    }

    // CreditSimulationAssumption
    else if ($BankFacilityGroupType == "assumption"){
      $data['BankFacilityGroupType']                  = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                    = $BankFacilityGroupId;
      $data['CreditSimulationAssumptionSubmit']       = 'add';

      $data['account_planning']['CreditSimulationAssumption'] = array(
        'CreditSimulationAssumptionId'                => 0,
        'USDExchange'                                 => 0,
        'IDRFTPSimpanan'                              => 0,
        'ValasFTPSimpanan'                            => 0,
        'IDRFTPPinjaman'                              => 0,
        'ValasFTPPinjaman'                            => 0
        );


      $dataCreditAssumption = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditAssumption($AccountPlanningId);
      if (!empty($dataCreditAssumption)) {
        $data['CreditSimulationAssumptionSubmit']         = 'edit';
        $data['account_planning']['CreditSimulationAssumption'] = array(
            'CreditSimulationAssumptionId'                => $dataCreditAssumption[0]['CreditSimulationAssumptionId'],
            'USDExchange'                                 => $dataCreditAssumption[0]['USDExchange'],
            'IDRFTPSimpanan'                              => $dataCreditAssumption[0]['IDRFTPSimpanan'],
            'ValasFTPSimpanan'                            => $dataCreditAssumption[0]['ValasFTPSimpanan'],
            'IDRFTPPinjaman'                              => $dataCreditAssumption[0]['IDRFTPPinjaman'],
            'ValasFTPPinjaman'                            => $dataCreditAssumption[0]['ValasFTPPinjaman']
            );
      }
    }
    // Credit Simulation
    else if ($BankFacilityGroupType == 'credit_simulation') {
      $data['BankFacilityGroupType']                  = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                    = $BankFacilityGroupId;
      $data['CreditSimulationSubmit']                 = 'add';

      $dataBankFacilityItem = $this->TasklistAccountPlanning_model->getAccountPlanningBankFacilityItem($BankFacilityGroupId);
      foreach ($dataBankFacilityItem as $key => $value) {

        $dataCreditSimulation[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulation($AccountPlanningId, $value['BankFacilityItemId']);
        $data['BankFacilityGroupName']    = $dataBankFacilityItem[0]['BankFacilityGroupName'];

        $IDRPlafond   = 0;
        $ValasPlafond = 0;
        $dataCreditSimulationPlafondSum[$BankFacilityGroupId] = $this->AccountPlanningCalculate_model->getCreditSimulationPlafondSum($AccountPlanningId, $value['BankFacilityItemId']);
        if (!empty($dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']])) {
          $IDRPlafond   = $dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']]['IDRPlafond'];
          $ValasPlafond = $dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']]['ValasPlafond'];
        }

        $IDRFTPSimpanan   = 0;
        $ValasFTPSimpanan = 0;
        $dataCreditAssumption = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditAssumption($AccountPlanningId);
        if (!empty($dataCreditAssumption)) {
          $IDRFTPSimpanan   = $dataCreditAssumption[0]['IDRFTPSimpanan'];
          $ValasFTPSimpanan = $dataCreditAssumption[0]['ValasFTPSimpanan'];
        }

        $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']] = array(
          'CreditSimulationId'              => 0
          , 'BankFacilityItemId'            => $value['BankFacilityItemId']
          , 'BankFacilityItemName'          => $value['BankFacilityItemName']
          , 'IDRFTPSimpanan'                => $IDRFTPSimpanan
          , 'ValasFTPSimpanan'              => $ValasFTPSimpanan
          , 'IDRPlafond'                    => $IDRPlafond
          , 'ValasPlafond'                  => $ValasPlafond
          , 'IDROutstanding'                => 0
          , 'ValasOutstanding'              => 0
          , 'IDRDailyRatas'                 => 0
          , 'ValasDailyRatas'               => 0
          , 'IDRTenor'                      => 0
          , 'ValasTenor'                    => 0
          , 'IDRIndicativeRate'             => 0
          , 'ValasIndicativeRate'           => 0
          , 'IDRIncomeExpense'              => 0
          , 'ValasIncomeExpense'            => 0
          , 'IDRProvisionRate'              => 0
          , 'ValasProvisionRate'            => 0
          , 'IDRProvision'                  => 0
          , 'ValasProvision'                => 0
          , 'IDRFee'                        => 0
          , 'ValasFee'                      => 0
          , 'IDRBebanBunga'                 => 0
          , 'ValasBebanBunga'               => 0
          );

        if (!empty($dataCreditSimulation[$value['BankFacilityGroupId']])) {
          $data['CreditSimulationSubmit']         = 'edit';
          foreach ($dataCreditSimulation[$value['BankFacilityGroupId']] as $keys => $values) {
            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']] = array(
              'CreditSimulationId'              => $values['CreditSimulationId']
              , 'BankFacilityItemId'            => $value['BankFacilityItemId']
              , 'BankFacilityItemName'          => $value['BankFacilityItemName']
              , 'IDRFTPSimpanan'                => $IDRFTPSimpanan
              , 'ValasFTPSimpanan'              => $ValasFTPSimpanan
              , 'IDRPlafond'                    => $IDRPlafond
              , 'ValasPlafond'                  => $ValasPlafond
              , 'IDROutstanding'                => $values['IDROutstanding']
              , 'ValasOutstanding'              => $values['ValasOutstanding']
              , 'IDRDailyRatas'                 => $values['IDRDailyRatas']
              , 'ValasDailyRatas'               => $values['ValasDailyRatas']
              , 'IDRTenor'                      => $values['IDRTenor']
              , 'ValasTenor'                    => $values['ValasTenor']
              , 'IDRIndicativeRate'             => $values['IDRIndicativeRate']
              , 'ValasIndicativeRate'           => $values['ValasIndicativeRate']
              , 'IDRIncomeExpense'              => $values['IDRIncomeExpense']
              , 'ValasIncomeExpense'            => $values['ValasIncomeExpense']
              , 'IDRProvisionRate'              => $values['IDRProvisionRate']
              , 'ValasProvisionRate'            => $values['ValasProvisionRate']
              , 'IDRProvision'                  => $values['IDRProvision']
              , 'ValasProvision'                => $values['ValasProvision']
              , 'IDRFee'                        => $values['IDRFee']
              , 'ValasFee'                      => $values['ValasFee']
              , 'IDRBebanBunga'                 => $values['IDRBebanBunga']
              , 'ValasBebanBunga'               => $values['ValasBebanBunga']
              );
          }
        }
      }

    // Credit Simulation Addition
      $data['CreditSimulationSubmitAddition']                 = 'add';
      $dataBankFacilityItemAddition[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, '', $BankFacilityGroupId);

      if (!empty($dataBankFacilityItemAddition[$value['BankFacilityGroupId']])) {
        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']] as $keysssss => $BankFacilityItemAddition) {

          $IDRPlafondAddition   = 0;
          $ValasPlafondAddition = 0;
          $dataCreditSimulationAdditionPlafondSum[$value['BankFacilityGroupId']] = $this->AccountPlanningCalculate_model->getCreditSimulationAdditionPlafondSum($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId']);
          if (!empty($dataCreditSimulationAdditionPlafondSum[$value['BankFacilityGroupId']])) {
            $IDRPlafondAddition   = $dataCreditSimulationAdditionPlafondSum[$BankFacilityItemAddition['BankFacilityGroupId']]['IDRPlafondAddition'];
            $ValasPlafondAddition = $dataCreditSimulationAdditionPlafondSum[$BankFacilityItemAddition['BankFacilityGroupId']]['ValasPlafondAddition'];
          }

          $data['inputform'][$BankFacilityGroupType.'_addition'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
            'CreditSimulationAdditionId'          => 0
            , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
            , 'BankFacilityItemAdditionName'      => $BankFacilityItemAddition['BankFacilityItemAdditionName']
            , 'IDRPlafondAddition'                => $IDRPlafondAddition
            , 'ValasPlafondAddition'              => $ValasPlafondAddition
            , 'IDROutstandingAddition'            => 0
            , 'ValasOutstandingAddition'          => 0
            , 'IDRDailyRatasAddition'             => 0
            , 'ValasDailyRatasAddition'           => 0
            , 'IDRTenorAddition'                  => 0
            , 'ValasTenorAddition'                => 0
            , 'IDRIndicativeRateAddition'         => 0
            , 'ValasIndicativeRateAddition'       => 0
            , 'IDRIncomeExpenseAddition'          => 0
            , 'ValasIncomeExpenseAddition'        => 0
            , 'IDRProvisionRateAddition'          => 0
            , 'ValasProvisionRateAddition'        => 0
            , 'IDRProvisionAddition'              => 0
            , 'ValasProvisionAddition'            => 0
            , 'IDRFeeAddition'                    => 0
            , 'ValasFeeAddition'                  => 0
            , 'IDRBebanBungaAddition'             => 0
            , 'ValasBebanBungaAddition'           => 0
            );
          $dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulationAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId']);


          if (!empty($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']])) {
            foreach ($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $CreditSimulationAddition) {
              $data['CreditSimulationSubmitAddition']                 = 'edit';

              $data['inputform'][$BankFacilityGroupType.'_addition'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'CreditSimulationAdditionId'               => $CreditSimulationAddition['CreditSimulationAdditionId']
                , 'BankFacilityItemAdditionId'        => $BankFacilityItemAddition['BankFacilityItemAdditionId']
                , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                , 'IDRPlafondAddition'                          => $IDRPlafondAddition
                , 'ValasPlafondAddition'                        => $ValasPlafondAddition
                , 'IDROutstandingAddition'                      => $CreditSimulationAddition['IDROutstandingAddition']
                , 'ValasOutstandingAddition'                      => $CreditSimulationAddition['ValasOutstandingAddition']
                , 'IDRDailyRatasAddition'                      => $CreditSimulationAddition['IDRDailyRatasAddition']
                , 'ValasDailyRatasAddition'                      => $CreditSimulationAddition['ValasDailyRatasAddition']
                , 'IDRTenorAddition'                      => $CreditSimulationAddition['IDRTenorAddition']
                , 'ValasTenorAddition'                      => $CreditSimulationAddition['ValasTenorAddition']
                , 'IDRIndicativeRateAddition'                      => $CreditSimulationAddition['IDRIndicativeRateAddition']
                , 'ValasIndicativeRateAddition'                      => $CreditSimulationAddition['ValasIndicativeRateAddition']
                , 'IDRIncomeExpenseAddition'                      => $CreditSimulationAddition['IDRIncomeExpenseAddition']
                , 'ValasIncomeExpenseAddition'                      => $CreditSimulationAddition['ValasIncomeExpenseAddition']
                , 'IDRProvisionRateAddition'                      => $CreditSimulationAddition['IDRProvisionRateAddition']
                , 'ValasProvisionRateAddition'                      => $CreditSimulationAddition['ValasProvisionRateAddition']
                , 'IDRProvisionAddition'                      => $CreditSimulationAddition['IDRProvisionAddition']
                , 'ValasProvisionAddition'                      => $CreditSimulationAddition['ValasProvisionAddition']
                , 'IDRFeeAddition'                      => $CreditSimulationAddition['IDRFeeAddition']
                , 'ValasFeeAddition'                      => $CreditSimulationAddition['ValasFeeAddition']
                , 'IDRBebanBungaAddition'                      => $CreditSimulationAddition['IDRBebanBungaAddition']
                , 'ValasBebanBungaAddition'                      => $CreditSimulationAddition['ValasBebanBungaAddition']
                );

            }
          }

        }
      }

    }
    // CreditSimulationFee
    else if ($BankFacilityGroupType == 'fee') {
      $data['BankFacilityGroupType']                  = $BankFacilityGroupType;
      $data['BankFacilityGroupId']                    = $BankFacilityGroupId;
      $data['CreditSimulationFeeSubmit']              = 'add';

      $dataSimulationFeeItem = $this->TasklistAccountPlanning_model->getAccountPlanningSimulationFeeItem();
      $dataCreditSimulationFeeSimpananSum = $this->AccountPlanningCalculate_model->getCreditSimulationFeeSimpananSum($AccountPlanningId, 3);
      $dataCreditSimulationFeePinjamanSum = $this->AccountPlanningCalculate_model->getCreditSimulationFeePinjamanSum($AccountPlanningId);
      foreach ($dataSimulationFeeItem as $key => $value) {
        $dataCreditSimulationFee[$value['FeeTypeId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulationFee($AccountPlanningId, $value['FeeTypeId']);

        $IDRAmount   = 0;
        $ValasAmount = 0;
        if ($value['FeeTypeId'] == 1) {
          if (!empty($dataCreditSimulationFeeSimpananSum)) {
            $IDRAmount   = $dataCreditSimulationFeeSimpananSum['IDRAmount'];
            $ValasAmount = $dataCreditSimulationFeeSimpananSum['ValasAmount'];
          }
        }
        if ($value['FeeTypeId'] == 2) {
          if (!empty($dataCreditSimulationFeePinjamanSum)) {
            $IDRAmount   = $dataCreditSimulationFeePinjamanSum['IDRAmount'];
            $ValasAmount = $dataCreditSimulationFeePinjamanSum['ValasAmount'];
          }
        }

        $data['inputform'][$BankFacilityGroupType][$value['FeeTypeId']] = array(
          'FeeTypeId'                             => $value['FeeTypeId'],
          'FeeTypeName'                           => $value['FeeTypeName'],
          'CreditSimulationFeeId'                 => 0,
          'IDRAmount'                             => $IDRAmount,
          'ValasAmount'                           => $ValasAmount
          );

        if (!empty($dataCreditSimulationFee[$value['FeeTypeId']])) {
          $data['CreditSimulationFeeSubmit']          = 'edit';
          $data['inputform'][$BankFacilityGroupType][$value['FeeTypeId']]   = array(
              'FeeTypeId'                             => $value['FeeTypeId'],
              'FeeTypeName'                           => $value['FeeTypeName'],
              'CreditSimulationFeeId'                 => $dataCreditSimulationFee[$value['FeeTypeId']][0]['CreditSimulationFeeId'],
              'IDRAmount'                             => $dataCreditSimulationFee[$value['FeeTypeId']][0]['IDRAmount'],
              'ValasAmount'                           => $dataCreditSimulationFee[$value['FeeTypeId']][0]['ValasAmount']
              );
        }
      }
    }
    else {
      $data['BankFacilityGroupType']    = $BankFacilityGroupType;
      $data['BankFacilityGroupId']      = $BankFacilityGroupId;
      $data['CompetitionAnalysisSubmit']                = 'add';

      $dataBankFacilityItem = $this->TasklistAccountPlanning_model->getAccountPlanningBankFacilityItem($BankFacilityGroupId);
      $dataBankList = $this->TasklistAccountPlanning_model->getBankList();
      foreach ($dataBankList as $keys => $values) {
        $dataBankLists[0] = 'Please Choose';
        $dataBankLists[$values['BankId']] = $values['Name'];
      }

      $data['BankFacilityGroupName']    = $dataBankFacilityItem[0]['BankFacilityGroupName'];

      foreach ($dataBankFacilityItem as $key => $value) {

        $dataCompetitionAnalysis[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountCompetitions($AccountPlanningId, $value['BankFacilityItemId']);

        $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']] = array(
          'BankFacilityItemId'          => $value['BankFacilityItemId']
          , 'CompetitionAnalysisId'     => 0
          , 'BankFacilityItemName'      => $value['BankFacilityItemName']
          , 'BankId1'                   => ''
          , 'BankId2'                   => ''
          , 'BankId3'                   => ''
          );

        if (is_array($dataCompetitionAnalysis[$value['BankFacilityGroupId']])) {
          $data['CompetitionAnalysisSubmit']                = 'edit';
          foreach ($dataCompetitionAnalysis as $keys => $values) {
            $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']] = array(
              'BankFacilityItemId'          => $value['BankFacilityItemId']
              , 'CompetitionAnalysisId'     => $values['CompetitionAnalysisId']
              , 'BankFacilityItemName'      => $value['BankFacilityItemName']
              , 'BankId1'                   => $values['BankId1']
              , 'BankId2'                   => $values['BankId2']
              , 'BankId3'                   => $values['BankId3']
              );
          }
        }

        $data['dataBankLists'][$value['BankFacilityItemId']][1] = form_dropdown('BankId['.$value['BankFacilityItemId'].'][1]', $dataBankLists,   $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']]['BankId1'], ' class="form-control col-md-7 col-xs-12"');
        $data['dataBankLists'][$value['BankFacilityItemId']][2] = form_dropdown('BankId['.$value['BankFacilityItemId'].'][2]', $dataBankLists,   $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']]['BankId2'], ' class="form-control col-md-7 col-xs-12"');
        $data['dataBankLists'][$value['BankFacilityItemId']][3] = form_dropdown('BankId['.$value['BankFacilityItemId'].'][3]', $dataBankLists,   $data['inputform'][$BankFacilityGroupType][$value['BankFacilityItemId']]['BankId3'], ' class="form-control col-md-7 col-xs-12"');

      }
    }

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/inputform/'.$BankFacilityGroupType.'.php', $data); 
    $this->load->view('layout/footer.php');
  }

  public function massCloneAccountPlannings($Year) {
    $this->checkModule();
    $AccountPlanning_list = $this->TasklistMyTask_model->getAccountPlanningByYear($Year);

    foreach ($AccountPlanning_list as $key => $value) {
      if (!empty($value['AccountPlanningId'])) {
        $this->db->trans_begin();
        $duplicateAccountPlanning = $this->TasklistMyTask_model->duplicateAccountPlanning($value['AccountPlanningId'], $value['CreatedBy'], $Year+1);
        // if($duplicateAccountPlanning['status'] == 'error'){
        //   $this->db->trans_rollback();
        // } 
        // else {
          $this->db->trans_commit();
        // }
      }
    }
    echo json_encode($duplicateAccountPlanning);
  }

  public function cloneAccountPlannings($AccountPlanningId) {
    $this->checkModule();

    $UserId = $this->session->PERSONAL_NUMBER;    
    $AccountPlanningYear = $this->TasklistMyTask_model->getAccountPlanningYear($AccountPlanningId);    

    if (!empty($AccountPlanningId)) {
      $this->db->trans_begin();
      $duplicateAccountPlanning = $this->TasklistMyTask_model->duplicateAccountPlanning($AccountPlanningId, $UserId, $AccountPlanningYear['Year']+1);
      if($duplicateAccountPlanning['status'] == 'error'){
        echo json_encode($duplicateAccountPlanning);
      } 
      else {
        $this->db->trans_commit();
        echo json_encode($duplicateAccountPlanning);
      }
    }
    else {
      $error = array(
          'status' => 'error',
          'message'=> 'AccountPlanningId empty'
      );
      echo json_encode($error);
    }

  }

  public function cloneAccountPlanning($AccountPlanningId) {
      $this->checkModule();

    $current_year = $this->current_year+1;
    $UserId = $this->session->PERSONAL_NUMBER;    

    if (!empty($AccountPlanningId)) {
      $this->db->trans_begin();
      $insertAccountPlanningId = $this->TasklistMyTask_model->insertAccountPlanning($current_year, $UserId);
      if($insertAccountPlanningId['status'] == 'error'){
        echo json_encode($insertAccountPlanningId);
      } 
      else {
        $account_planning_vcif_list = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

        foreach ($account_planning_vcif_list as $key => $value) {
          $data[$key] = array(
            'AccountPlanningId'   => $insertAccountPlanningId['message'],
            'VCIF'                => $value['VCIF'],
            'IsMain'              => $value['IsMain'],
            'UserId'              => $UserId,
            'Year'                => $current_year
            );
        }
        
        $insertAPActivity = $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($insertAccountPlanningId['message'], 'Create', 'Creating account planning', $UserId);
        $insertCustomerAP = $this->TasklistMyTask_model->insertCustomerAP($data); 

        if($insertCustomerAP['status']=='error') {
          $this->db->trans_rollback();
          echo json_encode($insertCustomerAP);
        }
        else {
          $insertDataAP = $this->TasklistMyTask_model->cloneData_AccountPlanning($AccountPlanningId, $insertAccountPlanningId['message'], $current_year-2);
          if($insertDataAP['status']=='error') {
            $this->db->trans_rollback();
          }
          else {
            $this->db->trans_commit();
          }
          echo json_encode($insertDataAP);
        }
      }
    }
    else {
      $error = array(
          'status' => 'error',
          'message'=> 'AccountPlanningId empty'
      );
      echo json_encode($error);
    }

  }

  public function view($AccountPlanningId, $AccountPlanningTabType='details', $AccountPlanningTab='') {
    if ($this->session->isCST == 0) {
      $this->checkModule();
      // $this->checkOwner($AccountPlanningId);
    }

    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);

    $ap_breadcrumb_title = 'View';
    if ($data['account_planning']['Year'] == $this->current_year) {
      if ($AccountPlanningTabType == 'input') {
        $AccountPlanningTabType = 'input';
        $ap_breadcrumb_title = 'Input';
      }
    }
    else {
      $AccountPlanningTabType = 'details';
    }
    $ap_tab_type_get = $AccountPlanningTabType;
    $ap_tab_get = ($AccountPlanningTab) ? $AccountPlanningTab : 'company_information';
    $ap_tab_subcontent_get = ($this->uri->segment(7)) ? $this->uri->segment(7) : '';

    $data['ap_breadcrumb_title']                  = $ap_breadcrumb_title;
    $data['AccountPlanningId']                    = $AccountPlanningId;
    $data['AccountPlanningTabType']               = $ap_tab_type_get;
    $data['AccountPlanningTab']                   = $ap_tab_get;
    $data['AccountPlanningTabSubcontent']         = $ap_tab_subcontent_get;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
    $data['account_planning']['Clasifications'] = 'Platinum';

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
    $this->load->view('tasklist/account_planning_ajax.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function view_cpa_projection($AccountPlanningId) {
    $this->checkModule();

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

  public function view_cpa_delta($AccountPlanningId) {
    $this->checkModule();

      $data['Existing'] = $this->DataTransaction_model->getCpaExisting($AccountPlanningId);
      $data['Projection'] = $this->view_cpa_projection($AccountPlanningId);

    // cpa delta simpanan
      $data['Simpanan']['TotalSaldo'] = $data['Projection']['Simpanan']['TotalSaldo'] - $data['Existing']['SaldoSimpanan']; 
      $data['Simpanan']['TotalRatas'] = $data['Projection']['Simpanan']['TotalRatas'] - $data['Existing']['AverageSaldoSimpanan']; 
      $data['Simpanan']['TotalFeeBased'] = $data['Projection']['Simpanan']['TotalFeeBased'] - $data['Existing']['AkumulasiNominalFeeSimpanan']; 
      $data['Simpanan']['TotalBebanBunga'] = $data['Projection']['Simpanan']['TotalBebanBunga'] - $data['Existing']['BebanBunga']; 
      $data['Simpanan']['TotalBebanBunga'] = $data['Projection']['Simpanan']['TotalBebanBunga'] - $data['Existing']['BebanBunga']; 
      $data['Simpanan']['JumlahRekSimpanan'] = 0; 

    // cpa delta pinjaman
      $data['Pinjaman']['NilaiTercatat'] = 0; 
      $data['Pinjaman']['NilaiTercatatRatas'] = 0; 
      $data['Pinjaman']['TotalOutstanding'] = $data['Projection']['Pinjaman']['TotalOutstanding'] - $data['Existing']['BakiDebet']; 
      $data['Pinjaman']['TotalDailyRatas'] = $data['Projection']['Pinjaman']['TotalDailyRatas'] - $data['Existing']['BakiDebetRatas']; 
      $data['Pinjaman']['TotalPlafond'] = $data['Projection']['Pinjaman']['TotalPlafond'] - $data['Existing']['PlafonEfektif']; 
      $data['Pinjaman']['TotalTarik'] = $data['Projection']['Pinjaman']['TotalTarik'] - $data['Existing']['KelonggaranTarik'];  
      $data['Pinjaman']['TotalFeeBasedPinjaman'] = $data['Projection']['Pinjaman']['TotalFeeBasedPinjaman'] - $data['Existing']['AkumulasiNominalFee'];  
      $data['Pinjaman']['TotalIncomeExpense'] = $data['Projection']['Pinjaman']['TotalIncomeExpense'] - $data['Existing']['PendapatanBunga'];  
      $data['Pinjaman']['TotalIncomeExpense'] = $data['Projection']['Pinjaman']['TotalIncomeExpense'] - $data['Existing']['PendapatanBungaAkumulasi'];  
      $data['Pinjaman']['JumlahRekKredit'] = 0; 
      // trade finance
      $data['Pinjaman']['TotalOutstandingTradeFinance'] = $data['Projection']['Pinjaman']['TotalOutstandingTradeFinance'] - $data['Existing']['AkumulasiNominalTrxTf'];  
      $data['Pinjaman']['TotalFeeBasedTradeFinance'] = $data['Projection']['Pinjaman']['TotalFeeBasedTradeFinance'] - $data['Existing']['AkumulasiNominalFeeTf'];  
      $data['Pinjaman']['AkumulasiJumlahTrxTf'] = 0; 
      // lainnya
      $data['Pinjaman']['TotalFeeBasedLain'] = $data['Projection']['Pinjaman']['TotalFeeBasedLain'] - $data['Existing']['FeeBased'];  

    // cpa delta laba rugi
      $data['LabaRugi']['PendapatanBunga'] = $data['Projection']['LabaRugi']['PendapatanBunga'] - $data['Existing']['PendapatanBunga'];  
      $data['LabaRugi']['PendapatanFTP'] = $data['Projection']['LabaRugi']['PendapatanFTP'] - $data['Existing']['PendapatanFtp']; 
      $data['LabaRugi']['TotalPendapatanBunga'] = $data['LabaRugi']['PendapatanBunga'] + $data['LabaRugi']['PendapatanFTP'];

      $data['LabaRugi']['BebanBunga'] = $data['Projection']['LabaRugi']['BebanBunga'] - $data['Existing']['BebanBunga']; 
      $data['LabaRugi']['BebanBungaFTP'] = $data['Projection']['LabaRugi']['BebanBungaFTP'] - $data['Existing']['BebanFtpAkumulasi']; 
      $data['LabaRugi']['TotalBebanBunga'] = $data['LabaRugi']['BebanBunga'] + $data['LabaRugi']['BebanBungaFTP']; 
      // $existing['NII'] = $data['LabaRugi']['TotalPendapatanBunga'] + $data['LabaRugi']['TotalProvision'] - $data['LabaRugi']['TotalBebanBunga']; 
      $existing['NII'] = $data['Existing']['PendapatanBunga'] - $data['Existing']['BebanBunga'];

      $existing['NIIFTP'] = ($data['Existing']['PendapatanBunga'] + $data['Existing']['PendapatanFtp']) - ($data['Existing']['BebanBunga'] + $data['Existing']['BebanFtpAkumulasi']);
      $data['LabaRugi']['NII'] = $data['Projection']['LabaRugi']['NII'] - $existing['NII']; 
      $data['LabaRugi']['NIIFTP'] = $data['Projection']['LabaRugi']['NIIFTP'] - $existing['NIIFTP']; 
      $data['LabaRugi']['FeeBased'] = $data['Projection']['LabaRugi']['FeeBased'] - $data['Existing']['FeeBased']; 

      $data['LabaRugi']['TotalJasaPerkreditan'] = $data['Projection']['LabaRugi']['TotalJasaPerkreditan'] - 0; 
      $data['LabaRugi']['TotalJasaSimpanan'] = $data['Projection']['LabaRugi']['TotalJasaSimpanan'] - 0; 
      $data['LabaRugi']['TotalJasaTransaksi'] = $data['Projection']['LabaRugi']['TotalJasaTransaksi'] - 0;
      $data['LabaRugi']['TotalJasaTransfer'] = $data['Projection']['LabaRugi']['TotalJasaTransfer'] - 0;
      $data['LabaRugi']['TotalProvision'] = $data['Projection']['LabaRugi']['TotalProvision'] - $data['Existing']['Provisi'];
      $data['LabaRugi']['TotalBiayaOperasional'] = $data['Projection']['LabaRugi']['TotalBiayaOperasional'] - $data['Existing']['TotalBiayaOperasional']; 
      $data['LabaRugi']['TotalAdministrasi'] = $data['Projection']['LabaRugi']['TotalAdministrasi'] - 0;
      $data['LabaRugi']['TotalOperasional'] = $data['Projection']['LabaRugi']['TotalOperasional'] - 0;
      $data['LabaRugi']['TotalPersonalia'] = $data['Projection']['LabaRugi']['TotalPersonalia'] - 0;

      $data['LabaRugi']['BiayaPpap'] = $data['Projection']['LabaRugi']['BiayaPpap'] - $data['Existing']['BiayaPpap']; 

      $data['LabaRugi']['LabaRugiSebelumModal'] = $data['Projection']['LabaRugi']['LabaRugiSebelumModal'] - $data['Existing']['LabaRugiSebelumModal']; 
      $data['LabaRugi']['LabaRugiFtpSeblumModal'] = $data['Projection']['LabaRugi']['LabaRugiFtpSeblumModal'] - $data['Existing']['LabaRugiFtpSeblumModal']; 

      $data['LabaRugi']['TotalBiayaModal'] = $data['Projection']['LabaRugi']['TotalBiayaModal'] - $data['Existing']['BiayaModal']; 
      $data['LabaRugi']['LabaRugiSetelahModal'] = $data['Projection']['LabaRugi']['LabaRugiSetelahModal'] - $data['Existing']['LabaRugiSetelahModal']; 
      $data['LabaRugi']['LabaRugiFtpSetelahModal'] = $data['Projection']['LabaRugi']['LabaRugiFtpSetelahModal'] - $data['Existing']['LabaRugiFtpSetelahModal']; 

      // echo "<pre>";
      // print_r($data);
      // die();

    return $data;       
  }

  public function view_cpa($tab_panel, $AccountPlanningId) {
    $this->checkModule();

    $data['AccountPlanningId']        = $AccountPlanningId;
    $data['tab_panel']                = $tab_panel;
    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);
    $data['account_planning']['Clasifications'] = 'Platinum';

    switch ($tab_panel) {
      case 'projection':
        $data['Projection'] = $this->view_cpa_projection($AccountPlanningId);

        break;
        
      case 'existing':
        $data['Existing'] = $this->DataTransaction_model->getCpaExisting($AccountPlanningId);

        break;
      
      case 'delta':
        $data['Delta'] = $this->view_cpa_delta($AccountPlanningId);

        break;
      
      default:
        $data['Existing'] = $this->DataTransaction_model->getCpaExisting($AccountPlanningId);

        break;
    }

    // echo "<pre>";
    // print_r($data);
    // die();

    $this->load->view('tasklist/cpa/cpa_'.$tab_panel.'.php', $data);
  }

  public function view_simulation($AccountPlanningId, $AccountPlanningTabType, $confirmation_user=''){
    $this->checkModule();

    $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($AccountPlanningId);
    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['account_planning']['status']             = $account_planning_status;
    $data['confirmation_user']                      = $confirmation_user;
    $data['AccountPlanningTabType']                 = $ap_tab_type_get;
    $data['account_planning']['AccountPlanningId']  = $AccountPlanningId;
    $data['AccountPlanningId']                      = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
    if (!empty($confirmation_user)) {
      $data['account_planning']['ConfirmationDetail'] = $this->ConfirmationAccountPlanning_model->getCheckerDetail($AccountPlanningId, $this->session->PERSONAL_NUMBER);

      $data['confirmation_table'] = 'AccountPlanningChecker';
      $data['confirmation_table_id'] = 'AccountPlanningChecker';
      $data['confirmation_docstatus_id'] = 2;
      if ($confirmation_user == 'Signer') {
        $data['account_planning']['ConfirmationDetail'] = $this->ConfirmationAccountPlanning_model->getSignerDetail($AccountPlanningId, $this->session->PERSONAL_NUMBER);

        $data['confirmation_table'] = 'AccountPlanningSigner';
        $data['confirmation_table_id'] = 'AccountPlanningSignerId';
        $data['confirmation_docstatus_id'] = 3;
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

      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
        $dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);

      // Credit Simulation
        $dataCreditSimulation[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulation($AccountPlanningId, $value['BankFacilityItemId']);
        $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']][0] = array(
          'BankFacilityGroupId'     => $value['BankFacilityGroupId']
          , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
          , 'heading_panel'         => $heading_panel
          , 'tab_panel'             => $tab_panel
          , 'expanded_panel'        => $expanded_panel
          );

        $IDRPlafond   = 0;
        $ValasPlafond = 0;
        $dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']] = $this->AccountPlanningCalculate_model->getCreditSimulationPlafondSum($AccountPlanningId, $value['BankFacilityItemId']);
        if (!empty($dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']])) {
          $IDRPlafond   = $dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']]['IDRPlafond'];
          $ValasPlafond = $dataCreditSimulationPlafondSum[$value['BankFacilityGroupId']]['ValasPlafond'];
        }

        $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulation_detail'][$value['BankFacilityItemId']] = array(
          'CreditSimulationId'              => 0
          , 'BankFacilityItemName'          => $value['BankFacilityItemName']
          , 'IDRPlafond'                    => number_format($IDRPlafond/VALUE_PER)
          , 'ValasPlafond'                  => number_format($ValasPlafond/VALUE_PER)
          , 'IDROutstanding'                => 0
          , 'ValasOutstanding'              => 0
          , 'IDRDailyRatas'                 => 0
          , 'ValasDailyRatas'               => 0
          , 'IDRTenor'                      => 0
          , 'ValasTenor'                    => 0
          , 'IDRIndicativeRate'             => 0
          , 'ValasIndicativeRate'           => 0
          , 'IDRIncomeExpense'              => 0
          , 'ValasIncomeExpense'            => 0
          , 'IDRProvisionRate'              => 0
          , 'ValasProvisionRate'            => 0
          , 'IDRProvision'                  => 0
          , 'ValasProvision'                => 0
          , 'IDRFee'                        => 0
          , 'ValasFee'                      => 0
          , 'IDRBebanBunga'                 => 0
          , 'ValasBebanBunga'               => 0
          );

        if (!empty($dataCreditSimulation[$value['BankFacilityGroupId']])) {
          foreach ($dataCreditSimulation[$value['BankFacilityGroupId']] as $keys => $values) {
            $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulation_detail'][$value['BankFacilityItemId']] = array(
              'CreditSimulationId'             => $values['CreditSimulationId']
              , 'BankFacilityItemName'         => $value['BankFacilityItemName']
              , 'IDRPlafond'                   => number_format($IDRPlafond/VALUE_PER)
              , 'ValasPlafond'                => number_format($ValasPlafond/VALUE_PER)
              , 'IDROutstanding'                 => number_format($values['IDROutstanding']/VALUE_PER)
              , 'ValasOutstanding'                 => number_format($values['ValasOutstanding']/VALUE_PER)
              , 'IDRDailyRatas'                 => number_format($values['IDRDailyRatas']/VALUE_PER)
              , 'ValasDailyRatas'                 => number_format($values['ValasDailyRatas']/VALUE_PER)
              , 'IDRTenor'                 => number_format($values['IDRTenor'])
              , 'ValasTenor'                 => number_format($values['ValasTenor'])
              , 'IDRIndicativeRate'                 => number_format($values['IDRIndicativeRate'], 2)
              , 'ValasIndicativeRate'                 => number_format($values['ValasIndicativeRate'], 2)
              , 'IDRIncomeExpense'                 => number_format($values['IDRIncomeExpense']/VALUE_PER)
              , 'ValasIncomeExpense'                 => number_format($values['ValasIncomeExpense']/VALUE_PER)
              , 'IDRProvisionRate'                 => number_format($values['IDRProvisionRate'], 2)
              , 'ValasProvisionRate'                 => number_format($values['ValasProvisionRate'], 2)
              , 'IDRProvision'                 => number_format($values['IDRProvision']/VALUE_PER)
              , 'ValasProvision'                 => number_format($values['ValasProvision']/VALUE_PER)
              , 'IDRFee'                 => number_format($values['IDRFee']/VALUE_PER)
              , 'ValasFee'                 => number_format($values['ValasFee']/VALUE_PER)
              , 'IDRBebanBunga'                 => number_format($values['IDRBebanBunga']/VALUE_PER)
              , 'ValasBebanBunga'               => number_format($values['ValasBebanBunga']/VALUE_PER)
              );
          }
        }

      // Credit Simulation Addition
        $dataBankFacilityItemAddition[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, '', $value['BankFacilityGroupId']);

        if (!empty($dataBankFacilityItemAddition[$value['BankFacilityGroupId']])) {
          foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']] as $keysssss => $BankFacilityItemAddition) {

            $IDRPlafondAddition   = 0;
            $ValasPlafondAddition = 0;
            $dataCreditSimulationAdditionPlafondSum[$value['BankFacilityGroupId']] = $this->AccountPlanningCalculate_model->getCreditSimulationAdditionPlafondSum($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId']);
            if (!empty($dataCreditSimulationAdditionPlafondSum[$value['BankFacilityGroupId']])) {
              $IDRPlafondAddition   = $dataCreditSimulationAdditionPlafondSum[$BankFacilityItemAddition['BankFacilityGroupId']]['IDRPlafondAddition'];
              $ValasPlafondAddition = $dataCreditSimulationAdditionPlafondSum[$BankFacilityItemAddition['BankFacilityGroupId']]['ValasPlafondAddition'];
            }

            $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulationAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'CreditSimulationAdditionId'          => 0
                , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                , 'IDRPlafondAddition'                          => number_format($IDRPlafondAddition/VALUE_PER)
                , 'ValasPlafondAddition'                        => number_format($ValasPlafondAddition/VALUE_PER)
                , 'IDROutstandingAddition'                      => 0
                , 'ValasOutstandingAddition'                      => 0
                , 'IDRDailyRatasAddition'                      => 0
                , 'ValasDailyRatasAddition'                      => 0
                , 'IDRTenorAddition'                      => 0
                , 'ValasTenorAddition'                      => 0
                , 'IDRIndicativeRateAddition'                      => 0
                , 'ValasIndicativeRateAddition'                      => 0
                , 'IDRIncomeExpenseAddition'                      => 0
                , 'ValasIncomeExpenseAddition'                      => 0
                , 'IDRProvisionRateAddition'                      => 0
                , 'ValasProvisionRateAddition'                      => 0
                , 'IDRProvisionAddition'                      => 0
                , 'ValasProvisionAddition'                      => 0
                , 'IDRFeeAddition'                      => 0
                , 'ValasFeeAddition'                      => 0
                , 'IDRBebanBungaAddition'                 => 0
                , 'ValasBebanBungaAddition'               => 0
              );

            $dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulationAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId']);

            if (!empty($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']])) {
              foreach ($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $CreditSimulationAddition) {
                $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulationAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                  'CreditSimulationAdditionId'               => $CreditSimulationAddition['CreditSimulationAdditionId']
                  , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                  , 'IDRPlafondAddition'                          => number_format($IDRPlafondAddition/VALUE_PER)
                  , 'ValasPlafondAddition'                        => number_format($ValasPlafondAddition/VALUE_PER)
                  , 'IDROutstandingAddition'                      => number_format($CreditSimulationAddition['IDROutstandingAddition']/VALUE_PER)
                  , 'ValasOutstandingAddition'                      => number_format($CreditSimulationAddition['ValasOutstandingAddition']/VALUE_PER)
                  , 'IDRDailyRatasAddition'                      => number_format($CreditSimulationAddition['IDRDailyRatasAddition']/VALUE_PER)
                  , 'ValasDailyRatasAddition'                      => number_format($CreditSimulationAddition['ValasDailyRatasAddition']/VALUE_PER)
                  , 'IDRTenorAddition'                      => number_format($CreditSimulationAddition['IDRTenorAddition'])
                  , 'ValasTenorAddition'                      => number_format($CreditSimulationAddition['ValasTenorAddition'])
                  , 'IDRIndicativeRateAddition'                      => number_format($CreditSimulationAddition['IDRIndicativeRateAddition'], 2)
                  , 'ValasIndicativeRateAddition'                      => number_format($CreditSimulationAddition['ValasIndicativeRateAddition'], 2)
                  , 'IDRIncomeExpenseAddition'                      => number_format($CreditSimulationAddition['IDRIncomeExpenseAddition']/VALUE_PER)
                  , 'ValasIncomeExpenseAddition'                      => number_format($CreditSimulationAddition['ValasIncomeExpenseAddition']/VALUE_PER)
                  , 'IDRProvisionRateAddition'                      => number_format($CreditSimulationAddition['IDRProvisionRateAddition'], 2)
                  , 'ValasProvisionRateAddition'                      => number_format($CreditSimulationAddition['ValasProvisionRateAddition'], 2)
                  , 'IDRProvisionAddition'                      => number_format($CreditSimulationAddition['IDRProvisionAddition']/VALUE_PER)
                  , 'ValasProvisionAddition'                      => number_format($CreditSimulationAddition['ValasProvisionAddition']/VALUE_PER)
                  , 'IDRFeeAddition'                      => number_format($CreditSimulationAddition['IDRFeeAddition']/VALUE_PER)
                  , 'ValasFeeAddition'                      => number_format($CreditSimulationAddition['ValasFeeAddition']/VALUE_PER)
                  , 'IDRBebanBungaAddition'                 => number_format($CreditSimulationAddition['IDRBebanBungaAddition']/VALUE_PER)
                  , 'ValasBebanBungaAddition'               => number_format($CreditSimulationAddition['ValasBebanBungaAddition']/VALUE_PER)
                  );

              }
            }
          }
        }
      }
    }


    // CreditSimulationAssumption
    $data['account_planning']['CreditSimulationAssumption'] = array(
      'CreditSimulationAssumptionId'                => 0,
      'USDExchange'                                 => 0,
      'IDRFTPSimpanan'                              => 0,
      'ValasFTPSimpanan'                            => 0,
      'IDRFTPPinjaman'                              => 0,
      'ValasFTPPinjaman'                            => 0
      );

    $dataCreditAssumption = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditAssumption($AccountPlanningId);
    if (!empty($dataCreditAssumption)) {
      $data['CreditSimulationAssumptionSubmit']         = 'edit';
      $data['account_planning']['CreditSimulationAssumption'] = array(
          'CreditSimulationAssumptionId'                => $dataCreditAssumption[0]['CreditSimulationAssumptionId'],
          'USDExchange'                                 => number_format($dataCreditAssumption[0]['USDExchange']),
          'IDRFTPSimpanan'                              => number_format($dataCreditAssumption[0]['IDRFTPSimpanan'], 2),
          'ValasFTPSimpanan'                            => number_format($dataCreditAssumption[0]['ValasFTPSimpanan'], 2),
          'IDRFTPPinjaman'                              => number_format($dataCreditAssumption[0]['IDRFTPPinjaman'], 2),
          'ValasFTPPinjaman'                            => number_format($dataCreditAssumption[0]['ValasFTPPinjaman'], 2)
          );
    }

    // CreditSimulationFee
    $dataSimulationFeeItem = $this->TasklistAccountPlanning_model->getAccountPlanningSimulationFeeItem();

    $dataCreditSimulationFeeSimpananSum = $this->AccountPlanningCalculate_model->getCreditSimulationFeeSimpananSum($AccountPlanningId, 3);
    $dataCreditSimulationFeePinjamanSum = $this->AccountPlanningCalculate_model->getCreditSimulationFeePinjamanSum($AccountPlanningId);
    foreach ($dataSimulationFeeItem as $key => $value) {
      $dataCreditSimulationFee[$value['FeeTypeId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulationFee($AccountPlanningId, $value['FeeTypeId']);

      $IDRAmount   = 0;
      $ValasAmount = 0;
      if ($value['FeeTypeId'] == 1) {
        if (!empty($dataCreditSimulationFeeSimpananSum)) {
          $IDRAmount   = $dataCreditSimulationFeeSimpananSum['IDRAmount'];
          $ValasAmount = $dataCreditSimulationFeeSimpananSum['ValasAmount'];
        }
      }
      if ($value['FeeTypeId'] == 2) {
        if (!empty($dataCreditSimulationFeePinjamanSum)) {
          $IDRAmount   = $dataCreditSimulationFeePinjamanSum['IDRAmount'];
          $ValasAmount = $dataCreditSimulationFeePinjamanSum['ValasAmount'];
        }
      }
      
      $data['account_planning']['CreditSimulationFee'][$value['FeeTypeId']] = array(
        'FeeTypeId'                             => $value['FeeTypeId'],
        'FeeTypeName'                           => $value['FeeTypeName'],
        'CreditSimulationFeeId'                 => 0,
        'IDRAmount'                             => number_format($IDRAmount/VALUE_PER),
        'ValasAmount'                           => number_format($ValasAmount/VALUE_PER)
        );

      if (!empty($dataCreditSimulationFee[$value['FeeTypeId']])) {
        $data['CreditSimulationFeeSubmit']          = 'edit';
        $IDRAmount   = $dataCreditSimulationFee[$value['FeeTypeId']][0]['IDRAmount'];
        $ValasAmount = $dataCreditSimulationFee[$value['FeeTypeId']][0]['ValasAmount'];
        if ($value['FeeTypeId'] == 13) {
          if (!empty($dataCreditSimulationFee[$value['FeeTypeId']][0])) {
            $IDRAmount   = $dataCreditSimulationFee[$value['FeeTypeId']][0]['IDRAmount'] * VALUE_PER;
            $ValasAmount = $dataCreditSimulationFee[$value['FeeTypeId']][0]['ValasAmount'] * VALUE_PER;
          }
        }
        $data['account_planning']['CreditSimulationFee'][$value['FeeTypeId']]   = array(
            'FeeTypeId'                             => $value['FeeTypeId'],
            'FeeTypeName'                           => $value['FeeTypeName'],
            'CreditSimulationFeeId'                 => $dataCreditSimulationFee[$value['FeeTypeId']][0]['CreditSimulationFeeId'],
            'IDRAmount'                             => number_format($IDRAmount/VALUE_PER),
            'ValasAmount'                           => number_format($ValasAmount/VALUE_PER)
            );
      }

    }

    $this->load->view('tasklist/view/simulation.php', $data);
  }

  public function view_action_plans($AccountPlanningId, $AccountPlanningTabType, $subtab_panel='') {
    $this->checkModule();

    $ap_tab_subcontent_get = ($subtab_panel) ? $subtab_panel : 'estimated_financial';
    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']                 = $ap_tab_type_get;

    $data['AccountPlanningSubTab']              = $ap_tab_subcontent_get;
    $data['AccountPlanningTab']                 = 'action_plans';

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);


    switch ($ap_tab_subcontent_get) {
      case 'estimated_financial':
        $data = $this->view_estimated_financial($AccountPlanningId, $AccountPlanningTabType);

        break;
        
      case 'initiatives_action':
        $data = $this->view_initiatives_action($AccountPlanningId, $AccountPlanningTabType);

        break;
    }
  }

  public function view_estimated_financial($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']                 = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
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

      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
        $dataBankFacility[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacility($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
    
       
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
    }

    $this->load->view('tasklist/view/estimated_financial.php', $data);
  }

  public function view_initiatives_action($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']                 = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

    if (!empty($data['account_planning_vcif_list'])) {
      foreach ($data['account_planning_vcif_list'] as $key => $valuess) {
      // Initiative Action
        $data['account_planning']['InitiativeAction'][$valuess['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningInitiativeAction($AccountPlanningId, $valuess['VCIF']);
        foreach ($data['account_planning']['InitiativeAction'][$valuess['VCIF']] as $keys => $values) {
          $dataDateTimePeriod[$keys]['DateTimePeriod'] = new DateTime(date($values['Period'].'-01'));
          $data['account_planning']['InitiativeAction'][$valuess['VCIF']][$keys]['DateTimePeriod'] = $dataDateTimePeriod[$keys]['DateTimePeriod']->format('F Y');
        }
      }
    }

    $this->load->view('tasklist/view/initiatives_action.php', $data);
  }

  public function view_client_needs($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;
    $data['AccountPlanningTab']                 = 'client_needs';

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

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
      }
    }

    $this->load->view('tasklist/view/client_needs.php', $data);
  }

  public function view_company_information($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
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
    $data['keyShareholderDataSource'] = $this->DataLoadOption_model->getKeyShareholderDataSource($AccountPlanningId);

    $recentActivities = $this->TasklistAccountPlanning_model->getAccountPlanningRecentActivities($AccountPlanningId);
    $data['account_planning']['recentActivities'] = $recentActivities;

    // echo "<pre>";
    // print_r($data['account_planning']['recentActivities']);
    // die();

    $this->load->view('tasklist/view/company_information.php', $data);
  }

  public function view_bri_starting_position($AccountPlanningId, $AccountPlanningTabType, $subtab_panel='') {
    $this->checkModule();

    $ap_type = ($this->uri->segment(7)) ? $this->uri->segment(7) : '';
    $ap_tab_subcontent_get = ($subtab_panel) ? $subtab_panel : 'financial_highlights';
    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['AccountPlanningSubTab']              = $ap_tab_subcontent_get;
    $data['AccountPlanningTab']                 = 'bri_starting_position';

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;
    $data['account_planning']['Clasifications'] = 'Platinum';

    $ap_tab_contents = array (
        'financial_highlights'
        , 'facilities_banking'
        , 'wallet_share'
        , 'competition_analysis'
      );

    foreach ($ap_tab_contents as $ap_tab_contents_key => $ap_tab_contents_value) {
      $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = '';
      $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = '';
      if ($ap_tab_subcontent_get == $ap_tab_contents_value) {
        $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = 'active';
        $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = ' active in';
      }
      if (empty($ap_tab_subcontent_get)) {
        if ($ap_tab_contents_value == 'financial_highlights') {
          $data['account_planning']['ap_tab_sub'][$ap_tab_contents_value] = 'active';
          $data['account_planning']['ap_tab_sub_content'][$ap_tab_contents_value] = ' active in';
        }
      }
    }

    $this->load->view('tasklist/view/bri_sp.php', $data);

    switch ($ap_tab_subcontent_get) {
      case 'financial_highlights':
        $data = $this->view_financial_highlights($AccountPlanningId, $AccountPlanningTabType);

        break;
        
      case 'facilities_banking':
        $data = $this->view_facilities_banking($AccountPlanningId, $AccountPlanningTabType);

        break;
      case 'wallet_share':
        $data = $this->view_wallet_share($AccountPlanningId, $AccountPlanningTabType);

        break;
      case 'competition_analysis':
        $data = $this->view_competition_analysis($AccountPlanningId, $AccountPlanningTabType);

        break;
    }
    $this->load->view('tasklist/view/bri_sp2.php', $data);
  }

  public function view_financial_highlights($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getFinnancialHighlightDetails($AccountPlanningId);
    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;

    $data['account_planning']['Years'] = Array(  
                                                $data['account_planning']['Year'] - 3,
                                                $data['account_planning']['Year'] - 2,
                                                $data['account_planning']['Year'] - 1
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

  // Financial Highlights
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

      $dataSource = $this->DataLoadOption_model->getFinancialHighlightDataSource($AccountPlanningId, $value['FinancialHighlightGroupId']);

      $data['account_planning']['FinancialHighlight'][$value['FinancialHighlightGroupId']][0] = array(
        'FinancialHighlightGroupId'       => $value['FinancialHighlightGroupId']
        , 'FinancialHighlightGroupName'   => $value['FinancialHighlightGroupName']
        , 'heading_panel'                 => $heading_panel
        , 'tab_panel'                     => $tab_panel
        , 'expanded_panel'                => $expanded_panel
        , 'DataSource'                    => $dataSource
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
  // End Financial Highlights

    $this->load->view('tasklist/view/financial_highlights.php', $data);
  }

  public function view_facilities_banking($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;

    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

  // BankFacilityItem
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
        $dataSource = $this->DataLoadOption_model->getBankFacilityDataSource($AccountPlanningId, $value['BankFacilityGroupId'], $account_planning_vcif['VCIF']);
        $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']][0][$account_planning_vcif['VCIF']]['DataSource'] = $dataSource;

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
    // End Facilities Banking
    }
  // End BankFacilityItem

    $this->load->view('tasklist/view/facilities_banking.php', $data);
  }

  public function view_wallet_share($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;

    $data['account_planning_vcif_list'] = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);

  // BankFacilityItem
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

    // Start of Wallet Share 
      $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']][0] = array(
        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
        , 'heading_panel'         => $heading_panel
        , 'tab_panel'             => $tab_panel
        , 'expanded_panel'        => $expanded_panel
      );

      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
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
      }
    // End of Wallet Share 
    }
  // End BankFacilityItem

    $this->load->view('tasklist/view/wallet_share.php', $data);
  }

  public function view_competition_analysis($AccountPlanningId, $AccountPlanningTabType) {
    $this->checkModule();

    $ap_tab_type_get = ($AccountPlanningTabType) ? $AccountPlanningTabType : 'details';
    $data['AccountPlanningTabType']             = $ap_tab_type_get;

    $data['account_planning']['AccountPlanningId']                  = $AccountPlanningId;
    $data['AccountPlanningId']                  = $AccountPlanningId;


  // BankFacilityItem
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
    // End competitionAnalys
    }
  // End BankFacilityItem

    $this->load->view('tasklist/view/competition_analysis.php', $data);
  }

  public function updateLastView($AccountPlanningId) {
    $this->checkModule();
    // var_dump($this->isOwner($AccountPlanningId));
    if ($this->isOwner($AccountPlanningId) == true) {
      $updateOwnerLastView = $this->TasklistAccountPlanning_model->updateData('AccountPlanningOwner', array('LastView' => $this->current_datetime), 'AccountPlanningId', $AccountPlanningId);
      echo json_encode($updateOwnerLastView);
    }
  }

  public function retrieve($AccountPlanningId) {
    $this->checkModule();

    $data_input = array(
      'AccountPlanningId'     => $AccountPlanningId
      , 'DocumentStatusId'    => 1
      , 'CreatedDate'         => $this->current_datetime
      , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
    );

    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_input);
    
    $updateChecker = $this->TasklistAccountPlanning_model->updateData('AccountPlanningChecker', array('IsActive' => 0), 'AccountPlanningId', $AccountPlanningId);
    $updateSigner = $this->TasklistAccountPlanning_model->updateData('AccountPlanningSigner', array('IsActive' => 0), 'AccountPlanningId', $AccountPlanningId);

    // $deleteChecker = $this->TasklistAccountPlanning_model->deleteData('AccountPlanningChecker', array('AccountPlanningId' => $AccountPlanningId));
    // $deleteSigner = $this->TasklistAccountPlanning_model->deleteData('AccountPlanningSigner', array('AccountPlanningId' => $AccountPlanningId));

    echo json_encode($insertData);
  }

  public function add_member() {
    $AccountPlanningId = $this->input->post('AccountPlanningId');
    foreach ((array) $this->input->post('member_list') as $key => $value) {
      $insertMemberPerRM = $this->TasklistAccountPlanning_model->addMemberAccountPlanning($this->input->post('AccountPlanningId'), $value, $this->session->PERSONAL_NUMBER);
      if ($insertMemberPerRM['insertStatus'] == 'error') 
        break;    
    }

    foreach ((array) $this->input->post('member_selected_list') as $key => $value) {
      $removeMemberPerRM = $this->TasklistAccountPlanning_model->removeMemberAccountPlanning($this->input->post('AccountPlanningId'), $value, $this->session->PERSONAL_NUMBER);
      if ($removeMemberPerRM['removeStatus'] == 'error') 
        break;
    }

    if(isset($insertMemberPerRM) && isset($removeMemberPerRM)){
      if($insertMemberPerRM['insertStatus'] <> 'error' && $removeMemberPerRM['removeStatus'] <> 'error')
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Member CST', 'Updating member CST', $_SESSION['PERSONAL_NUMBER']);
      echo json_encode(array_merge($insertMemberPerRM,$removeMemberPerRM));
    }
    else if(isset($insertMemberPerRM)){
      if($insertMemberPerRM['insertStatus'] <> 'error')
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Member CST', 'Updating member CST', $_SESSION['PERSONAL_NUMBER']);
      echo json_encode($insertMemberPerRM);
    }
    else if(isset($removeMemberPerRM)){
      if($removeMemberPerRM['removeStatus'] <> 'error')
        $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Member CST', 'Updating member CST', $_SESSION['PERSONAL_NUMBER']);
      echo json_encode($removeMemberPerRM);
    }
  }

  public function add_checkersigner() {

    $data_input = array(
      'AccountPlanningId'     => $this->input->post('AccountPlanningId')
      , 'DocumentStatusId'    => 2
      , 'CreatedDate'         => $this->current_datetime
      , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
    );

    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_input);

    foreach ($this->input->post('checker_per_uker_list') as $key => $checker_per_uker_list) {
      $data_inputChecker[$key] = array (
        'UserId'                => $checker_per_uker_list
        , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
        , 'IsActive'            => 1
        , 'IsApproved'          => NULL
        , 'Comment'             => NULL
        , 'CreatedDate'         => $this->current_datetime
        , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
        );

      $insertCheckerPerRM = $this->TasklistAccountPlanning_model->insertCheckerSignerPerRM('AccountPlanningChecker', $data_inputChecker[$key]);
      if ($insertCheckerPerRM['status'] == 'success') {
        $this->notification_model->addNotif($checker_per_uker_list, "Account Planning", "Add Account Planning Checker", "You are added as a checker of account planning (".$this->input->post('AccountPlanningId').")", "confirmation/Checker/view/".$this->input->post('AccountPlanningId'));
      }
      if ($insertCheckerPerRM['status'] == 'error') 
        break;    
    }

    foreach ($this->input->post('signer_per_uker_list') as $key => $signer_per_uker_list) {
      $data_inputSigner[$key] = array (
        'UserId'                => $signer_per_uker_list
        , 'AccountPlanningId'   => $this->input->post('AccountPlanningId')
        , 'IsActive'            => 1
        , 'IsApproved'          => NULL
        , 'Comment'             => NULL
        , 'CreatedDate'         => $this->current_datetime
        , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
        );

      $insertSignerPerRM = $this->TasklistAccountPlanning_model->insertCheckerSignerPerRM('AccountPlanningSigner', $data_inputSigner[$key]);
      if ($insertSignerPerRM['status'] == 'success') {
        $this->notification_model->addNotif($signer_per_uker_list, "Account Planning", "Add Account Planning Signer", "You are added as a signer of account planning (".$this->input->post('AccountPlanningId').")", "confirmation/Signer/view/".$this->input->post('AccountPlanningId'));
      }
      if ($insertSignerPerRM['status'] == 'error') 
        break;    
    }

    if($insertCheckerPerRM['status'] == 'success' && $insertSignerPerRM['status'] == 'success')
      $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($this->input->post('AccountPlanningId'), 'Submit', 'Submitting account planning', $_SESSION['PERSONAL_NUMBER']);

    // echo json_encode($insertCheckerPerRM);
    echo json_encode($insertSignerPerRM);
  }

  public function manage_VCIF_proc() {

    $data_input = array(
      'AccountPlanningId'     => $this->input->post('AccountPlanningId')
      , 'DocumentStatusId'    => 1
      , 'CreatedDate'         => $this->current_datetime
      , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
    );

    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningStatus', $data_input);
    
    $updateChecker = $this->TasklistAccountPlanning_model->updateData('AccountPlanningChecker', array('IsActive' => 0), 'AccountPlanningId', $this->input->post('AccountPlanningId'));
    $updateSigner = $this->TasklistAccountPlanning_model->updateData('AccountPlanningSigner', array('IsActive' => 0), 'AccountPlanningId', $this->input->post('AccountPlanningId'));

    if ($this->input->post('IsMain') != $this->input->post('oldIsMain')) {
      foreach ($this->input->post('IsMain') as $key => $value) {
        $UpdateVCIFOld = $this->TasklistAccountPlanning_model->updateDataManageVCIF('AccountPlanningCustomer', array('IsMain' => 0), $this->input->post('AccountPlanningId'), $this->input->post('oldIsMain')[$key]);
        $UpdateVCIF = $this->TasklistAccountPlanning_model->updateDataManageVCIF('AccountPlanningCustomer', array('IsMain' => 1), $this->input->post('AccountPlanningId'), $this->input->post('IsMain')[$key]);
      }
    }

    if (!empty($this->input->post('vcif_list'))) {

      foreach ($this->input->post('vcif_list') as $key => $value) {
        $VCIF = $value;
        $destAccountPlanningId = $this->input->post('AccountPlanningId');
        $CreatedBy = $this->session->PERSONAL_NUMBER;

        $data_inputVCIF[$key] = array (
          'VCIF'                      => $VCIF
          , 'AccountPlanningId'       => $destAccountPlanningId
          , 'CreatedDate'             => $this->current_datetime
          , 'CreatedBy'               => $CreatedBy
          );

        $insertVCIF = $this->TasklistAccountPlanning_model->insertDataVCIF('AccountPlanningCustomer', $data_inputVCIF[$key]);

        if (!empty($this->input->post('srcAccountPlanningId')[$key])) {
          $srcAccountPlanningId = $this->input->post('srcAccountPlanningId')[$key];
          $moveVCIF = $this->TasklistAccountPlanning_model->moveVCIFAccountPlanning($srcAccountPlanningId, $VCIF, $destAccountPlanningId, $CreatedBy);
        }
      }
    }
    // else {
    //     $result_insert = array(
    //         'insertStatus' => 'error'
    //         , 'insertMessage' => 'No VCIF Selected to Insert'
    //     );
    //     echo json_encode($result_insert);
    //     exit();
    // }
    // echo "<pre>";
    // print_r($data_inputVCIF);
    // die();

    if (!empty($this->input->post('vcif_selected_list'))) {
      foreach ($this->input->post('vcif_selected_list') as $key => $value) {
        /*if ($value == $this->input->post('oldIsMain')[$key]) {
            $result_update = array(
                'updateStatus' => 'error'
                , 'updateMessage' => 'Cannot remove main company in Account Planning.'
            );
            echo json_encode($result_update);
            exit();
        }*/

        $removeVCIF = $this->TasklistAccountPlanning_model->removeVCIFAccountPlanning($this->input->post('AccountPlanningId'), $value, $this->session->PERSONAL_NUMBER);
        
        if ($removeVCIF['removeStatus'] == 'error') 
          break;
      }
    }
    // else {
    //     $updateStatus = array(
    //         'updateStatus' => 'error'
    //         , 'updateMessage' => 'No VCIF Selected to Remove'
    //     );
    //     echo json_encode($updateStatus);
    //     exit();
    // }

    // if(isset($insertVCIF) && isset($moveVCIF) && isset($removeVCIF))
    //   echo json_encode(array_merge($insertVCIF,$removeVCIF));
    // else if(isset($insertVCIF))
    //   echo json_encode($insertVCIF);
    // else if(isset($removeVCIF))
    //   echo json_encode($removeVCIF);
    // else if(isset($UpdateVCIF))
    //   echo json_encode($UpdateVCIF);
    // echo json_encode($insertVCIF);
    // print_r(json_encode($insertVCIF));
    if(isset($insertVCIF) && isset($moveVCIF) && isset($removeVCIF))
      echo json_encode(array_merge($insertVCIF,$moveVCIF,$removeVCIF));
    else if(isset($insertVCIF) && isset($moveVCIF))
      echo json_encode(array_merge($insertVCIF,$moveVCIF));
    else if(isset($insertVCIF) && isset($removeVCIF))
      echo json_encode(array_merge($insertVCIF,$removeVCIF));
    else if(isset($moveVCIF) && isset($removeVCIF))
      echo json_encode(array_merge($moveVCIF,$removeVCIF));
    else if(isset($insertVCIF))
      echo json_encode($insertVCIF);
    else if(isset($moveVCIF))
      echo json_encode($moveVCIF);
    else if(isset($removeVCIF))
      echo json_encode($removeVCIF);
    else if(isset($UpdateVCIF))
      echo json_encode($UpdateVCIF);
  }

  public function manage_CST_privilege() {
    // $this->checkModule();
    $AccountPlanningId = $this->input->post('AccountPlanningId');
    $UserId = $this->input->post('UserId');
    $PrivilegeTab = implode(";", $this->input->post('PrivilegeId'));

    $data_update = array(
      'PrivilegeTab'        => $PrivilegeTab
    );

    $updateCST = $this->TasklistAccountPlanning_model->updateData('AccountPlanningMember',  $data_update, 'AccountPlanningId', $AccountPlanningId, 'UserId', $UserId);
    
    echo json_encode($updateCST);
  }

  public function getCSTPrivilegeTab($AccountPlanningId, $UserId) {
    $result = $this->PerformanceAccountPlanning_model->getCSTPrivilegeTab($AccountPlanningId, $UserId);
    echo json_encode(explode(";", $result['PrivilegeTab']));
  }

  public function getAPVCIFSelected($AccountPlanningId) {
    $result = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
    echo json_encode($result);
  }

  public function getGroupVCIFList($CustomerGroupId, $AccountPlanningId) {
    $APVCIFSelected = $this->PerformanceAccountPlanning_model->getAccountPlanningVCIFList($AccountPlanningId);
    $VCIFList = $this->TasklistAccountPlanning_model->getVCIFList($APVCIFSelected, $CustomerGroupId, $AccountPlanningId);
    foreach ($VCIFList as $key) {
      $getAPIdByVCIF = $this->TasklistAccountPlanning_model->getAccountPlanningIdByVCIF($key['VCIF']);
      $result[] = array(
                        'VCIF'                  => $key['VCIF']
                        , 'CustomerName'        => $key['CustomerName']
                        , 'AccountPlanningId'   => $getAPIdByVCIF['AccountPlanningId']
      );
    }
    // print_r($result); die();

    echo json_encode($result);
  }

  public function getMemberSelected($AccountPlanningId) {
    $result = $this->TasklistAccountPlanning_model->getMemberSelected($AccountPlanningId);
    echo json_encode($result);
  }

  public function getMemberList($AccountPlanningId) {
    $memberSelected = $this->TasklistAccountPlanning_model->getMemberSelected($AccountPlanningId);
    $result = $this->TasklistAccountPlanning_model->getMemberLists($memberSelected, $this->session->PERSONAL_NUMBER);
    echo json_encode($result);
  }

  public function getCheckerSelected($AccountPlanningId) {
    $result = $this->TasklistAccountPlanning_model->getCheckerSelected($AccountPlanningId, $this->session->PERSONAL_NUMBER);
    echo json_encode($result);
  }

  public function getChecker($AccountPlanningId) {
    $CheckerSelected = '';
    $CheckerSelected = $this->TasklistAccountPlanning_model->getCheckerSelected($AccountPlanningId, $this->session->PERSONAL_NUMBER);
    foreach ($CheckerSelected as $key => $value) {
        $CheckerSelected['UserId'][] = $value['UserId'];
    }
    $CheckerPerUnitKerjaList = $this->TasklistAccountPlanning_model->getChecker($this->session->DIVISION, $CheckerSelected);
    foreach ($CheckerPerUnitKerjaList as $key => $value) {
      $CheckerPerUnitKerjaList[$key]['Checkerchecked'] = '';
      if (!empty($CheckerSelected['UserId'])) {
        if (in_array($value['UserId'], $CheckerSelected['UserId'])) {
          $CheckerPerUnitKerjaList[$key]['Checkerchecked'] =  ' checked="checked"';
        }
      }
    }

    echo json_encode($CheckerPerUnitKerjaList);
  }

  public function getSignerSelected($AccountPlanningId) {
    $result = $this->TasklistAccountPlanning_model->getSignerSelected($AccountPlanningId, $this->session->PERSONAL_NUMBER);
    echo json_encode($result);
  }

  public function getSigner($AccountPlanningId) {
    $SignerSelected = '';
    $SignerSelected = $this->TasklistAccountPlanning_model->getSignerSelected($AccountPlanningId, $this->session->PERSONAL_NUMBER);
    foreach ($SignerSelected as $key => $value) {
        $SignerSelected['UserId'][] = $value['UserId'];
    }
    $SignerPerUnitKerjaList = $this->TasklistAccountPlanning_model->getSigner($this->session->DIVISION, $SignerSelected);
    foreach ($SignerPerUnitKerjaList as $key => $value) {
      $SignerPerUnitKerjaList[$key]['Signerchecked'] = '';
      if (!empty($SignerSelected['UserId'])) {
        if (in_array($value['UserId'], $SignerSelected['UserId'])) {
          $SignerPerUnitKerjaList[$key]['Signerchecked'] = ' checked="checked"';
        }
      }
    }

    echo json_encode($SignerPerUnitKerjaList);
  }

  /*
Start Script From Irvan 
  */
  public function upload_businessprocessorganitation($AccountPlanningId){
		$user = $this->session->all_userdata();
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $structureTypeId = $this->input->post('structureTypeId');
    
    $base_path = './uploads/account_planning';
		
    switch($structureTypeId){
      case 1: 
        $vcif = $this->input->post('vcif');
        $fname = 'Business_Process_'.$vcif.'.'.$ext;
        if( is_dir($base_path.'/'.$AccountPlanningId.'/'.$vcif.'/') === false )
        {
          mkdir($base_path.'/'.$AccountPlanningId.'/'.$vcif.'/', 0755, true);
        }
        $full_path = $base_path.'/'.$AccountPlanningId.'/'.$vcif.'/';
        break;
      case 2: 
        $vcif = NULL;
        $fname = 'Group_Structure.'.$ext;
        if( is_dir($base_path.'/'.$AccountPlanningId) === false )
        {
          mkdir($base_path.'/'.$AccountPlanningId, 0755, true);
        }
        $full_path = $base_path.'/'.$AccountPlanningId.'/';
        break;
      case 3: 
        $vcif = $this->input->post('vcif');
        $fname = 'Company_Structure_'.$vcif.'.'.$ext;
        if( is_dir($base_path.'/'.$AccountPlanningId.'/'.$vcif.'/') === false )
        {
          mkdir($base_path.'/'.$AccountPlanningId.'/'.$vcif.'/', 0755, true);
        }
        $full_path = $base_path.'/'.$AccountPlanningId.'/'.$vcif.'/';
        break;
    }
    
		$config['upload_path'] = $full_path;
    $config['allowed_types'] = '*';
    $config['file_name'] = $fname;
    $config['max_filename'] = '255';
    $config['encrypt_name'] = false;
    $config['max_size'] = '';
    $config['overwrite'] = TRUE;
		$status = "";
		$msg = "";
		
		if (isset($_FILES['file']['name'])) {
			if (0 < $_FILES['file']['error']) {
				$status = "error";
				$code = $_FILES['file']['error'];
        switch ($code) {
            case 1:
                $msg = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case 2:
                $msg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case 3:
                $msg = "The uploaded file was only partially uploaded";
                break;
            case 4:
                $msg = "No file was uploaded";
                break;
            case 6:
                $msg = "Missing a temporary folder";
                break;
            case 7:
                $msg = "Failed to write file to disk";
                break;
            case 8:
                $msg = "File upload stopped by extension";
                break;

            default:
                $msg = "Unknown upload error";
                break;
        }		
      }else{
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
          $status = "error";
          $msg = $this->upload->display_errors('', '');
        } else {
          
          $data = array(
            'StructureTypeId' => $structureTypeId,
            'AccountPlanningId' => $AccountPlanningId,
            'VCIF' => $vcif,
            'FilePath' => $fname,
            'Size' => $_FILES['file']['size'], // as Bytes
            'Type' => $_FILES['file']['type'],
            'createdBy' => $user['PERSONAL_NUMBER']
          );
          if($this->TasklistAccountPlanning_model->uploadBusinessProcessOrganization($data)){
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating business process organization on company information', $user['PERSONAL_NUMBER']);
            $status = "success";
            $msg = "File successfully uploaded";
          }else{
            $status = "error";
            $msg = "Something went wrong when saving the file, please try again.";	
          }
        }
      }
    }else {
      $status = "error";
      $msg = 'Please choose a file';
    }
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
  public function editbusinessprocessorganisation($AccountPlanningId, $AccountPlanningTab){
    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId'] = $AccountPlanningId;
    $data['AccountPlanningTab'] = $AccountPlanningTab;

    $rsGroupStructure = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 2);
    $data['GroupStructure'] = $rsGroupStructure;
    
    $rsAssignedCompany = $this->TasklistAccountPlanning_model->getSelectedCompanyOption($AccountPlanningId);
    for($i=0; $i<count($rsAssignedCompany); $i++){
      $rsBusinessProcess = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 1, $rsAssignedCompany[$i]->VCIF);
      $rsAssignedCompany[$i]->BusinessProcess = $rsBusinessProcess;

      $rsCompanyStructure = $this->TasklistAccountPlanning_model->getAccountPlanningFileStructure($AccountPlanningId, 3, $rsAssignedCompany[$i]->VCIF);
      $rsAssignedCompany[$i]->CompanyStructure = $rsCompanyStructure;
    }
    $data['AssignedCompany'] = $rsAssignedCompany;
    //echo json_encode($data); die;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/editform/business_process_organitation', $data); 
    $this->load->view('layout/footer.php');
  }
  public function proses_editcoveragemapping($AccountPlanningId){
    $this->checkModule();
    $user = $this->session->all_userdata();
    $vcif = $this->input->post('vcif');
    $jumlahCoverageMapping = $this->input->post('jumlahCoverageMapping');
    $dataCoverageMapping = explode(',',$this->input->post('dataCoverageMapping'));
    
    $arrCoverageMapping = array();
    foreach($dataCoverageMapping as $row){
      $coverageMapping = array(
        'ClientName' => $this->input->post('client_name_'.$row),
        'ContactNumber' => $this->input->post('client_contact_'.$row),
        'ClientPosition' => $this->input->post('client_position_'.$row),
        'BankPerson' => $this->input->post('bank_person_name_'.$row),
        'BankContact' => $this->input->post('bank_contact_'.$row),
        'BankPosition' => $this->input->post('bank_position_'.$row),
        'OtherInformation' => $this->input->post('other_information_'.$row)          
      );
      array_push($arrCoverageMapping, $coverageMapping);
    }
    
    $data = array(
      'accountPlanningId' => $AccountPlanningId,
      'vcif' => $vcif,
      'jumlahCoverageMapping' => $jumlahCoverageMapping,
      'arrCoverageMapping' => $arrCoverageMapping,
      'createdBy' => $user['PERSONAL_NUMBER']
    );
    //echo json_encode($data); die;
    $this->TasklistAccountPlanning_model->updateCoverageMapping($data);
    $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating coverage mapping on company information', $user['PERSONAL_NUMBER']);
    redirect('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');
  }
  public function editcoveragemapping($AccountPlanningId, $AccountPlanningTab, $VCIF){
    $this->checkModule();

    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId'] = $AccountPlanningId;
    $data['AccountPlanningTab'] = $AccountPlanningTab;
    $data['VCIF'] = $VCIF;

    $rsCompany = $this->TasklistAccountPlanning_model->getCompanyInformation($VCIF);
    $data['CompanyInformation'] = $rsCompany;

    $rsCoverageMapping = $this->TasklistAccountPlanning_model->getAccountPlanningCoverageMapping($AccountPlanningId, $VCIF);
    $data['CoverageMapping'] = $rsCoverageMapping;
    //echo json_encode($rsCoverageMapping); die;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/editform/coverage_mapping', $data); 
    $this->load->view('layout/footer.php');
  }
  public function proses_editstrategicplan($AccountPlanningId){
    $this->checkModule();
    $user = $this->session->all_userdata();
    $vcif = $this->input->post('vcif');
    $jumlahStrategicPlan = $this->input->post('jumlahStrategicPlan');
    $dataStrategicPlan = explode(',',$this->input->post('dataStrategicPlan'));
    
    $arrStrategicPlan = array();
    foreach($dataStrategicPlan as $row){
      $name = trim($this->input->post('name_'.$row));
      if($name != ""){
        $strategicPlan = array(
          'StrategicPlanTypeId' => $this->input->post('type_'.$row),
          'Name' => $this->input->post('name_'.$row)
        );
        array_push($arrStrategicPlan, $strategicPlan);
      }     
    }
    
    $data = array(
      'accountPlanningId' => $AccountPlanningId,
      'vcif' => $vcif,
      'jumlahStrategicPlan' => count($arrStrategicPlan),
      'arrStrategicPlan' => $arrStrategicPlan,
      'createdBy' => $user['PERSONAL_NUMBER']
    );
    //echo json_encode($data); die;
    $this->TasklistAccountPlanning_model->updateStrategicPlan($data);
    $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating strategic plan on company information', $user['PERSONAL_NUMBER']);
    redirect('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');
  }
  public function editstrategicplan($AccountPlanningId, $AccountPlanningTab, $VCIF){
    $this->checkModule();

    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId'] = $AccountPlanningId;
    $data['AccountPlanningTab'] = $AccountPlanningTab;
    $data['VCIF'] = $VCIF;

    $rsCompany = $this->TasklistAccountPlanning_model->getCompanyInformation($VCIF);
    $data['CompanyInformation'] = $rsCompany;

    $rsStrategicPlanType = $this->TasklistAccountPlanning_model->getStrategicPlanTypeOption();
    $data['StrategicPlanTypeOption'] = $rsStrategicPlanType;
    
    $rsStrategicPlan = $this->TasklistAccountPlanning_model->getAccountPlanningStrategicPlan($AccountPlanningId, $VCIF);
    $data['StrategicPlan'] = $rsStrategicPlan;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/editform/strategic_plan', $data); 
    $this->load->view('layout/footer.php');
  }
  public function proses_editkeyshareholders($AccountPlanningId){
    $this->checkModule();
    $user = $this->session->all_userdata();
    $dataShareholders = explode(',',$this->input->post('arrShareholders'));
    $arrShareholders = array();
    
    foreach($dataShareholders as $row){
      $shareholders = array(
          'Name' => $this->input->post('name_'.$row),
          'Value' => str_replace(",","",$this->input->post('value_'.$row))
      );
      array_push($arrShareholders, $shareholders);
    }  
    
    $data = array(
      'accountPlanningId' => $AccountPlanningId,
      'jumlahShareholders' => count($arrShareholders),
      'arrShareholders' => $arrShareholders,
      'createdBy' => $user['PERSONAL_NUMBER']
    );
    $this->TasklistAccountPlanning_model->updateShareholders($data);
    $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating key shareholders on company information', $user['PERSONAL_NUMBER']);
    redirect('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');
  }
  public function editkeyshareholders($AccountPlanningId, $AccountPlanningTab){
    $this->checkModule();

    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId'] = $AccountPlanningId;
    $data['AccountPlanningTab'] = $AccountPlanningTab;

    $rsShareholder = $this->PerformanceAccountPlanning_model->getAccountPlanningShareholder($AccountPlanningId);
    for($i=0; $i<count($rsShareholder); $i++){
      $rsShareholder[$i]['Value'] =  round($rsShareholder[$i]['Value'],0);
    }
    $data['Shareholder'] = $rsShareholder;

    //echo json_encode($rsShareholder); die;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/editform/key_shareholders', $data); 
    $this->load->view('layout/footer.php');
  }
  public function proses_editgroupoverview(){
    $this->checkModule();
    $user = $this->session->all_userdata();
    $AccountPlanningId = $this->input->post('account_planning_id');

    $data = array(
      'accountPlanningId' => $AccountPlanningId,
      'VCIF' => $this->input->post('vcif'),
      'address' => $this->input->post('address'),
      'provinceId' => $this->input->post('city'),
      'globalRatingId' => $this->input->post('global_ratings'),
      'domesticRatingId' => $this->input->post('domestic_ratings'),
      'industry' => $this->input->post('industry'),
      'industryTrendId' => $this->input->post('industry_trend'),
      'lifeCycleId' => $this->input->post('life_cycle'),
      'createdBy' => $user['PERSONAL_NUMBER']
    );

    $this->TasklistAccountPlanning_model->updateGroupOverview($data);
    $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Update', 'Updating group overview on company information', $user['PERSONAL_NUMBER']);
    redirect('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');
  }
  public function editgroupoverview($AccountPlanningId, $AccountPlanningTab, $VCIF) {
    $this->checkModule();

    $data['isCST']                    = '';
    if ($this->isCST($AccountPlanningId) == true) {
      $data['isCST']                  = 'Cst';
    }
    $data['AccountPlanningId'] = $AccountPlanningId;
    $data['AccountPlanningTab'] = $AccountPlanningTab;
    $data['VCIF'] = $VCIF;

    $CustomerName = $this->TasklistAccountPlanning_model->getCustomerInformation($VCIF);
    $data['CustomerName'] = $CustomerName;

    $rsCity = $this->TasklistAccountPlanning_model->getCityOption();
    $data['CityOption'] = $rsCity;

    $rsGlobalRating = $this->TasklistAccountPlanning_model->getGlobalRatingOption();
    $data['GlobalRatingOption'] = $rsGlobalRating;

    $defaultGlobalRatingDescription = $this->TasklistAccountPlanning_model->getGlobalRatingDescription($rsGlobalRating[0]->GlobalRatingId);
    $data['defaultGlobalRatingDescription'] = $defaultGlobalRatingDescription;

    $rsDomesticRating = $this->TasklistAccountPlanning_model->getDomesticRatingOption();
    $data['DomesticRatingOption'] = $rsDomesticRating;

    $rsIndustryTrend = $this->TasklistAccountPlanning_model->getIndustryTrendOption();
    $data['IndustryTrendOption'] = $rsIndustryTrend;

    $rsLifeCycle = $this->TasklistAccountPlanning_model->getLifeCycleOption();
    $data['LifeCycleOption'] = $rsLifeCycle;

    $rsGroupOverview = $this->TasklistAccountPlanning_model->getGroupOverviewInformation($VCIF);
    $data['GroupOverview'] = $rsGroupOverview;

    //echo json_encode($data); die;
    
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/editform/group_overview', $data); 
    $this->load->view('layout/footer.php');
  }
  public function serviceGetGlobalRatingDescription($globalRatingId){
    $user = $this->session->all_userdata();
    if(empty($user['USER_ID'])) redirect('logins');
    $result = $this->TasklistAccountPlanning_model->getGlobalRatingDescription($globalRatingId);
    echo json_encode($result);
  }
  /*
End Script From Irvan
  */
}

?>