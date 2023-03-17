<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold"><?= strtoupper($title1); ?></div>
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
                                <div class="card border-0" style="height:100% ;">
                                    <div class="card-body bg-primary cardEffect border-top border-warning border-5 rounded">
                                        <div class="row">
                                            <div class="col mr-2">
                                                <?php
                                                $namaDonasi = $row->nama_donasi;
                                                $namaDonasi = preg_replace("/[^a-zA-Z0-9\']/", " ", $namaDonasi);
                                                ?>
                                                <a href="<?= base_url(); ?>laporanPengguna/detail/<?= $row->id_donasi; ?>/<?= $row->nama_donasi; ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h6><?= $namaDonasi ?></h6>
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
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold"><?= strtoupper($title2); ?></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0" style="height:100% ;">
                                <div class="card-body bg-primary cardEffect border-top border-warning border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="<?= base_url(); ?>laporanPengguna/taqur/" target="_blank" class="text-decoration-none fw-bold text-light text-uppercase">
                                                <h6>Tabungan Qurban</h6>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-signature fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0" style="height:100% ;">
                                <div class="card-body bg-primary cardEffect border-top border-warning border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="<?= base_url(); ?>laporanPengguna/jumat/" class="text-decoration-none fw-bold text-light text-uppercase">
                                                <h6>Sedekah Jum'at</h6>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-signature fa-2x text-white"></i>
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