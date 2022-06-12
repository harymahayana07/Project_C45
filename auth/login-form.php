<?php require_once '../conn/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>C45 | LOGIN </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/login-form.css'); ?>">

</head>

<body>
  <div class="container mt-2">
    <div class="wrapper">
      <div class="logo"> <img src="<?= base_url('dist/img/user.png') ?>" alt=""> </div>
      <div class="text-center mt-4 name"> SISTEM </div>
      <div class="text-center name"> PENJURUSAN SISWA </div>
      <?php
      if (isset($_POST['login'])) {
        $userID = $_POST['user'];
        $password = $_POST['pass'];
        $query = mysql_query("select * from user where user_id='$userID' and password='$password'");

        if (mysql_num_rows($query) == 0) {
      ?>
          <div class="row">
            <div class="col-lg-12 col-lg-offset-1">
              <div class="alert alert-danger alert-dismissable" role="alert">
                <a href="<?= base_url('auth/login-form.php') ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <center><strong>Login gagal!</strong> <br> Username / Password salah</center>
              </div>
            </div>
          </div>
      <?php
        } else {
          while ($row = mysql_fetch_array($query)) {
            $_SESSION['login'] = true;
            $_SESSION['usr'] = $row['user_id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['pwd'] = $row['password'];
            $_SESSION['lvl'] = $row['type'];
            header("location:../index.php");
          }
        }
      }
      ?>
      <form class="p-3 mt-3" action="" method="POST">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="user" id="userName" placeholder="Username" autocomplete="off" required> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="pass" id="pwd" placeholder="Password" required> </div>
        <input type="submit" name="login" class="btn mt-3" value="Login">
      </form>
      <div class="text-center fs-6"> <a href="<?= base_url('public/index.php') ?>">Kembali </a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href="<?= base_url('lupa_password.php') ?>">Lupa password?</a></div>
    </div>
  </div>
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
  <script src="<?= base_url('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>