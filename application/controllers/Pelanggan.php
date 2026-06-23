<?php
// application/controllers/Pelanggan.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pelanggan_model');
    }

    public function index() {
        $this->cek_role(['admin']);
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $this->render('pelanggan/index', $data);
    }

    public function tambah() {
        $this->cek_role(['admin']);
        if ($this->input->post()) {
            $this->Pelanggan_model->insert([
                'nama'    => $this->input->post('nama', TRUE),
                'alamat'  => $this->input->post('alamat', TRUE),
                'telepon' => $this->input->post('telepon', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan.');
            redirect('pelanggan');
        }
        $this->render('pelanggan/form', ['pelanggan' => null, 'judul' => 'Tambah Pelanggan']);
    }

    public function edit($id) {
        $this->cek_role(['admin']);
        $pelanggan = $this->Pelanggan_model->get_by_id($id);
        if (!$pelanggan) show_404();

        if ($this->input->post()) {
            $this->Pelanggan_model->update($id, [
                'nama'    => $this->input->post('nama', TRUE),
                'alamat'  => $this->input->post('alamat', TRUE),
                'telepon' => $this->input->post('telepon', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Pelanggan berhasil diupdate.');
            redirect('pelanggan');
        }
        $this->render('pelanggan/form', ['pelanggan' => $pelanggan, 'judul' => 'Edit Pelanggan']);
    }

    public function hapus($id) {
        $this->cek_role(['admin']);
        $this->Pelanggan_model->delete($id);
        $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
        redirect('pelanggan');
    }
}