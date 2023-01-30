<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <?php 
                    $namaDonasi = $donasi->nama_donasi;
                    $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                ?>
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?> <?= strtoupper($namaDonasi)  ?></a>
                    <a href="<?= base_url('dashboard'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-9">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 mb-1">
                                            <div class="card border-0 bg-primary shadow">
                                                <!-- <div class="card-header fw-bold bg-dark"></div> -->
                                                <div class="card-body text-center text-light border-top border-warning border-5 rounded-top">
                                                    <div class="row">
                                                        <div class="col mr-2">
                                                            <h4>Penerimaan : </h4>
                                                            <h4>Rp. <?= number_format($masuk, '0', ',', '.'); ?>,-</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer fw-bold bg-primary"></div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <div class="card bg-primary border-0 shadow">
                                                <!-- <div class="card-header fw-bold bg-dark"></div> -->
                                                <div class="card-body text-center text-light border-top border-warning border-5 rounded-top">
                                                    <div class="row">
                                                        <div class="col mr-2">
                                                            <h4>Pengeluaran : </h4>
                                                            <h4>Rp. <?= number_format($keluar, '0', ',', '.'); ?>,-</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer fw-bold bg-primary"></div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-danger border-0 shadow">
                                                <!-- <div class="card-header fw-bold bg-dark"></div> -->
                                                <div class="card-body text-center text-light border-top border-warning border-5 rounded-top">
                                                    <div class="row">
                                                        <div class="col mr-2">
                                                            <h4>Saldo : </h4>
                                                            <h4>Rp. <?= number_format($saldo, '0', ',', '.'); ?>,-</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer fw-bold bg-danger"></div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php foreach ($gambar as $row) : ?>
                                    <img src="<?= base_url('assets/photo/') ?><?= $row->photo ?>" class="img-fluid rounded p-3" alt="Donasi">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </main>