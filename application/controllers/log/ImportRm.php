<?php

class ImportRm extends MY_Controller {

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
      $this->load->model('Log_model');
	}

    function index() {
        $this->checkModule();

        $data['log_list_scheduler'] = $this->Log_model->get_log_list(2, 1);
        $data['log_list_manual'] = $this->Log_model->get_log_list(2, 0);
        $data['links'] = 'log/ImportRm';
        $data['title'] = 'Log Import Scheduler Relationship Manager';
        $data['link_import'] = 'scheduled-scripts/script-import-monitoring/import_monitoring.php?procedure=0';
        // $data['link_import'] = 'scheduled-scripts/script-import-monitoring/relationshipmanager/rm_script.php?procedure=0';

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('log/log_import.php', $data);
        $this->load->view('layout/footer.php');
    }
}


?>