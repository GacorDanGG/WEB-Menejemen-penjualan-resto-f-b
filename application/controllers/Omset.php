<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Omset extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Omset_model');
        $this->load->library('session');

        // Pastikan user sudah login
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    // Menampilkan omset per bulan
    public function perbulan() {
        $data['username'] = $this->session->userdata('username');
        $data['omset_perbulan'] = $this->Omset_model->get_omset_perbulan();

        // Periksa role akses di sini, bukan di __construct
        if ($this->session->userdata('role') !== 'owner') {
            $data['access_denied'] = true;
        } else {
            $data['access_denied'] = false;
        }

        $this->load->view('omset/omset_perbulan', $data);
    }

    // Menampilkan omset per tahun
    public function pertahun() {
        $data['username'] = $this->session->userdata('username');
        $data['omset_pertahun'] = $this->Omset_model->get_omset_pertahun();

        // Periksa role akses di sini
        if ($this->session->userdata('role') !== 'owner') {
            $data['access_denied'] = true;
        } else {
            $data['access_denied'] = false;
        }

        $this->load->view('omset/omset_pertahun', $data);
    }
}
