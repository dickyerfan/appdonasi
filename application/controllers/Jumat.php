<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jumat extends CI_Controller
{
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('Model_jumat');
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
        $data['jumat'] = $this->Model_jumat->getAll();
        $data['title'] = 'DAFTAR SEDEKAH JUM\'AT';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jumat/jumat_view');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = 'Tambah Transaksi ';
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
            $this->load->view('jumat/tambah_view',$data);
            $this->load->view('templates/footer');
        } else {
            $this->Model_jumat->tambahData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Sedekah Jum\'at berhasil di tambah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            helper_log('Tambah Data di Sedekah Jum\'at', $this->input->post('nama_transaksi').' | '.$this->input->post('jml_transaksi').' | '.date('Y-m-d'));
            redirect('jumat');
        }
    }

    public function rinci($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Model_jumat->getDetailDonasi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jumat/rinci_view', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $id_transaksi = $this->uri->segment(4);
        helper_log('Hapus Data di Sedekah Jum\'at' , $this->input->post('nama_transaksi').''.$this->input->post('jml_transaksi'));

        $this->Model_jumat->hapusData($id);
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Sedekah Jum\'at berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('jumat');
    }

    public function edit($id)
    {
        $data['title'] = 'Form Edit Transaksi ';
        $data['transaksi'] = $this->Model_jumat->getIdTransaksi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jumat/edit_view');
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->Model_jumat->updateData();
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Donasi Sedekah Jum\'at berhasil di Update 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        helper_log('Update Data di Sedekah Jum\'at', $this->input->post('nama_transaksi').' | '.$this->input->post('jml_transaksi').' | '.$this->input->post('tgl_transaksi'));
        redirect('jumat');
        
    }
}