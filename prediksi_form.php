<?php $thisPage = "PREDIKSI";
require_once 'conn/koneksi.php';
require_once 'conn/general.php';
if (!isset($_SESSION['usr'])) {
    header("location:auth/login-form.php");
}
?>
<?php include_once("siswa/template/header.php"); ?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
        include_once("siswa/template/navbar.php");
        include_once("siswa/template/sidebar.php");
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb mb-0">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home / Penjurusan </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- <div class="col-sm-8 col-sm-6 alert alert-info mt-2">
                    <h4 class="page-title text-dark font-weight-medium mb-1 mt-2">Selamat Datang Di Website Penjurusan <?= strtolower($_SESSION['nama']); ?></h4>
                </div> -->

                <!--  -->

                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $s_Query = mysql_query("SELECT * FROM pohon_keputusan");
                $jml_tree = mysql_num_rows($s_Query);
                if ($jml_tree == 0) {

                    $msg = "Anda Belum bisa melakukan prediksi karena pohon keputusan belum terbentuk"; ?>
                    <div style="margin-left: 9px; margin-right: 9px;">
                        <div class="col-md-8 col-md-3 alert alert-warning"><i class="fas fa-exclamation-triangle"></i>&emsp;<?php echo $msg; ?></div>
                    </div>

                    <?php

                } else {
                    $nisn = $_SESSION['usr'];
                    $query = mysql_query("SELECT * FROM hasil_prediksi WHERE nisn='$nisn'");
                    $baris = mysql_fetch_array($query);
                    $jmlque = mysql_num_rows($query);
                    if ($jmlque == 1) {
                    ?>
                        <div class="card-body" style="color: black; background-color: #dee0e3;">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="jk1" class="col-lg-2">Jenis Kelamin</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select name="jk" id="jk1" class="form-control" disabled autofocus>
                                                        <option value="1" <?php if ($baris['jk'] == '1') : echo 'selected';
                                                                            endif; ?>>Laki-Laki</option>
                                                        <option value="2" <?php if ($baris['jk'] == '2') : echo 'selected';
                                                                            endif; ?>>Perempuan</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="ppdb" class="col-lg-2">Jalur PPDB</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <select name="txtppdb" id="ppdb" class="form-control" disabled>
                                                        <option value="1" <?php if ($baris['ppdb'] == '1') : echo 'selected';
                                                                            endif; ?>>Perpindahan Orang tua</option>
                                                        <option value="2" <?php if ($baris['ppdb'] == '2') : echo 'selected';
                                                                            endif; ?>>Prestasi Akademik</option>
                                                        <option value="3" <?php if ($baris['ppdb'] == '3') : echo 'selected';
                                                                            endif; ?>>Prestasi Non-Akademik</option>
                                                        <option value="4" <?php if ($baris['ppdb'] == '4') : echo 'selected';
                                                                            endif; ?>>Prestasi Tahfidz</option>
                                                        <option value="5" <?php if ($baris['ppdb'] == '5') : echo 'selected';
                                                                            endif; ?>>Afirmasi</option>
                                                        <option value="6" <?php if ($baris['ppdb'] == '6') : echo 'selected';
                                                                            endif; ?>>Zonasi</option>
                                                        <option value="7" <?php if ($baris['ppdb'] == '7') : echo 'selected';
                                                                            endif; ?>>PPLP</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="indo" class="col-lg-2">Rata-rata Bahasa Indonesia</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtbhs_id" id="indo" class="form-control" value="<?= $baris['bhs_indonesia'] ?>" disabled autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="math" class="col-lg-2">Rata-rata Matematika</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtmtk" id="math" class="form-control" value="<?= $baris['matematika'] ?>" disabled autocomplete="off">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="ing" class="col-lg-2">Rata-rata Bahasa Inggris</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtbhs_ing" id="ing" class="form-control" value="<?= $baris['bhs_inggris'] ?>" disabled autocomplete="off">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="alam" class="col-lg-2">Rata-rata Ilmu Pengetahuan Alam</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtipa" id="alam" class="form-control" value="<?= $baris['ipa'] ?>" disabled autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="sosial" class="col-lg-2">Rata-rata Ilmu Pengetahuan Sosial</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtips" id="sosial" class="form-control" value="<?= $baris['ips'] ?>" disabled autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="skh" class="col-lg-2">Rata-rata SKHU</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtskhu" id="skh" class="form-control" value="<?= $baris['skhu'] ?>" disabled autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="skh" class="col-lg-2">Prediksi Jurusan</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="txtskhu" id="skh" class="form-control" value="<?= $baris['hasil'] ?>" disabled autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //menyajikan rule
                        $n_jk = $baris['jk'];
                        $n_ppdb = $baris['ppdb'];
                        $n_bhs_indonesia = $baris['bhs_indonesia'];
                        $n_matematika = $baris['matematika'];
                        $n_bhs_inggris = $baris['bhs_inggris'];
                        $n_ipa = $baris['ipa'];
                        $n_ips = $baris['ips'];
                        $n_skhu = $baris['skhu'];
                        $sql = mysql_query("SELECT * FROM pohon_keputusan");
                        $id_rule = "";
                        $keputusan = "";
                        while ($row = mysql_fetch_array($sql)) {
                            //menggabungkan parent dan akar dengan kata AND
                            if ($row[1] != '') {
                                $rule = $row[1] . " AND " . $row[2];
                            } else {
                                $rule = $row[2];
                            }
                            //mengubah parameter
                            $rule = str_replace("<=", " k ", $rule);
                            $rule = str_replace("=", " s ", $rule);
                            $rule = str_replace(">", " l ", $rule);
                            //mengganti nilai
                            $rule = str_replace("jk", "'$n_jk'", $rule);
                            $rule = str_replace("ppdb", "'$n_ppdb'", $rule);
                            $rule = str_replace("bhs_indonesia", "'$n_bhs_indonesia'", $rule);
                            $rule = str_replace("matematika", "'$n_matematika'", $rule);
                            $rule = str_replace("bhs_inggris", "$n_bhs_inggris", $rule);
                            $rule = str_replace("ipa", "'$n_ipa'", $rule);
                            $rule = str_replace("ips", "'$n_ips'", $rule);
                            $rule = str_replace("skhu", "'$n_skhu'", $rule);
                            //menghilangkan '
                            $rule = str_replace("'", "", $rule);
                            //menggabungkan kata ortu dan orang lain
                            // $rule = str_replace("Orang Tua", "OrangTua", $rule);
                            //  $rule = str_replace("Orang Lain", "OrangLain", $rule);
                            //explode and
                            $explodeAND = explode(" AND ", $rule);
                            $jmlAND = count($explodeAND);
                            //menghilangkan ()
                            $explodeAND = str_replace("(", "", $explodeAND);
                            $explodeAND = str_replace(")", "", $explodeAND);
                            //deklarasi bol
                            $bolAND = array();
                            $n = 0;
                            while ($n < $jmlAND) {
                                //explode or
                                $explodeOR = explode(" OR ", $explodeAND[$n]);
                                $jmlOR = count($explodeOR);
                                //deklarasi bol
                                $bol = array();
                                $a = 0;
                                while ($a < $jmlOR) {
                                    //pecah  dengan spasi
                                    $exrule2 = explode(" ", $explodeOR[$a]);
                                    $parameter = $exrule2[1];
                                    if ($parameter == 's') {
                                        //pecah  dengan s
                                        $explodeRule = explode(" s ", $explodeOR[$a]);
                                        //nilai true false						
                                        if ($explodeRule[0] == $explodeRule[1]) {
                                            $bol[$a] = "Benar";
                                        } else if ($explodeRule[0] != $explodeRule[1]) {
                                            $bol[$a] = "Salah";
                                        }
                                    } else if ($parameter == 'k') {
                                        //pecah  dengan k
                                        $explodeRule = explode(" k ", $explodeOR[$a]);
                                        //nilai true false
                                        if ($explodeRule[0] <= $explodeRule[1]) {
                                            $bol[$a] = "Benar";
                                        } else {
                                            $bol[$a] = "Salah";
                                        }
                                    } else if ($parameter == 'l') {
                                        //pecah dengan s
                                        $explodeRule = explode(" l ", $explodeOR[$a]);
                                        //nilai true false
                                        if ($explodeRule[0] > $explodeRule[1]) {
                                            $bol[$a] = "Benar";
                                        } else {
                                            $bol[$a] = "Salah";
                                        }
                                    }
                                    //cetak nilai bolean				
                                    $a++;
                                }
                                //isi false
                                $bolAND[$n] = "Salah";
                                $b = 0;
                                while ($b < $jmlOR) {
                                    //jika $bol[$b] benar bolAND benar
                                    if ($bol[$b] == "Benar") {
                                        $bolAND[$n] = "Benar";
                                    }
                                    $b++;
                                }
                                $n++;
                            }
                            //isi boolrule
                            $boolRule = "Benar";
                            $a = 0;
                            while ($a < $jmlAND) {
                                //jika ada yang salah boolrule diganti salah
                                if ($bolAND[$a] == "Salah") {
                                    $boolRule = "Salah";
                                }
                                $a++;
                            }
                            if ($boolRule == "Benar") {
                                $keputusan = $row[3];
                                $id_rule = $row[0];
                            }
                        }
                        if ($keputusan == '') {
                        ?>
                            <!-- <div class="row mt-3" style="text-align: center;">
                                                    <div class="col-lg-12 col-md-4 label"><b>Rule yang terpilih adalah rule terakhir karena tidak memenuhi semua rule</b></div>
                                                </div> -->
                        <?php
                        } else {
                            $sql_que = mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");
                            $row_bar = mysql_fetch_array($sql_que);
                            $rule_terpilih = "IF " . $row_bar[1] . " AND " . $row_bar[2] . " THEN jurusan = " . $row_bar[3];
                        ?>
                            <!-- <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Rule yang terpilih adalah rule ke :</div>
                                                    <div class="col-lg-9 col-md-8"><?= $row_bar[0] . $rule_terpilih ?></div>
                                                </div> -->
                        <?php
                        }
                    }
                    //jika belum melakukan prediksi
                    else if ($jmlque == 0) {
                        if (!isset($_POST['submit'])) {
                        ?>
                            <!--  -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body" style="color: black; background-color: #dee0e3;">
                                            <h4 class="card-title mb-3"> Isi Data dibawah dengan data nilai anda</h4>
                                            <form action="" method="POST">
                                                <div class="form-body">
                                                    <!--  -->
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="jk1" class="col-lg-2">Jenis Kelamin</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <select name="jk" id="jk1" class="form-control" autofocus required>
                                                                            <option value=""> <i>---Pilih--- <i class="bi bi-caret-down-fill"></i></i> </option>
                                                                            <option value="1">Laki-Laki</option>
                                                                            <option value="2">Perempuan</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="ppdb" class="col-lg-2">Jalur PPDB</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <select name="txtppdb" id="ppdb" class="form-control" required>
                                                                            <option value=""><i>---Pilih--- <i class="bi bi-caret-down-fill"></i></i> </option>
                                                                            <option value="1">Perpindahan Orang tua</option>
                                                                            <option value="2">Prestasi Akademik</option>
                                                                            <option value="3">Prestasi Non-Akademik</option>
                                                                            <option value="4">Prestasi Tahfidz</option>
                                                                            <option value="5">Afirmasi</option>
                                                                            <option value="6">Zonasi</option>
                                                                            <option value="7">PPLP</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="indo" class="col-lg-2">Rata-rata Bahasa Indonesia</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtbhs_id" id="indo" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="math" class="col-lg-2">Rata-rata Matematika</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtmtk" id="math" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="ing" class="col-lg-2">Rata-rata Bahasa Inggris</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtbhs_ing" id="ing" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="alam" class="col-lg-2">Rata-rata Ilmu Pengetahuan Alam</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtipa" id="alam" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="sosial" class="col-lg-2">Rata-rata Ilmu Pengetahuan Sosial</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtips" id="sosial" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="skh" class="col-lg-2">Rata-rata SKHU</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="txtskhu" id="skh" class="form-control" placeholder=" * " autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions mt-3">
                                                    <div class="text-left">
                                                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
                                                        <a href="prediksi_form.php" class="btn btn-dark">Reset</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <?php
                        } else {
                            $n_jk = $_POST['jk'];
                            $n_ppdb = $_POST['txtppdb'];
                            $n_bhs_indonesia = $_POST['txtbhs_id'];
                            $n_matematika = $_POST['txtmtk'];
                            $n_bhs_inggris = $_POST['txtbhs_ing'];
                            $n_ipa = $_POST['txtipa'];
                            $n_ips = $_POST['txtips'];
                            $n_skhu = $_POST['txtskhu'];

                            // echo "<h4><center>Hasil Jawaban Anda...<br>";
                            // echo "jk: " . $n_jk . "<br>";
                            // echo "ppdb: " . $n_ppdb . "<br>";
                            // echo "bhs_indonesia: " . $n_bhs_indonesia . "<br>";
                            // echo "matematika: " . $n_matematika . "<br>";
                            // echo "bhs_inggris: " . $n_bhs_inggris . "<br>";
                            // echo "ipa: " . $n_ipa . "<br>";
                            // echo "ips: " . $n_ips . "<br>";
                            // echo "skhu: " . $n_skhu . "<br><br><br></center></h4>";

                            $sql = mysql_query("SELECT * FROM pohon_keputusan");
                            $id_rule = "";
                            $keputusan = "";
                            while ($row = mysql_fetch_array($sql)) {
                                //menggabungkan parent dan akar dengan kata AND
                                if ($row[1] != '') {
                                    $rule = $row[1] . " AND " . $row[2];
                                } else {
                                    $rule = $row[2];
                                }
                                //mengubah parameter
                                $rule = str_replace("<=", " k ", $rule);
                                $rule = str_replace("=", " s ", $rule);
                                $rule = str_replace(">", " l ", $rule);
                                //mengganti nilai
                                $rule = str_replace("jk", "'$n_jk'", $rule);
                                $rule = str_replace("ppdb", "'$n_ppdb'", $rule);
                                $rule = str_replace("bhs_indonesia", "'$n_bhs_indonesia'", $rule);
                                $rule = str_replace("matematika", "'$n_matematika'", $rule);
                                $rule = str_replace("bhs_inggris", "$n_bhs_inggris", $rule);
                                $rule = str_replace("ipa", "'$n_ipa'", $rule);
                                $rule = str_replace("ips", "'$n_ips'", $rule);
                                $rule = str_replace("skhu", "'$n_skhu'", $rule);
                                //menghilangkan '
                                $rule = str_replace("'", "", $rule);
                                //menggabungkan kata ortu dan orang lain
                                // $rule = str_replace("Orang Tua", "OrangTua", $rule);
                                // $rule = str_replace("Orang Lain", "OrangLain", $rule);
                                //explode and
                                $explodeAND = explode(" AND ", $rule);
                                $jmlAND = count($explodeAND);
                                //menghilangkan ()
                                $explodeAND = str_replace("(", "", $explodeAND);
                                $explodeAND = str_replace(")", "", $explodeAND);
                                //deklarasi bol
                                $bolAND = array();
                                $n = 0;
                                while ($n < $jmlAND) {
                                    //explode or
                                    $explodeOR = explode(" OR ", $explodeAND[$n]);
                                    $jmlOR = count($explodeOR);
                                    //deklarasi bol
                                    $bol = array();
                                    $a = 0;
                                    while ($a < $jmlOR) {
                                        //pecah  dengan spasi
                                        $exrule2 = explode(" ", $explodeOR[$a]);
                                        $parameter = $exrule2[1];
                                        if ($parameter == 's') {
                                            //pecah  dengan s
                                            $explodeRule = explode(" s ", $explodeOR[$a]);
                                            //nilai true false						
                                            if ($explodeRule[0] == $explodeRule[1]) {
                                                $bol[$a] = "Benar";
                                            } else if ($explodeRule[0] != $explodeRule[1]) {
                                                $bol[$a] = "Salah";
                                            }
                                        } else if ($parameter == 'k') {
                                            //pecah  dengan k
                                            $explodeRule = explode(" k ", $explodeOR[$a]);
                                            //nilai true false
                                            if ($explodeRule[0] <= $explodeRule[1]) {
                                                $bol[$a] = "Benar";
                                            } else {
                                                $bol[$a] = "Salah";
                                            }
                                        } else if ($parameter == 'l') {
                                            //pecah dengan s
                                            $explodeRule = explode(" l ", $explodeOR[$a]);
                                            //nilai true false
                                            if ($explodeRule[0] > $explodeRule[1]) {
                                                $bol[$a] = "Benar";
                                            } else {
                                                $bol[$a] = "Salah";
                                            }
                                        }
                                        //cetak nilai bolean				
                                        $a++;
                                    }
                                    //isi false
                                    $bolAND[$n] = "Salah";
                                    $b = 0;
                                    while ($b < $jmlOR) {
                                        //jika $bol[$b] benar bolAND benar
                                        if ($bol[$b] == "Benar") {
                                            $bolAND[$n] = "Benar";
                                        }
                                        $b++;
                                    }
                                    $n++;
                                }
                                //isi boolrule
                                $boolRule = "Benar";
                                $a = 0;
                                while ($a < $jmlAND) {
                                    //jika ada yang salah boolrule diganti salah
                                    if ($bolAND[$a] == "Salah") {
                                        $boolRule = "Salah";
                                    }
                                    $a++;
                                }
                                if ($boolRule == "Benar") {
                                    $keputusan = $row[3];
                                    $id_rule = $row[0];
                                }
                            }

                            if ($keputusan == '') {
                                $que = mysql_query("SELECT parent FROM pohon_keputusan");
                                $jml = array();
                                $exParent = array();
                                $i = 0;
                                while ($bar = mysql_fetch_array($que)) {
                                    $exParent = explode(" AND ", $bar['parent']);
                                    $jml[$i] = count($exParent);
                                    $i++;
                                }
                                $maxParent = max($jml);
                                $sql_query = mysql_query("SELECT * FROM pohon_keputusan");
                                while ($bar_row = mysql_fetch_array($sql_query)) {
                                    $explP = explode(" AND ", $bar_row['parent']);
                                    $jmlT = count($explP);
                                    if ($jmlT == $maxParent) {
                                        $keputusan = $bar_row['keputusan'];
                                        $id_rule = $bar_row['id'];
                                    }
                                }
                                echo "<h1><center>Anda Akan masuk kelas " . $keputusan . "</center></h1>";
                                // echo "<h4><center>Rule terpilih adalah rule yang terakhir karena tidak memenuhi semua rule</center></h4>";
                                if (empty($errors)) :

                                    $simpan = mysql_query("INSERT INTO hasil_prediksi (nisn,jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,hasil) 
                                     VALUES ('$nisn', '$n_jk', '$n_ppdb', '$n_bhs_indonesia','$n_matematika','$n_bhs_inggris','$n_ipa','$n_ips','$n_skhu','$keputusan')");

                                    if ($simpan) {
                                        $sts[] = 'Data berhasil disimpan';
                                    } else {
                                        $sts[] = 'Data gagal disimpan';
                                    }
                                endif;
                            } else {
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card text-white bg-info">
                                            <div class="card-header">
                                                <h4 class="mb-0 text-white">Selamat Kepada <?= ucwords($_SESSION['lvl']); ?></h4>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title text-white"> Nama : <?= $_SESSION['nama']; ?></h3>
                                                <p class="card-text"> Anda Masuk Dikelas : <?= $keputusan; ?></p>
                                                <a href="prediksi_form.php" class="btn btn-dark">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php
                                // echo "<h1><center>Anda diprediksi masuk kelas " . $keputusan . "</center></h1>";
                                $sql_que = mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");
                                $row_bar = mysql_fetch_array($sql_que);
                                $rule_terpilih = "IF " . $row_bar[1] . " AND " . $row_bar[2] . " THEN jurusan = " . $row_bar[3];
                                // echo "<h4><center>Rule yang terpilih adalah rule ke-" . $row_bar[0] . "<br>" . $rule_terpilih . "</center></h4>";
                                if (empty($errors)) :

                                    $simpan = mysql_query("INSERT INTO hasil_prediksi (nisn,jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,hasil) 
                                     VALUES ('$nisn', '$n_jk', '$n_ppdb', '$n_bhs_indonesia','$n_matematika','$n_bhs_inggris','$n_ipa','$n_ips','$n_skhu','$keputusan')");

                                    if ($simpan) {
                                        $sts[] = 'Data berhasil disimpan';
                                    } else {
                                        $sts[] = 'Data gagal disimpan';
                                    }
                                endif;
                            }
                        }
                    }
                }
                ?>

                <!--  -->
            </div>

        </div>
    </div>
    <?php include_once("siswa/template/footer.php") ?>
</body>

</html>