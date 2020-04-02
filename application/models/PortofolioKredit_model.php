<?php
class PortofolioKredit_model extends MY_Model {

	function __construct() {
        parent::__construct();
        $this->currentDateTime = date('Y-m-d H:i:s');
    }

    function getPortofolioKredit($data){
        $whereClause = " WHERE t2.IsProcess = 1";

        if($data['Keyword'] != NULL){
            if($whereClause == "") 
                $whereClause .= " WHERE (";
            else
                $whereClause .= " AND (";
            $whereClause .= " t2.CustomerName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.Address LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.SubsectorEconomyName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t3.Name LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.TotalPlafondPermohonan LIKE '%".$data['Keyword']."%'";
            $whereClause .= ")";
        }

        if($data['DivisionId'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t3.UnitKerjaId = ".$data['DivisionId'];
        }

        if($data['UsulanPlafond'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            switch($data['UsulanPlafond']){
                case 1:
                    $whereClause .= $conn." t2.TotalPlafondPermohonan < 50000000000";
                    break;
                case 2:
                    $whereClause .= $conn." t2.TotalPlafondPermohonan >= 50000000000";
                    break;
            }            
        }

        if($data['CreatedBy'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn. " t1.CreatedBy = '".$data['CreatedBy']."'";
        }

        $pagination = "";
        if(isset($data['limit_per_page'])){
            $pagination = " OFFSET ".$data['rowno']." ROWS FETCH NEXT ".$data['limit_per_page']." ROWS ONLY";
        }

        $sql = "SELECT  t1.*, 
                        t2.CustomerName, t2.Address, t2.SubsectorEconomyName, t2.TotalPlafondPermohonan AS Plafond, t2.JangkaWaktu,
                        t3.Name AS RMName,
                        t5.Name AS StatusApplicationName
                FROM PortofolioKredit t1
                LEFT JOIN Summary_PinjamanMenengah t2 ON t1.NoRekening = t2.NoRekening AND t1.Periode = t2.Periode
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN Role t5 ON t1.StatusApplicationId = t5.RoleId ".$whereClause."
                ORDER BY ModifiedDate DESC".$pagination;
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;
    }

    function getTotalPortofolioKredit($data){
        $whereClause = " WHERE t2.IsProcess = 1";

        if($data['Keyword'] != NULL){
            if($whereClause == "") 
                $whereClause .= " WHERE (";
            else
                $whereClause .= " AND (";
            $whereClause .= " t2.CustomerName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.Address LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.SubsectorEconomyName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t3.Name LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.PlafonAwal LIKE '%".$data['Keyword']."%'";
            $whereClause .= ")";
        }

        if($data['DivisionId'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t3.UnitKerjaId = ".$data['DivisionId'];
        }

        if($data['UsulanPlafond'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            switch($data['UsulanPlafond']){
                case 1:
                    $whereClause .= $conn." t2.PlafonAwal < 50000000000";
                    break;
                case 2:
                    $whereClause .= $conn." t2.PlafonAwal >= 50000000000";
                    break;
            }            
        }

        if($data['CreatedBy'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn. " t1.CreatedBy = '".$data['CreatedBy']."'";
        }
        
        $sql = "SELECT COUNT(1) Total
                FROM PortofolioKredit t1
                LEFT JOIN Summary_PinjamanMenengah t2 ON t1.NoRekening = t2.NoRekening AND t1.Periode = t2.Periode
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN Role t5 ON t1.StatusApplicationId = t5.RoleId ".$whereClause."";
        
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;
    }

    function multipleComment($data){
        $this->db->trans_begin();
        $isCommit = 1;
        $msg = "";
        foreach($data["ArrPortofolioKreditId"] as $row){
            $isApproved = NULL;
            $statusApplicationId = NULL;
            $comment = $data['Comment'];
            $userId = $data['UserId'];
            $currentDate = $data["CurrentDate"];
            $result = $this->addLogPortofolioKredit($row, $isApproved, $statusApplicationId, $comment, $userId, $currentDate, 0);
            if($result["status"] == "error") {
                $isCommit = 0;
                $msg = $result["message"];
                break;
            }else{
                $RM = $this->getPortofolioKreditOwner($row);
                $comment = "Komentar Portofolio Kredit";
                $this->notification_model->addNotif($RM, "Monitoring Portofolio Kredit", $comment, "", "monitoring/portofolio_kredit/detail/".$row);                
            }
        }
        if($isCommit == 0){
			$this->db->trans_rollback();
			$result = array(
                "status" => "error",
                "message" => $msg
            );
		}else{
            $this->db->trans_commit();
            $result = array(
                "status" => "success",
                "message" => "Data has been saved"
            );
        }
        return $result;
    }

    function addLogPortofolioKredit($portofolioKreditId, $isApproved, $statusApplicationId, $comment, $createdBy, $currentDate, $type){
        $data = array(
            "PortofolioKreditId" => $portofolioKreditId,
            "IsApproved" => $isApproved,
            "StatusApplicationId" => $statusApplicationId,
            "Comment" => $comment,
            "Type" => $type,
            "CreatedBy" => $createdBy,
            "CreatedDate" => $currentDate
        );        
        $this->db->insert("PortofolioKreditLog", $data);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Portofolio Kredit Failed"
            );
        }else {
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    function getPortofolioKreditOwner($portofolioKreditId){
        $this->db->select("CreatedBy");
        $this->db->from("PortofolioKredit");
        $this->db->where("PortofolioKreditId",$portofolioKreditId);
        $result = $this->db->get()->result();
        return $result[0]->CreatedBy;
    }

    function getDetailPortofolioKredit($portofolioKreditId){
        $sql = "SELECT  t1.*,
                        t2.CustomerName, t2.Address, t2.PlafonAwal AS plafond, t2.JangkaWaktu, t2.CustomerName AS ContactPerson, t2.SubsectorEconomyName,
                        t3.Name AS RMName, t3.UnitKerjaId AS DivisionId,
                        t4.Name AS UnitKerjaName,
                        t5.Name AS RoleName
                FROM PortofolioKredit t1
                LEFT JOIN Summary_PinjamanMenengah t2 ON t1.NoRekening = t2.NoRekening AND t1.Periode = t2.Periode
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN UnitKerja t4 ON t3.UnitKerjaId = t4.UnitKerjaId
                LEFT JOIN Role t5 ON t3.RoleId = t5.RoleId
                WHERE t1.PortofolioKreditId = ".$portofolioKreditId;
        $query = $this->db->query($sql);
        $result = $query->result();
        if($result)
            return $result[0];
        else
            return FALSE;
    }

    function getHistoryPortofolioKredit($portofolioKreditId, $statusApplicationId = null, $type = 1){
        $sql = "SELECT t1.*, t2.Name AS CreatedByName, t4.Name AS ROLE_NAME
                FROM PortofolioKreditLog t1
                LEFT JOIN [User] t2 ON t1.CreatedBy = t2.UserId
                LEFT JOIN Role t4 ON t1.StatusApplicationId = t4.RoleId
                WHERE t1.PortofolioKreditId = ".$portofolioKreditId;
        if($type == 0){
            $sql .= " AND  t1.Type = ".$type;
        }else{
            $sql .= " AND (t1.Type = ".$type." OR t1.Type IS null)";
        }
        if($statusApplicationId != null){
            if($statusApplicationId != 14){
                $sql .= " AND t2.RoleId = ".$statusApplicationId;
            }else{
                $sql .= " AND t2.RoleId IN (14, 16)";
            }
        }
        $sql .= " ORDER BY t1.CreatedDate DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getFasilitasPermohonan($portofolioKreditId){
        $sql = "SELECT t1.Plafond, t3.FacilityName
                FROM PortofolioDetailPermohonanFacility t1
                LEFT JOIN PortofolioKredit t2 ON t1.NoRekening = t2.NoRekening AND t1.Periode = t2.Periode
                LEFT JOIN Facility t3 ON t1.FacilityId = t3.FacilityId
                WHERE t2.PortofolioKreditId = ".$portofolioKreditId;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getPortofolioKreditDocumentStatus($portofolioKreditId, $portofolioKreditDocumentId = NULL){
        $sql = "SELECT Status, Description, ModifiedBy
                FROM PortofolioKreditDocumentStatus
                WHERE PortofolioKreditId = ".$portofolioKreditId;
        if($portofolioKreditDocumentId != null){
            $sql .= " AND PortofolioKreditDocumentId = ".$portofolioKreditDocumentId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function updateStatusPortofolioKredit($data){
        $portofolioKreditId = $data['portofolioKreditId'];
        $isApproved = $data['isApproved'];
        $statusApplicationId = $data['tujuanId'];
        $comment = $data['comment'];
        $putusanId = $data['putusanId'];
        $waktuKunjungan = $data["waktuKunjungan"];
        $hasilKunjungan = $data["hasilKunjungan"];
        $userId = $data['userId'];
        $divisionId = $data['divisionId'];
        $roleId = $data['roleId'];
        $arrDocumentPortofolioKredit = $data["arrDocumentPortofolioKredit"];
        $currentDate = $this->currentDateTime;
        
        $isCommit = 1;
        $this->db->trans_begin();

        if($roleId == 14 && $putusanId != 0){
            $portofolioKredit = array(
                'StatusApplicationId' => $statusApplicationId,
                'StatusPutusan' => $putusanId,
                'TanggalPutusan' => $this->currentDateTime,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }else if($roleId == USER_ROLE_RM_MENENGAH){
            $portofolioKredit = array(
                'WaktuKunjungan' => $waktuKunjungan,
                'HasilKunjungan' => $hasilKunjungan,
                'StatusApplicationId' => $statusApplicationId,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }else{
            $portofolioKredit = array(
                'StatusApplicationId' => $statusApplicationId,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }
        
        $where = array(
            'PortofolioKreditId' => $portofolioKreditId
        );
        $this->db->update('PortofolioKredit', $portofolioKredit, $where);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Portofolio Kredit Failed"
            );
            $isCommit = 0;
        }else {
            if($roleId == USER_ROLE_ADK && $statusApplicationId == USER_ROLE_WP){
                foreach($arrDocumentPortofolioKredit as $row){
                    $sqlSelect = "SELECT * FROM PortofolioKreditDocumentStatus
                                  WHERE PortofolioKreditId = ".$portofolioKreditId."
                                  AND PortofolioKreditDocumentId = ".$row["PortofolioKreditDocumentId"];
                    $querySelect = $this->db->query($sqlSelect);		
                    $resultSelect = $querySelect->result();

                    if(!empty($resultSelect)){
                        $document = array(
                            "Status" => $row["Status"],
                            "Description" => $row["Description"],
                            "ModifiedBy" => $row["ModifiedBy"],
                            "ModifiedDate" => $row["ModifiedDate"]
                        );
                        $where = array(
                            "PortofolioKreditId" => $portofolioKreditId,
                            "PortofolioKreditDocumentId" => $row["PortofolioKreditDocumentId"]
                        );
                        $this->db->update("PortofolioKreditDocumentStatus", $document, $where);
                    }else{
                        $document = array(
                            "PortofolioKreditId" => $portofolioKreditId,
                            "PortofolioKreditDocumentId" => $row["PortofolioKreditDocumentId"],
                            "Status" => $row["Status"],
                            "Description" => $row["Description"],
                            "ModifiedBy" => $row["ModifiedBy"],
                            "ModifiedDate" => $row["ModifiedDate"]
                        );
                        $this->db->insert("PortofolioKreditDocumentStatus", $document);
                    }                    
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $result = array(
                            "status" => "error",
                            "message" => $errorStatus["message"],
                            "event" => "Update Portofolio Kredit Document Failed"
                        );
                        $isCommit = 0;
                        break;
                    }
                }
            }

            $rs = $this->addLogPortofolioKredit($portofolioKreditId, $isApproved, $statusApplicationId, $comment, $userId, $currentDate, 1);
            if($rs["status"] == "error") {
                $result = $rs;
                $isCommit = 0;
            }else{
                switch($isApproved){
                    case 0:
                        $comment = 'Pengembalian Portofolio Kredit'; break;
                    case 1:
                        $comment = 'Pengiriman Portofolio Kredit'; break;
                    default: break;
                }
                switch($statusApplicationId){
                    case 12: 
                        $statusApplicationUserId = $this->getPortofolioKreditOwner($portofolioKreditId);
                        $this->notification_model->addNotif($statusApplicationUserId, "Monitoring Portofolio Kredit", $comment, "", "monitoring/portofolio_kredit/detail/".$portofolioKreditId);
                        break;
                    default :
                        $rsUser = $this->getUserInformation($statusApplicationId, $divisionId);
                        foreach($rsUser as $row){
                            $this->notification_model->addNotif($row->id, "Monitoring Portofolio Kredit", $comment, "", "monitoring/portofolio_kredit/detail/".$portofolioKreditId);
                        }
                        /* Send Notification to Kadiv Role */
                        if($statusApplicationId == 14){
                            $rsKadiv = $this->getUserInformation(16);
                            foreach($rsKadiv as $rowKadiv){
                                $this->notification_model->addNotif($rowKadiv->id, "Monitoring Portofolio Kredit", $comment, "", "monitoring/portofolio_kredit/detail/".$portofolioKreditId);
                            }
                        }
                        break;
                }
            }
        }

        if($isCommit == 0){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
			$result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    function getUserInformation($roleId, $divisionId = null){
        if ($divisionId == null){
            $where = array(
                'RoleId' => $roleId,
                'IsActive' => 1
            );
        }else{
            $where = array(
                'UnitKerjaId' => $divisionId,
                'RoleId' => $roleId,
                'IsActive' => 1
            );
        }
        $this->db->select('UserId AS id, UnitKerjaId AS role_id, Name');
        $this->db->from('User');
        $this->db->where($where);
        $result = $this->db->get()->result();
        return $result;
    }

    function updateTanggapan($data){
        $this->db->trans_begin();
        $where = array(
            "PortofolioKreditId" => $data["PortofolioKreditId"]
        );
        $data = array(
            "Tanggapan" => $data["Tanggapan"],
            "TanggapanBy" => $data["UserId"],
            "ModifiedBy" => $data["UserId"],
            "ModifiedDate" => $this->currentDateTime
        );
        $result = $this->db->update("PortofolioKredit", $data, $where);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Tanggapan"
            );
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    function prosesAkadKredit($data){
        $userId = $data['userId'];
        $portofolioKreditId = $data['portofolioKreditId'];
        $tanggalAkad = $data['tanggalAkad'];
        $notarisName = $data['notarisName'];
        $desc = $data['desc'];
        $this->db->trans_begin();
        $portofolioKredit = array(
            'IsAkad' => 1,
            'TanggalAkad' => $tanggalAkad,
            'NamaNotaris' => $notarisName,
            'Keterangan' => $desc,
            'ModifiedBy' => $userId,
            'ModifiedDate' => $this->currentDateTime
        );        
        $where = array(
            'PortofolioKreditId' => $portofolioKreditId
        );
        $this->db->update('PortofolioKredit', $portofolioKredit, $where);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $this->db->trans_rollback();
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Proses Akad Kredit Failed"
            );
        }else {
            $this->db->trans_commit();
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    
}
?>