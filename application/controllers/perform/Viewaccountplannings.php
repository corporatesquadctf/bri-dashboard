<?php

/**
 * 
 */
class Viewaccountplannings extends MY_Controller {

    private $year_current;

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('master_model');
        $this->load->model('accountplanning');
        $this->load->model('notification_model');
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function viewAp($customer_vcif, $year, $page = 1) {

        $this->checkAccessViewAcp();

        $data['mode'] = 'view';
        $data['year'] = $year;
        $divisi_ini = $_SESSION['DIVISION'];
        $data['mydivisi'] = $this->master_model->get_mydiv($divisi_ini);

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
        $APvcif = $account_planning['vcif'];

        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Get Account Planning", "", "View Account Planning " . $data['account_planning']['customer_name'] . " (" . $customer_vcif . ")", "");

        $data['parameter'] = $this->master_model->get_param($APvcif);

        $this->db->select('PKLookup CITY_ID, Description CITY_NAME');
        $this->db->from('LOOKUP_PROVINSI');
        $data['cities'] = $this->db->get()->result_array();

        $this->load->model('master_model');

        $data['globalrate'] = $this->master_model->get_global_ratings();
        $data['domrate'] = $this->master_model->get_domestic_ratings();
        $data['indtrend'] = $this->master_model->get_industry_trends();
        $data['lifecycle'] = $this->master_model->get_life_cycles();
        $data['banks'] = $this->master_model->get_banks();

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
        $data['GR'] = $this->getGlobal_ratings($customer_vcif);
        $data['kota'] = $this->getKota($customer_vcif);


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
            $this->db->where([
                'a.STATUS' => '1',
                'a.VCIF' => $customer_vcif,
                'a.SERVICE_NAME' => $service['SERVICE_NAME'],
                'a.DATA_YEAR' => $year]);
            $service_divisions = $this->db->get()->result();

            foreach ($service_divisions as $service_division) {
                $divisi[] = $service_division->DIVISION_ID;
                $divisi_name[] = $service_division->DIVISION_NAME;
            }

            $data['services'][$index]['DIVISI'] = $divisi;
            $data['services'][$index]['DIVISI_NAME'] = $divisi_name;
        }
        $data['APLN'] = $this->getAP($customer_vcif, $year);

        //BRI Starting Points
        $this->load->model('bri_starting/banking_facilities_model');
        $data['banking_facilities'] = $this->banking_facilities_model->get($customer_vcif);

        //Credit Simulations
        $this->load->model('credit_simulations_model');
        $data['credit_simulations'] = $this->credit_simulations_model->get($customer_vcif);
        $data['credit_simulation_assumptions'] = $this->credit_simulations_model->get_assumptions($customer_vcif);
        $data['credit_simulation_fee'] = $this->credit_simulations_model->get_fees($customer_vcif);


        $data['FINANCIAL_HIGHLIGHT'] = $this->getFinHigh($customer_vcif);

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

        $this->db->select('USERS.*, ROLE.SUBROLE_ID');
        $this->db->from('USERS');
        $this->db->join('ROLE', 'USERS.role_id =  ROLE.ID', 'left');
        $this->db->where('USERS.STATUS', 1);

        $data['dataChecker'] = array();
        $data['dataSigner'] = array();

        $user_roles = $this->db->get()->result();

        foreach ($user_roles as $user_role) {
            if ($user_role->SUBROLE_ID == 2) {
                $data['dataChecker'] [] = $user_role;
            }
            if ($user_role->SUBROLE_ID == 3) {
                $data['dataSigner'] [] = $user_role;
            }
        }

        // LOAD IMAGE BISNIS PROCESS

        $vcif = $this->input->post('VCIF');
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
        $user_id = $_SESSION['USER_ID'];
        $ada = array();
        $ketemu = 0;
        if ($data['account_planning']['doc_status'] == 2) {
            $ada = $this->accountplanning->get_checker($user_id, $vcif);
            foreach ($ada as $a) {
                if ($user_id == $a->checker_id) {
                    $ketemu = 2;
                }
            }
        } else if ($data['account_planning']['doc_status'] == 3) {
            $ada = $this->accountplanning->get_signer($user_id, $vcif);
            foreach ($ada as $a) {
                if ($user_id == $a->signer_id) {
                    $ketemu = 3;
                }
            }
        }
        $data['signer'] = $ketemu;
        $data['page'] = (int) $page;
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/account_planning_view.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function getAP($vcif, $year) {
        $this->db->select('*');
        $this->db->from('ACCOUNT_PLANNINGS');
        $this->db->where('VCIF', $vcif);
        $this->db->where('YEAR', $year);
        $this->db->where('DOC_STATUS', 4);

        return $this->db->get()->result_array();
    }

