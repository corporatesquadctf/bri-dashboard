<?php

class User_model extends MY_Model {

    private $year_current;

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function getUserInformation($data){
        $sql = "SELECT t1.UserId, t1.Name,  t1.RoleId, t2.Name AS RoleName, t1.UnitKerjaId, t3.Name AS UnitKerjaName, t1.IsActive
                FROM [User] t1
                LEFT JOIN Role t2 ON  t1.RoleId = t2.RoleId
                LEFT JOIN UnitKerja t3 ON t1.UnitKerjaId = t3.UnitKerjaId 
                WHERE 1=1";

        if($data["RoleId"] != "all"){
            $sql .= " AND t1.RoleId = ".$data["RoleId"];
        }

        if($data["UnitKerjaId"] != "all"){
            $sql .= " AND t1.UnitKerjaId = ".$data["UnitKerjaId"];
        }

        if($data["IsActiveId"] != "all"){
            $sql .= " AND t1.IsActive = ".$data["IsActiveId"];
        }

        if($data["Keyword"] != NULL){
            $sql .= " AND (";
            $sql .= " t1.UserId LIKE '%".$data["Keyword"]."%'";
            $sql .= " OR t1.Name LIKE '%".$data["Keyword"]."%'";
            $sql .= " OR t2.Name LIKE '%".$data["Keyword"]."%'";
            $sql .= " OR t3.Name LIKE '%".$data["Keyword"]."%')";
        }

        $sql .= " ORDER BY UserId";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getRoleOption($regionalId = NULL){
        $sql = "SELECT RoleId, Name AS RoleName
                FROM Role
                WHERE IsActive = 1";
        if($regionalId != NULL){
            $sql .= " AND RegionalId >= ".$regionalId;
        }
        $sql .= " ORDER BY RoleName";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getUnitKerjaOption(){
        $sql = "SELECT UnitKerjaId, Name AS UnitKerjaName
                FROM UnitKerja
                WHERE IsActive = 1
                ORDER BY UnitKerjaName";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_user_list() {
        $this->db->select('UserId, Name');
        $this->db->from('[User]');
        return $this->db->get()->row();
    }

    public function get_user_data($user_id) {
        $sql = 'SELECT A.*, B.Name RoleName, C.Name UnitKerjaName
            FROM [User] A
            JOIN [Role] B ON A.RoleId=B.RoleId
            JOIN UnitKerja C ON A.UnitKerjaId=C.UnitKerjaId
            WHERE A.IsActive=1 and UserId=\''.$user_id.'\'';
        return $this->db->query($sql)->row();
    }

    public function get_customers($user_id) {
        $this->db->distinct();
        $this->db->select(<<<SQL
delegations_maker.vcif, 
view_customer_mapping.company_name, 
delegations_maker.maker_id, 
users.name maker_name, 

account_plannings.year, 
account_plannings.doc_status
SQL
        );
        $this->db->from('account_plannings');
        $this->db->join('delegations_maker', 'account_plannings.vcif =  delegations_maker.vcif', 'right');
        $this->db->join('users', 'delegations_maker.maker_id =  users.id', 'right');
        $this->db->join('view_customer_mapping', 'delegations_maker.vcif = view_customer_mapping.vcif', 'left');
        $this->db->where('account_plannings.year', null);
        $this->db->or_where('account_plannings.year', $this->year_current);
        $this->db->where('delegations_maker.maker_id', $user_id);
        return $this->db->get()->result();
    }

    function get_tasks($user_id) {

        $data = array(
            'tasklists' => array()
        );

        $this->db->distinct();
        $this->db->select(<<<SQL
            delegations_maker.*, 
            delegations_checker.rejected_reason checker_reason,
            delegations_signer.rejected_reason signer_reason,
            view_customer_mapping.company_name company_name,
            view_customer_mapping.status_vcif status_vcif,
            account_plannings.vcif,
            account_plannings.year, 
            account_plannings.doc_status, 
            USERS.id, USERS.name
SQL
        );

        $this->db->from('delegations_maker');
        $this->db->join('account_plannings', 'account_plannings.vcif = delegations_maker.vcif', 'left');
        $this->db->join('delegations_checker', 'delegations_checker.vcif = delegations_maker.vcif', 'left');
        $this->db->join('delegations_signer', 'delegations_signer.vcif = delegations_maker.vcif', 'left');
        $this->db->join('view_customer_mapping', 'delegations_maker.vcif = view_customer_mapping.vcif', 'left');
        $this->db->join('USERS', 'USERS.id = delegations_maker.maker_id', 'left');
        $this->db->where('maker_id', $user_id);
        $this->db->order_by('account_plannings.year', 'desc');

        $groups = $this->db->get()->result_array();

        foreach ($groups as $group) {

            $vcif = $group['vcif'];
            if (!key_exists($vcif, $data['tasklists'])) {
                $data['tasklists'][$vcif] = array(
                    'company_name' => $group['company_name'],
                    'checker_reason' => $group['checker_reason'],
                    'signer_reason' => $group['signer_reason'],
                    'doc_status' => $group['doc_status'],
                    'status_vcif' => $group['status_vcif'],
                    'id' => $group['id'],
                    'name' => $group['name'],
                    'year' => $group['year'],
                    'vcif' => $group['vcif'],
                    'makers' => array()
                );
            }

            $this->db->distinct();
            $this->db->select(<<<SQL

            delegations_maker.maker_id,
            users.name
SQL
            );
            $this->db->from('view_customer_mapping');
            $this->db->join('delegations_maker', 'view_customer_mapping.vcif = delegations_maker.vcif', 'left');
            $this->db->join('users', 'delegations_maker.maker_id = users.id', 'left');
            $this->db->where('view_customer_mapping.vcif', $group['vcif']);

            $data['tasklists'][$vcif]['makers'] = $this->db->get()->result_array();
        }
        return $data['tasklists'];
    }

    public function upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '1024';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('input_gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            echo "<script>alert('Wrong File Format');document.location='../profile'</script>";
            return $return;
        }
    }

    public function save($upload) {
        $id = $this->input->post('id');
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $data = array(
            'profile_picture' => $upload['file']['file_name']
        );
        $getData = $this->db->where('id', $id)->get('USERS')->result_array()[0];
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "update profile picture", json_encode($getData), json_encode($data), "");

        $this->db->where('id', $id);
        $upd = $this->db->update('USERS', $data);
        $this->session->set_userdata('PROFILE_PIC', $upload['file']['file_name']);
        return $upd;
    }

    public function get_array_user_data($user_id) {
        $sql = 'SELECT A.*, B.Name RoleName, C.Name UnitKerjaName
            FROM [User] A
            JOIN [Role] B ON A.RoleId=B.RoleId
            JOIN UnitKerja C ON A.UnitKerjaId=C.UnitKerjaId
            WHERE A.IsActive=1 and UserId=\''.$user_id.'\'';
        $query = $this->db->query($sql);		
        $result = $query->result_array();
        return $result[0];
    }

}
