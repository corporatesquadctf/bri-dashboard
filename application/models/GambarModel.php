<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GambarModel extends CI_Model {

    // Fungsi untuk menampilkan semua data gambar
    public function view() {

        $this->db->where('VCIF', 'XYZ');
        $q = $this->db->get('STRUCTURE')->result();
    }

    // Fungsi untuk melakukan proses upload file
    public function upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '5000';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('input_gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    // Fungsi untuk menyimpan data ke database
    public function save($upload, $year) {

        $today = date('Y-m-d H:i:s');
        $persn = $_SESSION['PERSONAL_NUMBER'];
        $data = array(
            // 'deskripsi'=>$this->input->post('input_deskripsi'),
            // 'nama_file' => $upload['file']['file_name'],
            // 'ukuran_file' => $upload['file']['file_size'],
            // 'tipe_file' => $upload['file']['file_type']
            'VCIF' => $this->input->post('VCIF'),
            'TITLE' => $this->input->post('TITLE'),
            'ADDON' => $today,
            'ADDBY' => $persn,
            'YEAR' => $year,
            'PATH' => $upload['file']['file_name'],
            'SIZE' => $upload['file']['file_size'],
            'TYPE' => $upload['file']['file_type']
        );

        $this->db->insert('STRUCTURE', $data);
    }

}
