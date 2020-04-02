<?php

    class Value_chain extends My_Controller{
        function __construct() {
            parent::__construct();
            $this->load->helper(array(
                'form',
                'url',
                'security'
            ));
            $this->load->library(array(
                'session',
                'form_validation'
            ));
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Value_chain_model");

            $current_datetime = new DateTime(date("Y-m-d H:i:s"));
            $this->current_datetime = $current_datetime->format("Y-m-d H:i:s");
        }

        function index(){
            $this->checkModule();

            $rsUnitKerjaOption = $this->Value_chain_model->getUnitKerjaOption(2);
            $data["UnitKerjaOption"] = $rsUnitKerjaOption;

            if($this->session->ROLE_ID == USER_ROLE_SUPER_USER_MENENGAH){
                $disabled = "";
                $ukerId = null;
            }else{
                $disabled = "readonly disabled";
                $ukerId = $this->session->DIVISION;
            }
            $data["disabled"] = $disabled;
            $data["ukerId"] = $ukerId;

            $year = date("Y");
            
            $filter = array(
                "UnitKerjaId" => $ukerId,
                "Year" => $year
            );

            $rsValueChain = $this->Value_chain_model->getDataValueChain($filter);
            $data["ValueChain"] = $rsValueChain;

            $this->load->view("layout/header.php");
            $this->load->view("layout/side-nav.php");
            $this->load->view("layout/top-nav.php");
            $this->load->view("backend/master_data/value_chain.php", $data);
            $this->load->view("layout/footer.php");
        }

        public function processUploadFile(){
            $userId = $this->session->PERSONAL_NUMBER;
            $unitKerjaId = $this->input->post("unitKerjaId");
            $year = date("Y");

            /* Config Destination Path */
            $fullPath = "./uploads/value_chain/".$unitKerjaId;
            if(is_dir($fullPath) === false){
                mkdir($fullPath, 0755, true);
            }

            /* Config File Upload */
            $config["upload_path"] = $fullPath;
            $config["allowed_types"] = "*";
            $config["max_filename"] = "255";
            $config["encrypt_name"] = false;
            $config["max_size"] = "";
            $config["overwrite"] = true;

            /* Move File Upload */
            $status = "success";
            $message = "";
            if (isset($_FILES["fileUpload"]["name"])){
                $data = array(
                    "Filename" => str_replace(" ","_", $_FILES["fileUpload"]["name"]),
                    "UnitKerjaId" => $unitKerjaId,
                    "Year" => $year,
                    "IsActive" => 1,
                    "CreatedBy" => $userId,
                    "CreatedDate" => $this->current_datetime
                );
                $rs = $this->Value_chain_model->insertValueChain($data);
                if($rs["status"] == "success"){
                    $config["file_name"] = str_replace(" ","_", $_FILES["fileUpload"]["name"]);
                    $this->load->library("upload", $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("fileUpload")){
                        $status = "error";
                        $message = $this->upload->display_errors("","");
                    }
                }else{
                    $status = $rs["status"];
                    $message = $rs["message"];
                }
            }else{
                $status = "error";
                $message = "No file selected";
            }            

            $data = array(
                "status" => $status,
                "message" => $message
            );
            echo json_encode($data);
        }
    }
?>