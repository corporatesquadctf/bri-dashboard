<?php

class TasklistDisposisi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->todays = $today->format('Y-m-d H:i:s');
    }

    public function getAccountPlanningMember($AccountPlanningId) {
        $sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name", "c"."Name" UkerName
                FROM "AccountPlanningMember" "a"
                LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
                LEFT JOIN UnitKerja c on c.UnitKerjaId=b.UnitKerjaId
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

    public function getRMSelectedAll($CustomerGroupId) {
        $sql = 'SELECT "a"."UserId", "b"."Name" AS "RMName", c.Name UkerName
                FROM "DisposisiCustomerGroup" "a"
                JOIN "User" "b" ON "a"."UserId"="b"."UserId" 
                LEFT JOIN UnitKerja c ON b.UnitKerjaId=c.UnitKerjaId
                WHERE "a"."CustomerGroupId" ='. $CustomerGroupId .' AND "a"."IsActive" =1';

        $result = $this->db->query($sql)->result_array();  

        return $result; 
    }

    public function getRMUnSelected($UnitKerjaId,$CustomerGroupId) {
        $sql = "SELECT a.UserId, a.Name AS RMName
            FROM [User] a
            WHERE a.UnitKerjaId = ".$UnitKerjaId." AND RoleID = 10
                AND UserId NOT IN(
                    SELECT UserId FROM DisposisiCustomerGroup
                    WHERE IsActive=1 AND CustomerGroupId = ".$CustomerGroupId."
                )";
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getRMPerUnitKerja($UnitKerjaId, $owner='') {
        $sql = 'SELECT "a"."UserId", "a"."Name" AS "RMName"
                    , "c"."Name" AS "UkerName"
                FROM "User" "a"
                LEFT JOIN "UnitKerja" "c" ON "c"."UnitKerjaId"="a"."UnitKerjaId"
                WHERE "a"."UnitKerjaId" ='. $UnitKerjaId .' AND RoleID = 10 ';
        if (!empty($owner)) {
            $sql .= ' AND a.UserId != \''.$owner.'\' ';
        }

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getRMPerUnitKerjaGroup($UnitKerjaId, $CustomerGroupId) {
        $sql = "SELECT a.UserId, a.Name AS RMName
            FROM [User] a
            WHERE a.UnitKerjaId = ".$UnitKerjaId." AND RoleID = 10
                AND UserId NOT IN(
                    SELECT UserId FROM DisposisiCustomerGroup
                    WHERE IsActive=1 AND CustomerGroupId = ".$CustomerGroupId."
                )";

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getGroupCustomerList($CustomerGroupId) {
        $sql = "SELECT A.VCIF, A.Name CustomerName, X.AccountPlanningId
                FROM CustomerKorporasi A
                LEFT JOIN (SELECT C.AccountPlanningId, C.VCIF
                FROM AccountPlanning B, AccountPlanningCustomer C
                WHERE B.AccountPlanningId=C.AccountPlanningId 
                    AND B.[Year]='".$this->year_current."') X ON A.VCIF=X.VCIF
                WHERE A.CustomerGroupId=".$CustomerGroupId." AND IsActive=1 AND IsExisting=1";
            
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getTotalViewGroupList($searchTxt='') {
        $sql = "SELECT COUNT(1) numrows
                FROM CustomerGroup A
                WHERE 1=1 ";
        if (!empty($searchTxt)) {
            $sql .= " AND (A.Name LIKE '%".$searchTxt."%' 
                OR CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerKorporasi
                    WHERE (Name LIKE '%".$searchTxt."%' OR VCIF LIKE '%".$searchTxt."%') AND IsActive=1 AND IsExisting=1
                )
                OR CustomerGroupId IN(
                    SELECT CustomerGroupId
                    FROM DisposisiCustomerGroup A, [User] B
                    WHERE A.IsActive=1 AND A.UserId=B.UserId
                        AND B.Name LIKE '%".$searchTxt."%'
                )
            ) ";
        }

        $result = $this->db->query($sql)->row_array();  

        return $result['numrows'];
    }

    public function getViewGroupList($rowperpage, $rowno, $searchTxt='') {
        $sql = "SELECT CustomerGroupId, Name CustomerGroupName, Logo, ClassificationId 
                FROM CustomerGroup A
                WHERE 1=1 ";
        if (!empty($searchTxt)) {
            $sql .= " AND (A.Name LIKE '%".$searchTxt."%' 
                OR CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerKorporasi
                    WHERE (Name LIKE '%".$searchTxt."%' OR VCIF LIKE '%".$searchTxt."%') AND IsActive=1 AND IsExisting=1
                )
                OR CustomerGroupId IN(
                    SELECT CustomerGroupId
                    FROM DisposisiCustomerGroup A, [User] B
                    WHERE A.IsActive=1 AND A.UserId=B.UserId
                        AND B.Name LIKE '%".$searchTxt."%'
                )
            ) ";
        }
        $sql .= ' ORDER BY a.Name ASC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function insertDisposisiPerRM($CustomerGroupId, $UserId, $CreatedBy) {
        $data = array(
            'CustomerGroupId'       => $CustomerGroupId, 
            'UserId'                => $UserId, 
            'CreatedBy'             => $CreatedBy, 
            );

        $str = $this->db->query('transDisposisiInsert ?,?,?',$data);

        $error = $this->db->error();
        //print_r($error); die();
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

    public function removeDisposisiPerRM($CustomerGroupId, $UserId, $CreatedBy) {
        $data = array(
            'CustomerGroupId'       => $CustomerGroupId, 
            'UserId'                => $UserId, 
            'CreatedBy'             => $CreatedBy, 
            );

        $str = $this->db->query('transDisposisiRemove ?,?,?',$data);

        $error = $this->db->error();
        //print_r($error); die();
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
}
