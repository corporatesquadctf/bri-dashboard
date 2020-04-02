<?php

class ApproveAccountPlanning_model extends CI_Model {

    public function getTotalViewApproveAccountPlanning($UserId, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='') {
        $sql = '
            SELECT "a"."AccountPlanningStatusId", "a"."AccountPlanningId", "a"."DocumentStatusId"
            , "b"."UserId"
            FROM "AccountPlanningStatus" "a"
            RIGHT JOIN "AccountPlanningChecker" "b" ON "a"."AccountPlanningId"="b"."AccountPlanningId"
            WHERE "b"."UserId" = \''.$UserId.'\' 
            AND "a"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "b"."AccountPlanningId"
            ) 
            AND "a"."DocumentStatusId" NOT IN (0, 1)
        ';

        $result = $this->db->query($sql)->result_array();  

        return count($result);
    }


    public function getViewApproveAccountPlanning($UserId, $rowperpage, $rowno, $keyword_search_box='', $uker_search_box='', $tahun_search_box='', $status_search_box='') {
        $sql = '
           SELECT "k"."AccountPlanningStatusId", "k"."AccountPlanningId", "k"."DocumentStatusId"
            , "a"."CreatedBy", "a"."AccountPlanningId", "a"."UserId", "a"."CreatedDate"
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

            WHERE "a"."UserId" = \''.$UserId.'\' 
            AND "k"."AccountPlanningStatusId" = (
            SELECT MAX(AccountPlanningStatusId) FROM AccountPlanningStatus WHERE AccountPlanningId = "a"."AccountPlanningId"
            ) 
            AND "k"."DocumentStatusId" NOT IN (0, 1)
        ';

        $sql .= ' ORDER BY "a"."CreatedDate" DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

}
?>