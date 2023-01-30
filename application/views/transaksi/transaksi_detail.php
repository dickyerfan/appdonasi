<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('transaksi/pilih'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <?php
                    $namaDonasi = $this->uri->segment(5);
                    $namaDonasi = preg_replace("/[^a-zA-Z&']/", " ", $namaDonasi);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama Donasi</td>
                                            <td> : </td>
                                            <td class="fw-bold text-primary"><?= $namaDonasi; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Transaksi</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $transaksi->nama_transaksi ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Transaksi</td>
                                            <td> : </td>
                                            <td class="fw-bold"> Rp. <?= number_format($transaksi->jml_transaksi, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Transaksi</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= format_indo($transaksi->tgl_transaksi)  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Transaksi</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $transaksi->jenis_transaksi ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Penginput</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $transaksi->nama_user ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Input</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= format_indo2($transaksi->tgl_input)  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Update</td>
                                            <td> : </td>
                                            <td class="fw-bold"><?= $transaksi->tgl_update == null ? 'Belum di Update' : format_indo2($transaksi->tgl_update)   ?></td>
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