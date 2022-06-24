<div class="modal fade" id="tambahDataUser" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="tambahDataModal">Tambah Data Siswa</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>&emsp;Isi Data Dibawah Dengan benar dan lengkap :</p>
				<div class="card card-info">
					<div class="card-body">
						<form method="post" action="data_user.php">
							<div class="form-group">
								<label for="nisn1">NISN :</label>
								<input type="number" name="nisn" id="nisn1" style="width: 150px;" class="form-control" placeholder=" Masukan Nisn ..." required autocomplete="off" autofocus>
							</div>
							<div class="form-group">
								<label for="nm">Nama :</label>
								<input type="text" name="nama" id="nm" style="width: 250px;" class="form-control" placeholder="Masukan Nama Lengkap ..." required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="jkk">Jenis Kelamin :</label>
								<br>
								<input id="jkk" type='radio' name='jenis_kelamin' value='L' required="required"> Laki-Laki &nbsp;&nbsp;&nbsp;
								<input id="jkk" type='radio' name='jenis_kelamin' value='P' required="required"> Perempuan
							</div>
							<div class="form-group">
								<label for="as">Asal Sekolah :</label>
								<input type="text" name="asal_sekolah" id="as" style="width: 250px;" class="form-control" placeholder="Masukan Sekolah Asal ..." required autocomplete="off">
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
				<input type="submit" name="submitSiswa" class="btn btn-primary" value="Simpan">
			</div>
			</form>
			<?php
			if (isset($_POST['submitSiswa'])) :
				$nisn = $_POST['nisn'];
				$nama = $_POST['nama'];
				$jk = $_POST['jenis_kelamin'];
				$asalsekolah = $_POST['asal_sekolah'];

				if (!$nisn) {
					$errors[] = 'NIsn tidak boleh kosong';
				}
				if (!$nama) {
					$errors[] = 'Nama tidak boleh kosong';
				}
				if (!$jk) {
					$errors[] = 'Jenis Kelamin tidak boleh kosong';
				}
				if (!$asalsekolah) {
					$errors[] = 'Asal Sekolah tidak boleh kosong';
				}
				if (empty($errors)) :

					$simpan_siswa = mysql_query("INSERT INTO data_siswa				
				VALUES(
					'$nisn',
					'$nama',
					'$jk',
					'$asalsekolah'
				)");

					$simpan_user = mysql_query("INSERT INTO user 				
				VALUES(
					'$nisn',
					'$nama',
					'$nisn',
					'siswa'										
				)");

					if ($simpan_siswa && $simpan_user) {
						$sts[] = 'Data siswa & user berhasil disimpan';
					} else {
						$sts[] = 'Data siswa & user gagal disimpan';
					}
				endif;
			endif;
			?>
		</div>
	</div>
</div>