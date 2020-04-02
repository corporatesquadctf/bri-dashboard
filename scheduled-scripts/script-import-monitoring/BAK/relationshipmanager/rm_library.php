<?php
	function getAccountPlanningList($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT DISTINCT "account_plannings"."vcif", "account_plannings"."customer_name", "account_plannings"."doc_status" FROM "delegations_maker" LEFT JOIN "account_plannings" ON "delegations_maker"."vcif" = "account_plannings"."vcif" WHERE "delegations_maker"."maker_id" = '.$rm_id.' AND "account_plannings"."year" = \''.$ap_year.'\'';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'vcif' => $row['vcif'],
				'doc_status' => $row['doc_status'],
				'customer_name' => $row['customer_name']
			);
		}

		return $results;
	}

	function getAccountPlanningPublish($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT "account_plannings"."doc_status", "account_plannings"."customer_name" FROM "delegations_maker" LEFT JOIN "account_plannings" ON "delegations_maker"."vcif" = "account_plannings"."vcif" WHERE "delegations_maker"."maker_id" = '.$rm_id.' AND "account_plannings"."year" = \''.$ap_year.'\' AND "account_plannings"."doc_status" = 4 GROUP BY "account_plannings"."customer_name", "account_plannings"."doc_status"';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'doc_status' => $row['doc_status'],
				'customer_name' => $row['customer_name']
			);
		}

		return $results;
	}

	function getAccountPlanningWa($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT "account_plannings"."doc_status", "account_plannings"."customer_name" FROM "delegations_maker" LEFT JOIN "account_plannings" ON "delegations_maker"."vcif" = "account_plannings"."vcif" WHERE "delegations_maker"."maker_id" = '.$rm_id.' AND "account_plannings"."year" = \''.$ap_year.'\' AND ("account_plannings"."doc_status" = 2 OR "account_plannings"."doc_status" = 3) GROUP BY "account_plannings"."customer_name", "account_plannings"."doc_status"';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'doc_status' => $row['doc_status'],
				'customer_name' => $row['customer_name']
			);
		}

		return $results;
	}

	function getAccountPlanningDraft($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT "account_plannings"."doc_status", "account_plannings"."customer_name" FROM "delegations_maker" LEFT JOIN "account_plannings" ON "delegations_maker"."vcif" = "account_plannings"."vcif" WHERE "delegations_maker"."maker_id" = '.$rm_id.' AND "account_plannings"."year" = \''.$ap_year.'\' AND ("account_plannings"."doc_status" = 0 OR "account_plannings"."doc_status" = 1) GROUP BY "account_plannings"."customer_name", "account_plannings"."doc_status"';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'doc_status' => $row['doc_status'],
				'customer_name' => $row['customer_name']
			);
		}

		return $results;
	}

	function getAccountPlanningReject($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT "account_plannings"."doc_status", "account_plannings"."customer_name" FROM "delegations_maker" LEFT JOIN "account_plannings" ON "delegations_maker"."vcif" = "account_plannings"."vcif" WHERE "delegations_maker"."maker_id" = '.$rm_id.' AND "account_plannings"."year" = \''.$ap_year.'\' AND ("account_plannings"."doc_status" = 5 OR "account_plannings"."doc_status" = 6) GROUP BY "account_plannings"."customer_name", "account_plannings"."doc_status"';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'doc_status' => $row['doc_status'],
				'customer_name' => $row['customer_name']
			);
		}

		return $results;
	}

	function getAccountPlanningProgress($vcif, $ap_year) {
		global $conn;

		$sql = 'SELECT ProgressTotal FROM MonitoringAccountPlanning WHERE vcif = \''.$vcif.'\' AND year = \''.$ap_year.'\'';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}

		$results = 0;
		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results = $row['ProgressTotal'];
		}

		return $results;
	}

	function getAccountPlanningVcif($rm_id, $ap_list) {
		$results = array();
		if (!empty($ap_list)) {
			foreach ($ap_list as $key) {
				$results[] = $key['vcif'];
			}
		}
		return $results;
	}

	function getTotalProgressAccountPlanning($rm_id, $ap_list, $ap_year) {
        $account_planning['vcif'] = getAccountPlanningVcif($rm_id, $ap_list);
		if (!empty($account_planning['vcif'])) {
			foreach ($account_planning['vcif'] as $key => $value) {
		        $getAccountPlanningProgress[$value] = getAccountPlanningProgress($value, $ap_year);
			}
			// $results = floor(array_sum($getAccountPlanningProgress) / count($account_planning['vcif']));
			$results = array_sum($getAccountPlanningProgress) / count($account_planning['vcif']);
			return $results;
		}
		return 0;

	}

	function insertMonitoringRm($rm_name, $personal_number, $division, $last_activity, $year, $account_planning_total, $account_planning_list, $account_planning_publish, $account_planning_wa, $account_planning_draft, $account_planning_reject, $account_planning_progress='') {
		global $conn;

		$sql = '
		INSERT INTO "MonitoringRm" (
		"RmName", 
		"PersonalNumber", 
		"Division", 
		"LastActivity", 
		"Year", 
		"AccountPlanningTotal", 
		"AccountPlanningList", 
		"AccountPlanningPublish", 
		"AccountPlanningWa", 
		"AccountPlanningDraft",
		"accountPlanningReject", 
		"AccountPlanningProgress"
		) 
		VALUES (
		\''.$rm_name.'\', 
		\''.$personal_number.'\', 
		\''.$division.'\', 
		\''.$last_activity.'\', 
		\''.$year.'\', 
		\''.$account_planning_total.'\', 
		\''.$account_planning_list.'\', 
		\''.$account_planning_publish.'\', 
		\''.$account_planning_wa.'\',
		\''.$account_planning_draft.'\',
		\''.$account_planning_reject.'\',
		\''.$account_planning_progress.'\'
		);
		';
		// echo $sql; die();

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
	        insertLogImportRM('insert MonitoringRm Failed', 0, 1);
		    die( print_r( sqlsrv_errors(), true));
		}
	}

	function insertLogImportRM($ProcedureName, $IsSuccess, $ProcedureType = 1){
		global $conn;
	    $current_datetime = date('Y-m-d H:i:s');
		$sql = '
		INSERT INTO "LogImport" (
			"CreatedDate",
			"ProcedureName",
			"IsSuccess",
			"LogTypeId",
			"ProcedureType"
		)
		VALUES (
			\''.$current_datetime.'\', 
			\''.$ProcedureName.'\', 
			\''.$IsSuccess.'\',
			2,
			\''.$ProcedureType.'\'
		)
		';

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
	}

?>