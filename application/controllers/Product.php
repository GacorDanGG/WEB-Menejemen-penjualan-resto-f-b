<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model'); // Load Product Model
        $this->load->helper(['url', 'form']); // Load URL and Form helper
        $this->load->library(['session', 'form_validation', 'upload']); // Load session, form_validation, and upload library

        // Ensure the user is logged in
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    // Display all products
    public function index() {
        $data['username'] = $this->session->userdata('username');  // Get username from session
        $data['product'] = $this->Product_model->get_all_produk();  // Get all products including image_url
    
        // Load the view to display the product list
        $this->load->view('product/main_product', $data);
    }    

     // Display the add product form
     public function add_product() {
        $this->load->view('product/add_product');
    }

    // Handle the add product action
    public function add_action() {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        // If validation fails, reload the add product page
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('product/add_product');
        } else {
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $image = $_FILES['image'];

            // Folder path for upload (Absolute path to folder outside 'application')
            $target_dir = FCPATH . 'assets/uploads/'; // Absolute path ke folder uploads
            $target_file = $target_dir . basename($image["name"]); // Path penuh untuk file
            $relative_path = 'assets/uploads/' . basename($image["name"]); // Path relatif untuk database
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            // Validate if the file is an image
            $check = getimagesize($image["tmp_name"]);
            if ($check === false) {
                $data['error'] = "File is not an image.";
                $this->load->view('product/add_product', $data);
                return;
            }

            // Validate file extension
            if (!in_array($imageFileType, $allowed_types)) {
                $data['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $this->load->view('product/add_product', $data);
                return;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $data['error'] = "Sorry, file already exists.";
                $this->load->view('product/add_product', $data);
                return;
            }

            // Move the uploaded file
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                // Simpan path relatif ke database
                $data = [
                    'name' => $name,
                    'price' => $price,
                    'image_url' => $relative_path
                ];
            
                if ($this->Product_model->insert_product($data)) {
                    $this->session->set_flashdata('message', 'Product successfully added!');
                    redirect('product/main_product');
                } else {
                    $data['error'] = 'Failed to save product data.';
                    $this->load->view('product/add_product', $data);
                }
            } else {
                $data['error'] = "Failed to upload the file. Please check the folder path or permissions.";
                $this->load->view('product/add_product', $data);
            }            
        }
    }

    public function hapus($product_id) {
        $product_id = intval($product_id); // Validasi ID sebagai integer

        // Ambil data produk berdasarkan ID
        $product = $this->Product_model->get_product_by_id($product_id);

        if (!$product) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            redirect('product');
        }

        // Hapus file gambar jika ada
        if (!empty($product['image_url']) && file_exists(FCPATH . $product['image_url'])) {
            unlink(FCPATH . $product['image_url']);
        }

        // Hapus data produk
        if ($this->Product_model->delete_product($product_id)) {
            $this->Product_model->reset_auto_increment();
            $this->session->set_flashdata('message', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk.');
        }

        redirect('product');
    }

    public function update() {
        $id = $this->input->post('id');
        
        // Validasi form
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->Product_model->get_product_by_id($id);
            $this->load->view('product/edit_product', $data);
        } else {
            $product_data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
            ];
    
            // Proses upload file jika ada file gambar baru
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    // Hapus gambar lama jika ada
                    $old_image = $this->input->post('old_image');
                    if ($old_image && file_exists(FCPATH . $old_image)) {
                        unlink(FCPATH . $old_image);
                    }
    
                    $upload_data = $this->upload->data();
                    $product_data['image_url'] = 'assets/uploads/' . $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('product/edit/' . $id);
                    return;
                }
            }
    
            // Update data produk di database
            if ($this->Product_model->update_product($id, $product_data)) {
                $this->session->set_flashdata('success', 'Product updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update the product.');
            }
    
            redirect('product');
        }
    }    

    public function edit($id) {
        $data['product'] = $this->Product_model->get_product_by_id($id); // Gunakan nama model yang benar
        if (!$data['product']) {
            show_404();
        }
        $this->load->view('product/edit_product', $data); // Pastikan path view benar
    }

    public function edit_action() {
        $id = $this->input->post('id');
        
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->Product_model->get_product_by_id($id);
            $this->load->view('product/edit_product', $data);
        } else {
            $product_data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
            ];
    
            // Process file upload if a new image is provided
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                // Folder path for upload (Absolute path to folder outside 'application')
                $target_dir = FCPATH . 'assets/uploads/';
                $target_file = $target_dir . basename($image["name"]); // Full path for the file
                $relative_path = 'assets/uploads/' . basename($image["name"]); // Relative path for the database
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    
                // Validate if the file is an image
                $check = getimagesize($image["tmp_name"]);
                if ($check === false) {
                    $data['error'] = "File is not an image.";
                    $data['product'] = $this->Product_model->get_product_by_id($id);
                    $this->load->view('product/edit_product', $data);
                    return;
                }
    
                // Validate file extension
                if (!in_array($imageFileType, $allowed_types)) {
                    $data['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $data['product'] = $this->Product_model->get_product_by_id($id);
                    $this->load->view('product/edit_product', $data);
                    return;
                }
    
                // Check if file already exists
                if (file_exists($target_file)) {
                    $data['error'] = "Sorry, file already exists.";
                    $data['product'] = $this->Product_model->get_product_by_id($id);
                    $this->load->view('product/edit_product', $data);
                    return;
                }
    
                // Move the uploaded file
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    // Delete the old image if it exists
                    $old_image = $this->input->post('old_image');
                    if ($old_image && file_exists(FCPATH . $old_image)) {
                        unlink(FCPATH . $old_image);
                    }
    
                    $product_data['image_url'] = $relative_path; // Set the new image URL
                } else {
                    $data['error'] = "Failed to upload the file. Please check the folder path or permissions.";
                    $data['product'] = $this->Product_model->get_product_by_id($id);
                    $this->load->view('product/edit_product', $data);
                    return;
                }
            }
    
            // Update product data in the database
            if ($this->Product_model->update_product($id, $product_data)) {
                $this->session->set_flashdata('success', 'Product updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update the product.');
            }
    
            redirect('product/main_product');
        }
    }   
           
}
