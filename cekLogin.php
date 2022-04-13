<?php
include "koneksi.php";
$userID = $_POST['user'];
$password = $_POST['pass'];
$query = mysql_query("select * from user where user_id='$userID' and password='$password'");

if (mysql_num_rows($query) == 0) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>C45 | LOGIN </title>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/login-form.css">
    </head>

    <body>
        <div class="container mt-2">
            <div class="wrapper">
                <div class="logo"> <img src="dist/img/user.png" alt=""> </div>
                <div class="text-center mt-4 name"> SISTEM </div>
                <div class="text-center name"> PENJURUSAN SISWA </div>
                <p class="alert alert-danger error text-center">Username Dan Password Tidak Cocok</p>
                <form class="p-3 mt-3" action="cekLogin.php" method="POST">
                    <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="user" id="userName" placeholder="Username" autocomplete="off" required> </div>
                    <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="pass" id="pwd" placeholder="Password" required> </div>
                    <button class="btn mt-3">Login</button>
                </form>
                <div class="text-center fs-6"> <a href="public/index.php">Kembali </a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href="ubah_password.php">Lupa password?</a></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
<?php
} else {
    while ($row = mysql_fetch_array($query)) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['usr'] = $row['user_id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['pwd'] = $row['password'];
        $_SESSION['lvl'] = $row['type'];
        header("location:index.php");
    }
}

?>