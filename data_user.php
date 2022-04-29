	<?php
	session_start();
	if (!isset($_SESSION['usr'])) {
		header("location:login-form.php");
	}
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>SMANDA | DATA USER </title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
		<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
		<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	</head>

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
		$query = mysql_query("SELECT * FROM data_siswa ORDER BY (nisn)");
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
		<?php
		require 'partial/sidebar.php';
		require 'partial/navbar.php';
		?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">DATA SISWA</h1>
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
									<button type="button" class="btn btn-primary btn-responsive" data-bs-toggle="modal" data-bs-target="#tambahDataUser">
										<i class="fas fa-plus-square"></i> Tambah Data
									</button>
									<button type="button" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusDataSiswa">
										<i class="fas fa-trash-alt"></i></i> Reset
									</button>
									<button type="button" class="btn btn-success btn-responsive" data-bs-toggle="modal" data-bs-target="#importData">
										<i class="fas fa-upload"></i> Import
									</button>
								</div>

							</div>
						</div>
					</div>
					<!--  -->
				</div>



				<!--  -->
				<div class="wrapper">
					<section class="content">
						<div class="container-fluid">

							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">
												<?php
												if ($jumlah == 0) {
													echo "<center><h3>Data User & Siswa Masih kosong...</h3></center>";
												} else {
													echo "Jumlah Data Siswa : " . $jumlah;
												}
												?>
											</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">

											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr style="text-align: center;">
														<th>No</th>
														<th>UserId/Nisn</th>
														<th>Nama</th>
														<th>Jenis Kelamin</th>
														<th>Asal Sekolah</th>
														<th>Status Prediksi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
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
														<tr bgcolor=<?php echo $warna; ?> class="text-center">
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
																?>
															</td>
															<td>
																<a href="data_user.php?act=delete&id=<?php echo $row[0]; ?>" class="btn btn-danger btn-responsive btn-sm d-inline" onclick="return confirm('Anda yakin akan hapus data ini?')"><i class="fas fa-trash"></i></a>
															</td>
														</tr>
												<?php
														$no++;
													}
												}
												?>
												</tbody>

											</table>

										</div>
										<!-- /.card-body -->
									</div>
									<!-- /.card -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.container-fluid -->
					</section>
					<!--  -->
				</div>
			</div>
		</div>


		<!-- Modal hapus data -->
		<div class="modal fade" id="hapusDataSiswa" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
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
							<a href="index.php?menu=user&act=delete_all" type="button" class="btn btn-primary"> Ya </a>
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
								<form method="POST" enctype="multipart/form-data" action="upload.php?data=user">
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
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- DataTables  & Plugins -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="plugins/jszip/jszip.min.js"></script>
		<script src="plugins/pdfmake/pdfmake.min.js"></script>
		<script src="plugins/pdfmake/vfs_fonts.js"></script>
		<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>

		<!-- Page specific script -->
		<script>
			$(function() {
				$("#example1")
					.DataTable({
						responsive: true,
						lengthChange: false,
						autoWidth: false,
						buttons: ["copy", "excel", "pdf", "print", "colvis"],
					})
					.buttons()
					.container()
					.appendTo("#example1_wrapper .col-md-6:eq(0)");
				$("#example2").DataTable({
					paging: true,
					lengthChange: false,
					searching: false,
					ordering: false,
					info: true,
					autoWidth: false,
					responsive: true,
				});
			});
		</script>

		<footer class="main-footer">
			<strong>Copyright &copy; 2021-2022 <i>Ni Luh Putu Sri Astiti</i> </strong>
		</footer>
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		</div>
		</body>

	</html>