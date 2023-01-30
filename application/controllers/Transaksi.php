<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_transaksi');
        $this->load->library('form_validation');

        if ($this->session->userdata('level') == 'Pengguna') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Admin...
                      </div>'
            );
            redirect('auth');
        }elseif(!$this->session->userdata('level')){
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login... 
                      </div>'
            );
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Transaksi';
        $data['transaksi'] = $this->Model_transaksi->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_semua', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $title = $this->input->get('nama_donasi');
        // $lokasi = $this->input->get('nama_donasi');
        // $title = $this->uri->segment(3);
        $table = $this->uri->segment(3);
        $data['title'] = 'Tambah Transaksi ' . $title;
        $data['donasi'] = $this->db->get('donasi')->result();
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'required|trim');
        $this->form_validation->set_rules('jml_transaksi', 'Jumlah Transaksi', 'required|trim|is_natural');
        $this->form_validation->set_rules('jenis_transaksi', 'Jenis Transaksi', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('is_natural', '%s harus inputan angka tanpa titik dan koma');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('transaksi/transaksi_tambah');
            $this->load->view('templates/footer');
        } else {
            $title = $this->uri->segment(4);
            $title = preg_replace("/[^a-zA-Z]/", " ", $title);
            $this->Model_transaksi->tambahData($table);
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> data ' . $title . ' berhasil di tambah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            redirect('transaksi/pilih');
        }
    }

    public function edit($id)
    {

        $data['title'] = 'Form Edit Transaksi';
        $data['donasi'] = $this->db->get('donasi')->result();
        $data['transaksi'] = $this->Model_transaksi->getIdTransaksi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_edit');
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $title = $this->uri->segment(4);
        $title = preg_replace("/[^a-zA-Z]/", " ", $title);
        $this->Model_transaksi->updateData();
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> data ' . $title . ' berhasil di Update 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('transaksi/pilih');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Model_transaksi->getDetail($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_detail', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $title = $this->uri->segment(5);
        $title = preg_replace("/[^a-zA-Z]/", " ", $title);
        $this->Model_transaksi->hapusData($id);
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Data ' . $title . ' berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('transaksi/pilih');
    }

    public function pilih()
    {
        $data['title'] = 'Pilih Transaksi/Donasi';
        $data['donasi'] = $this->db->get('donasi')->result();
        // $data['transaksi'] = $this->Model_transaksi->inputData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_pilih', $data);
        $this->load->view('templates/footer');
    }
    public function donasi()
    {
        $title = $this->input->get('nama_donasi');
        $data['title'] = 'Donasi ' . $title;
        // $data['donasi1'] = $this->db->get('donasi')->result();
        $data['donasi'] = $this->Model_transaksi->getAllDonasi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_donasi', $data);
        $this->load->view('templates/footer');
    }

    public function entry()
    {

        $data['title'] = 'Input Transaksi';
        $data['donasi'] = $this->db->get('donasi')->result();
        // $data['transaksi'] = $this->Model_transaksi->tambahData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('transaksi/transaksi_entry', $data);
        $this->load->view('templates/footer');
    }
}
