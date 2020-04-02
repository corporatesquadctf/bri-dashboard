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

            $doc_status = $row_ap_monitoring['Status'];
            $account_planning_addon = '';
            if ($row_ap_monitoring['CreatedDate'] != '') {
                $account_planning_addon = $row_ap_monitoring['CreatedDate']->format('Y-m-d H:i:s');
            }
            $account_planning_publish = '';
            if ($row_ap_monitoring['PublishDate'] != '') {
                $account_planning_publish = $row_ap_monitoring['PublishDate']->format('Y-m-d H:i:s');
            }
            $total_account_planning_prog = 100;
            if (!key_exists($vcif, $data['ap_list'])) {
                $account_planning_member_list[$ap_id] = getAccountPlanningMember($ap_id);
                $account_planning_checker_list[$ap_id] = getAccountPlanningChecker($ap_id);
                $account_planning_signer_list[$ap_id] = getAccountPlanningSigner($ap_id);
                $account_planning_cif_list[$vcif] = getAccountPlanningCif($vcif);
                $account_planning_prog['ci'] = getTotalPoinAccountPlanningCi($ap_id);
                $account_planning_prog['sp'] = getTotalPoinAccountPlanningSp($ap_id);
                $account_planning_prog['cn'] = getTotalPoinAccountPlanningCn($ap_id);
                $account_planning_prog['ap'] = getTotalPoinAccountPlanningAp($ap_id);
                $account_planning_prog['cpa'] = getTotalPoinAccountPlanningCpa($ap_id);
                
                if ($row_ap_monitoring['Status'] != 4) {
                    $total_account_planning_prog = array_sum($account_planning_prog);
                }
            
                /*insertMonitoringAccountPlanning(
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
                );*/


                $ap_monitoring_list[$vcif] = array(
                    'vcif' => $row_ap_monitoring['VCIF'], 
                    'customer_name' => $row_ap_monitoring['CustomerName'],
                    'sektor_usaha' => $row_ap_monitoring['SektorUsaha'],
                    'group_id' => $row_ap_monitoring['CustomerGroupId'],
                    'cif' => json_encode($account_planning_cif_list[$vcif]),
                    'group_name' => $row_ap_monitoring['GroupName'],
                    'clasified' => $row_ap_monitoring['ClassificationName'],
                    'doc_status' => $row_ap_monitoring['DocumentStatusId'],
                    'doc_status_text' => $row_ap_monitoring['Status'],
                    'account_planning_addon' => $row_ap_monitoring['CreatedDate'],
                    'account_planning_publish' => $account_planning_publish,
                    'year' => $row_ap_monitoring['Year'],
                    'rmid' => $row_ap_monitoring['RMId'],
                    'rm' => $row_ap_monitoring['RMName'],
                    'member' => json_encode($account_planning_member_list[$ap_id]),
                    'checker_list' => json_encode($account_planning_checker_list[$ap_id]),
                    'signer_list' => json_encode($account_planning_signer_list[$ap_id]),
                    'ap_progress_company_information' => $account_planning_prog['ci'],
                    'ap_progress_bri_starting_position' => $account_planning_prog['sp'],
                    'ap_progress_client_needs' => $account_planning_prog['cn'],
                    'ap_progress_action_plan' => $account_planning_prog['ap'],
                    'ap_progress_simulasi_cpa' => $account_planning_prog['cpa'],
                    'ap_progress_total' => $total_account_planning_prog
                    );

            }
        }
         echo "<pre>";
         print_r($ap_monitoring_list);
    }
    sqlsrv_free_stmt($ap_monitoring);

    //insertLogImportAccountPlanning('Import Monitoring Account Planning', 1, $ProcedureType);

	echo "Insert Table ap_monitoring done\n";
?>