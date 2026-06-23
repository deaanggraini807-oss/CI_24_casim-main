<?php
// application/controllers/Dashboard.php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Produk_model', 'Pelanggan_model', 'Sales_order_model']);
    }

    public function index() {
        $this->cek_role(['admin']);
        $data['total_produk']   = $this->Produk_model->count_all();
        $data['total_pelanggan']= $this->Pelanggan_model->count_all();
        $data['total_order']    = $this->Sales_order_model->count_all();
        $data['total_omset']    = $this->Sales_order_model->total_omset();
        $data['order_terbaru']  = $this->Sales_order_model->get_terbaru(5);
        $this->render('dashboard/index', $data);
    }
}