<?php require_once '../conn/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>C45 | LOGIN </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" crossorigin="anonymous" />
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
          $msg = "Username & Password yang Anda Masukkan Salah";
      ?>
          <div class="row">
            <div class="col-md-12 col-md-3">
              <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show mt-2" role="alert">
                <button type="button" class="close bg-dark" data-dismiss="alert" aria-label="Close">
                  <a href="" class="text-white"><span aria-hidden="true">&emsp;×&emsp;</span></a>
                </button>
                <div class="text-center" style="margin-left: 30px; margin-top: 4px;">
                  <p><strong>Username & Password yang diMasukan Salah</strong></p>
                </div>
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
      <form class="p-3" action="" method="POST">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="user" id="userName" placeholder="Username" autocomplete="off" required autofocus> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="pass" id="pass" placeholder="Password" required> </div>
        <!-- <span id="mybutton" onclick="change()" style="margin-right: 20px;">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
              <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
            </svg>
          </span> -->

        <input type="submit" name="login" class="btn mt-3" value="Login">
      </form>
      <div class="fs-6">&emsp;<a href="<?= base_url('public/index.php') ?>"><span class="fas fa-arrow-left"></span>&emsp;Kembali </a></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'"></script>
  <!-- <script>
    function change() {
      var x = document.getElementById('pass').type;
      if (x == 'password') {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                                    </svg>`;
      } else {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                    </svg>`;
      }
    }
  </script> -->
</body>

</html>