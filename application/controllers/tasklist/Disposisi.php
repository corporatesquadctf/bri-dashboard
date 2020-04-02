<?php 

class Disposisi extends MY_Controller {

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

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList('');
    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno);
      //$params['rm_per_uker_list'] = $this->TasklistDisposisi_model->getRMPerUnitKerja($this->session->DIVISION);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $rm_selected_list = $this->TasklistDisposisi_model->getRMSelectedAll($CustomerGroupId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
          'group_customer_list'             => $group_customer_list,
          'rm_selected_list'                => $rm_selected_list,
        );
      }
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/disposisi/page';
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
    $this->load->view('tasklist/disposisi_group_list.php', $params);
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

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList('');
    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno);
      //$params['rm_per_uker_list'] = $this->TasklistDisposisi_model->getRMPerUnitKerja($this->session->DIVISION);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $rm_selected_list = $this->TasklistDisposisi_model->getRMSelectedAll($CustomerGroupId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
          'group_customer_list'             => $group_customer_list,
          'rm_selected_list'                => $rm_selected_list,
        );
      }
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/disposisi/page';
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
    $this->load->view('tasklist/disposisi_group_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function search($searchTxt='', $rowno=0) {
    $this->checkModule();

    $params = array();

    if (empty($searchTxt)) {
      $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
    }
    else {
      $searchTxt = str_replace('_', ' ', $searchTxt);
    }

    if(empty(trim($searchTxt))) {
      header("location:".base_url() . "tasklist/disposisi");
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

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList($searchTxt);
    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno, $searchTxt);
      //$params['rm_per_uker_list'] = $this->TasklistDisposisi_model->getRMPerUnitKerja($this->session->DIVISION);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $rm_selected_list = $this->TasklistDisposisi_model->getRMSelectedAll($CustomerGroupId);

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
          'group_customer_list'             => $group_customer_list,
          'rm_selected_list'                => $rm_selected_list,
        );
      }
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/disposisi/search/'.$params['searchTxt'];
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
    $this->load->view('tasklist/disposisi_group_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function add_disposisi() {
    foreach ((array) $this->input->post('rm_per_uker_list') as $key => $value) {
      $insertDisposisiPerRM = $this->TasklistDisposisi_model->insertDisposisiPerRM($this->input->post('CustomerGroupId'), $value, $this->session->PERSONAL_NUMBER);
      if ($insertDisposisiPerRM['insertStatus'] == 'error') 
        break;    
    }

    foreach ((array) $this->input->post('rm_selected_list') as $key => $value) {
      $removeDisposisiPerRM = $this->TasklistDisposisi_model->removeDisposisiPerRM($this->input->post('CustomerGroupId'), $value, $this->session->PERSONAL_NUMBER);
      if ($removeDisposisiPerRM['removeStatus'] == 'error') 
        break;
    }

    /*if(isset($insertDisposisiPerRM))
      echo json_encode($insertDisposisiPerRM);

    if(isset($removeDisposisiPerRM))
      echo json_encode($removeDisposisiPerRM);*/

    if(isset($insertDisposisiPerRM) && isset($removeDisposisiPerRM))
      echo json_encode(array_merge($insertDisposisiPerRM,$removeDisposisiPerRM));
    else if(isset($insertDisposisiPerRM))
      echo json_encode($insertDisposisiPerRM);
    else if(isset($removeDisposisiPerRM))
      echo json_encode($removeDisposisiPerRM);
    
  }

  public function getRMSelected($CustomerGroupId) {
    $result = $this->TasklistDisposisi_model->getRMSelected($this->session->DIVISION, $CustomerGroupId);
    echo json_encode($result);
  }

  public function getRMUnSelected($CustomerGroupId) {
    $result = $this->TasklistDisposisi_model->getRMUnSelected($this->session->DIVISION, $CustomerGroupId);
    echo json_encode($result);
  }

}

?>
