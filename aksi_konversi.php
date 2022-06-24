<?php
require_once 'conn/koneksi.php';
$query = mysql_query("select * from data_training order by(id)");
$query2 = mysql_query("select * from data_training_konversi order by(id)");
$jumlah = mysql_num_rows($query);
$jumlah2 = mysql_num_rows($query2);

while ($row = mysql_fetch_array($query)) {
  $jk = $row['jk'];
  $ppdb = $row['ppdb'];
  $bhs_indonesia = $row['bhs_indonesia'];
  if ($bhs_indonesia >= 92 && $bhs_indonesia <= 100) {
    $bhs_indonesia = "A";
  } else if ($bhs_indonesia >= 84 && $bhs_indonesia < 92) {
    $bhs_indonesia = "B";
  } else if ($bhs_indonesia >= 76 && $bhs_indonesia < 84) {
    $bhs_indonesia = "C";
  } else if ($bhs_indonesia >= 70 && $bhs_indonesia < 76) {
    $bhs_indonesia = "D";
  } else if ($bhs_indonesia >= 65  && $bhs_indonesia < 70) {
    $bhs_indonesia = "E";
  } else {
    $bhs_indonesia = "Tidak Lulus";
  }
  $matematika = $row['matematika'];
  if ($matematika >= 92 && $matematika <= 100) {
    $matematika = "A";
  } else if ($matematika >= 84 && $matematika < 92) {
    $matematika = "B";
  } else if ($matematika >= 76 && $matematika < 84) {
    $matematika = "C";
  } else if ($matematika >= 70 && $matematika < 76) {
    $matematika = "D";
  } else if ($matematika >= 65  && $matematika < 70) {
    $matematika = "E";
  } else {
    $matematika = "Tidak Lulus";
  }
  $bhs_inggris = $row['bhs_inggris'];
  if ($bhs_inggris >= 92 && $bhs_inggris <= 100) {
    $bhs_inggris = "A";
  } else if ($bhs_inggris >= 84 && $bhs_inggris < 92) {
    $bhs_inggris = "B";
  } else if ($bhs_inggris >= 76 && $bhs_inggris < 84) {
    $bhs_inggris = "C";
  } else if ($bhs_inggris >= 70 && $bhs_inggris < 76) {
    $bhs_inggris = "D";
  } else if ($bhs_inggris >= 65  && $bhs_inggris < 70) {
    $bhs_inggris = "E";
  } else {
    $bhs_inggris = "Tidak Lulus";
  }
  $ipa = $row['ipa'];
  if ($ipa >= 92 && $ipa <= 100) {
    $ipa = "A";
  } else if ($ipa >= 84 && $ipa < 92) {
    $ipa = "B";
  } else if ($ipa >= 76 && $ipa < 84) {
    $ipa = "C";
  } else if ($ipa >= 70 && $ipa < 76) {
    $ipa = "D";
  } else if ($ipa >= 65  && $ipa < 70) {
    $ipa = "E";
  } else {
    $ipa = "Tidak Lulus";
  }
  $ips = $row['ips'];
  if ($ips >= 92 && $ips <= 100) {
    $ips = "A";
  } else if ($ips >= 84 && $ips < 92) {
    $ips = "B";
  } else if ($ips >= 76 && $ips < 84) {
    $ips = "C";
  } else if ($ips >= 70 && $ips < 76) {
    $ips = "D";
  } else if ($ips >= 65  && $ips < 70) {
    $ips = "E";
  } else {
    $ips = "Tidak Lulus";
  }
  $skhu = $row['skhu'];
  if ($skhu >= 92 && $skhu <= 100) {
    $skhu = "A";
  } else if ($skhu >= 84 && $skhu < 92) {
    $skhu = "B";
  } else if ($skhu >= 76 && $skhu < 84) {
    $skhu = "C";
  } else if ($skhu >= 70 && $skhu < 76) {
    $skhu = "D";
  } else if ($skhu >= 65  && $skhu < 70) {
    $skhu = "E";
  } else {
    $skhu = "Tidak Lulus";
  }
  $jurusan = $row['jurusan'];

  if (isset($_POST['submit_konversi'])) {
    $simpan = mysql_query("INSERT INTO data_training_konversi 
			                      	(jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan)
                            VALUES(
                              '$jk',
                              '$ppdb',
                              '$bhs_indonesia',
                              '$matematika',
                              '$bhs_inggris',
                              '$ipa',
                              '$ips',
                              '$skhu',
                              '$jurusan'
                            )");
    if ($simpan) :
      header('location:mining_konversi.php?status_konversi=sukses_konversi');
    endif;
  }
}
?>