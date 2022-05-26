<?php
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
    header("location:auth/login-form.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Users / Profile </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('') ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/NiceAdmin/assets/css/style.css') ?>" rel="stylesheet">

</head>

<body>

    <?php
    require 'partial/header-siswa.php';
    require 'partial/sidebar-siswa.php';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center mb-5">

                            <img src="dist/img/user-bg-dark.png" alt="Profile" class="rounded-circle">
                            <h2><?= $_SESSION['nama'] ?></h2>
                            <h3><?= $_SESSION['lvl'] ?></h3>

                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit"> Data Diri Anda</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">


                                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                    <!--  -->

                                    <?php
                                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

                                    $s_Query = mysql_query("SELECT * FROM pohon_keputusan");
                                    $jml_tree = mysql_num_rows($s_Query);

                                    if ($jml_tree == 0) {
                                        echo "<center><h3>Anda tidak bisa melakukan prediksi,<br>
			Karena Pohon Keputusan belum terbentuk...</h3></center>";
                                    } else {
                                        $nisn = $_SESSION['usr'];
                                        $query = mysql_query("SELECT * FROM hasil_prediksi WHERE nisn='$nisn'");
                                        $baris = mysql_fetch_array($query);
                                        $jmlque = mysql_num_rows($query);
                                        if ($jmlque == 1) {
                                    ?>
                                            <div class="row">
                                                <div class="col-lg-9 col-md-4 label "><b>
                                                        <h3>Data Diri Anda : </h3>
                                                    </b></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label ">Nisn </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>
                                                <div class="col-lg-7 col-md-7"><?= $_SESSION['usr'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label ">Nama Lengkap </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>
                                                <div class="col-lg-7 col-md-7"><?= $_SESSION['nama'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">PPBD </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['ppdb'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Nilai Bahasa Indonesia </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['bhs_indonesia'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Nilai Matematika </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['matematika'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Nilai Bahasa Inggris </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['bhs_inggris'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Nilai Ipa </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['ipa'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Nilai Ips </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['ips'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Rata - Rata SKHU </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['skhu'] ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 label">Prediksi Kelas </div>
                                                <div class="col-lg-1 col-md-1 label ">:</div>

                                                <div class="col-lg-7 col-md-7"><?= $baris['hasil'] ?></div>
                                            </div>

                                            <?php
                                            //menyajikan rule
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
                                                <div class="row mt-3" style="text-align: center;">
                                                    <div class="col-lg-12 col-md-4 label"><b>Rule yang terpilih adalah rule terakhir karena tidak memenuhi semua rule</b></div>
                                                </div>
                                            <?php
                                            } else {
                                                $sql_que = mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");
                                                $row_bar = mysql_fetch_array($sql_que);
                                                $rule_terpilih = "IF " . $row_bar[1] . " AND " . $row_bar[2] . " THEN jurusan = " . $row_bar[3];
                                            ?>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Rule yang terpilih adalah rule ke :</div>
                                                    <div class="col-lg-9 col-md-8"><?= $row_bar[0] . $rule_terpilih ?></div>
                                                </div>
                                            <?php
                                            }
                                            echo "<center><a href='delete_prediksi.php?id=$nisn' accesskey='5' title='ubah jawaban' onClick=\"return confirm('Anda yakin akan mengedit data?')\">Klik disini untuk kembali lakukan prediksi</a></center>";
                                        }
                                        //jika belum melakukan prediksi
                                        else if ($jmlque == 0) {
                                            if (!isset($_POST['submit'])) {
                                            ?>
                                                <center><b>Jawab pertanyaan berikut dengan benar!</b></center>
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
                                                        <input type="number" name="txtbhs_id" id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>
                                                    <!-- Nilai Matematika -->
                                                    <div class="form-group">
                                                        <label for="math">Nilai Matematika :</label>
                                                        <input type="number" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>
                                                    <!-- Nilai bahasa inggris -->
                                                    <div class="form-group">
                                                        <label for="ing">Nilai Bahasa Inggris :</label>
                                                        <input type="number" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>
                                                    <!-- Nilai ipa -->
                                                    <div class="form-group">
                                                        <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                                                        <input type="number" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>
                                                    <!-- Nilai ips -->
                                                    <div class="form-group">
                                                        <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                                                        <input type="number" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>
                                                    <!-- Nilai skhu -->
                                                    <div class="form-group">
                                                        <label for="hu">Nilai SKHU :</label>
                                                        <input type="number" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                                                    </div>

                                                    <!--  -->
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
                                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                                    </div>
                                                </form>

                                    <?php
                                            } else {
                                                $n_ppdb = $_POST['txtppdb'];
                                                $n_bhs_indonesia = $_POST['txtbhs_id'];
                                                $n_matematika = $_POST['txtmtk'];
                                                $n_bhs_inggris = $_POST['txtbhs_ing'];
                                                $n_ipa = $_POST['txtipa'];
                                                $n_ips = $_POST['txtips'];
                                                $n_skhu = $_POST['txtskhu'];
                                                echo "<h4><center>Hasil Jawaban Anda...<br>";
                                                echo "ppdb: " . $n_ppdb . "<br>";
                                                echo "bhs_indonesia: " . $n_bhs_indonesia . "<br>";
                                                echo "matematika: " . $n_matematika . "<br>";
                                                echo "bhs_inggris: " . $n_bhs_inggris . "<br>";
                                                echo "ipa: " . $n_ipa . "<br>";
                                                echo "ips: " . $n_ips . "<br>";
                                                echo "skhu: " . $n_skhu . "<br><br><br></center></h4>";

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
                                                    $rule = str_replace("instansi", "'$n_instansi'", $rule);
                                                    $rule = str_replace("status", "'$n_status'", $rule);
                                                    $rule = str_replace("jurusan", "'$n_jurusan'", $rule);
                                                    $rule = str_replace("rata_un", "$n_rataUN", $rule);
                                                    $rule = str_replace("kerja", "'$n_kerja'", $rule);
                                                    $rule = str_replace("motivasi", "'$n_motivasi'", $rule);
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
                                                    echo "<h1><center>Anda diprediksi masuk kelas " . $keputusan . "</center></h1>";
                                                    echo "<h4><center>Rule terpilih adalah rule yang terakhir karena tidak memenuhi semua rule</center></h4>";
                                                    mysql_query("INSERT INTO hasil_prediksi (nisn,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,hasil) VALUES 
				('$nisn','$n_ppdb','$n_bhs_indonesia','$n_matematika','$n_bhs_inggris','$n_ipa','$n_ips','$n_skhu','$keputusan')");
                                                } else {
                                                    echo "<h1><center>Anda diprediksi masuk kelas " . $keputusan . "</center></h1>";
                                                    $sql_que = mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");
                                                    $row_bar = mysql_fetch_array($sql_que);
                                                    $rule_terpilih = "IF " . $row_bar[1] . " AND " . $row_bar[2] . " THEN jurusan = " . $row_bar[3];
                                                    echo "<h4><center>Rule yang terpilih adalah rule ke-" . $row_bar[0] . "<br>" . $rule_terpilih . "</center></h4>";
                                                    mysql_query("INSERT INTO hasil_prediksi (nisn,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,hasil) VALUES 
				('$nisn','$n_ppdb','$n_bhs_indonesia','$n_matematika','$n_bhs_inggris','$n_ipa','$n_ips','$n_skhu','$keputusan')");
                                                }
                                            }
                                        }
                                    }
                                    ?>


                                    <!-- Profile Edit Form -->
                                    <!-- <form> -->

                                    <!-- <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/img/profile-img.jpg" alt="Profile">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control" id="company" value="Lueilwitz, Wisoky and Leuschke">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control" id="Job" value="Web Designer">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control" id="Country" value="USA">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div> -->
                                    <!-- </form> -->
                                    <!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control" id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Ni Luh Putu Sri Astiti</span></strong>.

        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/chart.js/chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/echarts/echarts.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?= base_url('assets/NiceAdmin/assets/vendor/php-email-form/validate.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/NiceAdmin/assets/js/main.js') ?>"></script>

</body>

</html>