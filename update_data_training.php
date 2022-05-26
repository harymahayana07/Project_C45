<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMANDA | DATA TRAINING</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<?php
require 'partial/navbar.php';
require 'partial/sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">UPDATE DATA TRAINING</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Training</li>
            <li class="breadcrumb-item active">Update</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="container-fluid mt-2">
    <!--  -->
    <div class="col-md-6">
      <!--  -->
      <div class="content-header">
        <div class="container-fluid">
          <?php
          $query = mysql_query("SELECT * FROM data_training WHERE id='$_GET[id]'");
          //$result = mysqli_query($conn, $query);
          $row = mysql_fetch_array($query);
          $ppdb = $row[1];
          $ppdb = $row[2];
          $bhs_indonesia = $row[3];
          $matematika = $row[4];
          $bhs_inggris = $row[5];
          $ipa = $row[6];
          $ips = $row[7];
          $skhu = $row[8];
          $jurusan = $row[9];
          if (isset($_POST['submit_data_training'])) {
            mysql_query("UPDATE data_training SET
                     jk = '$_POST[jk]',
                     ppdb = '$_POST[txtppdb]',
                     bhs_indonesia = '$_POST[txtbhs_id]',
                     matematika = '$_POST[txtmtk]',
                     bhs_inggris = '$_POST[txtbhs_ing]',
                     ipa = '$_POST[txtipa]',
                     ips = '$_POST[txtips]',
                     skhu = '$_POST[txtskhu]',
                     jurusan = '$_POST[peminatan]'
                     WHERE id = '$_GET[id]'");
            echo "<center><h3>Berhasil update</h3></center>";
          } else {
          ?>
            <!-- Input addon -->
            <div class="card">
              <div class="card-body">

                <!-- jk -->
                <form method="post" action="">
                  <div class="form-group">
                    <label for="jk1">PPDB :</label>
                    <select id="jk1" name="jk" class="form-control" required autofocus>
                      <option value="1" <?php if ($jk == '1') {
                                          echo 'selected';
                                        } ?>>Laki-laki</option>
                      <option value="2" <?php if ($jk == '2') {
                                          echo 'selected';
                                        } ?>>Perempuan</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="ppdb">PPDB :</label>
                    <select name="txtppdb" id="ppdb" class="form-control" required>
                      <option value="1" <?php if ($ppdb == '1') {
                                          echo 'selected';
                                        } ?>>Perpindahan Orang tua</option>
                      <option value="2" <?php if ($ppdb == '2') {
                                          echo 'selected';
                                        } ?>>Prestasi Akademik</option>
                      <option value="3" <?php if ($ppdb == '3') {
                                          echo 'selected';
                                        } ?>>Prestasi Non-Akademik</option>
                      <option value="4" <?php if ($ppdb == '4') {
                                          echo 'selected';
                                        } ?>>Prestasi Thafidz</option>
                      <option value="5" <?php if ($ppdb == '5') {
                                          echo 'selected';
                                        } ?>>Afirmasi</option>
                      <option value="6" <?php if ($ppdb == '6') {
                                          echo 'selected';
                                        } ?>>Zonasi</option>
                      <option value="7" <?php if ($ppdb == '7') {
                                          echo 'selected';
                                        } ?>>PPLP</option>
                    </select>
                  </div>
                  <!-- Nilai bahasa indonesia -->
                  <div class="form-group">
                    <label for="indo">Nilai Bahasa Indonesia :</label>
                    <input type="text" name="txtbhs_id" value=<?php echo $bhs_indonesia; ?> id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- Nilai Matematika -->
                  <div class="form-group">
                    <label for="math">Nilai Matematika :</label>
                    <input type="text" name="txtmtk" value=<?php echo $matematika; ?> id="math" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- Nilai bahasa inggris -->
                  <div class="form-group">
                    <label for="ing">Nilai Bahasa Inggris :</label>
                    <input type="text" name="txtbhs_ing" value=<?php echo $bhs_inggris; ?> id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- Nilai ipa -->
                  <div class="form-group">
                    <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                    <input type="text" name="txtipa" value=<?php echo $ipa; ?> id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- Nilai ips -->
                  <div class="form-group">
                    <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                    <input type="text" name="txtips" value=<?php echo $ips; ?> id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- Nilai skhu -->
                  <div class="form-group">
                    <label for="hu">Nilai SKHU :</label>
                    <input type="text" name="txtskhu" value=<?php echo $skhu; ?> id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                  </div>
                  <!-- jurusan jurusan -->
                  <div class="form-group">
                    <label for="jp">Jurusan Peminatan :</label>
                    <br>
                    <input type='radio' name='peminatan' value='MIPA' <?php if ($jurusan == 'MIPA') {
                                                                        echo 'checked';
                                                                      } ?> required="required"> MIPA &nbsp;&nbsp;&nbsp;
                    <input type='radio' name='peminatan' value='IPS' <?php if ($jurusan == 'IPS') {
                                                                        echo 'checked';
                                                                      } ?> required="required"> IPS &nbsp;&nbsp;&nbsp;
                  </div>
                  <!--  -->
              </div>
              <!-- /.card-body -->
            </div>

            <div>
              <a href='index.php?menu=data' class="btn btn-secondary" accesskey='5' title='Kembali'> Kembali </a>
              <input type="submit" name="submit_data_training" class="btn btn-primary" value="Simpan">
            </div>
            </form>
        </div>
      </div>
    </div>

  <?php
          }

  ?>
  </div>