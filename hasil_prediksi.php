<?php $thisPage = "HASIL PREDIKSI";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<?php
include_once("partial/headers.php");

if (isset($_GET['act'])) {
	$action = $_GET['act'];
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE hasil_prediksi");
		header('location:hasil_prediksi.php?status_hapus_all=sukses-hapus-all');
	}
} else {
	require 'partial/navbar.php';
	require 'partial/sidebar.php';
	$query = mysql_query("SELECT a.nisn,b.nama,b.jenis_kelamin,b.asal_sekolah,a.hasil 
								FROM hasil_prediksi a INNER JOIN data_siswa b ON (a.nisn=b.nisn) 
								ORDER BY(a.nisn)");
	$jumlah = mysql_num_rows($query);

?>

	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<div class="content-wrapper">
				<section class="content-header">
					<div class="container-fluid">

						<div class="row mb-2">
							<div class="col-sm-6">
								<h3><i class="fas fa-calculator">&nbsp;</i>HASIL PREDIKSI</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Hasil Prediksi</li>
								</ol>
							</div>
						</div>
					</div>
				</section>
				<section class="content">
					<div class="container-fluid">

						<div class="row mb-2">
							<div class="content-header">

								<div class="container-fluid">
									<div class="row" style="float: right;">
										<div class="col-lg-12 col-md-4">
											<a href="export/CLP.php?format=3" class="btn btn-success btn-responsive"><i class="fas fa-print"></i> Cetak </a>&emsp;

											<button type="button" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusDataTraining">
												<i class="fas fa-trash-alt"></i></i> Reset
											</button>
											<div class="modal fade" id="hapusDataTraining" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header bg-warning">
															<h5>Hapus Data Training</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															Yakin Hapus Semua Data ?
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
															<a href="hasil_prediksi.php?act=delete_all" class="btn btn-primary"> Ya </a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$status = isset($_GET['status_hapus_all']) ? $_GET['status_hapus_all'] : '';
						$msg = '';
						switch ($status):
							case 'sukses-hapus-all':
								$msg = 'Semua data berhasil dihapus';
								break;
						endswitch;

						if ($msg) : ?>
							<div style="margin-left: 9px; margin-right: 9px;">
								<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="hasil_prediksi.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
							</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">

										<?php
										if ($jumlah == 0) {
											$msg = "Belum ada siswa yang melakukan prediksi";
											echo '<div class="alert alert-warning mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
										} else {
											echo "Jumlah data : " . $jumlah;
										}
										?>
									</div>
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
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php include_once("partial/footers.php"); ?>
		</div>
	</body>

	</html>