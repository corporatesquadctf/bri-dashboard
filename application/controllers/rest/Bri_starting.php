<?php

class Bri_starting extends REST_Controller {

    private $user_id;

    function __construct() {
        parent::__construct();
        $this->load->model('bri_starting/financial_highlights_model');
        $this->load->model('bri_starting/banking_facilities_model');
        $this->load->model('bri_starting/wallet_shares_model');
        $this->load->model('bri_starting/competition_analyses_model');
        $this->load->model('login_integrasi_model');
        $this->load->model('notification_model');

        $this->user_id = $_SESSION['USER_ID'];
    }

    function get_notif() {
        $result = $this->notification_model->getNotif();
        $this->set_output($result);
    }

    function readNotif($nomer) {
        $result = $this->notification_model->readNotif($nomer);
        $this->set_output($result);
      }

    function checkDocStatus(){
        $personal_number = $_SESSION['PERSONAL_NUMBER'];
        $vcif = $this->request->vcif;
        $year = $this->request->year;
        $pass = $this->request->pass;
        $approved = $this->login_integrasi_model->loginBristarRest($personal_number, $pass);
        if($approved['success'] == true){
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $getCompany = $this->db->select('customer_name')
                                   ->where('vcif', $vcif)
                                   ->from('account_plannings')
                                   ->get()->result_array();
            $this->insertLog($persn, "", "Update Account Planning", "", $getCompany[0]['customer_name']." (".$vcif.")", "");

            $result = $this->financial_highlights_model->checkDocStatus($vcif,$year, $pass);
            $this->set_output($result);
        }else{
            $approved['message'] = "Password is incorrect";
            $this->set_output($approved);
        }
      }

    function get_financial_highlights($vcif,$year) {
        $result = $this->financial_highlights_model->get($vcif,$year);
        $this->set_output($result);
    }

    function save_financial_highlights() {
        $currency = $this->request->currency;
        $vcif = $this->request->vcif;
        $rows = $this->request->rows;
        $year_now = $this->request->year_now;

        $hasil = $this->financial_highlights_model->save_financial_highlight_value($vcif, $rows, $year_now, $currency);
        $this->set_output($hasil);
    }

    function save_banking_facilities() {
        $this->banking_facilities_model->vcif = $this->request->vcif;
        $this->banking_facilities_model->group_id = $this->request->group_id;
        $this->banking_facilities_model->rows = $this->request->rows;


        $this->banking_facilities_model->save_banking_facility();
        $this->set_output_success("Data has been saved");
    }

    function get_wallet_shares($vcif) {
        $result = $this->wallet_shares_model->get($vcif);
        $this->set_output($result);
    }

    function save_wallet_shares() {
        $this->wallet_shares_model->vcif = $this->request->vcif;
        $this->wallet_shares_model->group_id = $this->request->group_id;
        $this->wallet_shares_model->rows = $this->request->rows;

        $this->wallet_shares_model->save_wallet_shares();
        $this->set_output_success("Data has been saved");
    }

    function get_competition_analyses($vcif) {
        $result = $this->competition_analyses_model->get($vcif);
        $this->set_output($result);
    }

    function save_competition_analyses() {
        $this->competition_analyses_model->vcif = $this->request->vcif;
        $this->competition_analyses_model->group_id = $this->request->group_id;
        $this->competition_analyses_model->rows = $this->request->rows;

        $this->competition_analyses_model->save_competition_analyses();
        $this->set_output_success("Data has been saved");
    }

}

?>