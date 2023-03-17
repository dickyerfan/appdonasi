<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABY| <?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/kategori.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/bootstrap.min.css" />
</head>

<body>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h4>Ahlan Wasahlan...</h4>
            <p>Silakan login untuk mengetahui lebih banyak tentang <br>ABY Bondowoso</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>
        <div class="register-info-box">
            <h5>Ahlan Wasahlan... <br>di Aplikasi Donasi Online ABY Bondowoso</h5>
            <p>Belum punya akun, <br>Silakan</p>
            <label id="label-login" for="log-login-show">Register</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            <div class="logo">
                <img src="<?= base_url('assets/img/aby.png') ?>" alt="aby.png">
            </div>
            <form method="post" action="<?= base_url('auth') ?>">
                <div class="login-show">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <h2>Silakan LOGIN</h2>
                    <input type="text" name="nama_pengguna" id="nama_pengguna" placeholder="Nama Pengguna" value="<?= set_value('nama_lengkap'); ?>">
                    <?= form_error('nama_pengguna', '<span class="text-danger small">', '</span>'); ?>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <?= form_error('password', '<span class="text-danger small">', '</span>'); ?>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <!-- <a href="index.html">Forgot password?</a> -->
                </div>
            </form>
            <form class="user" method="post" action="<?= base_url('auth/registrasi') ?>">
                <div class="register-show">
                    <?= $this->session->flashdata('info'); ?>
                    <?= $this->session->unset_userdata('info'); ?>
                    <h4>REGISTER</h4>
                    <input type="text" name="nama_pengguna" id="nama_pengguna" placeholder="Masukan Nama pengguna" value="<?= set_value('nama_pengguna'); ?>">
                    <?= form_error('nama_pengguna', '<p class="text-danger small">', '</p>'); ?>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                    <?= form_error('nama_lengkap', '<p class="text-danger small">', '</p>'); ?>
                    <input type="text" name="email" id="email" placeholder="Masukan Alamat email" value="<?= set_value('email'); ?>">
                    <?= form_error('password', '<p class="text-danger small">', '</p>'); ?>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <?= form_error('email', '<p class="text-danger small">', '</p>'); ?>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/datatables/bootstrap5/jquery-3.5.1.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(".login-info-box").fadeOut();
            $(".login-show").addClass("show-log-panel");
        });

        $('.login-reg-panel input[type="radio"]').on("change", function() {
            if ($("#log-login-show").is(":checked")) {
                $(".register-info-box").fadeOut();
                $(".login-info-box").fadeIn();

                $(".white-panel").addClass("right-log");
                $(".register-show").addClass("show-log-panel");
                $(".login-show").removeClass("show-log-panel");
            } else if ($("#log-reg-show").is(":checked")) {
                $(".register-info-box").fadeIn();
                $(".login-info-box").fadeOut();

                $(".white-panel").removeClass("right-log");

                $(".login-show").addClass("show-log-panel");
                $(".register-show").removeClass("show-log-panel");
            }
        });
    </script>
</body>

</html>