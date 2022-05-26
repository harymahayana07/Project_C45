<?php
if (isset($_POST['submit'])) {
	include "koneksi.php";
	$lama = $_POST['lama'];
	$baru = $_POST['baru'];
	$konfirm = $_POST['konfirm'];
	$sql = mysql_query("SELECT * FROM user WHERE password='$lama'");
	$row = mysql_fetch_array($sql);
	if (mysql_num_rows($sql) == 1) {
		if ($baru == $konfirm) {
			mysql_query("UPDATE user SET password='$baru' WHERE user_id='$row[0]'");
			echo "Berhasil ubah password";
		} else {
			echo "Password baru Anda tidak sama dengan konfirmasi password..";
		}
	} else {
		echo "Password lama Anda salah..";
	}
} else {
?>
	<!--  -->
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>C45 | UBAH_PASSWORD </title>
		<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/login-form.css">
	</head>

	<body>
		<div class="container mt-2">
			<div class="wrapper">
				<div class="logo"> <img src="dist/img/user.png" alt=""> </div>
				<div class="text-center name mt-3"> UBAH PASSWORD </div>

				<form class="p-3 mt-3" action='' method="POST">
					<div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="user" id="userName" placeholder="Username" autocomplete="off" required> </div>
					<div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="pass" id="pwd" placeholder="Password Lama" required> </div>
					<div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="pass2" id="pw" placeholder="Password Baru" required> </div>

					<input class="btn mt-3" type=submit name=submit value=Submit>
					<input class="btn mt-3" type='reset' value='Batal'>
				</form>
				<div class="text-center fs-6"> <a href="public/index.php">Kembali </a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</div>
			</div>
		</div>
		<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php
}
?>