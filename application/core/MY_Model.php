<?php
class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function insertLog($pers, $name, $action, $ori, $change, $msg){
        $this->load->database();
		$newData = [
			'personal_number'   => $pers,
			'action' => $action,
			'addon' => date('Y-m-d H:i:s'),
			'name' => $name,
			'ori' => $ori,
			'change' => $change,
			'msg' => $msg
		];
		$updateData = $this->db->insert('LOG', $newData);
	}
}