<?php
	echo "Importing leaderboard\n";
	$sql = "delete from leaderboard";
	
	$statement = sqlsrv_query( $connection, $sql);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = <<<SQL


insert into leaderboard(
	group_id, 
	group_name, 
	vcif, 
	company_name, 
	new, 
	outstanding, 
	outstanding_ratas,
	simpanan,
	simpanan_ratas,
	current_cpa
)
	
select 
	view_customer_mapping.group_id, 
    view_customer_mapping.group_name, 
    view_customer_mapping.vcif, 
    view_customer_mapping.company_name,
	view_customer_mapping.new,
	-- 
	isnull(fact_kredit_cpa_sum.outstanding,0)/1000000 outstanding,
	isnull(fact_kredit_cpa_sum.outstanding_ratas,0)/1000000 outstanding_ratas,
	isnull(fact_simpanan_cpa_sum.simpanan,0)/1000000 simpanan,
	isnull(fact_simpanan_cpa_sum.simpanan_ratas,0)/1000000 simpanan_ratas,
	isnull(fact_summary_laba_rugi_sum.current_cpa,0)/1000000 current_cpa
	
from (
	select distinct 
		group_id,
		group_name,
		vcif,
		company_name,
		new
	from view_customer_mapping
	where view_customer_mapping.status_vcif = 1
) view_customer_mapping

left join (
	select 
      sum(baki_debet) outstanding,
      sum(baki_debet_ratas) outstanding_ratas,
	  par_mapping_vcif.vcif
   from fact_kredit_cpa
   inner join par_mapping_vcif
   on fact_kredit_cpa.cifno = par_mapping_vcif.CIF
   group by par_mapping_vcif.vcif
) fact_kredit_cpa_sum
on view_customer_mapping.vcif = fact_kredit_cpa_sum.vcif

left join (
	select 
      sum(saldo) simpanan,
      sum(avrgsaldo) simpanan_ratas,
	  par_mapping_vcif.vcif
   from fact_simpanan_cpa
   inner join par_mapping_vcif
   on fact_simpanan_cpa.cifno = par_mapping_vcif.CIF
   group by par_mapping_vcif.vcif
) fact_simpanan_cpa_sum
on view_customer_mapping.vcif = fact_simpanan_cpa_sum.vcif

left join (
	select 
      sum(laba_rugi_ftp_setelah_modal) current_cpa,
	  par_mapping_vcif.vcif
   from fact_summary_laba_rugi
   inner join par_mapping_vcif
   on fact_summary_laba_rugi.cifno = par_mapping_vcif.CIF
   group by par_mapping_vcif.vcif
) fact_summary_laba_rugi_sum
on view_customer_mapping.vcif = fact_summary_laba_rugi_sum.vcif

SQL;

	$statement = sqlsrv_query( $connection, $sql, $params);
	if($statement === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	echo "Imported leaderboard\n";
?>