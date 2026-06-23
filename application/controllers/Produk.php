<?php
// application/controllers/Produk.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index() {
        $this->cek_role(['admin']);
        $data['produk'] = $this->Produk_model->get_all();
        $this->render('produk/index', $data);
    }

    public function tambah() {
        $this->cek_role(['admin']);
        if ($this->input->post()) {
            $this->Produk_model->insert([
                'kode_produk'  => $this->input->post('kode_produk', TRUE),
                'nama_produk'  => $this->input->post('nama_produk', TRUE),
                'harga'        => $this->input->post('harga'),
                'stok'         => $this->input->post('stok'),
                'keterangan'   => $this->input->post('keterangan', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            redirect('produk');
        }
        $this->render('produk/form', ['produk' => null, 'judul' => 'Tambah Produk']);
    }

    public function edit($id) {
        $this->cek_role(['admin']);
        $produk = $this->Produk_model->get_by_id($id);
        if (!$produk) show_404();

        if ($this->input->post()) {
            $this->Produk_model->update($id, [
                'kode_produk'  => $this->input->post('kode_produk', TRUE),
                'nama_produk'  => $this->input->post('nama_produk', TRUE),
                'harga'        => $this->input->post('harga'),
                'stok'         => $this->input->post('stok'),
                'keterangan'   => $this->input->post('keterangan', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Produk berhasil diupdate.');
            redirect('produk');
        }
        $this->render('produk/form', ['produk' => $produk, 'judul' => 'Edit Produk']);
    }

    public function hapus($id) {
        $this->cek_role(['admin']);
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('produk');
    }
}