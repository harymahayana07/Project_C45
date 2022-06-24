<?php $thisPage = "MINING DATA";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
  header("location:auth/login-form.php");
}
?>
<?php
require 'partial/headers.php';
if (isset($_GET['act'])) {
  $action = $_GET['act'];
  //delete semua data
  if ($action == 'delete_all') {
    mysql_query("TRUNCATE data_training_konversi");
    header('location:mining_konversi.php?status_hapus_all=sukses-hapus-all');
  }
}
?>
<?php
require 'partial/sidebar.php';
require 'partial/navbar.php';
$query = mysql_query("select * from data_training order by(id)");
$query2 = mysql_query("select * from data_training_konversi order by(id)");
$jumlah = mysql_num_rows($query);
$jumlah2 = mysql_num_rows($query2);

?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="m-0"><i class="fas fa-server"></i>&nbsp;MINING KONVERSI DATA</h3>
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
  <div class="container-fluid mt-2">
    <div class="row mb-2">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row" style="float: right;">
            <div class="col-lg-12 col-md-4">
              <a href="mining.php" type="button" class="btn btn-success btn-responsive"><i class="fas fa-backward"></i>&emsp; Kembali</a>&nbsp;
              <button type="submit" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusKonversi">
                <i class="fas fa-trash-alt"></i></i>&emsp;Reset
              </button>&nbsp;
              <?php if ($jumlah2 !== 0) : ?>
                <form method="POST" action='' class="d-inline">
                  <button type="submit" name="submit_mining" class="btn btn-primary btn-responsive">
                    <i class="fas fa-hourglass-end"></i>&emsp;Proses Mining
                  </button>
                </form>&emsp;
              <?php endif; ?>
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
                      <a href="mining_konversi.php?act=delete_all" class="btn btn-primary"> Ya </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <section class="content">

        <?php
        $msg = "Data Belum Dikonversi";
        if ($jumlah2 == 0) : ?>
          <div style="margin-left: 9px; margin-right: 9px;">
            <div class="col-md-6 col-md-3 alert alert-warning"><i class="fas fa-exclamation-triangle"></i>&emsp;<?php echo $msg; ?></div>
          </div>
        <?php endif; ?>
        <?php
        $status = isset($_GET['status_konversi']) ? $_GET['status_konversi'] : '';
        $msg = '';
        switch ($status):
          case 'sukses_konversi':
            $msg = 'Semua Data mining berhasil di konversi';
            break;
        endswitch;

        if ($msg) : ?>
          <div style="margin-left: 9px; margin-right: 9px;">
            <div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="mining_konversi.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
          </div>
        <?php endif; ?>

        <?php
        $status = isset($_GET['status_hapus_all']) ? $_GET['status_hapus_all'] : '';
        $msg = '';
        switch ($status):
          case 'sukses-hapus-all':
            $msg = 'Semua Data berhasil dihapus';
            break;
        endswitch;

        if ($msg) : ?>
          <div style="margin-left: 9px; margin-right: 9px;">
            <div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="mining_konversi.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
          </div>
        <?php endif; ?>

        <?php
        if (isset($_POST['submit_mining'])) {
        ?>
        
            <div class=" card">
              <div class="card-body">
                <?php include "proses_mining.php"; ?>
              </div>
            </div>
        
        <?php
        }else{
        ?>
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
                <div class="card-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jk</th>
                        <th>Ppdb</th>
                        <th>Bhs Indonesia</th>
                        <th>Matematika</th>
                        <th>Bhs Inggris</th>
                        <th>Ipa</th>
                        <th>Ips</th>
                        <th>Skhu</th>
                        <th>Jurusan</th>
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
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </section>
    </div>
  </div>
</div>
<?php include_once("partial/footers.php"); ?>

</div>
</body>

</html>