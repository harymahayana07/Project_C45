<?php
require 'sidebar.php';
require 'navbar.php';
?>
<?php
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
  $query=mysql_query("select * from data_training order by(id)");
	$jumlah=mysql_num_rows($query);	
?>
  <style>
    .btn {
      margin-bottom: 8px;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="background-color: #89cff0; border-radius: 5px;">
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

    <div class="container-fluid mt-2">
      <!--  -->
      <div class="row mb-2" style="float: left;">

        <div class="col-xl-4 col-6">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
            <i class="fas fa-plus-circle"> Tambah Data</i>
          </button>
        </div>

        <div class="col-lg-4 col-6">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#hapusData">
            <i class="fas fa-trash-alt"> Hapus Data</i>
          </button>
        </div>

        <div class="col-md-4 col-6">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importData">
            <i class="fas fa-plus-circle"> Import Data</i>
          </button>
        </div>

      </div>

    </div>

  </div>

  <!-- Modal tambah data -->
  <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        
          <div class="modal-header bg-info">
            <h5 class="modal-title" id="tambahDataModal">Tambah Data Training</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <!-- Input addon -->
            <!--  -->
            <div class="card card-info">
              <div class="card-body">

                <!-- ppdb -->
                <form method="post" action="">
                <div class="form-group">

                  <label for="ppdb">PPDB :</label>

                  <select name="txtppdb" id="ppdb" class="form-control" required autofocus>
                    <option value=""> <i>---Pilih--- <i class="bi bi-caret-down-fill"></i></i> </option>
                    <option value="Prestasi Akademik">Prestasi Akademik</option>
                    <option value="Prestasi Non-Akademik">Prestasi Non-Akademik</option>
                    <option value="Prestasi Tahfidz">Prestasi Tahfidz</option>
                    <option value="Afirmasi">Afirmasi</option>
                    <option value="PPLP">PPLP</option>
                    <option value="Zonasi">Zonasi</option>
                    <option value="Perpindahan Orang tua">Perpindahan Orang tua</option>
                  </select>

                </div>
                <!-- Nilai bahasa indonesia -->
                <div class="form-group">
                  <label for="indo">Nilai Bahasa Indonesia :</label>
                  <input type="text" name="txtbhs_id" id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- Nilai Matematika -->
                <div class="form-group">
                  <label for="math">Nilai Matematika :</label>
                  <input type="text" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- Nilai bahasa inggris -->
                <div class="form-group">
                  <label for="ing">Nilai Bahasa Inggris :</label>
                  <input type="text" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- Nilai ipa -->
                <div class="form-group">
                  <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                  <input type="text" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- Nilai ips -->
                <div class="form-group">
                  <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                  <input type="text" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- Nilai skhu -->
                <div class="form-group">
                  <label for="hu">Nilai SKHU :</label>
                  <input type="text" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required>
                </div>
                <!-- minat jurusan -->
                <div class="form-group">
                  <label for="jp">Jurusan Peminatan :</label>
                  <br>
                  <input type='radio' name='peminatan' value='IPA' required="required"> IPA &nbsp;&nbsp;&nbsp;
                  <input type='radio' name='peminatan' value='IPS' required="required"> IPS &nbsp;&nbsp;&nbsp;
                  <input type='radio' name='peminatan' value='BAHASA' required="required"> BAHASA
                </div>
                <!--  -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
            <input type="button" name="submit" class="btn btn-primary" value="Simpan">
          </div>
          </form>
          <?php
          if (isset($_POST['submit'])) {mysql_query("INSERT INTO data_training 
			                      	(ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,minat)
                            VALUES(
                              '$_POST[txtppdb]',
                              '$_POST[txtbhs_id]',
                              '$_POST[txtmtk]',
                              '$_POST[txtbhs_ing]',
                              '$_POST[txtipa]',
                              '$_POST[txtips]',
                              '$_POST[txtskhu]',
                              '$_POST[peminatan]'
                            )");
          }
          ?>
        

      </div>
    </div>
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
          <button type="button" class="btn btn-primary"> Ya </button>
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
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
          <button type="button" class="btn btn-primary"> Upload </button>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <!-- /.content-header -->
  <div class="content-wrapper">
    <?php
    if ($jumlah == 0) {
      echo "<center><h3>Data Training masih kosong...</h3></center>";
    } else {
      echo "Jumlah data training: " . $jumlah;
    ?>
      <table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
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
  <!-- end table -->

  </div>
  <!-- data table -->




  <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
  <?php
  require 'footer.php';
  ?>