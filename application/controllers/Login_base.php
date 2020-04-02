<?php

abstract class Login_base extends MY_Controller {

    public $captcha_config;

    function __construct() {
        parent::__construct();
        $this->captcha_config = array(
            'expiration' => 7200,
            'font_path' => APPPATH . '../assets/captcha.ttf',
            'font_size' => 36,
            'img_height' => 50,
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
        $this->load->helper(array(
            'form',
            'url',
            'security',
            'captcha'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $this->load->database();
    }

    public function index() {
        $cap = create_captcha($this->captcha_config);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $cap['word']);
        $data['captchaImg'] = $cap['image'];
        $this->load->view('login_index', $data);
    }

    public function refreshCaptcha() {
        $captcha = create_captcha($this->captcha_config);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        echo $captcha['image'];
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('logins');
    }

    protected function getAccess($role_id, $user_id) {
        $result = [
            'PERFORMANCE' => [],
            'REPORT' => [],
            'TASK' => [],
            'DISPOSISI' => [],
            'ADMIN' => [],
            'MASTER' => [],
            'WORKFLOW' => [],
            'LOG' => [],
            'MONITORING' => [],
            'PIPELINE' => [],
            'PORTOFOLIO' => [],
            'APPROVAL' => [],
            'UTILITY' => [],
            'KAJIAN EKONOMI MAKRO' => [],
            'ACCOUNT PLANNING MENENGAH' => [],
            'FTP' => [],
            'DELEGATE' => []
        ];



        /*$this->db->select('ACCESS_ROLES.*, MODULE.MODULE_PATH, MODULE.MODULE_NAME, MODULE.MODULE_TYPE');
        $this->db->from('ACCESS_ROLES');
        $this->db->join('MODULE', 'MODULE.ID = ACCESS_ROLES.MODULE_ID', 'left');
        $this->db->where('ACCESS_ROLES.ROLE_ID', $role_id);
        $this->db->where('MODULE.STATUS', 1);
        $this->db->where('MODULE.ENVIRONMENT', DSC_ENVIRONMENT);*/
        $sql = "SELECT B.[Path] ModulePath, B.ModuleTypeId, B.Name ModuleName
            FROM MapModuleRole A
            JOIN Module B ON A.ModuleId=B.ModuleId AND B.IsActive=1
            WHERE A.RoleId=".$role_id." ORDER BY SortList ASC";
        $query = $this->db->query($sql);
        
        $modules = $query->result();

        foreach ($modules as $module):
            switch ($module->ModuleTypeId):
                case 1:
                    $result['PERFORMANCE'][] = $module;
                    break;
                case 2:
                    $result['REPORT'][] = $module;
                    break;
                case 9:
                    $result['TASK'][] = $module;
                    break;
                case 10:
                    $result['DISPOSISI'][] = $module;
                    break;
                case 3:
                    $result['ADMIN'][] = $module;
                    break;
                case 4:
                    $result['MASTER'][] = $module;
                    break;
                case 5:
                    $result['WORKFLOW'][] = $module;
                    break;
                case 6:
                    $result['MONITORING'][] = $module;
                    break;
                case 7:
                    $result['PIPELINE'][] = $module;
                    break;
                case 8:
                    $result['LOG'][] = $module;
                    break;
                case 11:
                    $result['PORTOFOLIO'][] = $module;
                    break;
                case 12:
                    $result['APPROVAL'][] = $module;
                    break;
                case 15:
                    $result['UTILITY'][] = $module;
                    break;
                case 16:
                    $result['KAJIAN EKONOMI MAKRO'][] = $module;
                    break;
                case 17:
                    $result['ACCOUNT PLANNING MENENGAH'][] = $module;
                    break;
                case 18:
                    $result['FTP'][] = $module;
                    break;
                case 19:
                    $result['DELEGATE'][] = $module;
                    break;
            endswitch;
        endforeach;

        $sql = "SELECT COUNT(1) Jml
            FROM AccountPlanningMember
            WHERE UserId='".$user_id."'";

        $isMember = $this->db->query($sql)->row_array();

        $this->session->isCST = 0;
        if($isMember['Jml'] > 0){
            $sql = "SELECT [Path] ModulePath, ModuleTypeId, Name ModuleName
                FROM Module 
                WHERE ModuleId=".MEMBER_MODULE_ID."
                    AND IsActive=1";

            $memberModule = $this->db->query($sql)->row();
            $result['TASK'][] = $memberModule;
            $this->session->isCST = 1;
        }

        return $result;
    }

}
