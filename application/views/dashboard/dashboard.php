<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
                        <div class="col-lg-9 col-7">
                            <div class="fw-bold">Yayasan Rumah Sedekah Bondowoso / Aksi Bersama Yatim </div>
                        </div>
                        <div class="col-lg-3 col-5">
                            <a href="<?= base_url('dashboard/ekspor') ?>" target="_blank" class="btn btn-success btn-sm float-end"><i class="fas fa-file-alt"></i> Export PDF</a>
                            <!-- <a id="belum"><button class="btn btn-warning btn-sm"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button></a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                        <h6>Ahlan Wasahlan... <?= $this->session->userdata('nama_lengkap') ?>, <span class="text-danger">Anda Login Sebagai <?= $this->session->userdata('level') ?></span></h6>
                    </marquee>
                    <div class="row justify-content-center mb-1" id="tanya" style="display: none;">
                        <div class="col-md-4">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <h3>Pilih Bulan & Tahun</h3>
                                    <form action="" method="GET">
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
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="add_post" id="tombol_pilih" class="btn btn-block btn-primary">Tampilkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $masuk = $this->db->query("SELECT sum(jml_transaksi) as masuk FROM transaksi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0");
                    foreach ($masuk->result() as $row) {
                        $masuk = $row->masuk;
                    }
                    $jumatMasuk = $this->db->query("SELECT sum(jml_transaksi) as jumatMasuk FROM sedekah_jumat WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0")->result();
                    foreach ($jumatMasuk as $row) {
                        $jumatMasuk = $row->jumatMasuk;
                    }
                    $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE detail_taqur.status_tabungan = 1")->result();
                    foreach ($totalTabungan as $row) {
                        $totalTabungan = $row->totalTabungan;
                    }
                    $masuk = $masuk + $totalTabungan + $jumatMasuk;
                    $keluar = $this->db->query("SELECT sum(jml_transaksi) as keluar FROM transaksi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0");
                    foreach ($keluar->result() as $row) {
                        $keluar = $row->keluar;
                    }
                    $jumatKeluar = $this->db->query("SELECT sum(jml_transaksi) as jumatKeluar FROM sedekah_jumat WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0")->result();
                    foreach ($jumatKeluar as $row) {
                        $jumatKeluar = $row->jumatKeluar;
                    }
                    $keluar = $keluar + $jumatKeluar;
                    $saldo = $masuk - $keluar;

                    $bulan = date('m');
                    $masukBlnIni = $this->db->query("SELECT sum(jml_transaksi) as masukBlnIni FROM transaksi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0 AND month(tgl_transaksi) = $bulan");
                    foreach ($masukBlnIni->result() as $row) {
                        $masukBlnIni = $row->masukBlnIni;
                    }
                    $masukBlnIni2 = $this->db->query("SELECT sum(jml_transaksi) as masukBlnIni2 FROM sedekah_jumat WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0 AND month(tgl_transaksi) = $bulan")->result();
                    foreach ($masukBlnIni2 as $row) {
                        $masukBlnIni2 = $row->masukBlnIni2;
                    }
                    $totalTabunganBlnIni = $this->db->query("SELECT sum(jml_tabungan) as totalTabunganBlnIni FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE detail_taqur.status_tabungan = 1 AND month(tgl_tabungan) = $bulan")->result();
                    foreach ($totalTabunganBlnIni as $row) {
                        $totalTabunganBlnIni = $row->totalTabunganBlnIni;
                    }
                    $masukBlnIni = $masukBlnIni + $masukBlnIni2 + $totalTabunganBlnIni;

                    $keluarBlnIni = $this->db->query("SELECT sum(jml_transaksi) as keluarBlnIni FROM transaksi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0 AND month(tgl_transaksi) = $bulan");
                    foreach ($keluarBlnIni->result() as $row) {
                        $keluarBlnIni = $row->keluarBlnIni;
                    }
                    $keluarBlnIni2 = $this->db->query("SELECT sum(jml_transaksi) as keluarBlnIni2 FROM sedekah_jumat WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0 AND month(tgl_transaksi) = $bulan")->result();
                    foreach ($keluarBlnIni2 as $row) {
                        $keluarBlnIni2 = $row->keluarBlnIni2;
                    }
                    $keluarBlnIni = $keluarBlnIni + $keluarBlnIni2;
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0 bg-warning shadow" style="height:100% ;">
                                <div class="card-body bg-light cardEffect border-start border-warning border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-light">
                                                <h5 class="text-warning text-uppercase">Total Penerimaan</h5>
                                                <h5 class="text-warning">Rp. <?= number_format($masuk, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0 bg-success shadow" style="height:100% ;">
                                <div class="card-body bg-light cardEffect border-start border-success border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-success">
                                                <h5 class="text-uppercase">Total Pengeluaran</h5>
                                                <h5 class="text-success">Rp. <?= number_format($keluar, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0 bg-danger shadow" style="height:100% ;">
                                <div class="card-body bg-light cardEffect border-start border-danger border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-danger">
                                                <h5 class="text-uppercase">Total Saldo</h5>
                                                <h5 class="text-danger">Rp. <?= number_format($saldo, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0 bg-primary shadow" style="height:100% ;">
                                <div class="card-body bg-light cardEffect border-start border-primary border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-primary">
                                                <h6 class="text-uppercase">Total Penerimaan Bulan ini</h6>
                                                <h5 class="text-primary">Rp. <?= number_format($masukBlnIni, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="card border-0 bg-dark shadow" style="height:100% ;">
                                <div class="card-body bg-light cardEffect border-start border-dark border-5 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-dark">
                                                <h6 class="text-uppercase">Total Pengeluaran Bulan ini</h6>
                                                <h5 class="text-dark">Rp. <?= number_format($keluarBlnIni, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-4 mb-4">
                            <div class="card bg-primary border-0 shadow" style="height:100% ;">
                                <div class="card-body border-top border-warning border-5 rounded-top">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-light">
                                                <h6 class="text-uppercase">Total Saldo Bulan ini</h6>
                                                <h5 class="text-warning">Rp. <?= number_format($saldo, 0, ',', '.') ?>,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card">
                                <div class="card-body bg-primary rounded text-light border-top border-warning border-5">
                                    <p>
                                        Aksi Bersama Yatim adalah sebuah komunitas dengan aktivitas kelompok sosial keagamaan, berawal pada bulan April 2019 di Bondowoso oleh sebuah grup WA BERTIGA. Aktifitas ABY berawal dari kepedulian terhadap keluarga anak Yatim di Bondowoso, yang ditindaklanjuti oleh penggalangan donasi lewat media sosial. Seiring berjalannya waktu, Tim inti berkembang dan target ABY meluas kepada kaum dhuafa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <?php
                            $numOfCols = 3;
                            $rowCount = 0;
                            $bootstrapColWidth = 12 / $numOfCols;
                            ?> -->
                    <!-- <h2>DONASI UMUM</h2>
                    <div class="row justify-content-center">
                        <?php foreach ($dashboard as $row) : ?>
                            <div class="col-xl-<?= $bootstrapColWidth; ?> mb-4">
                                <div class="card bg-primary border-0 shadow" style="height:100% ;">
                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                        <div class="row">
                                            <?php
                                            $namaDonasi = $row->nama_donasi;
                                            $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                                            ?>
                                            <div class="col mr-2">
                                                <a href="<?= base_url(); ?>dashboard/detail/<?= $row->id_donasi; ?>/<?= $row->nama_donasi ?>" class="text-decoration-none fw-bold text-light text-uppercase">
                                                    <h5><?= $namaDonasi ?></h5>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-donate fa-2x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $rowCount++;
                            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                        endforeach; ?>
                    </div> -->
                </div>
            </div>
        </div>
    </main>