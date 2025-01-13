<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all_users() {
        return $this->db->get('users')->result_array();
    }

    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row_array();
    }

    public function delete_user($username) {
        $this->db->delete('users', ['username' => $username]);
    }

    public function add_action() {
        $data = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role'     => $this->input->post('role')
        ];

        $this->db->insert('users', $data);
    }

    public function update_user() {
        $data = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role'     => $this->input->post('role')
        ];

        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->update('users', $data);
    }

    public function hapus_user($username) {
        
        $user = $this->db->get_where('users', ['username' => $username])->row();

        if ($user) {
            $user_id = $user->user_id;

            
            $this->db->where('user_id', $user_id);
            $this->db->delete('orders');

            
            $this->db->where('username', $username);
            if ($this->db->delete('users')) {
                
                $this->db->query("ALTER TABLE users AUTO_INCREMENT = 1");

                
                $query = $this->db->query("SELECT MAX(user_id) AS max_id FROM users");
                $row = $query->row();
                if ($row && $row->max_id !== null) {
                    $next_auto_increment = $row->max_id + 1;
                    $this->db->query("ALTER TABLE users AUTO_INCREMENT = $next_auto_increment");
                }
                return true;
            }
        }
        return false;
    }
}
