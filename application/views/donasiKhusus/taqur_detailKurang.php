<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <?php
                    $namaDonasi = $this->uri->segment(4);
                    $idDonasi = $this->uri->segment(3);
                    ?>
                    <a href="<?= base_url('donasiKhusus/detail/'); ?><?=$idDonasi?>/<?= $namaDonasi ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url('donasikhusus/updateTabungan') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="id_penabung" value="<?= $taqur->id_penabung ?>">
                                    <label for="status_tabungan">Ambil Tabungan :</label>
                                    <select name="status_tabungan" id="status_tabungan" class="form-select" required>
                                        <option value="">Pilih Tidak Aktif Jika tabungan akan Di ambil</option>
                                        <option value=1>Aktif</option>
                                        <option value=0>Tidak Aktif</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('status_tabungan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>