<?php

class Accountplannings extends CI_Controller {

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
    }

    public function main($customer_vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');

        if ($customer_vcif) {
            $this->db->select('*')->from('ACCOUNT_PLANNINGS')->where('VCIF', $customer_vcif)->where('YEAR', $yearNow);
            $getAp = $this->db->get();

            foreach ($getAp->result() as $ap) {
                $grpOverview = array();
                $shrHolder = array();
                $strPlan = array();
                $cvrgMapping = array();

                $groupoverviewID = $ap->GROUPOVERVIEW_ID;

                // GET	GROUPOVERVIEW DATA
                $this->db->select('go.*, lp.Description CITY_NAME, gr.NAME GLOBALRATING, dr.NAME DOMESTICRATING, it.NAME INDUSTRYTREND, lc.NAME LIFECYCLE')
                        ->from('GROUP_OVERVIEWS go')
                        ->join('LOOKUP_PROVINSI lp', 'lp.PKLookup = go.CITY_ID', 'left')
                        ->join('MASTER_GLOBALRATINGS gr', 'gr.ID = go.GLOBALRATING_ID', 'left')
                        ->join('MASTER_DOMESTICRATINGS dr', 'dr.ID = go.DOMESTICRATING_ID', 'left')
                        ->join('MASTER_INDUSTRYTRENDS it', 'it.ID = go.INDUSTRYTYPE_ID', 'left')
                        ->join('MASTER_LIFECYCLES lc', 'lc.ID = go.LIFECYCLE_ID', 'left')
                        ->where('go.ID', $groupoverviewID);
                $getGrp = $this->db->get();

                foreach ($getGrp->result() as $grp) {
                    $grpOverview = array(
                        'GROUPOVERVIEW_ID' => $grp->ID,
                        'PARENT_ID' => $grp->PARENT_ID,
                        'CITY_ID' => $grp->ID,
                        'CITY_NAME' => $grp->CITY_NAME,
                        'ADDRESS' => $grp->ADDRESS1,
                        'GLOBALRATING_ID' => $grp->GLOBALRATING_ID,
                        'GLOBALRATING' => $grp->GLOBALRATING,
                        'GLOBALRATING_DESC' => $grp->GLOBALRATING_DESC,
                        'DOMESTICRATING_ID' => $grp->DOMESTICRATING_ID,
                        'DOMESTICRATING' => $grp->DOMESTICRATING,
                        'INDUSTRY_NAME' => $grp->INDUSTRY_NAME,
                        'INDUSTRYTREND_ID' => $grp->INDUSTRYTYPE_ID,
                        'INDUSTRYTREND' => $grp->INDUSTRYTREND,
                        'LIFECYCLE_ID' => $grp->LIFECYCLE_ID,
                        'LIFECYCLE' => $grp->LIFECYCLE
                    );
                }

                // GET KEYSHAREHOLDER DATA
                $this->db->select('*')
                        ->from('SHAREHOLDERS')
                        ->where('VCIF', $customer_vcif);
                $getShareholder = $this->db->get();

                foreach ($getShareholder->result() as $sh) {
                    $shrHolder[] = array(
                        'SHAREHOLDER' => $sh->SHAREHOLDER,
                        'SHARE_VALUE' => $sh->SHARE_VALUE,
                        'PORTION' => $sh->PORTION
                    );
                }

                // GET STRATEGIC PLANS DATA
                $this->db->select('*')->from('STRATEGIC_PLANS')->where('VCIF', $customer_vcif)->where('PLANNING_TYPE', 1);
                $getStrPlanA = $this->db->get(); // 1-3 Year Strategic Plan

                foreach ($getStrPlanA->result() as $spa) {
                    $strPlan['A'][] = array(
                        'DIVISION_ID' => $spa->DIVISION_ID,
                        'PLANNING' => $spa->PLANNING,
                        'PLANNING_TYPE' => $spa->PLANNING_TYPE
                    );
                }

                $this->db->select('*')->from('STRATEGIC_PLANS')->where('VCIF', $customer_vcif)->where('PLANNING_TYPE', 2);
                $getStrPlanB = $this->db->get(); // > 3 Year Strategic Plan

                foreach ($getStrPlanB->result() as $spb) {
                    $strPlan['B'][] = array(
                        'DIVISION_ID' => $spa->DIVISION_ID,
                        'PLANNING' => $spa->PLANNING,
                        'PLANNING_TYPE' => $spa->PLANNING_TYPE
                    );
                }

                // GET COVERAGE MAPPING DATA
                $this->db->select('*')->from('COVERAGE_MAPPINGS')->where('VCIF', $customer_vcif);
                $getCovMapping = $this->db->get();

                foreach ($getCovMapping->result() as $cm) {
                    $cvrgMapping[] = array(
                        'CLIENT_POSITION' => $cm->CLIENT_POSITION,
                        'CLIENT_NAME' => $cm->CLIENT_NAME,
                        'CONTACT_PERSON' => $cm->CONTACT_PERSON,
                        'OTHER_INFORMATION' => $cm->OTHER_INFORMATION,
                        'BANK_POSITION' => $cm->BANK_POSITION,
                        'BANK_PERSON' => $cm->BANK_PERSON
                    );
                }

                // SUMMARY DATA
                $data['accountplanning'][] = array(
                    'ACCOUNTPLANNING_ID' => $ap->ID,
                    'GROUP_ID' => $ap->GROUP_ID,
                    'VCIF' => $ap->VCIF,
                    'CUSTOMER_NAME' => $ap->CUSTOMER_NAME,
                    'CREATED_DATE' => $ap->ADDON,
                    'CREATED_BY' => $ap->ADDBY,
                    'DOC_YEAR' => $ap->YEAR,
                    'DOC_STATUS' => $ap->DOC_STATUS,
                    'GROUP_OVERVIEWS' => $grpOverview,
                    'KEY_SHAREHOLDERS' => $shrHolder,
                    'STRATEGIC_PLANS' => $strPlan,
                    'COVERAGE_MAPPINGS' => $cvrgMapping
                );
            }
        }
        // LOAD MASTER CITY
        $getCity = $this->db->select('*')->from('LOOKUP_PROVINSI')->get();
        foreach ($getCity->result() as $ct) {
            $data['city'][] = array(
                'CITY_ID' => $ct->PKLookup,
                'CITY_NAME' => $ct->Description
            );
        }


        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/account_planning_view.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function index($x) {
        $this->load->database();

        $postedData = $x;

        if (ctype_digit($postedData)) {
            // GROUP DATA
            $groupId = $postedData;
            $this->db->distinct()
                    ->select('b.VCIF, a.*')
                    ->from('NEW_GROUP a')
                    ->join('par_mapping_vcif b', 'b.GROUP_NAME = a.NAMA_GROUP', 'left')
                    ->where('a.ID_GROUP', $groupId);
            $result = $this->db->get();
            $detail['group'] = $result->result();

            // DIVISION DATA
            $getDivision = $this->db->get('MASTER_DIVISIONS');
            $detail['division'] = $getDivision->result();

            // CLASSIFICATION DATA
            $getClassification = $this->db->get('MASTER_CLASSIFICATIONS');
            $detail['classification'] = $getClassification->result();

            // CITY DATA
            $getCity = $this->db->get('LOOKUP_PROVINSI');
            $detail['city'] = $getCity->result();

            // GLOBAL RATING DATA
            $getGlobRating = $this->db->get('MASTER_GLOBALRATINGS');
            $detail['globalrate'] = $getGlobRating->result();

            // DOMESTIC RATING DATA
            $getDomesticRate = $this->db->get('MASTER_DOMESTICRATINGS');
            $detail['domrate'] = $getDomesticRate->result();

            // INDUSTRY TREND DATA
            $getIndustryTrend = $this->db->get('MASTER_INDUSTRYTRENDS');
            $detail['indTrend'] = $getIndustryTrend->result();

            // LIFE CYCLE DATA
            $getLifeCycle = $this->db->get('MASTER_LIFECYCLES');
            $detail['lifecycle'] = $getLifeCycle->result();

            // LOAD ESTIMATED FINANCIALS DATA
            $data['ESTIMATED_FINANCIAL'] = $this->getEstFin($Vcif);
            print_r('<pre>');
            print_r($data['ESTIMATED_FINANCIAL']);
            die();


            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('performance/account_planning_view.php', $detail);
            $this->load->view('layout/footer.php');
        } else {

            $companyName = $postedData;

            $this->db->select('*')
                    ->from('VIEW_MASTER_COMPANY')
                    ->where('COMPANY_NAME', $companyName);
            $result = $this->db->get();
            $detail['data'] = $result->result();
            $detail['total'] = $result->num_rows();
        }
    }

    /* =============== GROUP OVERVIEW SECTION =============== */

    public function saveGroupOverview() {
        $this->load->database();

        $userID = $this->input->form('userID');
        $compID = $this->input->form('custID');
        $today = date('Y-m-d H:i:s');

        if ($compID) {
            $newData = [
                'CUSTOMER_ID' => $compID,
                'ADDRESS1' => $this->input->post('custAddress'),
                'CITY_ID' => $this->input->post('custCity'),
                'GLOBALRATING_ID' => $this->input->post('globalRate'),
                'DOMESTICRATING_ID' => $this->input->post('domesticRate'),
                'INDUSTRY_NAME' => $this->input->post('industryName'),
                'INDUSTRYTYPE_ID' => $this->input->post('industryTrend'),
                'LIFECYCLE_ID' => $this->input->post('lifeCycle'),
                'STATUS' => '1',
                'ADDON' => $today,
                'ADDBY' => $userID
            ];

            $insertData = $this->db->insert('GROUP_OVERVIEWS', $newData);

            print_r($insertData);
            die();
        }
    }

    public function saveShareholder() {
        $this->load->database();

        $key = $this->input->post('keyshareholders');
        $share = $this->input->post('shares');
        $data = [
            'keyshareholders' => $key,
            'shares' => $share
        ];
        /*
          header('Content-Type: application/json');
          echo json_encode( $data );
         */
        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    public function saveFunding() {
        $this->load->database();

        $key = $this->input->post('kebutuhanpendanaan');
        $nominal = $this->input->post('action');
        $waktu = $this->input->post('jangkawaktu');
        $data = [
            'kebutuhanpendanaan' => $key,
            'action' => $nominal,
            'jangkawaktu' => $waktu
        ];

        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    public function saveSP1() {
        $this->load->database();

        $key = $this->input->post('planning');
        $data = [
            'planning' => $key
        ];
        /*
          header('Content-Type: application/json');
          echo json_encode( $data );
         */
        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    public function saveService() {
        $this->load->database();

        $key = $this->input->post('namaservices');
        $divisi = $this->input->post('productdivisitag');
        $divTag = $this->input->post('div');
        print_r('<pre>');
        print_r(array($key, $divTag));
        die();
        $data = [
            'namaservices' => $key,
            'productdivisitag' => $divisi
        ];

        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    public function saveSP3() {
        $this->load->database();

        $key = $this->input->post('plan');
        $data = [
            'plan' => $key
        ];
        /*
          header('Content-Type: application/json');
          echo json_encode( $data );
         */

        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    public function saveCmap() {
        $this->load->database();

        $posclient = $this->input->post('positionatclient');
        $name = $this->input->post('nameoftheclient');
        $contact = $this->input->post('contactperson');
        $other = $this->input->post('otherinformation');
        $posbank = $this->input->post('positionatthebank');
        $namebank = $this->input->post('nameofthebanksperson');
        $data = [
            'positionatclient' => $key,
            'nameoftheclient' => $name,
            'contactperson' => $contact,
            'otherinformation' => $other,
            'positionatthebank' => $posbank,
            'nameofthebanksperson' => $namebank
        ];
        /*
          header('Content-Type: application/json');
          echo json_encode( $data );
         */
        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($data));
    }

    function Summary_cpa() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/company/summary_cpa');
        $this->load->view('layout/footer.php');
    }

}

?>