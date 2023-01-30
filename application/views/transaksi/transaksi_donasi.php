<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <?php
                    $table = $this->input->get('nama_donasi');
                    $table = preg_replace("/[^a-zA-Z]/", "", $table);
                    $table = substr($table, 0, 10);
                    $table = strtolower($table);
                    $namaDonasi = $this->input->get('nama_donasi');
                    ?>
                    <a href="<?= base_url('transaksi/tambah/'); ?><?= $table ?>/<?= $namaDonasi; ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Input Transaksi</button></a>
                    <!-- <a href="<?= base_url('transaksi/input'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a> -->
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Nama Transaksi</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jenis Transaksi</th>
                                    <th class="text-center">Nama Penginput</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($donasi as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>transaksi/edit/<?= $table ?>/<?= $row->id_transaksi; ?>/<?= $namaDonasi; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                            <a href="<?= base_url(); ?>transaksi/hapus/<?= $table ?>/<?= $row->id_transaksi; ?>/<?= $namaDonasi; ?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus data"></i></a>
                                            <a href="<?= base_url(); ?>transaksi/detail/<?= $table ?>/<?= $row->id_transaksi; ?>/<?= $namaDonasi; ?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail data"></i></a>
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