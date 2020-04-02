<?php 

  class CreateAccountPlanning extends MY_Controller {

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

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function index($rowno=0) {
      $this->checkModule();

      $userId = $this->session->PERSONAL_NUMBER;
      $year = $this->current_year;
      $params = array();
      $limit_per_page = 1;

      $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
      $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
      $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
      $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
      $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
      $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];

      $total_records = $this->CreateAccountPlanning_model->getTotalCustomerList($userId);
      if ($total_records > 0) {   
        $customerList = $this->CreateAccountPlanning_model->getCustomerList($userId, $year, $limit_per_page, $rowno);
        
        $i = 0;
        foreach ($customerList as $row) {
          $cif = $row["CIF"];
          $pinjaman = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($cif);
          $simpanan = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($cif);
          $customerList[$i]["PinjamanTotal"] = number_format($pinjaman['TotalPinjaman']/VALUE_PER,0);
          $customerList[$i]["PinjamanRatas"] = number_format($pinjaman['RatasPinjaman']/VALUE_PER,0);
          $customerList[$i]["SimpananTotal"] = number_format($simpanan['TotalSimpanan']/VALUE_PER,0);
          $customerList[$i]["SimpananRatas"] = number_format($simpanan['RatasSimpanan']/VALUE_PER,0);
          $i++;
        }
        $params["result"] = $customerList;
        //echo json_encode($params); die;
        $params['row'] = $rowno;

        $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/create_account_planning/page';
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
      $this->load->view('tasklist/account_planning_menengah/create_account_planning_list.php', $params);
      $this->load->view('layout/footer.php');
    }

    public function page($rowno=1) {
      $this->checkModule();

      $userId = $this->session->PERSONAL_NUMBER;
      $year = $this->current_year;
      $params = array();
      $limit_per_page = 1;
      $rowno = ($rowno-1) * $limit_per_page;

      $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
      $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
      $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
      $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
      $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
      $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];

      $total_records = $this->CreateAccountPlanning_model->getTotalCustomerList($userId);
      if ($total_records > 0) {   
        $customerList = $this->CreateAccountPlanning_model->getCustomerList($userId, $year, $limit_per_page, $rowno);
        
        $i = 0;
        foreach ($customerList as $row) {
          $cif = $row["CIF"];
          $pinjaman = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($cif);
          $simpanan = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($cif);
          $customerList[$i]["PinjamanTotal"] = number_format($pinjaman['TotalPinjaman']/VALUE_PER,0);
          $customerList[$i]["PinjamanRatas"] = number_format($pinjaman['RatasPinjaman']/VALUE_PER,0);
          $customerList[$i]["SimpananTotal"] = number_format($simpanan['TotalSimpanan']/VALUE_PER,0);
          $customerList[$i]["SimpananRatas"] = number_format($simpanan['RatasSimpanan']/VALUE_PER,0);
          $i++;
        }
        $params["result"] = $customerList;
        //echo json_encode($params); die;
        $params['row'] = $rowno;

        $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/create_account_planning/page';
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
      $this->load->view('tasklist/account_planning_menengah/create_account_planning_list.php', $params);
      $this->load->view('layout/footer.php');
    }

    public function search($searchTxt='', $rowno=0) {
      $this->checkModule();

      $userId = $this->session->PERSONAL_NUMBER;
      $year = $this->current_year;
      $params = array();

      if (empty($searchTxt)) {
        $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
      }
      else {
        $searchTxt = str_replace('_', ' ', $searchTxt);
      }
      $params['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));

      if(empty(trim($searchTxt))) {
        header("location:".base_url() . "tasklist/account_planning_menengah/create_account_planning");
      }

      $limit_per_page = 1;
      if($rowno != 0){
        $rowno = ($rowno-1) * $limit_per_page;
      }

      $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
      $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
      $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
      $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
      $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
      $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];

      $total_records = $this->CreateAccountPlanning_model->getTotalCustomerList($userId, $searchTxt);
      if ($total_records > 0) {   
        $customerList = $this->CreateAccountPlanning_model->getCustomerList($userId, $year, $limit_per_page, $rowno, $searchTxt);
        
        $i = 0;
        foreach ($customerList as $row) {
          $cif = $row["CIF"];
          $pinjaman = $this->DataTransaction_model->getDataPinjamanAccountPlanningMenengah($cif);
          $simpanan = $this->DataTransaction_model->getDataSimpananAccountPlanningMenengah($cif);
          $customerList[$i]["PinjamanTotal"] = number_format($pinjaman['TotalPinjaman']/VALUE_PER,0);
          $customerList[$i]["PinjamanRatas"] = number_format($pinjaman['RatasPinjaman']/VALUE_PER,0);
          $customerList[$i]["SimpananTotal"] = number_format($simpanan['TotalSimpanan']/VALUE_PER,0);
          $customerList[$i]["SimpananRatas"] = number_format($simpanan['RatasSimpanan']/VALUE_PER,0);
          $i++;
        }
        $params["result"] = $customerList;
        //echo json_encode($params); die;
        $params['row'] = $rowno;

        $config['base_url'] = base_url() . 'tasklist/account_planning_menengah/create_account_planning/search/'.$params['searchTxt'];
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $total_records;
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 6;
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
      $this->load->view('tasklist/account_planning_menengah/create_account_planning_list.php', $params);
      $this->load->view('layout/footer.php');
    }

    public function process_create() {
      $current_year = $this->current_year;
      $userId = $this->session->PERSONAL_NUMBER;
      $cif = $this->input->post("cif");

      $processCreateAccountPlanning = $this->CreateAccountPlanning_model->insertAccountPlanning($current_year, $userId, $cif);
      echo json_encode($processCreateAccountPlanning);
    }

  }

?>
