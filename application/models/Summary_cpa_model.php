<?php

class Summary_cpa_model extends CI_Model {

    private $year_current;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $lastMonth = new DateTime(date("Y-m-d H:i:s", strtotime("-1 month")));
        $this->year_current = $today->format('Y');
        $this->lastMonth = $lastMonth;
    }

    public function get_existing_simpanan($vcif, $month = 0, $year = 0) {
        if ($month == 0) {
            $month = $this->lastMonth->format('m');
        };
        if ($year == 0) {
            $year = $this->lastMonth->format('Y');
        };
        $query_string = <<<SQL
with simpanan_cpa as (
        select 
                case simpanan_cpa.currency
                when 'IDR' then 'IDR'
                else 'VALAS'
                end currency,
                simpanan_cpa.saldo, 
                simpanan_cpa.avrgsaldo,
                0 fee_based_income,
                simpanan_cpa.beban_bunga,
                simpanan_cpa.beban_bunga_akumulasi,
                1 rekening
        from fact_simpanan_cpa simpanan_cpa
        WHERE DATEPART(m, posisi) = ?
            AND DATEPART(yyyy, posisi) = ?
            AND cifno in (
                select cif from par_mapping_vcif where vcif = ?
            )
)

select
        currency,
        sum(saldo) saldo,
        sum(avrgsaldo) ratas_harian_saldo,
        sum(fee_based_income) fee_based_income,
        sum(beban_bunga) beban_bunga,
        sum(beban_bunga_akumulasi) beban_bunga_akumulasi,
        sum(rekening) jumlah_rekening
 from simpanan_cpa
 group by currency
SQL
        ;

        $result = array(
            'saldo' => array(),
            'ratas_harian_saldo' => array(),
            'fee_based_income' => array(),
            'beban_bunga' => array(),
            'beban_bunga_akumulasi' => array(),
            'jumlah_rekening' => array()
        );

        foreach ($result as $key => $value) {
            $result[$key]['IDR'] = 0;
            $result[$key]['VALAS'] = 0;
            $result[$key]['TOTAL'] = 0;
        }

        $rows = $this->db->query($query_string, array($month, $year, $vcif))->result_array();

        foreach ($rows as $row) {
            foreach ($result as $key => $value) {
                $currency = $row['currency'];
                $result[$key][$currency] = $row[$key];
                $result[$key]['TOTAL'] += $row[$key];
            }
        }

        return $result;
    }

    public function get_existing_pinjaman($vcif, $month = 0, $year = 0) {
        if ($month == 0) {
            $month = $this->lastMonth->format('m');
        };
        if ($year == 0) {
            $year = $this->lastMonth->format('Y');
        };
        $query_string = <<<SQL
with kredit_cpa as (
    select 
        case mata_uang
            when 'IDR' then 'IDR'
            else 'VALAS'
        end currency,
	nlai_tercatat nilai_tercatat,
	nilai_tercatat_ratas,
	baki_debet,
	baki_debet_ratas,
	plafon_efektif plafond,
	kelonggaran_tarik,
	0 fee_based_income,
	pend_bunga pendapatan_bunga,
	pend_bunga_akumulasi pendapatan_bunga_akumulasi,
	1 rekening
    from fact_kredit_cpa
    WHERE DATEPART(m, posisi) = ?
        AND DATEPART(yyyy, posisi) = ?
        AND cifno in (
	        select cif from par_mapping_vcif where vcif = ?
        )
) 

select 
	currency,
	SUM(nilai_tercatat) nilai_tercatat,
	SUM(nilai_tercatat_ratas) nilai_tercatat_ratas,
	SUM(baki_debet) baki_debet,
	SUM(baki_debet_ratas) baki_debet_ratas,
	SUM(plafond) plafond,
	SUM(kelonggaran_tarik) kelonggaran_tarik,
	SUM(fee_based_income) fee_based_income,
	SUM(pendapatan_bunga) pendapatan_bunga,
	SUM(pendapatan_bunga_akumulasi) pendapatan_bunga_akumulasi,
	SUM(rekening) jumlah_rekening
from kredit_cpa
group by currency
SQL
        ;
        $result = array(
            'nilai_tercatat' => array(),
            'nilai_tercatat_ratas' => array(),
            'baki_debet' => array(),
            'baki_debet_ratas' => array(),
            'plafond' => array(),
            'kelonggaran_tarik' => array(),
            'fee_based_income' => array(),
            'pendapatan_bunga' => array(),
            'pendapatan_bunga_akumulasi' => array(),
            'jumlah_rekening' => array()
        );

        foreach ($result as $key => $value) {
            $result[$key]['IDR'] = 0;
            $result[$key]['VALAS'] = 0;
            $result[$key]['TOTAL'] = 0;
        }

        $rows = $this->db->query($query_string, array($month, $year, $vcif))->result_array();

        foreach ($rows as $row) {
            foreach ($result as $key => $value) {
                $currency = $row['currency'];
                $result[$key][$currency] = $row[$key];
                $result[$key]['TOTAL'] += $row[$key];
            }
        }

        return $result;
    }

    public function get_existing_labarugi($vcif, $month = 0, $year = 0) {
        if ($month == 0) {
            $month = $this->lastMonth->format('m');
        };
        if ($year == 0) {
            $year = $this->lastMonth->format('Y');
        };
        $query_string = <<<SQL
select 
    --Pendapatan Bunga
    sum(pend_bunga) pendapatan_bunga,
    sum(pendapatan_ftp) pendapatan_ftp,
    sum(provisi) pendapatan_provisi,
    --Beban
    sum(beban_bunga) beban_bunga,
    sum(beban_ftp) beban_ftp,
    --Fee Based
    0 jasa_perkreditan,
    0 jasa_simpanan,
    0 jasa_trans_bis_int,
    0 jasa_transfer,
    --Biaya Operasional
    0 beban_administrasi,
    0 beban_lain,
    0 beban_personalia,
    --
    sum(ppap) sum_ppap,
    sum(laba_rugi_sebelum_modal) laba_rugi_sebelum,
    sum(laba_rugi_ftp_sebelum_modal) laba_rugi_ftp_sebelum,
    sum(biaya_modal) biaya_modal
from fact_summary_laba_rugi
WHERE DATEPART(m, posisi) = ?
    AND DATEPART(yyyy, posisi) = ?
    AND cifno in (
        select cif from par_mapping_vcif where vcif = ?
    )
SQL
        ;

        $result = $this->db->query($query_string, array($month, $year, $vcif))->row_array();

        $result['pendapatan_bunga_total'] = $result['pendapatan_bunga'] + $result['pendapatan_ftp'] + $result['pendapatan_provisi'];
        $result['beban_bunga_total'] = $result['beban_bunga'] + $result['beban_ftp'];
        $result['nii'] = $result['pendapatan_bunga'] + $result['pendapatan_provisi'] - $result['beban_bunga'];
        $result['nii_ftp'] = $result['pendapatan_bunga_total'] - $result['beban_bunga_total'];
        $result['fee_based_total'] = $result['jasa_perkreditan'] + $result['jasa_simpanan'] +
                $result['jasa_trans_bis_int'] + $result['jasa_transfer'];
        $result['biaya_operasional_total'] = $result['beban_administrasi'] + $result['beban_lain'] + $result['beban_personalia'];
        $result['total_biaya'] = $result['laba_rugi_sebelum'] - $result['biaya_modal'];
        $result['total_biaya_ftp'] = $result['laba_rugi_ftp_sebelum'] - $result['biaya_modal'];

        return $result;
    }

    public function get_projection($vcif, $assumptions, $fees) {
        $query_string = <<<SQL
with source_table as (
    select    
        groups.id group_id,   
	groups.group_name,    

	credit_simulations.plafond_idr,
	credit_simulations.outstanding_idr,
	credit_simulations.ratas_harian_idr,
	credit_simulations.tenor_idr,
	credit_simulations.indicative_rate_idr,
	credit_simulations.income_expense_idr,
	credit_simulations.provision_rate_idr,
	credit_simulations.provision_idr,
	credit_simulations.fee_idr,

	credit_simulations.plafond_valas,
	credit_simulations.outstanding_valas,
	credit_simulations.ratas_harian_valas,
	credit_simulations.tenor_valas,
	credit_simulations.indicative_rate_valas,
	credit_simulations.income_expense_valas,
	credit_simulations.provision_rate_valas,
	credit_simulations.provision_valas,
	credit_simulations.fee_valas
                
	from bankingfacility_groups groups 

	inner join bankingfacility_details details 
	on groups.id = details.group_id 
        
	left join (
		select *
		from credit_simulations
		where data_year = ? and vcif = ? 
	) credit_simulations
	on details.id = credit_simulations.detail_id 

    union all 
    select 
        additions.group_id,
        groups.group_name,    

	credit_simulations.plafond_idr,
	credit_simulations.outstanding_idr,
	credit_simulations.ratas_harian_idr,
	credit_simulations.tenor_idr,
	credit_simulations.indicative_rate_idr,
	credit_simulations.income_expense_idr,
	credit_simulations.provision_rate_idr,
	credit_simulations.provision_idr,
	credit_simulations.fee_idr,

	credit_simulations.plafond_valas,
	credit_simulations.outstanding_valas,
	credit_simulations.ratas_harian_valas,
	credit_simulations.tenor_valas,
	credit_simulations.indicative_rate_valas,
	credit_simulations.income_expense_valas,
	credit_simulations.provision_rate_valas,
	credit_simulations.provision_valas,
	credit_simulations.fee_valas
                
    from bankingfacility_groups groups 

    inner join ( 
        select * 
	from bankingfacility_additions 
	where data_year = ? and vcif = ? 
    ) additions
    on groups.id  = additions.group_id

    left join (
        select *
	from credit_simulations_addition
	where data_year = ? and vcif = ? 
    ) credit_simulations
    on additions.id = credit_simulations.detail_id
)

select    
    group_id,   
    group_name,    

    sum(plafond_idr) plafond_idr,
    sum(outstanding_idr) outstanding_idr,
    sum(ratas_harian_idr) ratas_harian_idr,
    sum(tenor_idr) tenor_idr,
    sum(indicative_rate_idr) indicative_rate_idr,
    sum(income_expense_idr) income_expense_idr,
    sum(provision_rate_idr) provision_rate_idr,
    sum(provision_idr) provision_idr,
    sum(fee_idr) fee_idr,

    sum(plafond_valas) plafond_valas,
    sum(outstanding_valas) outstanding_valas,
    sum(ratas_harian_valas) ratas_harian_valas,
    sum(tenor_valas) tenor_valas,
    sum(indicative_rate_valas) indicative_rate_valas,
    sum(income_expense_valas) income_expense_valas,
    sum(provision_rate_valas) provision_rate_valas,
    sum(provision_valas) provision_valas,
    sum(fee_valas) fee_valas
from source_table 
group by group_id, group_name
SQL

        ;

        $result = array(
            'simpanan' => array(
                'saldo' => array(),
                'ratas_harian_saldo' => array(),
                'fee_based_income' => array(),
                'beban_bunga' => array(),
                'beban_bunga_akumulasi' => array(),
                'jumlah_rekening' => array()
            ),
            'pinjaman' => array(
                'nilai_tercatat' => array(),
                'nilai_tercatat_ratas' => array(),
                'baki_debet' => array(),
                'baki_debet_ratas' => array(),
                'plafond' => array(),
                'kelonggaran_tarik' => array(),
                'fee_based_income' => array(),
                'pendapatan_bunga' => array(),
                'pendapatan_bunga_akumulasi' => array(),
                'jumlah_rekening' => array(),
                'prev_plafond' => array()
            )
        );




        foreach ($result as $group_id => $group) {
            foreach ($group as $key => $value) {
                $result[$group_id][$key]['IDR'] = 0;
                $result[$group_id][$key]['VALAS'] = 0;
                $result[$group_id][$key]['TOTAL'] = 0;
            }
        };

        $rows = $this->db->query($query_string, array(
                    $this->year_current, $vcif,
                    $this->year_current, $vcif,
                    $this->year_current, $vcif
                ))->result_array();

        foreach ($rows as $row) {
            $group_id = $row['group_id'];

            $add_baki_debet = in_array($group_id, array(BANK_FACIL_DIRECT_LOAN, BANK_FACIL_INDIRECT_LOAN));


            if ($add_baki_debet) {
                $result['pinjaman']['baki_debet']['IDR'] += $row['outstanding_idr'];
                $result['pinjaman']['baki_debet']['VALAS'] += $row['outstanding_valas'] * $assumptions['kurs_usd'];
                $result['pinjaman']['baki_debet']['TOTAL'] += $row['outstanding_idr'] + $row['outstanding_valas'] * $assumptions['kurs_usd'];


                $result['pinjaman']['baki_debet_ratas']['IDR'] += $row['ratas_harian_idr'];
                $result['pinjaman']['baki_debet_ratas']['VALAS'] += $row['ratas_harian_valas'] * $assumptions['kurs_usd'];
                $result['pinjaman']['baki_debet_ratas']['TOTAL'] += $row['ratas_harian_idr'] + $row['ratas_harian_valas'] * $assumptions['kurs_usd'];

                $result['pinjaman']['plafond']['IDR'] += $row['plafond_idr'];
                $result['pinjaman']['plafond']['VALAS'] += $row['plafond_valas'] * $assumptions['kurs_usd'];
                $result['pinjaman']['plafond']['TOTAL'] += $row['plafond_idr'] + $row['plafond_valas'] * $assumptions['kurs_usd'];
            }



            if ($group_id == BANK_FACIL_DIRECT_LOAN) {
                $result['pinjaman']['pendapatan_bunga_akumulasi']['IDR'] += $row['income_expense_idr'];
                $result['pinjaman']['pendapatan_bunga_akumulasi']['VALAS'] += $row['income_expense_valas'] * $assumptions['kurs_usd'];
                $result['pinjaman']['pendapatan_bunga_akumulasi']['TOTAL'] += $row['income_expense_idr'] + $row['income_expense_valas'] * $assumptions['kurs_usd'];
            }

            if ($group_id == BANK_FACIL_CASH) {
                $result['simpanan']['saldo']['IDR'] = $row['outstanding_idr'];
                $result['simpanan']['saldo']['VALAS'] = $row['outstanding_valas'] * $assumptions['kurs_usd'];
                $result['simpanan']['saldo']['TOTAL'] = $row['outstanding_idr'] + $result['simpanan']['saldo']['VALAS'];

                $result['simpanan']['ratas_harian_saldo']['IDR'] = $row['ratas_harian_idr'];
                $result['simpanan']['ratas_harian_saldo']['VALAS'] = $row['ratas_harian_valas'] * $assumptions['kurs_usd'];
                $result['simpanan']['ratas_harian_saldo']['TOTAL'] = $row['ratas_harian_idr'] + $result['simpanan']['ratas_harian_saldo']['VALAS'];

                $result['simpanan']['beban_bunga_akumulasi']['IDR'] = $row['income_expense_idr'];
                $result['simpanan']['beban_bunga_akumulasi']['VALAS'] = $row['income_expense_valas'] * $assumptions['kurs_usd'];
                $result['simpanan']['beban_bunga_akumulasi']['TOTAL'] = $row['income_expense_idr'] + $result['simpanan']['beban_bunga_akumulasi']['VALAS'];
            }

            $result['pinjaman']['prev_plafond']['IDR'] += $row['provision_idr'];
            $result['pinjaman']['prev_plafond']['VALAS'] += $row['provision_valas'];
            $result['pinjaman']['prev_plafond']['TOTAL'] = $result['pinjaman']['prev_plafond']['IDR'] + $result['pinjaman']['prev_plafond']['VALAS'];
        }

        $result['simpanan']['fee_based_income']['IDR'] = $fees['fee_income_simpanan_idr'];
        $result['simpanan']['fee_based_income']['VALAS'] = $fees['fee_income_simpanan_valas'] * $assumptions['kurs_usd'];
        $result['simpanan']['fee_based_income']['TOTAL'] = $fees['fee_income_simpanan_idr'] + $result['simpanan']['fee_based_income']['VALAS'];

        $result['pinjaman']['outstanding']['IDR'] = $fees['outstanding_idr'];
        $result['pinjaman']['outstanding']['VALAS'] = $fees['outstanding_valas'] * $assumptions['kurs_usd'];
        $result['pinjaman']['outstanding']['TOTAL'] = $fees['outstanding_idr'] + $result['pinjaman']['outstanding']['VALAS'];

        $result['pinjaman']['fee_income_pinjaman']['IDR'] = $fees['fee_income_pinjaman_idr'];
        $result['pinjaman']['fee_income_pinjaman']['VALAS'] = $fees['fee_income_pinjaman_valas'] * $assumptions['kurs_usd'];
        $result['pinjaman']['fee_income_pinjaman']['TOTAL'] = $fees['fee_income_pinjaman_idr'] + $result['pinjaman']['fee_income_pinjaman']['VALAS'];

        $result['pinjaman']['fee_income']['IDR'] = $fees['fee_income_idr'];
        $result['pinjaman']['fee_income']['VALAS'] = $fees['fee_income_valas'] * $assumptions['kurs_usd'];
        $result['pinjaman']['fee_income']['TOTAL'] = $fees['fee_income_idr'] + $result['pinjaman']['fee_income']['VALAS'];

        $result['pinjaman']['fee_income_lainnya']['IDR'] = $fees['fee_income_lainnya_idr'];
        $result['pinjaman']['fee_income_lainnya']['VALAS'] = $fees['fee_income_lainnya_valas'] * $assumptions['kurs_usd'];
        $result['pinjaman']['fee_income_lainnya']['TOTAL'] = $fees['fee_income_lainnya_idr'] + $result['pinjaman']['fee_income_lainnya']['VALAS'];

        $result['fee_jasa_kredit']['IDR'] = $fees['fee_jasa_kredit_idr'];
        $result['fee_jasa_kredit']['VALAS'] = $fees['fee_jasa_kredit_valas'] * $assumptions['kurs_usd'];
        $result['fee_jasa_kredit']['TOTAL'] = $fees['fee_jasa_kredit_idr'] + $result['fee_jasa_kredit']['VALAS'];

        $result['fee_jasa_simpanan']['IDR'] = $fees['fee_jasa_simpanan_idr'];
        $result['fee_jasa_simpanan']['VALAS'] = $fees['fee_jasa_simpanan_valas'] * $assumptions['kurs_usd'];
        $result['fee_jasa_simpanan']['TOTAL'] = $fees['fee_jasa_simpanan_idr'] + $result['fee_jasa_simpanan']['VALAS'];

        $result['fee_jasa_bisnis_int']['IDR'] = $fees['fee_jasa_bisnis_int_idr'];
        $result['fee_jasa_bisnis_int']['VALAS'] = $fees['fee_jasa_bisnis_int_valas'] * $assumptions['kurs_usd'];
        $result['fee_jasa_bisnis_int']['TOTAL'] = $fees['fee_jasa_bisnis_int_idr'] + $result['fee_jasa_bisnis_int']['VALAS'];

        $result['fee_jasa_transfer']['IDR'] = $fees['fee_jasa_transfer_idr'];
        $result['fee_jasa_transfer']['VALAS'] = $fees['fee_jasa_transfer_valas'] * $assumptions['kurs_usd'];
        $result['fee_jasa_transfer']['TOTAL'] = $fees['fee_jasa_transfer_idr'] + $result['fee_jasa_transfer']['VALAS'];

        $result['beban_adm']['IDR'] = $fees['beban_adm_idr'];
        $result['beban_adm']['VALAS'] = $fees['beban_adm_valas'] * $assumptions['kurs_usd'];
        $result['beban_adm']['TOTAL'] = $fees['beban_adm_idr'] + $result['beban_adm']['VALAS'];

        $result['beban_ops']['IDR'] = $fees['beban_ops_idr'];
        $result['beban_ops']['VALAS'] = $fees['beban_ops_valas'] * $assumptions['kurs_usd'];
        $result['beban_ops']['TOTAL'] = $fees['beban_ops_idr'] + $result['beban_ops']['VALAS'];

        $result['beban_person']['IDR'] = $fees['beban_person_idr'];
        $result['beban_person']['VALAS'] = $fees['beban_person_valas'] * $assumptions['kurs_usd'];
        $result['beban_person']['TOTAL'] = $fees['beban_person_idr'] + $result['beban_person']['VALAS'];

        $result['ppap']['IDR'] = $fees['ppap_idr'];
        $result['ppap']['VALAS'] = $fees['ppap_valas'] * $assumptions['kurs_usd'];
        $result['ppap']['TOTAL'] = $fees['ppap_idr'] + $result['ppap']['VALAS'];

        $result['total_biaya_modal']['IDR'] = $fees['total_biaya_modal_idr'];
        $result['total_biaya_modal']['VALAS'] = $fees['total_biaya_modal_valas'] * $assumptions['kurs_usd'];
        $result['total_biaya_modal']['TOTAL'] = $fees['total_biaya_modal_idr'] + $result['total_biaya_modal']['VALAS'];

        $labarugi = array();

        $labarugi['pendapatan_bunga'] = $result['pinjaman']['pendapatan_bunga_akumulasi']['TOTAL'];
        $labarugi['pendapatan_ftp'] = //
                $result['simpanan']['ratas_harian_saldo']['IDR'] * $assumptions['ftp_simpanan_idr'] / 100 +
                $result['simpanan']['ratas_harian_saldo']['VALAS'] * $assumptions['ftp_simpanan_valas'] / 100;
        $labarugi['pendapatan_provisi'] = $result['pinjaman']['prev_plafond']['TOTAL'];
        $labarugi['pendapatan_bunga_total'] = $labarugi['pendapatan_bunga'] + $labarugi['pendapatan_ftp'] + $labarugi['pendapatan_provisi'];
        //
        $labarugi['beban_bunga'] = $result['simpanan']['beban_bunga_akumulasi']['TOTAL'];
        $labarugi['beban_ftp'] = //                 
                $result['pinjaman']['baki_debet_ratas']['IDR'] * $assumptions['ftp_pinjaman_idr'] / 100 +
                $result['pinjaman']['baki_debet_ratas']['VALAS'] * $assumptions['ftp_pinjaman_valas'] / 100;
        $labarugi['beban_bunga_total'] = $labarugi['beban_bunga'] + $labarugi['beban_ftp'];
        //
        $labarugi['nii'] = $labarugi['pendapatan_bunga'] + $labarugi['pendapatan_provisi'] - $labarugi['beban_bunga'];
        $labarugi['nii_ftp'] = $labarugi['pendapatan_bunga_total'] - $labarugi['beban_bunga_total'];
        //
        $labarugi['fee_based_total'] = $result['fee_jasa_kredit']['TOTAL'] + $result['fee_jasa_simpanan']['TOTAL'] + $result['fee_jasa_bisnis_int']['TOTAL'] + $result['fee_jasa_transfer']['TOTAL'];

        $labarugi['jasa_perkreditan'] = $result['fee_jasa_kredit']['TOTAL'];
        $labarugi['jasa_simpanan'] = $result['fee_jasa_simpanan']['TOTAL'];
        $labarugi['jasa_trans_bis_int'] = $result['fee_jasa_bisnis_int']['TOTAL'];
        $labarugi['jasa_transfer'] = $result['fee_jasa_transfer']['TOTAL'];

        $labarugi['operasional_total'] = $result['beban_adm']['TOTAL'] + $result['beban_ops']['TOTAL'] + $result['beban_person']['TOTAL'];
        $labarugi['beban_administrasi'] = $result['beban_adm']['TOTAL'];
        $labarugi['beban_lain'] = $result['beban_ops']['TOTAL'];
        $labarugi['beban_personalia'] = $result['beban_person']['TOTAL'];

        $labarugi['sum_ppap'] = $result['ppap']['TOTAL'];
        $labarugi['biaya_operasional_total'] = 0;
        $labarugi['biaya_modal'] = $result['total_biaya_modal']['TOTAL'];
        $labarugi['laba_rugi_sebelum'] = //
                ($labarugi['nii'] + $labarugi['fee_based_total']) - // 
                ($labarugi['biaya_operasional_total'] + $labarugi['sum_ppap']);
        $labarugi['laba_rugi_ftp_sebelum'] = //
                ($labarugi['nii_ftp'] + $labarugi['fee_based_total']) - // 
                ($labarugi['biaya_operasional_total'] + $labarugi['sum_ppap']);
        //
        $labarugi['total_biaya'] = $labarugi['laba_rugi_sebelum'] - $labarugi['biaya_modal'];
        $labarugi['total_biaya_ftp'] = $labarugi['laba_rugi_ftp_sebelum'] - $labarugi['biaya_modal'];

        $result['labarugi'] = $labarugi;


        return $result;
    }

}
