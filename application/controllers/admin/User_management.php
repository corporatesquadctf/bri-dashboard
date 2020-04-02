<?php

/**
 * 
 */
class User_management extends MY_Controller {

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
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
    }

    function index() {
        $this->load->database();

        $this->checkModule();

        $this->db->select('a.*, b.ROLE_NAME ROLENAME, c.DIVISION_NAME DIVISINAME')
                ->from('USERS a')
                ->join('ROLE b', 'b.ID = a.role_id', 'left')
                ->join('MASTER_DIVISIONS c', 'c.ID = a.division_id', 'left')
                ->where('a.status', '1');
        $queryData = $this->db->get();
        $this->db->where('STATUS', '1');
        $queryDataRole = $this->db->get('ROLE');
        $this->db->where('STATUS', '1');
        $queryDataDivisi = $this->db->get('MASTER_DIVISIONS');
        $data['data'] = $queryData->result();
        $data['role'] = $queryDataRole->result();
        $data['division'] = $queryDataDivisi->result();
        $data['total'] = $this->db->count_all('USERS');

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get user_management", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/index.php', $data);
        $this->load->view('layout/footer.php');
    }

    function user() {
        $this->checkModule();
        $data = array();

        $userId = $this->session->PERSONAL_NUMBER;
        $roleUserId = $this->session->ROLE_ID;
        $regionalId = $this->session->REGIONAL;
        $data["RegionalId"] = $regionalId;

        $rsIsActiveOption = array(["IsActiveId" => "1", "IsActiveName" => "Active"], 
						          ["IsActiveId" => "0", "IsActiveName" => "Non Active"]);
        $data["IsActiveOption"] = $rsIsActiveOption;
        
        $rsRoleOption = $this->User_model->getRoleOption($regionalId);
        $data["RoleOption"] = $rsRoleOption;
        
        $rsUnitKerjaOption = $this->User_model->getUnitKerjaOption();
        $data["UnitKerjaOption"] = $rsUnitKerjaOption;
        
        if($this->input->post()){
            if($roleUserId == USER_ROLE_ADMIN_WILAYAH){
                $UnitKerjaId = $this->session->DIVISION;
            }else{
                $UnitKerjaId = $this->input->post("unitKerjaId");
            }
            $RoleId = $this->input->post("roleId");
            $IsActiveId = $this->input->post("isActiveId");
            $Keyword = $this->input->post("keyword");
        }else{
            if($roleUserId == USER_ROLE_ADMIN_WILAYAH){
                $UnitKerjaId = $this->session->DIVISION;
            }else{
                $UnitKerjaId = "all";
            }
            $RoleId = "all";
            $IsActiveId = "all";
            $Keyword = NULL;
        }
        $data["RoleId"] = $RoleId;
        $data["UnitKerjaId"] = $UnitKerjaId;
        $data["IsActiveId"] = $IsActiveId;
        $data["Keyword"] = $Keyword;

        $filterOption = array(
            "RoleId" => $RoleId,
            "UnitKerjaId" => $UnitKerjaId,
            "IsActiveId" => $IsActiveId,
            "Keyword" => $Keyword
        );        
        $rsUser = $this->User_model->getUserInformation($filterOption);
        $data["User"] = $rsUser;
        
        //echo json_encode($data); die;
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/user.php', $data);
        $this->load->view('layout/footer.php');
    }

    function menu() {
        $this->db->select('a.*')
                ->from('MODULE a')
                ->where('a.STATUS', '1');

        $queryData = $this->db->get();

        $data['data'] = $queryData->result();

        $data['total'] = $this->db->count_all('module');

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/menu.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function access() {
        $this->checkModule();

        //$this->load->database();

        // GET ROLE DATA FOR INDEX
        $qRole = $this->db->select('RoleId ROLE_ID, Name ROLE_NAME')->from('ROLE')->where('IsActive', '1')->order_by('RoleId', 'ASC')->get();

        $data['MASTER_ROLE'] = $qRole->result();

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog("INFO", $persn, "Get User Management", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/access.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function editAccess($RoleId) {
        $this->load->database();

        $this->checkModuleAcc();

        // GET ROLE DATA 
        $qRole = $this->db->select('RoleId ROLE_ID, Name ROLE_NAME')->from('Role')->where(['IsActive' => '1', 'RoleId' => $RoleId])->get();

        $data['MASTER_ROLE'] = $qRole->result();

        // GET MODULE DATA
        $qModule = "SELECT A.ModuleId MODULE_ID, A.ModuleTypeId, B.Name MODULE_TYPE, A.Name MODULE_NAME, A.[Path] MODULE_PATH
            FROM Module A, ModuleType B 
            WHERE A.ModuleTypeId = B.ModuleTypeId
                AND A.IsActive=1";
        $data['MASTER_MODULE'] = $this->db->query($qModule)->result();

        // GET MODULE DATA PER ROLE
        $qAccess = $this->db->select('*')->from('Role')->where(['IsActive' => '1', 'RoleId' => $RoleId])->get();
        $totalAccess = count($qAccess->result());
        if ($totalAccess > 0) {
            foreach ($qAccess->result() as $rl) {

                $qModAcc = $this->db->select('*')->from('MapModuleRole')->where('RoleId', $RoleId)->get();
                $modules [] = array();
                foreach ($qModAcc->result() as $mod) {
                    $modules[] = $mod->ModuleId;
                }

                $data['ACCESS_ROLE'][] = array(
                    'ROLE_ID' => $rl->RoleId,
                    'ROLE_NAME' => $rl->Name,
                    'MODULES' => $modules
                );
            }
        }

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog('INFO', $persn, "Get user_management/edit_access", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/edit_access.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertAcc() {
        $this->load->database();

        $roleId = $this->input->post('role');
        $moduleID = $this->input->post('moduleID');
        $currentUser = $this->input->post('userId');
        $today = date('Y-m-d H:i:s');

        //Delete existing map
        $sql = "DELETE FROM MapModuleRole WHERE RoleId=".$roleId;
        $this->db->query($sql);

        for ($i = 0; $i < count($moduleID); $i++) {

            $newData = array(
                'ROLE_ID' => $roleId,
                'MODULE_ID' => $moduleID[$i],
                'MODIBY' => $currentUser,
                'MODION' => $today
            );
            $query = "INSERT INTO MapModuleRole VALUES (".$moduleID[$i].", ".$roleId.",'".$today."', '".$currentUser."')";

            $hasil = $this->db->query($query);
            $persn = $_SESSION['PERSONAL_NUMBER'];
            //$this->insertLog($persn, "", "insert account", "", json_encode($newData), "");
            $this->insertLog('INFO', $persn, "Edit Access", "", "", json_encode($newData), "");
        }

        
        print_r($hasil);
        die();
    }

    function signer_role() {
        $queryData = $this->db->get('SUB_ROLE');
        $menuData = $this->db->get('SUB_ROLE');
        $data['data_signer'] = $queryData->result();
        $data['data_signer'] = $menuData->result();
        $data['total'] = $this->db->count_all('SUB_ROLE');

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get user_management/signer", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/signer.php', $data);
        $this->load->view('layout/footer.php');
    }

    function role() {
        $this->checkModule();

        /*$this->db->select('a.*, b.SUBROLE_NAME SUBROLENAME')
                ->from('ROLE a')
                ->join('SUB_ROLE b', 'b.ID = a.SUBROLE_ID', 'left')
                ->where('a.STATUS', '1')
                ->order_by('a.ADDON', 'DESC');*/

        $sql = "SELECT A.*, B.Name SUBROLENAME, C.Name AS SegmentName
            FROM [Role] A
            LEFT JOIN SubRole B ON B.SubRoleId=A.SubRoleId
            LEFT JOIN Segment C ON A.SegmentId = C.SegmentId
            WHERE C.IsActive = 1
            ORDER BY A.RoleId";
        
        $queryData = $this->db->query($sql);
        $queryDataSub = $this->db->get('SubRole');
        $querySegment = $this->db->get("Segment");
        $data['data'] = $queryData->result();
        $data['data_subrole'] = $queryDataSub->result();
        $data["data_segment"] = $querySegment->result();
        $data['total'] = $this->db->count_all('Role');

        $rsIsActiveOption = array(["IsActiveId" => "1", "IsActiveName" => "Active"], 
						          ["IsActiveId" => "0", "IsActiveName" => "Non Active"]);
        $data["IsActiveOption"] = $rsIsActiveOption;

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog('INFO', $persn, "Get user_management/role", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/user_management/role.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function addNewAccess() {
        $this->load->database();

        $role = $this->input->post('role');
        $today = date('Y-m-d H:i:s');
        $moduleId = $this->input->post('moduleID');
        $userId = $this->input->post('userId');

        print_r('<pre>');
        print_r(array($moduleId));
        die();

        $records = array();

        for ($i = 0; $i < count($moduleId); $i++) {
            $query = "INSERT INTO ACCESS_ROLES (ROLE_ID, MODULE_ID) VALUES ('" . $role . "','" . $moduleId[$i] . "')";
            $hasil = $this->db->query($query);
            $newData = array(
                'ROLE_ID' => $role,
                'MODULE_ID' => $moduleId[$i]
            );
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "insert addNewAccess", "", json_encode($newData), "");
        }
        print_r($hasil);
        die();
    }

    public function addNewRole() {
        $this->load->database();

        $name = $this->input->post('name');
        $today = date('Y-m-d H:i:s');
        //$subRoleType = $this->input->post('subRoleType');
        $userId = $this->session->PERSONAL_NUMBER;
        $segmentId = $this->input->post("segmentId");
        $isActive = $this->input->post("isActive");
        $description = $this->input->post('description');

        if ($name) {
            $newData = [
                'Name' => $name,
                //'SubRoleId' => $subRoleType,
                "SegmentId" => $segmentId,
                'IsActive' => $isActive,
                'Description' => $description,
                'CreatedDate' => $today,
                'CreatedBy' => $userId
            ];

            $this->db->insert("Role", $newData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog('INFO', $persn, "Add New Role", "", "", json_encode($newData), "");

                $result = array(
                    "status" => "success",
                    "message" => "Role has been successfully added"
                );
            }

            echo json_encode($result);
        }
    }

    public function updateDataRole() {
        $this->load->database();

        $editRoleId = $this->input->post('editRoleId');
        $name = $this->input->post('name');
        $today = date('Y-m-d H:i:s');
        //$subRoleType = $this->input->post('subRoleType');
        $userId = $this->session->PERSONAL_NUMBER;
        $segmentId = $this->input->post("segmentId");
        $isActive = $this->input->post("isActive");
        $description = $this->input->post('description');


        if ($editRoleId) {
            $newData = [
                'Name' => $name,
                //'SubRoleId' => $subRoleType,
                "SegmentId" => $segmentId,
                "IsActive" => $isActive,
                'Description' => $description,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];

            $this->db->where('RoleId', $editRoleId)->update('"Role"', $newData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $getData = $this->db->where('RoleId', $editRoleId)->get('"Role"')->result_array()[0];
                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog('INFO', $persn, "Update Role", "", json_encode($getData), json_encode($newData), "");

                $result = array(
                    "status" => "success",
                    "message" => "Role has been successfully added"
                );
            }

            echo json_encode($result);
        }
    }

    public function deleteRoleData() {
        $this->load->database();

        $userId = $this->input->post('userId');
        $userId2 = $this->input->post('userId2');
        $today = date('Y-m-d H:i:s');

        if ($userId) {
            $newData = [
                'IsActive' => 0,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId2
            ];
            $updateData = $this->db->where('RoleId', $userId)->update('"Role"', $newData);

            $getData = $this->db->where('RoleId', $userId)->get('"Role"')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];

            $this->insertLog('INFO', $persn, "Delete Role", "", json_encode($getData), json_encode($newData), "");

            print_r($updateData);
            die();
        }
    }

    private function add_user_brisim($pn) {
        $hasil = $this->check_user_brisim($pn, 1);
        return $hasil;
    }

    private function check_user_brisim($pn, $rest = 0) {
        $token_list = $this->getTokenDatabase();
        $token = $token_list[0]->TokenNumber;
        $hasil_json = $this->getFromRestUser($pn, $token);
        $hasil_json = json_decode($hasil_json, TRUE);
        $divisi_id = $hasil_json['CHILD_2'];
        $name = $hasil_json['SNAME'];
        $corp = $hasil_json['STELL_TX'];
        if ($rest == 1) {
            $kembali = Array(
                'nama' => $name,
                'divisi' => $divisi_id,
                'corporate_title' => $corp
            );
            return $kembali;
        } else {
            $kembali = Array(
                'nama' => $name,
                'divisi' => $divisi_id,
                'corporate_title' => $corp
            );
            print_r($kembali);
            die;
        }
    }

    private function getTokenDatabase() {
        $this->db->select('a.*')
                ->from('Token a')
                ->order_by("CreatedDate", "desc")
                ->limit(1);
        $queryData = $this->db->get();
        $data = $queryData->result();
        return $queryData->result();
    }

    private function getFromRestUser($id, $token) {
        //Start send login
        $url = BRISTAR_SERVER . "brisim/infopekerjaeof/" . $id;

        $request_headers = array();
        $request_headers[] = 'Authorization: Bearer ' . $token;
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch2, CURLOPT_HTTPGET, TRUE);
        $data2 = curl_exec($ch2);
        $data = json_decode($data2, TRUE);
        if ($data) {

        } else {
            $data3 = explode("}}", $data2)[0] . "}}";
            $data = json_decode($data3, TRUE);
        }

        curl_close($ch2);
        if ($data) {
            if ($data['success'] == TRUE) {
                return json_encode($data['data'][0]);
            } else {
                return null;
            }
        } else {
            return NULL;
        }
    }

    public function addNewUser() {
        $this->load->database();
        
        $userId = $this->input->post("userId");
        $roleId = $this->input->post("roleId");
        $isActive = $this->input->post("isActive");
        $createdBy = $_SESSION["USER_ID"];
        $today = date("Y-m-d H:i:s");
        
        if (strlen($userId) <= 7) {
            $userId = str_repeat("0", 8 - strlen($userId)) . $userId;
        };

        //CHeck PN from bristar
        $error = 0;
        $brisim = $this->add_user_brisim($userId);
        if ($brisim['nama']) {
            $name = $brisim['nama'];
            $title = $brisim['corporate_title'];
            $unitKerjaId = $brisim['divisi'];
        } else {
            $error = 1;
            $error_msg = "User ini tidak ada di Bristar";
        }
        
        if ($userId && $error == 0) {
            $ada_data = $this->db->where("userId", $userId)->get('User')->result();
            if (count($ada_data) > 0) {
                $this->output->set_status_header('400');
                $data = array(
                    "status" => "error",
                    "message" => "Sudah ada user dgn Personal Number ".$userId
                );
                echo json_encode($data);
            } else {
                $newData = array(
                    "UserId" => $userId,
                    "Name" => $name,
                    "UnitKerjaId" => $unitKerjaId,
                    "RoleId" => $roleId,
                    "Title" => $title,
                    "IsActive" => $isActive,
                    "CreatedDate" => $today,
                    "CreatedBy" => $createdBy
                );
                //echo json_encode($newData); die;

                $insertData = $this->db->insert('User', $newData);
                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog('INFO', $persn, "Add New User", "", "", json_encode($newData), "");
                print_r($insertData);
            }
        } else {
            $this->output->set_status_header('400');
            $this->data['message'] = $error_msg;
            echo json_encode($this->data);
        }
    }

    public function deleteData() {
        $this->load->database();

        $userId = $this->input->post('userId');
        $userId2 = $this->input->post('userId2');
        $today = date('Y-m-d H:i:s');

        if ($userId) {
            $newData = [
                'STATUS' => 0,
                'MODION' => $today,
                'MODIBY' => $userId2
            ];
            $updateData = $this->db->where('ID', $userId)->update('USERS', $newData);

            $getData = $this->db->where('ID', $userId)->get('USERS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "delete deleteData", json_encode($getData), json_encode($newData), "");

            print_r($updateData);
            die();
        }
    }

    public function updateUser() {
        $this->load->database();

        $userId = $this->input->post("userId");
        $name = $this->input->post("name");
        $unitKerjaId = $this->input->post("unitKerjaId");
        $roleId = $this->input->post("roleId");
        $isActive = $this->input->post("isActive");
        $modifiedBy = $_SESSION["USER_ID"];
        $modifiedDate = date("Y-m-d H:i:s");
        
        $newData = [
            "UserId" => $userId,
            "Name" => $name,
            "UnitKerjaId" => $unitKerjaId,
            "RoleId" => $roleId,
            "IsActive" => $isActive,
            "ModifiedDate" => $modifiedDate,
            "ModifiedBy" => $modifiedBy
        ];

        $getData = $this->db->where('UserId', $userId)->get('User')->result_array()[0];
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog('INFO', $persn, "Update User", "", json_encode($getData), json_encode($newData), "");
        $updateData = $this->db->where('UserId', $userId)->update('User', $newData);
        print_r($updateData);        
    }

    public function serviceCheckRoleName(){
        if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
        $this->load->database();
        $roleName = strtoupper(trim($this->input->post("roleName")));
        $roleId = $this->input->post("roleId");

        $sql = "SELECT RoleId FROM Role WHERE UPPER(LTRIM(RTRIM((Name)))) = '".$roleName."'";
        if($roleId != null){
            $sql .= " AND RoleId != ".$roleId;
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            echo "false";
        }else
            echo "true";
    }

    public function serviceGetRoleInformation($roleId){
        if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
        $this->load->database();
        
        $sql = "SELECT * FROM Role WHERE RoleId = ".$roleId;
        $query = $this->db->query($sql);
        $result = $query->result();
        
        echo json_encode($result[0]);
    }
}
?>