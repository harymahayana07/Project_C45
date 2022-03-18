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
  include "form_data_training.php";
  $query = mysql_query("select * from data_training order by(id)");
  $jumlah = mysql_num_rows($query);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Training</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Data Training</li>
            </ol>

          </div><!-- /.col -->
          <div class="mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fas fa-plus-circle"> Tambah Data Training</i>
            </button>

          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

              <form method=POST action=''>

                <div class="modal-header bg-info">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Training</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
               
                  <!-- Input addon -->
                  <!--  -->
                  <div class="card card-info">
                    <div class="card-body">
                     
                        <!-- ppdb -->
                        <div class="form-group">

                          <label for="ppdb">PPDB :</label>

                          <select name="txtppdb" id="ppdb" class="form-control" required autofocus>
                            <option value=""> <i>---Pilih---</i> </option>
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

                        <!--  -->
                        <!-- Nilai Matematika -->
                        <div class="form-group">
                          <label for="math">Nilai Matematika :</label>
                          <input type="text" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98.5" required>
                        </div>

                        <!--  -->
                        <!-- Nilai bahasa inggris -->
                        <div class="form-group">
                          <label for="ing">Nilai Bahasa Inggris :</label>
                          <input type="text" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required>
                        </div>

                        <!--  -->
                        <!-- Nilai ipa -->
                        <div class="form-group">
                          <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                          <input type="text" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required>
                        </div>

                        <!--  -->
                        <!-- Nilai ips -->
                        <div class="form-group">
                          <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                          <input type="text" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required>
                        </div>

                        <!--  -->
                        <!-- Nilai skhu -->
                        <div class="form-group">
                          <label for="hu">Nilai SKHU :</label>
                          <input type="text" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required>
                        </div>
                        <!--  -->
                        <!-- minat jurusan -->
                        <div class="form-group">
                          <label for="jp">Jurusan Peminatan :</label>
                          <br>
                          <input type='radio' name='peminatan' value='IPA' required="required"> IPA &nbsp;&nbsp;&nbsp;
                          <input type='radio' name='peminatan' value='IPS' required="required"> IPS &nbsp;&nbsp;&nbsp;
                          <input type='radio' name='peminatan' value='BAHASA' required="required"> BAHASA
                        </div>
                        <!--  -->
                        <!-- motivasi -->
                        <div class="form-group">
                          <label for="jp">Motivasi :</label>
                          <br>
                          <input type='checkbox' name='motivasi' value='sendiri' required="required"> Sendiri &nbsp;&nbsp;&nbsp;
                          <input type='checkbox' name='motivasi' value='orang-tua' required="required"> Orang Tua &nbsp;&nbsp;&nbsp;
                          <input type='checkbox' name='motivasi' value='orang-lain' required="required"> Orang Lain
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
                <?php
                             if (isset($_POST['submit'])) {
                        mysql_query("INSERT INTO data_training 
			                      	(ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,minat,motivasi)
                            VALUES(
                              '$_POST[txtppdb]',
                              '$_POST[txtbhs_id]',
                              '$_POST[txtmtk]',
                              '$_POST[txtbhs_ing]',
                              '$_POST[txtipa]',
                              '$_POST[txtips]',
                              '$_POST[txtskhu]',
                              '$_POST[peminatan]',
                              '$_POST[motivasi]'
                            )");
                         }
                         ?>
              </form>
              
              </div>
            </div>
          </div>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
  <!-- /.content-header -->
  <!-- data table -->
  <?php
  if ($jumlah == 0) {
    echo "<center><h3>Data training masih kosong...</h3></center>";
  } else {
    echo "Jumlah data training: " . $jumlah;
  ?>
    <table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
      <tr align='center'>
        <th>No</th>
        <th>Instansi</th>
        <th>Status</th>
        <th>Jurusan</th>
        <th>Nilai Rata UN</th>
        <th>Status Kerja</th>
        <th>Motivasi</th>
        <th><b>Prestasi</b></th>
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
          <td><?php echo $row['instansi']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['jurusan']; ?></td>
          <td><?php echo $row['rata_un']; ?></td>
          <td><?php echo $row['kerja']; ?></td>
          <td><?php echo $row['motivasi']; ?></td>
          <td><b><?php echo $row['ipk']; ?></b></td>
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

<!-- Button trigger modal -->

<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<?php
require 'footer.php';
?>