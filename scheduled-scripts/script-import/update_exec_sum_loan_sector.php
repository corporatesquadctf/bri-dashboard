<?php
	echo "Importing exec_sum_loan_sector\n";
	$sql = "delete from exec_sum_loan_sector where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL

insert into exec_sum_loan_sector(year, month, division, jenis, baki_debet, rek)

select 
	YEAR(POSISI) year, 
	MONTH(POSISI) month,
	DIV_ID division,
	JENIS_PENGGUNAAN jenis,
	sum(isnull(baki_debet, 0)) baki_debet, 
	count(1) rek
from fact_kredit_cpa
	    
INNER JOIN VIEW_CUSTOMER_MAPPING 
ON FACT_KREDIT_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF

WHERE DIV_ID IS NOT NULL
	AND YEAR(POSISI) = ?
	AND MONTH(POSISI) = ?

GROUP BY 
	YEAR(POSISI), 
	MONTH(POSISI), 
	DIV_ID, 
	JENIS_PENGGUNAAN

SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported exec_sum_loan_sector\n";
?>