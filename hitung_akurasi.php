<div class="container-fluid mt-2">
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
								$query2 = mysql_query("SELECT * FROM data_uji order by(id)");
								$jumlah = mysql_num_rows($query2);
								if ($jumlah == 0) {
									$msg = "Data uji Masih kosong";
									echo '<div class="alert alert-warning mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
								} else {
									echo "Jumlah data uji: " . $jumlah;
								}
								?>
							</div>
							<div class="card-body">
								<?php
								error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
								$query = mysql_query("SELECT * FROM data_uji");
								$id_rule = array();
								$it = 0;
								while ($bar = mysql_fetch_array($query)) {
									//ambil data uji
									$n_jk = $bar['jk'];
									$n_ppdb = $bar['ppdb'];
									$n_bhs_indonesia = $bar['bhs_indonesia'];
									$n_matematika = $bar['matematika'];
									$n_bhs_inggris = $bar['bhs_inggris'];
									$n_ipa = $bar['ipa'];
									$n_ips = $bar['ips'];
									$n_skhu = $bar['skhu'];
									$n_jurusanAsli = $bar['jurusan_asli'];

									$sql = mysql_query("SELECT * FROM pohon_keputusan");
									$keputusan = "";
									while ($row = mysql_fetch_array($sql)) {
										//menggabungkan parent dan akar dengan kata AND
										if ($row[1] != '') {
											$rule = $row[1] . " AND " . $row[2];
										} else {
											$rule = $row[2];
										}
										//mengubah parameter
										$rule = str_replace("<=", " k ", $rule);
										$rule = str_replace("=", " s ", $rule);
										$rule = str_replace(">", " l ", $rule);
										//mengganti nilai
										$rule = str_replace("jk", "'$n_jk'", $rule);
										$rule = str_replace("ppdb", "'$n_ppdb'", $rule);
										$rule = str_replace("bhs_indonesia", "'$n_bhs_indonesia'", $rule);
										$rule = str_replace("matematika", "$n_matematika", $rule);
										$rule = str_replace("bhs_inggris", "'$n_bhs_inggris'", $rule);
										$rule = str_replace("ipa", "'$n_ipa'", $rule);
										$rule = str_replace("ips", "'$n_ips'", $rule);
										$rule = str_replace("skhu", "'$n_skhu'", $rule);
										//menghilangkan '
										$rule = str_replace("'", "", $rule);
										//explode and
										$explodeAND = explode(" AND ", $rule);
										$jmlAND = count($explodeAND);
										//menghilangkan ()
										$explodeAND = str_replace("(", "", $explodeAND);
										$explodeAND = str_replace(")", "", $explodeAND);
										//deklarasi bol
										$bolAND = array();
										$n = 0;
										while ($n < $jmlAND) {
											//explode or
											$explodeOR = explode(" OR ", $explodeAND[$n]);
											$jmlOR = count($explodeOR);
											//deklarasi bol
											$bol = array();
											$a = 0;
											while ($a < $jmlOR) {
												//pecah  dengan spasi
												$exrule2 = explode(" ", $explodeOR[$a]);
												$parameter = $exrule2[1];
												if ($parameter == 's') {
													//pecah  dengan s
													$explodeRule = explode(" s ", $explodeOR[$a]);
													//nilai true false						
													if ($explodeRule[0] == $explodeRule[1]) {
														$bol[$a] = "Benar";
													} else if ($explodeRule[0] != $explodeRule[1]) {
														$bol[$a] = "Salah";
													}
												} else if ($parameter == 'k') {
													//pecah  dengan k
													$explodeRule = explode(" k ", $explodeOR[$a]);
													//nilai true false
													if ($explodeRule[0] <= $explodeRule[1]) {
														$bol[$a] = "Benar";
													} else {
														$bol[$a] = "Salah";
													}
												} else if ($parameter == 'l') {
													//pecah dengan s
													$explodeRule = explode(" l ", $explodeOR[$a]);
													//nilai true false
													if ($explodeRule[0] > $explodeRule[1]) {
														$bol[$a] = "Benar";
													} else {
														$bol[$a] = "Salah";
													}
												}
												$a++;
											}
											//isi false
											$bolAND[$n] = "Salah";
											$b = 0;
											while ($b < $jmlOR) {
												//jika $bol[$b] benar bolAND benar
												if ($bol[$b] == "Benar") {
													$bolAND[$n] = "Benar";
												}
												$b++;
											}
											$n++;
										}
										//isi boolrule
										$boolRule = "Benar";
										$a = 0;
										while ($a < $jmlAND) {
											//jika ada yang salah boolrule diganti salah
											if ($bolAND[$a] == "Salah") {
												$boolRule = "Salah";
											}
											$a++;
										}
										if ($boolRule == "Benar") {
											$keputusan = $row['keputusan'];
											$id_rule[$it] = $row['id'];
										}
										if ($keputusan == '') {
											$que = mysql_query("SELECT parent FROM pohon_keputusan");
											$jml = array();
											$exParent = array();
											$i = 0;
											while ($row_baris = mysql_fetch_array($que)) {
												$exParent = explode(" AND ", $row_baris['parent']);
												$jml[$i] = count($exParent);
												$i++;
											}
											$maxParent = max($jml);
											$sql_query = mysql_query("SELECT * FROM pohon_keputusan");
											while ($row_bar = mysql_fetch_array($sql_query)) {
												$explP = explode(" AND ", $row_bar['parent']);
												$jmlT = count($explP);
												if ($jmlT == $maxParent) {
													$keputusan = $row_bar['keputusan'];
													$id_rule[$it] = $row_bar['id'];
												}
											}
										}
									}
									$it++;
									mysql_query("UPDATE data_uji SET jurusan_prediksi='$keputusan' WHERE id=$bar[0]");
								}
								//menampilkan data uji dengan hasil prediksi
								$sql = mysql_query("SELECT * FROM data_uji");
								?>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Jenis Kelamin</th>
											<th>PPDB</th>
											<th>Bahasa Indonesia</th>
											<th>Matematika</th>
											<th>Bahasa Inggris</th>
											<th>Ipa</th>
											<th>Ips</th>
											<th>Skhu</th>
											<th><b>Jurusan Asli</b></th>
											<th><b>Jurusan Prediksi</b></th>
											<th><b>ID Rule Terpilih</b></th>
											<th><b>Ketepatan</b></th>
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

											if ($row['jurusan_asli'] == $row['jurusan_prediksi']) {
												$ketepatan = "Benar";
											} else {
												$ketepatan = "Salah";
											}
										?>
											<tr bgcolor=<?php echo $warna; ?> class="text-center">
												<td><?php echo $no; ?></td>
												<td><?php echo $row['jk']; ?></td>
												<td><?php echo $row['ppdb']; ?></td>
												<td><?php echo $row['bhs_indonesia']; ?></td>
												<td><?php echo $row['matematika']; ?></td>
												<td><?php echo $row['bhs_inggris']; ?></td>
												<td><?php echo $row['ipa']; ?></td>
												<td><?php echo $row['ips']; ?></td>
												<td><?php echo $row['skhu']; ?></td>
												<td><b><?php echo $row['jurusan_asli']; ?></b></td>
												<td><b><?php echo $row['jurusan_prediksi']; ?></b></td>
												<td><?php echo $id_rule[$no - 1]; ?></td>
												<td><?php if ($ketepatan == 'Salah') {
														echo "<b>" . $ketepatan . "</b>";
													} else {
														echo $ketepatan;
													} ?></b></td>
											</tr>
										<?php
											$no++;
										}
										?>
									</tbody>
								</table>

							</div>
							<div class="card-footer">
								<?php
								//perhitungan akurasi
								$que = mysql_query("SELECT * FROM data_uji");
								$jumlah = mysql_num_rows($que);
								$TP = 0;
								$FN = 0;
								$TN = 0;
								$FP = 0;
								$kosong = 0;
								while ($row = mysql_fetch_array($que)) {
									$asli = $row['jurusan_asli'];
									$prediksi = $row['jurusan_prediksi'];
									if ($asli == 'MIPA' & $prediksi == 'MIPA') {
										$TP++;
									} else if ($asli == 'MIPA' & $prediksi == 'IPS') {
										$FN++;
									} else if ($asli == 'IPS' & $prediksi == 'IPS') {
										$TN++;
									} else if ($asli == 'IPS' & $prediksi == 'MIPA') {
										$FP++;
									} else if ($prediksi == '') {
										$kosong++;
									}
								}
								$tepat = ($TP + $TN);
								$tidak_tepat = ($FP + $FN + $kosong);
								$akurasi = ($tepat / $jumlah) * 100;
								$laju_error = ($tidak_tepat / $jumlah) * 100;
								$sensitivitas = ($TP / ($TP + $FN)) * 100;
								$spesifisitas = ($TN / ($FP + $TN)) * 100;

								$akurasi = round($akurasi, 2);
								$laju_error = round($laju_error, 2);
								$sensitivitas = round($sensitivitas, 2);
								$spesifisitas = round($spesifisitas, 2);
								
								echo '<div class="alert alert-info">Jumlah data yang diprediksi : ' . $jumlah . '</div>';
								echo '<div class="alert alert-info">Jumlah data yang diprediksi tepat : ' . $tepat . '</div>';
								echo '<div class="alert alert-info">Jumlah data yang diprediksi tidak tepat : ' . $tidak_tepat . '</div>';
								if ($kosong != 0) :
									echo '<div class="alert alert-warning">Jumlah data yang prediksinya kosong : ' . $kosong . '</div>';
								endif;
								echo '<div class="alert alert-info">Akurasi : ' . $akurasi . '%</div>';
								echo '<div class="alert alert-info">Tidak Akurat : ' . $laju_error . '%</div>';
								echo '<div class="alert alert-info">TP : ' . $TP . '&emsp;|&emsp; TN : ' . $TN . '&emsp;|&emsp; FP : ' . $FP . '&emsp;|&emsp;FN : ' . $FN . '</div>';
								echo '<div class="alert alert-info">Sensitivitas : ' . $sensitivitas . '%</div>';
								echo '<div class="alert alert-info">Spesifisitas : ' . $spesifisitas . '%</div>';
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