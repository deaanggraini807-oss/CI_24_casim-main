<?php
// application/controllers/Auth.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login() {
        // Sudah login → langsung redirect
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
        }

        if ($this->input->post()) {
            $nama     = $this->input->post('nama', TRUE);
            $password = $this->input->post('password');

            $user = $this->Auth_model->login($nama, $password);

            if ($user) {
                // Simpan session
                $this->session->set_userdata([
                    'logged_in' => TRUE,
                    'user_id'   => $user->id,
                    'username'  => $user->username,
                    'nama'      => $user->nama,
                    'role'      => $user->role,
                ]);

                // Update last_login
                $this->db->where('id', $user->id)
                         ->update('users', ['last_login' => date('Y-m-d H:i:s')]);

                $this->_redirect_by_role($user->role);
            } else {
                $this->session->set_flashdata('error', 'Nama atau password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    private function _redirect_by_role($role) {
        switch ($role) {
            case 'admin':   redirect('dashboard');    break;
            case 'sales':   redirect('sales_order');  break;
            case 'manager': redirect('laporan');      break;
            default:        redirect('auth/login');
        }
    }
}