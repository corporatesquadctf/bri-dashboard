<?php

class Competition_analyses_model extends CI_Model {

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

    competition_analysis.first_bank,
    competition_analysis.second_bank,
    competition_analysis.third_bank,
    a.name first_name,
    b.name second_name,
    c.name third_name,
	
    1 mandatory,
    0 optional

from bankingfacility_groups groups 

inner join bankingfacility_details details 
on groups.id = details.group_id 
        
left join (
	select *
	from competition_analysis
	where data_year = ? and vcif = ? 
) competition_analysis
on details.id = competition_analysis.detail_id 

left join master_banks a on a.id = competition_analysis.first_bank
left join master_banks b on b.id = competition_analysis.second_bank
left join master_banks c on c.id = competition_analysis.third_bank

union all 
select 
	additions.group_id,
	groups.group_name,    
	'addition-' + convert(varchar, additions.id) detail_id,
	additions.detail_name,

        competition_analysis_addition.first_bank,
        competition_analysis_addition.second_bank,
        competition_analysis_addition.third_bank,
        a.name first_name,
        b.name second_name,
        c.name third_name,
	
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
	from competition_analysis_addition
	where data_year = ? and vcif = ? 
) competition_analysis_addition
on additions.id = competition_analysis_addition.detail_id 

left join master_banks a on a.id = competition_analysis_addition.first_bank
left join master_banks b on b.id = competition_analysis_addition.second_bank
left join master_banks c on c.id = competition_analysis_addition.third_bank
SQL
        ;

        $rows = $this->db->query($query_string, array(
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
                'first_bank' => $row->first_bank,
                'second_bank' => $row->second_bank,
                'third_bank' => $row->third_bank,
                'first_name' => $row->first_name,
                'second_name' => $row->second_name,
                'third_name' => $row->third_name,
                'mandatory' => $row->mandatory === 1
            );
        }
        return $result;
    }

    public function save_competition_analyses() {
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

        $this->delete_competition_analysis($rows_mandatory);
        $this->insert_competition_analysis($rows_mandatory);
        if (!empty($rows_optional)) {
            $this->delete_competition_analysis_addition($rows_optional);
            $this->insert_competition_analysis_addition($rows_optional);
        }
        $this->db->trans_complete();
    }

    private function delete_competition_analysis($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('competition_analysis');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function delete_competition_analysis_addition($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('competition_analysis_addition');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function insert_competition_analysis($rows) {
        $this->db->insert_batch('competition_analysis', $rows);
    }

    private function insert_competition_analysis_addition($rows) {
        $this->db->insert_batch('competition_analysis_addition', $rows);
    }

}
