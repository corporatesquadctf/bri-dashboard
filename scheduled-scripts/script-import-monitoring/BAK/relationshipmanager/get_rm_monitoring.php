<?php

	echo "get MonitoringRm begin\n";

	$sql3 = <<<SQL
	SELECT "users"."id", "users"."name", "users"."personal_number", "master_divisions"."division_name", "log"."addon"
	FROM "users" 
	LEFT JOIN "master_divisions" ON "master_divisions"."id" = "users"."division_id" 
	LEFT JOIN "role" ON "role"."id" = "users"."role_id" 
	LEFT JOIN "log" ON "log"."personal_number" = "users"."personal_number" AND "log"."action" = 'Get Task Profile'
	WHERE "users"."role_id" = 10
SQL;

	$rm_monitoring = sqlsrv_query( $conn, $sql3);

?>