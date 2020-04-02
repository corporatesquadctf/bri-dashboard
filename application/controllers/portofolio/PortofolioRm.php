<?php
    class PortofolioRm Extends MY_Controller {

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
            $this->load->model("PortofolioRm_model");
            $this->load->model("Pipeline_model");
        }

        public function index($rowNo=0){
            $this->checkModule();
            $data = array();
            $limitPage = 1;
            
            if($this->input->post()){
                $keyword = $this->input->post("keyword");
            }else{
                $keyword = NULL;
            }
            $data["keyword"] = $keyword;

            $arrColors = Array(
                "#EBD618", 
                "#46CEB6", 
                "#9522F0", 
                "#1998DF", 
                "#F86D43", 
                "#FF62EF", 
                "#455C73", 
                "#9B59B6", 
                "#BDC3C7", 
                "#26B99A", 
                "#3498DB"
            );

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

            $rs_facility = $this->Pipeline_model->getFacilityOption();
            $data['fasilitasOption'] = $rs_facility;
            $fasilitas_option = "";
            foreach($rs_facility as $row){
                $fasilitas_option .= "<option value='".$row->FacilityId."'>".$row->FacilityName."</option>";
            }
            $data['facility_option'] = $fasilitas_option;

            //$currentYear = date("Y");
            $currentYear = 2018;
            $lastYear = $currentYear-1;
            $arrPeriode = array();
            $arrPeriode[] = $lastYear."-12";
            for($i = 1; $i <= 12; $i++) {
                if($i<10) $m = "0".$i;
                else $m = $i;
                $arrPeriode[] = $currentYear."-".$m;
            }
            $arrPeriodeLabel = array();
            foreach($arrPeriode as $row){
                array_push($arrPeriodeLabel, date("F Y", strtotime($row)));
            }
            $data["Labels"] = $arrPeriodeLabel;            
            
            //$lastPosition = strtotime("first day of previous month");
            //$month = date("m", $lastPosition);
            //$year  = date("Y", $lastPosition);
            $month = 7;
            $year  = 2018;

            $totalRecords = $this->PortofolioRm_model->getTotalCustomer($this->session->PERSONAL_NUMBER, $month, $year, $keyword);
            
            if($totalRecords > 0){
                $rsCustomer = $this->PortofolioRm_model->getAllCustomer($this->session->PERSONAL_NUMBER, $limitPage, $rowNo, $month, $year, $keyword);
                foreach($rsCustomer as $row){
                    $cif = $row->Cif;
                    $arrNoRekeningKredit = array();

                    /* Get Data Kredit */
                    $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($this->session->PERSONAL_NUMBER, $cif, $month, $year);
                    $totalPlafondKredit = 0;
                    $indexRekeningKredit = 0;
                    $tglRealisasiMinimum = strtotime(date("Y-m-d"));
                    foreach($rsRekeningKredit as $rowRekeningKredit){
                        $noRekening = $rowRekeningKredit->NoRekening;
                        $arrNoRekeningKredit[] = $noRekening;
                        $arrOutstandingKredit = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsOutstandingKredit = $this->PortofolioRm_model->getOutstandingKredit($this->session->PERSONAL_NUMBER, $cif, $noRekening, $rowPeriode);
                            if(!empty($rsOutstandingKredit)){
                                $arrOutstandingKredit[] = $rsOutstandingKredit[0]->PlafonEfektif;
                            }else{
                                $arrOutstandingKredit[] = 0;
                            }
                        endforeach;
                        
                        $tglRealisasi = strtotime($rowRekeningKredit->TglRealisasi);
                        if($tglRealisasi < $tglRealisasiMinimum) $tglRealisasiMinimum = $tglRealisasi;

                        switch($rowRekeningKredit->JenisPenggunaan){
                            case 1: $rowRekeningKredit->JenisPenggunaan = "KI"; break;
                            case 2: $rowRekeningKredit->JenisPenggunaan = "KMK"; break;
                            default: $rowRekeningKredit->JenisPenggunaan = ""; break;
                        }
                        $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
                        $rowRekeningKredit->DatasetKredit = $arrOutstandingKredit;
                        $rowRekeningKredit->Warna = $arrColors[$indexRekeningKredit];
                        $indexRekeningKredit++;
                    }

                    /* Get Data Simpanan */
                    $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);
                    $indexRekeningSimpanan = 0;
                    foreach($rsRekeningSimpanan as $rowRekeningSimpanan){
                        $noRekening = $rowRekeningSimpanan->NoRekening;
                        $arrInstandingSimpanan = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                            if(!empty($rsInstandingSimpanan)){
                                $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                            }else{
                                $arrInstandingSimpanan[] = 0;
                            }
                        endforeach;
                        $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
                        $rowRekeningSimpanan->Warna = $arrColors[$indexRekeningSimpanan];
                        $indexRekeningSimpanan++;
                    }
                    
                    /* Get Total and Average Outstanding Kredit */
                    $arrTotalOutstandingKredit = array();
                    $arrAverageOutstandingKredit = array();
                    for($i=0; $i<count($arrPeriode); $i++){
                        $totalOutstandingKredit = 0;
                        foreach($rsRekeningKredit as $rowRekeningKredit){
                            $plafonEfektif = $rowRekeningKredit->DatasetKredit[$i];
                            $totalOutstandingKredit += $plafonEfektif;
                        }
                        $arrTotalOutstandingKredit[] = $totalOutstandingKredit;
                        $arrAverageOutstandingKredit[] = number_format(($totalOutstandingKredit / $totalPlafondKredit) * 100, 2);
                    }

                    /* Calculate Delta Outstanding Kredit */
                    $arrTotalDeltaOutstanding = array();
                    $totalDelta = 0;
                    for($i=0; $i<count($arrTotalOutstandingKredit); $i++){
                        if($i==0){
                            $selisih = 0;
                            $arrTotalDeltaOutstanding[] = 0;
                        } else {
                            $selisih = $arrTotalOutstandingKredit[$i] - $arrTotalOutstandingKredit[$i - 1];
                            $arrTotalDeltaOutstanding[] = $selisih;
                        }
                        $totalDelta += $selisih;
                    }
                    
                    $tahunRealisasi = date("Y", $tglRealisasiMinimum);
                    $bulanRealisasi = date("m", $tglRealisasiMinimum);
                    if($tahunRealisasi < $year){
                        if($month == 12) $month = 0;
                        $totalBulan = $month + 1;
                    }else {
                        if($month == 12) $month = 0;
                        $totalBulan = $month - $bulanRealisasi + 1;
                    }

                    $row->AverageDelta = number_format($totalDelta / $totalBulan, 2);
                    $row->TotalPlafondKredit = $totalPlafondKredit;
                    $row->DetailRekeningKredit = $rsRekeningKredit;
                    $row->DetailRekeningSimpanan = $rsRekeningSimpanan;
                    $row->TotalOutstandingKredit = $arrTotalOutstandingKredit;
                    $row->AverageOutstandingKredit = $arrAverageOutstandingKredit;
                    $row->DetailDeltaKredit = $arrTotalDeltaOutstanding;
                }
                $data["Customer"] = $rsCustomer;
                
                $config['base_url'] = base_url().'portofolio/portofolioRm/page';
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $totalRecords;
                $config['per_page'] = $limitPage;
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
                $data["links"] = $this->pagination->create_links();
            }

            //echo json_encode($data); die;

            $this->load->view("layout/header.php");
            $this->load->view("layout/side-nav.php");
            $this->load->view("layout/top-nav.php");
            $this->load->view("portofolio/portofolio_rm.php", $data);
            $this->load->view("layout/footer.php");
        }

        public function page($rowNo=1){
            $this->checkModule();
            $data = array();
            $limitPage = 1;
            $rowNo = ($rowNo-1) * $limitPage;
            
            if($this->input->post()){
                $keyword = $this->input->post("keyword");
            }else{
                $keyword = NULL;
            }
            $data["keyword"] = $keyword;

            $arrColors = Array(
                "#EBD618", 
                "#46CEB6", 
                "#9522F0", 
                "#1998DF", 
                "#F86D43", 
                "#FF62EF", 
                "#455C73", 
                "#9B59B6", 
                "#BDC3C7", 
                "#26B99A", 
                "#3498DB"
            );

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

            $rs_facility = $this->Pipeline_model->getFacilityOption();
            $data['fasilitasOption'] = $rs_facility;
            $fasilitas_option = "";
            foreach($rs_facility as $row){
                $fasilitas_option .= "<option value='".$row->FacilityId."'>".$row->FacilityName."</option>";
            }
            $data['facility_option'] = $fasilitas_option;

            //$currentYear = date("Y");
            $currentYear = 2018;
            $lastYear = $currentYear-1;
            $arrPeriode = array();
            $arrPeriode[] = $lastYear."-12";
            for($i = 1; $i <= 12; $i++) {
                if($i<10) $m = "0".$i;
                else $m = $i;
                $arrPeriode[] = $currentYear."-".$m;
            }
            $arrPeriodeLabel = array();
            foreach($arrPeriode as $row){
                array_push($arrPeriodeLabel, date("F Y", strtotime($row)));
            }
            $data["Labels"] = $arrPeriodeLabel;            
            
            //$lastPosition = strtotime("first day of previous month");
            //$month = date("m", $lastPosition);
            //$year  = date("Y", $lastPosition);
            $month = 7;
            $year  = 2018;

            $totalRecords = $this->PortofolioRm_model->getTotalCustomer($this->session->PERSONAL_NUMBER, $month, $year, $keyword);
            
            if($totalRecords > 0){
                $rsCustomer = $this->PortofolioRm_model->getAllCustomer($this->session->PERSONAL_NUMBER, $limitPage, $rowNo, $month, $year, $keyword);
                foreach($rsCustomer as $row){
                    $cif = $row->Cif;
                    $arrNoRekeningKredit = array();

                    /* Get Data Kredit */
                    $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($this->session->PERSONAL_NUMBER, $cif, $month, $year);
                    $totalPlafondKredit = 0;
                    $indexRekeningKredit = 0;
                    $tglRealisasiMinimum = strtotime(date("Y-m-d"));
                    foreach($rsRekeningKredit as $rowRekeningKredit){
                        $noRekening = $rowRekeningKredit->NoRekening;
                        $arrNoRekeningKredit[] = $noRekening;
                        $arrOutstandingKredit = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsOutstandingKredit = $this->PortofolioRm_model->getOutstandingKredit($this->session->PERSONAL_NUMBER, $cif, $noRekening, $rowPeriode);
                            if(!empty($rsOutstandingKredit)){
                                $arrOutstandingKredit[] = $rsOutstandingKredit[0]->PlafonEfektif;
                            }else{
                                $arrOutstandingKredit[] = 0;
                            }
                        endforeach;
                        
                        $tglRealisasi = strtotime($rowRekeningKredit->TglRealisasi);
                        if($tglRealisasi < $tglRealisasiMinimum) $tglRealisasiMinimum = $tglRealisasi;

                        switch($rowRekeningKredit->JenisPenggunaan){
                            case 1: $rowRekeningKredit->JenisPenggunaan = "KI"; break;
                            case 2: $rowRekeningKredit->JenisPenggunaan = "KMK"; break;
                            default: $rowRekeningKredit->JenisPenggunaan = ""; break;
                        }
                        $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
                        $rowRekeningKredit->DatasetKredit = $arrOutstandingKredit;
                        $rowRekeningKredit->Warna = $arrColors[$indexRekeningKredit];
                        $indexRekeningKredit++;
                    }

                    /* Get Data Simpanan */
                    $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);
                    $indexRekeningSimpanan = 0;
                    foreach($rsRekeningSimpanan as $rowRekeningSimpanan){
                        $noRekening = $rowRekeningSimpanan->NoRekening;
                        $arrInstandingSimpanan = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                            if(!empty($rsInstandingSimpanan)){
                                $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                            }else{
                                $arrInstandingSimpanan[] = 0;
                            }
                        endforeach;
                        $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
                        $rowRekeningSimpanan->Warna = $arrColors[$indexRekeningSimpanan];
                        $indexRekeningSimpanan++;
                    }
                    
                    /* Get Total and Average Outstanding Kredit */
                    $arrTotalOutstandingKredit = array();
                    $arrAverageOutstandingKredit = array();
                    for($i=0; $i<count($arrPeriode); $i++){
                        $totalOutstandingKredit = 0;
                        foreach($rsRekeningKredit as $rowRekeningKredit){
                            $plafonEfektif = $rowRekeningKredit->DatasetKredit[$i];
                            $totalOutstandingKredit += $plafonEfektif;
                        }
                        $arrTotalOutstandingKredit[] = $totalOutstandingKredit;
                        $arrAverageOutstandingKredit[] = number_format(($totalOutstandingKredit / $totalPlafondKredit) * 100, 2);
                    }

                    /* Calculate Delta Outstanding Kredit */
                    $arrTotalDeltaOutstanding = array();
                    $totalDelta = 0;
                    for($i=0; $i<count($arrTotalOutstandingKredit); $i++){
                        if($i==0){
                            $selisih = 0;
                            $arrTotalDeltaOutstanding[] = 0;
                        } else {
                            $selisih = $arrTotalOutstandingKredit[$i] - $arrTotalOutstandingKredit[$i - 1];
                            $arrTotalDeltaOutstanding[] = $selisih;
                        }
                        $totalDelta += $selisih;
                    }
                    
                    $tahunRealisasi = date("Y", $tglRealisasiMinimum);
                    $bulanRealisasi = date("m", $tglRealisasiMinimum);
                    if($tahunRealisasi < $year){
                        if($month == 12) $month = 0;
                        $totalBulan = $month + 1;
                    }else {
                        if($month == 12) $month = 0;
                        $totalBulan = $month - $bulanRealisasi + 1;
                    }

                    $row->AverageDelta = number_format($totalDelta / $totalBulan, 2);
                    $row->TotalPlafondKredit = $totalPlafondKredit;
                    $row->DetailRekeningKredit = $rsRekeningKredit;
                    $row->DetailRekeningSimpanan = $rsRekeningSimpanan;
                    $row->TotalOutstandingKredit = $arrTotalOutstandingKredit;
                    $row->AverageOutstandingKredit = $arrAverageOutstandingKredit;
                    $row->DetailDeltaKredit = $arrTotalDeltaOutstanding;
                }
                $data["Customer"] = $rsCustomer;
                
                $config['base_url'] = base_url().'portofolio/portofolioRm/page';
                $config['use_page_numbers'] = TRUE;
                $config['total_rows'] = $totalRecords;
                $config['per_page'] = $limitPage;
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
                $data["links"] = $this->pagination->create_links();
            }

            //echo json_encode($data); die;

            $this->load->view("layout/header.php");
            $this->load->view("layout/side-nav.php");
            $this->load->view("layout/top-nav.php");
            $this->load->view("portofolio/portofolio_rm.php", $data);
            $this->load->view("layout/footer.php");
        }

        public function search($fSearchTxt='', $rowNo=0){
            $this->checkModule();
            $data = array();
            $limitPage = 1;
            if($rowNo != 0){
                $rowNo = ($rowNo-1) * $limitPage;
              }

            if (empty($fSearchTxt)) {
                $fSearchTxt = ($this->input->post('keyword')) ? $this->input->post('keyword') : "";
                $data['keyword'] = $fSearchTxt;
            }
            else {
                $fSearchTxt = trim(str_replace('_', ' ', $fSearchTxt));
                $data['keyword'] = '';
            }
            if(empty($fSearchTxt))
                $searchUrl = '_';
            else 
                $searchUrl = $fSearchTxt;
            
            $arrColors = Array(
                "#EBD618", 
                "#46CEB6", 
                "#9522F0", 
                "#1998DF", 
                "#F86D43", 
                "#FF62EF", 
                "#455C73", 
                "#9B59B6", 
                "#BDC3C7", 
                "#26B99A", 
                "#3498DB"
            );

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

            $rs_facility = $this->Pipeline_model->getFacilityOption();
            $data['fasilitasOption'] = $rs_facility;
            $fasilitas_option = "";
            foreach($rs_facility as $row){
                $fasilitas_option .= "<option value='".$row->FacilityId."'>".$row->FacilityName."</option>";
            }
            $data['facility_option'] = $fasilitas_option;

            //$currentYear = date("Y");
            $currentYear = 2018;
            $lastYear = $currentYear-1;
            $arrPeriode = array();
            $arrPeriode[] = $lastYear."-12";
            for($i = 1; $i <= 12; $i++) {
                if($i<10) $m = "0".$i;
                else $m = $i;
                $arrPeriode[] = $currentYear."-".$m;
            }
            $arrPeriodeLabel = array();
            foreach($arrPeriode as $row){
                array_push($arrPeriodeLabel, date("F Y", strtotime($row)));
            }
            $data["Labels"] = $arrPeriodeLabel;            
            
            //$lastPosition = strtotime("first day of previous month");
            //$month = date("m", $lastPosition);
            //$year  = date("Y", $lastPosition);
            $month = 7;
            $year  = 2018;

            $totalRecords = $this->PortofolioRm_model->getTotalCustomer($this->session->PERSONAL_NUMBER, $month, $year, $fSearchTxt);
            
            if($totalRecords > 0){
                $rsCustomer = $this->PortofolioRm_model->getAllCustomer($this->session->PERSONAL_NUMBER, $limitPage, $rowNo, $month, $year, $fSearchTxt);
                foreach($rsCustomer as $row){
                    $cif = $row->Cif;
                    $arrNoRekeningKredit = array();

                    /* Get Data Kredit */
                    $rsRekeningKredit = $this->PortofolioRm_model->getAllRekeningKredit($this->session->PERSONAL_NUMBER, $cif, $month, $year);
                    $totalPlafondKredit = 0;
                    $indexRekeningKredit = 0;
                    $tglRealisasiMinimum = strtotime(date("Y-m-d"));
                    foreach($rsRekeningKredit as $rowRekeningKredit){
                        $noRekening = $rowRekeningKredit->NoRekening;
                        $arrNoRekeningKredit[] = $noRekening;
                        $arrOutstandingKredit = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsOutstandingKredit = $this->PortofolioRm_model->getOutstandingKredit($this->session->PERSONAL_NUMBER, $cif, $noRekening, $rowPeriode);
                            if(!empty($rsOutstandingKredit)){
                                $arrOutstandingKredit[] = $rsOutstandingKredit[0]->PlafonEfektif;
                            }else{
                                $arrOutstandingKredit[] = 0;
                            }
                        endforeach;
                        
                        $tglRealisasi = strtotime($rowRekeningKredit->TglRealisasi);
                        if($tglRealisasi < $tglRealisasiMinimum) $tglRealisasiMinimum = $tglRealisasi;

                        switch($rowRekeningKredit->JenisPenggunaan){
                            case 1: $rowRekeningKredit->JenisPenggunaan = "KI"; break;
                            case 2: $rowRekeningKredit->JenisPenggunaan = "KMK"; break;
                            default: $rowRekeningKredit->JenisPenggunaan = ""; break;
                        }
                        $totalPlafondKredit += $rowRekeningKredit->PlafonAwal;
                        $rowRekeningKredit->DatasetKredit = $arrOutstandingKredit;
                        $rowRekeningKredit->Warna = $arrColors[$indexRekeningKredit];
                        $indexRekeningKredit++;
                    }

                    /* Get Data Simpanan */
                    $rsRekeningSimpanan = $this->PortofolioRm_model->getAllRekeningSimpanan($cif, $month, $year);
                    $indexRekeningSimpanan = 0;
                    foreach($rsRekeningSimpanan as $rowRekeningSimpanan){
                        $noRekening = $rowRekeningSimpanan->NoRekening;
                        $arrInstandingSimpanan = array();
                        foreach($arrPeriode as $rowPeriode):
                            $rsInstandingSimpanan = $this->PortofolioRm_model->getInstandingSimpanan($noRekening, $rowPeriode);
                            if(!empty($rsInstandingSimpanan)){
                                $arrInstandingSimpanan[] = $rsInstandingSimpanan[0]->Saldo;
                            }else{
                                $arrInstandingSimpanan[] = 0;
                            }
                        endforeach;
                        $rowRekeningSimpanan->DatasetSimpanan = $arrInstandingSimpanan;
                        $rowRekeningSimpanan->Warna = $arrColors[$indexRekeningSimpanan];
                        $indexRekeningSimpanan++;
                    }
                    
                    /* Get Total and Average Outstanding Kredit */
                    $arrTotalOutstandingKredit = array();
                    $arrAverageOutstandingKredit = array();
                    for($i=0; $i<count($arrPeriode); $i++){
                        $totalOutstandingKredit = 0;
                        foreach($rsRekeningKredit as $rowRekeningKredit){
                            $plafonEfektif = $rowRekeningKredit->DatasetKredit[$i];
                            $totalOutstandingKredit += $plafonEfektif;
                        }
                        $arrTotalOutstandingKredit[] = $totalOutstandingKredit;
                        $arrAverageOutstandingKredit[] = number_format(($totalOutstandingKredit / $totalPlafondKredit) * 100, 2);
                    }

                    /* Calculate Delta Outstanding Kredit */
                    $arrTotalDeltaOutstanding = array();
                    $totalDelta = 0;
                    for($i=0; $i<count($arrTotalOutstandingKredit); $i++){
                        if($i==0){
                            $selisih = 0;
                            $arrTotalDeltaOutstanding[] = 0;
                        } else {
                            $selisih = $arrTotalOutstandingKredit[$i] - $arrTotalOutstandingKredit[$i - 1];
                            $arrTotalDeltaOutstanding[] = $selisih;
                        }
                        $totalDelta += $selisih;
                    }
                    
                    $tahunRealisasi = date("Y", $tglRealisasiMinimum);
                    $bulanRealisasi = date("m", $tglRealisasiMinimum);
                    if($tahunRealisasi < $year){
                        if($month == 12) $month = 0;
                        $totalBulan = $month + 1;
                    }else {
                        if($month == 12) $month = 0;
                        $totalBulan = $month - $bulanRealisasi + 1;
                    }

                    $row->AverageDelta = number_format($totalDelta / $totalBulan, 2);
                    $row->TotalPlafondKredit = $totalPlafondKredit;
                    $row->DetailRekeningKredit = $rsRekeningKredit;
                    $row->DetailRekeningSimpanan = $rsRekeningSimpanan;
                    $row->TotalOutstandingKredit = $arrTotalOutstandingKredit;
                    $row->AverageOutstandingKredit = $arrAverageOutstandingKredit;
                    $row->DetailDeltaKredit = $arrTotalDeltaOutstanding;
                }
                $data["Customer"] = $rsCustomer;
                
                $config['base_url'] = base_url().'portofolio/portofolioRm/search/'.$searchUrl;;
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

            //echo json_encode($data); die;

            $this->load->view("layout/header.php");
            $this->load->view("layout/side-nav.php");
            $this->load->view("layout/top-nav.php");
            $this->load->view("portofolio/portofolio_rm.php", $data);
            $this->load->view("layout/footer.php");
        }

        function proses_portofolio(){
            $noRekening = $this->input->post("portofolio_no_rekening");
            $periode = $this->input->post("portofolio_periode");
            $rsPortofolio = $this->PortofolioRm_model->getDetailPortofolioKredit($noRekening, $periode);
            $statusId = $rsPortofolio->IsProcess;
            if($statusId != 1){
                $isProcess = $this->input->post("isProcess");
                $realisasi = $this->input->post("realisasi");
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
                $data = array(
                    "Cif" => $rsPortofolio->Cif,
                    "IsProcess" => $isProcess,
                    "BulanRealisasi" => $realisasi,
                    "JangkaWaktu" => $jangkaWaktu,
                    "ArrFasilitasPermohonan" => $arrFasilitas,
                    "total_plafond_permohonan" => $total_plafond_permohonan,
                    "NoRekening" => $noRekening,
                    "Periode" => $periode,
                    "Comment" => NULL,
                    "UserId" => $this->session->PERSONAL_NUMBER,            
                    "DivisionId" => $this->session->DIVISION,
                    "RoleId" => $this->session->ROLE_ID
                );
                $result = $this->PortofolioRm_model->changeStatusPortofolioKredit($data);
            }else{
                $result = array(
                    "status" => "error",
                    "message" => "Failed to process portofolio kredit, already processed"
                );
            }
            echo json_encode($result);
        }

        public function serviceGetFasilitasPermohonan(){
            $noRekening = $this->input->post("noRekening");
            $periode = $this->input->post("periode");
            $data = array(
                "NoRekening" => $noRekening,
                "Periode" => $periode
            );
            $result = $this->PortofolioRm_model->getFasilitasPermohonan($data);
            echo json_encode($result);
        }
    }
?>