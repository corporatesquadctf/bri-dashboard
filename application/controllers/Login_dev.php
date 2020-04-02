<?php

abstract class Login_dev extends Login_base {

    function process() {
        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $current_datetime = $current_datetime->format('Y-m-d H:i:s');
        $persn = $this->input->post('personalnumber');
        /*$passw = $this->input->post('password');
        $captcha = $this->input->post('captcha');

        $this->form_validation->set_rules('personalnumber', 'Personal Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');

        $sessCaptcha = $this->session->userdata('captchaCode');
        if ($captcha === $sessCaptcha) {
            echo 'Captcha code matched.';
        } else {
            $this->session->set_flashdata('result_login', '<br>Captcha code does not match, please try again.');
            redirect('logins');
            return;
        }

        if (strlen($persn) <= 7) {
            $persn = str_repeat("0", 8 - strlen($persn)) . $persn;
        };

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_index');
            return;
        }

        $postedPass = md5($passw);*/
        $postedPn = $persn;
        /*$where = array(
            'a.personal_number' => $postedPn,
            //'a.password' => $postedPass,
            'a.status' => '1');

        $this->db->select('a.*, b.token_number, b.expires, c.ROLE_NAME, c.SUBROLE_ID, d.SUBROLE_NAME');
        $this->db->from('USERS a');
        $this->db->join('TOKENS b', 'b.ID = a.token_id', 'left');
        $this->db->join('ROLE c', 'c.ID = a.role_id', 'left');
        $this->db->join('SUB_ROLE d', 'd.ID = c.ID', 'left');

        $this->db->where($where);
*/
        $sql = 'SELECT A.*, B.TokenNumber, B.Expires, 
                C.RoleId, C.Name RoleName
                -- , C.RegionalId
                -- , F.Name AS RegionalName
                , D.SubRoleId, D.Name SubRoleName, E.UnitKerjaId, E.Name UnitKerjaName
                -- , E.SegmentId
                , C.SegmentId
            FROM [User] A
            LEFT JOIN Token B ON B.TokenId=A.TokenId AND B.IsActive=1
            JOIN [Role] C ON C.RoleId=A.RoleId AND C.IsActive=1
            LEFT JOIN SubRole D ON D.SubRoleId=C.SubRoleId AND D.IsActive=1
            JOIN UnitKerja E ON E.UnitKerjaId=A.UnitKerjaId AND E.IsActive=1
            -- LEFT JOIN Regional F ON C.RegionalId = F.RegionalId AND F.IsActive=1
            WHERE UserId = \''.$postedPn.'\'';

            // echo $sql; die();
        $queryData = $this->db->query($sql);

        //$queryData = $this->db->get();

        $data['data'] = $queryData->result();
        $foundData = count($data['data']);

        if ($foundData == 0) {
            $this->session->set_flashdata('result_login', '<br>Password or Personal Number is not match.');
            redirect('logins');
            return;
        }

        foreach ($data['data'] as $k) {
            $getAccess = $this->getAccess($k->RoleId, $persn);
            $session_data = array(
                'USER_ID' => $k->UserId,
                'PERSONAL_NUMBER' => $k->UserId,
                'NAME' => $k->Name,
                'OTHER_EMAIL' => $k->OtherEmail,
                'CORP_EMAIL' => $k->CorporateEmail,
                'CORP_TITLE' => $k->Title,
                'PHONE_NUM1' => $k->PhoneNumber1,
                'PHONE_NUM2' => $k->PhoneNumber2,
                'ROLE_ID' => $k->RoleId,
                'ROLE_NAME' => $k->RoleName,
                'SUBROLE_ID' => $k->SubRoleId,
                'SUBROLE_NAME' => $k->SubRoleName,
                'TOKEN_NUM' => $k->TokenNumber,
                'EXPIRES_IN' => $k->Expires,
                'ACCESS' => $getAccess,
                'PROFILE_PIC' => $k->ProfilePicture,
                'MODION' => $k->ModifiedDate,
                'DIVISION' => $k->UnitKerjaId,
                'DIVISION_NAME' => $k->UnitKerjaName,
                'REGIONAL' => $k->RegionalId,
                'REGIONAL_NAME' => $k->RegionalName,
                'SEGMENT_ID' => $k->SegmentId
            );
            $this->session->set_userdata($session_data);
        }

        $sql = "UPDATE [User] SET LastLogin = '".$current_datetime."'
            WHERE UserId = '".$persn."'";

        $this->db->query($sql);

        if($this->session->SEGMENT_ID == 1){
            redirect('Home');
        }else{
            redirect("Profile");
        }
    }
}

?>