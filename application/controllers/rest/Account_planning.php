<?php

class Account_planning extends REST_Controller {

    private $user_id;

    function __construct() {
        parent::__construct();
        $this->load->model('bri_starting/financial_highlights_model');
        $this->load->model('bri_starting/banking_facilities_model');
        $this->load->model('bri_starting/wallet_shares_model');
        $this->load->model('bri_starting/competition_analyses_model');
        //
        $this->load->model('credit_simulations_model');
        $this->load->model('action_plan_model');
        $this->load->model('client_needs_model');

        $this->user_id = $_SESSION['USER_ID'];
    }

    function get_credit_simulation() {
        $result = $this->action_plan_model->get($vcif);
        $this->set_output($result);
    }

    function save_credit_simulations() {
        $this->credit_simulations_model->vcif = $this->request->vcif;
        $this->credit_simulations_model->group_id = $this->request->group_id;
        $this->credit_simulations_model->rows = $this->request->rows;


        $this->credit_simulations_model->save_credit_simulations();
        $this->set_output_success("Data has been edited");
    }

    function save_credit_simulation_assumptions() {
        $this->credit_simulations_model->save_credit_simulation_assumptions($this->request);
        $this->set_output_success("Data has been edited");
    }

    function get_action_plan_estimated($vcif) {
        $result = $this->action_plan_model->get($vcif);
        $this->set_output($result);
    }

    function save_action_plan_estimated() {
        $this->action_plan_model->vcif = $this->request->vcif;
        $this->action_plan_model->group_id = $this->request->group_id;
        $this->action_plan_model->rows = $this->request->rows;


        $this->action_plan_model->save_action_plan();
        $this->set_output_success("Data has been edited");
    }

    function save_initiative() {

        $vcif = $this->request->vcif;
        $rows = $this->request->rows;
        $year = $this->request->year;
        $this->action_plan_model->save_initiative($vcif, $rows, $year);
        $this->set_output_success('Data has been saved');
    }

    function get_funding($vcif, $year) {
        $result = $this->client_needs_model->get($vcif, $year);
        $this->set_output($result);
    }

    function save_fundings() {

        $vcif = $this->request->vcif;
        $rows = $this->request->rows;
        $year = $this->request->year;
        $this->client_needs_model->save_funding($vcif, $rows, $year);
        $this->set_output_success('Data has been saved');
    }

    function get_service($vcif) {
        $result = $this->client_needs_model->getService($vcif);
        $this->set_output($result);
    }

    function save_services() {
        $vcif = $this->request->vcif;
        $rows = $this->request->rows;
        $year = $this->request->year;

        $this->client_needs_model->save_service($vcif, $rows, $year);
        $this->set_output_success('Data has been saved');
    }

    function save_fee_simulation() {
        $this->credit_simulations_model->save_fee_simulation($this->request);
        $this->set_output_success("Data has been edited");
    }

}

?>