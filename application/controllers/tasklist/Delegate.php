<?php 

class Delegate extends MY_Controller {

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
      $this->load->model('TasklistAccountPlanning_model');
      $this->load->model('PerformanceAccountPlanning_model');
      $this->load->model('MonitoringAccountPlanning_model');
      $this->load->model('DataTransaction_model');
      $this->load->model('AccountPlanningCalculate_model');
      $this->load->model('DataLoadOption_model');
      $this->load->model('Delegate_model');
      $this->load->model('Notification_model');

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index($rowno=0) {
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
    
    $search_year = array('all' => '--- All ---'
                        , $this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $this->current_year, ' class="form-control col-md-7 col-xs-12" style="width: 25%;min-width: 80px"');
    $params['keyword_search_box'] = '';
    $total_records = $this->Delegate_model->getTotalMyAccountPlanningByDivision($this->session->DIVISION, $this->current_year);
    if ($total_records > 0) {   

      $ap_Tasklist = $this->Delegate_model->getMyAccountPlanningByDivision($this->session->DIVISION, $limit_per_page, $rowno, $this->current_year);

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

      $config['base_url'] = base_url() . 'tasklist/delegate/index';
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
    $this->load->view('tasklist/delegate_account_planning_list.php', $params);
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
    
    $search_year = array('all' => '--- All ---'
                        , $this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $fYear, ' class="form-control col-md-7 col-xs-12" style="width: 25%;min-width: 80px"');

    $total_records = $this->Delegate_model->getTotalMyAccountPlanningByDivision($this->session->DIVISION, $fYear, $fDocStatus, $fSearchTxt);
    $params['keyword_search_box'] = $fSearchTxt;
    if ($total_records > 0) {   

      $ap_Tasklist = $this->Delegate_model->getMyAccountPlanningByDivision($this->session->DIVISION, $limit_per_page, $rowno, $fYear, $fDocStatus, $fSearchTxt);

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

      $config['base_url'] = base_url() . 'tasklist/delegate/search/'.$fYear.'/'.$fDocStatus.'/'.$searchUrl;
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
    $this->load->view('tasklist/delegate_account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function view($AccountPlanningId, $AccountPlanningTabType='details', $AccountPlanningTab='') {
    $this->checkModule();

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
    $this->load->view('tasklist/delegate_account_planning_detail.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function add_delegate() {
    $AccountPlanningId = $this->input->post('AccountPlanningId');
    $AccountPlanningOwnerId = $this->input->post('AccountPlanningOwnerId');
    $new_owner = $this->input->post('new_owner');
    $old_owner = $this->input->post('old_owner');

    $data_input = array(
      'AccountPlanningId'     => $AccountPlanningId
      , 'UserId'              => $new_owner
      , 'IsActive'            => 1
      , 'StartDate'           => $this->current_datetime
      , 'CreatedBy'           => $this->session->PERSONAL_NUMBER
    );

    $data_update = array(
      'AccountPlanningId'     => $AccountPlanningId
      , 'UserId'              => $old_owner
      , 'IsActive'            => 0
      , 'EndDate'             => $this->current_datetime
      , 'ModifiedBy'          => $this->session->PERSONAL_NUMBER
    );

    $insertData = $this->TasklistAccountPlanning_model->insertData('AccountPlanningOwner', $data_input);
    
    $updateData = $this->TasklistAccountPlanning_model->updateData('AccountPlanningOwner', $data_update, 'AccountPlanningOwnerId', $AccountPlanningOwnerId);

    if($insertData['status'] == 'success') {
      $AP_owner = $this->TasklistAccountPlanning_model->getAccountPlanningOwner($AccountPlanningId);
      $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($AccountPlanningId, 'Delegate', $AP_owner['RMName'].' Delegated into account planning ('.$AccountPlanningId.')', $this->session->PERSONAL_NUMBER);

      $this->Notification_model->addNotif($new_owner, 'Delegate', 'Delegate Account Planning', 'Your\'e Delegated into account planning ('.$AccountPlanningId.')', 'tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input');
    }
    
    echo json_encode($insertData);
  }

  public function getRMPerUnitKerja($AccountPlanningId) {
    $AccountPlanningOwner = $this->TasklistAccountPlanning_model->getAccountPlanningOwner($AccountPlanningId);
    $result = $this->TasklistDisposisi_model->getRMPerUnitKerja($this->session->DIVISION, $AccountPlanningOwner['UserId']);

    echo json_encode($result);
  }

  public function getAccountPlanningOwner($AccountPlanningId) {
    $result = $this->TasklistAccountPlanning_model->getAccountPlanningOwner($AccountPlanningId);

    echo json_encode($result);
  }

}

?>
