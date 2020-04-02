<?php

defined('BASEPATH') or exit('No direct script access allowed');


function get_image_path($image_name, $page)
{
    if ($page == 'user') {
        $filename = APPPATH . '../assets/images/user_profile/' . $image_name;
        if(!file_exists($filename)){
            $filename = APPPATH . '../assets/images/user_profile/default.png';           
        }
    } else {
        $filename = APPPATH . '../uploads/' . $image_name;
        if(!file_exists($filename)){
            $filename = APPPATH . '../uploads/CustomerGroupLogo/default.png';           
        }
    }
    if (file_exists($filename)) {
        // $this->response($filename, 200)->header('Content-type', $header);
        $mime = mime_content_type($filename); //<-- detect file type
        header('Content-Length: ' . filesize($filename)); //<-- sends filesize header
        header("Content-Type: $mime"); //<-- send mime-type header
        header('Content-Disposition: inline; filename="' . $filename . '";'); //<-- sends filename header
        readfile($filename); //<--reads and outputs the file onto the output buffer
        die(); //<--cleanup
        exit; //and exit
    }
    return;
}
