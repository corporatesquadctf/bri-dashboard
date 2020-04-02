<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Banks extends MY_Controller {

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
    }

    public function index() {
        $this->load->database();
        $this->checkModule();

        $sql = "SELECT A.*, B.Name MAKER, C.Name MODIFIER
            FROM Bank A
            LEFT JOIN [User] B ON A.CreatedBy=B.UserId
            LEFT JOIN [User] C ON A.ModifiedBy=C.UserId";

        $queryData = $this->db->query($sql);
        $data['data'] = $queryData->result();

        $rsIsActiveOption = array(["IsActiveId" => "1", "IsActiveName" => "Active"], 
						          ["IsActiveId" => "0", "IsActiveName" => "Non Active"]);
        $data["IsActiveOption"] = $rsIsActiveOption;

        $persn = $_SESSION['PERSONAL_NUMBER'];
        //$this->insertLog($persn, "", "get master_banks", "", "", "");
        $this->insertLog('INFO', $persn, "Get Bank", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('backend/master_data/bank_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertNew() {
        $this->load->database();

        $bankName = $this->input->post('bankName');
        $userId = $this->session->PERSONAL_NUMBER;
        $isActive = $this->input->post("isActive");
        $today = date('Y-m-d H:i:s');

        if ($bankName) {
            $newData = [
                'Name' => $bankName,
                'IsActive' => $isActive,
                'CreatedDate' => $today,
                'CreatedBy' => $userId
            ];
            $this->db->insert('Bank', $newData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $persn = $_SESSION['PERSONAL_NUMBER'];
                $this->insertLog('INFO', $persn, "Insert Bank", "", "", json_encode($newData), "");
            
                $result = array(
                    "status" => "success",
                    "message" => "Bank has been successfully added."
                );
            }
            echo json_encode($result);
        }
    }

    public function updateData() {
        $this->load->database();

        $bankId = $this->input->post('bankId');
        $bankName = $this->input->post('bankName');
        $isActive = $this->input->post("isActive");
        $userId = $this->session->PERSONAL_NUMBER;
        $today = date('Y-m-d H:i:s');

        //$this->form_validation->set_rules('bankName', 'Bank Name ', 'required');

        if ($bankId) {
            $newData = [
                'Name' => $bankName,
                "IsActive" => $isActive,
                'ModifiedDate' => $today,
                'ModifiedBy' => $userId
            ];
            $getData = $this->db->where('BankId', $bankId)->get('Bank')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            //$this->insertLog($persn, "", "update master_banks", json_encode($getData), json_encode($newData), "");
            $this->insertLog('INFO', $persn, "Update Bank", "", json_encode($getData), json_encode($newData), "");
            $updateData = $this->db->where('BankId', $bankId)->update('Bank', $newData);
            $errorStatus = $this->db->error();
            if($errorStatus["code"]<>0){
                $result = array(
                    "status" => "error",
                    "message" => $errorStatus["message"]
                );
            }else{
                $result = array(
                    "status" => "success",
                    "message" => "Bank has been successfully updated"
                );
            }
        }else{
            $result = array(
                "status" => "error",
                "message" => "Bank is not found"
            );
        }
        echo json_encode($result);
    }

    public function deleteData() {
        $this->load->database();

        $bankId = $this->input->post('bankId');
        $userId = $this->input->post('userId');
        $today = date('Y-m-d H:i:s');

        if ($bankId) {
            $newData = [
                'STATUS' => 0,
                'MODION' => $today,
                'MODIBY' => $userId
            ];
            $getData = $this->db->where('id', $bankId)->get('MASTER_BANKS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "delete master_banks", json_encode($getData), json_encode($newData), "");
            $updateData = $this->db->where('ID', $bankId)->update('MASTER_BANKS', $newData);

            print_r($updateData);
            die();
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

    public function serviceCheckBankName(){
        if(empty($this->session->PERSONAL_NUMBER)) redirect("logins");
        $this->load->database();
        $bankName = strtoupper(trim($this->input->post("bankName")));
        $bankId = $this->input->post("bankId");

        $sql = "SELECT BankId FROM Bank WHERE UPPER(LTRIM(RTRIM((Name)))) = '".$bankName."'";
        if($bankId != null){
            $sql .= " AND BankId != ".$bankId;
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