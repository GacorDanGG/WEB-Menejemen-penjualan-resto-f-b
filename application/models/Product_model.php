<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_all_produk() {
        $this->db->select('*'); // Pilih semua kolom termasuk image_url
        $this->db->from('products'); // Tabel produk
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan data sebagai array
    }
    

    // Get product by ID
    public function get_product_by_id($id) {
        $query = $this->db->get_where('products', ['product_id' => $id]);
        return $query->row_array();
    }

    public function insert_product($data) {
        return $this->db->insert('products', $data); // Assuming 'products' is your table name
    }

    public function delete_product($product_id) {
        // Hapus data yang terkait di tabel order_items terlebih dahulu
        $this->db->delete('order_items', ['product_id' => $product_id]);
        
        // Setelah itu hapus produk dari tabel products
        return $this->db->delete('products', ['product_id' => $product_id]);
    }

    public function update_product($id, $data) {
        $this->db->where('product_id', $id); // Gunakan 'product_id' jika itu nama kolomnya
        return $this->db->update('products', $data);
    }    

    // Reset AUTO_INCREMENT
    public function reset_auto_increment() {
        $query = $this->db->query("SELECT MAX(product_id) + 1 AS next_id FROM products");
        $next_auto_increment = $query->row()->next_id ?? 1;
        $this->db->query("ALTER TABLE products AUTO_INCREMENT = $next_auto_increment");
    }
    
}