    public function getFunding($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');

        if (!empty($customer_vcif)) {
            $getData = $this->db->select('*')
                    ->from('FUNDINGS')
                    ->where('VCIF', $customer_vcif)
                    ->where('DATA_YEAR', $yearNow)
                    ->get();

            if ($getData->num_rows() > 0) {
                foreach ($getData->result() as $fnd) {
                    $fundingData[] = array(
                        'VCIF' => $fnd->VCIF,
                        'DATA_YEAR' => $fnd->DATA_YEAR,
                        'FUNDING_NEED' => $fnd->FUNDING_NEED,
                        'TIME_PERIOD' => $fnd->TIME_PERIOD,
                        'NOMINAL' => $fnd->NOMINAL
                    );
                }
            } else {
                $fundingData = $getData->result();
            }
        }
        return $fundingData;
    }

    public function getService($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');

        if (!empty($customer_vcif)) {
            $getData = $this->db->distinct()
                    ->select('VCIF, DATA_YEAR, SERVICE_NAME')
                    ->from('SERVICES')
                    ->where('VCIF', $customer_vcif)
                    ->where('DATA_YEAR', $yearNow)
                    ->get();

            if ($getData->num_rows() > 0) {
                foreach ($getData->result() as $srvc) {
                    $serviceData[] = array(
                        'VCIF' => $srvc->VCIF,
                        'DATA_YEAR' => $srvc->DATA_YEAR,
                        'SERVICE_NAME' => $srvc->SERVICE_NAME
                    );
                }
            } else {
                $serviceData = $getData->result();
            }
        }
        return $serviceData;
    }

    public function getFinhigh($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');
        $yearMin1 = $yearNow - 1;
        $yearMin2 = $yearMin1 - 1;
        $yearMin3 = $yearMin2 - 1;

        if (!empty($customer_vcif)) {
            $qBalShe = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 1 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQBalShe = $this->db->query($qBalShe);
            $res['BALANCE_SHEET'] = $getQBalShe->result();

            $qIncSta = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 2 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQIncSta = $this->db->query($qIncSta);
            $res['INCOME_STATEMENT'] = $getQIncSta->result();

            $qLiquid = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 3 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQLiquid = $this->db->query($qLiquid);
            $res['LIQUIDITY'] = $getQLiquid->result();

            $qActive = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 4 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQActive = $this->db->query($qActive);
            $res['ACTIVITY'] = $getQActive->result();

            $qProfit = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 6 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQProfit = $this->db->query($qProfit);
            $res['PROFITABILITY'] = $getQProfit->result();

            $qSolvab = "SELECT DISTINCT b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID, MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-3 THEN a.DATA_VALUE END) AS 'YEAR3', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-2 THEN a.DATA_VALUE END) AS 'YEAR2', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE())-1 THEN a.DATA_VALUE END) AS 'YEAR1', MAX(CASE WHEN a.DATA_YEAR = YEAR(GETDATE()) THEN a.DATA_VALUE END) AS 'YEAR NOW'FROM FINANCIALHIGHLIGHT_VALUES a LEFT JOIN FINANCIALHIGHLIGHT_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "' AND b.GROUP_ID = 7 GROUP BY b.DETAIL_NAME, a.DETAIL_ID, b.GROUP_ID ORDER BY a.DETAIL_ID ASC";
            $getQSolvab = $this->db->query($qSolvab);
            $res['SOLVABILITY'] = $getQSolvab->result();

            return $res;
        }
    }

