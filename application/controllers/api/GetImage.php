<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class GetImage extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security',
            'image_helper'
        ));
        $this->checkTokenMobile();
    }

    public function index_post(){
        $file = $this->post('namefile');
        $page = $this->post('page');
        get_image_path($file, $page);
        return;
    }
}