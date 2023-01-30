<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('user/admin'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pengguna">Nama Pengguna :</label>
                                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" placeholder="Masukan nama pengguna" value="<?= set_value('nama_pengguna'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_pengguna'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap :</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan nama lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_lengkap'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email" value="<?= set_value('email'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" value="<?= set_value('password'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="level">Level User:</label>
                                    <select name="level" id="level" class="form-control">
                                        <!-- <option value="Admin">Admin</option> -->
                                        <option value="Pengguna" selected>Pengguna</option>
                                    </select>
                                    <small class="form-text text-danger pl-3">Admin hanya bisa menambah user level Pengguna</small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mt-2" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>