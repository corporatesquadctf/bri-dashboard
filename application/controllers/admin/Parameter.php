<?php 

/**
* 
*/
class Parameter extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	function index() {
		$this->load->view('layout/header.php');
		$this->load->view('layout/side-nav.php');
		$this->load->view('layout/top-nav.php');
		$this->load->view('backend/parameter/index.php');
		$this->load->view('layout/footer.php');
	}
}

?>