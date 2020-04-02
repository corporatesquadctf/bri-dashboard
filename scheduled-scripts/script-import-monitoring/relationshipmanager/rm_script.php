<?php
	define('BASE_RM', dirname(dirname(__FILE__))); 
	error_reporting(-1);
        ini_set('display_errors', 1);

	require_once(BASE_RM.'/db_connect.php');

	require 'rm_library.php';
    $prev_year = date('Y') - 1;
    $current_year = date('Y');
    $ProcedureType = 1;
    if (isset($_GET['procedure'])) {
	    $ProcedureType = 0;
    }

	echo "Performing RM Import\n";

	// require_once 'drop_rmmonitoring.php';
	// require_once 'create_rmmonitoring.php';
    require_once 'get_rm_monitoring.php';
	require_once 'insert_rmmonitoring.php';

	echo "RM Import Done\n";

?>