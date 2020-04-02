<?php

class ManageAccountPlanning_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    /* Company Information */
    public function getTotalAccountPlanning($userId, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatusMenengah G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusMenengahId = (
                SELECT MAX(AccountPlanningStatusMenengahId) FROM AccountPlanningStatusMenengah
                WHERE AccountPlanningMenengahId = A.AccountPlanningMenengahId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND D.CustomerName LIKE '%".$searchTxt."%'";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningMenengahId, A.CreatedDate, A.[Year],
                D.CIF, D.CustomerName, E.Name RMName
            FROM AccountPlanningMenengah A, AccountPlanningOwnerMenengah B,
                 CustomerMenengah D, [User] E ".$tblFilter."
            WHERE A.AccountPlanningMenengahId=B.AccountPlanningMenengahId
                AND A.CIF = D.CIF 
                AND E.UserId = B.UserId
                AND B.IsActive=1 ".$filter."
            ) Tbl
        ";
        $result = $this->db->query($sql)->row_array();
        return $result['Total'];
    }
    public function getAccountPlanning($userId, $rowperpage, $rowno, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatusMenengah G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusMenengahId = (
                SELECT MAX(AccountPlanningStatusMenengahId) FROM AccountPlanningStatusMenengah
                WHERE AccountPlanningMenengahId = A.AccountPlanningMenengahId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND D.CustomerName LIKE '%".$searchTxt."%'";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "SELECT A.AccountPlanningMenengahId, A.CreatedDate, A.[Year],
                D.CIF, D.CustomerName, E.Name RMName
            FROM AccountPlanningMenengah A, AccountPlanningOwnerMenengah B,
                 CustomerMenengah D, [User] E ".$tblFilter."
            WHERE A.AccountPlanningMenengahId=B.AccountPlanningMenengahId
                AND A.CIF = D.CIF 
                AND E.UserId = B.UserId
                AND B.IsActive=1 ".$filter."
                ORDER BY D.CustomerName OFFSET ".$rowno." ROWS FETCH NEXT ".$rowperpage." ROWS ONLY
        ";

        $result = $this->db->query($sql);
        return $result->result_array();
    }
    public function getAccountPlanningInformation($userId = "", $apMenengahId){
        $sql = "SELECT  A.AccountPlanningMenengahId, A.CreatedDate, A.[Year],
                        D.CIF, D.CustomerName, E.Name AS RMName, F.Name AS UnitKerjaName
                FROM    AccountPlanningMenengah A,
                        AccountPlanningOwnerMenengah B,
                        CustomerMenengah D, 
                        [User] E,
                        UnitKerja F
                WHERE   A.AccountPlanningMenengahId=B.AccountPlanningMenengahId AND
                        A.CIF = D.CIF AND 
                        E.UserId = B.UserId AND
                        F.UnitKerjaId = E.UnitKerjaId AND
                        A.AccountPlanningMenengahId = '".$apMenengahId."' AND
                        B.IsActive=1";
        if(!empty($userId)) {
            $sql .= " AND B.UserId='".$userId."'  ";
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0];
    }
    public function getAccountPlanningDebiturOverview($apMenengahId, $CIF = NULL) {
        $whereClause = "";
        if($CIF != NULL){
            $whereClause .= " AND a.CIF = '".$CIF."'";
        }
        $sql = 'SELECT "a".DebiturOverviewId, "a"."Address", "a"."IndustryName",
                    "b"."Name" AS "Province",
                    "e"."Name" AS "LifeCycle",
                    "f"."CustomerName" AS "CompanyName",
                    "g"."Name" AS "IndustryTrend"
                FROM "DebiturOverview" "a"
                LEFT JOIN "Province" "b" on "a"."ProvinceId"="b"."ProvinceId" AND "b"."IsActive"=1
                LEFT JOIN "LifeCycle" "e" on "a"."LifeCycleId"="e"."LifeCycleId" AND "e"."IsActive"=1
                LEFT JOIN "CustomerMenengah" "f" on "a"."CIF"="f"."CIF" 
                LEFT JOIN "IndustryTrend" "g" on "a"."IndustryTrendId"="g"."IndustryTrendId" AND "g"."IsActive"=1
                WHERE "a"."AccountPlanningMenengahId" ='. $apMenengahId .$whereClause;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        
    }
    public function getTotalShareholder($apMenengahId, $CIF = NULL) {
        $whereClause = "";
        if($CIF != NULL){
            $whereClause .= " AND t2.CIF = '".$CIF."'";
        }
        $sql = "SELECT SUM(t1.Quantity) as TotalShareholders
                FROM ShareholderMenengah t1
                LEFT JOIN AccountPlanningMenengah t2 ON t1.AccountPlanningMenengahId = t2.AccountPlanningMenengahId
                WHERE t1.AccountPlanningMenengahId =".$apMenengahId .$whereClause;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->TotalShareholders;
    }
    public function getAccountPlanningShareholder($apMenengahId, $CIF = NULL) {
        $whereClause = "";
        if($CIF != NULL){
            $whereClause .= " AND t2.CIF = '".$CIF."'";
        }
        $sql = "SELECT t1.Name, t1.Quantity as Value, t1.Rate, t1.Nominal
                FROM ShareholderMenengah t1
                LEFT JOIN AccountPlanningMenengah t2 ON t1.AccountPlanningMenengahId = t2.AccountPlanningMenengahId
                WHERE t1.AccountPlanningMenengahId =".$apMenengahId .$whereClause;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getAccountPlanningFileStructure($apMenengahId, $CIF = NULL, $StructureTypeId){
        $whereClause = "";
        if($StructureTypeId == 1 || $StructureTypeId == 3){
            $whereClause .= " AND t1.CIF IS NOT NULL ";
        }
        if($CIF != NULL){
            $whereClause .= " AND t1.CIF = '".$CIF."'";
        }
        $sql = "SELECT t1.FilePath, t1.CIF, t2.CustomerName
                FROM FileStructureMenengah t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIF = t2.CIF
                WHERE t1.AccountPlanningMenengahId = ".$apMenengahId." AND t1.StructureTypeId = ".$StructureTypeId. $whereClause;
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function getAccountPlanningStrategicPlan($apMenengahId, $CIF = NULL, $StrategicPlanTypeId = NULL) {
        $whereClause = '';
        if($CIF != NULL){
            $whereClause .= " AND t1.CIF = '".$CIF."'";
        }
        if($StrategicPlanTypeId != NULL){
            $whereClause .= " AND StrategicPlanTypeId =". $StrategicPlanTypeId;
        }
        $sql = "SELECT t1.StrategicPlanTypeId, t2.Name AS StrategicPlanTypeName, t1.Name
                FROM StrategicPlanMenengah t1
                LEFT JOIN StrategicPlanType t2 ON t1.StrategicPlanTypeId = t2.StrategicPlanTypeId
                WHERE t1.AccountPlanningMenengahId = ".$apMenengahId ."
                AND t1.CIF = '".$CIF."' ".$whereClause." ORDER BY t1.StrategicPlanTypeId";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function getAccountPlanningCoverageMapping($apMenengahId, $CIF = NULL) {
        $whereClause = '';
        if($CIF != NULL){
            $whereClause .= " AND t1.CIF = '".$CIF."'";
        }
        $sql = "SELECT ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description
                FROM CoverageMappingMenengah
                WHERE AccountPlanningMenengahId = ".$apMenengahId." AND CIF = '".$CIF."'";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function updateDebiturOverview($data){
        $this->db->trans_begin();

        switch($data["type"]){
            case "insert":
                $row = array(
                    "AccountPlanningMenengahId" => $data["accountPlanningMenengahId"],
                    "CIF" => $data["CIF"],
                    "Address" => $data["address"],
                    "ProvinceId" => $data["provinceId"],
                    "IndustryName" => $data["industryName"],
                    "IndustryTrendId" => $data["industryTrendId"],
                    "LifeCycleId" => $data["lifeCycleId"],
                    "CreatedDate" => $this->current_datetime,
                    "CreatedBy" => $data["userId"]
                );
                $this->db->insert("DebiturOverview", $row);
                break;
            case "update":
                $where = array(
                    "AccountPlanningMenengahId" => $data["accountPlanningMenengahId"],
                    "CIF" => $data["CIF"]
                );
                $row = array(
                    "Address" => $data["address"],
                    "ProvinceId" => $data["provinceId"],
                    "IndustryName" => $data["industryName"],
                    "IndustryTrendId" => $data["industryTrendId"],
                    "LifeCycleId" => $data["lifeCycleId"],
                    "ModifiedDate" => $this->current_datetime,
                    "ModifiedBy" => $data["userId"]
                );
                $this->db->update('DebiturOverview', $row, $where);
                break;
            default:
                break;
        }
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Debitur Overview"
            );
        } else {
            $result = array(
                "status" => "success"
            );
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
        return $result;
    }
    public function updateKeyShareholders($data){
        $this->db->trans_begin();

        $this->db->delete('ShareholderMenengah', array('AccountPlanningMenengahId' => $data["accountPlanningMenengahId"]));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Key Shareholders"
            );
        }else{
            if($data['jumlahShareholders'] > 0){
                $arrShareholders = array();
                foreach($data['arrShareholders'] as $rows){
                    $dataPost = array(
                                'AccountPlanningMenengahId' => $data['accountPlanningMenengahId'],
                                'Name' => $rows['name'],
                                'Rate' => $rows['rate'],
                                'Quantity' => $rows['quantity'],
                                'Nominal' => $rows['nominal'],
                                'CreatedBy' => $data['userId'],
                                'CreatedDate' => $this->current_datetime
                            );
                    array_push($arrShareholders, $dataPost);
                }
                $this->db->insert_batch('ShareholderMenengah', $arrShareholders);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Key Shareholders"
                    );
                }else{
                    $result = array(
                        "status" => "success"
                    );
                }                
            }
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
        return $result;
    }
    public function updateBusinessProcessOrganization($data){
        $this->db->trans_begin();

        switch($data['structureTypeId']){
            case 1:
                $arrayWhere = array('AccountPlanningMenengahId' => $data["accountPlanningMenengahId"], 
                                    'StructureTypeId' => $data['structureTypeId'],
                                    'CIF' => $data['CIF']);
                break;
            case 3:
                $arrayWhere = array('AccountPlanningMenengahId' => $data["accountPlanningMenengahId"], 
                                    'StructureTypeId' => $data['structureTypeId'],
                                    'CIF' => $data['CIF']);
                break;
        }

        $this->db->delete('FileStructureMenengah', $arrayWhere);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete File Structure"
            );
        }else{
            $dataPost = array(
                'StructureTypeId' => $data['structureTypeId'],
                'AccountPlanningMenengahId' => $data['accountPlanningMenengahId'],
                'CIF' => $data['CIF'],
                'FilePath' => $data['filePath'],
                'Size' => $data['size'],
                'Type' => $data['type'],
                'CreatedBy' => $data['userId'],
                'CreatedDate' => $this->current_datetime
            );
            $this->db->insert('FileStructureMenengah', $dataPost);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Insert File Structure"
                );
            }else{
                $result = array(
                    "status" => "success",
                    "message" => ""
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
    public function updateStrategicPlan($data){
        $this->db->trans_begin();

        $this->db->delete('StrategicPlanMenengah', array('AccountPlanningMenengahId' => $data["accountPlanningMenengahId"], 'CIF' => $data['cif']));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Strategic Plan"
            );
        }else{
            if($data['jumlahStrategicPlan'] > 0){
                $arrStrategicPlan = array();
                foreach($data['arrStrategicPlan'] as $rows){
                    $dataPost = array(
                                'CIF' => $data['cif'],
                                'AccountPlanningMenengahId' => $data['accountPlanningMenengahId'],
                                'StrategicPlanTypeId' => $rows['StrategicPlanTypeId'],
                                'Name' => $rows['Name'],
                                'CreatedBy' => $data['createdBy'],
                                'CreatedDate' => $this->current_datetime
                            );
                    array_push($arrStrategicPlan, $dataPost);
                }
                $this->db->insert_batch('StrategicPlanMenengah', $arrStrategicPlan);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Strategic Plan"
                    );
                }else{
                    $result = array(
                        "status" => "success",
                        "message" => ""
                    );
                }
            }           
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
        return $result;
    }
    public function updateCoverageMapping($data){
        $this->db->trans_begin();

        $this->db->delete('CoverageMappingMenengah', array('AccountPlanningMenengahId' => $data["accountPlanningMenengahId"], 'CIF' => $data['cif']));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Coverage Mapping"
            );
        }else{
            if($data['jumlahCoverageMapping'] > 0){
                $arrCoverageMapping = array();
                foreach($data['arrCoverageMapping'] as $rows){
                    $dataPost = array(
                                'AccountPlanningMenengahId' => $data['accountPlanningMenengahId'],
                                'CIF' => $data['cif'],
                                'ClientName' => $rows['ClientName'],
                                'ContactNumber' => $rows['ContactNumber'],
                                'ClientPosition' => $rows['ClientPosition'],
                                'BankPerson' => $rows['BankPerson'],
                                'BankContact' => $rows['BankContact'],
                                'BankPosition' => $rows['BankPosition'],
                                'OtherInformation' => $rows['OtherInformation'],
                                'CreatedBy' => $data['createdBy'],
                                'CreatedDate' => $this->current_datetime
                            );
                    array_push($arrCoverageMapping, $dataPost);
                }
    
                $this->db->insert_batch('CoverageMappingMenengah', $arrCoverageMapping);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Coverage Mapping"
                    );
                }else{
                    $result = array(
                        "status" => "success",
                        "message" => ""
                    );
                }
            }
        }        

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
        return $result;
    }

    /* BRI Starting Position */
    public function getFinancialHighlightGroup($financialHighlightGroupId = NULL){
        $sql = "SELECT FinancialHighlightGroupMenengahId, Name
                FROM FinancialHighlightGroupMenengah WHERE IsActive = 1";
        if($financialHighlightGroupId != NULL){
            $sql .= " AND FinancialHighlightGroupMenengahId = ".$financialHighlightGroupId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFinancialHighlightItem($financialHighlightGroupId = NULL) {
        $sql = "SELECT FinancialHighlightItemMenengahId, Name
                FROM FinancialHighlightItemMenengah
                WHERE IsActive = 1";
        if($financialHighlightGroupId != NULL){
            $sql .= " AND FinancialHighlightGroupMenengahId = ".$financialHighlightGroupId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFinancialHighlight($apMenengahId, $financialHighlightItemMenengahId, $year){
        $sql = "SELECT FinancialHighlightMenengahId, FinancialHighlightItemMenengahId, 
                CASE WHEN Amount IS NULL THEN 0 ELSE Amount END AS Amount  
                FROM FinancialHighlightMenengah
                WHERE AccountPlanningMenengahId = ".$apMenengahId."
                AND FinancialHighlightItemMenengahId = ".$financialHighlightItemMenengahId."
                AND Year = '".$year."'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFinancialHighlightByGroup($apMenengahId, $financialHighlightGroupMenengahId, $year){
        $sql = "SELECT  t1.FinancialHighlightMenengahId, t1.FinancialHighlightItemMenengahId, t1.AccountPlanningMenengahId, t1.Year, t1.Amount,
                        t2.FinancialHighlightGroupMenengahId, t2.Name
                FROM FinancialHighlightMenengah t1 
                LEFT JOIN FinancialHighlightItemMenengah t2 ON t1.FinancialHighlightItemMenengahId = t2.FinancialHighlightItemMenengahId 
                LEFT JOIN FinancialHighlightGroupMenengah t3 ON t2.FinancialHighlightGroupMenengahId = t3.FinancialHighlightGroupMenengahId
                WHERE t2.FinancialHighlightGroupMenengahId = ".$financialHighlightGroupMenengahId."
                AND t1.AccountPlanningMenengahId = ".$apMenengahId."
                AND t1.Year = '".$year."'
                AND t2.IsActive = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateFinancialHighlight($data){
        $this->db->trans_begin();
        //echo json_encode($data); die;

        foreach($data['arrFinancialHighlight'] as $rows){
            $sqlSelect = "SELECT * 
                            FROM FinancialHighlightMenengah
                            WHERE AccountPlanningMenengahId = ".$rows["accountPlanningMenengahId"]."
                            AND FinancialHighlightItemMenengahId = ".$rows["financialHighlightItemMenengahId"]."
                            AND Year = '".$rows["year"]."'";
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();

            if(!empty($resultSelect)){
                $where = array(
                    "FinancialHighlightItemMenengahId" => $rows["financialHighlightItemMenengahId"],
                    "AccountPlanningMenengahId" => $rows["accountPlanningMenengahId"],
                    "Year" => $rows["year"]
                );
                $dataFinancialHighlight = array(
                    "Amount" => $rows["amount"],
                    "ModifiedDate" => $this->current_datetime,
                    "ModifiedBy" => $data["userId"]
                );
                $this->db->update('FinancialHighlightMenengah', $dataFinancialHighlight, $where);
                $event = "Update";
            }else{
                $dataFinancialHighlight = array(
                    "FinancialHighlightItemMenengahId" => $rows["financialHighlightItemMenengahId"],
                    "AccountPlanningMenengahId" => $rows["accountPlanningMenengahId"],
                    "Year" => $rows["year"],
                    "Amount" => $rows["amount"],
                    "CreatedDate" => $this->current_datetime,
                    "CreatedBy" => $data["userId"]
                );
                $this->db->insert("FinancialHighlightMenengah", $dataFinancialHighlight);
                $event = "Insert";
            }
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $message = $errorStatus["message"];
                break;
            }
        }
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => $event
            );
        }else{
            $this->db->trans_commit();            
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }
    public function getFacilitiesBankingGroup($bankFacilityGroupId = NULL){
        $sql = "SELECT BankFacilityGroupMenengahId, Name
                FROM BankFacilityGroupMenengah WHERE IsActive = 1";
        if($bankFacilityGroupId != NULL){
            $sql .= " AND BankFacilityGroupMenengahId = ".$bankFacilityGroupId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFacilitiesBankingItem($bankFacilityGroupId = NULL){
        $sql = "SELECT BankFacilityItemMenengahId, Name
                FROM BankFacilityItemMenengah";
        if($bankFacilityGroupId != NULL){
            $sql .= " WHERE BankFacilityGroupMenengahId = ".$bankFacilityGroupId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFacilitiesBankingItemAddition($bankFacilityGroupId = NULL, $accountPlanningId = NULL){
        $sql = "SELECT BankFacilityItemAdditionMenengahId, Name
                FROM BankFacilityItemAdditionMenengah
                WHERE IsActive = 1";
        if($bankFacilityGroupId != NULL){
            $sql .= " AND BankFacilityGroupMenengahId = ".$bankFacilityGroupId;
        }
        if($accountPlanningId != NULL){
            $sql .= " AND AccountPlanningMenengahId = ".$accountPlanningId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFacilitiesBanking($accountPlanningId, $bankFacilityItemId = NULL){
        $sql = "SELECT BankFacilityMenengahId, IDRAmount, IDRRate, ValasAmount, ValasRate
                FROM BankFacilityMenengah 
                WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemId != NULL){
            $sql .= " AND BankFacilityItemMenengahId = ".$bankFacilityItemId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getFacilitiesBankingAddition($accountPlanningId, $bankFacilityItemAdditionId = NULL){
        $sql = "SELECT BankFacilityAdditionMenengahId, IDRAmount, IDRRate, ValasAmount, ValasRate
                FROM BankFacilityAdditionMenengah 
                WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemAdditionId != NULL){
            $sql .= " AND BankFacilityItemAdditionMenengahId = ".$bankFacilityItemAdditionId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateFacilitiesBanking($data){
        $this->db->trans_begin();
        //echo json_encode($data);die;
        
        foreach($data["arrFacilitiesBankingItem"] as $row){
            $sqlSelect = "SELECT * 
                            FROM BankFacilityMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemMenengahId = ".$row["BankFacilityItemMenengahId"];
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();
            if(!empty($resultSelect)){
                $where = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataFacilitiesBanking = array(
                    "IDRAmount" => $row["IDRAmount"],
                    "IDRRate" => $row["IDRRate"],
                    "ValasAmount" => $row["ValasAmount"],
                    "ValasRate" => $row["ValasRate"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('BankFacilityMenengah', $dataFacilitiesBanking, $where);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Bank Facility"
                    );
                }
            }else{
                $dataFacilitiesBanking = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "IDRAmount" => $row["IDRAmount"],
                    "IDRRate" => $row["IDRRate"],
                    "ValasAmount" => $row["ValasAmount"],
                    "ValasRate" => $row["ValasRate"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("BankFacilityMenengah", $dataFacilitiesBanking);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Bank Facility"
                    );
                }
            }

            $sqlSelect = "SELECT * FROM WalletShareMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemMenengahId = ".$row["BankFacilityItemMenengahId"];
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();
            if(!empty($resultSelect)){
                $where = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataWalletShare = array(
                    "TotalAmount" => $row["TotalAmount"],
                    "OtherNominal" => $row["OtherNominal"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('WalletShareMenengah', $dataWalletShare, $where);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Total Account For Wallet Share"
                    );
                }
            }else{
                $dataWalletShare = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "TotalAmount" => $row["TotalAmount"],
                    "OtherNominal" => $row["OtherNominal"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("WalletShareMenengah", $dataWalletShare);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Total Account For Wallet Share"
                    );
                }
            }
        }

        $sqlUpdate = "UPDATE BankFacilityItemAdditionMenengah SET IsActive = 0
                    WHERE AccountPlanningMenengahId = ".$data["AccountPlanningMenengahId"]."
                    AND BankFacilityGroupMenengahId = ".$data["BankFacilityGroupMenengahId"];
        $queryUpdate = $this->db->query($sqlUpdate);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Bank Facility Addition to Inactive"
            );
        }
        if(!empty($data["arrUpdateFacilitiesBankingItemAddition"])){
            foreach($data["arrUpdateFacilitiesBankingItemAddition"] as $row){
                $whereBankFacilityItemAddition = array(
                    "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataBankFacilityItemAddition = array(
                    "Name" => $row["Name"],
                    "IsActive" => $row["IsActive"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('BankFacilityItemAdditionMenengah', $dataBankFacilityItemAddition, $whereBankFacilityItemAddition);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Bank Facility Item Addition"
                    );
                }else{
                    $sqlSelect = "SELECT * 
                                    FROM BankFacilityAdditionMenengah
                                    WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                                    AND BankFacilityItemAdditionMenengahId = ".$row["BankFacilityItemAdditionMenengahId"];
                    $querySelect = $this->db->query($sqlSelect);
                    $resultSelect = $querySelect->result();
                    if(!empty($resultSelect)){
                        $where = array(
                            "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                            "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                        );
                        $dataFacilitiesBanking = array(
                            "IDRAmount" => $row["IDRAmount"],
                            "IDRRate" => $row["IDRRate"],
                            "ValasAmount" => $row["ValasAmount"],
                            "ValasRate" => $row["ValasRate"],
                            "ModifiedDate" => $row["CurrentDate"],
                            "ModifiedBy" => $row["UserId"]
                        );
                        $this->db->update('BankFacilityAdditionMenengah', $dataFacilitiesBanking, $where);
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Update Bank Facility Addition"
                        );

                        $sqlSelect = "SELECT * FROM WalletShareAdditionMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemAdditionMenengahId = ".$row["BankFacilityItemAdditionMenengahId"];
                        $querySelect = $this->db->query($sqlSelect);
                        $resultSelect = $querySelect->result();
                        if(!empty($resultSelect)){
                            $where = array(
                                "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                                "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                            );
                            $dataWalletShare = array(
                                "TotalAmount" => $row["TotalAmount"],
                                "OtherNominal" => $row["OtherNominal"],
                                "ModifiedDate" => $row["CurrentDate"],
                                "ModifiedBy" => $row["UserId"]
                            );
                            $this->db->update('WalletShareAdditionMenengah', $dataWalletShare, $where);
                            $errorStatus = $this->db->error();
                            if($errorStatus["code"]<>0){
                                $result = array(
                                    "status" => "error",
                                    "message" => $errorStatus["message"],
                                    "event" => "Update Total Account For Wallet Share Addition"
                                );
                            }
                        }else{
                            $dataWalletShare = array(
                                "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                                "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                                "TotalAmount" => $row["TotalAmount"],
                                "OtherNominal" => $row["OtherNominal"],
                                "CreatedDate" => $row["CurrentDate"],
                                "CreatedBy" => $row["UserId"]
                            );
                            $this->db->insert("WalletShareAdditionMenengah", $dataWalletShare);
                            $errorStatus = $this->db->error();
                            if($errorStatus["code"]<>0){
                                $result = array(
                                    "status" => "error",
                                    "message" => $errorStatus["message"],
                                    "event" => "Insert Total Account For Wallet Share Addition"
                                );
                            }
                        }
                    }
                }
            }
        }

        if(!empty($data["arrNewFacilitiesBankingItemAddition"])){
            foreach($data["arrNewFacilitiesBankingItemAddition"] as $row){
                $newBankFacilitiesItemAddition = array(
                    "BankFacilityGroupMenengahId" => $row["BankFacilityGroupMenengahId"],
                    "Name" => $row["Name"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "IsActive" => $row["IsActive"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("BankFacilityItemAdditionMenengah", $newBankFacilitiesItemAddition);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Bank Facility Item Addition"
                    );
                }else{
                    $lastId = $this->db->insert_id();
                    $newBankFacilityAddition = array(
                        "BankFacilityItemAdditionMenengahId" => $lastId,
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                        "IDRAmount" => $row["IDRAmount"],
                        "IDRRate" => $row["IDRRate"],
                        "ValasAmount" => $row["ValasAmount"],
                        "ValasRate" => $row["ValasRate"],
                        "CreatedDate" => $row["CurrentDate"],
                        "CreatedBy" => $row["UserId"]
                    );
                    $this->db->insert("BankFacilityAdditionMenengah", $newBankFacilityAddition);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Bank Facility Addition"
                        );
                    }

                    $dataWalletShare = array(
                        "BankFacilityItemAdditionMenengahId" => $lastId,
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                        "TotalAmount" => $row["TotalAmount"],
                        "OtherNominal" => $row["OtherNominal"],
                        "CreatedDate" => $row["CurrentDate"],
                        "CreatedBy" => $row["UserId"]
                    );
                    $this->db->insert("WalletShareAdditionMenengah", $dataWalletShare);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Total Account For Wallet Share Addition"
                        );
                    }
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
    public function getWalletShare($accountPlanningId, $bankFacilityItemId = NULL){
        $sql = "SELECT
                    AccountPlanningMenengahId, 
                    CASE WHEN TotalAmount IS NULL THEN 0 ELSE TotalAmount END AS TotalAmount, 
                    CASE WHEN OtherNominal IS NULL THEN 0 ELSE OtherNominal END AS OtherNominal
                FROM WalletShareMenengah 
                WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemId != NULL){
            $sql .= " AND BankFacilityItemMenengahId = ".$bankFacilityItemId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getWalletShareAddition($accountPlanningId, $bankFacilityItemAdditionId = NULL){
        $sql = "SELECT
                    AccountPlanningMenengahId, 
                    CASE WHEN TotalAmount IS NULL THEN 0 ELSE TotalAmount END AS TotalAmount, 
                    CASE WHEN OtherNominal IS NULL THEN 0 ELSE OtherNominal END AS OtherNominal
                FROM WalletShareAdditionMenengah 
                WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemAdditionId != NULL){
            $sql .= " AND BankFacilityItemAdditionMenengahId = ".$bankFacilityItemAdditionId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateWalletShare($data){
        $this->db->trans_begin();

        foreach($data["arrFacilitiesBankingItem"] as $row){
            $sqlSelect = "SELECT * 
                            FROM WalletShareMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemMenengahId = ".$row["BankFacilityItemMenengahId"];
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();
            if(!empty($resultSelect)){
                $where = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataWalletShare = array(
                    "OtherNominal" => $row["OtherNominal"],
                    "TotalAmount" => $row["TotalAmount"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('WalletShareMenengah', $dataWalletShare, $where);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Wallet Share"
                    );
                }
            }else{
                $dataWalletShare = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "OtherNominal" => $row["OtherNominal"],
                    "TotalAmount" => $row["TotalAmount"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("WalletShareMenengah", $dataWalletShare);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Inser Wallet Share"
                    );
                }
            }
        }

        if(!empty($data["arrFacilitiesBankingItemAddition"])){
            foreach($data["arrFacilitiesBankingItemAddition"] as $row){
                $sqlSelect = "SELECT * 
                                FROM WalletShareAdditionMenengah
                                WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                                AND BankFacilityItemAdditionMenengahId = ".$row["BankFacilityItemAdditionMenengahId"];
                $querySelect = $this->db->query($sqlSelect);
                $resultSelect = $querySelect->result();
                if(!empty($resultSelect)){
                    $where = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                    );
                    $dataWalletShare = array(
                        "OtherNominal" => $row["OtherNominal"],
                        "TotalAmount" => $row["TotalAmount"],
                        "ModifiedDate" => $row["CurrentDate"],
                        "ModifiedBy" => $row["UserId"]
                    );
                    $this->db->update('WalletShareAdditionMenengah', $dataWalletShare, $where);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Update Wallet Share Addition"
                        );
                    }
                }else{
                    $dataWalletShare = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                        "OtherNominal" => $row["OtherNominal"],
                        "TotalAmount" => $row["TotalAmount"],
                        "CreatedDate" => $row["CurrentDate"],
                        "CreatedBy" => $row["UserId"]
                    );
                    $this->db->insert("WalletShareAdditionMenengah", $dataWalletShare);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Wallet Share Addition"
                        );
                    }
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
    public function getCompetitionAnalysis($accountPlanningId, $bankFacilityItemId = NULL){
        $sql = "SELECT
                    t2.BankFacilityItemMenengahId, t2.AccountPlanningMenengahId,
                    t2.BankId1, CASE WHEN t3.Name IS NULL THEN '' ELSE t3.Name END AS BankName1, 
                    t2.BankId2, CASE WHEN t4.Name IS NULL THEN '' ELSE t4.Name END AS BankName2,
                    t2.BankId3, CASE WHEN t5.Name IS NULL THEN '' ELSE t5.Name END AS BankName3
                FROM CompetitionAnalysisMenengah t2 
                LEFT JOIN Bank t3 ON t2.BankId1 = t3.BankId
                LEFT JOIN Bank t4 ON t2.BankId2 = t4.BankId
                LEFT JOIN Bank t5 ON t2.BankId3 = t5.BankId
                WHERE t2.AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemId != NULL){
            $sql .= " AND t2.BankFacilityItemMenengahId = ".$bankFacilityItemId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getCompetitionAnalysisAddition($accountPlanningId, $bankFacilityItemAdditionId = NULL){
        $sql = "SELECT
                    t2.BankFacilityItemAdditionMenengahId, t2.AccountPlanningMenengahId,
                    t2.BankId1, CASE WHEN t3.Name IS NULL THEN '' ELSE t3.Name END AS BankName1, 
                    t2.BankId2, CASE WHEN t4.Name IS NULL THEN '' ELSE t4.Name END AS BankName2,
                    t2.BankId3, CASE WHEN t5.Name IS NULL THEN '' ELSE t5.Name END AS BankName3
                FROM CompetitionAnalysisAdditionMenengah t2 
                LEFT JOIN Bank t3 ON t2.BankId1 = t3.BankId
                LEFT JOIN Bank t4 ON t2.BankId2 = t4.BankId
                LEFT JOIN Bank t5 ON t2.BankId3 = t5.BankId
                WHERE t2.AccountPlanningMenengahId = ".$accountPlanningId;
        if($bankFacilityItemAdditionId != NULL){
            $sql .= " AND t2.BankFacilityItemAdditionMenengahId = ".$bankFacilityItemAdditionId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateCompetitionAnalysis($data){
        $isCommit = 1;
        $this->db->trans_begin();

        foreach($data["arrFacilitiesBankingItem"] as $row){
            $sqlSelect = "SELECT * 
                            FROM CompetitionAnalysisMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemMenengahId = ".$row["BankFacilityItemMenengahId"];
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();
            if(!empty($resultSelect)){
                $where = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataWalletShare = array(
                    "BankId1" => $row["BankId1"],
                    "BankId2" => $row["BankId2"],
                    "BankId3" => $row["BankId3"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('CompetitionAnalysisMenengah', $dataWalletShare, $where);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Competition Analysis"
                    );
                }
            }else{
                $dataWalletShare = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "BankId1" => $row["BankId1"],
                    "BankId2" => $row["BankId2"],
                    "BankId3" => $row["BankId3"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("CompetitionAnalysisMenengah", $dataWalletShare);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Competition Analysis"
                    );
                }
            }
        }

        if(!empty($data["arrFacilitiesBankingItemAddition"])){
            foreach($data["arrFacilitiesBankingItemAddition"] as $row){
                $sqlSelect = "SELECT * 
                                FROM CompetitionAnalysisAdditionMenengah
                                WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                                AND BankFacilityItemAdditionMenengahId = ".$row["BankFacilityItemAdditionMenengahId"];
                $querySelect = $this->db->query($sqlSelect);
                $resultSelect = $querySelect->result();
                if(!empty($resultSelect)){
                    $where = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                    );
                    $dataFacilitiesBanking = array(
                        "BankId1" => $row["BankId1"],
                        "BankId2" => $row["BankId2"],
                        "BankId3" => $row["BankId3"],
                        "ModifiedDate" => $row["CurrentDate"],
                        "ModifiedBy" => $row["UserId"]
                    );
                    $this->db->update('CompetitionAnalysisAdditionMenengah', $dataFacilitiesBanking, $where);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Update Competition Analysis Addition"
                        );
                    }
                }else{
                    $dataFacilitiesBanking = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                        "BankId1" => $row["BankId1"],
                        "BankId2" => $row["BankId2"],
                        "BankId3" => $row["BankId3"],
                        "CreatedDate" => $row["CurrentDate"],
                        "CreatedBy" => $row["UserId"]
                    );
                    $this->db->insert("CompetitionAnalysisAdditionMenengah", $dataFacilitiesBanking);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Competition Analysis Addition"
                        );
                    }
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

    /* Client Needs */
    public function getFundings($apMenengahId){
        $sql = "SELECT FundingMenengahId, FundingNeed, TimePeriod, Amount, [Description]
                FROM FundingMenengah
                WHERE AccountPlanningMenengahId = ".$apMenengahId;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateFundings($data){
        $this->db->trans_begin();

        $this->db->delete("FundingMenengah", array("AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"]));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Fundings"
            );
        }else{
            if(!empty($data["ArrFundings"])){
                $arrFundings = array();
                foreach($data["ArrFundings"] as $row){
                    $funding = array(
                                "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                                "FundingNeed" => $row["FundingNeed"],
                                "TimePeriod" => $row["TimePeriod"],
                                "Amount" => $row["Amount"],
                                "Description" => $row["Description"],
                                "CreatedBy" => $row["UserId"],
                                "CreatedDate" => $row["CurrentDate"]
                            );
                    array_push($arrFundings, $funding);
                }

                $this->db->insert_batch("FundingMenengah", $arrFundings);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Fundings"
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
    public function getServices($apMenengahId){
        $sql = "SELECT ServiceMenengahId, Name, Target, Description
                FROM ServiceMenengah
                WHERE AccountPlanningMenengahId = ".$apMenengahId;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getUnitKerjaTag($ServiceMenengahId){
        $sql = "SELECT t1.UnitKerjaId, t2.Name
                FROM TagServiceUnitKerjaMenengah t1
                LEFT JOIN UnitKerja t2 ON t1.UnitKerjaId = t2.UnitKerjaId
                WHERE t1.ServiceMenengahId = ".$ServiceMenengahId;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateServices($data){
        $this->db->trans_begin();

        $this->db->delete("ServiceMenengah", array("AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"]));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Services"
            );
        }else{
            if(!empty($data["ArrServices"])){
                foreach($data["ArrServices"] as $row){
                    $service = array(
                                "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                                "Name" => $row["Name"],
                                "Target" => $row["Target"],
                                "Description" => $row["Description"],
                                "CreatedBy" => $row["UserId"],
                                "CreatedDate" => $row["CurrentDate"]
                            );
                    $this->db->insert("ServiceMenengah", $service);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Services"
                        );
                    }else{
                        $lastId = $this->db->insert_id();
                        if(!empty($row["Type"])){
                            $arrServiceTag = array();
                            foreach($row["Type"] as $rowType){
                                $serviceTag = array(
                                    "ServiceMenengahId" => $lastId,
                                    "UnitKerjaId" => $rowType,
                                    "CreatedDate" => $row["CurrentDate"],
                                    "CreatedBy" => $row["UserId"]
                                );
                                array_push($arrServiceTag, $serviceTag);
                            }
                            $this->db->insert_batch("TagServiceUnitKerjaMenengah", $arrServiceTag);
                            $errorStatus = $this->db->error();
                            if($errorStatus["code"]<>0){
                                $result = array(
                                    "status" => "error",
                                    "message" => $errorStatus["message"],
                                    "event" => "Insert Tang Service"
                                );
                            }
                        }
                    }
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

    /* Action Plans */
    public function getEstimatedFinancial($accountPlanningId, $bankFacilityItemId = NULL){
        $sql = "SELECT
                    CASE WHEN t2.IDRProjection IS NULL THEN 0 ELSE t2.IDRProjection END AS IDRProjection, 
                    CASE WHEN t2.ValasProjection IS NULL THEN 0 ELSE t2.ValasProjection END AS ValasProjection,
                    CASE WHEN t2.IDRTarget IS NULL THEN 0 ELSE t2.IDRTarget END AS IDRTarget, 
                    CASE WHEN t2.ValasTarget IS NULL THEN 0 ELSE t2.ValasTarget END AS ValasTarget
                FROM EstimatedFinancialMenengah t2
                WHERE t2.AccountPlanningMenengahId = ".$accountPlanningId;
       if($bankFacilityItemId != NULL){
            $sql .= " AND t2.BankFacilityItemMenengahId = ".$bankFacilityItemId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getEstimatedFinancialAddition($accountPlanningId, $bankFacilityItemAdditionId = NULL){
        $sql = "SELECT
                    CASE WHEN t2.IDRProjection IS NULL THEN 0 ELSE t2.IDRProjection END AS IDRProjection, 
                    CASE WHEN t2.ValasProjection IS NULL THEN 0 ELSE t2.ValasProjection END AS ValasProjection,
                    CASE WHEN t2.IDRTarget IS NULL THEN 0 ELSE t2.IDRTarget END AS IDRTarget, 
                    CASE WHEN t2.ValasTarget IS NULL THEN 0 ELSE t2.ValasTarget END AS ValasTarget
                FROM EstimatedFinancialAdditionMenengah t2
                WHERE t2.AccountPlanningMenengahId = ".$accountPlanningId;
       if($bankFacilityItemAdditionId != NULL){
            $sql .= " AND t2.BankFacilityItemAdditionMenengahId = ".$bankFacilityItemAdditionId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateEstimatedFinancial($data){
        $this->db->trans_begin();

        foreach($data["arrFacilitiesBankingItem"] as $row){
            $sqlSelect = "SELECT * 
                            FROM EstimatedFinancialMenengah
                            WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                            AND BankFacilityItemMenengahId = ".$row["BankFacilityItemMenengahId"];
            $querySelect = $this->db->query($sqlSelect);
            $resultSelect = $querySelect->result();
            if(!empty($resultSelect)){
                $where = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                );
                $dataEstimatedFinancial = array(
                    "IDRProjection" => $row["IDRProjection"],
                    "ValasProjection" => $row["ValasProjection"],
                    "IDRTarget" => $row["IDRTarget"],
                    "ValasTarget" => $row["ValasTarget"],
                    "ModifiedDate" => $row["CurrentDate"],
                    "ModifiedBy" => $row["UserId"]
                );
                $this->db->update('EstimatedFinancialMenengah', $dataEstimatedFinancial, $where);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Update Estimated Financial"
                    );
                }
            }else{
                $dataEstimatedFinancial = array(
                    "BankFacilityItemMenengahId" => $row["BankFacilityItemMenengahId"],
                    "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                    "IDRProjection" => $row["IDRProjection"],
                    "ValasProjection" => $row["ValasProjection"],
                    "IDRTarget" => $row["IDRTarget"],
                    "ValasTarget" => $row["ValasTarget"],
                    "CreatedDate" => $row["CurrentDate"],
                    "CreatedBy" => $row["UserId"]
                );
                $this->db->insert("EstimatedFinancialMenengah", $dataEstimatedFinancial);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Estimated Financial"
                    );
                }
            }
        }

        if(!empty($data["arrFacilitiesBankingItemAddition"])){
            foreach($data["arrFacilitiesBankingItemAddition"] as $row){
                $sqlSelect = "SELECT * 
                                FROM EstimatedFinancialAdditionMenengah
                                WHERE AccountPlanningMenengahId = ".$row["AccountPlanningMenengahId"]."
                                AND BankFacilityItemAdditionMenengahId = ".$row["BankFacilityItemAdditionMenengahId"];
                $querySelect = $this->db->query($sqlSelect);
                $resultSelect = $querySelect->result();
                if(!empty($resultSelect)){
                    $where = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"]
                    );
                    $dataEstimatedFinancial = array(
                        "IDRProjection" => $row["IDRProjection"],
                        "ValasProjection" => $row["ValasProjection"],
                        "IDRTarget" => $row["IDRTarget"],
                        "ValasTarget" => $row["ValasTarget"],
                        "ModifiedDate" => $row["CurrentDate"],
                        "ModifiedBy" => $row["UserId"]
                    );
                    $this->db->update('EstimatedFinancialAdditionMenengah', $dataEstimatedFinancial, $where);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Update Estimated Financial Addition"
                        );
                    }
                }else{
                    $dataEstimatedFinancial = array(
                        "BankFacilityItemAdditionMenengahId" => $row["BankFacilityItemAdditionMenengahId"],
                        "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                        "IDRProjection" => $row["IDRProjection"],
                        "ValasProjection" => $row["ValasProjection"],
                        "IDRTarget" => $row["IDRTarget"],
                        "ValasTarget" => $row["ValasTarget"],
                        "CreatedDate" => $row["CurrentDate"],
                        "CreatedBy" => $row["UserId"]
                    );
                    $this->db->insert("EstimatedFinancialAdditionMenengah", $dataEstimatedFinancial);
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Estimated Financial Addition"
                        );
                    }
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
    public function getInitiativeAction($accountPlanningId){
        $sql = "SELECT
                Name, Period, Description
            FROM InitiativeActionMenengah
            WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function updateInitiativeAction($data){
        $this->db->trans_begin();

        $this->db->delete("InitiativeActionMenengah", array("AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"]));
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Delete Initiatives Action"
            );
        }else{
            if(!empty($data["ArrInitiativesAction"])){
                foreach($data["ArrInitiativesAction"] as $row){
                    $initiativesAction = array(
                                "AccountPlanningMenengahId" => $row["AccountPlanningMenengahId"],
                                "Name" => $row["Name"],
                                "Period" => $row["Period"],
                                "Description" => $row["Description"],
                                "CreatedBy" => $row["UserId"],
                                "CreatedDate" => $row["CurrentDate"]
                            );
                    $this->db->insert("InitiativeActionMenengah", $initiativesAction);
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Insert Initiatives Action"
                        );
                    }
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

    /* Submit Approval Account Planning */
    public function submitAccountPlanning($data){
        $this->db->trans_begin();

        /* Insert Account Planning Status */
        $docStatus = array(
            "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"],
            "DocumentStatusId" => $data["DocumentStatusId"],
            "Comment" => NULL,
            "CreatedDate" => $data["CurrentDate"],
            "CreatedBy" => $data["UserId"]
        );
        $this->db->insert("AccountPlanningStatusMenengah", $docStatus);
        $errorDocStatus = $this->db->error();
        if($errorDocStatus["code"]<>0){
            $isCommit = 0;
            $result = array(
                "status" => "error",
                "message" => $errorDocStatus["message"],
                "event" => "Insert Account Planning Status"
            );
        } else {
            /* Insert Account Planning Approver */
            $approver = array(
                "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"],
                "UserId" => $data["ApproverId"],
                "IsActive" => 1,
                "IsApproved" => NULL,
                "Comment" => NULL,
                "CreatedDate" => $data["CurrentDate"],
                "CreatedBy" => $data["UserId"]
            );
            $this->db->insert("AccountPlanningApproverMenengah", $approver);
            $errorApprover = $this->db->error();
            if($errorApprover["code"]<>0){
                $isCommit = 0;
                $result = array(
                    "status" => "error",
                    "message" => $errorApprover["message"],
                    "event" => "Insert Account Planning Approver"
                );
            }else{
                $this->notification_model->addNotif($data["ApproverId"], "Account Planning Menengah", "Add Account Planning Approver", "You are added as an approver of account planning (".$data["AccountPlanningMenengahId"].")", "confirmation/approver/view/".$data["AccountPlanningMenengahId"]);
                $result = array(
                    "status" => "success"
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
    public function retrieveAccountPlanning($data){
        $this->db->trans_begin();

        $docStatus = array(
            "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"],
            "DocumentStatusId" => $data["DocumentStatusId"],
            "Comment" => NULL,
            "CreatedDate" => $data["CurrentDate"],
            "CreatedBy" => $data["UserId"]
        );
        $this->db->insert("AccountPlanningStatusMenengah", $docStatus);
        $errorDocStatus = $this->db->error();
        if($errorDocStatus["code"]<>0){
            $isCommit = 0;
            $result = array(
                "status" => "error",
                "message" => $errorDocStatus["message"],
                "event" => "Insert Account Planning Status"
            );
        }else {
            $where = array(
                "AccountPlanningMenengahId" => $data["AccountPlanningMenengahId"]
            );
            $approver = array(
                "IsActive" => 0,
                "ModifiedDate" => $data["CurrentDate"],
                "ModifiedBy" => $data["UserId"]
            );
            $this->db->update("AccountPlanningApproverMenengah", $approver, $where);
            $errorApprover = $this->db->error();
            if($errorApprover["code"]<>0){
                $isCommit = 0;
                $result = array(
                    "status" => "error",
                    "message" => $errorApprover["message"],
                    "event" => "Update Account Planning Approver"
                );
            }else{
                $result = array(
                    "status" => "success"
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

    /* Services */
    public function getCustomerInformation($CIF){
        $this->db->select('CustomerName');
        $this->db->from('CustomerMenengah');
        $this->db->where('CIF', $CIF);
        $this->db->limit(1);
        $result = $this->db->get()->result();
        return $result[0]->CustomerName;
    }
    public function getCityOption(){
        $this->db->select('ProvinceId, Name');
        $this->db->from('Province');
        $this->db->order_by('ViewOrder','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getIndustryTrendOption(){
        $this->db->select('IndustryTrendId, Name');
        $this->db->from('IndustryTrend');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getLifeCycleOption(){
        $this->db->select('LifeCycleId, Name');
        $this->db->from('LifeCycle');
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getStrategicPlanTypeOption(){
        $this->db->select('StrategicPlanTypeId, Name');
        $this->db->from('StrategicPlanType');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getBank(){
        $this->db->select("BankId, Name");
        $this->db->from("Bank");
        $this->db->where("IsActive", 1);
        $this->db->order_by("Name","asc");
        $result = $this->db->get()->result();
        return $result;
    }
    public function getUnitKerja(){
        $this->db->select('UnitKerjaId, Name');
        $this->db->from('UnitKerja');
        $this->db->where('SegmentId',1);
        $this->db->where('IsActive',1);
        $this->db->where('UnitKerjaTypeId', 1);
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getListApprover($unitKerjaId){
        $arrApprover = array(USER_ROLE_GH_MENENGAH, USER_ROLE_WP);

        $this->db->select("UserId, Name");
        $this->db->from("User");
        $this->db->where("UnitKerjaId", $unitKerjaId);
        $this->db->where_in("RoleId", $arrApprover);
        $this->db->where("IsActive", 1);
        $this->db->order_by("Name","ASC");
        $result = $this->db->get()->result();
        return $result;
    }
}
