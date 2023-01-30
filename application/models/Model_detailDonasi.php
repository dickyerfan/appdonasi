<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_detailDonasi extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('donasi')->result();
    }

    // public function getDetail($id)
    // {
    //     return $this->db->get_where('donasi', ['id_donasi' => $id])->row();
    // }

    public function getAllDonasi()
    {
        
        if (isset($_GET['add_post'])){
            // $bulan = $this->input->post('bulan', true);
            // $tahun = $this->input->post('tahun', true);
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        }else{
            $bulan = date('m');
            $tahun = date('Y');
        }

        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->order_by('tgl_transaksi');
        return $this->db->get()->result();
    }

    public function getDetailDonasi($id)
    {
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id_transaksi', $id);
        return $this->db->get()->row();
    }

    public function hapusData($id)
    {
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $id = $this->uri->segment(3);
        $this->db->where('id_transaksi', $id);
        $this->db->delete($table);
    }

    public function getIdTransaksi($id)
    {
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $id = $this->uri->segment(3);
        return $this->db->get_where($table, ['id_transaksi' => $id])->row();
    }

    public function updateData()
    {
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
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

    public function tambahData($table)
    {
        $data = [
            'nama_donasi' => $this->uri->segment(4),
            'nama_transaksi' => $this->input->post('nama_transaksi', true),
            'jml_transaksi' => $this->input->post('jml_transaksi', true),
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi', true),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_input' => date('Y-m-d H:i:s'),
            'kode_saldo' => 0
        ];
        $this->db->insert($table, $data);
    }

    public function getSaldo()
    {
            if(isset($_POST['addSaldo'])){
                $bulan = $this->input->post('bulan', true);
                $tahun = $this->input->post('tahun', true);
                if ($bulan < 10) {
                    $bulan = str_split($bulan)[1];
                }
            $table = $this->uri->segment(4);
            $table = preg_replace("/[^a-zA-Z]/", "", $table);
            $table = substr($table, 0, 10);
            $table = strtolower($table);
            return $this->db->query("SELECT * FROM $table WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun AND kode_saldo = 1 ORDER BY tgl_transaksi")->result();
        }else{
            $bulan = date('m');
            $tahun = date('Y');

            $table = $this->uri->segment(4);
            $table = preg_replace("/[^a-zA-Z]/", "", $table);
            $table = substr($table, 0, 10);
            $table = strtolower($table);
            return $this->db->query("SELECT * FROM $table WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun AND kode_saldo = 1 ORDER BY tgl_transaksi")->result();
        }
    }
}
