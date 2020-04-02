<?php

	echo "get MonitoringRm begin\n";

	$sql3 = <<<SQL
	SELECT "A"."UserId", "A"."Name", "B"."Name" "UnitKerja", "A"."LastLogin" "LastAccess"
	FROM "User" "A"
	LEFT JOIN "UnitKerja" "B" on "A"."UnitKerjaId"="B"."UnitKerjaId"
	LEFT JOIN "Log" "C" on "A"."UserId"="C"."CreatedBy" and "C"."Action"='Get Task Profile'
	WHERE "A"."RoleId"=10
SQL;

	$rm_monitoring = sqlsrv_query( $conn, $sql3);

?>