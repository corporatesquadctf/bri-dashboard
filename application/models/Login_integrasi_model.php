<?php

class Login_integrasi_model extends CI_Model {

    public function loginBristarRest($id, $pass) {
        $token_list = $this->getTokenDatabase();

        $token = $token_list[0]->token_number;
        $hasil_json = $this->getFromRest($id, $pass, $token);
        $hasil = json_decode($hasil_json, TRUE);
        $hasilRest = array(
            'success' => true
        );
        if (strpos($hasil_json, 'data') !== false) {
            $hasil['token'] = $token;
        } elseif (strpos($hasil_json, 'error_description') !== false) {
            $token = $this->getToken();
            $this->insertTokenDatabase($token);
            $hasil = json_decode($this->getFromRest($id, $pass, $token), TRUE);
            $hasil['token'] = $token;
        }
        $hasil['data']['rc'] == '00' ? $hasilRest['success'] = true : $hasilRest['success'] = false;
        return $hasilRest;
    }

    private function getTokenDatabase() {
        $this->db->select('a.*')
                ->from('TOKENS a')
                ->order_by("addon", "desc")
                ->limit(1);
        $queryData = $this->db->get();
        $data = $queryData->result();
        return $queryData->result();
    }

    private function insertTokenDatabase($token) {
        $datenow = date('Y-m-d H:i:s');
        $newData = [
            'token_number' => $token,
            'expires' => 720,
            'status' => 1,
            'addon' => date('Y-m-d H:i:s')
        ];
        $query = "INSERT INTO TOKENS (token_number, expires, status, addon) VALUES ('" . $token . "','720', '1','" . $datenow . "')";
        $hasil = $this->db->query($query);
    }

    private function getToken() {
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

    private function getFromRest($id, $pass, $token) {
        //Start send login
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

}
