<?php
class Pipeline_model extends MY_Model {

	function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->load->model('ProsesKredit_model');
        $this->load->database();
    }
    
    function getPipeline($data){
        
        $whereClause = "";

        if($data['LAYER_STATUS_ID'] != NULL){
            $count_layer = count($data['LAYER_STATUS_ID']);
            if($count_layer == 1){
                $whereClause .= " WHERE t1.LayerStatusId = ".$data['LAYER_STATUS_ID'][0];
            }else{
                $whereClause .= " WHERE t1.LayerStatusId IN (";
                $i=0;
                foreach($data['LAYER_STATUS_ID'] as $row){
                    if($i != 0) $whereClause .= ",";
                    $whereClause .= $row;
                    $i++;
                }
                $whereClause .= ")";
            }
        }

        if($data['STATUS_ID'] != NULL){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $count_status = count($data['STATUS_ID']);
            if($count_status == 1){
                $whereClause .= $conn." t1.StatusId = ".$data['STATUS_ID'][0];
            }else{
                $whereClause .= $conn." t1.StatusId IN (";
                $i=0;
                foreach($data['STATUS_ID'] as $row){
                    if($i != 0) $whereClause .= ",";
                    $whereClause .= $row;
                    $i++;
                }
                $whereClause .= ")";
            }
        }

        if($data['YEAR'] != NULL){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." YEAR(t1.SubmittedDate) = ".$data['YEAR'];
        }

        if($data['CREATED_BY'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t1.CreatedBy = '".$data['CREATED_BY']."'";
        }

        if($data['DIVISION_ID'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t3.UnitKerjaId = ".$data['DIVISION_ID'];
        }

        if($data['SEKTOR_USAHA_ID'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t1.BusinessSector = ".$data['SEKTOR_USAHA_ID'];
        }

        if($data['KEYWORD'] != NULL){
            $whereClause .= " AND (";
            $whereClause .= "t2.CIF LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.CustomerName LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t7.DataSourceName LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.Address LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.BusinessType LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t3.name LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.Plafond LIKE '%".$data['KEYWORD']."%')";
        }

        $sql = "SELECT t1.*, t2.CIF, t3.Name AS RM_NAME, t6.Name AS LAYER_STATUS_NAME, t5.PipelineStatusName AS STATUS_NAME, t7.DataSourceName
                FROM Pipeline t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIFId = t2.CustomerMenengahId
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN PipelineApprovalLayer t4 ON t1.LayerStatusId = t4.PipelineApprovalLayerId
                LEFT JOIN PipelineStatus t5 ON t1.StatusId = t5.PipelineStatusId
                LEFT JOIN Role t6 ON t4.RoleId = t6.RoleId
                LEFT JOIN PipelineDataSource t7 ON t1.DataSourceId = t7.PipelineDataSourceId ".$whereClause." 
                ORDER BY ModifiedDate DESC";
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;        
    }

    function getHistoryPipeline($data){
        $whereClause = "";
        
        if($data['STATUS_ID'] != NULL){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $count_status = count($data['STATUS_ID']);
            if($count_status == 1){
                $whereClause .= $conn." t1.StatusId = ".$data['STATUS_ID'][0];
            }else{
                $whereClause .= $conn." t1.StatusId IN (";
                $i=0;
                foreach($data['STATUS_ID'] as $row){
                    if($i != 0) $whereClause .= ",";
                    $whereClause .= $row;
                    $i++;
                }
                $whereClause .= ")";
            }
        }

        if($data['YEAR'] != NULL || $data['YEAR'][0] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $count_year = count($data["YEAR"]);
            if($count_year == 1){
                $whereClause .= $conn." YEAR(t1.SubmittedDate) = ".$data["YEAR"][0];
            }else{
                $whereClause .= $conn." YEAR(t1.SubmittedDate) IN (";
                $i=0;
                foreach($data['YEAR'] as $row){
                    if($i != 0) $whereClause .= ",";
                    $whereClause .= $row;
                    $i++;
                }
                $whereClause .= ")";
            }
        }

        if($data['CREATED_BY'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t1.CreatedBy = ".$data['CREATED_BY'];
        }

        if($data['DIVISION_ID'] != 0){
            if ($whereClause == "") 
                $conn = " WHERE ";
            else $conn = " AND ";
            $whereClause .= $conn." t3.UnitKerjaId = ".$data['DIVISION_ID'];
        }

        if($data['KEYWORD'] != NULL){
            $whereClause .= " AND (";
            $whereClause .= " t2.CIF LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.CustomerName LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t7.DataSourceName LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.Address LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.BusinessType LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t3.name LIKE '%".$data['KEYWORD']."%'";
            $whereClause .= " OR t1.Plafond LIKE '%".$data['KEYWORD']."%')";
        }

        $sql = "SELECT t1.*, t2.CIF, t3.Name AS RM_NAME, t6.Name AS LAYER_STATUS_NAME, t5.PipelineStatusName AS STATUS_NAME, t7.DataSourceName
                FROM Pipeline t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIFId = t2.CustomerMenengahId
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN PipelineApprovalLayer t4 ON t1.LayerStatusId = t4.PipelineApprovalLayerId
                LEFT JOIN PipelineStatus t5 ON t1.StatusId = t5.PipelineStatusId
                LEFT JOIN Role t6 ON t4.RoleId = t6.RoleId
                LEFT JOIN PipelineDataSource t7 ON t1.DataSourceId = t7.PipelineDataSourceId ".$whereClause." 
                ORDER BY ModifiedDate DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        
        $rs = array();
        foreach($result as $row){
            $isPassedLayerApproval = $this->checkIsPassedLayerApproval($row->PipelineId, $data['LAYER_STATUS_ID'][0]);
            if($isPassedLayerApproval == 1){
                if($row->LayerStatusId == $data['LAYER_STATUS_ID']){
                    if($row->StatusId != 3){
                        $rs[] = $row;
                    }
                } else $rs[] = $row;
            }
        }
        return $rs;
    }

    function getDetailPipeline($id){
        $where = array(
            't1.PipelineId' => $id
        );

        $this->db->select("t1.*, t2.CIF, t3.Name, t4.SubSectorEconomyName, t5.DataSourceName");
        $this->db->from("Pipeline t1");
        $this->db->join("CustomerMenengah t2", "t1.CIFId = t2.CustomerMenengahId", "left");
        $this->db->join("TdbSource t3", "t1.TDBResourceId = t3.TdbSourceId", "left");
        $this->db->join("SubSectorEconomy t4", "t1.EconomySubSector = t4.SubSectorEconomyId", "left");
        $this->db->join("PipelineDataSource t5", "t1.DataSourceId = t5.PipelineDataSourceId", "left");
        $this->db->where($where);

        $queryData = $this->db->get();
        $result = $queryData->result();
        return $result[0];
    }

    function createPipeline($data){
        $created_date = date('Y-m-d H:i:s');
        $this->db->trans_begin();

        $row = array(
            'DataSourceId' => $data['sumber_pipeline'],
            'CIFId' => $data['cif'],
            'CustomerMenengahTypeId' => $data['jenis_debitur'], 
            'CustomerName' => $data['nama_debitur'],
            'NPWP' => $data['npwp_perusahaan'],
            'Address' => $data['alamat'],
            'ContactPerson' => $data['contact_person'],
            'PhoneNumber' => $data['no_telp'],
            'BusinessType' => $data['jenis_usaha'],
            'BusinessSector' => $data['sektor_usaha'],
            'EconomySubSector' => $data['sub_sektor_ekonomi'],
            'LPGStatus' => $data['warna_lpg'],
            'LPGDescription' => $data["lpgDescription"],
            'CustomerStatusId' => $data['status_debitur'],
            'Plafond' => $data['plafond'],
            'CustomerResouceId' => $data['tdb'],
            'TDBResourceId' => $data['sumber_tdb'],
            'LayerStatusId' => 1,
            'StatusId' => 1,
            'AdditionalDesc' => $data['additional_desc'],
            'CreatedBy' => $data['user_id'],
            'CreatedDate' => $created_date,
            'ModifiedBy' => $data['user_id'],
            'ModifiedDate' => $created_date
        );
        
        $this->db->insert('Pipeline', $row);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Create Pipeline"
            );
        }else{
            $insert_id = $this->db->insert_id();
            // Add Fasilitas Suplesi
            if($data['jmlFasilitasSuplesi'] > 0){
                $arrFasilitasSuplesi = array();
                foreach($data['arrFasilitasSuplesi'] as $rows){
                    $data_array = array(
                                        'PipelineId' => $insert_id,
                                        'FacilityId' => $rows['PipelineFacilityId'],
                                        'PlafondExisting' => $rows['PlafondExisting'],
                                        'PlafondSuplecy' => $rows['PlafondSuplecy'],
                                        'NoRekening' => $rows['NoRekening'],
                                        'EWS' => $rows['EWS'],
                                        'CreatedBy' => $data['user_id'],
                                        'CreatedDate' => $created_date
                    );
                    array_push($arrFasilitasSuplesi, $data_array);
                }
                $this->db->insert_batch('PipelineDetailSuplecyFacility', $arrFasilitasSuplesi);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Suplecy Facility"
                    );
                }
            }

            // Add Fasilitas Baru
            if($data['total_fasilitas'] > 0){
                $arr_facility = array();
                foreach($data['arr_fasilitas'] as $rows){
                    $data_array = array(
                                        'PipelineId' => $insert_id,
                                        'FacilityId' => $rows['PipelineFacilityId'],
                                        'Plafond' => $rows['PipelineFacilityValue'],
                                        'CreatedBy' => $data['user_id'],
                                        'CreatedDate' => $created_date
                    );
                    array_push($arr_facility, $data_array);
                }
                $this->db->insert_batch('PipelineDetailNewFacility', $arr_facility);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert New Facility"
                    );
                }
            }

            // Add Log Pipeline
            $rs = $this->createLogPipeline($insert_id, 1, 1, $data['user_id'], $created_date);
            if($rs["status"] == "error") {
                $result = $rs;
            }
			
        }
            
        //Commit Transaction
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
            $this->db->trans_commit();
            $result = array(
                "status" => "success"
            );
        }
        return $result;
	}

    function updatePipeline($data){
        $modified_date = date('Y-m-d H:i:s');
        $this->db->trans_begin();

        $row = array(
            'DataSourceId' => $data['sumber_pipeline'],
            'CIFId' => $data['cif'],
            'CustomerMenengahTypeId' => $data['jenis_debitur'], 
            'CustomerName' => $data['nama_debitur'],
            'NPWP' => $data['npwp_perusahaan'],
            'Address' => $data['alamat'],
            'ContactPerson' => $data['contact_person'],
            'PhoneNumber' => $data['no_telp'],
            //'EWSStatus' => $data['ews_status'],
            'BusinessType' => $data['jenis_usaha'],
            'BusinessSector' => $data['sektor_usaha'],
            'EconomySubSector' => $data['sub_sektor_ekonomi'],
            'LPGStatus' => $data['warna_lpg'],
            'LPGDescription' => $data['lpgDescription'],
            'CustomerStatusId' => $data['status_debitur'],
            'Plafond' => $data['plafond'],
            'CustomerResouceId' => $data['tdb'],
            'TDBResourceId' => $data['sumber_tdb'],
            'LayerStatusId' => 1,
            'StatusId' => 1,
            'AdditionalDesc' => $data['additional_desc'],
            'ModifiedBy' => $data['user_id'],
            'ModifiedDate' => $modified_date
        );
        $this->db->where('PipelineId', $data["id"]);
        $this->db->update('Pipeline', $row);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Update Pipeline"
            );
        }else{
            // Delete Detail Facility
            $this->db->delete('PipelineDetailNewFacility', array('PipelineId' => $data["id"]));
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Delete New Facility"
                );
            }
            $this->db->delete('PipelineDetailSuplecyFacility', array('PipelineId' => $data["id"]));
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"],
                    "event" => "Delete Suplecy Facility"
                );
            }

            // Add Fasilitas Suplesi
            if($data['jmlFasilitasSuplesi'] > 0){
                $arrFasilitasSuplesi = array();
                foreach($data['arrFasilitasSuplesi'] as $rows){
                    $data_array = array(
                                        'PipelineId' => $data["id"],
                                        'FacilityId' => $rows['PipelineFacilityId'],
                                        'PlafondExisting' => $rows['PlafondExisting'],
                                        'PlafondSuplecy' => $rows['PlafondSuplecy'],
                                        'NoRekening' => $rows['NoRekening'],
                                        'EWS' => $rows['EWS'],
                                        'CreatedBy' => $data['user_id'],
                                        'CreatedDate' => $modified_date
                    );
                    array_push($arrFasilitasSuplesi, $data_array);
                }
                $this->db->insert_batch('PipelineDetailSuplecyFacility', $arrFasilitasSuplesi);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert Suplecy Facility"
                    );
                }
            }

            // Add Facilitas Baru
            if($data['total_fasilitas'] > 0){
                $arr_facility = array();
                foreach($data['arr_fasilitas'] as $rows){
                    $data_array = array(
                                        'PipelineId' => $data["id"],
                                        'FacilityId' => $rows['PipelineFacilityId'],
                                        'Plafond' => $rows['PipelineFacilityValue'],
                                        'CreatedBy' => $data['user_id'],
                                        'CreatedDate' => $modified_date
                    );
                    array_push($arr_facility, $data_array);
                }
                $this->db->insert_batch('PipelineDetailNewFacility', $arr_facility);
                $errorStatus = $this->db->error();
                if($errorStatus["code"]<>0){
                    $result = array(
                        "status" => "error",
                        "message" => $errorStatus["message"],
                        "event" => "Insert New Facility"
                    );
                }
            }

            // Add Log Pipeline
            $rs = $this->createLogPipeline($data["id"], 1, 1, $data['user_id'], $modified_date, $data['comment']);
            if($rs["status"] == "error") {
                $result = $rs;
            }
        }

        //Commit Transaction
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
            $this->db->trans_commit();
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    function updatePipelineStatus($data){
        $modified_date = date('Y-m-d H:i:s');
        if($data['layer_status_id'] < 5){
            if($data['status_id'] == 2 || $data['status_id'] == 4){
                $rs_next_user = $this->getUserNextLayer($data['division_id'], $data['role_id']);
                if(empty($rs_next_user)){
                    $next_role = $data['role_id']+1;
                    $rs_next_user2 = $this->getUserNextLayer($data['division_id'], $next_role);
                    $next_user = $rs_next_user2;
                    $next_layer = $data['layer_status_id']+2;
                }else{
                    $next_user = $rs_next_user;
                    $next_layer = $data['layer_status_id']+1;
                }
            }else{
                $next_layer = $data['layer_status_id'];
            }
            
            if($data['status_id'] == 2 || $data['status_id'] == 4) $next_status_id = 3;
            else $next_status_id = $data['status_id'];

            if($data['status_id'] == 2) {
                // Update Submitted Date
                $pipeline = array(
                    'LayerStatusId' => $next_layer,
                    'StatusId' => $next_status_id,
                    'SubmittedDate' => $modified_date,
                    'ModifiedBy' => $data['user_id'],
                    'ModifiedDate' => $modified_date
                );
            }
            else {
                $pipeline = array(
                    'LayerStatusId' => $next_layer,
                    'StatusId' => $next_status_id,
                    'ModifiedBy' => $data['user_id'],
                    'ModifiedDate' => $modified_date
                );
            }

            $isCommit = 1;
            $arr_rm = array();
            foreach($data['arr_pipeline_id'] as $row){
                $where = array(
                    'PipelineId' => $row
                );
                $result = $this->db->update('Pipeline', $pipeline, $where);
                if($result != 1){
                    $isCommit = 0;
                }

                $this->createLogPipeline($row, $data['layer_status_id'], $data['status_id'], $data['user_id'], $modified_date, $data['comment']);

                $rm_id = $this->getPipelineMaker($row);
                if(!in_array($rm_id, $arr_rm)){
                    array_push($arr_rm, $rm_id);
                }
            }
        }else{
            $next_status_id = $data['status_id'];

            $isCommit = 1;
            $arr_rm = array();
            foreach($data['arr_pipeline_id'] as $row){
                $pipeline = array(
                    'LayerStatusId' => 5,
                    'StatusId' => $next_status_id,
                    'ModifiedBy' => $data['user_id'],
                    'ModifiedDate' => $modified_date
                );
                $where = array(
                    'PipelineId' => $row
                );
                $result = $this->db->update('Pipeline', $pipeline, $where);
                if($result != 1){
                    $isCommit = 0;
                }

                $this->createLogPipeline($row, $data['layer_status_id'], $data['status_id'], $data['user_id'], $modified_date);

                $rm_id = $this->getPipelineMaker($row);
                if(!in_array($rm_id, $arr_rm)){
                    array_push($arr_rm, $rm_id);
                }
            }
        }

        $arr_user_below_layer = array();
        $current_layer = $data['layer_status_id'];
        switch($current_layer){
            case 3: 
                $rs_user = $this->getUserLayer($data['division_id'], USER_ROLE_GH_MENENGAH);
                if(!empty($rs_user)){
                    foreach($rs_user as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                break;
            case 4:
                foreach($data['arr_pipeline_id'] as $row){
                    $division_id = $this->getDivisionId($row);
                    $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                    if(!empty($rs_wapinwil)){
                        foreach($rs_wapinwil as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                    $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                    if(!empty($rs_gh)){
                        foreach($rs_gh as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                }
                break;
            case 5:
                $rs_user = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_user)){
                    foreach($rs_user as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                foreach($data['arr_pipeline_id'] as $row){
                    $division_id = $this->getDivisionId($row);
                    $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                    if(!empty($rs_wapinwil)){
                        foreach($rs_wapinwil as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                    $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                    if(!empty($rs_gh)){
                        foreach($rs_gh as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                }
                break;                
        }
        
        switch($data['layer_status_id']){
            case 1: 
                foreach($next_user as $user_id){
                    $this->notification_model->addNotif($user_id->UserId, "Pipeline", "Submitted Pipeline", "", "submitted");
                }
                break;
            case 2:
            case 3:
            case 4:
                if($data['status_id'] == 4){
                    // 1st Notif For Next Approval
                    foreach($next_user as $user_id){
                        $this->notification_model->addNotif($user_id->UserId, "Pipeline", "Approved Pipeline", "", "submitted");
                    }
                    
                    // 2nd Notification For Layer Below Except RM
                    foreach($arr_user_below_layer as $user_id){
                        $this->notification_model->addNotif($user_id, "Pipeline", "Approved Pipeline", "", "history");
                    }
                    
                    // 3nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->notification_model->addNotif($rm_id, "Pipeline", "Approved Pipeline", "", "history");
                    }
                } else if($data['status_id'] == 5){
                    // 1st Notif For Layer Below Except RM
                    foreach($arr_user_below_layer as $user_id){
                        $this->notification_model->addNotif($user_id, "Pipeline", "Rejected Pipeline", "", "history");
                    }

                    // 2nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->notification_model->addNotif($rm_id, "Pipeline", "Rejected Pipeline", "", "draft");
                    }
                }
                break;
            case 5:
                if($data['status_id'] == 4){
                    $comment = "Approved Pipeline";
                    // 1nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->notification_model->addNotif($rm_id, "Pipeline", $comment, "", "approved");
                        //echo json_encode($arr_rm); die;
                    }
                }else if($data['status_id'] == 5){
                    $comment = "Rejected Pipeline";
                    // 1nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->notification_model->addNotif($rm_id, "Pipeline", $comment, "", "draft");
                    }
                    //echo json_encode($arr_rm); die;
                }
                // 1nd Notification For Layer Below Except RM
                foreach($arr_user_below_layer as $user_id){
                    $this->notification_model->addNotif($user_id, "Pipeline", $comment, "", "history");
                }
                //echo json_encode($arr_user_below_layer);
                break;                
        }
        return $isCommit;
    }

    function multipleCommentapprovedPipeline($data){
        //echo json_encode($data['arr_pipeline_id']); die;
        $modified_date = date('Y-m-d H:i:s');
        $isCommit = 1;
        $arr_rm = array();
        foreach($data['arr_pipeline_id'] as $rowId){
            $rs_pipeline = $this->getStatusPipeline($rowId);
            $this->createLogPipeline($rowId, $rs_pipeline->LayerStatusId, $rs_pipeline->StatusId, $data['user_id'], $modified_date, $data['comment']);
            
            $rm_id = $this->getPipelineMaker($rowId);
            if(!in_array($rm_id, $arr_rm)){
                array_push($arr_rm, $rm_id);
            }

            $arr_user_below_layer = array();
            $role_id = $data['role_id'];
            switch($role_id){
                case USER_ROLE_WP: 
                    $rs_user = $this->getUserLayer($data['division_id'], USER_ROLE_GH_MENENGAH);
                    if(!empty($rs_user)){
                        foreach($rs_user as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }                    
                    };
                    break;
                case USER_ROLE_ERO:
                        $division_id = $this->getDivisionId($rowId);
                        $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                        if(!empty($rs_wapinwil)){
                            foreach($rs_wapinwil as $row){
                                if(!in_array($row->UserId, $arr_user_below_layer)){
                                    array_push($arr_user_below_layer, $row->UserId);
                                }
                            }
                        };
                        $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                        if(!empty($rs_gh)){
                            foreach($rs_gh as $row){
                                if(!in_array($row->UserId, $arr_user_below_layer)){
                                    array_push($arr_user_below_layer, $row->UserId);
                                }
                            }
                        };
                    break;
                case USER_ROLE_KADIV:
                    $rs_user = $this->getUserLayer(null, USER_ROLE_ERO);
                    if(!empty($rs_user)){
                        foreach($rs_user as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }                    
                    };
                    $division_id = $this->getDivisionId($rowId);
                    $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                    if(!empty($rs_wapinwil)){
                        foreach($rs_wapinwil as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                    $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                    if(!empty($rs_gh)){
                        foreach($rs_gh as $row){
                            if(!in_array($row->UserId, $arr_user_below_layer)){
                                array_push($arr_user_below_layer, $row->UserId);
                            }
                        }
                    };
                    break;                
            }
            $comment = "Comment Pipeline";
            //echo json_encode($arr_user_below_layer); die;
            foreach($arr_user_below_layer as $id){
                $this->notification_model->addNotif($id, "Pipeline", $comment, "", "approved_detail/".$rowId);
            }
            foreach($arr_rm as $rm){
                $this->notification_model->addNotif($rm, "Pipeline", $comment, "", "approved_detail/".$rowId);
            }
        }
        //echo json_encode($arr_user_below_layer); die;
        return 1;
    }

    function singleCommentapprovedPipeline($data){
        $modified_date = date('Y-m-d H:i:s');
        $arr_user = array();
        $role_id = $data['role_id'];
        $arr_user_below_layer = array();
        $this->createLogPipeline($data['pipeline_id'], $data['layer_status_id'], $data['status_id'], $data['user_id'], $modified_date, $data['comment']);
        switch($role_id){
            case USER_ROLE_RM_MENENGAH:
                $rs_gh = $this->getUserLayer($data['division_id'], USER_ROLE_GH_MENENGAH);
                if(!empty($rs_gh)){
                    foreach($rs_gh as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_wapinwil = $this->getUserLayer($data['division_id'], USER_ROLE_WP);
                if(!empty($rs_wapinwil)){
                    foreach($rs_wapinwil as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_ero = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_ero)){
                    foreach($rs_ero as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                $rs_kadiv = $this->getUserLayer(null, USER_ROLE_KADIV);
                if(!empty($rs_kadiv)){
                    foreach($rs_kadiv as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                break;
            case USER_ROLE_GH_MENENGAH:
                $rm_id = $data['created_by'];
                if(!in_array($rm_id, $arr_user)){
                    array_push($arr_user, $rm_id);
                }
                $rs_wapinwil = $this->getUserLayer($data['division_id'], USER_ROLE_WP);
                if(!empty($rs_wapinwil)){
                    foreach($rs_wapinwil as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_ero = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_ero)){
                    foreach($rs_ero as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                $rs_kadiv = $this->getUserLayer(null, USER_ROLE_KADIV);
                if(!empty($rs_kadiv)){
                    foreach($rs_kadiv as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                break;
            case USER_ROLE_WP: 
                $rm_id = $data['created_by'];
                if(!in_array($rm_id, $arr_user)){
                    array_push($arr_user, $rm_id);
                }                
                $rs_gh = $this->getUserLayer($data['division_id'], USER_ROLE_GH_MENENGAH);
                if(!empty($rs_gh)){
                    foreach($rs_gh as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_ero = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_ero)){
                    foreach($rs_ero as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                $rs_kadiv = $this->getUserLayer(null, USER_ROLE_KADIV);
                if(!empty($rs_kadiv)){
                    foreach($rs_kadiv as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                break;
            case USER_ROLE_ERO:
                $rm_id = $data['created_by'];
                if(!in_array($rm_id, $arr_user)){
                    array_push($arr_user, $rm_id);
                }
                $division_id = $this->getDivisionId($data['pipeline_id']);
                $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                if(!empty($rs_gh)){
                    foreach($rs_gh as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };      
                $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                if(!empty($rs_wapinwil)){
                    foreach($rs_wapinwil as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_kadiv = $this->getUserLayer(null, USER_ROLE_KADIV);
                if(!empty($rs_kadiv)){
                    foreach($rs_kadiv as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                break;
            case USER_ROLE_KADIV:
                $rm_id = $data['created_by'];
                if(!in_array($rm_id, $arr_user)){
                    array_push($arr_user, $rm_id);
                }
                $division_id = $this->getDivisionId($data['pipeline_id']);
                $rs_gh = $this->getUserLayer($division_id, USER_ROLE_GH_MENENGAH);
                if(!empty($rs_gh)){
                    foreach($rs_gh as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };      
                $rs_wapinwil = $this->getUserLayer($division_id, USER_ROLE_WP);
                if(!empty($rs_wapinwil)){
                    foreach($rs_wapinwil as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }
                };
                $rs_ero = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_ero)){
                    foreach($rs_ero as $row){
                        if(!in_array($row->UserId, $arr_user_below_layer)){
                            array_push($arr_user_below_layer, $row->UserId);
                        }
                    }                    
                };
                break;                
        }

        $comment = "Comment Pipeline";
        foreach($arr_user as $user_id){
            $this->notification_model->addNotif($user_id, "Pipeline", $comment, "", "approved_detail/".$data['pipeline_id']);
        }
        foreach($arr_user_below_layer as $id){
            $this->notification_model->addNotif($id, "Pipeline", $comment, "", "approved_detail/".$data['pipeline_id']);
        }
        return 1;
    }

    function changeStatusApprovedPipeline($data){
        $modified_date = date('Y-m-d H:i:s');
        $isCommit = 1;
        $arr_rm = array();
        if($data['status_id'] == 4){
            $pipeline = array(
                'BulanRealisasi' => $data['bulanRealisasi'],
                'JangkaWaktu' => $data["jangka_waktu"],
                'TotalPlafondPermohonan' => $data['total_plafond_permohonan'],
                'ModifiedBy' => $data['user_id'],
                'ModifiedDate' => $modified_date
            );
        }else if($data['status_id'] == 6){
            $pipeline = array(
                'JangkaWaktu' => $data["jangka_waktu"],
                'TotalPlafondPermohonan' => $data['total_plafond_permohonan'],
                'LayerStatusId' => $data['layer_status_id'],
                'StatusId' => $data['status_id'],
                'BulanRealisasi' => $data['bulanRealisasi'],
                'ModifiedBy' => $data['user_id'],
                'ModifiedDate' => $modified_date
            );
        }else{
            $pipeline = array(
                'LayerStatusId' => $data['layer_status_id'],
                'StatusId' => $data['status_id'],
                'ModifiedBy' => $data['user_id'],
                'ModifiedDate' => $modified_date
            );
        }
        
        $where = array(
            'PipelineId' => $data['pipeline_id']
        );
        $result = $this->db->update('Pipeline', $pipeline, $where);
        if($result != 1){
            $isCommit = 0;
        }else{
            $this->createLogPipeline($data['pipeline_id'], $data['layer_status_id'], $data['status_id'], $data['user_id'], $modified_date, $data['comment']);
            
            if($data['status_id'] == 7 || $data['status_id'] == 8){
                $arr_user_higher_layer = array();
                $rs_gh = $this->getUserLayer($data['division_id'], USER_ROLE_GH_MENENGAH);
                if(!empty($rs_gh)){
                    if(!in_array($rs_gh[0]->UserId, $arr_user_higher_layer)){
                        array_push($arr_user_higher_layer, $rs_gh[0]->UserId);
                    }
                };
                $rs_wapinwil = $this->getUserLayer($data['division_id'], USER_ROLE_WP);
                if(!empty($rs_wapinwil)){
                    if(!in_array($rs_wapinwil[0]->UserId, $arr_user_higher_layer)){
                        array_push($arr_user_higher_layer, $rs_wapinwil[0]->UserId);
                    }
                };
                $rs_ero = $this->getUserLayer(null, USER_ROLE_ERO);
                if(!empty($rs_ero)){
                    if(!in_array($rs_ero[0]->UserId, $arr_user_higher_layer)){
                        array_push($arr_user_higher_layer, $rs_ero[0]->UserId);
                    }
                };
                $rs_kadiv = $this->getUserLayer(null, USER_ROLE_KADIV);
                if(!empty($rs_kadiv)){
                    if(!in_array($rs_kadiv[0]->UserId, $arr_user_higher_layer)){
                        array_push($arr_user_higher_layer, $rs_kadiv[0]->UserId);
                    }
                };
                $comment = "Cancel Pipeline";
                foreach($arr_user_higher_layer as $user_id){
                    $this->notification_model->addNotif($user_id, "Pipeline", $comment, "", "approved_detail/".$data['pipeline_id']);
                }
            }else{
                //Insert Fasilitas Permohonan
                $this->db->delete("PipelineDetailPermohonanFacility", array("PipelineId" => $data["pipeline_id"]));
                $arrFasilitasPermohonan = array();
                foreach($data["arrFasilitasPermohonan"] as $row){
                    $fasilitasPermohonan = array(
                        "PipelineId" => $data["pipeline_id"],
                        "FacilityId" => $row["FacilityId"],
                        "Plafond" => $row["Plafond"],
                        "CreatedBy" => $this->session->PERSONAL_NUMBER,
                        "CreatedDate" => date("Y-m-d H:i:s")
                    );
                    array_push($arrFasilitasPermohonan, $fasilitasPermohonan);
                }
                $this->db->insert_batch("PipelineDetailPermohonanFacility", $arrFasilitasPermohonan);
                
                if($data['status_id'] == 6){
                    //Prose pipeline & insert into table Proses Kredit
                    $dataProsesKredit = array(
                        'PipelineId' => $data['pipeline_id'],
                        'StatusApplicationId' => $data['role_id'],
                        'UserId' => $data['user_id']                    
                    );
                    $this->ProsesKredit_model->addProsesKredit($dataProsesKredit);
                }
            }
        }
        return $isCommit;
    }

    function createLogPipeline($pipeline_id, $pipeline_layer_status_id,
        $pipeline_status_id, $created_by, $created_date, $comment = NULL){

        $data = array(
            'PipelineId' => $pipeline_id,
            'PipelineLayerStatusId' => $pipeline_layer_status_id,
            'PipelineStatusId' => $pipeline_status_id,
            'Comment' => $comment,
            'CreatedBy' => $created_by,
            'CreatedDate' => $created_date
        );
        
        $this->db->insert('PipelineLogActivity', $data);
        $errorStatus = $this->db->error();
        if($errorStatus["code"]<>0){
            $result = array(
                "status" => "error",
                "message" => $errorStatus["message"],
                "event" => "Insert Log Pipeline"
            );
        }else{
            $result = array(
                "status" => "success"
            );
        }
        return $result;
    }

    /*
        =-=-=-=- Start of Service =-=-=-=
    */
    function getPipelineDataSourceOption(){
        $data = $this->db
                    ->select("PipelineDataSourceId, DataSourceName")
                    ->from('PipelineDataSource')
                    ->where('IsActive',1)
                    ->get()->result();
        return $data;
    }

    public function getCustomerOption($CIF = null, $userId){
        $currentYear = date('Y');
        $whereClause = "";
        if($CIF != NULL){
            $whereClause .= " OR t2.CIFId = ".$CIF;
        }
        $sql = "SELECT distinct(t1.CustomerMenengahId), t1.CIF, t1.CustomerName, t2.StatusId
                FROM CustomerMenengah t1 LEFT JOIN Pipeline t2
                ON t1.CustomerMenengahId = t2.CIFId
                WHERE (YEAR(t2.SubmittedDate) = ".$currentYear." OR t2.SubmittedDate IS NULL)
                AND (t2.StatusId IS NULL OR (t2.StatusId NOT IN(1,2,3,5) AND t2.StatusId != 4 AND t2.StatusId != 6)) 
                AND t1.CIF IN (SELECT CIF FROM DisposisiCustomerMenengah WHERE UserId = '".$userId."' AND IsActive = 1) 
                AND t1.UnitKerjaId = '".$this->session->DIVISION."'
                ".$whereClause."
                ORDER BY CIF";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function getEWSOption(){
        $data = $this->db
                    ->select("*")
                    ->from('Ews')
                    ->get()->result();
        return $data;
    }

    function getCustomerTypeOption(){
        $data = $this->db
                    ->distinct()
                    ->select("CustomerMenengahTypeId, CustomerMenengahTypeName")
                    ->from('CustomerMenengahType')
                    ->get()->result();
        return $data;
    }

    function getSektorUsahaOption(){
        $data = $this->db
                    ->distinct()
                    ->select("SegmentationId, SegmentationName")
                    ->from('SubSectorEconomy')
                    ->get()->result();
        return $data;
    }

    function getSubSektorEkonomiOption($segmentasi_id){
        $this->db->select('t1.SubSectorEconomyId, t1.SubSectorEconomyName');
        $this->db->from('SubSectorEconomy t1');
        $this->db->join("LPGDetail t2","t1.SubSectorEconomyId = t2.KodeSektorEkonomiBI");
        $this->db->where_in('t1.SegmentationId', $segmentasi_id);
        $this->db->order_by('t1.SubSectorEconomyName');
        $data = $this->db->get()->result();
        return $data;
    }

    function getLpgInformation($subSectorEconomyId){
        $this->db->select("Warna");
        $this->db->from("LpgDetail");
        $this->db->where("KodeSektorEkonomiBI", $subSectorEconomyId);
        $result = $this->db->get()->result();
        return $result;
    }

    function getFacilityOption(){
        $data = $this->db
                    ->select('*')
                    ->from('Facility')
                    ->get()->result();
        return $data;
    }

    function getDetailCustomerInformation($id){
        $this->db->select('t1.*, t2.EwsId, t3.EwsColorCode');
        $this->db->from('CustomerMenengah t1');
        $this->db->join('EwsDetail t2', 't1.CIF = t2.CIF', 'left');
        $this->db->join('Ews t3', 't2.EwsId = t3.EwsId ', 'left');
        $this->db->where('t1.CustomerMenengahId', $id);
        $result = $this->db->get()->result();
        $facilityDetail = $this->getDetailFacility($result[0]->CIF);
        $result[0]->FacilityDetail = $facilityDetail;
        return $result;
    }

    function getDetailFacility($CIF){
        /*
        $lastPosition = strtotime("first day of previous month");
        $month = date("m", $lastPosition);
        $year  = date("Y", $lastPosition);

        $sql = "SELECT
                    t1.Cif AS t1.CIF, t1.NoRekening, t1.JenisPenggunaan AS t1.FacilityId, t1.PlafonEfektif AS t1.Plafond,
                    t2.FacilityName, t3.WARNA AS warna
                FROM
                    Summary_PinjamanMenengah t1
                LEFT JOIN Facility t2 ON t1.JenisPenggunaan = t2.FacilityId
                LEFT JOIN F_PINJAMAN_EWS t3 ON t1.NoRekening = t3.REKENING
                WHERE t1.Cif = ".$CIF." AND MONTH(Periode) = ".$month." AND YEAR(Periode) = ".$year;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        */
        
        //$this->db->select('t1.*, t2.FacilityName, t3.warna');
		$this->db->select('t1.*, t2.FacilityName, t3.WARNA AS warna');
        $this->db->from('FacilityDetail t1');
        $this->db->join('Facility t2', 't1.FacilityId = t2.FacilityId', 'left');
        //$this->db->join('EwsDetailTransactions t3', 't1.NoRekening = t3.rekening', 'left');
		$this->db->join('F_PINJAMAN_EWS t3', 't1.NoRekening = t3.REKENING', 'left');
        $this->db->where('t1.CIF', $CIF);
        $this->db->order_by('FacilityName');
        $result = $this->db->get()->result();
        return $result;
        
    }
    

    function getSumberTDBOption(){
        $data = $this->db
                    ->select("TdbSourceId, Name")
                    ->from('TdbSource')
                    ->order_by('Name','ASC')
                    ->get()->result();
        return $data;
    }

    function getUserNextLayer($division_id, $role_id){
        $next_role = $role_id+1;
        if($next_role == USER_ROLE_ERO || $next_role == USER_ROLE_KADIV){
            $where = array(
                'RoleId' => $next_role
            );
        }else{
            $where = array(
                'UnitKerjaId' => $division_id,
                'RoleId' => $next_role
            );
        }
        $this->db->select('UserId, RoleId');
        $this->db->from('User');
        $this->db->where($where);
        $result = $this->db->get()->result();
        return $result;
    }

    function getUserLayer($division_id = null, $role_id){
        if ($division_id == null || $division_id == 0){
            $where = array(
                'RoleId' => $role_id,
                'IsActive' => 1
            );
        }else{
            $where = array(
                'UnitKerjaId' => $division_id,
                'RoleId' => $role_id,
                'IsActive' => 1
            );
        }
        $this->db->select('UserId, RoleId, Name');
        $this->db->from('User');
        $this->db->where($where);
        $this->db->order_by('Name','asc');
        $result = $this->db->get()->result();
        return $result;
    }

    function getUserByRole($role_id, $division_id = null, $user_id = null){
        if ($division_id == null || $division_id == 0){
            if ($user_id == null || $user_id == 0){
                $where = array(
                    'RoleId' => $role_id
                );
            }else{
                $where = array(
                    'RoleId' => $role_id,
                    'UserId' => $user_id
                );
            }            
        }else{
            if ($user_id == null || $user_id == 0){
                $where = array(
                    'UnitKerjaId' => $division_id,
                    'RoleId' => $role_id
                );
            }else{
                $where = array(
                    'UnitKerjaId' => $division_id,
                    'RoleId' => $role_id,
                    'UserId' => $user_id
                );
            }            
        }
        $this->db->select('UserId, Name');
        $this->db->from('User');
        $this->db->where($where);
        $this->db->order_by('Name');
        $result = $this->db->get()->result();
        return $result;
    }

    function getStatusPipeline($pipeline_id){
        $this->db->select('LayerStatusId, StatusId');
        $this->db->from('Pipeline');
        $this->db->where('PipelineId',$pipeline_id);
        $result = $this->db->get()->result();
        return $result[0];
    }

    function getPipelineMaker($pipeline_id){
        $this->db->select('CreatedBy');
        $this->db->from('Pipeline');
        $this->db->where('PipelineId',$pipeline_id);
        $result = $this->db->get()->result();
        return $result[0]->CreatedBy;
    }

    function getDetailFacilityValue($pipeline_id){
        $data = $this->db
                ->select("*")
                ->from("PipelineDetailNewFacility")
                ->where("PipelineId", $pipeline_id)
                ->get()->result_array();
        return $data;
    }

    function getDetailFacilitySuplecy($pipeline_id){
        $this->db->select("t1.*, t2.FacilityName");
        $this->db->from("PipelineDetailSuplecyFacility t1");
        $this->db->join("Facility t2", "t1.FacilityId = t2.FacilityId", "left");
        $this->db->where("t1.PipelineId", $pipeline_id);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function getLogPipeline($pipeline_id, $status_id = null){
        if($status_id == null){
            $where = array(
                't1.PipelineId' => $pipeline_id
            );
        }else{
            $where = array(
                't1.PipelineId' => $pipeline_id,
                't1.PipelineStatusId' => $status_id
            );
        }

        $this->db->select("t1.*, t2.name as CreatedByName, t4.Name AS ROLE_NAME, t5.PipelineStatusName as StatusName");
        $this->db->from('PipelineLogActivity t1');
        $this->db->join('User t2', 't1.CreatedBy = t2.UserId ', 'left');
        $this->db->join('PipelineApprovalLayer t3', 't1.PipelineLayerStatusId = t3.PipelineApprovalLayerId ', 'left');
        $this->db->join('Role t4', 't2.RoleId = t4.RoleId ', 'left');
        $this->db->join('PipelineStatus t5', 't1.PipelineStatusId = t5.PipelineStatusId ', 'left');
        $this->db->where($where);
        $this->db->order_by('t1.CreatedDate','DESC');
        $result = $this->db->get()->result();
        return $result;
    }

    function getDivisionId($pipeline_id){
        $this->db->select("t2.UnitKerjaId");
        $this->db->from('Pipeline t1');
        $this->db->join('User t2', 't1.CreatedBy = t2.UserId ', 'left');
        $this->db->where('PipelineId', $pipeline_id);
        $result = $this->db->get()->result();
        return $result[0]->UnitKerjaId;
    }

    function getUnitKerjaMenengah($division_id = NULL){
        $this->db->select('UnitKerjaId, Name');
        $this->db->from('UnitKerja');
        $this->db->where('IsActive', 1);
        $this->db->where('SegmentId', 2);
        if($division_id != NULL){
            $this->db->where('UnitKerjaId', $division_id);
        }
        $this->db->order_by('Name', 'ASC');
        $result = $this->db->get()->result();
        return $result;
    }

    function checkIsPassedLayerApproval($pipeline_id, $layer_id){
        $this->db->select('PipelineLogActivityId');
        $this->db->from('PipelineLogActivity');
        $this->db->where('PipelineLayerStatusId', $layer_id);
        $this->db->where('PipelineId', $pipeline_id);
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if(empty($result)){
            return 0;
        }else return 1;
    }

    function getRMOption($division_id = 0, $role_id){
        if ($division_id == 0){
            $where = array(
                "role_id" => $role_id
            );
        }else{
            $where = array(
                "division_id" => $division_id,
                "role_id" => $role_id
            );
        }
        $this->db->select("id, role_id, name");
        $this->db->from("USERS");
        $this->db->where($where);
        $this->db->order_by("name","asc");
        $result = $this->db->get()->result();
        return $result;
    }

    function checkActivePipeline($CIF){
        $sql = "SELECT StatusId FROM Pipeline WHERE CIFId = '".$CIF."' AND StatusId NOT IN (4,6)";
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return 1;
        }else return 0;
    }

    function checkStatusPipeline($NPWP){
        $currentYear = date("Y");
        $sql = "SELECT PipelineId FROM Pipeline
                WHERE NPWP = '".$NPWP."'
                AND YEAR(SubmittedDate) = ".$currentYear."
                AND StatusId IN (2,3)";
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return 1;
        }else 
            return 0;
    }

    function checkCustomerStatus($npwp){
        $year = date('Y');
        //$sql = "SELECT PipelineId FROM Pipeline WHERE NPWP = '".$npwp."' AND YEAR(SubmittedDate) = '".$year."' AND StatusId NOT IN (4,5,6)";
        $sql = "SELECT PipelineId FROM Pipeline WHERE (NPWP != '' AND NPWP = '".$npwp."') AND YEAR(SubmittedDate) = '".$year."' AND StatusId NOT IN (4,5,6)";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return "false";
        }else return "true";
    }

    function checkCustomerByCIF($cif){
        $year = date('Y');
        $sql = "SELECT PipelineId FROM Pipeline WHERE CIFId = ".$cif." AND StatusId NOT IN (4,5,6) ";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return "false";
        }else return "true";
    }

    function getFasilitasPermohonan($pipelineId){
        $this->db->select("*");
        $this->db->from("PipelineDetailPermohonanFacility");
        $this->db->where("PipelineId", $pipelineId);
        $result = $this->db->get()->result();
        return $result;
    }
}

?>