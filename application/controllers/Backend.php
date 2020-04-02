<?php 

/**
* 
*/
class Backend extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	function index() {
		$userID = $_SESSION['USER_ID'];
		$this->db->select('a.*, b.ROLE_NAME')
				 ->from('USERS a')
				 ->join('ROLE b', 'b.ID = a.role_id', 'left')
				 ->where('a.STATUS', 1)
				 ->where('a.id', $userID);

		$queryData 		= $this->db->get();
		$data['user']	= $queryData->result();
		
		$this->load->view('layout/header.php');
		$this->load->view('layout/side-nav.php');
		$this->load->view('layout/top-nav.php');
		$this->load->view('backend/user_management/index.php');
		$this->load->view('layout/footer.php');
	}

	function user_management() {
		$this->load->view('layout/header.php');
		$this->load->view('layout/side-nav.php');
		$this->load->view('layout/top-nav.php');
		$this->load->view('backend/user_management/index.php');
		$this->load->view('layout/footer.php');
	}
}

?>