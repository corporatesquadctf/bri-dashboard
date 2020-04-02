IF OBJECT_ID('dbo.exec_sum_classified_loan', 'U') IS NOT NULL 
DROP TABLE dbo.exec_sum_classified_loan
GO 

select * into exec_sum_classified_loan from (
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

GROUP BY 
	YEAR(POSISI), 
	MONTH(POSISI), 
	DIV_ID, 
	master_labels.label_name
) source