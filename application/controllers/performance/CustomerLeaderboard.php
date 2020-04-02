<?php 

class CustomerLeaderboard extends MY_Controller {

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
      $this->load->model('Leaderboard_model');
      $this->load->model('PerformanceAccountPlanning_model');
      $this->load->model('DataTransaction_model');
      $this->load->model('MonitoringAccountPlanning_model');
      $this->load->model('TasklistDisposisi_model');
      $this->load->model('AccountPlanningCalculate_model');

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index($rowno=0) {
    $this->checkModule();

    $params = array();
    $data = array(
          'group_list' => array()
    );

    $keyword_search = "";
    $keyword_search = ($this->input->post('keyword_search')) ? $this->input->post('keyword_search') : "";
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];
    
    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_box[''] = 'All';
    foreach ($ukers as $uker) {
      $uker_search_box[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_box, '', ' class="form-control col-md-7 col-xs-12"');

    $params['keyword_search_box'] = $keyword_search;

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList('');

    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
        $RoRaGroup['RoRa'] = 0;
        $RarocGroup['Raroc'] = 0;
        // $RarocGroup['Raroc'] = $this->DataTransaction_model->getRarocPerGroup($CustomerGroupId);

        $GroupIsMain = $this->AccountPlanningCalculate_model->getGroupIsMain($CustomerGroupId);

        $AccountPlanningId = 0;
        if (!empty($GroupIsMain['AccountPlanningId'])) {
          $AccountPlanningId = $GroupIsMain['AccountPlanningId'];
        }
        $GroupFHCalc = $this->AccountPlanningCalculate_model->getGroupFHCalcDetails($AccountPlanningId);
        $model5V = V5_FRAUD_CONSTANT + (V5_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V5_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V5_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V5_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V5_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3));
        $GroupFHCalc["Model5V"] = number_format($model5V, 3);
        
