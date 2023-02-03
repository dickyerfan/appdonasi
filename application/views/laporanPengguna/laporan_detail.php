<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header title">
                    <div class="row">
                    <?php 
                        $namaDonasi = $this->uri->segment(4);
                        $namaDonasi = preg_replace("/[^a-zA-Z\']/", " ", $namaDonasi);
                    ?>
                        <div class="col-7">
                            <a class="fw-bold text-dark logo" style="text-decoration:none ;"><?= strtoupper($title) ?> <?= strtoupper($namaDonasi)  ?></a>
                        </div>  
                        <?php
                                $nama_id = $this->uri->segment(3);
                                $nama_donasi = $this->uri->segment(4);
                            ?>
                        <div class="col-5">
                            <a href="<?= $url_cetak; ?>" target="_blank" class="btn btn-success btn-sm logo"><i class="fas fa-file-alt"></i> Export PDF</a>
                            <a id="belum"><button class="btn btn-warning btn-sm logo"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button></a>
                            <a href="<?= base_url('laporanPengguna'); ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mb-1" id="tanya" style="display: none;">
                        <div class="col-md-4">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <h3>Pilih Bulan & Tahun</h3>
                                    <?php
                                    $nama_id = $this->uri->segment(3);
                                    $nama_donasi = $this->uri->segment(4);
                                    ?>
                                    <form action="<?= base_url('laporanPengguna/detail') ?>/<?= $nama_id ?>/<?= $nama_donasi ?>" method="GET">
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
                                            <button type="submit" name="add_post" id="tombol_pilih" class="btn btn-block btn-primary">Pilih</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $bln = $this->input->post('bulan', true);
                        $tahun = $this->input->post('tahun', true);
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
                        function tgl_indo($tanggal)
                        {
                            $bulan = array(
                                1 =>   'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            );
                            $pecahkan = explode('-', $tanggal);

                            // variabel pecahkan 0 = tanggal
                            // variabel pecahkan 1 = bulan
                            // variabel pecahkan 2 = tahun

                            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                        }
                        ?>
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm table-responsive">
                                <thead>

                                    <tr class="text-center font">
                                        <th scope="col">NO</th>
                                        <th scope="col">Nama Transaksi</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Penerimaan (Rp)</th>
                                        <th scope="col">Pengeluaran (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transaksi as $row) :
                                    ?>
                                        <tr class="font">
                                            <th scope="row" class="text-center"><?= $no++ ?></th>
                                            <td><?= $row->nama_transaksi ?></td>
                                            <!-- <?php $tanggal = date('d M Y', strtotime($row->tgl_transaksi)); ?> -->
                                            <td class="text-center"><?= tgl_indo($row->tgl_transaksi)  ?></td>
                                            <td class="text-end"><?= $row->jenis_transaksi == 'Penerimaan' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : '-' ?></td>
                                            <td class="text-end"><?= $row->jenis_transaksi == 'Pengeluaran' ? number_format($row->jml_transaksi, '0', ',', '.') . ',-' : '-' ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="font">
                                        <th colspan="3" class="text-center">Total</th>
                                        <th class="text-end"><?= number_format($totalMasuk, '0', ',', '.')  ?>,-</th>
                                        <th class="text-end"><?= number_format($totalKeluar, '0', ',', '.')  ?>,-</th>
                                    </tr>
                                    <tr class="font">
                                        <th colspan="3" class="text-center">Saldo Akhir</th>
                                        <th class="text-end" colspan="2"><?= number_format($saldo, '0', ',', '.')  ?>,-</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>