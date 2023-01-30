<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailDonasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_detailDonasi');
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

        $data['title'] = 'DAFTAR DONASI UMUM';
        $data['detailDonasi'] = $this->Model_detailDonasi->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detailDonasi/detailDonasi', $data);
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $namaDonasi = $this->uri->segment(4);
        $namaDonasi = preg_replace("/[^a-zA-Z&\']/", " ", $namaDonasi);
        $data['title'] = 'Donasi ' . $namaDonasi;
        $data['detailDonasi'] = $this->Model_detailDonasi->getAllDonasi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detailDonasi/detailDonasi_view', $data);
        $this->load->view('templates/footer');
    }

    public function rinci($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Model_detailDonasi->getDetailDonasi($id);
        $data['detailDonasi'] = $this->Model_detailDonasi->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detailDonasi/detailDonasi_rinci', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $title = $this->uri->segment(4);
        $title = preg_replace("/[^a-zA-Z&']/", " ", $title);
        $namaDonasi = $this->uri->segment(4);
        $idDonasi = $this->uri->segment(3);
        $this->Model_detailDonasi->hapusData($id);
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Donasi ' . $title . ' berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('detailDonasi/detail/' .$idDonasi.'/'. $namaDonasi);
    }

    public function edit($id)
    {
        $title = $this->uri->segment(5);
        $title = preg_replace("/[^a-zA-Z\']/", " ", $title);
        $data['title'] = 'Form Edit Transaksi ' . $title;
        $data['donasi'] = $this->db->get('donasi')->result();
        $data['transaksi'] = $this->Model_detailDonasi->getIdTransaksi($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detailDonasi/detailDonasi_edit');
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $title = $this->uri->segment(4);
        $title = preg_replace("/[^a-zA-Z&']/", " ", $title);
        $namaDonasi = $this->uri->segment(4);
        $idDonasi = $this->uri->segment(3);
        
        $this->Model_detailDonasi->updateData();

        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Donasi ' . $title . ' berhasil di Update 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('detailDonasi/detail/' .$idDonasi.'/'. $namaDonasi);
        
    }

    public function tambah()
    {
        // $title = $this->input->get('nama_donasi');
        $title = $this->uri->segment(4);
            $title = preg_replace("/[^a-zA-Z&']/", " ", $title);
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        $namaDonasi = $this->uri->segment(4);
        $idDonasi = $this->uri->segment(3);
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
            $this->load->view('detailDonasi/detailDonasi_tambah',$data);
            $this->load->view('templates/footer');
        } else {
            $this->Model_detailDonasi->tambahData($table);
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Transaksi di Donasi ' . $title . ' berhasil di tambah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
            );
            redirect('detailDonasi/detail/' .$idDonasi.'/'. $namaDonasi);
        }
    }

    public function ambilSaldoAwal()
    {
            $bulanskrng = date('m');
            if ($bulanskrng < 10) {
                $bulanskrng = str_split($bulanskrng)[1];
            }
            $tahun = date('Y');

            if($bulanskrng == 1){
                $bulanLalu = 12;
                $tahun = $tahun - 1;
            }else{
                $bulanLalu = $bulanskrng - 1;
                $tahun = date('Y');
            }

        
        $id = $this->uri->segment(3);
        
        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);
        
        $bulanSaldo = date('m');
        $tahunSaldo = date('Y');

        $namaDonasi = $this->uri->segment(4);
        $namaDonasi = preg_replace("/[^a-zA-Z-\']/", "", $namaDonasi);
        $alamat = 'detailDonasi/detail/' . $id .'/' . $namaDonasi ;


        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulanLalu);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulanLalu);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $keluar = $this->db->get()->result();
        foreach ($keluar as $row) {
            $keluar = $row->keluar;
        }
        $saldo = $masuk - $keluar;
    
        $bulanDB = $this->Model_detailDonasi->getSaldo();
        foreach($bulanDB as $row){
            $bulanDB = $row->jml_transaksi;
        }

        $tampilBulan = date('m');
        switch ($tampilBulan) {
            case '01':
                $tampilBulan = "Januari";
                break;
            case '02':
                $tampilBulan = "Februari";
                break;
            case '03':
                $tampilBulan = "Maret";
                break;
            case '04':
                $tampilBulan = "April";
                break;
            case '05':
                $tampilBulan = "Mei";
                break;
            case '06':
                $tampilBulan = "Juni";
                break;
            case '07':
                $tampilBulan = "Juli";
                break;
            case '08':
                $tampilBulan = "Agustus";
                break;
            case '09':
                $tampilBulan = "September";
                break;
            case '10':
                $tampilBulan = "Oktober";
                break;
            case '11':
                $tampilBulan = "November";
                break;
            case '12':
                $tampilBulan = "Desember";
                break;
        }
        $tampilTahun = date('Y');

        if ($saldo == $bulanDB){

            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;">
                <strong>Maaf,</strong> Saldo Awal Sudah ditambahkan
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
              </div>'
            );
            redirect($alamat);
        }else {
            $data = [
                "nama_transaksi" => 'Saldo Awal '. $tampilBulan.' '.$tampilTahun,
                "jml_transaksi" => $saldo,
                "tgl_transaksi" => $tahunSaldo.'-'.$bulanSaldo.'-'.'01',
                "jenis_transaksi" => 'Penerimaan',
                "nama_user" => 'Admin',
                "tgl_input" => $tahunSaldo.'-'.$bulanSaldo.'-'.'01',
                "kode_saldo" => 1
            ];
            $this->db->insert($table, $data);
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width:50%;">
                <strong>Sukses,</strong> Saldo berhasil ditambahkan
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
              </div>'
            );
            redirect($alamat);
        }
    }
}
