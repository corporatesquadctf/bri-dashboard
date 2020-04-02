<?php

class Banking_facilities_model extends CI_Model {

    private $year_current;
    public $vcif;
    public $group_id;
    public $rows;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get($vcif) {
        $result = array();

        $today = new DateTime(date('Y-m-d H:i:s'));

        if (empty($vcif)) {
            return result;
        }

        $query_string = <<<SQL
select    
    groups.id group_id,   
    groups.group_name,    
    convert(varchar, details.id) detail_id,
    details.detail_name,  
    "values".amount_idr,
    "values".amount_idr_percent,
    "values".amount_valas,
    "values".amount_valas_percent,
    1 mandatory,
    0 optional
from bankingfacility_details details 
        
left join ( 
    select * 
    from bankingfacility_values 
    where vcif = ? and data_year = ? 
) "values" 
on "values".detail_id = details.id 
        
left join bankingfacility_groups groups 
on details.group_id = groups.id 

union all 
select 
	additions.group_id,
	groups.group_name,    
	'addition-' + convert(varchar, additions.id) detail_id,
	additions.detail_name,
	additions.amount_idr,
	additions.amount_idr_percent,
	additions.amount_valas,
	additions.amount_valas_percent,
	0 mandatory,
	1 optional
from ( 
    select * 
    from bankingfacility_additions 
    where vcif = ? and data_year = ? 
) 
additions

left join bankingfacility_groups groups 
on additions.group_id = groups.id 

SQL
        ;

        $rows = $this->db->query($query_string, array(
                    $vcif, $this->year_current,
                    $vcif, $this->year_current)
                )->result();

        foreach ($rows as $row) {

            $group_id = $row->group_id;
            if (!array_key_exists($group_id, $result)) {
                $result[$group_id] = array(
                    'name' => $row->group_name,
                    'details' => array()
                );
            }

            $detail_id = $row->detail_id;

            $detail = array(
                'detail_name' => $row->detail_name,
                'amount_idr' => number_format($row->amount_idr),
                'amount_idr_percent' => $row->amount_idr_percent,
                'amount_valas' => number_format($row->amount_valas),
                'amount_valas_percent' => $row->amount_valas_percent,
                'optional' => $row->optional === 1,
                'mandatory' => $row->mandatory === 1
            );

            foreach ($detail as $key => $value) {

                if (empty($value)) {
                    $detail[$key] = 0;
                }
                if ($detail['amount_idr'] < 0) {
                    $detail['amount_idr'] = preg_replace("([/-])", "", $detail['amount_idr']);
                    $detail['amount_idr'] = "(" . $detail['amount_idr'] . ")";
                }
                if ($detail['amount_valas'] < 0) {
                    $detail['amount_valas'] = preg_replace("([/-])", "", $detail['amount_valas']);
                    $detail['amount_valas'] = "(" . $detail['amount_valas'] . ")";
                }
            }

            $result[$group_id]['details'][$detail_id] = $detail;
        }

        if ($this->bank_facil_rows_are_empty($vcif, BANK_FACIL_CASH)) {
            $result[BANK_FACIL_CASH] = $this->get_default_cash($vcif);
        }

        if ($this->bank_facil_rows_are_empty($vcif, BANK_FACIL_DIRECT_LOAN)) {
            $result[BANK_FACIL_DIRECT_LOAN] = $this->get_default_direct_loan($vcif, $result[BANK_FACIL_DIRECT_LOAN]['details']);
        }
        return $result;
    }

    private function bank_facil_rows_are_empty($vcif, $group_id) {
        $query_string = <<<SQL
select count(1) row_count from bankingfacility_values
where vcif = ?
and data_year = ?
and detail_id in (
    select detail_id 
	from bankingfacility_details
	where group_id = ?
)
SQL
        ;
        $row = $this->db->query($query_string, array($vcif, $this->year_current, $group_id))->row();
        return $row->row_count == 0;
    }

    private function get_default_cash($vcif) {

        $query_string = <<<SQL
with source_table as (
	select 
	   saldo,
	   beban_bunga,
	   case currency
		  when 'IDR' then 'IDR'
		  else 'VALAS'
	   end currency,
	   desc1 
	from fact_simpanan_cpa
    WHERE DATEPART(m, posisi) = DATEPART(m, DATEADD(m, -1, getdate()))
        AND DATEPART(yyyy, posisi) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
	    AND cifno in (
            select cif 
            from par_mapping_vcif
            where vcif = ?
        )
)
select 
   sum(saldo) saldo,
   sum(beban_bunga) beban_bunga,
   currency,
   desc1
from source_table
group by currency, desc1
order by desc1
SQL
        ;

        $current_account = 6;
        $time_deposit = 7;

        $rows = $this->db->query($query_string, array($vcif))->result();

        $result = array(
            'name' => 'Cash'
        );

        $details = array(
            $current_account => array(
                'detail_name' => 'Current Account',
            ),
            $time_deposit => array(
                'detail_name' => 'Time Deposit',
            )
        );

        foreach ($details as $detail_name => $detail) {
            $details[$detail_name]['mandatory'] = TRUE;
            $details[$detail_name]['optional'] = FALSE;
            //
            $details[$detail_name]['amount_idr'] = 0;
            $details[$detail_name]['amount_idr_percent'] = 0;
            $details[$detail_name]['amount_valas'] = 0;
            $details[$detail_name]['amount_valas_percent'] = 0;
        }

        foreach ($rows as $row) {

            $amount = $row->saldo;
            $amount_percent = round($row->beban_bunga / $row->saldo * 100, 2);

            if ($row->desc1 == 'GIRO' && $row->currency == 'IDR') {
                $details[$current_account]['amount_idr'] = $amount;
                $details[$current_account]['amount_idr_percent'] = $amount_percent;
            }
            if ($row->desc1 == 'GIRO' && $row->currency == 'VALAS') {
                $details[$current_account]['amount_valas'] = $amount;
                $details[$current_account]['amount_valas_percent'] = $amount_percent;
            }
            if ($row->desc1 == 'DEPOSITO' && $row->currency == 'IDR') {
                $details[$time_deposit]['amount_idr'] = $amount;
                $details[$time_deposit]['amount_idr_percent'] = $amount_percent;
            }
            if ($row->desc1 == 'DEPOSITO' && $row->currency == 'VALAS') {
                $details[$time_deposit]['amount_valas'] = $amount;
                $details[$time_deposit]['amount_valas_percent'] = $amount_percent;
            }
        }

        $result['details'] = $details;
        return $result;
    }

