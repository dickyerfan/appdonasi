<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <img src="<?= base_url('assets/img/aby.png') ?>" class="navbar-brand ps-3 logo" style="width:50px ;">
    <a class="navbar-brand ps-2 mt-2 logo" href="<?= base_url('dashboard') ?>">
        <h6>YRSB / ABY<br> Bondowoso</h6>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold logo" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $this->session->userdata('nama_lengkap'); ?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= base_url('password') ?>"><i class="fa-solid fa-unlock-keyhole fa-fw"></i> Ganti Password</a></li>
                <li><a class="dropdown-item" href="<?= base_url('password/profil') ?>"><i class="fa-solid fa-id-card fa-fw"></i> Profil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-right-from-bracket fa-fw"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>