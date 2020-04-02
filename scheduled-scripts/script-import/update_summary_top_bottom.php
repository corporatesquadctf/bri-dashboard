<?php
	echo "Importing summary_top_bottom\n";
	$sql = "delete from summary_top_bottom where year = ? and month = ?";
	$params = [$year, $month];
	
	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL

DECLARE @YEAR INT, @MONTH INT;

SELECT @YEAR = ?, @MONTH = ?;

insert into summary_top_bottom(year, month, division, nama_nasabah, vcif, jumlah, kredit, simpanan)

SELECT 

@YEAR  year , 
@MONTH month,
VIEW_CUSTOMER_MAPPING.div_id        division,  
VIEW_CUSTOMER_MAPPING.company_name  nama_nasabah,  
VIEW_CUSTOMER_MAPPING.vcif          vcif        , 

SUM(ISNULL(LABARUGI_SUM.JUMLAH,0))   jumlah,
SUM(ISNULL(KREDIT_SUM.KREDIT,0))     kredit , 
SUM(ISNULL(SIMPANAN_SUM.SIMPANAN,0)) simpanan

FROM (
	SELECT 
		CIFNO, 
		SUM(ISNULL(LABA_RUGI_FTP_SETELAH_MODAL,0)) jumlah
	FROM FACT_SUMMARY_LABA_RUGI
	WHERE YEAR(POSISI) = @YEAR
		AND MONTH(POSISI) = @MONTH
	GROUP BY CIFNO
)LABARUGI_SUM

INNER JOIN VIEW_CUSTOMER_MAPPING 
ON LABARUGI_SUM.CIFNO = VIEW_CUSTOMER_MAPPING.CIF 
AND VIEW_CUSTOMER_MAPPING.VCIF IS NOT NULL
AND VIEW_CUSTOMER_MAPPING.DIV_ID IS NOT NULL

LEFT JOIN (
	SELECT 
		CIFNO, 
		SUM(ISNULL(AVRGSALDO,0)) simpanan
	FROM FACT_SIMPANAN_CPA
		WHERE YEAR(POSISI) = @YEAR
		AND MONTH(POSISI) = @MONTH	
	GROUP BY CIFNO
)SIMPANAN_SUM
ON LABARUGI_SUM.CIFNO = SIMPANAN_SUM.CIFNO

LEFT JOIN (
	SELECT 
		CIFNO, 
		SUM(ISNULL(BAKI_DEBET_RATAS,0)) kredit
	FROM FACT_KREDIT_CPA
	WHERE YEAR(POSISI) = @YEAR
		AND MONTH(POSISI) = @MONTH
	GROUP BY CIFNO
)KREDIT_SUM
ON LABARUGI_SUM.CIFNO = KREDIT_SUM.CIFNO

GROUP BY
	VIEW_CUSTOMER_MAPPING.div_id,
	VIEW_CUSTOMER_MAPPING.company_name,
	VIEW_CUSTOMER_MAPPING.vcif

SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported summary_top_bottom\n";
?>