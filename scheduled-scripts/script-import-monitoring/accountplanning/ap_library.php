<?php


    function getAccountPlanningVCIFList($AccountPlanningId) {
		global $conn;
        $sql = 'SELECT "a"."VCIF", "a"."IsMain", "b"."Name"
                FROM "AccountPlanningCustomer" "a"
                LEFT JOIN "CustomerKorporasi" "b" on "a"."VCIF"="b"."VCIF"
                WHERE "a"."AccountPlanningId" ='. $AccountPlanningId.'
                ORDER BY b.Name';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}

		$results = array();
		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'VCIF' => $row['VCIF'],
				'IsMain' => $row['IsMain'],
				'Name' =>  $row['Name']
			);
		}

		return $results;
    }


    function getDocumentStatusPublishDate($AccountPlanningId) {
		global $conn;
        $sql = 'SELECT 
            "d"."CreatedDate"
            FROM "AccountPlanningStatus" "d"
            WHERE "d"."AccountPlanningId" = '.$AccountPlanningId.' AND DocumentStatusId = 4
            ORDER BY AccountPlanningStatusId DESC
        ';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}

		$results = array();
		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results['CreatedDate'] = $row['CreatedDate'];
		}

		return $results;
    }


    function getDocumentStatus($AccountPlanningId) {
		global $conn;
        $sql = 'SELECT 
            "d"."DocumentStatusId",
            "e"."Name" AS "Status"
            FROM "AccountPlanningStatus" "d"
            LEFT JOIN "DocumentStatus" "e" ON "d"."DocumentStatusId"="e"."DocumentStatusId"
            WHERE "d"."AccountPlanningId" = '.$AccountPlanningId.'
            ORDER BY AccountPlanningStatusId ASC
        ';

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

		$sql = 'SELECT "b"."VCIF", "a"."CIF", "a"."Name"
				from "DetailCustomerKorporasi" "a", "CustomerKorporasi" "b"
				where "a"."VCIF"="b"."VCIF"
				and "b"."VCIF"=\''.$vcif.'\'';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$results = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$results[] = array(
				'nama' => $row['Name'],
				'cif' => $row['CIF']
			);
		}

		return $results;
	}

	function getPoinAccountPlanningCi($AccountPlanningId, $table, $Vcif='', $Vcif_total='') {
		global $conn;

		$sql = 'SELECT count(accountPlanningId) AS total_ci FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;

		if ($table != 'Shareholder') {
			$sql .= ' AND VCIF = \''.$Vcif.'\'';
		}
		// echo "<br>".$sql;

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_ci = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_ci = $row['total_ci'];
		}

		$results = countPoinAccountPlanningCi($sum_ci, $table, $Vcif_total);

		return $results;
	}

	function countPoinAccountPlanningCi($total_ci, $table, $Vcif_total='') {
		$results = 0;
		if ($total_ci >= '1') {
			if ($table == 'StrategicPlan') {
				$results = 2 / $Vcif_total;
			}
			elseif ($table == 'Shareholder') {
				$results = 1;
			}
			else {
				$results = 1 / $Vcif_total;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCi($AccountPlanningId, $table, $Vcif='', $Vcif_total='') {
        $account_planning_ci = getPoinAccountPlanningCi($AccountPlanningId, $table, $Vcif, $Vcif_total);

		return $account_planning_ci;
	}

	function getPoinAccountPlanningSp($AccountPlanningId, $table, $Vcif, $Vcif_total) {
		global $conn;

		
		if ($table == 'FinancialHighlight') {
			$sql = 'SELECT count(a.AccountPlanningId) AS total_sp FROM '.$table.' a, AccountPlanning b
				WHERE a.accountPlanningId = '.$AccountPlanningId.' AND a.AccountPlanningId=b.AccountPlanningId 
				AND a.[year]=b.[year]-1';
		}
		else {
			$sql = 'SELECT count(AccountPlanningId) AS total_sp FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId;
		}
		if ($table != 'CompetitionAnalysis' && $table != 'FinancialHighlight') {
			$sql .= ' AND VCIF = \''.$Vcif.'\'';
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

		$results = poinAccountPlanningSp($sum_sp, $table, $Vcif_total);

		return $results;
	}

	function poinAccountPlanningSp($total_sp, $table, $Vcif_total) {
		$results = 0;
		if ($table == 'FinancialHighlight' && $total_sp >= 1) {
			$results = ($total_sp * 0.2);
			if ($total_sp >= 25) {
				$results = 5;
			}
		}
		elseif (($table == 'BankFacility') && $total_sp >= 1) {
			$results = 5 / $Vcif_total;
		}
		elseif ($table == 'WalletShare' && $total_sp >= 1) {
			$results = 10 / $Vcif_total;
		}
		elseif (($table == 'CompetitionAnalysis') && $total_sp >= 1) {
			$results = 5;
		}

		return $results;
	}


	function getTotalPoinAccountPlanningSp($AccountPlanningId, $Vcif, $Vcif_total) {
        $account_planning_sp['fh'] = getPoinAccountPlanningSp($AccountPlanningId,'FinancialHighlight', $Vcif, $Vcif_total);
        $account_planning_sp['fb'] = getPoinAccountPlanningSp($AccountPlanningId,'BankFacility', $Vcif, $Vcif_total);
        $account_planning_sp['ws'] = getPoinAccountPlanningSp($AccountPlanningId,'WalletShare', $Vcif, $Vcif_total);
        $account_planning_sp['ca'] = getPoinAccountPlanningSp($AccountPlanningId,'CompetitionAnalysis', $Vcif, $Vcif_total);

		return $account_planning_sp;
	}

	function getPoinAccountPlanningCn($AccountPlanningId, $table, $Vcif, $Vcif_total) {
		global $conn;

		$sql = 'SELECT count(AccountPlanningId) AS total_cn FROM '.$table.' WHERE accountPlanningId = '.$AccountPlanningId.' AND VCIF = \''.$Vcif.'\'';

		$result = sqlsrv_query( $conn, $sql);
		if( $result === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		$sum_cn = array();

		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
			$sum_cn = $row['total_cn'];
		}

		$results = poinAccountPlanningCn($sum_cn, $table, $Vcif_total);

		return $results;
	}

	function poinAccountPlanningCn($total_cn, $table, $Vcif_total) {
		$results = 0;
		if ($total_cn >= '1') {
			if ($table == 'Funding' || $table == 'Service' || $table == 'InitiativeAction' || $table == 'EstimatedFinancial') {
				$results = 15 / $Vcif_total;
			}
		}

		return $results;
	}

	function getTotalPoinAccountPlanningCn($AccountPlanningId, $Vcif, $Vcif_total) {
        $account_planning_cn['fundings'] = getPoinAccountPlanningCn($AccountPlanningId, 'Funding', $Vcif, $Vcif_total);
        $account_planning_cn['services'] = getPoinAccountPlanningCn($AccountPlanningId, 'Service', $Vcif, $Vcif_total);

		return array_sum($account_planning_cn);
	}

	function getTotalPoinAccountPlanningAp($AccountPlanningId, $Vcif, $Vcif_total) {
        $account_planning_ap['estimated_financials'] = getPoinAccountPlanningCn($AccountPlanningId,'EstimatedFinancial', $Vcif, $Vcif_total);
        $account_planning_ap['initiative_actions'] = getPoinAccountPlanningCn($AccountPlanningId,'InitiativeAction', $Vcif, $Vcif_total);

		return array_sum($account_planning_ap);
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

		return $account_planning_cpa['total_cpa'];
	}

	function insertMonitoringAccountPlanning($AccountPlanningId, $vcif, $customer_name, $sektor_usaha, $group_id, $group_name, $clasified, $addby, $status, $doc_status, $account_planning_addon, $account_planning_publish, $IsMain, $checker_list, $signer_list, $year, $ap_progress_company_information, $ap_progress_bri_starting_position, $ap_progress_client_needs, $ap_progress_action_plan, $ap_progress_simulasi_cpa, $ap_progress_total='', $rm_name, $member='', $vcif_list, $uker) {
		global $conn;

		$sql = '
		INSERT INTO "MonitoringAccountPlanning" (
		"AccountPlanningId", 
		"Vcif", 
		"CustomerName", 
		"SektorUsaha", 
		"Groupid", 
		"GroupName", 
		"Clasified", 
		"AddBy", 
		"Status", 
		"DocumentStatusId", 
		"AccountPlanningAddon", 
		"AccountPlanningPublish",
		"IsMain",
		"CheckerPn",
		"SignerPn",
		"Year", 
		"ProgressCompanyInformation", 
		"ProgressBriStartingPosition", 
		"ProgressClientNeeds", 
		"ProgressActionPlan", 
		"ProgressSimulationsCpa", 
		"ProgressTotal",
		"RMName",
		"Member",
		"VCIFList",
		"Uker"
		) 
		VALUES (
		'.$AccountPlanningId.', 
		\''.$vcif.'\', 
		\''.$customer_name.'\', 
		\''.$sektor_usaha.'\', 
		\''.$group_id.'\', 
		\''.$group_name.'\', 
		\''.$clasified.'\', 
		\''.$addby.'\',
		\''.$status.'\',
		\''.$doc_status.'\',
		\''.$account_planning_addon.'\',
		\''.$account_planning_publish.'\',
		1,
		\''.$checker_list.'\',
		\''.$signer_list.'\',
		\''.$year.'\',
		\''.$ap_progress_company_information.'\',
		\''.$ap_progress_bri_starting_position.'\',
		\''.$ap_progress_client_needs.'\',
		\''.$ap_progress_action_plan.'\',
		\''.$ap_progress_simulasi_cpa.'\',
		\''.$ap_progress_total.'\',
		\''.$rm_name.'\',
		\''.$member.'\',
		\''.$vcif_list.'\',
		\''.$uker.'\'
		)
		';
		// echo "<br>".$sql; die();

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
	        insertLogImportAccountPlanning('insert MonitoringAccountPlanning Failed AccountPlanningId='.$AccountPlanningId, 0, 1);
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