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
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <div class="row justify-content-center">
                        <?php foreach ($detailDonasi as $row) : ?>
                            <div class="col-xl-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card bg-primary border-0 shadow" style="height:100% ;">
                                    <!-- <div class="card-header bg-warning"></div> -->
                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                        <div class="row">
                                            <div class="col mr-2">
                                                <?php 
                                                    $namaDonasi = $row->nama_donasi;
                                                    $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                                                ?>
                                                <a href="<?= base_url(); ?>detailDonasi/detail/<?=$row->id_donasi?>/<?= $row->nama_donasi; ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h5><?= $namaDonasi ?></h5>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-donate fa-2x text-white"></i>
                                            </div>
                                        </div>
                                        <?php 
                                        $table = $row->nama_donasi;
                                        $table = preg_replace("/[^a-zA-Z]/", "", $table);
                                        $table = substr($table, 0, 10);
                                        $table = strtolower($table);

                                        $masuk = $this->db->query("SELECT sum(jml_transaksi) AS masuk FROM donasi JOIN $table ON donasi.nama_donasi = $table.nama_donasi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0")->result();
                                        foreach ($masuk as $row) {
                                            $masuk = $row->masuk;
                                        }
                                        $keluar = $this->db->query("SELECT sum(jml_transaksi) AS keluar FROM donasi JOIN $table ON donasi.nama_donasi = $table.nama_donasi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0")->result();
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
                    </div>
                </div>
            </div>
        </div>
    </main>