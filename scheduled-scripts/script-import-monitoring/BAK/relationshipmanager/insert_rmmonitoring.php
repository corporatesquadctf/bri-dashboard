<?php

    if( $rm_monitoring === false ) {
        insertLogImportRM('GET RM Failed', 0, $ProcedureType);
        die( print_r( sqlsrv_errors(), true));
    }

    else {
        echo "get MonitoringRm done\n";
        require_once 'truncate_rmmonitoring.php';
        echo "Insert Table MonitoringRm begin\n";
        $params = array();
        $account_planning_list = array();
        $data = array(
            'rmusers' => array()
        );
        while( $row_rm_monitoring = sqlsrv_fetch_array( $rm_monitoring, SQLSRV_FETCH_ASSOC) ) {
            $rm_id = $row_rm_monitoring['id'];
            $vcif = $row_rm_monitoring['id'];
            $ap_years = array($prev_year, $current_year);
            $last_activity = '';
            if ($row_rm_monitoring['addon'] != '') {
                $last_activity = $row_rm_monitoring['addon']->format('Y-m-d H:i:s');
            }
            if (!key_exists($rm_id, $data['rmusers'])) {

                foreach ($ap_years as  $ap_year) {
                    $account_planning_publish = '0';
                    $account_planning_wa = '0';
                    $account_planning_draft = '0';
                    $account_planning_reject = '0';

                    $account_planning_list[$rm_id] = getAccountPlanningList($rm_id, $ap_year);
                    if (!empty($account_planning_list[$rm_id])) {
                        $account_planning_total = count($account_planning_list[$rm_id]);
                    }
                    if (!empty(count(getAccountPlanningPublish($rm_id, $ap_year)))) {
                        $account_planning_publish = count(getAccountPlanningPublish($rm_id, $ap_year));
                    }
                    if (!empty(count(getAccountPlanningWa($rm_id, $ap_year)))) {
                        $account_planning_wa = count(getAccountPlanningWa($rm_id, $ap_year));
                    }
                    if (!empty(count(getAccountPlanningDraft($rm_id, $ap_year)))) {
                        $account_planning_draft = count(getAccountPlanningDraft($rm_id, $ap_year));
                    }
                    if (!empty(count(getAccountPlanningReject($rm_id, $ap_year)))) {
                        $account_planning_reject = count(getAccountPlanningReject($rm_id, $ap_year));
                    }

                    $account_planning_vcif[$rm_id] = getAccountPlanningVcif($rm_id, $account_planning_list[$rm_id]);
                    $account_planning_progress[$rm_id] = getTotalProgressAccountPlanning($rm_id, $account_planning_list[$rm_id], $ap_year);

                    insertMonitoringRm(
                        str_replace("'", "''", $row_rm_monitoring['name']), 
                        $row_rm_monitoring['personal_number'], 
                        $row_rm_monitoring['division_name'], 
                        $last_activity,
                        $ap_year, 
                        $account_planning_total, 
                        json_encode($account_planning_list[$rm_id]), 
                        $account_planning_publish, 
                        $account_planning_wa, 
                        $account_planning_draft, 
                        $account_planning_reject, 
                        $account_planning_progress[$rm_id]
                    );
/*
                    $params['results'][$ap_year][$rm_id] = array(
                        'rm_name' => $row_rm_monitoring['name'],
                        'personal_number' => $row_rm_monitoring['personal_number'],
                        'division' => $row_rm_monitoring['division_name'],
                        'last_activity' => $last_activity,
                        'year' => $ap_year,
                        'account_planning_total' => count( $account_planning_list[$rm_id]),
                        'account_planning_vcif' => $account_planning_vcif[$rm_id],
                        // 'account_planning_list' => json_encode($account_planning_list[$rm_id]),
                        'account_planning_list' => $account_planning_list[$rm_id],
                        'account_planning_publish' => count($account_planning_publish[$rm_id]),
                        'account_planning_wa' => count($account_planning_wa[$rm_id]),
                        'account_planning_draft' => count($account_planning_draft[$rm_id]),
                        'account_planning_reject' => count($account_planning_reject[$rm_id]),
                        'account_planning_progress' => $account_planning_progress[$rm_id]
                    );
*/
                }
            }
        }
        // echo "<pre>";
        // print_r($params['results']);
    }
    
    sqlsrv_free_stmt($rm_monitoring);

    insertLogImportRM('Import Monitoring RM', 1, $ProcedureType);

    echo "Insert Table MonitoringRm done\n";
?>