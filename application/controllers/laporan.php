<?php
// application/controllers/Laporan.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Sales_order_model', 'Auth_model']);
    }

    public function index() {
        $this->cek_role(['admin', 'manager']);

        $filter = [
            'user_id' => $this->input->get('sales_id'),
            'dari'    => $this->input->get('dari'),
            'sampai'  => $this->input->get('sampai'),
            'status'  => $this->input->get('status'),
        ];

        $data['orders']     = $this->Sales_order_model->get_laporan($filter);
        $data['list_sales'] = $this->db->where('role', 'sales')->get('users')->result();
        $data['filter']     = $filter;
        $data['total']      = array_sum(array_column($data['orders'], 'total'));
        $this->render('laporan/index', $data);
    }

    // Halaman cetak PDF (tanpa template sidebar)
    public function cetak() {
        $this->cek_role(['admin', 'manager']);
        $filter = [
            'user_id' => $this->input->get('sales_id'),
            'dari'    => $this->input->get('dari'),
            'sampai'  => $this->input->get('sampai'),
            'status'  => $this->input->get('status'),
        ];
        $data['orders'] = $this->Sales_order_model->get_laporan($filter);
        $data['filter'] = $filter;
        $data['total']  = array_sum(array_column($data['orders'], 'total'));
        $this->load->view('laporan/cetak', $data);
    }
}