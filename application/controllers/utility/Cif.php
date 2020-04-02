<?php 

class Cif extends MY_Controller {

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

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index($rowno=0) {
    $this->checkModule();

    $data = array(
          'cif_list' => array()
    );

    if (empty($txtcari)) {
      $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
    }
    else {
      $txtcari = str_replace('_', ' ', $txtcari);
    }

    $limit_per_page = 10;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $total_records = $this->Utility_model->getTotalViewCifLists($txtcari);

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $params = array();
    $params['txtcari'] = trim(str_replace(' ', '_', $txtcari));
    if ($total_records > 0) {   
      $cif_list = $this->Utility_model->getViewCifLists($limit_per_page, $rowno, $txtcari);
      $params['vcif_list'] = $this->Utility_model->getViewVcifList();

      foreach ($cif_list as $cif_row) {
        $CIF = $cif_row['CIF'];
        if (!key_exists($CIF, $data['cif_list'])) {

          $params['results'][$CIF] = array(
            'CIF'                 => $CIF,
            'VCIF'                => $cif_row['VCIF'],
            'CompanyName'         => $cif_row['CompanyName'],
            'IsActive'            => $cif_row['IsActive'],
            'CustomerGroupName'   => $cif_row['CustomerGroupName'],
            'CustomerName'        => $cif_row['CustomerName']
          );
        }
      }
      // echo "<pre>";
      // print_r($params['results']);

      $params['txtcari'] = $txtcari;
      $params['row'] = $rowno;
      $params['total_records'] = $total_records;

      if ($txtcari != '') {
        $config['base_url'] = base_url() . 'Utility/Cif/search_result/'.$params['txtcari'];
      } else {
        $config['base_url'] = base_url() . 'Utility/Cif/page';
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
    // echo "<pre>";
    // print_r($params);

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/cif_list.php', $params);
    $this->load->view('layout/footer.php');

  }

  public function page($rowno=0) {
    // $this->checkModule();

    $data = array(
          'cif_list' => array()
    );

    if (empty($txtcari)) {
      $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
    }
    else {
      $txtcari = str_replace('_', ' ', $txtcari);
    }

    $limit_per_page = 10;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $total_records = $this->Utility_model->getTotalViewCifLists($txtcari);

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $params = array();
    $params['txtcari'] = trim(str_replace(' ', '_', $txtcari));
    if ($total_records > 0) {   
      $cif_list = $this->Utility_model->getViewCifLists($limit_per_page, $rowno, $txtcari);
      $params['vcif_list'] = $this->Utility_model->getViewVcifList();

      foreach ($cif_list as $cif_row) {
        $CIF = $cif_row['CIF'];
        if (!key_exists($CIF, $data['cif_list'])) {

          $params['results'][$CIF] = array(
            'CIF'                 => $CIF,
            'VCIF'                => $cif_row['VCIF'],
            'CompanyName'         => $cif_row['CompanyName'],
            'IsActive'            => $cif_row['IsActive'],
            'CustomerGroupName'   => $cif_row['CustomerGroupName'],
            'CustomerName'        => $cif_row['CustomerName']
          );
        }
      }

      $params['txtcari'] = $txtcari;
      $params['row'] = $rowno;

      if ($txtcari != '') {
        $config['base_url'] = base_url() . 'Utility/Cif/search_result/'.$params['txtcari'];
      } else {
        $config['base_url'] = base_url() . 'Utility/Cif/page';
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
    $this->load->view('utility/cif_list.php', $params);
    $this->load->view('layout/footer.php');

  }

  public function search_result($txtcari = '', $rowno=0) {
    // $this->checkModule();

    $data = array(
          'cif_list' => array()
    );

    if (empty($txtcari)) {
      $txtcari = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
      if (empty($this->input->post('txtcari'))) {
        redirect('utility/Cif');
      }
    }
    else {
      $txtcari = str_replace('_', ' ', $txtcari);
    }

    $limit_per_page = 10;
    $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    $total_records = $this->Utility_model->getTotalViewCifLists($txtcari);

    if($rowno != 0){
      $rowno = ($rowno-1) * $limit_per_page;
    }
    $params = array();
    $params['txtcari'] = trim(str_replace(' ', '_', $txtcari));
    if ($total_records > 0) {   
      $cif_list = $this->Utility_model->getViewCifLists($limit_per_page, $rowno, $txtcari);
      $params['vcif_list'] = $this->Utility_model->getViewVcifList();

      foreach ($cif_list as $cif_row) {
        $CIF = $cif_row['CIF'];
        if (!key_exists($CIF, $data['cif_list'])) {

          $params['results'][$CIF] = array(
            'CIF'                 => $CIF,
            'VCIF'                => $cif_row['VCIF'],
            'CompanyName'         => $cif_row['CompanyName'],
            'IsActive'            => $cif_row['IsActive'],
            'CustomerGroupName'   => $cif_row['CustomerGroupName'],
            'CustomerName'        => $cif_row['CustomerName']
          );
        }
      }

      $params['txtcari'] = $txtcari;
      $params['row'] = $rowno;

      $config['base_url'] = base_url() . 'Utility/Cif/search_result/'.$params['txtcari'];
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
    $this->load->view('utility/cif_list.php', $params);
    $this->load->view('layout/footer.php');

  }

  public function getDetails($CIF) {
    $this->checkModule();
    $result = $this->Utility_model->getViewCifDetails($CIF);
    echo json_encode($result);
  }

  public function set_status($CIF, $IsActive) {
    // $this->checkModule();

    $IsActive_val = 1;
    if ($IsActive == 1) {
      $IsActive_val = 0;
    }

    $data_edit = array (
      'IsActive'                 => $IsActive_val
      , 'ModifiedDate'           => $this->current_datetime
      , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
      );

    $result = $this->TasklistAccountPlanning_model->updateData('DetailCustomerKorporasi', $data_edit, 'CIF', $CIF);

    if($result['status'] == 'error') {
      echo "failed";
    }
    else {
      echo "success";
    }
  }

  public function cif_proc() {
    $this->checkModule();

    // echo "<pre>";
    // print_r($this->input->post());
    // die();

    $VCIF = $this->input->post('VCIF');
    if ($this->input->post('NewGroup') == 1) {
      $data_input_group = array (
        'Name'                    => trim($this->input->post('CustomerGroupName'))
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

      $VCIF = $this->TasklistAccountPlanning_model->insertDataGetInputedId('CustomerKorporasi', $data_input_group);
    }

    if ($this->input->post('IsCIFRemapping') == 1) {
      if ($VCIF != $this->input->post('oldVCIF')) {
        if ($this->input->post('IsActive') == 1) {
          $result_error = array(
              'status' => 'modal'
              , 'message' => 'CIF cannot remapped to another VCIF. <br><br>Set CIF Status to Inactive First.'
          );
          echo json_encode($result_error);
          exit();
        }
        else {
          $result_confirmation = array(
              'status' => 'confirms'
              , 'message' => "Your'e about to Move ".$this->input->post('CIF')." From ".$this->input->post('oldVCIF')." to ".$VCIF
          );
          echo json_encode($result_confirmation);
          exit();
        }
      }
    }

    if ($this->input->post('submit_type_cif') == 'add') {
      $data_input = array (
        'CIF'                     => trim($this->input->post('CIF'))
        //, 'Name'                  => trim($this->input->post('NameCIF'))
        , 'VCIF'                  => $VCIF
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input);
    }
    else if ($this->input->post('submit_type_cif') == 'edit') {
      $data_edit = array (
        'CIF'                      => trim($this->input->post('CIF'))
        //, 'Name'                   => trim($this->input->post('NameCIF'))
        , 'VCIF'                   => $VCIF
        , 'ModifiedDate'           => $this->current_datetime
        , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->updateData('DetailCustomerKorporasi', $data_edit, 'CIF', $this->input->post('CIF'));
      if ($VCIF != $this->input->post('oldVCIF')) {
          $result_mapping = array(
              'status_remapping' => 'success'
              , 'remapping_message' => "".$this->input->post('CIF')." success moved from ".$this->input->post('oldVCIF')." to ".$VCIF
          );
      }
    }

    if(isset($result)) {
      if(isset($result_mapping)) {
        echo json_encode(array_merge($result, $result_mapping));
      }
      else {
        echo json_encode($result);
      }
    }

  }
/*
  public function cif_proc() {
    $this->checkModule();
    
    if ($this->input->post('submit_type_cif') == 'add') {
      foreach ($this->input->post('CIF') as $key => $value) {
        if (!empty($value)) {
          $data_input[$key] = array (
            'CIF'                     => trim($value)
            , 'CIF'                  => $this->input->post('CIF')
            , 'Name'                  => trim($this->input->post('NameCIF')[$key])
            , 'CreatedDate'           => $this->current_datetime
            , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
            );

          $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input[$key]);
        }
      }
    }

    // echo print_r($result);
    if(isset($result)) {
      echo json_encode($result);
    }

  }
*/
  public function download_mass_upload_cif($cif) {
    $this->checkModule();
    $this->load->library('excel');

    $this->excel->createSheet(NULL, 0);
    $this->excel->setActiveSheetIndex(0);

    $style_top = array(
              'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
                )
            );
        
    // Set title and Layout size
    $this->excel->getActiveSheet()->setTitle('Mass Upload CIF');

    $this->excel->getActiveSheet()->mergeCells("B1:I1");
    $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
    $this->excel->getActiveSheet()->setCellValue("A1", "Keterangan Mapping");
    $this->excel->getActiveSheet()->setCellValue("B1", "* Isikan CIF secara berurutan kebawah pada kolom CIF.");

    $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(30);  // CIF

    $this->excel->getActiveSheet()->setCellValue("A3", "CIF");

    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="Mass_Upload_CIF_'.date('Ymd_His').'.xls"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    // In use Excel5 / Office 2003
    // If you want to support MS Excel 2007, change it into 'Excel2007' and adjust filename extension and mimpe type header
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');

    exit();
  }

  public function mass_upload_cif($CIF) {
    $this->checkModule();
    $data = NULL;
    $data['CIF'] = $CIF;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/mass_upload_cif', $data);
    $this->load->view('layout/footer.php');
  }

  public function uploaded_mass_input_cif() {
    $this->checkModule();
    $this->load->library('excel');
    $data['CIF'] = $this->input->post('CIF');

    if (!empty($_FILES['file_cif']['name'])) {

      try{
        $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_cif']['tmp_name']);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $this->excel = $objPHPExcel->getSheet(0);

        $highestRow = $this->excel->getHighestRow(); // e.g. 10
        $highestColumn = $this->excel->getHighestColumn(); // e.g 'F'
        
        $ctr_success = 0;
        $ctr_failure = 0;
        $ctr_all = 0;
        $content = array();
        $counter = 0;
        for($i=4; $i <= $highestRow; $i++) {
          $data['isCIFExist'][$counter] = $this->Utility_model->isCIFExist(trim($this->excel->getCell("A".$i)->getValue()));

          $content[$counter]['cif'] = $this->excel->getCell("A".$i)->getValue();
          $content[$counter]['valid'] = true;
          $content[$counter]['message'] = "";

          if(empty(trim($this->excel->getCell("A".$i)))) {
            $content[$counter]['valid'] = false;
            $content[$counter]['message'] = "CIF belum diisi.\n";
          } 

          if(!empty($data['isCIFExist'][$counter])) {
            $content[$counter]['valid'] = false;
            $content[$counter]['message'] = "CIF sudah terdaftar.\n";
          } 

          if($content[$counter]['valid']) {
            $ctr_success++;
          } else {
            $ctr_failure++;
          }
          $ctr_all++;
          $counter++;
        }

        $data['filename'] = $_FILES['file_cif']['name'];
        $data['ctr_success'] = $ctr_success;
        $data['ctr_failure'] = $ctr_failure;
        $data['ctr_all'] = $ctr_all;
        $data['content'] = $content;
        
        $data['result'] = true;
        $data['result_message'] = "Berhasil parsing";

        // echo "<pre>";
        // print_r($data);
        // die();
      } 
      catch (Exception $e) {
          $data['result'] = false;
          $data['result_message'] = $e->getMessage();
      }
    }
    else {
      $data['result'] = false;
      $data['result_message'] = "File CIF belum dipilih.";
    }

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/uploaded_mass_input_cif', $data);
    $this->load->view('layout/footer.php');
  }

  public function save_uploaded_mass_upload_cif() {
    $this->checkModule();
    // echo "<pre>";
    // print_r($this->input->post());
    // die();
    if(!empty($this->input->post('CIF')) && $this->input->post('filename') && $this->input->post('summary')) {
      foreach ($this->input->post('cif') as $key => $value) {
        if (!empty($value)) {
          $data_input[$key] = array (
            'CIF'                     => trim($value)
            , 'CIF'                  => $this->input->post('CIF')
            , 'Name'                  => trim($this->input->post('NameCIF')[$key])
            , 'CreatedDate'           => $this->current_datetime
            , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
            );

          $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input[$key]);
        }
        else{
          $result = array('status' => 'error', 'message' => 'CIF empty.');
        }
      }
    } else {
      $result = array('status' => 'error', 'message' => 'Parameter tidak lengkap');
    }
    echo json_encode($result);
  }

}

?>
