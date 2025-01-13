<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reports_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['reports'] = $this->Reports_model->get_all_reports();
        $this->load->view('reports', $data);
    }
}
