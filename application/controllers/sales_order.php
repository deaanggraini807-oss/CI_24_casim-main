<?php
// application/controllers/Sales_order.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Sales_order_model', 'Pelanggan_model', 'Produk_model']);
    }

    public function index() {
        $this->cek_role(['admin', 'sales']);
        $role    = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        $data['orders'] = ($role === 'admin')
            ? $this->Sales_order_model->get_all()
            : $this->Sales_order_model->get_by_user($user_id);

        $this->render('sales_order/index', $data);
    }

    public function tambah() {
        $this->cek_role(['admin', 'sales']);
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $data['produk']    = $this->Produk_model->get_all();
        $this->render('sales_order/form', $data);
    }

    public function simpan() {
        $this->cek_role(['admin', 'sales']);

        $produk_ids = $this->input->post('produk_id');
        $qtys       = $this->input->post('qty');
        $hargas     = $this->input->post('harga');

        if (empty($produk_ids)) {
            $this->session->set_flashdata('error', 'Minimal tambahkan 1 produk.');
            redirect('sales_order/tambah');
        }

        // Hitung total
        $total = 0;
        foreach ($produk_ids as $i => $pid) {
            $total += $qtys[$i] * $hargas[$i];
        }

        // Simpan header SO
        $so_id = $this->Sales_order_model->insert([
            'kode_so'       => $this->Sales_order_model->generate_kode(),
            'pelanggan_id'  => $this->input->post('pelanggan_id'),
            'user_id'       => $this->session->userdata('user_id'),
            'tanggal_order' => date('Y-m-d'),
            'status'        => 'draft',
            'total'         => $total,
            'catatan'       => $this->input->post('catatan', TRUE),
        ]);

        // Simpan detail & kurangi stok
        foreach ($produk_ids as $i => $pid) {
            $this->Sales_order_model->insert_detail([
                'so_id'      => $so_id,
                'produk_id'  => $pid,
                'qty'        => $qtys[$i],
                'harga'      => $hargas[$i],
                'subtotal'   => $qtys[$i] * $hargas[$i],
            ]);
            $this->Produk_model->kurangi_stok($pid, $qtys[$i]);
        }

        $this->session->set_flashdata('success', 'Sales Order berhasil dibuat.');
        redirect('sales_order');
    }

    public function detail($id) {
        $this->cek_role(['admin', 'sales', 'manager']);
        $data['so']     = $this->Sales_order_model->get_by_id($id);
        $data['detail'] = $this->Sales_order_model->get_detail($id);
        if (!$data['so']) show_404();
        $this->render('sales_order/detail', $data);
    }

    public function update_status($id) {
        $this->cek_role(['admin']);
        $status = $this->input->post('status');
        $this->Sales_order_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status berhasil diupdate.');
        redirect('sales_order/detail/' . $id);
    }
}