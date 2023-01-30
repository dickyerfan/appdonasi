<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('jumat'); ?>" id="kembali"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">

                    <form class="user" action="<?= base_url('jumat/update/') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="id_transaksi" value="<?= $transaksi->id_transaksi ?>">
                                    <label for="nama_transaksi">Nama Transaksi :</label>
                                    <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" placeholder="Masukan Nama Transaksi" value="<?= $transaksi->nama_transaksi; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_transaksi'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jml_transaksi">Jumlah :</label>
                                    <input type="text" class="form-control" id="jml_transaksi" name="jml_transaksi" placeholder="Masukan Jumlah Transaksi" value="<?= $transaksi->jml_transaksi; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('jml_transaksi'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_transaksi">Waktu Transaksi :</label>
                                    <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" placeholder="Masukan Waktu Transaksi" value="<?= $transaksi->tgl_transaksi; ?>" required>
                                    <small class="form-text text-danger pl-3"><?= form_error('tanggal'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_transaksi">Jenis Transaksi :</label>
                                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-control select2">
                                        <option value=""> Pilih Jenis Transaksi </option>
                                        <option value="Penerimaan" <?= $transaksi->jenis_transaksi == 'Penerimaan' ? 'selected' : '' ?>>Penerimaan</option>
                                        <option value="Pengeluaran" <?= $transaksi->jenis_transaksi == 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('jenis_transaksi'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-edit"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>