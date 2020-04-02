<?php

class Credit_simulations_model extends CI_Model {

    private $year_current;
    public $vcif;
    public $group_id;
    public $rows;

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get($vcif) {
        $result = array();


        $today = new DateTime(date('Y-m-d H:i:s'));
        $year_current = $today->format('Y');

        if (empty($vcif)) {
            return result;
        }

        $query_string = <<<SQL
select    
    groups.id group_id,   
    groups.group_name,    
    convert(varchar, details.id) detail_id,
    details.detail_name,  

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
    credit_simulations.fee_valas,
                
    1 mandatory,
    0 optional

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
    'addition-' + convert(varchar, additions.id) detail_id,
    additions.detail_name,

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
    credit_simulations.fee_valas,
                
    0 mandatory,
    1 optional
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
SQL
        ;
        $rows = $this->db->query($query_string, array(
                    $year_current, $vcif,
                    $year_current, $vcif,
                    $year_current, $vcif)
                )->result_array();

        foreach ($rows as $row) {

            foreach ($row as $key => $value) {
                if (empty($value)) {
                    $row[$key] = 0;
                }else{
                    if (is_numeric($value)){
                        $val = (float)$value;
                        if ($key != "group_id" && $key != 'detail_id' && $key != 'mandatory' && $key != 'optional' && $key != 'indicative_rate_idr' && $key != 'provision_rate_idr' && $key != 'provision_rate_valas' && $key != 'indicative_rate_valas'){
                            $row[$key] = number_format($val);
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

    public function get_assumptions($vcif) {
        $result = array(
            'vcif' => $vcif,
            'data_year' => $this->year_current,
            'kurs_usd' => 0,
            'ftp_simpanan_idr' => 0,
            'ftp_simpanan_valas' => 0,
            'ftp_pinjaman_idr' => 0,
            'ftp_pinjaman_valas' => 0
        );

        $this->db->select(<<<SQL
            vcif, 
            data_year, 
            kurs_usd, 
            ftp_simpanan_idr, 
            ftp_simpanan_valas, 
            ftp_pinjaman_idr,
            ftp_pinjaman_valas
SQL
        );
        $this->db->from('credit_simulation_assumptions');
        $this->db->where('vcif', $vcif);
        $this->db->where('data_year', $this->year_current);
        $result_from_db = $this->db->get()->row_array();

        if (empty($result_from_db)) {
            $this->db->set($result);
            $this->db->insert('credit_simulation_assumptions');
        } else {
            $result = $result_from_db;
        }

        return $result;
    }

    public function save_credit_simulation_assumptions($request) {
        $this->db->where('vcif', $request->vcif);
        $this->db->where('data_year', $this->year_current);
        unset($request->vcif);
        $this->db->set($request);
        $this->db->update('credit_simulation_assumptions');
    }

    public function get_fees($vcif) {
        $result = array(
            'vcif' => $vcif,
            'data_year' => $this->year_current,
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
            vcif,
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
        $this->db->from('credit_simulation_fee');
        $this->db->where('vcif', $vcif);
        $this->db->where('data_year', $this->year_current);
        $result_from_db = $this->db->get()->row_array();


        if (empty($result_from_db)) {
            $this->db->set($result);
            $this->db->insert('credit_simulation_fee');
        } else {
            $result = $result_from_db;
        }
        return $result;
     }

    public function save_fee_simulation($request){
        $temp = $this->db->where('vcif', $request->vcif)
                ->where('data_year', $this->year_current)
                ->get('credit_simulation_fee')->result();
        if(empty($temp)){
            $this->db->set('vcif', $request->vcif);
            $this->db->set('data_year', $this->year_current);
            $this->db->insert('credit_simulation_fee', $request);
        }

        $this->db->where('vcif', $request->vcif);
        $this->db->where('data_year', $this->year_current);
        unset($request->vcif);
        $this->db->update('credit_simulation_fee', $request);

    }

    public function save_credit_simulations() {
       
        $this->db->trans_start();
        $rows_mandatory = array();
        $rows_optional = array();

         $this->db->select(<<<SQL
            vcif, 
            data_year, 
            kurs_usd

SQL
        );
        $this->db->from('credit_simulation_assumptions');
        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $result_from_db = $this->db->get()->row_array();

        foreach ($this->rows as $row) {
            $row->vcif = $this->vcif;
            $row->data_year = $this->year_current;
            $mandatory = $row->mandatory;
            unset($row->mandatory);
            if ($mandatory) {
                unset($row->detail_name);
                $rows_mandatory[] = $row;
            } else {
                $row->detail_id = str_replace('addition-', '', $row->detail_id);
                unset($row->group_id);
                $rows_optional[] = $row;
            }

           $row->provision_idr = $row->plafond_idr  * $row->provision_rate_idr / 100;
           $row->provision_valas = $row->plafond_valas * $result_from_db['kurs_usd'] * $row->provision_rate_valas / 100;

            if ($row->tenor_idr <= 12){
                $row->income_expense_idr = $row->tenor_idr / 12 * $row->ratas_harian_idr * $row->indicative_rate_idr / 100;
            } else {
                $row->income_expense_idr = $row->ratas_harian_idr * $row->indicative_rate_idr / 100;
            }

            if ($row->tenor_valas <= 12){
                $row->income_expense_valas = $row->tenor_valas / 12 * $row->ratas_harian_valas * $row->indicative_rate_valas / 100;
            } else {
                $row->income_expense_valas = $row->ratas_harian_valas * $row->indicative_rate_valas / 100;
            }
        }

        $this->delete_credit_simulations($rows_mandatory);
        $this->insert_credit_simulations($rows_mandatory);

        $this->delete_credit_simulations_addition($rows_optional);
        $this->insert_credit_simulations_addition($rows_optional);

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

        $this->db->from('credit_simulations');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function delete_credit_simulations_addition($rows) {
        if (empty($rows)) {
            return;
        }

        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('credit_simulations_addition');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function insert_credit_simulations($rows) {
        if (empty($rows)) {
            return;
        }

        $this->db->insert_batch('credit_simulations', $rows);
    }

    private function insert_credit_simulations_addition($rows) {
        if (empty($rows)) {
            return;
        }

        $this->db->insert_batch('credit_simulations_addition', $rows);
    }

}
