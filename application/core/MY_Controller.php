<?php
// application/core/MY_Controller.php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    protected function cek_login() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    protected function cek_role(array $roles) {
        $this->cek_login();
        if (!in_array($this->session->userdata('role'), $roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        }
    }

    protected function user() {
        return [
            'id'       => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'nama'     => $this->session->userdata('nama'),
            'role'     => $this->session->userdata('role'),
        ];
    }

    // Load view dengan template SB Admin
    protected function render($view, $data = []) {
        $data['user']         = $this->user();
        $data['content_view'] = $view;
        $this->load->view('templates/main', $data);
    }
}