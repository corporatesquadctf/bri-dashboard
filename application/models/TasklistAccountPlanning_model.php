<?php

class TasklistAccountPlanning_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getAccountPlanningRecentActivities($AccountPlanningId) {
        $sql = "SELECT distinct Activity, Message, B.Name, convert(datetime,convert(varchar,A.CreatedDate, 100)) CreatedDate
                FROM AccountPlanningActivity A, [User] B
                WHERE A.CreatedBy=B.UserId AND AccountPlanningId=".$AccountPlanningId."  
                ORDER BY convert(datetime,convert(varchar,A.CreatedDate, 100)) DESC OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY";

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningEstimatedFinancial($AccountPlanningId, $BankFacilityItemId, $VCIF) {
        $sql = '
        SELECT "c"."Name" AS BankFacilityGroupName, 
        "b"."Name" AS BankFacilityItemName, "b"."BankFacilityGroupId",
        "a"."EstimatedFinancialId", "a"."IDRProjection", "a"."ValasProjection", "a"."IDRTarget", "a"."ValasTarget", "a"."VCIF",
        "d"."Name" AS "CompanyName"
                FROM "EstimatedFinancial" "a"
                LEFT JOIN "BankFacilityItem" "b" ON "a"."BankFacilityItemId" = "b"."BankFacilityItemId"
                LEFT JOIN "BankFacilityGroup" "c" ON "b"."BankFacilityGroupId" = "c"."BankFacilityGroupId"
                LEFT JOIN "CustomerKorporasi" "d" ON "a"."VCIF" = "d"."VCIF"
                WHERE "a"."AccountPlanningId" = '. $AccountPlanningId .' AND "a"."VCIF" = \''. $VCIF .'\' AND "b"."BankFacilityItemId" = '. $BankFacilityItemId;
        // echo $sql;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningIdByVCIF($VCIF) {
        $sql = "
            SELECT DISTINCT a.AccountPlanningId FROM AccountPlanningCustomer a
                LEFT JOIN AccountPlanning b on b.Year='".$this->current_year."' AND b.AccountPlanningId=a.AccountPlanningId
                WHERE a.VCIF='".$VCIF."' AND b.[Year]!=''
        ";
        // echo $sql;

        $result = $this->db->query($sql)->row_array();  
        return $result;
    }

