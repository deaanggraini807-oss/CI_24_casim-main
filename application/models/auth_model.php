<?php
// application/models/Auth_model.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    // Login menggunakan kolom 'nama' dan 'password'
    public function login($nama, $password) {
        $user = $this->db
            ->where('nama', $nama)
            ->get('users')
            ->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}