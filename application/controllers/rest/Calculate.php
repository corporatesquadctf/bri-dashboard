<?php

class Calculate extends REST_Controller {

    private $user_id;

    function __construct() {
        parent::__construct();
        $this->load->model('bri_starting/financial_highlights_model');
        $this->load->model('bri_starting/banking_facilities_model');
        $this->load->model('bri_starting/wallet_shares_model');
        $this->load->model('bri_starting/competition_analyses_model');
        //
        $this->load->model('calculate_simulations_model');
        $this->load->model('action_plan_model');
        $this->load->model('client_needs_model');

        $this->user_id = $_SESSION['USER_ID'];
    }

     function save_calculate_assumptions(){
        $this->calculate_simulations_model->save_calculate_simulation_assumptions($this->request);
        $this->set_output_success("Data has been edited");
    }

    function save_calc_fee_simulation(){
        
        $this->calculate_simulations_model->save_calc_fee_simulation($this->request);
        $this->set_output_success("Data has been edited");
    }
    
    function save_calc_simulation() {
        
        $this->calculate_simulations_model->user_id = $this->request->user_id;
        $this->calculate_simulations_model->group_id = $this->request->group_id;
        $this->calculate_simulations_model->rows = $this->request->rows;


        $this->calculate_simulations_model->save_calculation_simulations();
        $this->set_output_success("Data has been edited");
    }

}

?>