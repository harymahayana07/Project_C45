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
		mysql_query("DELETE FROM mahasiswa WHERE nim = '$id'");
		header('location:index.php?menu=user');
	}
	//delete semua data
	else if ($action == 'delete_all') {
		mysql_query("TRUNCATE mahasiswa");
		mysql_query("DELETE FROM user WHERE type ='1'");
		header('location:index.php?menu=user');
	}
} else {

?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Data Siswa</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item active">Data Siswa</li>
						</ol>

						<!-- tombol tambah data -->
					</div><!-- /.col -->
					<tr>
						<div class=" col-sm-4 col-md-4 mt-4">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
								<i class="fas fa-plus-circle"> Tambah Data</i>
							</button>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
								<i class="fas fa-plus-circle"> Hapus Data</i>
							</button>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">

									<form method=POST action=''>
										<div class="modal-header bg-info">
											<h5 class="modal-title" id="tambahDataModal">Tambah Data Siswa</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">

											<!-- Input addon -->
											<!--  -->
											<div class="card card-info">
												<div class="card-body">


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
											mysql_query("INSERT INTO data_training 
			                      	(ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,minat,motivasi)
                            VALUES(
                              '$_POST[txtppdb]',
                              '$_POST[txtbhs_id]',
                              '$_POST[txtmtk]',
                              '$_POST[txtbhs_ing]',
                              '$_POST[txtipa]',
                              '$_POST[txtips]',
                              '$_POST[txtskhu]',
                              '$_POST[peminatan]',
                              '$_POST[motivasi]'
                            )");
										}
										?>
									</form>

								</div>
							</div>
						</div>


						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
	</div>
	<!-- /.content-header -->
	<!-- data table -->
	<?php
	if ($jumlah == 0) {
		echo "<center><h3>Data training masih kosong...</h3></center>";
	} else {
		echo "Jumlah data training: " . $jumlah;
	?>
		<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
			<tr align='center'>
				<th>No</th>
				<th>Instansi</th>
				<th>Status</th>
				<th>Jurusan</th>
				<th>Nilai Rata UN</th>
				<th>Status Kerja</th>
				<th>Motivasi</th>
				<th><b>Prestasi</b></th>
				<th>Action</th>
			</tr>
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
				<tr bgcolor=<?php echo $warna; ?> align='center'>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['instansi']; ?></td>
					<td><?php echo $row['status']; ?></td>
					<td><?php echo $row['jurusan']; ?></td>
					<td><?php echo $row['rata_un']; ?></td>
					<td><?php echo $row['kerja']; ?></td>
					<td><?php echo $row['motivasi']; ?></td>
					<td><b><?php echo $row['ipk']; ?></b></td>
					<td>
						<a href="index.php?menu=data&act=update&id=<?php echo $row['id']; ?>">Update | </a>
						<a href="data_training.php?act=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?')">Delete</a>
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

<!-- Button trigger modal -->

<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<?php
require 'footer.php';
?>