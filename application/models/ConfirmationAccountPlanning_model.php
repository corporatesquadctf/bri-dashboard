<?php

class ConfirmationAccountPlanning_model extends CI_Model {
    public function getSignerList($AccountPlanningId) {
        $sql = 'SELECT 
            "a"."AccountPlanningSignerId", "a"."UserId", "a"."IsApproved", "a"."Comment", "a"."CreatedBy"
            , "b"."Name" AS "SignerName"
            FROM "AccountPlanningSigner" "a"
            LEFT JOIN "User" "b" ON "a"."UserId" = "b"."UserId"
            WHERE "a"."AccountPlanningId"='.$AccountPlanningId.' AND "a"."IsActive"=1
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getSignerDetail($AccountPlanningId, $UserId) {
        $sql = 'SELECT 
            "a"."AccountPlanningSignerId", "a"."UserId", "a"."IsApproved", "a"."Comment", "a"."CreatedBy"
            , "b"."Name" AS "SignerName"
            FROM "AccountPlanningSigner" "a"
            LEFT JOIN "User" "b" ON "a"."UserId" = "b"."UserId"
            WHERE "a"."AccountPlanningId"='.$AccountPlanningId.' AND "a"."UserId"='.$UserId.' AND "a"."IsActive"=1
            ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCheckerList($AccountPlanningId) {
        $sql = 'SELECT 
            "a"."AccountPlanningChecker", "a"."UserId", "a"."IsApproved", "a"."Comment", "a"."CreatedBy"
            , "b"."Name" AS "CheckerName"
            FROM "AccountPlanningChecker" "a"
            LEFT JOIN "User" "b" ON "a"."UserId" = "b"."UserId"
            WHERE "a"."AccountPlanningId"='.$AccountPlanningId.' AND "a"."IsActive"=1
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getCheckerDetail($AccountPlanningId, $UserId) {
        $sql = 'SELECT 
            AccountPlanningChecker, IsApproved, Comment, CreatedBy
            FROM AccountPlanningChecker
            WHERE AccountPlanningId='.$AccountPlanningId.' AND UserId='.$UserId.' AND IsActive=1
        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getTotalViewHistoryAccountPlanning($UserId, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningChecker", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningChecker" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
            AND "k"."DocumentStatusId" NOT IN (4, 5, 6)
        ';

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $result = $this->db->query($sql)->result_array();  

        return count($result);
    }

    public function getViewHistoryAccountPlanning($UserId, $rowperpage, $rowno, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningChecker", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"
            , "i"."Logo"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningChecker" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1
            LEFT JOIN "CustomerGroup" "i" ON "i"."CustomerGroupId" = "d"."CustomerGroupId"

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
            AND "k"."DocumentStatusId" NOT IN (4, 5, 6)
        ';

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $sql .= ' ORDER BY "a"."CreatedDate" DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewCheckerAccountPlanning($UserId, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='', $history='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningChecker", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningChecker" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
        ';
        if (!empty($history)) {
            $sql .= '
                 AND "k"."DocumentStatusId" IN (3, 4, 5, 6)
            ';
        }
        else {
            $sql .= '
                 AND "k"."DocumentStatusId" = 2
            ';
        }
        // echo $sql;

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $result = $this->db->query($sql)->result_array();  

        return count($result);
    }

    public function getViewCheckerAccountPlanning($UserId, $rowperpage, $rowno, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='', $history='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningChecker", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"
            , "i"."Logo"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningChecker" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1
            LEFT JOIN "CustomerGroup" "i" ON "i"."CustomerGroupId" = "d"."CustomerGroupId"

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
        ';
        if (!empty($history)) {
            $sql .= '
                 AND "k"."DocumentStatusId" IN (3, 4, 5, 6)
            ';
        }
        else {
            $sql .= '
                 AND "k"."DocumentStatusId" = 2
            ';
        }

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $sql .= ' ORDER BY "a"."CreatedDate" DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewSignerAccountPlanning($UserId, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='', $history='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningSignerId", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningSigner" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
        ';
        if (!empty($history)) {
            $sql .= '
                 AND "k"."DocumentStatusId" IN (4, 5, 6)
            ';
        }
        else {
            $sql .= '
                 AND "k"."DocumentStatusId" = 3
            ';
        }


        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $result = $this->db->query($sql)->result_array();  

        return count($result);
    }

    public function getViewSignerAccountPlanning($UserId, $rowperpage, $rowno, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='', $history='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."AccountPlanningSignerId", "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
            , "b"."Year", "b"."FinancialHighlightCurrency" AS "Currency"
            , "c"."VCIF"
            , "d"."Name" AS "CustomerName"
            , "e"."Name" AS "CustomerGroupName", "e"."CustomerGroupId", "e"."Logo"
            , "f"."Name" AS "RMName"
            , "i"."Logo"

            FROM "AccountPlanningStatus" "k"
            RIGHT JOIN "AccountPlanningSigner" "a" ON "k"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanning" "b" ON "b"."AccountPlanningId"="a"."AccountPlanningId"
            LEFT JOIN "AccountPlanningCustomer" "c" ON "a"."AccountPlanningId"="c"."AccountPlanningId" AND "c"."IsMain"=1
            LEFT JOIN "CustomerKorporasi" "d" ON "c"."VCIF"="d"."VCIF"
            LEFT JOIN "CustomerGroup" "e" ON "e"."CustomerGroupId"="d"."CustomerGroupId"
            LEFT JOIN "User" "f" ON "a"."CreatedBy"="f"."UserId" AND "f"."IsActive"=1
            LEFT JOIN "CustomerGroup" "i" ON "i"."CustomerGroupId" = "d"."CustomerGroupId"

            WHERE "a"."UserId" = \''.$UserId.'\' AND "a"."IsActive"=1
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
        ';
        if (!empty($history)) {
            $sql .= '
                 AND "k"."DocumentStatusId" IN (4, 5, 6)
            ';
        }
        else {
            $sql .= '
                 AND "k"."DocumentStatusId" = 3
            ';
        }


        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (d.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR e.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR f.Name LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR c.VCIF LIKE '%".$keyword_search_box."%' ESCAPE '!')
            ";
        }

        $sql .= ' ORDER BY "a"."CreatedDate" DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

}

?>