	<?php $thisPage = "DATA SISWA";
	require_once 'conn/koneksi.php';
	if (!isset($_SESSION['usr'])) {

		header("location:auth/login-form.php");
	}
	?>
	<?php
	include_once("partial/headers.php");
	if (isset($_GET['act'])) {
		$action = $_GET['act'];
		$id = $_GET['id'];
		if ($action == 'delete') {
			mysql_query("DELETE FROM user WHERE user_id = '$id'");
			mysql_query("DELETE FROM data_siswa WHERE nisn = '$id'");
			header('location:data_user.php?status_hapus=sukses-hapus');
		} else if ($action == 'delete_all') {
			mysql_query("TRUNCATE data_siswa");
			mysql_query("DELETE FROM user WHERE type ='siswa'");
			header('location:data_user.php?status_hapus_all=sukses-hapus-all');
		}
	} else {
		require 'partial/sidebar.php';
		require 'partial/navbar.php';
		include 'form_data_user.php';
		$query = mysql_query("SELECT * FROM data_siswa ORDER BY (nisn)");
		$jumlah = mysql_num_rows($query);
	?>

		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="m-0"><i class="fas fa-graduation-cap"></i>&nbsp;DATA SISWA</h3>
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
			<div class="container-fluid mt-2">
				<div class="row mb-2">
					<!--  -->
					<div class="content-header">
						<div class="container-fluid">
							<div class="row" style="float: right;">
								<div class="col-lg-12 col-md-4">
									<button type="button" class="btn bg-info btn-responsive" data-bs-toggle="modal" data-bs-target="#tambahDataUser">
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
				</div>
				<div class="wrapper">
					<section class="content">
						<?php include_once("partial/flash_massage_user.php"); ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<?php
											if ($jumlah == 0) {
												$msg = "Data Siswa & User masih kosong";
												echo '<div class="alert alert-warning mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
											} else {
												echo "Jumlah Data Siswa :&nbsp;" . $jumlah;
											}
											?>
										</div>
										<div class="card-body">
											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr style="text-align: center;">
														<th>No</th>
														<th>Nisn</th>
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
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
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
							<a href="data_user.php?act=delete_all" type="button" class="btn btn-primary"> Ya </a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="importData" tabindex="-1" aria-labelledby="importDataModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5>Import Data Siswa</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<p><span style="color: red;">*</span>type file harus xls (Excel 97 - 2003).</p>
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
		<?php include_once("partial/footers.php"); ?>
		</div>
		</body>

		</html>