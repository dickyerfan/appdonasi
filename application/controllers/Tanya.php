<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
    }
    public function detail($id)
    {
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);

        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);

        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $keluar = $this->db->get()->result();
        foreach ($keluar as $row) {
            $keluar = $row->keluar;
        }

        $data['title'] = 'Laporan Donasi';
        $data['donasi'] = $this->Model_laporan->getDetail($id);
        $data['masuk'] = $this->Model_laporan->getMasuk();
        $data['keluar'] = $this->Model_laporan->getKeluar();
        $data['totalMasuk'] = $masuk;
        $data['totalKeluar'] = $keluar;
        $data['saldoLalu'] =
            $data['saldo'] =  $masuk - $keluar;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/laporan_detail', $data);
        $this->load->view('templates/footer');
    }
}
