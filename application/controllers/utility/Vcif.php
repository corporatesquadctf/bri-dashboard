<?php 

class Vcif extends MY_Controller {

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
      $this->load->model('PerformanceAccountPlanning_model');
      $this->load->model('TasklistAccountPlanning_model');

      $current_datetime = new DateTime(date('Y-m-d H:i:s'));
      $this->current_year = $current_datetime->format('Y');
      $this->current_date = $current_datetime->format('Y-m-d');
      $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
  }

  public function index() {
    $this->checkModule();

    $data = array();
    $vcif_list = $this->Utility_model->getViewVcifList();
    $data['group_list'] = $this->Utility_model->getViewGroupList();

    if (!empty($vcif_list)) {
      foreach ($vcif_list as $vcif_row) {
        $VCIF = $vcif_row['VCIF'];
        $isVCIFMainAP = $this->Utility_model->isVCIFMainAP($VCIF);

        $IsMain = $vcif_row['IsMain'];
        if (empty($vcif_row['IsMain'])) {
          $IsMain = 0;
        }

        $data['results'][$VCIF] = array(
          'VCIF'                 => $VCIF,
          'CustomerName'         => $vcif_row['CustomerName'],
          'isVCIFMainAP'         => $isVCIFMainAP['IsMain'],
          'AccountPlanningId'    => $isVCIFMainAP['AccountPlanningId'],
          'IsActive'             => $vcif_row['IsActive'],
          'IsExisting'           => $vcif_row['IsExisting'],
          'IsMain'               => $IsMain,
          'CustomerGroupId'      => $vcif_row['CustomerGroupId'],
          'CustomerGroupName'    => $vcif_row['CustomerGroupName']
        );
      }
    }

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/vcif_list.php', $data);
    $this->load->view('layout/footer.php');
  }

  public function getDetails($VCIF) {
    $this->checkModule();
    $result = $this->Utility_model->getViewVcifDetails($VCIF);
    echo json_encode($result);
  }

  public function set_status($VCIF, $IsActive) {
    $this->checkModule();

    $IsActive_val = 1;
    if ($IsActive == 1) {
      $IsActive_val = 0;
    }

    $data_edit = array (
      'IsActive'                 => $IsActive_val
      , 'ModifiedDate'           => $this->current_datetime
      , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
      );


    $result = $this->TasklistAccountPlanning_model->updateData('CustomerKorporasi', $data_edit, 'VCIF', $VCIF);

    if($result['status'] == 'error') {
      echo "failed";
    }
    else {
      echo "success";
    }
  }

  public function set_main($VCIF, $IsMain, $CustomerGroupId) {
    $this->checkModule();

    $result_mapping = $this->Utility_model->transGroupSetMainCustomer($CustomerGroupId, $VCIF, $this->session->PERSONAL_NUMBER);

    echo json_encode($result_mapping);
}

  public function set_mains($VCIF, $IsMain, $CustomerGroupId) {
    $this->checkModule();

    $CustomerMainGroup = $this->Utility_model->getCustomerMainGroup($CustomerGroupId);

    $IsMain_val = 1;
    if ($IsMain == 1) {
      $IsMain_val = 0;
    }

    if ($CustomerMainGroup['VCIF'] != $VCIF) {

      $data_edit_oldmain = array (
        'IsMain'                    => 0
        , 'ModifiedDate'            => $this->current_datetime
        , 'ModifiedBy'              => $this->session->PERSONAL_NUMBER
        );

      $result_oldmain = $this->TasklistAccountPlanning_model->updateData('CustomerKorporasi', $data_edit_oldmain, 'VCIF', $CustomerMainGroup['VCIF']);
    }

    $data_edit_newmain = array (
      'IsMain'                    => $IsMain_val
      , 'ModifiedDate'            => $this->current_datetime
      , 'ModifiedBy'              => $this->session->PERSONAL_NUMBER
      );

    $result = $this->TasklistAccountPlanning_model->updateData('CustomerKorporasi', $data_edit_newmain, 'VCIF', $VCIF);

    if($result['status'] == 'error') {
      echo "failed";
    }
    else {
      echo "success";
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

    if ($this->input->post('isVCIFMainAP') != 1) {
      $CustomerGroupId = $this->input->post('CustomerGroupId');
      $IsExisting = $this->input->post('IsExisting');
      if ($this->input->post('NewGroup') == 1) {
        $isGroupExist = $this->Utility_model->isGroupExist(trim($this->input->post('CustomerGroupName')));
        if (!empty($isGroupExist['CustomerGroupId'])) {
            $result_error = array(
                'status' => 'error'
                , 'message' => 'Group already exist.'
            );
            echo json_encode($result_error);
            exit();
        }

        $data_input_group = array (
          'Name'                    => trim($this->input->post('CustomerGroupName'))
          , 'CreatedDate'           => $this->current_datetime
          , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
          );

        $CustomerGroupId = $this->TasklistAccountPlanning_model->insertDataGetInputedId('CustomerGroup', $data_input_group);
      }
      if ($this->input->post('IsAccountPlanningExist') == 1) {
        if ($this->input->post('oldCustomerGroupId') != $this->input->post('CustomerGroupId')) {
          $NewGroupDetails = $this->Utility_model->getViewGroupDetails($this->input->post('CustomerGroupId'));
          $result_confirmation = array(
              'status' => 'confirms'
              , 'message' => $this->input->post('oldVCIF').' already have Account Planning ID '.$this->input->post('AccountPlanningId').'. <br>Your\'e about to move '.$this->input->post('oldVCIF')." from group ".$this->input->post('oldCustomerGroupName')." to ".$NewGroupDetails['CustomerGroupName'].'.<br>Are you sure?'
          );
          echo json_encode($result_confirmation);
          exit();
        }
      }
    }
    else if ($this->input->post('isVCIFMainAP') == 1) {
      $CustomerGroupId = $this->input->post('oldCustomerGroupId');
      $IsExisting = $this->input->post('oldIsExisting');
      if ($this->input->post('oldCustomerGroupId') != $this->input->post('CustomerGroupId')) {
        $result_error = array(
            'status' => 'modal'
            , 'message' => 'VCIF cannot remapped to another Group. <br><br>Do Remapping Account Planning First.'
        );
        echo json_encode($result_error);
        exit();
      }
    }

    // $IsMainGroup = $this->input->post('IsMainGroup');
    if ($this->input->post('submit_type_vcif') == 'add') {
      $isCustomerExist = $this->Utility_model->isCustomerExist(trim($this->input->post('NameVCIF')));
      if (!empty($isCustomerExist['VCIF'])) {
          $result_error = array(
              'status' => 'error'
              , 'message' => 'Customer already exist.'
          );
          echo json_encode($result_error);
          exit();
      }

      $VCIF = $this->Utility_model->generateVcif();
      $data_input = array (
        'VCIF'                    => $VCIF
        , 'Name'                  => trim($this->input->post('NameVCIF'))
        , 'CustomerGroupId'       => $CustomerGroupId
        , 'IsExisting'            => $IsExisting
        // , 'IsMain'                => $IsMainGroup
        , 'CreatedDate'           => $this->current_datetime
        , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
        );

        $result = $this->TasklistAccountPlanning_model->insertData('CustomerKorporasi', $data_input);
    }
    else if ($this->input->post('submit_type_vcif') == 'edit') {
      $VCIF = $this->input->post('oldVCIF');
      $data_edit = array (
        'VCIF'                     => $VCIF
        , 'Name'                   => trim($this->input->post('NameVCIF'))
        , 'CustomerGroupId'        => $CustomerGroupId
        , 'IsExisting'             => $IsExisting
        // , 'IsMain'                 => $IsMainGroup
        , 'ModifiedDate'           => $this->current_datetime
        , 'ModifiedBy'             => $this->session->PERSONAL_NUMBER
        );


      $result = $this->TasklistAccountPlanning_model->updateData('CustomerKorporasi', $data_edit, 'VCIF', $VCIF);
      if ($this->input->post('IsAccountPlanningExist') == 2) {
        $data['account_planning'] = $this->PerformanceAccountPlanning_model->getDetailPerformanceAccountPlanning($this->input->post('AccountPlanningId'));

        $result_mapping = $this->Utility_model->transAccountPlanningRemoveCustomer($this->input->post('AccountPlanningId'), $VCIF, $this->session->PERSONAL_NUMBER, $data['account_planning']['RMId']);
      }
    }

    if(isset($result)) {
      if(isset($result_warning)) {
        echo json_encode(array_merge($result, $result_warning));
      }
      if(isset($result_mapping)) {
        echo json_encode(array_merge($result, $result_mapping));
      }
      else {
        echo json_encode($result);
      }
    }
  }

  public function cif_proc() {
    $this->checkModule();
    
    if ($this->input->post('submit_type_cif') == 'add') {
      /*
      foreach ($this->input->post('CIF') as $key => $value) {
        if (!empty($value)) {
          $data['isCIFExist'][$key] = $this->Utility_model->isCIFExist(trim($value));
          if ($data['isCIFExist'][$key]) {
            $result_error = 1;
            $result_error_message[$key] = $value.' already exist.';
          }
          else {
            $data_input[$key] = array (
              'CIF'                     => trim($value)
              , 'VCIF'                  => $this->input->post('VCIF')
              , 'Name'                  => trim($this->input->post('NameCIF')[$key])
              , 'CreatedDate'           => $this->current_datetime
              , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
              );

            $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input[$key]);
          }
        }
        else {
            $result_error = 1;
            $result_error_message[$key] = 'CIF cannot empty.';
        }
      }
      */
      $cif = $this->input->post("CIF");
      $isExistCIF = $this->Utility_model->isCIFExist(trim($cif));
      if($isExistCIF){
        $result_error = 1;
        $result_error_message[0] = $cif.' already exist.';
      }else{
        $data_input[0] = array (
          'CIF'                     => strtoupper(trim($cif))
          , 'VCIF'                  => $this->input->post('VCIF')
          //, 'Name'                  => trim($this->input->post('CIFName'))
          , 'CreatedDate'           => $this->current_datetime
          , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
          );

        $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input[0]);
      }
    }

    if(isset($result)) {
      echo json_encode($result);
    }
    elseif(isset($result_error)) {
      $result_error = array(
          'status' => 'error'
          , 'message' => implode('<br>', $result_error_message)
      );
      echo json_encode($result_error);
    }
  }

  public function download_mass_upload_cif($vcif) {
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

  public function mass_upload_cif($VCIF) {
    $this->checkModule();
    $data = NULL;
    $data['VCIF'] = $VCIF;

    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('utility/mass_upload_cif', $data);
    $this->load->view('layout/footer.php');
  }

  public function uploaded_mass_input_cif() {
    $this->checkModule();
    $this->load->library('excel');
    $data['VCIF'] = $this->input->post('VCIF');

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
        // for($i=4; $i <= $highestRow; $i++) {
        //   $inputed_cif[]=trim($this->excel->getCell("A".$i)->getValue());
        // }
        for($i=4; $i <= $highestRow; $i++) {
          $data['isCIFExist'][$counter] = $this->Utility_model->isCIFExist(trim($this->excel->getCell("A".$i)->getValue()));
          // $data['isCIFValid'][$counter] = in_array(trim($this->excel->getCell("A".$i)->getValue()), $this->input->post('cif'), true);

          $content[$counter]['cif'] = $this->excel->getCell("A".$i)->getValue();
          $content[$counter]['valid'] = true;
          $content[$counter]['message'] = "";

          if(empty(trim($this->excel->getCell("A".$i)))) {
            $content[$counter]['valid'] = false;
            $content[$counter]['message'] = "CIF belum diisi.\n";
          } 
          // else if(in_array(trim($this->excel->getCell("A".$i)->getValue()), $inputed_cif)) {
          //   $content[$counter]['valid'] = false;
          //   $content[$counter]['message'] = "CIF sudah terdapat.\n";
          // } 
          else if(strlen(trim($this->excel->getCell("A".$i))) > 10) {
            $content[$counter]['valid'] = false;
            $content[$counter]['message'] = "CIF max 10 karakter.\n";
          } 
          else if(!empty($data['isCIFExist'][$counter])) {
            $content[$counter]['valid'] = false;
            $content[$counter]['message'] = "CIF sudah terdaftar.\n";
          } 
          else {
            $content[$counter]['valid'] = true;
            $content[$counter]['message'] = "data CIF valid.\n";
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
    if(!empty($this->input->post('VCIF')) && $this->input->post('filename') && $this->input->post('summary')) {
      if (!empty($this->input->post('cif'))) {
        foreach ($this->input->post('cif') as $key => $value) {
          $isCIFExist[$key] = $this->Utility_model->isCIFExist(trim($this->input->post($value)));
          if (empty($isCIFExist[$key])) {
            $data_input[$key] = array (
              'CIF'                     => trim($value)
              , 'VCIF'                  => $this->input->post('VCIF')
              , 'Name'                  => trim($this->input->post('NameCIF')[$key])
              , 'CreatedDate'           => $this->current_datetime
              , 'CreatedBy'             => $this->session->PERSONAL_NUMBER
              );
            
            // $this->db->trans_begin();
            $result = $this->TasklistAccountPlanning_model->insertData('DetailCustomerKorporasi', $data_input[$key]);
            // if($result['status'] == 'error'){
            //   $this->db->trans_rollback();
            // } 
            // else {
              // $this->db->trans_commit();
            // }
          }
        }
        $result = array(
            'status' => 'success',
            // 'message'=> count($data_input).' Data(s) Saved'
            'message'=> ' Data(s) Saved'
        );
      }
      else{
        $result = array('status' => 'error', 'message' => 'CIF empty.');
      }
    } else {
      $result = array('status' => 'error', 'message' => 'Parameter tidak lengkap');
    }
    echo json_encode($result);
    exit();
  }

}

?>