    private function get_default_direct_loan($vcif, $details_from_db) {
        $query_string = <<<SQL
with source_table as (
    select 
        baki_debet,
	pend_bunga,
	case mata_uang
            when 'IDR' then 'IDR'
            else 'VALAS'
	end currency,
	jenis_penggunaan
	from fact_kredit_cpa
    WHERE DATEPART(m, posisi) = DATEPART(m, DATEADD(m, -1, getdate()))
        AND DATEPART(yyyy, posisi) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
	    AND cifno in (
            select cif 
            from par_mapping_vcif
            where vcif = ?
	    )
)
select 
    sum(baki_debet) baki_debet,
    sum(pend_bunga) pend_bunga,
    currency,
    jenis_penggunaan
from source_table
group by currency, jenis_penggunaan
SQL
        ;

        $ki = 1;
        $kmk = 2;

        $rows = $this->db->query($query_string, array($vcif))->result();

        $result = array(
            'name' => 'Direct Loan'
        );

        $details = array(
            $ki => array(
                'detail_name' => 'KI',
            ),
            $kmk => array(
                'detail_name' => 'KMK',
            )
        );

        foreach ($details as $detail_name => $detail) {
            $details[$detail_name]['mandatory'] = TRUE;
            $details[$detail_name]['optional'] = FALSE;
            //
            $details[$detail_name]['amount_idr'] = 0;
            $details[$detail_name]['amount_idr_percent'] = 0;
            $details[$detail_name]['amount_valas'] = 0;
            $details[$detail_name]['amount_valas_percent'] = 0;
        }

        foreach ($rows as $row) {

            $amount = $row->baki_debet;
            try {
                if ($row->baki_debet != 0) {
                    $amount_percent = round($row->pend_bunga / $row->baki_debet * 100, 2);
                } else {
                    $amount_percent = 0.00;
                }
            } catch (Exception $e) {
                $amount_percent = 0.00;
            }

            if ($row->jenis_penggunaan == 1 && $row->currency == 'IDR') {
                $details[$ki]['amount_idr'] = $amount;
                $details[$ki]['amount_idr_percent'] = $amount_percent;
            }
            if ($row->jenis_penggunaan == 1 && $row->currency == 'VALAS') {
                $details[$ki]['amount_valas'] = $amount;
                $details[$ki]['amount_valas_percent'] = $amount_percent;
            }
            if ($row->jenis_penggunaan == 2 && $row->currency == 'IDR') {
                $details[$kmk]['amount_idr'] = $amount;
                $details[$kmk]['amount_idr_percent'] = $amount_percent;
            }
            if ($row->jenis_penggunaan == 2 && $row->currency == 'VALAS') {
                $details[$kmk]['amount_valas'] = $amount;
                $details[$kmk]['amount_valas_percent'] = $amount_percent;
            }
        }

        foreach ($details_from_db as $detail) {
            if ($detail['optional']) {
                $details[] = $detail;
            }
        }

        $result['details'] = $details;


        return $result;
    }

    public function save_banking_facility() {
        $this->db->trans_start();
        $rows_mandatory = array();
        $rows_optional = array();

        foreach ($this->rows as $row) {
            $row->vcif = $this->vcif;
            $row->data_year = $this->year_current;
            $mandatory = $row->mandatory;
            unset($row->mandatory);
            if ($mandatory) {
                unset($row->detail_name);
                $rows_mandatory[] = $row;
            } else {
                $row->group_id = $this->group_id;
                unset($row->detail_id);
                $rows_optional[] = $row;
            }
        }

        $this->delete_banking_facility_value($rows_mandatory);
        $this->insert_banking_facility_value($rows_mandatory);

        $this->delete_banking_facility_addition();
        $this->insert_banking_facility_addition($rows_optional);

        $this->db->trans_complete();
    }

    private function delete_banking_facility_value($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('bankingfacility_values');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function delete_banking_facility_addition() {
        $this->db->from('bankingfacility_additions');
        $this->db->where_in('vcif', $this->vcif);
        $this->db->where_in('group_id', $this->group_id);
        $this->db->delete();
    }

    private function insert_banking_facility_value($rows) {
        if (empty($rows)) {
            return;
        }
        $this->db->insert_batch('bankingfacility_values', $rows);
    }

    private function insert_banking_facility_addition($rows) {
        if (empty($rows)) {
            return;
        }
        $this->db->insert_batch('bankingfacility_additions', $rows);
    }

}
