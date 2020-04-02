<?php

class Company_information_model extends CI_Model {

    private $user_id;
    private $current_time;

    function __construct() {
        parent::__construct();
        $this->load->library('session');

        $this->user_id = $_SESSION['USER_ID'];
        $this->current_time = date('Y-m-d H:i:s');
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    function get_key_shareholders($vcif, $year) {

        $this->db->select(<<<SQL
            ID shareholder_id,
            shareholder,
            share_value,
            portion
SQL
        );
        $this->db->from('SHAREHOLDERS');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);
        $result = $this->db->get()->result();

        foreach ($result as $row) {
            $row->share_value_formatted = number_format($row->share_value);
        }

        return $result;
    }

    function save_key_shareholders($vcif, $rows, $year) {

        $total_share_value = 0;
        foreach ($rows as $row) {
            $total_share_value += $row->share_value;
        }
        if ($total_share_value == 0) {
            $row->portion = 0;
            foreach ($rows as $row) {
                $row->portion = 0;
                $row->vcif = $vcif;
                $row->year = $year;
                $row->addby = $this->user_id;
                $row->addon = $this->current_time;
            }
        } else {
            foreach ($rows as $row) {
                $row->portion = $row->share_value / $total_share_value * 100;
                $row->vcif = $vcif;
                $row->year = $year;
                $row->addby = $this->user_id;
                $row->addon = $this->current_time;
            }
        }

        $this->db->trans_start();
        $this->db->from('shareholders');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);
        $this->db->delete();
        $this->db->insert_batch('shareholders', $rows);
        $this->db->trans_complete();
    }

    function get_strategic_plans($vcif, $year) {
        $result = array(
            1 => array(),
            2 => array()
        );

        $this->db->select('id planning_id, planning, planning_type, year');
        $this->db->from('strategic_plans');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);
        $strategic_plans = $this->db->get()->result_array();
        foreach ($strategic_plans as $strategic_plan) {
            $result[$strategic_plan['planning_type']][] = $strategic_plan;
        }
        return $result;
    }

    function save_strategic_plans($vcif, $year, $planning_type, $rows) {
        foreach ($rows as $row) {
            $row->vcif = $vcif;
            $row->planning_type = $planning_type;
            $row->addby = $this->user_id;
            $row->addon = $this->current_time;
            $row->year = $year;
        }

        $this->db->trans_start();
        $this->db->from('strategic_plans');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);
        $this->db->where('planning_type', $planning_type);
        $this->db->delete();
        $this->db->insert_batch('strategic_plans', $rows);
        $this->db->trans_complete();
    }

    function get_coverage_mappings($vcif, $year) {
        $this->db->select('client_position, client_name, contact_person, other_information, bank_position, bank_person');
        $this->db->from('coverage_mappings');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);

        return $this->db->get()->result_array();
    }

    function save_coverage_mappings($vcif, $rows, $year) {

        foreach ($rows as $row) {
            $row->vcif = $vcif;
            $row->addby = $this->user_id;
            $row->addon = $this->current_time;
            $row->year = $year;
            unset($row->index);
        }

        $this->db->trans_start();
        $this->db->from('coverage_mappings');
        $this->db->where('vcif', $vcif);
        $this->db->where('year', $year);
        $this->db->delete();
        $this->db->insert_batch('coverage_mappings', $rows);
        $this->db->trans_complete();
    }

    function get_group_overview($vcif, $year) {
        $this->db->select(<<<SQL
                    go.id groupoverview_id,
                    go.vcif,
                    go.parent_id,
                    go.year,
                    go.city_id,
                    lp.description city_name, 
                    go.address1 address1,
                    go.globalrating_id,
                    go.globalrating_desc,
                    gr.name globalrating,
                    gr.description globaldesc, 
                    go.domesticrating_id,   
                    dr.name domesticrating, 
                    go.industry_name,
                    go.industrytype_id,
                    it.name industrytrend,
                    go.lifecycle_id,
                    lc.name lifecycle
SQL
        );
        $this->db->from('group_overviews go');
        $this->db->join('lookup_provinsi lp', 'lp.pklookup = go.city_id', 'left');
        $this->db->join('master_globalratings gr', 'gr.id = go.globalrating_id', 'left');
        $this->db->join('master_domesticratings dr', 'dr.id = go.domesticrating_id', 'left');
        $this->db->join('master_industrytrends it', 'it.id = go.industrytype_id', 'left');
        $this->db->join('master_lifecycles lc', 'lc.id = go.lifecycle_id', 'left');
        $this->db->where('go.vcif', $vcif);
        $this->db->where('go.year', $year);

        return $this->db->get()->row();
    }

    function save_group_overview($row) {
        unset($row->customer_name);
        unset($row->globaldesc);
        unset($row->industrytrend_id);

        $row->addon = $this->current_time;
        $row->addby = $this->user_id;
        $row->year = $this->year_current;

        $this->db->trans_start();
        $this->db->where('vcif', $row->vcif);
        $this->db->where('year', $this->year_current);
        $row_count = $this->db->count_all_results('group_overviews');

        if ($row_count == 0) {
            $this->db->insert('group_overviews', $row);
        } else {
            $this->db->where('vcif', $row->vcif);
            $this->db->update('group_overviews', $row);
        }
        //
        $this->db->trans_complete();
    }

}
