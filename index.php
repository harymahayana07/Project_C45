
<?php
if (!isset($_GET['menu'])) {
  include 'dashboard.php';
}
//jika menu sudah diset
if (isset($_GET['menu'])) {
  $kode = $_GET['menu'];
  //menu home
  if ($kode == 'home') {
    include 'dashboard.php';
  }
  //menu olah data
  else if ($kode == 'data') {
    include 'data_training.php';
  }
  //menu mining (proses pembentukan pohon keputusan)
  else if ($kode == 'mining') {
    include 'mining.php';
  }
  //menu pohon keputusan atau rule
  else if ($kode == 'tree') {
    include 'tree.php';
  }
  //menu pohon tree2
  else if ($kode == 'pohon_tree') {
    include 'pohon_tree.php';
  }
  //menu uji pohon keputusan atau rule
  else if ($kode == 'uji_rule') {
    include 'uji_rule.php';
  }
  //menu hasil prediksi
  else if ($kode == 'hasil') {
    include 'hasil_prediksi.php';
  }
  //menu data user
  else if ($kode == 'user') {
    include 'data_user.php';
  }
  //menu prediksi
  else if ($kode == 'prediksi') {
    include 'prediksi.php';
  }
  //menu ubah password
  else if ($kode == 'ubah_password') {
    include 'ubah_password.php';
  }
}
?>