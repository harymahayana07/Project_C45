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

                <a href="mining_konversi.php" type="button" class="btn btn-warning btn-sm btn-responsive"><i class="fas fa-eye"></i>&emsp; Lihat Hasil Konversi</a> &emsp;

                <a href="mining_konversi.php" type="button" name="submit" class="btn btn-success btn-sm btn-responsive"><i class="fab fa-cloudscale"></i>&emsp; Konversi Data Ke Huruf</a>

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