<?php $thisPage = "HASIL PREDIKSI";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SMANDA | DATA PREDIKSI </title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>" />

	<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
</head>
<?php
require 'partial/navbar.php';
require 'partial/sidebar.php';
?>

<body class="hold-transition sidebar-mini">

	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>POHON KEPUTUSAN</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Pohon Keputusan</li>
							</ol>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</section>
			<?php
			if (isset($_GET['act'])) {
				$action = $_GET['act'];
				//delete semua data
				if ($action == 'delete_all') {
					mysql_query("TRUNCATE hasil_prediksi");
					header('location:hasil_prediksi.php');
				}
			} else {
				$query = mysql_query("SELECT a.nisn,b.nama,b.jenis_kelamin,b.asal_sekolah,a.hasil 
								FROM hasil_prediksi a INNER JOIN data_siswa b ON (a.nisn=b.nisn) 
								ORDER BY(a.nisn)");
				$jumlah = mysql_num_rows($query);
				//jika hasil_prediksi kosong
				if ($jumlah == 0) {
					echo "<center><h3>Hasil Prediksi Kosong...</h3></center>";
				}
				//jika hasil prediksi sudah terisi
				else {
			?>

					<!--  -->
					<section class="content">
						<div class="container-fluid">

							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">
												<?php
												if ($jumlah == 0) {
													echo "<center><h3>Data Prediksi masih kosong...</h3></center>";
												} else {
													echo "Jumlah data : " . $jumlah;
												}
												?>
												<p>
													Opsi:
													<a href="index.php?menu=hasil&act=delete_all" onClick="return confirm('Anda yakin akan hapus semua data?')">Hapus Semua Data</a> |
													<a href="export/CLP.php?format=3">Download Laporan</a>
												</p>
											</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">

											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nisn</th>
														<th>Nama</th>
														<th>Jenis Kelamin</th>
														<th>Asal Sekolah</th>
														<th>Hasil Prediksi</th>

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
															<td><?php echo $row[0]; ?></td>
															<td><?php echo $row[1]; ?></td>
															<td><?php echo $row[2]; ?></td>
															<td><?php echo $row[3]; ?></td>
															<td><?php echo $row[4]; ?></td>
														</tr>
											<?php
														$no++;
													}
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
<!--  -->