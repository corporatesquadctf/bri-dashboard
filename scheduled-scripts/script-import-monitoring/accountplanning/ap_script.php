<?php
	define('BASE_AP', dirname(dirname(__FILE__))); 
	error_reporting(-1);
        ini_set('display_errors', 1);
	
	require_once(BASE_AP.'/db_connect.php');
	require 'ap_library.php';
    $prev_year = date('Y') - 1;
    $current_year = date('Y');
    $ProcedureType = 1;
    if (isset($_GET['procedure'])) {
	    $ProcedureType = 0;
    }

	echo "Performing AP Import\n";

	// require_once 'drop_apmonitoring.php';
	// require_once 'create_apmonitoring.php';
    require_once 'get_ap_monitoring.php';
	require_once 'insert_apmonitoring.php';

	echo "AP Import Done\n";

?>