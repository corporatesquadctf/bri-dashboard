<?php
class Log_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
    }

    public function get_log_list($LogTypeId, $ProcedureType) {

        $this->db->select('LogImportId, CreatedDate, ProcedureName, IsSuccess, ProcedureType');
        $this->db->from('LogImport');
        $this->db->where('LogTypeId', $LogTypeId);
        $this->db->where('ProcedureType', $ProcedureType);
        $this->db->order_by('CreatedDate', 'DESC');
        return $this->db->get()->result_array();
    }

}
?>