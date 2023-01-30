<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ABY| <?= $title ?></title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- select2 bootstrap5 -->
    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2-bootstrap-5-theme.min.css" />

    <!-- <link href="<?= base_url(); ?>assets/datatables/bootstrap5/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>assets/datatables/bootstrap5/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .bg-primary:hover{
            box-shadow: 2px 2px 10px rgb(0, 0, 0);
            transform: translateY(-6px);
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

        /* setting carousel */
        .img-wrapper{
            max-width:100%;
            height:65vw;
            display:flex;
            justify-content:center;
            /* align-items:flex-start; */
        }

        img{
            max-width:100%;
            max-height:100%;
        }


        @media (max-width:576px) {
            .namaDonasi{
            font-size:1em;
            }
            .fontRupiah {
                font-size:.9em;
            }
        }

        @media (min-width:576px) {
            .carousel-inner{
                display: flex;
            }
            .carousel-item {
                display: block;
                margin-right:0;
                flex: 0 0 calc(100%/3); 
            }
            .img-wrapper{
            height:23vw;
            background-color:skyblue;           
            }

        }
        .carousel-inner {
                padding: 1em;
            }
        .card1{
                margin:0 .5em;
                border:0px;
                border-radius:10;
                box-shadow:2px 6px 8px 0 rgba(22, 22, 26,.18);
                background-color:orange;
            }
        .carousel-control-prev, .carousel-control-next{
            width:6vh;
            height:6vh;
            background-color:#e1e1e1;
            border-radius:50%;
            top:50%;
            transform: translateY(-50%);
        }
        .carousel-control-prev:hover, .carousel-control-next:hover{
            opacity: .8;
        }    
    </style>

</head>

<body class="sb-nav-fixed">