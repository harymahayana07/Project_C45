<?php
session_start();
if (!isset($_SESSION['usr'])) {
  header("location:login-form.php");
}
?>
<?php
require 'partial/sidebar.php';
require 'partial/navbar.php';
include "koneksi.php";
if (isset($_GET['act'])) {
  $action = $_GET['act'];
  $id = $_GET['id'];
  //update data training
  if ($action == 'update') {
    include "update_data_training.php";
  }
  //delete data training
  else if ($action == 'delete') {
    mysql_query("DELETE FROM data_training WHERE id = '$id'");
    header('location:index.php?menu=data');
  }
  //delete semua data
  else if ($action == 'delete_all') {
    mysql_query("TRUNCATE data_training");
    header('location:index.php?menu=data');
  }
} else {
  include "form_data_training.php";
  $query = mysql_query("select * from data_training order by(id)");
  $jumlah = mysql_num_rows($query);
?>
  <style>
    .btn {
      margin-bottom: 8px;
    }

    @media (max-width: 768px) {
      .btn-responsive {
        padding: 2px 4px;
        font-size: 80%;
        line-height: 1;
        border-radius: 3px;
      }
    }

    @media (min-width: 769px) and (max-width: 992px) {
      .btn-responsive {
        padding: 4px 9px;
        font-size: 90%;
        line-height: 1.2;
      }
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Data Training</h1>
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
    <!--  -->
    <div class="container-fluid mt-2">
      <!--  -->
      <div class="row mb-2">
        <!--  -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row" style="float: left;">
              <div class="col-lg-12 col-md-4">
                <button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#tambahData">
                  <i class="fas fa-plus-circle"> Tambah Data</i>
                </button>
                <button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusData">
                  <i class="fas fa-trash-alt"> Hapus Data</i>
                </button>
                <button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#importData">
                  <i class="fas fa-plus-circle"> Import Data</i>
                </button>
              </div>

            </div>
          </div>
        </div>
        <!--  -->
      </div>

      <div class="row" style="float: left;">

        <div class="col-md-12">
          <?php
          if ($jumlah == 0) {
            echo "<center><h3>Data Training masih kosong...</h3></center>";
          } else {
            echo "Jumlah data training: " . $jumlah;
          ?>
            <!--  -->

            <!--  -->
            <table bgcolor='#7c96ba' border="" cellspacing='0' cellspading='0' align='center' width=900>
              <tr></tr>
              <tr align='center'>
                <th>No</th>
                <th>PPDB</th>
                <th>bhs_indonesia</th>
                <th>Matematika</th>
                <th>bhs_inggris</th>
                <th>Ipa</th>
                <th>Ips</th>
                <th>SKHU</th>
                <th><b>Peminatan</b></th>
                <th>Action</th>
              </tr>
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
                <tr bgcolor=<?php echo $warna; ?> align='center'>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['ppdb']; ?></td>
                  <td><?php echo $row['bhs_indonesia']; ?></td>
                  <td><?php echo $row['matematika']; ?></td>
                  <td><?php echo $row['bhs_inggris']; ?></td>
                  <td><?php echo $row['ipa']; ?></td>
                  <td><?php echo $row['ips']; ?></td>
                  <td><?php echo $row['skhu']; ?></td>
                  <td><b><?php echo $row['minat']; ?></b></td>
                  <td>
                    <a href="index.php?menu=data&act=update&id=<?php echo $row['id']; ?>">Update | </a>
                    <a href="data_training.php?act=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?')">Delete</a>
                  </td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </table>
        <?php
          }
        }
        ?>
        </div>
      </div>
    </div>
    <!-- end table -->
  </div>

  <!-- Modal hapus data -->
  <div class="modal fade" id="hapusData" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
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
          <!--  -->
          <a href="index.php?menu=data&act=delete_all" class="btn btn-primary"> Ya </a>
          <!--  -->
        </div>

      </div>
    </div>
  </div>
  <!--  -->
  <!-- Modal import data -->
  <div class="modal fade" id="importData" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5>Import Data Training</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group">
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
  <!--  -->
  <!-- /.content-header -->
  <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
  <?php
  require 'partial/footer.php';
  ?>