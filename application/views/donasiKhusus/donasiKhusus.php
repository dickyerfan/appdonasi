<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold"><?= $title ?></div>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-1">
                            <div class="card border-0 shadow cardEffect3" style="height:100% ;">
                                <div class="card-body bg-primary border-top border-warning border-5 rounded">
                                    <a href="<?= base_url('jumat') ?>">
                                        <img class="mb-2" src="<?= base_url('assets/img/jumat.jpeg') ?>">
                                    </a>
                                    <div class="row">
                                        <?php
                                        $masuk = $this->db->query("SELECT sum(jml_transaksi) as masuk FROM sedekah_jumat WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0")->result();
                                        foreach ($masuk as $row) {
                                            $masuk = $row->masuk;
                                        }
                                        $keluar = $this->db->query("SELECT sum(jml_transaksi) as keluar FROM sedekah_jumat WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0")->result();
                                        foreach ($keluar as $row) {
                                            $keluar = $row->keluar;
                                        }
                                        $saldo = $masuk - $keluar;
                                        ?>
                                        <div class="col">
                                            <a href="<?= base_url('jumat') ?>" class="text-decoration-none fw-bold text-light ">
                                                <h5 class="text-uppercase">Sedekah Jum'at</h5>
                                                <small class="text-warning">Masuk : Rp. <?= number_format($masuk, 0, ',', '.') ?>,-</small><br>
                                                <small class="text-warning">Keluar : Rp. <?= number_format($keluar, 0, ',', '.') ?>,-</small><br>
                                                <small class="text-warning">Saldo : Rp. <?= number_format($saldo, 0, ',', '.') ?>,-</small>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="">
                                                <i class="fas fa-donate fa-2x text-white" data-bs-toggle="tooltip" title="Laporan"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="card border-0 shadow cardEffect3" style="height:100% ;">
                                <div class="card-body bg-primary border-top border-warning border-5 rounded">
                                    <a href="<?= base_url('donasiKhusus/tabunganQurban') ?>">
                                        <img class="mb-2" src="<?= base_url('assets/img/donasi2.jpg') ?>">
                                    </a>
                                    <div class="row">
                                        <?php
                                        $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE detail_taqur.status_tabungan = 1")->result();
                                        foreach ($totalTabungan as $row) {
                                            $totalTabungan = $row->totalTabungan;
                                        }
                                        ?>
                                        <div class="col">
                                            <a href="<?= base_url('donasiKhusus/tabunganQurban') ?>" class="text-decoration-none fw-bold text-light ">
                                                <h5 class="text-uppercase">Tabungan Qurban</h5>
                                                <small class="text-warning">Total : Rp. <?= number_format($totalTabungan, 0, ',', '.') ?>,-</small>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('donasiKhusus/taqurTabel') ?>">
                                                <i class="fas fa-donate fa-2x text-white" data-bs-toggle="tooltip" title="Laporan Dalam Bentuk Tabel"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>