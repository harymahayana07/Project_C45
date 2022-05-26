<?php
// setting default timezone 
date_default_timezone_set('Asia/Jakarta');
//KONVERSI PHP KE PHP 7
include "parser-php-version.php";
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "c45";
$koneksi = mysql_connect($host, $user, $password);
mysql_select_db($database, $koneksi);

// fungsi base url
function base_url($url = null)
{
    $base_url = "http://localhost:80/c45";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}
// tanggal indonesia
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . "/" . $bulan . "/" . $tahun;
}
