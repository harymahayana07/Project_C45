<?php $thisPage = "POHON KEPUTUSAN";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
    header("location:auth/login-form.php");
}
?>
<?php
require 'partial/headers.php';
require 'partial/sidebar.php';
require 'partial/navbar.php';
?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0"><i class="fas fa-server"></i>&nbsp;POHON KEPUTUSAN</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Pohon Keputusan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row mb-2">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row" style="float: right;">
                            <div class="col-lg-12 col-md-4">
                                <a href="<?= base_url('tree.php') ?>" type="button" class="btn btn-success btn-responsive"><i class="fas fa-eye"></i>&emsp; Lihat Rule/Aturan Yang terbentuk</a> &emsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php
                                    $query = mysql_query("SELECT * FROM pohon_keputusan");
                                    $jumlah = mysql_num_rows($query);

                                    if ($jumlah == 0) {
                                        $msg = "pohon keputusan belum terbentuk";
                                        echo '<div class="alert alert-warning py- mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
                                    } else {
                                        echo "Jumlah pohon keputusan :&nbsp;" . $jumlah;
                                    }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
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
                                                    echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka Jurusan = </i><strong>" . $row_bar[0] . " (" . $id[$ll] . ")</strong>";
                                                } else if ($exRule[$i - 1] != "---- ") {
                                                    echo "<br>" . $strip . "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka Jurusan = </i><strong>" . $row_bar[0] . "  (" . $id[$ll] . ")</strong>";
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include_once("partial/footers.php"); ?>
    </div>
</body>

</html>