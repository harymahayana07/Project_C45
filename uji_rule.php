<?php $thisPage = "DATA UJI";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<?php
require 'partial/headers.php';
if (isset($_GET['act'])) {
	$action = $_GET['act'];
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE data_uji");
		header('location:uji_rule.php?status_hapus_all=sukses-hapus-all');
	}
} else {

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
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h3><i class="fas fa-user-cog"></i> UJI RULE</h3>
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
			<div class="container-fluid mt-2">
				<div class="row mb-2">
					<div class="content-header">
						<div class="container-fluid">
							<div class="row" style="float: right;">
								<div class="col-lg-12 col-md-4">
									<button type="submit" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusuji">
										<i class="fas fa-trash-alt"></i> Reset
									</button>&nbsp;
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
													<a href="<?= base_url('uji_rule.php?act=delete_all') ?>" class="btn btn-primary"> Ya </a>
												</div>
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-warning btn-responsive" data-bs-toggle="modal" data-bs-target="#importDataUji">
										<i class="fas fa-upload"></i> Import
									</button>
									<div class="modal fade" id="importDataUji" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-warning">
													<h5>Import Data Uji</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">

													<div class="form-group">
														<p><span style="color: red;">* </span>type file harus xls (Excel 97 - 2003).</p>
														<label for="exampleInputFile">Input File : </label>
														<div class="input-group">

															<form method="POST" enctype="multipart/form-data" action="upload.php?data=uji">
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
									&nbsp;
									<form method="POST" action='' class="d-inline">
										<button type="submit" name="submit_akurasi" class="btn btn-primary btn-responsive">
											<i class="fas fa-hourglass-end"></i>&emsp;Hitung Akurasi
										</button>
									</form>&emsp;
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wrapper">
					<section class="content">
						<?php if (!empty($sts)) : ?>
							<?php foreach ($sts as $st) : ?>
								<div style="margin-left: 9px; margin-right: 9px;">
									<?php
									echo '<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></a>&emsp;' . $st . '</div>';
									?>
								</div>
							<?php endforeach; ?>
						<?php
						endif;
						?>

						<?php
						$status_all = isset($_GET['status_import']) ? $_GET['status_import'] : '';
						$msg = '';
						switch ($status_all):
							case 'sukses-import':
								$msg = 'Data berhasil disimpan';
								break;
							case 'gagal-import':
								$msg = 'Data gagal disimpan periksa file excel anda';
								break;
						endswitch;

						if ($msg) : ?>
							<div style="margin-left: 9px; margin-right: 9px;">
								<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="uji_rule.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
							</div>
						<?php endif; ?>

						<?php
						$status = isset($_GET['status_hapus_all']) ? $_GET['status_hapus_all'] : '';
						$msg = '';
						switch ($status):
							case 'sukses-hapus-all':
								$msg = 'Semua Data berhasil dihapus';
								break;
						endswitch;

						if ($msg) : ?>
							<div style="margin-left: 9px; margin-right: 9px;">
								<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="uji_rule.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
							</div>
						<?php endif; ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<?php
											if ($jumlah == 0) {
												$msg = "Data uji Masih kosong";
												echo '<div class="alert alert-warning mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
											} else {
												echo "Jumlah data uji: " . $jumlah;
											}
											?>
										</div>
										<div class="card-body">
											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Jk</th>
														<th>PPDB</th>
														<th>Bahasa Indonesia</th>
														<th>Matematika</th>
														<th>Bahasa Inggris</th>
														<th>Ipa</th>
														<th>Ips</th>
														<th>Skhu</th>
														<th>Jurusan</th>
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
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<?php include_once("partial/footers.php"); ?>
		</div>
		</body>

		</html>