<?php
session_start();
if (!isset($_SESSION['usr'])) {
  header("location:login-form.php");
}
?>

<?php
$level = $_SESSION['lvl'];
if ($level == 'admin') {
  require 'partial/navbar.php';
  require 'partial/sidebar.php';
  require 'dashboard.php';
?>
<?php 
	//jika menu sudah diset
  if (isset($_GET['menu'])) {
    $kode=$_GET['menu'];
    //menu home
    if($kode=='home'){
      echo "<center><strong>
      <h2>SISTEM PREDIKSI PRESTASI AKADEMIK MAHASISWA MENGGUNAKAN METODE DECISION TREE C4.5</h2><br/>
      <img src='images/university.png' width='350' height='auto'/><br>									
      Aplikasi ini akan menghasilkan informasi perkiraan prestasi akademik mahasiswa baru dari data training yang digunakan adalah data nilai UN, Jurusan, Status pekerjaan, Motivasi dan Prestasi sekolah.
      <br>
      Hasil analisa dikelompokkan menjasi kelas tinggi (predikasi berprestasi tinggi) dan kelas rendah (predikasi berprestasi rendah).
      </strong></center>";
    }
    //menu olah data
    else if ($kode=='data'){
      include 'data_training.php';
    }
    //menu mining (proses pembentukan pohon keputusan)
    else if($kode=='mining'){
      include 'mining.php';
    }
    //menu pohon keputusan atau rule
    else if($kode=='tree'){
      include 'tree.php';
    }
    //menu pohon tree2
    else if($kode=='pohon_tree'){
      include 'pohon_tree.php';
    }
    //menu uji pohon keputusan atau rule
    else if($kode=='uji_rule'){
      include 'uji_rule.php';
    }
    //menu hasil prediksi
    else if($kode=='hasil'){	
      include 'hasil_prediksi.php';
    }
    //menu data user
    else if($kode=='user'){		
      include 'data_user.php';
    }
    //menu prediksi
    else if($kode=='prediksi'){
      include 'prediksi.php';
    }
    //menu ubah password
    else if($kode=='ubah_password'){
      include 'ubah_password.php';
    }
  }
  //jika menu belum diset
  else{
    echo "<strong><center>Belum diset</center></strong><br><br>";
    echo "<center><strong>
        
        <h2>SISTEM PREDIKSI PRESTASI AKADEMIK MAHASISWA MENGGUNAKAN METODE DECISION TREE C4.5</h2><br/>
        <img src='images/university.png' width='350' height='auto'/><br>									
        Aplikasi ini akan menghasilkan informasi perkiraan prestasi akademik mahasiswa baru dari data training yang digunakan adalah data nilai UN, Jurusan, Status pekerjaan, Motivasi dan Prestasi sekolah.
        <br>
        Hasil analisa dikelompokkan menjasi kelas tinggi (predikasi berprestasi tinggi) dan kelas rendah (predikasi berprestasi rendah).
        </strong></center>";
  }
?>

<?php
} else {
  require 'partial/navbar-siswa.php';
}
?>

<?php
require 'partial/footer.php';
?>