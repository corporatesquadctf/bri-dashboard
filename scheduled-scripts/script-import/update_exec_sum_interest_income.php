<?php
	echo "Importing exec_sum_interest_income\n";
	$sql = "delete from exec_sum_interest_income where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL
	
	INSERT INTO exec_sum_interest_income(year, month, division, bunga, bunga_total)
SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
	SUM(ISNULL(PEND_BUNGA,0)) bunga, 
    SUM(ISNULL(PEND_BUNGA_AKUMULASI,0)) bunga_total
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
	echo "Imported exec_sum_interest_income\n";
?>