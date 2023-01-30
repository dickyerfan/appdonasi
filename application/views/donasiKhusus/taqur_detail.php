<!-- <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?> <?= strtoupper($taqur->nama_penabung)  ?></a>
                    <a href="<?= base_url('donasiKhusus/tabunganQurban'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header bg-primary shadow">
                            </div>
                            <div class="card-body shadow">
                                <h5><?= $taqur->nama_penabung; ?></h5>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main> -->

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
                            <?php
                            $table = $this->uri->segment(4);
                            $idDonasi = $this->uri->segment(3);
                            ?>
                            <a href="<?=($this->session->userdata('level')=='SuperAdmin')? base_url('donasiKhusus/detailKurang/'):'javascript:void(0)' ?><?=$idDonasi?>/<?= $table ?>"><button class="btn btn-warning btn-sm"><i class="fas fa-dollar"></i> Ambil Tab</button></a>
                            <a href="<?=($inputTab == 0)?'javascript:void(0)': base_url('donasiKhusus/detailTambah/'); ?><?=$idDonasi?>/<?= $table ?>"><button class="btn btn-success btn-sm"><i class="fas fa-sack-dollar"></i> Input Tabungan</button></a>
                            <a href="<?= base_url('donasiKhusus/tabunganQurban'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('pesan'); ?>
                    <?= $this->session->unset_userdata('pesan'); ?>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="card shadow ps-3 pt-2 pb-2">Total Tabungan : Rp. <?= number_format($totalTabungan,0,',','.');?></h5>
                    </div>
                    <!-- <div class="col-sm-4">
                        <h5 class="card shadow ps-3 pt-2 pb-2">Status :</h5>
                    </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Jumlah (Rp)</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama Penginput</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($taqur as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <!-- <a href="<?=base_url() ?>donasiKhusus/detailEdit/<?= $row->id_transaksi; ?>/<?= $row->nama_penabung; ?>/<?=$table?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Tabungan"></i></a> -->
                                            <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('donasiKhusus/detailHapus/'):'javascript:void(0)' ?><?= $row->id_transaksi; ?>/<?= $row->nama_penabung; ?>/<?=$row->id_penabung?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus Tabungan, Hanya bisa dilakukan SuperAdmin"></i></a>

                                            <a href="<?= base_url(); ?>donasiKhusus/detailRinci/<?= $row->id_transaksi; ?>/<?= $row->nama_penabung; ?>/<?=$idDonasi?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail Tabungan"></i></a>
                                        </td>
                                        <td class="text-end"><?= number_format($row->jml_tabungan, 0, ',', '.');  ?>,-</td>
                                        <?php $tanggal = date('d M Y', strtotime($row->tgl_tabungan)); ?>
                                        <td class="text-end"><?= $tanggal ?></td>
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
