<?php

    if( $ap_monitoring === false ) {
        insertLogImportAccountPlanning('GET Account Planning Failed', 0, $ProcedureType);
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
            $ap_id = $row_ap_monitoring['id'];
            $vcif = $row_ap_monitoring['vcif'];
            $addby = $row_ap_monitoring['addby'];
            $doc_status = $row_ap_monitoring['doc_status'];
            $account_planning_addon = '';
            if ($row_ap_monitoring['account_planning_addon'] != '') {
                $account_planning_addon = $row_ap_monitoring['account_planning_addon']->format('Y-m-d H:i:s');
            }
            $account_planning_publish = '';
            if ($row_ap_monitoring['account_planning_publish'] != '') {
                $account_planning_publish = $row_ap_monitoring['account_planning_publish']->format('Y-m-d H:i:s');
            }
            $total_account_planning_prog = 100;
            if (!key_exists($vcif, $data['ap_list'])) {
                $account_planning_cif_list[$vcif] = getAccountPlanningCiv($vcif);
                $account_planning_rm_list[$vcif] = getAccountPlanningRm($vcif);
                $account_planning_checker_list[$vcif] = getAccountPlanningChecker($vcif, $ap_id);
                $account_planning_signer_list[$vcif] = getAccountPlanningSigner($vcif, $ap_id);
                $account_planning_prog['ci'] = getTotalPoinAccountPlanningCi($vcif, $row_ap_monitoring['year']);
                $account_planning_prog['sp'] = getTotalPoinAccountPlanningSp($vcif, $row_ap_monitoring['year']);
                $account_planning_prog['cn'] = getTotalPoinAccountPlanningCn($vcif, $row_ap_monitoring['year']);
                $account_planning_prog['ap'] = getTotalPoinAccountPlanningAp($vcif, $row_ap_monitoring['year']);
                $account_planning_prog['cpa'] = getTotalPoinAccountPlanningCpa($vcif, $row_ap_monitoring['year']);
                $account_planning_prog['checker'] = 0;
                $account_planning_prog['signer'] = 0;
                if ($doc_status == 0) {
                    $doc_status_text = 'Disposisi';
                }
                elseif ($doc_status == 1) {
                    $doc_status_text = 'Draft';
                }
                elseif ($doc_status == 2) {
                    $doc_status_text = 'Waiting Approval By Checker';
                }
                elseif ($doc_status == 3) {
                    $doc_status_text = 'Waiting Approval By Signer';
                }
                elseif ($doc_status == 4) {
                    $doc_status_text = 'Publish';
                }
                elseif ($doc_status == 5) {
                    $doc_status_text = 'Reject by Checker';
                }
                elseif ($doc_status == 6) {
                    $doc_status_text = 'Reject by Signer';
                }

                if ($row_ap_monitoring['doc_status'] != 4) {
                    $total_account_planning_prog = array_sum($account_planning_prog);
                }
            
                insertMonitoringAccountPlanning(
                    $ap_id, 
                    $row_ap_monitoring['vcif'], 
                    $row_ap_monitoring['customer_name'], 
                    '', 
                    $row_ap_monitoring['id_group'],
                    json_encode($account_planning_cif_list[$vcif]),
                    $row_ap_monitoring['group_name'],
                    '', 
                    $row_ap_monitoring['addby'],
                    $row_ap_monitoring['status'],
                    $row_ap_monitoring['doc_status'],
                    $doc_status_text,
                    $account_planning_addon,
                    $account_planning_publish,
                    json_encode($account_planning_checker_list[$vcif]),
                    json_encode($account_planning_signer_list[$vcif]),
                    $row_ap_monitoring['year'],
                    count($account_planning_rm_list[$vcif]),
                    json_encode($account_planning_rm_list[$vcif]),
                    $account_planning_prog['ci'],
                    $account_planning_prog['sp'],
                    $account_planning_prog['cn'],
                    $account_planning_prog['ap'],
                    $account_planning_prog['cpa'],
                    $total_account_planning_prog
                );

/*
                $ap_monitoring_list[$vcif] = array(
                    'vcif' => $row_ap_monitoring['vcif'], 
                    'customer_name' => $row_ap_monitoring['customer_name'],
                    'sektor_usaha' => '',
                    'group_id' => $row_ap_monitoring['id_group'],
                    'cif' => json_encode($account_planning_cif_list[$vcif]),
                    'group_name' => $row_ap_monitoring['group_name'],
                    'clasified' => '',
                    'addby' => $addby,
                    'status' => $row_ap_monitoring['status'],
                    'doc_status' => $row_ap_monitoring['doc_status'],
                    'doc_status_text' => $doc_status_text,
                    'account_planning_addon' => $account_planning_addon,
                    'account_planning_publish' => $account_planning_publish,
                    'checker_list' => json_encode($account_planning_checker_list[$vcif]),
                    'signer_list' => json_encode($account_planning_signer_list[$vcif]),
                    'year' => $row_ap_monitoring['year'],
                    'rm_total' => count($account_planning_rm_list[$vcif]),
                    'rm_list' => json_encode($account_planning_rm_list[$vcif]),
                    'ap_progress_company_information' => $account_planning_prog['ci'],
                    'ap_progress_bri_starting_position' => $account_planning_prog['sp'],
                    'ap_progress_client_needs' => $account_planning_prog['cn'],
                    'ap_progress_action_plan' => $account_planning_prog['ap'],
                    'ap_progress_simulasi_cpa' => $account_planning_prog['cpa'],
                    'ap_progress_total' => $total_account_planning_prog
                    );
*/
            }
        }
        // echo "<pre>";
        // print_r($ap_monitoring_list);
    }
    sqlsrv_free_stmt($ap_monitoring);

    insertLogImportAccountPlanning('Import Monitoring Account Planning', 1, $ProcedureType);

	echo "Insert Table ap_monitoring done\n";
?>