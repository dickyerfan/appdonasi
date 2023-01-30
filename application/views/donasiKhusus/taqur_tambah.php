<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('donasiKhusus/tabunganQurban'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_donasi">Nama Donasi :</label>
                                    <input type="text" class="form-control" id="nama_donasi" name="nama_penabung" placeholder="Masukan Nama Penabung" value="<?= set_value('nama_penabung'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_penabung'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?= set_value('alamat'); ?></textarea>
                                    <small class="form-text text-danger pl-3"><?= form_error('alamat'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>