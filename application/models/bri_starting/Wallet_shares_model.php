<?php

class Wallet_shares_model extends CI_Model {

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

    "values".amount_idr bri_share,
    "values".amount_valas bri_share_valas, 
    wallet_shares.total_share,
	
    1 mandatory,
    0 optional

from bankingfacility_groups groups 

inner join bankingfacility_details details 
on groups.id = details.group_id 
        
left join ( 
    select * 
    from bankingfacility_values 
    where data_year = ? and vcif = ? 
) "values" 
on details.id = "values".detail_id 

left join (
	select *
	from wallet_shares
	where data_year = ? and vcif = ? 
) wallet_shares
on details.id = wallet_shares.detail_id 

union all 
select 
	additions.group_id,
	groups.group_name,    
	'addition-' + convert(varchar, additions.id) detail_id,
	additions.detail_name,

	additions.amount_idr bri_share,
    additions.amount_valas bri_share_valas,
	wallet_shares_addition.total_share,
	
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
	from wallet_shares_addition
	where data_year = ? and vcif = ? 
) wallet_shares_addition
on additions.id = wallet_shares_addition.detail_id 
SQL
        ;

        $rows = $this->db->query($query_string, array(
                    $year_current, $vcif,
                    $year_current, $vcif,
                    $year_current, $vcif,
                    $year_current, $vcif)
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

            $result[$group_id]['details'][$detail_id] = array(
                'name' => $row->detail_name,
                'bri_share' => $row->bri_share + $row->bri_share_valas,
                'total_share' => $row->total_share,
                'mandatory' => $row->mandatory === 1
            );
        }
        return $result;
    }

    public function save_wallet_shares() {
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
                $row->detail_id = str_replace('addition-', '', $row->detail_id);
                unset($row->group_id);
                $rows_optional[] = $row;
            }
        }

        $this->delete_wallet_share_value($rows_mandatory);
        $this->insert_wallet_share_value($rows_mandatory);
        if(!empty($rows_optional)) {
        $this->delete_wallet_share_addition($rows_optional);
        $this->insert_wallet_share_addition($rows_optional);
    }
        $this->db->trans_complete();
    }

    private function delete_wallet_share_value($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('wallet_shares');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function delete_wallet_share_addition($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('wallet_shares_addition');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function insert_wallet_share_value($rows) {
        $this->db->insert_batch('wallet_shares', $rows);
    }

    private function insert_wallet_share_addition($rows) {
        $this->db->insert_batch('wallet_shares_addition', $rows);
    }

}
