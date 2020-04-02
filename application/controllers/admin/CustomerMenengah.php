<?php
    class CustomerMenengah extends My_Controller{
        function __construct() {
            parent::__construct();
            $this->load->helper(array(
                "form",
                "url",
                "security"
            ));
            $this->load->library(array(
                "session",
                "form_validation"
            ));
            $this->load->helper("url");
            $this->load->library("session");
            $this->load->model("CustomerMenengah_model");

            $current_datetime = new DateTime(date('Y-m-d H:i:s'));
            $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
        }
        function index(){
            $this->checkModule();
            $data = array();
            
            $userId = $this->session->PERSONAL_NUMBER;
            $roleId = $this->session->ROLE_ID;
            $data["RoleId"] = $roleId;

            $rsIsActiveOption = array(["IsActiveId" => "1", "IsActiveName" => "Active"], 
                                      ["IsActiveId" => "0", "IsActiveName" => "Non Active"]);
            $data["IsActiveOption"] = $rsIsActiveOption;

            $rsCustomerTypeOption = $this->CustomerMenengah_model->getCustomerTypeOption();
            $data["CustomerTypeOption"] = $rsCustomerTypeOption;

            if($this->input->post()){
                if($roleId == USER_ROLE_RM_MENENGAH || $roleId == USER_ROLE_ADMIN_WILAYAH){
                    $unitKerjaId = $this->session->DIVISION;
                }else{
                    $unitKerjaId = $this->input->post("unitKerjaId");
                }
                $isActiveId = $this->input->post("isActiveId");
                $keyword = $this->input->post("keyword");
            }else{
                if($roleId == USER_ROLE_RM_MENENGAH || $roleId == USER_ROLE_ADMIN_WILAYAH){
                    $unitKerjaId = $this->session->DIVISION;
                }else{
                    $unitKerjaId = "all";
                }
                $isActiveId = "all";
                $keyword = NULL;
            }
            $data["UnitKerjaId"] = $unitKerjaId;
            $data["IsActiveId"] = $isActiveId;
            $data["Keyword"] = $keyword;

            $rsUnitKerjaOption = $this->CustomerMenengah_model->getUnitKerjaOption($unitKerjaId);
            $data["UnitKerjaOption"] = $rsUnitKerjaOption;

            $params = array(
                "UserId" => $userId,
                "RoleId" => $roleId,
                "UnitKerjaId" => $unitKerjaId,
                "IsActiveId" => $isActiveId,
                "Keyword" => $keyword
            );

            $rsCustomerMenengah = $this->CustomerMenengah_model->getListOfCustomerMenengah($params);
            $data["CustomerMenengah"] = $rsCustomerMenengah;

            if($roleId == USER_ROLE_RM_MENENGAH || $roleId == USER_ROLE_ADMIN_WILAYAH){
                $classDropdownWilayah = "readonly disabled";
                $classWilayah = "readonly";
                $isRequired = "";
                if($roleId == USER_ROLE_ADMIN_WILAYAH){
                    $classWilayah = "";
                }
                if($roleId == USER_ROLE_RM_MENENGAH){
                    $isRequired = "required";
                }
            }else{
                $classDropdownWilayah = "";
                $classWilayah = "";
                $isRequired = "";
            }
            $data["classDropdownWilayah"] = $classDropdownWilayah;
            $data["classWilayah"] = $classWilayah;
            $data["isRequired"] = $isRequired;

            //echo json_encode($data); die;
            $this->load->view("layout/header");
            $this->load->view("layout/side-nav");
            $this->load->view("layout/top-nav");
            $this->load->view("backend/master_data/customer_menengah", $data);
            $this->load->view("layout/footer.php");
        }
        public function add_customer(){
            $this->checkModule();

            $userId = $this->session->PERSONAL_NUMBER;
            $currentDate = $this->current_datetime;
            $CIF = $this->input->post("addCIF");
            $customerName = $this->input->post("addName");
            $customerMenengahTypeId = $this->input->post("addType") != 0 ? $this->input->post("addType") : NULL ;
            $NPWP = $this->input->post("addNPWP");
            $address = $this->input->post("addAddress");
            $contactPerson = $this->input->post("addCP");
            $phoneNumber = $this->input->post("addPhone");
            $unitKerjaId = $this->input->post("addUnitKerjaId") != 0 ? $this->input->post("addUnitKerjaId") : NULL;
            $isActive = $this->input->post("addIsActive") != 0 ? $this->input->post("addIsActive") : NULL;

            $data = array(
                "CIF" => $CIF,
                "CustomerName" => $customerName,
                "CustomerMenengahTypeId" => $customerMenengahTypeId,
                "NPWP" => $NPWP,
                "Address" => $address,
                "ContactPerson" => $contactPerson,
                "PhoneNumber" => $phoneNumber,
                "UnitKerjaId" => $unitKerjaId,
                "IsActive" => $isActive,
                "CreatedBy" => $userId,
                "CreatedDate" => $currentDate
            );

            $result = $this->CustomerMenengah_model->addCustomer($data);
            echo json_encode($result);
        }
        public function edit_customer(){
            $this->checkModule();

            $userId = $this->session->PERSONAL_NUMBER;
            $currentDate = $this->current_datetime;
            $CIF = $this->input->post("editCIF");
            $oldCIF = $this->input->post("oldCIF");
            $customerName = $this->input->post("editName");
            $customerMenengahTypeId = $this->input->post("editType") != 0 ? $this->input->post("editType") : NULL ;
            $NPWP = $this->input->post("editNPWP");
            $address = $this->input->post("editAddress");
            $contactPerson = $this->input->post("editCP");
            $phoneNumber = $this->input->post("editPhone");
            $unitKerjaId = $this->input->post("editUnitKerjaId") != 0 ? $this->input->post("editUnitKerjaId") : NULL;
            $isActive = $this->input->post("editIsActive") != 0 ? $this->input->post("editIsActive") : NULL;

            $data = array(
                "CIF" => $CIF,
                "CustomerName" => $customerName,
                "CustomerMenengahTypeId" => $customerMenengahTypeId,
                "NPWP" => $NPWP,
                "Address" => $address,
                "ContactPerson" => $contactPerson,
                "PhoneNumber" => $phoneNumber,
                "UnitKerjaId" => $unitKerjaId,
                "IsActive" => $isActive,
                "ModifiedBy" => $userId,
                "ModifiedDate" => $currentDate
            );

            $result = $this->CustomerMenengah_model->updateCustomer($data, $oldCIF);
            echo json_encode($result);
        }
        public function serviceCheckCIFCustomer(){
            if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
            $this->checkModule();
            
            $cif = $this->input->post("cif");
            $oldcif = !empty($this->input->post("oldcif"))? $this->input->post("oldcif") : NULL;
            $result = $this->CustomerMenengah_model->serviceCheckCIFCustomer($cif, $oldcif);
            echo $result;
        }
        public function serviceCheckNPWPCustomer(){
            if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");

            $this->checkModule();
            $data = array();

            $cif = $this->input->post("cif");
            $npwp = $this->input->post("npwp");
            $data = array(
                "CIF" => $cif,
                "NPWP" => $npwp
            );
            $result = $this->CustomerMenengah_model->serviceCheckNPWPCustomer($data);
            echo $result;
        }
    }
?>