    public function getVCIFList($APVCIFSelected='', $CustomerGroupId, $AccountPlanningId) {
        $sql = "SELECT DISTINCT a.VCIF, a.Name CustomerName
                --, b.AccountPlanningId
                FROM CustomerKorporasi a
                -- , AccountPlanningCustomer b
                LEFT JOIN AccountPlanning c on c.Year=(SELECT C.[Year] FROM AccountPlanning C WHERE C.AccountPlanningId=".$AccountPlanningId.")
                WHERE a.CustomerGroupId=".$CustomerGroupId."
                -- AND a.VCIF=b.VCIF
            ";
            // echo $sql;
        if (!empty($APVCIFSelected)) {
            $sql .= ' AND a.VCIF NOT IN (';
            $selected = '';
            foreach ($APVCIFSelected as $key => $value) {
                $selected .= "'".$value['VCIF']."', ";
            }
            $sql .= substr($selected, 0, -2);
            $sql .= ')';
        }
        // echo $sql;
            
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getMemberSelected($AccountPlanningId, $CreatedBy='') {
        $sql = 'SELECT "a"."UserId"
                    , "b"."Name" AS "RMName"
                    , "c"."Name" AS "UkerName"
                FROM "AccountPlanningMember" "a"
                LEFT JOIN "User" "b" ON "a"."UserId"="b"."UserId"
                LEFT JOIN "UnitKerja" "c" ON "c"."UnitKerjaId"="b"."UnitKerjaId"
                WHERE "a"."AccountPlanningId"='. $AccountPlanningId .'';
        if (!empty($CreatedBy)) {
            $sql .= ' AND "a"."CreatedBy"=\''. $CreatedBy.'\'';
        }

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getMemberLists($memberSelected, $userId) {
        $sql = 'SELECT "a"."UserId", "a"."Name", "b"."Name" AS "UkerName"
                FROM "User" "a", UnitKerja b
                WHERE a.IsActive = 1 AND UserId <> \''.$userId.'\' 
                    AND A.UnitKerjaId=b.UnitKerjaId and b.SegmentId=1';
        if (!empty($memberSelected)) {
            $sql .= ' AND UserId NOT IN (';
            $selected = '';
            foreach ($memberSelected as $key => $value) {
                $selected .= "'".$value['UserId']."', ";
            }
            $sql .= substr($selected, 0, -2);
            $sql .= ')';
        }

        $results = $this->db->query($sql)->result_array();  

        return $results;
    }

    public function getCheckerSelected($AccountPlanningId, $CreatedBy) {
        $sql = 'SELECT "a"."UserId", "b"."Name" AS "CheckerName"
                FROM "AccountPlanningChecker" "a"
                LEFT JOIN "User" "b" ON "a"."UserId"="b"."UserId"
                WHERE "a"."AccountPlanningId"='. $AccountPlanningId .' AND "a"."CreatedBy"=\''. $CreatedBy.'\' AND "a"."IsActive"=1 ';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getChecker($UnitKerjaId, $memberSelected='') {
        $sql = 'SELECT "a"."UserId", "a"."Name" AS "CheckerName", "a"."RoleID"
                FROM "User" "a"
                WHERE 
                 RoleID IN (7, 8, 9) 
                --AND "a"."UnitKerjaId" ='. $UnitKerjaId .' 
                ';
        // echo $sql;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getSignerSelected($AccountPlanningId, $CreatedBy) {
        $sql = 'SELECT "a"."UserId", "b"."Name" AS "SignerName"
                FROM "AccountPlanningSigner" "a"
                LEFT JOIN "User" "b" ON "a"."UserId"="b"."UserId"
                WHERE "a"."AccountPlanningId"='. $AccountPlanningId .' AND "a"."CreatedBy"=\''. $CreatedBy.'\' AND "a"."IsActive"=1';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getSigner($UnitKerjaId, $memberSelected='') {
        $sql = 'SELECT "a"."UserId", "a"."Name" AS "SignerName", "a"."RoleID"
                FROM "User" "a"
                WHERE 
                 RoleID IN (7, 8, 9) 
                -- AND"a"."UnitKerjaId" ='. $UnitKerjaId .' 
                ';
        // echo $sql;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getBankList() {
        $sql = '
            SELECT BankId, Name, Logo
            FROM Bank 
            WHERE IsActive = 1
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getAccountPlanningFinancialHighlightItem($FinancialHighlightGroupId) {
        $sql = 'SELECT "a"."FinancialHighlightItemId", "a"."FinancialHighlightGroupId", "a"."Name" AS "FinancialHighlightItemName",
                "b"."Name" AS "FinancialHighlightGroupName"
                FROM "FinancialHighlightItem" "a"
                LEFT JOIN "FinancialHighlightGroup" "b" ON "a"."FinancialHighlightGroupId" = "b"."FinancialHighlightGroupId"
                WHERE "a"."IsActive" ='. 1 .' AND "a"."FinancialHighlightGroupId" = '. $FinancialHighlightGroupId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningBankFacilityItem($BankFacilityGroupId) {
        $sql = 'SELECT "a"."BankFacilityItemId", "a"."BankFacilityGroupId", "a"."Name" AS "BankFacilityItemName",
                "b"."Name" AS "BankFacilityGroupName"
                FROM "BankFacilityItem" "a"
                LEFT JOIN "BankFacilityGroup" "b" ON "a"."BankFacilityGroupId" = "b"."BankFacilityGroupId"
                WHERE "a"."IsActive" ='. 1 .' AND "a"."BankFacilityGroupId" = '. $BankFacilityGroupId;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningSimulationFeeItem() {
        $sql = 'SELECT "a"."FeeTypeId", "a"."Name" AS "FeeTypeName"
                FROM "FeeType" "a"
                WHERE "a"."IsActive" ='. 1;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getAccountPlanningOwner($AccountPlanningId) {
        $sql = '
            SELECT a.AccountPlanningOwnerId, a.UserId
                , b.Name AS RMName
            FROM AccountPlanningOwner a 
            LEFT JOIN [User] b ON a.UserId=b.UserId
            WHERE a.AccountPlanningId = '.$AccountPlanningId.' AND a.IsActive = 1
        ';

        $result = $this->db->query($sql)->row_array();  

        return $result;
    }

    public function getTotalViewTasklistAccountPlanning($UserId, $keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
            SELECT COUNT(*) AS "numrows" 
            FROM "AccountPlanningOwner" 
            WHERE UserId = \''.$UserId.'\' AND IsActive = 1
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result[0]['numrows'];
    }

    public function getViewTasklistAccountPlanning($UserId, $rowperpage, $rowno, $keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
            SELECT "k"."CreatedBy", "k"."AccountPlanningId", "k"."UserId" AS "RMId",
            "a"."Year", "a"."FinancialHighlightCurrency" AS "Currency", "a"."CreatedDate",
            "b"."VCIF", 
            "c"."Name" AS "CustomerName", "c"."CustomerGroupId", 
            --"d"."DocumentStatusId", 
            --"e"."Name" AS "Status",
            "g"."Name" AS "RMName",
            "h"."Name" AS "CustomerGroupName"

            FROM "AccountPlanningOwner" "k"
            LEFT JOIN "AccountPlanning" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "b" ON "k"."AccountPlanningId"="b"."AccountPlanningId" AND "b"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "c" ON "b"."VCIF"="c"."VCIF"
            --LEFT JOIN "AccountPlanningStatus" "d" ON "k"."AccountPlanningId"="d"."AccountPlanningId"
            --LEFT JOIN "DocumentStatus" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusId"
            LEFT JOIN "User" "g" ON "k"."UserId"="g"."UserId" AND "g"."IsActive"=1
            LEFT JOIN "CustomerGroup" "h" ON "c"."CustomerGroupId"="h"."CustomerGroupId"
            WHERE "k"."UserId" = \''.$UserId.'\'  AND "k"."IsActive" = 1
        ';

        $sql .= ' ORDER BY k.StartDate DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function insertDataFinancialHighlight($table, $data_input) {
        if(strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 18 || $data_input['FinancialHighlightItemId'] == 19 || $data_input['FinancialHighlightItemId'] == 20 || $data_input['FinancialHighlightItemId'] == 12 || $data_input['FinancialHighlightItemId'] == 22 || $data_input['FinancialHighlightItemId'] == 21)) {
            $result = array(
                'status' => 'success'
            );
        } else {
            $str = $this->db->insert($table, $data_input);
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
                //Operating Margin
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 9 || $data_input['FinancialHighlightItemId'] == 7)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 18
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 18, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when (isnull(sum(sales),0)=0) then 0
                                else round(sum(op_profit)/isnull(sum(sales),0)*100,2) end op_margin, 
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=9) then Amount else 0 end Op_Profit,
                                case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (9,7)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when (isnull(sum(sales),0)=0) then 0
                                    else round(sum(op_profit)/isnull(sum(sales),0)*100,2) end
                                from(
                                    select case when(FinancialHighlightItemId=9) then Amount else 0 end Op_Profit,
                                        case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (9,7)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=18";
                    }

                    $this->db->query($sql);
                }

                // Net Profit Margin
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 11 || $data_input['FinancialHighlightItemId'] == 7)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 19
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 19, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when (isnull(sum(sales),0)=0) then 0
                                else round(sum(Net_Profit)/isnull(sum(sales),0)*100,2) end profit_margin, 
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (11,7)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when (isnull(sum(sales),0)=0) then 0
                                    else round(sum(Net_Profit)/isnull(sum(sales),0)*100,2) end profit_margin
                                from(
                                    select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                        case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (11,7)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=19";
                    }

                    $this->db->query($sql);
                }

                // ROA
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 11 || $data_input['FinancialHighlightItemId'] == 3)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 20
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 20, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when (isnull(sum(tot_aset),0)=0) then 0
                                else round(sum(Net_Profit)/isnull(sum(tot_aset),0)*100,2) end roa, 
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                case when (FinancialHighlightItemId=3) then Amount else 0 end tot_aset
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (11,3)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when (isnull(sum(tot_aset),0)=0) then 0
                                    else round(sum(Net_Profit)/isnull(sum(tot_aset),0)*100,2) end roa
                                from(
                                    select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                        case when (FinancialHighlightItemId=3) then Amount else 0 end tot_aset
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (11,3)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=20";
                    }

