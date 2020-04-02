<?php
	echo "Drop Table MonitoringRm begin\n";

	$sql = <<<SQL
	DROP TABLE [dbo].[MonitoringRm]
SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Drop Table MonitoringRm done\n";
?>