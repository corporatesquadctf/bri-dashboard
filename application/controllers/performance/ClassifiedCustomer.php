<?php 

class ClassifiedCustomer extends MY_Controller {

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

  public function view($ClassificationId=1) {
    $this->checkModule();

    $data = array();
    $data['ClassificationId'] = $ClassificationId;

    $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
    $data['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];
    $data['ratasPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['ratas'];
    $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
    $data['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
    $data['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];
    $cpaLastUpdateDate = $this->DataTransaction_model->getCpaLastUpdateDate();
    $data['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];

    $data['Classification'] = $this->Leaderboard_model->getClassification();
    $data['countCustomerGroupClassification'] = $this->Leaderboard_model->countCustomerGroupClassification();
    
    $group_list = $this->Leaderboard_model->getCustomerGroupByClassification($ClassificationId);
    foreach ($group_list as $group_row) {
      $CustomerGroupId = $group_row['CustomerGroupId'];

      $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
      $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
      $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
      $RoRaGroup['RoRa'] = 0;
      $RarocGroup['Raroc'] = 0;

      $data['results'][$CustomerGroupId] = array(
        'CustomerGroupName'               => $group_row['CustomerGroupName'],
        'CustomerGroupId'                 => $CustomerGroupId,
        'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
        'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
        'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
        'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
        'RoRaGroup'                       => number_format($RoRaGroup['RoRa']/VALUE_PER, 0),
        'RarocGroup'                      => number_format($RarocGroup['Raroc']/VALUE_PER, 0),
        'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
        'Logo'                            => $group_row['Logo']
      );
    }

    // print_r($data['results']);

    $data['search_box'] = ' style="display: none;"';

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/customer_classified.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function details($ClassificationId) {
    $this->checkModule();

    $data = array();
    
    $group_list = $this->Leaderboard_model->getCustomerGroupByClassification($ClassificationId);
    foreach ($group_list as $group_row) {
      $CustomerGroupId = $group_row['CustomerGroupId'];

      $pinjamanGroup = $this->DataTransaction_model->getLastDataPinjamanGroup($CustomerGroupId);
      $simpananGroup = $this->DataTransaction_model->getLastDataSimpananGroup($CustomerGroupId);
      $cpaGroup = $this->DataTransaction_model->getLastDataCpaGroup($CustomerGroupId);
      $RoRaGroup['RoRa'] = 0;
      $RarocGroup['Raroc'] = 0;

      $data['results'][$CustomerGroupId] = array(
        'CustomerGroupName'               => $group_row['CustomerGroupName'],
        'CustomerGroupId'                 => $CustomerGroupId,
        'PinjamanTotalGroup'              => number_format($pinjamanGroup['TotalPinjaman']/VALUE_PER, 0),
        'PinjamanRatasGroup'              => number_format($pinjamanGroup['RatasPinjaman']/VALUE_PER, 0),
        'SimpananTotalGroup'              => number_format($simpananGroup['TotalSimpanan']/VALUE_PER, 0),
        'SimpananRatasGroup'              => number_format($simpananGroup['RatasSimpanan']/VALUE_PER, 0),
        'RoRaGroup'                       => number_format($RoRaGroup['RoRa']/VALUE_PER, 0),
        'RarocGroup'                      => number_format($RarocGroup['Raroc']/VALUE_PER, 0),
        'CurrentCPAGroup'                 => number_format($cpaGroup['Cpa']/VALUE_PER, 0),
        'Logo'                            => $group_row['Logo']
      );
    }

    $this->load->view('performance/customer_classified_details.php', $data);

  }
}

?>
