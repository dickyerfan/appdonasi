<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?> <?= strtoupper($donasi->nama_donasi)  ?></a>
                    <a href="<?= base_url('donasi'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header bg-primary shadow">
                                <h6 class="text-light">Status : <?=($donasi->status ==0)?'Tidak Aktif':'Aktif'?></h6>
                            </div>
                            <div class="card-body shadow">
                                <h5><?= $donasi->deskripsi; ?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="<?= base_url('assets/photo/') . $donasi->photo ?>" alt="" class="img-fluid shadow" width="85%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>