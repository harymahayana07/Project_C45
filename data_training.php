<?php $thisPage = "DATA TRAINING";
require_once 'conn/koneksi.php';
require_once 'conn/general.php';
if (!isset($_SESSION['usr'])) {
  header("location:auth/login-form.php");
}
?>

<?php
include_once ("partial/headers.php");
require_once "partial/navbar.php";
if (isset($_GET['act'])) {
  $action = $_GET['act'];
  $id = $_GET['id'];
  if ($action == 'update') {
    include "update_data_training.php";
  } else if ($action == 'delete') {
    mysql_query("DELETE FROM data_training WHERE id = '$id'");
    header('location:data_training.php?status_hapus=sukses-hapus');
  } else if ($action == 'delete_all') {
    mysql_query("TRUNCATE data_training");
    header('location:data_training.php?status_hapus_all=sukses-hapus-all');
  }
} else {
  require 'partial/sidebar.php';
  include "form_data_training.php";
  $query = mysql_query("select * from data_training order by(id)");
  $jumlah = mysql_num_rows($query);
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3 class="m-0"><i class="fas fa-server"></i>&nbsp;DATA TRAINING</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Data Training</li>
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
                <button type="button" class="btn bg-info btn-responsive" data-bs-toggle="modal" data-bs-target="#tambahDataTraining">
                  <i class="fas fa-plus-square"></i> Tambah Data
                </button>
                <button type="button" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusDataTraining">
                  <i class="fas fa-trash-alt"></i></i> Reset
                </button>
                <div class="modal fade" id="hapusDataTraining" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h5>Hapus Data Training</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Yakin Hapus Semua Data ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <a href="data_training.php?act=delete_all" class="btn btn-primary"> Ya </a>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-success btn-responsive" data-bs-toggle="modal" data-bs-target="#importDataTraining">
                  <i class="fas fa-upload"></i> Import
                </button>
                <div class="modal fade" id="importDataTraining" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h5>Import Data Training</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <p><span style="color: red;">*</span>type file harus xls (Excel 97 - 2003).</p>
                          <label for="exampleInputFile">Input File : </label>
                          <div class="input-group">

                            <form method="POST" enctype="multipart/form-data" action="upload.php?data=training">
                              <div class="custom-file">
                                <input type="file" name="userfile">
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input name="upload" type="submit" value="import">
                      </div>
                      </form>
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
        <?php include_once("partial/flash_massage_training.php");?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <?php
                    if ($jumlah == 0) {
                      $msg = "Data Training masih kosong";
                      echo '<div class="alert alert-warning py- mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
                    } else {
                      echo "Jumlah data training :&nbsp;" . $jumlah;
                    }
                    ?>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jk</th>
                          <th>PPDB</th>
                          <th>Bhs Indonesia</th>
                          <th>Matematika</th>
                          <th>Bhs Inggris</th>
                          <th>Ipa</th>
                          <th>Ips</th>
                          <th>Skhu</th>
                          <th>Jurusan</th>
                          <th>Aksi</th>
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
                                  echo 'Perpindahan Orang tua';
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
                            <td><?php echo $row['bhs_indonesia']; ?></td>
                            <td><?php echo $row['matematika']; ?></td>
                            <td><?php echo $row['bhs_inggris']; ?></td>
                            <td><?php echo $row['ipa']; ?></td>
                            <td><?php echo $row['ips']; ?></td>
                            <td><?php echo $row['skhu']; ?></td>
                            <td><b><?php echo $row['jurusan']; ?></b></td>
                            <td>
                              <a href="data_training.php?act=update&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-responsive btn-sm d-inline"><i class="fas fa-edit"></i></a>
                              <a href="data_training.php?act=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-responsive btn-sm d-inline" onclick="return confirm('Apakah anda yakin akan menghapus data?')"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                      <?php
                          $no++;
                        }
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
<?php include_once("partial/footers.php");?>
  </div>
  </body>
</html>