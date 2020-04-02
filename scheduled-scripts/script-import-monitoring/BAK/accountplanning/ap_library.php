<?php
	function getAccountPlanningRm($vcif) {
		global $conn;

		$sql = 'SELECT "delegations_maker"."maker_id", "users"."personal_number", "users"."name", "delegations_maker"."division_id" FROM "delegations_maker" LEFT JOIN "users" ON "delegations_maker"."maker_id" = "users"."id" WHERE "delegations_maker"."vcif" = \''.$vcif.'\' ';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'maker_id' => $row['maker_id'],
				'personal_number' => $row['personal_number'],
				'name' =>  str_replace("'", "''", $row['name']),
				'uker' =>  $row['division_id']
			);
		}

		return $results;
	}

	function getAccountPlanningChecker($vcif, $ap_id) {
		global $conn;

		$sql = 'SELECT "delegations_checker"."checker_id", "users"."personal_number", "users"."name" FROM "delegations_checker" LEFT JOIN "users" ON "delegations_checker"."checker_id" = "users"."id" WHERE "delegations_checker"."vcif" = \''.$vcif.'\' AND "delegations_checker"."ap_id" = \''.$ap_id.'\' ';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'checker_id' => $row['checker_id'],
				'personal_number' => $row['personal_number'],
				'name' =>  str_replace("'", "''", $row['name'])
			);
		}

		return $results;
	}

	function getAccountPlanningSigner($vcif, $ap_id) {
		global $conn;

		$sql = 'SELECT "delegations_signer"."signer_id", "users"."personal_number", "users"."name" FROM "delegations_signer" LEFT JOIN "users" ON "delegations_signer"."signer_id" = "users"."id" WHERE "delegations_signer"."vcif" = \''.$vcif.'\' AND "delegations_signer"."ap_id" = \''.$ap_id.'\' ';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'signer_id' => $row['signer_id'],
				'personal_number' => $row['personal_number'],
				'name' =>  str_replace("'", "''", $row['name'])
			);
		}

		return $results;
	}

	function getAccountPlanningCiv($vcif) {
		global $conn;

		$sql = 'SELECT "par_mapping_vcif"."nama", "par_mapping_vcif"."cif" FROM "par_mapping_vcif" WHERE "par_mapping_vcif"."vcif" = \''.$vcif.'\' ';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'nama' => $row['nama'],
				'cif' => $row['cif']
			);
		}

		return $results;
	}

	function getPoinAccountPlanningCi($vcif, $table, $ap_year) {
		global $conn;

		$sql = 'SELECT count(vcif) AS total_ci FROM '.$table.' WHERE vcif = \''.$vcif.'\' AND year = \''.$ap_year.'\'';

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
			if ($table == 'strategic_plans') {
				$results = 2;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCi($vcif, $ap_year) {
        $account_planning_ci['go'] = getPoinAccountPlanningCi($vcif,'group_overviews', $ap_year);
        $account_planning_ci['sh'] = getPoinAccountPlanningCi($vcif,'shareholders', $ap_year);
        $account_planning_ci['sp'] = getPoinAccountPlanningCi($vcif,'strategic_plans', $ap_year);
        $account_planning_ci['cm'] = getPoinAccountPlanningCi($vcif,'coverage_mappings', $ap_year);

		return array_sum($account_planning_ci);
	}

	function getPoinAccountPlanningSp($vcif, $table, $ap_year) {
		global $conn;

		$sql = 'SELECT count(vcif) AS total_sp FROM '.$table.' WHERE vcif = \''.$vcif.'\'';
		if ($table == 'financialhighlight_values') {
			$ap_year = $ap_year - 1;
			$sql .= ' AND data_year = \''.$ap_year.'\'';
		}
		else {
			$sql .= ' AND data_year = \''.$ap_year.'\'';
		}
		if ($table == 'bankingfacility_values') {
			$sql .= ' AND (amount_idr != 0 OR amount_valas != 0 OR (amount_idr != 0 AND amount_valas != 0))';
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
		if (($table == 'bankingfacility_values' || $table == 'competition_analysis') && $total_sp >= 1) {
			$results = 5;
		}
		elseif ($table == 'wallet_shares' && $total_sp >= 1) {
			$results = 10;
		}
		elseif ($table == 'financialhighlight_values' && $total_sp >= 1) {
			$results = $total_sp * 0.2;
			if ($total_sp >= 25) {
				$results = 5;
			}
		}

		return $results;
	}


	function getTotalPoinAccountPlanningSp($vcif, $ap_year) {
        $account_planning_sp['fv'] = getPoinAccountPlanningSp($vcif,'financialhighlight_values', $ap_year);
        $account_planning_sp['bv'] = getPoinAccountPlanningSp($vcif,'bankingfacility_values', $ap_year);
        $account_planning_sp['ws'] = getPoinAccountPlanningSp($vcif,'wallet_shares', $ap_year);
        $account_planning_sp['ca'] = getPoinAccountPlanningSp($vcif,'competition_analysis', $ap_year);

		return array_sum($account_planning_sp);
	}

	function getPoinAccountPlanningCn($vcif, $table, $ap_year) {
		global $conn;

		$sql = 'SELECT count(vcif) AS total_cn FROM '.$table.' WHERE vcif = \''.$vcif.'\' AND data_year = \''.$ap_year.'\'';

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
			if ($table == 'fundings' || $table == 'services' || $table == 'initiative_actions' || $table == 'estimated_financials') {
				$results = 15;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCn($vcif, $ap_year) {
        $account_planning_ci['fundings'] = getPoinAccountPlanningCn($vcif,'fundings', $ap_year);
        $account_planning_ci['services'] = getPoinAccountPlanningCn($vcif,'services', $ap_year);

		return array_sum($account_planning_ci);
	}

	function getTotalPoinAccountPlanningAp($vcif, $ap_year) {
        $account_planning_cn['estimated_financials'] = getPoinAccountPlanningCn($vcif,'estimated_financials', $ap_year);
        $account_planning_cn['initiative_actions'] = getPoinAccountPlanningCn($vcif,'initiative_actions', $ap_year);

		return array_sum($account_planning_cn);
	}

	function getPoinAccountPlanningCpa($vcif, $table, $bankingfacility, $ap_year) {
		global $conn;

		$sql = 'SELECT count(vcif) AS total_cpa FROM '.$table.' WHERE vcif = \''.$vcif.'\' AND data_year = \''.$ap_year.'\'';
		if ($table == 'credit_simulation_assumptions') {
			if ($bankingfacility == 'simpanan') {
				$sql .= ' AND (ftp_simpanan_idr != 0 OR ftp_simpanan_valas != 0 OR (ftp_simpanan_idr != 0 AND ftp_simpanan_valas != 0))';
			}
			elseif ($bankingfacility == 'pinjaman') {
				$sql .= ' AND (ftp_pinjaman_idr != 0 OR ftp_pinjaman_valas != 0 OR (ftp_pinjaman_idr != 0 AND ftp_pinjaman_valas != 0))';
			}
		}

		if ($table == 'credit_simulations') {
			if ($bankingfacility == '1,2') {
				$sql .= ' AND (detail_id = 1 OR detail_id = 2)';
			}
			elseif ($bankingfacility == '6,7') {
				$sql .= ' AND (detail_id = 6 OR detail_id = 7)';
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
			if ($table == 'credit_simulations' || $table == 'credit_simulation_assumptions') {
				$results = 2.5;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCpa($vcif, $ap_year) {
        $account_planning_cpa['cpa']['1,2'] = getPoinAccountPlanningCpa($vcif,'credit_simulations','1,2', $ap_year);
        $account_planning_cpa['cpa']['6,7'] = getPoinAccountPlanningCpa($vcif,'credit_simulations','6,7', $ap_year);
        $account_planning_cpa['cpa']['simpanan'] = getPoinAccountPlanningCpa($vcif,'credit_simulation_assumptions','simpanan', $ap_year);
        $account_planning_cpa['cpa']['pinjaman'] = getPoinAccountPlanningCpa($vcif,'credit_simulation_assumptions','pinjaman', $ap_year);
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