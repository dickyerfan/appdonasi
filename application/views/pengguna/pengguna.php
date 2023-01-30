<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="fw-bold">Aksi Bersama Yatim Bondowoso</div>
                </div>
                <div class="card-body">
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <div class="row justify-content-center">
                        <?php foreach ($dashboard as $row) : ?>
                            <div class="col-xl-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card bg-primary border-0 border-dark shadow" style="height:100% ;">
                                    <!-- <div class="card-header fw-bold bg-dark"></div> -->
                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                        <div class="row">
                                            <?php 
                                            $namaDonasi = $row->nama_donasi;
                                            $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                                            ?>
                                            <div class="col mr-2">
                                                <a href="<?= base_url(); ?>pengguna/detail/<?= $row->id_donasi; ?>/<?= $row->nama_donasi ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h5><?= $namaDonasi ?></h5>
                                                </a>
                                                <!-- <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Penerimaan</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">:</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800 float-end"><?= $masuk ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Pengeluaran</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">:</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800 float-end"><?= $keluar ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Saldo</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">:</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800 float-end"><?= $saldo ?></div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-donate fa-2x text-white"></i>
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