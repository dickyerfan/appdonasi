<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('donasiKhusus/tabunganQurban'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url('donasikhusus/update') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <div class="form-group">
                                    <input type="hidden" name="id_penabung" value="<?= $taqur->id_penabung ?>">
                                    <label for="nama_donasi">Nama Penabung :</label>
                                    <input type="text" class="form-control" id="nama_penabung" name="nama_penabung" placeholder="Masukan Nama Penabung" value="<?= $taqur->nama_penabung ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <textarea name="alamat" id="" cols="30" rows="5" class="form-control"><?= $taqur->alamat ?></textarea>
                                </div> -->
                                <div class="form-group">
                                    <input type="hidden" name="id_penabung" value="<?= $taqur->id_penabung ?>">
                                    <label for="status">Status Penabung :</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="">Pilih Tidak Aktif Jika Sudah digunakan</option>
                                        <option value=1>Aktif</option>
                                        <option value=0>Tidak Aktif</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('status'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>