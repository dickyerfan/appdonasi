<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header mb-2 shadow">
                <div class="row">
                        <div class="col-8">
                            <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <div class="col-4">
                            <a href="<?= base_url('donasiKhusus/tambah/'); ?>"><button class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Tambah Penabung</button></a>
                            <!-- <a href="<?= base_url('donasiKhusus/detailTambah'); ?>"><button class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Input Tabungan</button></a> -->
                            <a href="<?= base_url('donasiKhusus'); ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <div class="row justify-content-center">
                        <?php foreach ($taqur as $row) : ?>
                            <div class="col-md-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card shadow" style="height:100% ;">
                                    <!-- <div class="card-header fw-bold"></div> -->
                                    <div class="card-body bg-primary rounded">
                                        <div class="row">
                                            <div class="col mr-2">
                                                <?php 
                                                    $namaPenabung = $row->nama_penabung;
                                                    $namaPenabung = preg_replace("/[^a-zA-Z\']/", " ", $namaPenabung);
                                                ?>
                                                <a href="<?= base_url('donasiKhusus/detail/')?><?=$row->id_penabung?>/<?=$row->nama_penabung?>" class="text-decoration-none fw-bold text-light">
                                                    <h6 class="text-uppercase"><?= $namaPenabung  ?></h6>
                                                    <small class="text-warning">Status : <?= ($row->status==0)?'Tidak Aktif':'Aktif'  ?></small>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('donasiKhusus/edit/'): 'javascript:void(0)' ?><?=$row->id_penabung?>/<?= $row->nama_penabung; ?>">
                                                    <i class="fas fa-donate fa-2x text-white" data-bs-toggle="tooltip" title="Untuk Menonaktifkan Tabungan, hanya bisa dilakukan oleh Super Admin"></i>
                                                </a>
                                            </div>
                                            <?php 
                                                $id = $row->id_penabung;
                                                $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE taqur.id_penabung = $id AND detail_taqur.status_tabungan = 1")->result();
                                                foreach ($totalTabungan as $row) {
                                                    $totalTabungan = $row->totalTabungan;
                                                }                                          
                                            ?>
                                            <!-- <button class="card mt-1 bg-light text-primary shadow">
                                                <strong>Jumlah : Rp. <?= number_format($totalTabungan,0,',','.');?>,-</strong>
                                            </button> -->
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            Total Tabungan 
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body text-primary">
                                                            <strong>Rp. <?= number_format($totalTabungan,0,',','.');?>,-</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $rowCount++;
                            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>