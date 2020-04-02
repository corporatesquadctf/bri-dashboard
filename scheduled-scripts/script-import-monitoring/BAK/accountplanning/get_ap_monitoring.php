<?php

	echo "get account_planning begin\n";
	$last_year = $current_year-1;

	$sql3 = <<<SQL
	SELECT DISTINCT "account_plannings"."id", "account_plannings"."vcif", "account_plannings"."customer_name", "account_plannings"."addby", "account_plannings"."status", "account_plannings"."year", "account_plannings"."doc_status", "account_plannings"."addon" AS "account_planning_addon", "log"."addon" AS "account_planning_publish", "par_mapping_vcif"."group_name", "par_group_detail_cif"."id_group","par_group"."nama_group" 
	FROM "account_plannings" 
	LEFT JOIN "log" ON "log"."action" = 'Signed Account Planning' AND  "log"."change" like CONCAT('%', "account_plannings"."vcif", '%') 
	LEFT JOIN "par_mapping_vcif" ON "par_mapping_vcif"."vcif" = "account_plannings"."vcif" 
	LEFT JOIN "par_group_detail_cif" ON "par_group_detail_cif"."cifno" = "par_mapping_vcif"."cif" 
	LEFT JOIN "par_group" ON "par_group"."id_group" = "par_group_detail_cif"."id_group" 
	WHERE "account_plannings"."year" = '$last_year' OR "account_plannings"."year" = '$current_year'
SQL;


	$ap_monitoring = sqlsrv_query($conn, $sql3);


?>