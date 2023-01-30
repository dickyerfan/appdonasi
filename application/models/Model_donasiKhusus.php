<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_donasiKhusus extends CI_Model
{

    public function getAll()
    {
        // return $this->db->get_where('taqur',['status' => 1])->result();
        return $this->db->get('taqur')->result();
    }

    public function getJoinTaqur()
    {
        $id = $this->uri->segment(3);
        $nama = $this->uri->segment(4);
        $this->db->select('*');
        $this->db->from('taqur');
        $this->db->join('detail_taqur','taqur.id_penabung = detail_taqur.id_penabung');
        $this->db->where('taqur.id_penabung', $id);
        $this->db->where('taqur.nama_penabung', $nama);
        $query = $this->db->get()->result();
        return $query;
    }
    public function getJoinSaldo()
    {
        $id = $this->uri->segment(3);
        $nama = $this->uri->segment(4);
        $this->db->select('sum(jml_tabungan) as totalTabungan');
        $this->db->from('taqur');
        $this->db->join('detail_taqur','taqur.id_penabung = detail_taqur.id_penabung');
        $this->db->where('taqur.id_penabung', $id);
        $this->db->where('taqur.nama_penabung', $nama);
        $this->db->where('detail_taqur.status_tabungan', 1);
        $query = $this->db->get()->result();
        return $query;
    }

    public function tambahData()
    {

        $data = [
            'nama_penabung' => $this->input->post('nama_penabung', true),
            'alamat' => $this->input->post('alamat', true),
            'status' => 1
        ];
        $this->db->insert('taqur', $data);

        // $table = $this->input->post('nama_penabung');
        // $table = preg_replace("/[^a-zA-Z]/", "", $table);
        // $table = substr($table, 0, 10);


        // $query  = "CREATE TABLE IF NOT EXISTS $table (id_transaksi INT(11) AUTO_INCREMENT, ";
        // $query .= "nama_penabung VARCHAR(100), ";
        // $query .= "jml_tabungan VARCHAR(100), ";
        // $query .= "tgl_tabungan DATE, ";
        // $query .= "nama_user VARCHAR(100), ";
        // $query .= "tgl_input DATETIME,";
        // $query .= "tgl_update DATETIME, PRIMARY KEY (id_transaksi))";
        // $data = $this->db->query($query);
    }

    public function getIdTaqur($id)
    {
        return $this->db->get_where('taqur', ['id_penabung' => $id])->row();
        // $id = $this->uri->segment(3);
        // $this->db->select('*');
        // $this->db->from('taqur');
        // $this->db->join('detail_taqur','taqur.id_penabung = detail_taqur.id_penabung');
        // $this->db->where('taqur.id_penabung', $id);
        // $query = $this->db->get()->row();
        // return $query;
    }

    public function updateData()
    {
        // $taqur['nama_penabung'] = $this->input->post('nama_penabung', true);
        // $taqur['alamat'] = $this->input->post('alamat', true);
        $taqur['status'] = $this->input->post('status', true);

        $this->db->where('id_penabung', $this->input->post('id_penabung'));
        $this->db->update('taqur', $taqur);
    }


    public function getDetailTabungan($id)
    {
        $idPenabung = $this->uri->segment(5);
        $idTransaksi = $this->uri->segment(3);
        $nama = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('taqur');
        $this->db->join('detail_taqur','taqur.id_penabung = detail_taqur.id_penabung');
        $this->db->where('taqur.id_penabung', $idPenabung);
        $this->db->where('taqur.nama_penabung', $nama);
        $this->db->where('detail_taqur.id_transaksi', $idTransaksi);
        return $this->db->get()->row();
    }

    public function tambahTabungan()
    {
        $data = [
            'id_penabung' => $this->uri->segment(3),
            'jml_tabungan' => $this->input->post('jml_tabungan', true),
            'tgl_tabungan' => date('Y-m-d'),
            'nama_user' => $this->session->userdata('nama_lengkap'),
            'tgl_input' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('detail_taqur', $data);
    }

    public function hapusTabungan($id)
    {
        $id = $this->uri->segment(3);
        $this->db->where('id_transaksi', $id);
        $this->db->delete('detail_taqur');
    }

    public function getIdTaqurKurang($id)
    {
        // return $this->db->get_where('taqur', ['id_penabung' => $id])->row();
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('taqur');
        $this->db->join('detail_taqur','taqur.id_penabung = detail_taqur.id_penabung');
        $this->db->where('taqur.id_penabung', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function updateTabungan()
    {
        $taqur['status_tabungan'] = $this->input->post('status_tabungan', true);

        $this->db->where('id_penabung', $this->input->post('id_penabung'));
        $this->db->update('detail_taqur', $taqur);
    }

}
