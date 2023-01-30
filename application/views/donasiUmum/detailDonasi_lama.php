<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold"><?= $title ?></div>
                </div>
                <div class="card-body">
                <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <?php foreach ($detailDonasi as $row) : ?>
                        <div class="carousel-item <?php if($row->id_donasi == 12){echo 'active';}  ?> ">
                            <div class="card card1">
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
                                            <h5 class="card-title namaDonasi"><?= $namaDonasi ?></h5>
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
                                    <span class="card-text fw-bold fontRupiah">Penerimaan : Rp. <?=number_format($masuk,0,',','.') ?></span><br>
                                    <span class="card-text fw-bold fontRupiah">Pengeluaran : Rp.  <?=number_format($keluar,0,',','.') ?></span><br>
                                    <span class="card-text fw-bold text-danger fontRupiah">Saldo : Rp. <?=number_format($saldo,0,',','.') ?></span>
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
                <!-- <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card card1">
                                <div class="img-wrapper">
                                    <img src="<?=base_url('assets/img/donasi.png')?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Galon Air</h5>
                                    <span class="card-text fw-bold">Penerimaan : Rp. 2.500.000,-</span><br>
                                    <span class="card-text fw-bold">Pengeluaraan : Rp. 1.000.000,-</span><br>
                                    <span class="card-text fw-bold text-danger">Saldo : Rp. 1.500.000,-</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card card1">
                                <div class="img-wrapper">
                                    <img src="<?=base_url('assets/img/donasi2.jpg')?>">
                                </div>    
                                <div class="card-body">
                                    <h5 class="card-title">Bakti Sosial Sumbersalak 2023</h5>
                                    <span class="card-text fw-bold">Penerimaan : Rp. 2.500.000,-</span><br>
                                    <span class="card-text fw-bold">Pengeluaraan : Rp. 1.000.000,-</span><br>
                                    <span class="card-text fw-bold text-danger">Saldo : Rp. 1.500.000,-</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card card1">
                                <div class="img-wrapper">
                                    <img src="<?=base_url('assets/img/donasiMakanan.jpg')?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tebar Qur'an</h5>
                                    <span class="card-text fw-bold">Penerimaan : Rp. 2.500.000,-</span><br>
                                    <span class="card-text fw-bold">Pengeluaraan : Rp. 1.000.000,-</span><br>
                                    <span class="card-text fw-bold text-danger">Saldo : Rp. 1.500.000,-</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card card1">
                                <div class="img-wrapper">
                                    <img src="<?=base_url('assets/img/Sedekah Jum_at.jpg')?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Operasional</h5>
                                    <span class="card-text fw-bold">Penerimaan : Rp. 2.500.000,-</span><br>
                                    <span class="card-text fw-bold">Pengeluaraan : Rp. 1.000.000,-</span><br>
                                    <span class="card-text fw-bold text-danger">Saldo : Rp. 1.500.000,-</span>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card card1">
                                <div class="img-wrapper">
                                    <img src="<?=base_url('assets/img/aby.png')?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Kemanusiaan</h5>
                                    <span class="card-text fw-bold">Penerimaan : Rp. 2.500.000,-</span><br>
                                    <span class="card-text fw-bold">Pengeluaraan : Rp. 1.000.000,-</span><br>
                                    <span class="card-text fw-bold text-danger">Saldo : Rp. 1.500.000,-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> -->
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <!-- <div class="row justify-content-center">
                        <?php foreach ($detailDonasi as $row) : ?>
                            <div class="col-xl-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card bg-primary border-0 shadow" style="height:100% ;">
                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                        <div class="row">
                                            <div class="col mr-2">
                                                <?php 
                                                    $namaDonasi = $row->nama_donasi;
                                                    $namaDonasi = preg_replace("/[^a-zA-Z0-9\']/", " ", $namaDonasi);
                                                ?>
                                                <a href="<?= base_url(); ?>donasiUmum/detail/<?=$row->id_donasi?>/<?= $row->nama_donasi; ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h6><?= $namaDonasi ?></h6>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-donate fa-2x text-white"></i>
                                            </div>
                                        </div>
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
                                        <div class="row mt-1">
                                            <div class="col-sm-12  text-white">Penerimaan : Rp. <?=number_format($masuk,0,',','.') ?></div>
                                            <div class="col-sm-12  text-white">Pengeluaran : Rp.  <?=number_format($keluar,0,',','.') ?></div>
                                            <div class="col-sm-12 text-warning">saldo : Rp. <?=number_format($saldo,0,',','.') ?></div>
                                        </div>                                                                  
                                    </div>
                                </div>
                            </div>
                        <?php
                            $rowCount++;
                            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                        endforeach; ?>
                    </div> -->
                </div>
            </div>
        </div>
    </main>