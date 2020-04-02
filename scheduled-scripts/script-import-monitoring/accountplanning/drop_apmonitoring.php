<?php
	echo "Drop Table MonitoringAccountPlanning begin\n";

	$sql = <<<SQL
	DROP TABLE [dbo].[MonitoringAccountPlanning]
SQL;

	$stmt = sqlsrv_query( $conn, $sql);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}
	echo "Drop Table MonitoringAccountPlanning done\n";
?>