    public function getBanfac($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');
        $yearMin1 = $yearNow - 1;

        if (!empty($customer_vcif)) {
            $qDirLoan = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.AMOUNT_IDR, a.AMOUNT_IDR_PERCENT, a.AMOUNT_VALAS, a.AMOUNT_VALAS_PERCENT FROM BANKINGFACILITY_VALUES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "' AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 1";
            $getQDirLoan = $this->db->query($qDirLoan);
            $res['DIRECT_LOAN'] = $getQDirLoan->result();

            $qIndLoan = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.AMOUNT_IDR, a.AMOUNT_IDR_PERCENT, a.AMOUNT_VALAS, a.AMOUNT_VALAS_PERCENT FROM BANKINGFACILITY_VALUES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "' AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 2";
            $getQIndLoan = $this->db->query($qIndLoan);
            $res['INDIRECT_LOAN'] = $getQIndLoan->result();

            $qCash = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.AMOUNT_IDR, a.AMOUNT_IDR_PERCENT, a.AMOUNT_VALAS, a.AMOUNT_VALAS_PERCENT FROM BANKINGFACILITY_VALUES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "' AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 3";
            $getQCash = $this->db->query($qCash);
            $res['CASH'] = $getQCash->result();

            $qTraBank = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.AMOUNT_IDR, a.AMOUNT_IDR_PERCENT, a.AMOUNT_VALAS, a.AMOUNT_VALAS_PERCENT FROM BANKINGFACILITY_VALUES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "' AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 4";
            $getQTraBank = $this->db->query($qTraBank);
            $res['TRAN_BANK'] = $getQTraBank->result();

            $qOthInfo = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.AMOUNT_IDR, a.AMOUNT_IDR_PERCENT, a.AMOUNT_VALAS, a.AMOUNT_VALAS_PERCENT FROM BANKINGFACILITY_VALUES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "' AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 5";
            $getQOthInfo = $this->db->query($qOthInfo);
            $res['OTHER_INFO'] = $getQOthInfo->result();

            return $res;
        }
    }

    public function getWallShare($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');
        $yearMin1 = $yearNow - 1;

        if (!empty($customer_vcif)) {
            $qDirLoan = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.BRI_SHARE, a.BRI_SHARE_PERCENT, a.OTHER_SHARE, a.OTHER_SHARE_PERCENT, a.TOTAL_SHARE FROM WALLET_SHARES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 1";
            $getQDirLoan = $this->db->query($qDirLoan);
            $res['DIRECT_LOAN'] = $getQDirLoan->result();

            $qIndLoan = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.BRI_SHARE, a.BRI_SHARE_PERCENT, a.OTHER_SHARE, a.OTHER_SHARE_PERCENT, a.TOTAL_SHARE FROM WALLET_SHARES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 2";
            $getQIndLoan = $this->db->query($qIndLoan);
            $res['INDIRECT_LOAN'] = $getQIndLoan->result();

            $qCash = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.BRI_SHARE, a.BRI_SHARE_PERCENT, a.OTHER_SHARE, a.OTHER_SHARE_PERCENT, a.TOTAL_SHARE FROM WALLET_SHARES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 3";
            $getQCash = $this->db->query($qCash);
            $res['CASH'] = $getQCash->result();

            $qTraBank = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.BRI_SHARE, a.BRI_SHARE_PERCENT, a.OTHER_SHARE, a.OTHER_SHARE_PERCENT, a.TOTAL_SHARE FROM WALLET_SHARES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 4";
            $getQTraBank = $this->db->query($qTraBank);
            $res['TRAN_BANK'] = $getQTraBank->result();

            $qOthInfo = "SELECT a.VCIF, a.DATA_YEAR, c.GROUP_NAME, b.DETAIL_NAME, a.BRI_SHARE, a.BRI_SHARE_PERCENT, a.OTHER_SHARE, a.OTHER_SHARE_PERCENT, a.TOTAL_SHARE FROM WALLET_SHARES a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID LEFT JOIN BANKINGFACILITY_GROUPS c ON c.ID = b.GROUP_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 5";
            $getQOthInfo = $this->db->query($qOthInfo);
            $res['OTHER_INFO'] = $getQOthInfo->result();

            return $res;
        }
    }

