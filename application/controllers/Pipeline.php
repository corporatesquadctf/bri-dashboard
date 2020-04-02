<?php
class Pipeline extends MY_Controller {

    function __construct() {
        parent::__construct();
        $user = $this->session->all_userdata();
        if(!$user =$this->session->userdata('USER_ID'))
		{
			redirect('logins');
		}else{
            $this->load->library('pagination');
            $this->load->helper(array(
                'form',
                'url',
                'security'
            ));
            $this->load->library(array(
                'session',
                'form_validation'
            ));
            $this->load->model('Pipeline_model');
            $this->load->database();            
        }
    }

    function index() {
        redirect('profile');
    }

    function draft() {
        $this->checkModule();
        $user = $this->session->all_userdata();
        $year = date('Y');

        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;

        if($this->input->post()){

            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION'], $user['USER_ID']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = $this->input->post('uker_id');
            $data['rm_id'] = $this->input->post('rm_id');
            $data['keyword'] = $this->input->post('keyword');

            $arr_layer_id = NULL;
            $arr_status_id = array('1','5');
            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $user['USER_ID'],
                'DIVISION_ID' => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => $this->input->post('keyword'),
                'YEAR' => NULL
            );
            
            $arr_layer_id = NULL;
            $arr_status_id = array('2','3','4','5','6','7','8');
            $data_post2 = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $user['USER_ID'],
                'DIVISION_ID' => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => $this->input->post('keyword'),
                'YEAR' => $year
            );
            
        }else{
            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION'], $user['USER_ID']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = 0;
            $data['rm_id'] = 0;
            $data['keyword'] = NULL;

            $arr_layer_id = NULL;
            $arr_status_id = array('1','5');
            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $user['USER_ID'],
                'DIVISION_ID' => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => NULL,
                'YEAR' => NULL
            );
            
            $arr_layer_id = NULL;
            $arr_status_id = array('2','3','4','5','6','7','8');
            $data_post2 = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $user['USER_ID'],
                'DIVISION_ID' => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => NULL,
                'YEAR' => $year
            );
        }

        $rs_pipeline = $this->Pipeline_model->getPipeline($data_post);
        foreach($rs_pipeline as $row){
            $isActive = $this->Pipeline_model->checkStatusPipeline($row->NPWP);
            $row->isActive = $isActive;
        }
        $rs_pipeline2 = $this->Pipeline_model->getPipeline($data_post2);
        $data['pipeline'] = $rs_pipeline;
        $data['pipeline2'] = $rs_pipeline2;
        $data['user'] = $user;

        //echo json_encode($rs_pipeline); die;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/draft_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function create(){
        $this->checkModule();
        
        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption(NULL, $this->session->PERSONAL_NUMBER);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;

        
        $rs_sub_sektor_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_sektor_usaha[0]->SegmentationId);
        $rsLpgInformation = $this->Pipeline_model->getLpgInformation($rs_sub_sektor_ekonomi[0]->SubSectorEconomyId);
        $warnaLpg = $rsLpgInformation[0]->Warna;
        $data['sub_sektor_ekonomi_option'] = $rs_sub_sektor_ekonomi;
        $arr_fasilitas = array();
        $obj_fasilitas = array(
            'PipelineFacilityValuesId' => '0',
            'PipelineFacilityId' => $rs_facility[0]->FacilityId,
            'PipelineFacilityValue' => ''
        );
        array_push($arr_fasilitas, $obj_fasilitas);
        if(empty($rs_customer)){
            $selectedCIF = '';
        }else{
            $selectedCIF = $rs_customer[0]->CustomerMenengahId;
        }
        $data_post = array(
            'sumber_pipeline' => $rs_data_source[0]->PipelineDataSourceId,
            'jenis_debitur' => $rs_customer_type[0]->CustomerMenengahTypeId,
            'cif' => $selectedCIF,
            'nama_debitur' => '',
            'npwp_perusahaan' => '',
            'alamat' => '',
            'contact_person' => '',
            'no_telp' => '',
            'ews_status' => 0,
            'jenis_usaha' => '',
            'sektor_usaha' => $rs_sektor_usaha[0]->SegmentationId,
            'sub_sektor_ekonomi' => $rs_sub_sektor_ekonomi[0]->SubSectorEconomyId,
            'warna_lpg' => $warnaLpg,
            'lpgDescription' => "",
            'status_debitur' => 0,
            'plafond' => 0,
            'tdb' => 0,
            'sumber_tdb' => $rs_sumber_tdb[0]->TdbSourceId,
            'jml_fasilitas' => '1',
            'arr_fasilitas' => $arr_fasilitas
        );
        $data['pipeline']= (object)$data_post;        

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/create_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function process_create(){
        $this->checkModule();
        $userId = $this->session->PERSONAL_NUMBER;

        $sumber_pipeline = $this->input->post('sumber_pipeline');
        switch($sumber_pipeline){
            case 1: 
                $cif_no = NULL; 
                $status_debitur = 1; 
                $jmlFasilitasSuplesi = 0;
                $arrFasilitasSuplesi = array();
                break;
            case 2: 
                $cif_no = $this->input->post('cif'); 
                $status_debitur = 2; 
                $jmlFasilitasSuplesi = $this->input->post('jml-fasilitas-suplesi');
                $arrFasilitasSuplesi = array();
                for($i=0; $i<$jmlFasilitasSuplesi; $i++){
                    $fasilitasSuplesi = array(
                        'PipelineFacilityId' => $this->input->post('fasilitas_suplesi_id_'.$i),
                        'PlafondExisting' => str_replace(",","",$this->input->post('plafond_existing_suplesi_'.$i)),
                        'PlafondSuplecy' => str_replace(",","",$this->input->post('plafond_baru_suplesi_'.$i)),
                        'NoRekening' => $this->input->post('no_rekening_'.$i),
                        'EWS' => $this->input->post('ews_'.$i),
                    );
                    array_push($arrFasilitasSuplesi, $fasilitasSuplesi);
                }
                break;
            }

            $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($this->input->post('sektor_usaha'));
            $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;

            $warna_lpg = $this->input->post('warna_lpg');
            if($warna_lpg[0] == 1 || $warna_lpg[0] == 2){
                $LPGDescription = $this->input->post('lpgDescription');
            }else{
                $LPGDescription = "";
            }

            $plafon = $this->input->post('plafond');
            $plafon = str_replace(",","",$plafon);

            $tdb = $this->input->post('tdb');
            switch($tdb[0]){
                case 1: $sumber_tdb = $this->input->post('sumber_tdb'); break;
                case 2: $sumber_tdb = NULL; break;
                default: $sumber_tdb = NULL; break;
            }
 
            $arr_fasilitas = array();            
            $jumlahFasilitasBaru = $this->input->post('jumlahFasilitasBaru');
            if($this->input->post('arrFasilitasBaru') != ""){
                $dataFasilitasBaru = explode(',',$this->input->post('arrFasilitasBaru'));
                foreach($dataFasilitasBaru as $row){
                    $fasilitasBaru = array(
                        'PipelineFacilityId' => $this->input->post('drp_fasilitas'.$row),
                        'PipelineFacilityValue' => str_replace(",","",$this->input->post('plafond_fasilitas'.$row))
                    );
                    array_push($arr_fasilitas, $fasilitasBaru);
                }
            }
            
            $jenis_debitur = $this->input->post('jenis_debitur_id');
            $additional_desc = $this->input->post("additional_desc");
            
            $data_post = array(
                'sumber_pipeline' => $this->input->post('sumber_pipeline'),
                'jenis_debitur' => $jenis_debitur,
                'cif' => $cif_no,
                'nama_debitur' => $this->input->post('nama_debitur'),
                'npwp_perusahaan' => $this->input->post('npwp_perusahaan'),
                'alamat' => $this->input->post('alamat'),
                'contact_person' => $this->input->post('contact_person'),
                'no_telp' => $this->input->post('no_telp'),
                'jenis_usaha' => $this->input->post('jenis_usaha'),
                'sektor_usaha' => $this->input->post('sektor_usaha'),
                'sub_sektor_ekonomi' => $this->input->post('sub_sektor_ekonomi'),
                'warna_lpg' => $warna_lpg[0],
                'lpgDescription' => $LPGDescription,
                'status_debitur' => $status_debitur,
                'plafond' => $plafon,
                'tdb' => $tdb[0],
                'sumber_tdb' => $sumber_tdb,
                'jmlFasilitasSuplesi' => $jmlFasilitasSuplesi,
                'arrFasilitasSuplesi' => $arrFasilitasSuplesi,
                'total_fasilitas' => count($arr_fasilitas),
                'arr_fasilitas' => $arr_fasilitas,
                'additional_desc' => $additional_desc,
                'user_id' => $userId
            );
            
        $result = $this->Pipeline_model->createPipeline($data_post);
        echo json_encode($result);
    }

    function edit(){
        $this->checkModule();
        $user = $this->session->all_userdata();
		$id = $this->uri->segment(3);
        
        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);

        $isRejected = 0;
        foreach($rs_comment as $row){
            if($row->PipelineStatusId == 5):
                 $isRejected = 1; break;
            endif;
        }
        
        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $this->session->PERSONAL_NUMBER);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;        
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;

        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);
        
        $data_post = array(
            'id' => $id,
            'sumber_pipeline' => $rs_pipeline->DataSourceId,
            'cif' => $rs_pipeline->CIFId,
            'jenis_debitur' => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur' => $rs_pipeline->CustomerName,
            'npwp_perusahaan' => $rs_pipeline->NPWP,
            'alamat' => $rs_pipeline->Address,
            'contact_person' => $rs_pipeline->ContactPerson,
            'no_telp' => $rs_pipeline->PhoneNumber,
            'jenis_usaha' => $rs_pipeline->BusinessType,
            'sektor_usaha' => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg' => $rs_pipeline->LPGStatus,
            'lpgDescription' => $rs_pipeline->LPGDescription,
            'status_debitur' => $rs_pipeline->CustomerStatusId,
            'plafond' => $rs_pipeline->Plafond,
            'tdb' => $rs_pipeline->CustomerResouceId,
            'StatusId' => $rs_pipeline->StatusId,
            'sumber_tdb' => $rs_pipeline->TDBResourceId,
            'additional_desc' => $rs_pipeline->AdditionalDesc,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas' => count($rs_detail_facility),
            'arr_fasilitas' => $rs_detail_facility,
            'log_comment' => $rs_comment,
            'isRejected' => $isRejected
        );
        $data['pipeline']= (object)$data_post;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/edit_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function process_edit(){
        $this->checkModule();
        $userId = $this->session->PERSONAL_NUMBER;
        $id = $this->uri->segment(3);

        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);

        $isRejected = 0;
        foreach($rs_comment as $row){
            if($row->PipelineStatusId == 5):
                 $isRejected = 1; break;
            endif;
        }

        $sumber_pipeline = $this->input->post('sumber_pipeline');
        switch($sumber_pipeline){
            case 1: 
                $cif_no = NULL; 
                $status_debitur = 1; 
                $jmlFasilitasSuplesi = 0;
                $arrFasilitasSuplesi = array();
                break;
            case 2:
                if($isRejected == 0){
                    $cif_no = $this->input->post('cif');
                }else{
                    $cif_no = $rs_pipeline->CIFId;
                }                     
                $status_debitur = 2; 
                $jmlFasilitasSuplesi = $this->input->post('jml-fasilitas-suplesi');
                $arrFasilitasSuplesi = array();
                for($i=0; $i<$jmlFasilitasSuplesi; $i++){
                    $fasilitasSuplesi = array(
                        'PipelineFacilityId' => $this->input->post('fasilitas_suplesi_id_'.$i),
                        'PlafondExisting' => str_replace(",","",$this->input->post('plafond_existing_suplesi_'.$i)),
                        'PlafondSuplecy' => str_replace(",","",$this->input->post('plafond_baru_suplesi_'.$i)),
                        'NoRekening' => $this->input->post('no_rekening_'.$i),
                        'EWS' => $this->input->post('ews_'.$i)
                    );
                    array_push($arrFasilitasSuplesi, $fasilitasSuplesi);
                }
                break;
        }

        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($this->input->post('sektor_usaha'));
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;

        $warna_lpg = $this->input->post('warna_lpg');
        if($warna_lpg[0] == 1 || $warna_lpg[0] == 2){
            $LPGDescription = $this->input->post('lpgDescription');
        }else{
            $LPGDescription = "";
        }
        
        $plafon = $this->input->post('plafond');
        $plafon = str_replace(",","",$plafon);

        $tdb = $this->input->post('tdb');
        switch($tdb[0]){
            case 1: $sumber_tdb = $this->input->post('sumber_tdb'); break;
            case 2: $sumber_tdb = NULL; break;
            default: $sumber_tdb = NULL; break;
        }

        $arr_fasilitas = array();            
        $jumlahFasilitasBaru = $this->input->post('jumlahFasilitasBaru');
        if($this->input->post('arrFasilitasBaru') != ""){
            $dataFasilitasBaru = explode(',',$this->input->post('arrFasilitasBaru'));
            foreach($dataFasilitasBaru as $row){
                $fasilitasBaru = array(
                    'PipelineFacilityId' => $this->input->post('drp_fasilitas'.$row),
                    'PipelineFacilityValue' => str_replace(",","",$this->input->post('plafond_fasilitas'.$row))
                );
                array_push($arr_fasilitas, $fasilitasBaru);
            }
        }

        $jenis_debitur = $this->input->post('jenis_debitur_id');

        $data_post = array(
            'id' => $id,
            'sumber_pipeline' => $this->input->post('sumber_pipeline'),
            'cif' => $cif_no,
            'jenis_debitur' => $jenis_debitur,
            'nama_debitur' => $this->input->post('nama_debitur'),
            'npwp_perusahaan' => $this->input->post('npwp_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'contact_person' => $this->input->post('contact_person'),
            'no_telp' => $this->input->post('no_telp'),
            'jenis_usaha' => $this->input->post('jenis_usaha'),
            'sektor_usaha' => $this->input->post('sektor_usaha'),
            'sub_sektor_ekonomi' => $this->input->post('sub_sektor_ekonomi'),
            'warna_lpg' => $warna_lpg[0],
            'lpgDescription' => $LPGDescription,
            'status_debitur' => $status_debitur,
            'plafond' => $plafon,
            'tdb' => $tdb[0],
            'sumber_tdb' => $sumber_tdb,
            'jmlFasilitasSuplesi' => $jmlFasilitasSuplesi,
            'arrFasilitasSuplesi' => $arrFasilitasSuplesi,
            'total_fasilitas' => count($arr_fasilitas),  
            'arr_fasilitas' => $arr_fasilitas,
            'comment' => $this->input->post('comment'),
            'additional_desc' => $this->input->post("additional_desc"),
            'user_id' => $userId
        );
        
        $result = $this->Pipeline_model->updatePipeline($data_post);
        echo json_encode($result);
    }

    function submit_pipeline(){
        $user = $this->session->all_userdata();
        $arr_pipeline_id = $this->input->post('id');
        $arrPipeline = array();
        foreach($arr_pipeline_id as $row){
            $rsPipeline = $this->Pipeline_model->getDetailPipeline($row);
            $LayerStatusId = $rsPipeline->LayerStatusId;
            if($LayerStatusId == 1){
                array_push($arrPipeline, $row);
            }
        }
        
        if(!empty($arrPipeline)){
            $data_post = array(
                'layer_status_id' => 1,
                'status_id' => 2,
                'arr_pipeline_id' => $arrPipeline,
                'user_id' => $user['USER_ID'],
                'division_id' => $user['DIVISION'],
                'role_id' => $user['ROLE_ID'],
                'comment' => ''
            );
            //echo json_encode($data_post); die;
            
            if($this->Pipeline_model->updatePipelineStatus($data_post)){
                $result = array(
                    "status" => "success",
                    "message" => "Pipeline has been successfully submitted!"
                );
            }
        }else{
            $result = array(
                "status" => "error",
                "message" => "Pipeline submitted already"
            );
        }
        echo json_encode($result);
    }

    function history(){
        $this->checkModule();
        $user = $this->session->all_userdata();
        $dataYear = array(  ["id" => 0, "name" => "3 Tahun Terakhir"], 
						    ["id" => date("Y"), "name" => date("Y")],
						    ["id" => date("Y")-1, "name" => date("Y")-1],
						    ["id" => date("Y")-2, "name" => date("Y")-2] );
        $data['dataYear'] =  $dataYear;
        switch($user['ROLE_ID']){
            case USER_ROLE_RM_MENENGAH: 
                $arr_layer_id = array('1');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
            case USER_ROLE_GH_MENENGAH: 
                $arr_layer_id = array('2');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
            case USER_ROLE_WP: 
                $arr_layer_id = array('3');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
            case USER_ROLE_ERO: 
                $arr_layer_id = array('4');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
            case USER_ROLE_KADIV: 
                $arr_layer_id = array('5');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
            default: 
                $arr_layer_id = array('1','2','3','4','5');
                $arr_status_id = array('2','3','4','5','6','7','8');
                break;
        }
        
        if($this->input->post()){  
            $year = array($this->input->post('year'));
            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                    $created_by = $user['USER_ID'];
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
                default:
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = $this->input->post('uker_id');
            $data['rm_id'] = $this->input->post('rm_id');
            $data['year'] = $this->input->post('year');
            $data['keyword'] = $this->input->post('keyword');

            if($this->input->post('year') == 0){
                $arrYear = array(date("Y"), date("Y")-1, date("Y")-2);
            }else{
                $arrYear = array($this->input->post('year'));
            }
            
            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'DIVISION_ID' => $division_id,
                'CREATED_BY' => $created_by,
                'KEYWORD' => $this->input->post('keyword'),
                'YEAR' => $arrYear
            );          
        }else{
            $year = array(date("Y"), date("Y")-1, date("Y")-2);
            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                    $created_by = $user['USER_ID'];
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $created_by = 0;
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $created_by = 0;
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default: 
                    $created_by = 0;
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = 0;
            $data['rm_id'] = 0;
            $data['year'] = 0;
            $data['keyword'] = NULL;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $created_by,
                'DIVISION_ID' => $division_id,
                'KEYWORD' => NULL,
                'YEAR' => $year
            );
        }
        $rs_pipeline = $this->Pipeline_model->getHistoryPipeline($data_post);
        $i = 0;
        foreach($rs_pipeline as $row){
            $rs_pipeline[$i]->IsActive = $this->Pipeline_model->checkActivePipeline($row->CIFId);
            $i++;
        }
        $data['pipeline'] = $rs_pipeline;
        $data['user'] = $user;
        //echo json_encode($rs_pipeline); die;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/history_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function history_detail(){
        $this->checkModule();
        $user = $this->session->all_userdata();
		$id = $this->uri->segment(3);
        $message  = '';
        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);

        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $this->session->PERSONAL_NUMBER);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;   
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;        
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);

        $rs_log = $this->Pipeline_model->getLogPipeline($id);
        $data['log_pipeline'] = $rs_log;

        
        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        $arr_index = array();
        for($i=0; $i<count($rs_detail_facility); $i++){
            array_push($arr_index,$i);
        }
        $data_post = array(
            'id' => $id,                
            'created_by' => $rs_pipeline->CreatedBy,
            'sumber_pipeline' => $rs_pipeline->DataSourceId,
            'cif' => $rs_pipeline->CIFId,
            'jenis_debitur' => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur' => $rs_pipeline->CustomerName,
            'npwp_perusahaan' => $rs_pipeline->NPWP,
            'alamat' => $rs_pipeline->Address,
            'contact_person' => $rs_pipeline->ContactPerson,
            'no_telp' => $rs_pipeline->PhoneNumber,
            'jenis_usaha' => $rs_pipeline->BusinessType,
            'sektor_usaha' => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg' => $rs_pipeline->LPGStatus,
            'lpgDescription' => $rs_pipeline->LPGDescription,
            'status_debitur' => $rs_pipeline->CustomerStatusId,
            'plafond' => $rs_pipeline->Plafond,
            'tdb' => $rs_pipeline->CustomerResouceId,
            'sumber_tdb' => $rs_pipeline->TDBResourceId,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas' => count($rs_detail_facility),
            'arr_fasilitas' => $rs_detail_facility,
            'arr_index' => $arr_index,
            'log_comment' => $rs_comment,
            'additional_desc'=> $rs_pipeline->AdditionalDesc
        );
        //echo json_encode($data_post); die;
        
        $data['pipeline']= (object)$data_post;
        
        
        $data['errmsg'] = $message;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/history_detail_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function submitted() {
        $this->checkModule();
        $user = $this->session->all_userdata();
        $year = date('Y');

        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;

        switch($user['ROLE_ID']){
            case USER_ROLE_GH_MENENGAH: 
                $arr_layer_id = array('2');
                $arr_status_id = array('2','3');
                break;
            case USER_ROLE_WP: 
                $arr_layer_id = array('3'); 
                $arr_status_id = array('2','3');
                break;
            case USER_ROLE_ERO: 
                $arr_layer_id = array('4');
                $arr_status_id = array('2','3');
                break;
            case USER_ROLE_KADIV: 
                $arr_layer_id = array('5'); 
                $arr_status_id = array('2','3');
                break;
            default: 
                $arr_layer_id = array('5'); 
                $arr_status_id = array('2','3');
                break;
        }
        
        if($this->input->post()){
            switch($user['ROLE_ID']){
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
                default: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = $this->input->post('uker_id');
            $data['rm_id'] = $this->input->post('rm_id');
            $data['sektorUsahaId'] = $this->input->post('sektorUsahaId');
            $data['keyword'] = $this->input->post('keyword');

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'DIVISION_ID' => $division_id,
                'CREATED_BY' => $this->input->post('rm_id'),
                'SEKTOR_USAHA_ID' => $this->input->post('sektorUsahaId'),
                'KEYWORD' => $this->input->post('keyword'),
                'YEAR' => $year
            );
        }else{
            switch($user['ROLE_ID']){
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }
            
            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = 0;
            $data['rm_id'] = 0;
            $data['sektorUsahaId'] = 0;
            $data['keyword'] = NULL;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'DIVISION_ID' => $division_id,
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => NULL,
                'CREATED_BY' => 0,
                'YEAR' => $year
            );
        }

        $rs_pipeline = $this->Pipeline_model->getPipeline($data_post);
        $data['pipeline'] = $rs_pipeline;
        $data['user'] = $user;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/submitted_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function detail(){
        $user = $this->session->all_userdata();
		$id = $this->uri->segment(3);

        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);
        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);
        $data['data_source_option'] = $rs_data_source;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $this->session->PERSONAL_NUMBER);
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;        
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;

        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        
        $data_post = array(
            'id' => $id,                
            'created_by' => $rs_pipeline->CreatedBy,
            'sumber_pipeline' => $rs_pipeline->DataSourceId,
            'cif' => $rs_pipeline->CIFId,
            'jenis_debitur' => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur' => $rs_pipeline->CustomerName,
            'npwp_perusahaan' => $rs_pipeline->NPWP,
            'alamat' => $rs_pipeline->Address,
            'contact_person' => $rs_pipeline->ContactPerson,
            'no_telp' => $rs_pipeline->PhoneNumber,
            'jenis_usaha' => $rs_pipeline->BusinessType,
            'sektor_usaha' => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg' => $rs_pipeline->LPGStatus,
            'lpgDescription' => $rs_pipeline->LPGDescription,
            'status_debitur' => $rs_pipeline->CustomerStatusId,
            'plafond' => $rs_pipeline->Plafond,
            'tdb' => $rs_pipeline->CustomerResouceId,
            'sumber_tdb' => $rs_pipeline->TDBResourceId,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas' => count($rs_detail_facility),
            'arr_fasilitas' => $rs_detail_facility,
            'log_comment' => $rs_comment,
            'additional_desc'=> $rs_pipeline->AdditionalDesc
        );
        //echo print_r($data_post,true); die;
        
        $data['pipeline']= (object)$data_post;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/detail_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function approval_pipeline(){
        $user = $this->session->all_userdata();
        switch($user['ROLE_ID']){
            case USER_ROLE_RM_MENENGAH: $layer_status_id = 1; break;
            case USER_ROLE_GH_MENENGAH: $layer_status_id = 2; break;
            case USER_ROLE_WP: $layer_status_id = 3; break;
            case USER_ROLE_ERO: $layer_status_id = 4; break;
            case USER_ROLE_KADIV: $layer_status_id = 5; break;
        }
        $arr_pipeline_id = $this->input->post('id');
        $arrPipeline = array();
        foreach($arr_pipeline_id as $row){
            $rsPipeline = $this->Pipeline_model->getDetailPipeline($row);
            $LayerStatusId = $rsPipeline->LayerStatusId;
            $StatusId = $rsPipeline->StatusId;
            if($LayerStatusId == $layer_status_id){
                if($LayerStatusId == 2 || $LayerStatusId == 3 || $LayerStatusId == 4 || $LayerStatusId == 5){
                    if($StatusId == 3) array_push($arrPipeline, $row);
                }else{
                    array_push($arrPipeline, $row);
                }
            }
        }
        $status_id = $this->input->post('status');
        if(!empty($arrPipeline)){
            if($this->input->post('comment') != NULL){
                $comment = $this->input->post('comment');
            }else $comment = "";
            $data_post = array(
                'layer_status_id' => $layer_status_id,
                'status_id' => $status_id,
                'arr_pipeline_id' => $arr_pipeline_id,
                'comment' => strip_tags($comment),
                'user_id' => $user['USER_ID'],
                'division_id' => $user['DIVISION'],
                'role_id' => $user['ROLE_ID']
            );
            if($status_id == 2){
                $flashmsg = 'Pipeline has been successfully submitted!';
                if($this->Pipeline_model->updatePipelineStatus($data_post)){
                    $result = array(
                        "status" => "success",
                        "message" => $flashmsg,
                        "redirect" => base_url("pipeline/draft")
                    );
                }else{
                    $result = array(
                        "status" => "error",
                        "message" => "Failed to submit Pipeline",
                        "redirect" => base_url("pipeline/draft")
                    );
                }
            } else if($status_id == 4) {
                $flashmsg = 'Pipeline has been successfully approved!';
                if($this->Pipeline_model->updatePipelineStatus($data_post)){
                    $result = array(
                        "status" => "success",
                        "message" => $flashmsg,
                        "redirect" => base_url("pipeline/submitted")
                    );
                }else{
                    $result = array(
                        "status" => "error",
                        "message" => "Failed to approve Pipeline",
                        "redirect" => base_url("pipeline/submitted")
                    );
                }
            }else if($status_id == 5) {
                $flashmsg = 'Pipeline has been successfully rejected!';
                if($this->Pipeline_model->updatePipelineStatus($data_post)){
                    $result = array(
                        "status" => "success",
                        "message" => $flashmsg,
                        "redirect" => base_url("pipeline/submitted")
                    );
                }else{
                    $result = array(
                        "status" => "error",
                        "message" => "Failed to reject Pipeline",
                        "redirect" => base_url("pipeline/submitted")
                    );
                }
            }
        }else{
            $flashmsg = 'Failed to Update Pipeline';                
            $this->session->set_flashdata('Failed', $flashmsg);
            if($status_id == 2){
                $redirect = base_url("pipeline/draft");
            } else if($status_id == 4 || $status_id == 5) {
                $redirect = base_url("pipeline/submitted");
            }
            $result = array(
                "status" => "error",
                "message" => $flashmsg,
                "redirect" => $redirect
            );
        }
        echo json_encode($result);
    }

    function approved(){
        $this->checkModule();
        $user = $this->session->all_userdata();
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['fasilitasOption'] = $rs_facility;
        $fasilitas_option = "";
        foreach($rs_facility as $row){
            $fasilitas_option .= "<option value='".$row->FacilityId."'>".$row->FacilityName."</option>";
        }
        $data['facility_option'] = $fasilitas_option;

        $month = array( ["value" => 1, "name" => "Januari"], 
						["value" => 2, "name" => "Februari"],
						["value" => 3, "name" => "Maret"],
						["value" => 4, "name" => "April"],
						["value" => 5, "name" => "Mei"],
						["value" => 6, "name" => "Juni"],
						["value" => 7, "name" => "Juli"],
						["value" => 8, "name" => "Agustus"],
						["value" => 9, "name" => "September"],
						["value" => 10, "name" => "Oktober"],
						["value" => 11, "name" => "November"],
                        ["value" => 12, "name" => "Desember"] );
        $data['month'] =  $month;

        $arr_layer_id = array('1','5');
        //Tambahkan 7 di arr_status_id jika batal masih ditampilkan di approved list
        $arr_status_id = array('4','6','7','8');
        $year = date('Y');
        switch($user['ROLE_ID']){
            case USER_ROLE_RM_MENENGAH: 
                $created_by = $user['USER_ID'];
                break;
            case USER_ROLE_GH_MENENGAH: 
            case USER_ROLE_WP: 
            case USER_ROLE_ERO: 
            case USER_ROLE_KADIV: 
                $created_by = 0;
                break;
            default:
                $created_by = 0;
                break;
        }

        if($this->input->post()){
            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                    $created_by = $user['USER_ID'];
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
                default: 
                    $created_by = $this->input->post('rm_id');
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $this->input->post('uker_id'));
                    $division_id = $this->input->post('uker_id');
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = $this->input->post('uker_id');
            $data['rm_id'] = $this->input->post('rm_id');
            $data['keyword'] = $this->input->post('keyword');

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'DIVISION_ID' => $division_id,
                'CREATED_BY' => $created_by,
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => $this->input->post('keyword'),
                'YEAR' => $year
            );       
        }else{
            switch($user['ROLE_ID']){
                case USER_ROLE_RM_MENENGAH:
                case USER_ROLE_GH_MENENGAH: 
                case USER_ROLE_WP: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO: 
                case USER_ROLE_KADIV: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default: 
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option'] = $rs_rm;        
            $data['uker_id'] = 0;
            $data['rm_id'] = 0;
            $data['keyword'] = NULL;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID' => $arr_status_id,
                'CREATED_BY' => $created_by,
                'DIVISION_ID' => $division_id,
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD' => NULL,
                'YEAR' => $year
            );
        }
        $rs_pipeline = $this->Pipeline_model->getPipeline($data_post);
        
        $data['pipeline'] = $rs_pipeline;
        $data['user'] = $user;
        //echo json_encode($rs_pipeline); die;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/approved_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function approved_detail(){
        $user = $this->session->all_userdata();
		$id = $this->uri->segment(3);
        $message  = '';
        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);

        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $this->session->PERSONAL_NUMBER);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;        
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;

        $month = array( ["value" => 1, "name" => "Januari"], 
						["value" => 2, "name" => "Februari"],
						["value" => 3, "name" => "Maret"],
						["value" => 4, "name" => "April"],
						["value" => 5, "name" => "Mei"],
						["value" => 6, "name" => "Juni"],
						["value" => 7, "name" => "Juli"],
						["value" => 8, "name" => "Agustus"],
						["value" => 9, "name" => "September"],
						["value" => 10, "name" => "Oktober"],
						["value" => 11, "name" => "November"],
                        ["value" => 12, "name" => "Desember"] );
        
        
        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        
        if($rs_pipeline->BulanRealisasi != NULL){
            $bulanRealisasi = $month[$rs_pipeline->BulanRealisasi - 1]['name'];
        }else{
            $bulanRealisasi = NULL;
        }
        
        $data_post = array(
            'id' => $id,
            'layer_status_id' => $rs_pipeline->LayerStatusId,
            'status_id' => $rs_pipeline->StatusId,         
            'created_by' => $rs_pipeline->CreatedBy,
            'sumber_pipeline' => $rs_pipeline->DataSourceId,
            'cif' => $rs_pipeline->CIFId,
            'jenis_debitur' => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur' => $rs_pipeline->CustomerName,
            'npwp_perusahaan' => $rs_pipeline->NPWP,
            'alamat' => $rs_pipeline->Address,
            'contact_person' => $rs_pipeline->ContactPerson,
            'no_telp' => $rs_pipeline->PhoneNumber,
            'jenis_usaha' => $rs_pipeline->BusinessType,
            'sektor_usaha' => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg' => $rs_pipeline->LPGStatus,
            'lpgDescription' => $rs_pipeline->LPGDescription,
            'status_debitur' => $rs_pipeline->CustomerStatusId,
            'plafond' => $rs_pipeline->Plafond,
            'tdb' => $rs_pipeline->CustomerResouceId,
            'sumber_tdb' => $rs_pipeline->TDBResourceId,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas' => count($rs_detail_facility),
            'arr_fasilitas' => $rs_detail_facility,
            'log_comment' => $rs_comment,
            'additional_desc' => $rs_pipeline->AdditionalDesc,
            'realisasi' => $bulanRealisasi
        );
        
        $data['pipeline']= (object)$data_post;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/approved_detail_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    function copy(){
        $this->checkModule();
        $user = $this->session->all_userdata();
		$id = $this->uri->segment(3);
        
        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);
        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $this->session->PERSONAL_NUMBER);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;        
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;

        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);            
                    
        $data_post = array(
            'id' => $id,
            'sumber_pipeline' => $rs_pipeline->DataSourceId,
            'cif' => $rs_pipeline->CIFId,
            'jenis_debitur' => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur' => $rs_pipeline->CustomerName,
            'npwp_perusahaan' => $rs_pipeline->NPWP,
            'alamat' => $rs_pipeline->Address,
            'contact_person' => $rs_pipeline->ContactPerson,
            'no_telp' => $rs_pipeline->PhoneNumber,
            'jenis_usaha' => $rs_pipeline->BusinessType,
            'sektor_usaha' => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg' => $rs_pipeline->LPGStatus,
            'lpgDescription' => $rs_pipeline->LPGDescription,
            'status_debitur' => $rs_pipeline->CustomerStatusId,
            'plafond' => $rs_pipeline->Plafond,
            'tdb' => $rs_pipeline->CustomerResouceId,
            'sumber_tdb' => $rs_pipeline->TDBResourceId,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas' => count($rs_detail_facility),
            'arr_fasilitas' => $rs_detail_facility,
            'log_comment' => $rs_comment,
            'additional_desc' => $rs_pipeline->AdditionalDesc
        );
        
        $data['pipeline']= (object)$data_post;        
        
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('pipeline/copy_pipeline.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function process_copy(){
        $this->checkModule();
        $userId = $this->session->PERSONAL_NUMBER;
        $id = $this->uri->segment(3);

        $sumber_pipeline = $this->input->post('sumber_pipeline');
        switch($sumber_pipeline){
            case 1: 
                $cif_no = NULL; 
                $status_debitur = 1; 
                $ews_status = NULL;
                $jmlFasilitasSuplesi = 0;
                $arrFasilitasSuplesi = array();
                break;
            case 2: 
                $cif_no = $this->input->post('cif'); 
                $status_debitur = 2; 
                $jmlFasilitasSuplesi = $this->input->post('jml-fasilitas-suplesi');
                $arrFasilitasSuplesi = array();
                for($i=0; $i<$jmlFasilitasSuplesi; $i++){
                    $fasilitasSuplesi = array(
                        'PipelineFacilityId' => $this->input->post('fasilitas_suplesi_id_'.$i),
                        'PlafondExisting' => str_replace(",","",$this->input->post('plafond_existing_suplesi_'.$i)),
                        'PlafondSuplecy' => str_replace(",","",$this->input->post('plafond_baru_suplesi_'.$i)),
                        'NoRekening' => $this->input->post('no_rekening_'.$i),
                        'EWS' => $this->input->post('ews_'.$i)
                    );
                    array_push($arrFasilitasSuplesi, $fasilitasSuplesi);
                }
                break;
        }

        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($this->input->post('sektor_usaha'));
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;

        $warna_lpg = $this->input->post('warna_lpg');
        if($warna_lpg[0] == 1 || $warna_lpg[0] == 2){
            $LPGDescription = $this->input->post('lpgDescription');
        }else{
            $LPGDescription = "";
        }
        
        $plafon = $this->input->post('plafond');
        $plafon = str_replace(",","",$plafon);

        $tdb = $this->input->post('tdb');
        switch($tdb[0]){
            case 1: $sumber_tdb = $this->input->post('sumber_tdb'); break;
            case 2: $sumber_tdb = NULL; break;
            default: $sumber_tdb = NULL; break;
        }

        $arr_fasilitas = array();            
        $jumlahFasilitasBaru = $this->input->post('jumlahFasilitasBaru');
        if($this->input->post('arrFasilitasBaru') != ""){
            $dataFasilitasBaru = explode(',',$this->input->post('arrFasilitasBaru'));
            foreach($dataFasilitasBaru as $row){
                $fasilitasBaru = array(
                    'PipelineFacilityId' => $this->input->post('drp_fasilitas'.$row),
                    'PipelineFacilityValue' => str_replace(",","",$this->input->post('plafond_fasilitas'.$row))
                );
                array_push($arr_fasilitas, $fasilitasBaru);
            }
        }

        $jenis_debitur = $this->input->post('jenis_debitur_id');

        $data_post = array(
            'sumber_pipeline' => $this->input->post('sumber_pipeline'),
            'cif' => $cif_no,
            'jenis_debitur' => $jenis_debitur,
            'nama_debitur' => $this->input->post('nama_debitur'),
            'npwp_perusahaan' => $this->input->post('npwp_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'contact_person' => $this->input->post('contact_person'),
            'no_telp' => $this->input->post('no_telp'),
            'jenis_usaha' => $this->input->post('jenis_usaha'),
            'sektor_usaha' => $this->input->post('sektor_usaha'),
            'sub_sektor_ekonomi' => $this->input->post('sub_sektor_ekonomi'),
            'warna_lpg' => $warna_lpg[0],
            'lpgDescription' => $LPGDescription,
            'status_debitur' => $status_debitur,
            'plafond' => $plafon,
            'tdb' => $tdb[0],
            'sumber_tdb' => $sumber_tdb,
            'jmlFasilitasSuplesi' => $jmlFasilitasSuplesi,
            'arrFasilitasSuplesi' => $arrFasilitasSuplesi,
            'total_fasilitas' => count($arr_fasilitas),           
            'arr_fasilitas' => $arr_fasilitas,
            'additional_desc' => $this->input->post("additional_desc"),
            'user_id' => $userId,
        ); 
        
        $result = $this->Pipeline_model->createPipeline($data_post);
        echo json_encode($result);
    }
    
    function single_comment_pipeline(){
        $user = $this->session->all_userdata();
        $pipeline_id = $this->input->post('pipeline_id');
        $comment = $this->input->post('comment');
        $layer_status_id = $this->input->post('layer_status_id');
        $status_id = $this->input->post('status_id');
        $created_by = $this->input->post('created_by');
        $data_post = array(
            'layer_status_id' => $layer_status_id,
            'status_id' => $status_id,
            'pipeline_id' => $pipeline_id,
            'comment' => $comment,
            'created_by' => $created_by,
            'user_id' => $user['USER_ID'],
            'division_id' => $user['DIVISION'],
            'role_id' => $user['ROLE_ID']
        );
        $flashmsg = 'Comment has been successfully added!';
        if($this->Pipeline_model->singleCommentapprovedPipeline($data_post)){
            $result = array(
                "status" => "success",
                "message" => $flashmsg
            );
        }else{
            $result = array(
                "status" => "error",
                "message" => "Failed to add comment"
            );
        }
        echo json_encode($result);
    }

    function multiple_comment_pipeline(){
        $user = $this->session->all_userdata();
        $arr_pipeline_id = $this->input->post('id');
        if($this->input->post('comment') != NULL){
            $comment = $this->input->post('comment');
        }else $comment = "";
        $data_post = array(
            'arr_pipeline_id' => $arr_pipeline_id,
            'comment' => strip_tags($comment),
            'user_id' => $user['USER_ID'],
            'division_id' => $user['DIVISION'],
            'role_id' => $user['ROLE_ID']
        );
        $flashmsg = 'Comment has been successfully added!';
        if($this->Pipeline_model->multipleCommentapprovedPipeline($data_post)){
            $result = array(
                "status" => "success",
                "message" => $flashmsg
            );
        }else{
            $result = array(
                "status" => "error",
                "message" => "Failed to add comment"
            );
        }
        echo json_encode($result);
    }

    function proses_pipeline(){
        $user = $this->session->all_userdata();
        $pipeline_id = $this->input->post('pipeline_id');
        $rsPipeline = $this->Pipeline_model->getDetailPipeline($pipeline_id);
        $LayerStatusId = $rsPipeline->LayerStatusId;
        $StatusId = $rsPipeline->StatusId;
        if($LayerStatusId == 5 && $StatusId == 4){
            $layer_status_id = 1;
            $isProcess = $this->input->post('isProcess');
            switch($isProcess){
                case 1: $statusId = 6; break;
                case 0: $statusId = 4; break;
            }
            $realisasi = $this->input->post('realisasi');
            $jangkaWaktu = $this->input->post("jangka_waktu");
            $dataFasilitasPermohonan = $this->input->post("data_fasilitas_permohonan");
            $arrFasilitasPermohonan = explode(",", $dataFasilitasPermohonan);
            $arrFasilitas = array();
            foreach($arrFasilitasPermohonan as $row){
                $fasilitasPermohonan = array(
                    "FacilityId" => $this->input->post("fasilitas_permohonan_".$row),
                    "Plafond" => str_replace(",","",$this->input->post("plafond_".$row))
                );
                array_push($arrFasilitas, $fasilitasPermohonan);
            }
            $total_plafond_permohonan = str_replace(",","",$this->input->post("plafond_permohonan"));
            $data_post = array(
                'layer_status_id' => $layer_status_id,
                'status_id' => $statusId,
                'bulanRealisasi' => $realisasi,
                'jangka_waktu' => $jangkaWaktu,
                'arrFasilitasPermohonan' => $arrFasilitas,
                'total_plafond_permohonan' => $total_plafond_permohonan,
                'pipeline_id' => $pipeline_id,
                'comment' => NULL,
                'user_id' => $user['USER_ID'],            
                'division_id' => $user['DIVISION'],
                'role_id' => $user['ROLE_ID']
            );
            //echo json_encode($data_post); die;
            $flashmsg = 'Pipeline has been successfully processed!';
            if($this->Pipeline_model->changeStatusApprovedPipeline($data_post)){
                $result = array(
                    "status" => "success",
                    "message" => $flashmsg
                );
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Failed to process pipeline"
                );
            }
        }else{
            $result = array(
                "status" => "error",
                "message" => "Failed to process pipeline"
            );
        }
        echo json_encode($result);
    }

    function batal_pipeline(){
        $user = $this->session->all_userdata();
        $pipeline_id = $this->input->post('pipeline_id');
        $comment = $this->input->post('comment');
        $layer_status_id = 1;
        $data_post = array(
            'layer_status_id' => $layer_status_id,
            'status_id' => 7,
            'pipeline_id' => $pipeline_id,
            'comment' => $comment,
            'user_id' => $user['USER_ID'],
            'division_id' => $user['DIVISION'],
            'role_id' => $user['ROLE_ID']
        );
        //$this->Pipeline_model->changeStatusApprovedPipeline($data_post);
        $flashmsg = 'Pipeline has been successfully canceled!';
        if($this->Pipeline_model->changeStatusApprovedPipeline($data_post)){
            if($this->Pipeline_model->changeStatusApprovedPipeline($data_post)){
                $result = array(
                    "status" => "success",
                    "message" => $flashmsg
                );
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Failed to cancel pipeline"
                );
            }
        }else{
            $result = array(
                "status" => "error",
                "message" => "Failed to cancel pipeline"
            );
        }
        echo json_encode($result);
    }

    /*
    function maintain_pipeline(){
        $user = $this->session->all_userdata();
        $pipeline_id = $this->input->post('pipeline_id');
        $comment = $this->input->post('comment');
        $layer_status_id = 1;
        $data_post = array(
            'layer_status_id' => $layer_status_id,
            'status_id' => 8,
            'pipeline_id' => $pipeline_id,
            'comment' => $comment,
            'user_id' => $user['USER_ID'],
            'division_id' => $user['DIVISION'],
            'role_id' => $user['ROLE_ID']
        );
        //$this->Pipeline_model->changeStatusApprovedPipeline($data_post);
        $flashmsg = '<br>Pipeline has been successfully maintained!';
        if($this->Pipeline_model->changeStatusApprovedPipeline($data_post)){
            $this->session->set_flashdata('Success', $flashmsg);
            redirect('pipeline/approved');
        }else echo 'Failed';
    }
    */

    /*
        =-=-=-=-=-=-=-= Start of Service =-=-=-=-=-=-=-=-
    */

    function serviceGetDetailCustomer($id){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getDetailCustomerInformation($id);
        echo json_encode($result);
    }

    function serviceGetDetailPlafond($userId){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getDetailFacility($id);
        echo json_encode($result);
    }

    function serviceGetSubSektorEkonomi($segmentasi_id){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getSubSektorEkonomiOption($segmentasi_id);
        echo json_encode($result);
    }

    function serviceGetLpgInformation($subSectorEconomyId){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getLpgInformation($subSectorEconomyId);
        echo json_encode($result);
    }

    function serviceGetDetailPipeline($pipeline_id, $created_by_id){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getDetailPipeline($pipeline_id);
        echo json_encode($result);
    }

    function serviceGetRM($division_id){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getUserLayer($division_id, USER_ROLE_RM_MENENGAH);
        echo json_encode($result);
    }

    /*
    function serviceCheckCustomerStatus($npwp){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->checkCustomerStatus($npwp);
        echo json_encode($result);
    }
    */

    function serviceCheckCustomerStatus(){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $npwp = $this->input->post("npwp");
        $result = $this->Pipeline_model->checkCustomerStatus($npwp);
        echo $result;
    }

    function serviceCheckCustomerByCIF(){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $cif = $this->input->post("cif");
        $result = $this->Pipeline_model->CheckCustomerByCIF($cif);
        echo $result;
    }

    function serviceGetFasilitasPermohonan($pipelineId){
        $user = $this->session->all_userdata();
        if(empty($user['USER_ID'])) redirect('logins');
        $result = $this->Pipeline_model->getFasilitasPermohonan($pipelineId);
        echo json_encode($result);
    }
}

?>