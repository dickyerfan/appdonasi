<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ABY| <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- select2 bootstrap5 -->
    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2-bootstrap-5-theme.min.css" />

    <link href="<?= base_url(); ?>assets/datatables/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/datatables/bootstrap5/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .cardEffect:hover {
            transition: transform 0.5s;
            box-shadow: 2px 2px 10px rgb(0, 0, 0);
            transform: translateY(-6px) translateX(6px);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(5deg);
            }

            100% {
                transform: rotate(-10deg);
            }
        }

        .cardEffect2:hover {
            box-shadow: 2px 2px 10px rgb(0, 0, 0);
            animation: spin 0.4s ease-in-out;
        }

        .cardEffect3 {
            transition: transform 0.3s ease-in-out;
        }

        .cardEffect3:hover {
            transform: scale(1.03);
        }

        .cardEffect4 {
            transition: transform 0.5s ease-in-out;
        }

        .cardEffect4:hover {
            transform: translateY(35px);
        }

        .judul {
            display: none;
        }

        @media print {

            .header,
            .navbar1 {
                display: none;
            }

            .logo {
                display: none;
            }

            .title {
                text-align: center;
            }

            .font {
                font-size: 0.8rem;
            }

            .judul {
                display: block;
            }
        }

        @media (max-width:460px) {
            .card1 {
                /* height:300px !important; */
                font-size: 0.8em !important;
            }
        }

        /* .bg-primary:hover {
            box-shadow: 2px 2px 10px rgb(0, 0, 0);
            transform: translateY(-6px);
        } */
    </style>

</head>

<body class="sb-nav-fixed">