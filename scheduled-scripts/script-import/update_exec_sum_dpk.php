<?php
	echo "Importing exec_sum_dpk\n";
	$sql = "delete from exec_sum_dpk where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL
	
INSERT INTO exec_sum_dpk(year, month, division, saldo, avrgsaldo)
SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
    SUM(ISNULL(SALDO,0)) saldo, 
    SUM(ISNULL(AVRGSALDO,0)) avrgsaldo
FROM FACT_SIMPANAN_CPA
INNER JOIN VIEW_CUSTOMER_MAPPING ON 
	FACT_SIMPANAN_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF
WHERE DIV_ID IS NOT NULL
	AND YEAR(POSISI) = ?
	AND MONTH(POSISI) = ?
	AND DESC1 != 'TABUNGAN'
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID
SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported exec_sum_dpk\n";
?>