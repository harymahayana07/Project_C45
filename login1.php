<!-- validasi login -->
<?php
// session mulai

//include/require koneksi
require 'koneksi.php';
// jika teken tombol login
if (isset($_POST['login'])) {
    // simpan inputan yg terjadi pada variabel post dan massukan ke variable $username dan $password
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];
    // jalankan query dari sql, koneksi dari conn, lalu ambil semua isi dalam tb_user, jika inputan sesuai user dan pass
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user='$username' and password='$password'");
    // kondisi, jika query benar, 
    if (mysqli_num_rows($query) === 1) {
        // masukan ke variabel data
        $data = mysqli_fetch_object($query);
        // ambil nilai dan masukan ke dalam session
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data->nama;
        $_SESSION['type'] = $data->type;
        // arahkan ke dashboard-> index
        header('location:dashboard.php');
        // jika salah maka munculkan pop up login gagal, username/password salah
    } else {
    }
    //    echo $error = 'Username atau password yang anda masukan salah';
}
?>
<!-- end val  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login </title>
    <link rel="stylesheet" type="text/css" href="assets/login.css" media="screen" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <script src="../C45/assets/js/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
  
    <style>

        body {
            background-image: url('dist/img/photo4.jpg');
        }
    </style>
</head>

<body>
<div>
		<center><h2>Login</h2><h4>Sistem Klasifikasi Jurusan ! </h4><br></center>
	</div>
	<div class="wrap">
		<div id="content">			
			<div id="main">		
				<div class="full_w">
					<form action="cekLogin.php" method="post" onSubmit="return validasi(this)">
						<label for="user">Username:</label>
							<input id="user" name="user" class="text" placeholder="Username"/>
						<label for="pass">Password:</label>
							<input id="pass" name="pass" type="password" class="text" placeholder="Password"/>
						<div class="sep"></div>
							<button type="submit" class="ok">Login</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</body>
<script>
    $('#form').parsley();
</script>

</html>