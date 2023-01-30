<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-9">
                            <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <div class="col-3">
                            <a href="<?= base_url('donasiKhusus/tambah/'); ?>"><button class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Tambah Penabung</button></a>
                            <!-- <a href="<?= base_url('donasiKhusus/detailTambah'); ?>"><button class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Input Tabungan</button></a> -->
                            <a href="<?= base_url('donasiKhusus'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
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
                                    <th class="text-center">Nama Penabung</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Jumlah (Rp)</th>
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
                                            <!-- <a href="<?= ($row->kode_saldo == 1 )?'javascript:void(0)' : base_url() ?>detailDonasi/edit/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $table; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>

                                            <a href="<?= ($row->kode_saldo == 1 OR $this->session->userdata('level')== 'Admin')?'javascript:void(0)' : base_url(); ?>detailDonasi/hapus/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $table; ?>" class="sweet"><i class="fas fa-fw fa-trash text-danger" data-bs-toggle="tooltip" title="Hapus data"></i></a>

                                            <a href="<?= base_url(); ?>detailDonasi/rinci/<?= $row->id_transaksi; ?>/<?= $row->nama_donasi; ?>/<?= $table; ?>"><i class="fas fa-fw fa-info-circle text-success" data-bs-toggle="tooltip" title="Detail data"></i></a> -->
                                            <a href="<?= base_url('donasiKhusus/detail/')?><?=$row->id_penabung?>/<?=$row->nama_penabung?>" class="text-decoration-none fw-bold">
                                                    <h6>Detail</h6>
                                                </a>
                                        </td>
                                        <?php 
                                        $namaPenabung = $row->nama_penabung;
                                        $namaPenabung = preg_replace("/[^a-zA-Z&\']/", " ", $namaPenabung);
                                        ?>
                                        <td><?= $namaPenabung ?></td>
                                        <td class="text-center">
                                            <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('donasiKhusus/edit/'): 'javascript:void(0)' ?><?=$row->id_penabung?>/<?= $row->nama_penabung; ?>" style="text-decoration: none;" class="data-bs-toggle="tooltip" title="Untuk Menonaktifkan Tabungan, hanya bisa dilakukan oleh Super Admin"">
                                                <?= $row->status == 1 ? 'Aktif':'Tidak Aktif' ?>
                                            </a>
                                        </td>
                                        <?php 
                                                $id = $row->id_penabung;
                                                $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE taqur.id_penabung = $id")->result();
                                                foreach ($totalTabungan as $row) {
                                                    $totalTabungan = $row->totalTabungan;
                                                }                                          
                                            ?>
                                        <td class="text-end"><?= number_format($totalTabungan, 0, ',', '.');  ?>,-</td>                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>