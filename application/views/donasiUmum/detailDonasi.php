<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-0 shadow">
                    <div class="fw-bold"><?= $title ?></div>
                </div>
                <div class="card-body">
                <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <?php foreach ($detailDonasi as $row) : ?>
                        <div class="carousel-item <?php if($row->id_donasi == 1){echo 'active';}  ?> ">
                            <div class="card bg-primary card1">
                                <div class="img-wrapper">
                                    <?php 
                                        $namaDonasi = $row->nama_donasi;
                                        $namaDonasi = preg_replace("/[^a-zA-Z0-9\']/", " ", $namaDonasi);
                                    ?>
                                        <a href="<?= base_url(); ?>donasiUmum/detail/<?=$row->id_donasi?>/<?= $row->nama_donasi; ?>">
                                            <img src="<?=base_url('assets/photo/'.$row->photo)?>">
                                        </a>
                                </div>
                                <div class="card-body">
                                        <a href="<?= base_url(); ?>donasiUmum/detail/<?=$row->id_donasi?>/<?= $row->nama_donasi; ?>" class="text-decoration-none fw-bold text-dark text-uppercase">
                                            <h5 class="card-title text-light namaDonasi"><?= $namaDonasi ?></h5>
                                        </a>
                                        <?php 
                                            $id = $row->id_donasi;
                                            $masuk = $this->db->query("SELECT sum(jml_transaksi) AS masuk FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
                                            foreach ($masuk as $row) {
                                                $masuk = $row->masuk;
                                            }
                                            $keluar = $this->db->query("SELECT sum(jml_transaksi) AS keluar FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
                                            foreach ($keluar as $row) {
                                                $keluar = $row->keluar;
                                            }
                                            $saldo = $masuk - $keluar;
                                        ?>
                                    <span class="card-text fw-bold text-light fontRupiah">Penerimaan : Rp. <?=number_format($masuk,0,',','.') ?></span><br>
                                    <span class="card-text fw-bold text-light fontRupiah">Pengeluaran : Rp.  <?=number_format($keluar,0,',','.') ?></span><br>
                                    <span class="card-text fw-bold text-warning fontRupiah">Saldo : Rp. <?=number_format($saldo,0,',','.') ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                </div>
            </div>
        </div>
    </main>