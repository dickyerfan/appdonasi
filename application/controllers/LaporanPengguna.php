<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
        $this->load->library('form_validation');
        $table = $this->session->nama_donasi;
        $table = substr($table, 0, 5);
        $table = strtolower($table);
        
        if(!$this->session->userdata('level')){
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
        if ($this->session->userdata('level') != 'Pengguna') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Pengguna...
                      </div>'
            );
            redirect('auth');
        }
        $data['title'] = 'Laporan Donasi';
        $data['title1'] = 'Laporan Donasi Umum';
        $data['title2'] = 'Laporan Donasi Khusus';
        $data['laporan'] = $this->Model_laporan->getAll();

        $this->load->view('templatePengguna/header', $data);
        $this->load->view('templatePengguna/navbar');
        $this->load->view('templatePengguna/sidebar');
        $this->load->view('laporanPengguna/laporan', $data);
        $this->load->view('templatePengguna/footer');
    }

    public function detail($id)
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
        $nama_id = $this->uri->segment(3);
        $nama_donasi = $this->uri->segment(4);
        
        if (isset($_GET['add_post'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $tanggal = $tahun . '-' . $bulan . '-01';
            $data['tanggal'] = $tanggal;
            $url_cetak = 'laporanPengguna/ekspor/'.$nama_id.'/'.$nama_donasi.'?bulan=' . $bulan . '&tahun=' . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $tanggal = $tahun . '-' . $bulan . '-01';
            $data['tanggal'] = $tanggal;
            $url_cetak = 'laporanPengguna/ekspor/'.$nama_id.'/'.$nama_donasi.'?bulan=' . $bulan . '&tahun=' . $tahun;
        }

        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $this->db->where('id_donasi',$nama_id);
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $this->db->where('id_donasi',$nama_id);
        $keluar = $this->db->get()->result();
        foreach ($keluar as $row) {
            $keluar = $row->keluar;
        }
        
        $data['title'] = 'Laporan Donasi';
        $data['donasi'] = $this->Model_laporan->getDetail($id);
        $data['transaksi'] = $this->Model_laporan->getTransaksi();
        $data['totalMasuk'] = $masuk;
        $data['totalKeluar'] = $keluar;
        $data['saldo'] =  $masuk - $keluar;
        $data['url_cetak'] = base_url($url_cetak);

        $this->load->view('templatePengguna/header', $data);
        $this->load->view('templatePengguna/navbar');
        $this->load->view('templatePengguna/sidebar');
        $this->load->view('laporanPengguna/laporan_detail', $data);
        $this->load->view('templatePengguna/footer');
    }

    public function ekspor(){

        if (isset($_GET['bulan']) && ($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }

        $title = $this->uri->segment(4);
        $title = preg_replace("/[^a-zA-Z\']/",' ', $title);
        $title2 = strtoupper($title);

        $this->load->library('pdf');
        $pdf = new FPDF('p', 'mm', [325, 215]);
        $pdf->AddFont('scada', '', 'scada.php');
        $pdf->AddPage();
        $pdf->SetFillColor(32, 87, 328,);
        // $pdf->Rect(10, 9, 190, 20, 'F');
        $pdf->SetFont('scada', '', 11);
        $pdf->Image(base_url('assets/img/yrsb.jpg'), 15, 12, 35, 10);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Yayasan Rumah Sedekah Bondowoso/Aksi Bersama Yatim', 0, 1, 'C');
        $pdf->SetFont('scada', '', 13);
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(190, 7, 'LAPORAN KEUANGAN DONASI '.$title2, 0, 1, 'C');
        $pdf->Image(base_url('assets/img/aby.png'), 170, 10, 30, 12);
        $pdf->SetFont('scada', '', 10);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Bulan ' . $bulan . ' '  . $tahun, 0, 1, 'C');

        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->SetFont('scada', '', 9);
        $pdf->SetFillColor(29, 117, 240,);
        $pdf->Rect(15, 26, 185, 7, 'F');
        $pdf->Cell(5, 1, '', 0, 0, 'C',);
        $pdf->Cell(185, 1, '', 1, 1, 'C');

        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(85, 6, 'Nama Transaksi', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Penerimaan', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Pengeluaran', 1, 1, 'C');

        $pdf->SetFont('scada', '', 9);

        if (isset($_GET['bulan']) && ($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $id = $this->uri->segment(3);
        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $this->db->where('id_donasi', $id);
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $this->db->where('id_donasi', $id);
        $keluar = $this->db->get()->result();
        foreach ($keluar as $row) {
            $keluar = $row->keluar;
        }
        $saldo = $masuk - $keluar;

        $transaksi = $this->db->query("SELECT * FROM transaksi WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun AND id_donasi = $id  ORDER BY tgl_transaksi ASC")->result();
        $no = 0;
        foreach ($transaksi as $row) {
            $tgls = strtotime($row->tgl_transaksi);
            $day = date('d', $tgls);
            $bln = date('m', $tgls);
            $tahun = date('Y', $tgls);

            switch ($bln) {
                case '01':
                    $bln = "Januari";
                    break;
                case '02':
                    $bln = "Februari";
                    break;
                case '03':
                    $bln = "Maret";
                    break;
                case '04':
                    $bln = "April";
                    break;
                case '05':
                    $bln = "Mei";
                    break;
                case '06':
                    $bln = "Juni";
                    break;
                case '07':
                    $bln = "Juli";
                    break;
                case '08':
                    $bln = "Agustus";
                    break;
                case '09':
                    $bln = "September";
                    break;
                case '10':
                    $bln = "Oktober";
                    break;
                case '11':
                    $bln = "November";
                    break;
                case '12':
                    $bln = "Desember";
                    break;
            }

            $tanggalFormat = $day . ' ' . $bln . ' ' . $tahun;

            $no++;
            $pdf->Cell(5, 6, '', 0, 0, 'C');
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(85, 6, $row->nama_transaksi, 1, 0, 'L');
            $pdf->Cell(30, 6, $tanggalFormat, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->jenis_transaksi == 'Penerimaan' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : ' ', 1, 0, 'R');
            $pdf->Cell(30, 6, $row->jenis_transaksi == 'Pengeluaran' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : ' ', 1, 1, 'R');
        }
        $pdf->SetFillColor(51, 148, 245,);
        $pdf->SetFont('scada', '', 9);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(125, 6, 'Total', 1, 0, 'C',[35, 178, 222]);
        $pdf->Cell(30, 6, number_format($masuk, '0', ',', '.') . ',-', 1, 0, 'R',[35, 178, 222]);
        $pdf->Cell(30, 6, number_format($keluar, '0', ',', '.') . ',-', 1, 0, 'R',[35, 178, 222]);
        $pdf->Cell(5, 6, '', 0, 1, 'C');
        $pdf->SetFont('scada', '', 10);
        $pdf->SetFillColor(29, 117, 240,);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(125, 6, 'Saldo', 1, 0, 'C',[29, 117, 240]);
        $pdf->Cell(60, 6, number_format($saldo, '0', ',', '.') . ',-', 1, 0, 'R',[29, 117, 240]);
        $pdf->Cell(5, 6, '', 0, 1, 'C');
        $pdf->Cell(5, 1, '', 0, 0, 'C');
        $pdf->Cell(185, 1, '', 1, 1, 'C',[29, 117, 240]);

        $tanggal = date('d');
        $bulan = date('m');
        $tahun = date('Y');
        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }

        $pdf->Cell(190, 2, '', 0, 1, 'C');
        $pdf->Cell(95, 6, '', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Bondowoso,'.' '. $tanggal.' '.$bulan.' '.$tahun, 0, 1, 'C');
        $pdf->Cell(95, 6, 'Mengetahui', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Dibuat Oleh,', 0, 1, 'C');
        $pdf->Cell(95, 6, 'Ketua Yayasan', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Bendahara', 0, 1, 'C');
        $pdf->Cell(190, 10, '', 0, 1, 'C');
        $pdf->Cell(95, 6, 'Abu Fulan', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Abu Fulan', 0, 1, 'C');
        $pdf->Output('I', 'Laporan Keuangan Donasi '. $title.' ' . $bln . ' ' . $tahun . '.pdf');
    }

    public function taqur()
    {
        $tanggal = date('d');
        $bulan = date('m');
        $tahun = date('Y');

        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }

        $this->load->library('pdf');
        $pdf = new FPDF('p', 'mm', [325, 215]);
        $pdf->AddFont('scada', '', 'scada.php');
        $pdf->AddPage();
        $pdf->SetFillColor(32, 87, 328,);
        $pdf->Image(base_url('assets/img/yrsb.jpg'), 15, 12, 35, 10);
        $pdf->SetFont('scada', '', 11);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Yayasan Rumah Sedekah Bondowoso/Aksi Bersama Yatim', 0, 1, 'C');
        $pdf->SetFont('scada', '', 13);
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(190, 7, 'LAPORAN TABUNGAN QURBAN ', 0, 1, 'C');
        $pdf->Image(base_url('assets/img/aby.png'), 170, 10, 30, 12);
        $pdf->SetFont('scada', '', 10);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'PER '. $tanggal.' ' . $bulan . ' '  . $tahun, 0, 1, 'C');
        // $pdf->Cell(190, 4, 'Bulan ' . $bulan . ' '  . $tahun, 0, 1, 'L');

        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->SetFont('scada', '', 9);
        $pdf->SetFillColor(29, 117, 240,);
        $pdf->Rect(15, 26, 185, 7, 'F');
        $pdf->Cell(5, 1, '', 0, 0, 'C',);
        $pdf->Cell(185, 1, '', 1, 1, 'C');

        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(55, 6, 'Nama Penabung', 1, 0, 'C');
        $pdf->Cell(85, 6, 'Alamat Penabung', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Jumlah Tabungan', 1, 1, 'C');

        $pdf->SetFont('scada', '', 9);

        $transaksi = $this->db->query("SELECT * FROM taqur WHERE status = 1")->result();
        $no = 0;
        foreach ($transaksi as $row) {
            $nama = $row->nama_penabung;
            $nama = preg_replace("/[^a-zA-Z]/", " ", $nama);

            $no++;
            $pdf->Cell(5, 6, '', 0, 0, 'C');
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(55, 6, $nama, 1, 0, 'L');
            $pdf->Cell(85, 6, $row->alamat, 1, 0, 'L');

            $id = $row->id_penabung;
            $tabungan = $this->db->query("SELECT sum(jml_tabungan) as tabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE taqur.id_penabung = $id AND detail_taqur.status_tabungan = 1")->result();
            foreach ($tabungan as $row) {
                $tabungan = $row->tabungan;
            } 
            $pdf->Cell(35, 6, number_format($tabungan,0,',','.').',-', 1, 1, 'R');
        }

        $pdf->SetFont('scada', '', 10);
        $pdf->SetFillColor(29, 117, 240,);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(150, 6, 'Total Tabungan', 1, 0, 'C',[29, 117, 240]);

        $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE detail_taqur.status_tabungan = 1")->result();
        foreach ($totalTabungan as $row) {
            $totalTabungan = $row->totalTabungan;
        } 

        $pdf->Cell(35, 6, number_format($totalTabungan,0,',','.').',-', 1, 0, 'R',[29, 117, 240]);
        $pdf->Cell(5, 6, '', 0, 1, 'C');
        $pdf->Cell(5, 1, '', 0, 0, 'C');
        $pdf->Cell(185, 1, '', 1, 1, 'C',[29, 117, 240]);


        $pdf->Cell(190, 2, '', 0, 1, 'C');
        $pdf->Cell(95, 6, '', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Bondowoso,'.' '. $tanggal.' '.$bulan.' '.$tahun, 0, 1, 'C');
        $pdf->Cell(95, 6, 'Mengetahui', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Dibuat Oleh,', 0, 1, 'C');
        $pdf->Cell(95, 6, 'Ketua Yayasan', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Bendahara', 0, 1, 'C');
        $pdf->Cell(190, 10, '', 0, 1, 'C');
        $pdf->Cell(95, 6, 'Abu Fulan', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Abu Fulan', 0, 1, 'C');

        $pdf->Output('I', 'Laporan Tabungan Qurban.pdf');
    }

    public function jumat()
    {
        $bulan = date('m');
        $tahun = date('Y');   

        if (isset($_GET['add_post'])) {
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $url_cetak = 'eksporJumat?tanggal_awal=' . $tanggal_awal . '&tanggal_akhir=' . $tanggal_akhir;
        } else {
            $tanggal_awal = '';
            $tanggal_akhir = '';
            $url_cetak = 'eksporJumat?tanggal_awal=' . $tanggal_awal . '&tanggal_akhir=' . $tanggal_akhir;
        }

        if (isset($_GET['add_post'])){
            // $tanggal_awalTahun = $tahun.'-'.$bulan.'-'.'01';
            $tanggal_awalTahun = '2023-01-01';
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = date('Y-m-d', strtotime('-1 days',strtotime($tanggal_awal)));

            $this->db->select('sum(jml_transaksi) as masukLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awalTahun.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->order_by('tgl_transaksi');
            $masukLalu = $this->db->get()->result();
            foreach ($masukLalu as $row) {
                $masukLalu = $row->masukLalu;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as masukLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $masukLalu = $this->db->get()->result();
            foreach ($masukLalu as $row) {
                $masukLalu = $row->masukLalu;
            }
        }

        if (isset($_GET['add_post'])){
            // $tanggal_awalTahun = $tahun.'-'.$bulan.'-'.'01';
            $tanggal_awalTahun = '2023-01-01';
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = date('Y-m-d', strtotime('-1 days',strtotime($tanggal_awal)));

            $this->db->select('sum(jml_transaksi) as keluarLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awalTahun.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->order_by('tgl_transaksi');
            $keluarLalu = $this->db->get()->result();
            foreach ($keluarLalu as $row) {
                $keluarLalu = $row->keluarLalu;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as keluarLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $keluarLalu = $this->db->get()->result();
            foreach ($keluarLalu as $row) {
                $keluarLalu = $row->keluarLalu;
            }
        }

        $data['totalMasuklalu'] = $masukLalu;
        $data['totalKeluarLalu'] = $keluarLalu;
        $data['saldoLalu'] =  $masukLalu - $keluarLalu;

        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('sum(jml_transaksi) as masuk');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->order_by('tgl_transaksi');
            $masuk = $this->db->get()->result();
            foreach ($masuk as $row) {
                $masuk = $row->masuk;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as masuk');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $masuk = $this->db->get()->result();
            foreach ($masuk as $row) {
                $masuk = $row->masuk;
            }
        }

        if (isset($_GET['add_post'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('sum(jml_transaksi) as keluar');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->order_by('tgl_transaksi');
            $keluar = $this->db->get()->result();
            foreach ($keluar as $row) {
                $keluar = $row->keluar;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as keluar');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $keluar = $this->db->get()->result();
            foreach ($keluar as $row) {
                $keluar = $row->keluar;
            }
        }
        $data['totalMasuk'] = $masuk + $masukLalu - $keluarLalu;
        $data['totalKeluar'] = $keluar;
        $data['saldo'] =  $masuk + ($masukLalu - $keluarLalu)- $keluar;


        $data['title'] = 'Laporan Sedekah Jumat';
        $data['jumatMasuk'] = $this->Model_laporan->getJumatMasuk();
        $data['jumatKeluar'] = $this->Model_laporan->getJumatKeluar();
        $data['keterangan'] = $this->Model_laporan->getKeterangan();
        $data['url_cetak'] = $url_cetak;
        $this->load->view('templatePengguna/header', $data);
        $this->load->view('templatePengguna/navbar');
        $this->load->view('templatePengguna/sidebar');
        $this->load->view('laporanPengguna/laporanJumat', $data);
        $this->load->view('templatePengguna/footer');
    }

    public function eksporJumat(){

        $bulan = date('m');
        $tahun = date('Y');   

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])) {
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
        } else {
            $tanggal_awal = '';
            $tanggal_akhir ='';
        }

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            // $tanggal_awalTahun = $tahun.'-'.$bulan.'-'.'01';
            $tanggal_awalTahun = '2023-01-01';
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = date('Y-m-d', strtotime('-1 days',strtotime($tanggal_awal)));

            $this->db->select('sum(jml_transaksi) as masukLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awalTahun.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->order_by('tgl_transaksi');
            $masukLalu = $this->db->get()->result();
            foreach ($masukLalu as $row) {
                $masukLalu = $row->masukLalu;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as masukLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $masukLalu = $this->db->get()->result();
            foreach ($masukLalu as $row) {
                $masukLalu = $row->masukLalu;
            }
        }

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            // $tanggal_awalTahun = $tahun.'-'.$bulan.'-'.'01';
            $tanggal_awalTahun = '2023-01-01';
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = date('Y-m-d', strtotime('-1 days',strtotime($tanggal_awal)));

            $this->db->select('sum(jml_transaksi) as keluarLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awalTahun.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->order_by('tgl_transaksi');
            $keluarLalu = $this->db->get()->result();
            foreach ($keluarLalu as $row) {
                $keluarLalu = $row->keluarLalu;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as keluarLalu');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $keluarLalu = $this->db->get()->result();
            foreach ($keluarLalu as $row) {
                $keluarLalu = $row->keluarLalu;
            }
        }
        $saldoLalu =  $masukLalu - $keluarLalu;

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('sum(jml_transaksi) as masuk');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->order_by('tgl_transaksi');
            $masuk = $this->db->get()->result();
            foreach ($masuk as $row) {
                $masuk = $row->masuk;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as masuk');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Penerimaan');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $masuk = $this->db->get()->result();
            foreach ($masuk as $row) {
                $masuk = $row->masuk;
            }
        }

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('sum(jml_transaksi) as keluar');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->order_by('tgl_transaksi');
            $keluar = $this->db->get()->result();
            foreach ($keluar as $row) {
                $keluar = $row->keluar;
            }
        }else{
            $this->db->select('sum(jml_transaksi) as keluar');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('jenis_transaksi', 'Pengeluaran');
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $keluar = $this->db->get()->result();
            foreach ($keluar as $row) {
                $keluar = $row->keluar;
            }
        }
        $totalMasuk = $masuk + $masukLalu - $keluarLalu;
        $totalKeluar = $keluar;
        $saldo =  $masuk + ($masukLalu - $keluarLalu)- $keluar;

        $this->load->library('pdf');
        $pdf = new FPDF('p', 'mm', [325, 215]);
        $pdf->AddFont('scada', '', 'scada.php');
        $pdf->AddPage();
        $pdf->SetFillColor(32, 87, 328,);
        $pdf->SetFont('scada', '', 11);
        $pdf->Image(base_url('assets/img/yrsb.jpg'), 15, 12, 35, 10);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Yayasan Rumah Sedekah Bondowoso/Aksi Bersama Yatim', 0, 1, 'C');
        $pdf->SetFont('scada', '', 13);
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(190, 7, 'LAPORAN SEDEKAH JUMAT UNTUK UMMAT ', 0, 1, 'C');
        $pdf->Image(base_url('assets/img/aby.png'), 170, 10, 30, 12);
        $pdf->SetFont('scada', '', 10);
        $pdf->Cell(5, 4, '', 0, 0, 'C');

        if (isset($_GET['tanggal_akhir'])){
            $tanggal = $_GET['tanggal_akhir'];
            }else{
                $tanggal = date('Y-m-d', strtotime('now'));
            }

            $pecahkan = explode('-', $tanggal);
            $bln = $pecahkan[1];
            $tahun = $pecahkan[0];
            $tgl = $pecahkan[2];

            switch ($bln) {
                case '1':
                    $bln = "Januari";
                    break;
                case '2':
                    $bln = "Februari";
                    break;
                case '3':
                    $bln = "Maret";
                    break;
                case '4':
                    $bln = "April";
                    break;
                case '5':
                    $bln = "Mei";
                    break;
                case '6':
                    $bln = "Juni";
                    break;
                case '7':
                    $bln = "Juli";
                    break;
                case '8':
                    $bln = "Agustus";
                    break;
                case '9':
                    $bln = "September";
                    break;
                case '10':
                    $bln = "Oktober";
                    break;
                case '11':
                    $bln = "Nofember";
                    break;
                case '12':
                    $bln = "Desember";
                    break;
            }
            $tanggalFix = $tgl.' '.$bln.' '.$tahun;
        $pdf->Cell(190, 4, $tanggalFix, 0, 1, 'C');

        $pdf->Cell(190, 5, '', 0, 1);
        $pdf->SetFont('scada', '', 9);
        $pdf->SetFillColor(29, 117, 240,);
        $pdf->Rect(15, 30, 185, 6, 'F');

        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(85, 6, 'Uraian', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Penerimaan', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Pengeluaran', 1, 1, 'C');

        $pdf->SetFont('scada', '', 9);

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('tgl_transaksi BETWEEN"'.$tanggal_awal.'" AND "'.$tanggal_akhir.'"');
            $this->db->order_by('tgl_transaksi');
            $jumatMasuk =  $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('sedekah_jumat');
            $this->db->where('MONTH(tgl_transaksi)', $bulan);
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
            $this->db->where('kode_saldo', 2);
            $this->db->order_by('tgl_transaksi');
            $jumatMasuk =  $this->db->get()->result();
        }


        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(85, 6, 'Sisa Saldo', 1, 0, 'L');
        $pdf->Cell(50, 6, number_format($saldoLalu, '0', ',', '.') . ',-', 1, 0, 'R');
        $pdf->Cell(50, 6, '', 1, 1, 'C');
        foreach ($jumatMasuk as $row) {
            $pdf->Cell(5, 6, '', 0, 0, 'C');
            $pdf->Cell(85, 6, $row->nama_transaksi, 1, 0, 'L');
            $pdf->Cell(50, 6, $row->jenis_transaksi == 'Penerimaan' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : ' ', 1, 0, 'R');
            $pdf->Cell(50, 6, $row->jenis_transaksi == 'Pengeluaran' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : ' ', 1, 1, 'R');
        }
        $pdf->SetFillColor(51, 148, 245,);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(85, 6, 'Total', 1, 0, 'C',[35, 178, 222]);
        $pdf->Cell(50, 6, number_format($totalMasuk, '0', ',', '.') . ',-', 1, 0, 'R',[35, 178, 222]);
        $pdf->Cell(50, 6, number_format($totalKeluar, '0', ',', '.') . ',-', 1, 1, 'R',[35, 178, 222]);

        $pdf->SetFillColor(29, 117, 240,);
        $pdf->SetFont('scada', '', 10);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(85, 6, 'Saldo Akhir', 1, 0, 'C',[29, 117, 240]);
        $pdf->Cell(100, 6, number_format($saldo, '0', ',', '.') . ',-', 1, 1, 'C',[29, 117, 240]);
        $pdf->Cell(5, 6, '', 0, 0, 'C');
        $pdf->Cell(185, 1, '', 1, 1, 'C',[29, 117, 240]);

        $pdf->Cell(5, 5, '', 0, 1, 'C');
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(60, 7, 'LOKASI PENDISTRIBUSIAN :', 0, 0, 'L');
        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('tanggal', $tanggal_akhir);
            $keterangan = $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('status', 0);
            $keterangan = $this->db->get()->result();
        }
        foreach($keterangan as $row ){
            $pdf->Cell(5, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->lokasi, 0, 1, 'L');
        }

        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(60, 7, 'TARGET PENDISTRIBUSIAN :', 0, 0, 'L');
        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('tanggal', $tanggal_akhir);
            $keterangan = $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('status', 0);
            $keterangan = $this->db->get()->result();
        }
        foreach($keterangan as $row ){
            $pdf->Cell(5, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->target, 0, 1, 'L');
        }

        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(60, 7, 'TELAH DI DISTRIBUSIKAN :', 0, 0, 'L');

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('tanggal', $tanggal_akhir);
            $keterangan = $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('status', 0);
            $keterangan = $this->db->get()->result();
        }
        foreach($keterangan as $row ){
            $pdf->Cell(5, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->distribusi1, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->distribusi2, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->distribusi3, 0, 1, 'L');
        }

        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(60, 7, 'DONASI LAIN-LAIN :', 0, 0, 'L');
        

        if (isset($_GET['tanggal_awal']) && ($_GET['tanggal_akhir'])){
            $tanggal_awal = $_GET['tanggal_awal'];
            $tanggal_akhir = $_GET['tanggal_akhir'];
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('tanggal', $tanggal_akhir);
            $keterangan = $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('lap_jumat');
            $this->db->where('status', 0);
            $keterangan = $this->db->get()->result();
        }
        foreach($keterangan as $row ){
            $pdf->Cell(5, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->donasi1, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->donasi2, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->donasi3, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->donasi4, 0, 1, 'L');
            $pdf->Cell(70, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, $row->donasi5, 0, 1, 'L');
        }

        $pdf->Output('I', 'Laporan Sedekah Jumat ' . $tanggalFix . '.pdf');
    }
    
}
