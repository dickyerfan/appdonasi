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

    public function getTransaksi()
    {
        if (isset($_GET['add_post'])){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        }else{
            $bulan = date('m');
            $tahun = date('Y');
        }
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('id_donasi', $id);
        $this->db->order_by('tgl_transaksi');
        return $this->db->get()->result();
    }

    public function getJumatMasuk()
    {
        $bulan = date('m');
        $tahun = date('Y');

        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];

            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->order_by('tgl_transaksi');
            return $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            return $this->db->get()->result();
        }

    }
    public function getJumatKeluar()
    {
        $bulan = date('m');
        $tahun = date('Y');
        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
        $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->order_by('tgl_transaksi');
            return $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            return $this->db->get()->result();
        }
    }

    public function getKeterangan()
    {

        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('tanggal', $tanggal_akhir);
            return $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('status', 0);
            return $this->db->get()->result();
        }
        // return $this->db->get('lap_jumat')->result();
    }

    public function TambahDonasi()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal', true),
            'lokasi' => $this->input->post('lokasi', true),
            'target' => $this->input->post('target', true),
            'distribusi1' => $this->input->post('distribusi1', true),
            'distribusi2' => $this->input->post('distribusi2', true),
            'distribusi3' => $this->input->post('distribusi3', true),
            'donasi1' => $this->input->post('donasi1', true),
            'donasi2' => $this->input->post('donasi2', true),
            'donasi3' => $this->input->post('donasi3', true),
            'donasi4' => $this->input->post('donasi4', true),
            'donasi5' => $this->input->post('donasi5', true)

        ];
        $this->db->insert('lap_jumat', $data);
    }



}
