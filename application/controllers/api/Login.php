<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Login extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
    }

    public function index_post()
    {
        $this->load->database();

        $persn = $this->post('personalnumber');
        $passw = $this->post('password');

        if (empty($persn)) {
            $this->response([
                'status' => FALSE,
                "detail" => "Personal Number cannot be empty",
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        if (empty($passw)) {
            $this->response([
                'status' => FALSE,
                "detail" => "Password cannot be empty",
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        } else {

            //HITUNG ID Jika <= 7
            if (strlen($persn) <= 7) {
                $persn = str_repeat("0", 8 - strlen($persn)) . $persn;
            };

            // $suksesApi = json_decode($this->loginBristar($persn, $passw), TRUE);

            if (true) {  //untuk developmen
                // if ($suksesApi['data']['rc'] == '00') {
                $token_mobile = $this->insertTokenMobile($persn);
                $postedPn = $persn;

                $sql = 'SELECT A.UserId
                    , A.UnitKerjaId
                    , A.RoleId
                    , A.Name
                    , A.Title
                    , A.CorporateEmail
                    , A.OtherEmail
                    , A.PhoneNumber1
                    , A.PhoneNumber2
                    , A.ProfilePicture
                    , A.IsActive
                    , A.LastLogin
                    , B.TokenNumber
                    , B.Expires
                    , C.RoleId
                    , C.Name RoleName
                    , D.SubRoleId
                    , D.Name SubRoleName
                    , E.UnitKerjaId
                    , E.Name UnitKerjaName
                    -- , E.SegmentId
                    , C.SegmentId
                    , G.Name SegmentName
                    FROM [User] A
                    LEFT JOIN TokenMobile B ON B.PersonalNumber=A.UserId
                    JOIN [Role] C ON C.RoleId=A.RoleId AND C.IsActive=1
                    LEFT JOIN SubRole D ON D.SubRoleId=C.SubRoleId AND D.IsActive=1
                    JOIN UnitKerja E ON E.UnitKerjaId=A.UnitKerjaId AND E.IsActive=1
                    --LEFT JOIN Regional F ON C.RegionalId = F.RegionalId AND F.IsActive=1
                    JOIN Segment G ON C.SegmentId=G.SegmentId AND G.IsActive=1
                    WHERE UserId = \'' . $postedPn . '\'';
                $queryData = $this->db->query($sql);

                // log_message('debug', print_r($queryData, TRUE));
                $data['data'] = $queryData->result();
                $foundData = count($data['data']);

                if ($foundData > 0) {
                    $this->insertLog('INFO', $persn, "Login", "Success login from mobile app", "", "", "");
                    $this->response([
                        "data" => $data['data'],
                        "status" => "Success",
                        "detail" => "Success login.",
                    ], REST_Controller::HTTP_OK);
                    return;
                } else {
                    $this->insertLog('INFO', $persn, "Login", "Failed Login using password from mobile app", "", "", "");
                    $this->response([
                        'status' => FALSE,
                        "detail" => "Password or Personal Number is not match.",
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                    return;
                }
            } else {
                $this->insertLog('INFO', $persn, "Login", "Failed Login using password from mobile app", "", "", "");
                $this->response([
                    'status' => FALSE,
                    "detail" => "Password or Personal Number is not match.",
                ], REST_Controller::HTTP_UNAUTHORIZED);
                return;
            };
        }
    }

    function loginBristar($id, $pass)
    {
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

    function getTokenDatabase()
    {
        $this->db->select('a.*')
            ->from('Token a')
            ->order_by("CreatedDate", "desc")
            ->limit(1);
        $queryData = $this->db->get();
        $data = $queryData->result();
        return $queryData->result();
    }

    function insertTokenDatabase($token)
    {
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

    function getToken()
    {
        echo "Initiate get access token\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, BRISTAR_SERVER . "oauth/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . CLIENT_ID . "&client_secret=" . CLIENT_SECRET . "&grant_type=" . GRANT_TYPE . "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output2 = curl_exec($ch);
        $server_output = json_decode($server_output2, TRUE);
        echo $server_output['access_token'] . '\n';
        curl_close($ch);
        return $server_output['access_token'];
    }

    function getFromRest($id, $pass, $token)
    {
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

    private function getFromRestUser($id, $token)
    {
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

    function insertTokenMobile($persn)
    {
        $datenow = date('Y-m-d H:i:s');
        $token = md5($persn . $datenow);
        $this->db->select('a.*')
            ->from('TokenMobile a')
            ->where("PersonalNumber", $persn);
        $queryData = $this->db->get();
        $data = $queryData->result();
        if (count($data) > 0) {
            $query = "UPDATE TokenMobile 
            SET TokenNumber = '" . $token . "', IsActive = 1, CreatedDate = '" . $datenow . "'
            WHERE PersonalNumber= '" . $persn . "' ";
            $hasil = $this->db->query($query);
        } else {
            $query = "INSERT INTO TokenMobile ( TokenNumber, PersonalNumber, Expires, IsActive, CreatedDate) 
            VALUES ('" . $token . "', '" . $persn . "', '720', '1','" . $datenow . "')";
            $hasil = $this->db->query($query);
        }
        return $token;
    }
}
