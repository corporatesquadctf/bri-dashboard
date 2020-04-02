<?php

	echo "get account_planning begin\n";
	$last_year = $current_year-1;

	$sql3 = <<<SQL
	SELECT DISTINCT "a"."AccountPlanningId", "a"."Year", "a"."CreatedDate"
	, "b"."VCIF"
	, "c"."Name" AS "CustomerName"
	, "d"."CustomerGroupId", "d"."Name" AS "GroupName", "d"."ClassificationId"
	, "e"."name" AS "SektorUsaha"
	, "h"."UserId" AS "RMId", "h"."LastView"
	, "i"."Name" AS "RMName", "i"."UnitKerjaId" AS "Uker"
	, "k"."Name" AS "ClassificationName"
	, "l"."CreatedDate" AS "PublishDate"
	from "AccountPlanning" "a" 
		LEFT JOIN "AccountPlanningCustomer" "b" on "a"."AccountPlanningId"="b"."AccountPlanningId" and "b"."IsMain"=1
		LEFT JOIN "CustomerKorporasi" "c" on "b"."VCIF"="c"."VCIF"
		LEFT JOIN "CustomerGroup" "d" ON "c"."CustomerGroupId"="d"."CustomerGroupId"
		LEFT JOIN "SektorUsaha" "e" ON "d"."SektorUsahaId"="e"."SektorUsahaId" and "e"."IsActive"=1
		LEFT JOIN "AccountPlanningOwner" "h" on "a"."AccountPlanningId"="h"."AccountPlanningId" and "h"."IsActive"=1
		LEFT JOIN "User" "i" on "h"."UserId"="i"."UserId" and "i"."IsActive"=1
		-- LEFT JOIN "CustomerGroupClassification" "j" ON "d"."CustomerGroupId"="j"."CustomerGroupId" and "j"."Year"="a"."Year"
		LEFT JOIN "Classification" "k" on "d"."ClassificationId"="k"."ClassificationId"
		LEFT JOIN "AccountPlanningStatus" "l" ON "l"."AccountPlanningId"="a"."AccountPlanningId" and "l"."DocumentStatusId"=4
	WHERE "a"."year" = '$last_year' OR "a"."year" = '$current_year'
SQL;


// echo $sql3;


	$ap_monitoring = sqlsrv_query($conn, $sql3);


?>