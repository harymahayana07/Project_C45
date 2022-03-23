<?php
require 'sidebar.php';
require 'navbar.php';
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
	$query = mysql_query("select * from data_siswa ORDER BY(nisn)");
	$jumlah = mysql_num_rows($query);
?>
	<style>
		.btn {
			margin-bottom: 8px;
		}
	</style>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="background-color: #89cff0; border-radius: 5px;">
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

		<div class="container-fluid mt-2">
			<!--  -->
			<div class="row mb-2" style="float: left;">

				<div class="col-xl-4 col-6">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
						<i class="fas fa-plus-circle"> Tambah Data</i>
					</button>
				</div>

				<div class="col-lg-4 col-6">
					<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#hapusData">
						<i class="fas fa-trash-alt"> Hapus Data</i>
					</button>
				</div>

				<div class="col-md-4 col-6">
					<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importData">
						<i class="fas fa-plus-circle"> Import Data</i>
					</button>
				</div>

			</div>

		</div>

	</div>

	<!-- Modal tambah data -->
	<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header bg-info">
					<h5 class="modal-title" id="tambahDataModal">Tambah Data Siswa</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- Input addon -->
					<!--  -->
					<div class="card card-info">
						<div class="card-body">
							<form method="post" action="">
								<!-- ppdb -->
								<!-- Nisn -->
								<div class="form-group">
									<label for="nisn">NISN :</label>
									<input type="text" name="txtnisn" id="nisn" style="width: 150px;" class="form-control" placeholder=" Masukan Nisn ..." required>
								</div>

								<!--  -->
								<!-- Nama -->
								<div class="form-group">
									<label for="nama">Nama :</label>
									<input type="text" name="txtusername" id="nama" style="width: 250px;" class="form-control" placeholder="Masukan Nama Lengkap ..." required>
								</div>

								<!--jenis kelamin  -->
								<div class="form-group">
									<label for="jkk">Jenis Kelamin :</label>
									<br>
									<input id="jkk" type='radio' name='jk' value='Laki-laki' required="required"> Laki-Laki &nbsp;&nbsp;&nbsp;
									<input id="jkk" type='radio' name='jk' value='Perempuan' required="required"> Perempuan

								</div>
								<!-- Asal Sekolah -->
								<div class="form-group">
									<label for="as">Asal Sekolah :</label>
									<input type="text" name="asal_sekolah" id="as" style="width: 250px;" class="form-control" placeholder="Masukan Sekolah Asal ..." required>
								</div>
								
								<!--  -->
								<!--  -->
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
					<input type="button" name="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
				<?php
				if (isset($_POST['submit'])) {
					$nisn = $_POST['txtnisn'];
					$nama = $_POST['txtusername'];
					$jk = $_POST['jk'];
					$asalsekolah = $_POST['asal_sekolah'];

					mysql_query("INSERT INTO data_siswa				
				VALUES(
					'$nisn',
					'$nama',
					'$jk',
					'$asal_sekolah'
				)");
					mysql_query("INSERT INTO user 				
				VALUES(
					'$nisn',
					'$nama',
					'$nisn',
					'siswa'										
				)");
				}
				?>
			</div>
		</div>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
					<button type="button" class="btn btn-primary"> Ya </button>
				</div>
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
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="exampleInputFile">
								<label class="custom-file-label" for="exampleInputFile">Choose file</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
					<button type="button" class="btn btn-primary"> Upload </button>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<!-- /.content-header -->
	<div class="content-wrapper">
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
					<th>Action</th>
				</tr>
				<?php
				$warna1 = '#ffffff';
				$warna2 = '#f5f5f5';
				$warna  = $warna1;
				$no = 1;
				while ($row = mysql_fetch_array($query)) {
					$nim = $row['nisn'];
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
						<td><?php echo $row[4]; ?></td>
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
	<!-- end table -->

	</div>
	<!-- data table -->




	<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
	<?php
	require 'footer.php';
	?>