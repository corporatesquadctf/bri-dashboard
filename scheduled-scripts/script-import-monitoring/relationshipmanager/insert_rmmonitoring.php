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
            $rm_id = $row_rm_monitoring['UserId'];
            //$vcif = $row_rm_monitoring['id'];
            $ap_years = array($prev_year, $current_year);
            $last_activity = '';
            if ($row_rm_monitoring['LastAccess'] != '') {
                $last_activity = $row_rm_monitoring['LastAccess']->format('Y-m-d H:i:s');
            }
            if (!key_exists($rm_id, $data['rmusers'])) {
            // if ($rm_id=='00088375') {

                foreach ($ap_years as  $ap_year) {
                    $ap_draft_list[$rm_id] = array();
                    $ap_wa_list[$rm_id] = array();
                    $ap_publish_list[$rm_id] = array();
                    $ap_reject_list[$rm_id] = array();

                    $account_planning_list[$rm_id] = getAccountPlanningList($rm_id, $ap_year);

                    // echo "<pre>";
                    // print_r($account_planning_list);
                    if (!empty($account_planning_list[$rm_id])) {
                        // $account_planning_total = count($account_planning_list[$rm_id]);

                        foreach ($account_planning_list[$rm_id] as $key => $value) {
                            if (!empty($value['ap_id'])) {
                            $account_planning_status[$ap_year][$value['ap_id']] = getDocumentStatus2($value['ap_id']);
                            $account_planning_progress[$ap_year][$value['ap_id']] = getAccountPlanningProgress($value['ap_id']);
                            $account_planning_list[$rm_id][$key]['doc_status'] = $account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'];
                            $account_planning_list[$rm_id][$key]['progress'] = $account_planning_progress[$ap_year][$value['ap_id']];

                            if ($account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 0 || $account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 1) {
                                // echo "<br>".$value['ap_id'];
                                $ap_draft_list[$rm_id][] = array($value['ap_id']);
                            }
                            if ($account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 2 || $account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 3) {
                                // echo "<br>".$value['ap_id'];
                                $ap_wa_list[$rm_id][] = array($value['ap_id']);
                            }
                            if ($account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 4) {
                                // echo "<br>".$value['ap_id'];
                                $ap_publish_list[$rm_id][] = array($value['ap_id']);
                            }
                            if ($account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 5 || $account_planning_status[$ap_year][$value['ap_id']]['DocumentStatusId'] == 6) {
                                // echo "<br>".$value['ap_id'];
                                $ap_reject_list[$rm_id][] = array($value['ap_id']);
                            }
                            }
                        }
                    }
                    

                    $account_planning_draft_list[$rm_id] = count($ap_draft_list[$rm_id]);
                    $account_planning_wa_list[$rm_id] = count($ap_wa_list[$rm_id]);
                    $account_planning_publish_list[$rm_id] = count($ap_publish_list[$rm_id]);
                    $account_planning_reject_list[$rm_id] = count($ap_reject_list[$rm_id]);

                    // echo "<br>account_planning_draft_list:".$account_planning_draft_list[$rm_id];
                    // echo "<br>account_planning_wa_list:".$account_planning_wa_list[$rm_id];
                    // echo "<br>account_planning_publish_list:".$account_planning_publish_list[$rm_id];
                    // echo "<br>account_planning_reject_list:".$account_planning_reject_list[$rm_id];

                    $account_planning_progress[$rm_id] = getTotalProgressAccountPlanning($rm_id, $account_planning_list[$rm_id]);
                    
                    insertMonitoringRm(
                        str_replace("'", "''", $row_rm_monitoring['Name']), 
                        $row_rm_monitoring['UserId'], 
                        $row_rm_monitoring['UnitKerja'], 
                        $last_activity,
                        $ap_year, 
                        count( $account_planning_list[$rm_id]), 
                        json_encode($account_planning_list[$rm_id]), 
                        $account_planning_publish_list[$rm_id],
                        $account_planning_wa_list[$rm_id],
                        $account_planning_draft_list[$rm_id],
                        $account_planning_reject_list[$rm_id],
                        $account_planning_progress[$rm_id]
                    );

                    $params['results'][$ap_year][$rm_id] = array(
                        'rm_name' => $row_rm_monitoring['Name'],
                        'personal_number' => $row_rm_monitoring['UserId'],
                        'division' => $row_rm_monitoring['UnitKerja'],
                        'last_activity' => $last_activity,
                        'year' => $ap_year,
                        'account_planning_publish' => $account_planning_publish_list[$rm_id],
                        'account_planning_wa' => $account_planning_wa_list[$rm_id],
                        'account_planning_draft' => $account_planning_draft_list[$rm_id],
                        'account_planning_reject' => $account_planning_reject_list[$rm_id],
                        'account_planning_progress' => $account_planning_progress[$rm_id],
                        'account_planning_total' => count( $account_planning_list[$rm_id]),
                        // 'account_planning_list' => json_encode($account_planning_list[$rm_id])
                        'account_planning_list' => $account_planning_list[$rm_id]
                    );

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