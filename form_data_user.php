<!-- Modal tambah data -->
<div class="modal fade" id="tambahDataUser" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
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
							<form method="post" action="data-user.php">
								<!-- ppdb -->
								<!-- Nisn -->
								<div class="form-group">
									<label for="nisn">NISN :</label>
									<input type="number" name="nisn" id="nisn" style="width: 150px;" class="form-control" placeholder=" Masukan Nisn ..." required autocomplete="off" autofocus>
								</div>

								<!--  -->
								<!-- Nama -->
								<div class="form-group">
									<label for="nm">Nama :</label>
									<input type="text" name="nama" id="nm" style="width: 250px;" class="form-control" placeholder="Masukan Nama Lengkap ..." required autocomplete="off">
								</div>

								<!--jenis kelamin  -->
								<div class="form-group">
									<label for="jkk">Jenis Kelamin :</label>
									<br>
									<input id="jkk" type='radio' name='jenis_kelamin' value='L' required="required"> Laki-Laki &nbsp;&nbsp;&nbsp;
									<input id="jkk" type='radio' name='jenis_kelamin' value='P' required="required"> Perempuan

								</div>
								<!-- Asal Sekolah -->
								<div class="form-group">
									<label for="as">Asal Sekolah :</label>
									<input type="text" name="asal_sekolah" id="as" style="width: 250px;" class="form-control" placeholder="Masukan Sekolah Asal ..." required autocomplete="off">
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
					$nisn = $_POST['nisn'];
					$nama = $_POST['nama'];
					$jk = $_POST['jenis_kelamin'];
					$asalsekolah = $_POST['asal_sekolah'];

					mysql_query("INSERT INTO data_siswa				
				VALUES(
					'$nisn',
					'$nama',
					'$jk',
					'$asalsekolah'
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