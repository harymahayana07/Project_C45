
<?php
require_once "conn/koneksi.php";
if (isset($_SESSION['usr'])) {
  echo "<script>window.location='" . base_url('dashboard.php') . "';</script>";
} else {
  echo "<script>window.location='" . base_url('public') . "';</script>";
}

?>