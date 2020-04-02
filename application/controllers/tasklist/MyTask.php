<?php 

class MyTask extends MY_Controller {

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
      $this->load->model('TasklistMyTask_model');
      $this->load->model('TasklistAccountPlanning_model');
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

    $total_records = $this->TasklistMyTask_model->getTotalViewGroupList($this->session->PERSONAL_NUMBER);
    if ($total_records > 0) {   
      $group_list = $this->TasklistMyTask_model->getViewGroupList($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list[$CustomerGroupId] = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        foreach ($group_customer_list[$CustomerGroupId] as $key => $value) {
          $pinjamanCust = $this->DataTransaction_model->getLastDataPinjamanVcif($value['VCIF']);
          $simpananCust = $this->DataTransaction_model->getLastDataSimpananVcif($value['VCIF']);
          $cpaCust = $this->DataTransaction_model->getLastDataCpaVcif($value['VCIF']);

          $group_customer_list[$CustomerGroupId][$key]['PinjamanTotal'] = number_format($pinjamanCust['TotalPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['PinjamanRatas'] = number_format($pinjamanCust['RatasPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananTotal'] = number_format($simpananCust['TotalSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananRatas'] = number_format($simpananCust['RatasSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['CurrentCPA'] = number_format($cpaCust['Cpa']/VALUE_PER,0);
          
         /* $SummaryCustomer[$CustomerGroupId][$key] = $this->TasklistMyTask_model->getSummaryCustomer($value['VCIF']);

          if (!empty($SummaryCustomer[$CustomerGroupId][$key])) {
            $group_customer_list[$CustomerGroupId][$key]['PinjamanTotal'] = $SummaryCustomer[$CustomerGroupId][$key][0]['PinjamanTotal'];
            $group_customer_list[$CustomerGroupId][$key]['PinjamanRatas'] = $SummaryCustomer[$CustomerGroupId][$key][0]['PinjamanRatas'];
            $group_customer_list[$CustomerGroupId][$key]['SimpananTotal'] = $SummaryCustomer[$CustomerGroupId][$key][0]['SimpananTotal'];
            $group_customer_list[$CustomerGroupId][$key]['SimpananRatas'] = $SummaryCustomer[$CustomerGroupId][$key][0]['SimpananRatas'];
            $group_customer_list[$CustomerGroupId][$key]['CurrentCPA']    = $SummaryCustomer[$CustomerGroupId][$key][0]['CurrentCPA'];
            $group_customer_list[$CustomerGroupId][$key]['ValueChain']    = $SummaryCustomer[$CustomerGroupId][$key][0]['ValueChain'];
          }*/
        }
        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),

          'group_customer_list'             => $group_customer_list
        );
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/MyTask/page';
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
    $this->load->view('tasklist/mytask_group_list.php', $params);
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

    $total_records = $this->TasklistMyTask_model->getTotalViewGroupList($this->session->PERSONAL_NUMBER, '');
    if ($total_records > 0) {   
      $group_list = $this->TasklistMyTask_model->getViewGroupList($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, '');

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list[$CustomerGroupId] = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        foreach ($group_customer_list[$CustomerGroupId] as $key => $value) {
          $pinjamanCust = $this->DataTransaction_model->getLastDataPinjamanVcif($value['VCIF']);
          $simpananCust = $this->DataTransaction_model->getLastDataSimpananVcif($value['VCIF']);
          $cpaCust = $this->DataTransaction_model->getLastDataCpaVcif($value['VCIF']);

          $group_customer_list[$CustomerGroupId][$key]['PinjamanTotal'] = number_format($pinjamanCust['TotalPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['PinjamanRatas'] = number_format($pinjamanCust['RatasPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananTotal'] = number_format($simpananCust['TotalSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananRatas'] = number_format($simpananCust['RatasSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['CurrentCPA'] = number_format($cpaCust['Cpa']/VALUE_PER,0);
        }
        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
          'group_customer_list'             => $group_customer_list
        );
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/MyTask/page';
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
    $this->load->view('tasklist/mytask_group_list.php', $params);
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
      header("location:".base_url() . "tasklist/MyTask");
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

    $total_records = $this->TasklistMyTask_model->getTotalViewGroupList($this->session->PERSONAL_NUMBER, $searchTxt);
    if ($total_records > 0) {   
      $group_list = $this->TasklistMyTask_model->getViewGroupList($this->session->PERSONAL_NUMBER, $limit_per_page, $rowno, $searchTxt);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list[$CustomerGroupId] = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);

        foreach ($group_customer_list[$CustomerGroupId] as $key => $value) {
          $pinjamanCust = $this->DataTransaction_model->getLastDataPinjamanVcif($value['VCIF']);
          $simpananCust = $this->DataTransaction_model->getLastDataSimpananVcif($value['VCIF']);
          $cpaCust = $this->DataTransaction_model->getLastDataCpaVcif($value['VCIF']);

          $group_customer_list[$CustomerGroupId][$key]['PinjamanTotal'] = number_format($pinjamanCust['TotalPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['PinjamanRatas'] = number_format($pinjamanCust['RatasPinjaman']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananTotal'] = number_format($simpananCust['TotalSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['SimpananRatas'] = number_format($simpananCust['RatasSimpanan']/VALUE_PER,0);
          $group_customer_list[$CustomerGroupId][$key]['CurrentCPA'] = number_format($cpaCust['Cpa']/VALUE_PER,0);
        }
        $params['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
          'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
          'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
          'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
          'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
          'group_customer_list'             => $group_customer_list
        );
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'tasklist/MyTask/search/'.$params['searchTxt'];
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
    $this->load->view('tasklist/mytask_group_list.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function create_ap() {
    $current_year = $this->current_year;
    //$current_datetime = $this->current_datetime;
    $UserId = $this->session->PERSONAL_NUMBER;

    

    if (!empty($this->input->post('VCIF'))) {
      $this->db->trans_begin();
      $insertAccountPlanningId = $this->TasklistMyTask_model->insertAccountPlanning($current_year, $UserId);
      if($insertAccountPlanningId['status'] == 'error'){
        echo json_encode($insertAccountPlanningId);
      } else {
        foreach ($this->input->post('VCIF') as $key => $value) {
        $IsMain = 0;
        if ($this->input->post('IsMain') == $value) {
          $IsMain = 1;
        }
        $data[$key] = array(
          'AccountPlanningId'   => $insertAccountPlanningId['message'],
          'VCIF'                => $value,
          'IsMain'              => $IsMain,
          'UserId'              => $UserId,
          'Year'                => $current_year
          );
      }
      $insertAPActivity = $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($insertAccountPlanningId['message'], 'Create', 'Creating account planning', $UserId);
      $insertCustomerAP = $this->TasklistMyTask_model->insertCustomerAP($data);  
      if($insertCustomerAP['status']=='error')
        $this->db->trans_rollback();
      else
        $this->db->trans_commit();
      echo json_encode($insertCustomerAP);
      }
    }
  }

}

?>
