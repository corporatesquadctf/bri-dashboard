<?php

class Logins_old extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $this->CI = &get_instance();

        // Load Model
        // $this->load->model('user');
    }

    function index() {
        $this->load->view('login_index');
    }

    function process() {
        $this->load->database();

        $persn = $this->input->post('personalnumber');
        $passw = $this->input->post('password');

        $this->form_validation->set_rules('personalnumber', 'Personal Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_index');
        } else {
            $postedPn = $persn;
            $postedPass = md5($passw);
            $where = array('a.personal_number' => $postedPn, 'a.password' => $postedPass, 'a.status' => '1');

            $this->db->select('a.*, b.token_number, b.expires, c.ROLE_NAME, c.SUBROLE_ID, d.SUBROLE_NAME')
                    ->from('USERS a')
                    ->join('TOKENS b', 'b.ID = a.token_id', 'left')
                    ->join('ROLE c', 'c.ID = a.role_id', 'left')
                    ->join('SUB_ROLE d', 'd.ID = c.ID', 'left')
                    ->where($where);

            $queryData = $this->db->get();
            $data['data'] = $queryData->result();
            $foundData = count($data['data']);

            if ($foundData > 0) {



                foreach ($data['data'] as $k) {

                    $getAccess = $this->getAccess($k->role_id);

                    $session_data = array(
                        'USER_ID' => $k->id,
                        'PERSONAL_NUMBER' => $k->personal_number,
                        'NAME' => $k->name,
                        'OTHER_EMAIL' => $k->email_lainnya,
                        'CORP_EMAIL' => $k->email_corporate,
                        'UNIT_ORG' => $k->unit_organisasi,
                        'CORP_TITLE' => $k->corporate_title,
                        'PHONE_NUM1' => $k->phone_number1,
                        'PHONE_NUM2' => $k->phone_number2,
                        'ROLE_ID' => $k->role_id,
                        'ROLE_NAME' => $k->ROLE_NAME,
                        'SUBROLE_ID' => $k->SUBROLE_ID,
                        'SUBROLE_NAME' => $k->SUBROLE_NAME,
                        'TOKEN_NUM' => $k->token_number,
                        'EXPIRES_IN' => $k->expires,
                        'ADDON' => $k->addon,
                        'MODION' => $k->modion,
                        'ACCESS' => $getAccess,
                        'PROFILE_PIC' => $k->profile_picture,
                        'MODION' => $k->modion,
                        'DIVISION' => $k->division_id
                    );

                    //print_r('<pre>'); print_r(array($session_data)); die();


                    $this->session->set_userdata($session_data);
                }
                //print_r('<pre>'); print_r($session_data); die();
                redirect('profile');
            } else {
                $this->session->set_flashdata('result_login', '<br>You do not have permission to access this site.');

                redirect('logins');
            }
        }
    }

    function getAccess($roleId) {
        $this->load->database();
        $perfModule = array();
        $repModule = array();
        $adminModule = array();
        $masterModule = array();
        $workModule = array();


        $getPerf = $this->db->select('a.*, b.MODULE_PATH, b.MODULE_NAME, b.MODULE_TYPE')
                ->from('ACCESS_ROLES a')
                ->join('MODULE b', 'b.ID = a.MODULE_ID', 'left')
                ->where('a.ROLE_ID', $roleId)
                ->where('b.MODULE_TYPE', 1)
                ->get();

        foreach ($getPerf->result() as $perf) {
            $perfModule[] = array(
                'MODULE_ID' => $perf->ID,
                'MODULE_NAME' => $perf->MODULE_NAME,
                'MODULE_PATH' => $perf->MODULE_PATH
            );
        }

        $getRep = $this->db->select('a.*, b.MODULE_PATH, b.MODULE_NAME, b.MODULE_TYPE')
                ->from('ACCESS_ROLES a')
                ->join('MODULE b', 'b.ID = a.MODULE_ID', 'left')
                ->where('a.ROLE_ID', $roleId)
                ->where('b.MODULE_TYPE', 2)
                ->get();

        foreach ($getRep->result() as $rep) {
            $repModule[] = array(
                'MODULE_ID' => $rep->ID,
                'MODULE_NAME' => $rep->MODULE_NAME,
                'MODULE_PATH' => $rep->MODULE_PATH
            );
        }

        $getAdm = $this->db->select('a.*, b.MODULE_PATH, b.MODULE_NAME, b.MODULE_TYPE')
                ->from('ACCESS_ROLES a')
                ->join('MODULE b', 'b.ID = a.MODULE_ID', 'left')
                ->where('a.ROLE_ID', $roleId)
                ->where('b.MODULE_TYPE', 3)
                ->get();

        foreach ($getAdm->result() as $adm) {
            $adminModule[] = array(
                'MODULE_ID' => $adm->ID,
                'MODULE_NAME' => $adm->MODULE_NAME,
                'MODULE_PATH' => $adm->MODULE_PATH
            );
        }

        $getMas = $this->db->select('a.*, b.MODULE_PATH, b.MODULE_NAME, b.MODULE_TYPE')
                ->from('ACCESS_ROLES a')
                ->join('MODULE b', 'b.ID = a.MODULE_ID', 'left')
                ->where('a.ROLE_ID', $roleId)
                ->where('b.MODULE_TYPE', 4)
                ->get();

        foreach ($getMas->result() as $mast) {
            $masterModule[] = array(
                'MODULE_ID' => $mast->ID,
                'MODULE_NAME' => $mast->MODULE_NAME,
                'MODULE_PATH' => $mast->MODULE_PATH
            );
        }

        $getWork = $this->db->select('a.*, b.MODULE_PATH, b.MODULE_NAME, b.MODULE_TYPE')
                ->from('ACCESS_ROLES a')
                ->join('MODULE b', 'b.ID = a.MODULE_ID', 'left')
                ->where('a.ROLE_ID', $roleId)
                ->where('b.MODULE_TYPE', 5)
                ->get();

        foreach ($getWork->result() as $work) {
            $workModule[] = array(
                'MODULE_ID' => $work->ID,
                'MODULE_NAME' => $work->MODULE_NAME,
                'MODULE_PATH' => $work->MODULE_PATH
            );
        }

        $dataAccess = array(
            'PERFORMANCE' => $perfModule,
            'REPORT' => $repModule,
            'ADMIN' => $adminModule,
            'MASTER' => $masterModule,
            'WORKFLOW' => $workModule
        );

        //print_r('<pre>'); print_r(array($dataAccess)); die();


        return $dataAccess;
    }

    function logout() {
        $this->session->sess_destroy();

        redirect('logins');
    }

}

?>