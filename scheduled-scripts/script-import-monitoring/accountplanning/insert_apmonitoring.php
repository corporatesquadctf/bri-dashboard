<?php

    if( $ap_monitoring === false ) {
        //insertLogImportAccountPlanning('GET Account Planning Failed', 0, $ProcedureType);
        die( print_r( sqlsrv_errors(), true));
    }

    else {
        echo "get account_planning done\n";
        require_once 'truncate_apmonitoring.php';
    	echo "Insert Table MonitoringAccountPlanning begin\n";
        $data = array(
            'ap_list' => array()
        );
        $ap_monitoring_list = array();

        while( $row_ap_monitoring = sqlsrv_fetch_array( $ap_monitoring, SQLSRV_FETCH_ASSOC) ) {
            $ap_id = $row_ap_monitoring['AccountPlanningId'];
            $vcif = $row_ap_monitoring['VCIF'];

            $DocumentStatusId = 0;
            $DocumentStatusText = 'Account Planning is created';
            $getDocumentStatus = getDocumentStatus($ap_id);
            if (!empty($getDocumentStatus['DocumentStatusId'])) {
                $DocumentStatusId   = $getDocumentStatus['DocumentStatusId'];
                $DocumentStatusText = $getDocumentStatus['Status'];
            }

            $account_planning_publish = '';
            $getDocumentStatusPublishDate = getDocumentStatusPublishDate($ap_id);
            if (!empty($getDocumentStatusPublishDate['CreatedDate'])) {
                $account_planning_publish = $getDocumentStatusPublishDate['CreatedDate']->format('Y-m-d H:i:s');
            }

            $account_planning_addon = '';
            if ($row_ap_monitoring['CreatedDate'] != '') {
                $account_planning_addon = $row_ap_monitoring['CreatedDate']->format('Y-m-d H:i:s');
            }

            $total_account_planning_prog = 100;
            // if ($ap_id==1) {
            if (!empty($vcif)) {
                $account_planning_vcif_list[$vcif] = getAccountPlanningVCIFList($ap_id);
                $account_planning_member_list[$ap_id] = getAccountPlanningMember($ap_id);
                $account_planning_checker_list[$ap_id] = getAccountPlanningChecker($ap_id);
                $account_planning_signer_list[$ap_id] = getAccountPlanningSigner($ap_id);
                foreach ($account_planning_vcif_list[$vcif] as $key => $value) {
                    $account_planning_progress[$ap_id]['ci']['GroupOverview'][$value['VCIF']] = getTotalPoinAccountPlanningCi($ap_id, 'GroupOverview', $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                    $account_planning_progress[$ap_id]['ci']['StrategicPlan'][$value['VCIF']] = getTotalPoinAccountPlanningCi($ap_id, 'StrategicPlan', $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                    $account_planning_progress[$ap_id]['ci']['CoverageMapping'][$value['VCIF']] = getTotalPoinAccountPlanningCi($ap_id, 'CoverageMapping', $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                    $account_planning_progress[$ap_id]['sp'] = getTotalPoinAccountPlanningSp($ap_id, $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                    $account_planning_progress[$ap_id]['cn'][$value['VCIF']] = getTotalPoinAccountPlanningCn($ap_id, $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                    $account_planning_progress[$ap_id]['ap'][$value['VCIF']] = getTotalPoinAccountPlanningAp($ap_id, $value['VCIF'], count($account_planning_vcif_list[$vcif]));
                }
                $account_planning_progress[$ap_id]['ci']['Shareholder'] = getTotalPoinAccountPlanningCi($ap_id, 'Shareholder');
                // echo "<pre>";
                // print_r($account_planning_progress);

                $account_planning_prog[$ap_id]['ci'] = (array_sum($account_planning_progress[$ap_id]['ci']['GroupOverview'])) + $account_planning_progress[$ap_id]['ci']['Shareholder'] + (array_sum($account_planning_progress[$ap_id]['ci']['StrategicPlan'])) + (array_sum($account_planning_progress[$ap_id]['ci']['CoverageMapping']));
                $account_planning_prog[$ap_id]['sp'] = array_sum($account_planning_progress[$ap_id]['sp']);
                $account_planning_prog[$ap_id]['cn'] = array_sum($account_planning_progress[$ap_id]['cn']);
                $account_planning_prog[$ap_id]['ap'] = array_sum($account_planning_progress[$ap_id]['ap']);

                $account_planning_prog[$ap_id]['cpa'] = getTotalPoinAccountPlanningCpa($ap_id);
                
                if ($DocumentStatusId != 4) {
                    $total_account_planning_prog = array_sum($account_planning_prog[$ap_id]);
                }
            
                insertMonitoringAccountPlanning(
                    $ap_id, 
                    $row_ap_monitoring['VCIF'], 
                    $row_ap_monitoring['CustomerName'], 
                    $row_ap_monitoring['SektorUsaha'], 
                    $row_ap_monitoring['CustomerGroupId'],
                    $row_ap_monitoring['GroupName'],
                    $row_ap_monitoring['ClassificationName'], 
                    $row_ap_monitoring['RMId'],
                    $DocumentStatusText,
                    $DocumentStatusId,
                    $account_planning_addon,
                    $account_planning_publish,
                    1,
                    json_encode($account_planning_checker_list[$ap_id]),
                    json_encode($account_planning_signer_list[$ap_id]),
                    $row_ap_monitoring['Year'],
                    $account_planning_prog[$ap_id]['ci'],
                    $account_planning_prog[$ap_id]['sp'],
                    $account_planning_prog[$ap_id]['cn'],
                    $account_planning_prog[$ap_id]['ap'],
                    $account_planning_prog[$ap_id]['cpa'],
                    $total_account_planning_prog,
                    str_replace("'", "''", $row_ap_monitoring['RMName']),
                    json_encode($account_planning_member_list[$ap_id]),
                    json_encode($account_planning_vcif_list[$vcif]),
                    $row_ap_monitoring['Uker']
                );

                $ap_monitoring_list[$vcif] = array(
                    'ap_id' => $ap_id, 
                    'vcif' => $row_ap_monitoring['VCIF'], 
                    'customer_name' => $row_ap_monitoring['CustomerName'],
                    'sektor_usaha' => $row_ap_monitoring['SektorUsaha'],
                    'group_id' => $row_ap_monitoring['CustomerGroupId'],
                    'group_name' => $row_ap_monitoring['GroupName'],
                    'clasified' => $row_ap_monitoring['ClassificationName'],
                    'doc_status' => $DocumentStatusId,
                    'doc_status_text' => $DocumentStatusText,
                    'account_planning_addon' => $account_planning_addon,
                    'account_planning_publish' => $account_planning_publish,
                    'year' => $row_ap_monitoring['Year'],
                    'rmid' => $row_ap_monitoring['RMId'],
                    // 'member' => json_encode($account_planning_member_list[$ap_id]),
                    'member' => $account_planning_member_list[$ap_id],
                    'checker_list' => json_encode($account_planning_checker_list[$ap_id]),
                    'signer_list' => json_encode($account_planning_signer_list[$ap_id]),
                    'ap_progress_company_information' => $account_planning_prog[$ap_id]['ci'],
                    'ap_progress_bri_starting_position' => $account_planning_prog[$ap_id]['sp'],
                    'ap_progress_client_needs' => $account_planning_prog[$ap_id]['cn'],
                    'ap_progress_action_plan' => $account_planning_prog[$ap_id]['ap'],
                    'ap_progress_simulasi_cpa' => $account_planning_prog[$ap_id]['cpa'],
                    'ap_progress_total' => $total_account_planning_prog,
                    'RMName' => str_replace("'", "''", $row_ap_monitoring['RMName']),
                    // 'vcif_list' => json_encode($account_planning_vcif_list[$vcif]),
                    'vcif_list' => $account_planning_vcif_list[$vcif],
                    'vcif_total' => count($account_planning_vcif_list[$vcif]),
                    'Uker' => $row_ap_monitoring['Uker']
                    );

            }
        }
         // echo "<pre>";
         // print_r($ap_monitoring_list);
    }
    sqlsrv_free_stmt($ap_monitoring);

    insertLogImportAccountPlanning('Import Monitoring Account Planning', 1, $ProcedureType);

	echo "Insert Table ap_monitoring done\n";
?>