<?php require 'partial/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <?php
    require 'partial/sidebar.php';
    require 'partial/navbar.php';
    ?>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>POHON KEPUTUSAN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pohon Keputusan</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><a href="?menu=tree">Lihat Rule/Aturan yang terbentuk</a></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!--  -->
                                    <?php
                                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                                    include "koneksi.php";
                                    //select id dari pohon keputusan
                                    $que_sql = mysql_query("SELECT id FROM pohon_keputusan");
                                    $id = array();
                                    $l = 0;
                                    while ($bar_row = mysql_fetch_array($que_sql)) {
                                        $id[$l] = $bar_row[0];
                                        $l++;
                                    }

                                    $query = mysql_query("SELECT * FROM pohon_keputusan ORDER BY(id)");
                                    $temp_rule = array();
                                    $temp_rule[0] = '';
                                    $ll = 0; //variabel untuk iterasi id pohon keputusan
                                    while ($bar = mysql_fetch_array($query)) {
                                        //menampung rule
                                        if ($bar[1] != '') {
                                            $rule = $bar[1] . " AND " . $bar[2];
                                        } else {
                                            $rule = $bar[2];
                                        }

                                        $rule = str_replace("OR", "/", $rule);
                                        //explode rule
                                        $exRule = explode(" AND ", $rule);
                                        $jml_ExRule = count($exRule);
                                        $jml_temp = count($temp_rule);

                                        $i = 0;
                                        while ($i < $jml_ExRule) {
                                            if ($temp_rule[$i] == $exRule[$i]) {
                                                $temp_rule[$i] = $exRule[$i];
                                                $exRule[$i] = "---- ";
                                            } else {
                                                $temp_rule[$i] = $exRule[$i];
                                            }

                                            if ($i == ($jml_ExRule - 1)) {
                                                $t = $i;
                                                while ($t < $jml_temp) {
                                                    $temp_rule[$t] = "";
                                                    $t++;
                                                }
                                            }

                                            //jika terakhir tambah cetak keputusan
                                            if ($i == ($jml_ExRule - 1)) {
                                                $strip = '';
                                                for ($x = 1; $x <= $i; $x++) {
                                                    $strip = $strip . "---- ";
                                                }
                                                $sql_que = mysql_query("SELECT keputusan FROM pohon_keputusan WHERE id=$id[$ll]");
                                                $row_bar = mysql_fetch_array($sql_que);
                                                if ($exRule[$i - 1] == "---- ") {
                                                    echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka prestasi = </i><strong>" . $row_bar[0] . " (" . $id[$ll] . ")</strong>";
                                                } else if ($exRule[$i - 1] != "---- ") {
                                                    echo "<br>" . $strip . "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka prestasi = </i><strong>" . $row_bar[0] . "  (" . $id[$ll] . ")</strong>";
                                                }
                                            }
                                            //jika pertama
                                            else if ($i == 0) {
                                                if ($ll == 1) {
                                                    echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                                } else {
                                                    echo $exRule[$i] . " ";
                                                }
                                            }
                                            //jika ditengah
                                            else {
                                                if ($exRule[$i] == "---- ") {
                                                    echo $exRule[$i] . " ";
                                                } else {
                                                    if ($exRule[$i - 1] == "---- ") {
                                                        echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                                    } else {
                                                        $strip = '';
                                                        for ($x = 1; $x <= $i; $x++) {
                                                            $strip = $strip . "---- ";
                                                        }
                                                        echo "<br>" . $strip . "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                                    }
                                                }
                                            }
                                            $i++;
                                        }
                                        echo "<br>";
                                        $ll++;
                                    }
                                    ?>
                                    <!--  -->
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">All rights reserved.</footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!--  -->
    <!--  -->

    <!--  -->
    <!--  -->




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
    <?php
    require 'partial/footer.php';
    ?>
</body>

</html>