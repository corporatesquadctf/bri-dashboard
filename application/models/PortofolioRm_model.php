<?php
    class PortofolioRm_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getTotalCustomer($userId, $month, $year, $keyword){
            $sql = "SELECT
                        DISTINCT Cif, CustomerName, SubSectorEconomyName, Address, WarnaLPG
                    FROM Summary_PinjamanMenengah
                    WHERE RIGHT('00000000'+ISNULL(LTRIM(RTRIM(PnPengelola)),''),8) = '".$userId."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            if($keyword != null){
                $sql .= " AND (";
                $sql .= " Cif LIKE '%".$keyword."%'";
                $sql .= " OR CustomerName LIKE '%".$keyword."%'";
                $sql .= " OR SubSectorEconomyName LIKE '%".$keyword."%'";
                $sql .= " OR Address LIKE '%".$keyword."%')";
            }
            $query = $this->db->query($sql);
            $result = $query->result();
            return count($result);
        }

        public function getAllCustomer($userId, $limitPage, $rowNo, $month, $year, $keyword){
            $sql = "SELECT
                        DISTINCT Cif, CustomerName, SubSectorEconomyName, Address, WarnaLPG
                    FROM Summary_PinjamanMenengah
                    WHERE RIGHT('00000000'+ISNULL(LTRIM(RTRIM(PnPengelola)),''),8) = '".$userId."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            if($keyword != null){
                $sql .= " AND (";
                $sql .= " Cif LIKE '%".$keyword."%'";
                $sql .= " OR CustomerName LIKE '%".$keyword."%'";
                $sql .= " OR SubSectorEconomyName LIKE '%".$keyword."%'";
                $sql .= " OR Address LIKE '%".$keyword."%')";
            }
            $sql .= " ORDER BY Cif OFFSET ".$rowNo." ROWS FETCH NEXT ".$limitPage." ROWS ONLY";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
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

        public function getOutstandingKredit($userId, $cif, $noRekening, $periode){
            $arrPeriode = explode("-", $periode);
            $year = $arrPeriode[0];
            $month = $arrPeriode[1];
            $sql = "SELECT PlafonEfektif FROM Summary_PinjamanMenengah
                    WHERE RIGHT('00000000'+ISNULL(LTRIM(RTRIM(PnPengelola)),''),8) = '".$userId."'
                    AND Cif = '".$cif."' AND NoRekening = '".$noRekening."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            $query = $this->db->query($sql);		
            $result = $query->result();
            return $result;
        }

        public function getInstandingSimpanan($noRekening, $periode){
            $arrPeriode = explode("-", $periode);
            $year = $arrPeriode[0];
            $month = $arrPeriode[1];
            $sql = "SELECT Saldo FROM Summary_SimpananMenengah
                    WHERE NoRekening = '".$noRekening."'
                    AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
            $query = $this->db->query($sql);		
            $result = $query->result();
            return $result;
        }

        public function getFasilitasPermohonan($data){
            $where = array(
                "NoRekening" => $data["NoRekening"],
                "Periode" => $data["Periode"]
            );
            $this->db->select("*");
            $this->db->from("PortofolioDetailPermohonanFacility");
            $this->db->where($where);
            $result = $this->db->get()->result();
            return $result;
        }

        public function getDetailPortofolioKredit($noRekening, $periode){
            $sql = "SELECT * FROM Summary_PinjamanMenengah WHERE NoRekening = '".$noRekening."' AND Periode = '".$periode."'";
            $query = $this->db->query($sql);		
            $result = $query->result();
            return $result[0];
        }

        public function changeStatusPortofolioKredit($data){
            /* 0 = Default ; 1 Mulai */
            $modifiedDate = date("Y-m-d H:i:s");
            $where = array(
                "NoRekening" => $data["NoRekening"],
                "Periode" => $data["Periode"]
            );
            $portofolio = array(
                "TotalPlafondPermohonan" => $data["total_plafond_permohonan"],
                "BulanRealisasi" => $data["BulanRealisasi"],
                "JangkaWaktu" => $data["JangkaWaktu"],
                "IsProcess" => $data["IsProcess"]
            );
            $this->db->update("Summary_PinjamanMenengah", $portofolio, $where);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Update Portofolio Kredit Failed"
                );
            }else{
                //Insert Fasilitas Permohonan
                $this->db->delete("PortofolioDetailPermohonanFacility", array("NoRekening" => $data["NoRekening"], "Periode" => $data["Periode"]));
                $arrFasilitasPermohonan = array();
                foreach($data["ArrFasilitasPermohonan"] as $row){
                    $fasilitasPermohonan = array(
                        "NoRekening" => $data["NoRekening"],
                        "Periode" => $data["Periode"],
                        "FacilityId" => $row["FacilityId"],
                        "Plafond" => $row["Plafond"],
                        "CreatedBy" => $this->session->PERSONAL_NUMBER,
                        "CreatedDate" => date("Y-m-d H:i:s")
                    );
                    array_push($arrFasilitasPermohonan, $fasilitasPermohonan);
                }
                $this->db->insert_batch("PortofolioDetailPermohonanFacility", $arrFasilitasPermohonan);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Fasilitas Permohonan Failed"
                    );
                }else{
                    if($data["IsProcess"] == 1){
                        //Proses portofolio & insert to Monitoring portofolio
                        $dataMonitoringPortofolio = array(
                            "Cif" => $data["Cif"],
                            "NoRekening" => $data["NoRekening"],
                            "Periode" => $data["Periode"],
                            "StatusApplicationId" => $this->session->ROLE_ID,
                            "StatusPutusan" => 0,
                            'IsAkad' => 0,
                            "CreatedBy" => $this->session->PERSONAL_NUMBER,     
                            "CreatedDate" => $modifiedDate          
                        );
                        $this->db->insert("PortofolioKredit", $dataMonitoringPortofolio);
                        $errorStatus = $this->db->error();
                        if($errorStatus["code"]<>0){
                            $result = array(
                                "status" => "error",
                                "message" => $errorStatus["message"],
                                "event" => "Insert Monitoring Portofolio Kredit Failed"
                            );
                        }else{
                            $result = array(
                                "status" => "success",
                                "message" => "Data has been saved"
                            );
                        }
                    }else{
                        $result = array(
                            "status" => "success",
                            "message" => "Data has been saved"
                        );
                    }
                }                
            }
            return $result;
        }
    }
?>