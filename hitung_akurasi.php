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
		//menggabungkan kata ortu dan orang lain
		// $rule=str_replace("Orang Tua","OrangTua",$rule);
		// $rule=str_replace("Orang Lain","OrangLain",$rule);
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
<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=950>
	<tr align='center'>
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
	<?php
	$warna1 = '#ffffff';
	$warna2 = '#f5f5f5';
	$warna  = $warna1;
	$no = 1;
	while ($row = mysql_fetch_array($sql)) {
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
		<tr bgcolor=<?php echo $warna; ?> align=center>
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
</table>

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
echo "<center><h4>";
echo "Jumlah data yang diprediksi: $jumlah<br>";
echo "Jumlah data yang diprediksi tepat: $tepat<br>";
echo "Jumlah data yang diprediksi tidak tepat: $tidak_tepat<br>";
if ($kosong != 0) {
	echo "Jumlah data yang prediksinya kosong: $kosong<br></h4>";
}
echo "<h2>AKURASI = $akurasi %<br>";
echo "TIDAK AKURAT = $laju_error %<br></h2>";
echo "<h4>TP: $TP | TN: $TN | FP: $FP | FN: $FN<br></h4>";
echo "<h2>SENSITIVITAS = $sensitivitas %<br>";
echo "SPESIFISITAS = $spesifisitas %<br>";
echo "</h2></center>";
?>