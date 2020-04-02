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
    $keyword_search = ($this->input->get('keyword_search_box')) ? $this->input->get('keyword_search_box') : "";
    $status_search = ($this->input->get('status_search_box')) ? $this->input->get('status_search_box') : "all";
    
    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_box[''] = 'All';
    foreach ($ukers as $uker) {
      $uker_search_box[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_box, '', ' class="form-control col-md-7 col-xs-12"');

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_box['all'] = 'All';
    foreach ($doc_statuses as $doc_status) {
      $status_search_box[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_box, '', ' class="form-control col-md-7 col-xs-12"');
    
    $search_year = array($this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $this->current_year, ' class="form-control col-md-7 col-xs-12"');

    $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning('', '', $this->current_year, $status_search);

    $params['keyword_search_box'] = $keyword_search;
    if ($total_records > 0) {   
      $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, '', '', $this->current_year, $status_search);

      $data = array(
            'ap_monitoring' => array()
      );

      foreach ($ap_monitoring as $ap_row) {
        $ap_id = $ap_row['MonitoringAccountPlanningId'];
        if (!key_exists($ap_id, $data['ap_monitoring'])) {
          if ($ap_row['ProgressTotal'] == 0.00) {
            $ProgressTotal = '0';
          }
          else {
            $ProgressTotal = $ap_row['ProgressTotal'];
          }
          $AccountPlanningCheckerList = $this->MonitoringAccountPlanning_model->getAccountPlanningChecker($ap_row['AccountPlanningId']);
          $CheckerList = array();
          foreach ($AccountPlanningCheckerList as $key) {
            $CheckerList[] = $key['personal_number']."/".$key['Name'];
          }

          $AccountPlanningSignerList = $this->MonitoringAccountPlanning_model->getAccountPlanningSigner($ap_row['AccountPlanningId']);
          $SignerList = array();
          foreach ($AccountPlanningSignerList as $key) {
            $SignerList[] = $key['personal_number']."/".$key['Name'];
          }
          
          $AccountPlanningAddon = '';
          if (!empty(strtotime($ap_row['AccountPlanningAddon']))) {
              $AccountPlanningAddon = date("j/m/y", strtotime($ap_row['AccountPlanningAddon']));
          }
          
          $AccountPlanningPublish = '';
          $AccountPlanningPublish_datetime = $this->current_datetime;
          $dateDiff = '';
          if ($ap_row['DocumentStatusId'] == 4) {
            if (!empty(strtotime($ap_row['AccountPlanningPublish']))) {
              $AccountPlanningPublish = ' - <i class="fa fa-clock" title="Publish" style="color: #5cb85c;"></i> '.date("j/m/y", strtotime($ap_row['AccountPlanningPublish']));
              $AccountPlanningPublish_datetime = $ap_row['AccountPlanningPublish'];
              if (!empty(strtotime($ap_row['AccountPlanningAddon'])) && !empty(strtotime($AccountPlanningPublish_datetime))) {
                $dateDiff = " : ".$this->dateDiff($ap_row['AccountPlanningAddon'], $AccountPlanningPublish_datetime)." day(s)";
              }
            }
          }
          $ap_logo['Logo'] = '';
          if (!empty($ap_row['GroupId'])) {
            $ap_logo = $this->MonitoringAccountPlanning_model->get_customer_logo($ap_row['GroupId']);
          }

          $OwnerLastView = '';
          $ap_LastView = $this->MonitoringAccountPlanning_model->get_owner_last_view($ap_row['AccountPlanningId']);
          if (!empty($ap_LastView['LastView'])) {
            $OwnerLastView = '<i class="fa fa-calendar" title="RM Last View" style="color: #5bc0de;"></i> '.date('j M y H:i', strtotime($ap_LastView['LastView']));
          }

          $SektorUsaha = ($ap_row['SektorUsaha']) ? $ap_row['SektorUsaha'] : "Kelapa Sawit";
          $Clasified = ($ap_row['Clasified']) ? $ap_row['Clasified'] : "Platinum";
          $params['results'][$ap_id] = array(
            'CustomerName'      => $ap_row['CustomerName'],
            'Logo'              => $ap_logo['Logo'],
            'LastView'          => $OwnerLastView,
            'Vcif'              => $ap_row['Vcif'],
            'SektorUsaha'       => $SektorUsaha,
            'RMName'            => $ap_row['RMName'],
            'Member'               => json_decode($ap_row['Member'], TRUE),
            'CheckerList'           => implode("; ", $CheckerList),
            'SignerList'           => implode("; ", $SignerList),
            'GroupName'        => $ap_row['GroupName'],
            'Clasified'        => $Clasified,
            'DocumentStatusId'        => $ap_row['DocumentStatusId'],
            'Status'   => $ap_row['Status'],
            'AccountPlanningAddon'   => $AccountPlanningAddon,
            'AccountPlanningPublish'   => $AccountPlanningPublish,
            'dateDiff'   => $dateDiff,
            'current_date'   => $this->current_date,
            'Year'          => $ap_row['Year'],
            'ProgressTotal' => number_format($ProgressTotal, 1)
          );
        }
      }

      $params['keyword_search_box'] = $keyword_search;
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'monitoring/AccountPlanning/page';
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
    $this->load->view('monitoring/AccountPlanning.php', $params);
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
    $keyword_search = ($this->input->get('keyword_search_box')) ? $this->input->get('keyword_search_box') : "";
    $status_search = ($this->input->get('status_search_box')) ? $this->input->get('status_search_box') : "all";
    

    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_box[''] = 'All';
    foreach ($ukers as $uker) {
      $uker_search_box[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_box, '', ' class="form-control col-md-7 col-xs-12"');

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_box['all'] = 'All';
    foreach ($doc_statuses as $doc_status) {
      $status_search_box[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_box, '', ' class="form-control col-md-7 col-xs-12"');
    
    $search_year = array($this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $this->current_year, ' class="form-control col-md-7 col-xs-12"');

    $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning('', '', $this->current_year, $status_search);

    $params['keyword_search_box'] = $keyword_search;
    if ($total_records > 0) {   
      $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, '', '', $this->current_year, $status_search);

      $data = array(
            'ap_monitoring' => array()
      );

      foreach ($ap_monitoring as $ap_row) {
        $ap_id = $ap_row['MonitoringAccountPlanningId'];
        if (!key_exists($ap_id, $data['ap_monitoring'])) {
          if ($ap_row['ProgressTotal'] == 0.00) {
            $ProgressTotal = '0';
          }
          else {
            $ProgressTotal = $ap_row['ProgressTotal'];
          }
          $AccountPlanningCheckerList = $this->MonitoringAccountPlanning_model->getAccountPlanningChecker($ap_row['AccountPlanningId']);
          $CheckerList = array();
          foreach ($AccountPlanningCheckerList as $key) {
            $CheckerList[] = $key['personal_number']."/".$key['Name'];
          }

          $AccountPlanningSignerList = $this->MonitoringAccountPlanning_model->getAccountPlanningSigner($ap_row['AccountPlanningId']);
          $SignerList = array();
          foreach ($AccountPlanningSignerList as $key) {
            $SignerList[] = $key['personal_number']."/".$key['Name'];
          }
          
          $AccountPlanningAddon = '';
          if (!empty(strtotime($ap_row['AccountPlanningAddon']))) {
              $AccountPlanningAddon = date("j/m/y", strtotime($ap_row['AccountPlanningAddon']));
          }
          
          $AccountPlanningPublish = '';
          $AccountPlanningPublish_datetime = $this->current_datetime;
          $dateDiff = '';
          if ($ap_row['DocumentStatusId'] == 4) {
            if (!empty(strtotime($ap_row['AccountPlanningPublish']))) {
              $AccountPlanningPublish = ' - <i class="fa fa-clock" title="Publish" style="color: #5cb85c;"></i> '.date("j/m/y", strtotime($ap_row['AccountPlanningPublish']));
              $AccountPlanningPublish_datetime = $ap_row['AccountPlanningPublish'];
              if (!empty(strtotime($ap_row['AccountPlanningAddon'])) && !empty(strtotime($AccountPlanningPublish_datetime))) {
                $dateDiff = " : ".$this->dateDiff($ap_row['AccountPlanningAddon'], $AccountPlanningPublish_datetime)." day(s)";
              }
            }
          }
          $ap_logo['Logo'] = '';
          if (!empty($ap_row['GroupId'])) {
            $ap_logo = $this->MonitoringAccountPlanning_model->get_customer_logo($ap_row['GroupId']);
          }

          $OwnerLastView = '';
          $ap_LastView = $this->MonitoringAccountPlanning_model->get_owner_last_view($ap_row['AccountPlanningId']);
          if (!empty($ap_LastView['LastView'])) {
            $OwnerLastView = '<i class="fa fa-calendar" title="RM Last View" style="color: #5bc0de;"></i> '.date('j M y H:i', strtotime($ap_LastView['LastView']));
          }
          
          $SektorUsaha = ($ap_row['SektorUsaha']) ? $ap_row['SektorUsaha'] : "Kelapa Sawit";
          $Clasified = ($ap_row['Clasified']) ? $ap_row['Clasified'] : "Platinum";
          $params['results'][$ap_id] = array(
            'CustomerName'      => $ap_row['CustomerName'],
            'Logo'              => $ap_logo['Logo'],
            'LastView'          => $OwnerLastView,
            'Vcif'              => $ap_row['Vcif'],
            'SektorUsaha'      => $SektorUsaha,
            'RMName'           => $ap_row['RMName'],
            'Member'               => json_decode($ap_row['Member'], TRUE),
            'CheckerList'           => implode("; ", $CheckerList),
            'SignerList'           => implode("; ", $SignerList),
            'GroupName'        => $ap_row['GroupName'],
            'Clasified'        => $Clasified,
            'DocumentStatusId'        => $ap_row['DocumentStatusId'],
            'Status'   => $ap_row['Status'],
            'AccountPlanningAddon'   => $AccountPlanningAddon,
            'AccountPlanningPublish'   => $AccountPlanningPublish,
            'dateDiff'   => $dateDiff,
            'current_date'   => $this->current_date,
            'Year'          => $ap_row['Year'],
            'ProgressTotal' => number_format($ProgressTotal, 1)
          );
        }
      }

      $params['keyword_search_box'] = $keyword_search;
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'monitoring/AccountPlanning/page';
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
    $this->load->view('monitoring/AccountPlanning.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function search_box() {
    $this->checkModule();

    $params = array();

    $keyword_search = ($this->input->get('keyword_search_box')) ? $this->input->get('keyword_search_box') : "";
    $uker_search = ($this->input->get('uker_search_box')) ? $this->input->get('uker_search_box') : "";
    $tahun_search = ($this->input->get('tahun_search_box')) ? $this->input->get('tahun_search_box') : $this->current_year;
    if($this->input->get('status_search_box') == 'all'){
      $status_search = 'all';
    }
    else {
      $status_search = ($this->input->get('status_search_box')) ? $this->input->get('status_search_box') : "0";
    }
    
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

    $rowno = ($this->input->get('rowno')) ? $this->input->get('rowno') : "0";
    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }

    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_field[''] = 'All';
    foreach ($ukers as $uker) {
      $uker_search_field[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_field, $uker_search, ' class="form-control col-md-7 col-xs-12"');

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $status_search_field['all'] = 'All';
    foreach ($doc_statuses as $doc_status) {
      $status_search_field[$doc_status['DocumentStatusId']] = $doc_status['Name'];
    }
    $params['status_search_box'] = form_dropdown('status_search_box', $status_search_field, $status_search, ' class="form-control col-md-7 col-xs-12"');
    
    $search_year = array($this->current_year-1 => $this->current_year-1
                        , $this->current_year => $this->current_year);
    $params['tahun_search_box'] = form_dropdown('tahun_search_box', $search_year, $tahun_search, ' class="form-control col-md-7 col-xs-12"');

    $params['keyword_search_box'] = trim(str_replace(' ', '_', $keyword_search));

    $total_records = $this->MonitoringAccountPlanning_model->getTotalViewAccountPlanning(urldecode(trim($keyword_search)), $uker_search, $tahun_search, $status_search);

    $params['keyword_search_box'] = $keyword_search;
    if ($total_records > 0) {   
      
      $ap_monitoring = $this->MonitoringAccountPlanning_model->getViewAccountPlanning($limit_per_page, $rowno, urldecode(trim($keyword_search)), $uker_search, $tahun_search, $status_search);

      $data = array(
            'ap_monitoring' => array()
      );

      foreach ($ap_monitoring as $ap_row) {
        $ap_id = $ap_row['MonitoringAccountPlanningId'];
        if (!key_exists($ap_id, $data['ap_monitoring'])) {
          if ($ap_row['ProgressTotal'] == 0.00) {
            $ProgressTotal = '0';
          }
          else {
            $ProgressTotal = $ap_row['ProgressTotal'];
          }
          $AccountPlanningCheckerList = $this->MonitoringAccountPlanning_model->getAccountPlanningChecker($ap_row['AccountPlanningId']);
          $CheckerList = array();
          foreach ($AccountPlanningCheckerList as $key) {
            $CheckerList[] = $key['personal_number']."/".$key['Name'];
          }

          $AccountPlanningSignerList = $this->MonitoringAccountPlanning_model->getAccountPlanningSigner($ap_row['AccountPlanningId']);
          $SignerList = array();
          foreach ($AccountPlanningSignerList as $key) {
            $SignerList[] = $key['personal_number']."/".$key['Name'];
          }
          
          $AccountPlanningAddon = '';
          if (!empty(strtotime($ap_row['AccountPlanningAddon']))) {
              $AccountPlanningAddon = date("j/m/y", strtotime($ap_row['AccountPlanningAddon']));
          }
          
          $AccountPlanningPublish = '';
          $AccountPlanningPublish_datetime = $this->current_datetime;
          $dateDiff = '';
          if ($ap_row['DocumentStatusId'] == 4) {
            if (!empty(strtotime($ap_row['AccountPlanningPublish']))) {
              $AccountPlanningPublish = ' - <i class="fa fa-clock" title="Publish Date" style="color: #5cb85c;"></i> '.date("j/m/y", strtotime($ap_row['AccountPlanningPublish']));
              $AccountPlanningPublish_datetime = $ap_row['AccountPlanningPublish'];
              if (!empty(strtotime($ap_row['AccountPlanningAddon'])) && !empty(strtotime($AccountPlanningPublish_datetime))) {
                $dateDiff = " : ".$this->dateDiff($ap_row['AccountPlanningAddon'], $AccountPlanningPublish_datetime)." day(s)";
              }
            }
          }
          $ap_logo['Logo'] = '';
          if (!empty($ap_row['GroupId'])) {
            $ap_logo = $this->MonitoringAccountPlanning_model->get_customer_logo($ap_row['GroupId']);
          }

          $OwnerLastView = '';
          $ap_LastView = $this->MonitoringAccountPlanning_model->get_owner_last_view($ap_row['AccountPlanningId']);
          if (!empty($ap_LastView['LastView'])) {
            $OwnerLastView = '<i class="fa fa-calendar" title="RM Last View" style="color: #5bc0de;"></i> '.date('j M y H:i', strtotime($ap_LastView['LastView']));
          }
          
          $SektorUsaha = ($ap_row['SektorUsaha']) ? $ap_row['SektorUsaha'] : "Kelapa Sawit";
          $Clasified = ($ap_row['Clasified']) ? $ap_row['Clasified'] : "Platinum";
          $params['results'][$ap_id] = array(
            'CustomerName'      => $ap_row['CustomerName'],
            'Logo'              => $ap_logo['Logo'],
            'LastView'          => $OwnerLastView,
            'Vcif'              => $ap_row['Vcif'],
            'SektorUsaha'      => $SektorUsaha,
            'RMName'           => $ap_row['RMName'],
            'Member'               => json_decode($ap_row['Member'], TRUE),
            'CheckerList'           => implode("; ", $CheckerList),
            'SignerList'           => implode("; ", $SignerList),
            'GroupName'        => $ap_row['GroupName'],
            'Clasified'        => $Clasified,
            'DocumentStatusId'        => $ap_row['DocumentStatusId'],
            'Status'   => $ap_row['Status'],
            'AccountPlanningAddon'        => $AccountPlanningAddon,
            'AccountPlanningPublish'        => $AccountPlanningPublish,
            'dateDiff'        => $dateDiff,
            'current_date'   => $this->current_date,
            'Year'          => $ap_row['Year'],
            'ProgressTotal' => number_format($ProgressTotal, 1)
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'monitoring/AccountPlanning/search_box?uker_search_box='.$uker_search.'&tahun_search_box='.$tahun_search.'&status_search_box='.$status_search.'&keyword_search_box='.urldecode($keyword_search);
      $config['page_query_string'] = TRUE;
      $config['query_string_segment'] = 'rowno';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limit_per_page;
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
    $this->load->view('monitoring/AccountPlanning.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function dateDiff($date1, $date2) {
      $date1_ts = strtotime($date1);
      $date2_ts = strtotime($date2);
      
      $diff = $date2_ts - $date1_ts;

      return round($diff / 86400);
  }
}

?>
