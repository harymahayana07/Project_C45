<!--  -->
<?php $thisPage = "POHON KEPUTUSAN";
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
	<title>SMANDA | TREE</title>
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
	<link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/loading.css') ?>" /> -->


</head>
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
if (isset($_GET['act'])) {
	$action = $_GET['act'];
	$id = $_GET['id'];
	//delete data training
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE pohon_keputusan");
		header('location:tree.php');
	}
} else {
	$query = mysql_query("select * from pohon_keputusan order by(id)");
	$jumlah = mysql_num_rows($query);
	//jika pohon keputusan kosong
	require 'partial/navbar.php';
	require 'partial/sidebar.php';
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<h1 class="m-0">TREE</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item active">Tree</li>
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
								<a href="<?= base_url('pohon_tree.php') ?>" type="button" class="btn btn-warning btn-sm btn-responsive"><i class="fas fa-eye"></i>&emsp; Lihat Pohon Keputusan</a>&emsp;

								<button type="button" class="btn btn-sm btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusDataTree">
									<i class="fas fa-trash-alt"></i></i> Reset
								</button>&emsp;
								<!-- Modal hapus data -->
								<div class="modal fade" id="hapusDataTree" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-warning">
												<h5>Hapus Data Tree</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Yakin Hapus Semua Data ?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
												<!--  -->
												<a href="tree.php?act=delete_all" class="btn btn-primary"> Ya </a>
												<!--  -->
											</div>

										</div>
									</div>
								</div>
								<a href="<?= base_url('uji_rule.php') ?>" type="button" class="btn btn-info btn-sm btn-responsive"><i class="fas fa-hourglass-end"></i>&emsp; Uji Rule / Akurasi Rule</a>&emsp;

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
												echo "<center><h3>Pohon Keputusan Belum Terbentuk...</h3></center>";
											} else {
												echo "Jumlah Data Tree: " . $jumlah;
											}
											?>
										</h3>
									</div>
									<!-- /.card-header -->
									<div class="card-body">

										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr class="text-center">
													<th>Id</th>
													<th>Aturan</th>
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
													<tr bgcolor=<?php echo $warna; ?>>
														<td align='center'><?php echo $row['id']; ?></td>
														<td><?php
															echo "IF ";
															if ($row['parent'] != '') {
																echo $row['parent'] . " AND ";
															}
															echo $row['akar'] . " THEN jurusan= " . $row['keputusan']; ?>
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

	<script>
		const hapus = document.querySelector('#hapus');
		hapus.addEventListener('click', function() {
			swal({
				title: 'hapus data ini',
				text: 'yakin hapus data',
				type: 'warning'
			});
		});
	</script>
	<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
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