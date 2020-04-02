<?php
class M_profile extends CI_Model{
 
    function list(){
        $hasil=$this->db->query("SELECT * FROM MASTER_DIVISIONS");
        return $hasil->result();
    }
     
}