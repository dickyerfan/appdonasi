<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <?php
                    $namaDonasi2 = $this->uri->segment(4);
                    $idDonasi = $this->uri->segment(3);
                    ?>
                    <a href="<?= base_url('donasiKhusus/tabunganQurban'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="id_penabung" id="id_penabung" class="form-select">
                                        <option value="">Pilih penabung</option>
                                        <?php foreach ($penabung as $row) : ?>
                                            <option value="<?= $row->id_penabung ?>"><?= $row->nama_penabung ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_penabung'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jml_tabungan">Jumlah Tabungan :</label>
                                    <input type="text" class="form-control" id="jml_tabungan" name="jml_tabungan" placeholder="Masukan Jumlah Tabungan" value="<?= set_value('jml_tabungan'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('jml_tabungan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
