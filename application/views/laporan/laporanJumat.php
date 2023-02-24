<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header title">
                    <div class="row">
                        <div class="col-6">
                            <a class="fw-bold text-dark logo" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                        </div>
                        <div class="col-6">
                            <a href="<?= (isset($_GET['add_post'])) ? $url_cetak : 'javascript:void(0)' ?>" target="_blank" class="btn btn-success btn-sm logo"><i class="fas fa-file-alt"></i> Export PDF</a>
                            <a id="belum"><button class="btn btn-warning btn-sm logo"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button></a>
                            <a href="<?= base_url('laporan/tambahDonasi'); ?>"><button class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> input Donasi</button></a>
                            <a href="<?= base_url('laporan'); ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mb-1" id="tanya" style="display: none;">
                        <div class="col-12">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url('laporan/jumat') ?>" method="GET">
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
                                                    <input type="date" name="tanggal_akhir" class="form-control" required>
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
                    <div class="row">
                        <?php
                        if (isset($_GET['add_post'])) {
                            $tanggal = $_GET['tanggal_akhir'];
                        } else {
                            $tanggal = date('Y-m-d', strtotime('now'));
                        }

                        $pecahkan = explode('-', $tanggal);
                        $bln = $pecahkan[1];
                        $tahun = $pecahkan[0];
                        $tgl = $pecahkan[2];

                        switch ($bln) {
                            case '1':
                                $bln = "Januari";
                                break;
                            case '2':
                                $bln = "Februari";
                                break;
                            case '3':
                                $bln = "Maret";
                                break;
                            case '4':
                                $bln = "April";
                                break;
                            case '5':
                                $bln = "Mei";
                                break;
                            case '6':
                                $bln = "Juni";
                                break;
                            case '7':
                                $bln = "Juli";
                                break;
                            case '8':
                                $bln = "Agustus";
                                break;
                            case '9':
                                $bln = "September";
                                break;
                            case '10':
                                $bln = "Oktober";
                                break;
                            case '11':
                                $bln = "Nofember";
                                break;
                            case '12':
                                $bln = "Desember";
                                break;
                        }

                        $tanggalFix = $tgl . ' ' . $bln . ' ' . $tahun;

                        ?>
                        <div class="col-md-12 text-center mb-2">
                            <h5>LAPORAN SEDEKAH JUM'AT UNTUK UMMAT</h5>
                            <h5><?= $tanggalFix; ?></h5>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header bg-primary text-light text-uppercase">Donasi Masuk</h5>
                                <div class="card-body border-1">
                                    <table class="table table-sm table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>Sisa Saldo</td>
                                                <td class="text-end"><?= 'Rp. ' . number_format($saldoLalu, '0', ',', '.') . ',-'; ?></td>
                                            </tr>
                                            <?php foreach ($jumatMasuk as $row) : ?>
                                                <tr class="font">
                                                    <td><?= $row->jenis_transaksi == 'Penerimaan' ? $row->nama_transaksi : '' ?></td>
                                                    <td class="text-end"><?= $row->jenis_transaksi == 'Penerimaan' ? 'Rp. ' . number_format($row->jml_transaksi, '0', ',', '.') . ',-' : '' ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header bg-primary text-light text-uppercase">Pengeluaran</h5>
                                <div class="card-body">
                                    <table class="table table-sm table-responsive">
                                        <tbody>
                                            <?php foreach ($jumatKeluar as $row) : ?>
                                                <tr class="font">
                                                    <td><?= $row->jenis_transaksi == 'Pengeluaran' ? $row->nama_transaksi : '' ?></td>
                                                    <td class="text-end"><?= $row->jenis_transaksi == 'Pengeluaran' ? 'Rp. ' . number_format($row->jml_transaksi, '0', ',', '.') . ',-' : '' ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="card">
                                <h6 class="card-header bg-primary text-light text-uppercase">Total Donasi Masuk + Sisa Saldo</h6>
                                <div class="card-body">
                                    <h5 class="text-center">Rp. <?= number_format($totalMasuk, '0', ',', '.')  ?>,-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h6 class="card-header bg-primary text-light text-uppercase">Total Pengeluaran</h6>
                                <div class="card-body">
                                    <h5 class="text-center">Rp. <?= number_format($totalKeluar, '0', ',', '.')  ?>,-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h6 class="card-header bg-primary text-light text-uppercase">Sisa Saldo</h6>
                                <div class="card-body">
                                    <h5 class="text-center">Rp. <?= number_format($saldo, '0', ',', '.')  ?>,-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <?php foreach ($keterangan as $row) : ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header bg-primary text-light text-uppercase">Donasi Lain-lain</h5>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row->donasi1 ?></h5>
                                        <h5 class="card-title"><?= $row->donasi2 ?></h5>
                                        <h5 class="card-title"><?= $row->donasi3 ?></h5>
                                        <h5 class="card-title"><?= $row->donasi4 ?></h5>
                                        <h5 class="card-title"><?= $row->donasi5 ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header bg-primary text-light text-uppercase">Informasi</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Telah di Distribusikan :</h5>
                                        <h6 class="card-title"><?= $row->distribusi1 ?></h6>
                                        <h6 class="card-title"><?= $row->distribusi2 ?></h6>
                                        <h6 class="card-title"><?= $row->distribusi3 ?></h6>
                                        <h5 class="card-title">Lokasi Pendistribusian :</h5>
                                        <h6 class="card-title"><?= $row->lokasi ?></h6>
                                        <h5 class="card-title">Target Pendistribusian :</h5>
                                        <h6 class="card-title"><?= $row->target ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>