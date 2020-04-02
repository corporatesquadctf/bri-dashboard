<?php

class Profile extends CI_Controller {

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
        $this->load->model('user_model');
        $this->load->model('master_model');
        /*$this->load->model('accountplanning');
        $this->load->model('notification_model');*/
        //$this->load->database();
    }

    function insertLog($level, $userId, $action, $msg, $old, $new, $exception) {
        $newData = [
            'Level' => $level,
            'LogDate' => date('Y-m-d H:i:s'),
            'CreatedBy' => $userId,
            'Action' => $action,
            'Message' => $msg,
            'OldValue' => $old,
            'NewValue' => $new,
            'Exception' => $exception
        ];
        $updateData = $this->db->insert('LOG', $newData);
    }

    public function index() {
        /*if (!isset($_SESSION)) {
            redirect(base_url().'c_home',refresh);
            die();
        }*/
        $user_id = $_SESSION['PERSONAL_NUMBER'];

        $data['user'] = $this->user_model->get_user_data($user_id);
        $data['divisions'] = $this->master_model->get_divisions();

        $sqlComment ="SELECT A.ProfileStatId, A.Comment, A.CreatedDate, B.Name, B.ProfilePicture, A.UserId
            FROM ProfileStat A
            LEFT JOIN [User] B ON A.UserId=B.UserId
            WHERE A.CreatedDate >= DATEADD(day,-10, GETDATE())
            ORDER BY A.CreatedDate DESC";

        $comments = $this->db->query($sqlComment)->result();

        foreach ($comments as $comment) {

            $sqlTags = "SELECT B.UnitKerjaId, B.Name
                FROM ProfileStatTag A, UnitKerja B
                WHERE A.UnitKerjaId=B.UnitKerjaId
                    AND A.ProfileStatId=".$comment->ProfileStatId;

            $resultTags = $this->db->query($sqlTags)->result();

            $tags = [];
            $nameTag = [];

            foreach ($resultTags as $tag) {
                $tags[] = $tag->UnitKerjaId;
                $nameTag[] = $tag->Name;
            }

            $data['COMMENT'][] = array(
                'PROFILE_PIC' => $comment->ProfilePicture,
                'NAME' => $comment->Name,
                'COM' => $comment->Comment,
                'ADDON' => $comment->CreatedDate,
                'COMS' => $comment->Comment,
                'TAGS' => $tags,
                'NAMETAG' => $nameTag
            );
        }

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog('INFO', $persn, "Get Profile", "", "", "", "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function own() {

        $user_id = $_SESSION['USER_ID'];

        $data['user'] = $this->user_model->get_user_data($user_id);
        $data['divisions'] = $this->master_model->get_divisions();

        //GET COMMENT
        $queryStat = "SELECT DISTINCT A.Comment, A.CreatedDate, B.Name, B.ProfilePicture 
            FROM ProfileStat A 
            LEFT JOIN [User] B ON B.UserId=A.CreatedBy 
            LEFT JOIN ProfileStatTag D ON A.ProfileStatId=D.ProfileStatId
            LEFT JOIN UnitKerja C ON C.UnitKerjaId=D.UnitKerjaId  
            ORDER BY A.CreatedDate DESC";
        $statsCom = $this->db->query($queryStat);
        $data['theStat'] = $statsCom->result();

        //GET DIVISI TAG EVERY COMMENT
        $qComment = "SELECT DISTINCT A.ProfileStatId, A.Comment, A.CreatedDate, B.Name, B.ProfilePicture, A.UserId
            FROM ProfileStat A 
            LEFT JOIN [User] B ON B.UserId=A.UserId
            WHERE A.UserId='".$user_id."'
            ORDER BY A.CreatedDate DESC";
        $resComment = $this->db->query($qComment)->result();
        $totalComment = count($resComment);
        if ($totalComment > 0) {
            foreach ($resComment as $comment) {
                $qTags = "SELECT A.*, B.UnitKerjaId DIVISI_ID, B.Name DIVISION_NAME
                    FROM ProfileStatTag A 
                    LEFT JOIN UnitKerja B ON A.UnitKerjaId=B.UnitKerjaId
                    WHERE A.ProfileStatId=".$comment->ProfileStatId;

                $resTags = $this->db->query($qTags)->result();

                foreach ($resTags as $tag) {
                    $tags[] = $tag->DIVISI_ID;
                    $nameTag[] = $tag->DIVISION_NAME;
                }

                $dataTug = $resTags;

                $data['COMMENT'][] = array(
                    'PROFILE_PIC' => $comment->ProfilePicture,
                    'NAME' => $comment->Name,
                    'COM' => $comment->Comment,
                    'ADDON' => $comment->CreatedDate,
                    'COMS' => $comment->Comment,
                    'TAGS' => $tags,
                    'NAMETAG' => $nameTag
                );

                $tags = array();
                $nameTag = array();
            }
        }

        $persn = $_SESSION['PERSONAL_NUMBER'];
        //$this->insertLog($persn, "", "Get Profile", "", "", "");
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/own.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function mentions() {
        $this->load->database();

        $user_id = $_SESSION['USER_ID'];

        $data['divisions'] = $this->master_model->get_divisions();

        //GET DIVISI TAG EVERY COMMENT

        $sql = "SELECT  A.Comment, A.CreatedDate, B.Name, B.ProfilePicture, A.UserId
            FROM ProfileStat A 
            LEFT JOIN [User] B ON B.UserId=A.UserId
            JOIN ProfileStatTag C ON C.ProfileStatId=A.ProfileStatId 
            WHERE C.UnitKerjaId=".$_SESSION['DIVISION']."
            ORDER BY A.CreatedDate DESC";

        $qComment = $this->db->query($sql);
        $totalComment = count($qComment->result());
        if ($totalComment > 0) {
            foreach ($qComment->result() as $comment) {
                $sql = "SELECT A.*, C.Name DIVISION_NAME
                    FROM ProfileStat A, ProfileStatTag B, UnitKerja C 
                    WHERE A.ProfileStatId=B.ProfileStatId
                        AND B.UnitKerjaId=C.UnitKerjaId
                        AND C.UnitKerjaId=".$_SESSION['DIVISION']."
                        AND A.UserId='".$comment->UserId."'
                    ORDER BY A.CreatedDate DESC";
                $qTags = $this->db->query($sql);
                foreach ($qTags->result() as $tag) {
                    $tags[] = $tag->UnitKerjaId;
                    $nameTag[] = $tag->DIVISION_NAME;
                }

                $dataTug = $qTags->result();

                $data['COMMENT'][] = array(
                    'PROFILE_PIC' => $comment->ProfilePicture,
                    'NAME' => $comment->Name,
                    'COM' => $comment->Comment,
                    'ADDON' => $comment->CreatedDate,
                    'COMS' => $comment->Comment,
                    'TAGS' => $tags,
                    'NAMETAG' => $nameTag
                );

                $tags = array();
                $nameTag = array();
            }
        }

        $persn = $_SESSION['PERSONAL_NUMBER'];
        //$this->insertLog($persn, "", "Get Mention", "", "", "");
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/mention.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function insertNew() {
        $this->load->database();
        $userId = $this->input->post('nama');
        $roleId = $this->input->post('role');
        $comment = $this->input->post('comment');
        $today = date('Y-m-d H:i:s');
        $taging = $this->input->post('tags');

        $persn = $_SESSION['PERSONAL_NUMBER'];
        //$this->insertLog($persn, "", "insertNew Profile", "", json_encode($this->input->post()), "");
        $query = "INSERT INTO ProfileStat(UserId, Comment, CreatedDate, CreatedBy) 
            VALUES('".$userId."', '".$comment."', '".$today."', '".$userId."')";
        $hasil = $this->db->query($query);
        if (!count($taging) == 0) {
            for ($i = 0; $i < count($taging); $i++) {
                $query = "INSERT INTO ProfileStatTag(ProfileStatId, UnitKerjaId)
                    SELECT MAX(ProfileStatId) ProfileStatId, ".$taging[$i]." UnitKerjaId 
                    FROM ProfileStat WHERE UserId='".$userId."'";
                $hasil = $this->db->query($query);
            }
        } /*else {
            $query = "INSERT INTO PROFILE_STAT (COMMENT, USER_ID, ADDON, DIVISI_ID, STATUS) VALUES ('" . $comment . "','" . $userId . "', '" . $today . "','" . $taging . "','1')";
            $hasil = $this->db->query($query);
        }*/
        print_r($hasil);
        die();
    }

    public function updateSetting() {
        $this->load->database();

        $id = $this->input->post('id');
        $mail_korp = $this->input->post('email_corporate');
        $mail = $this->input->post('email_lainnya');
        $phone1 = $this->input->post('phone_number1');
        $today = date('Y-m-d H:i:s');
        $phone2 = $this->input->post('phone_number2');

        if ($id) {
            $upData = [
                // 'id' 	=> $id,
                'email_lainnya' => $mail,
                'email_corporate' => $mail_korp,
                'phone_number1' => $phone1,
                'modion' => $today,
                'phone_number2' => $phone2
            ];

            $getData = $this->db->where('id', $id)->get('USERS')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "updateSetting Profile", json_encode($getData), json_encode($upData), "");
            $updateData = $this->db->where('id', $id)->update('USERS', $upData);
            print_r($updateData);
            die();
        }
    }

    public function tambah() {
        $data = array();

        if ($this->input->post('submit')) {
            $upload = $this->user_model->upload();

            if ($upload['result'] == "success") {
                $this->user_model->save($upload);
                redirect('profile/setting/');
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error'];
            }
        }
    }

    public function task() {

        $user_id = $_SESSION['USER_ID'];

        $data['user'] = $this->user_model->get_user_data($user_id);
        $data['customers'] = $this->user_model->get_customers($user_id);
        $data['tasks'] = $this->user_model->get_tasks($user_id);
        $data['divisions'] = $this->master_model->get_divisions();

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "Get task Profile", "", json_encode($data), "");

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/task.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function setting() {
        $this->load->database();
        $data['divisions'] = $this->master_model->get_divisions();
        $user_id = $_SESSION['USER_ID'];
        $user = $this->user_model->get_user_data($user_id);

        $user->personal_number = $_SESSION['PERSONAL_NUMBER'];
        $user->name = $_SESSION['NAME'];
        $user->unit_organisasi = $_SESSION['UNIT_ORG'];
        $user->corporate_title = $_SESSION['CORP_TITLE'];

        $data['user'] = $user;

        $persn = $_SESSION['PERSONAL_NUMBER'];
        $this->insertLog($persn, "", "Get setting Profile", "", json_encode($data), "");
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/setting.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function src_division() {
        $this->load->database();
        $this->db->select('a.*, b.name MAKER, c.name MODIFIER')
                ->from('MASTER_DIVISIONS a')
                ->join('USERS b', 'b.id = a.ADDBY', 'left')
                ->join('USERS c', 'c.id = a.MODIBY', 'left')
                ->where('a.STATUS', '1');

        $queryData = $this->db->get();
        $data['data'] = $queryData->result();
        json_encode($data);
    }

    public function log() {
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/log.php');
        $this->load->view('layout/footer.php');
    }

    public function APConfirmation() {
        $data['divisions'] = $this->master_model->get_divisions();    
        $user_id = $_SESSION['USER_ID'];
        $data['user'] = $this->user_model->get_user_data($user_id);
        $data['companies_to_check'] = $this->accountplanning->get_checker($user_id);
        $data['companies_to_sign'] = $this->accountplanning->get_signer($user_id);

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/ap_confirmation.php', $data);
        $this->load->view('layout/footer.php');
    }

    //decline checker
    public function declines() {
        $user_id = $_SESSION['USER_ID'];
        $vcif = $this->input->post('vcif');
        $msg = $this->input->post('msg');
        $comp_name = $this->input->post('comp_name');

        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Rejected Account Planning (Checker)", "", $comp_name . " (" . $vcif . ")", $msg);

        if ($vcif) {
            $updateData = $this->accountplanning->change_checker($user_id, $vcif, false, $msg);
            print_r('1');
            die();
        }
    }

    // accept checker
    public function OKb() {
        $user_id = $_SESSION['USER_ID'];
        $vcif = $this->input->post('vcif');
        $oks = $this->input->post('okID');
        $comp_name = $this->input->post('comp_name');
        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Checked Account Planning", "", $comp_name . " (" . $vcif . ")", "");

        if ($vcif) {
            $updateData = $this->accountplanning->change_checker($user_id, $vcif, true, "");
            print_r('1');
            die();
        }
    }

    //dicline signer
    public function DCsigner() {
        $user_id = $_SESSION['USER_ID'];
        $vcif = $this->input->post('vcif');
        $msg = $this->input->post('msg');
        $comp_name = $this->input->post('comp_name');

        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Rejected Account Planning (Signer)", "", $comp_name . " (" . $vcif . ")", $msg);

        if ($vcif) {
            $updateData = $this->accountplanning->change_signer($user_id, $vcif, false, $msg);
            print_r('1');
            die();
        }
    }

    //accept signer
    public function OKsigner() {
        $user_id = $_SESSION['USER_ID'];
        $vcif = $this->input->post('vcif');
        $comp_name = $this->input->post('comp_name');

        $personaln = $_SESSION['PERSONAL_NUMBER'];

        $this->insertLog($personaln, "", "Signed Account Planning", "", $comp_name . " (" . $vcif . ")", "");

        if ($vcif && $user_id) {
            $updateData = $this->accountplanning->change_signer($user_id, $vcif, true, "");
            print_r('1');
            die();
        }
    }

    public function disposisi() {
        $user_id = $_SESSION['USER_ID'];
        $data['user'] = $this->user_model->get_user_data($user_id);
        $data['divisions'] = $this->master_model->get_divisions();
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('profile/tag.php', $data);
        $this->load->view('layout/footer.php');
    }

}

?>