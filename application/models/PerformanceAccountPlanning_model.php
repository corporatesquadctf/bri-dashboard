<?php

class PerformanceAccountPlanning_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function getFinnancialHighlightDetails($AccountPlanningId) {
        $sql = 'SELECT 
            "Year", "FinancialHighlightCurrency"
            FROM "AccountPlanning"
            WHERE "AccountPlanningId" = '.$AccountPlanningId.'
        ';

        $result = $this->db->query($sql)->row_array();  

        if (empty($result)) {
            return 0;
        }
        else {
            return $result;
        }
    }

    public function getDocumentStatus($AccountPlanningId) {
        $sql = 'SELECT 
            "d"."DocumentStatusId",
            "e"."Name" AS "Status"
            FROM "AccountPlanningStatus" "d"
            LEFT JOIN "DocumentStatus" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusId"
            WHERE "d"."AccountPlanningId" = '.$AccountPlanningId.'
            ORDER BY "d"."CreatedDate" DESC
        ';

        $result = $this->db->query($sql)->result_array();  

        if (empty($result)) {
            return 0;
        }
        else {
            return $result[0];
        }
    }

    public function getDocumentStatusMenengah($accountPlanningMenengahId){
        $sql = 'SELECT 
            "d"."DocumentStatusId",
            "e"."Name" AS "Status"
            FROM "AccountPlanningStatusMenengah" "d"
            LEFT JOIN "DocumentStatusMenengah" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusMenengahId"
            WHERE "d"."AccountPlanningMenengahId" = '.$accountPlanningMenengahId.'
            ORDER BY AccountPlanningStatusMenengahId DESC
        ';

        $result = $this->db->query($sql)->result_array();  

        if (empty($result)) {
            return 0;
        }
        else {
            return $result[0];
        }
    }

    public function getAccountCompetitions($AccountPlanningId, $BankFacilityItemId){
        $sql='SELECT distinct a.CompetitionAnalysisId,a.AccountPlanningId, a.BankId1, a.BankId2, a.BankId3,
                b.BankFacilityGroupId,
                b.Name AS BankFacilityGroupName, 
                c.BankFacilityItemId,
                c.Name AS BankFacilityItemName, 
                                    
                (select z.Name from Bank z where z.BankId = a.BankId1) as BankName1,
                (select p.Name from Bank p where p.BankId = a.BankId2) as BankName2,
                (select q.Name from Bank q where q.BankId = a.BankId3) as BankName3
            
                FROM CompetitionAnalysis a
                LEFT JOIN BankFacilityItem c on a.BankFacilityItemId = c.BankFacilityItemId 
                LEFT JOIN BankFacilityGroup b on b.BankFacilityGroupId = c.BankFacilityGroupId
                LEFT JOIN BankFacility d on a.AccountPlanningId = d.AccountPlanningId
                
                WHERE a.AccountPlanningId ='. $AccountPlanningId .'
                 AND c.BankFacilityItemId ='.  $BankFacilityItemId.' 
                
                ';
        
        $result = $this->db->query($sql)->row_array();
        return $result;
    }

    public function getAccountPlanningFinancialHighlight($AccountPlanningId, $FinancialHighlightItemId, $Year) {
        // $sql = 'SELECT FinancialHighlightId, Amount, Year
        //         FROM FinancialHighlight
        //         WHERE AccountPlanningId = '. $AccountPlanningId .' AND FinancialHighlightItemId = '. $FinancialHighlightItemId .' AND [Year] IN (YEAR(GETDATE())-3, YEAR(GETDATE())-2, YEAR(GETDATE())-1)';
        $sql = 'SELECT FinancialHighlightId, Amount, Year
                FROM FinancialHighlight
                WHERE AccountPlanningId = '. $AccountPlanningId .' AND FinancialHighlightItemId = '. $FinancialHighlightItemId .' 
                AND [Year] IN ('.$Year[0].', '.$Year[1].', '.$Year[2].')';
        // echo $sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningFinancialHighlightCurrency($AccountPlanningId) {
        $sql = 'SELECT FinancialHighlightCurrency
                FROM AccountPlanning
                WHERE AccountPlanningId = '. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();

        return $result[0]['FinancialHighlightCurrency'];
    }

    public function getAccountPlanningFinancialHighlightItem() {
        $sql = 'SELECT "a"."FinancialHighlightItemId", "a"."FinancialHighlightGroupId", "a"."Name" AS "FinancialHighlightItemName",
                "b"."Name" AS "FinancialHighlightGroupName"
                FROM "FinancialHighlightItem" "a"
                LEFT JOIN "FinancialHighlightGroup" "b" ON "a"."FinancialHighlightGroupId" = "b"."FinancialHighlightGroupId"
                WHERE "a"."IsActive" ='. 1;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getCSTPrivilegeTab($AccountPlanningId, $UserId) {
        $sql = 'SELECT PrivilegeTab
                FROM AccountPlanningMember
                WHERE AccountPlanningId = '.$AccountPlanningId.' AND UserId =\''. $UserId.'\'';
        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCustomerByVCIF($VCIF) {
        $sql = 'SELECT CustomerGroupId, Name, Description
                FROM CustomerKorporasi
                WHERE VCIF =\''. $VCIF.'\'';
        $result = $this->db->query($sql);

        return $result->row_array();
    }

    public function getAccountPlanningInitiativeAction($AccountPlanningId, $VCIF='') {
        $sql = 'SELECT InitiativeActionId, Name, Period, Description, VCIF
                FROM InitiativeAction
                WHERE AccountPlanningId ='. $AccountPlanningId;
        if (!empty($VCIF)) {
            $sql .= " AND VCIF = '".$VCIF."'";
        }

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacilityGroup() {
        $sql = 'SELECT BankFacilityGroupId, Name AS BankFacilityGroupName
                FROM BankFacilityGroup
                WHERE IsActive ='. 1;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacilityItem($AccountPlanningId = '', $BankFacilityGroupId = '', $Join = '') {
        $sql = 'SELECT "a"."BankFacilityItemId", "a"."BankFacilityGroupId", "a"."Name" AS "BankFacilityItemName",
                "b"."Name" AS "BankFacilityGroupName"
                FROM "BankFacilityItem" "a"
                LEFT JOIN "BankFacilityGroup" "b" ON "a"."BankFacilityGroupId" = "b"."BankFacilityGroupId"';

        $sql .= ' WHERE "a"."IsActive" = 1 AND IsDefault = 1';
        // echo $sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningCreditAssumption($AccountPlanningId) {
        $sql = 'SELECT CreditSimulationAssumptionId, USDExchange, IDRFTPSimpanan, ValasFTPSimpanan, IDRFTPPinjaman, ValasFTPPinjaman
                FROM CreditSimulationAssumption
                WHERE AccountPlanningId ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }


    public function getAccountPlanningCreditSimulationFee($AccountPlanningId, $FeeTypeId) {
        $sql = 'SELECT 
        "a"."CreditSimulationFeeId"
        , "a"."FeeTypeId"
        , "a"."AccountPlanningId"
        , "a"."IDRAmount"
        , "a"."ValasAmount"
                FROM "CreditSimulationFee" "a"
                WHERE "a"."FeeTypeId" = '. $FeeTypeId .' AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                ';
        // echo "<br>".$sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningCreditSimulation($AccountPlanningId, $BankFacilityItemId) {
        $sql = 'SELECT 
        "a"."CreditSimulationId"
        , "a"."BankFacilityItemId"
        , "a"."AccountPlanningId"
        , "a"."IDRPlafond"
        , "a"."ValasPlafond"
        , "a"."IDROutstanding"
        , "a"."ValasOutstanding"
        , "a"."IDRDailyRatas"
        , "a"."ValasDailyRatas"
        , "a"."IDRTenor"
        , "a"."ValasTenor"
        , "a"."IDRIndicativeRate"
        , "a"."ValasIndicativeRate"
        , "a"."IDRIncomeExpense"
        , "a"."ValasIncomeExpense"
        , "a"."IDRProvisionRate"
        , "a"."ValasProvisionRate"
        , "a"."IDRProvision"
        , "a"."ValasProvision"
        , "a"."IDRFee"
        , "a"."ValasFee"
        , "a"."IDRBebanBunga"
        , "a"."ValasBebanBunga"
                FROM "CreditSimulation" "a"
                WHERE "a"."BankFacilityItemId" = '. $BankFacilityItemId .' AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                ';
        // echo "<br>".$sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningCreditSimulationAddition($AccountPlanningId, $BankFacilityItemAdditionId = '') {
        $sql = 'SELECT 
        "a"."CreditSimulationAdditionId"
        , "a"."BankFacilityItemAdditionId"
        , "a"."AccountPlanningId"
        , "a"."IDRPlafondAddition"
        , "a"."ValasPlafondAddition"
        , "a"."IDROutstandingAddition"
        , "a"."ValasOutstandingAddition"
        , "a"."IDRDailyRatasAddition"
        , "a"."ValasDailyRatasAddition"
        , "a"."IDRTenorAddition"
        , "a"."ValasTenorAddition"
        , "a"."IDRIndicativeRateAddition"
        , "a"."ValasIndicativeRateAddition"
        , "a"."IDRIncomeExpenseAddition"
        , "a"."ValasIncomeExpenseAddition"
        , "a"."IDRProvisionRateAddition"
        , "a"."ValasProvisionRateAddition"
        , "a"."IDRProvisionAddition"
        , "a"."ValasProvisionAddition"
        , "a"."IDRFeeAddition"
        , "a"."ValasFeeAddition"
        , "a"."IDRBebanBungaAddition"
        , "a"."ValasBebanBungaAddition"
                FROM "CreditSimulationAddition" "a"
                WHERE "a"."BankFacilityItemAdditionId" = '. $BankFacilityItemAdditionId .' AND "a"."AccountPlanningId" = '. $AccountPlanningId .' 
                ';


        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacilityItemsAddition($AccountPlanningId, $VCIF='', $BankFacilityGroupId='') {
        $sql = '
        SELECT "a"."BankFacilityItemAdditionId", "a"."BankFacilityGroupId", "a"."Name" AS "BankFacilityItemAdditionName",
        "b"."Name" AS "BankFacilityGroupName"
        FROM "BankFacilityItemAddition" "a"
        LEFT JOIN "BankFacilityGroup" "b" ON "a"."BankFacilityGroupId" = "b"."BankFacilityGroupId"
                ';

        $sql .= ' WHERE "a"."BankFacilityGroupId" = '. $BankFacilityGroupId .' AND "a"."AccountPlanningId" = '. $AccountPlanningId .' ';
        if (!empty($VCIF)) {
            $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
        }
        // echo "<br>".$sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningEstimatedFinancialAddition($AccountPlanningId, $BankFacilityItemAdditionId = '', $VCIF = '') {
        $sql = '
        SELECT 
        "a"."EstimatedFinancialAdditionId", "a"."BankFacilityItemAdditionId", "a"."IDRProjectionAddition", "a"."ValasProjectionAddition", "a"."IDRTargetAddition", "a"."ValasTargetAddition", "a"."VCIF",
        "b"."Name" AS BankFacilityItemAdditionName, "b"."BankFacilityGroupId",
        "c"."Name" AS BankFacilityGroupName, 
        "d"."Name" AS "CompanyName"
                FROM "EstimatedFinancialAddition" "a"
                LEFT JOIN "BankFacilityItemAddition" "b" ON "a"."BankFacilityItemAdditionId" = "b"."BankFacilityItemAdditionId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                LEFT JOIN "CustomerKorporasi" "d" ON "a"."VCIF" = "d"."VCIF"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId;
                if (!empty($BankFacilityItemAdditionId)) {
                     $sql .= ' AND "b"."BankFacilityItemAdditionId" = '. $BankFacilityItemAdditionId;
                }
                if (!empty($VCIF)) {
                     $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        // echo "<br>".$sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacility($AccountPlanningId, $BankFacilityItemId, $VCIF='') {
        $sql = 'SELECT "c"."Name" AS BankFacilityGroupName
        , "b"."Name" AS BankFacilityItemName, "b"."BankFacilityGroupId"
        , "a"."BankFacilityId", "a"."IDRAmount", "a"."ValasAmount", "a"."IDRRate", "a"."ValasRate"
        , "d"."Name" AS "CompanyName"

                FROM "BankFacility" "a"
                LEFT JOIN "BankFacilityItem" "b" ON "a"."BankFacilityItemId" = "b"."BankFacilityItemId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                LEFT JOIN "CustomerKorporasi" "d" ON "a"."VCIF" = "d"."VCIF"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "b"."BankFacilityItemId" = '. $BankFacilityItemId;
                if (!empty($VCIF)) {
                     $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        // echo $sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacilityAddition($AccountPlanningId, $BankFacilityItemAdditionId, $VCIF='') {
        $sql = 'SELECT "c"."Name" AS BankFacilityGroupName
        , "b"."Name" AS BankFacilityItemAdditionName, "b"."BankFacilityGroupId"
        , "a"."BankFacilityAdditionId", "a"."IDRAmountAddition", "a"."ValasAmountAddition", "a"."IDRRateAddition", "a"."ValasRateAddition"
        , "d"."Name" AS "CompanyName"

                FROM "BankFacilityAddition" "a"
                LEFT JOIN "BankFacilityItemAddition" "b" ON "a"."BankFacilityItemAdditionId" = "b"."BankFacilityItemAdditionId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                LEFT JOIN "CustomerKorporasi" "d" ON "a"."VCIF" = "d"."VCIF"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "b"."BankFacilityItemAdditionId" = '. $BankFacilityItemAdditionId;
                if (!empty($VCIF)) {
                     $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        // echo "<br>".$sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningEstimatedFinancial($AccountPlanningId, $BankFacilityItemId = '', $VCIF = '') {
        $sql = '
        SELECT 
        "a"."EstimatedFinancialId", "a"."BankFacilityItemId", "a"."IDRProjection", "a"."ValasProjection", "a"."IDRTarget", "a"."ValasTarget", "a"."VCIF",
        "b"."Name" AS BankFacilityItemName, "b"."BankFacilityGroupId",
        "c"."Name" AS BankFacilityGroupName, 
        "d"."Name" AS "CompanyName"
                FROM "EstimatedFinancial" "a"
                LEFT JOIN "BankFacilityItem" "b" ON "a"."BankFacilityItemId" = "b"."BankFacilityItemId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                LEFT JOIN "CustomerKorporasi" "d" ON "a"."VCIF" = "d"."VCIF"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId;
                if (!empty($BankFacilityItemId)) {
                     $sql .= ' AND "b"."BankFacilityItemId" = '. $BankFacilityItemId;
                }
                if (!empty($VCIF)) {
                     $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        //echo $sql; die;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningWalletShare($AccountPlanningId, $BankFacilityItemId = "", $VCIF = "") {
        $sql = 'SELECT "c"."Name" AS BankFacilityGroupName, "b"."Name" AS BankFacilityItemName, "b"."BankFacilityGroupId",
         "a"."WalletShareId", "a"."BRINominal", "a"."BRIPortion", "a"."OtherNominal", "a"."OtherPortion", "a"."TotalAmount"
                FROM "WalletShare" "a"
                LEFT JOIN "BankFacilityItem" "b" ON "a"."BankFacilityItemId" = "b"."BankFacilityItemId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "b"."BankFacilityItemId" = '. $BankFacilityItemId;
                if ($VCIF != "") {
                        $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        //echo $sql; die;
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningWalletShareAddition($AccountPlanningId, $BankFacilityItemAdditionId = "", $VCIF = "") {
        $sql = 'SELECT "c"."Name" AS BankFacilityGroupName, "b"."Name" AS BankFacilityItemAdditionName, "b"."BankFacilityGroupId",
         "a"."WalletShareAdditionId", "a"."BRINominalAddition", "a"."BRIPortionAddition", "a"."OtherNominalAddition", "a"."OtherPortionAddition", "a"."TotalAmountAddition"
                FROM "WalletShareAddition" "a"
                LEFT JOIN "BankFacilityItemAddition" "b" ON "a"."BankFacilityItemAdditionId" = "b"."BankFacilityItemAdditionId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "b"."BankFacilityItemAdditionId" = '. $BankFacilityItemAdditionId;
                if ($VCIF != "") {
                        $sql .= ' AND "a"."VCIF" = \''. $VCIF .'\'';
                }
        //echo $sql; die;
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningServiceTag($ServiceId) {
        $sql = 'SELECT "a"."UnitKerjaId", "b"."Name" AS "TagServiceUnitKerja"
                FROM "TagServiceUnitKerja" "a"
                LEFT JOIN "UnitKerja" "b" on "a"."UnitKerjaId"="b"."UnitKerjaId" AND "b"."IsActive"=1
                WHERE "a"."ServiceId" ='. $ServiceId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningService($AccountPlanningId, $VCIF='') {
        $sql = 'SELECT ServiceId, Name AS ServiceName, Target, Description
                FROM Service
                WHERE AccountPlanningId ='. $AccountPlanningId;
        if (!empty($VCIF)) {
            $sql .= " AND VCIF = '".$VCIF."'";
        }

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningFunding($AccountPlanningId, $VCIF='') {
        $sql = 'SELECT FundingId, FundingNeed, TimePeriod, Amount, Description
                FROM Funding
                WHERE AccountPlanningId ='. $AccountPlanningId;
        if (!empty($VCIF)) {
            $sql .= " AND VCIF = '".$VCIF."'";
        }

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningCoverageMapping($AccountPlanningId) {
        $sql = 'SELECT ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description
                FROM CoverageMapping
                WHERE AccountPlanningId ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningStrategicPlan($AccountPlanningId, $StrategicPlanTypeId) {
        $sql = 'SELECT Name
                FROM StrategicPlan
                WHERE AccountPlanningId ='. $AccountPlanningId .' AND StrategicPlanTypeId ='. $StrategicPlanTypeId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningFileStructure($AccountPlanningId, $StructureTypeId) {
        $sql = 'SELECT FilePath
                FROM FileStructure
                WHERE AccountPlanningId ='. $AccountPlanningId .' AND StructureTypeId ='. $StructureTypeId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningShareholder($AccountPlanningId) {
        $sql = 'SELECT Name, Quantity as Value
                FROM Shareholder
                WHERE AccountPlanningId ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningGroupOverview($AccountPlanningId) {
        $sql = 'SELECT "a".GroupOverviewId, "a"."Address1", "a"."Address2", "a"."Address3", "a"."Address1", "a"."IndustryName",
                    "b"."Name" AS "Province",
                    "c"."Name" AS "GlobalRatingName", "c"."Description" AS "GlobalRatingDescription", 
                    "d"."Name" AS "DomesticRating",
                    "e"."Name" AS "LifeCycle",
                    "f"."Name" AS "ChildCompanyName",
                    "g"."Name" AS "IndustryTrend"
                FROM "GroupOverview" "a"
                LEFT JOIN "Province" "b" on "a"."ProvinceId"="b"."ProvinceId" AND "b"."IsActive"=1
                LEFT JOIN "GlobalRating" "c" on "a"."GlobalRatingId"="c"."GlobalRatingId" AND "c"."IsActive"=1
                LEFT JOIN "DomesticRating" "d" on "a"."DomesticRatingId"="d"."DomesticRatingId" AND "d"."IsActive"=1
                LEFT JOIN "LifeCycle" "e" on "a"."LifeCycleId"="e"."LifeCycleId" AND "e"."IsActive"=1
                LEFT JOIN "CustomerKorporasi" "f" on "a"."VCIF"="f"."VCIF" 
                LEFT JOIN "IndustryTrend" "g" on "a"."IndustryTrendId"="g"."IndustryTrendId" AND "g"."IsActive"=1
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningVCIFList($AccountPlanningId) {
        /*$sql = 'SELECT "a"."VCIF", "a"."IsMain", "b"."Name"
                FROM "AccountPlanningCustomer" "a"
                LEFT JOIN "CustomerKorporasi" "b" on "a"."VCIF"="b"."VCIF"
                LEFT JOIN "AccountPlanning" "c" on "a"."AccountPlanningId"="c"."AccountPlanningId"
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId.' AND "c"."Year" ='. $this->year_current.'
                ORDER BY b.Name';*/
        $sql = 'SELECT "a"."VCIF", "a"."IsMain", "b"."Name"
                FROM "AccountPlanningCustomer" "a"
                LEFT JOIN "CustomerKorporasi" "b" on "a"."VCIF"="b"."VCIF"
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId.' 
                ORDER BY b.Name';
                // echo $sql;
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getAccountPlanningMember($AccountPlanningId) {
        $sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name", c.Name UkerName
                FROM "AccountPlanningMember" "a"
                LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
                LEFT JOIN UnitKerja c on c.UnitKerjaId = b.UnitKerjaId
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewPerformanceAccountPlanning($keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
            SELECT COUNT(*) AS "numrows" 
            FROM "AccountPlanning" 
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result[0]['numrows'];
    }

    public function getViewPerformanceAccountPlanning($rowperpage, $rowno, $keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
            SELECT "a"."AccountPlanningId", "a"."Year", "a"."FinancialHighlightCurrency" AS "Currency", "a"."CreatedDate", 
            "b"."VCIF", 
            "c"."Name" AS "CustomerName", "c"."CustomerGroupId", 
            "f"."UserId" AS "RMId", 
            "g"."Name" AS "RMName",
            "h"."Name" AS "CustomerGroupName"
            
            FROM AccountPlanning a
            LEFT JOIN "AccountPlanningCustomer" "b" ON "a"."AccountPlanningId"="b"."AccountPlanningId"
            LEFT JOIN "CustomerKorporasi" "c" ON "b"."VCIF"="c"."VCIF" 
            LEFT JOIN "AccountPlanningOwner" "f" ON "a"."AccountPlanningId"="f"."AccountPlanningId" AND "f"."IsActive"=1
            LEFT JOIN "User" "g" ON "f"."UserId"="g"."UserId" AND "g"."IsActive"=1
            LEFT JOIN "CustomerGroup" "h" ON "c"."CustomerGroupId"="h"."CustomerGroupId" 
            WHERE "b"."IsMain"=1
        ';

        $sql .= ' ORDER BY a.CreatedDate DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        // echo $sql; die();
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getDetailPerformanceAccountPlanning($AccountPlanningId) {
        $sql = '
            SELECT "a"."AccountPlanningId", "a"."Year", "a"."FinancialHighlightCurrency" AS "FinancialHighlightCurrency", "a"."CreatedDate", "b"."VCIF", "c"."Name" AS "CustomerName", "d"."DocumentStatusId", "e"."Name" AS "Status",
                "f"."UserId" AS "RMId", "g"."Name" AS "RMName", "g"."UnitKerjaId", "h"."Name" AS "UKER"
                , "i"."Logo", "i"."ClassificationId"
                , "j"."Name" AS Clasifications
            FROM AccountPlanning a
            LEFT JOIN "AccountPlanningCustomer" "b" ON "a"."AccountPlanningId"="b"."AccountPlanningId"
            LEFT JOIN "CustomerKorporasi" "c" ON "b"."VCIF"="c"."VCIF" 
            LEFT JOIN "AccountPlanningStatus" "d" ON "a"."AccountPlanningId"="d"."AccountPlanningId"
            LEFT JOIN "DocumentStatus" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusId" 
            LEFT JOIN "AccountPlanningOwner" "f" ON "a"."AccountPlanningId"="f"."AccountPlanningId" AND "f"."IsActive"=1
            LEFT JOIN "User" "g" ON "f"."UserId"="g"."UserId" AND "g"."IsActive"=1
            LEFT JOIN "UnitKerja" "h" ON "h"."UnitKerjaId" = "g"."UnitKerjaId"
            LEFT JOIN "CustomerGroup" "i" ON "i"."CustomerGroupId" = "c"."CustomerGroupId"
            LEFT JOIN "Classification" "j" ON "i"."ClassificationId" = "j"."ClassificationId"
            WHERE "b"."IsMain"=1 AND "a"."AccountPlanningId" = '.$AccountPlanningId.'
        ';

        $result = $this->db->query($sql)->row_array();  

        return $result;
    }
}

?>
