<?php

class Disposisi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model("notification_model");
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->currentDate = $today->format('Y-m-d H:i:s');
    }
    public function getTotalCustomerMenengah($unitKerjaId = NULL, $searchTxt=NULL){
        $whereClause = "";
        if($unitKerjaId != NULL){
            $whereClause .= " WHERE UnitKerjaId = ".$unitKerjaId;
        }
        if ($searchTxt != NULL) {
            $whereClause .= " AND CustomerName LIKE '%".$searchTxt."%'";
        }
        $sql = "SELECT COUNT(*) AS TotalRows
                FROM CustomerMenengah ".$whereClause;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->TotalRows;
    }
    public function getListOfCustomerMenengah($unitKerjaId = NULL, $rowPerPage, $rowNo, $searchTxt=NULL){
        $whereClause = "";
        if($unitKerjaId != NULL){
            $whereClause .= " AND t1.UnitKerjaId = ".$unitKerjaId;
        }
        if ($searchTxt != NULL) {
            $whereClause .= " AND t1.CustomerName LIKE '%".$searchTxt."%'";
        }
        /*
        $sql = "SELECT t1.CIF, t1.CustomerName,
                    t2.UserId AS rmUserId, t8.Name as rmName,
                    t3.BakiDebet AS TotalPinjaman, t4.BakiDebetRatas AS RatasPinjaman,
                    t5.Saldo AS TotalSimpanan, t6.AverageSaldo AS RatasSimpanan
                FROM CustomerMenengah t1
                LEFT JOIN DisposisiCustomerMenengah t2 ON t1.CIF = t2.CIF
                LEFT JOIN Summary_PinjamanDailyCif t3 ON t1.CIF = t3.Cif
                LEFT JOIN Summary_PinjamanMonthlyCif t4 ON t1.CIF = t4.Cif
                LEFT JOIN Summary_SimpananDailyCif t5 ON t1.CIF = t5.Cif
                LEFT JOIN Summary_SimpananMonthlyCif t6 ON t1.CIF = t6.Cif
                LEFT JOIN [User] t8 ON t2.UserId = t8.UserId
                WHERE (t2.IsActive IS NULL OR t2.IsActive = 1) AND t2.EndDate IS NULL ".$whereClause."
                ORDER BY t1.CustomerName
                OFFSET ".$rowNo." ROWS FETCH NEXT ".$rowPerPage." ROWS ONLY";
        */
        $sql = "SELECT t1.CIF, t1.CustomerName,
                    t2.UserId AS rmUserId, t8.Name as rmName
                FROM CustomerMenengah t1
                LEFT JOIN DisposisiCustomerMenengah t2 ON t1.CIF = t2.CIF
                LEFT JOIN [User] t8 ON t2.UserId = t8.UserId
                WHERE (t2.IsActive IS NULL OR t2.IsActive = 1) AND t2.EndDate IS NULL ".$whereClause."
                ORDER BY t1.CustomerName
                OFFSET ".$rowNo." ROWS FETCH NEXT ".$rowPerPage." ROWS ONLY";
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;
    }
    public function getListUser($roleId = NULL, $unitKerjaId = NULL){
        $whereClause = "";
        if($roleId != NULL){
            $whereClause .= " AND RoleId = ".$roleId;
        }
        if($unitKerjaId != NULL){
            $whereClause .= " AND UnitKerjaId =".$unitKerjaId;
        }
        $sql = "SELECT UserId, Name
                FROM [User]
                WHERE IsActive = 1".$whereClause."
                ORDER BY Name";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function disposisiCustomerMenengah($cif, $rmId, $createdBy){
        $this->db->trans_begin();
        $isCommit = 1;

        /* Update Disposisi Customer Menengah */
        $sqlUpdate = "UPDATE DisposisiCustomerMenengah
                      SET IsActive = 0, EndDate = '".$this->currentDate."', ModifiedBy = '".$createdBy."'
                      WHERE CIF = '".$cif."' AND IsActive = 1";
        $queryUpdate = $this->db->query($sqlUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Disposisi Customer Menengah"
            );
            $isCommit = 0;
        }else{
            /* Insert Disposisi Customer Menengah */
            $dataInsert = array(
                "CIF" => $cif,
                "UserId" => $rmId,
                "IsActive" => 1,
                "StartDate" => $this->currentDate,
                "CreatedBy" => $createdBy
            );
            $this->db->insert("DisposisiCustomerMenengah", $dataInsert);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Insert Disposisi Customer Menengah"
                );
                $isCommit = 0;
            }else{
                /* Update Pipeline Owner */
                $sqlPipeline = "UPDATE Pipeline SET CreatedBy = '".$rmId."' WHERE CIFId = (SELECT CustomerMenengahId FROM CustomerMenengah WHERE CIF = '".$cif."')";
                $queryPipeline = $this->db->query($sqlPipeline);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Pipeline Owner"
                    );
                    $isCommit = 0;
                }

                /* Update Proses Kredit Owner */
                $sqlProsesKredit = "UPDATE ProsesKredit SET CreatedBy = '".$rmId."'
                                WHERE PipelineId = (SELECT PipelineId FROM Pipeline WHERE CIFId = (SELECT CustomerMenengahId FROM CustomerMenengah WHERE CIF = '".$cif."'));";
                $queryProsesKredit = $this->db->query($sqlProsesKredit);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Proses Kredit Owner"
                    );
                    $isCommit = 0;
                }
            }
        }

        if ($isCommit == 0){
            $this->db->trans_rollback();
        }else{
            $this->notification_model->addNotif($rmId, "Disposisi Customer Menengah", "Redisposisi Customer Menengah", "Nasabah dengan CIF ".$cif." telah didisposisikan ke anda", "admin/customer_menengah");
            $result = array(
                "status" => "success",
                "message" => "Disposisi success"
            );
            $this->db->trans_commit();
        }
        return $result;
    }
    public function getActiveProsesKredit($cif){
        $sql = "SELECT ProsesKreditId
                FROM ProsesKredit t1
                LEFT JOIN Pipeline t2 ON t1.PipelineId = t2.PipelineId
                LEFT JOIN CustomerMenengah t3 ON t2.CIFId = t3.CustomerMenengahId
                WHERE t1.IsAkad = 0 AND t3.CIF = '".$cif."'";
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return 1;
        }else return 0;
    }
}

?>