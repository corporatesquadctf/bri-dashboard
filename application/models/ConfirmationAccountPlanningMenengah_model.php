<?php
    class ConfirmationAccountPlanningMenengah_model extends CI_Model {
        public function getTotalConfirmationAccountPlanning($userId, $keyword = ""){
            $sql = "SELECT COUNT(t1.AccountPlanningMenengahId) AS Total
                    FROM AccountPlanningMenengah t1
                    LEFT JOIN AccountPlanningApproverMenengah t2 ON t1.AccountPlanningMenengahId = t2.AccountPlanningMenengahId
                    LEFT JOIN AccountPlanningStatusMenengah t3 ON t1.AccountPlanningMenengahId = t3.AccountPlanningMenengahId
                    LEFT JOIN CustomerMenengah t4 ON t1.CIF = t4.CIF
                    WHERE t2.AccountPlanningApproverMenengahId IN (
                        SELECT AccountPlanningApproverMenengahId 
                        FROM AccountPlanningApproverMenengah 
                        WHERE UserId = '".$userId."'
                        AND IsActive = 1 )
                    AND t3.AccountPlanningStatusMenengahId = (
                        SELECT MAX(AccountPlanningStatusMenengahId) FROM AccountPlanningStatusMenengah WHERE AccountPlanningMenengahId = t1.AccountPlanningMenengahId
                    )
                    AND t3.DocumentStatusId = 2";
            if(!empty($keyword)){
                $sql .= "AND (t4.CustomerName LIKE '%".$keyword."%' ESCAPE '!')";
            }
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result[0]->Total;
        }
        public function getConfirmationAccountPlanning($userId, $rowPage, $rowNo, $keyword = ""){
            $sql = "SELECT 
                        t1.AccountPlanningMenengahId, t1.Year, t1.CIF,
                        t2.UserId AS ApproverId, t5.Name AS ApproverName,
                        t3.DocumentStatusId, t6.Name AS Status,
                        t4.CustomerName
                    FROM AccountPlanningMenengah t1
                    LEFT JOIN AccountPlanningApproverMenengah t2 ON t1.AccountPlanningMenengahId = t2.AccountPlanningMenengahId
                    LEFT JOIN AccountPlanningStatusMenengah t3 ON t1.AccountPlanningMenengahId = t3.AccountPlanningMenengahId
                    LEFT JOIN CustomerMenengah t4 ON t1.CIF = t4.CIF
                    LEFT JOIN [User] t5 ON t2.UserId = t5.UserId
                    LEFT JOIN DocumentStatusMenengah t6 ON t3.DocumentStatusId = t6.DocumentStatusMenengahId
                    WHERE t2.AccountPlanningApproverMenengahId IN (
                        SELECT AccountPlanningApproverMenengahId 
                        FROM AccountPlanningApproverMenengah 
                        WHERE UserId = '".$userId."'
                        AND IsActive = 1 )
                    AND t3.AccountPlanningStatusMenengahId = (
                        SELECT MAX(AccountPlanningStatusMenengahId) FROM AccountPlanningStatusMenengah WHERE AccountPlanningMenengahId = t1.AccountPlanningMenengahId
                    )
                    AND t3.DocumentStatusId = 2";
            if(!empty($keyword)){
                $sql .= "AND (t4.CustomerName LIKE '%".$keyword."%' ESCAPE '!')";
            }
            $sql .= " ORDER BY t2.CreatedDate DESC OFFSET ".$rowNo." ROWS FETCH NEXT ".$rowPage." ROWS ONLY";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            return $result;
        }
        public function approvalAccountPlanning($data){
            $this->db->trans_begin();
            $where = array(
                "UserId" => $data["UserId"],
                "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"]
            );
            $dataApprover = array(
                "IsApproved" => $data["IsApproved"],
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("AccountPlanningApproverMenengah", $dataApprover, $where);
            $errorApprover = $this->db->error();
            if($errorApprover["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorApprover["message"],
                    "event" => "Update Approver"
                );
            }else{
                $dataDocStatus = array(
                    "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"],
                    "DocumentStatusId" => $data["DocumentStatusId"],
                    "Comment" => $data["Comment"],
                    "CreatedDate" => $data["CurrentDate"],
                    "CreatedBy" => $data["UserId"]
                );
                $this->db->insert("AccountPlanningStatusMenengah", $dataDocStatus);
                $errorDocStatus = $this->db->error();
                if($errorDocStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorDocStatus["message"],
                        "event" => "Insert Document Status"
                    );
                }else{
                    switch($data["DocumentStatusId"]){
                        case 3: $status = "Approved"; break;
                        case 4: $status = "Rejected"; break;
                        default: break;
                    }
                    $result = array(
                        "status" => "success",
                        "message" => $status
                    );
                }
            }
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }        
            return $result;
        }
        public function getCommentAccountPlanning($accountPlanningId){
            $sql = "SELECT t3.Name AS ApproverName, t1.Comment, t2.Name AS DocumentStatusName, t1.CreatedDate
                    FROM AccountPlanningStatusMenengah t1
                    LEFT JOIN DocumentStatusMenengah t2 ON t1.DocumentStatusId = t2.DocumentStatusMenengahId
                    LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                    WHERE t1.Comment IS NOT NULL AND t1.AccountPlanningMenengahId = ".$accountPlanningId."
                    ORDER BY AccountPlanningStatusMenengahId DESC";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
    }
?>