<?php

class Master_model extends CI_Model {

    public function get_global_ratings() {
        $this->db->select('ID GLOBALRATE_ID, NAME GLOBALRATE_NAME, DESCRIPTION GLOBALRATE_DESC');
        $this->db->from('MASTER_GLOBALRATINGS');
        return $this->db->get()->result_array();
    }

    public function get_group_overview() {

        $this->db->select('ID ID, VCIF VCIF, CITY CITY_ID');
        $this->db->from('GROUP_OVERVIEW');
        $this->db->where('VCIF', $customer_vcif);
        return $this->db->get()->result_array();
    }

    public function get_domestic_ratings() {
        $this->db->select('ID DOMESTICRATING_ID, NAME DOMESTICRATING');
        $this->db->from('MASTER_DOMESTICRATINGS');
        return $this->db->get()->result_array();
    }

    public function get_industry_trends() {
        $this->db->select('ID INDUSTRYTREND_ID, NAME INDUSTRYTREND');
        $this->db->from('MASTER_INDUSTRYTRENDS');
        return $this->db->get()->result_array();
    }

    public function get_life_cycles() {
        $this->db->select('ID LIFECYCLE_ID, NAME LIFECYCLE');
        $this->db->from('MASTER_LIFECYCLES');
        return $this->db->get()->result_array();
    }

    public function get_banks() {
        $this->db->select('ID BANK_ID, NAME BANK');
        $this->db->from('MASTER_BANKS');
        $this->db->order_by('NAME');
        return $this->db->get()->result_array();
    }

    public function get_divisions() {
        $sql = "SELECT UnitKerjaId, Name
            FROM UnitKerja
            WHERE IsActive=1";
            
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function get_div() {
        $this->db->select('ID, DIVISION_NAME');
        $this->db->from('MASTER_DIVISIONS');
        $this->db->where('STATUS', 1);
        return $this->db->get()->result();
    }

    public function get_log() {
        $this->db->distinct();
        $this->db->select('Action');
        $this->db->from('Log');
        return $this->db->get()->result();
    }

    public function get_tb_log() {
        // $this->db->select('*');
        // $this->db->from('Log');
        // $this->db->order_by('LogDate', 'DESC');
        // return $this->db->get()->result();

        $sql = '
            SELECT * FROM Log
            ORDER BY LogDate DESC 
            OFFSET 0 ROWS FETCH NEXT 500 ROWS ONLY
        ';

        return $this->db->query($sql)->result();  
    }

    public function get_mydiv($divisi_ini) {
        $this->db->select('ID, DIVISION_NAME');
        $this->db->from('MASTER_DIVISIONS');
        $this->db->where('STATUS', 1);
        $this->db->where('ID', $divisi_ini);
        return $this->db->get()->result();
    }

    public function get_param($APvcif) {
        $this->db->distinct();
        $this->db->select('VCIF, COMPANY_NAME, MASTER_SUPER_CLASSIFICATIONS');
        $this->db->from('VIEW_RELASI');
        $this->db->where('VCIF', $APvcif);
        return $this->db->get()->result();
    }

    public function get_seven_divisions() {
        $this->db->select('ID division_id, division_name    ');
        $this->db->from('MASTER_DIVISIONS');
        $this->db->where('STATUS', 1);
        $this->db->where('DIVISION_TYPE', 1);
        $result = $this->db->get()->result();
        $hasil = Array();
        $json = '{ "division_id": "0", "division_name": "Please Select" }';
        $temp = json_decode($json);
        $hasil[] = $temp;
        /*
          $json = '{ "division_id": "1", "division_name": "all" }';
          $temp = json_decode($json);
          $hasil[] = $temp;
         */
        foreach ($result as $r) {
            $hasil[] = $r;
        };
        return $hasil;
    }

}
