<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <?php
                    $namaPenabung = $this->uri->segment(4);
                    $namaPenabung = preg_replace("/[^a-zA-Z-\']/", " ", $namaPenabung);
                    $namaPenabung2 = $this->uri->segment(4);
                    $namaPenabung2 = preg_replace("/[^a-zA-Z\']/", " ", $namaPenabung2);
                    $idPenabung = $this->uri->segment(5);
                    ?>
                    <a href="<?= base_url('donasiKhusus/detail/'); ?><?= $idPenabung?>/<?= $namaPenabung ?>" id="kembali"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama Penabung</td>
                                            <td> : </td>
                                            <td class="fw-bold text-primary"><?= $namaPenabung2; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Tabungan</td>
                                            <td> : </td>
                                            <td class="fw-bold">Rp. <?= number_format($tabungan->jml_tabungan,0,',','.')  ?>,-</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Tabungan</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= format_indo($tabungan->tgl_tabungan)  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Penginput</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $tabungan->nama_user ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Input</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= format_indo2($tabungan->tgl_input)  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Update</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $tabungan->tgl_update == null ? 'Belum di Update' : format_indo2($tabungan->tgl_update)   ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="<?= base_url('assets/img/donasi2.jpg') ?>" alt="" class="img-fluid shadow" width="345px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>