IF OBJECT_ID('dbo.exec_sum_plafon', 'U') IS NOT NULL 
DROP TABLE dbo.exec_sum_plafon
GO 

select * into exec_sum_plafon from (

SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
    SUM(PLAFON_EFEKTIF) plafon 
FROM FACT_KREDIT_CPA
INNER JOIN VIEW_CUSTOMER_MAPPING ON 
FACT_KREDIT_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF
WHERE DIV_ID IS NOT NULL
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID

)SOURCE;