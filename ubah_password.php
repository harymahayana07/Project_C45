<?php $thisPage = "Password";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<?php
include_once("partial/headers.php");
include_once("partial/navbar.php");
include_once("partial/sidebar.php");
include_once("conn/general.php");
?>
<?php
if (isset($_POST['submit'])) :
	$lama = $_POST['lama'];
	$baru = $_POST['baru'];
	$konfirm = $_POST['konfirm'];

	$sql = mysql_query("SELECT * FROM user WHERE password='$lama'");
	$row = mysql_fetch_array($sql);

	if (!$lama) {
		$errors[] = 'password lama tidak boleh kosong';
	}
	if (!$baru) {
		$errors[] = 'password baru tidak boleh kosong';
	}
	if (!$konfirm) {
		$errors[] = 'konfirmasi passwordtidak boleh kosong';
	}

	if (empty($errors)) :

		if (mysql_num_rows($sql) == 1) {
			if ($baru == $konfirm) {
				$simpan = mysql_query("UPDATE user SET password='$baru' WHERE user_id='$row[0]'");
				if ($simpan) {
					$sts[] = 'Password Berhasil Dirubah';
				} else {
					$sts[] = 'Password Gagal dirubah';
				}
			} else {
				$sts[] = 'Password Baru dan Konfirmasi Anda berbeda';
			}
		} else {
			$sts[] = 'Password Lama Anda salah';
		}

	endif;
endif;
?>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h3 class="m-0"><i class="fas fa-sync-alt"></i>&nbsp;PASSWORD</h3>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Home</li>
								<li class="breadcrumb-item active">Password</li>
							</ol>
						</div>
					</div>
				</div>
			</div>

			<section class="content">
				<div class="container-fluid">
					<?php if (!empty($errors)) : ?>
						<?php foreach ($errors as $err) : ?>
							<div style="margin-left: 2px; margin-right: 9px;">
								<div class="col-md-6 col-md-3 alert alert-warning"><i class="fas fa-check-circle"></i><a href=""><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $err; ?></div>
							</div>
						<?php endforeach; ?>
					<?php
					endif;
					?>
					<?php if (!empty($sts)) : ?>
						<?php foreach ($sts as $st) : ?>
							<div style="margin-left: 2px; margin-right: 9px;">
								<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href=""><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $st; ?></div>
							</div>
						<?php endforeach; ?>
					<?php
					endif;
					?>
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title">Ubah Password</h3>
						</div>
						<form class="form-horizontal" action="" method="POST">
							<div class="card-body">
								<div class="form-group row">
									<label for="pw_lama" class="col-sm-2 col-form-label">Password Lama</label>
									<div class="col-sm-10">
										<input type="text" name="lama" class="form-control" id="pw_lama" placeholder=" * Masukkan Password lama">
									</div>
								</div>
								<div class="form-group row">
									<label for="pw_baru" class="col-sm-2 col-form-label">Password Baru</label>
									<div class="col-sm-10">
										<input type="text" name="baru" class="form-control" id="pw_baru" placeholder=" * Masukkan Password baru">
									</div>
								</div>
								<div class="form-group row">
									<label for="pw_konfirmasi" class="col-sm-2 col-form-label">Konfirmasi Password</label>
									<div class="col-sm-10">
										<input type="text" name="konfirm" class="form-control" id="pw_konfirmasi" placeholder=" * Konfirmasi Password ">
									</div>
								</div>

							</div>
							<div class="card-footer">
								<input type="submit" name="submit" class="btn btn-info" value="Update">
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		<?php
		require 'partial/footers.php';
		?>