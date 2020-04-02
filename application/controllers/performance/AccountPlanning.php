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
      $this->load->model('TasklistDisposisi_model');
      $this->load->model('TasklistAccountPlanning_model');
      $this->load->model('PerformanceAccountPlanning_model');
      $this->load->model('MonitoringAccountPlanning_model');
      $this->load->model('DataTransaction_model');

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

    $search_year2 = array(
                        /*$this->current_year-2 => $this->current_year-2
                        , */$this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box2'] = form_dropdown('tahun_search_box2', $search_year2, $this->current_year, ' id="tahun_search_box2"');

    $params['keyword_search_box'] = '';
    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning('', $this->current_year);
    //$params['keyword_search_box'] = $keyword_search;
    if ($total_records > 0) {   
      // $ap_Tasklist = $this->TasklistAccountPlanning_model->getViewTasklistAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, '', '', $this->current_year, '');

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning('', $limit_per_page, $rowno, $this->current_year);

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
          //'Currency'                        => $ap_row['Currency'],
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
          //'CustomerGroupName'               => $ap_row['CustomerGroupName'],
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

      $config['base_url'] = base_url() . 'performance/AccountPlanning/page';
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
    $this->load->view('performance/performance_account_planning.php', $params);
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
    // echo empty($fDocStatus).'| '.$fDocStatus.'-->';
    if (empty($fDocStatus) && $fDocStatus<>'0') {
      $fDocStatus = ($this->input->post('status_search_box'));
    }
    else {
      $fDocStatus = str_replace('_', ' ', $fDocStatus);
    }
    // echo empty($fDocStatus).' | '.$fDocStatus;die();
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

    //$keyword_search = ($this->input->get('keyword_search_box')) ? $this->input->get('keyword_search_box') : "";
    //$status_search = ($this->input->get('status_search_box')) ? $this->input->get('status_search_box') : "all";

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

    $search_year2 = array(
                        /*$this->current_year-2 => $this->current_year-2
                        , */$this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box2'] = form_dropdown('tahun_search_box2', $search_year2, $this->current_year, ' id="tahun_search_box2"');

    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning('', $fYear, $fDocStatus, $fSearchTxt);
    $params['keyword_search_box'] = $fSearchTxt;
    if ($total_records > 0) {   
      // $ap_Tasklist = $this->TasklistAccountPlanning_model->getViewTasklistAccountPlanning($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, '', '', $this->current_year, '');

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning('', $limit_per_page, $rowno, $fYear, $fDocStatus, $fSearchTxt);

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
          //'Currency'                        => $ap_row['Currency'],
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
          //'CustomerGroupName'               => $ap_row['CustomerGroupName'],
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

      if(empty($fSearchTxt))
          $searchUrl = '_';
      else 
          $searchUrl = $fSearchTxt;

      $config['base_url'] = base_url() . 'performance/AccountPlanning/search/'.$fYear.'/'.$fDocStatus.'/'.$searchUrl;
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
    $this->load->view('performance/performance_account_planning.php', $params);
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

    $search_year2 = array(
                        /*$this->current_year-2 => $this->current_year-2
                        , */$this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box2'] = form_dropdown('tahun_search_box2', $search_year2, $this->current_year, ' id="tahun_search_box2"');

    $total_records = $this->TasklistAccountPlanning_model->getTotalMyAccountPlanning('', $this->current_year);
     $params['keyword_search_box'] = '';
    if ($total_records > 0) {   

      $ap_Tasklist = $this->TasklistAccountPlanning_model->getMyAccountPlanning('', $limit_per_page, $rowno, $this->current_year);

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
          //'Currency'                        => $ap_row['Currency'],
          'CreatedDate'                     => $ap_row['CreatedDate'],
          'Year'                            => $ap_row['Year'],
          'ap_year_color'                   => $ap_year_color,
          'ap_status_color'                 => $ap_status_color,
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerName'                    => $ap_row['CustomerName'],
          'Logo'                            => $ap_row['Logo'],
          //'CustomerGroupName'               => $ap_row['CustomerGroupName'],
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

      $config['base_url'] = base_url() . 'performance/AccountPlanning/page';
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
    $this->load->view('performance/performance_account_planning.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function view($AccountPlanningId, $AccountPlanningTabType='details', $AccountPlanningTab='') {
    $this->checkModule();
    // $this->checkAPInputStatus($AccountPlanningId);
    // $this->checkOwner($AccountPlanningId);

    $ap_breadcrumb_title = 'View';
    $ap_tab_type_get = 'details';
    $ap_tab_get = ($AccountPlanningTab) ? $AccountPlanningTab : 'company_information';
    $ap_tab_subcontent_get = ($this->uri->segment(7)) ? $this->uri->segment(7) : '';

    $data['ap_breadcrumb_title']                  = $ap_breadcrumb_title;
    $data['AccountPlanningId']                    = $AccountPlanningId;
    $data['AccountPlanningTabType']               = $ap_tab_type_get;
    $data['AccountPlanningTab']                   = $ap_tab_get;
    $data['AccountPlanningTabSubcontent']         = $ap_tab_subcontent_get;
    $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($AccountPlanningId);

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
    $this->load->view('performance/performance_detail_account_planning.php', $data);
    // $this->load->view('tasklist/account_planning_ajax.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function z_detail($AccountPlanningId) {
    $this->checkModule();
    // $this->checkAPInputStatus($AccountPlanningId);
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
        if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24) {
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
      if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24) {
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
              if ($value['FinancialHighlightItemId'] == 14 || $value['FinancialHighlightItemId'] == 24) {
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

    /*foreach ($data['account_planning']['Years'] as $keyss => $valuess) {
      //Automatic Operating Margin
      if(empty($data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']) || !isset($data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']) || $data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount'] == 0) {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][18][$valuess]['Amount'] = 'NaN';
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][18][$valuess]['ChartAmount'] = 0;
      }
      else {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][18][$valuess]['Amount'] = round((str_replace(',','',$data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][9][$valuess]['Amount'])/str_replace(',', '', $data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']))*100, 2);
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][18][$valuess]['ChartAmount'] = $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][18][$valuess]['Amount'];
      }

      //Automatic Net Profit Margin
      if(empty($data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']) || !isset($data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']) || $data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount'] == 0) {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][19][$valuess]['Amount'] = 'NaN';
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][19][$valuess]['ChartAmount'] = 0;
      }
      else {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][19][$valuess]['Amount'] = round((str_replace(',','',$data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][11][$valuess]['Amount'])/str_replace(',', '', $data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][7][$valuess]['Amount']))*100, 2);
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][19][$valuess]['ChartAmount'] = $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][19][$valuess]['Amount'];
      }

      //Automatic ROA
      if(empty($data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][3][$valuess]['Amount']) || !isset($data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][3][$valuess]['Amount']) || $data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][3][$valuess]['Amount'] == 0) {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][20][$valuess]['Amount'] = 'NaN';
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][20][$valuess]['ChartAmount'] = 0;
      }
      else {
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][20][$valuess]['Amount'] = round((str_replace(',','',$data['account_planning']['FinancialHighlight'][2]['FinancialHighlight_details'][11][$valuess]['Amount'])/str_replace(',', '', $data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][3][$valuess]['Amount']))*100, 2);  
        $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][20][$valuess]['ChartAmount'] = $data['account_planning']['FinancialHighlight'][5]['FinancialHighlight_details'][20][$valuess]['Amount'];
      }

      //Automatic Current Ratio
      if (str_replace(',','',$data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][4][$valuess]['Amount'])+str_replace(',','',$data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][5][$valuess]['Amount']) == 0) {
        $data['account_planning']['FinancialHighlight'][3]['FinancialHighlight_details'][12][$valuess]['Amount'] = 'NaN';
        $data['account_planning']['FinancialHighlight'][3]['FinancialHighlight_details'][12][$valuess]['ChartAmount'] = 0;
      } else {
        $data['account_planning']['FinancialHighlight'][3]['FinancialHighlight_details'][12][$valuess]['Amount'] = round(str_replace(',','',$data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][3][$valuess]['Amount']) / (str_replace(',','',$data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][4][$valuess]['Amount'])+str_replace(',','',$data['account_planning']['FinancialHighlight'][1]['FinancialHighlight_details'][5][$valuess]['Amount'])), 2);
        $data['account_planning']['FinancialHighlight'][3]['FinancialHighlight_details'][12][$valuess]['ChartAmount'] = $data['account_planning']['FinancialHighlight'][3]['FinancialHighlight_details'][12][$valuess]['Amount'];
      }

      //Automatic DSCR
    }*/

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

      /* Start of Wallet Share */
      $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']][0] = array(
        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
        , 'heading_panel'         => $heading_panel
        , 'tab_panel'             => $tab_panel
        , 'expanded_panel'        => $expanded_panel
      );

      foreach ($data['account_planning_vcif_list'] as $keyss => $account_planning_vcif) {
        $dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShare($AccountPlanningId, $value['BankFacilityItemId'], $account_planning_vcif['VCIF']);
        $IDRAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']]['IDRAmount']);
        $ValasAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']]['ValasAmount']);
        $BRINominal = $IDRAmount + $ValasAmount;
        $OtherNominal = 0;
        $BRIPortion = 0;
        $OtherPortion = 0;
        $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
          'WalletShareId'           => 0
          , 'BankFacilityItemName'  => $value['BankFacilityItemName']
          , 'BRINominal'            => number_format($BRINominal,0)
          , 'BRIPortion'            => $BRIPortion
          , 'OtherNominal'          => number_format($OtherNominal,0)
          , 'OtherPortion'          => $OtherPortion
          , 'TotalAmount'           => 0
        );
        if (!empty($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']])) {
          foreach ($dataWalletShare[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] as $keys => $values) {
            $TotalAmount = $values['TotalAmount']/VALUE_PER;
            $IDRAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']]['IDRAmount']);
            $ValasAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['FacilitiesBanking_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']]['ValasAmount']);
            $BRINominal = $IDRAmount + $ValasAmount;

            if($TotalAmount == 0){
              $OtherNominal = 0;
              $BRIPortion = 0;
              $OtherPortion = 0;
            }else{
              if($BRINominal > $TotalAmount){
                $OtherNominal = 0;
                $BRIPortion = 100;
                $OtherPortion = 0;
              }else{
                $OtherNominal = $TotalAmount - $BRINominal;
                $BRIPortion = ($BRINominal/$TotalAmount)*100;
                $OtherPortion = ($OtherNominal/$TotalAmount)*100;
              }
            }

            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShare_details'][$account_planning_vcif['VCIF']][$value['BankFacilityItemId']] = array(
              'WalletShareId'           => $values['WalletShareId']
              , 'BankFacilityItemName'  => $value['BankFacilityItemName']
              , 'BRINominal'            => number_format($BRINominal,0)
              , 'BRIPortion'            => number_format($BRIPortion,2)
              , 'OtherNominal'          => number_format($OtherNominal,0)
              , 'OtherPortion'          => $OtherPortion
              , 'TotalAmount'           => number_format($TotalAmount,0)
            );
          }
        }
        
        // Wallet Share Addition
        $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $account_planning_vcif['VCIF'], $value['BankFacilityGroupId']);
        if (isset($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']])) {
          foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']] as $keyssss => $BankFacilityItemAddition) {
            $IDRAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']]['IDRAmountAddition']);
            $ValasAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']]['ValasAmountAddition']);
            $BRINominal = $IDRAmount + $ValasAmount;
            $OtherNominal = 0;
            $BRIPortion = 0;
            $OtherPortion = 0;
        
            $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
              'WalletShareAdditionId'         => 0
            , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
            , 'BRINominalAddition'            => number_format($BRINominal,0)
            , 'BRIPortionAddition'            => $BRIPortion
            , 'OtherNominalAddition'          => number_format($OtherNominal,0)
            , 'OtherPortionAddition'          => $OtherPortion
            , 'TotalAmountAddition'           => 0
            );

            $dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningWalletShareAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId'], $account_planning_vcif['VCIF']);
            //echo json_encode($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] ); die;
            foreach ($dataWalletShareAddition[$value['BankFacilityGroupId']][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $WalletShareAddition) {
              $TotalAmount = $WalletShareAddition['TotalAmountAddition']/VALUE_PER;
              $IDRAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']]['IDRAmountAddition']);
              $ValasAmount = str_replace(',', '', $data['account_planning']['FacilitiesBanking'][$value['BankFacilityGroupId']]['BankFacilityAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']]['ValasAmountAddition']);
              $BRINominal = $IDRAmount + $ValasAmount;

              if($TotalAmount == 0){
                $OtherNominal = 0;
                $BRIPortion = 0;
                $OtherPortion = 0;
              }else{
                if($BRINominal > $TotalAmount){
                  $OtherNominal = 0;
                  $BRIPortion = 100;
                  $OtherPortion = 0;
                }else{
                  $OtherNominal = $TotalAmount - $BRINominal;
                  $BRIPortion = ($BRINominal/$TotalAmount)*100;
                  $OtherPortion = ($OtherNominal/$TotalAmount)*100;
                }
              }

              $data['account_planning']['WalletShare'][$value['BankFacilityGroupId']]['WalletShareAddition_detail'][$account_planning_vcif['VCIF']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'WalletShareAdditionId'         => $WalletShareAddition["WalletShareAdditionId"]
              , 'BankFacilityItemAdditionName'  => $BankFacilityItemAddition['BankFacilityItemAdditionName']
              , 'BRINominalAddition'            => number_format($BRINominal,0)
              , 'BRIPortionAddition'            => number_format($BRIPortion, 2)
              , 'OtherNominalAddition'          => number_format($OtherNominal,0)
              , 'OtherPortionAddition'          => $OtherPortion
              , 'TotalAmountAddition'           => number_format($TotalAmount,0)
              );
            }
          }
        }
      }
      /* End of Wallet Share */

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

    // Credit Simulation
      $dataCreditSimulation[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulation($AccountPlanningId, $value['BankFacilityItemId']);
      $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']][0] = array(
        'BankFacilityGroupId'     => $value['BankFacilityGroupId']
        , 'BankFacilityGroupName' => $value['BankFacilityGroupName']
        , 'heading_panel'         => $heading_panel
        , 'tab_panel'             => $tab_panel
        , 'expanded_panel'        => $expanded_panel
        );

      $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulation_detail'][$value['BankFacilityItemId']] = array(
        'CreditSimulationId'                 => 0
        , 'BankFacilityItemName'          => $value['BankFacilityItemName']
        , 'IDRPlafond'                    => ''
        , 'ValasPlafond'                  => ''
        , 'IDROutstanding'                => ''
        , 'ValasOutstanding'                => ''
        , 'IDRDailyRatas'                => ''
        , 'ValasDailyRatas'                => ''
        , 'IDRTenor'                => ''
        , 'ValasTenor'                => ''
        , 'IDRIndicativeRate'                => ''
        , 'ValasIndicativeRate'                => ''
        , 'IDRIncomeExpense'                => ''
        , 'ValasIncomeExpense'                => ''
        , 'IDRProvisionRate'                => ''
        , 'ValasProvisionRate'                => ''
        , 'IDRProvision'                => ''
        , 'ValasProvision'                => ''
        , 'IDRFee'                => ''
        , 'ValasFee'                => ''
        );

      if (!empty($dataCreditSimulation[$value['BankFacilityGroupId']])) {
        foreach ($dataCreditSimulation[$value['BankFacilityGroupId']] as $keys => $values) {
          $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulation_detail'][$value['BankFacilityItemId']] = array(
            'CreditSimulationId'             => $values['CreditSimulationId']
            , 'BankFacilityItemName'      => $value['BankFacilityItemName']
            , 'IDRPlafond'                => $values['IDRPlafond']
            , 'ValasPlafond'              => $values['ValasPlafond']
            , 'IDROutstanding'                 => $values['IDROutstanding']
            , 'ValasOutstanding'                 => $values['ValasOutstanding']
            , 'IDRDailyRatas'                 => $values['IDRDailyRatas']
            , 'ValasDailyRatas'                 => $values['ValasDailyRatas']
            , 'IDRTenor'                 => $values['IDRTenor']
            , 'ValasTenor'                 => $values['ValasTenor']
            , 'IDRIndicativeRate'                 => $values['IDRIndicativeRate']
            , 'ValasIndicativeRate'                 => $values['ValasIndicativeRate']
            , 'IDRIncomeExpense'                 => $values['IDRIncomeExpense']
            , 'ValasIncomeExpense'                 => $values['ValasIncomeExpense']
            , 'IDRProvisionRate'                 => $values['IDRProvisionRate']
            , 'ValasProvisionRate'                 => $values['ValasProvisionRate']
            , 'IDRProvision'                 => $values['IDRProvision']
            , 'ValasProvision'                 => $values['ValasProvision']
            , 'IDRFee'                 => $values['IDRFee']
            , 'ValasFee'                 => $values['ValasFee']
            );
        }
      }
