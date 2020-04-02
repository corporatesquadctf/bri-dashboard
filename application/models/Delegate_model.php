<?php

class Delegate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $today->format('Y');
        $this->current_datetime = $today->format('Y-m-d H:i:s');
        $this->created_date = date('Y-m-d H:i:s');
    }

    public function getTotalMyAccountPlanningByDivision($DivisionId, $year='', $docStatusId='', $searchTxt=''){
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

        if(!empty($DivisionId)) {
            $filter .= "
            	AND B.UserId IN (
		        	SELECT UserId FROM [User] u WHERE UnitKerjaId = ".$DivisionId."
		        )
            ";
        }

        $sql = "SELECT COUNT(1) Total FROM(
            SELECT A.AccountPlanningId, A.CreatedDate, A.CreatedBy, A.[Year]
				, D.CustomerGroupId, D.Name CustomerName
				, E.Name RMName, E.UnitKerjaId
				, F.Logo
            FROM AccountPlanning A
			    , AccountPlanningOwner B
			    , AccountPlanningCustomer C
			    , CustomerKorporasi D
			    , [User] E
			    , CustomerGroup F 
			    ".$tblFilter."
            WHERE A.AccountPlanningId = B.AccountPlanningId
                AND B.AccountPlanningId = C.AccountPlanningId
                AND C.VCIF = D.VCIF
                AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 
                ".$filter."
            ) Tbl
        ";
        // echo $sql;
        $result = $this->db->query($sql)->row_array();

        return $result['Total'];
    }

    public function getMyAccountPlanningByDivision($DivisionId, $rowperpage, $rowno, $year='', $docStatusId='', $searchTxt=''){
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

        if(!empty($DivisionId)) {
            $filter .= "
            	AND B.UserId IN (
		        	SELECT UserId FROM [User] u WHERE UnitKerjaId = ".$DivisionId."
		        )
            ";
        }

        $sql = "
            SELECT A.AccountPlanningId, A.CreatedDate, A.CreatedBy, A.[Year]
				, D.CustomerGroupId, D.Name CustomerName
				, E.Name RMName, E.UnitKerjaId
				, F.Logo
            FROM AccountPlanning A
			    , AccountPlanningOwner B
			    , AccountPlanningCustomer C
			    , CustomerKorporasi D
			    , [User] E
			    , CustomerGroup F 
			    ".$tblFilter."
            WHERE A.AccountPlanningId = B.AccountPlanningId
                AND B.AccountPlanningId = C.AccountPlanningId
                AND C.VCIF = D.VCIF
                AND E.UserId = B.UserId
                AND D.CustomerGroupId = F.CustomerGroupId
                AND B.IsActive=1
                AND C.IsMain=1 
                ".$filter."
            ORDER BY A.CreatedDate DESC OFFSET ".$rowno." ROWS FETCH NEXT ".$rowperpage." ROWS ONLY
        ";
        // echo $sql;
        $result = $this->db->query($sql);

        return $result->result_array();
    }

}