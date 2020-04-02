<?php

/**
 * 
 */
class ShareholdersModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function saveGroupOverview($data = array()) {
        return $this->db->insert('GROUP_OVERVIEWS', $data);
    }

    function total (){
    	$this->load->database();
        $queryData = $this->db
        		// ->distinct()
        		->select_sum('SHARE_VALUE')
        		->where('VCIF', 'IQWAASZO')
                ->from('SHAREHOLDERS')
                // ->join('PAR_MAPPING_VCIF b', 'b.CIF = a.CIFNO', 'left')
        		;
        $queryData = $this->db->get();
        $data['totals'] = $queryData->result();
    }

}

?>