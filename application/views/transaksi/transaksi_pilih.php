<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <!-- <a href="<?= base_url('transaksi'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->session->flashdata('info'); ?>
                            <?= $this->session->unset_userdata('info'); ?>
                            <form action="<?= base_url('transaksi/donasi/') ?>" method="get">
                                <div class="form-group">
                                    <label for="nama_donasi" class="fw-bold mb-2">Pilih Donasi :</label>
                                    <select name="nama_donasi" id="nama_donasi" class="form-control select2">
                                        <?php foreach ($donasi as $row) : ?>
                                            <option value="<?= $row->nama_donasi  ?>"><?= $row->nama_donasi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-check-square"></i> Pilih Donasi</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="<?= base_url('assets/img/donasi2.jpg') ?>" alt="" class="img-fluid shadow" width="345px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>