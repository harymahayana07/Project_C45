<?php $thisPage = "PREDIKSI";
require_once 'conn/koneksi.php';
require_once 'conn/general.php';
if (!isset($_SESSION['usr'])) {
    header("location:auth/login-form.php");
}
?>
<?php include_once("siswa/template/header.php"); ?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
        include_once("siswa/template/navbar.php");
        include_once("siswa/template/sidebar.php");
        ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb mb-0">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home / Profile </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid ">

                <?php
                $nisn = $_SESSION['usr'];
                $nama = $_SESSION['nama'];
                $lvl = $_SESSION['lvl'];
                ?>
                <div class="card-body" style="color: black; background-color: #dee0e3;">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="row">
                                <label for="math" class="col-lg-2">Nisn siswa </label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" id="math" class="form-control" value="<?= $_SESSION['usr'] ?>" disabled autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="math" class="col-lg-2">Nama siswa </label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" id="math" class="form-control" value="<?= $_SESSION['nama'] ?>" disabled autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="math" class="col-lg-2">Status </label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" id="math" class="form-control" value="<?= strtoupper($_SESSION['lvl']); ?> SMAN 2 MATARAM" disabled autocomplete="off">
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
    <?php include_once("siswa/template/footer.php") ?>
</body>

</html>