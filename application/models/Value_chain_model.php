<?php
  class Value_chain_model extends MY_Model {
    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function getUnitKerjaOption($segmentId = null){
      $sql = "SELECT UnitKerjaId, Name AS UnitKerjaName
              FROM UnitKerja
              WHERE IsActive = 1";
      if($segmentId != null){
        $sql .= " AND SegmentId = ".$segmentId;
      }  
      $sql .= " ORDER BY UnitKerjaName";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function getDataValueChain($data){
      $sql = "SELECT t1.*, t2.Name AS UnitKerjaName 
              FROM ValueChain t1 
              LEFT JOIN UnitKerja t2 ON t1.UnitKerjaId = t2.UnitKerjaId
              WHERE t1.IsActive = 1 AND t1.Year = ".$data["Year"];
      if($data["UnitKerjaId"] != NULL){
        $sql .= " AND t1.UnitKerjaId = ".$data["UnitKerjaId"];
      }
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function insertValueChain($data){
      $this->db->trans_begin();
      $this->db->insert("ValueChain", $data);
      $errorStatus = $this->db->error();
      if($errorStatus["code"]<>0){
        $result = array(
          "status" => "error",
          "message" => $errorStatus["message"],
          "event" => "Insert Value Chain"
        );
      }
      
      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
      }else{
        $this->db->trans_commit();
        $result = array(
          "status" => "success"
        );
      }        
      return $result;
    }
  }
?>