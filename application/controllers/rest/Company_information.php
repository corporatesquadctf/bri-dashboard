<?php

class Company_information extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('company_information_model');
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get_group_overview($vcif, $year) {

        $result = $this->company_information_model->get_group_overview($vcif, $year);
        if (empty($result)) {
            $result = $this->company_information_model->get_group_overview($vcif, $year - 1);
            if (!empty($result)) {
                $hasil = new stdClass();
                $hasil->vcif = $result->vcif;
                $hasil->parent_id = $result->parent_id;
                $hasil->city_id = $result->city_id;
                $hasil->address1 = $result->address1;
                $hasil->globalrating_id = $result->globalrating_id;
                $hasil->globalrating_desc = $result->globaldesc;
                $hasil->domesticrating_id = $result->domesticrating_id;
                $hasil->industry_name = $result->industry_name;
                $hasil->industrytype_id = $result->industrytype_id;
                $hasil->lifecycle_id = $result->lifecycle_id;
                $hasil->status = 1;
                $this->company_information_model->save_group_overview($hasil);
            };
        }
        $this->set_output($result);
    }

    public function save_group_overview() {

        $this->company_information_model->save_group_overview($this->request);
        $this->set_output_success('Data has been saved');
    }

    public function get_key_shareholders($vcif, $year) {
        $result = $this->company_information_model->get_key_shareholders($vcif, $year);
        if (empty($result)) {
            $result = $this->company_information_model->get_key_shareholders($vcif, $year - 1);
            if (!empty($result)) {
                $hasil_array = Array();
                foreach ($result as $res) {
                    $hasil = new stdClass();
                    $hasil->shareholder = $res->shareholder;
                    $hasil->share_value = $res->share_value;
                    $hasil_array[] = $hasil;
                };
                $this->company_information_model->save_key_shareholders($vcif, $hasil_array, $year);
            }
        }
        $this->set_output($result);
    }

    public function save_key_shareholders() {
        $vcif = $this->request->vcif;
        $year = $this->request->year;
        $rows = $this->request->rows;
        $this->company_information_model->save_key_shareholders($vcif, $rows, $year);
        $this->set_output_success('Data has been saved');
    }

    public function get_strategic_plans($vcif, $year) {
        $result = $this->company_information_model->get_strategic_plans($vcif, $year);
        if (empty($result['1']) && empty($result['2'])) {
            $result = $this->company_information_model->get_strategic_plans($vcif, $year - 1);
            if (!empty($result['1']) || (!empty($result['2']))) {
                $rows = Array();
                foreach ($result['1'] as $res) {
                    $hasil = new stdClass();
                    $hasil->planning = $res['planning'];
                    $rows[] = $hasil;
                };
                $this->company_information_model->save_strategic_plans($vcif, $year, 1, $rows);
                $rows = Array();
                foreach ($result['2'] as $res) {
                    $hasil = new stdClass();
                    $hasil->planning = $res['planning'];
                    $rows[] = $hasil;
                };
                $this->company_information_model->save_strategic_plans($vcif, $year, 2, $rows);
            }
        }
        $this->set_output($result);
    }

    public function save_strategic_plans() {
        $vcif = $this->request->vcif;
        $year = $this->request->year;
        $planning_type = $this->request->planning_type;
        $rows = $this->request->rows;

        $this->company_information_model->save_strategic_plans($vcif, $year, $planning_type, $rows);
        $this->set_output_success('Data has been saved');
    }

    public function get_coverage_mappings($vcif, $year) {
        $result = $this->company_information_model->get_coverage_mappings($vcif, $year);
        if (empty($result)) {
            $result = $this->company_information_model->get_key_shareholders($vcif, $year - 1);
            if (!empty($result)) {
                $hasil_array = Array();
                foreach ($result as $res) {
                    $hasil = new stdClass();
                    $hasil->shareholder = $res->shareholder;
                    $hasil->share_value = $res->share_value;
                    $hasil_array[] = $hasil;
                };
                $this->company_information_model->save_key_shareholders($vcif, $hasil_array, $year);
            }
        }
        $this->set_output($result);
    }

    public function save_coverage_mappings() {
        $vcif = $this->request->vcif;
        $year = $this->request->year;
        $rows = $this->request->rows;

        $this->company_information_model->save_coverage_mappings($vcif, $rows, $year);
        $this->set_output_success('Data has been saved');
    }

}
