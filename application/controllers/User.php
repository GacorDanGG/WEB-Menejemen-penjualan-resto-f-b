<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session');

        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    // Menampilkan halaman utama user
    public function main_user() {
        $data['username'] = $this->session->userdata('username');
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user/main_user', $data);
    }

     // Berpindah ke controller Order
     public function order() {
        // Mengambil data orders dari database
        $data['orders'] = $this->Order_model->get_all_orders();

        // Memuat view untuk menampilkan data orders
        $this->load->view('order/main_order', $data);
    }

    public function product() {
        // Mengambil data orders dari database
        $data['products'] = $this->Product_model->get_all_products();

        // Memuat view untuk menampilkan data orders
        $this->load->view('product/main_product', $data);
    }
    // Berpindah ke halaman Reports
    public function reports() {
        $this->load->view('reports');
    }

    // Berpindah ke halaman Omset per bulan
    public function month() {
        $this->load->view('omset/omset_perbulan');
    }

    // Berpindah ke halaman Omset per tahun
    public function year() {
        $this->load->view('omset/omset_pertahun');
    }

    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    // Menambahkan user baru
    public function add_action() {
        $data['username'] = $this->session->userdata('username');
    
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->User_model->add_action([
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role'     => $this->input->post('role'),
            ]);
            $this->session->set_flashdata('message', 'User berhasil ditambahkan.');
            redirect('user/main_user');
        }
    
        $this->load->view('user/add_user', $data);
    }

    // Menghapus user
    public function delete_user($username = null) {
        if ($username === null) {
            $this->session->set_flashdata('error', 'Username tidak diberikan.');
            redirect('user/main_user');
        }

        $username = urldecode($username); // Decode URL username untuk menghindari masalah encoding
    
        if ($this->User_model->hapus_user($username)) {
            $this->session->set_flashdata('message', 'Pengguna berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengguna.');
        }
    
        redirect('user/main_user');
    }

    // Menampilkan form edit user
    public function edit($user_id) {
        $data['user'] = $this->User_model->get_user_by_id($user_id);
    
        if (!$data['user']) {
            show_404();
        }
    
        $this->load->view('user/edit_user', $data);
    }

    // Memproses pembaruan user
    public function edit_action() {
        $user_id = $this->input->post('user_id');
        $update_data = [
            'username' => $this->input->post('username'),
            'role'     => $this->input->post('role'),
        ];
    
        // Update password jika diinputkan
        if (!empty($this->input->post('password'))) {
            $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }
    
        if ($this->User_model->update_user($user_id, $update_data)) {
            $this->session->set_flashdata('message', 'Data user berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data user.');
        }
    
        redirect('user/main_user');
    }

    // Membatalkan tindakan dan kembali ke halaman utama user
    public function batal() {
        redirect('user/main_user');
    }
}
