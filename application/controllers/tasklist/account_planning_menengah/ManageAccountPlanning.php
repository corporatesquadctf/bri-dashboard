<?php 

class ManageAccountPlanning extends MY_Controller {

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
    $currentYear = $this->current_year;
    $limitPage = 2;

    /* Set Header Information */
    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
    $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
    $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $params["docStatusOption"] = $doc_statuses;
    $params["status_search_box"] = -1;
    
    $search_year = array( ["id" => 0, "name" => "All years"], 
                          ["id" => date("Y")-2, "name" => date("Y")-2],
                          ["id" => date("Y")-1, "name" => date("Y")-1],
                          ["id" => date("Y"), "name" => date("Y")]
                        );
    $params['yearOption'] = $search_year;
    $params['year_search_box'] = $this->current_year;
    
    $params['keyword_search_box'] = '';
    $params["hideFilter"] = 1;

    $total_records = $this->ManageAccountPlanning_model->getTotalAccountPlanning($userId, $currentYear);
    if ($total_records > 0) {   
      $ap_Tasklist = $this->ManageAccountPlanning_model->getAccountPlanning($userId, $limitPage, $rowNo, $currentYear);
      
      $i = 0;
      foreach ($ap_Tasklist as $ap_row) {
        $CIF = $ap_row['CIF'];
        $AccountPlanningMenengahId = $ap_row['AccountPlanningMenengahId'];
        
        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($AccountPlanningMenengahId);
        $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
        $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
        $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3){
          $ap_status_color = '#43a047';
        }

        $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
        $ap_Tasklist[$i]["ap_status_color"] = $ap_status_color;
        $ap_Tasklist[$i]["DocumentStatusId"] = $account_planning_status['DocumentStatusId'];
        $ap_Tasklist[$i]["Status"] = $account_planning_status['Status'];

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

      $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/manage_account_planning/page';
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
    $this->load->view('tasklist/account_planning_menengah/manage_account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }
  public function page($rowNo=1) {
    $this->checkModule();
    $params = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $currentYear = $this->current_year;
    $limitPage = 2;
    $rowNo = ($rowNo-1) * $limitPage;

    /* Set Header Information */
    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
    $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
    $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $params["docStatusOption"] = $doc_statuses;
    $params["status_search_box"] = -1;
    
    $search_year = array( ["id" => 0, "name" => "All years"], 
                          ["id" => date("Y")-2, "name" => date("Y")-2],
                          ["id" => date("Y")-1, "name" => date("Y")-1],
                          ["id" => date("Y"), "name" => date("Y")]
                        );
    $params['yearOption'] = $search_year;
    $params['year_search_box'] = $this->current_year;
    
    $params['keyword_search_box'] = '';
    $params["hideFilter"] = 1;

    $total_records = $this->ManageAccountPlanning_model->getTotalAccountPlanning($userId, $currentYear);
    if ($total_records > 0) {   
      $ap_Tasklist = $this->ManageAccountPlanning_model->getAccountPlanning($userId, $limitPage, $rowNo, $currentYear);
      
      $i = 0;
      foreach ($ap_Tasklist as $ap_row) {
        $CIF = $ap_row['CIF'];
        $AccountPlanningMenengahId = $ap_row['AccountPlanningMenengahId'];
        
        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($AccountPlanningMenengahId);
        $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
        $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
        $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3){
          $ap_status_color = '#43a047';
        }

        $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
        $ap_Tasklist[$i]["ap_status_color"] = $ap_status_color;
        $ap_Tasklist[$i]["DocumentStatusId"] = $account_planning_status['DocumentStatusId'];
        $ap_Tasklist[$i]["Status"] = $account_planning_status['Status'];

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

      $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/manage_account_planning/page';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limitPage;
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
    $params['search_box'] = ' style="display: none;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/manage_account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }
  public function search($fYear='', $fDocStatus='', $fSearchTxt='', $rowNo=0) {
    $this->checkModule();
    $params = array();

    if (empty($fYear) && $fYear<>'0') {
      $fYear = ($this->input->post('tahun_search_box')) ? $this->input->post('tahun_search_box') : "";
      $params['year_search_box'] = $fYear;
    }
    else {
      $fYear = str_replace('_', ' ', $fYear);
      $params['year_search_box'] = $this->current_year;
    }
    
    if (empty($fDocStatus) && $fDocStatus<>'0') {
      $fDocStatus = ($this->input->post('status_search_box'));
      if($fDocStatus == "all")
        $params['status_search_box'] = -1;
      else $params['status_search_box'] = $fDocStatus;
    }
    else {
      $fDocStatus = str_replace('_', ' ', $fDocStatus);
      $params["status_search_box"] = -1;
    }

    if (empty($fSearchTxt)) {
      $fSearchTxt = ($this->input->post('keyword_search_box')) ? $this->input->post('keyword_search_box') : "";
      $params['keyword_search_box'] = $fSearchTxt;
    }
    else {
      $fSearchTxt = trim(str_replace('_', ' ', $fSearchTxt));
      $params['keyword_search_box'] = '';
    }
    
    $params["hideFilter"] = 0;
    
    if(empty($fSearchTxt))
          $searchUrl = '_';
      else 
          $searchUrl = $fSearchTxt;

    $userId = $this->session->PERSONAL_NUMBER;
    $limitPage = 2;
    if($rowNo != 0){
      $rowNo = ($rowNo-1) * $limitPage;
    }

    /* Set Header Information */
    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
    $params["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
    $params["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

    $doc_statuses = $this->MonitoringAccountPlanning_model->get_doc_status();
    $params["docStatusOption"] = $doc_statuses;
    
    $search_year = array( ["id" => 0, "name" => "All years"], 
                          ["id" => date("Y")-2, "name" => date("Y")-2],
                          ["id" => date("Y")-1, "name" => date("Y")-1],
                          ["id" => date("Y"), "name" => date("Y")]
                        );
    $params['yearOption'] = $search_year;
    
    

    $params["hideFilter"] = 0;

    $total_records = $this->ManageAccountPlanning_model->getTotalAccountPlanning($userId, $fYear, $fDocStatus, $fSearchTxt);
    if ($total_records > 0) {   
      $ap_Tasklist = $this->ManageAccountPlanning_model->getAccountPlanning($userId, $limitPage, $rowNo, $fYear, $fDocStatus, $fSearchTxt);
      
      $i = 0;
      foreach ($ap_Tasklist as $ap_row) {
        $CIF = $ap_row['CIF'];
        $AccountPlanningMenengahId = $ap_row['AccountPlanningMenengahId'];
        
        $account_planning_status = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($AccountPlanningMenengahId);
        $pinjamanAp = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($CIF);
        $simpananAp = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($CIF);
        $rsCommentAp = $this->ConfirmationAccountPlanningMenengah_model->getCommentAccountPlanning($AccountPlanningMenengahId);

        $ap_year_color = '#218FD8';
        $ap_status_color = '#218FD8';
        if ($ap_row['Year'] != $this->current_year) {
          $ap_year_color = '#F58C38';
        }

        if($account_planning_status['DocumentStatusId'] == 4){
          $ap_status_color = '#f44336';
        } else if ($account_planning_status['DocumentStatusId'] == 3){
          $ap_status_color = '#43a047';
        }

        $ap_Tasklist[$i]["ap_year_color"] = $ap_year_color;
        $ap_Tasklist[$i]["ap_status_color"] = $ap_status_color;
        $ap_Tasklist[$i]["DocumentStatusId"] = $account_planning_status['DocumentStatusId'];
        $ap_Tasklist[$i]["Status"] = $account_planning_status['Status'];

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

      $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/manage_account_planning/search/'.$fYear.'/'.$fDocStatus.'/'.$searchUrl;;
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limitPage;
      $config["uri_segment"] = 8;
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
    $this->load->view('tasklist/account_planning_menengah/manage_account_planning_list.php', $params);
    $this->load->view('layout/footer.php');
  }
  public function input($accountPlanningMenengahId){
    $this->checkModule();    
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $unitKerjaId = $this->session->DIVISION;

    $data["APMenengahId"] = $accountPlanningMenengahId;
    
    $rsDocumentStatus = $this->PerformanceAccountPlanning_model->getDocumentStatusMenengah($accountPlanningMenengahId);
    
    /* Get Account Planning Menengah Information */
    $rsAPMenengahHeaderInformation = $this->ManageAccountPlanning_model->getAccountPlanningInformation($userId, $accountPlanningMenengahId);
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
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/base_input.php', $data);
    $this->load->view('layout/footer.php');
  }

  /* Input Tab Company Information */
  public function input_debitur_overview($apMenengahId, $CIF){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["CIF"] = $CIF;

    $CustomerName = $this->ManageAccountPlanning_model->getCustomerInformation($CIF);
    $data['CustomerName'] = $CustomerName;

    $rsCity = $this->ManageAccountPlanning_model->getCityOption();
    $data["CityOption"] = $rsCity;

    $rsIndustryTrend = $this->ManageAccountPlanning_model->getIndustryTrendOption();
    $data["IndustryTrendOption"] = $rsIndustryTrend;

    $rsLifeCycle = $this->ManageAccountPlanning_model->getLifeCycleOption();
    $data["LifeCycleOption"] = $rsLifeCycle;

    $rsDebiturOverview = $this->ManageAccountPlanning_model->getAccountPlanningDebiturOverview($apMenengahId, $CIF);
    if(!empty($rsDebiturOverview)){
      $data["DebiturOverview"] = $rsDebiturOverview[0];
      $data["Type"] = "update";
    }else {
      $data["DebiturOverview"] = $rsDebiturOverview;
      $data["Type"] = "insert";
    }

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/debitur_overview.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_debitur_overview(){
    $this->checkModule();

    $userId = $this->session->PERSONAL_NUMBER;
    $apMenengahId = $this->input->post("apMenengahId");
    $CIF = $this->input->post("CIF");
    $type = $this->input->post("type");

    $data = array(
      'type' => $type,
      'accountPlanningMenengahId' => $apMenengahId,
      'CIF' => $CIF,
      'address' => $this->input->post('address'),
      'provinceId' => $this->input->post('city'),
      'industryName' => $this->input->post('industry'),
      'industryTrendId' => $this->input->post('industry_trend'),
      'lifeCycleId' => $this->input->post('life_cycle'),
      'userId' => $userId
    );

    $result = $this->ManageAccountPlanning_model->updateDebiturOverview($data);
    echo json_encode($result);
  }
  public function input_key_shareholders($apMenengahId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;

    $rsShareholder = $this->ManageAccountPlanning_model->getAccountPlanningShareholder($apMenengahId);
    if(!empty($rsShareholder)){
      $rate = $rsShareholder[0]["Rate"];
      for($i=0; $i<count($rsShareholder); $i++){
        $rsShareholder[$i]["Value"] =  number_format($rsShareholder[$i]["Value"], 2);
      }
    }else $rate = 1;
    $data['Shareholder'] = $rsShareholder;
    $data["Rate"] = $rate;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/key_shareholders.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_key_shareholders(){
    $this->checkModule();

    $userId = $this->session->PERSONAL_NUMBER;
    $apMenengahId = $this->input->post("apMenengahId");
    
    $dataShareholders = explode(",",$this->input->post("arrShareholders"));
    $arrShareholders = array();    
    foreach($dataShareholders as $row){
      $shareholders = array(
          "name" => $this->input->post("name_".$row),
          "rate" => str_replace(",","",$this->input->post("rate")),
          "quantity" => str_replace(",","",$this->input->post("value_".$row)),
          "nominal" => str_replace(",","",$this->input->post("nominal_".$row)),
      );
      array_push($arrShareholders, $shareholders);
    }

    $data = array(
      "accountPlanningMenengahId" => $apMenengahId,
      "jumlahShareholders" => count($arrShareholders),
      "arrShareholders" => $arrShareholders,
      "userId" => $userId
    );

    $result = $this->ManageAccountPlanning_model->updateKeyShareholders($data);
    echo json_encode($result);
  }
  public function input_business_organization($apMenengahId, $CIF){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["CIF"] = $CIF;

    $CustomerName = $this->ManageAccountPlanning_model->getCustomerInformation($CIF);
    $data['CustomerName'] = $CustomerName;

    $rsBusinessProcess = $this->ManageAccountPlanning_model->getAccountPlanningFileStructure($apMenengahId, $CIF, 1);
    $data["businessProcess"] = $rsBusinessProcess;

    $rsCompanyStructure = $this->ManageAccountPlanning_model->getAccountPlanningFileStructure($apMenengahId, $CIF, 3);
    $data["companyStructure"] = $rsCompanyStructure;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/business_process_organitation.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_business_organization(){
    $this->checkModule();
		$userId = $this->session->PERSONAL_NUMBER;
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $apMenengahId = $this->input->post("apMenengahId");
    $structureTypeId = $this->input->post('structureTypeId');
    
    $base_path = './uploads/account_planning_menengah';
		
    switch($structureTypeId){
      case 1: 
        $CIF = $this->input->post('cif');
        $fname = 'Business_Process_'.$CIF.'.'.$ext;
        if( is_dir($base_path.'/'.$apMenengahId.'/'.$CIF.'/') === false )
        {
          mkdir($base_path.'/'.$apMenengahId.'/'.$CIF.'/', 0755, true);
        }
        $full_path = $base_path.'/'.$apMenengahId.'/'.$CIF.'/';
        break;
      case 3: 
        $CIF = $this->input->post('cif');
        $fname = 'Company_Structure_'.$CIF.'.'.$ext;
        if( is_dir($base_path.'/'.$apMenengahId.'/'.$CIF.'/') === false )
        {
          mkdir($base_path.'/'.$apMenengahId.'/'.$CIF.'/', 0755, true);
        }
        $full_path = $base_path.'/'.$apMenengahId.'/'.$CIF.'/';
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
            'structureTypeId' => $structureTypeId,
            'accountPlanningMenengahId' => $apMenengahId,
            'CIF' => $CIF,
            'filePath' => $fname,
            'size' => $_FILES['file']['size'], // as Bytes
            'type' => $_FILES['file']['type'],
            'userId' => $userId
          );
          $rs = $this->ManageAccountPlanning_model->updateBusinessProcessOrganization($data);
          $status = $rs["status"];
          $msg = $rs["message"];
        }
      }
    }else {
      $status = "error";
      $msg = 'Please choose a file';
    }
		echo json_encode(array('status' => $status, 'message' => $msg));
  }
  public function input_strategic_plan($apMenengahId, $CIF){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["CIF"] = $CIF;

    $CustomerName = $this->ManageAccountPlanning_model->getCustomerInformation($CIF);
    $data['CustomerName'] = $CustomerName;

    $rsStrategicPlanType = $this->ManageAccountPlanning_model->getStrategicPlanTypeOption();
    $data['StrategicPlanTypeOption'] = $rsStrategicPlanType;
    
    $rsStrategicPlan = $this->ManageAccountPlanning_model->getAccountPlanningStrategicPlan($apMenengahId, $CIF);
    $data['StrategicPlan'] = $rsStrategicPlan;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/strategic_plan', $data); 
    $this->load->view('layout/footer.php');
  }
  public function process_input_strategic_plan(){
    $this->checkModule();
    $userId = $this->session->PERSONAL_NUMBER;
    $apMenengahId = $this->input->post('apMenengahId');
    $cif = $this->input->post('cif');
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
      'accountPlanningMenengahId' => $apMenengahId,
      'cif' => $cif,
      'jumlahStrategicPlan' => count($arrStrategicPlan),
      'arrStrategicPlan' => $arrStrategicPlan,
      'createdBy' => $userId
    );
    $result = $this->ManageAccountPlanning_model->updateStrategicPlan($data);
    echo json_encode($result);
  }
  public function input_coverage_mapping($apMenengahId, $CIF){
    $this->checkModule();
    $data = array();

    $data['apMenengahId'] = $apMenengahId;
    $data['CIF'] = $CIF;

    $CustomerName = $this->ManageAccountPlanning_model->getCustomerInformation($CIF);
    $data['CustomerName'] = $CustomerName;

    $rsCoverageMapping = $this->ManageAccountPlanning_model->getAccountPlanningCoverageMapping($apMenengahId, $CIF);
    $data['CoverageMapping'] = $rsCoverageMapping;
    //echo json_encode($rsCoverageMapping); die;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/coverage_mapping', $data); 
    $this->load->view('layout/footer.php');
  }
  public function process_input_coverage_mapping(){
    $this->checkModule();
    $userId = $this->session->PERSONAL_NUMBER;
    $apMenengahId = $this->input->post('apMenengahId');
    $cif = $this->input->post('cif');
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
      'accountPlanningMenengahId' => $apMenengahId,
      'cif' => $cif,
      'jumlahCoverageMapping' => $jumlahCoverageMapping,
      'arrCoverageMapping' => $arrCoverageMapping,
      'createdBy' => $userId
    );
    $result = $this->ManageAccountPlanning_model->updateCoverageMapping($data);
    echo json_encode($result);
  }

  /* Input Tab BRI Starting Position */
  public function input_financial_highlight($apMenengahId, $financialHighlightGroupId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "bri_starting_position";
    $data["FinancialHighlightGroupType"] = "financial_highlights";
    $rsFinancialHighlightGroup = $this->ManageAccountPlanning_model->getFinancialHighlightGroup($financialHighlightGroupId);
    $data["FinancialHighlightGroupId"] = $financialHighlightGroupId;
    $data["FinancialHighlightGroupName"] = $rsFinancialHighlightGroup[0]->Name;
    $data["Years"] = array(date('Y') - 3, date('Y') - 2, date('Y') - 1);
    $rsFinancialHighlightItem = $this->ManageAccountPlanning_model->getFinancialHighlightItem($financialHighlightGroupId);
    $data["FinancialHighlightItem"] = $rsFinancialHighlightItem;
    
    $arrFinancialHighlight = array();
    $isNewData = 1;
    foreach($rsFinancialHighlightItem as $row){
      $financialHighlightItemMenengahId = $row->FinancialHighlightItemMenengahId;
      foreach($data["Years"] as $year){
        $rsFinancialHighlight = $this->ManageAccountPlanning_model->getFinancialHighlight($apMenengahId, $financialHighlightItemMenengahId, $year);
        if(!empty($rsFinancialHighlight)){
          $isNewData = 0;
          $arrFinancialHighlight[$financialHighlightItemMenengahId][$year] = $rsFinancialHighlight[0]->Amount;
        }else $arrFinancialHighlight[$financialHighlightItemMenengahId][$year] = 0;        
      }
    }
    $data["arrFinancialHighlight"] = $arrFinancialHighlight;
    if($isNewData == 1){
      $data["type"] = "insert";
    }else{
      $data["type"] = "update";
    }
    
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/financial_highlights.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_financial_highlight(){
    $this->checkModule();
    $data = array();
    $arrYears = array(date('Y') - 3, date('Y') - 2, date('Y') - 1);
    
    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = $this->input->post("mainTab");
    $secondTab = $this->input->post("secondTab");
    $apMenengahId = $this->input->post("apMenengahId");
    $financialHighlightGroupId = $this->input->post("financialHighlightGroupId");

    $arrFinancialHighlight = array();
    $arrBalanceSheet = array();
    $arrIncomeStatement = array();

    $rsFinancialHighlightItem = $this->ManageAccountPlanning_model->getFinancialHighlightItem($financialHighlightGroupId);
    foreach($rsFinancialHighlightItem as $row){
      $financialHighlightItemMenengahId = $row->FinancialHighlightItemMenengahId;
      $accountPlanningMenengahId = $apMenengahId;
      foreach($arrYears as $year){
        $amount = str_replace(",","",$this->input->post("amount_".$financialHighlightItemMenengahId."_".$year));
        if($amount == "") $amount = 0;

        /* Build Data Source For Calculate Current Ratio */
        if($financialHighlightGroupId == 1){
          if($financialHighlightItemMenengahId == 6) 
            $arrBalanceSheet[$financialHighlightItemMenengahId][$year] = $amount;
          if($financialHighlightItemMenengahId == 26) 
            $arrBalanceSheet[$financialHighlightItemMenengahId][$year] = $amount;
          if($financialHighlightItemMenengahId == 27) 
            $arrBalanceSheet[$financialHighlightItemMenengahId][$year] = $amount;
        }

        /* Build Data Source For Calculate Profitablility */
        if($financialHighlightGroupId == 2){
          if($financialHighlightItemMenengahId == 7) 
            $arrIncomeStatement[$financialHighlightItemMenengahId][$year] = $amount;
          if($financialHighlightItemMenengahId == 9) 
            $arrIncomeStatement[$financialHighlightItemMenengahId][$year] = $amount;
          if($financialHighlightItemMenengahId == 11) 
            $arrIncomeStatement[$financialHighlightItemMenengahId][$year] = $amount;
          
          $rsTotalAsset = $this->ManageAccountPlanning_model->getFinancialHighlight($apMenengahId, 6, $year);
          if(!empty($rsTotalAsset)){
            $arrIncomeStatement[6][$year] = $rsTotalAsset[0]->Amount;
          }else $arrIncomeStatement[6][$year] = 0;
        }

        $financialHighlight = array(
          "financialHighlightItemMenengahId" => $financialHighlightItemMenengahId,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $amount
        );
        array_push($arrFinancialHighlight, $financialHighlight);
      }
    }
    
    if($financialHighlightGroupId == 1){
      foreach($arrYears as $year){
        $totalAsset = $arrBalanceSheet[6][$year];
        $shortTermLiabilities = $arrBalanceSheet[26][$year];
        $longTermLiabilities = $arrBalanceSheet[27][$year];

        if($shortTermLiabilities + $longTermLiabilities != 0) {
          $amountCurrentRatio = number_format(($totalAsset / ($shortTermLiabilities + $longTermLiabilities)) * 100, 2);
        }else $amountCurrentRatio = 0;
        //echo ($totalAsset / ($shortTermLiabilities + $longTermLiabilities)) *100; die;
        $amountCurrentRatio = str_replace(",","",$amountCurrentRatio);
        if($amountCurrentRatio == "") $amountCurrentRatio = 0;
        $currentRatio = array(
          "financialHighlightItemMenengahId" => 12,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $amountCurrentRatio
        );
        array_push($arrFinancialHighlight, $currentRatio);

        if($totalAsset != 0){
          $ammountDebtToTotalAssetRatio = number_format((($shortTermLiabilities + $longTermLiabilities) / $totalAsset) * 100 ,  2);
        }else $$ammountDebtToTotalAssetRatio = 0;
        $ammountDebtToTotalAssetRatio = str_replace(",","",$ammountDebtToTotalAssetRatio);
        if($ammountDebtToTotalAssetRatio == "") $ammountDebtToTotalAssetRatio = 0;
        $debtToTotalRatio = array(
          "financialHighlightItemMenengahId" => 22,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $ammountDebtToTotalAssetRatio
        );
        array_push($arrFinancialHighlight, $debtToTotalRatio);
      }
    }else if($financialHighlightGroupId == 2){
      foreach($arrYears as $year){
        $totalAsset = $arrIncomeStatement[6][$year];
        $sales = $arrIncomeStatement[7][$year];
        $biayaSGA = $arrIncomeStatement[9][$year];
        $netProfit = $arrIncomeStatement[11][$year];
        
        /* Calculate Operating Margin */
        if($sales != 0){
          $amountOperatingMargin = number_format(($biayaSGA / $sales) * 100, 2);
        }else $amountOperatingMargin = 0;
        $amountOperatingMargin = str_replace(",","",$amountOperatingMargin);
        if($amountOperatingMargin == "") $amountOperatingMargin = 0;
        $operatingMargin = array(
          "financialHighlightItemMenengahId" => 18,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $amountOperatingMargin
        );
        array_push($arrFinancialHighlight, $operatingMargin);

        /* Calculate Net Profit Margin */
        if($sales != 0){
          $amountNetProfitMargin = number_format(($netProfit / $sales) * 100, 2);
        }else $amountNetProfitMargin = 0;
        $amountNetProfitMargin = str_replace(",","",$amountNetProfitMargin);
        if($amountNetProfitMargin == "") $amountNetProfitMargin = 0;
        $operatingMargin = array(
          "financialHighlightItemMenengahId" => 19,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $amountNetProfitMargin
        );
        array_push($arrFinancialHighlight, $operatingMargin);

        /* Calculate Return Of Assets */
        if($totalAsset != 0){
          $amountReturnOfAssets = number_format(($netProfit / $totalAsset) * 100, 2);
        }else $amountReturnOfAssets = 0;
        $amountReturnOfAssets = str_replace(",","",$amountReturnOfAssets);
        if($amountReturnOfAssets == "") $amountReturnOfAssets = 0;
        $returnOfAssets = array(
          "financialHighlightItemMenengahId" => 20,
          "accountPlanningMenengahId" => $accountPlanningMenengahId,
          "year" => $year,
          "amount" => $amountReturnOfAssets
        );
        array_push($arrFinancialHighlight, $returnOfAssets);
      }
    }

    $data = array(
      "userId" => $userId,
      "accountPlanningMenengahId" => $accountPlanningMenengahId,
      "arrFinancialHighlight" => $arrFinancialHighlight
    );

    $result = $this->ManageAccountPlanning_model->updateFinancialHighlight($data);
    echo json_encode($result);
  }
  public function input_facilities_banking($apMenengahId, $facilitiesBankingGroupId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "bri_starting_position";

    $data["FacilitiesBankingGroupId"] = $facilitiesBankingGroupId;
    $data["FacilitiesBankingGroupType"] = "facilities_banking";

    $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup($facilitiesBankingGroupId);
    $data["FacilitiesBankingGroupName"] = $rsFacilitiesBankingGroup[0]->Name;

    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
      $rsFacilitiesBanking = $this->ManageAccountPlanning_model->getFacilitiesBanking($apMenengahId, $bankFacilityItemId);
      if(!empty($rsFacilitiesBanking)){
        $rowItem->IDRAmount = $rsFacilitiesBanking[0]->IDRAmount;
        $rowItem->IDRRate = $rsFacilitiesBanking[0]->IDRRate;
        $rowItem->ValasAmount = $rsFacilitiesBanking[0]->ValasAmount;
        $rowItem->ValasRate = $rsFacilitiesBanking[0]->ValasRate;
      }else{
        $rowItem->IDRAmount = 0;
        $rowItem->IDRRate = 0;
        $rowItem->ValasAmount = 0;
        $rowItem->ValasRate = 0;
      }
    }
    $data["FacilitiesBankingItem"] = $rsFacilitiesBankingItem;

    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $rsFacilitiesBankingAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsFacilitiesBankingAddition)){
        $rowItemAddition->IDRAmount = $rsFacilitiesBankingAddition[0]->IDRAmount;
        $rowItemAddition->IDRRate = $rsFacilitiesBankingAddition[0]->IDRRate;
        $rowItemAddition->ValasAmount = $rsFacilitiesBankingAddition[0]->ValasAmount;
        $rowItemAddition->ValasRate = $rsFacilitiesBankingAddition[0]->ValasRate;
      }else{
        $rowItemAddition->IDRAmount = 0;
        $rowItemAddition->IDRRate = 0;
        $rowItemAddition->ValasAmount = 0;
        $rowItemAddition->ValasRate = 0;
      }
    }
    $data["FacilitiesBankingItemAddition"] = $rsFacilitiesBankingItemAddition;

    //echo json_encode($data); die;
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/facilities_banking.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_facilities_banking(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = $this->input->post("mainTab");
    $secondTab = $this->input->post("secondTab");
    $apMenengahId = $this->input->post("apMenengahId");
    $facilitiesBankingGroupId = $this->input->post("facilitiesBankingGroupId");

    $data["AccountPlanningMenengahId"] = $apMenengahId;
    $data["BankFacilityGroupMenengahId"] = $facilitiesBankingGroupId;

    $arrFacilitiesBankingItem = array();
    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $index = $rowItem->BankFacilityItemMenengahId;

      $rsFacilitiesBanking = $this->ManageAccountPlanning_model->getFacilitiesBanking($apMenengahId, $index);
      if(!empty($rsFacilitiesBanking)){
        $oldIDRAmount = $rsFacilitiesBanking[0]->IDRAmount;
        $oldValasAmount = $rsFacilitiesBanking[0]->ValasAmount;
      }else{
        $oldIDRAmount = 0;
        $oldValasAmount = 0;
      }
      $oldBRINominal = $oldIDRAmount + $oldValasAmount;
      
      $rsWalletShare = $this->ManageAccountPlanning_model->getWalletShare($apMenengahId, $index);
      $IDRAmount = str_replace(",","",$this->input->post("nom_idr_".$index));
      $ValasAmount = str_replace(",","",$this->input->post("nom_valas_".$index));
      $totalAmount = $IDRAmount + $ValasAmount;
      if($totalAmount > $oldBRINominal && $oldBRINominal != 0){
        $selisih = $totalAmount - $oldBRINominal;
        $totalAmount = $rsWalletShare[0]->TotalAmount + $selisih;
      }else if($totalAmount < $oldBRINominal && $oldBRINominal != 0){
        $selisih = $oldBRINominal - $totalAmount;
        $totalAmount = $rsWalletShare[0]->TotalAmount - $selisih;
      }
      $otherNominal = $totalAmount - ($IDRAmount + $ValasAmount);

      $facilitiesBanking = array(
        "BankFacilityItemMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "IDRAmount" => str_replace(",","",$this->input->post("nom_idr_".$index)),
        "IDRRate" => str_replace(",","",$this->input->post("rate_idr_".$index)),
        "ValasAmount" => str_replace(",","",$this->input->post("nom_valas_".$index)),
        "ValasRate" => str_replace(",","",$this->input->post("rate_valas_".$index)),
        "TotalAmount" => $totalAmount,
        "OtherNominal" => $otherNominal,
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItem, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItem"] = $arrFacilitiesBankingItem;

    $arrUpdateFacilitiesBankingItemAddition = array();
    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $index = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      if($this->input->post("adt_nom_idr_".$index) != NULL){

        $rsFacilitiesBankingAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingAddition($apMenengahId, $index);
        if(!empty($rsFacilitiesBankingAddition)){
          $oldIDRAmount = $rsFacilitiesBankingAddition[0]->IDRAmount;
          $oldValasAmount = $rsFacilitiesBankingAddition[0]->ValasAmount;
        }else{
          $oldIDRAmount = 0;
          $oldValasAmount = 0;
        }
        $oldBRINominal = $oldIDRAmount + $oldValasAmount;

        $rsWalletShareAddition = $this->ManageAccountPlanning_model->getWalletShareAddition($apMenengahId, $index);
        $IDRAmount = str_replace(",","",$this->input->post("adt_nom_idr_".$index));
        $ValasAmount = str_replace(",","",$this->input->post("adt_nom_valas_".$index));
        $totalAmount = $IDRAmount + $ValasAmount;
        if($totalAmount > $oldBRINominal && $oldBRINominal != 0){
          $selisih = $totalAmount - $oldBRINominal;
          $totalAmount = $rsWalletShareAddition[0]->TotalAmount + $selisih;
        }else if($totalAmount < $oldBRINominal && $oldBRINominal != 0){
          $selisih = $oldBRINominal - $totalAmount;
          $totalAmount = $rsWalletShareAddition[0]->TotalAmount - $selisih;
        }
        $otherNominal = $totalAmount - ($IDRAmount + $ValasAmount);

        $facilitiesBanking = array(
          "BankFacilityItemAdditionMenengahId" => $index,
          "AccountPlanningMenengahId" => $apMenengahId,
          "Name" => $this->input->post("adt_name_".$index),
          "IDRAmount" => str_replace(",","",$this->input->post("adt_nom_idr_".$index)),
          "IDRRate" => str_replace(",","",$this->input->post("adt_rate_idr_".$index)),
          "ValasAmount" => str_replace(",","",$this->input->post("adt_nom_valas_".$index)),
          "ValasRate" => str_replace(",","",$this->input->post("adt_rate_valas_".$index)),
          "TotalAmount" => $totalAmount,
          "OtherNominal" => $otherNominal,
          "IsActive" => 1,
          "CurrentDate" => $this->current_datetime,
          "UserId" => $userId
        );
        array_push($arrUpdateFacilitiesBankingItemAddition, $facilitiesBanking);
      }      
    }
    $data["arrUpdateFacilitiesBankingItemAddition"] = $arrUpdateFacilitiesBankingItemAddition;

    $dataFacilitiesBankingItemAddition = explode(",",$this->input->post("dataFacilitiesBankingItemAddition"));
    $arrNewFacilitiesBankingItemAddition = array();
    foreach($dataFacilitiesBankingItemAddition as $row){
      $name = trim($this->input->post("name_addition_".$row));
      if($name != ""){
        $IDRAmount = str_replace(",","",$this->input->post("nom_idr_addition_".$row));
        $ValasAmount = str_replace(",","",$this->input->post("nom_valas_addition_".$row));
        $totalAmount = $IDRAmount + $ValasAmount;
        $otherNominal = 0;
        
        $facilitiesBankingItemAddition = array(
          "BankFacilityGroupMenengahId" => $facilitiesBankingGroupId,
          "Name" => $this->input->post("name_addition_".$row),
          "AccountPlanningMenengahId" => $apMenengahId,
          "IsActive" => 1,
          "IDRAmount" => str_replace(",","",$this->input->post("nom_idr_addition_".$row)),
          "IDRRate" => str_replace(",","",$this->input->post("rate_idr_addition_".$row)),
          "ValasAmount" => str_replace(",","",$this->input->post("nom_valas_addition_".$row)),
          "ValasRate" => str_replace(",","",$this->input->post("rate_valas_addition_".$row)),
          "TotalAmount" => $totalAmount,
          "OtherNominal" => $otherNominal,
          "CurrentDate" => $this->current_datetime,
          "UserId" => $userId
        );
        array_push($arrNewFacilitiesBankingItemAddition, $facilitiesBankingItemAddition);
      }     
    }
    $data["arrNewFacilitiesBankingItemAddition"] = $arrNewFacilitiesBankingItemAddition;
    $result = $this->ManageAccountPlanning_model->updateFacilitiesBanking($data);
    echo json_encode($result);
  }
  public function input_wallet_share($apMenengahId, $facilitiesBankingGroupId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "bri_starting_position";

    $data["FacilitiesBankingGroupId"] = $facilitiesBankingGroupId;
    $data["FacilitiesBankingGroupType"] = "wallet_share";

    $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup($facilitiesBankingGroupId);
    $data["FacilitiesBankingGroupName"] = $rsFacilitiesBankingGroup[0]->Name;

    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
      $rsBankFacility = $this->ManageAccountPlanning_model->getFacilitiesBanking($apMenengahId, $bankFacilityItemId);
      if(!empty($rsBankFacility)){
        $IDRAmount = $rsBankFacility[0]->IDRAmount;
        $ValasAmount = $rsBankFacility[0]->ValasAmount;
      }else{
        $IDRAmount = 0;
        $ValasAmount = 0;
      }
      $BRINominal = $IDRAmount + $ValasAmount;
      $rsWalletShare = $this->ManageAccountPlanning_model->getWalletShare($apMenengahId, $bankFacilityItemId);
      if(!empty($rsWalletShare)){
        if($rsWalletShare[0]->TotalAmount == 0) 
          $BRIPortion = 0;
        else{
          $BRIPortion = number_format(($BRINominal / $rsWalletShare[0]->TotalAmount) * 100 , 2);
        }
        $rowItem->BRINominal = number_format($BRINominal, 2, '.', '');
        $rowItem->BRIPortion = number_format($BRIPortion, 2, '.', '');
        $rowItem->OtherNominal = $rsWalletShare[0]->OtherNominal;
        $rowItem->TotalAmount = $rsWalletShare[0]->TotalAmount;        
      }else{
        $rowItem->BRINominal = $BRINominal;
        $rowItem->BRIPortion = 0;
        $rowItem->OtherNominal = 0;
        $rowItem->TotalAmount = 0;
      }
    }
    $data["FacilitiesBankingItem"] = $rsFacilitiesBankingItem;

    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $rsBankFacilityAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsBankFacilityAddition)){
        $IDRAmount = $rsBankFacilityAddition[0]->IDRAmount;
        $ValasAmount = $rsBankFacilityAddition[0]->ValasAmount;
      }else{
        $IDRAmount = 0;
        $ValasAmount = 0;
      }
      $BRINominal = $IDRAmount + $ValasAmount;

      $rsWalletShareAddition = $this->ManageAccountPlanning_model->getWalletShareAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsWalletShareAddition)){
        if($rsWalletShareAddition[0]->TotalAmount == 0) 
          $BRIPortion = 0;
        else{
          $BRIPortion = number_format(($BRINominal / $rsWalletShareAddition[0]->TotalAmount) * 100 , 2);
        }
        $rowItemAddition->BRINominal = number_format($BRINominal, 2, '.', '');
        $rowItemAddition->BRIPortion = number_format($BRIPortion, 2, '.', '');
        $rowItemAddition->OtherNominal = $rsWalletShareAddition[0]->OtherNominal;
        $rowItemAddition->TotalAmount = $rsWalletShareAddition[0]->TotalAmount;
      }else{
        $rowItemAddition->BRINominal = $BRINominal;
        $rowItemAddition->BRIPortion = 0;
        $rowItemAddition->OtherNominal = 0;
        $rowItemAddition->TotalAmount = 0;
      }
    }
    $data["FacilitiesBankingItemAddition"] = $rsFacilitiesBankingItemAddition;
    //echo json_encode($data); die;
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/wallet_share.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_wallet_share(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = $this->input->post("mainTab");
    $secondTab = $this->input->post("secondTab");
    $apMenengahId = $this->input->post("apMenengahId");
    $facilitiesBankingGroupId = $this->input->post("facilitiesBankingGroupId");

    $data["AccountPlanningMenengahId"] = $apMenengahId;
    $data["BankFacilityGroupMenengahId"] = $facilitiesBankingGroupId;

    $arrFacilitiesBankingItem = array();
    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $index = $rowItem->BankFacilityItemMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "OtherNominal" => str_replace(",","",$this->input->post("other_nominal_".$index)),
        "TotalAmount" => str_replace(",","",$this->input->post("total_amount_".$index)),
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItem, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItem"] = $arrFacilitiesBankingItem;

    $arrFacilitiesBankingItemAddition = array();
    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $index = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemAdditionMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "OtherNominal" => str_replace(",","",$this->input->post("other_nominal_addition_".$index)),
        "TotalAmount" => str_replace(",","",$this->input->post("total_amount_addition_".$index)),
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItemAddition, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItemAddition"] = $arrFacilitiesBankingItemAddition;

    $result = $this->ManageAccountPlanning_model->updateWalletShare($data);
    echo json_encode($result);
  }
  public function input_competition_analysis($apMenengahId, $facilitiesBankingGroupId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "bri_starting_position";

    $data["FacilitiesBankingGroupId"] = $facilitiesBankingGroupId;
    $data["FacilitiesBankingGroupType"] = "competition_analysis";

    $rsBank = $this->ManageAccountPlanning_model->getBank();
    $data["Bank"] = $rsBank;

    $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup($facilitiesBankingGroupId);
    $data["FacilitiesBankingGroupName"] = $rsFacilitiesBankingGroup[0]->Name;

    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
      $rsCompetitionAnalysis = $this->ManageAccountPlanning_model->getCompetitionAnalysis($apMenengahId, $bankFacilityItemId);
      if(!empty($rsCompetitionAnalysis)){
        $rowItem->BankId1 = $rsCompetitionAnalysis[0]->BankId1;
        $rowItem->BankId1Portion = $rsCompetitionAnalysis[0]->BankId1Portion;
        $rowItem->BankName1 = $rsCompetitionAnalysis[0]->BankName1;
        $rowItem->BankId2 = $rsCompetitionAnalysis[0]->BankId2;
        $rowItem->BankId2Portion = $rsCompetitionAnalysis[0]->BankId2Portion;
        $rowItem->BankName2 = $rsCompetitionAnalysis[0]->BankName2;
        $rowItem->BankId3 = $rsCompetitionAnalysis[0]->BankId3;
        $rowItem->BankId3Portion = $rsCompetitionAnalysis[0]->BankId3Portion;
        $rowItem->BankName3 = $rsCompetitionAnalysis[0]->BankName3;     
      }else{
        $rowItem->BankId1 = 0;
        $rowItem->BankId1Portion = 0;
        $rowItem->BankName1 = null;
        $rowItem->BankId2 = 0;
        $rowItem->BankId2Portion = 0;
        $rowItem->BankName2 = null;
        $rowItem->BankId3 = 0;
        $rowItem->BankId3Portion = 0;
        $rowItem->BankName3 = null;     
      }
      $rsWalletShare = $this->ManageAccountPlanning_model->getWalletShare($apMenengahId, $bankFacilityItemId);
      if(!empty($rsWalletShare)){
        $rowItem->OtherNominal = $rsWalletShare[0]->OtherNominal;
      }else{
        $rowItem->OtherNominal = 0;
      }
    }
    $data["FacilitiesBankingItem"] = $rsFacilitiesBankingItem;

    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $rsCompetitionAnalysisAddition = $this->ManageAccountPlanning_model->getCompetitionAnalysisAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsCompetitionAnalysisAddition)){
        $rowItemAddition->BankId1 = $rsCompetitionAnalysis[0]->BankId1;
        $rowItemAddition->BankId1Portion = $rsCompetitionAnalysis[0]->BankId1Portion;
        $rowItemAddition->BankName1 = $rsCompetitionAnalysis[0]->BankName1;
        $rowItemAddition->BankId2 = $rsCompetitionAnalysis[0]->BankId2;
        $rowItemAddition->BankId2Portion = $rsCompetitionAnalysis[0]->BankId2Portion;
        $rowItemAddition->BankName2 = $rsCompetitionAnalysis[0]->BankName2;
        $rowItemAddition->BankId3 = $rsCompetitionAnalysis[0]->BankId3;
        $rowItemAddition->BankId3Portion = $rsCompetitionAnalysis[0]->BankId3Portion;
        $rowItemAddition->BankName3 = $rsCompetitionAnalysis[0]->BankName3; 
      }else{
        $rowItemAddition->BankId1 = 0;
        $rowItemAddition->BankId1Portion = 0;
        $rowItemAddition->BankName1 = null;
        $rowItemAddition->BankId2 = 0;
        $rowItemAddition->BankId2Portion = 0;
        $rowItemAddition->BankName2 = null;
        $rowItemAddition->BankId3 = 0;
        $rowItemAddition->BankId3Portion = 0;
        $rowItemAddition->BankName3 = null;     
      }
      $rsWalletShareAddition = $this->ManageAccountPlanning_model->getWalletShareAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsWalletShareAddition)){
        $rowItemAddition->OtherNominal = $rsWalletShareAddition[0]->OtherNominal;
      }else{
        $rowItemAddition->OtherNominal = 0;
      }
    }
    $data["FacilitiesBankingItemAddition"] = $rsFacilitiesBankingItemAddition;

    //echo json_encode($data); die;
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/competition_analysis.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_competition_analysis(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = $this->input->post("mainTab");
    $secondTab = $this->input->post("secondTab");
    $apMenengahId = $this->input->post("apMenengahId");
    $facilitiesBankingGroupId = $this->input->post("facilitiesBankingGroupId");

    $data["AccountPlanningMenengahId"] = $apMenengahId;
    $data["BankFacilityGroupMenengahId"] = $facilitiesBankingGroupId;

    $arrFacilitiesBankingItem = array();
    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $index = $rowItem->BankFacilityItemMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "BankId1" => ($this->input->post("bank1_".$index) != 0) ? $this->input->post("bank1_".$index) : NULL,
        "BankId1Portion" => ($this->input->post("bank1_".$index) != 0) ? str_replace(",","",$this->input->post("bank1_portion_".$index)) : NULL,
        "BankId2" => ($this->input->post("bank2_".$index) != 0) ? $this->input->post("bank2_".$index) : NULL,
        "BankId2Portion" => ($this->input->post("bank2_".$index) != 0) ? str_replace(",","",$this->input->post("bank2_portion_".$index)) : NULL,
        "BankId3" => ($this->input->post("bank3_".$index) != 0) ? $this->input->post("bank3_".$index) : NULL,
        "BankId3Portion" => ($this->input->post("bank3_".$index) != 0) ? str_replace(",","",$this->input->post("bank3_portion_".$index)) : NULL,
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItem, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItem"] = $arrFacilitiesBankingItem;

    $arrFacilitiesBankingItemAddition = array();
    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $index = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemAdditionMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "BankId1" => ($this->input->post("bank1_addition_".$index) != 0) ? $this->input->post("bank1_addition_".$index) : NULL,
        "BankId1Portion" => ($this->input->post("bank1_addition_".$index) != 0) ? str_replace(",","",$this->input->post("bank1_portion_addition_".$index)) : NULL,
        "BankId2" => ($this->input->post("bank2_addition_".$index) != 0) ? $this->input->post("bank2_addition_".$index) : NULL,
        "BankId2Portion" => ($this->input->post("bank2_addition_".$index) != 0) ? str_replace(",","",$this->input->post("bank2_portion_addition_".$index)) : NULL,
        "BankId3" => ($this->input->post("bank3_addition_".$index) != 0) ? $this->input->post("bank3_addition_".$index) : NULL,
        "BankId3Portion" => ($this->input->post("bank3_addition_".$index) != 0) ? str_replace(",","",$this->input->post("bank3_portion_addition_".$index)) : NULL,
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItemAddition, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItemAddition"] = $arrFacilitiesBankingItemAddition;
    $result = $this->ManageAccountPlanning_model->updateCompetitionAnalysis($data);
    echo json_encode($result);
  }

  /* Input Tab Client Needs */
  public function input_fundings($apMenengahId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "client_needs";

    $rsFundings = $this->ManageAccountPlanning_model->getFundings($apMenengahId);
    $data["Fundings"] = $rsFundings;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/fundings', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_fundings(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = "client_needs";
    $apMenengahId = $this->input->post("apMenengahId");
    $data["AccountPlanningMenengahId"] = $apMenengahId;

    $totalFundings = $this->input->post("totalFundings");
    $dataFundings = explode(',',$this->input->post("dataFundings"));
    
    $arrFundings = array();
    foreach($dataFundings as $row){
      $funding = array(
        "AccountPlanningMenengahId" => $apMenengahId,
        "FundingNeed" => $this->input->post("funding_need_".$row),
        "TimePeriod" => $this->input->post("time_period_".$row) != "" ? $this->input->post("time_period_".$row):0,
        "Amount" => $this->input->post("amount_".$row) != "" ? str_replace(",","",$this->input->post("amount_".$row)):0,
        "Description" => $this->input->post("description_".$row),
        "UserId" => $userId,
        "CurrentDate" => $this->current_datetime
      );
      array_push($arrFundings, $funding);
    }
    $data = array(
      "AccountPlanningMenengahId" => $apMenengahId,
      "ArrFundings" => $arrFundings,
      "UserId" => $userId,
      "CurrentDate" => $this->current_datetime
    );
    
    $result = $this->ManageAccountPlanning_model->updateFundings($data);
    echo json_encode($result);
  }
  public function input_services($apMenengahId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "client_needs";

    $rsUnitKerja = $this->ManageAccountPlanning_model->getUnitKerja();
    $data["UnitKerja"] = $rsUnitKerja;

    $rsServices = $this->ManageAccountPlanning_model->getServices($apMenengahId);
    foreach($rsServices as $row){
      $ServiceMenengahId = $row->ServiceMenengahId;
      $rsUnitKerjaTag = $this->ManageAccountPlanning_model->getUnitKerjaTag($ServiceMenengahId);
      $arrUnitKerjaTag = array();
      foreach($rsUnitKerjaTag as $rows){
        array_push($arrUnitKerjaTag, $rows->UnitKerjaId);
      }
      $row->UnitKerjaTag = $arrUnitKerjaTag;
    }
    $data["Services"] = $rsServices;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/services', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_services(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = "client_needs";
    $apMenengahId = $this->input->post("apMenengahId");
    $data["AccountPlanningMenengahId"] = $apMenengahId;

    $totalServices = $this->input->post("totalServices");
    $dataServices = explode(',',$this->input->post("dataServices"));
    
    $arrServices = array();
    foreach($dataServices as $row){
      $service = array(
        "AccountPlanningMenengahId" => $apMenengahId,
        "Name" => $this->input->post("name_".$row),
        "Type" => $this->input->post("type_".$row),
        "Target" => $this->input->post("target_".$row) != "" ? $this->input->post("target_".$row):0,
        "Description" => $this->input->post("description_".$row),
        "UserId" => $userId,
        "CurrentDate" => $this->current_datetime
      );
      array_push($arrServices, $service);
    }
    $data = array(
      "AccountPlanningMenengahId" => $apMenengahId,
      "ArrServices" => $arrServices,
      "UserId" => $userId,
      "CurrentDate" => $this->current_datetime
    );
    
    $result = $this->ManageAccountPlanning_model->updateServices($data);
    echo json_encode($result);
  }

  /* Input Tab Action Plans */
  public function input_estimated_financial($apMenengahId, $facilitiesBankingGroupId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "action_plans";

    $data["FacilitiesBankingGroupId"] = $facilitiesBankingGroupId;
    $data["FacilitiesBankingGroupType"] = "estimated_financial";

    $rsFacilitiesBankingGroup = $this->ManageAccountPlanning_model->getFacilitiesBankingGroup($facilitiesBankingGroupId);
    $data["FacilitiesBankingGroupName"] = $rsFacilitiesBankingGroup[0]->Name;

    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $bankFacilityItemId = $rowItem->BankFacilityItemMenengahId;
      $rsEstimatedFinancial = $this->ManageAccountPlanning_model->getEstimatedFinancial($apMenengahId, $bankFacilityItemId);
      if(!empty($rsEstimatedFinancial)){
        $rowItem->IDRProjection = $rsEstimatedFinancial[0]->IDRProjection;
        $rowItem->ValasProjection = $rsEstimatedFinancial[0]->ValasProjection;
        $rowItem->IDRTarget = $rsEstimatedFinancial[0]->IDRTarget;
        $rowItem->ValasTarget = $rsEstimatedFinancial[0]->ValasTarget;
      }else{
        $rowItem->IDRProjection = 0;
        $rowItem->ValasProjection = 0;
        $rowItem->IDRTarget = 0;
        $rowItem->ValasTarget = 0;
      }
      
    }
    $data["FacilitiesBankingItem"] = $rsFacilitiesBankingItem;

    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $bankFacilityItemAdditionId = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $rsEstimatedFinancialAddition = $this->ManageAccountPlanning_model->getEstimatedFinancialAddition($apMenengahId, $bankFacilityItemAdditionId);
      if(!empty($rsEstimatedFinancialAddition)){
        $rowItemAddition->IDRProjection = $rsEstimatedFinancialAddition[0]->IDRProjection;
        $rowItemAddition->ValasProjection = $rsEstimatedFinancialAddition[0]->ValasProjection;
        $rowItemAddition->IDRTarget = $rsEstimatedFinancialAddition[0]->IDRTarget;
        $rowItemAddition->ValasTarget = $rsEstimatedFinancialAddition[0]->ValasTarget;
      }else{
        $rowItemAddition->IDRProjection = 0;
        $rowItemAddition->ValasProjection = 0;
        $rowItemAddition->IDRTarget = 0;
        $rowItemAddition->ValasTarget = 0;
      }
    }
    $data["FacilitiesBankingItemAddition"] = $rsFacilitiesBankingItemAddition;

    //echo json_encode($data); die;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/estimated_financial.php', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_estimated_financial(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = $this->input->post("mainTab");
    $secondTab = $this->input->post("secondTab");
    $apMenengahId = $this->input->post("apMenengahId");
    $facilitiesBankingGroupId = $this->input->post("facilitiesBankingGroupId");

    $data["AccountPlanningMenengahId"] = $apMenengahId;
    $data["BankFacilityGroupMenengahId"] = $facilitiesBankingGroupId;

    $arrFacilitiesBankingItem = array();
    $rsFacilitiesBankingItem = $this->ManageAccountPlanning_model->getFacilitiesBankingItem($facilitiesBankingGroupId);
    foreach($rsFacilitiesBankingItem as $rowItem){
      $index = $rowItem->BankFacilityItemMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "IDRProjection" => str_replace(",","",$this->input->post("idr_projection_".$index)),
        "ValasProjection" => str_replace(",","",$this->input->post("valas_projection_".$index)),
        "IDRTarget" => str_replace(",","",$this->input->post("idr_target_".$index)),
        "ValasTarget" => str_replace(",","",$this->input->post("valas_target_".$index)),
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItem, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItem"] = $arrFacilitiesBankingItem;

    $arrFacilitiesBankingItemAddition = array();
    $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($facilitiesBankingGroupId, $apMenengahId);
    foreach($rsFacilitiesBankingItemAddition as $rowItemAddition){
      $index = $rowItemAddition->BankFacilityItemAdditionMenengahId;
      $facilitiesBanking = array(
        "BankFacilityItemAdditionMenengahId" => $index,
        "AccountPlanningMenengahId" => $apMenengahId,
        "IDRProjection" => str_replace(",","",$this->input->post("idr_projection_addition_".$index)),
        "ValasProjection" => str_replace(",","",$this->input->post("valas_projection_addition_".$index)),
        "IDRTarget" => str_replace(",","",$this->input->post("idr_target_addition_".$index)),
        "ValasTarget" => str_replace(",","",$this->input->post("valas_target_addition_".$index)),
        "CurrentDate" => $this->current_datetime,
        "UserId" => $userId
      );
      array_push($arrFacilitiesBankingItemAddition, $facilitiesBanking);
    }
    $data["arrFacilitiesBankingItemAddition"] = $arrFacilitiesBankingItemAddition;

    $result = $this->ManageAccountPlanning_model->updateEstimatedFinancial($data);
    echo json_encode($result);
  }
  public function input_initiatives_action($apMenengahId){
    $this->checkModule();
    $data = array();

    $data["apMenengahId"] = $apMenengahId;
    $data["AccountPlanningTab"] = "action_plans";
    $data["FacilitiesBankingGroupType"] = "initiatives_action";

    $rsIntitiativesAction = $this->ManageAccountPlanning_model->getInitiativeAction($apMenengahId);
    $data["InitiativesAction"] = $rsIntitiativesAction;

    //echo json_encode($data); die;
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('tasklist/account_planning_menengah/input_account_planning/form_input/inititatives_action', $data);
    $this->load->view('layout/footer.php');
  }
  public function process_input_initiatives_action(){
    $this->checkModule();
    $data = array();

    $userId = $this->session->PERSONAL_NUMBER;
    $mainTab = "action_plans";
    $secondTab = "initiatives_action";
    $apMenengahId = $this->input->post("apMenengahId");
    $data["AccountPlanningMenengahId"] = $apMenengahId;

    $totalInitiativesAction = $this->input->post("totalInitiativesAction");
    $dataInitiativesAction = explode(',',$this->input->post("dataInitiativesAction"));
    
    $arrInitiativesAction = array();
    foreach($dataInitiativesAction as $row){
      $initiativesAction = array(
        "AccountPlanningMenengahId" => $apMenengahId,
        "Name" => $this->input->post("name_".$row),
        "Period" => $this->input->post("period_".$row),
        "Description" => $this->input->post("description_".$row),
        "UserId" => $userId,
        "CurrentDate" => $this->current_datetime
      );
      array_push($arrInitiativesAction, $initiativesAction);
    }
    $data = array(
      "AccountPlanningMenengahId" => $apMenengahId,
      "ArrInitiativesAction" => $arrInitiativesAction,
      "UserId" => $userId,
      "CurrentDate" => $this->current_datetime
    );
    $result = $this->ManageAccountPlanning_model->updateInitiativeAction($data);
    echo json_encode($result);
  }

  /* Submit Approval Account Planning */
  public function submit_account_planning(){
    $this->checkModule();
    $data = array(
      "AccountPlanningMenengahId" => $this->input->post("accountPlanningId"),
      "DocumentStatusId" => 2,
      "ApproverId" => $this->input->post("approverId"),
      "UserId" => $this->session->PERSONAL_NUMBER,
      "CurrentDate" => $this->current_datetime
    );

    $rsSubmitAccountPlanning = $this->ManageAccountPlanning_model->submitAccountPlanning($data);
    echo json_encode($rsSubmitAccountPlanning);
  }
  public function retrieve_account_planning($accountPlanningMenengahId){
    $this->checkModule();
    $data = array(
      "AccountPlanningMenengahId" => $accountPlanningMenengahId,
      "DocumentStatusId" => 1,
      "UserId" => $this->session->PERSONAL_NUMBER,
      "CurrentDate" => $this->current_datetime
    );
    $rsRetrieveAccountPlanning = $this->ManageAccountPlanning_model->retrieveAccountPlanning($data);
    echo json_encode($rsRetrieveAccountPlanning);
  }

  /* Ajax Services Account Planning */
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
              "BRINominal" => $BRINominal,
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
              "BankId1Portion" => number_format($rsCompetitionAnalysis[0]->BankId1Portion, 2),
              "BankName1" => $rsCompetitionAnalysis[0]->BankName1,
              "BankId2" => $rsCompetitionAnalysis[0]->BankId2,
              "BankId2Portion" => number_format($rsCompetitionAnalysis[0]->BankId2Portion, 2),
              "BankName2" => $rsCompetitionAnalysis[0]->BankName2,
              "BankId3" => $rsCompetitionAnalysis[0]->BankId3,
              "BankId3Portion" => number_format($rsCompetitionAnalysis[0]->BankId3Portion, 2),
              "BankName3" => $rsCompetitionAnalysis[0]->BankName3
            );
          }else{
            $arrCompetitionAnalysis = array(
              "BankId1" => "",
              "BankId1Portion" => "",
              "BankName1" => "",
              "BankId2" => "",
              "BankId2Portion" => "",
              "BankName2" => "",
              "BankId3" => "",
              "BankId3Portion" => "",
              "BankName3" => ""
            );
          }
          $rowItem->CompetitionAnalysis = $arrCompetitionAnalysis;
        }
        $row->FacilitiesBankingItem = $rsFacilitiesBankingItem;

        $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($bankFacilityGroupId, $apMenengahId);
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
              "BRINominal" => $BRINominalAddition,
              "BRIPortion" => $BRIPortion,
              "OtherNominal" => $rsWalletShareAddition[0]->OtherNominal,
              "TotalAmount" => $rsWalletShareAddition[0]->TotalAmount
            );
          }else{
            $arrWalletShareAddition = array(
              "BRINominal" => $BRINominalAddition,
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
              "BankId1Portion" => number_format($rsCompetitionAnalysisAddition[0]->BankId1Portion, 2),
              "BankName1" => $rsCompetitionAnalysisAddition[0]->BankName1,
              "BankId2" => $rsCompetitionAnalysisAddition[0]->BankId2,
              "BankId2Portion" => number_format($rsCompetitionAnalysisAddition[0]->BankId2Portion, 2),
              "BankName2" => $rsCompetitionAnalysisAddition[0]->BankName2,
              "BankId3" => $rsCompetitionAnalysisAddition[0]->BankId3,
              "BankId3Portion" => number_format($rsCompetitionAnalysisAddition[0]->BankId3Portion, 2),
              "BankName3" => $rsCompetitionAnalysisAddition[0]->BankName3
            );
          }else{
            $arrCompetitionAnalysisAddition = array(
              "BankId1" => "",
              "BankId1Portion" => "",
              "BankName1" => "",
              "BankId2" => "",
              "BankId2Portion" => "",
              "BankName2" => "",
              "BankId3" => "",
              "BankId3Portion" => "",
              "BankName3" => ""
            );
          }
          $rowItemAddition->CompetitionAnalysisAddition = $arrCompetitionAnalysisAddition;
        }
        $row->FacilitiesBankingItemAddition = $rsFacilitiesBankingItemAddition;
      }
      $data["FacilitiesBanking"] = $rsFacilitiesBankingGroup;

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

      $rsFacilitiesBankingItemAddition = $this->ManageAccountPlanning_model->getFacilitiesBankingItemAddition($bankFacilityGroupId, $apMenengahId);
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
            if($rsEstimatedFinancialAddition[0]->ValasTarget != 0){
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
