<?php $thisPage = "MINING DATA";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
  header("location:auth/login-form.php");
}
?>
<?php
require 'partial/header.php';

if (isset($_GET['act'])) {
  $action = $_GET['act'];
  //delete semua data
  if ($action == 'delete_all') {
    mysql_query("TRUNCATE data_training_konversi");
    header('location:mining_konversi.php');
  }
}
?>
<?php

$query = mysql_query("select * from data_training order by(id)");
$query2 = mysql_query("select * from data_training_konversi order by(id)");
$jumlah = mysql_num_rows($query);
$jumlah2 = mysql_num_rows($query2);
while ($row = mysql_fetch_array($query)) {
  // $row2 = mysql_fetch_array($query2);

  // jenis kelamin
  $jk = $row['jk'];
  // ppdb
  $ppdb = $row['ppdb'];
  // bhs_indonesia
  $bhs_indonesia = $row['bhs_indonesia'];
  if ($bhs_indonesia >= 92 && $bhs_indonesia <= 100) {
    $bhs_indonesia = "A";
  } else if ($bhs_indonesia >= 84 && $bhs_indonesia < 92) {
    $bhs_indonesia = "B";
  } else if ($bhs_indonesia >= 76 && $bhs_indonesia < 84) {
    $bhs_indonesia = "C";
  } else if ($bhs_indonesia >= 70 && $bhs_indonesia < 76) {
    $bhs_indonesia = "D";
  } else if ($bhs_indonesia >= 65  && $bhs_indonesia < 70) {
    $bhs_indonesia = "E";
  } else {
    $bhs_indonesia = "Tidak Lulus";
  }

  // matematika
  $matematika = $row['matematika'];
  if ($matematika >= 92 && $matematika <= 100) {
    $matematika = "A";
  } else if ($matematika >= 84 && $matematika < 92) {
    $matematika = "B";
  } else if ($matematika >= 76 && $matematika < 84) {
    $matematika = "C";
  } else if ($matematika >= 70 && $matematika < 76) {
    $matematika = "D";
  } else if ($matematika >= 65  && $matematika < 70) {
    $matematika = "E";
  } else {
    $matematika = "Tidak Lulus";
  }

  // bhs_inggris
  $bhs_inggris = $row['bhs_inggris'];
  if ($bhs_inggris >= 92 && $bhs_inggris <= 100) {
    $bhs_inggris = "A";
  } else if ($bhs_inggris >= 84 && $bhs_inggris < 92) {
    $bhs_inggris = "B";
  } else if ($bhs_inggris >= 76 && $bhs_inggris < 84) {
    $bhs_inggris = "C";
  } else if ($bhs_inggris >= 70 && $bhs_inggris < 76) {
    $bhs_inggris = "D";
  } else if ($bhs_inggris >= 65  && $bhs_inggris < 70) {
    $bhs_inggris = "E";
  } else {
    $bhs_inggris = "Tidak Lulus";
  }

  // ipa
  $ipa = $row['ipa'];
  if ($ipa >= 92 && $ipa <= 100) {
    $ipa = "A";
  } else if ($ipa >= 84 && $ipa < 92) {
    $ipa = "B";
  } else if ($ipa >= 76 && $ipa < 84) {
    $ipa = "C";
  } else if ($ipa >= 70 && $ipa < 76) {
    $ipa = "D";
  } else if ($ipa >= 65  && $ipa < 70) {
    $ipa = "E";
  } else {
    $ipa = "Tidak Lulus";
  }

  // ips
  $ips = $row['ips'];
  if ($ips >= 92 && $ips <= 100) {
    $ips = "A";
  } else if ($ips >= 84 && $ips < 92) {
    $ips = "B";
  } else if ($ips >= 76 && $ips < 84) {
    $ips = "C";
  } else if ($ips >= 70 && $ips < 76) {
    $ips = "D";
  } else if ($ips >= 65  && $ips < 70) {
    $ips = "E";
  } else {
    $ips = "Tidak Lulus";
  }

  // skhu
  $skhu = $row['skhu'];
  if ($skhu >= 92 && $skhu <= 100) {
    $skhu = "A";
  } else if ($skhu >= 84 && $skhu < 92) {
    $skhu = "B";
  } else if ($skhu >= 76 && $skhu < 84) {
    $skhu = "C";
  } else if ($skhu >= 70 && $skhu < 76) {
    $skhu = "D";
  } else if ($skhu >= 65  && $skhu < 70) {
    $skhu = "E";
  } else {
    $skhu = "Tidak Lulus";
  }
  // jurusan
  $jurusan = $row['jurusan'];

  if (isset($_POST['submit_konversi'])) {
    mysql_query("INSERT INTO data_training_konversi 
			                      	(jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan)
                            VALUES(
                              '$jk',
                              '$ppdb',
                              '$bhs_indonesia',
                              '$matematika',
                              '$bhs_inggris',
                              '$ipa',
                              '$ips',
                              '$skhu',
                              '$jurusan'
                            )");

    header('location:mining_konversi.php');
  }
}

if ($jumlah == 0) {
  echo "<center><h3>Data Belum Dikonversi...</h3></center>";
} else {
  if (isset($_POST['submit_mining'])) {
?>
<?php
    require 'partial/sidebar.php';
    require 'partial/navbar.php';
?>
    <div class="content-wrapper">
      <div class=" card">
        <div class="card-body">
          <?php include "proses_mining.php"; ?>
        </div>
      </div>
    </div>

  <?php
  } else {
    require 'partial/sidebar.php';
    require 'partial/navbar.php';
  ?>
    <!--  -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="m-0">MINING KONVERSI DATA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Mining</li>
                <li class="breadcrumb-item active">Konversi</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="container-fluid mt-2">
        <!--  -->
        <div class="row mb-2">
          <!--  -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12 col-md-4">
                  <a href="mining.php" type="button" class="btn btn-success btn-sm btn-responsive"><i class="fas fa-backward"></i>&emsp; Kembali</a>&emsp;
                  <button type="submit" class="btn btn-danger btn-sm btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusKonversi">
                    <i class="fas fa-trash-alt"></i></i>&emsp;Reset
                  </button>&emsp;

                  <form method="POST" action='' class="d-inline">
                    <button type="submit" name="submit_mining" class="btn btn-primary btn-sm btn-responsive">
                      <i class="fas fa-hourglass-end"></i>&emsp;Proses Mining
                    </button>
                  </form>&emsp;
                  <a href="<?= base_url('mining_konversi.php') ?>" type="button" class="btn btn-success btn-sm btn-responsive"><i class="fas fa-sync"></i>&emsp; Refresh</a>&emsp;

                  <!--  -->
                  <!-- Modal hapus data -->
                  <div class="modal fade" id="hapusKonversi" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-warning">
                          <h5>Hapus Data Mining Konversi</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Yakin Hapus Semua Data ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <!--  -->
                          <a href="mining_konversi.php?act=delete_all" class="btn btn-primary"> Ya </a>
                          <!--  -->
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!--  -->
        </div>


        <!--  -->
        <div class="wrapper">
          <section class="content">
            <div class="container-fluid">

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">

                        <?php
                        echo "Jumlah data : " . $jumlah2;

                        ?>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>JENIS KELAMIN</th>
                            <th>PPDB</th>
                            <th>BAHASA INDONESIA</th>
                            <th>MATEMATIKA</th>
                            <th>BAHASA INGGRIS</th>
                            <th>IPA</th>
                            <th>IPS</th>
                            <th>SKHU</th>
                            <th>JURUSAN</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $warna1 = '#ffffff';
                          $warna2 = '#f5f5f5';
                          $warna  = $warna1;
                          $no = 1;

                          while ($row2 = mysql_fetch_array($query2)) {
                            if ($warna == $warna1) {
                              $warna = $warna2;
                            } else {
                              $warna = $warna1;
                            }
                          ?>
                            <tr bgcolor=<?php echo $warna; ?> class="text-center">
                              <td><?php echo $no; ?></td>
                              <td>
                                <?php if ($row2['jk'] == '1') {
                                  echo 'L';
                                } else if ($row2['jk'] == '2') {
                                  echo 'P';
                                } ?>
                              </td>
                              <td><?php if ($row2['ppdb'] == '1') {
                                    echo 'Perpindahan Orang tua';
                                  } else if ($row2['ppdb'] == '2') {
                                    echo 'Prestasi Akademik';
                                  } else if ($row2['ppdb'] == '3') {
                                    echo 'Prestasi Non-Akademik';
                                  } else if ($row2['ppdb'] == '4') {
                                    echo 'Prestasi Thafidz';
                                  } else if ($row2['ppdb'] == '5') {
                                    echo 'Afirmasi';
                                  } else if ($row2['ppdb'] == '6') {
                                    echo 'Zonasi';
                                  } else if ($row2['ppdb'] == '7') {
                                    echo 'PPLP';
                                  }
                                  ?>
                              </td>
                              <td>
                                <?php echo $row2['bhs_indonesia']; ?>
                              </td>
                              <td>
                                <?php echo $row2['matematika']; ?>
                              </td>
                              <td>
                                <?php echo $row2['bhs_inggris']; ?>
                              </td>
                              <td>
                                <?php echo $row2['ipa']; ?>
                              </td>
                              <td>
                                <?php echo $row2['ips']; ?>
                              </td>
                              <td>
                                <?php echo $row2['skhu']; ?>
                              </td>
                              <td>
                                <b>
                                  <?php echo $row2['jurusan']; ?>
                                </b>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                  <?php
                }
              }
                  ?>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
          </section>
          <!--  -->
        </div>
      </div>
    </div>

    <!--  -->
    <script src="<?= base_url('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

    <!-- Page specific script -->
    <script>
      $(function() {
        $("#example1")
          .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });
    </script>

    <footer class="main-footer">
      <strong>Copyright &copy; 2021-2022 <i>Ni Luh Putu Sri Astiti</i> </strong>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    </div>
    </body>

    </html>