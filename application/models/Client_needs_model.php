<?php

class Client_needs_model extends CI_Model {

    private $year_current;
    private $user_id;
    public $vcif;
    public $rows;

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->user_id = $_SESSION['USER_ID'];
        $this->current_time = date('Y-m-d H:i:s');
    }

    public function get($vcif, $year) {


        $this->db->select('*');
        $this->db->from('fundings');
        $this->db->where('vcif', $vcif);
        $this->db->where('data_year', $year);
        $this->db->where('status', 1);
        $result = $this->db->get()->result();

        foreach ($result as $row) {
            $row->nominal_formatted = number_format($row->NOMINAL);
        }

        return $result;
    }

    public function getServices($vcif) {
        if (!empty($vcif)) {
            $getData = $this->db->distinct()
                    ->select('VCIF, DATA_YEAR, SERVICE_NAME, DIVISION_ID')
                    ->from('SERVICES')
                    ->where('VCIF', $vcif)
                    ->where('DATA_YEAR', $this->year_current)
                    ->get();

            if ($getData->num_rows() > 0) {
                foreach ($getData->result() as $srvc) {
                    $serviceData[] = array(
                        'VCIF' => $srvc->VCIF,
                        'DATA_YEAR' => $srvc->DATA_YEAR,
                        'SERVICE_NAME' => $srvc->SERVICE_NAME,
                        'DIVISION_ID' => $srvc->DIVISION_ID
                    );
                }
            } else {
                $serviceData = $getData->result();
            }
        }
        return $serviceData;
    }

    public function save_service($vcif, $rows, $year) {
        $customer_vcif = $vcif;
        $user_id = $_SESSION['USER_ID'];
        $today = new DateTime(date('Y-m-d H:i:s'));
        $addOn = date('Y-m-d H:i:s');
        $this->year_current = $today->format('Y');
        $dataServ = $rows;

        $this->db->where('VCIF', $customer_vcif);
        $this->db->delete('SERVICES');


        foreach ($dataServ as $f) {
            if (!count($f->product_divisi) == 0) {
                for ($i = 0; $i < count($f->product_divisi); $i++) {
                    $servicename = preg_replace('/ +/', ' ', trim($f->nama_service));
                    $query = "INSERT INTO SERVICES (VCIF, SERVICE_NAME, DIVISION_ID, STATUS, DATA_YEAR, ADDON, ADDBY) VALUES ('" . $customer_vcif . "','" . $servicename . "', '" . $f->product_divisi[$i] . "','1','" . $year . "','" . $addOn . "','" . $user_id . "')";
                    $hasil = $this->db->query($query);
                }
            } else {

                $addOn = date('Y-m-d H:i:s');
                $servicename = preg_replace('/ +/', ' ', trim($f->nama_service));

                $query = "INSERT INTO SERVICES (VCIF, SERVICE_NAME, DIVISION_ID, STATUS, DATA_YEAR, ADDON, ADDBY) VALUES ('" . $customer_vcif . "','" . $servicename . "', '" . $f->product_divisi . "','1','" . $year . "','" . $addOn . "','" . $user_id . "')";

                $hasil = $this->db->query($query);
            }
        }
    }

    public function save_funding($vcif, $rows, $year) {
        foreach ($rows as $row) {
            $row->vcif = $vcif;
            $row->addby = $this->user_id;
            $row->addon = $this->current_time;
            $row->data_year = $year;
            $row->status = 1;
        }

        $this->db->trans_start();
        $this->db->from('fundings');
        $this->db->where('vcif', $vcif);
        $this->db->delete();
        $this->db->insert_batch('fundings', $rows);
        $this->db->trans_complete();
    }

}
