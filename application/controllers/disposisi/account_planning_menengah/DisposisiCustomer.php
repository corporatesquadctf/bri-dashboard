<?php
    class DisposisiCustomer extends MY_Controller {
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
            $this->load->model("disposisi/account_planning_menengah/Disposisi_model","Disposisi_model");
            $this->load->model("data_transaction/account_planning_menengah/DataTransaction_model","DataTransaction_model");
      
            $current_datetime = new DateTime(date("Y-m-d H:i:s"));
            $this->current_year = $current_datetime->format("Y");
            $this->current_date = $current_datetime->format("Y-m-d");
            $this->current_datetime = $current_datetime->format("Y-m-d H:i:s");
        }

        public function index($rowNo = 0) {
            $this->checkModule();
            $data = array();

            $unitKerjaId = $_SESSION["DIVISION"];
            $limitPage = 5;

            $rsRm = $this->Disposisi_model->getListUser(USER_ROLE_RM_MENENGAH, $unitKerjaId);
            $data["rmList"] = $rsRm;

            /* Set Header Information */
            $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
            $data["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
            $data["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
            $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
            $data["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
            $data["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

            $totalRecords = $this->Disposisi_model->getTotalCustomerMenengah($unitKerjaId);
            if ($totalRecords > 0){
                $customerList = $this->Disposisi_model->getListOfCustomerMenengah($unitKerjaId, $limitPage, $rowNo);
                foreach($customerList as $row){
                    $row->ActiveProsesKredit = $this->Disposisi_model->getActiveProsesKredit($row->CIF);
                }
                $data["result"] = $customerList;

                $data['row'] = $rowNo;

                $config['base_url'] = base_url() . 'disposisi/account_planning_menengah/disposisi_customer/page';
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $totalRecords;
                $config['per_page'] = $limitPage;
                $config["uri_segment"] = 3;
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

                $data["links"] = $this->pagination->create_links();
            }
            
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('disposisi/disposisi_customer_menengah.php', $data);
            $this->load->view('layout/footer.php');
        }

        public function page($rowNo = 1) {
            $this->checkModule();
            $data = array();

            $unitKerjaId = $_SESSION["DIVISION"];
            $limitPage = 5;
            $rowNo = ($rowNo-1) * $limitPage;

            $rsRm = $this->Disposisi_model->getListUser(USER_ROLE_RM_MENENGAH, $unitKerjaId);
            $data["rmList"] = $rsRm;

            /* Set Header Information */
            $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
            $data["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
            $data["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
            $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
            $data["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
            $data["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

            $totalRecords = $this->Disposisi_model->getTotalCustomerMenengah($unitKerjaId);
            if ($totalRecords > 0){
                $customerList = $this->Disposisi_model->getListOfCustomerMenengah($unitKerjaId, $limitPage, $rowNo);
                foreach($customerList as $row){
                    $row->ActiveProsesKredit = $this->Disposisi_model->getActiveProsesKredit($row->CIF);
                }
                $data["result"] = $customerList;

                $data['row'] = $rowNo;

                $config['base_url'] = base_url() . 'disposisi/account_planning_menengah/disposisi_customer/page';
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $totalRecords;
                $config['per_page'] = $limitPage;
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

                $data["links"] = $this->pagination->create_links();
            }
            
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('disposisi/disposisi_customer_menengah.php', $data);
            $this->load->view('layout/footer.php');
        }

        public function search($searchTxt='', $rowNo = 0) {
            $this->checkModule();
            $data = array();

            if (empty($searchTxt)) {
                $searchTxt = ($this->input->post('txtcari')) ? $this->input->post('txtcari') : "";
            }
            else {
                $searchTxt = str_replace('_', ' ', $searchTxt);
            }
            $data['searchTxt'] = trim(str_replace(' ', '_', $searchTxt));
    
            if(empty(trim($searchTxt))) {
                header("location:".base_url() . "disposisi/account_planning_menengah/disposisi_customer");
            }

            $unitKerjaId = $_SESSION["DIVISION"];
            $limitPage = 5;

            $rsRm = $this->Disposisi_model->getListUser(USER_ROLE_RM_MENENGAH, $unitKerjaId);
            $data["rmList"] = $rsRm;

            /* Set Header Information */
            $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
            $data["totalPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["total"];
            $data["ratasPinjamanLastUpdateDate"] = $pinjamanLastUpdateDate["ratas"];
            $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
            $data["totalSimpananLastUpdateDate"] = $simpananLastUpdateDate["total"];
            $data["ratasSimpananLastUpdateDate"] = $simpananLastUpdateDate["ratas"];

            $totalRecords = $this->Disposisi_model->getTotalCustomerMenengah($unitKerjaId, $searchTxt);
            if ($totalRecords > 0){
                $customerList = $this->Disposisi_model->getListOfCustomerMenengah($unitKerjaId, $limitPage, $rowNo, $searchTxt);
                foreach($customerList as $row){
                    $row->ActiveProsesKredit = $this->Disposisi_model->getActiveProsesKredit($row->CIF);
                }
                $data["result"] = $customerList;

                $data['row'] = $rowNo;

                $config['base_url'] = base_url() . 'disposisi/account_planning_menengah/disposisi_customer/search/'.$data['searchTxt'];
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $totalRecords;
                $config['per_page'] = $limitPage;
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

                $data["links"] = $this->pagination->create_links();
            }
            
            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('disposisi/disposisi_customer_menengah.php', $data);
            $this->load->view('layout/footer.php');
        }

        public function process_disposisi() {
            $cif = $this->input->post("disposisiCIF");
            $rmId = $this->input->post("disposisiRMId");
            $createdBy = $this->session->PERSONAL_NUMBER;

            $disposisiStatus = $this->Disposisi_model->disposisiCustomerMenengah($cif, $rmId, $createdBy);
            echo json_encode($disposisiStatus);
          }
    }
?>