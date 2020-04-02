<?php

class TasklistDisposisi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->todays = $today->format('Y-m-d H:i:s');
    }

    public function getAccountPlanningMember($AccountPlanningId) {
        $sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name"
                FROM "AccountPlanningMember" "a"
                LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getRMSelected($UnitKerjaId,$CustomerGroupId) {
        $sql = 'SELECT "a"."UserId", "b"."Name" AS "RMName"
                FROM "DisposisiCustomerGroup" "a"
                LEFT JOIN "User" "b" ON "a"."UserId"="b"."UserId" AND "b"."UnitKerjaId" ='. $UnitKerjaId .'
                WHERE "a"."CustomerGroupId" ='. $CustomerGroupId .' AND "a"."IsActive" =1  AND "b"."UnitKerjaId" ='. $UnitKerjaId;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getRMPerUnitKerja($UnitKerjaId) {
        $sql = 'SELECT "a"."UserId", "a"."Name" AS "RMName"
                FROM "User" "a"
                WHERE "a"."UnitKerjaId" ='. $UnitKerjaId .' AND RoleID = 10 ';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getGroupCustomerList($CustomerGroupId) {
        $sql = 'SELECT "a"."VCIF", "a"."Name" AS "CustomerName"
                FROM "Customer" "a"
                WHERE "a"."IsActive"=1 AND "a"."CustomerGroupId" ='. $CustomerGroupId;

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewGroupList($keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
            SELECT COUNT(*) AS "numrows" 
            FROM "CustomerGroup" 
            WHERE IsActive=1
        ';

        $result = $this->db->query($sql)->result_array();  

        return $result[0]['numrows'];
    }

    public function getViewGroupList($rowperpage, $rowno, $keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {

        $sql = '
            SELECT 
            "a"."CustomerGroupId", "a"."Name" AS "CustomerGroupName",
            "i"."PinjamanTotal" AS "PinjamanTotalGroup", "i"."PinjamanRatas" AS "PinjamanRatasGroup", "i"."SimpananTotal" AS "SimpananTotalGroup", "i"."SimpananRatas" AS "SimpananRatasGroup", "i"."CurrentCPA" AS "CurrentCPAGroup", "i"."ValueChain" AS "ValueChainGroup"
            FROM CustomerGroup a
            LEFT JOIN "SummaryCustomerGroup" "i" ON "a"."CustomerGroupId"="i"."CustomerGroupId"

            WHERE "a"."IsActive"=1
        ';

        $sql .= ' ORDER BY 1 OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function insertDisposisiPerRM($CustomerGroupId, $UserId, $CreatedBy) {
        $data = array(
            'CustomerGroupId'       => $CustomerGroupId, 
            'UserId'                => $UserId, 
            'IsActive'              => 1, 
            'CreatedDate'           => $this->todays, 
            'CreatedBy'             => $CreatedBy, 
            );
/*
        $sql = '
            INSERT INTO "DisposisiCustomerGroup" (
            "CustomerGroupId",
            "UserId",
            "IsActive",
            "CreatedDate",
            "CreatedBy",
            )
            VALUES (
            '.$CustomerGroupId.',
            \''.$UserId.'\',
            1,
            \''.$this->todays.'\',
            '.$CreatedBy.',
            )
        ';
        echo $sql;
*/
        $str = $this->db->insert('DisposisiCustomerGroup', $data);

        // return $this->db->last_query();

    }
}
