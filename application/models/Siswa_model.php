<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    private $table = 'siswa';     // tabel database

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()     // ambil data siswa
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)    // ambil data siswa - id
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function save($data)     // simpan data siswa baru
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)    // update data siswa
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)     // hapus data siswa
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function search($keyword)
    {
        $this->db->like('nama', $keyword);
        $this->db->or_like('nis', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get($this->table)->result();
    }
}