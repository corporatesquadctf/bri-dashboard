IF OBJECT_ID('dbo.exec_sum_loan_outstanding', 'U') IS NOT NULL 
DROP TABLE dbo.exec_sum_loan_outstanding
GO 

select * into exec_sum_loan_outstanding from (

SELECT 
    YEAR(POSISI) year, 
    MONTH(POSISI) month,
	DIV_ID division,
    SUM(isnull(BAKI_DEBET,0)) outstanding,
    SUM(isnull(BAKI_DEBET_RATAS,0)) ratas
FROM FACT_KREDIT_CPA
INNER JOIN VIEW_CUSTOMER_MAPPING ON 
FACT_KREDIT_CPA.CIFNO = VIEW_CUSTOMER_MAPPING.CIF
WHERE DIV_ID IS NOT NULL
GROUP BY YEAR(POSISI), MONTH(POSISI), DIV_ID

)source;