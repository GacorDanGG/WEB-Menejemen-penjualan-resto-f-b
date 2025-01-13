<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('main_login');
    }

    public function login_action() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // Panggil fungsi validate_user dengan dua parameter
        $user = $this->Login_model->validate_user($username, $password);

        if ($user) {
            $this->session->set_userdata([
                'username' => $user->username,
                'user_id' => $user->user_id,
                'role' => $user->role
            ]);

            redirect('order_input');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
