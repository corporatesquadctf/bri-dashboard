<?php

class Calendar_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->user_id = $_SESSION['USER_ID'];
    }

    public function get_calendar($division) {
        $user_role_id = $this->session->get_userdata()['ROLE_ID'];
        $user_division_id = $this->session->get_userdata()['DIVISION'];

        $unrestricted_role_ids = array(
            USER_ROLE_SUPER_USER
        );

        $user_is_restricted = !in_array($user_role_id, $unrestricted_role_ids);

        $data['user_is_restricted'] = $user_is_restricted;

        $query_string = <<<SQL
SELECT 
  id = 0,
  title = CONCAT('JT.' + RTRIM(o.nama_debitur), ' ', o.rekening),
  desk = '', 
  divisi = '0', 
  start = TGL_JTUH_TEMPO,
  editable = 0,
  allDay = 1
FROM FACT_KREDIT_CPA as o
WHERE TGL_JTUH_TEMPO IS NOT NULL;
SQL
        ;
        $rows = $this->db->query($query_string)->result();
        $rows2 = Array();
        if ($user_is_restricted) {
            $edited_division = '%' . $division . '%';
            $query_string = <<<SQL
SELECT 
  id = o.id,
  title = o.msg,
  desk = o.desk, 
  divisi = o.divisi, 
  add_by = o.ADDBY,
  start = o.tgl,
  editable = 1,
  allDay = 1
FROM CALENDAR as o
WHERE o.divisi LIKE ?;
SQL
            ;
            $rows2 = $this->db->query($query_string, array($edited_division))->result();
        } else {
            $query_string = <<<SQL
SELECT 
  id = o.id,
  title = o.msg,
  desk = o.desk, 
  divisi = o.divisi, 
  add_by = o.ADDBY,
  start = o.tgl,
  editable = 1,
  allDay = 1
FROM CALENDAR as o;
SQL
            ;
            $rows2 = $this->db->query($query_string)->result();
        }
        $rows3 = [];
        foreach ($rows2 as $r) {
            $r->divisi = explode("|", $r->divisi);
            if ($r->add_by == $this->user_id) {
                $r->editable = 1;
            } else {
                $r->editable = 0;
            }
            $rows3[] = $r;
            $rows[] = $r;
        };
        $masterDivisi = $this->db
                        ->select('m.id, m.division_name')
                        ->from('MASTER_DIVISIONS m')
                        ->get()->result();
        $divisiNow = $this->session->get_userdata()['DIVISION'];
        $result = array(
            'data' => $rows,
            'divisi' => $masterDivisi,
            'divisiNow' => $this->session->get_userdata()['DIVISION']
        );
        return $result;
    }

    private function division_to_str($division) {
        $temp_division = "";
        foreach ($division as $key => $divi) {
            if ($key == 0) {
                $temp_division = $temp_division . $divi;
            } else {
                $temp_division = $temp_division . "|" . $divi;
            }
        }
        return $temp_division;
    }

    public function add_calendar($division, $tgl99, $msg, $desk) {
        //ADD to calendar
        $tgl2 = $tgl99->format('Y-m-d H:i:s');
        $tgl = $tgl99->format('Y-m-d');
        $temp_division = $this->division_to_str($division);
        $personaln = $_SESSION['PERSONAL_NUMBER'];
        $newData = [
            'tgl' => $tgl,
            'msg' => $msg,
            'desk' => $desk,
            'divisi' => $temp_division,
            'ADDON' => date('Y-m-d H:i:s'),
            'ADDBY' => $this->user_id
        ];
        $this->insertLog($personaln, "", "Add Calendar", "", json_encode($newData), $msg);
        $updateData = $this->db->insert('CALENDAR', $newData);
        $req = array();
        //Get all user division

        foreach ($division as $divi) {
            $user_id = $this->db->select('id')->where('division_id', $divi)->get('USERS')->result();
            foreach ($user_id as $us) {
                $newData = [
                    'USER_ID' => $us->id,
                    'PT' => "Calendar",
                    'VCIF' => $divi,
                    'COMMENT' => $tgl . " - " . $msg,
                    'ADDON' => date('Y-m-d H:i:s'),
                    'READ' => 0,
                    'ADDBY' => $this->user_id
                ];
                $req[] = $newData;
            };
        }
        $this->db->insert_batch('NOTIFICATION', $req);

        return $user_id;
    }

    public function chg_calendar($division, $id, $msg, $desk) {
        //ADD to calendar
        $personaln = $_SESSION['PERSONAL_NUMBER'];
        $newData = [
            'msg' => $msg,
            'desk' => $desk,
            'MODION' => date('Y-m-d H:i:s'),
            'MODIBY' => $this->user_id
        ];
        $this->insertLog($personaln, "", "Edit Calendar", "", json_encode($newData), $msg);
        $updateData = $this->db->where('id', $id)->update('CALENDAR', $newData);
     
        //Get all user division
        return $updateData;
    }

}
