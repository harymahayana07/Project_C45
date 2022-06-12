<?php
require_once "../conn/koneksi.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('siswa/package/src/assets/images/favicon.png') ?>">
    <title>Adminmart Template - Dashboard</title>
    <!-- Custom CSS -->
    <link href="<?= base_url('siswa/package/src/assets/extra-libs/c3/c3.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('siswa/package/src/assets/libs/chartist/dist/chartist.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('siswa/package/src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= base_url('siswa/package/src/dist/css/style.min.css') ?>" rel="stylesheet">


</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <div class="navbar-brand">
                        <a href="index.html">
                            <b class="logo-icon">
                                <img src="<?= base_url('siswa/package/src/assets/images/logo-icon.png') ?>" alt="homepage" class="dark-logo" />
                                <img src="<?= base_url('siswa/package/src/assets/images/logo-icon.png') ?>" alt="homepage" class="light-logo" />
                            </b>
                            <span class="logo-text">
                                <img src="<?= base_url('siswa/package/src/assets/images/logo-text.png') ?>" alt="homepage" class="dark-logo" />
                                <img src="<?= base_url('siswa/package/src/assets/images/logo-light-text.png') ?>" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="settings" class="svg-icon"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>EN</option>
                                        <option value="1">AB</option>
                                        <option value="2">AK</option>
                                        <option value="3">BE</option>
                                    </select>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white" type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= base_url('dist/img/user-bg-dark.png') ?>" alt="user" class="rounded-circle" width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark">Jason Doe</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="credit-card" class="svg-icon mr-2 ml-1"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail" class="svg-icon mr-2 ml-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="pl-4 p-3"><a href="javascript:void(0)" class="btn btn-sm btn-info">View
                                        Profile</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php require_once "template/sidebar.php"; ?>

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1 mt-3">Selamat Datang Di Website Penjurusan nama_s</h3>
                    </div>

                </div>
            </div>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6 col-lg-8">
                        <div class="card" style="height: 400px;">
                            apa isinya
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Langkah Melakukan Penjurusan</h4>
                                <div class="mt-4 activity">
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Check Biodata Diri!</h5>
                                            <p class="font-14 mb-2 text-muted"> Biodata ini meliputi Nama, Asal <br>sekolah Dan Nisn
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                                <i data-feather="message-square"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Masukkan Data Diri</h5>
                                            <p class="font-14 mb-2 text-muted">Data Ini Hanya Berisi <br>
                                                Jalur PPDB & Jenis Kelamin</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                                <i data-feather="message-square"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Masukkan Data Raport</h5>
                                            <p class="font-14 mb-2 text-muted">Data Ini meliputi Nilai Rata-rata <br>
                                                Bahasa indonesia,Matematika,bahasa <br>inggris,Ipa, Ips, skhu</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                <i data-feather="bell"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Penjurusan Selesai!
                                            </h5>
                                            <p class="font-14 mb-2 text-muted">Hasil Akan Keluar dan akan<br> Menentukan Penjurusan Anda</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="<?= base_url('siswa/package/src/assets/libs/jquery/dist/jquery.min.js">') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/libs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/dist/js/app-style-switcher.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/dist/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/dist/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/dist/js/custom.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/extra-libs/c3/d3.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/extra-libs/c3/c3.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/libs/chartist/dist/chartist.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') ?>/"></script>
    <script src="<?= base_url('siswa/package/src/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script src="<?= base_url('siswa/package/src/dist/js/pages/dashboards/dashboard1.min.js') ?>"></script>
</body>

</html>