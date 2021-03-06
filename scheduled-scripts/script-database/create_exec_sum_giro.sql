IF OBJECT_ID('dbo.exec_sum_giro', 'U') IS NOT NULL 
DROP TABLE dbo.exec_sum_giro
GO 

select * into exec_sum_giro from (

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
AND DESC1 = 'GIRO'
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID

)SOURCE;