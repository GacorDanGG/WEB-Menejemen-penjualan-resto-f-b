<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Omset_model extends CI_Model {

    public function get_omset_perbulan() {
        $query = $this->db->query("
            SELECT DATE_FORMAT(order_date, '%Y-%m') AS bulan, 
                   SUM(total_amount) AS total_omset 
            FROM orders 
            GROUP BY DATE_FORMAT(order_date, '%Y-%m') 
            ORDER BY bulan
        ");
        return $query->result_array();
    }

    public function get_omset_pertahun() {
        $this->db->select('YEAR(order_date) AS tahun, SUM(total_amount) AS total_omset');
        $this->db->from('orders');
        $this->db->group_by('YEAR(order_date)');
        $this->db->order_by('tahun', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
