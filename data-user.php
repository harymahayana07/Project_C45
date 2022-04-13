	<?php
	session_start();
	if (!isset($_SESSION['usr'])) {
		header("location:login-form.php");
	}
	?>
	<?php
	require 'partial/sidebar.php';
	require 'partial/navbar.php';
	?>
	<?php
	include "koneksi.php";
	if (isset($_GET['act'])) {
		$action = $_GET['act'];
		$id = $_GET['id'];
		//delete data user
		if ($action == 'delete') {
			mysql_query("DELETE FROM user WHERE user_id = '$id'");
			mysql_query("DELETE FROM data_siswa WHERE nisn = '$id'");
			header('location:index.php?menu=user');
		}
		//delete semua data
		else if ($action == 'delete_all') {
			mysql_query("TRUNCATE data_siswa");
			mysql_query("DELETE FROM user WHERE type ='siswa'");
			header('location:index.php?menu=user');
		}
	} else {
		include 'form_data_user.php';
		$query = mysql_query("select * from data_siswa ORDER BY(nisn)");
		$jumlah = mysql_num_rows($query);
	?>
		<style>
			.btn {
				margin-bottom: 8px;
			}

			@media (max-width: 768px) {
				.btn-responsive {
					padding: 2px 4px;
					font-size: 80%;
					line-height: 1;
					border-radius: 3px;
				}
			}

			@media (min-width: 769px) and (max-width: 992px) {
				.btn-responsive {
					padding: 4px 9px;
					font-size: 90%;
					line-height: 1.2;
				}
			}
		</style>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">Data Siswa</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Home</li>
								<li class="breadcrumb-item active">Data Siswa</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="container-fluid mt-2">
				<!--  -->
				<div class="row mb-2">
					<!--  -->
					<div class="content-header">
						<div class="container-fluid">
							<div class="row" style="float: left;">
								<div class="col-lg-12 col-md-4">
									<button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#tambahDataUser">
										<i class="fas fa-plus-circle"> Tambah Data</i>
									</button>
									<button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusData">
										<i class="fas fa-trash-alt"> Hapus Data</i>
									</button>
									<button type="button" class="btn btn-secondary btn-responsive" data-bs-toggle="modal" data-bs-target="#importData">
										<i class="fas fa-plus-circle"> Import Data</i>
									</button>
								</div>

							</div>
						</div>
					</div>
					<!--  -->
				</div>

				<div class="row" style="float: left;">

					<div class="col-md-12">

						<!--  -->

						<!--  -->
						<?php

						if ($jumlah == 0) {
							echo "<center><h3> Data User & Siswa masih kosong...</h3></center>";
						} else {
							echo "Jumlah data : " . $jumlah;
						?>
							<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
								<tr align='center'>
									<th>No</th>
									<th>UserId/Nisn</th>
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Asal Sekolah</th>
									<th>Cek Prediksi</th>
									<th>Action</th>
								</tr>
								<?php
								$warna1 = '#ffffff';
								$warna2 = '#f5f5f5';
								$warna  = $warna1;
								$no = 1;
								while ($row = mysql_fetch_array($query)) {
									$nisn = $row['nisn'];
									$que = mysql_query("SELECT * FROM hasil_prediksi WHERE nisn = '$nisn'");
									$statusPrediksi = "";
									//jika mahasiswa sudah melakukan prediksi
									if (mysql_num_rows($que) == 1) {
										$statusPrediksi = "Sudah";
									} else if (mysql_num_rows($que) == 0) {
										$statusPrediksi = "Belum";
									}
									if ($warna == $warna1) {
										$warna = $warna2;
									} else {
										$warna = $warna1;
									}
								?>
									<tr bgcolor=<?php echo $warna; ?> align='center'>
										<td><?php echo $no; ?></td>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>
										<td><?php echo $row[2]; ?></td>
										<td><?php echo $row[3]; ?></td>
										<td><?php
											if ($statusPrediksi == 'Sudah') {
												echo "<strong>" . $statusPrediksi . "</strong>";
											} else {
												echo $statusPrediksi;
											}
											?></td>
										<td>
											<a href="index.php?menu=user&act=delete&id=<?php echo $row[0]; ?>" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
										</td>
									</tr>
								<?php
									$no++;
								}
								?>
							</table>
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
			<!-- end table -->
		</div>


		<!-- Modal hapus data -->
		<div class="modal fade" id="hapusData" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5>Hapus Data Siswa</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Yakin Hapus Semua Data ?
					</div>
					<form method="POST" enctype="multipart/form-data" action="upload.php?data=training">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
							<a href="index.php?menu=data&act=delete_all" type="button" class="btn btn-primary"> Ya </a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--  -->
		<!-- Modal import data -->
		<div class="modal fade" id="importData" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5>Import Data Siswa</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="exampleInputFile">Input File : </label>
							<div class="input-group">
								<form method="POST" enctype="multipart/form-data" action="upload.php?data=training">
									<div class="custom-file">
										<input type="file" name="userfile">
									</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input name="upload" type="submit" value="import">
					</div>
					</form>
				</div>
			</div>
		</div>
		<!--  -->
		<!-- /.content-header -->
		<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
		<?php
		require 'partial/footer.php';
		?>
		<!--  -->