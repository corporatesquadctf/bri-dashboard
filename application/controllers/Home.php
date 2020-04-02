<?php
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
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
        $this->load->model('TasklistDisposisi_model');
        $this->load->model('DataTransaction_model');
        $this->load->model('Leaderboard_model');
        $this->load->model('AccountPlanningCalculate_model');
        $this->load->model("FTP_Position_model");

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_date2 = $current_datetime->format('j F Y');
        $this->current_date3 = $current_datetime->format('Y-m');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function index() {
        $this->isLogin();

        $max_month = 24;
        $max_periode = 23;
        $min_periode = 0;

        $data['max_month'] = $max_month;
        $data['max_periode'] = $max_periode;
        $data['min_periode'] = $min_periode;

    // month list
        for ($i=$max_periode; $i > $min_periode; $i--) {
            $month_list[$i]['year_month'] = date('M Y', strtotime('-'.$i.' month'));
        }
        $data['month_list'] = $month_list;
    // end month list

    // Line Chart
        $DataSimpananAllGroups = $this->DataTransaction_model->getDataSimpananAllGroups($max_month);
        $DataPinjamanAllGroups = $this->DataTransaction_model->getDataPinjamanAllGroups($max_month);
        $DataCpaAllGroups = $this->DataTransaction_model->getDataCpaAllGroups($max_month);

        $data['DataSimpananAllGroups'] = $DataSimpananAllGroups;
        $data['DataPinjamanAllGroups'] = $DataPinjamanAllGroups;
        $data['DataCpaAllGroups']    = $DataCpaAllGroups;
    // End Line Chart

    // TotalCustomer
        $data['TotalCustomer'] = $this->TasklistDisposisi_model->getTotalViewGroupList('');
        // $data['TotalCustomerLastUpdateDate'] = $this->current_date2;
    // End TotalCustomer

        $data['param_month_yod'] = 12;
        $data['param_month_yoy'] = date('m', strtotime('-12 month'));
        $data['param_last_year'] = date('Y', strtotime('-12 month'));
        // $data['param_month_yod'] = 10;
        // $data['param_month_yoy'] = 10;
        // $data['param_last_year'] = 2018;

    // Pinjaman
        $pinjamanLastUpdateDate = $this->DataTransaction_model->getPinjamanLastUpdateDate();
        $LastTotalPinjamanAllGroup = $this->DataTransaction_model->getLastDataPinjamanAllGroup();
        $data['LastTotalPinjamanAllGroup'] = number_format($LastTotalPinjamanAllGroup['TotalPinjaman']/1000000000000, 1);
        $data['totalPinjamanLastUpdateDate'] = $pinjamanLastUpdateDate['total'];

        $PinjamanAllGroupLastYearByMonth = $this->DataTransaction_model->getDataPinjamanAllGroupByPeriode(array(
            'month' => $data['param_month_yoy']
            , 'year'=> $data['param_last_year']
        ));
        $data['PinjamanAllGroupLastYearByMonth'] = number_format($PinjamanAllGroupLastYearByMonth['TotalPinjaman']/1000000000000, 1);

        $PinjamanAllGroupLastYear = $this->DataTransaction_model->getDataPinjamanAllGroupByPeriode(array(
            'month' => $data['param_month_yod']
            , 'year'=> $data['param_last_year']
        ));
        $data['PinjamanAllGroupLastYear'] = number_format($PinjamanAllGroupLastYear['TotalPinjaman']/1000000000000, 1);

        // YOY
        $data['YOYTotalPinjamanAllGroups'] = 0;
        if ($data['PinjamanAllGroupLastYearByMonth'] != 0) {
            $data['YOYTotalPinjamanAllGroups'] = (($data['LastTotalPinjamanAllGroup'] - $data['PinjamanAllGroupLastYearByMonth']) / $data['PinjamanAllGroupLastYearByMonth']);
        }

        // YOD
        $data['YODTotalPinjamanAllGroups'] = 0;
        $data['Loan_persen'] = 0;
        if ($data['PinjamanAllGroupLastYear'] != 0) {
            $data['YODTotalPinjamanAllGroups'] = (($data['LastTotalPinjamanAllGroup'] - $data['PinjamanAllGroupLastYear']) / $data['PinjamanAllGroupLastYear']);
            $data['Loan_persen'] = number_format((($data['LastTotalPinjamanAllGroup'] - $data['PinjamanAllGroupLastYear']) / $data['PinjamanAllGroupLastYear']) * 100, 1);
        }
    // End Pinjaman

    // Simpanan
        $simpananLastUpdateDate = $this->DataTransaction_model->getSimpananLastUpdateDate();
        $LastTotalSimpananAllGroup = $this->DataTransaction_model->getLastDataSimpananAllGroup();
        $data['LastTotalSimpananAllGroup'] = number_format($LastTotalSimpananAllGroup['TotalSimpanan']/1000000000000, 1);
        $data['totalSimpananLastUpdateDate'] = $simpananLastUpdateDate['total'];
        $data['ratasSimpananLastUpdateDate'] = $simpananLastUpdateDate['ratas'];

        $SimpananAllGroupLastYearByMonth = $this->DataTransaction_model->getDataSimpananAllGroupByPeriode(array(
            'month' => $data['param_month_yoy']
            , 'year'=> $data['param_last_year']
        ));
        $data['SimpananAllGroupLastYearByMonth'] = number_format($SimpananAllGroupLastYearByMonth['TotalSimpanan']/1000000000000, 1);

        $SimpananAllGroupLastYear = $this->DataTransaction_model->getDataSimpananAllGroupByPeriode(array(
            'month' => $data['param_month_yod']
            , 'year'=> $data['param_last_year']
        ));
        $data['SimpananAllGroupLastYear'] = number_format($SimpananAllGroupLastYear['TotalSimpanan']/1000000000000, 1);

        // YOY
        $data['YOYTotalSimpananAllGroups'] = 0;
        if ($data['SimpananAllGroupLastYearByMonth'] != 0) {
            $data['YOYTotalSimpananAllGroups'] = (($data['LastTotalSimpananAllGroup'] - $data['SimpananAllGroupLastYearByMonth']) / $data['SimpananAllGroupLastYearByMonth']);
        }

        // YOD
        $data['YODTotalSimpananAllGroups'] = 0;
        $data['CASA_persen'] = 0;
        if ($data['SimpananAllGroupLastYear'] != 0) {
            $data['YODTotalSimpananAllGroups'] = (($data['LastTotalSimpananAllGroup'] - $data['SimpananAllGroupLastYear']) / $data['SimpananAllGroupLastYear']);
            $data['CASA_persen'] = (($data['LastTotalSimpananAllGroup'] - $data['SimpananAllGroupLastYear']) / $data['SimpananAllGroupLastYear']) * 100;
        }

    // End Simpanan

    // CPA
        $cpaLastUpdateDate = $this->DataTransaction_model->getLastUpdateDateCpaAllGroup();
        $LastDataCpaAllGroup = $this->DataTransaction_model->getLastDataCpaAllGroup();
        $data['LastDataCpaAllGroup'] = number_format($LastDataCpaAllGroup['Cpa']/1000000000000, 1);
        $data['cpaLastUpdateDate'] = $cpaLastUpdateDate['LastUpdateDate'];
        
        $data['CustomerGroupClassification'] = $this->Leaderboard_model->countCustomerGroupClassification();
        $data['CustomerLoanSegment'] = $this->Leaderboard_model->countCustomerLoanSegment();
        $data['AccountPlanningPublishByClassification'] = $this->AccountPlanningCalculate_model->countAccountPlanningPublishByClassification();
    // End CPA

    // FTP
        $data['FTPItemPinjaman'] = $this->FTP_Position_model->getFTPDetail("FTPItemPinjaman", 7, 'CreatedDate');
        $data['FTPItemTransitInterestRupiah'] = $this->FTP_Position_model->getFTPDetail("FTPItemTransitInterest", 8, 'CreatedDate');
        $data['FTPItemTransitInterestValas'] = $this->FTP_Position_model->getFTPDetail("FTPItemTransitInterest", 9, 'CreatedDate');
        $data['FTPItemPinjamanValas'] = $this->FTP_Position_model->getFTPDetail("FTPItemPinjamanValas", 12, 'CreatedDate');
        $data['FTPItemSBDK'] = $this->FTP_Position_model->getFTPDetail("FTPItemPrimeLandingRate", 13, 'CreatedDate');
        $data['FTPItemRupiah'] = $this->FTP_Position_model->getFTPDetail("FTPItemFTP", 14, 'CreatedDate');
        $data['FTPItemValas'] = $this->FTP_Position_model->getFTPDetail("FTPItemFTP", 15, 'CreatedDate');

        $data['FTPItemSimpanan']['Rupiah'] = $this->getFTPDetailByPage("FTPItemSimpanan", 1, 1, 'FTPSimpananRupiah');
        $data['FTPItemSimpanan']['Valas'] = $this->getFTPDetailByPage("FTPItemSimpanan", 2, 1, 'FTPSimpananValas');

        $FTPItem = $this->FTP_Position_model->getFTPItem(2);
        foreach($FTPItem as $rowItem){
            $data['FTPItemDeposito'][$rowItem->FTPItemId] = $this->getFTPDetailByPage("FTPItemDeposito", $rowItem->FTPItemId, 1, 'FTPItemDeposito_'.$rowItem->FTPItemId);
        }

        $FTPItem = $this->FTP_Position_model->getFTPItem(3);
        foreach($FTPItem as $rowItem){
            $data['FTPItemDepositoValas'][$rowItem->FTPItemId] = $this->getFTPDetailByPage("FTPItemDepositoValas", $rowItem->FTPItemId, 1, 'FTPItemDepositoValas_'.$rowItem->FTPItemId);
        }

        $FTPItem = $this->FTP_Position_model->getFTPItem(5);
        foreach($FTPItem as $rowItem){
            $data['FTPItemTransitInterest'][$rowItem->FTPItemId] = $this->getFTPDetailByPage("FTPItemTransitInterest", $rowItem->FTPItemId, 1, 'FTPItemTransitInterest_'.$rowItem->FTPItemId);
        }
    // End FTP

        $ActiveCustomerKorporasi = $this->DataTransaction_model->getActiveCustomerKorporasi();
        foreach ($ActiveCustomerKorporasi as $key => $value) {
            $DataSimpananPerCustomer[] = $this->DataTransaction_model->getDataSimpananPerCustomer($value['VCIF']);
        }
        $data['DataSimpananPerCustomer'] = $DataSimpananPerCustomer;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('home/index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function getFTPDetailByPage($refTable, $FTPItemId, $page=1, $refView='') {
        $params = array();
        
        $limit_per_page = 5;
        $rowno = ($page-1) * $limit_per_page;

        $pages = array(
            'rowperpage' => $limit_per_page
            , 'rowno' => $rowno
        );

        $total_records = count($this->FTP_Position_model->getFTPDetail($refTable, $FTPItemId));
        if ($total_records > 0) {   
            $params['result'] = $this->FTP_Position_model->getFTPDetail($refTable, $FTPItemId, $Order='', $Description='', $pages);
            $params['row'] = $rowno;
            $params['page'] = $page;
            $params['total_records'] = $total_records;

            $config['base_url'] = '#';
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 5;
            $config['display_pages'] = FALSE;

            $config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
            $config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';

            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['next_tag_open'] = '<li class="right carousel-control" id="button_'.$refView.'_next" rell="next" refTable="'.$refTable.'" FTPItemId="'.$FTPItemId.'" refView="'.$refView.'" style="z-index: 10; width: 40px; color: #fff; margin-top: 40px;">';
            $config['next_tagl_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="left carousel-control" id="button_'.$refView.'_prev" rell="prev" refTable="'.$refTable.'" FTPItemId="'.$FTPItemId.'" refView="'.$refView.'" style="z-index: 10; width: 40px; color: #fff; margin-top: 40px;">';
            $config['prev_tagl_close'] = '</li>';

            $config['first_link'] = FALSE;
            $config['last_link'] = FALSE;
            $config['attributes'] = array(
                'style' => 'color: #fff; cursor: pointer;'
            );

            $this->pagination->initialize($config);

            $params["links"] = $this->pagination->create_links();
        }

        return $params;
    }

    public function getLoadFTPDetailByPage($refTable, $FTPItemId, $page=1, $refView='') {
        $params = array();
        
        $limit_per_page = 5;
        $rowno = ($page-1) * $limit_per_page;

        $pages = array(
            'rowperpage' => $limit_per_page
            , 'rowno' => $rowno
        );

        $total_records = count($this->FTP_Position_model->getFTPDetail($refTable, $FTPItemId));
        if ($total_records > 0) {   
            $params[$refTable]['result'] = $this->FTP_Position_model->getFTPDetail($refTable, $FTPItemId, $Order='', $Description='', $pages);
            $params['row'] = $rowno;
            $params['page'] = $page;
            $params['total_records'] = $total_records;

            $config['base_url'] = '#';
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 5;
            $config['display_pages'] = FALSE;
            
            $config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
            $config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';


            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['next_tag_open'] = '<li class="right carousel-control" id="button_'.$refView.'_next" rell="next" refTable="'.$refTable.'" FTPItemId="'.$FTPItemId.'" refView="'.$refView.'" style="z-index: 10; width: 40px; color: #fff; margin-top: 40px;">';
            $config['next_tagl_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="left carousel-control" id="button_'.$refView.'_prev" rell="prev" refTable="'.$refTable.'" FTPItemId="'.$FTPItemId.'" refView="'.$refView.'" style="z-index: 10; width: 40px; color: #fff; margin-top: 40px;">';
            $config['prev_tagl_close'] = '</li>';

            $config['first_link'] = FALSE;
            $config['last_link'] = FALSE;
            $config['attributes'] = array(
                'style' => 'color: #fff; cursor: pointer;'
            );

            $this->pagination->initialize($config);

            $params[$refView]["links"] = $this->pagination->create_links();
        }
        // echo "<pre>";
        // print_r($params);
        // die();

        $this->load->view('home/landing_page/'.$refView.'.php', $params);
    }

}

?>