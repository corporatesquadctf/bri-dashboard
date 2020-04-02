<?php

class Relasi_divisi extends REST_Controller {

    function __construct() {
        parent::__construct();
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

    public function get_relasi() {
        $rows = Array();
        $hasil = Array();
        $company = $this->db->distinct()
                ->select('GROUP_ID, GROUP_NAME, VCIF, COMPANY_NAME')
                ->from('VIEW_CUSTOMER_MAPPING');
        $comp = $this->db->get();
        $hasil['company'] = $comp->result();

        $querys = $this->db->distinct()
                ->select('a.*, b.ID, b.DIVISION_NAME, c.GROUP_NAME, c.COMPANY_NAME')
                ->from('RELATION_DIVISI_VCIF a')
                ->join('MASTER_DIVISIONS b', 'b.ID = a.DIV_ID', 'left')
                ->join('VIEW_CUSTOMER_MAPPING c', 'c.VCIF = a.VCIF', 'left')
                ->where('a.STATUS', '1')
                ->order_by('c.COMPANY_NAME', 'asc');
        $divs = $this->db->get()->result();
        foreach ($divs as $key => $d) {
            $d->index = $key + 1;
            $hasil['relDiv'][] = $d;
        }

        $srcdiv = $this->db->distinct()
                ->select('ID, DIVISION_NAME')
                ->from('MASTER_DIVISIONS')
                ->where('STATUS', '1');
        $src = $this->db->get();
        $hasil['src'] = $src->result();
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
        if ($this->check_new($id) == 1) {
            $newData = [
                'NAME' => $nama,
            ];
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
        if ($this->check_new($id) == 1) {
            $newData = [
                'STATUS_VCIF' => 0,
            ];
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
