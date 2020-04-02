<?php
class ProsesKredit_model extends MY_Model {

	function __construct() {
        parent::__construct();
        $this->currentDateTime = date('Y-m-d H:i:s.v');
    }

    function addProsesKredit($data){
        $pipelineId = $data['PipelineId'];
        $statusApplicationId = $data['StatusApplicationId'];
        $statusPutusan = 0;
        $isAkad = 0;
        $userId = $data['UserId'];
        
        $isCommit = 1;
        $this->db->trans_begin();

        $row = array(
            'PipelineId' => $pipelineId,
            'StatusApplicationId' => $statusApplicationId,
            'StatusPutusan' => $statusPutusan,
            'IsAkad' => $isAkad,
            'CreatedBy' => $userId,
            'CreatedDate' => $this->currentDateTime,
            'ModifiedBy' => $userId,
            'ModifiedDate' => $this->currentDateTime
        );

        $this->db->insert('ProsesKredit', $row);
        if ($this->db->trans_status() === FALSE){
            $isCommit = 0;
        }
            
        if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
    }

    function getProsesKredit($data){
        $whereClause = " WHERE t2.StatusId = 6";

        if($data['Keyword'] != NULL){
            if($whereClause == "") 
                $whereClause .= " WHERE (";
            else
                $whereClause .= " AND (";
            $whereClause .= " t2.CustomerName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t4.DataSourceName LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.Address LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t2.BusinessType LIKE '%".$data['Keyword']."%'";
            $whereClause .= " OR t3.name LIKE '%".$data['Keyword']."%'";
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
        
        $sql = "SELECT  t1.*, 
                        t2.CustomerName, t2.Address, t2.BusinessType, t2.TotalPlafondPermohonan AS Plafond, t2.JangkaWaktu,
                        t3.Name AS RMName,
                        t4.DataSourceName AS StatusPermohonan,
                        t5.Name AS StatusApplicationName
                FROM ProsesKredit t1
                LEFT JOIN Pipeline t2 ON t1.PipelineId = t2.PipelineId
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN PipelineDataSource t4 ON t2.DataSourceId = t4.PipelineDataSourceId
                LEFT JOIN Role t5 ON t1.StatusApplicationId = t5.RoleId ".$whereClause."
                ORDER BY ModifiedDate DESC";
        
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;
    }

    function getDetailProsesKredit($prosesKreditId){
        $where = array(
            't1.ProsesKreditId' => $prosesKreditId
        );

        $this->db->select("t1.*, t2.CustomerName, t2.Address, t2.ContactPerson, t2.plafond, t2.JangkaWaktu, t2.BusinessType, t3.DataSourceName AS StatusPermohonan, t4.Name AS RMName, t4.UnitKerjaId AS DivisionId, t5.Name AS UnitKerjaName, t6.Name as RoleName");
        $this->db->from("ProsesKredit t1");
        $this->db->join('Pipeline t2', 't1.PipelineId = t2.PipelineId', 'left');
        $this->db->join('PipelineDataSource t3', 't2.DataSourceId = t3.PipelineDataSourceId', 'left');
        $this->db->join('User t4', 't1.CreatedBy = t4.Userid', 'left');
        $this->db->join("UnitKerja t5", "t4.UnitKerjaId = t5.UnitKerjaId");
        $this->db->join("Role t6", "t4.RoleId = t6.RoleId", "left");
        $this->db->where($where);

        $queryData = $this->db->get();
        $result = $queryData->result();
        return $result[0];
    }

    function updateTanggapan($data){
        $this->db->trans_begin();
        $where = array(
            "ProsesKreditId" => $data["ProsesKreditId"]
        );
        $data = array(
            "Tanggapan" => $data["Tanggapan"],
            "TanggapanBy" => $data["UserId"],
            "ModifiedBy" => $data["UserId"],
            "ModifiedDate" => $this->currentDateTime
        );
        $result = $this->db->update("ProsesKredit", $data, $where);
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

    function getHistoryProsesKredit($prosesKreditId, $statusApplicationId = null, $type = 1){
        /*

        if($statusApplicationId == null){
            $where = array(
                't1.ProsesKreditId' => $prosesKreditId
            );
        }else{
            $where = array(
                't1.ProsesKreditId' => $prosesKreditId,
                't2.RoleId' => $statusApplicationId
            );
        }

        $this->db->select("t1.*, t2.Name as CreatedByName, t4.Name AS ROLE_NAME");
        $this->db->from('ProsesKreditLog t1');
        $this->db->join('User t2', 't1.CreatedBy = t2.UserId ', 'left');
        $this->db->join('Role t4', 't1.StatusApplicationId = t4.RoleId ', 'left');
        $this->db->where($where);
        $this->db->order_by('t1.CreatedDate','DESC');
        $result = $this->db->get()->result();
        return $result;
        */

        $sql = "SELECT t1.*, t2.Name AS CreatedByName, t4.Name AS ROLE_NAME
                FROM ProsesKreditLog t1
                LEFT JOIN [User] t2 ON t1.CreatedBy = t2.UserId
                LEFT JOIN Role t4 ON t1.StatusApplicationId = t4.RoleId
                WHERE t1.ProsesKreditId = ".$prosesKreditId;
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

    function getFasilitasPermohonan($prosesKreditId){
        $where = array(
            "t2.ProsesKreditId" => $prosesKreditId
        );
        $this->db->select("t3.FacilityName, t1.Plafond");
        $this->db->from("PipelineDetailPermohonanFacility t1");
        $this->db->join("ProsesKredit t2", "t1.PipelineId = t2.PipelineId", "left");
        $this->db->join("Facility t3", "t1.FacilityId = t3.FacilityId", "left");
        $this->db->where($where);
        $result = $this->db->get()->result();
        return $result;
    }

    function updateStatusProsesKredit($data){
        $prosesKreditId = $data['prosesKreditId'];
        $isApproved = $data['isApproved'];
        $statusApplicationId = $data['tujuanId'];
        $comment = $data['comment'];
        $putusanId = $data['putusanId'];
        $waktuKunjungan = $data["waktuKunjungan"];
        $hasilKunjungan = $data["hasilKunjungan"];
        $userId = $data['userId'];
        $divisionId = $data['divisionId'];
        $roleId = $data['roleId'];
        $arrDocumentProsesKredit = $data["arrDocumentProsesKredit"];
        
        $isCommit = 1;
        $this->db->trans_begin();

        if($roleId == 14 && $putusanId != 0){
            $prosesKredit = array(
                'StatusApplicationId' => $statusApplicationId,
                'StatusPutusan' => $putusanId,
                'TanggalPutusan' => $this->currentDateTime,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }else if($roleId == USER_ROLE_RM_MENENGAH){
            $prosesKredit = array(
                'WaktuKunjungan' => $waktuKunjungan,
                'HasilKunjungan' => $hasilKunjungan,
                'StatusApplicationId' => $statusApplicationId,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }else{
            $prosesKredit = array(
                'StatusApplicationId' => $statusApplicationId,
                'ModifiedBy' => $userId,
                'ModifiedDate' => $this->currentDateTime
            );
        }
        
        $where = array(
            'ProsesKreditId' => $prosesKreditId
        );
        $rs = $this->db->update('ProsesKredit', $prosesKredit, $where);
        if($rs != 1){
            $isCommit = 0;
        }else{
            if($roleId == USER_ROLE_ADK && $statusApplicationId == USER_ROLE_WP){
                foreach($arrDocumentProsesKredit as $row){
                    $sqlSelect = "SELECT * FROM ProsesKreditDocumentStatus WHERE ProsesKreditId = ".$prosesKreditId." AND ProsesKreditDocumentId = ".$row["ProsesKreditDocumentId"];
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
                            "ProsesKreditId" => $prosesKreditId,
                            "ProsesKreditDocumentId" => $row["ProsesKreditDocumentId"]
                        );
                        $this->db->update("ProsesKreditDocumentStatus", $document, $where);
                    }else{
                        $document = array(
                            "ProsesKreditId" => $prosesKreditId,
                            "ProsesKreditDocumentId" => $row["ProsesKreditDocumentId"],
                            "Status" => $row["Status"],
                            "Description" => $row["Description"],
                            "ModifiedBy" => $row["ModifiedBy"],
                            "ModifiedDate" => $row["ModifiedDate"]
                        );
                        $this->db->insert("ProsesKreditDocumentStatus", $document);
                    }
                    
                    $errorStatus = $this->db->error();
                    if($errorStatus["code"]<>0){
                        $isCommit = 0;
                        break;
                    }
                }
            }
            
            if($this->addLogProsesKredit($prosesKreditId, $isApproved, $statusApplicationId, $comment, $userId, 1)){
                switch($isApproved){
                    case 0:
                        $comment = 'Pengembalian Paket Kredit'; break;
                    case 1:
                        $comment = 'Pengiriman Paket Kredit'; break;
                    default: break;
                }
                switch($statusApplicationId){
                    case 12: 
                        $statusApplicationUserId = $this->getProsesKreditMaker($prosesKreditId);
                        $this->notification_model->addNotif($statusApplicationUserId, "Monitoring Proses Kredit", $comment, "", "monitoring/proseskredit/detail/".$prosesKreditId); 
                        if ($this->db->trans_status() === FALSE){
                            $isCommit = 0;
                        }
                        break;
                    default : 
                        $rsUser = $this->getUserInformation($statusApplicationId, $divisionId);
                        foreach($rsUser as $row){
                            $this->notification_model->addNotif($row->id, "Monitoring Proses Kredit", $comment, "", "monitoring/proseskredit/detail/".$prosesKreditId); 
                            if ($this->db->trans_status() === FALSE){
                                $isCommit = 0;
                            }
                        }
                        /* Send Notification to Kadiv Role */
                        if($statusApplicationId == 14){
                            $rsKadiv = $this->getUserInformation(16);
                            foreach($rsKadiv as $rowKadiv){
                                $this->notification_model->addNotif($rowKadiv->id, "Monitoring Proses Kredit", $comment, "", "monitoring/proseskredit/detail/".$prosesKreditId); 
                                if ($this->db->trans_status() === FALSE){
                                    $isCommit = 0;
                                }
                            }
                        }
                        break;
                }
            }else $isCommit = 0;                  
        }

        if($isCommit == 0){
			$this->db->trans_rollback();
			$result = array(
                "status" => "error",
                "message" => "Failed to update Proses Kredit",
                "event" => "Teruskan proses kredit failed"
            );
		}else{
			$this->db->trans_commit();
			$result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    function multipleCommentProsesKredit($data){
        $isCommit = 1;
        $this->db->trans_begin();
        foreach($data['arrProsesKreditId'] as $row){
            $isApproved = NULL;
            $statusApplicationId = NULL;
            $comment = $data['comment'];
            $userId = $data['userId'];
            $result = $this->addLogProsesKredit($row, $isApproved, $statusApplicationId, $comment, $userId, 0);
            if(!$result) {
                $isCommit = 0; 
                break;
            }else{
                $RM = $this->getProsesKreditMaker($row);
                $comment = "Komentar Proses Kredit";
                $this->notification_model->addNotif($RM, "Monitoring Proses Kredit", $comment, "", "monitoring/proseskredit/detail/".$row);                
            }
        }
        if($isCommit == 0){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
    }

    function prosesAkadKredit($data){
        $userId = $data['userId'];
        $prosesKreditId = $data['prosesKreditId'];
        $tanggalAkad = $data['tanggalAkad'];
        $notarisName = $data['notarisName'];
        $desc = $data['desc'];
        $isCommit = 1;
        $this->db->trans_begin();
        $prosesKredit = array(
            'IsAkad' => 1,
            'TanggalAkad' => $tanggalAkad,
            'NamaNotaris' => $notarisName,
            'Keterangan' => $desc,
            'ModifiedBy' => $userId,
            'ModifiedDate' => $this->currentDateTime
        );        
        $where = array(
            'prosesKreditId' => $prosesKreditId
        );
        $this->db->update('ProsesKredit', $prosesKredit, $where);
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

    function addLogProsesKredit($prosesKreditId, $isApproved, $statusApplicationId, $comment, $createdBy, $type){
        $data = array(
            'ProsesKreditId' => $prosesKreditId,
            'IsApproved' => $isApproved,
            'StatusApplicationId' => $statusApplicationId,
            'Comment' => $comment,
            'Type' => $type,
            'CreatedBy' => $createdBy,
            'CreatedDate' => $this->currentDateTime
        );        
        $this->db->insert('ProsesKreditLog', $data);
        if ($this->db->trans_status() === FALSE){
            return 0;
        }else return 1;
    }

    function getTujuanProsesKreditOption($arrRole = null){
        $this->db->select('RoleId AS ID, Name AS ROLE_NAME');
        $this->db->from('Role');
        $this->db->where('IsActive', 1);
        if($arrRole != null){
            $countRole = count($arrRole);
            if($countRole == 1){
                $this->db->where('RoleId', $arrRole[0]);
            }else{
                $this->db->where_in('RoleId', $arrRole);
            }
        }
        $this->db->order_by('ROLE_NAME','ASC');
        $result = $this->db->get()->result();
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

    function getProsesKreditMaker($prosesKreditId){
        $this->db->select('CreatedBy');
        $this->db->from('ProsesKredit');
        $this->db->where('ProsesKreditId',$prosesKreditId);
        $result = $this->db->get()->result();
        return $result[0]->CreatedBy;
    }

    function getProsesKreditDocumentStatus($prosesKreditId, $prosesKreditDocumentId = NULL){
        $sql = "SELECT Status, Description, ModifiedBy
                FROM ProsesKreditDocumentStatus
                WHERE ProsesKreditId = ".$prosesKreditId;
        if($prosesKreditDocumentId != null){
            $sql .= " AND ProsesKreditDocumentId = ".$prosesKreditDocumentId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getProsesKreditDocument(){
        $this->db->select("*");
        $this->db->from("ProsesKreditDocument");
        $result = $this->db->get()->result();
        return $result;
    }
}
?>