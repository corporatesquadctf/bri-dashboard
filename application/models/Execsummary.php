<?php

/**
* 
*/
class Execsummary extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function getData() {
		$where = array();

		$this->db->select('*');
		$this->db->from('dataset1');

		$record = $this->db->get();

		return $dataRec = $record->result(); 
	}
}

?>