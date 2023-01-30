<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">

                <div class="nav">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-fw"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="<?= base_url('donasi') ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-dollar fa-fw"></i></div>
                        Daftar Donasi
                    </a>
                    <a class="nav-link" href="<?= base_url('donasiUmum') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-donate fa-fw"></i></div>
                        Donasi Umum
                    </a>
                    <!-- <a class="nav-link" href="<?= base_url('transaksi/pilih') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-keyboard fa-fw"></i></div>
                        Pilih Donasi
                    </a> -->
                    <a class="nav-link" href="<?= base_url('donasiKhusus') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-donate fa-fw"></i></div>
                        Donasi Khusus
                    </a>
                    <a class="nav-link" href="<?= base_url('laporan') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                        Laporan
                    </a>
                    <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#dataUser" aria-expanded="false" aria-controls="dataUser">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                        Data User
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="dataUser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('user/admin') ?>">Data Admin</a>
                            <a class="nav-link" href="<?= base_url('user/user') ?>">Data User</a>
                        </nav>
                    </div> -->
                    <a class="nav-link" href="<?= base_url('user/admin') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                        Data User
                    </a>
                    <a class="nav-link" href="<?= base_url('backup') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database fa-fw"></i></div>
                        Backup Data
                    </a>
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                        Logout
                    </a>
                    <!-- <div class="sb-sidenav-menu-heading">Addons</div> -->
                    <!-- <a class="nav-link" href="<?= base_url('chart') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Master Charts
                    </a>
                    <a class="nav-link" href="<?= base_url('tabel') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Master Tables
                    </a> -->
                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
        </nav>
    </div>