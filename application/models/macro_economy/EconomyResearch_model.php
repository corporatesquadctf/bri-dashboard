<?php
    class EconomyResearch_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }
        public function getMacroEconomyStructure($macroEconomyId = null){
            $sql = "SELECT MacroEconomyId AS id, ParentNode AS parent, Name AS text
                    FROM MacroEconomy
                    WHERE IsActive = 1";
            if($macroEconomyId != null){
                $sql .= " AND MacroEconomyId = ".$macroEconomyId;
            }
            $sql .= " ORDER BY Name";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function getPrimaryMacroEconomyStructure($data){
            $sql = "SELECT MacroEconomyId AS id, ParentNode AS parent, Name AS text
                    FROM MacroEconomy
                    WHERE IsActive = 1 AND MacroEconomyId NOT IN (".$data.") ORDER BY Name";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function createAnalysis($data){
            $this->db->trans_begin();
            $this->db->insert("MacroEconomyAnalysis", $data);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Create Macro Economy Analysis"
                );
            }else{
                $insertId = $this->db->insert_id();
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success",
                    "id" => $insertId
                );
            }        
            return $result;
        }
        public function createMacroEconomyFile($data){
            $this->db->trans_begin();
            $this->db->insert("MacroEconomyFile", $data);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Create Macro Economy File"
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
        public function serviceRemoveFileUpload($data, $macroEconomyFileId){
            $this->db->trans_begin();
            $where = array(
                "MacroEconomyFileId" => $macroEconomyFileId
            );
            $this->db->update("MacroEconomyFile", $data, $where);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $this->db->trans_rollback();
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Remove File Upload"
                );
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success"
                );
            }
            return $result;
        }
        public function serviceDeleteAnalysis($data, $macroEconomyAnalysisId){
            $this->db->trans_begin();
            $where = array(
                "MacroEconomyAnalysisId" => $macroEconomyAnalysisId
            );
            $this->db->update("MacroEconomyAnalysis", $data, $where);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $this->db->trans_rollback();
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Remove Macro Analysis"
                );
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success"
                );
            }
            return $result;
        }
        public function serviceGetFileUpload($macroEconomyAnalysisId){
            $sql = "SELECT MacroEconomyFileId, Name
                    FROM MacroEconomyFile
                    WHERE MacroEconomyAnalysisId = ".$macroEconomyAnalysisId."
                    AND IsActive = 1
                    ORDER BY MacroEconomyFileId DESC";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceGetAnalysis($macroEconomyId = null){
            $sql = "SELECT MacroEconomyAnalysisId, MacroEconomyId, Title, StartPeriode, EndPeriode, Description, CreatedDate, CreatedBy
                    FROM MacroEconomyAnalysis
                    WHERE IsActive = 1";
            if($macroEconomyId != null){
                $sql .= " AND MacroEconomyId = ".$macroEconomyId;
            }      
            $sql .= " ORDER BY Title";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceGetMyFiles($createdBy){
            $sql = "SELECT MacroEconomyAnalysisId, MacroEconomyId, Title, StartPeriode, EndPeriode, Description, CreatedDate, CreatedBy
                    FROM MacroEconomyAnalysis
                    WHERE CreatedBy = ".$createdBy."
                    AND IsActive = 1
                    ORDER BY Title";            
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceGetPinnedAnalysis($macroEconomyId = null){
            $sql = "SELECT t1.MacroEconomyAnalysisId, t2.MacroEconomyId, t2.Title, t2.StartPeriode, t2.EndPeriode, t2.Description, t2.CreatedDate, t2.CreatedBy
                    FROM MacroEconomyAnalysisPinned t1
                    LEFT JOIN MacroEconomyAnalysis t2 ON t1.MacroEconomyAnalysisId = t2.MacroEconomyAnalysisId
                    WHERE t1.IsActive = 1 AND t1.CreatedBy = ".$this->session->PERSONAL_NUMBER;
            if($macroEconomyId != null){
                $sql .= " AND t2.MacroEconomyId = ".$macroEconomyId;
            }
            $sql .= " ORDER BY Title";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceUpdateMacroEconomyLog($data){
            $this->db->trans_begin();
            $this->db->insert("MacroEconomyLog", $data);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $this->db->trans_rollback();
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Create Macro Economy Log"
                );
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success"
                );
            }        
            return $result;
        }
        public function serviceGetDetailAnalysis($macroEconomyAnalysisId){
            $sql = "SELECT t1.MacroEconomyAnalysisId, t1.MacroEconomyId, t1.Title, t1.StartPeriode, t1.EndPeriode, t1.Description, t1.CreatedDate,
                        t1.CreatedBy, t2.Name AS CreatedByName
                    FROM MacroEconomyAnalysis t1
                    LEFT JOIN [User] t2 ON t1.CreatedBy = t2.UserId
                    WHERE t1.MacroEconomyAnalysisId = ".$macroEconomyAnalysisId;
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result[0];
        }
        public function serviceCreateSector($data){
            $this->db->trans_begin();
            $this->db->insert("MacroEconomy", $data);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Create Sector"
                );
            }else{
                $insert_id = $this->db->insert_id();
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success",
                    "id" => $insert_id
                );
            }        
            return $result;
        }
        public function serviceUpdateSector($data){
            $this->db->trans_begin();
            $where = array(
                "MacroEconomyId" => $data["MacroEconomyId"]
            );
            $newData = array(
                "Name" => $data["Name"],
                "IsActive" => $data["IsActive"],
                "ModifiedDate" => $data["ModifiedDate"],
                "ModifiedBy" => $data["ModifiedBy"]
            );
            $this->db->update("MacroEconomy", $newData, $where);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Sector"
                );
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success",
                    "id" => $data["MacroEconomyId"]
                );
            }        
            return $result;
        }
        public function serviceGetChildSector($macroEconomyId){
            $sql = "SELECT MacroEconomyId AS id
                    FROM MacroEconomy
                    WHERE ParentNode = '".$macroEconomyId."' AND IsActive = 1";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceDeleteSector($data){
            $this->db->trans_begin();
            $this->db->update_batch("MacroEconomy", $data, "MacroEconomyId");
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
        public function servicePinnAnalysis($data){
            $pin = "Unpinned";
            if($data["IsActive"] == 1) $pin = "Pinned";
                
            $this->db->trans_begin();
            $sql = "SELECT * FROM MacroEconomyAnalysisPinned
                    WHERE MacroEconomyAnalysisId = ".$data["MacroEconomyAnalysisId"]."
                    AND CreatedBy = ".$data["CreatedBy"];
            $query = $this->db->query($sql);
            $result = $query->result();
            if(!empty($result)){
                $where = array(
                    "MacroEconomyPinnedId" => $result[0]->MacroEconomyPinnedId
                );
                $dataUpdate = array(
                    "IsActive" => $data["IsActive"],
                    "ModifiedDate" => $data["CreatedDate"],
                    "ModifiedBy" => $data["CreatedBy"]
                );
                $this->db->update("MacroEconomyAnalysisPinned", $dataUpdate, $where);
                $errorStatus = $this->db->error();
            }else{
                $this->db->insert("MacroEconomyAnalysisPinned", $data);
                $errorStatus = $this->db->error();
            }
            
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => $pin." Macro Economy Analysis"
                );
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $result = array(
                    "status" => "success",
                    "message" => "Analysis Directory has been ".$pin
                );
            }        
            return $result;
        }
        public function serviceGetLatestMacroEconomyId(){
            $sql = "SELECT MacroEconomyId FROM MacroEconomyLog WHERE CreatedBy = ".$this->session->PERSONAL_NUMBER."
                    AND MacroEconomyLogId = (SELECT MAX(MacroEconomyLogId) FROM MacroEconomyLog)";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        public function serviceMoveAnalysis($data, $macroEconomyAnalysisId){
            $this->db->trans_begin();
            $where = array(
                "MacroEconomyAnalysisId" => $macroEconomyAnalysisId
            );
            $this->db->update("MacroEconomyAnalysis", $data, $where);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Move Macro Economy Analysis"
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