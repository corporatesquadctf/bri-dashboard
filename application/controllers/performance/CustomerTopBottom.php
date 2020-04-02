<?php 

class CustomerTopBottom extends MY_Controller {

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

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function view($sort='DESC') {
    $this->checkModule();

    $params = array();
    $data = array(
          'group_list' => array()
    );

    $limit_per_page = 15;
    $sort_by = ($this->input->get('sort_by')) ? $this->input->get('sort_by') : "TotalSimpanan";
    $rowno = ($this->input->get('rowno')) ? $this->input->get('rowno') : 0;

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
    
    $sort_by_box = array(
      'TotalSimpanan'     => 'Total Simpanan'
      , 'RatasSimpanan'   => 'Ratas Simpanan'
      , 'TotalPinjaman'   => 'Total Pinjaman'
      , 'RatasPinjaman'   => 'Ratas Pinjaman'
      // , 'Rora'            => 'Rora'
      // , 'Raroc'           => 'Raroc'
      , 'Cpa'             => 'Current CPA'
    );
    $params['sort_by_box'] = form_dropdown('sort_by', $sort_by_box, $sort_by, ' class="form-control col-md-7 col-xs-12"');
    $params['sort_by'] = $sort_by;
    $params['sort'] = $sort;

    $total_records = $this->TasklistDisposisi_model->getTotalViewGroupList('');

    if ($total_records > 0) {   
      $group_list = $this->Leaderboard_model->getViewCustomerTopBottomList($limit_per_page, $rowno, $sort_by, $sort);

      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];

        $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
        $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
        $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
        $RoRaGroup['RoRa'] = 0;
        $RarocGroup['Raroc'] = 0;

        if (!key_exists($CustomerGroupId, $data['group_list'])) {
          $group_customer_list = $this->TasklistDisposisi_model->getGroupCustomerList($CustomerGroupId);
          $GroupCustomerList = array();
          if (!empty($group_customer_list)) {
            foreach ($group_customer_list as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);
              $RoRaVCIF['RoRa']     = 0;
              $RarocVCIF['Raroc'] = 0;

              $GroupCustomerList[$customer_list] = array (
                'CustomerName'                   => $customer_row['CustomerName'],
                'VCIF'                           => $customer_row['VCIF'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'RoRaVCIF'                       => number_format($RoRaVCIF['RoRa']/VALUE_PER, 0),
                'RarocVCIF'                      => number_format($RarocVCIF['Raroc']/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }
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
            'group_customer_list'             => $GroupCustomerList
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'performance/CustomerTopBottom/view/'.$sort.'?sort_by='.$sort_by;
      $config['page_query_string'] = TRUE;
      $config['query_string_segment'] = 'rowno';
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

    // echo "<pre>";
    // print_r($params);
    // die();

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_topbottom.php', $params);
    $this->load->view('layout/footer.php');
  }
/*
  public function details($VCIF) {
    $this->checkModule();
    $data = array();
    // $data['VCIF'] = $VCIF;
    $data['details'] = $this->Leaderboard_model->getVCIFDetails($VCIF);
    $data['LastSimpanan'] = $this->DataTransaction_model->getLastDataSimpananVcif($VCIF);
    $data['LastPinjaman'] = $this->DataTransaction_model->getLastDataPinjamanVcif($VCIF);
    $data['Simpanan'] = $this->DataTransaction_model->getDetailSimpananVcif($VCIF);
    $data['Pinjaman'] = $this->DataTransaction_model->getDetailPinjamanVcif($VCIF);
    $data['Existing'] = $this->DataTransaction_model->getCpaExistingPerVCIF($VCIF);

    // echo "<pre>";
    // print_r($data);
    // die();


    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_topbottom_details.php', $data);
    $this->load->view('layout/footer.php');
  }
*/  
}

?>
