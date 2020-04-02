<?php

class Leaderboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
    }

    public function getClassification() {
        $sql = '
            SELECT ClassificationId, Name FROM Classification Where IsActive=1  
        ';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getLoanSegment() {
        $sql = 'SELECT A.SektorEkonomiRarocId, A.Name SegmentName, A.Description, A.AmountEL, A.AmountEAD, A.CreatedDate, A.ModifiedDate, A.IsActive
                , B.Name CreatedBy
                , C.Name ModifiedBy
                FROM SektorEkonomiRaroc A
                LEFT JOIN [User] B ON A.CreatedBy=B.UserId
                LEFT JOIN [User] C ON A.ModifiedBy=C.UserId
                WHERE A.IsActive=1';

        $result = $this->db->query($sql)->result();  

        return $result;
    }

    public function getLoanSegmentDetails($SektorEkonomiRarocId) {
        $sql = 'SELECT A.SektorEkonomiRarocId, A.Name SegmentName, A.Description, A.AmountEL, A.AmountEAD, A.CreatedDate, A.ModifiedDate, A.IsActive
                , B.Name CreatedBy
                , C.Name ModifiedBy
                FROM SektorEkonomiRaroc A
                LEFT JOIN [User] B ON A.CreatedBy=B.UserId
                LEFT JOIN [User] C ON A.ModifiedBy=C.UserId
                WHERE A.IsActive=1 AND SektorEkonomiRarocId='.$SektorEkonomiRarocId;

        $result = $this->db->query($sql)->row_array();  

        return $result;
    }

    public function countCustomerLoanSegment() {
        $sql = "
            SELECT 
            Raroc1, Raroc1Name 
            , Raroc2, Raroc2Name 
            , Raroc3, Raroc3Name 
            , Raroc4, Raroc4Name 
            , Raroc5, Raroc5Name 
            , Raroc6, Raroc6Name 
            , (Raroc1+Raroc2+Raroc3+Raroc4+Raroc5+Raroc6) TotalRaroc
            FROM
            (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc1
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=1) Raroc1Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=1
            ) Raroc1
            , (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc2
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=2) Raroc2Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=2
            ) Raroc2
            , (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc3
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=3) Raroc3Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=3
            ) Raroc3
            , (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc4
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=4) Raroc4Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=4
            ) Raroc4
            , (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc5
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=5) Raroc5Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=5
            ) Raroc5
            , (
                SELECT COUNT(a.SektorEkonomiRaroc) Raroc6
                , (SELECT s.Name FROM SektorEkonomiRaroc s WHERE s.SektorEkonomiRarocId=6) Raroc6Name 
                FROM Summary_PinjamanMonthlyCustomer a WHERE a.SektorEkonomiRaroc=6
            ) Raroc6

            ";
        // echo $sql;
        $result = $this->db->query($sql)->row_array();  

        return $result;
    }

    public function countCustomerGroupClassification() {
        $sql = "
            SELECT * FROM
            (
            Select count(CustomerGroupId) Platinum From CustomerGroup Where ClassificationId=1
            ) A
            , (
            Select count(CustomerGroupId) Gold From CustomerGroup Where ClassificationId=2
            ) B
            , (
            Select count(CustomerGroupId) Silver From CustomerGroup Where ClassificationId=3
            ) C
            , (
            Select count(CustomerGroupId) Bronze From CustomerGroup Where ClassificationId=4
            ) D
        ";
        $result = $this->db->query($sql)->row_array();  

        return $result;
    }

    public function getTotalCustomerGroupByClassification($ClassificationId) {
        $sql = "SELECT COUNT(1) numrows
                FROM CustomerGroup A
                WHERE ClassificationId=".$ClassificationId." ";

        $result = $this->db->query($sql)->row_array();  

        return $result['numrows'];
    }

    public function getCustomerGroupByClassification($ClassificationId) {
        $sql = "SELECT CustomerGroupId, Name CustomerGroupName, Logo 
                FROM CustomerGroup A
                WHERE ClassificationId=".$ClassificationId." ";
        // $sql .= ' ORDER BY a.Name ASC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getViewCustomerTopBottomList($rowperpage, $rowno, $sort_by='TotalSimpanan', $sort='DESC') {
        $sql = "
        SELECT Z.CustomerGroupId CustomerGroupId, Z.Name CustomerGroupName, Z.Logo 
        , (
                SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                FROM Summary_PinjamanDailyCustomer
                WHERE Vcif IN(
                    SELECT b.VCIF
                    FROM CustomerGroup a, CustomerKorporasi b
                    WHERE a.CustomerGroupId=b.CustomerGroupId
                        AND a.CustomerGroupId=Z.CustomerGroupId
                )
                AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
            ) TotalPinjaman
         , (
                SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                FROM Summary_PinjamanMonthlyCustomer
                WHERE Vcif IN(
                    SELECT c.VCIF
                    FROM CustomerGroup d, CustomerKorporasi c
                    WHERE d.CustomerGroupId=c.CustomerGroupId
                        AND d.CustomerGroupId=Z.CustomerGroupId
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanMonthlyCustomer)
            ) RatasPinjaman  
        , (
                SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                FROM Summary_SimpananDailyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=Z.CustomerGroupId
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
            ) TotalSimpanan
        , (
                SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                FROM Summary_SimpananMonthlyCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=Z.CustomerGroupId
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
        ) RatasSimpanan  
        , (
                SELECT ISNULL(SUM(LabaRugiFtpSetelahModal),0) Cpa
                FROM Summary_CpaCustomer
                WHERE Vcif IN(
                    SELECT B.VCIF
                    FROM CustomerGroup A, CustomerKorporasi B
                    WHERE A.CustomerGroupId=B.CustomerGroupId
                        AND A.CustomerGroupId=Z.CustomerGroupId
                )
                    AND Periode = (SELECT MAX(Periode) FROM Summary_CpaCustomer)
        )  Cpa 
        , 0 RoRa    
        , 0 Raroc    

        FROM CustomerGroup Z
        WHERE 1=1

        ";

        $sql .= ' ORDER BY '.$sort_by.' '.$sort.' OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';

        // echo $sql;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewRmLeaderboard($searchTxt = '', $uker_search = '') {
        $sql = '
            SELECT "A"."UserId", "A"."Name" AS "RmName", "B"."Name" AS "UnitKerja", "C"."LogDate" "LastAccess"
            FROM "User" "A"
            LEFT JOIN "UnitKerja" "B" on "A"."UnitKerjaId"="B"."UnitKerjaId"
            LEFT JOIN "Log" "C" on "A"."UserId"="C"."CreatedBy" and "C"."Action"=\'Get Task Profile\'
            WHERE "A"."RoleId"=10
        ';
        if (!empty($uker_search)) {
            $sql .= " AND (
                A.UnitKerjaId = '".$uker_search."' 
                )
            ";
        }
        if (!empty($searchTxt)) {
            $sql .= " AND (
                A.UserId LIKE '%".$searchTxt."%' 
                OR A.Name LIKE '%".$searchTxt."%' 
                )
            ";
        }
        // echo $sql;

        $result = $this->db->query($sql)->result_array();  

        return count($result);
    }

    public function getViewRmLeaderboard($rowperpage, $rowno, $searchTxt = '', $uker_search = '') {
        $sql = '
            SELECT "A"."UserId", "A"."Name" AS "RmName", "A"."ProfilePicture"
            , "B"."Name" AS "UnitKerja"
            , "C"."LogDate" "LastAccess"
            FROM "User" "A"
            LEFT JOIN "UnitKerja" "B" on "A"."UnitKerjaId"="B"."UnitKerjaId"
            LEFT JOIN "Log" "C" on "A"."UserId"="C"."CreatedBy" and "C"."Action"=\'Get Task Profile\'
            WHERE "A"."RoleId"=10
        ';
        if (!empty($uker_search)) {
            $sql .= " AND (
                A.UnitKerjaId = '".$uker_search."' 
                )
            ";
        }
        if (!empty($searchTxt)) {
            $sql .= " AND (
                A.UserId LIKE '%".$searchTxt."%' 
                OR A.Name LIKE '%".$searchTxt."%' 
                )
            ";
        }
        $sql .= ' ORDER BY a.Name ASC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        // echo $sql;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getAccountPlanningList($userId){
        $sql = "
            SELECT A.AccountPlanningId, A.CreatedDate, A.CreatedBy, A.[Year],
                D.CustomerGroupId, D.Name CustomerName, E.Name RMName, F.Logo, F.Name GroupName
            FROM AccountPlanning A, AccountPlanningOwner B,
                AccountPlanningCustomer C, CustomerKorporasi D, [User] E,
                CustomerGroup F
            WHERE A.AccountPlanningId=B.AccountPlanningId
                AND B.AccountPlanningId=C.AccountPlanningId
                AND C.VCIF=D.VCIF AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 
        ";
        if(!empty($userId)) {
            $sql .= " AND B.UserId='".$userId."'  ";
        }
        $sql .= 'ORDER BY A.CreatedDate DESC';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getVCIFPerRM($userId){
        $sql = "
            SELECT 
                A.AccountPlanningId, A.VCIF, A.CreatedDate, A.CreatedBy
                , B.CustomerGroupId, B.Name CustomerName
                , C.Logo, C.Name GroupName
                , D.Year
            FROM AccountPlanningCustomer A
            LEFT JOIN CustomerKorporasi B ON B.VCIF=A.VCIF
            LEFT JOIN CustomerGroup C ON C.CustomerGroupId = B.CustomerGroupId
            LEFT JOIN AccountPlanning D ON A.AccountPlanningId = D.AccountPlanningId
            WHERE 
                B.IsActive=1
                AND D.Year='".$this->current_year."'            
        ";
        if(!empty($userId)) {
            $sql .= " AND A.CreatedBy='".$userId."'  ";
        }
        $sql .= ' ORDER BY A.AccountPlanningId ASC';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function getVCIFDetails($VCIF) {
        $sql = "SELECT a.VCIF, a.Name CustomerName
            FROM CustomerKorporasi a 
            where a.VCIF='".$VCIF."'
                -- AND IsActive=1 AND IsExisting=1
                ";
        // echo $sql;

        $result = $this->db->query($sql)->row_array();  

        return $result;
    }


}
