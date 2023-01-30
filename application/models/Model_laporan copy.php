<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_laporan extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('donasi')->result();
    }

    public function getDetail($id)
    {
        return $this->db->get_where('donasi', ['id_donasi' => $id])->row();
    }

    public function getMasuk()
    {
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);

        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        return $this->db->get()->result();
    }
    public function getKeluar()
    {
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);

        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        return $this->db->get()->result();
    }

    // public function getTotalMasuk()
    // {
    //     $bulan = $this->input->post('bulan', true);
    //     $tahun = $this->input->post('tahun', true);

    //     $table = $this->uri->segment(4);
    //     $table = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table = substr($table, 0, 10);
    //     $table = strtolower($table);
    //     $this->db->select('sum(jml_transaksi) as masuk');
    //     $this->db->from($table);
    //     $this->db->where('MONTH(tgl_transaksi)', $bulan);
    //     $this->db->where('YEAR(tgl_transaksi)', $tahun);
    //     $this->db->where('jenis_transaksi', 'Penerimaan');
    //     return $this->db->get()->result();
    // }

    // public function getTotalKeluar()
    // {
    //     $bulan = $this->input->post('bulan', true);
    //     $tahun = $this->input->post('tahun', true);

    //     $table = $this->uri->segment(4);
    //     $table = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table = substr($table, 0, 10);
    //     $table = strtolower($table);
    //     $this->db->select('sum(jml_transaksi) as keluar');
    //     $this->db->from($table);
    //     $this->db->where('MONTH(tgl_transaksi)', $bulan);
    //     $this->db->where('YEAR(tgl_transaksi)', $tahun);
    //     $this->db->where('jenis_transaksi', 'Pengeluaran');
    //     return $this->db->get()->result();
    // }
}
