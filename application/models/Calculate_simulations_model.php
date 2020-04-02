<?php

class Calculate_simulations_model extends CI_Model {

    private $year_current;
    public $vcif;
    public $user_id;
    public $group_id;
    public $rows;

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get($user_id) {
        $result = array();


        $today = new DateTime(date('Y-m-d H:i:s'));
        $year_current = $today->format('Y');

        if (empty($user_id)) {
            return result;
        }

        $query_string = <<<SQL
select    
    groups.id group_id,   
    groups.group_name,    
    convert(varchar, details.id) detail_id,
    details.detail_name,  

    credit_calculate_simulations.plafond_idr,
    credit_calculate_simulations.outstanding_idr,
    credit_calculate_simulations.ratas_harian_idr,
    credit_calculate_simulations.tenor_idr,
    credit_calculate_simulations.indicative_rate_idr,
    credit_calculate_simulations.income_expense_idr,
    credit_calculate_simulations.provision_rate_idr,
    credit_calculate_simulations.provision_idr,
    credit_calculate_simulations.fee_idr,

    credit_calculate_simulations.plafond_valas,
    credit_calculate_simulations.outstanding_valas,
    credit_calculate_simulations.ratas_harian_valas,
    credit_calculate_simulations.tenor_valas,
    credit_calculate_simulations.indicative_rate_valas,
    credit_calculate_simulations.income_expense_valas,
    credit_calculate_simulations.provision_rate_valas,
    credit_calculate_simulations.provision_valas,
    credit_calculate_simulations.fee_valas,
                
    1 mandatory,
    0 optional

from bankingfacility_groups groups 

inner join bankingfacility_details details 
on groups.id = details.group_id 
        
left join (
    select *
    from credit_calculate_simulations
    where user_id = ?
) credit_calculate_simulations
on details.id = credit_calculate_simulations.detail_id
SQL
        ;
        $rows = $this->db->query($query_string, array($user_id)
                )->result_array();

        foreach ($rows as $row) {

            foreach ($row as $key => $value) {
                if (empty($value)) {
                    $row[$key] = 0;
                } else {
                    if (is_numeric($value)) {
                        $val = (float) $value;
                        if ($key != "group_id" && $key != 'detail_id' && $key != 'mandatory' && $key != 'optional') {
                            $row[$key] = 0;
                        }
                    }
                }
            }

            $group_id = $row['group_id'];
            if (!array_key_exists($group_id, $result)) {
                $result[$group_id] = array(
                    'name' => $row['group_name'],
                    'details' => array()
                );
            }

            $detail_id = $row['detail_id'];

            $row['mandatory'] = $row['mandatory'] === 1;
            $row['optional'] = $row['optional'] === 1;

            $result[$group_id]['details'][$detail_id] = $row;
        }
        return $result;
    }

    public function get_assumptions($user_id) {
        $result = array(
            'user_id' => $user_id,
            'kurs_usd' => 0,
            'ftp_simpanan_idr' => 0,
            'ftp_simpanan_valas' => 0,
            'ftp_pinjaman_idr' => 0,
            'ftp_pinjaman_valas' => 0
        );

        $this->db->select(<<<SQL
            user_id, 
            kurs_usd, 
            ftp_simpanan_idr, 
            ftp_simpanan_valas, 
            ftp_pinjaman_idr,
            ftp_pinjaman_valas
SQL
        );
        $this->db->from('credit_calculate_assumptions');
        $this->db->where('user_id', $user_id);
        $result_from_db = $this->db->get()->row_array();

        if (empty($result_from_db)) {
            $this->db->set($result);
            $this->db->insert('credit_calculate_assumptions');
        } else {
            $result = $result_from_db;
        }

        return $result;
    }

    public function save_calculate_simulation_assumptions($request) {

        $temp = $this->db->where('user_id', $request->user_id)
                        ->get('credit_calculate_assumptions')->result();
        if (empty($temp)) {
            $this->db->set('user_id', $request->user_id);
            $this->db->insert('credit_calculate_assumptions', $request);
        }

        $this->db->where('user_id', $request->user_id);
        unset($request->user_id);
        $this->db->update('credit_calculate_assumptions', $request);
    }

