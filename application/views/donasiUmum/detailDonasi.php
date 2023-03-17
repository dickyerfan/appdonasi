<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-lg-10 col-6">
                            <div class="fw-bold"><?= $title ?></div>
                        </div>
                        <div class="col-lg-2 col-6">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table" width="99%">
                            <thead>
                                <tr class="bg-dark">
                                    <th class=" text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($detailDonasi as $row) : ?>
                                    <tr>
                                        <?php
                                        $namaDonasi = $row->nama_donasi;
                                        $namaDonasi = preg_replace("/[^a-zA-Z0-9\']/", " ", $namaDonasi);
                                        ?>
                                        <td>
                                            <div class="card p-2 shadow-sm border-0" style="background: linear-gradient(to right, #ccf7ff, #fff);">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-4 col-12">
                                                        <div class="card p-1 shadow-sm mb-1 cardEffect2" style="background: linear-gradient(to right, #7FCDCD, #5B5EA6); border:none;">
                                                            <div class="card mb-1" style="border: none;">
                                                                <div class="card-header">
                                                                    <a href="<?= base_url(); ?>donasiUmum/detail/<?= $row->id_donasi ?>/<?= $row->nama_donasi; ?>" style="text-decoration: none; color:black;">
                                                                        <h5 class="card-title mt-1 fw-bold text-uppercase"><?= $namaDonasi ?></h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="card" style="border: none;">
                                                                <div class="card-body">
                                                                    <span style="font-size: .7rem;"><?= $row->deskripsi ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <a href="<?= base_url(); ?>donasiUmum/detail/<?= $row->id_donasi ?>/<?= $row->nama_donasi; ?>">
                                                            <img class="card-img-top mb-1 shadow-sm  cardEffect3" src="<?= base_url('assets/photo/' . $row->photo) ?>">
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <?php
                                                        $id = $row->id_donasi;
                                                        $masuk = $this->db->query("SELECT sum(jml_transaksi) AS masuk FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
                                                        foreach ($masuk as $row) {
                                                            $masuk = $row->masuk;
                                                        }
                                                        $keluar = $this->db->query("SELECT sum(jml_transaksi) AS keluar FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
                                                        foreach ($keluar as $row) {
                                                            $keluar = $row->keluar;
                                                        }
                                                        $saldo = $masuk - $keluar;
                                                        ?>
                                                        <div class="card p-1 shadow-sm mb-1 cardEffect4" style="background: linear-gradient(to right, #7FCDCD, #5B5EA6); border:none;">
                                                            <div class="card mb-1" style="border: none;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-5"><span class="card-text fw-bold text-warning">Penerimaan</span></div>
                                                                        <div class="col-7"><span class="card-text fw-bold text-warning">: Rp. <?= number_format($masuk, 0, ',', '.') ?></span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mb-1" style="border: none;">
                                                                <div class="card" style="border: none;">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-5"><span class="card-text fw-bold text-warning">Pengeluaran</span></div>
                                                                            <div class="col-7"><span class="card-text fw-bold text-warning">: Rp. <?= number_format($keluar, 0, ',', '.') ?></span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card" style="border: none;">
                                                                <div class="card" style="border: none;">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-5"><span class="card-text fw-bold text-warning">Saldo</span></div>
                                                                            <div class="col-7"><span class="card-text fw-bold text-warning">: Rp. <?= number_format($saldo, 0, ',', '.') ?></span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>