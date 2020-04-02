IF OBJECT_ID('dbo.exec_sum_loan_sector', 'U') IS NOT NULL 
DROP TABLE dbo.exec_sum_loan_sector
GO 

select * into exec_sum_loan_sector from (

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

GROUP BY 
	YEAR(POSISI), 
	MONTH(POSISI), 
	DIV_ID, 
	JENIS_PENGGUNAAN
	
)source;