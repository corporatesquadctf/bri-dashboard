<?php 

class Group extends MY_Controller {

  function __construct() {
      parent::__construct();
      $this->load->helper(array(
          'form',
          'url',
          'security'
      ));
      $this->load->library(array(
          'session',
          'pagination'
      ));
      $this->load->model('Utility_model');
      $this->load->model('TasklistAccountPlanning_model');
      $this->load->model('Leaderboard_model');

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index() {
    $this->checkModule();

    $data = array();
    $group_list = $this->Utility_model->getViewGroupList();
    $data['classification_list'] = $this->Leaderboard_model->getClassification();
    $data['CustomerType_list'] = $this->Utility_model->getCustomerType();

    if (!empty($group_list)) {
      foreach ($group_list as $group_row) {
        $CustomerGroupId = $group_row['CustomerGroupId'];
        $group_customer_list = $this->Utility_model->getGroupCustomerList($CustomerGroupId);
        $CreatedDate = '';
        if (!empty($group_row['CreatedDate'])) {
          $CreatedDates = new DateTime(date('Y-m-d H:i:s'));
          $CreatedDate = $CreatedDates->format('j M y H:i');
        }
        $ModifiedDate = '';
        if (!empty($group_row['ModifiedDate'])) {
          $ModifiedDates = new DateTime(date('Y-m-d H:i:s'));
          $ModifiedDate = $ModifiedDates->format('j M y H:i');
        }

        $data['results'][$CustomerGroupId] = array(
          'CustomerGroupId'                 => $CustomerGroupId,
          'CustomerGroupName'               => $group_row['CustomerGroupName'],
          'Logo'                            => $group_row['Logo'],
          'ClassificationId'                => $group_row['ClassificationId'],
          'CustomerClassificationName'      => $group_row['CustomerClassificationName'],
          'CustomerTypeId'                  => $group_row['CustomerTypeId'],
          'CustomerTypeName'                => $group_row['CustomerTypeName'],
          'CreatedDate'                     => $CreatedDate,
          'CreatedBy'                       => $group_row['CreatedBy'],
          'ModifiedDate'                    => $ModifiedDate,
          'ModifiedBy'                      => $group_row['ModifiedBy'],
          'group_customer_list'             => $group_customer_list
        );
      }
    }

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/group_list.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function create_group() {
    $this->checkModule();
    $data = array();

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/create_group.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function getDetails($CustomerGroupId) {
    $this->checkModule();
    $result = $this->Utility_model->getViewGroupDetails($CustomerGroupId);
    echo json_encode($result);
  }

  public function group_proc() {
    $this->checkModule();

    if ($this->input->post('Name') == '') {
        $result_error = array(
            'status' => 'error'
            , 'message' => 'Group Name cannot empty'
        );
        echo json_encode($result_error);
        exit();
    }

    if ($this->input->post('submit_type') == 'add') {
      $isGroupExist = $this->Utility_model->isGroupExist(trim($this->input->post('Name')));
      if (!empty($isGroupExist['CustomerGroupId'])) {
          $result_error = array(
              'status' => 'error'
              , 'message' => 'Group already exist.'
          );
          echo json_encode($result_error);
          exit();
      }

      $data_input = array (
        'Name'                    => trim($this->input->post('Name'))
        , 'Description'           => trim($this->input->post('Description'))
        , 'ClassificationId'      => trim($this->input->post('ClassificationId'))
        , 'CustomerTypeId'        => trim($this->input->post('CustomerTypeId'))
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->insertData('CustomerGroup', $data_input);
    }
    else if ($this->input->post('submit_type') == 'edit') {
      $data_edit = array (
        'Name'                     => trim($this->input->post('Name'))
        , 'Description'            => trim($this->input->post('Description'))
        , 'ClassificationId'       => trim($this->input->post('ClassificationId'))
        , 'CustomerTypeId'        => trim($this->input->post('CustomerTypeId'))
        , 'ModifiedDate'           => $this->current_datetime
        , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->updateData('CustomerGroup', $data_edit, 'CustomerGroupId', $this->input->post('CustomerGroupId'));
    }

    if(isset($result)) {
      echo json_encode($result);
    }
  }

  public function upload_proc() {
    $this->checkModule();
    $config['upload_path']          = './uploads/CustomerGroupLogo/';
    $config['allowed_types']        = 'gif|jpg|jpeg|png';
    $config['max_size']             = 5000;
    $config['file_ext_tolower']     = true;
    $config['encrypt_name']         = true;
    $config['max_width']            = 1024;//500; 
    $config['max_height']           = 1024;//500; 

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('logo_group')) {
      $error = array($this->upload->display_errors());
      $result_error = array(
          'status' => 'error'
          , 'message' => $error
      );
      echo json_encode($result_error);
      exit();
    }
    else {
      $oldLogo = $this->input->post('oldLogo');
      if (!empty($oldLogo)) {
        $filename = $config['upload_path'].$oldLogo;
        if ( file_exists ($filename) ) unlink ($filename);
      }
      $data_insertLogo = array (
        'Logo'     => $this->upload->data('file_name')
      );

      $result = $this->Utility_model->insertLogoToGroup($this->input->post('CustomerGroupId'), $data_insertLogo);
      echo json_encode($result);
      exit();
    }
  }

  public function vcif_proc() {
    $this->checkModule();

    if ($this->input->post('NameVCIF') == '') {
        $result_error = array(
            'status' => 'error'
            , 'message' => 'VCIF Name cannot empty'
        );
        echo json_encode($result_error);
        exit();
    }
    
    $isCustomerExist = $this->Utility_model->isCustomerExist(trim($this->input->post('NameVCIF')));
    if (!empty($isCustomerExist['VCIF'])) {
        $result_error = array(
            'status' => 'error'
            , 'message' => 'Customer already exist.'
        );
        echo json_encode($result_error);
        exit();
    }
    
    if ($this->input->post('submit_type_vcif') == 'add') {
      $VCIF = $this->Utility_model->generateVcif();
      $data_input = array (
        'VCIF'                    => $VCIF
        , 'CustomerGroupId'       => $this->input->post('CustomerGroupId')
        , 'Name'                  => trim($this->input->post('NameVCIF'))
        , 'Description'           => trim($this->input->post('DescriptionVCIF'))
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->insertData('CustomerKorporasi', $data_input);
    }

    if(isset($result)) {
      echo json_encode($result);
    }

  }


}

?>
