<?php

/**
* 
*/
class Customer_model extends MY_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
  }
  
  function generate_vcif($nama){
    $output = strtoupper('NC_' . substr($nama, 0, 4));
    $sukses = false;
    while($sukses == false) {
      $res = $this->db
          ->select("p.VCIF AS vcif")
          ->from('PAR_VCIF p')
          ->where('p.VCIF', $output)
          ->get()->result();
      if (count($res) == 0){
        $sukses = true;
      }else{
        $nama = preg_replace('/\s+/', '', $nama);
        $output = strtoupper('NC_' . substr(str_shuffle($nama), 0, 4));
      }
    }
    return $output;
  }

  function generate_cif($nama){
    $output = strtoupper('NN_' . substr($nama, 0, 4));
    $sukses = false;
    while($sukses == false) {
      $res = $this->db
          ->select("p.CIFNO AS cif")
          ->from('PAR_GROUP_DETAIL_CIF p')
          ->where('p.CIFNO', $output)
          ->get()->result();
      if (count($res) == 0){
        $sukses = true;
      }else{
        $nama = preg_replace('/\s+/', '', $nama);
        $output = strtoupper('NN_' . substr(str_shuffle($nama), 0, 4));
      }
    }
    return $output;
  }

  function get_group(){
    $rows = $this->db
        ->select("p.ID_GROUP AS id, p.NAMA_GROUP AS nama")
        ->from('PAR_GROUP p')
        ->get()->result();
    return $rows;
  }

  function check_exist($a){
    //Check apakah sudah pernah ada group id ini
    $check = $this->db
    ->select("p.ID_GROUP AS id, p.NAMA_GROUP AS nama")
    ->from('PAR_GROUP p')
    ->where('p.ID_GROUP', $group_id)
    ->get()->result();
  }

	function add_customer($custName, $groupName) {
    $updateData_par_group = "0";
    //Check Customer Name exist
    $res = $this->db
          ->select("p.NAME AS name")
          ->select("p.STATUS_VCIF AS status")
          ->from('PAR_VCIF p')
          ->where('p.NAME', $custName)
          ->where('p.STATUS_VCIF', 1)
          ->get()->result();
    if (count($res) > 0){
      $output['error'] = 1;
      $output['msg'] = "Nama Customer Sudah Ada";
      return $output;
    }
    //Create new PAR_GROUP
    if ($groupName->id == "0"){
      $newData = Array(
        'NAMA_GROUP' => $groupName->nama,
        'KETERANGAN' => $groupName->nama,
        'LAST_UPDATE' => date('Y-m-d H:i:s')
      );
      $updateData_par_group = $this->db->insert('PAR_GROUP', $newData);
      if($updateData_par_group){
        $groupName->id = $this->db->insert_id();
      }
    };
    //Generate VCIF
    $vcif = $this->generate_vcif($custName);
    $cif = $this->generate_cif($custName);
    //Create New PAR_GROUP_DETAIL_CIF
    //(ID_GROUP, CIFNO, LAST_UPDATE, USER_UPDATE)
    $newData = Array(
      'ID_GROUP' => $groupName->id,
      'CIFNO' => $cif,
      'LAST_UPDATE' => date('Y-m-d H:i:s')
    );
    $persn = $_SESSION['PERSONAL_NUMBER'];
    $this->insertLog($persn,"", "insert Par_Group_Detail_CIF", "", json_encode($newData), "");
    $updateData_par_group_detail_cif = $this->db->insert('PAR_GROUP_DETAIL_CIF', $newData);
    //Create New PAR_VCIF
    //(VCIF, NAME, ID)
    $newData = Array(
      'VCIF' => $vcif,
      'NAME' => $custName,
      'STATUS_VCIF' => 1,
    );
     $this->insertLog($persn,"", "insert Par VCIF", "", json_encode($newData), "");
    $updateData_par_vcif = $this->db->insert('PAR_VCIF', $newData);
    //Create New PAR_MAPPING_VCIF
    //(ID, VCIF, NAMA, CIF, RELATION, GROUP_NAME)
    $newData = Array(
      'VCIF' => $vcif,
      'NAMA' => $custName,
      'CIF' => $cif,
      'RELATION' => 'GROUP'
    );
    $this->insertLog($persn,"", "insert Par Mapping Vcif", "", json_encode($newData), "");
    $updateData_par_mapping_vcif = $this->db->insert('PAR_MAPPING_VCIF', $newData);
    $output['groupName'] = $groupName;
    $output['custName'] = $custName;
    $output['vcif'] = $vcif;
    $output['cif'] = $cif;
    $output['updateData_par_group'] = $updateData_par_group;
    $output['updateData_par_group_detail_cif'] = $updateData_par_group_detail_cif;
    $output['updateData_par_vcif'] = $updateData_par_vcif;
    $output['updateData_par_mapping_vcif'] = $updateData_par_mapping_vcif;
    $output['group'] = $this->get_group();
    $output['error'] = 0;
		return $output; 
  }
  function edit_customer($custName, $groupName) {
    $output['groupName'] = $groupName;
    $output['custName'] = $custName;
    return $output;
  }
}

?>