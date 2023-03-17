<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_donasiUmum extends CI_Model
{

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->order_by('id_donasi', 'ASC');
        return $this->db->get()->result();
        // return $this->db->get('donasi')->result();
    }

    public function getAllDonasi()
    {

        if (isset($_GET['add_post'])) {
            // $bulan = $this->input->post('bulan', true);
            // $tahun = $this->input->post('tahun', true);
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $id = $this->uri->segment(3);

        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi', 'donasi.id_donasi = transaksi.id_donasi');
        $this->db->where('transaksi.id_donasi', $id);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->order_by('tgl_transaksi');
        return $this->db->get()->result();
    }

    public function getDetailDonasi($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id);
        return $this->db->get()->row();
    }

    public function hapusData($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('transaksi');
    }

    public function getIdTransaksi($id)
    {
        return $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
    }

    public function updateData()
    {
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
        $this->db->update('transaksi', $data);
    }

    public function tambahData()
    {
        $data = [
            'id_donasi' => $this->uri->segment(3),
            'nama_transaksi' => $this->input->post('nama_transaksi', true),
            'jml_transaksi' => $this->input->post('jml_transaksi', true),
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi', true),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_input' => date('Y-m-d H:i:s'),
            'kode_saldo' => 0
        ];
        $this->db->insert('transaksi', $data);
    }

    public function getSaldo()
    {
        $id_donasi = $this->uri->segment(3);
        if (isset($_POST['addSaldo'])) {
            $bulan = $this->input->post('bulan', true);
            $tahun = $this->input->post('tahun', true);
            if ($bulan < 10) {
                $bulan = str_split($bulan)[1];
            }

            return $this->db->query("SELECT * FROM transaksi WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun AND kode_saldo = 1 AND id_donasi = $id_donasi ORDER BY tgl_transaksi")->result();
        } else {
            $bulan = date('m');
            $tahun = date('Y');

            return $this->db->query("SELECT * FROM transaksi WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun AND kode_saldo = 1 AND id_donasi = $id_donasi ORDER BY tgl_transaksi")->result();
        }
    }
}
