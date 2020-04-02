<?php 
    class FTP_Position extends MY_Controller {
        function __construct() {
            parent::__construct();
            $this->load->helper(array(
                "form",
                "url",
                "security"
            ));
            $this->load->library(array(
                "session",
                "form_validation",
                "pagination"
            ));

            $this->load->model("FTP_Position_model");

            $current_datetime = new DateTime(date('Y-m-d H:i:s'));
            $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
        }

        public function index(){
            $data = array();

            $rsFTP = $this->FTP_Position_model->getFTPGroup();
            foreach($rsFTP as $row){
                $rsFTPItem = $this->FTP_Position_model->getFTPItem($row->FTPGroupId);
                $row->FTPItems = $rsFTPItem;
                
                foreach($rsFTPItem as $rowItem){
                    switch($row->FTPGroupId){
                        case 1: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemSimpanan", $rowItem->FTPItemId);
                                break;
                        case 2: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemDeposito", $rowItem->FTPItemId);
                                break;
                        case 3: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemDepositoValas", $rowItem->FTPItemId);
                                break;
                        case 4: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemPinjaman", $rowItem->FTPItemId);
                                break;
                        case 5: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemTransitInterest", $rowItem->FTPItemId);
                                break;
                        case 6: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemPinjamanValas", $rowItem->FTPItemId);
                                break;
                        case 7: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemPrimeLandingRate", $rowItem->FTPItemId);
                                break;
                        case 8: $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemFTP", $rowItem->FTPItemId);
                                break;
                    }
                    $rowItem->FTPDetail = $rsDetailFTP;
                }
            }
            $data["FTP"] = $rsFTP;

            //echo json_encode($data); die;

            $this->load->view("layout/header");
            $this->load->view("layout/side-nav");
            $this->load->view("layout/top-nav");
            $this->load->view("ftp/ftp_position", $data);
            $this->load->view("layout/footer");
        }

        public function edit_ftp_position($FTPItemId){
            $rsFTP = $this->FTP_Position_model->getFTP($FTPItemId);
            //$data["DetailFTP"] = $rsDetailFTP[0];

            switch($rsFTP[0]->FTPGroupId){
                case 1: $page = "ftp/simpanan";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemSimpanan", $FTPItemId);
                        break;
                case 2: $page = "ftp/deposito";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemDeposito", $FTPItemId);
                        break;
                case 3: $page = "ftp/deposito_valas";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemDepositoValas", $FTPItemId);
                        break;
                case 4: $page = "ftp/pinjaman";
                        $rsDetailFTP =  $this->FTP_Position_model->getFTPDetail("FTPItemPinjaman", $FTPItemId);
                        break;
                case 5: if($FTPItemId == 8 || $FTPItemId == 9) $page = "ftp/transit_interest";
                        if($FTPItemId == 10 || $FTPItemId == 11) $page = "ftp/scf";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemTransitInterest", $FTPItemId);
                        break;
                case 6: $page = "ftp/pinjaman_valas";
                        $rsDetailFTP =  $this->FTP_Position_model->getFTPDetail("FTPItemPinjamanValas", $FTPItemId);
                        break;
                case 7: $page = "ftp/prime_lending_rate";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemPrimeLandingRate", $FTPItemId);
                        break;
                case 8: $page = "ftp/ftp";
                        $rsDetailFTP = $this->FTP_Position_model->getFTPDetail("FTPItemFTP", $FTPItemId);
                        break;
            }

            $rsFTP[0]->FTPDetail = $rsDetailFTP;
            $data = $rsFTP[0];
            //echo json_encode($data); die;

            $this->load->view("layout/header");
            $this->load->view("layout/side-nav");
            $this->load->view("layout/top-nav");
            $this->load->view($page, $data);
            $this->load->view("layout/footer");
        }

        public function process_edit_simpanan(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            $dataSimpanan = explode(",",$this->input->post("arrSimpanan"));
            $arrSimpanan = array();
            foreach($dataSimpanan as $row){
                if($this->input->post("topMargin_".$row) == ""){
                    $topMargin = null;
                }else{
                    $topMargin = str_replace(",","",$this->input->post("topMargin_".$row));
                }
                $simpanan = array(
                    "FTPItemSimpananId" => $this->input->post("FTPItemSimpananId_".$row),
                    "BottomMargin" => str_replace(",","",$this->input->post("bottomMargin_".$row)),
                    "TopMargin" => $topMargin,
                    "InterestRate" => str_replace(",","",$this->input->post("interestRate_".$row)),
                    "IsActive" => 1
                );
                array_push($arrSimpanan, $simpanan);
            }

            $data = array(
                "FTPItemId" => $FTPItemId,
                "ArrSimpanan" => $arrSimpanan,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );
            
            $result = $this->FTP_Position_model->insertFTPSimpanan($data);
            echo json_encode($result);
        }

        public function process_edit_deposito(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            $dataDeposito = explode(",",$this->input->post("arrDeposito"));
            $arrDeposito = array();
            foreach($dataDeposito as $row){
                $deposito = array(
                    "FTPItemDepositoId" => $this->input->post("FTPItemDepositoId_".$row),
                    "Term" => str_replace(",","",$this->input->post("term_".$row)),
                    "InterestRate" => str_replace(",","",$this->input->post("interestRate_".$row)),
                    "IsActive" => 1
                );
                array_push($arrDeposito, $deposito);
            }

            $data = array(
                "FTPItemId" => $FTPItemId,
                "ArrDeposito" => $arrDeposito,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );
            
            $result = $this->FTP_Position_model->insertFTPDeposito($data);
            echo json_encode($result);
        }

        public function process_edit_deposito_valas(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            $dataDepositoValas = explode(",",$this->input->post("arrDepositoValas"));
            $arrDepositoValas = array();
            foreach($dataDepositoValas as $row){
                $depositoValas = array(
                    "FTPItemDepositoValasId" => $this->input->post("FTPItemDepositoValasId_".$row),
                    "Term" => str_replace(",","",$this->input->post("term_".$row)),
                    "InterestRateLess" => str_replace(",","",$this->input->post("interestRateLess_".$row)),
                    "InterestRateMore" => str_replace(",","",$this->input->post("interestRateMore_".$row)),
                    "IsActive" => 1
                );
                array_push($arrDepositoValas, $depositoValas);
            }

            $data = array(
                "FTPItemId" => $FTPItemId,
                "ArrDepositoValas" => $arrDepositoValas,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );
            
            $result = $this->FTP_Position_model->insertFTPDepositoValas($data);
            echo json_encode($result);
        }

        public function process_edit_pinjaman(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            
            $data = array(
                "FTPItemId" => $FTPItemId,
                "Description" => $this->input->post("desc"),
                "BottomMarginInterestRate" => str_replace(",","",$this->input->post("bottomMarginInterestRate")),
                "TopMarginInterestRate" => str_replace(",","",$this->input->post("topMarginInterestRate")),
                "IsActive" => 1,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );

            $result = $this->FTP_Position_model->insertFTPPinjaman($data);
            echo json_encode($result);
        }

        public function process_edit_transit_interest(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            
            $data = array(
                "FTPItemId" => $FTPItemId,
                "Description" => $this->input->post("desc"),
                "BottomMarginInterestRate" => str_replace(",","",$this->input->post("bottomMarginInterestRate")),
                "TopMarginInterestRate" => str_replace(",","",$this->input->post("topMarginInterestRate")),
                "IsActive" => 1,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );
            $result = $this->FTP_Position_model->insertFTPTransitInterest($data);
            echo json_encode($result);
        }

        public function process_edit_scf(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            $dataSCF = explode(",",$this->input->post("arrSCF"));
            $arrSCF = array();
            foreach($dataSCF as $row){
                if($this->input->post("topMargin_".$row) == ""){
                    $topMargin = null;
                }else{
                    $topMargin = str_replace(",","",$this->input->post("topMargin_".$row));
                }

                if($this->input->post("bottomMargin_".$row) == ""){
                    $bottomMargin = null;
                }else{
                    $bottomMargin = str_replace(",","",$this->input->post("bottomMargin_".$row));
                }
                $SCF = array(
                    "FTPItemTransitInterestId" => $this->input->post("FTPItemTransitInterestId_".$row),
                    "BottomMargin" => $bottomMargin,
                    "TopMargin" => $topMargin,
                    "InterestRate" => $this->input->post("interestRate_".$row),
                    "IsActive" => 1
                );
                array_push($arrSCF, $SCF);
            }

            $data = array(
                "FTPItemId" => $FTPItemId,
                "ArrSCF" => $arrSCF,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );

            $result = $this->FTP_Position_model->insertFTPSCF($data);
            echo json_encode($result);
        }

        public function process_edit_pinjaman_valas(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            
            $data = array(
                "FTPItemId" => $FTPItemId,
                "Description" => $this->input->post("desc"),
                "BottomMarginInterestRate" => str_replace(",","",$this->input->post("bottomMarginInterestRate")),
                "TopMarginInterestRate" => str_replace(",","",$this->input->post("topMarginInterestRate")),
                "IsActive" => 1,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );

            $result = $this->FTP_Position_model->insertFTPPinjamanValas($data);
            echo json_encode($result);
        }

        public function process_edit_prime_lending_rate(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");
            
            $data = array(
                "FTPItemId" => $FTPItemId,
                "SBDK" => $this->input->post("sbdk"),
                "KreditKorporasi" => str_replace(",","",$this->input->post("kreditKorporasi")),
                "IsActive" => 1,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );

            $result = $this->FTP_Position_model->insertFTPPrimeLendingRate($data);
            echo json_encode($result);
        }

        public function process_edit_ftp(){
            $userId = $this->session->PERSONAL_NUMBER;
            $FTPItemId = $this->input->post("FTPItemId");

            $arrFTP = array();
            for($i=0; $i<2; $i++){
                $ftp = array(
                    "FTPItemFTPId" => $this->input->post("FTPItemFTPId_".$i),
                    "Description" => $this->input->post("desc_".$i),
                    "InterestRate" => str_replace(",","",$this->input->post("interestRate_".$i)),
                    "IsActive" => 1
                );
                array_push($arrFTP, $ftp);
            }
            
            $data = array(
                "FTPItemId" => $FTPItemId,
                "ArrFTP" => $arrFTP,
                "CurrentDate" => $this->current_datetime,
                "UserId" => $userId
            );

            $result = $this->FTP_Position_model->insertFTP($data);
            echo json_encode($result);
        }
    }
?>