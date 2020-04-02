<?php
    class PortofolioRmApi_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getAllRekeningKredit($userId, $cif, $month, $year){
            $sql = "SELECT
                        NoRekening, JenisPenggunaan, PlafonAwal, WarnaEWS, Kolektibilitas,
                        SegmentationName, Status, TglRealisasi, TglJatuhTempo, Periode, BulanRealisasi, JangkaWaktu, IsProcess
                    FROM Summary_PinjamanMenengah
                    WHERE RIGHT('00000000'+ISNULL(LTRIM(RTRIM(PnPengelola)),''),8) = '".$userId."' AND Cif = '".$cif."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function getAllRekeningSimpanan($cif, $month, $year){
            $sql = "SELECT
                        Periode, NoRekening, Saldo
                    FROM Summary_SimpananMenengah
                    WHERE Cif = '".$cif."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year."
                    ORDER BY Saldo DESC OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function getRekeningKreditDetail($userId, $cif, $month, $year, $noRekening){
            $sql = "SELECT
                        NoRekening, JenisPenggunaan, PlafonAwal, WarnaEWS, WarnaLPG, Kolektibilitas,
                        SegmentationName, Status, TglRealisasi, TglJatuhTempo, Periode, BulanRealisasi, JangkaWaktu, IsProcess
                    FROM Summary_PinjamanMenengah
                    WHERE RIGHT('00000000'+ISNULL(LTRIM(RTRIM(PnPengelola)),''),8) = '".$userId."' AND Cif = '".$cif."' AND NoRekening = ".$noRekening."
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function getRekeningSimpananDetail($cif, $month, $year, $noRekening){
            $sql = "SELECT
                        Periode, NoRekening, Saldo
                    FROM Summary_SimpananMenengah
                    WHERE Cif = '".$cif."' AND NoRekening = ".$noRekening."
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year."
                    ORDER BY Saldo DESC OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
    }