    public function get_fees($user_id) {
        $result = array(
            'user_id' => $user_id,
            'fee_income_simpanan_idr' => 0,
            'fee_income_simpanan_valas' => 0,
            'fee_income_pinjaman_idr' => 0,
            'fee_income_pinjaman_valas' => 0,
            'outstanding_idr' => 0,
            'outstanding_valas' => 0,
            'fee_income_idr' => 0,
            'fee_income_valas' => 0,
            'fee_income_lainnya_idr' => 0,
            'fee_income_lainnya_valas' => 0,
            'fee_jasa_kredit_idr' => 0,
            'fee_jasa_kredit_valas' => 0,
            'fee_jasa_simpanan_idr' => 0,
            'fee_jasa_simpanan_valas' => 0,
            'fee_jasa_bisnis_int_idr' => 0,
            'fee_jasa_bisnis_int_valas' => 0,
            'fee_jasa_transfer_idr' => 0,
            'fee_jasa_transfer_valas' => 0,
            'beban_adm_idr' => 0,
            'beban_adm_valas' => 0,
            'beban_ops_idr' => 0,
            'beban_ops_valas' => 0,
            'beban_person_idr' => 0,
            'beban_person_valas' => 0,
            'ppap_idr' => 0,
            'ppap_valas' => 0,
            'total_biaya_modal_idr' => 0,
            'total_biaya_modal_valas' => 0
        );

        $this->db->select(<<<SQL
            user_id,
            data_year,
            fee_income_simpanan_idr,
            fee_income_simpanan_valas,
            fee_income_pinjaman_idr,
            fee_income_pinjaman_valas,
            outstanding_idr,
            outstanding_valas,
            fee_income_idr,
            fee_income_valas,
            fee_income_lainnya_idr,
            fee_income_lainnya_valas,
            fee_jasa_kredit_idr,
            fee_jasa_kredit_valas,
            fee_jasa_simpanan_idr,
            fee_jasa_simpanan_valas,
            fee_jasa_bisnis_int_idr,
            fee_jasa_bisnis_int_valas,
            fee_jasa_transfer_idr,
            fee_jasa_transfer_valas,
            beban_adm_idr,
            beban_adm_valas,
            beban_ops_idr,
            beban_ops_valas,
            beban_person_idr,
            beban_person_valas,
            ppap_idr,
            ppap_valas,
            total_biaya_modal_idr,
            total_biaya_modal_valas  
SQL
        );
        $this->db->from('credit_calculation_fee');
        $this->db->where('user_id', $user_id);
        $result_from_db = $this->db->get()->row_array();


        if (empty($result_from_db)) {
            $this->db->set($result);
            $this->db->insert('credit_calculation_fee');
        } else {
            $result = $result_from_db;
        }
        return $result;
    }

    public function save_calc_fee_simulation($request) {
        $temp = $this->db->where('user_id', $request->user_id)
                        ->get('credit_calculation_fee')->result();
        if (empty($temp)) {
            $this->db->set('user_id', $request->user_id);
            $this->db->insert('credit_calculation_fee', $request);
        }

        $this->db->where('user_id', $request->user_id);
        unset($request->user_id);
        $this->db->update('credit_calculation_fee', $request);
    }

    public function save_calculation_simulations() {

        $this->db->trans_start();
        $rows_mandatory = array();
        $user_id = $_SESSION['USER_ID'];

        $this->db->select(<<<SQL
            user_id, 
            kurs_usd
SQL
        );
        $this->db->from('credit_calculate_assumptions');
        $this->db->where('user_id', $user_id);
        $result_from_db = $this->db->get()->row_array();

        foreach ($this->rows as $row) {
            $row->user_id = $this->user_id;
            $row->data_year = $this->year_current;
            $mandatory = $row->mandatory;
            unset($row->mandatory);
            unset($row->detail_name);
            $rows_mandatory[] = $row;

            $row->provision_idr = $row->plafond_idr * $row->provision_rate_idr / 100;
            $row->provision_valas = $row->plafond_valas * $result_from_db['kurs_usd'] * $row->provision_rate_valas / 100;

            if ($row->tenor_idr <= 12) {
                $row->income_expense_idr = $row->tenor_idr / 12 * $row->ratas_harian_idr * $row->indicative_rate_idr / 100;
            } else {
                $row->income_expense_idr = $row->ratas_harian_idr * $row->indicative_rate_idr / 100;
            }

            if ($row->tenor_valas <= 12) {
                $row->income_expense_valas = $row->tenor_valas / 12 * $row->ratas_harian_valas * $row->indicative_rate_valas / 100;
            } else {
                $row->income_expense_valas = $row->ratas_harian_valas * $row->indicative_rate_valas / 100;
            }
        }

        $this->delete_credit_simulations($rows_mandatory);
        $this->insert_credit_simulations($rows_mandatory);

        $this->db->trans_complete();
    }

    private function delete_credit_simulations($rows) {
        if (empty($rows)) {
            return;
        }

        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('credit_calculate_simulations');

        $this->db->where('user_id', $this->user_id);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function insert_credit_simulations($rows) {
        if (empty($rows)) {
            return;
        }

        $this->db->insert_batch('credit_calculate_simulations', $rows);
    }

    public function get_projection($user_id, $assumptions, $fees) {
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
        from credit_calculate_simulations
        where user_id = ?
    ) credit_simulations
    on details.id = credit_simulations.detail_id
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

        $rows = $this->db->query($query_string, array($user_id
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
        $labarugi['pendapatan_bunga_total'] = $labarugi['pendapatan_bunga'] + $labarugi['pendapatan_ftp'];
        $labarugi['pendapatan_provisi'] = $result['pinjaman']['prev_plafond']['TOTAL'];
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
