<?php
	echo "Truncate Table MonitoringAccountPlanning begin\n";

	$sql = <<<SQL
	TRUNCATE TABLE [dbo].[MonitoringAccountPlanning]
SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
        insertLogImportAccountPlanning('Truncate Table MonitoringAccountPlanning Failed', 0);
	    die( print_r( sqlsrv_errors(), true));
	}
    sqlsrv_free_stmt($stmt);
	echo "Truncate Table MonitoringAccountPlanning done\n";
?>