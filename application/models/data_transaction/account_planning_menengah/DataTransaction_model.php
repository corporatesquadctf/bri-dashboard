<?php
    class DataTransaction_model extends CI_Model {
        function __construct() {
            parent::__construct();
            $today = new DateTime(date('Y-m-d H:i:s'));
            $this->year_current = $today->format('Y');
            $this->todays = $today->format('Y-m-d H:i:s');
        }

        public function getPinjamanLastUpdateDate(){
            $result = array();
            $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
                FROM Summary_PinjamanDailyCif
                ";

            $query = $this->db->query($sql)->row_array();
            $result['total'] = $query['LastUpdateDate'];

            $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
                FROM Summary_PinjamanMonthlyCif
                ";

            $query = $this->db->query($sql)->row_array();
            $result['ratas'] = $query['LastUpdateDate'];

            return $result;
        }

        public function getSimpananLastUpdateDate(){
            $result = array();

            $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
                FROM Summary_SimpananDailyCif";
            $query = $this->db->query($sql)->row_array();
            $result['total'] = $query['LastUpdateDate'];
            
            $sql = "SELECT FORMAT(MAX(Periode),'dd MMMM yyyy') LastUpdateDate 
                FROM Summary_SimpananMonthlyCif";
            $query = $this->db->query($sql)->row_array();
            $result['ratas'] = $query['LastUpdateDate'];

            return $result;
        }

        public function getDataSimpananAccountPlanningMenengah($CIF){
            $sql = "SELECT *FROM 
                (
                    SELECT ISNULL(SUM(Saldo),0) TotalSimpanan
                    FROM Summary_SimpananDailyCif
                    WHERE Cif = '".$CIF."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananDailyCustomer)
                ) A,
                (
                    SELECT ISNULL(AVG(AverageSaldo),0) RatasSimpanan
                    FROM Summary_SimpananMonthlyCif
                    WHERE Cif = '".$CIF."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
                ) B
            ";
            $result = $this->db->query($sql);

            return $result->row_array();
        }

        public function getDataPinjamanAccountPlanningMenengah($CIF){
            $sql = "SELECT *FROM 
                (
                    SELECT ISNULL(SUM(BakiDebet),0) TotalPinjaman
                    FROM Summary_PinjamanDailyCif
                    WHERE Cif = '".$CIF."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_PinjamanDailyCustomer)
                ) A,
                (
                    SELECT ISNULL(AVG(BakiDebetRatas),0) RatasPinjaman
                    FROM Summary_PinjamanMonthlyCif
                    WHERE Cif = '".$CIF."'
                    AND Periode = (SELECT MAX(Periode) FROM Summary_SimpananMonthlyCustomer)
                ) B";

            $result = $this->db->query($sql);

            return $result->row_array();
        }
    }
?>