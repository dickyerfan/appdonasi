<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('laporan/jumat'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal : <small class="text-danger">Pilih Hari Jumat</small></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Tanggal" value="<?= set_value('tanggal'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('tanggal'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi :</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi" value="<?= set_value('lokasi'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('lokasi'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="donasi2">Target :</label>
                                    <input type="text" class="form-control" id="target" name="target" placeholder="Masukan Target" value="<?= set_value('target'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('target'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="distribusi1">Distribusi 1 :</label>
                                    <input type="text" class="form-control" id="distribusi1" name="distribusi1" placeholder="Masukan Distribusi 1" value="<?= set_value('distribusi1'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('distribusi1'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="distribusi2">Distribusi 2 :</label>
                                    <input type="text" class="form-control" id="distribusi2" name="distribusi2" placeholder="Masukan Distribusi 1" value="<?= set_value('distribusi2'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('distribusi2'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="distribusi3">Distribusi 3 :</label>
                                    <input type="text" class="form-control" id="distribusi3" name="distribusi3" placeholder="Masukan Distribusi 1" value="<?= set_value('distribusi3'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('distribusi3'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="donasi1">Donasi 1 :</label>
                                    <input type="text" class="form-control" id="donasi1" name="donasi1" placeholder="Masukan Donasi 1" value="<?= set_value('donasi1'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('donasi1'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="donasi2">Donasi 2 :</label>
                                    <input type="text" class="form-control" id="donasi2" name="donasi2" placeholder="Masukan Donasi 2" value="<?= set_value('donasi2'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('donasi2'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="donasi3">Donasi 3 :</label>
                                    <input type="text" class="form-control" id="donasi3" name="donasi3" placeholder="Masukan Donasi 3" value="<?= set_value('donasi3'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('donasi3'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="donasi4">Donasi 4 :</label>
                                    <input type="text" class="form-control" id="donasi4" name="donasi4" placeholder="Masukan Donasi 4" value="<?= set_value('donasi4'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('donasi4'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="donasi5">Donasi 5 :</label>
                                    <input type="text" class="form-control" id="donasi5" name="donasi5" placeholder="Masukan Donasi 5" value="<?= set_value('donasi5'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('donasi5'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>