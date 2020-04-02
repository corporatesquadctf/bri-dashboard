<?php
	function getAccountPlanningMember($AccountPlanningId) {
		global $conn;

		$sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name"
				from "AccountPlanningMember" "a"
				LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
				WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'personal_number' => $row['UserId'],
				'name' =>  str_replace("'", "''", $row['Name'])
			);
		}

		return $results;
	}

	function getAccountPlanningChecker($AccountPlanningId) {
		global $conn;

		$sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name"
			from "AccountPlanningChecker" "a"
			LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
			WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'personal_number' => $row['UserId'],
				'name' =>  str_replace("'", "''", $row['Name'])
			);
		}

		return $results;
	}

	function getAccountPlanningSigner($AccountPlanningId) {
		global $conn;

		$sql = 'SELECT "a"."AccountPlanningId", "a"."UserId", "b"."Name"
			from "AccountPlanningSigner" "a"
			LEFT JOIN "User" "b" on "a"."UserId"="b"."UserId"
			WHERE "a"."AccountPlanningId" ='. $AccountPlanningId;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'personal_number' => $row['UserId'],
				'name' =>  str_replace("'", "''", $row['Name'])
			);
		}

		return $results;
	}

	function getAccountPlanningCif($vcif) {
		global $conn;

		$sql = 'SELECT "b"."VCIF", "a"."CIFNo", "a"."Name"
				from "CIF" "a", "Customer" "b"
				where "a"."VCIF"="b"."VCIF" and "a"."IsActive"=1
				and "b"."VCIF"=\''.$vcif.'\'';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'nama' => $row['Name'],
				'cif' => $row['CIFNo']
			);
		}

		return $results;
	}

	function getPoinAccountPlanningCi($AccountPlanningId, $table) {
		global $conn;

		$sql = 'SELECT count(accountPlanningId) AS total_ci FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_ci = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_ci = $row['total_ci'];
		}

		$results = countPoinAccountPlanningCi($sum_ci,$table);

		return $results;
	}

	function countPoinAccountPlanningCi($total_ci,$table) {
		$results = 0;
		if ($total_ci >= '1') {
			$results = 1;
			if ($table == 'StrategicPlan') {
				$results = 2;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCi($AccountPlanningId) {
        $account_planning_ci['go'] = getPoinAccountPlanningCi($AccountPlanningId,'GroupOverview');
        $account_planning_ci['sh'] = getPoinAccountPlanningCi($AccountPlanningId,'Shareholder');
        $account_planning_ci['sp'] = getPoinAccountPlanningCi($AccountPlanningId,'StrategicPlan');
        $account_planning_ci['cm'] = getPoinAccountPlanningCi($AccountPlanningId,'CoverageMapping');

		return array_sum($account_planning_ci);
	}

	function getPoinAccountPlanningSp($AccountPlanningId, $table) {
		global $conn;

		
		if ($table == 'FinancialHighlight') {
			$sql = 'SELECT count(a.AccountPlanningId) AS total_sp FROM '.$table.' a, AccountPlanning b
				WHERE a.accountPlanningId = '.$AccountPlanningId.' AND a.AccountPlanningId=b.AccountPlanningId 
				AND a.[year]=b.[year]-1';
		}
		else {
			$sql = 'SELECT count(AccountPlanningId) AS total_sp FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;
		}
		if ($table == 'BankFacility') {
			$sql .= ' AND (IDRAmount != 0 OR ValasAmount != 0 OR (IDRAmount != 0 AND ValasAmount != 0))';
		}

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_sp = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_sp = $row['total_sp'];
		}

		$results = poinAccountPlanningSp($sum_sp,$table);

		return $results;
	}

	function poinAccountPlanningSp($total_sp,$table) {
		$results = 0;
		if (($table == 'BankFacility' || $table == 'CompetitionAnalysis') && $total_sp >= 1) {
			$results = 5;
		}
		elseif ($table == 'WalletShare' && $total_sp >= 1) {
			$results = 10;
		}
		elseif ($table == 'FinancialHighlight' && $total_sp >= 1) {
			$results = $total_sp * 0.2;
			if ($total_sp >= 25) {
				$results = 5;
			}
		}

		return $results;
	}


	function getTotalPoinAccountPlanningSp($AccountPlanningId) {
        $account_planning_sp['fv'] = getPoinAccountPlanningSp($AccountPlanningId,'FinancialHighlight');
        $account_planning_sp['bv'] = getPoinAccountPlanningSp($AccountPlanningId,'BankFacility');
        $account_planning_sp['ws'] = getPoinAccountPlanningSp($AccountPlanningId,'WalletShare');
        $account_planning_sp['ca'] = getPoinAccountPlanningSp($AccountPlanningId,'CompetitionAnalysis');

		return array_sum($account_planning_sp);
	}

	function getPoinAccountPlanningCn($AccountPlanningId, $table) {
		global $conn;

		$sql = 'SELECT count(AccountPlanningId) AS total_cn FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_cn = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_cn = $row['total_cn'];
		}

		$results = poinAccountPlanningCn($sum_cn,$table);

		return $results;
	}

	function poinAccountPlanningCn($total_cn,$table) {
		$results = 0;
		if ($total_cn >= '1') {
			if ($table == 'Funding' || $table == 'Service' || $table == 'InitiativeAction' || $table == 'EstimatedFinancial') {
				$results = 15;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCn($AccountPlanningId) {
        $account_planning_ci['fundings'] = getPoinAccountPlanningCn($AccountPlanningId,'Funding');
        $account_planning_ci['services'] = getPoinAccountPlanningCn($AccountPlanningId,'Service');

		return array_sum($account_planning_ci);
	}

	function getTotalPoinAccountPlanningAp($AccountPlanningId) {
        $account_planning_cn['estimated_financials'] = getPoinAccountPlanningCn($AccountPlanningId,'EstimatedFinancial');
        $account_planning_cn['initiative_actions'] = getPoinAccountPlanningCn($AccountPlanningId,'InitiativeAction');

		return array_sum($account_planning_cn);
	}

	function getPoinAccountPlanningCpa($AccountPlanningId, $table, $bankingfacility) {
		global $conn;

		$sql = 'SELECT count(AccountPlanningId) AS total_cpa FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;
		if ($table == 'CreditSimulationAssumption') {
			if ($bankingfacility == 'simpanan') {
				$sql .= ' AND (IDRFTPSimpanan != 0 OR ValasFTPSimpanan != 0 OR (IDRFTPSimpanan != 0 AND ValasFTPSimpanan != 0))';
			}
			elseif ($bankingfacility == 'pinjaman') {
				$sql .= ' AND (IDRFTPPinjaman != 0 OR ValasFTPPinjaman != 0 OR (IDRFTPPinjaman != 0 AND ValasFTPPinjaman != 0))';
			}
		}

		if ($table == 'CreditSimulation') {
			if ($bankingfacility == '1,2') {
				$sql .= ' AND (BankFacilityItemId = 1 OR BankFacilityItemId = 2)';
			}
			elseif ($bankingfacility == '6,7') {
				$sql .= ' AND (BankFacilityItemId = 6 OR BankFacilityItemId = 7)';
			}
		}

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_cpa = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_cpa = $row['total_cpa'];
		}

		$results = poinAccountPlanningCpa($sum_cpa,$table);

		return $results;
	}

	function poinAccountPlanningCpa($total_cpa,$table) {
		$results = 0;
		if ($total_cpa >= '1') {
			if ($table == 'CreditSimulation' || $table == 'CreditSimulationAssumption') {
				$results = 2.5;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCpa($AccountPlanningId) {
        $account_planning_cpa['cpa']['1,2'] = getPoinAccountPlanningCpa($AccountPlanningId,'CreditSimulation','1,2');
        $account_planning_cpa['cpa']['6,7'] = getPoinAccountPlanningCpa($AccountPlanningId,'CreditSimulation','6,7');
        $account_planning_cpa['cpa']['simpanan'] = getPoinAccountPlanningCpa($AccountPlanningId,'CreditSimulationAssumption','simpanan');
        $account_planning_cpa['cpa']['pinjaman'] = getPoinAccountPlanningCpa($AccountPlanningId,'CreditSimulationAssumption','pinjaman');
        $account_planning_cpa['total_cpa'] = array_sum($account_planning_cpa['cpa']);

		// return $account_planning_cpa;
		return $account_planning_cpa['total_cpa'];
	}

	function insertMonitoringAccountPlanning($id, $vcif, $customer_name, $sektor_usaha, $group_id, $cif, $group_name, $clasified, $addby, $status, $doc_status, $doc_status_text, $account_planning_addon, $account_planning_publish, $checker_list, $signer_list, $year, $rm_total, $rm_list, $ap_progress_company_information, $ap_progress_bri_starting_position, $ap_progress_client_needs, $ap_progress_action_plan, $ap_progress_simulasi_cpa, $ap_progress_total='') {
		global $conn;

		$sql = '
		INSERT INTO "MonitoringAccountPlanning" (
		"AccountPlanningId", 
		"Vcif", 
		"CustomerName", 
		"SektorUsaha", 
		"Groupid", 
		"Cif", 
		"GroupName", 
		"Clasified", 
		"AddBy", 
		"Status", 
		"DocStatus", 
		"DocStatusText", 
		"AccountPlanningAddon", 
		"AccountPlanningPublish", 
		"CheckerPn",
		"SignerPn",
		"Year", 
		"RmTotal", 
		"RmList", 
		"ProgressCompanyInformation", 
		"ProgressBriStartingPosition", 
		"ProgressClientNeeds", 
		"ProgressActionPlan", 
		"ProgressSimulationsCpa", 
		"ProgressTotal"
		) 
		VALUES (
		\''.$id.'\', 
		\''.$vcif.'\', 
		\''.$customer_name.'\', 
		\''.$sektor_usaha.'\', 
		\''.$group_id.'\', 
		\''.$cif.'\', 
		\''.$group_name.'\', 
		\''.$clasified.'\', 
		\''.$addby.'\',
		\''.$status.'\',
		\''.$doc_status.'\',
		\''.$doc_status_text.'\',
		\''.$account_planning_addon.'\',
		\''.$account_planning_publish.'\',
		\''.$checker_list.'\',
		\''.$signer_list.'\',
		\''.$year.'\',
		\''.$rm_total.'\',
		\''.$rm_list.'\',
		\''.$ap_progress_company_information.'\',
		\''.$ap_progress_bri_starting_position.'\',
		\''.$ap_progress_client_needs.'\',
		\''.$ap_progress_action_plan.'\',
		\''.$ap_progress_simulasi_cpa.'\',
		\''.$ap_progress_total.'\'
		)
		';
		// echo $sql; die();

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
	        insertLogImportAccountPlanning('insert MonitoringAccountPlanning Failed AccountPlanningId='.$id, 0, 1);
		    die( print_r( sqlsrv_errors(), true));
		}
	}

	function insertLogImportAccountPlanning($ProcedureName, $IsSuccess, $ProcedureType = 1){
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
			1,
			\''.$ProcedureType.'\'
		)
		';

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
	}

?>