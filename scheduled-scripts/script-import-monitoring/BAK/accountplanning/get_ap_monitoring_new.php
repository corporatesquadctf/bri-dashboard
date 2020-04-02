<?php

	echo "get account_planning begin\n";
	$last_year = $current_year-1;

	$sql3 = <<<SQL
	SELECT DISTINCT "a"."AccountPlanningId", "a"."Year", "b"."VCIF", "c"."Name" AS "CustomerName", "e"."name" AS "SektorUsaha", 
		"d"."CustomerGroupId", "d"."Name" AS "GroupName", "a"."CreatedDate", "f"."DocumentStatusId", "g"."Name" AS "Status",
		"h"."UserId" AS "RMId", "i"."Name" AS "RMName", "k"."Name" AS "ClassificationName", "l"."CreatedDate" AS "PublishDate"
	from "AccountPlanning" "a" 
		LEFT JOIN "AccountPlanningCustomer" "b" on "a"."AccountPlanningId"="b"."AccountPlanningId" and "b"."IsMain"=1
		LEFT JOIN "Customer" "c" on "b"."VCIF"="c"."VCIF" and "c"."IsActive"=1
		LEFT JOIN "CustomerGroup" "d" ON "c"."CustomerGroupId"="d"."CustomerGroupId" and "d"."IsActive"=1
		LEFT JOIN "SektorUsaha" "e" ON "d"."SektorUsahaId"="e"."SektorUsahaId" and "e"."IsActive"=1
		LEFT JOIN "AccountPlanningStatus" "f" on "a"."AccountPlanningId"="f"."AccountPlanningId"
		LEFT JOIN "DocumentStatus" "g" on "f"."DocumentStatusId"="g"."DocumentStatusId" and "g"."IsActive"=1
		LEFT JOIN "AccountPlanningOwner" "h" on "a"."AccountPlanningId"="h"."AccountPlanningId" and "h"."IsActive"=1
		LEFT JOIN "User" "i" on "h"."UserId"="i"."UserId" and "i"."IsActive"=1
		LEFT JOIN "CustomerGroupClassification" "j" ON "d"."CustomerGroupId"="j"."CustomerGroupId" and "j"."Year"="a"."Year"
		LEFT JOIN "Classification" "k" on "j"."ClassificationId"="k"."ClassificationId"
		LEFT JOIN "AccountPlanningStatus" "l" ON "l"."AccountPlanningId"="a"."AccountPlanningId" and "l"."DocumentStatusId"=4
	WHERE "a"."year" = '2018' OR "a"."year" = '2019'
SQL;

	$ap_monitoring = sqlsrv_query($conn, $sql3);


?>