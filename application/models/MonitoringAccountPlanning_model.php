<?php

class MonitoringAccountPlanning_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function getTotalViewAccountPlanning($keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {

        $sql = '
            SELECT COUNT(*) AS "numrows" 
            FROM "MonitoringAccountPlanning" 
        ';

        $sql .= "WHERE MonitoringAccountPlanning.Year = '".$tahun_search_box."'";

        if (!empty($uker_search_box)) {
            $sql .= " AND MonitoringAccountPlanning.Uker = '".$uker_search_box."'";
        }

        if ($status_search_box == 'all') {
            // $sql .= " AND (MonitoringAccountPlanning.DocumentStatusId = 0 OR MonitoringAccountPlanning.DocumentStatusId = 1 OR MonitoringAccountPlanning.DocumentStatusId = 2 OR MonitoringAccountPlanning.DocumentStatusId = 3 OR MonitoringAccountPlanning.DocumentStatusId = 4 OR MonitoringAccountPlanning.DocumentStatusId = 5 OR MonitoringAccountPlanning.DocumentStatusId = 6)";
            $sql .= " AND MonitoringAccountPlanning.DocumentStatusId IN (0, 1, 2, 3, 4, 5, 6)";
        }
        else {
            $sql .= " AND MonitoringAccountPlanning.DocumentStatusId = ".$status_search_box;
        }

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (MonitoringAccountPlanning.Vcif LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.CustomerName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.SektorUsaha LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.VCIFList LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.GroupName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.RMName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.Member LIKE '%".$keyword_search_box."%' ESCAPE '!' )
            ";
        }

        // echo $sql; 
        $result = $this->db->query($sql)->result_array();  

        return $result[0]['numrows'];
    }

    public function getViewAccountPlanning($rowperpage, $rowno, $keyword_search_box, $uker_search_box, $tahun_search_box, $status_search_box) {
        $sql = '
         SELECT MonitoringAccountPlanningId, AccountPlanningId, Vcif, CustomerName, SektorUsaha, GroupId, GroupName, Clasified, RMName, Member, DocumentStatusId, Status, AccountPlanningAddon, AccountPlanningPublish, ProgressTotal, Year 
         FROM MonitoringAccountPlanning 
        ';
            $sql .= "WHERE MonitoringAccountPlanning.Year = '".$tahun_search_box."'";

        if (!empty($uker_search_box)) {
            $sql .= " AND MonitoringAccountPlanning.Uker = '".$uker_search_box."'";
        }

        if ($status_search_box == 'all') {
            $sql .= " AND MonitoringAccountPlanning.DocumentStatusId IN (0, 1, 2, 3, 4, 5, 6)";
        }
        else {
            $sql .= " AND MonitoringAccountPlanning.DocumentStatusId = ".$status_search_box;
        }

        if (!empty($keyword_search_box)) {
            $sql .= " 
                 AND (MonitoringAccountPlanning.Vcif LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.CustomerName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.SektorUsaha LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.VCIFList LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.GroupName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.RMName LIKE '%".$keyword_search_box."%' ESCAPE '!' 
                OR MonitoringAccountPlanning.Member LIKE '%".$keyword_search_box."%' ESCAPE '!' )
            ";
        }

        $sql .= ' ORDER BY MonitoringAccountPlanningId DESC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getAccountPlanningChecker($ap_id) {

        /*$sql = 'SELECT "delegations_checker"."checker_id", "users"."personal_number", "users"."name" FROM "delegations_checker" LEFT JOIN "users" ON "delegations_checker"."checker_id" = "users"."id" WHERE "delegations_checker"."vcif" = \''.$vcif.'\' AND "delegations_checker"."ap_id" = \''.$ap_id.'\' ';*/
        
        $sql = "SELECT A.UserId personal_number, B.Name 
            FROM AccountPlanningChecker A, [User] B
            WHERE A.AccountPlanningId=".$ap_id." AND A.IsActive=1 AND B.UserId=A.UserId";
            
        return $this->db->query($sql)->result_array();
    }

    public function getAccountPlanningSigner($ap_id) {

        /*$sql = 'SELECT "delegations_signer"."signer_id", "users"."personal_number", "users"."name" FROM "delegations_signer" LEFT JOIN "users" ON "delegations_signer"."signer_id" = "users"."id" WHERE "delegations_signer"."vcif" = \''.$vcif.'\' AND "delegations_signer"."ap_id" = \''.$ap_id.'\' ';*/

        $sql = "SELECT A.UserId personal_number, B.Name 
            FROM AccountPlanningSigner A, [User] B
            WHERE A.AccountPlanningId=".$ap_id." AND A.IsActive=1 AND B.UserId=A.UserId";

        return $this->db->query($sql)->result_array();
    }

    public function get_ukers() {

        $sql = 'SELECT UnitKerjaId, Name FROM UnitKerja WHERE isActive = 1 AND UnitKerjaTypeId = 1 ';

        return $this->db->query($sql)->result_array();
    }

    public function get_doc_status() {

        $sql = 'SELECT DocumentStatusId, Name FROM DocumentStatus';

        return $this->db->query($sql)->result_array();
    }

    public function get_customer_logo($CustomerGroupId) {

        $sql = 'SELECT Logo FROM CustomerGroup WHERE CustomerGroupId = '.$CustomerGroupId ;

        return $this->db->query($sql)->row_array();  
    }

    public function get_owner_last_view($AccountPlanningId) {

        $sql = 'SELECT LastView FROM AccountPlanningOwner WHERE AccountPlanningId = '.$AccountPlanningId ;

        return $this->db->query($sql)->row_array();  
    }

}
