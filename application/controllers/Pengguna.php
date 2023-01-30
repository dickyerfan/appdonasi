<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dashboard');
    }

    public function index()
    {
        if ($this->session->userdata('level') != 'Pengguna') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Pengguna...
                      </div>'
            );
            redirect('auth');
        }
        $data['title'] = 'Dashboard';
        $data['dashboard'] = $this->Model_dashboard->getAll();

        $this->load->view('templatePengguna/header', $data);
        $this->load->view('templatePengguna/navbar');
        $this->load->view('templatePengguna/sidebar');
        $this->load->view('pengguna/pengguna', $data);
        $this->load->view('templatePengguna/footer');
    }

    public function detail($id)
    {
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);

        $masuk = $this->db->query("SELECT sum(jml_transaksi) as masuk FROM $table WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0");
        foreach ($masuk->result() as $row) {
            // echo $row->masuk;
            $masuk = $row->masuk;
        }

        $keluar = $this->db->query("SELECT sum(jml_transaksi) as keluar FROM $table WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0");
        foreach ($keluar->result() as $row) {
            // echo $row->keluar;
            $keluar = $row->keluar;
        }
        $saldo = $masuk - $keluar;

        $data['masuk'] = $masuk;
        $data['keluar'] = $keluar;
        $data['saldo'] = $saldo;


        $data['title'] = 'Donasi';
        $data['donasi'] = $this->Model_dashboard->getDetail($id);
        $data['gambar'] = $this->Model_dashboard->getGambar($id);
        $this->load->view('templatePengguna/header', $data);
        $this->load->view('templatePengguna/navbar');
        $this->load->view('templatePengguna/sidebar');
        $this->load->view('pengguna/pengguna_detail', $data);
        $this->load->view('templatePengguna/footer');
    }
}
