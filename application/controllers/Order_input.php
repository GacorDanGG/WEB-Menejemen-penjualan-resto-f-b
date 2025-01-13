<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_input extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_input_model'); // Load the model
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Method untuk menampilkan daftar order dan produk
    public function index()
    {
        // Periksa apakah user telah login
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        // Ambil data produk untuk ditampilkan
        $data['products'] = $this->Order_input_model->get_products();

        // Ambil data semua order
        $data['orders'] = $this->Order_input_model->get_orders();

        // Load view dengan data
        $this->load->view('order/main_order', $data);
    }

    public function add_order()
{
    // Periksa apakah user telah login
    if (!$this->session->userdata('username')) {
        redirect('login');
    }

    if ($this->input->post()) {
        // Jika form disubmit, proses data
        $user_id = $this->session->userdata('user_id');
        $total_amount = 0;
        $order_items = [];

        // Loop untuk setiap produk yang diinputkan
        foreach ($this->input->post('product_id') as $product_id) {
            $quantity = $this->input->post('quantity')[$product_id];

            if ($quantity > 0) {
                // Ambil detail produk
                $product = $this->Order_input_model->get_product($product_id);
                $subtotal = $product['price'] * $quantity;
                $total_amount += $subtotal;

                // Siapkan data item order
                $order_items[] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'price' => $product['price']
                ];
            }
        }

        // Buat data order
        $order_number = $this->Order_input_model->generate_order_number();
        $order_id = $this->Order_input_model->insert_order($order_number, $total_amount, $user_id);

        // Tambahkan item order ke database
        foreach ($order_items as $item) {
            $this->Order_input_model->insert_order_item($order_id, $item);
        }

        // Redirect ke halaman utama setelah berhasil
        redirect('http://localhost/fp_ggmu/index.php/order_input'); // Perubahan URL sesuai permintaan
    } else {
        // Jika tidak, tampilkan form tambah order
        $data['products'] = $this->Order_input_model->get_products();
        $this->load->view('order/add_order', $data);
    }
}

    // Method untuk menghapus order
    public function delete($order_id)
    {
        if ($this->Order_input_model->delete_order($order_id)) {
            redirect('order_input');  // Redirect kembali ke halaman utama
        } else {
            show_error('Error deleting order');
        }
    }
}
?>
