<?php

class Customer extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('session');
    }

    private function check_new($id) {
        $check = $this->db->where('ID', $id)->get("PAR_VCIF")->result();
        if (count($check) == 1) {
            $temp = $check[0];
            if (substr($temp->VCIF, 0, 3) == "NC_") {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function get_customer() {
        $param = $this->request->param;
        $rows = Array();
        $hasil = Array();
        if ($param == 'all') {
            $query_string = <<<SQL
SELECT 
  CNAME = o.COMPANY_NAME,
  GNAME = o.GROUP_NAME,
  status_vcif = o.STATUS_VCIF,
  vcif = o.VCIF,
  new = o.NEW,
  par_vcif_id = o.PAR_VCIF_ID
FROM VIEW_CUSTOMER_MAPPING as o
--where o.STATUS_VCIF = 1
GROUP BY o.COMPANY_NAME, o.GROUP_NAME, o.STATUS_VCIF, o.VCIF, o.NEW, o.PAR_VCIF_ID
ORDER BY o.COMPANY_NAME ASC
SQL
            ;
            $rows = $this->db->query($query_string)->result();
        } else if ($param == 'new') {
            $query_string = <<<SQL
SELECT 
  CNAME = o.COMPANY_NAME,
  GNAME = o.GROUP_NAME,
  status_vcif = o.STATUS_VCIF,
  vcif = o.VCIF,
  new = o.NEW,
  par_vcif_id = o.PAR_VCIF_ID
FROM VIEW_CUSTOMER_MAPPING as o
where o.STATUS_VCIF = 1 AND o.NEW = 1
GROUP BY o.COMPANY_NAME, o.GROUP_NAME, o.STATUS_VCIF, o.VCIF, o.NEW, o.PAR_VCIF_ID
ORDER BY o.COMPANY_NAME ASC
SQL
            ;
            $rows = $this->db->query($query_string)->result();
        } else {
            $query_string = <<<SQL
SELECT 
  CNAME = o.COMPANY_NAME,
  GNAME = o.GROUP_NAME,
  status_vcif = o.STATUS_VCIF,
  vcif = o.VCIF,
  new = o.NEW,
  par_vcif_id = o.PAR_VCIF_ID
FROM VIEW_CUSTOMER_MAPPING as o
where o.STATUS_VCIF = 1 AND o.NEW = 0
GROUP BY o.COMPANY_NAME, o.GROUP_NAME, o.STATUS_VCIF, o.VCIF, o.NEW, o.PAR_VCIF_ID
ORDER BY o.COMPANY_NAME ASC
SQL
            ;
            $rows = $this->db->query($query_string)->result();
        }

        foreach ($rows as $key => $row) {
            $row->index = $key + 1;
        };
        $hasil['cust'] = $rows;
        $this->set_output($hasil);
    }

    public function add_customer() {
        $custName = $this->request->cust;
        $group_id = $this->request->group_id;
        $group_name = $this->request->group_name;
        $hasil_group = new stdClass();
        $kembali['error'] = 0;
        if (strlen($custName) < 4) {
            $kembali['error'] = 1;
            $kembali['msg'] = "Nama Customer minimal 4 char";
        }
        if ($group_id == "0") {
            $kembali['error'] = 1;
            $kembali['msg'] = "Group Harus dipilih atau input";
            $this->set_output($kembali);
        } else if ($group_id == "1") {
            if ($group_name == "") {
                $kembali['error'] = 1;
                $kembali['msg'] = "Group Harus dipilih atau input";
                $this->set_output($kembali);
            } else {
                if (strlen($group_name) >= 4) {
                    $hasil_group->id = "0";
                    $hasil_group->nama = $group_name;
                } else {
                    $kembali['error'] = 1;
                    $kembali['msg'] = "Nama Group minimal 4 char";
                }
            }
        } else {
            $res = $this->db
                            ->select("p.ID_GROUP AS id, p.NAMA_GROUP AS nama")
                            ->from('PAR_GROUP p')
                            ->where('p.ID_GROUP', $group_id)
                            ->get()->result();
            $hasil_group->id = $res[0]->id;
            $hasil_group->nama = $res[0]->nama;
        };
        if ($kembali['error'] == 1) {
            $output = $kembali;
        } else {
            $output = $this->customer_model->add_customer($custName, $hasil_group);
        }
        $this->set_output($output);
    }

    public function edit_customer() {
        $id = $this->request->id;
        $nama = $this->request->nama;
        $kembali['error'] = 0;
        $persn = $_SESSION['PERSONAL_NUMBER'];
        if ($this->check_new($id) == 1) {
            $newData = [
                'NAME' => $nama,
            ];
            $getData = $this->db->where('ID', $id)->get('PAR_VCIF')->result_array()[0];
            $this->insertLog($persn, "", "Edit Par VCIF", json_encode($getData), json_encode($newData), "");

            $updateData = $this->db->where('ID', $id)->update('PAR_VCIF', $newData);
            if ($updateData) {
                $kembali['error'] = 0;
            } else {
                $kembali['error'] = 1;
                $kembali['msg'] = "Update Gagal";
            };
        } else {
            $kembali['error'] = 1;
            $kembali['msg'] = "Update Gagal, User Bukan New Customer";
        }
        $this->set_output($kembali);
    }

    public function remove_new_customer() {
        $id = $this->request->id;
        $kembali['error'] = 0;
        $persn = $_SESSION['PERSONAL_NUMBER'];
        if ($this->check_new($id) == 1) {
            $newData = [
                'STATUS_VCIF' => 0,
            ];
            $getData = $this->db->where('id', $id)->where('STATUS_VCIF', 1)->get('PAR_VCIF')->result_array();
            $this->insertLog($persn, "", "delete customer", json_encode($getData), json_encode($newData), "");

            $updateData = $this->db->where('ID', $id)->update('PAR_VCIF', $newData);
            if ($updateData) {
                $kembali['error'] = 0;
            } else {
                $kembali['error'] = 1;
                $kembali['msg'] = "Update Gagal";
            }
        } else {
            $kembali['error'] = 1;
            $kembali['msg'] = "Update Gagal, User Bukan New Customer";
        }
        $this->set_output($kembali);
    }

    public function un_remove_new_customer() {
        $id = $this->request->id;
        $kembali['error'] = 0;
        if ($this->check_new($id) == 1) {
            $newData = [
                'STATUS_VCIF' => 1,
            ];
            $getData = $this->db->where('id', $id)->where('STATUS_VCIF', 0)->get('PAR_VCIF')->result_array()[0];
            $persn = $_SESSION['PERSONAL_NUMBER'];
            $this->insertLog($persn, "", "restore customer", json_encode($getData), json_encode($newData), "");

            $updateData = $this->db->where('ID', $id)->update('PAR_VCIF', $newData);
            if ($updateData) {
                $kembali['error'] = 0;
            } else {
                $kembali['error'] = 1;
                $kembali['msg'] = "Update Gagal";
            }
        } else {
            $kembali['error'] = 1;
            $kembali['msg'] = "Update Gagal, User Bukan New Customer";
        }
        $this->set_output($kembali);
    }

}
