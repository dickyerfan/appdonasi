<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_jumat extends CI_Model
{

    public function getAll() 
    {
        $bulan = date('m');
        $tahun = date('Y');

        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];

            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->order_by('tgl_transaksi');
            return $this->db->get()->result();
        }else{
            // $tanggal_awal = $tahun.'-'.$bulan.'-01';
            // $tanggal_akhir = $tahun.'-'.$bulan.'-31';
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->order_by('tgl_transaksi','DESC');
            return $this->db->get()->result();
        }


    }

    public function tambahData()
    {
        $data = [
            'nama_transaksi' => $this->input->post('nama_transaksi', true),
            'jml_transaksi' => $this->input->post('jml_transaksi', true),
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi', true),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_input' => date('Y-m-d H:i:s'),
            'kode_saldo' => 0
        ];
        $this->db->insert('sedekah_jumat', $data);
    }

    public function getDetailDonasi($id)
    {
        $this->db->select('*');
        $this->db->from('sedekah_jumat');
        $this->db->where('id_transaksi', $id);
        return $this->db->get()->row();
    }

    public function hapusData($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('sedekah_jumat');
    }

    public function getIdTransaksi($id)
    {
        return $this->db->get_where('sedekah_jumat', ['id_transaksi' => $id])->row();
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
        $this->db->update('sedekah_jumat', $data);
    }

}
