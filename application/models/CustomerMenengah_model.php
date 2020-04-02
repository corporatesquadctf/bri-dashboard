<?php
  class CustomerMenengah_model extends MY_Model {
    function __construct() {
      parent::__construct();
      $this->load->database();
    }
    public function getListOfCustomerMenengah($data){
      $sql = "SELECT
                t1.CIF, t1.CustomerName, t1.NPWP, t1.Address, t1.ContactPerson, t1.PhoneNumber, 
                t1.IsActive, 
                CASE 
                  WHEN t1.IsActive IS NULL THEN ''
                  WHEN t1.IsActive = 0 THEN 'Non Active' 
                  WHEN t1.IsActive = 1 THEN 'Active'
                END AS Status,
                t1.CustomerMenengahTypeId, t2.CustomerMenengahTypeName AS TypeName,
                t3.UnitKerjaId, t3.Name AS UnitKerjaName 
              FROM CustomerMenengah t1
              LEFT JOIN CustomerMenengahType t2 ON t1.CustomerMenengahTypeId = t2.CustomerMenengahTypeId
              LEFT JOIN UnitKerja t3 ON t1.UnitKerjaId = t3.UnitKerjaId
              WHERE 1=1";
      if($data["RoleId"] == USER_ROLE_RM_MENENGAH || $data["RoleId"] == USER_ROLE_ADMIN_WILAYAH){
        $sql .= " AND t1.UnitKerjaId = ".$data["UnitKerjaId"];
        if($data["RoleId"] == USER_ROLE_RM_MENENGAH){
          $sql .= " AND t1.CIF IN (SELECT CIF FROM DisposisiCustomerMenengah WHERE UserId = '".$data["UserId"]."' AND IsActive = 1)";
        }
      }else{
        if($data["UnitKerjaId"] != "all"){
          $sql .= " AND t1.UnitKerjaId = ".$data["UnitKerjaId"];
        }
      }
      if($data["IsActiveId"] != "all"){
        $sql .= " AND t1.IsActive = ".$data["IsActiveId"];
      }
      if($data["Keyword"] != NULL){
        $sql .= " AND (";
        $sql .= " t1.CIF LIKE '%".$data["Keyword"]."%'";
        $sql .= " OR t1.CustomerName LIKE '%".$data["Keyword"]."%'";
        $sql .= " OR t1.Address LIKE '%".$data["Keyword"]."%'";
        $sql .= " OR t1.ContactPerson LIKE '%".$data["Keyword"]."%'";
        $sql .= " OR t3.Name LIKE '%".$data["Keyword"]."%'";
        $sql .= " )";
      }
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    public function addCustomer($data){
      $this->db->trans_begin();
      $this->db->insert("CustomerMenengah", $data);
      $errorStatus = $this->db->error();
      if($errorStatus["code"]<>0){
        $result = array(
          "status" => "error",
          "message" => $errorStatus["message"],
          "event" => "Insert Customer"
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
    public function updateCustomer($data, $oldCIF){
      $this->db->trans_begin();
      $where = array(
        "CIF" => $oldCIF
      );
      $this->db->update("CustomerMenengah", $data, $where);
      $errorStatus = $this->db->error();
      if($errorStatus["code"]<>0){
        $result = array(
          "status" => "error",
          "message" => $errorStatus["message"],
          "event" => "Update Customer"
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
    public function getCustomerTypeOption(){
      $sql = "SELECT CustomerMenengahTypeId, CustomerMenengahTypeName
              FROM CustomerMenengahType";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    public function getUnitKerjaOption($unitKerjaId){
      $sql = "SELECT UnitKerjaId, Name AS UnitKerjaName
              FROM UnitKerja
              WHERE IsActive = 1
              AND SegmentId = 2";
      if($unitKerjaId != "all"){
        $sql .= " AND UnitKerjaId = ".$unitKerjaId;
      }
      $sql .= " ORDER BY UnitKerjaName";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    public function serviceCheckCIFCustomer($cif, $oldcif = null){
      $sql = "SELECT CIF FROM CustomerMenengah WHERE CIF = '".$cif."'" ;
      $query = $this->db->query($sql);
      $result = $query->result();
      if(!empty($result)){
        if($oldcif != null){
          if($result[0]->CIF == $oldcif){
            return "true";
          }else return "false";
        }else return "false";
      }else return "true";
    }
    public function serviceCheckNPWPCustomer($data){
      $sql = "SELECT CIF FROM CustomerMenengah WHERE 1=1";
      if($data["CIF"] != NULL || !empty($data["CIF"])){
        $sql .= " AND CIF != '".$data["CIF"]."'";
      }
      if($data["NPWP"] != NULL || !empty($data["NPWP"])){
        $sql .= " AND NPWP = '".$data["NPWP"]."'";
      }
      $query = $this->db->query($sql);
      $result = $query->result();
      if(!empty($result)){
          return "false";
      }else return "true";
    }
  }
?>