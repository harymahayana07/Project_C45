<?php $thisPage = "Dashboard"; ?>
<?php include_once("template/header.php"); ?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
        include_once("template/navbar.php");
        include_once("template/sidebar.php");
        ?>

        <div class="page-wrapper">

            <div class="page-breadcrumb mb-0">
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

                    </div>

                </div>

            </div>
            <div class="container-fluid ">

                <!--  -->
                <div class="col-sm-8 col-sm-6">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Selamat Datang <strong><?= strtolower($_SESSION['lvl']); ?></strong> di Aplikasi Penjurusan !
                    </div>
                </div>
                <div class="col-sm-8 col-sm-6 center alert alert-info mt-2">
                    <div class="row">
                        <div class="col-sm-8 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Langkah Melakukan Penjurusan</h4>
                                    <div class="mt-4 activity">
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i class="icon-check"></i>
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
                                                    <i class="icon-note"></i>
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
                                                    <i class="icon-note"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">Masukkan Data Raport</h5>
                                                <p class="font-14 mb-2 text-muted">Data Ini meliputi Nilai Rata-rata
                                                    Bahasa indonesia, Matematika, bahasa <br>inggris,Ipa, Ips, skhu</p>
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
    </div>
    <?php include_once("template/footer.php"); ?>
</body>

</html>