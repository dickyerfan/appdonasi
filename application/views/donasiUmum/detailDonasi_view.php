<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-7">
                            <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <div class="col-5">
                            <?php
                            $table = $this->uri->segment(4);
                            $idDonasi = $this->uri->segment(3);
                            $namaDonasi = $this->uri->segment(4);
                            $namaDonasi = preg_replace("/[^a-zA-Z]/", "", $namaDonasi);
                            ?>
                            <a href="<?= base_url('donasiUmum/tambah/'); ?><?= $idDonasi ?>/<?= $table ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Input Transaksi</button></a>
                            <a id="saldo"><button class="btn btn-success btn-sm logo"><i class="fas fa-dollar"></i> Saldo Awal</button></a>
                            <button id="belum" class="btn btn-warning btn-sm"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button>
                            <!-- <a href="<?= base_url('detailDonasi'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a> -->
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
                                    <?php
                                    $nama_id = $this->uri->segment(3);
                                    $nama_donasi = $this->uri->segment(4);
                                    ?>
                                    <form action="<?= base_url('donasiUmum/ambilSaldoAwal') ?>/<?= $nama_id ?>/<?= $nama_donasi ?>" method="POST">
                                        <div class="form-group">
                                            <input type="hidden" name="bulan" class="form-control" value="<?php echo $bulan = date('m'); ?>">
                                            <input type="hidden" name="tahun" class="form-control" value="<?php echo $tahun = date('Y'); ?>">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="addSaldo" id="tombolSaldo" class="btn btn-block btn-primary">Ambil Saldo Awal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" id="tanya" style="display: none;">
                        <div class="col-xl-12">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url() ?>donasiUmum/detail/<?= $nama_id ?>/<?= $nama_donasi ?>" method="GET">
                                        <div class="row">
                                            <div class="col-md-3 d-grid gap-2">
                                                <button class="btn btn-block btn-outline-secondary" disabled>Pilih Bulan & Tahun :</button>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $bulan = date('m'); ?>
                                                    <select name="bulan" class="form-select mb-1" required>
                                                        <!-- <option value="<?php echo $bulan = date('m'); ?>">Bulan</option> -->
                                                        <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>Januari</option>
                                                        <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>Februari</option>
                                                        <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>Maret</option>
                                                        <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>April</option>
                                                        <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>Mei</option>
                                                        <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>Juni</option>
                                                        <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>Juli</option>
                                                        <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>Agustus</option>
                                                        <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>September</option>
                                                        <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>Oktober</option>
                                                        <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>November</option>
                                                        <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="tahun" class="form-select mb-1">
                                                        <?php
                                                        $mulai = date('Y') - 2;
                                                        for ($i = $mulai; $i < $mulai + 11; $i++) {
                                                            $sel = $i == date('Y') ? ' selected="selected"' : '';
                                                            echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" name="add_post" id="tombol_pilih" class="btn btn-block btn-outline-primary">Tampilkan</button>
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
                                foreach ($detailDonasi as $row) :
                                ?>
                                    <tr class>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= ($row->kode_saldo == 1) ? 'javascript:void(0)' : base_url() ?>donasiUmum/edit/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $row->id_donasi; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>

                                            <a href="<?= ($row->kode_saldo == 1 or $this->session->userdata('level') == 'Admin') ? 'javascript:void(0)' : base_url(); ?>donasiUmum/hapus/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $row->id_donasi; ?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus data"></i></a>

                                            <a href="<?= base_url(); ?>donasiUmum/rinci/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $row->id_donasi; ?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail data"></i></a>
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