/*
    // Credit Simulation Addition
      $dataBankFacilityItemAddition[$value['BankFacilityGroupId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, '', $value['BankFacilityGroupId']);

      if (!empty($dataBankFacilityItemAddition[$value['BankFacilityGroupId']])) {
        foreach ($dataBankFacilityItemAddition[$value['BankFacilityGroupId']] as $keysssss => $BankFacilityItemAddition) {
          $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulationAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
            'CreditSimulationIdAdditionId'               => 0
            , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
            , 'IDRPlafond'                          => ''
            , 'ValasPlafond'                        => ''
            , 'IDROutstanding'                      => ''
            , 'ValasOutstanding'                      => ''
            , 'IDRDailyRatas'                      => ''
            , 'ValasDailyRatas'                      => ''
            , 'IDRTenor'                      => ''
            , 'ValasTenor'                      => ''
            , 'IDRIndicativeRate'                      => ''
            , 'ValasIndicativeRate'                      => ''
            , 'IDRIncomeExpense'                      => ''
            , 'ValasIncomeExpense'                      => ''
            , 'IDRProvisionRate'                      => ''
            , 'ValasProvisionRate'                      => ''
            , 'IDRProvision'                      => ''
            , 'ValasProvision'                      => ''
            , 'IDRFee'                      => ''
            , 'ValasFee'                      => ''
            );

          $dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditSimulationAddition($AccountPlanningId, $BankFacilityItemAddition['BankFacilityItemAdditionId']);

          if (!empty($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']])) {
            foreach ($dataCreditSimulationAddition[$value['BankFacilityGroupId']][$BankFacilityItemAddition['BankFacilityItemAdditionId']] as $keysssss => $CreditSimulationAddition) {
              $data['account_planning']['CreditSimulation'][$value['BankFacilityGroupId']]['CreditSimulationAddition_detail'][$BankFacilityItemAddition['BankFacilityItemAdditionId']] = array(
                'CreditSimulationIdAdditionId'               => $CreditSimulationAddition['CreditSimulationIdAdditionId']
                , 'BankFacilityItemAdditionName'        => $BankFacilityItemAddition['BankFacilityItemAdditionName']
                , 'IDRPlafondAddition'                          => $CreditSimulationAddition['IDRPlafondAddition']
                , 'ValasPlafondAddition'                        => $CreditSimulationAddition['ValasPlafondAddition']
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
                );

            }
          }
        }
      }
*/

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

  // CreditAssumption
  $data['account_planning']['CreditAssumption'][0] = array(
    'CreditSimulationAssumptionId'                => 0,
    'USDExchange'                                 => 0,
    'IDRFTPSimpanan'                              => 0,
    'ValasFTPSimpanan'                            => 0,
    'IDRFTPPinjaman'                              => 0,
    'ValasFTPPinjaman'                            => 0
    );

  $data['account_planning']['CreditAssumption'] = $this->PerformanceAccountPlanning_model->getAccountPlanningCreditAssumption($AccountPlanningId);
    if (!empty($data['account_planning']['CreditAssumption'])) {
      $data['account_planning']['CreditAssumption'][0] = array(
          'CreditSimulationAssumptionId'                => $data['account_planning']['CreditAssumption'][0]['CreditSimulationAssumptionId'],
          'USDExchange'                                 => number_format($data['account_planning']['CreditAssumption'][0]['USDExchange']),
          'IDRFTPSimpanan'                              => number_format($data['account_planning']['CreditAssumption'][0]['IDRFTPSimpanan']),
          'ValasFTPSimpanan'                            => number_format($data['account_planning']['CreditAssumption'][0]['ValasFTPSimpanan']),
          'IDRFTPPinjaman'                              => number_format($data['account_planning']['CreditAssumption'][0]['IDRFTPPinjaman']),
          'ValasFTPPinjaman'                            => number_format($data['account_planning']['CreditAssumption'][0]['ValasFTPPinjaman'])
          );
    }

    // echo "<pre>";
    // // print_r($dataBankFacilityItemAddition);
    // print_r($data['account_planning']['CreditAssumption']);
    // die();

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/performance_detail_account_planning.php', $data);
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


  }


}

?>
