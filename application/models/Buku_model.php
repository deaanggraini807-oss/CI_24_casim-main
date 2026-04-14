<?php
class Buku_model extends CI_Model {

    public function get_all() {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.id_kategori');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('buku', $data);
    }

    public function get_kategori() {
        return $this->db->get('kategori')->result();
    }
}