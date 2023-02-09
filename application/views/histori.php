<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-7">
                            <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <!-- <div class="col-5">
                            <?php
                            $table = $this->uri->segment(4);
                            $idDonasi = $this->uri->segment(3);
                            $namaDonasi = $this->uri->segment(4);
                            $namaDonasi = preg_replace("/[^a-zA-Z]/", "", $namaDonasi);
                            ?>
                            <a href="<?= base_url('donasiUmum/tambah/'); ?><?=$idDonasi?>/<?= $table ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Input Transaksi</button></a>
                            <a id="saldo"><button class="btn btn-success btn-sm logo"><i class="fas fa-dollar"></i> Saldo Awal</button></a>
                            <button id="belum" class="btn btn-warning btn-sm"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button>
                        </div> -->
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
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama Pengguna</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($histori as $row) :
                                ?>
                                    <tr class>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $row->log_time ?></td>
                                        <td><?= $row->log_user ?></td>
                                        <td><?= $row->log_tipe ?></td>
                                        <td><?= $row->log_desc ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>