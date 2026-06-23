<?php
// application/models/Sales_order_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order_model extends CI_Model {

    // Ambil semua SO dengan join pelanggan & user
    public function get_all() {
        return $this->db
            ->select('so.*, p.nama as nama_pelanggan, u.nama as nama_sales')
            ->from('sales_order so')
            ->join('pelanggan p', 'p.id = so.pelanggan_id', 'left')
            ->join('users u', 'u.id = so.user_id', 'left')
            ->order_by('so.id', 'DESC')
            ->get()->result();
    }

    // Hanya SO milik sales tertentu
    public function get_by_user($user_id) {
        return $this->db
            ->select('so.*, p.nama as nama_pelanggan, u.nama as nama_sales')
            ->from('sales_order so')
            ->join('pelanggan p', 'p.id = so.pelanggan_id', 'left')
            ->join('users u', 'u.id = so.user_id', 'left')
            ->where('so.user_id', $user_id)
            ->order_by('so.id', 'DESC')
            ->get()->result();
    }

    public function get_by_id($id) {
        return $this->db
            ->select('so.*, p.nama as nama_pelanggan, u.nama as nama_sales')
            ->from('sales_order so')
            ->join('pelanggan p', 'p.id = so.pelanggan_id', 'left')
            ->join('users u', 'u.id = so.user_id', 'left')
            ->where('so.id', $id)
            ->get()->row();
    }

    public function get_detail($so_id) {
        return $this->db
            ->select('sod.*, pr.nama_produk, pr.harga')
            ->from('sales_order_detail sod')
            ->join('produk pr', 'pr.id = sod.produk_id', 'left')
            ->where('sod.so_id', $so_id)
            ->get()->result();
    }

    public function insert($data) {
        $this->db->insert('sales_order', $data);
        return $this->db->insert_id();
    }

    public function insert_detail($data) {
        return $this->db->insert('sales_order_detail', $data);
    }

    public function update_status($id, $status) {
        return $this->db->where('id', $id)->update('sales_order', ['status' => $status]);
    }

    public function count_all() {
        return $this->db->count_all('sales_order');
    }

    public function total_omset() {
        $result = $this->db->select_sum('total')->where('status', 'selesai')->get('sales_order')->row();
        return $result->total ?? 0;
    }

    public function get_terbaru($limit = 5) {
        return $this->db
            ->select('so.*, p.nama as nama_pelanggan, u.nama as nama_sales')
            ->from('sales_order so')
            ->join('pelanggan p', 'p.id = so.pelanggan_id', 'left')
            ->join('users u', 'u.id = so.user_id', 'left')
            ->order_by('so.id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    // Laporan filter
    public function get_laporan($filter = []) {
        $this->db
            ->select('so.*, p.nama as nama_pelanggan, u.nama as nama_sales')
            ->from('sales_order so')
            ->join('pelanggan p', 'p.id = so.pelanggan_id', 'left')
            ->join('users u', 'u.id = so.user_id', 'left');

        if (!empty($filter['user_id']))    $this->db->where('so.user_id', $filter['user_id']);
        if (!empty($filter['dari']))       $this->db->where('so.tanggal_order >=', $filter['dari']);
        if (!empty($filter['sampai']))     $this->db->where('so.tanggal_order <=', $filter['sampai']);
        if (!empty($filter['status']))     $this->db->where('so.status', $filter['status']);

        return $this->db->order_by('so.id','DESC')->get()->result();
    }

    // Generate kode SO unik
    public function generate_kode() {
        $prefix = 'SO-' . date('Ymd') . '-';
        $last = $this->db->like('kode_so', $prefix, 'after')
                         ->order_by('id','DESC')
                         ->limit(1)
                         ->get('sales_order')->row();
        $num = $last ? (intval(substr($last->kode_so, -4)) + 1) : 1;
        return $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}