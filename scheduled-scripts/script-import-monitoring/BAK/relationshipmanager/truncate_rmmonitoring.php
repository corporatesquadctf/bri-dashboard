<?php
	echo "Truncate Table MonitoringRm begin\n";

	$sql = <<<SQL
	TRUNCATE TABLE [dbo].[MonitoringRm]
SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
        insertLogImportRM('Truncate Table MonitoringRm Failed', 0);
	    die( print_r( sqlsrv_errors(), true));
	}
    sqlsrv_free_stmt($stmt);
	echo "Truncate Table MonitoringRm done\n";
?>