<?php

class AccountPlanningMenengah_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

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

    public function getTabunganAccountPlanning($AccountPlanningMenengahId, $Desc1)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $filter='';
        if($Desc1=='GIRO'){
            $filter = "AND Desc1 = 'GIRO'";
        }else if($Desc1=='DEPOSITO'){
            $filter = "AND Desc1 = 'DEPOSITO'";
        }
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(saldo),0) \'' . $d->format('m') . '\'
            FROM Summary_SimpananMonthlyCif
            WHERE Cif IN(
            SELECT CIF FROM AccountPlanningMenengah
            WHERE AccountPlanningMenengahId=' . $AccountPlanningMenengahId . '
            ) '. $filter .' AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getSimpananAccountPlanningYoYoD($AccountPlanningMenengahId)
    {
        $sql = "SELECT SaldoSekarang, SaldoTahunLalu, SaldoAkhirTahunLalu, 
                case when SaldoSekarang = 0 Then 0
                     else ((SaldoGiro/SaldoSekarang)*100) 
                END as Casa FROM 
                ( SELECT ISNULL(SUM(saldo),0) SaldoSekarang
                FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                )) ) A,

                ( SELECT ISNULL(SUM(saldo),0) SaldoTahunLalu
                FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_SimpananMonthlyCif)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananMonthlyCif 
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(saldo),0) SaldoAkhirTahunLalu
                FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_SimpananMonthlyCif 
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ))-1 ) C,
				( SELECT ISNULL(SUM(saldo),
0) SaldoGiro
                FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND Desc1 = 'GIRO' AND Periode = (SELECT Max(Periode) FROM Summary_SimpananMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . " AND Desc1 = 'GIRO'
                )) ) D";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanAccountPlanning($AccountPlanningMenengahId)
    {
        $d = new DateTime(date('Y-m-d H:i:s'));
        $d->modify('first day of last month');
        $last_month = $d->format('m');
        $d->format('Y');
        $sql = 'SELECT * FROM ';

        for ($i = $last_month; $i > $last_month - 7; $i--) {
            $sql .= '( SELECT ISNULL(SUM(bakidebet),0) \'' . $d->format('m') . '\'
            FROM Summary_PinjamanMonthlyCif
            WHERE Cif IN(
            SELECT CIF FROM AccountPlanningMenengah
            WHERE AccountPlanningMenengahId=' . $AccountPlanningMenengahId . '
            ) AND month(periode)=' . $d->format('m') . ' AND YEAR(periode) = ' . $d->format('Y') . ' ) "' . $d->format('m') . '",';
            $d->modify('first day of last month');
        }
        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanAccountPlanningYoYoD($AccountPlanningMenengahId)
    {
        $sql = "SELECT * FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetSekarang
                FROM Summary_PinjamanMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                )) ) A,

                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetTahunLalu
                FROM Summary_PinjamanMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND month(periode)=(SELECT Max(month(periode)) FROM Summary_PinjamanMonthlyCif)
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCif 
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ))-1 ) B,

                ( SELECT ISNULL(SUM(bakidebet),0) bakidebetAkhirTahunLalu
                FROM Summary_PinjamanMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ) AND month(periode)=12
                AND YEAR(periode) = (SELECT Max(YEAR(periode)) FROM Summary_PinjamanMonthlyCif
                WHERE Cif IN(
                    SELECT CIF FROM AccountPlanningMenengah
                    WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                ))-1 ) C";
        // return var_dump($sql);
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function getPinjamanAccountPlanningKIKMK($AccountPlanningMenengahId)
    {
        $sql = "SELECT KI,KMK,(KI + KMK) as total, 
        case when (KI+KMK) = 0 Then 0
            else ((KI/(KI+KMK))*100) 
        END as KIPersen, 
        case when (KI+KMK) = 0 Then 0
            else ((KMK/(KI+KMK))*100) 
        END as KMKPersen FROM 
                ( SELECT ISNULL(SUM(bakidebet),0) KI
                    FROM Summary_PinjamanMonthlyCif
                    WHERE Cif IN(
                            SELECT CIF FROM AccountPlanningMenengah
                            WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCif
                        WHERE Cif IN(
                            SELECT CIF FROM AccountPlanningMenengah
                            WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                        )) And JenisPenggunaan = 1 ) A,
        
                ( SELECT ISNULL(SUM(bakidebet),0) KMK
                    FROM Summary_PinjamanMonthlyCif
                    WHERE Cif IN(
                        SELECT CIF FROM AccountPlanningMenengah
                        WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                    ) AND Periode = (SELECT Max(Periode) FROM Summary_PinjamanMonthlyCif
                        WHERE Cif IN(
                            SELECT CIF FROM AccountPlanningMenengah
                            WHERE AccountPlanningMenengahId=" . $AccountPlanningMenengahId . "
                        )) And JenisPenggunaan = 2 ) B";
        $result = $this->db->query($sql)->result_array();
        return $result;
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

    /* Client Needs */
    public function getFundings($apMenengahId){
        $sql = "SELECT FundingMenengahId, FundingNeed, TimePeriod, Amount, [Description]
                FROM FundingMenengah
                WHERE AccountPlanningMenengahId = ".$apMenengahId;
        $query = $this->db->query($sql);
        $result = $query->result();
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

    public function getInitiativeAction($accountPlanningId){
        $sql = "SELECT
                Name, Period, Description
            FROM InitiativeActionMenengah
            WHERE AccountPlanningMenengahId = ".$accountPlanningId;
        $query = $this->db->query($sql);
        $result = $query->result();
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

    public function get_doc_status() {

        $sql = 'SELECT DocumentStatusMenengahId, Name FROM DocumentStatusMenengah' ;

        return $this->db->query($sql)->result_array();  
    }

}
