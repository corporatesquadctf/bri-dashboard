<?php

class FTP_Position_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getFTPGroup(){
        $sql = "SELECT FTPGroupId, Name FROM FTPGroup WHERE IsActive = 1 ORDER BY FTPGroupId";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getFTPItem($FTPGroupId){
        $sql = "SELECT FTPItemId, Name FROM FTPItem WHERE FTPGroupId = ".$FTPGroupId." AND IsActive = 1 ORDER BY FTPItemId";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getFTP($FTPItemId){
        $sql = "SELECT t1.FTPItemId, t1.Name AS FTPItemName, t2.FTPGroupId, t2.Name AS FTPGroupName
                FROM FTPItem t1
                LEFT JOIN FTPGroup t2 ON t1.FTPGroupId = t2.FTPGroupId
                WHERE t1.IsActive = 1 AND t2.IsActive = 1";
        if($FTPItemId != NULL){
            $sql .= " AND t1.FTPItemId = ".$FTPItemId;
        }
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getFTPDetail($refTable, $FTPItemId, $Order='', $Description='', $page=''){
        $sql = "SELECT * FROM ".$refTable." WHERE FTPItemId = ".$FTPItemId." AND IsActive = 1";
        if (!empty($Description)) {
            $sql .= " AND Description = '".$Description."' ";
        }
        if (!empty($Order)) {
            $sql .= " ORDER BY ".$Order." DESC";
        }
        if (!empty($page)) {
            $sql .= ' ORDER BY 1 OFFSET '.$page['rowno'].' ROWS FETCH NEXT '.$page['rowperpage'].' ROWS ONLY';
        }
        // echo $sql;

        $result = $this->db->query($sql);
        return $result->result();
    }

    function insertFTPSimpanan($data){
        $this->db->trans_begin();
        $whereUpdate = array(
            "FTPItemId" => $data["FTPItemId"]
        );
        $arrayUpdate = array(
            "IsActive" => 0,
            "ModifiedDate" => $data["CurrentDate"],
            "ModifiedBy" => $data["UserId"]
        );
        $this->db->update("FTPItemSimpanan", $arrayUpdate, $whereUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
            );
        }else{
            foreach($data["ArrSimpanan"] as $row){
                if($row["FTPItemSimpananId"] == 0){
                    $arrayInsert = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "BottomMargin" => $row["BottomMargin"],
                        "TopMargin" => $row["TopMargin"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "CreatedDate" => $data["CurrentDate"],
                        "CreatedBy" => $data["UserId"]
                    );
                    $this->db->insert("FTPItemSimpanan", $arrayInsert);
                }else{
                    $whereUpdate = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "FTPItemSimpananId" => $row["FTPItemSimpananId"]
                    );
                    $arrayUpdate = array(
                        "BottomMargin" => $row["BottomMargin"],
                        "TopMargin" => $row["TopMargin"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "ModifiedDate" => $data["CurrentDate"],
                        "ModifiedBy" => $data["UserId"]
                    );
                    $this->db->update("FTPItemSimpanan", $arrayUpdate, $whereUpdate);
                }
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"]
                    );
                }
            }
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

    function insertFTPDeposito($data){
        $this->db->trans_begin();
        $whereUpdate = array(
            "FTPItemId" => $data["FTPItemId"]
        );
        $arrayUpdate = array(
            "IsActive" => 0,
            "ModifiedDate" => $data["CurrentDate"],
            "ModifiedBy" => $data["UserId"]
        );
        $this->db->update("FTPItemDeposito", $arrayUpdate, $whereUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
            );
        }else{
            foreach($data["ArrDeposito"] as $row){
                if($row["FTPItemDepositoId"] == 0){
                    $arrayInsert = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "Term" => $row["Term"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "CreatedDate" => $data["CurrentDate"],
                        "CreatedBy" => $data["UserId"]
                    );
                    $this->db->insert("FTPItemDeposito", $arrayInsert);
                }else{
                    $whereUpdate = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "FTPItemDepositoId" => $row["FTPItemDepositoId"]
                    );
                    $arrayUpdate = array(
                        "Term" => $row["Term"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "ModifiedDate" => $data["CurrentDate"],
                        "ModifiedBy" => $data["UserId"]
                    );
                    $this->db->update("FTPItemDeposito", $arrayUpdate, $whereUpdate);
                }
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"]
                    );
                }
            }
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

