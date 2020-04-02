<?php

class Action_plan_model extends CI_Model {

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
    
        estimated_financials.projection_idr,
        estimated_financials.projection_valas,
        estimated_financials.target_idr,
        estimated_financials.target_valas,
        
        1 mandatory,
        0 optional
    
    from bankingfacility_groups groups 
    
    inner join bankingfacility_details details 
    on groups.id = details.group_id 
            
    left join (
        select *
        from estimated_financials
        where data_year = ? and vcif = ? 
    ) estimated_financials
    on details.id = estimated_financials.detail_id 
    
            union all 
    select 
        additions.group_id,
        groups.group_name,    
        'addition-' + convert(varchar, additions.id) detail_id,
        additions.detail_name,
    
            estimated_financials_additions.projection_idr,
            estimated_financials_additions.projection_valas,
            estimated_financials_additions.target_idr,
            estimated_financials_additions.target_valas,
        
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
        from estimated_financials_additions
        where data_year = ? and vcif = ? 
    ) estimated_financials_additions
    
    on additions.id = estimated_financials_additions.detail_id 

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
                'projection_idr' => $row->projection_idr,
                'projection_valas' => $row->projection_valas,
                'target_idr' => $row->target_idr,
                'target_valas' => $row->target_valas,
                'optional' => $row->optional === 1,
                'mandatory' => $row->mandatory === 1
            );
        }
        return $result;
    }

    public function save_action_plan() {
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

        $this->delete_action_plan($rows_mandatory);
        $this->insert_action_plan_value($rows_mandatory);

        $this->delete_action_plan_addition();
        $this->insert_action_plan_addition($rows_optional);

        $this->db->trans_complete();
    }

    private function delete_action_plan($rows) {
        $detail_ids = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
        }

        $this->db->from('estimated_financials');

        $this->db->where('vcif', $this->vcif);
        $this->db->where('data_year', $this->year_current);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function delete_action_plan_addition() {
        $this->db->from('estimated_financials_additions');
        $this->db->where_in('vcif', $this->vcif);
        $this->db->where_in('group_id', $this->group_id);
        $this->db->delete();
    }

    private function insert_action_plan_value($rows) {
        $this->db->insert_batch('estimated_financials', $rows);
    }

    private function insert_action_plan_addition($rows) {
        $this->db->insert_batch('estimated_financials_additions', $rows);
    }

    public function save_initiative($vcif, $rows, $year) {
        $customer_vcif = $vcif;
        $user_id = $_SESSION['USER_ID'];
        $dataIniat = $rows;
        $this->db->where('VCIF', $customer_vcif);
        $this->db->where('DATA_YEAR', $year);
        $this->db->delete('INITIATIVE_ACTIONS');

        foreach ($dataIniat as $ini) {

            $newData = [
                'VCIF' => $customer_vcif,
                'INITIATIVES' => preg_replace('/ +/', ' ', trim($ini->initiative)),
                'PERIOD_DATE' => $ini->action_plan . '-01',
                'DESCRIPTION' => preg_replace('/ +/', ' ', trim($ini->description)),
                'STATUS' => 1,
                'DATA_YEAR' => $year,
                'ADDON' => date('Y-m-d H:i:s'),
                'ADDBY' => $user_id
            ];
            $get_initiativesAct = $this->db->insert('INITIATIVE_ACTIONS', $newData);
        }
    }

    public function get_initiative_actions($vcif, $year) {
        if (empty($vcif)) {
            return array();
        }
        $today = new DateTime(date('Y-m-d'));
        $year_current = $today->format('Y');

        $this->db->select(<<<SQL
            INITIATIVE_ACTIONS.vcif, 
            INITIATIVE_ACTIONS.data_year,
            INITIATIVE_ACTIONS.initiatives, 
            INITIATIVE_ACTIONS.description, 
            INITIATIVE_ACTIONS.period_date period_date, 
            MASTER_PERIODS.QUARTER_NAME action_quarter, 
            MASTER_PERIODS.MONTH_NAME action_month
SQL
        );
        $this->db->from('INITIATIVE_ACTIONS');
        $this->db->join('MASTER_PERIODS', 'INITIATIVE_ACTIONS.PERIOD_ID = MASTER_PERIODS .ID ', 'left');
        $this->db->where('VCIF', $vcif);
        $this->db->where('DATA_YEAR', $year);
        return $this->db->get()->result_array();
    }

    public function get_estimated_financial($vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');
        $yearMin1 = $yearNow - 1;

        if (!empty($vcif)) {
            $qDirLoan = "SELECT a.DETAIL_ID, a.GROUP_ID, a.VCIF, a.DATA_YEAR, b.DETAIL_NAME, a.PROJECTION_IDR, a.PROJECTION_VALAS, a.TARGET_IDR, a.TARGET_VALAS FROM ESTIMATED_FINANCIALS a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 1";
            $getQDirLoan = $this->db->query($qDirLoan);

            $res['DIRECT_LOAN'] = $getQDirLoan->result();

            $qIndLoan = "SELECT a.DETAIL_ID, a.GROUP_ID, a.VCIF, a.DATA_YEAR, b.DETAIL_NAME, a.PROJECTION_IDR, 
				a.PROJECTION_VALAS, a.TARGET_IDR, a.TARGET_VALAS 
				FROM ESTIMATED_FINANCIALS a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID 
				WHERE a.VCIF = '" . $vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "' AND b.GROUP_ID = 2;";
            $getQIndLoan = $this->db->query($qIndLoan);

            $res['INDIRECT_LOAN'] = $getQIndLoan->result();

            $qCash = "SELECT a.DETAIL_ID, a.GROUP_ID, a.VCIF, a.DATA_YEAR, b.DETAIL_NAME, a.PROJECTION_IDR, a.PROJECTION_VALAS, a.TARGET_IDR, a.TARGET_VALAS FROM ESTIMATED_FINANCIALS a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 3";
            $getQCash = $this->db->query($qCash);

            $res['CASH'] = $getQCash->result();

            $qTranBank = "SELECT a.DETAIL_ID, a.GROUP_ID, a.VCIF, a.DATA_YEAR, b.DETAIL_NAME, a.PROJECTION_IDR, a.PROJECTION_VALAS, a.TARGET_IDR, a.TARGET_VALAS FROM ESTIMATED_FINANCIALS a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 4";
            $getQTranBank = $this->db->query($qTranBank);

            $res['TRAN_BANK'] = $getQTranBank->result();

            $qOthInfo = "SELECT a.GROUP_ID, a.VCIF, a.DATA_YEAR, b.DETAIL_NAME, a.PROJECTION_IDR, a.PROJECTION_VALAS, a.TARGET_IDR, a.TARGET_VALAS FROM ESTIMATED_FINANCIALS a LEFT JOIN BANKINGFACILITY_DETAILS b ON b.ID = a.DETAIL_ID WHERE a.VCIF = '" . $vcif . "'AND a.DATA_YEAR = '" . $yearMin1 . "'AND b.GROUP_ID = 5";
            $getQOthInfo = $this->db->query($qOthInfo);

            $res['OTHER_INFO'] = $getQOthInfo->result();
        }
        return $res;
    }

}
