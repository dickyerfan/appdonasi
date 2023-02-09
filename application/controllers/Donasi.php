<?php
defined('BASEPATH') or exit('No direct script access allowed');

class donasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_donasi');
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

        $data['title'] = 'Daftar Donasi';
        $data['donasi'] = $this->Model_donasi->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasi/donasi_semua');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Nama Donasi';

        $this->form_validation->set_rules('nama_donasi', 'Nama Donasi', 'required|trim|regex_match[/^[a-zA-Z0-9-\']*$/]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        // $this->form_validation->set_rules('photo', 'Photo', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('regex_match', 'tidak boleh ada spasi, gunakan tanda - sebagai pemisah');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('donasi/donasi_tambah');
            $this->load->view('templates/footer');
        } else {
            $data['tambah'] = $this->Model_donasi->tambahData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width:50%;">
                    <strong>Sukses,</strong> Donasi berhasil di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            helper_log('Tambah Donasi', $this->input->post('nama_donasi'));
            redirect('donasi');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Form Edit Donasi';
        $data['donasi'] = $this->Model_donasi->getIdDonasi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasi/donasi_edit');
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->Model_donasi->updateData();
        if ($this->db->affected_rows() <= 0) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            redirect('donasi');
        } else {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Sukses,</strong> Data Donasi berhasil di update
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            helper_log('Update Donasi', $this->input->post('deskripsi'));
            redirect('donasi');
        }
    }

    public function hapus($id)
    {
        $this->Model_donasi->hapusData($id);
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                    <strong>Sukses,</strong> Donasi berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        helper_log('Hapus Donasi', $this->input->post('nama_donasi'));
        redirect('donasi');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Donasi';
        $data['donasi'] = $this->Model_donasi->getIdDonasi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasi/donasi_detail', $data);
        $this->load->view('templates/footer');
    }
}
