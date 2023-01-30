<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_donasi extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('donasi')->result();
    }

    // public function tambahData()
    // {
    //     $config['upload_path'] = './assets/photo';
    //     $config['max_size'] = 512;
    //     $config['allowed_types'] = 'jpg|jpeg|png|tiff';

    //     $this->load->library('upload', $config);
    //     if (!$this->upload->do_upload('photo')) {
    //         // echo "Photo Gagal diUpload!";
    //         $photo = 'default.png';
    //     } else {
    //         $photo = $this->upload->data('file_name');
    //     }

    //     $data = [
    //         'nama_donasi' => $this->input->post('nama_donasi', true),
    //         'deskripsi' => $this->input->post('deskripsi', true),
    //         'photo' => $photo
    //     ];
    //     $this->db->insert('donasi', $data);

    //     $table = $this->input->post('nama_donasi');
    //     $table = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table = substr($table, 0, 10);

    //     $table2 = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table2 = substr($table2, 0, 5) . '1';

    //     $query  = "CREATE TABLE IF NOT EXISTS $table (id_transaksi INT(11) AUTO_INCREMENT, ";
    //     $query .= "nama_transaksi VARCHAR(100),";
    //     $query .= "jml_transaksi VARCHAR(100), ";
    //     $query .= "tgl_transaksi DATE, ";
    //     $query .= "jenis_transaksi VARCHAR(100), ";
    //     $query .= "nama_user VARCHAR(100), ";
    //     $query .= "tgl_input DATETIME,";
    //     $query .= "tgl_update DATETIME, PRIMARY KEY (id_transaksi))";
    //     $data = $this->db->query($query);

    //     // if ($this->db->table_exists($table)) {
    //     //     $data = $this->db->query($query);
    //     // } else {
    //     //     $query  = "CREATE TABLE IF NOT EXISTS $table2 (id_transaksi INT(11) AUTO_INCREMENT, ";
    //     //     $query .= "nama_transaksi VARCHAR(100),";
    //     //     $query .= "jml_transaksi VARCHAR(100), ";
    //     //     $query .= "tgl_transaksi DATE, ";
    //     //     $query .= "jenis_transaksi VARCHAR(100), ";
    //     //     $query .= "nama_user VARCHAR(100), ";
    //     //     $query .= "tgl_input DATETIME,";
    //     //     $query .= "tgl_update DATETIME, PRIMARY KEY (id_transaksi))";
    //     //     $data = $this->db->query($query);
    //     // }
    // }

    public function tambahData()
    {
        $foto = $_FILES['photo']['name'];
        if ($foto) {
            $config['upload_path'] = './assets/photo';
            $config['max_size'] = 512;
            $config['allowed_types'] = 'jpg|jpeg|png|tiff';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo')) {
                // echo "Photo Gagal diUpload!";
                $photo = 'default.png';
            } else {
                $photo = $this->upload->data('file_name');
            }
        } else {
            $photo = 'default.png';
        }

        $data = [
            'nama_donasi' => $this->input->post('nama_donasi', true),
            'deskripsi' => $this->input->post('deskripsi', true),
            'photo' => $photo
        ];
        $this->db->insert('donasi', $data);

        // $table = $this->input->post('nama_donasi');
        // $table = preg_replace("/[^a-zA-Z]/", "", $table);
        // $table = substr($table, 0, 10);

        // $query  = "CREATE TABLE IF NOT EXISTS $table (id_transaksi INT(11) AUTO_INCREMENT, ";
        // $query .= "nama_donasi VARCHAR(100),";
        // $query .= "nama_transaksi VARCHAR(100),";
        // $query .= "jml_transaksi VARCHAR(100), ";
        // $query .= "tgl_transaksi DATE, ";
        // $query .= "jenis_transaksi VARCHAR(100), ";
        // $query .= "nama_user VARCHAR(100), ";
        // $query .= "tgl_input DATETIME,";
        // $query .= "tgl_update DATETIME,";
        // $query .= "kode_saldo INT(1), PRIMARY KEY (id_transaksi))";
        // $data = $this->db->query($query);

    }

    public function getIdDonasi($id)
    {
        return $this->db->get_where('donasi', ['id_donasi' => $id])->row();
    }

    public function updateData()
    {
        $foto = $_FILES['photo']['name'];
        if ($foto) {
            $config['upload_path'] = './assets/photo/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 512;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {
                echo $this->upload->display_errors();
            } else {
                $cekFotoLama = $this->db->get_where('donasi', ['id_donasi' => $this->input->post('id_donasi')])->row();

                if ($cekFotoLama->photo != 'default.png') {
                    unlink('assets/photo/' . $cekFotoLama->photo);
                }

                $fotoBaru = $this->upload->data('file_name');
                $donasi['photo'] = $fotoBaru;
            }
        }

        // $donasi['nama_donasi'] = $this->input->post('nama_donasi', true);
        $donasi['deskripsi'] = $this->input->post('deskripsi', true);
        $donasi['status'] = $this->input->post('status', true);

        $this->db->where('id_donasi', $this->input->post('id_donasi'));
        $this->db->update('donasi', $donasi);
    }

    public function hapusData($id)
    {

        $cekFotoLama = $this->db->get_where('donasi', ['id_donasi' => $id])->row();

        if ($cekFotoLama->photo != 'default.png') {
            unlink('assets/photo/' . $cekFotoLama->photo);
        }

        $this->db->where('id_donasi', $id);
        $this->db->delete('donasi');

        // $table = $this->uri->segment(4);
        // $table = preg_replace("/[^a-zA-Z]/", "", $table);
        // $table = substr($table, 0, 10);
        // $table = strtolower($table);
        // $query  = "DROP TABLE IF EXISTS $table ";
        // $this->db->query($query);
    }

    // public function getDetail($id)
    // {
    //     $table = $this->session->userdata('nama_donasi');
    //     $table = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table = substr($table, 0, 5);
    //     $this->db->select('*');
    //     $this->db->from($table);
    //     $this->db->where('id_transaksi', $id);
    //     return $this->db->get()->result();
    // }
}
