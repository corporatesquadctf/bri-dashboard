<?php
	echo "Importing exec_sum_customer_profit\n";
	$sql = "delete from exec_sum_customer_profit where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL
	
	INSERT INTO exec_sum_customer_profit(year, month, division, setelah_modal)
SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
    SUM(ISNULL(LABA_RUGI_FTP_SETELAH_MODAL,0)) setelah_modal
FROM FACT_SUMMARY_LABA_RUGI
INNER JOIN VIEW_CUSTOMER_MAPPING ON 
	FACT_SUMMARY_LABA_RUGI.CIFNO = VIEW_CUSTOMER_MAPPING.CIF
WHERE DIV_ID IS NOT NULL
	AND YEAR(POSISI) = ?
	AND MONTH(POSISI) = ?
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID
SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported exec_sum_customer_profit\n";
?>