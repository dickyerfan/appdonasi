<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('donasi/tambah'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Tambah Donasi</button></a>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Action</th>
                                            <th class=" text-center">Nama Donasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($donasi as $row) :
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url(); ?>donasi/edit/<?= $row->id_donasi; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                                    <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('donasi/hapus/'):'javascript:void(0)' ?><?= $row->id_donasi; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data, hanya bisa dilakukan Super Admin"><i class="fas fa-fw fa-trash"></i></a>
                                                    <a href="<?= base_url(); ?>donasi/detail/<?= $row->id_donasi; ?>" class="text-success" data-bs-toggle="tooltip" title="Detail data"><i class="fa-solid fa-circle-info"></i></a>
                                                </td>
                                                <td class="fw-bold"><?= $row->nama_donasi ?></td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/donasi2.jpg') ?>" alt="" class="img-fluid shadow" width="345px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>