<?php 

class RmLeaderboard extends MY_Controller {

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

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index($rowno=0) {
    $this->checkModule();

    $params = array();
    $data = array(
          'rmusers' => array()
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

    $total_records = $this->Leaderboard_model->getTotalViewRmLeaderboard($keyword_search);

    if ($total_records > 0) {   
      $rmusers = $this->Leaderboard_model->getViewRmLeaderboard($limit_per_page, $rowno, $keyword_search);
      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['UserId'];

        $pinjamanPerRM = $this->DataTransaction_model->getLastDataPinjamanPerRM($rm_id);
        $simpananPerRM = $this->DataTransaction_model->getLastDataSimpananPerRM($rm_id);
        $cpaPerRM = $this->DataTransaction_model->getLastDataCpaPerRM($rm_id);

        if (!key_exists($rm_id, $data['rmusers'])) {
          // $AccountPlanningList = $this->Leaderboard_model->getAccountPlanningList($rm_id);
          $AccountPlanningList = $this->Leaderboard_model->getVCIFPerRM($rm_id);
          $VCIFPerUserId = array();
          if (!empty($AccountPlanningList)) {
            foreach ($AccountPlanningList as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);

              $VCIFPerUserId[$customer_list] = array (
                'GroupName'                      => $customer_row['GroupName'],
                'CustomerName'                   => $customer_row['CustomerName'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }
          }

          $params['results'][$rm_id] = array(
            'RmName'                      => $rmuser['RmName'],
            'PersonalNumber'              => $rm_id,
            'ProfilePicture'              => $rmuser['ProfilePicture'],
            'UnitKerja'                   => $rmuser['UnitKerja'],
            'VCIFPerUserId'               => $VCIFPerUserId,
            'PinjamanTotalPerRM'          => number_format($pinjamanPerRM['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasPerRM'          => number_format($pinjamanPerRM['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalPerRM'          => number_format($simpananPerRM['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasPerRM'          => number_format($simpananPerRM['RatasSimpanan']/VALUE_PER, 0),
            'CurrentCPAPerRM'             => number_format($cpaPerRM['Cpa']/VALUE_PER, 0),
            'LastAccess'                  => $rmuser['LastAccess']
          );
        }
      }

      $params['keyword_search_box'] = $keyword_search;
      $params['row'] = $rowno;

      if ($keyword_search != '') {
        $config['base_url'] = base_url() . 'performance/RmLeaderboard/search/'.$params['keyword_search_box'];
      } else {
        $config['base_url'] = base_url() . 'performance/RmLeaderboard/page';
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
    $this->load->view('performance/rm_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function page($rowno=0) {
    $this->checkModule();

    $params = array();
    $data = array(
          'rmusers' => array()
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

    $total_records = $this->Leaderboard_model->getTotalViewRmLeaderboard();

    if ($total_records > 0) {   
      $rmusers = $this->Leaderboard_model->getViewRmLeaderboard($limit_per_page, $rowno, $keyword_search);
      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['UserId'];

        $pinjamanPerRM = $this->DataTransaction_model->getLastDataPinjamanPerRM($rm_id);
        $simpananPerRM = $this->DataTransaction_model->getLastDataSimpananPerRM($rm_id);
        $cpaPerRM = $this->DataTransaction_model->getLastDataCpaPerRM($rm_id);

        if (!key_exists($rm_id, $data['rmusers'])) {
          // $AccountPlanningList = $this->Leaderboard_model->getAccountPlanningList($rm_id);
          $AccountPlanningList = $this->Leaderboard_model->getVCIFPerRM($rm_id);
          $VCIFPerUserId = array();
          if (!empty($AccountPlanningList)) {
            foreach ($AccountPlanningList as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);

              $VCIFPerUserId[$customer_list] = array (
                'GroupName'                      => $customer_row['GroupName'],
                'CustomerName'                   => $customer_row['CustomerName'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }
          }

          $params['results'][$rm_id] = array(
            'RmName'                      => $rmuser['RmName'],
            'PersonalNumber'              => $rm_id,
            'ProfilePicture'              => $rmuser['ProfilePicture'],
            'UnitKerja'                   => $rmuser['UnitKerja'],
            'VCIFPerUserId'               => $VCIFPerUserId,
            'PinjamanTotalPerRM'          => number_format($pinjamanPerRM['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasPerRM'          => number_format($pinjamanPerRM['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalPerRM'          => number_format($simpananPerRM['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasPerRM'          => number_format($simpananPerRM['RatasSimpanan']/VALUE_PER, 0),
            'CurrentCPAPerRM'             => number_format($cpaPerRM['Cpa']/VALUE_PER, 0),
            'LastAccess'                  => $rmuser['LastAccess']
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'performance/RmLeaderboard/page';
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
    $this->load->view('performance/rm_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }
  
  public function search() {
   $this->checkModule();

    $params = array();
    $data = array(
          'rmusers' => array()
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

    $total_records = $this->Leaderboard_model->getTotalViewRmLeaderboard($params['keyword_search_box'], $uker_search);

    if ($total_records > 0) {   
      $rmusers = $this->Leaderboard_model->getViewRmLeaderboard($limit_per_page, $rowno, $params['keyword_search_box'], $uker_search);
      foreach ($rmusers as $rmuser) {
        $rm_id = $rmuser['UserId'];

        $pinjamanPerRM = $this->DataTransaction_model->getLastDataPinjamanPerRM($rm_id);
        $simpananPerRM = $this->DataTransaction_model->getLastDataSimpananPerRM($rm_id);
        $cpaPerRM = $this->DataTransaction_model->getLastDataCpaPerRM($rm_id);

        if (!key_exists($rm_id, $data['rmusers'])) {
          // $AccountPlanningList = $this->Leaderboard_model->getAccountPlanningList($rm_id);
          $AccountPlanningList = $this->Leaderboard_model->getVCIFPerRM($rm_id);
          $VCIFPerUserId = array();
          if (!empty($AccountPlanningList)) {
            foreach ($AccountPlanningList as $customer_list => $customer_row) {
              $pinjamanVCIF = $this->DataTransaction_model->getLastDataPinjamanVcif($customer_row['VCIF']);
              $simpananVCIF = $this->DataTransaction_model->getLastDataSimpananVcif($customer_row['VCIF']);
              $cpaVCIF = $this->DataTransaction_model->getLastDataCpaVcif($customer_row['VCIF']);

              $VCIFPerUserId[$customer_list] = array (
                'GroupName'                      => $customer_row['GroupName'],
                'CustomerName'                   => $customer_row['CustomerName'],
                'PinjamanTotalVCIF'              => number_format($pinjamanVCIF['TotalPinjaman']/VALUE_PER, 0),
                'PinjamanRatasVCIF'              => number_format($pinjamanVCIF['RatasPinjaman']/VALUE_PER, 0),
                'SimpananTotalVCIF'              => number_format($simpananVCIF['TotalSimpanan']/VALUE_PER, 0),
                'SimpananRatasVCIF'              => number_format($simpananVCIF['RatasSimpanan']/VALUE_PER, 0),
                'CurrentCPAVCIF'                 => number_format($cpaVCIF['Cpa']/VALUE_PER, 0)
              );
            }
          }

          $params['results'][$rm_id] = array(
            'RmName'                      => $rmuser['RmName'],
            'PersonalNumber'              => $rm_id,
            'ProfilePicture'              => $rmuser['ProfilePicture'],
            'UnitKerja'                   => $rmuser['UnitKerja'],
            'VCIFPerUserId'               => $VCIFPerUserId,
            'PinjamanTotalPerRM'          => number_format($pinjamanPerRM['TotalPinjaman']/VALUE_PER, 0),
            'PinjamanRatasPerRM'          => number_format($pinjamanPerRM['RatasPinjaman']/VALUE_PER, 0),
            'SimpananTotalPerRM'          => number_format($simpananPerRM['TotalSimpanan']/VALUE_PER, 0),
            'SimpananRatasPerRM'          => number_format($simpananPerRM['RatasSimpanan']/VALUE_PER, 0),
            'CurrentCPAPerRM'             => number_format($cpaPerRM['Cpa']/VALUE_PER, 0),
            'LastAccess'                  => $rmuser['LastAccess']
          );
        }
      }

      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'performance/RmLeaderboard/search?uker_search_box='.$uker_search.'&keyword_search_box='.urldecode($params['keyword_search_box']);
      // $config['base_url'] = base_url() . 'performance/RmLeaderboard/search/'.$params['keyword_search_box'];
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
    $this->load->view('performance/rm_leaderboard.php', $params);
    $this->load->view('layout/footer.php');
  }
}

?>
