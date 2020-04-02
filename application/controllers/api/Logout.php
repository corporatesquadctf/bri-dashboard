<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Logout extends REST_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
    }

    public function index_post(){
        $isToken = $this->checkTokenMobile();
        $headers = $this->input->request_headers();
        $token = $headers['Authorization'];

        // $persn = $this->post('personalnumber');
        // if (empty($persn)) {
        //     $this->response([
        //         "status" => "Error",
        //         "detail" => "Need personalnumber by post method",
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        //     return;
        // }
        if ($isToken) {
            $datenow = date('Y-m-d H:i:s');
            $query = "UPDATE TokenMobile 
            SET IsActive = 0, CreatedDate = '" . $datenow . "'
            WHERE TokenNumber= '" . $token . "' ";
            $hasil = $this->db->query($query);
            $this->response([
                "status" => "Success",
                "detail" => "Logout success",
            ], REST_Controller::HTTP_OK);
            //$this->insertLog('INFO', $persn, "Logout", "Success logout from mobile app", "", "", "");
            return;
        }
    }

}
