<?php
	echo "Importing exec_sum_classified_loan\n";
	$sql = "delete from exec_sum_classified_loan where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL

insert into exec_sum_classified_loan(year, month, division, kolektibilitas, baki_debet, total_rekening)
	
select 
	YEAR(POSISI) year, 
	MONTH(POSISI) month,
	DIV_ID division,
	master_labels.label_name kolektibilitas,
	sum(isnull(baki_debet, 0)) baki_debet, 
	count(1) total_rekening		
from fact_kredit_cpa
	
inner join master_labels 
on fact_kredit_cpa.kolektibilitas  = master_labels.label_value			
	and master_labels.group_id = 'KOLEKTIBILITAS'
    
INNER JOIN VIEW_CUSTOMER_MAPPING 
ON FACT_KREDIT_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF

WHERE DIV_ID IS NOT NULL
	AND YEAR(POSISI) = ?
	AND MONTH(POSISI) = ?

GROUP BY 
	YEAR(POSISI), 
	MONTH(POSISI), 
	DIV_ID, 
	master_labels.label_name

SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported exec_sum_classified_loan\n";
?>