    function insertFTPDepositoValas($data){
        $this->db->trans_begin();
        $whereUpdate = array(
            "FTPItemId" => $data["FTPItemId"]
        );
        $arrayUpdate = array(
            "IsActive" => 0,
            "ModifiedDate" => $data["CurrentDate"],
            "ModifiedBy" => $data["UserId"]
        );
        $this->db->update("FTPItemDepositoValas", $arrayUpdate, $whereUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
            );
        }else{
            foreach($data["ArrDepositoValas"] as $row){
                if($row["FTPItemDepositoValasId"] == 0){
                    $arrayInsert = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "Term" => $row["Term"],
                        "InterestRateLess" => $row["InterestRateLess"],
                        "InterestRateMore" => $row["InterestRateMore"],
                        "IsActive" => $row["IsActive"],
                        "CreatedDate" => $data["CurrentDate"],
                        "CreatedBy" => $data["UserId"]
                    );
                    $this->db->insert("FTPItemDepositoValas", $arrayInsert);
                }else{
                    $whereUpdate = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "FTPItemDepositoValasId" => $row["FTPItemDepositoValasId"]
                    );
                    $arrayUpdate = array(
                        "Term" => $row["Term"],
                        "InterestRateLess" => $row["InterestRateLess"],
                        "InterestRateMore" => $row["InterestRateMore"],
                        "IsActive" => $row["IsActive"],
                        "ModifiedDate" => $data["CurrentDate"],
                        "ModifiedBy" => $data["UserId"]
                    );
                    $this->db->update("FTPItemDepositoValas", $arrayUpdate, $whereUpdate);
                }
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"]
                    );
                }
            }
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

    function insertFTPPinjaman($data){
        $this->db->trans_begin();
        $sql = "SELECT * FROM FTPItemPinjaman WHERE IsActive = 1";
        $query = $this->db->query($sql);
        $rs = $query->result();
        if(!empty($rs)){
            $whereUpdate = array(
                "FTPItemId" => $data["FTPItemId"]
            );
            $arrayUpdate = array(
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("FTPItemPinjaman", $arrayUpdate, $whereUpdate);
        }else{
            $arrayInsert = array(
                "FTPItemId" => $data["FTPItemId"],
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "CreatedDate" => $data["CurrentDate"],
                "CreatedBy" => $data["UserId"]
            );
            $this->db->insert("FTPItemPinjaman", $arrayInsert);
        }
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
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

    function insertFTPTransitInterest($data){
        $this->db->trans_begin();
        $sql = "SELECT * FROM FTPItemTransitInterest WHERE IsActive = 1 AND FTPItemId = ".$data["FTPItemId"];
        $query = $this->db->query($sql);
        $rs = $query->result();
        if(!empty($rs)){
            $whereUpdate = array(
                "FTPItemId" => $data["FTPItemId"]
            );
            $arrayUpdate = array(
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("FTPItemTransitInterest", $arrayUpdate, $whereUpdate);
        }else{
            $arrayInsert = array(
                "FTPItemId" => $data["FTPItemId"],
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "CreatedDate" => $data["CurrentDate"],
                "CreatedBy" => $data["UserId"]
            );
            $this->db->insert("FTPItemTransitInterest", $arrayInsert);
        }
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
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

    function insertFTPSCF($data){
        $this->db->trans_begin();
        $whereUpdate = array(
            "FTPItemId" => $data["FTPItemId"]
        );
        $arrayUpdate = array(
            "IsActive" => 0,
            "ModifiedDate" => $data["CurrentDate"],
            "ModifiedBy" => $data["UserId"]
        );
        $this->db->update("FTPItemTransitInterest", $arrayUpdate, $whereUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
            );
        }else{
            foreach($data["ArrSCF"] as $row){
                if($row["FTPItemTransitInterestId"] == 0){
                    $arrayInsert = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "BottomMarginTerm" => $row["BottomMargin"],
                        "TopMarginTerm" => $row["TopMargin"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "CreatedDate" => $data["CurrentDate"],
                        "CreatedBy" => $data["UserId"]
                    );
                    $this->db->insert("FTPItemTransitInterest", $arrayInsert);
                }else{
                    $whereUpdate = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "FTPItemTransitInterestId" => $row["FTPItemTransitInterestId"]
                    );
                    $arrayUpdate = array(
                        "BottomMarginTerm" => $row["BottomMargin"],
                        "TopMarginTerm" => $row["TopMargin"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "ModifiedDate" => $data["CurrentDate"],
                        "ModifiedBy" => $data["UserId"]
                    );
                    $this->db->update("FTPItemTransitInterest", $arrayUpdate, $whereUpdate);
                }
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"]
                    );
                }
            }
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

    function insertFTPPinjamanValas($data){
        $this->db->trans_begin();
        $sql = "SELECT * FROM FTPItemPinjamanValas WHERE IsActive = 1";
        $query = $this->db->query($sql);
        $rs = $query->result();
        if(!empty($rs)){
            $whereUpdate = array(
                "FTPItemId" => $data["FTPItemId"]
            );
            $arrayUpdate = array(
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("FTPItemPinjamanValas", $arrayUpdate, $whereUpdate);
        }else{
            $arrayInsert = array(
                "FTPItemId" => $data["FTPItemId"],
                "BottomMarginInterestRate" => $data["BottomMarginInterestRate"],
                "TopMarginInterestRate" => $data["TopMarginInterestRate"],
                "Description" => $data["Description"],
                "IsActive" => $data["IsActive"],
                "CreatedDate" => $data["CurrentDate"],
                "CreatedBy" => $data["UserId"]
            );
            $this->db->insert("FTPItemPinjamanValas", $arrayInsert);
        }
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
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

    function insertFTPPrimeLendingRate($data){
        $this->db->trans_begin();
        $sql = "SELECT * FROM FTPItemPrimeLandingRate WHERE IsActive = 1";
        $query = $this->db->query($sql);
        $rs = $query->result();
        if(!empty($rs)){
            $whereUpdate = array(
                "FTPItemId" => $data["FTPItemId"]
            );
            $arrayUpdate = array(
                "SBDK" => $data["SBDK"],
                "KreditKorporasi" => $data["KreditKorporasi"],
                "IsActive" => $data["IsActive"],
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("FTPItemPrimeLandingRate", $arrayUpdate, $whereUpdate);
        }else{
            $arrayInsert = array(
                "FTPItemId" => $data["FTPItemId"],
                "SBDK" => $data["SBDK"],
                "KreditKorporasi" => $data["KreditKorporasi"],
                "IsActive" => $data["IsActive"],
                "CreatedDate" => $data["CurrentDate"],
                "CreatedBy" => $data["UserId"]
            );
            $this->db->insert("FTPItemPrimeLandingRate", $arrayInsert);
        }
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
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

    function insertFTP($data){
        $this->db->trans_begin();
        $whereUpdate = array(
            "FTPItemId" => $data["FTPItemId"]
        );
        $arrayUpdate = array(
            "IsActive" => 0,
            "ModifiedDate" => $data["CurrentDate"],
            "ModifiedBy" => $data["UserId"]
        );
        $this->db->update("FTPItemFTP", $arrayUpdate, $whereUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"]
            );
        }else{
            foreach($data["ArrFTP"] as $row){
                if($row["FTPItemFTPId"] == 0){
                    $arrayInsert = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "Description" => $row["Description"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "CreatedDate" => $data["CurrentDate"],
                        "CreatedBy" => $data["UserId"]
                    );
                    $this->db->insert("FTPItemFTP", $arrayInsert);
                }else{
                    $whereUpdate = array(
                        "FTPItemId" => $data["FTPItemId"],
                        "FTPItemFTPId" => $row["FTPItemFTPId"]
                    );
                    $arrayUpdate = array(
                        "Description" => $row["Description"],
                        "InterestRate" => $row["InterestRate"],
                        "IsActive" => $row["IsActive"],
                        "ModifiedDate" => $data["CurrentDate"],
                        "ModifiedBy" => $data["UserId"]
                    );
                    $this->db->update("FTPItemFTP", $arrayUpdate, $whereUpdate);
                }
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"]
                    );
                }
            }
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