    public function getCompAnal($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');
        $yearMin1 = $yearNow - 1;

        if (!empty($customer_vcif)) {
            $qDirLoan = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, e.DETAIL_NAME, b.NAME AS FIRST_BANK, c.NAME AS SECOND_BANK, d.NAME AS THIRD_BANK FROM COMPETITION_ANALYSIS a LEFT JOIN MASTER_BANKS b ON b.ID = a.FIRST_BANK LEFT JOIN MASTER_BANKS c ON c.ID = a.SECOND_BANK LEFT JOIN MASTER_BANKS d ON d.ID = a.THIRD_BANK LEFT JOIN BANKINGFACILITY_DETAILS e ON e.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND e.GROUP_ID = 1";
            $getDirLoan = $this->db->query($qDirLoan);

            $res['DIRECT_LOAN'] = $getDirLoan->result();

            $qIndLoan = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, e.DETAIL_NAME, b.NAME AS FIRST_BANK, c.NAME AS SECOND_BANK, d.NAME AS THIRD_BANK FROM COMPETITION_ANALYSIS a LEFT JOIN MASTER_BANKS b ON b.ID = a.FIRST_BANK LEFT JOIN MASTER_BANKS c ON c.ID = a.SECOND_BANK LEFT JOIN MASTER_BANKS d ON d.ID = a.THIRD_BANK LEFT JOIN BANKINGFACILITY_DETAILS e ON e.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND e.GROUP_ID = 2";
            $getIndLoan = $this->db->query($qIndLoan);

            $res['INDIRECT_LOAN'] = $getIndLoan->result();

            $qCash = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, e.DETAIL_NAME, b.NAME AS FIRST_BANK, c.NAME AS SECOND_BANK, d.NAME AS THIRD_BANK FROM COMPETITION_ANALYSIS a LEFT JOIN MASTER_BANKS b ON b.ID = a.FIRST_BANK LEFT JOIN MASTER_BANKS c ON c.ID = a.SECOND_BANK LEFT JOIN MASTER_BANKS d ON d.ID = a.THIRD_BANK LEFT JOIN BANKINGFACILITY_DETAILS e ON e.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND e.GROUP_ID = 3";
            $getCash = $this->db->query($qCash);

            $res['CASH'] = $getCash->result();

            $qTranBank = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, e.DETAIL_NAME, b.NAME AS FIRST_BANK, c.NAME AS SECOND_BANK, d.NAME AS THIRD_BANK FROM COMPETITION_ANALYSIS a LEFT JOIN MASTER_BANKS b ON b.ID = a.FIRST_BANK LEFT JOIN MASTER_BANKS c ON c.ID = a.SECOND_BANK LEFT JOIN MASTER_BANKS d ON d.ID = a.THIRD_BANK LEFT JOIN BANKINGFACILITY_DETAILS e ON e.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND e.GROUP_ID = 4";
            $getTranBank = $this->db->query($qTranBank);

            $res['TRAN_BANK'] = $getTranBank->result();

            $qDirLoan = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, e.DETAIL_NAME, b.NAME AS FIRST_BANK, c.NAME AS SECOND_BANK, d.NAME AS THIRD_BANK FROM COMPETITION_ANALYSIS a LEFT JOIN MASTER_BANKS b ON b.ID = a.FIRST_BANK LEFT JOIN MASTER_BANKS c ON c.ID = a.SECOND_BANK LEFT JOIN MASTER_BANKS d ON d.ID = a.THIRD_BANK LEFT JOIN BANKINGFACILITY_DETAILS e ON e.ID = a.DETAIL_ID WHERE a.VCIF = '" . $customer_vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND e.GROUP_ID = 5";
            $getDirLoan = $this->db->query($qDirLoan);

            $res['OTHER_INFO'] = $getDirLoan->result();
        }
        return $res;
    }

    public function getGlobal_ratings($vcif) {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');

        if (empty($vcif)) {
            return array();
        }

        $this->db->select('a.GLOBALRATING_ID, b.DESCRIPTION');
        $this->db->from('GROUP_OVERVIEWS a');
        $this->db->join('MASTER_GLOBALRATINGS b', 'b.ID = a.GLOBALRATING_ID', 'left');
        $this->db->where('VCIF', $vcif);

        return $this->db->get()->result_array();
    }

    public function getKota($vcif) {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');

        if (empty($vcif)) {
            return array();
        }

        $this->db->select('a.CITY_ID, b.PKLookup, b.Description');
        $this->db->from('GROUP_OVERVIEWS a');
        $this->db->join('LOOKUP_PROVINSI b', 'b.PKLookup = a.CITY_ID', 'left');
        $this->db->where('VCIF', $vcif);

        return $this->db->get()->result_array();
    }

}

?>