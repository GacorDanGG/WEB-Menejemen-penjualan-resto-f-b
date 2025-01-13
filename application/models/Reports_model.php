<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_reports() {
        $query = $this->db->get('order_items'); // Ganti dengan nama tabel Anda
        return $query->result_array();
    }
}
