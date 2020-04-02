<?php

class MonitoringRm_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function getTotalViewRelationshipManager($search = '') {
        $this->db->select(<<<SQL
            MonitoringRmId
SQL
            );
        $this->db->from('MonitoringRm');
        if (!empty($search)) {
            $this->db->like('MonitoringRm.PersonalNumber', $search);
            $this->db->or_like('MonitoringRm.RmName', $search);
            $this->db->or_like('MonitoringRm.Division', $search);
            $this->db->or_like('MonitoringRm.Year', $search);
            $this->db->or_like('MonitoringRm.AccountPlanningList', $search);
        }
        return $this->db->count_all_results();
    }

    public function getViewRelationshipManager($rowperpage, $rowno, $search = '') {
         $this->db->select(<<<SQL
            MonitoringRmId, PersonalNumber, RmName, Division, LastActivity, Year, AccountPlanningTotal, AccountPlanningList, AccountPlanningPublish, AccountPlanningWa, AccountPlanningDraft, AccountPlanningReject, AccountPlanningProgress
SQL
            );
        $this->db->from('MonitoringRm');
        if (!empty($search)) {
            $this->db->like('MonitoringRm.PersonalNumber', $search);
            $this->db->or_like('MonitoringRm.RmName', $search);
            $this->db->or_like('MonitoringRm.Division', $search);
            $this->db->or_like('MonitoringRm.Year', $search);
            $this->db->or_like('MonitoringRm.AccountPlanningList', $search);
        }
        $this->db->limit($rowperpage, $rowno); 
        return $this->db->get()->result_array();
    }
}
