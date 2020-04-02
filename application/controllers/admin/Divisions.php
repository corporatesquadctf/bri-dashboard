<?php

class Divisions extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $this->load->library('form_validation');
    }

    public function index() {
        //$this->load->database();

        $this->checkModule();

        $sql = "SELECT A.*, B.Name [Type], C.Name Segment, D.Name MAKER, E.Name MODIFIER
            FROM UnitKerja A
            LEFT JOIN UnitKerjaType B ON A.UnitKerjaTypeId=B.UnitKerjaTypeId
            LEFT JOIN Segment C ON A.SegmentId=C.SegmentId
            LEFT JOIN [User] D ON A.CreatedBy=D.UserId
            LEFT JOIN [User] E ON A.ModifiedBy=E.UserId";

        $queryData = $this->db->query($sql);
        $data['data'] = $queryData->result();

        $querySegment = $this->db->get("Segment");
        $data["data_segment"] = $querySegment->result();

        $qDivisionType = $this->db->get("UnitKerjaType");
        $data["DivisionType"] = $qDivisionType->result();

        $rsIsActiveOption = array(["IsActiveId" => "1", "IsActiveName" => "Active"], 
						          ["IsActiveId" => "0", "IsActiveName" => "Non Active"]);
        $data["IsActiveOption"] = $rsIsActiveOption;

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog('INFO', $persn, "Get Division", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/division_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertNew() {
        $this->load->database();

        $unitKerjaId = $this->input->post('unitKerjaId');
        $name = $this->input->post('name');
        $userId = $this->session->PERSONAL_NUMBER;
        $segmentId = $this->input->post('segmentId');
        $isActive = $this->input->post('isActive');
        $unitKerjaTypeId = $this->input->post('unitKerjaTypeId');
        $today = date('Y-m-d H:i:s');

        if ($name) {
            $newData = [
                'UnitKerjaId' => $unitKerjaId,
                'Name' => $name,
                'SegmentId' => $segmentId,
                'UnitKerjaTypeId' => $unitKerjaTypeId,
                'IsActive' => $isActive,
                'CreatedDate' => $today,
                'CreatedBy' => $userId
            ];

            $this->db->insert('UnitKerja', $newData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog('INFO', $persn, "Insert Division", "", "", json_encode($newData), "");

                $result = array(
                    "status" => "success",
                    "message" => "Division has been successfully added."
                );
            }
            echo json_encode($result);
        }
    }

    public function updateData() {
        //$this->load->database();

        $unitKerjaId = $this->input->post('unitKerjaId');
        $name = $this->input->post('name');
        $userId = $this->session->PERSONAL_NUMBER;
        $segmentId = $this->input->post('segmentId');
        $unitKerjaTypeId = $this->input->post('unitKerjaTypeId');
        $isActive = $this->input->post('isActive');
        $today = date('Y-m-d H:i:s');

        if ($unitKerjaId) {
            $editedData = [
                'Name' => $name,
                'SegmentId' => $segmentId,
                'UnitKerjaTypeId' => $unitKerjaTypeId,
                'IsActive' => $isActive,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];
            $getData = $this->db->where('UnitKerjaId', $unitKerjaId)->get('UnitKerja')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog('INFO', $persn, "Update Division", "", json_encode($getData), json_encode($editedData), "");

            $this->db->where('UnitKerjaId', $unitKerjaId)->update('UnitKerja', $editedData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $result = array(
                    "status" => "success",
                    "message" => "Division has been successfully updated"
                );
            }
        }else{
            $result = array(
                "status" => "error",
                "message" => "Division is not found"
            );
        }
        echo json_encode($result);
    }

    public function deleteData() {
        $this->load->database();

        $divId = $this->input->post('divisionId');
        $userId = $this->input->post('userId');
        $today = date('Y-m-d H:i:s');

        if ($divId) {
            /*$newData = [
                'IsActive' => 0,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];
            */

            $getData = $this->db->where('UnitKerjaId', $divId)->get('UnitKerja')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog('INFO', $persn, "Delete Division", "", json_encode($getData), "", "");

            $updateData = $this->db->where('UnitKerjaId', $divId)->delete('UnitKerja');

            print_r($updateData);
        }
    }

    function insertLog($level, $userId, $action, $msg, $old, $new, $exception) {
        $newData = [
            'Level' => $level,
            'LogDate' => date('Y-m-d H:i:s'),
            'CreatedBy' => $userId,
            'Action' => $action,
            'Message' => $msg,
            'OldValue' => $old,
            'NewValue' => $new,
            'Exception' => $exception
        ];
        $updateData = $this->db->insert('LOG', $newData);
    }

    function serviceCheckDivisionId(){
        if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
        $this->load->database();
        $divisionName = $this->input->post("divisionName");
        $divisionId = $this->input->post("divisionId");
        $sql = "SELECT UnitKerjaId FROM UnitKerja WHERE UnitKerjaId = ".$divisionId;
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            echo "false";
        }else
            echo "true";
    }

    function serviceCheckDivisionName(){
        if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
        $this->load->database();
        $divisionId = $this->input->post("divisionId");
        $divisionName = strtoupper(trim($this->input->post("divisionName")));
        $sql = "SELECT UnitKerjaId FROM UnitKerja WHERE UPPER(LTRIM(RTRIM((Name)))) = '".$divisionName."'";
        if($divisionId != null){
            $sql .= " AND UnitKerjaId != ".$divisionId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            echo "false";
        }else
            echo "true";
    }

}

?>