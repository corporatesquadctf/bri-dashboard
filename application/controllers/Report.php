<?php

/**
 * 
 */
class Report extends MY_Controller {

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
        $this->load->model('user_model');
        $this->load->model('master_model');
        $this->load->model('accountplanning');
        $this->load->model('notification_model');
        $this->load->database();
    }

    function index() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('report/index.php');
        $this->load->view('layout/footer.php');
    }

    function monitoring() {
        $this->load->model('user_model');
        $data['divisions'] = $this->master_model->get_div();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('report/monitoring.php', $data);
        $this->load->view('layout/footer.php');
    }

    function timeseries() {

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('report/timeseries.php');
        $this->load->view('layout/footer.php');
    }

    function log() {
        $this->load->model('master_model');
        $data['log'] = $this->master_model->get_log();
        $data['tb_log'] = $this->master_model->get_tb_log();

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('report/log.php', $data);
        $this->load->view('layout/footer.php');
    }

}

?>