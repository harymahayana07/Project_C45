<?php $thisPage = "Dashboard";
include('conn/koneksi.php');
if (!isset($_SESSION['usr'])) {
  header("location:auth/login-form.php");
}
$level = $_SESSION['lvl'];
if ($level == 'siswa') {
  include_once("siswa/index.php");
} else {
  require 'partial/headers.php';
  $query_data = mysql_query("SELECT * FROM data_training ORDER BY(id)");
  $jumlah_data = mysql_num_rows($query_data);
  $query_data2 = mysql_query("SELECT * FROM data_siswa");
  $jumlah_data2 = mysql_num_rows($query_data2);
  $query_data3 = mysql_query("SELECT * FROM hasil_prediksi");
  $jumlah_data3 = mysql_num_rows($query_data3);
  $query_data4 = mysql_query("SELECT * FROM pohon_keputusan");
  $jumlah_data4 = mysql_num_rows($query_data4);
?>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class=" preloader flex-column justify-content-center align-items-center">
        <div class="loading-area">
          <span class="loader"><img src="<?= base_url('dist/img/logo.png') ?>" alt="AdminLTELogo" height="120" width="120"></span>
          <span class="load_anim1"></span>
          <span class="load_anim2"></span>
        </div>
      </div>
      <?php require "partial/navbar.php"; ?>
      <?php require 'partial/sidebar.php'; ?>

      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h3 class="m-0"><i class="fas fa-home"></i>&nbsp;DASHBOARD</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $jumlah_data; ?></h3>
                    <p>Data Training</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-database"></i>
                  </div>
                  <a href="<?= base_url('data_training.php') ?>" class="small-box-footer text-dark">Lihat Data &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $jumlah_data2; ?></h3>
                    <p>Data Siswa</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <a href="<?= base_url('data_user.php') ?>" class="small-box-footer text-dark">Lihat Data &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3 class="text-white"><?php echo $jumlah_data3; ?></h3>
                    <p class="text-white">Hasil Prediksi</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-plus"></i>
                  </div>
                  <a href="<?= base_url('hasil_prediksi.php') ?>" class="small-box-footer text-dark">Lihat Data &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $jumlah_data4; ?></h3>
                    <p>Pohon Keputusan</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file-alt"></i>
                  </div>
                  <a href="<?= base_url('pohon_tree.php') ?>" class="small-box-footer text-dark">Lihat Data &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    <?php
    require 'partial/footers.php';
  }
    ?>