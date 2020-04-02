<?php
    class ProsesKredit extends MY_Controller {
        function __construct() {
            parent::__construct();
            $user = $this->session->all_userdata();
            if(!$user =$this->session->userdata('USER_ID'))
            {
                redirect('logins');
            }else{
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
                $this->load->model('ProsesKredit_model');
                $this->load->model('Pipeline_model');            
            }
        }

        public function index() {
            $this->checkModule();
            $user = $this->session->all_userdata();
            $data['user'] = $user;
            $userId = $user['USER_ID'];
            $roleId = $user['ROLE_ID'];

            $rsUsulanPlafond = array();
            $data1 = array('id' => 1, 'name' => 'Kurang dari 50M');
            $rsUsulanPlafond[] = (object)$data1;
            $data2 = array('id' => 2, 'name' => '50M atau lebih');
            $rsUsulanPlafond[] = (object)$data2;
            $data['rsUsulanPlafond'] = $rsUsulanPlafond;
            
            if($this->input->post()){
                switch($user['ROLE_ID']){
                    case 12:
                        $createdBy = $userId;
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 14:
                        $createdBy = $this->input->post('rm_id');
                        $usulanPlafond = $this->input->post('usulanPlafond');
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 16:
                        $createdBy = $this->input->post('rm_id');
                        $usulanPlafond = $this->input->post('usulanPlafond');
                        $divisionId = $this->input->post('ukerId');
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah();
                        $rsRM = $this->Pipeline_model->getUserByRole(12,$divisionId);
                        break;
                    case 17:
                        $createdBy = $this->input->post('rm_id');
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 18:
                        $createdBy = $this->input->post('rm_id');
                        $divisionId = $user['DIVISION'];
                        $usulanPlafond = 0;
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    default:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = 0;
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah();
                        $rsRM = $this->Pipeline_model->getUserByRole(12);
                        break;
                }
                $data['rsUker'] = $rsUker;
                $data['rsRM'] = $rsRM;

                $data['uker_id'] = $this->input->post('ukerId');
                $data['rm_id'] = $this->input->post('rm_id');
                $data['usulanPlafond'] = $this->input->post('usulanPlafond');
                $data['keyword'] = $this->input->post('keyword');
            }else{
                switch($user['ROLE_ID']){
                    case 12:
                        $createdBy = $userId;
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 14:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 16:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = 0;
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah();
                        $rsRM = $this->Pipeline_model->getUserByRole(12);
                        break;
                    case 17:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    case 18:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = $user['DIVISION'];
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                        $rsRM = $this->Pipeline_model->getUserByRole(12, $divisionId);
                        break;
                    default:
                        $createdBy = 0;
                        $usulanPlafond = 0;
                        $divisionId = 0;
                        $rsUker = $this->Pipeline_model->getUnitKerjaMenengah();
                        $rsRM = $this->Pipeline_model->getUserByRole(12);
                        break;
                }
                $data['rsUker'] = $rsUker;
                $data['rsRM'] = $rsRM;

                $data['uker_id'] = 0;
                $data['rm_id'] = 0;
                $data['usulanPlafond'] = 0;
                $data['keyword'] = '';                
                
            }

            $filter = array(
                'Keyword' => $data['keyword'],
                'UsulanPlafond' => $usulanPlafond,
                'DivisionId' => $divisionId,
                'CreatedBy' => $createdBy
            );

            $rsProsesKredit = $this->ProsesKredit_model->getProsesKredit($filter);
            $data['prosesKredit'] = $rsProsesKredit; 

            //echo json_encode($data); die;

            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('monitoring/proses_kredit/ProsesKredit.php', $data);
            $this->load->view('layout/footer.php');        
        }

        public function detail(){
            $this->checkModule();
            $user = $this->session->all_userdata();
            $data['user'] = $user;

            $prosesKreditId = $this->uri->segment(4);
            $rsProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $data['prosesKredit'] = $rsProsesKredit;
            //echo json_encode($rsProsesKredit); die;

            $rsHistoryProsesKreditRM = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 12);
            $data['historyProsesKreditRM'] = $rsHistoryProsesKreditRM;
            //echo json_encode($rsHistoryProsesKreditRM); die;

            //$rsADK = $this->ProsesKredit_model->getUserInformation(17, $rsProsesKredit->DivisionId);
            $rsHistoryProsesKreditADK = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 17);
            //$data['adk'] = $rsADK;
            $data['historyProsesKreditADK'] = $rsHistoryProsesKreditADK;

            //$rsARK = $this->ProsesKredit_model->getUserInformation(18, $rsProsesKredit->DivisionId);
            $rsHistoryProsesKreditARK = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 18);
            //$data['ark'] = $rsARK;
            $data['historyProsesKreditARK'] = $rsHistoryProsesKreditARK;

            //$rsKomite = $this->ProsesKredit_model->getUserInformation(14, $rsProsesKredit->DivisionId);
            $rsHistoryProsesKreditKomite = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 14);
            //$data['komite'] = $rsKomite;
            $data['historyProsesKreditKomite'] = $rsHistoryProsesKreditKomite;

            $rsHistoryProsesKreditKadiv = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 16);
            $data['historyProsesKreditKadiv'] = $rsHistoryProsesKreditKadiv;

            $rsCommentKadiv = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 16, 0);
            $data['commentKadiv'] = $rsCommentKadiv;

            $role = $user['ROLE_ID'];
            switch($role){
                case 12:
                    $arrTujuanDiteruskan = array(17,18);
                    $rsTujuanDiteruskan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                    //echo json_encode($rsTujuanDiteruskan); die;

                    $rsTujuanDikembalikan = array();
                    //echo json_encode($rsTujuanDikembalikan); die;
                    break;
                case 14:
                    $arrTujuanDiteruskan = array(17);
                    $rsTujuanDiteruskan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                    //echo json_encode($rsTujuanDiteruskan); die;

                    $arrTujuanDikembalikan = array(17);
                    $rsTujuanDikembalikan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);                  
                    break;
                case 16:
                    $arrTujuanDiteruskan = array(17);
                    $rsTujuanDiteruskan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                    //echo json_encode($rsTujuanDiteruskan); die;

                    $arrTujuanDikembalikan = array(17);
                    $rsTujuanDikembalikan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);                  
                    break;
                case 17:
                    if(empty($rsHistoryProsesKreditARK)){
                        $arrTujuanDiteruskan = array(18);
                    }else $arrTujuanDiteruskan = array(14, 18);
                    
                    $rsTujuanDiteruskan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                    //echo json_encode($rsTujuanDiteruskan); die;
                    
                    $arrTujuanDikembalikan = array(12, 18);
                    $rsTujuanDikembalikan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);                  
                    break;
                case 18:
                    $arrTujuanDiteruskan = array(17);
                    $rsTujuanDiteruskan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                    //echo json_encode($rsTujuanDiteruskan); die;
                    
                    $arrTujuanDikembalikan = array(12,17);
                    $rsTujuanDikembalikan = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);                  
                    break;
                default:
                    $rsTujuanDiteruskan = array();
                    $rsTujuanDikembalikan = array();
                    break;
            }
            $data['tujuanDiteruskanOption'] = $rsTujuanDiteruskan;
            $data['tujuanDikembalikanOption'] = $rsTujuanDikembalikan;           

            //echo json_encode($rsHistoryProsesKreditKomite); die;

            //$historyProsesKredit = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId);

            $rsFasilitasPermohonan = $this->ProsesKredit_model->getFasilitasPermohonan($prosesKreditId);
            $data["fasilitasPermohonan"] = $rsFasilitasPermohonan;
            
            $pipelineId = $rsProsesKredit->PipelineId;
            $rsPipeline = $this->Pipeline_model->getDetailPipeline($pipelineId);
            $data['pipeline'] = $rsPipeline;

            $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
            foreach($rsProsesKreditDocument as $row){
                $rsProsesKreditDocumentStatus = $this->ProsesKredit_model->getProsesKreditDocumentStatus($prosesKreditId, $row->ProsesKreditDocumentId);
                if(!empty($rsProsesKreditDocumentStatus)){
                    $row->Status = $rsProsesKreditDocumentStatus[0]->Status;
                    $row->Description = $rsProsesKreditDocumentStatus[0]->Description;
                }else{
                    $row->Status = NULL;
                    $row->Description = NULL;
                }
            }
            $data["ProsesKreditDocument"] = $rsProsesKreditDocument;

            /* Set Kadiv and Wapinwil as a Komite */
            if($user["ROLE_ID"] == 16){
                $roleId = 14;
            }else{
                $roleId = $user["ROLE_ID"];
            }
            $data["roleId"] = $roleId;
            //echo json_encode($data); die;
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('monitoring/proses_kredit/DetailProsesKredit.php', $data);
            $this->load->view('layout/footer.php');
        }

        public function teruskan_proses_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $prosesKreditId = $this->input->post('prosesKreditId');
            $isApproved = 1;
            $tujuanDiteruskanId = $this->input->post('tujuanDiteruskanId');
            $comment = $this->input->post('comment');
            $currentDateTime = date("Y-m-d H:i:s");

            if($roleId == USER_ROLE_RM_MENENGAH){
                $waktuKunjungan = $this->input->post("waktu_kunjungan");
                $hasilKunjungan = $this->input->post("hasil_kunjungan");
            }else{
                $waktuKunjungan = null;
                $hasilKunjungan = null;
            }

            if($roleId == 16) $role = 14;
            else $role = $roleId;

            if($roleId == USER_ROLE_ADK && $tujuanDiteruskanId == 14){
                $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
                $arrDocumentProsesKredit =  array();
                foreach($rsProsesKreditDocument as $row){
                    $statusDoc = 0;
                    if($this->input->post("document_proses_kredit_".$row->ProsesKreditDocumentId) != null)
                        $statusDoc = 1;
                    $document = array(
                        "ProsesKreditId" => $prosesKreditId,
                        "ProsesKreditDocumentId" => $row->ProsesKreditDocumentId,
                        "Status" => $statusDoc,
                        "Description" => $this->input->post("desc_document_".$row->ProsesKreditDocumentId),
                        "ModifiedBy" => $userId,
                        "ModifiedDate" => $currentDateTime
                    );
                    array_push($arrDocumentProsesKredit, $document);
                }                
            }else $arrDocumentProsesKredit = array();
            
            $rsProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $StatusApplicationId = $rsProsesKredit->StatusApplicationId;
            if($StatusApplicationId == $role){
                // Putusan Hasil Komite
                if($roleId == 14 || $roleId == 16){
                    $putusanId = $this->input->post('putusanId');
                }else $putusanId = NULL;

                $data = array(
                    'prosesKreditId' => $prosesKreditId,
                    'isApproved' => $isApproved,
                    'tujuanId' => $tujuanDiteruskanId,
                    'comment' => $comment,
                    'putusanId' => $putusanId,
                    'waktuKunjungan' => $waktuKunjungan,
                    'hasilKunjungan' => $hasilKunjungan,
                    'arrDocumentProsesKredit' => $arrDocumentProsesKredit,
                    'userId' => $userId,
                    'roleId' => $role,
                    'divisionId' => $divisionId
                );
                $result = $this->ProsesKredit_model->updateStatusProsesKredit($data);
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Proses kredit sudah terupdate",
                    "event" => "Teruskan proses kredit failed"
                );
            }           
            echo json_encode($result);
        }

        public function akad_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $prosesKreditId = $this->input->post('prosesKreditId');
            $tanggalAkad = date('Y-m-d', strtotime(str_replace('/','-', $this->input->post('tanggalAkad'))));
            $notarisName = $this->input->post('notarisName');
            $desc = $this->input->post('desc');

            $data = array(
                'prosesKreditId' => $prosesKreditId,
                'tanggalAkad' => $tanggalAkad,
                'notarisName' => $notarisName,
                'desc' => $desc,
                'userId' => $userId,
                'roleId' => $roleId,
                'divisionId' => $divisionId
            );
            
            $result = $this->ProsesKredit_model->prosesAkadKredit($data);
            echo json_encode($result);
        }
    
        public function kembalikan_proses_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $prosesKreditId = $this->input->post('prosesKreditId');
            $isApproved = 0;
            $tujuanDikembalikanId = $this->input->post('tujuanDikembalikanId');
            $comment = $this->input->post('comment');
            $waktuKunjungan = null;
            $hasilKunjungan = null;
            $putusanId = NULL;
            $arrDocumentProsesKredit = null;

            $rsProsesKredit = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
            $StatusApplicationId = $rsProsesKredit->StatusApplicationId;

            if($roleId == 16) $role = 14;
            else $role = $roleId;

            if($StatusApplicationId == $role){
                $data = array(
                    'prosesKreditId' => $prosesKreditId,
                    'isApproved' => $isApproved,
                    'tujuanId' => $tujuanDikembalikanId,
                    'putusanId' => $putusanId,
                    'waktuKunjungan' => $waktuKunjungan,
                    'hasilKunjungan' => $hasilKunjungan,
                    'arrDocumentProsesKredit' => $arrDocumentProsesKredit,
                    'comment' => $comment,
                    'userId' => $userId,
                    'roleId' => $role,
                    'divisionId' => $divisionId
                );
                
                $flashmsg = '<br>Paket berhasil dikembalikan';
                /*
                if($this->ProsesKredit_model->updateStatusProsesKredit($data)){
                    $this->session->set_flashdata('Success', $flashmsg);
                    redirect('monitoring/proseskredit');
                }
                */
                $result = $this->ProsesKredit_model->updateStatusProsesKredit($data);
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Proses kredit sudah terupdate",
                    "event" => "Kembalikan proses kredit failed"
                );
            }
            echo json_encode($result);
        }

        public function multiple_comment(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $arrProsesKreditId = $this->input->post('id');
            if($this->input->post('comment') != NULL){
                $comment = $this->input->post('comment');
            }else $comment = NULL;
            $data = array(
                'arrProsesKreditId' => $arrProsesKreditId,
                'comment' => $comment,
                'userId' => $userId
            );
            $flashmsg = '<br>Comment has been successfully added!';
            if($this->ProsesKredit_model->multipleCommentProsesKredit($data)){
                $this->session->set_flashdata('Success', $flashmsg);
                redirect('monitoring/proseskredit');
            }
        }

        public function edit_tanggapan_lkn(){
            $userId = $this->session->PERSONAL_NUMBER;
            $prosesKreditId = $this->input->post("prosesKreditId");
            $tanggapanLKN = $this->input->post("tanggapan_lkn");
            $data = array(
                "ProsesKreditId" => $prosesKreditId,
                "Tanggapan" => $tanggapanLKN,
                "UserId" => $userId
            );
            $result = $this->ProsesKredit_model->updateTanggapan($data);
            echo json_encode($result);
        }
        
    }    
?>