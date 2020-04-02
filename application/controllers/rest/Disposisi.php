<?php

class Disposisi extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('master_model');
        $this->load->model('accountplanning');
        $this->load->model('notification_model');
        $this->load->database();
    }

    public function get_disposisi() {
        $user_id = $_SESSION['USER_ID'];

        $data['user'] = $this->user_model->get_user_data($user_id);
        $result = [];
        $user_id_str = '%|' . $user_id . '|%';
        $data['user_id_str'] = $user_id_str;
        $division = $data['user']->division_id;
        $roles = 11;
        $roles_admin = 2;
        if ($data['user']->role_id == $roles) {
            $query_string = <<<SQL
SELECT 
  d.*,
  account_plannings.doc_status
FROM disposisi as d
INNER JOIN account_plannings 
  ON account_plannings.VCIF = d.VCIF
      AND account_plannings.YEAR = d.DATA_YEAR
      AND account_plannings.doc_status = 4
WHERE d.STAFF_ID LIKE ?
SQL
            ;
            $result = $this->db->query($query_string, array($user_id_str))->result_array();
        } else {
            $query_string = <<<SQL
SELECT 
  d.*,
  account_plannings.doc_status
FROM disposisi as d
INNER JOIN account_plannings 
  ON account_plannings.VCIF = d.VCIF
      AND account_plannings.YEAR = d.DATA_YEAR
      AND account_plannings.doc_status = 4
WHERE d.ADDBY = ?
SQL
            ;
            $result = $this->db->query($query_string, array($data['user']->id))->result_array();
        }
        foreach ($result as $key => $res) {
            $result[$key]['index'] = $key + 1;
            if ($data['user']->role_id == $roles_admin) {
                $result[$key]['roles'] = 1;
            } else {
                $result[$key]['roles'] = 0;
            }
            $res['STAFF_ID'] = substr($res['STAFF_ID'], 1, -1);
            $temp = explode("|", $res['STAFF_ID']);
            $result[$key]['STAFF_ID'] = $temp;
            $panjang_temp = count($temp);
            $result_temp = [];
            foreach ($temp as $key2 => $t) {
                if ($t) {
                    $temp_name = $this->db->select('name')->from('USERS')->where('id', $t)->get()->result();
                    $result_temp[] = $temp_name[0];
                }
            }
            $result[$key]['STAFF_NAME'] = $result_temp;
        }
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "get disposisi", "", "", "");
        $data['disposisi'] = $result;
        $data['divisions'] = $this->master_model->get_divisions();
        $masteruser = $this->db->select('id')->select('name')->from('USERS')
                        ->where('role_id', $roles)
                        ->where('division_id', $division)
                        ->get()->result();
        $data['master_users'] = $masteruser;
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->set_output($data);
    }

    public function edit_disposisi() {
        $id = $this->request->id;
        $users = $this->request->users;
        $temp_users = '|';
        if ($users) {
            foreach ($users as $u) {
                $temp_users = $temp_users . $u . '|';
            }
        } else {
            $temp_users = '';
        }
        $newData = Array(
            'STAFF_ID' => $temp_users
        );
        $getData = $this->db->where('ID', $id)->get('disposisi')->result_array()[0];
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "update disposisi", json_encode($getData), json_encode($newData), "");

        $updateData = $this->db->where('ID', $id)->update('disposisi', $newData);
        $result = new stdClass();
        if ($updateData) {
            $result->error = 0;
        } else {
            $result->error = 1;
            $result->msg = "Gagal Mengupdate data";
        }
        $this->set_output($result);
    }

}

?>