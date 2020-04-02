<?php

class Executive_summary extends REST_Controller {

    private $division;

    function __construct() {
        parent::__construct();
        $this->load->model('executive_summary_model');

        $this->load->library('session');

        $user_role_id = $this->session->get_userdata()['ROLE_ID'];
        $user_division_id = $this->session->get_userdata()['DIVISION'];
        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER,
            //USER_ROLE_ADMIN_DIVISI,
            //USER_ROLE_ADMIN_PARAMETER,
            USER_ROLE_BOARD
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        if ($user_is_restricted) {
            $this->division = $user_division_id;
        } else {
            $this->division = $this->request->division;
        }
        $today = new DateTime(date('Ym01'));
        $start = $this->request->start;
        $end = $this->request->end;
        $end = date_create($end . '-01');
        $start = date_create($start . '-01');
        $this->startDate = $start->format('Ymd');
        $this->endDate = $end->format('Ymd');
        if ($this->endDate == $today) {
            $this->filter = 1;
        } else {
            $this->filter = 0;
        }
    }

    public function get_classified_loan() {
        $output = $this->executive_summary_model->get_classified_loan($this->division);
        $this->set_output($output);
    }

    public function get_plafon() {
        $output = $this->executive_summary_model->get_plafon($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_loan_outstanding() {
        $output = $this->executive_summary_model->get_loan_outstanding($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_customer_profit() {
        $output = $this->executive_summary_model->get_customer_profit($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_loan_sector() {
        $output = $this->executive_summary_model->get_loan_sector($this->division);
        $this->set_output($output);
    }

    public function get_interest_income() {
        $output = $this->executive_summary_model->get_interest_income($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_fee_income() {
        $output = $this->executive_summary_model->get_fee_income($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_dpk() {
        $output = $this->executive_summary_model->get_dpk($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_giro() {
        $output = $this->executive_summary_model->get_giro($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_deposito() {
        $output = $this->executive_summary_model->get_deposito($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

    public function get_loany() {
        $output = $this->executive_summary_model->get_loany($this->request->start, $this->request->end, $this->division);
        $this->set_output($output);
    }

}
