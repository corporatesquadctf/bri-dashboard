<?php

class CreateAccountPlanning_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function getTotalCustomerList($userId, $searchTxt=NULL) {
        $sql = "SELECT COUNT(*) AS numrows
                FROM DisposisiCustomerMenengah t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIF = t2.CIF
                WHERE t1.IsActive = 1 AND t1.UserId = '".$userId."'";

        if ($searchTxt != NULL) {
            $sql .= " AND t2.CustomerName LIKE '%".$searchTxt."%'";
        }
        $result = $this->db->query($sql)->result_array();
        return $result[0]['numrows'];
    }

    public function getCustomerList($userId, $year = NULL, $rowperpage, $rowno, $searchTxt = NULL) {
        $sql = "SELECT  t1.CIF, t2.CustomerName, t3.AccountPlanningMenengahId
                FROM DisposisiCustomerMenengah t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIF = t2.CIF
                LEFT JOIN AccountPlanningMenengah t3 ON t1.CIF = t3.CIF
                WHERE t1.IsActive = 1 AND t1.UserId = '".$userId."'";
        
        if($year != NULL){
            $sql ." AND t3.Year = '".$year."'";
        }
        
        if ($searchTxt != NULL) {
            $sql .= " AND t2.CustomerName LIKE '%".$searchTxt."%'";
        }

        $sql .= ' ORDER BY CustomerName OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function insertAccountPlanning($year, $userId, $cif) {
        $isCommit = 1;
        $this->db->trans_begin();
        $data = array(
            "Year" => $year,
            "CIF" => $cif,
            "CreatedDate" => $this->current_datetime,
            "CreatedBy" => $userId
        );
        $this->db->insert("AccountPlanningMenengah", $data);
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }else{
            $insert_id = $this->db->insert_id();
            $dataOwner = array(
                "AccountPlanningMenengahId" => $insert_id,
                "UserId" => $userId,
                "IsActive" => 1,
                "StartDate" => $this->current_datetime,
                "CreatedBy" => $userId
            );
            $this->db->insert("AccountPlanningOwnerMenengah", $dataOwner);
            if ($this->db->trans_status() === FALSE){
                $isCommit = 0;
            }else{
                $dataStatus = array(
                    "AccountPlanningMenengahId" => $insert_id,
                    "DocumentStatusId" => 0,
                    "CreatedDate" => $this->current_datetime,
                    "CreatedBy" => $userId
                );
                $this->db->insert("AccountPlanningStatusMenengah", $dataStatus);
                if ($this->db->trans_status() === FALSE){
                    $isCommit = 0;
                }
            }
        }

        if($isCommit = 1){
            $this->db->trans_commit();
            $result = array(
                "status" => "success",
                "message" => $insert_id
            );
        }else{
            $this->db->trans_rollback();
            $result = array(
                "status" => "error",
                "message" => "Failed to Create Account Planning"
            );
        }
        return $result;
    }
}
