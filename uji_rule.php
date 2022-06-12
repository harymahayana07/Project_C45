<?php $thisPage = "DATA UJI";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<?php
require 'partial/header.php';

if (isset($_GET['act'])) {
	$action = $_GET['act'];
	//delete semua data
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE data_uji");
		header('location:uji_rule.php');
	}
} else { ?>
	<?php
	
	if (isset($_POST['submit_akurasi'])) {
		require 'partial/sidebar.php';
		require 'partial/navbar.php';
	?>
		<div class="content-wrapper">
			<div class=" card">
				<div class="card-body">
					<?php include "hitung_akurasi.php"; ?>
				</div>
			</div>
		</div>

	<?php
	} else {
		$query = mysql_query("SELECT * FROM data_uji order by(id)");
		$jumlah = mysql_num_rows($query);
										require 'partial/sidebar.php';
										require 'partial/navbar.php';
	?>
		<!--  -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">UJI RULE</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Home</li>
								<li class="breadcrumb-item active">Uji rule</li>
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
							<div class="row">
								<div class="col-lg-12 col-md-4">
									<a href="<?= base_url('tree.php') ?>" type="button" class="btn btn-success btn-sm btn-responsive"><i class="fas fa-backward"></i>&emsp; Kembali</a>&emsp;
									<button type="submit" class="btn btn-danger btn-sm btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusuji">
										<i class="fas fa-trash-alt"></i></i>&emsp;Reset
									</button>&emsp;

									<a href="<?= base_url('uji_rule.php') ?>" type="button" class="btn btn-success btn-sm btn-responsive"><i class="fas fa-sync"></i>&emsp; Refresh</a>&emsp;
									<!--  -->
									<!-- Modal hapus data -->
									<div class="modal fade" id="hapusuji" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-warning">
													<h5>Hapus Data Uji</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Yakin Hapus Semua Data ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
													<!--  -->
													<a href="<?= base_url('uji_rule.php?act=delete_all')?>" class="btn btn-primary"> Ya </a>
													<!--  -->
												</div>

											</div>
										</div>
									</div>
									<!--  -->
									<button type="button" class="btn btn-sm btn-warning btn-responsive" data-bs-toggle="modal" data-bs-target="#importDataUji">
										<i class="fas fa-upload"></i> Import
									</button>
									<!--  -->
									<!-- Modal import data -->
									<div class="modal fade" id="importDataUji" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-warning">
													<h5>Import Data Uji</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">

													<div class="form-group">
														<label for="exampleInputFile">Input File : </label>
														<div class="input-group">

															<form method="POST" enctype="multipart/form-data" action="<?= base_url('upload.php?data=uji')?>">
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
									<form method="POST" action='' class="d-inline">
										<button type="submit" name="submit_akurasi" class="btn btn-primary btn-sm btn-responsive">
											<i class="fas fa-hourglass-end"></i>&emsp;Hitung Akurasi
										</button>
									</form>&emsp;
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
													echo "<center><h3>Data Uji masih kosong...</h3></center>";
												} else {
													echo "Jumlah data uji: " . $jumlah;
												}
												?>


											</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">

											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>JENIS KELAMIN</th>
														<th>PPDB</th>
														<th>BAHASA INDONESIA</th>
														<th>MATEMATIKA</th>
														<th>BAHASA INGGRIS</th>
														<th>IPA</th>
														<th>IPS</th>
														<th>SKHU</th>
														<th>JURUSAN 1</th>

													</tr>
												</thead>
												<tbody>
													<?php
													$warna1 = '#ffffff';
													$warna2 = '#f5f5f5';
													$warna  = $warna1;
													$no = 1;

													while ($row = mysql_fetch_array($query)) {
														if ($warna == $warna1) {
															$warna = $warna2;
														} else {
															$warna = $warna1;
														}
													?>
														<tr bgcolor=<?php echo $warna; ?> class="text-center">
															<td><?php echo $no; ?></td>
															<td>
																<?php if ($row['jk'] == '1') {
																	echo 'L';
																} else if ($row['jk'] == '2') {
																	echo 'P';
																} ?>
															</td>
															<td><?php if ($row['ppdb'] == '1') {
																	echo 'Perpindahan Orang tua';
																} else if ($row['ppdb'] == '2') {
																	echo 'Prestasi Akademik';
																} else if ($row['ppdb'] == '3') {
																	echo 'Prestasi Non-Akademik';
																} else if ($row['ppdb'] == '4') {
																	echo 'Prestasi Thafidz';
																} else if ($row['ppdb'] == '5') {
																	echo 'Afirmasi';
																} else if ($row['ppdb'] == '6') {
																	echo 'Zonasi';
																} else if ($row['ppdb'] == '7') {
																	echo 'PPLP';
																}
																?>
															</td>
															<td>
																<?php echo $row['bhs_indonesia']; ?>
															</td>
															<td>
																<?php echo $row['matematika']; ?>
															</td>
															<td>
																<?php echo $row['bhs_inggris']; ?>
															</td>
															<td>
																<?php echo $row['ipa']; ?>
															</td>
															<td>
																<?php echo $row['ips']; ?>
															</td>
															<td>
																<?php echo $row['skhu']; ?>
															</td>
															<td>
																<b>
																	<?php echo $row['jurusan_asli']; ?>
																</b>
															</td>
														</tr>
													<?php
														$no++;
													}
													?>
												</tbody>
											</table>
									<?php
								}
							}
									?>
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

		<!--  -->
		<script src="<?= base_url('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') ?>"></script>
		<!-- jQuery -->
		<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
		<!-- Bootstrap 4 -->
		<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
		<!-- DataTables  & Plugins -->
		<script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('plugins/jszip/jszip.min.js') ?>"></script>
		<script src="<?= base_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
		<script src="<?= base_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
		<script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

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
					ordering: true,
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