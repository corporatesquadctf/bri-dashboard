<?php
class Pipeline_model extends MY_Model {

	function __construct() {
        parent::__construct();
        $this->load->model('ProsesKredit_model');
        $this->load->database();
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
                // return var_dump($sql);
        if($data['rowno'] || $data['rowno']){
            $sql .= "OFFSET ".$data['rowno']." ROWS FETCH NEXT ".$data['rowno']." ROWS ONLY";
        }
            
        $query = $this->db->query($sql);		
        $result = $query->result();
        return $result;        
    }
 
    function getTotalPipeline($data){
        
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

        $sql = "SELECT COUNT(1) Total
                FROM Pipeline t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIFId = t2.CustomerMenengahId
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN PipelineApprovalLayer t4 ON t1.LayerStatusId = t4.PipelineApprovalLayerId
                LEFT JOIN PipelineStatus t5 ON t1.StatusId = t5.PipelineStatusId
                LEFT JOIN Role t6 ON t4.RoleId = t6.RoleId
                LEFT JOIN PipelineDataSource t7 ON t1.DataSourceId = t7.PipelineDataSourceId ".$whereClause."";
                // return var_dump($sql);
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
                $whereClause .= $conn." YEAR(t1.SubmittedDate) = ".$data["YEAR"][0][0];
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
                ORDER BY ModifiedDate DESC OFFSET ".$data['rowno']." ROWS FETCH NEXT ".$data['limit_per_page']." ROWS ONLY";
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
    
    function getTotalHistoryPipeline($data){
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
                $whereClause .= $conn." YEAR(t1.SubmittedDate) = ".$data["YEAR"][0][0];
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

        $sql = "SELECT COUNT(1) Total
                FROM Pipeline t1
                LEFT JOIN CustomerMenengah t2 ON t1.CIFId = t2.CustomerMenengahId
                LEFT JOIN [User] t3 ON t1.CreatedBy = t3.UserId
                LEFT JOIN PipelineApprovalLayer t4 ON t1.LayerStatusId = t4.PipelineApprovalLayerId
                LEFT JOIN PipelineStatus t5 ON t1.StatusId = t5.PipelineStatusId
                LEFT JOIN Role t6 ON t4.RoleId = t6.RoleId
                LEFT JOIN PipelineDataSource t7 ON t1.DataSourceId = t7.PipelineDataSourceId ".$whereClause." 
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        
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
                    $this->addNotif($data['user_id'], $user_id->UserId, "Pipeline", "Submitted Pipeline", "", "submitted");
                }
                break;
            case 2:
            case 3:
            case 4:
                if($data['status_id'] == 4){
                    // 1st Notif For Next Approval
                    foreach($next_user as $user_id){
                        $this->addNotif($data['user_id'], $user_id->UserId, "Pipeline", "Approved Pipeline", "", "submitted");
                    }
                    
                    // 2nd Notification For Layer Below Except RM
                    foreach($arr_user_below_layer as $user_id){
                        $this->addNotif($data['user_id'], $user_id, "Pipeline", "Approved Pipeline", "", "history");
                    }
                    
                    // 3nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->addNotif($data['user_id'], $rm_id, "Pipeline", "Approved Pipeline", "", "history");
                    }
                } else if($data['status_id'] == 5){
                    // 1st Notif For Layer Below Except RM
                    foreach($arr_user_below_layer as $user_id){
                        $this->addNotif($data['user_id'], $user_id, "Pipeline", "Rejected Pipeline", "", "history");
                    }

                    // 2nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->addNotif($data['user_id'], $rm_id, "Pipeline", "Rejected Pipeline", "", "draft");
                    }
                }
                break;
            case 5:
                if($data['status_id'] == 4){
                    $comment = "Approved Pipeline";
                    // 1nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->addNotif($data['user_id'], $rm_id, "Pipeline", $comment, "", "approved");
                        //echo json_encode($arr_rm); die;
                    }
                }else if($data['status_id'] == 5){
                    $comment = "Rejected Pipeline";
                    // 1nd Notification Pipeline Maker (RM)
                    foreach($arr_rm as $rm_id){
                        $this->addNotif($data['user_id'], $rm_id, "Pipeline", $comment, "", "draft");
                    }
                    //echo json_encode($arr_rm); die;
                }
                // 1nd Notification For Layer Below Except RM
                foreach($arr_user_below_layer as $user_id){
                    $this->addNotif($data['user_id'], $user_id, "Pipeline", $comment, "", "history");
                }
                //echo json_encode($arr_user_below_layer);
                break;                
        }
        return $isCommit;
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

    function getPipelineMaker($pipeline_id){
        $this->db->select('CreatedBy');
        $this->db->from('Pipeline');
        $this->db->where('PipelineId',$pipeline_id);
        $result = $this->db->get()->result();
        return $result[0]->CreatedBy;
    }

    function getDivisionId($pipeline_id){
        $this->db->select("t2.UnitKerjaId");
        $this->db->from('Pipeline t1');
        $this->db->join('User t2', 't1.CreatedBy = t2.UserId ', 'left');
        $this->db->where('PipelineId', $pipeline_id);
        $result = $this->db->get()->result();
        return $result[0]->UnitKerjaId;
    }

    function checkActivePipeline($CIF){
        $sql = "SELECT StatusId FROM Pipeline WHERE CIFId = '".$CIF."' AND StatusId NOT IN (4,6)";
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            return 1;
        }else return 0;
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

    function getSumberTDBOption(){
        $data = $this->db
                    ->select("TdbSourceId, Name")
                    ->from('TdbSource')
                    ->order_by('Name','ASC')
                    ->get()->result();
        return $data;
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

    function getSubSektorEkonomiOption($segmentasi_id){
        $this->db->select('t1.SubSectorEconomyId, t1.SubSectorEconomyName');
        $this->db->from('SubSectorEconomy t1');
        $this->db->join("LPGDetail t2","t1.SubSectorEconomyId = t2.KodeSektorEkonomiBI");
        $this->db->where_in('t1.SegmentationId', $segmentasi_id);
        $this->db->order_by('t1.SubSectorEconomyName');
        $data = $this->db->get()->result();
        return $data;
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

    function getPipelineDataSourceOption(){
        $data = $this->db
                    ->select("PipelineDataSourceId, DataSourceName")
                    ->from('PipelineDataSource')
                    ->where('IsActive',1)
                    ->get()->result();
        return $data;
    }

    function getEWSOption(){
        $data = $this->db
                    ->select("*")
                    ->from('Ews')
                    ->get()->result();
        return $data;
    }
    
    function getFacilityOption(){
        $data = $this->db
                    ->select('*')
                    ->from('Facility')
                    ->get()->result();
        return $data;
    }

    function changeStatusApprovedPipeline($data){
        $modified_date = date('Y-m-d H:i:s');
        $isCommit = 1;
        $arr_rm = array();
        if($data['status_id'] == 4){
            $pipeline = array(
                'BulanRealisasi' => $data['bulanRealisasi'],
                'JangkaWaktu' => $data["jangka_waktu"],
                'ModifiedBy' => $data['user_id'],
                'ModifiedDate' => $modified_date
            );
        }else if($data['status_id'] == 6){
            $pipeline = array(
                'JangkaWaktu' => $data["jangka_waktu"],
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
                    $this->addNotif($data['user_id'], $user_id, "Pipeline", $comment, "", "approved_detail/".$data['pipeline_id']);
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
                        "CreatedBy" => $data['user_id'],
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

    public function addNotif($UserFrom, $UserTo, $Subject, $Title, $Message, $URL) {
        $newData = [
          'CreatedDate' => date('Y-m-d H:i:s'),
          'UserFrom' => $UserFrom,
          'UserTo' => $UserTo,
          'Subject' => $Subject,
          'Title' => $Title,
          'Message' => $Message,
          'URL' => $URL
        ];
        // echo json_encode($newData);
        $updateData = $this->db->insert('Notification', $newData);
      }
}