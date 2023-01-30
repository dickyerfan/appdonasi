<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('transaksi/tambah'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Input Transaksi</button></a>
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
                                    <th class="text-center">Jenis Donasi</th>
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
                                foreach ($transaksi as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>transaksi/edit/<?= $row->id_transaksi; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                            <a href="<?= base_url(); ?>transaksi/hapus/<?= $row->id_transaksi; ?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus data"></i></a>
                                            <a href="<?= base_url(); ?>transaksi/detail/<?= $row->id_transaksi; ?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail data"></i></a>
                                        </td>
                                        <td><?= $row->nama_donasi ?></td>
                                        <td><?= $row->nama_transaksi ?></td>
                                        <td class="text-end"><?= number_format($row->jml_transaksi, 0, ',', '.');  ?>,-</td>
                                        <?php $tanggal = date('d M Y', strtotime($row->tgl_transaksi)); ?>
                                        <td class="text-end"><?= $tanggal ?></td>
                                        <!-- format_indo ada di helper -->
                                        <!-- <td class="text-end"><?= format_indo($row->date); ?></td> -->
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