                    $this->db->query($sql);
                }

                // Current Ratio
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 3 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 12
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 12, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when(isnull(sum(short_term_lia+long_term_lia),0)=0) then 0
                                else round(sum(tot_aset)/isnull(sum(short_term_lia+long_term_lia),0)*100,2) end cr, 
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (3,4,5)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when(isnull(sum(short_term_lia+long_term_lia),0)=0) then 0
                                    else round(sum(tot_aset)/isnull(sum(short_term_lia+long_term_lia),0)*100,2) end cr
                                from(
                                    select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                        case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                        case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (3,4,5)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=12";
                    }

                    $this->db->query($sql);
                }

                // DSCR 25 switch to Debt to total asset 21
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 6 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 21
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 21, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when (isnull(sum(equity),0)=0) then 0
                                else round(sum(short_term_lia+long_term_lia)/isnull(sum(equity),0)*100,2) end dscr, 
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=6) then Amount else 0 end equity,
                                case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (6,4,5)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when (isnull(sum(equity),0)=0) then 0
                                    else round(sum(short_term_lia+long_term_lia)/isnull(sum(equity),0)*100,2) end dscr
                                from(
                                    select case when(FinancialHighlightItemId=6) then Amount else 0 end equity,
                                        case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                        case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (6,4,5)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=21";
                    }

                    $this->db->query($sql);
                }

                // Debt to total asset
                if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 3 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                    $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                        WHERE FinancialHighlightItemId = 22
                            AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                            AND Year = '".$data_input['Year']."'";

                    $query = $this->db->query($sql)->row_array();
                    
                    if ($query['JML'] == 0) {
                        $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                            select 22, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                case when (isnull(sum(tot_aset),0)=0) then 0
                                else round(sum(short_term_lia+long_term_lia)/isnull(sum(tot_aset),0)*100,2) end debt_tot_aset,
                                sysdatetime(), '".$data_input['CreatedBy']."' 
                            from(
                            select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                            from FinancialHighlight
                            where AccountPlanningId=".$data_input['AccountPlanningId']."
                                and FinancialHighlightItemId in  (3,4,5)
                                and Year='".$data_input['Year']."'
                            ) tbl_a";
                    } else {
                        $sql = "UPDATE FinancialHighlight
                            SET Amount = (
                                select case when (isnull(sum(tot_aset),0)=0) then 0
                                    else round(sum(short_term_lia+long_term_lia)/isnull(sum(tot_aset),0)*100,2) end debt_tot_aset
                                from(
                                    select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                        case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                        case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                    from FinancialHighlight
                                    where AccountPlanningId=".$data_input['AccountPlanningId']."
                                        and FinancialHighlightItemId in  (3,4,5)
                                        and Year='".$data_input['Year']."'
                                ) tbl_a
                            ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                            WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                AND FinancialHighlightItemId=22";
                    }

                    $this->db->query($sql);
                }
            }
        }

        return $result;

    }

    public function moveVCIFAccountPlanning($srcAccountPlanningId, $VCIF, $destAccountPlanningId, $UserId) {
        $data = array(
            'srcAccountPlanningId'          => $srcAccountPlanningId, 
            'targetVCIF'                    => $VCIF, 
            'destAccountPlanningId'         => $destAccountPlanningId, 
            'UserId'                        => $UserId, 
            );

        $str = $this->db->query('transAccountPlanningMoveCustomer ?,?,?,?',$data);

        $error = $this->db->error();
        if($error['code']<>0) {
            $result = array(
                'moveStatus' => 'error',
                'moveMessage'=> $error['message']
            );
        } else {
            $result = array(
                'moveStatus' => 'success'
            );
        }
        return $result;

    }

    public function removeVCIFAccountPlanning($accountPlanningId, $VCIF, $UserId) {
        $data = array(
            'AccountPlanningId'     => $accountPlanningId, 
            'VCIF'                  => $VCIF, 
            'UserId'                => $UserId, 
            );

        $str = $this->db->query('transAccountPlanningRemoveCustomer ?,?,?',$data); 

        $error = $this->db->error();
        if($error['code']<>0) {
            $result = array(
                'removeStatus' => 'error',
                'removemoveMessage'=> $error['message']
            );
        } else {
            $result = array(
                'removeStatus' => 'success'
            );
        }
        return $result;

    }

    public function insertDataVCIF($table, $data_input) {

        $str = $this->db->insert($table, $data_input);
        // echo "<br>".$this->db->last_query(); //die();
        $error = $this->db->error();
        // print_r($error); die();
        if($error['code']<>0) {
            $result = array(
                'insertStatus' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'insertStatus' => 'success'
            );
        }

        return $result;
    }

    public function insertData($table, $data_input) {

        $str = $this->db->insert($table, $data_input);
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

    public function insertDataBankFacilities($table, $data_input, $data_type='') {

        $str = $this->db->insert($table, $data_input);
        $InputedId = $this->getInputedId();  
        // echo $this->db->last_query(); //die();
        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {

            if ($data_type == 'Addition') {
                $sql_wallet_share = '
                        INSERT INTO WalletShareAddition (
                            BankFacilityItemAdditionId
                            , AccountPlanningId
                            , VCIF
                            , BRINominalAddition
                            , TotalAmountAddition
                            , CreatedDate
                            , CreatedBy) 
                        VALUES(
                            '.$data_input['BankFacilityItemAdditionId'].'
                            , '.$data_input['AccountPlanningId'].'
                            , \''.$data_input['VCIF'].'\'
                            , (
                                SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                                FROM BankFacilityAddition
                                WHERE BankFacilityAdditionId = '.$InputedId.'    
                            )
                            , (
                                SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                                FROM BankFacilityAddition
                                WHERE BankFacilityAdditionId = '.$InputedId.'    
                            )
                            , \''.$data_input['CreatedDate'].'\'
                            , \''.$data_input['CreatedBy'].'\'
                        );
                    ';
            }
            else {
                $sql_wallet_share = '
                    INSERT INTO WalletShare (
                        BankFacilityItemId
                        , AccountPlanningId
                        , VCIF
                        , BRINominal
                        , TotalAmount
                        , CreatedDate
                        , CreatedBy) 
                    VALUES(
                        '.$data_input['BankFacilityItemId'].'
                        , '.$data_input['AccountPlanningId'].'
                        , \''.$data_input['VCIF'].'\'
                        , (
                            SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                            FROM BankFacility
                            WHERE BankFacilityId = '.$InputedId.'    
                        )
                        , (
                            SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                            FROM BankFacility
                            WHERE BankFacilityId = '.$InputedId.'    
                        )
                        , \''.$data_input['CreatedDate'].'\'
                        , \''.$data_input['CreatedBy'].'\'
                    );
                ';
            }

            $this->db->query($sql_wallet_share);

            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function updateDataBankFacilities($table, $data, $IDField, $IDValue, $WalletShareId, $data_type='') {

        $this->db->where($IDField, $IDValue);
        $str = $this->db->update($table, $data);
        // echo "<br>".$this->db->last_query(); 
        // die();

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            if ($data_type == 'Addition') {
                $sql_wallet_share = '
                    UPDATE "WalletShareAddition" SET 
                    "BRINominalAddition" = (
                        SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                        FROM BankFacilityAddition
                        WHERE BankFacilityAdditionId = '.$IDValue.'
                    ) 
                    , "TotalAmountAddition" = (
                        (
                            SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                            FROM BankFacilityAddition
                            WHERE BankFacilityAdditionId = '.$IDValue.'      
                        ) + (
                            SELECT ISNULL(OtherNominalAddition, 0)
                            FROM WalletShareAddition
                            WHERE WalletShareAdditionId = '.$WalletShareId.'
                        )
                    )
                    , "ModifiedDate" = \''.$data['ModifiedDate'].'\'
                    , "ModifiedBy" = \''.$data['ModifiedBy'].'\' 
                    WHERE "WalletShareAdditionId" = '.$WalletShareId.'
                ';
            }
            else {
                $sql_wallet_share = '
                    UPDATE "WalletShare" SET 
                    "BRINominal" = (
                        SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                        FROM BankFacility
                        WHERE BankFacilityId = '.$IDValue.'
                    ) 
                    , "TotalAmount" = (
                        (
                            SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                            FROM BankFacility
                            WHERE BankFacilityId = '.$IDValue.'      
                        ) + (
                            SELECT ISNULL(OtherNominal, 0)
                            FROM WalletShare
                            WHERE WalletShareId = '.$WalletShareId.'
                        )
                    )
                    , "ModifiedDate" = \''.$data['ModifiedDate'].'\'
                    , "ModifiedBy" = \''.$data['ModifiedBy'].'\' 
                    WHERE "WalletShareId" = '.$WalletShareId.'
                ';
            }

            // echo "<br>".$sql_wallet_share; die();
            $this->db->query($sql_wallet_share);

            $result = array(
                'status' => 'success'
            );
        }

        return $result;

    }  

    public function updateDataWalletShare($table, $data, $IDField, $IDValue, $data_type='') {
        if ($data_type == 'Addition') {
            $sql_wallet_share = '
                UPDATE "WalletShareAddition" SET 
                "OtherNominalAddition" = (
                    '.$data['TotalAmountAddition'].' - (
                        SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                        FROM BankFacilityAddition
                        WHERE BankFacilityAdditionId IN (
                            SELECT BankFacilityAdditionId
                            FROM BankFacilityAddition
                            WHERE AccountPlanningId = '.$data['AccountPlanningId'].'
                            AND BankFacilityItemAdditionId = '.$data['BankFacilityItemAdditionId'].'
                            AND VCIF = \''.$data['VCIF'].'\'
                        )
                    )
                )
                ,"BRINominalAddition" = (
                    SELECT ISNULL(IDRAmountAddition, 0) + ISNULL(ValasAmountAddition, 0)
                    FROM BankFacilityAddition
                    WHERE BankFacilityAdditionId IN (
                        SELECT BankFacilityAdditionId
                        FROM BankFacilityAddition
                        WHERE AccountPlanningId = '.$data['AccountPlanningId'].'
                        AND BankFacilityItemAdditionId = '.$data['BankFacilityItemAdditionId'].'
                        AND VCIF = \''.$data['VCIF'].'\'
                    )
                ) 
                , "TotalAmountAddition" = '.$data['TotalAmountAddition'].'
                , "ModifiedDate" = \''.$data['ModifiedDate'].'\'
                , "ModifiedBy" = \''.$data['ModifiedBy'].'\' 
                WHERE "WalletShareAdditionId" = '.$IDValue.'
            ';
        }
        else {
            $sql_wallet_share = '
                UPDATE "WalletShare" SET 
                "OtherNominal" = (
                    '.$data['TotalAmount'].' - (
                        SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                        FROM BankFacility
                        WHERE BankFacilityId IN (
                            SELECT BankFacilityId
                            FROM BankFacility
                            WHERE AccountPlanningId = '.$data['AccountPlanningId'].'
                            AND BankFacilityItemId = '.$data['BankFacilityItemId'].'
                            AND VCIF = \''.$data['VCIF'].'\'
                        )
                    )
                )
                ,"BRINominal" = (
                    SELECT ISNULL(IDRAmount, 0) + ISNULL(ValasAmount, 0)
                    FROM BankFacility
                    WHERE BankFacilityId IN (
                        SELECT BankFacilityId
                        FROM BankFacility
                        WHERE AccountPlanningId = '.$data['AccountPlanningId'].'
                        AND BankFacilityItemId = '.$data['BankFacilityItemId'].'
                        AND VCIF = \''.$data['VCIF'].'\'
                    )
                )
                , "TotalAmount" = '.$data['TotalAmount'].'
                , "ModifiedDate" = \''.$data['ModifiedDate'].'\'
                , "ModifiedBy" = \''.$data['ModifiedBy'].'\' 
                WHERE "WalletShareId" = '.$IDValue.'
            ';
        }

        // echo "<br>".$sql_wallet_share; die();
        $this->db->query($sql_wallet_share);

        $error = $this->db->error();

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

    public function updateData($table, $data, $IDField, $IDValue, $IDField2='', $IDValue2='') {

        $this->db->where($IDField, $IDValue);
        if (!empty($IDField2) && !empty($IDValue2)) {
            $this->db->where($IDField2, $IDValue2);
        }
        $str = $this->db->update($table, $data);

        // echo "<br>".$this->db->last_query(); 
        // die();

        $error = $this->db->error();

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


    public function updateDataManageVCIF($table, $data, $AccountPlanningId, $VCIF) {

        $this->db->where('AccountPlanningId', $AccountPlanningId);
        $this->db->where('VCIF', $VCIF);
        $str = $this->db->update($table, $data);
        // echo "<br>".$this->db->last_query(); 
        // die();

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'updateStatus' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'updateStatus' => 'success'
            );
        }

        return $result;

    }    

    public function insertDataGetInputedId($table, $data_input) {

        $str = $this->db->insert($table, $data_input);
        $InputedId = $this->getInputedId();  
        return $InputedId;

    }

    public function updateDataFinancialHighlight($table, $data_input, $IDField, $IDValue) {

        if(strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 18 || $data_input['FinancialHighlightItemId'] == 19 || $data_input['FinancialHighlightItemId'] == 20 || $data_input['FinancialHighlightItemId'] == 12 || $data_input['FinancialHighlightItemId'] == 21 || $data_input['FinancialHighlightItemId'] == 22)) {
            $result = array(
                'status' => 'success'
            );
        } else {
            $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                    WHERE FinancialHighlightItemId = ".$data_input['FinancialHighlightItemId']."
                        AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                        AND Year = '".$data_input['Year']."'";

                $query = $this->db->query($sql)->row_array();

            if ($query['JML'] == 0) {
                $result = $this->insertData($table, $data_input);
            } else {

                $this->db->where($IDField, $IDValue);
                $str = $this->db->update($table, $data_input);
                // echo "<br>".$this->db->last_query(); //die();

                $error = $this->db->error();

                if($error['code']<>0) {
                    $result = array(
                        'status' => 'error',
                        'message'=> $error['message']
                    );
                } else {
                    $result = array(
                        'status' => 'success'
                    );

                    //Operating Margin
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 9 || $data_input['FinancialHighlightItemId'] == 7)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 18
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 18, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when (isnull(sum(sales),0)=0) then 0
                                    else round(sum(op_profit)/isnull(sum(sales),0)*100,2) end op_margin, 
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=9) then Amount else 0 end Op_Profit,
                                    case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (9,7)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when (isnull(sum(sales),0)=0) then 0
                                        else round(sum(op_profit)/isnull(sum(sales),0)*100,2) end
                                    from(
                                        select case when(FinancialHighlightItemId=9) then Amount else 0 end Op_Profit,
                                            case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (9,7)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=18";
                        }

                        $this->db->query($sql);
                    }

                    // Net Profit Margin
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 11 || $data_input['FinancialHighlightItemId'] == 7)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 19
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 19, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when (isnull(sum(sales),0)=0) then 0
                                    else round(sum(Net_Profit)/isnull(sum(sales),0)*100,2) end profit_margin, 
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                    case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (11,7)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when (isnull(sum(sales),0)=0) then 0
                                        else round(sum(Net_Profit)/isnull(sum(sales),0)*100,2) end profit_margin
                                    from(
                                        select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                            case when (FinancialHighlightItemId=7) then Amount else 0 end Sales
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (11,7)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=19";
                        }

                        $this->db->query($sql);
                    }

                    // ROA
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 11 || $data_input['FinancialHighlightItemId'] == 3)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 20
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 20, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when (isnull(sum(tot_aset),0)=0) then 0
                                    else round(sum(Net_Profit)/isnull(sum(tot_aset),0)*100,2) end roa, 
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                    case when (FinancialHighlightItemId=3) then Amount else 0 end tot_aset
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (11,3)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when (isnull(sum(tot_aset),0)=0) then 0
                                        else round(sum(Net_Profit)/isnull(sum(tot_aset),0)*100,2) end roa
                                    from(
                                        select case when(FinancialHighlightItemId=11) then Amount else 0 end Net_Profit,
                                            case when (FinancialHighlightItemId=3) then Amount else 0 end tot_aset
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (11,3)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=20";
                        }

                        $this->db->query($sql);
                    }

                    // Current Ratio
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 3 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 12
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 12, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when(isnull(sum(short_term_lia+long_term_lia),0)=0) then 0
                                    else round(sum(tot_aset)/isnull(sum(short_term_lia+long_term_lia),0)*100,2) end cr, 
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                    case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                    case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (3,4,5)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when(isnull(sum(short_term_lia+long_term_lia),0)=0) then 0
                                        else round(sum(tot_aset)/isnull(sum(short_term_lia+long_term_lia),0)*100,2) end cr
                                    from(
                                        select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                            case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                            case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (3,4,5)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=12";
                        }

                        $this->db->query($sql);
                    }

                    // DSCR 25 switch to Debt to total asset 21
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 6 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 21
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 21, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when (isnull(sum(equity),0)=0) then 0
                                    else round(sum(short_term_lia+long_term_lia)/isnull(sum(equity),0)*100,2) end dscr, 
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=6) then Amount else 0 end equity,
                                    case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                    case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (6,4,5)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when (isnull(sum(equity),0)=0) then 0
                                        else round(sum(short_term_lia+long_term_lia)/isnull(sum(equity),0)*100,2) end dscr
                                    from(
                                        select case when(FinancialHighlightItemId=6) then Amount else 0 end equity,
                                            case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                            case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (6,4,5)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=21";
                        }

                        $this->db->query($sql);
                    }

                    // Debt to total asset
                    if (strtolower($table) == 'financialhighlight' && ($data_input['FinancialHighlightItemId'] == 3 || $data_input['FinancialHighlightItemId'] == 4 || $data_input['FinancialHighlightItemId'] == 5)) {
                        $sql = "SELECT COUNT(1) JML FROM FinancialHighlight 
                            WHERE FinancialHighlightItemId = 22
                                AND AccountPlanningId = ".$data_input['AccountPlanningId']."
                                AND Year = '".$data_input['Year']."'";

                        $query = $this->db->query($sql)->row_array();
                        
                        if ($query['JML'] == 0) {
                            $sql = "INSERT INTO FinancialHighlight(FinancialHighlightItemId, AccountPlanningId, Year, Amount, CreatedDate, CreatedBy)
                                select 22, ".$data_input['AccountPlanningId'].", '".$data_input['Year']."', 
                                    case when (isnull(sum(tot_aset),0)=0) then 0
                                    else round(sum(short_term_lia+long_term_lia)/isnull(sum(tot_aset),0)*100,2) end debt_tot_aset,
                                    sysdatetime(), '".$data_input['CreatedBy']."' 
                                from(
                                select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                    case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                    case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                from FinancialHighlight
                                where AccountPlanningId=".$data_input['AccountPlanningId']."
                                    and FinancialHighlightItemId in  (3,4,5)
                                    and Year='".$data_input['Year']."'
                                ) tbl_a";
                        } else {
                            $sql = "UPDATE FinancialHighlight
                                SET Amount = (
                                    select case when (isnull(sum(tot_aset),0)=0) then 0
                                        else round(sum(short_term_lia+long_term_lia)/isnull(sum(tot_aset),0)*100,2) end debt_tot_aset
                                    from(
                                        select case when(FinancialHighlightItemId=3) then Amount else 0 end tot_aset,
                                            case when (FinancialHighlightItemId=4) then Amount else 0 end short_term_lia,
                                            case when (FinancialHighlightItemId=5) then Amount else 0 end long_term_lia
                                        from FinancialHighlight
                                        where AccountPlanningId=".$data_input['AccountPlanningId']."
                                            and FinancialHighlightItemId in  (3,4,5)
                                            and Year='".$data_input['Year']."'
                                    ) tbl_a
                                ), ModifiedDate = SYSDATETIME(), ModifiedBy = '".$data_input['CreatedBy']."'
                                WHERE AccountPlanningId=".$data_input['AccountPlanningId']." AND Year='".$data_input['Year']."'
                                    AND FinancialHighlightItemId=22";
                        }

                        $this->db->query($sql);
                    }
                }
            }
        }

        return $result;

    }

    public function deleteData($table, $data_delete) {

        $str = $this->db->delete($table, $data_delete);

    }

    public function getInputedId() {
        $sql = "SELECT SCOPE_IDENTITY() AS InputedId;";
        $result = $this->db->query($sql)->result_array();   

        return $result[0]['InputedId'];
    }

    public function insertMemberPerRM($AccountPlanningId, $UserId, $CreatedBy) {
        $data = array(
            'AccountPlanningId'     => $AccountPlanningId, 
            'UserId'                => $UserId, 
            'CreatedDate'           => $this->current_datetime, 
            'CreatedBy'             => $CreatedBy, 
            );

        $str = $this->db->insert('AccountPlanningMember', $data);

        // $str = $this->db->query('AccountPlanningMember ?,?,?,?',$data);

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

    public function insertCheckerSignerPerRM($Table, $data) {

        $str = $this->db->insert($Table, $data);

        $error = $this->db->error();

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

    /*
        Start Script From Irvan 
    */
    public function getAccountPlanningGroupOverview($AccountPlanningId, $VCIF = NULL) {
        $whereClause = "";
        if($VCIF != NULL){
            $whereClause .= " AND a.VCIF = '".$VCIF."'";
        }
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
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId .$whereClause;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }
    public function getAccountPlanningFileStructure($AccountPlanningId, $StructureTypeId, $VCIF = NULL){
        $whereClause = "";
        if($StructureTypeId == 1 || $StructureTypeId == 3){
            $whereClause .= " AND t1.VCIF IS NOT NULL ";
        }
        if($VCIF != NULL){
            $whereClause .= " AND t1.VCIF = '".$VCIF."'";
        }
        $sql = "SELECT t1.FilePath, t1.VCIF, t2.Name
                FROM FileStructure t1
                LEFT JOIN CustomerKorporasi t2 ON t1.VCIF = t2.VCIF
                WHERE t1.AccountPlanningId = ".$AccountPlanningId." AND t1.StructureTypeId = ".$StructureTypeId. $whereClause;
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function uploadBusinessProcessOrganization($data){
        $isCommit = 1;
        $this->db->trans_begin();

        switch($data['StructureTypeId']){
            case 1:
                $arrayWhere = array('AccountPlanningId' => $data["AccountPlanningId"], 
                                    'StructureTypeId' => $data['StructureTypeId'],
                                    'VCIF' => $data['VCIF']);
                break;
            case 2:
                $arrayWhere = array('AccountPlanningId' => $data["AccountPlanningId"], 
                                    'StructureTypeId' => $data['StructureTypeId']);
                break;
            case 3:
                $arrayWhere = array('AccountPlanningId' => $data["AccountPlanningId"], 
                                    'StructureTypeId' => $data['StructureTypeId'],
                                    'VCIF' => $data['VCIF']);
                break;
        }

        $this->db->delete('FileStructure', $arrayWhere);
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        $dataPost = array(
            'StructureTypeId' => $data['StructureTypeId'],
            'AccountPlanningId' => $data['AccountPlanningId'],
            'VCIF' => $data['VCIF'],
            'FilePath' => $data['FilePath'],
            'Size' => $data['Size'],
            'Type' => $data['Type'],
            'CreatedBy' => $data['createdBy'],
            'CreatedDate' => $this->created_date
        );
        $this->db->insert('FileStructure', $dataPost);
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        //Commit Transaction
		if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
            $this->db->trans_commit();
            return 1;
		}
    }
    public function updateCoverageMapping($data){
        $isCommit = 1;
        $this->db->trans_begin();

        $this->db->delete('CoverageMapping', array('AccountPlanningId' => $data["accountPlanningId"], 'VCIF' => $data['vcif']));
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        if($data['jumlahCoverageMapping'] > 0){
            $arrCoverageMapping = array();
            foreach($data['arrCoverageMapping'] as $rows){
                $dataPost = array(
                            'AccountPlanningId' => $data['accountPlanningId'],
                            'VCIF' => $data['vcif'],
                            'ClientName' => $rows['ClientName'],
                            'ContactNumber' => $rows['ContactNumber'],
                            'ClientPosition' => $rows['ClientPosition'],
                            'BankPerson' => $rows['BankPerson'],
                            'BankContact' => $rows['BankContact'],
                            'BankPosition' => $rows['BankPosition'],
                            'OtherInformation' => $rows['OtherInformation'],
                            'CreatedBy' => $data['createdBy'],
                            'CreatedDate' => $this->created_date
                        );
                array_push($arrCoverageMapping, $dataPost);
            }

            $this->db->insert_batch('CoverageMapping', $arrCoverageMapping);
            if ($this->db->trans_status() === FALSE){
                $isCommit = 0;
            }
        }

        //Commit Transaction
		if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
            $this->db->trans_commit();
            return 1;
		}
    }
    public function getAccountPlanningCoverageMapping($AccountPlanningId, $VCIF) {
        $sql = "SELECT ClientPosition, ClientName, ContactNumber, OtherInformation, BankPosition, BankPerson, BankContact, Description
                FROM CoverageMapping
                WHERE AccountPlanningId = ".$AccountPlanningId." AND VCIF = '".$VCIF."'";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function updateStrategicPlan($data){
        $isCommit = 1;
        $this->db->trans_begin();

        $this->db->delete('StrategicPlan', array('AccountPlanningId' => $data["accountPlanningId"], 'VCIF' => $data['vcif']));
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        if($data['jumlahStrategicPlan'] > 0){
            $arrStrategicPlan = array();
            foreach($data['arrStrategicPlan'] as $rows){
                $dataPost = array(
                            'VCIF' => $data['vcif'],
                            'AccountPlanningId' => $data['accountPlanningId'],
                            'StrategicPlanTypeId' => $rows['StrategicPlanTypeId'],
                            'Name' => $rows['Name'],
                            'CreatedBy' => $data['createdBy'],
                            'CreatedDate' => $this->created_date
                        );
                array_push($arrStrategicPlan, $dataPost);
            }

            $this->db->insert_batch('StrategicPlan', $arrStrategicPlan);
            if ($this->db->trans_status() === FALSE){
                $isCommit = 0;
            }
        }

        //Commit Transaction
		if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
            $this->db->trans_commit();
            return 1;
		}
    }
    public function getAccountPlanningStrategicPlan($AccountPlanningId, $VCIF, $StrategicPlanTypeId = NULL) {
        $whereClause = '';
        if($StrategicPlanTypeId != NULL){
            $whereClause .= " AND StrategicPlanTypeId =". $StrategicPlanTypeId;
        }
        $sql = "SELECT t1.StrategicPlanTypeId, t2.Name AS StrategicPlanTypeName, t1.Name
                FROM StrategicPlan t1
                LEFT JOIN StrategicPlanType t2 ON t1.StrategicPlanTypeId = t2.StrategicPlanTypeId
                WHERE t1.AccountPlanningId = ".$AccountPlanningId ."
                AND t1.VCIF = '".$VCIF."' ".$whereClause." ORDER BY t1.StrategicPlanTypeId";

        $result = $this->db->query($sql)->result();

        return $result;
    }
    public function updateShareholders($data){
        $isCommit = 1;
        $this->db->trans_begin();

        $this->db->delete('Shareholder', array('AccountPlanningId' => $data["accountPlanningId"]));
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        if($data['jumlahShareholders'] > 0){
            $arrShareholders = array();
            foreach($data['arrShareholders'] as $rows){
                $dataPost = array(
                            'AccountPlanningId' => $data['accountPlanningId'],
                            'Name' => $rows['Name'],
                            'Quantity' => $rows['Value'],
                            'LoadFrom' => 3,
                            'CreatedBy' => $data['createdBy'],
                            'CreatedDate' => $this->created_date
                        );
                array_push($arrShareholders, $dataPost);
            }

            $this->db->insert_batch('Shareholder', $arrShareholders);
            if ($this->db->trans_status() === FALSE){
                $isCommit = 0;
            }
        }

        //Commit Transaction
		if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
            $this->db->trans_commit();
            return 1;
		}
    }
    public function getGroupOverviewInformation($VCIF) {
        $sql = "SELECT a.GroupOverviewId, a.Address1, a.Address2, a.Address3, a.Address1, a.IndustryName, 
                    a.ProvinceId, a.GlobalRatingId, a.DomesticRatingId,a.IndustryTrendId,a.LifeCycleId,
                    b.Name AS Province,
                    c.Name AS GlobalRatingName, c.Description AS GlobalRatingDescription, 
                    d.Name AS DomesticRating,
                    e.Name AS LifeCycle,
                    f.Name AS ChildCompanyName,
                    g.Name AS IndustryTrend
                FROM CustomerKorporasi f
                LEFT JOIN GroupOverview a on a.VCIF=f.VCIF 
                LEFT JOIN Province b on a.ProvinceId=b.ProvinceId AND b.IsActive=1
                LEFT JOIN GlobalRating c on a.GlobalRatingId=c.GlobalRatingId AND c.IsActive=1
                LEFT JOIN DomesticRating d on a.DomesticRatingId=d.DomesticRatingId AND d.IsActive=1
                LEFT JOIN LifeCycle e on a.LifeCycleId=e.LifeCycleId AND e.IsActive=1
                LEFT JOIN IndustryTrend g on a.IndustryTrendId=g.IndustryTrendId AND g.IsActive=1
                WHERE a.VCIF = '". $VCIF."'";
        $this->db->limit(1);
        $result = $this->db->query($sql)->result();
        if(!empty($result)){
            return $result[0];
        }else return $result;        
    }
    public function updateGroupOverview($data){
        $isCommit = 1;
        $this->db->trans_begin();

        $arrayWhere = array('AccountPlanningId' => $data["accountPlanningId"],
                            'VCIF' => $data['VCIF']);
        $this->db->delete('GroupOverview', $arrayWhere);
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }

        $row = array(
            'AccountPlanningId' => $data["accountPlanningId"],
            'VCIF' => $data['VCIF'],
            'Address1' => $data['address'],
            'ProvinceId' => $data['provinceId'],
            'GlobalRatingId' => $data['globalRatingId'],
            'DomesticRatingId' => $data['domesticRatingId'],
            'IndustryName' => $data['industry'],
            'IndustryTrendId' => $data['industryTrendId'],
            'LifeCycleId' => $data['lifeCycleId'],
            'CreatedBy' => $data['createdBy']
        );
        $this->db->insert('GroupOverview', $row);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
			return 0;
        }else{
            $this->db->trans_commit();
			return 1;
        }
    }
    public function getStrategicPlanTypeOption(){
        $this->db->select('StrategicPlanTypeId, Name');
        $this->db->from('StrategicPlanType');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getSelectedCompanyOption($AccountPlanningId){
        $this->db->select('t1.VCIF, t1.IsMain, t2.Name');
        $this->db->from('AccountPlanningCustomer t1');
        $this->db->join('CustomerKorporasi t2','t1.VCIF = t2.VCIF','left');
        $this->db->where('t1.AccountPlanningId',$AccountPlanningId);
        $this->db->order_by("t1.IsMain DESC, t2.Name ASC");
        $result = $this->db->get()->result();
        return $result;
    }
    public function getCompanyInformation($VCIF){
        $this->db->select('*');
        $this->db->from('CustomerKorporasi');
        $this->db->where('VCIF',$VCIF);
        $this->db->limit(1);
        $result = $this->db->get()->result();
        return $result[0];
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
        $this->db->order_by('Name','asc');
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
    public function getDomesticRatingOption(){
        $this->db->select('DomesticRatingId, Name');
        $this->db->from('DomesticRating');
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getGlobalRatingOption(){
        $this->db->select('GlobalRatingId, Name');
        $this->db->from('GlobalRating');
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getGlobalRatingDescription($globalRatingId){
        $this->db->select('Description');
        $this->db->from('GlobalRating');
        $this->db->where('GlobalRatingId',$globalRatingId);
        $this->db->limit(1);
        $result = $this->db->get()->result();
        return $result[0]->Description;
    }
    public function getCIF($VCIF){
        $this->db->select('CIF, Name');
        $this->db->from('DetailCustomerKorporasi');
        $this->db->where('VCIF', $VCIF);
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }
    public function getCustomerInformation($VCIF){
        $this->db->select('Name');
        $this->db->from('CustomerKorporasi');
        $this->db->where('VCIF', $VCIF);
        $this->db->limit(1);
        $result = $this->db->get()->result();
        return $result[0]->Name;
    }
    public function getCSTMember($AccountPlanningId){
        $this->db->select("t1.CreatedDate, t2.Name AS UserName, t2.Title, t2.ProfilePicture, t3.Name AS UkerName");
        $this->db->from("AccountPlanningMember t1");
        $this->db->join("User t2","t1.UserId = t2.UserId","left");
        $this->db->join("UnitKerja t3","t2.UnitKerjaId = t3.UnitKerjaId","left");
        $this->db->where("t1.AccountPlanningId", $AccountPlanningId);
        $result = $this->db->get()->result();
        return $result;
    }
    public function getTotalMyAccountPlanningMenengah($userId, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningMenengahId = A.AccountPlanningMenengahId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND D.CustomerName LIKE '%".$searchTxt."'";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningMenengahId, A.CreatedDate, A.[Year],
                D.CIF, D.CustomerName, E.Name RMName
            FROM AccountPlanningMenengah A, AccountPlanningMenengahOwner B,
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
    public function getMyAccountPlanningMenengah($userId, $rowperpage, $rowno, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningMenengahId = A.AccountPlanningMenengahId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND D.CustomerName LIKE '%".$searchTxt."'";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "SELECT A.AccountPlanningMenengahId, A.CreatedDate, A.[Year],
                D.CIF, D.CustomerName, E.Name RMName
            FROM AccountPlanningMenengah A, AccountPlanningMenengahOwner B,
                 CustomerMenengah D, [User] E ".$tblFilter."
            WHERE A.AccountPlanningMenengahId=B.AccountPlanningMenengahId
                AND A.CIF = D.CIF 
                AND E.UserId = B.UserId
                AND B.IsActive=1 ".$filter."
                ORDER BY A.CreatedDate DESC OFFSET ".$rowno." ROWS FETCH NEXT ".$rowperpage." ROWS ONLY
        ";

        $result = $this->db->query($sql);
        return $result->result_array();
    }
    /*
        End Script From Irvan
    */

    /* Script Andre */
    public function getTotalMyAccountPlanning($userId, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%".$searchTxt."%' OR Y.VCIF LIKE '%".$searchTxt."%')
                )";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningId, A.CreatedDate, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F ".$tblFilter."
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 ".$filter."
            ) Tbl
        ";
        // echo $sql;
        $result = $this->db->query($sql)->row_array();

        return $result['Total'];
    }

    public function getTotalMyAccountPlanningCst($userId, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%".$searchTxt."%' OR Y.VCIF LIKE '%".$searchTxt."%')
                )";
        }

        /*if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }*/

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningId, A.CreatedDate, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F, AccountPlanningMember H ".$tblFilter."
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                -- AND B.IsActive=1
                AND C.IsMain=1 
                AND A.AccountPlanningId = H.AccountPlanningId
                AND H.UserId = '".$userId."'
                ".$filter."
            ) Tbl
        ";

        // echo $sql;

        $result = $this->db->query($sql)->row_array();

        return $result['Total'];
    }

    public function getMyAccountPlanning($userId, $rowperpage, $rowno, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }
        elseif(!empty($year) && $year == 'all'){
            $filter .= " AND A.Year IN (".$this->current_year."-1, ".$this->current_year.")";
        }

        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%".$searchTxt."%' OR Y.VCIF LIKE '%".$searchTxt."%')
                )";
        }

        if(!empty($userId)) {
            $filter .= " AND B.UserId='".$userId."'  ";
        }

        $sql = "
            SELECT A.AccountPlanningId, A.CreatedDate, A.CreatedBy, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F ".$tblFilter."
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 ".$filter."
            ORDER BY A.CreatedDate DESC OFFSET ".$rowno." ROWS FETCH NEXT ".$rowperpage." ROWS ONLY
        ";
        // echo $sql;
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function getMyAccountPlanningCst($userId, $rowperpage, $rowno, $year='', $docStatusId='', $searchTxt=''){
        $filter = '';
        $tblFilter = '';
        if(!empty($year) && $year <> 'all'){
            $filter .= " AND A.Year='".$year."'";
        }
        elseif(!empty($year) && $year == 'all'){
            $filter .= " AND A.Year IN (".$this->current_year."-1, ".$this->current_year.")";
        }


        if(!empty($docStatusId) && $docStatusId <> 'all'){
            $tblFilter = ", AccountPlanningStatus G ";
            $filter .= " AND G.DocumentStatusId=".$docStatusId." AND G.AccountPlanningStatusId = (
                SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus
                WHERE AccountPlanningId = A.AccountPlanningId) ";
        }

        if(!empty($searchTxt)){
            $filter .= " AND A.AccountPlanningId IN (
                    SELECT X.AccountPlanningId
                    FROM AccountPlanningCustomer X, CustomerKorporasi Y
                    WHERE X.VCIF=Y.VCIF
                        AND (Y.NAME LIKE '%".$searchTxt."%' OR Y.VCIF LIKE '%".$searchTxt."%')
                )";
        }

        // if(!empty($userId)) {
        //     $filter .= " AND B.UserId='".$userId."'  ";
        // }

        $sql = "
            SELECT A.AccountPlanningId, A.CreatedDate, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F, AccountPlanningMember H ".$tblFilter."
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                -- AND B.IsActive=1
                AND C.IsMain=1 
                AND A.AccountPlanningId = H.AccountPlanningId
                AND H.UserId = '".$userId."'
                ".$filter."
            ORDER BY H.CreatedDate DESC OFFSET ".$rowno." ROWS FETCH NEXT ".$rowperpage." ROWS ONLY
        ";

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    public function addMemberAccountPlanning($accountPlanningId, $UserId, $CreatedBy) {
        $data = array(
            'AccountPlanningId'     => $accountPlanningId, 
            'UserId'                => $UserId, 
            'CreatedBy'             => $CreatedBy, 
            );

        $str = $this->db->query('transAccountPlanningAddMember ?,?,?',$data);

        $error = $this->db->error();
        if($error['code']<>0) {
            $result = array(
                'insertStatus' => 'error',
                'insertMessage'=> $error['message']
            );
        } else {
            $result = array(
                'insertStatus' => 'success'
            );
        }

         return $result;

    }

    public function removeMemberAccountPlanning($accountPlanningId, $UserId, $CreatedBy) {
        $data = array(
            'AccountPlanningId'     => $accountPlanningId, 
            'UserId'                => $UserId, 
            'CreatedBy'             => $CreatedBy, 
            );

        $str = $this->db->query('transAccountPlanningRemoveMember ?,?,?',$data);

        $error = $this->db->error();
        if($error['code']<>0) {
            $result = array(
                'removeStatus' => 'error',
                'removeMessage'=> $error['message']
            );
        } else {
            $result = array(
                'removeStatus' => 'success'
            );
        }

         return $result;

    }

    public function insertAccountPlanningActivity($accountPlanningId, $activity, $message, $userId){
        $sql = "INSERT INTO AccountPlanningActivity(AccountPlanningId, Activity, Message, CreatedBy, CreatedDate)
                VALUES(".$accountPlanningId.", '".$activity."', '".$message."', '".$userId."', SYSDATETIME())";

        $result = $this->db->query($sql);

        return $result;
    }
}

?>
