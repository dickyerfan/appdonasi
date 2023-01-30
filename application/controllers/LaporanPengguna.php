<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
        $table = $this->session->nama_donasi;
        $table = substr($table, 0, 5);
        $table = strtolower($table);
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
            // $bulan = $this->input->post('bulan', true);
            // $tahun = $this->input->post('tahun', true);
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $tanggal = $tahun . '-' . $bulan . '-01';
            $data['tanggal'] = $tanggal;
            $url_cetak = 'laporan/ekspor/'.$nama_id.'/'.$nama_donasi.'?bulan=' . $bulan . '&tahun=' . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $tanggal = $tahun . '-' . $bulan . '-01';
            $data['tanggal'] = $tanggal;
            $url_cetak = 'laporan/ekspor/'.$nama_id.'/'.$nama_donasi.'?bulan=' . $bulan . '&tahun=' . $tahun;
        }


        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);

        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
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
        $title = strtoupper($title);

        $this->load->library('pdf');
        $pdf = new FPDF('p', 'mm', [325, 215]);
        $pdf->AddFont('scada', '', 'scada.php');
        $pdf->AddPage();
        $pdf->SetFillColor(32, 87, 328,);
        // $pdf->Rect(10, 9, 190, 20, 'F');
        $pdf->SetFont('scada', '', 11);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Yayasan Rumah Sedekah Bondowoso/Aksi Bersama Yatim', 0, 1, 'L');
        $pdf->SetFont('scada', '', 13);
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(190, 7, 'LAPORAN KEUANGAN DONASI '.$title, 0, 1, 'L');
        $pdf->Image(base_url('assets/img/aby.png'), 170, 10, 30, 12);
        $pdf->SetFont('scada', '', 11);
        $pdf->Cell(5, 4, '', 0, 0, 'C');
        $pdf->Cell(190, 4, 'Bulan ' . $bulan . ' '  . $tahun, 0, 1, 'L');

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

        $table = $this->uri->segment(4);
        $table = preg_replace("/[^a-zA-Z]/", "", $table);
        $table = substr($table, 0, 10);
        $table = strtolower($table);

        $tablePdf = $this->uri->segment(4);
        $tablePdf = preg_replace("/[^a-zA-Z]/", "", $tablePdf);
        $tablePdf = substr($tablePdf, 0, 10);

        $this->db->select('sum(jml_transaksi) as masuk');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Penerimaan');
        $masuk = $this->db->get()->result();
        foreach ($masuk as $row) {
            $masuk = $row->masuk;
        }

        $this->db->select('sum(jml_transaksi) as keluar');
        $this->db->from($table);
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $keluar = $this->db->get()->result();
        foreach ($keluar as $row) {
            $keluar = $row->keluar;
        }
        $saldo = $masuk - $keluar;

        $transaksi = $this->db->query("SELECT * FROM $table WHERE month(tgl_transaksi)=$bulan AND year(tgl_transaksi)= $tahun  ORDER BY tgl_transaksi ASC")->result();
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
        $pdf->Cell(185, 1, '', 1, 0, 'C',[29, 117, 240]);
        $pdf->Output('I', 'Laporan Keuangan Donasi '. $tablePdf.' ' . $bln . ' ' . $tahun . '.pdf');
    }
}
