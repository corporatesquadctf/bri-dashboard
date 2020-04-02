<?php 

class RelationshipManager extends MY_Controller {

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
      $this->load->model('MonitoringRm_model');
      $this->load->model('PerformanceAccountPlanning_model');
  }

  public function index($rowno=0) {
    $this->checkModule();

    $data = array(
          'rmusers' => array()
    );

    $txtcari = "";
    $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "2019";
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $total_records = $this->MonitoringRm_model->getTotalViewRelationshipManager($txtcari);

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $params = array();
    $params['txtcari'] = $txtcari;
    if ($total_records > 0) {   
      $rmusers = $this->MonitoringRm_model->getViewRelationshipManager($limit_per_page, $rowno, $txtcari);

      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['MonitoringRmId'];
        if (!key_exists($rm_id, $data['rmusers'])) {
          if ($rmuser['AccountPlanningProgress'] == 0.00) {
            $AccountPlanningProgress = '0';
          }
          else {
            $AccountPlanningProgress = $rmuser['AccountPlanningProgress'];
          }

          $AccountPlanningList = json_decode($rmuser['AccountPlanningList'], TRUE);
          foreach ($AccountPlanningList as $key => $value) {
            $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($value['ap_id']);
            $AccountPlanningList[$key]['doc_status'] = $account_planning_status['DocumentStatusId'];
          }

          $LastActivity = $rmuser['LastActivity'];
          if ($rmuser['LastActivity'] == '1900-01-01 00:00:00.000') {
            $LastActivity = '';
          }

          $params['results'][$rm_id] = array(
            'RmName' => $rmuser['RmName'],
            'PersonalNumber' => $rmuser['PersonalNumber'],
            'Division' => $rmuser['Division'],
            'LastActivity' => $LastActivity,
            'Year' => $rmuser['Year'],
            'AccountPlanningTotal' => $rmuser['AccountPlanningTotal'],
            'AccountPlanningList' => $AccountPlanningList,
            'AccountPlanningPublish' => $rmuser['AccountPlanningPublish'],
            'AccountPlanningWa' => $rmuser['AccountPlanningWa'],
            'AccountPlanningDraft' => $rmuser['AccountPlanningDraft'],
            'AccountPlanningReject' => $rmuser['AccountPlanningReject'],
            'AccountPlanningProgress' => number_format($AccountPlanningProgress, 1)
          );
        }
      }
      // echo "<pre>";
      // print_r($params['results']);

      $params['txtcari'] = $txtcari;
      $params['row'] = $rowno;

      if ($txtcari != '') {
        $config['base_url'] = base_url() . 'monitoring/RelationshipManager/search_result/'.$params['txtcari'];
      } else {
        $config['base_url'] = base_url() . 'monitoring/RelationshipManager/page';
      }
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
    $this->load->view('monitoring/RelationshipManager.php', $params);
    $this->load->view('layout/footer.php');

  }
  
  public function page($rowno=0) {
    $this->checkModule();

    $data = array(
          'rmusers' => array()
    );

    $txtcari = "";
    $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $total_records = $this->MonitoringRm_model->getTotalViewRelationshipManager();

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $params = array();
    $params['txtcari'] = $txtcari;
    if ($total_records > 0) {   
      $rmusers = $this->MonitoringRm_model->getViewRelationshipManager($limit_per_page, $rowno, $txtcari);

      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['MonitoringRmId'];
        if (!key_exists($rm_id, $data['rmusers'])) {
          if ($rmuser['AccountPlanningProgress'] == 0.00) {
            $AccountPlanningProgress = '0';
          }
          else {
            $AccountPlanningProgress = $rmuser['AccountPlanningProgress'];
          }

          $AccountPlanningList = json_decode($rmuser['AccountPlanningList'], TRUE);
          foreach ($AccountPlanningList as $key => $value) {
            $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($value['ap_id']);
            $AccountPlanningList[$key]['doc_status'] = $account_planning_status['DocumentStatusId'];
          }

          $LastActivity = $rmuser['LastActivity'];
          if ($rmuser['LastActivity'] == '1900-01-01 00:00:00.000') {
            $LastActivity = '';
          }

          $params['results'][$rm_id] = array(
            'RmName' => $rmuser['RmName'],
            'PersonalNumber' => $rmuser['PersonalNumber'],
            'Division' => $rmuser['Division'],
            'LastActivity' => $LastActivity,
            'Year' => $rmuser['Year'],
            'AccountPlanningTotal' => $rmuser['AccountPlanningTotal'],
            'AccountPlanningList' => $AccountPlanningList,
            'AccountPlanningPublish' => $rmuser['AccountPlanningPublish'],
            'AccountPlanningWa' => $rmuser['AccountPlanningWa'],
            'AccountPlanningDraft' => $rmuser['AccountPlanningDraft'],
            'AccountPlanningReject' => $rmuser['AccountPlanningReject'],
            'AccountPlanningProgress' => number_format($AccountPlanningProgress, 1)
          );
        }
      }

      $params['txtcari'] = $txtcari;
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'monitoring/RelationshipManager/page';
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
    $this->load->view('monitoring/RelationshipManager.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function search_result($txtcari = '', $rowno=0) {
   $this->checkModule();

    $data = array(
          'rmusers' => array()
    );

    if (empty($txtcari)) {
      $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
      if (empty($this->input->post('txtcari'))) {
        redirect('monitoring/RelationshipManager');
      }
    }
    else {
      $txtcari = str_replace('_', ' ', $txtcari);
    }
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    $total_records = $this->MonitoringRm_model->getTotalViewRelationshipManager(trim($txtcari));
    $rmusers = $this->MonitoringRm_model->getViewRelationshipManager($limit_per_page, $rowno, trim($txtcari));

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }

    $params = array();
    $params['txtcari'] = trim(str_replace(' ', '_', $txtcari));
    if ($total_records > 0) {   
      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['MonitoringRmId'];
        if (!key_exists($rm_id, $data['rmusers'])) {
          if ($rmuser['AccountPlanningProgress'] == 0.00) {
            $AccountPlanningProgress = '0';
          }
          else {
            $AccountPlanningProgress = $rmuser['AccountPlanningProgress'];
          }

          $AccountPlanningList = json_decode($rmuser['AccountPlanningList'], TRUE);
          foreach ($AccountPlanningList as $key => $value) {
            $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatus($value['ap_id']);
            $AccountPlanningList[$key]['doc_status'] = $account_planning_status['DocumentStatusId'];
          }

          $LastActivity = $rmuser['LastActivity'];
          if ($rmuser['LastActivity'] == '1900-01-01 00:00:00.000') {
            $LastActivity = '';
          }

          $params['results'][$rm_id] = array(
            'RmName' => $rmuser['RmName'],
            'PersonalNumber' => $rmuser['PersonalNumber'],
            'Division' => $rmuser['Division'],
            'LastActivity' => $LastActivity,
            'Year' => $rmuser['Year'],
            'AccountPlanningTotal' => $rmuser['AccountPlanningTotal'],
            'AccountPlanningList' => $AccountPlanningList,
            'AccountPlanningPublish' => $rmuser['AccountPlanningPublish'],
            'AccountPlanningWa' => $rmuser['AccountPlanningWa'],
            'AccountPlanningDraft' => $rmuser['AccountPlanningDraft'],
            'AccountPlanningReject' => $rmuser['AccountPlanningReject'],
            'AccountPlanningProgress' => number_format($AccountPlanningProgress, 1)
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'monitoring/RelationshipManager/search_result/'.$params['txtcari'];
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
    $this->load->view('monitoring/RelationshipManager.php', $params);
    $this->load->view('layout/footer.php');
  }
}

?>
