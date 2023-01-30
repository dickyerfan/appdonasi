<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-8">
                            <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <div class="col-4">
                            <a href="<?= base_url('jumat/tambah/'); ?>"><button class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Input Transaksi</button></a>
                            <!-- <a id="saldo"><button class="btn btn-success btn-sm logo"><i class="fas fa-dollar"></i> Saldo Awal</button></a> -->
                            <button id="belum" class="btn btn-warning btn-sm"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button>
                            <a href="<?= base_url('donasiKhusus'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mb-1" id="getSaldo" style="display: none;">
                        <div class="col-md-4">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url('jumat') ?>" method="POST">
                                        <div class="form-group">
                                        <input type="hidden" name="bulan" class="form-control" value="<?php echo $bulan = date('m'); ?>">
                                        <input type="hidden" name="tahun" class="form-control" value="<?php echo $tahun= date('Y'); ?>">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="addSaldo" id="tombolSaldo" class="btn btn-block btn-primary">Ambil Saldo Awal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-1" id="tanya" style="display: none;">
                        <div class="col-12">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url('jumat') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="tanggal_awal" class="fw-bold">Tanggal Awal :</label>
                                                <input type="date" name="tanggal_awal" class="form-control" required>    
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="tanggal_akhir" class="fw-bold">Tanggal Akhir :</label>
                                                <input type="date" name="tanggal_akhir" class="form-control"required>    
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-grid gap-2 mt-3">
                                                <button type="submit" name="add_post" id="tombol_pilih" class="btn btn-block btn-primary">Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Nama Transaksi</th>
                                    <th class="text-center">Jumlah (Rp)</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jenis Transaksi</th>
                                    <th class="text-center">Nama Penginput</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jumat as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= ($row->kode_saldo == 1 )?'javascript:void(0)' : base_url() ?>jumat/edit/<?= $row->id_transaksi; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>

                                            <a href="<?= ($row->kode_saldo == 1 OR $this->session->userdata('level')== 'Admin')?'javascript:void(0)' : base_url(); ?>jumat/hapus/<?= $row->id_transaksi; ?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus data"></i></a>

                                            <a href="<?= base_url(); ?>jumat/rinci/<?= $row->id_transaksi; ?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail data"></i></a>
                                        </td>
                                        <td><?= $row->nama_transaksi ?></td>
                                        <td class="text-end"><?= number_format($row->jml_transaksi, 0, ',', '.');  ?>,-</td>
                                        <?php $tanggal = date('d M Y', strtotime($row->tgl_transaksi)); ?>
                                        <td class="text-end"><?= $tanggal ?></td>
                                        <td><?= $row->jenis_transaksi ?></td>
                                        <td><?= $row->nama_user ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>