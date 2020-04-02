<?php


    function getDocumentStatus2($AccountPlanningId) {
		global $conn;

        $sql = 'SELECT 
            "d"."DocumentStatusId",
            "e"."Name" AS "Status"
            FROM "AccountPlanningStatus" "d"
            LEFT JOIN "DocumentStatus" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusId"
            WHERE "d"."AccountPlanningId" = '.$AccountPlanningId.'
            ORDER BY "d"."AccountPlanningStatusId" ASC
        ';
        // echo "<br>".$sql;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results['DocumentStatusId'] = $row['DocumentStatusId'];
			$results['Status'] = $row['Status'];
		}

		return $results;
    }

	function getAccountPlanningList($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT a.AccountPlanningId, b.VCIF, c.Name
		from AccountPlanningOwner a
		left join AccountPlanningCustomer b on a.AccountPlanningId=b.AccountPlanningId and b.IsMain=1
		left join CustomerKorporasi c on b.VCIF=c.VCIF
		join AccountPlanning d on a.AccountPlanningId=d.AccountPlanningId and d.Year=\''.$ap_year.'\'
		WHERE A.UserId=\''.$rm_id.'\' and a.IsActive=1';
        // echo "<br>".$sql;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'ap_id' => $row['AccountPlanningId'],
				'vcif' => $row['VCIF'],
				'customer_name' => $row['Name']
			);
		}

		return $results;
	}

	function getAccountPlanningPublish($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT DISTINCT a.UserId, a.AccountPlanningId
		FROM AccountPlanningOwner a
		JOIN AccountPlanningStatus b ON a.AccountPlanningId=b.AccountPlanningId and b.DocumentStatusId=4 
		join AccountPlanning c on a.AccountPlanningId=c.AccountPlanningId and c.Year=\''.$ap_year.'\'
		WHERE A.UserId=\''.$rm_id.'\' and a.IsActive=1';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'rm_id' => $row['UserId'],
				'ap_id' => $row['AccountPlanningId']
			);
		}

		return $results;
	}

	function getAccountPlanningWa($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT DISTINCT a.UserId, a.AccountPlanningId
		FROM AccountPlanningOwner a
		JOIN AccountPlanningStatus b ON a.AccountPlanningId=b.AccountPlanningId and (b.DocumentStatusId=2 or b.DocumentStatusId=3) 
		join AccountPlanning c on a.AccountPlanningId=c.AccountPlanningId and c.Year=\''.$ap_year.'\'
		WHERE A.UserId=\''.$rm_id.'\' and a.IsActive=1';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'rm_id' => $row['UserId'],
				'ap_id' => $row['AccountPlanningId']
			);
		}

		return $results;
	}

	function getAccountPlanningDraft($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT DISTINCT a.UserId, a.AccountPlanningId
		FROM AccountPlanningOwner a
		JOIN AccountPlanningStatus b ON a.AccountPlanningId=b.AccountPlanningId and (b.DocumentStatusId=0 or b.DocumentStatusId=1) 
		join AccountPlanning c on a.AccountPlanningId=c.AccountPlanningId and c.Year=\''.$ap_year.'\'
		WHERE A.UserId=\''.$rm_id.'\' and a.IsActive=1';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'rm_id' => $row['UserId'],
				'ap_id' => $row['AccountPlanningId']
			);
		}

		return $results;
	}

	function getAccountPlanningReject($rm_id, $ap_year) {
		global $conn;

		$sql = 'SELECT DISTINCT a.UserId, a.AccountPlanningId
		FROM AccountPlanningOwner a
		JOIN AccountPlanningStatus b ON a.AccountPlanningId=b.AccountPlanningId and (b.DocumentStatusId=5 or b.DocumentStatusId=6) 
		join AccountPlanning c on a.AccountPlanningId=c.AccountPlanningId and c.Year=\''.$ap_year.'\'
		WHERE A.UserId=\''.$rm_id.'\' and a.IsActive=1';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'rm_id' => $row['UserId'],
				'ap_id' => $row['AccountPlanningId']
			);
		}

		return $results;
	}

	function getAccountPlanningProgress($ap_id) {
		global $conn;

		$sql = 'SELECT ProgressTotal FROM MonitoringAccountPlanning WHERE accountplanningid='.$ap_id;

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

	function getAccountPlanningId($ap_list) {
		$results = array();
		if (!empty($ap_list)) {
			foreach ($ap_list as $key) {
				$results[] = $key['ap_id'];
			}
		}
		return $results;
	}

	function getTotalProgressAccountPlanning($rm_id, $ap_list) {
        $account_planning['ap_id'] = getAccountPlanningId($ap_list);
		if (!empty($account_planning['ap_id'])) {
			foreach ($account_planning['ap_id'] as $key => $value) {
		        $getAccountPlanningProgress[$value] = getAccountPlanningProgress($value);
			}
			// $results = floor(array_sum($getAccountPlanningProgress) / count($account_planning['vcif']));
			$results = array_sum($getAccountPlanningProgress) / count($account_planning['ap_id']);
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
		// echo $sql; //die();

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