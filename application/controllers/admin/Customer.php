<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Customer extends MY_Controller {

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

    public function index() {

        $this->checkModule();

        $this->load->database();
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get Customer (Group Company)", "", "", "");

        $data['group'] = $this->db
                        ->select("p.ID_GROUP AS id, p.NAMA_GROUP AS nama")
                        ->from('PAR_GROUP p')
                        ->get()->result();
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/customer_view.php', $data);
        $this->load->view('layout/footer.php');
    }

}

?>