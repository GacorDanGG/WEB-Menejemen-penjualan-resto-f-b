<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_input_model extends CI_Model
{
    // Ambil data semua produk
    public function get_products()
    {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // Ambil detail produk berdasarkan ID
    public function get_product($product_id)
    {
        $query = $this->db->get_where('products', ['product_id' => $product_id]);
        return $query->row_array();
    }

    // Ambil semua order untuk ditampilkan
    public function get_orders()
    {
        $this->db->select('orders.*, users.username');
        $this->db->from('orders');
        $this->db->join('users', 'orders.user_id = users.user_id', 'left');
        $this->db->order_by('orders.order_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Generate nomor order unik
    public function generate_order_number()
    {
        return 'ORD-' . time(); // Format unik menggunakan timestamp
    }

    // Simpan data order
    public function insert_order($order_number, $total_amount, $user_id)
    {
        $data = [
            'order_number' => $order_number,
            'total_amount' => $total_amount,
            'user_id' => $user_id,
            
        ];
        $this->db->insert('orders', $data);
        return $this->db->insert_id(); // Kembalikan ID order yang baru dibuat
    }

    // Simpan item order
    public function insert_order_item($order_id, $item)
    {
        $data = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
        $this->db->insert('order_items', $data);
    }

    // Hapus order berdasarkan ID
    public function delete_order($order_id)
    {
        // Hapus item order terlebih dahulu untuk menjaga integritas referensial
        $this->db->delete('order_items', ['order_id' => $order_id]);
        // Hapus data order
        return $this->db->delete('orders', ['order_id' => $order_id]);
    }
}
?>
