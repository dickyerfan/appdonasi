<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold"><?= strtoupper($title); ?></div>
                </div>
                <div class="card-body">
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <div class="row justify-content-center">
                        <?php foreach ($laporan as $row) : ?>
                            <div class="col-xl-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card bg-primary border-0 shadow" style="height:100% ;">
                                    <!-- <div class="card-header fw-bold"></div> -->
                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                        <div class="row">
                                            <div class="col mr-2">
                                            <?php 
                                                    $namaDonasi = $row->nama_donasi;
                                                    $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                                                ?>
                                                <a href="<?= base_url(); ?>laporanPengguna/detail/<?= $row->id_donasi; ?>/<?= $row->nama_donasi; ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h5><?= $namaDonasi ?></h5>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-signature fa-2x text-white"></i>
                                            </div>
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