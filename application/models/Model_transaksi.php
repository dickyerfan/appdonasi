<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_transaksi extends CI_Model
{
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('donasi', 'donasi.id_donasi = transaksi.id_donasi');
        return $this->db->get()->result();
    }

    public function getAllDonasi()
    {
        $table = $this->input->get('nama_donasi');
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        // $table = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $table = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $this->db->select('*');
        $this->db->from($table);
        // $this->db->join('donasi', 'donasi.id_donasi = transaksi.id_donasi');
        $this->db->where('id_transaksi', $id);
        return $this->db->get()->row();
    }

    public function tambahData($table)
    {
        // $table = $this->input->get('nama_donasi');
        // $table = preg_replace("/[^a-zA-Z]/", "", $table);
        // $table = substr($table, 0, 5);
        // $table = strtolower($table);
        $data = [
            // 'id_donasi' => $this->input->post('id_donasi', true),
            'nama_transaksi' => $this->input->post('nama_transaksi', true),
            'jml_transaksi' => $this->input->post('jml_transaksi', true),
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi', true),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_input' => date('Y-m-d H:i:s')
        ];
        $this->db->insert($table, $data);
    }

    public function getIdTransaksi($id)
    {
        $table = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        return $this->db->get_where($table, ['id_transaksi' => $id])->row();
    }

    public function updateData()
    {
        $table = $this->uri->segment(3);
        // $table = $this->input->get('nama_donasi');
        $data = [
            'id_transaksi' => $this->input->post('id_transaksi', true),
            'nama_transaksi' => $this->input->post('nama_transaksi', true),
            'jml_transaksi' => $this->input->post('jml_transaksi', true),
            'tgl_transaksi' => $this->input->post('tgl_transaksi', true),
            'jenis_transaksi' => $this->input->post('jenis_transaksi', true),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_update' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_transaksi', $this->input->post('id_transaksi'));
        $this->db->update($table, $data);
    }

    public function hapusData($id)
    {
        $table = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $this->db->where('id_transaksi', $id);
        $this->db->delete($table);
    }
}
