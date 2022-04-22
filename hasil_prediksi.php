<?php
include "koneksi.php";
if (isset($_GET['act'])) {
	$action = $_GET['act'];
	//delete semua data
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE hasil_prediksi");
		header('location:index.php?menu=hasil');
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
		echo "Jumlah data : " . $jumlah;
?>
		<p>
			Opsi:
			<a href="index.php?menu=hasil&act=delete_all" onClick="return confirm('Anda yakin akan hapus semua data?')">Hapus Semua Data</a> |
			<a href="export/CLP.php?format=3">Download Laporan</a>
		</p>
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
											echo "<center><h3>Data Prediksi masih kosong...</h3></center>";
										} else {
											echo "Jumlah data : " . $jumlah;
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
													<td><?php echo $row[5]; ?></td>
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
		<!--  -->