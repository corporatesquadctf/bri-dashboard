<?php

class Calendar extends REST_Controller {

    private $division;

    function __construct() {
        parent::__construct();
        $this->load->model('calendar_model');

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
        } else {
            $this->division = $user_division_id;
        }
    }

    public function get_calendar() {
        $output = $this->calendar_model->get_calendar($this->division);
        $this->set_output($output);
    }

    public function add_calendar() {
        $tgl = new DateTime($this->request->tgl);
        $msg = $this->request->msg;
        $desk = $this->request->desc;
        $divisi = $this->request->divisi;
        if ($divisi == 0) {
            $divisi = $this->division;
        }

        $output = $this->calendar_model->add_calendar($divisi, $tgl, $msg, $desk);
        $this->set_output($output);
    }

    public function chg_calendar() {
        $id = $this->request->id;
        $msg = $this->request->msg;
        $desk = $this->request->desc;
        $divisi = $this->request->divisi;
        if ($divisi == 0) {
            $divisi = $this->division;
        }
        $output = $this->calendar_model->chg_calendar($divisi, $id, $msg, $desk);
        $this->set_output($output);
    }

}
