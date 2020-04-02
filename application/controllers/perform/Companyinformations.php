
<?php

class Companyinformations extends MY_Controller {

    private $year_current;

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
        $this->load->database();
        $this->load->model('GambarModel');
        $this->load->model('master_model');
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->year_see = 2018;
    }

    public function main($customer_vcif, $year, $page = 1) {
        $this->checkSubRole();
        $this->checkAccessAcp();
        $data['mode'] = 'edit';
        $data['accountplannings'] = array();

        if ($customer_vcif) {
            $data['vcif'] = $customer_vcif;
            $this->db->select(<<<SQL
                    id account_planning_id,
                    group_id,
                    vcif,
                    customer_name,
                    addon created_date,
                    addby created_by,
                    year doc_year,
                    doc_status,
                    groupoverview_id
SQL
            );

            $this->db->from('ACCOUNT_PLANNINGS');
            $this->db->where('VCIF', $customer_vcif);
            $this->db->where('YEAR', $year);
            $account_planning = $this->db->get()->row_array();
            $data['account_planning'] = $account_planning;
        }
        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Input Account Planning", "", "Input Account Planning " . $data['account_planning']['customer_name'] . " (" . $customer_vcif . ")", "");

        $divisi_ini = $_SESSION['DIVISION'];
        $APvcif = $account_planning['vcif'];
        $data['parameter'] = $this->master_model->get_param($APvcif);

        $this->db->select('PKLookup CITY_ID, Description CITY_NAME');
        $this->db->from('LOOKUP_PROVINSI');
        $data['cities'] = $this->db->get()->result_array();



        $data['globalrate'] = $this->master_model->get_global_ratings();
        $data['domrate'] = $this->master_model->get_domestic_ratings();
        $data['indtrend'] = $this->master_model->get_industry_trends();
        $data['lifecycle'] = $this->master_model->get_life_cycles();
        $data['banks'] = $this->master_model->get_banks();
        $data['mydivisi'] = $this->master_model->get_mydiv($divisi_ini);

        // LOAD STRATEGIC PLAN 1-3 Year
        $this->db->select('ID PLANNING_ID, PLANNING, PLANNING_TYPE');
        $this->db->from('STRATEGIC_PLANS');
        $this->db->where('VCIF', $customer_vcif);

        $strategic_plans = $this->db->get()->result_array();

        $data['strplan1'] = array();
        $data['strplan2'] = array();

        foreach ($strategic_plans as $strategic_plan) {
            if ($strategic_plan['PLANNING_TYPE'] == 1) {
                $data['strplan1'] [] = $strategic_plan;
            }

            if ($strategic_plan['PLANNING_TYPE'] == 2) {
                $data['strplan2'] [] = $strategic_plan;
            }
        }

        // LOAD COVERAGE MAPPING
        $this->db->select(<<<SQL
                ID COVMAP_ID,
                CLIENT_POSITION,
                CLIENT_NAME,
                CONTACT_PERSON,
                OTHER_INFORMATION,
                BANK_POSITION,
                BANK_PERSON
SQL
        );
        $this->db->from('COVERAGE_MAPPINGS');
        $this->db->where('VCIF', $customer_vcif);

        $data['covmap'] = $this->db->get()->result_array();

        $data['FUNDING'] = $this->getFunding($customer_vcif);
        $data['SERVICE'] = $this->getService($customer_vcif);
        $data['GROUP'] = $this->getGroupOverview($customer_vcif);
        $data['GR'] = $this->getGlobal_ratings($customer_vcif);

        $this->db->distinct();
        $this->db->select('SERVICE_NAME, VCIF, DATA_YEAR');
        $this->db->from('SERVICES');
        $this->db->where(['STATUS' => '1', 'VCIF' => $customer_vcif, 'DATA_YEAR' => $year]);
        $data['services'] = $this->db->get()->result_array();

        foreach ($data['services'] as $index => $service) {
            $divisi_name = array();
            $divisi = array();

            $this->db->select('a.*, b.DIVISION_NAME');
            $this->db->from('SERVICES a');
            $this->db->join('MASTER_DIVISIONS b', 'b.ID = a.DIVISION_ID', 'left');
            $this->db->where(array(
                'a.STATUS' => '1',
                'a.VCIF' => $customer_vcif,
                'a.SERVICE_NAME' => $service['SERVICE_NAME'],
                'a.DATA_YEAR' => $year));
            $service_divisions = $this->db->get()->result();

            foreach ($service_divisions as $service_division) {
                $divisi[] = $service_division->DIVISION_ID;
                $divisi_name[] = $service_division->DIVISION_NAME;
            }

            $data['services'][$index]['DIVISI'] = $divisi;
            $data['services'][$index]['DIVISI_NAME'] = $divisi_name;
        }

        //BRI Starting Points
        $this->load->model('bri_starting/banking_facilities_model');
        $data['banking_facilities'] = $this->banking_facilities_model->get($customer_vcif);

        //Credit Simulations
        $this->load->model('credit_simulations_model');
        $data['credit_simulations'] = $this->credit_simulations_model->get($customer_vcif);
        $data['credit_simulation_assumptions'] = $this->credit_simulations_model->get_assumptions($customer_vcif);
        $data['credit_simulation_fee'] = $this->credit_simulations_model->get_fees($customer_vcif);


        $data['FINANCIAL_HIGHLIGHT'] = $this->getFinHigh($customer_vcif, $year);

        $this->load->model('action_plan_model');
        $data['initiative_actions'] = $this->action_plan_model->get_initiative_actions($customer_vcif, $year);
        $data['estimated_financial'] = $this->action_plan_model->get_estimated_financial($customer_vcif);

        //ACTION PLAN
        $this->load->model('Action_plan_model');
        $data['ESTIMATED_FINANCIALMOD'] = $this->Action_plan_model->get($customer_vcif);

        //MASTER DIVISI
        $data['division'] = $this->db->get('MASTER_DIVISIONS')->result();

        //MASTER PERIODS
        $data['periods'] = $this->db->get('MASTER_PERIODS')->result();
        $queryChk = $this->db->select('*')
                ->from('USERS')
                ->where('STATUS', '1')
                ->where('role_id', '9')
                ->or_where('role_id', '8')
                ->or_where('role_id', '7')
                ->get();
        $data['dataCheckers'] = $queryChk->result();

        // LOAD IMAGE BISNIS PROCESS
        $queryBisPro = $this->db->select('*')
                ->from('STRUCTURE')
                ->where('VCIF', $customer_vcif)
                ->where('TITLE', 'BISNISPROCESS')
                ->order_by("ADDON", "desc")
                ->LIMIT('1')
                ->get();
        $data['gambarBisnis'] = $queryBisPro->result();

        $queryDatabisnis = $this->db->select('*')
                ->from('STRUCTURE')
                ->where('VCIF', $customer_vcif)
                ->where('TITLE', 'ORGANISASI')
                ->order_by("ADDON", "desc")
                ->LIMIT('1')
                ->get();
        $data['gambar'] = $queryDatabisnis->result();

        $queryDatastruktur = $this->db->select('*')
                ->from('STRUCTURE')
                ->where('VCIF', $customer_vcif)
                ->where('TITLE', 'STRUKTUR')
                ->order_by("ADDON", "desc")
                ->LIMIT('1')
                ->get();
        $data['gambarStruktur'] = $queryDatastruktur->result();
        $data['vcif'] = $customer_vcif;
        $data['year'] = $year;
        $data['page'] = (int) $page;


        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/account_planning_view.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function tambah() {
        $vcif = $this->input->post('VCIF');
        $year = $this->input->post('YEAR');

        $data = array();

        if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->GambarModel->upload();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
                $this->GambarModel->save($upload, $year);
                redirect('perform/Companyinformations/main/' . $vcif . '/' . $year);
            } else { // Jika proses upload gagal
                echo "<script>alert('Wrong File Format');document.location='main/$vcif/$year'</script>";
            }
        }
    }

    public function getService($vcif) {
        if (!empty($vcif)) {
            $getData = $this->db->distinct()
                    ->select('VCIF, DATA_YEAR, SERVICE_NAME, DIVISION_ID')
                    ->from('SERVICES')
                    ->where('VCIF', $vcif)
                    ->where('DATA_YEAR', $this->year_current)
                    ->get();

            if ($getData->num_rows() > 0) {
                foreach ($getData->result() as $srvc) {
                    $serviceData[] = array(
                        'VCIF' => $srvc->VCIF,
                        'DATA_YEAR' => $srvc->DATA_YEAR,
                        'SERVICE_NAME' => $srvc->SERVICE_NAME,
                        'DIVISION_ID' => $srvc->DIVISION_ID
                    );
                }
            } else {
                $serviceData = $getData->result();
            }
        }
        return $serviceData;
    }

    public function getFunding($vcif) {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');

        if (empty($vcif)) {
            return array();
        }

        $this->db->select('*');
        $this->db->from('FUNDINGS');
        $this->db->where('VCIF', $vcif);
        $this->db->where('DATA_YEAR', $this->year_current);

        return $this->db->get()->result_array();
    }

    public function getGroupOverview($vcif) {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');

        if (empty($vcif)) {
            return array();
        }

        $this->db->select('a.*, b.Description');
        $this->db->from('GROUP_OVERVIEWS a');
        $this->db->join('LOOKUP_PROVINSI b', 'b.PKLookup = a.CITY_ID', 'left');
        $this->db->where('a.VCIF', $vcif);
        $this->db->where('a.YEAR', $this->year_current);
        $result = $this->db->get()->result_array();
        if (empty($result)) {
            $this->db->select('a.*, b.Description');
            $this->db->from('GROUP_OVERVIEWS a');
            $this->db->join('LOOKUP_PROVINSI b', 'b.PKLookup = a.CITY_ID', 'left');
            $this->db->where('a.VCIF', $vcif);
            $this->db->where('a.YEAR', $this->year_current - 1);
            $result = $this->db->get()->result_array();
        }
        return $result;
    }

    public function getGlobal_ratings($vcif, $getThis = "0") {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');

        if (empty($vcif)) {
            return array();
        }

        $this->db->select('a.GLOBALRATING_ID, b.DESCRIPTION');
        $this->db->from('GROUP_OVERVIEWS a');
        $this->db->join('MASTER_GLOBALRATINGS b', 'b.ID = a.GLOBALRATING_ID', 'left');
        $this->db->where('VCIF', $vcif);
        $this->db->where('YEAR', $this->year_current);
        $result = $this->db->get()->result_array();
        if (empty($result)) {
            $this->db->select('a.GLOBALRATING_ID, b.DESCRIPTION');
            $this->db->from('GROUP_OVERVIEWS a');
            $this->db->join('MASTER_GLOBALRATINGS b', 'b.ID = a.GLOBALRATING_ID', 'left');
            $this->db->where('VCIF', $vcif);
            $this->db->where('YEAR', $this->year_current - 1);
            $result = $this->db->get()->result_array();
        }
        if ($getThis == "0") {
            return $result;
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        }
    }

    public function getFinhigh($vcif, $year) {

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->year_see = $year;
        $yearMin1 = $year - 1;
        $yearMin2 = $yearMin1 - 1;
        $yearMin3 = $yearMin2 - 1;

        if (!empty($vcif)) {
            // CHECK IF THERE IS ANY DATA IN THE ACCOUNT PLANNING 
            $qBalShe = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 1 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQBalShe = $this->db->query($qBalShe);

            if ($getQBalShe->result()) {
                $res['BALANCE_SHEET'] = $getQBalShe->result();
            } else {
                $qBalSheDef = "SELECT a.ID DETAIL_ID, a.DETAIL_NAME FROM FINANCIALHIGHLIGHT_DETAILS a LEFT JOIN FINANCIALHIGHLIGHT_GROUPS b ON b.ID = a.GROUP_ID WHERE a.GROUP_ID = 1 AND a.IS_DEFAULT = 1";
                $getQBalSheDef = $this->db->query($qBalSheDef);
                $res['BALANCE_SHEET'] = $getQBalSheDef->result();
            }

            $qIncSta = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 2 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQIncSta = $this->db->query($qIncSta);
            $res['INCOME_STATEMENT'] = $getQIncSta->result();

            $qLiquid = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 3 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQLiquid = $this->db->query($qLiquid);
            $res['LIQUIDITY'] = $getQLiquid->result();

            $qActive = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 4 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQActive = $this->db->query($qActive);
            $res['ACTIVITY'] = $getQActive->result();

            $qProfit = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 6 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQProfit = $this->db->query($qProfit);
            $res['PROFITABILITY'] = $getQProfit->result();

            $qSolvab = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = " . $yearMin3 . " THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin2 . " THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = " . $yearMin1 . " THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "' AND b.GROUP_ID = 7 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQSolvab = $this->db->query($qSolvab);
            $res['SOLVABILITY'] = $getQSolvab->result();
            return $res;
        }
    }

    /* =============== GROUP OVERVIEW SECTION =============== */

    public function saveGroupOverview() {

        $userID = $this->input->post('userID');
        $vcif = $this->input->post('vcif');
        $today = date('Y-m-d H:i:s');

        $groupID = $this->input->post('parentID');
        if ($groupID) {
            $parentID = $groupID;
        } else {
            $parentID = NULL;
        }

        if ($vcif) {
            $newData = [
                'VCIF' => $vcif,
                'PARENT_ID' => $parentID,
                'CITY_ID' => $this->input->post('cityID'),
                'YEAR' => $today->format('Y'),
                'GLOBALRATING_ID' => $this->input->post('globalrate'),
                'GLOBALRATING_DESC' => $this->input->post('globalrating_description'),
                'DOMESTICRATING_ID' => $this->input->post('domesticrate'),
                'INDUSTRY_NAME' => $this->input->post('industryname'),
                'INDUSTRYTYPE_ID' => $this->input->post('industryID'),
                'LIFECYCLE_ID' => $this->input->post('lifecycleID'),
                'ADDRESS1' => $this->input->post('custAddress'),
                'ADDON' => $today,
                'ADDBY' => $userID
            ];

            $this->load->model('Accountplanning');
            $result = $this->Accountplanning->saveGroupOverview($newData);

            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
        }
    }

    public function saveFunding() {
        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $dataAyax = json_decode($this->input->post('data'));


        $this->db->where('VCIF', $customer_vcif);
        $this->db->delete('FUNDINGS');

        foreach ($dataAyax as $f) {
            $newData = [
                'VCIF' => $customer_vcif,
                'FUNDING_NEED' => preg_replace('/ +/', ' ', trim($f->kebutuhanpendanaan)),
                'TIME_PERIOD' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->jangkawaktu),
                'NOMINAL' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->action),
                'DATA_YEAR' => $this->year_current,
                'STATUS' => 1,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];

            $saveFundings = $this->db->insert('FUNDINGS', $newData);
        }

        header('Content-Type: application/json');
        echo json_encode($dataAyax);
    }

    public function saveService() {
        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $addOn = date('Y-m-d H:i:s');
        $this->year_current = $today->format('Y');
        $dataServ = json_decode($this->input->post('data'));

        $this->db->where('VCIF', $customer_vcif);
        $this->db->delete('SERVICES');


        foreach ($dataServ as $f) {

            if (!count($f->product_divisi) == 0) {
                for ($i = 0; $i < count($f->product_divisi); $i++) {
                    $servicename = preg_replace('/ +/', ' ', trim($f->nama_service));
                    $query = "INSERT INTO SERVICES (VCIF, SERVICE_NAME, DIVISION_ID, STATUS, DATA_YEAR, ADDON, ADDBY) VALUES ('" . $customer_vcif . "','" . $servicename . "', '" . $f->product_divisi[$i] . "','1','" . $this->year_current . "','" . $addOn . "','" . $user_id . "')";
                    $hasil = $this->db->query($query);
                }
            } else {
                $addOn = date('Y-m-d H:i:s');
                $servicename = preg_replace('/ +/', ' ', trim($f->nama_service));
                $query = "INSERT INTO SERVICES (VCIF, SERVICE_NAME, DIVISION_ID, STATUS, DATA_YEAR, ADDON, ADDBY) VALUES ('" . $customer_vcif . "','" . $servicename . "', '" . $f->product_divisi . "','1','" . $this->year_current . "','" . $addOn . "','" . $user_id . "')";
                $hasil = $this->db->query($query);
            }
        }
        echo json_encode($dataServ);
    }

    public function saveInitiativeAction() {
        $this->load->database();
        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $dataIniat = json_decode($this->input->post('data'));

        $this->db->where('VCIF', $customer_vcif);
        $this->db->delete('INITIATIVE_ACTIONS');

        foreach ($dataIniat as $ini) {

            $newData = [
                'VCIF' => $customer_vcif,
                'INITIATIVES' => preg_replace('/ +/', ' ', trim($ini->initiative)),
                'PERIOD_ID' => preg_replace('/[^a-zA-Z0-9\.]/', '', $ini->action_plan),
                'DESCRIPTION' => preg_replace('/ +/', ' ', trim($ini->description)),
                'STATUS' => 1,
                'DATA_YEAR' => $this->year_current,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $get_initiativesAct = $this->db->insert('INITIATIVE_ACTIONS', $newData);
        }
    }

    public function saveEstCash() {
        $this->load->database();

        $customer_vcif = $this->input->post('vcif');
        $yearMin1 = $this->year_current - 1;
        $dataEstTrans = json_decode($this->input->post('data'));

        foreach ($dataEstTrans as $f) {
            $newData = [
                'VCIF' => $customer_vcif,
                'PROJECTION_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->projectioncustomerbyidr),
                'TARGET_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->targetbribyidr),
                'STATUS' => 1,
                'DATA_YEAR' => $yearMin1,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $getEstimatedTrans = $this->db->where('DETAIL_ID', $f->id)->update('ESTIMATED_FINANCIALS', $newData);
        }
    }

    public function saveEstTrans() {
        $this->load->database();

        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $yearMin1 = $this->year_current - 1;
        $dataEstTrans = json_decode($this->input->post('data'));

        foreach ($dataEstTrans as $f) {
            $newData = [
                'VCIF' => $customer_vcif,
                'PROJECTION_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->projectioncustomerbyidr),
                'TARGET_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->targetbribyidr),
                'STATUS' => 1,
                'DATA_YEAR' => $yearMin1,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $getEstimatedTrans = $this->db->where('DETAIL_ID', $f->id)->update('ESTIMATED_FINANCIALS', $newData);
        }
    }

    public function saveEstFinInLoan() {
        $this->load->database();

        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $yearMin1 = $this->year_current - 1;
        $dataEstInLoan = json_decode($this->input->post('data'));

        foreach ($dataEstInLoan as $f) {
            $newData = [
                'VCIF' => $customer_vcif,
                'PROJECTION_IDR' => preg_replace('/ +/', ' ', $f->projectioncustomerbyidr),
                'TARGET_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->targetbribyidr),
                'STATUS' => 1,
                'DATA_YEAR' => $yearMin1,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $getEstimatedInLoan = $this->db->where('DETAIL_ID', $f->id)->update('ESTIMATED_FINANCIALS', $newData);
        }
    }

    public function saveEstFinDirloan() {
        $this->load->database();

        $customer_vcif = $this->input->post('vcif');
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $yearMin1 = $this->year_current - 1;
        $dataEstFin = json_decode($this->input->post('data'));

        foreach ($dataEstFin as $f) {
            $newData = [
                'VCIF' => $customer_vcif,
                'PROJECTION_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->projectioncustomerbyidr),
                'TARGET_IDR' => preg_replace('/[^a-zA-Z0-9\.]/', '', $f->targetbribyidr),
                'STATUS' => 1,
                'DATA_YEAR' => $yearMin1,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $getEstimated = $this->db->where('DETAIL_ID', $f->id)->update('ESTIMATED_FINANCIALS', $newData);
        }
    }

    public function delegate() {

        $vcif = $this->input->post('vcif');
        $company_name = $this->input->post('company_name');
        $user_id = $_SESSION['USER_ID'];
        $today = date('Y-m-d H:i:s');
        $checker_ids = $this->input->post('checker_ids');

        if ($vcif) {
            $this->load->model('notification_model');
            $delegations_checker = array();

            foreach ($checker_ids as $checker_id) {
                $delegations_checker[] = array(
                    'status' => 1,
                    'vcif' => $vcif,
                    // 'addon' => $today,
                    'addby' => $user_id,
                    'checker_id' => $checker_id
                );
                $this->notification_model->addNotif($checker_id, $company_name, "Sign to Checker", $vcif);
            }
            //
            $this->db->trans_start();
            $this->db->where('vcif', $vcif);
            $this->db->delete('delegations_checker');
            $this->db->insert_batch('delegations_checker', $delegations_checker);
            $this->db->trans_complete();
        }
        redirect('perform/Companyinformations/main/' . $vcif);
    }

    public function delegateSigner() {

        $id = $this->input->post('id');
        $vcif = $this->input->post('vcif');
        $year = $this->input->post('account_year');
        $year_now = date("Y");
        $company_name = $this->input->post('comp_name');
        $user_id = $_SESSION['USER_ID'];
        $today = date('Y-m-d H:i:s');
        $checker_ids = $this->input->post('checker_ids');
        $signer_id = $this->input->post('signer_ids');

        if ($vcif) {
            $this->load->model('notification_model');
            $delegations_checker = array();

            foreach ($signer_id as $signer_id) {
                $delegations_checker[] = array(
                    'status' => 0,
                    'vcif' => $vcif,
                    'AP_id' => $id,
                    'addby' => $user_id,
                    'signer_id' => $signer_id
                );
            }

            $delegations_checker2 = array();

            foreach ($checker_ids as $checker_id) {
                $delegations_checker2[] = array(
                    'status' => 1,
                    'vcif' => $vcif,
                    'AP_id' => $id,
                    'addby' => $user_id,
                    'checker_id' => $checker_id
                );
                $this->notification_model->addNotif($checker_id, $company_name, "Sign to Checker", $vcif, $year_now);
            }

            $nameSigner = $this->db->select('name')->where('id', $delegations_checker[0]['signer_id'])->get('USERS')->result_array()[0]['name'];
            if (count($delegations_checker) == 2) {
                $nameSigner2 = $this->db->select('name')->where('id', $delegations_checker[1]['signer_id'])->get('USERS')->result_array()[0]['name'];
            } else {
                $nameSigner2 = "-";
            }
            $nameChecker = $this->db->select('name')->where('id', $delegations_checker2[0]['checker_id'])->get('USERS')->result_array()[0]['name'];
            if (count($delegations_checker2) == 2) {
                $nameChecker2 = $this->db->select('name')->where('id', $delegations_checker2[1]['checker_id'])->get('USERS')->result_array()[0]['name'];
            } else {
                $nameChecker2 = "-";
            }

            $personaln = $_SESSION['PERSONAL_NUMBER'];

            $this->insertLog($personaln, "", "Submit Account Planning", "", "RM Choose: " . $nameChecker . ", " . $nameChecker2 . " as Checkers " . "& " . $nameSigner . ", " . $nameSigner2 . " as Signers " . "for " . $company_name . " (" . $vcif . ")", "");

            //
            $this->db->trans_start();
            //
            $this->db->where('vcif', $vcif);
            $this->db->delete('delegations_signer');
            $this->db->insert_batch('delegations_signer', $delegations_checker);
            //
            $this->db->where('vcif', $vcif);
            $this->db->delete('delegations_checker');
            $this->db->insert_batch('delegations_checker', $delegations_checker2);
            //Update status submit
            $update_this_vcif = array(
                'DOC_STATUS' => 2
            );
            $this->db->where('VCIF', $vcif)->where('YEAR', $year)->update('ACCOUNT_PLANNINGS', $update_this_vcif);
            $this->db->trans_complete();
        }
        redirect('profile/task');
    }

    public function Simulasicpa() {
        $user_id = $_SESSION['USER_ID'];
        $this->load->model('calculate_simulations_model');
        $data['calculate_simulations'] = $this->calculate_simulations_model->get($user_id);

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/simulasi_cpa/simulasicpa', $data);
        $this->load->view('layout/footer.php');
    }

    public function Simulasicpa_calc() {
        $user_id = $_SESSION['USER_ID'];
        $this->load->model('calculate_simulations_model');

        $data['credit_simulation_assumptions'] = $this->calculate_simulations_model->get_assumptions($user_id);
        $data['credit_simulation_fees'] = $this->calculate_simulations_model->get_fees($user_id);
        $data['calc_projection'] = $this->calculate_simulations_model->get_projection($user_id, $data['credit_simulation_assumptions'], $data['credit_simulation_fees']);

        foreach (array('simpanan', 'pinjaman') as $group) {
            foreach ($data['calc_projection'][$group] as $key => $value) {
                foreach (array('IDR', 'VALAS', 'TOTAL') as $currency) {
                    $data['calc_projection'][$group][$key][$currency] = number_format($data['calc_projection'][$group][$key][$currency]);
                }
            }
        }

        foreach ($data['calc_projection']['labarugi'] as $key => $value) {
            $data['calc_projection']['labarugi'][$key] = number_format($data['calc_projection']['labarugi'][$key]);
        }

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/simulasi_cpa/simulasicpa_calc', $data);
        $this->load->view('layout/footer.php');
    }

}
