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
                    <a href="<?= base_url('donasiUmum/detail/'); ?><?=$idDonasi?>/<?= $namaDonasi2 ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <div class="form-group">
                                    <label for="id_donasi">Nama Donasi :</label>
                                    <select name="id_donasi" id="id_donasi" class="form-control select2">
                                        <option value="">Pilih Donasi</option>
                                        <?php foreach ($donasi as $row) : ?>
                                            <option value="<?= $row->id_donasi ?>"><?= $row->nama_donasi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_jabatan'); ?></small>
                                </div> -->
                                <div class="form-group">
                                    <label for="nama_transaksi">Nama Transaksi :</label>
                                    <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" placeholder="Masukan Nama Transaksi" value="<?= set_value('nama_transaksi'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_transaksi'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jml_transaksi">Jumlah :</label>
                                    <input type="text" class="form-control" id="jml_transaksi" name="jml_transaksi" placeholder="Masukan Jumlah Transaksi" value="<?= set_value('jml_transaksi'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('jml_transaksi'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_transaksi">Jenis Transaksi :</label>
                                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-control select2">
                                        <option value=""> Pilih Jenis Transaksi </option>
                                        <option value="Penerimaan">Penerimaan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('jenis_transaksi'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>