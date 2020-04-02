<?php
    class Portofolio_kredit extends MY_Controller {
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
                $this->load->model('PortofolioKredit_model');
                $this->load->model('PortofolioRm_model');
                $this->load->model("ProsesKredit_model");
                $this->load->model("Pipeline_model");

                $current_datetime = new DateTime(date('Y-m-d H:i:s'));
                $this->current_datetime = $current_datetime->format('Y-m-d H:i:s'); 
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

            $rsPortofolioKredit = $this->PortofolioKredit_model->getPortofolioKredit($filter);
            $data['PortofolioKredit'] = $rsPortofolioKredit; 

            //echo json_encode($data); die;

            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('monitoring/portofolio_kredit/PortofolioKredit.php', $data);
            $this->load->view('layout/footer.php');        
        }

        public function multiple_comment(){
            $userId = $this->session->PERSONAL_NUMBER;
            $arrPortofolioKreditId = $this->input->post("id");
            if($this->input->post("comment") != NULL){
                $comment = $this->input->post("comment");
            }else $comment = NULL;
            $data = array(
                "ArrPortofolioKreditId" => $arrPortofolioKreditId,
                "Comment" => $comment,
                "UserId" => $userId,
                "CurrentDate" => $this->current_datetime
            );
            $result = $this->PortofolioKredit_model->multipleComment($data);
            echo json_encode($result);
        }

        public function detail(){
            $this->checkModule();
            $user = $this->session->all_userdata();
            $data['user'] = $user;

            $portofolioKreditId = $this->uri->segment(4);
            $rsPortofolioKredit = $this->PortofolioKredit_model->getDetailPortofolioKredit($portofolioKreditId);
            $data['PortofolioKredit'] = $rsPortofolioKredit;
            
            $rsHistoryProsesPortofolioRM = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 12);
            $data['historyPortofolioKreditRM'] = $rsHistoryProsesPortofolioRM;
            
            $rsHistoryPortofolioKreditADK = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 17);
            $data['historyPortofolioKreditADK'] = $rsHistoryPortofolioKreditADK;

            $rsHistoryPortofolioKreditARK = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 18);
            $data['historyPortofolioKreditARK'] = $rsHistoryPortofolioKreditARK;

            $rsHistoryPortofolioKreditKomite = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 14);
            $data['historyPortofolioKreditKomite'] = $rsHistoryPortofolioKreditKomite;

            $rsHistoryPortofolioKreditKadiv = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 16);
            $data['historyPortofolioKreditKadiv'] = $rsHistoryPortofolioKreditKadiv;

            $rsCommentKadiv = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 16, 0);
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
                    if(empty($rsHistoryPortofolioKreditARK)){
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

            $rsFasilitasPermohonan = $this->PortofolioKredit_model->getFasilitasPermohonan($portofolioKreditId);
            $data["fasilitasPermohonan"] = $rsFasilitasPermohonan;

            $noRekening = $rsPortofolioKredit->NoRekening;
            $periode = $rsPortofolioKredit->Periode;
            $rsPortofolio = $this->PortofolioRm_model->getDetailPortofolioKredit($noRekening, $periode);
            $data['portofolio'] = $rsPortofolio;

            //$rsPortofolioKreditDocument = $this->PortofolioKredit_model->getPortofolioKreditDocument();
            //$data["PortofolioKreditDocument"] = $rsPortofolioKreditDocument;

            $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
            foreach($rsProsesKreditDocument as $row){
                $rsProsesKreditDocumentStatus = $this->PortofolioKredit_model->getPortofolioKreditDocumentStatus($portofolioKreditId, $row->ProsesKreditDocumentId);
                if(!empty($rsProsesKreditDocumentStatus)){
                    $row->Status = $rsProsesKreditDocumentStatus[0]->Status;
                    $row->Description = $rsProsesKreditDocumentStatus[0]->Description;
                }else{
                    $row->Status = NULL;
                    $row->Description = NULL;
                }
            }
            $data["PortofolioKreditDocument"] = $rsProsesKreditDocument;

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
            $this->load->view('monitoring/portofolio_kredit/DetailPortofolioKredit.php', $data);
            $this->load->view('layout/footer.php');
        }

        public function teruskan_proses_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $portofolioKreditId = $this->input->post("portofolioKreditId");
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
                $rsPortofolioKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
                $arrDocumentPortofolioKredit =  array();
                foreach($rsPortofolioKreditDocument as $row){
                    $statusDoc = 0;
                    if($this->input->post("document_portofolio_kredit_".$row->ProsesKreditDocumentId) != null)
                        $statusDoc = 1;
                    $document = array(
                        "PortofolioKreditId" => $portofolioKreditId,
                        "PortofolioKreditDocumentId" => $row->ProsesKreditDocumentId,
                        "Status" => $statusDoc,
                        "Description" => $this->input->post("desc_document_".$row->ProsesKreditDocumentId),
                        "ModifiedBy" => $userId,
                        "ModifiedDate" => $currentDateTime
                    );
                    array_push($arrDocumentPortofolioKredit, $document);
                }                
            }else $arrDocumentPortofolioKredit = array();
            
            $rsPortofolioKredit = $this->PortofolioKredit_model->getDetailPortofolioKredit($portofolioKreditId);
            $StatusApplicationId = $rsPortofolioKredit->StatusApplicationId;
            if($StatusApplicationId == $role){
                // Putusan Hasil Komite
                if($roleId == 14 || $roleId == 16){
                    $putusanId = $this->input->post('putusanId');
                }else $putusanId = NULL;

                $data = array(
                    'portofolioKreditId' => $portofolioKreditId,
                    'isApproved' => $isApproved,
                    'tujuanId' => $tujuanDiteruskanId,
                    'comment' => $comment,
                    'putusanId' => $putusanId,
                    'waktuKunjungan' => $waktuKunjungan,
                    'hasilKunjungan' => $hasilKunjungan,
                    'arrDocumentPortofolioKredit' => $arrDocumentPortofolioKredit,
                    'userId' => $userId,
                    'roleId' => $role,
                    'divisionId' => $divisionId
                );
                //echo json_encode($data); die;
                $result = $this->PortofolioKredit_model->updateStatusPortofolioKredit($data);
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Proses kredit sudah terupdate",
                    "event" => "Teruskan proses kredit failed"
                );
            }           
            echo json_encode($result);
        }

        public function edit_tanggapan_lkn(){
            $userId = $this->session->PERSONAL_NUMBER;
            $portofolioKreditId = $this->input->post("tanggapan_portofolioKreditId");
            $tanggapanLKN = $this->input->post("tanggapan_lkn");
            $data = array(
                "PortofolioKreditId" => $portofolioKreditId,
                "Tanggapan" => $tanggapanLKN,
                "UserId" => $userId
            );
            $result = $this->PortofolioKredit_model->updateTanggapan($data);
            echo json_encode($result);
        }

        public function kembalikan_proses_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $portofolioKreditId = $this->input->post('kembalikan_portofolioKreditId');
            $isApproved = 0;
            $tujuanDikembalikanId = $this->input->post('tujuanDikembalikanId');
            $comment = $this->input->post('kembalikan_comment');
            $waktuKunjungan = null;
            $hasilKunjungan = null;
            $putusanId = NULL;
            $arrDocumentPortofolioKredit = null;

            $rsPortofolioKredit = $this->PortofolioKredit_model->getDetailPortofolioKredit($portofolioKreditId);
            $StatusApplicationId = $rsPortofolioKredit->StatusApplicationId;

            if($roleId == 16) $role = 14;
            else $role = $roleId;

            if($StatusApplicationId == $role){
                $data = array(
                    'portofolioKreditId' => $portofolioKreditId,
                    'isApproved' => $isApproved,
                    'tujuanId' => $tujuanDikembalikanId,
                    'putusanId' => $putusanId,
                    'waktuKunjungan' => $waktuKunjungan,
                    'hasilKunjungan' => $hasilKunjungan,
                    'arrDocumentPortofolioKredit' => $arrDocumentPortofolioKredit,
                    'comment' => $comment,
                    'userId' => $userId,
                    'roleId' => $role,
                    'divisionId' => $divisionId
                );                
                $result = $this->PortofolioKredit_model->updateStatusPortofolioKredit($data);
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Portofolio kredit sudah terupdate",
                    "event" => "Kembalikan portofolio kredit failed"
                );
            }
            echo json_encode($result);
        }

        public function akad_kredit(){
            $user = $this->session->all_userdata();
            $userId = $user['USER_ID'];
            $divisionId = $user['DIVISION'];
            $roleId = $user['ROLE_ID'];
            $portofolioKreditId = $this->input->post('akad_portofolioKreditId');
            $tanggalAkad = date('Y-m-d', strtotime(str_replace('/','-', $this->input->post('tanggalAkad'))));
            $notarisName = $this->input->post('notarisName');
            $desc = $this->input->post('desc');

            $data = array(
                'portofolioKreditId' => $portofolioKreditId,
                'tanggalAkad' => $tanggalAkad,
                'notarisName' => $notarisName,
                'desc' => $desc,
                'userId' => $userId,
                'roleId' => $roleId,
                'divisionId' => $divisionId
            );

            $result = $this->PortofolioKredit_model->prosesAkadKredit($data);
            echo json_encode($result);
        }        
    }    
?>