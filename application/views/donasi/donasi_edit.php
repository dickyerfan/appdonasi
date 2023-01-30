<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('donasi'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url('donasi/update') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="id_donasi" value="<?= $donasi->id_donasi ?>">
                                    <label for="nama_donasi">Nama Donasi :</label>
                                    <input type="text" class="form-control" id="nama_donasi" name="nama_donasi" placeholder="Masukan Nama donasi" value="<?= $donasi->nama_donasi ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi :</label>
                                    <!-- <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Nama donasi" value="<?= $donasi->deskripsi ?>"> -->
                                    <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control"><?= $donasi->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo :</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status :</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="1"<?=$donasi->status == 1 ?'selected':''?>>Aktif</option>
                                        <option value="0"<?=$donasi->status == 0 ?'selected':''?>>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>