        $model8V = V8_FRAUD_CONSTANT + (V8_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V8_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V8_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V8_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V8_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3))
          - (V8_SGAI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGAI"], 3)) + (V8_TATA_FRAUD_CONSTANT * number_format($GroupFHCalc["TATA"], 3)) - (V8_LVGI_FRAUD_CONSTANT * number_format($GroupFHCalc["LIVIGI"], 3));
        $GroupFHCalc["Model8V"] = number_format($model8V, 3);

        if (!key_exists($CustomerGroupId, $data['group_list'])) {
          $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
          $GroupCustomerList = array();
          if (!empty($group_customer_list)) {
            foreach ($group_customer_list as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);
              $RoRaVCIF['RoRa']     = 0;
              $RarocVCIF['Raroc'][$customer_row['VCIF']] = $this->DataTransaction_model->getRarocPerVCIF($customer_row['VCIF']);

              $GroupCustomerList[$customer_list] = array (
                'CustomerName'                   => $customer_row['CustomerName'],
                'VCIF'                           => $customer_row['VCIF'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'RoRaVCIF'                       => number_format($RoRaVCIF['RoRa']/VALUE_PER, 0),
                'RarocVCIF'                      => number_format($RarocVCIF['Raroc'][$customer_row['VCIF']]/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }

            // $RoRaGroup['RoRa'] = array_sum($RoRaVCIF['RoRa']);
            $RarocGroup['Raroc'] = array_sum($RarocVCIF['Raroc']);
          }

          $params['results'][$CustomerGroupId] = array(
            'CustomerGroupName'               => $group_row['CustomerGroupName'],
            'CustomerGroupId'                 => $CustomerGroupId,
            'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
            'RoRaGroup'                        => number_format($RoRaGroup['RoRa']/VALUE_PER, 0),
            'RarocGroup'                      => number_format($RarocGroup['Raroc']/VALUE_PER, 0),
            'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
            'Logo'                            => $group_row['Logo'],
            'GroupFHCalc'                     => $GroupFHCalc,
            'group_customer_list'             => $GroupCustomerList
          );
        }
      }

      $params['keyword_search_box'] = $keyword_search;
      $params['row'] = $rowno;

      if ($keyword_search != '') {
        $config['base_url'] = base_url() . 'performance/CustomerLeaderboard/search/'.$params['keyword_search_box'];
      } else {
        $config['base_url'] = base_url() . 'performance/CustomerLeaderboard/page';
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
    $params['search_box'] = ' style="display: none;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function page($rowno=0) {
    $this->checkModule();

    $params = array();
    $data = array(
          'group_list' => array()
    );

    $keyword_search = "";
    $keyword_search = ($this->input->post('keyword_search')) ? $this->input->post('keyword_search') : "";
    $limit_per_page = 5;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];
    
    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_box[''] = '--- All ---';
    foreach ($ukers as $uker) {
      $uker_search_box[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_box, '', ' class="form-control col-md-7 col-xs-12"');

    $params['keyword_search_box'] = urldecode(trim($keyword_search));

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList('');

    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
        $RoRaGroup['RoRa'] = 0;
        $RarocGroup['Raroc'] = 0;
        // $RarocGroup['Raroc'] = $this->DataTransaction_model->getRarocPerGroup($CustomerGroupId);

        $GroupIsMain = $this->AccountPlanningCalculate_model->getGroupIsMain($CustomerGroupId);

        $AccountPlanningId = 0;
        if (!empty($GroupIsMain['AccountPlanningId'])) {
          $AccountPlanningId = $GroupIsMain['AccountPlanningId'];
        }
        $GroupFHCalc = $this->AccountPlanningCalculate_model->getGroupFHCalcDetails($AccountPlanningId);
        $model5V = V5_FRAUD_CONSTANT + (V5_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V5_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V5_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V5_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V5_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3));
        $GroupFHCalc["Model5V"] = number_format($model5V, 3);
        
        $model8V = V8_FRAUD_CONSTANT + (V8_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V8_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V8_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V8_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V8_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3))
          - (V8_SGAI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGAI"], 3)) + (V8_TATA_FRAUD_CONSTANT * number_format($GroupFHCalc["TATA"], 3)) - (V8_LVGI_FRAUD_CONSTANT * number_format($GroupFHCalc["LIVIGI"], 3));
        $GroupFHCalc["Model8V"] = number_format($model8V, 3);

        if (!key_exists($CustomerGroupId, $data['group_list'])) {
          $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
          $GroupCustomerList = array();
          if (!empty($group_customer_list)) {
            foreach ($group_customer_list as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);
              $RoRaVCIF['RoRa']     = 0;
              $RarocVCIF['Raroc'][$customer_row['VCIF']] = $this->DataTransaction_model->getRarocPerVCIF($customer_row['VCIF']);

              $GroupCustomerList[$customer_list] = array (
                'CustomerName'                   => $customer_row['CustomerName'],
                'VCIF'                           => $customer_row['VCIF'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'RoRaVCIF'                       => number_format($RoRaVCIF['RoRa']/VALUE_PER, 0),
                'RarocVCIF'                      => number_format($RarocVCIF['Raroc'][$customer_row['VCIF']]/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }

            // $RoRaGroup['RoRa'] = array_sum($RoRaVCIF['RoRa']);
            $RarocGroup['Raroc'] = array_sum($RarocVCIF['Raroc']);
          }

          $params['results'][$CustomerGroupId] = array(
            'CustomerGroupName'               => $group_row['CustomerGroupName'],
            'CustomerGroupId'                 => $CustomerGroupId,
            'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
            'RoRaGroup'                       => number_format($RoRaGroup['RoRa']/VALUE_PER, 0),
            'RarocGroup'                      => number_format($RarocGroup['Raroc']/VALUE_PER, 0),
            'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
            'Logo'                            => $group_row['Logo'],
            'GroupFHCalc'                     => $GroupFHCalc,
            'group_customer_list'             => $GroupCustomerList
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'performance/CustomerLeaderboard/page';
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
    $this->load->view('performance/customer_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function search() {
   $this->checkModule();

    $params = array();
    $data = array(
          'group_list' => array()
    );

    $rowno = ($this->input->get('rowno')) ? $this->input->get('rowno') : 0;
    $keyword_search = ($this->input->get('keyword_search_box')) ? $this->input->get('keyword_search_box') : "";
    $uker_search = ($this->input->get('uker_search_box')) ? $this->input->get('uker_search_box') : "";

    $limit_per_page = 5;
    $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }


    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $params['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $params['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $params['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $params['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $params['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];    

    $ukers = $this->MonitoringAccountPlanning_model->get_ukers();
    $uker_search_field[''] = 'All';
    foreach ($ukers as $uker) {
      $uker_search_field[$uker['UnitKerjaId']] = $uker['Name'];
    }
    $params['uker_search_box'] = form_dropdown('uker_search_box', $uker_search_field, $uker_search, ' class="form-control col-md-7 col-xs-12"');

    $params['keyword_search_box'] = urldecode(trim($keyword_search));

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList($params['keyword_search_box']);

    if ($total_records > 0) {   
      $group_list = $this->TasklistDisposisi_model->getViewGroupList($limit_per_page, $rowno, $params['keyword_search_box']);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
        $RoRaGroup['RoRa'] = 0;
        $RarocGroup['Raroc'] = 0;
        // $RarocGroup['Raroc'] = $this->DataTransaction_model->getRarocPerGroup($CustomerGroupId);

        $GroupIsMain = $this->AccountPlanningCalculate_model->getGroupIsMain($CustomerGroupId);

        $AccountPlanningId = 0;
        if (!empty($GroupIsMain['AccountPlanningId'])) {
          $AccountPlanningId = $GroupIsMain['AccountPlanningId'];
        }
        $GroupFHCalc = $this->AccountPlanningCalculate_model->getGroupFHCalcDetails($AccountPlanningId);
        
        $model5V = V5_FRAUD_CONSTANT + (V5_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V5_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V5_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V5_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V5_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3));
        $GroupFHCalc["Model5V"] = number_format($model5V, 3);
        
        $model8V = V8_FRAUD_CONSTANT + (V8_DSRI_FRAUD_CONSTANT * number_format($GroupFHCalc["DSRI"], 3)) + (V8_GMI_FRAUD_CONSTANT * number_format($GroupFHCalc["GMI"], 3))
          + (V8_AQI_FRAUD_CONSTANT * number_format($GroupFHCalc["AQI"], 3)) + (V8_SGI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGI"], 3)) + (V8_DEPI_FRAUD_CONSTANT * number_format($GroupFHCalc["DEPI"], 3))
          - (V8_SGAI_FRAUD_CONSTANT * number_format($GroupFHCalc["SGAI"], 3)) + (V8_TATA_FRAUD_CONSTANT * number_format($GroupFHCalc["TATA"], 3)) - (V8_LVGI_FRAUD_CONSTANT * number_format($GroupFHCalc["LIVIGI"], 3));
        $GroupFHCalc["Model8V"] = number_format($model8V, 3);
        //echo json_encode($GroupFHCalc); die;

        if (!key_exists($CustomerGroupId, $data['group_list'])) {
          $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
          $GroupCustomerList = array();
          if (!empty($group_customer_list)) {
            foreach ($group_customer_list as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);
              $RoRaVCIF['RoRa']     = 0;
              $RarocVCIF['Raroc'][$customer_row['VCIF']] = $this->DataTransaction_model->getRarocPerVCIF($customer_row['VCIF']);

              $GroupCustomerList[$customer_list] = array (
                'CustomerName'                   => $customer_row['CustomerName'],
                'VCIF'                           => $customer_row['VCIF'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'RoRaVCIF'                       => number_format($RoRaVCIF['RoRa']/VALUE_PER, 0),
                'RarocVCIF'                      => number_format($RarocVCIF['Raroc'][$customer_row['VCIF']]/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }

            // $RoRaGroup['RoRa'] = array_sum($RoRaVCIF['RoRa']);
            $RarocGroup['Raroc'] = array_sum($RarocVCIF['Raroc']);
          }

          $params['results'][$CustomerGroupId] = array(
            'CustomerGroupName'               => $group_row['CustomerGroupName'],
            'CustomerGroupId'                 => $CustomerGroupId,
            'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
            'RoRaGroup'                        => number_format($RoRaGroup['RoRa']/VALUE_PER, 0),
            'RarocGroup'                      => number_format($RarocGroup['Raroc']/VALUE_PER, 0),
            'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
            'Logo'                            => $group_row['Logo'],
            'GroupFHCalc'                     => $GroupFHCalc,
            'group_customer_list'             => $GroupCustomerList
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'performance/CustomerLeaderboard/search?uker_search_box='.$uker_search.'&keyword_search_box='.urldecode($params['keyword_search_box']);
      // $config['base_url'] = base_url() . 'performance/CustomerLeaderboard/search/'.$params['keyword_search_box'];
      $config['page_query_string'] = TRUE;
      $config['query_string_segment'] = 'rowno';
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
    $params['search_box'] = ' style="display: block;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }

  public function details($VCIF) {
    $this->checkModule();
    $data = array();
    $data['link_export_simpanan'] = 'performance/CustomerLeaderboard/get_detail_Simpanan/'.$VCIF;
    $data['Simpanan'] = array();
    $data['Pinjaman'] = array();

    $data['details'] = $this->Leaderboard_model->getVCIFDetails($VCIF);
    $data['countSimpananVcif'] = $this->DataTransaction_model->countDetailSimpananVcif($VCIF);
    if ($data['countSimpananVcif']['NumRows'] <= 500) {
      $data['Simpanan'] = $this->DataTransaction_model->getDetailSimpananVcif($VCIF);
    }
    $data['Pinjaman'] = $this->DataTransaction_model->getDetailPinjamanVcif($VCIF);
    $data['Existing'] = $this->DataTransaction_model->getCpaExistingPerVCIF($VCIF);

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_leaderboard_details.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function get_detail_Simpanan($VCIF) {
    $this->checkModule();
    $this->load->library('excel');

    $data = array();

    $data['Simpanan'] = $this->DataTransaction_model->getDetailSimpananVcif($VCIF);

    // echo "<pre>";
    // print_r($data);
    // die();

    $this->excel->createSheet(NULL, 0);
    $this->excel->setActiveSheetIndex(0);

    $style_top = array(
              'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
                )
            );

    // Set title and Layout size
    $this->excel->getActiveSheet()->setTitle('Data Simpanan '.$VCIF);

    $this->excel->getActiveSheet()->mergeCells("A1:E1");
    $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
    $this->excel->getActiveSheet()->setCellValue("A1", 'Data Simpanan '.$VCIF);

    $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(5);  // No
    $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(15);  // CIF
    $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth(30);  // No Rekening
    $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth(30);  // Ratas Simpanan
    $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth(30);  // Total Simpanan

    $this->excel->getActiveSheet()->setCellValue("A3", "No");
    $this->excel->getActiveSheet()->setCellValue("B3", "CIF");
    $this->excel->getActiveSheet()->setCellValue("C3", "No Rekening");
    $this->excel->getActiveSheet()->setCellValue("D3", "Ratas Simpanan");
    $this->excel->getActiveSheet()->setCellValue("E3", "Total Simpanan");

    if (!empty($data['Simpanan'])) {
      $indexSimp = 1;
      $indexrow = 4;
      foreach ($data['Simpanan'] as $Simpanans => $Simpanan_row) :
        $this->excel->getActiveSheet()->setCellValue("A".$indexrow, $indexSimp);  // No
        $this->excel->getActiveSheet()->setCellValue("B".$indexrow, $Simpanan_row['Cif']);  // Cif
        $this->excel->getActiveSheet()->setCellValue("C".$indexrow, $Simpanan_row['NoRek']);  // NoRek
        $this->excel->getActiveSheet()->setCellValue("D".$indexrow, number_format($Simpanan_row['RatasSimpanan'], 0));  // RatasSimpanan
        $this->excel->getActiveSheet()->setCellValue("E".$indexrow, number_format($Simpanan_row['TotalSimpanan'], 0));  // TotalSimpanan

        $indexSimp++;
        $indexrow++;
      endforeach;
    }

    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="data_simpanan_'.$VCIF.'_'.date('Ymd_His').'.xls"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    // In use Excel5 / Office 2003
    // If you want to support MS Excel 2007, change it into 'Excel2007' and adjust filename extension and mimpe type header
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');

    exit();
  }

}

?>
