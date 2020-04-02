<?php

include APPPATH . 'controllers/Login_base.php';
//include APPPATH . 'controllers/Login_dev.php';
include APPPATH . 'controllers/login_prod.php';

//class Logins extends Login_dev {
class Logins extends Login_prod {
    function __construct() {
        parent::__construct();
        $this->captcha_config = array(
            'expiration' => 7200,
            'font_path' => APPPATH . '../assets/captcha.ttf',
            'font_size' => 50,
            'img_height' => 65,
            'img_width' => 220,
            'img_path' => 'captcha/',
            'img_url' => base_url('captcha/'),
            'word_length' => 4,
            'pool' => '0123456789',
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
    }

}

?>