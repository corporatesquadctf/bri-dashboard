<?php
	echo "Importing exec_sum_loany_raw\n";
	$sql = "delete from exec_sum_loany_raw where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL
	
	INSERT INTO exec_sum_loany_raw(year, month, division, pend_bunga, baki_debet_ratas)
SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
	SUM(ISNULL(PEND_BUNGA,0)) pend_bunga, 
    SUM(ISNULL(BAKI_DEBET_RATAS,0)) baki_debet_ratas
FROM FACT_KREDIT_CPA
INNER JOIN VIEW_CUSTOMER_MAPPING ON 
	FACT_KREDIT_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF
WHERE DIV_ID IS NOT NULL
	AND YEAR(POSISI) = ?
	AND MONTH(POSISI) = ?
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID
SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported exec_sum_loany_raw\n";
?>