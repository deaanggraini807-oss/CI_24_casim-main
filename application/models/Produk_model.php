<?php
// application/models/Produk_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function get_all() {
        return $this->db->order_by('id','DESC')->get('produk')->result();
    }
    public function get_by_id($id) {
        return $this->db->where('id', $id)->get('produk')->row();
    }
    public function count_all() {
        return $this->db->count_all('produk');
    }
    public function insert($data) {
        return $this->db->insert('produk', $data);
    }
    public function update($id, $data) {
        return $this->db->where('id', $id)->update('produk', $data);
    }
    public function delete($id) {
        return $this->db->where('id', $id)->delete('produk');
    }
    public function kurangi_stok($id, $qty) {
        $this->db->set('stok', 'stok - '.$qty, FALSE)
                 ->where('id', $id)
                 ->update('produk');
    }
}