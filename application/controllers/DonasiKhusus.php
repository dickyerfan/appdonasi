<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DonasiKhusus extends CI_Controller
{
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('Model_donasiKhusus');
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

        $data['title'] = 'DAFTAR DONASI KHUSUS';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/donasiKhusus');
        $this->load->view('templates/footer');
    }

    public function tabunganQurban()
    {
        $data['title'] = 'TABUNGAN QURBAN';
        $data['taqur'] = $this->Model_donasiKhusus->getAll();
        $totalTabungan = $this->Model_donasiKhusus->getJoinSaldo();
        foreach ($totalTabungan as $row) {
            $totalTabungan = $row->totalTabungan;
        }
        $data['totalTabungan'] = $totalTabungan;
        // $data['taqur'] = $this->Model_donasiKhusus->getJoinTaqur();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/tabunganQurban', $data);
        $this->load->view('templates/footer');
    }

    public function taqurTabel()
    {
        $data['title'] = 'TABUNGAN QURBAN';
        $data['taqur'] = $this->Model_donasiKhusus->getAll();
        $totalTabungan = $this->Model_donasiKhusus->getJoinSaldo();
        foreach ($totalTabungan as $row) {
            $totalTabungan = $row->totalTabungan;
        }
        $data['totalTabungan'] = $totalTabungan;
        // $data['taqur'] = $this->Model_donasiKhusus->getJoinTaqur();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/taqurTabel', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Nama Penabung';

        $this->form_validation->set_rules('nama_penabung', 'Nama Penabung', 'required|trim|regex_match[/^[a-zA-Z0-9-\']*$/]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('regex_match', 'tidak boleh ada spasi, gunakan tanda - sebagai pemisah');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('donasiKhusus/taqur_tambah');
            $this->load->view('templates/footer');
        } else {
            $data['tambah'] = $this->Model_donasiKhusus->tambahData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width:50%;">
                    <strong>Sukses,</strong> Data Penabung berhasil di tambah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            helper_log('Tambah Penabung di Tabungan Qurban', $this->input->post('nama_penabung').' | '.$this->input->post('alamat'));
            redirect('donasiKhusus/tabunganQurban');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Form Perubahan Status Penabung';
        $data['taqur'] = $this->Model_donasiKhusus->getIdTaqur($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/taqur_edit');
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $namaPenabung = $this->uri->segment(5);
        $namaPenabung = preg_replace("/[^a-zA-Z&\']/", " ", $namaPenabung);

        $this->Model_donasiKhusus->updateData();
        if ($this->db->affected_rows() <= 0) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            redirect('donasiKhusus/tabunganQurban');
        } else {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Sukses,</strong> Tabungan Sudah di ubah statusnya...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            helper_log('Update Status Penabung', $namaPenabung);
            redirect('donasiKhusus/tabunganQurban');
        }
    }

    public function detail()
    {
        $namaPenabung = $this->uri->segment(4);
        $namaPenabung = preg_replace("/[^a-zA-Z&\']/", " ", $namaPenabung);
        $data['title'] = 'DETAIL TABUNGAN QURBAN '.$namaPenabung;
        $data['taqur'] = $this->Model_donasiKhusus->getJoinTaqur();
        $totalTabungan = $this->Model_donasiKhusus->getJoinSaldo();
        foreach ($totalTabungan as $row) {
            $totalTabungan = $row->totalTabungan;
        }
        $data['totalTabungan'] = $totalTabungan;

        $inputTab = $data['taqur'];
        foreach ($inputTab as $row) {
            $inputTab = $row->status;
        }
        $data['inputTab'] = $inputTab;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/taqur_detail', $data);
        $this->load->view('templates/footer');
    }
    // public function detail()
    // {
    //     $namaDonasi = $this->uri->segment(4);
    //     $namaDonasi = preg_replace("/[^a-zA-Z&\']/", " ", $namaDonasi);
    //     $data['title'] = 'DETAIL TABUNGAN QURBAN '.$namaDonasi;
    //     $data['taqur'] = $this->Model_donasiKhusus->getAllPenabung();

    //     $table = $this->uri->segment(4);
    //     $table = preg_replace("/[^a-zA-Z]/", "", $table);
    //     $table = substr($table, 0, 10);
    //     $table = strtolower($table);

    //     $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM $table");
    //     foreach ($totalTabungan->result() as $row) {
    //         $totalTabungan = $row->totalTabungan;
    //     }

    //     $data['totalTabungan'] = $totalTabungan;

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/navbar');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('donasiKhusus/taqur_detail', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function detailTambah()
    // {
    //     $data['title'] = 'Tambah Tabungan';
    //     $data['penabung'] = $this->db->get('taqur')->result();
    //     // $namaDonasi = $this->uri->segment(4);
    //     // $idDonasi = $this->uri->segment(3);
    //     $idDonasi = $this->input->post('id_penabung');
    //     $namaDonasi = $this->input->post('nama_penabung');
    //     $this->form_validation->set_rules('jml_tabungan', 'Jumlah Tabungan', 'required|trim');
    //     $this->form_validation->set_message('required', '%s masih kosong');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/navbar');
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('donasiKhusus/taqur_detailTambah');
    //         $this->load->view('templates/footer');
    //     } else {
    //         $data['tambah'] = $this->Model_donasiKhusus->tambahTabungan();
    //         $this->session->set_flashdata(
    //             'pesan',
    //             '<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width:50%;">
    //                 <strong>Sukses,</strong> Data Tabungan berhasil di tambah
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    //                 </button>
    //               </div>'
    //         );
    //         redirect('donasiKhusus/detail/' .$idDonasi.'/'. $namaDonasi);
    //         // redirect('donasiKhusus/tabunganQurban/');
    //     }
    // }

    public function detailTambah()
    {
        $data['title'] = 'Tambah Tabungan';

        $namaPenabung = $this->uri->segment(4);
        $idPenabung = $this->uri->segment(3);

        $this->form_validation->set_rules('jml_tabungan', 'Jumlah Tabungan', 'required|trim|is_natural');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('is_natural', '%s harus inputan angka tanpa titik dan koma');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('donasiKhusus/taqur_detailTambah');
            $this->load->view('templates/footer');
        } else {
            $data['tambah'] = $this->Model_donasiKhusus->tambahTabungan();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width:50%;">
                    <strong>Sukses,</strong> Data Tabungan berhasil di tambah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            helper_log('Tambah Data di Tabungan Qurban', $namaPenabung.' | '.$this->input->post('jml_tabungan'));
            redirect('donasikhusus/detail/' .$idPenabung.'/'. $namaPenabung);
        }
    }

    public function detailHapus($id)
    {
        $namaPenabung = $this->uri->segment(4);
        $idPenabung = $this->uri->segment(5);
        $this->Model_donasiKhusus->hapusTabungan($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                    <strong>Sukses,</strong> Data Tabungan berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        helper_log('Hapus Data di Tabungan Qurban', $namaPenabung);
        redirect('donasikhusus/detail/' .$idPenabung.'/'. $namaPenabung);
    }

    public function detailRinci($id)
    {
        $data['title'] = 'Detail Tabungan';
        $data['tabungan'] = $this->Model_donasiKhusus->getDetailTabungan($id);
        $data['detailTaqur'] = $this->Model_donasiKhusus->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/taqur_detailRinci');
        $this->load->view('templates/footer');
    }

    public function detailKurang($id)
    {
        $data['title'] = 'Form Ambil Tabungan';
        $data['taqur'] = $this->Model_donasiKhusus->getIdTaqurKurang($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('donasiKhusus/taqur_detailKurang');
        $this->load->view('templates/footer');
    }

    public function updateTabungan()
    {
        $this->Model_donasiKhusus->updateTabungan();
        if ($this->db->affected_rows() <= 0) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            redirect('donasiKhusus/tabunganQurban');
        } else {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;">
                        <strong>Sukses,</strong> Tabungan Sudah di ubah statusnya...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            helper_log('Ambil Tabungan Qurban',$this->input->post('status_tabungan'));
            redirect('donasiKhusus/tabunganQurban');
        }
    }

}
