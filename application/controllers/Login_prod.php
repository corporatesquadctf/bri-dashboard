<?php

abstract class Login_prod extends Login_base {

    function process() {
        $this->load->database();

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $current_datetime = $current_datetime->format('Y-m-d H:i:s');
        $persn = $this->input->post('personalnumber');
        $passw = $this->input->post('password');
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

        //HITUNG ID Jika <= 7
        if (strlen($persn) <= 7) {
            $persn = str_repeat("0", 8 - strlen($persn)) . $persn;
        };
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_index');
        } else {
            $suksesApi = json_decode($this->loginBristar($persn, $passw), TRUE);
            log_message('error', print_r($suksesApi, TRUE));
            if ($suksesApi['data']['rc'] == '00') {
                $postedPn = $persn;
                /*$postedPass = md5($passw);
                $where = array('a.personal_number' => $postedPn, 'a.status' => '1');

                $this->db->select('a.*, b.token_number, b.expires, c.ROLE_NAME, c.SUBROLE_ID, d.SUBROLE_NAME')
                        ->from('USERS a')
                        ->join('TOKENS b', 'b.ID = a.token_id', 'left')
                        ->join('ROLE c', 'c.ID = a.role_id', 'left')
                        ->join('SUB_ROLE d', 'd.ID = c.ID', 'left')
                        ->where($where);

                $queryData = $this->db->get();
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
                $queryData = $this->db->query($sql);

                log_message('debug', print_r($queryData, TRUE));
                $data['data'] = $queryData->result();
                $foundData = count($data['data']);

                if ($foundData > 0) {
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
                    $this->insertLog('INFO', $persn, "Login", "Success login", "", "", "");
                    
                    $sql = "UPDATE [User] SET LastLogin = '".$current_datetime."'
                        WHERE UserId = '".$postedPn."'";

                    $this->db->query($sql);

                    if($this->session->SEGMENT_ID == 1){
                        redirect('Home');
                    }else{
                        redirect("Profile");
                    }
                } else {
                    $this->insertLog('INFO', $persn, "Login", "Failed Login using password", "", "", "");
                    $this->session->set_flashdata('result_login', '<br>Password or Personal Number is not match.');
                    redirect('logins');
                }
            } else {
                $this->insertLog('INFO', $persn, "Login", "Failed Login using password", "", "", "");
                $this->session->set_flashdata('result_login', '<br>Password or Personal Number is not match.');
                redirect('logins');
            };
        }
    }

    public function add_user_brisim($pn) {
        $hasil = $this->check_user_brisim($pn, 1);
        if ($hasil['nama']) {
            echo json_encode($hasil);
        } else {
            $this->output->set_status_header('400');
            $error_msg = "User ini tidak ada di Bristar";
            $this->data['message'] = $error_msg;
            echo json_encode($this->data);
        }
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

    function loginBristar($id, $pass) {
        $token_list = $this->getTokenDatabase();
        $token = $token_list[0]->TokenNumber;
        $hasil_json = $this->getFromRest($id, $pass, $token);
        $hasil = json_decode($hasil_json, TRUE);
        if (strpos($hasil_json, 'data') !== false) {
            $hasil['token'] = $token;
            return json_encode($hasil);
        } elseif (strpos($hasil_json, 'error_description') !== false) {
            $token = $this->getToken();
            $this->insertTokenDatabase($token);
            $hasil = json_decode($this->getFromRest($id, $pass, $token), TRUE);
            $hasil['token'] = $token;
            return json_encode($hasil);
        }
    }

    function getTokenDatabase() {
        $this->db->select('a.*')
                ->from('Token a')
                ->order_by("CreatedDate", "desc")
                ->limit(1);
        $queryData = $this->db->get();
        $data = $queryData->result();
        return $queryData->result();
    }

    function insertTokenDatabase($token) {
        $datenow = date('Y-m-d H:i:s');
        $newData = [
            'TokenNumber' => $token,
            'Expires' => 720,
            'IsActive' => 1,
            'CreatedDate' => date('Y-m-d H:i:s')
        ];
        $query = "INSERT INTO Token (TokenNumber, Expires, IsActive, CreatedDate) VALUES ('" . $token . "','720', '1','" . $datenow . "')";
        $hasil = $this->db->query($query);
    }

    function getToken() {
        echo "Initiate get access token\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, BRISTAR_SERVER . "oauth/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=".CLIENT_ID."&client_secret=".CLIENT_SECRET."&grant_type=".GRANT_TYPE."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output2 = curl_exec($ch);
        $server_output = json_decode($server_output2, TRUE);
        echo $server_output['access_token'] . '\n';
        curl_close($ch);
        return $server_output['access_token'];
    }

    function getFromRest($id, $pass, $token) {
        $url = BRISTAR_SERVER . "korporasi/login";
        $request_headers = array();
        $request_headers[] = 'Authorization: Bearer ' . $token;
        $post_data = array(
            'personal_number' => $id,
            'password' => $pass
        );
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data);
        $data2 = curl_exec($ch2);
        $data = json_decode($data2, TRUE);

        if ($data) {
            
        } else {
            $data3 = explode("}}", $data2)[0] . "}}";
            $data = json_decode($data3, TRUE);
        };
        curl_close($ch2);
        if ($data) {
            return json_encode($data);
        } else {
            return NULL;
        }
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
        };
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

    public function checkCustomer($cifId=""){
        $rsToken = $this->getTokenDatabase();
        $token = $rsToken[0]->TokenNumber;

        $rsCustomer = $this->getFromRestCustomer($cifId, $token);   
        echo $rsCustomer;     
    }

    public function getFromRestCustomer($cifId, $token){
        $url = BRISTAR_SERVER . "customer/name/" . $cifId;
        $request_headers = array();
        $request_headers[] = 'Authorization: Bearer ' . $token;

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch2, CURLOPT_HTTPGET, TRUE);
        $data = curl_exec($ch2);
        return $data;        
    }

}

?>