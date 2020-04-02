<?php

class TasklistMyTask_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function getAccountPlanningYear($AccountPlanningId) {
        $sql = 'SELECT "a"."Year"
                FROM "AccountPlanning" "a"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId;

        $result = $this->db->query($sql)->row_array();  

        return $result;
    }

    public function getAccountPlanningByYear($Year) {
        $sql = 'SELECT "a"."AccountPlanningId", "a"."CreatedBy"
                FROM "AccountPlanning" "a"
                WHERE "a"."Year" = \''. $Year.'\'';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getSummaryCustomer($VCIF) {
        $sql = 'SELECT "a"."VCIF", "a"."PinjamanTotal", "a"."PinjamanRatas", "a"."SimpananTotal", "a"."SimpananRatas", "a"."CurrentCPA", "a"."ValueChain" 
                FROM "Summary_SimpanPinjamCustomerVCIF" "a"
                WHERE "a"."VCIF" = \''. $VCIF.'\'';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewGroupList($UserId, $searchTxt='') {
        $sql = '
            SELECT COUNT(*) AS "numrows" 
            FROM "DisposisiCustomerGroup" "a" 
            WHERE IsActive=1 AND UserId = \''.$UserId.'\' 
        ';

        if (!empty($searchTxt)) {
            $sql .= " AND (
                CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerGroup
                    WHERE Name LIKE '%".$searchTxt."%'
                )
                OR CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerKorporasi
                    WHERE Name LIKE '%".$searchTxt."%'
                )
            ) ";
        }

        $result = $this->db->query($sql)->result_array();  

        return $result[0]['numrows'];
    }

    public function getViewGroupList($UserId, $rowperpage, $rowno, $searchTxt='') {

        $sql = '
            SELECT 
            "a"."CustomerGroupId", "a"."UserId", 
            "b"."Name" AS "CustomerGroupName", b.[Logo]
            FROM DisposisiCustomerGroup a
            JOIN "CustomerGroup" "b" ON "a"."CustomerGroupId"="b"."CustomerGroupId"
            WHERE "a"."IsActive"=1 AND "a"."UserId" = \''.$UserId.'\' 
        ';

        if (!empty($searchTxt)) {
            $sql .= " AND (b.Name LIKE '%".$searchTxt."%' 
                OR a.CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerKorporasi
                    WHERE Name LIKE '%".$searchTxt."%'
                )
            ) ";
        }

        $sql .= ' ORDER BY StartDate DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getAccountPlanningId() {
        $sql = "
            SELECT SCOPE_IDENTITY() AS AccountPlanningId;
        ";

        $result = $this->db->query($sql)->result_array();   

        return $result[0]['AccountPlanningId'];
    }

    public function insertAccountPlanning($year, $userId) {

        $sql = "INSERT INTO AccountPlanning(Year, CreatedDate, CreatedBy)
            VALUES('".$year."', SYSDATETIME(), '".$userId."')";
        $this->db->query($sql);
        $sql = "SELECT SCOPE_IDENTITY() AS AccountPlanningId";
        $result = $this->db->query($sql)->result_array();  
        $apId = $result[0]['AccountPlanningId'];
        //$this->db->trans_complete();

         $data = array(
            'AccountPlanningId'       => $apId, 
            'UserId'                => $userId
        );

        $query = $this->db->query('transAccountPlanningOwnerCreate ?,?',$data);
        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success',
                'message'=> $apId
            );
        }

         return $result;
    }

    public function duplicateAccountPlanning($AccountPlanningId, $UserId, $Year='') {
        if (empty($Year)) {
            $Year = $this->current_year + 1;
        }

        $data = array(
            'AccountPlanningId'     => $AccountPlanningId, 
            'UserId'                => $UserId,
            'Year'                  => $Year
        );

        $query = $this->db->query('transAccountPlanningDuplicate ?,?,?',$data);
        $error = $this->db->error();

        // if($error['code']<>0) {
        //     $result = array(
        //         'status' => 'error',
        //         'message'=> $error['message']
        //     );
        // } else {
            $result = array(
                'status' => 'success',
            );
        // }

         return $result;

    }

    public function insertCustomerAP($data) {

        foreach ($data as $key => $value) {
            $query = $this->db->query('transAccountPlanningAddCustomer ?,?,?,?,?',$value);
            $error = $this->db->error();
            //print_r($error); die();
            if($error['code']<>0) {
                $result = array(
                    'status' => 'error',
                    'message'=> $error['message']
                );
                break;
            } else {
                $result = array(
                    'status' => 'success'
                );
            }
        }

        return $result;

    }
    
    public function cloneItemAddition_AccountPlanning($AccountPlanningId, $insertAccountPlanningId, $VCIF, $BankFacilityGroupId) {

        $sql = '        
        DECLARE @BankFacilityGroupId INT
        SET @BankFacilityGroupId = '.$BankFacilityGroupId.'
            
        ';
        $sql .= '        
        DECLARE @OldItemAdditionId INT

        SET @OldItemAdditionId = (
            SELECT BankFacilityItemAdditionId FROM BankFacilityItemAddition WHERE AccountPlanningId = '.$AccountPlanningId.' AND VCIF = \''.$VCIF.'\' AND BankFacilityGroupId = '.$BankFacilityGroupId.'
        )

        ';

        $sql .= '
        INSERT INTO BankFacilityItemAddition (BankFacilityGroupId, AccountPlanningId, VCIF, Name, Description, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT BankFacilityGroupId, '.$insertAccountPlanningId.', VCIF, Name, Description, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy 
            FROM BankFacilityItemAddition 
            WHERE AccountPlanningId = '.$AccountPlanningId.' 
            AND VCIF = \''.$VCIF.'\' 
            AND BankFacilityGroupId = @BankFacilityGroupId

        ';

        $sql .= '
        DECLARE @NewItemAdditionId INT
        SET @NewItemAdditionId = (
                SELECT SCOPE_IDENTITY()
            ) 
    
        ';

        $sql .= '        
        INSERT INTO BankFacilityAddition (BankFacilityItemAdditionId, AccountPlanningId, VCIF, IDRAmountAddition, IDRRateAddition, ValasAmountAddition, ValasRateAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT @NewItemAdditionId, '.$insertAccountPlanningId.', \''.$VCIF.'\', IDRAmountAddition, IDRRateAddition, ValasAmountAddition, ValasRateAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy 
            FROM BankFacilityAddition 
            WHERE AccountPlanningId = '.$AccountPlanningId.' 
            AND VCIF = \''.$VCIF.'\'
            AND BankFacilityItemAdditionId = @OldItemAdditionId

        ';

        $sql .= '
        INSERT INTO EstimatedFinancialAddition (BankFacilityItemAdditionId, AccountPlanningId, VCIF, IDRProjectionAddition, ValasProjectionAddition, IDRTargetAddition, ValasTargetAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy)
        SELECT @NewItemAdditionId, '.$insertAccountPlanningId.', \''.$VCIF.'\', IDRProjectionAddition, ValasProjectionAddition, IDRTargetAddition, ValasTargetAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy 
            FROM EstimatedFinancialAddition 
            WHERE AccountPlanningId = '.$AccountPlanningId.'
            AND VCIF = \''.$VCIF.'\'
            AND BankFacilityItemAdditionId = @OldItemAdditionId

        ';

        // echo $sql; die();
        // $result = $this->db->query($sql)->result_array();   
        // return $result[0]['InputedId'];

        $str = $this->db->query($sql);
        // echo $this->db->last_query(); //die();
        $error = $this->db->error();
        // print_r($error); die();
        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function cloneDataAddition_AccountPlanning($AccountPlanningId, $insertAccountPlanningId, $VCIF, $BankFacilityItemAdditionId) {
        $sql = '

        INSERT INTO BankFacilityAddition (BankFacilityItemAdditionId, AccountPlanningId, VCIF, IDRAmountAddition, IDRRateAddition, ValasAmountAddition, ValasRateAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$BankFacilityItemAdditionId.', '.$insertAccountPlanningId.', '.$VCIF.', IDRAmountAddition, IDRRateAddition, ValasAmountAddition, ValasRateAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM BankFacilityAddition WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO EstimatedFinancialAddition (BankFacilityItemAdditionId, AccountPlanningId, VCIF, IDRProjectionAddition, ValasProjectionAddition, IDRTargetAddition, ValasTargetAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy)
        SELECT '.$BankFacilityItemAdditionId.', '.$insertAccountPlanningId.', '.$VCIF.', IDRProjectionAddition, ValasProjectionAddition, IDRTargetAddition, ValasTargetAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM EstimatedFinancialAddition WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO WalletShareAddition (BankFacilityItemAdditionId, AccountPlanningId, VCIF, BRINominalAddition, BRIPortionAddition, OtherNominalAddition, OtherPortionAddition, TotalAmountAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$BankFacilityItemAdditionId.', '.$insertAccountPlanningId.', '.$VCIF.', BRINominalAddition, BRIPortionAddition, OtherNominalAddition, OtherPortionAddition, TotalAmountAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM WalletShareAddition WHERE AccountPlanningId = '.$AccountPlanningId.'

        ';

        // echo $sql; die();

        $str = $this->db->query($sql);
        // echo $this->db->last_query(); //die();
        $error = $this->db->error();
        // print_r($error); die();
        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function cloneData_AccountPlanning($AccountPlanningId, $insertAccountPlanningId, $Year) {

        $sql = '

        INSERT INTO AccountPlanningChecker (AccountPlanningId, UserId, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy)
        SELECT '.$insertAccountPlanningId.', UserId, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM AccountPlanningChecker WHERE IsActive = 1 AND AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO AccountPlanningSigner (AccountPlanningId, UserId, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy)
        SELECT '.$insertAccountPlanningId.', UserId, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM AccountPlanningSigner WHERE IsActive = 1 AND AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO AccountPlanningMember (AccountPlanningId, UserId, CreatedDate, CreatedBy, PrivilegeTab)
        SELECT '.$insertAccountPlanningId.', UserId, CreatedDate, CreatedBy, PrivilegeTab FROM AccountPlanningMember WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO BankFacility (BankFacilityItemId, AccountPlanningId, VCIF, IDRAmount, IDRRate, ValasAmount, ValasRate, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom) 
        SELECT BankFacilityItemId, '.$insertAccountPlanningId.', VCIF, IDRAmount, IDRRate, ValasAmount, ValasRate, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom FROM BankFacility WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO BankFacilityItemAddition (BankFacilityGroupId, AccountPlanningId, VCIF, Name, Description, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT BankFacilityGroupId, '.$insertAccountPlanningId.', VCIF, Name, Description, IsActive, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM BankFacilityItemAddition WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO CompetitionAnalysis (BankFacilityItemId, AccountPlanningId, BankId1, BankId2, BankId3, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT BankFacilityItemId, '.$insertAccountPlanningId.', BankId1, BankId2, BankId3, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM CompetitionAnalysis WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO CoverageMapping (AccountPlanningId, VCIF, ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', VCIF, ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM CoverageMapping WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO EstimatedFinancial (BankFacilityItemId, AccountPlanningId, VCIF, IDRProjection, ValasProjection, IDRTarget, ValasTarget, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT BankFacilityItemId, '.$insertAccountPlanningId.', VCIF, IDRProjection, ValasProjection, IDRTarget, ValasTarget, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM EstimatedFinancial WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO FinancialHighlight (FinancialHighlightItemId, AccountPlanningId, [Year], Amount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom) 
        SELECT FinancialHighlightItemId, '.$insertAccountPlanningId.', [Year], Amount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom FROM FinancialHighlight WHERE AccountPlanningId = '.$AccountPlanningId.' AND [Year] IN ('.$Year.', '.($Year-1).') 
        INSERT INTO FinancialHighlight (FinancialHighlightItemId, AccountPlanningId, [Year], Amount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom) 
        SELECT FinancialHighlightItemId, '.$insertAccountPlanningId.', \'2019\', 0, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom FROM FinancialHighlight WHERE AccountPlanningId = '.$AccountPlanningId.' AND [Year] = '.$Year.' 

        INSERT INTO Funding (AccountPlanningId, VCIF, FundingNeed, TimePeriod, Amount, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', VCIF, FundingNeed, TimePeriod, Amount, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM Funding WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO FileStructure (StructureTypeId, AccountPlanningId, VCIF, FilePath, [Size], [Type], Description, CreatedDate, CreatedBy) 
        SELECT StructureTypeId, '.$insertAccountPlanningId.', VCIF, FilePath, [Size], [Type], Description, CreatedDate, CreatedBy FROM FileStructure WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO GroupOverview (AccountPlanningId, VCIF, Address1, Address2, Address3, ProvinceId, GlobalRatingId, DomesticRatingId, IndustryName, IndustryTrendId, LifeCycleId, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', VCIF, Address1, Address2, Address3, ProvinceId, GlobalRatingId, DomesticRatingId, IndustryName, IndustryTrendId, LifeCycleId, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM GroupOverview WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO InitiativeAction (AccountPlanningId, VCIF, Name, Period, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', VCIF, Name, Period, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM InitiativeAction WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO Shareholder (AccountPlanningId, Name, Quantity, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom) 
        SELECT '.$insertAccountPlanningId.', Name, Quantity, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, LoadFrom FROM Shareholder WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO Service (AccountPlanningId, VCIF, Name, Target, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', VCIF, Name, Target, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM Service WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO StrategicPlan (StrategicPlanTypeId, AccountPlanningId, VCIF, Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT StrategicPlanTypeId, '.$insertAccountPlanningId.', VCIF, Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM StrategicPlan WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO WalletShare (BankFacilityItemId, AccountPlanningId, VCIF, BRINominal, BRIPortion, OtherNominal, OtherPortion, TotalAmount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT BankFacilityItemId, '.$insertAccountPlanningId.', VCIF, BRINominal, BRIPortion, OtherNominal, OtherPortion, TotalAmount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM WalletShare WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO CreditSimulationAssumption (AccountPlanningId, USDExchange, IDRFTPSimpanan, ValasFTPSimpanan, IDRFTPPinjaman, ValasFTPPinjaman, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT '.$insertAccountPlanningId.', USDExchange, IDRFTPSimpanan, ValasFTPSimpanan, IDRFTPPinjaman, ValasFTPPinjaman, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM CreditSimulationAssumption WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO CreditSimulation (BankFacilityItemId, AccountPlanningId, IDRPlafond, ValasPlafond, IDROutstanding, ValasOutstanding, IDRDailyRatas, ValasDailyRatas, IDRTenor, ValasTenor, IDRIndicativeRate, ValasIndicativeRate, IDRIncomeExpense, ValasIncomeExpense, IDRProvisionRate, ValasProvisionRate, IDRProvision, ValasProvision, IDRFee, ValasFee, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IDRBebanBunga, ValasBebanBunga) 
        SELECT BankFacilityItemId, '.$insertAccountPlanningId.', IDRPlafond, ValasPlafond, IDROutstanding, ValasOutstanding, IDRDailyRatas, ValasDailyRatas, IDRTenor, ValasTenor, IDRIndicativeRate, ValasIndicativeRate, IDRIncomeExpense, ValasIncomeExpense, IDRProvisionRate, ValasProvisionRate, IDRProvision, ValasProvision, IDRFee, ValasFee, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IDRBebanBunga, ValasBebanBunga FROM CreditSimulation WHERE AccountPlanningId = '.$AccountPlanningId.'

        --INSERT INTO CreditSimulationAddition (BankFacilityItemAdditionId, AccountPlanningId, IDRPlafondAddition, ValasPlafondAddition, IDROutstandingAddition, ValasOutstandingAddition, IDRDailyRatasAddition, ValasDailyRatasAddition, IDRTenorAddition, ValasTenorAddition, IDRIndicativeRateAddition, ValasIndicativeRateAddition, IDRIncomeExpenseAddition, ValasIncomeExpenseAddition, IDRProvisionRateAddition, ValasProvisionRateAddition, IDRProvisionAddition, ValasProvisionAddition, IDRFeeAddition, ValasFeeAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IDRBebanBungaAddition, ValasBebanBungaAddition)
        --SELECT BankFacilityItemAdditionId, '.$insertAccountPlanningId.', IDRPlafondAddition, ValasPlafondAddition, IDROutstandingAddition, ValasOutstandingAddition, IDRDailyRatasAddition, ValasDailyRatasAddition, IDRTenorAddition, ValasTenorAddition, IDRIndicativeRateAddition, ValasIndicativeRateAddition, IDRIncomeExpenseAddition, ValasIncomeExpenseAddition, IDRProvisionRateAddition, ValasProvisionRateAddition, IDRProvisionAddition, ValasProvisionAddition, IDRFeeAddition, ValasFeeAddition, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IDRBebanBungaAddition, ValasBebanBungaAddition FROM CreditSimulationAddition WHERE AccountPlanningId = '.$AccountPlanningId.'

        INSERT INTO CreditSimulationFee (FeeTypeId, AccountPlanningId, IDRAmount, ValasAmount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        SELECT FeeTypeId, '.$insertAccountPlanningId.', IDRAmount, ValasAmount, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy FROM CreditSimulationFee WHERE AccountPlanningId = '.$AccountPlanningId.'

        ';

        // echo $sql; die();

        $str = $this->db->query($sql);
        // echo $this->db->last_query(); //die();
        $error = $this->db->error();
        // print_r($error); die();
        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

}
