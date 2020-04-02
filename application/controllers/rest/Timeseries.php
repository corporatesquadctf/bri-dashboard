<?php

class Timeseries extends REST_Controller {
    private $division;
    
    function __construct() {
        parent::__construct();
        $this->load->model('timeseries_model');

        $this->load->library('session');

        $user_role_id = $this->session->get_userdata()['ROLE_ID'];
        $user_division_id = $this->session->get_userdata()['DIVISION'];
        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER,
            USER_ROLE_ADMIN_DIVISI,
            USER_ROLE_ADMIN_PARAMETER,
            USER_ROLE_BOARD
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        if ($user_is_restricted) {
            $this->division = $user_division_id;
            $this->user_is_restricted = true;
        } else {
            $this->division = $this->request->division;
            $this->user_is_restricted = false;
        }
    }

    public function get_data() {
        $start = $this->request->start;
        $end = $this->request->end;
        $division = $this->division;
        $output = $this->timeseries_model->get_data($start,$end, $this->division,$this->user_is_restricted);
        $this->set_output($output);
    }
  }
