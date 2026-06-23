<?php
// application/models/Pelanggan_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    public function get_all() {
        return $this->db->order_by('id','DESC')->get('pelanggan')->result();
    }
    public function get_by_id($id) {
        return $this->db->where('id', $id)->get('pelanggan')->row();
    }
    public function count_all() {
        return $this->db->count_all('pelanggan');
    }
    public function insert($data) {
        return $this->db->insert('pelanggan', $data);
    }
    public function update($id, $data) {
        return $this->db->where('id', $id)->update('pelanggan', $data);
    }
    public function delete($id) {
        return $this->db->where('id', $id)->delete('pelanggan');
    }
}