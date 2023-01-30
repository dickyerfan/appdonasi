<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('user/admin/tambah'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Tambah User</button></a>
                </div>
                <div class="p-2">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary text-center">
                                    <th>No</th>
                                    <th>Action</th>
                                    <th>Nama Pengguna</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center">
                                            <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('user/admin/edit/'):'javascript:void(0)' ?><?= $row->id; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data, hanya bisa dilakukan Super Admin"></i></a>
                                            <a href="<?= ($this->session->userdata('level')=='SuperAdmin')? base_url('user/admin/hapus/'):'javascript:void(0)' ?><?= $row->id; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data, hanya bisa dilakukan Super Admin"><i class="fas fa-fw fa-trash"></i></a>
                                        </td>
                                        <td><?= $row->nama_pengguna ?></td>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->level ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>