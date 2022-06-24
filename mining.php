<?php $thisPage = "MINING DATA";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
  header("location:auth/login-form.php");
}
?>
<?php
require 'partial/headers.php';
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
          <h3 class="m-0"><i class="fas fa-server"></i>&nbsp;DATA MINING</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Mining</li>
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
              <?php if ($jumlah !== 0) { ?>
                <form action="aksi_konversi.php" method="POST" class="d-inline">
                  <button name="submit_konversi" type="submit" class="btn btn-success btn-responsive"><i class="fab fa-cloudscale"></i>&emsp; Konversi Huruf</button>
                </form>
              <?php } ?>
              <?php if ($jumlah2 !== 0) : ?>
                &emsp;<a href="mining_konversi.php" type="button" class="btn btn-warning btn-responsive"><i class="fas fa-eye"></i>&emsp; Lihat Hasil Konversi</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <?php
      if ($jumlah == 0) :
        $msg = "Data training masih kosong"; ?>
        <div style="margin-left: 9px; margin-right: 9px;">
          <div class="col-md-6 col-md-3 alert alert-warning"><i class="fas fa-exclamation-triangle"></i>&emsp;<?php echo $msg; ?></div>
        </div>
      <?php endif; ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <?php
                    echo "Jumlah data : " . $jumlah;
                    ?>
                  </h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>N0</th>
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
                      while ($row = mysql_fetch_array($query)) {
                        if ($warna == $warna1) {
                          $warna = $warna2;
                        } else {
                          $warna = $warna1;
                        }
                      ?>
                        <tr bgcolor=<?php echo $warna; ?> class="text-center">
                          <td><?php echo $no; ?></td>

                          <td>
                            <?php if ($row['jk'] == '1') {
                              echo 'L';
                            } else if ($row['jk'] == '2') {
                              echo 'P';
                            } ?>
                          </td>
                          <td><?php if ($row['ppdb'] == '1') {
                                echo "Perpindahan Orang tua";
                              } else if ($row['ppdb'] == '2') {
                                echo 'Prestasi Akademik';
                              } else if ($row['ppdb'] == '3') {
                                echo 'Prestasi Non-Akademik';
                              } else if ($row['ppdb'] == '4') {
                                echo 'Prestasi Thafidz';
                              } else if ($row['ppdb'] == '5') {
                                echo 'Afirmasi';
                              } else if ($row['ppdb'] == '6') {
                                echo 'Zonasi';
                              } else if ($row['ppdb'] == '7') {
                                echo 'PPLP';
                              }
                              ?>
                          </td>
                          <td>
                            <?php echo $row['bhs_indonesia']; ?>
                          </td>
                          <td>
                            <?php echo $row['matematika']; ?>
                          </td>
                          <td>
                            <?php echo $row['bhs_inggris']; ?>
                          </td>
                          <td>
                            <?php echo $row['ipa']; ?>
                          </td>
                          <td>
                            <?php echo $row['ips']; ?>
                          </td>
                          <td>
                            <?php echo $row['skhu']; ?>
                          </td>
                          <td>
                            <b>
                              <?php echo $row['jurusan']; ?>
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
      </section>
    </div>
  </div>
</div>
<?php include_once ("partial/footers.php");?>
</div>
</body>
</html>