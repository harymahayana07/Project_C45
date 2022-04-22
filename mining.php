<?php
session_start();
if (!isset($_SESSION['usr'])) {
  header("location:login-form.php");
}
?>
<?php
require 'partial/header.php';
require 'partial/sidebar.php';
require 'partial/navbar.php';
?>
<?php
include "koneksi.php";
$query = mysql_query("select * from data_training order by(id)");
$jumlah = mysql_num_rows($query);

if ($jumlah == 0) {
  echo "<center><h3>Data Masih Kosong...</h3></center>";
} else {

  if (isset($_POST['submit'])) {
    include "proses_mining.php";
  } else {
?>

    <!--  -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="m-0">MINING DATA</h1>
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
      <!--  -->
      <div class="container-fluid mt-2">
        <!--  -->
        <div class="row mb-2">
          <!--  -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12 col-md-4">

                  <form method="POST" action='' class="d-inline">
                    <button type="submit" name="submit" class="btn btn-success btn-sm btn-responsive"><i class="fab fa-cloudscale"></i>&emsp; Proses Mining </button>
                  </form>

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
                        if ($jumlah == 0) {
                          echo "<center><h3>Data Masih Kosong...</h3></center>";
                        } else {
                          echo "Jumlah data : " . $jumlah;
                        ?>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>PPDB</th>
                            <th>BAHASA INDONESIA</th>
                            <th>MATEMATIKA</th>
                            <th>BAHASA INGGRIS</th>
                            <th>IPA</th>
                            <th>IPS</th>
                            <th>SKHU</th>
                            <th>JURUSAN</th>
                            <th>AKSI</th>
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
                              <td><?php echo $row['ppdb']; ?>

                              </td>
                              <td>
                                <?php
                                if ($row['bhs_indonesia'] >= 92 && $row['bhs_indonesia'] <= 100) {
                                  echo "A";
                                } else if ($row['bhs_indonesia'] >= 84 && $row['bhs_indonesia'] < 92) {
                                  echo "B";
                                } else if ($row['bhs_indonesia'] >= 76 && $row['bhs_indonesia'] < 84) {
                                  echo "C";
                                } else if ($row['bhs_indonesia'] >= 70 && $row['bhs_indonesia'] < 76) {
                                  echo "D";
                                } else if ($row['bhs_indonesia'] >= 65 && $row['bhs_indonesia'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                if ($row['matematika'] >= 92 && $row['matematika'] <= 100) {
                                  echo "A";
                                } else if ($row['matematika'] >= 84 && $row['matematika'] < 92) {
                                  echo "B";
                                } else if ($row['matematika'] >= 76 && $row['matematika'] < 84) {
                                  echo "C";
                                } else if ($row['matematika'] >= 70 && $row['matematika'] < 76) {
                                  echo "D";
                                } else if ($row['matematika'] >= 65 && $row['matematika'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                if ($row['bhs_inggris'] >= 92 && $row['bhs_inggris'] <= 100) {
                                  echo "A";
                                } else if ($row['bhs_inggris'] >= 84 && $row['bhs_inggris'] < 92) {
                                  echo "B";
                                } else if ($row['bhs_inggris'] >= 76 && $row['bhs_inggris'] < 84) {
                                  echo "C";
                                } else if ($row['bhs_inggris'] >= 70 && $row['bhs_inggris'] < 76) {
                                  echo "D";
                                } else if ($row['bhs_inggris'] >= 65 && $row['bhs_inggris'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                if ($row['ipa'] >= 92 && $row['ipa'] <= 100) {
                                  echo "A";
                                } else if ($row['ipa'] >= 84 && $row['ipa'] < 92) {
                                  echo "B";
                                } else if ($row['ipa'] >= 76 && $row['ipa'] < 84) {
                                  echo "C";
                                } else if ($row['ipa'] >= 70 && $row['ipa'] < 76) {
                                  echo "D";
                                } else if ($row['ipa'] >= 65 && $row['ipa'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                if ($row['ips'] >= 92 && $row['ips'] <= 100) {
                                  echo "A";
                                } else if ($row['ips'] >= 84 && $row['ips'] < 92) {
                                  echo "B";
                                } else if ($row['ips'] >= 76 && $row['ips'] < 84) {
                                  echo "C";
                                } else if ($row['ips'] >= 70 && $row['ips'] < 76) {
                                  echo "D";
                                } else if ($row['ips'] >= 65 && $row['ips'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                if ($row['skhu'] >= 92 && $row['skhu'] <= 100) {
                                  echo "A";
                                } else if ($row['skhu'] >= 84 && $row['skhu'] < 92) {
                                  echo "B";
                                } else if ($row['skhu'] >= 76 && $row['skhu'] < 84) {
                                  echo "C";
                                } else if ($row['skhu'] >= 70 && $row['skhu'] < 76) {
                                  echo "D";
                                } else if ($row['skhu'] >= 65 && $row['skhu'] < 70) {
                                  echo "E";
                                } else {
                                  echo "Tidak Lulus";
                                }
                                ?>
                              </td>
                              <td>
                                <b>
                                  <?php echo $row['minat']; ?>
                                </b>
                              </td>
                              <td>
                                <a href="index.php?menu=data&act=update&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-responsive btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="data_training.php?act=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-responsive btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data?')"><i class="fas fa-trash"></i></a>
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

    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

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