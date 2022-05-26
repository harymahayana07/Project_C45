	<?php
	$awal = microtime(true);
	include "fungsi.php";
	mysql_query("TRUNCATE pohon_keputusan");
	pembentukan_tree("", "");
	echo "<br><h1><center>---PROSES SELESAI---</center></h1>";
	echo "<center><a href='pohon_tree.php' accesskey='5' title='pohon keputusan'>Lihat pohon keputusan yang terbentuk</a></center>";

	$akhir = microtime(true);
	$lama = $akhir - $awal;
	//echo "<br>Lama eksekusi script adalah: ".$lama." detik";


	//fungsi utama
	function proses_DT($parent, $kasus_cabang1, $kasus_cabang2)
	{
		echo "cabang 1<br>";
		pembentukan_tree($parent, $kasus_cabang1);
		echo "cabang 2<br>";
		pembentukan_tree($parent, $kasus_cabang2);
	}

	function pangkas($PARENT, $KASUS, $LEAF)
	{
		//PEMANGKASAN CABANG
		$sql_pangkas = mysql_query("SELECT * FROM pohon_keputusan WHERE parent=\"$PARENT\" AND keputusan=\"$LEAF\"");
		$row_pangkas = mysql_fetch_array($sql_pangkas);
		$jml_pangkas = mysql_num_rows($sql_pangkas);
		//jika keputusan dan parent belum ada maka insert
		if ($jml_pangkas == 0) {
			mysql_query("INSERT INTO pohon_keputusan (parent,akar,keputusan)VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")");
		}
		//jika keputusan dan parent sudah ada maka delete
		else {
			mysql_query("DELETE FROM pohon_keputusan WHERE id='$row_pangkas[0]'");

			$exPangkas = explode(" AND ", $PARENT);
			$jmlEXpangkas = count($exPangkas);
			$temp = array();
			for ($a = 0; $a < ($jmlEXpangkas - 1); $a++) {
				$temp[$a] = $exPangkas[$a];
			}
			$imPangkas = implode(" AND ", $temp);
			$akarPangkas = $exPangkas[$jmlEXpangkas - 1];

			$que_pangkas = mysql_query("SELECT * FROM pohon_keputusan WHERE parent=\"$imPangkas\" AND keputusan=\"$LEAF\"");
			$baris_pangkas = mysql_fetch_array($que_pangkas);
			$jumlah_pangkas = mysql_num_rows($que_pangkas);

			if ($jumlah_pangkas == 0) {
				mysql_query("INSERT INTO pohon_keputusan (parent,akar,keputusan)VALUES (\"$imPangkas\" , \"$akarPangkas\" , \"$LEAF\")");
				//mysql_query("UPDATE pohon_keputusan SET parent=\"$imPangkas\" , akar=\"$akarPangkas\" , keputusan=\"$LEAF\" WHERE id=\"$row_pangkas[0]\"");
			} else {
				pangkas($imPangkas, $akarPangkas, $LEAF);
			}
		}
		echo "Keputusan = " . $LEAF . "<br>================================<br>";
	}

	//fungsi proses dalam suatu kasus data
	function pembentukan_tree($N_parent, $kasus)
	{
		//mengisi kondisi
		if ($N_parent != '') {
			$kondisi = $N_parent . " AND " . $kasus;
		} else {
			$kondisi = $kasus;
		}
		echo $kondisi . "<br>";
		//cek data heterogen / homogen???
		$cek = cek_heterohomogen('jurusan', $kondisi);
		if ($cek == 'homogen') {
			echo "<br>LEAF ";
			$sql_keputusan = mysql_query("SELECT DISTINCT(jurusan) FROM data_training WHERE $kondisi");
			$row_keputusan = mysql_fetch_array($sql_keputusan);
			$keputusan = $row_keputusan['0'];
			//insert atau lakukan pemangkasan cabang
			pangkas($N_parent, $kasus, $keputusan);
		} //jika data masih heterogen
		else if ($cek == 'heterogen') {
			//cek jumlah data
			$jumlah = jumlah_data($kondisi);
			if ($jumlah < 10) {
				echo "<br>LEAF ";
				$Nmipa = $kondisi . " AND jurusan='MIPA'";
				$Nips = $kondisi . " AND jurusan='IPS'";
				$jumlahMipa = jumlah_data("$Nmipa");
				$jumlahIps = jumlah_data("$Nips");
				if ($jumlahMipa <= $jumlahIps) {
					$keputusan = 'IPS';
				} else {
					$keputusan = 'MIPA';
				}
				//insert atau lakukan pemangkasan cabang
				pangkas($N_parent, $kasus, $keputusan);
			}
			//lakukan perhitungan
			else {
				//jika kondisi tidak kosong kondisi_ipk=tambah and
				$kondisi_jurusan = '';
				if ($kondisi != '') {
					$kondisi_jurusan = $kondisi . " AND ";
				}
				$jml_mipa = jumlah_data("$kondisi_jurusan jurusan='MIPA'");
				$jml_ips = jumlah_data("$kondisi_jurusan jurusan='IPS'");
				$jml_total = $jml_mipa + $jml_ips;
				echo "Jumlah data = " . $jml_total . "<br>";
				echo "Jumlah Mipa = " . $jml_mipa . "<br>";
				echo "Jumlah Ips = " . $jml_ips . "<br>";

				//hitung entropy semua
				$entropy_all = hitung_entropy($jml_mipa, $jml_ips);
				echo "Entropy = " . $entropy_all . "<br>";

				//cek berapa nilai setiap atribut

				// atribut nilai jenis kelamin
				// $nilai_jk = array();
				// $nilai_jk = cek_nilaiAtribut('jk', $kondisi);
				// $jmljk = count($nilai_jk);
				// // atribut nilai ppdb
				// $nilai_ppdb = array();
				// $nilai_ppdb = cek_nilaiAtribut('ppdb', $kondisi);
				// $jmlPpdb = count($nilai_ppdb);
				// atribut nilai jurusan
				// $nilai_jurusan = array();
				// $nilai_jurusan = cek_nilaiAtribut('jurusan', $kondisi);
				// $jmlJurusan = count($nilai_jurusan);

				//hapus table gain dan hitung gain atribut
				mysql_query("TRUNCATE gain");

				//jenis kelamin ini dia 
				// if ($jmljk != 1) {
				// 	$NA1Jk = "jk='$nilai_jk[0]'";
				// 	$NA2Jk = "jk='$nilai_jk[1]'";
				// 	hitung_gain($kondisi, "jk", $entropy_all, $NA1Jk, $NA2Jk, "", "", "", "", "");
				// }
				//ppdb
				// if ($jmlPpdb != 1) {
				// 	$NA1Ppdb = "ppdb='$nilai_ppdb[0]'";
				// 	$NA2Ppdb = "";
				// 	$NA3Ppdb = "";
				// 	$NA4Ppdb = "";
				// 	$NA5Ppdb = "";
				// 	$NA6Ppdb = "";
				// 	$NA7Ppdb = "";
				// 	if ($jmlPpdb == 2) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 	} else if ($jmlPpdb == 3) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 		$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
				// 	} else if ($jmlPpdb == 4) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 		$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
				// 		$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
				// 	} else if ($jmlPpdb == 5) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 		$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
				// 		$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
				// 		$NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
				// 	} else if ($jmlPpdb == 6) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 		$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
				// 		$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
				// 		$NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
				// 		$NA6Ppdb = "ppdb='$nilai_ppdb[5]'";
				// 	} else if ($jmlPpdb == 7) {
				// 		$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
				// 		$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
				// 		$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
				// 		$NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
				// 		$NA6Ppdb = "ppdb='$nilai_ppdb[5]'";
				// 		$NA7Ppdb = "ppdb='$nilai_ppdb[6]'";
				// 	}

				// 	hitung_gain($kondisi, "ppdb", $entropy_all, $NA1Ppdb, $NA2Ppdb, $NA3Ppdb, $NA4Ppdb, $NA5Ppdb, $NA6Ppdb, $NA7Ppdb);
				// }

				//hitung gain atribut Numerik	
				//jenis kelamin
				hitung_gain($kondisi, "Jenis Kelamin Laki-laki", $entropy_all, "jk=1", "jk>1", "", "", "", "", "");
				hitung_gain($kondisi, "Jenis Kelamin Perempuan", $entropy_all, "jk=2", "jk>2", "", "", "", "", "", "");
				//ppdb
				hitung_gain($kondisi, "PPDB Perpindahan Orang tua", $entropy_all, "ppdb=1", "ppdb>1", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Akademik", $entropy_all, "ppdb=2", "ppdb>2", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Non Akademik", $entropy_all, "ppdb=3", "ppdb>3", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Thafidz", $entropy_all, "ppdb=4", "ppdb>4", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Afirmasi", $entropy_all, "ppdb=5", "ppdb>5", "", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Zonasi", $entropy_all, "ppdb=6", "ppdb>6", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB PPLP", $entropy_all, "ppdb=7", "ppdb>7", "", "", "", "", "");


				// bhs_indonesia

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Bahasa Indonesia Nilai A", $entropy_all, "bhs_indonesia<=92", "bhs_indonesia>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Bahasa Indonesia Nilai B", $entropy_all, "bhs_indonesia<=84", "bhs_indonesia>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Bahasa Indonesia Nilai C", $entropy_all, "bhs_indonesia<=76", "bhs_indonesia>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Bahasa Indonesia Nilai D", $entropy_all, "bhs_indonesia<=70", "bhs_indonesia>70", "", "", "", "", "");

				// matematika

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Matematika Nilai A", $entropy_all, "matematika<=92", "matematika>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Matematika Nilai B", $entropy_all, "matematika<=84", "matematika>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Matematika Nilai C", $entropy_all, "matematika<=76", "matematika>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Matematika Nilai D", $entropy_all, "matematika<=70", "matematika>70", "", "", "", "", "");

				// bhs_inggris

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Bahasa Inggris Nilai A", $entropy_all, "bhs_inggris<=92", "bhs_inggris>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Bahasa Inggris Nilai B", $entropy_all, "bhs_inggris<=84", "bhs_inggris>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Bahasa Inggris Nilai C", $entropy_all, "bhs_inggris<=76", "bhs_inggris>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Bahasa Inggris Nilai D", $entropy_all, "bhs_inggris<=70", "bhs_inggris>70", "", "", "", "", "");

				// ipa

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Ipa Nilai A", $entropy_all, "ipa<=92", "ipa>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Ipa Nilai B", $entropy_all, "ipa<=84", "ipa>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Ipa Nilai C", $entropy_all, "ipa<=76", "ipa>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Ipa Nilai D", $entropy_all, "ipa<=70", "ipa>70", "", "", "", "", "");

				// ips

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Ips Nilai A", $entropy_all, "ips<=92", "ips>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Ips Nilai B", $entropy_all, "ips<=84", "ips>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Ips Nilai C", $entropy_all, "ips<=76", "ips>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Ips Nilai D", $entropy_all, "ips<=70", "ips>70", "", "", "", "", "");

				// skhu

				//hitung gain nilai A (92 - 100)
				hitung_gain($kondisi, "Skhu Nilai A", $entropy_all, "skhu<=92", "skhu>92", "", "", "", "", "");
				//hitung gain nilai B (84 - 92)
				hitung_gain($kondisi, "Skhu Nilai B", $entropy_all, "skhu<=84", "skhu>84", "", "", "", "", "");
				// hitung gain nilai C (76 - 84)
				hitung_gain($kondisi, "Skhu Nilai C", $entropy_all, "skhu<=76", "skhu>76", "", "", "", "", "");
				// hitung gain nilai D (70 - 76)
				hitung_gain($kondisi, "Skhu Nilai D", $entropy_all, "skhu<=70", "skhu>70", "", "", "", "", "");

				//jurusan
				// if ($jmlJurusan != 1) {
				// 	$NA1Jurusan = "jurusan='$nilai_jurusan[0]'";
				// 	$NA2Jurusan = "jurusan='$nilai_jurusan[1]'";
				// 	hitung_gain($kondisi, "jurusan", $entropy_all, $NA1Jurusan, $NA2Jurusan, "", "", "", "", "");
				// }

				//ambil nilai gain tertinggi
				$sql_max = mysql_query("SELECT MAX(gain) FROM gain");
				$row_max = mysql_fetch_array($sql_max);
				$max_gain = $row_max['0'];
				$sql = mysql_query("SELECT * FROM gain WHERE gain=$max_gain");
				$row = mysql_fetch_array($sql);
				$atribut = $row['1'];
				echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
				echo "<br>================================<br>";
				//percabangan jika nilai atribut lebih dari 2 hitung rasio terlebih dahulu


				// JENIS KELAMIN TERPILIH
				// if ($atribut == "jk") {
				// 	proses_DT($kondisi, "($atribut='1')", "($atribut='2')");
				// }

				//PPDB TERPILIH
				// if ($atribut == "ppdb") {
				// 	//jika nilai atribut 3
				// 	if ($jmlPpdb == 7) {
				// 		//hitung rasio
				// 		$cabang = array();
				// 		$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5], $nilai_ppdb[6]);
				// 		$exp_cabang = explode(" , ", $cabang[1]);
				// 		proses_DT(
				// 			$kondisi,
				// 			"($atribut='$cabang[0]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')",
				// 			"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')",
				// 		);
				// 	}
				// }
				// jenis kelamin
				if ($atribut == "Jenis Kelamin Laki-laki") {
					proses_DT($kondisi, "(jk=1)", "(jk>1)");
				} else if ($atribut == "Jenis Kelamin Perempuan") {
					proses_DT($kondisi, "(jk=2)", "(jk>2)");
				}
				// ppdb
				else if ($atribut == "PPDB Perpindahan Orang tua") {
					proses_DT($kondisi, "(ppdb=1)", "ppdb>1");
				} else if ($atribut == "PPDB Prestasi Akademik") {
					proses_DT($kondisi, "(ppdb=2)", "(ppdb>2)");
				} else if ($atribut == "PPDB Prestasi Non Akademik") {
					proses_DT($kondisi, "(ppdb=3)", "(ppdb>3)");
				} else if ($atribut == "PPDB Prestasi Thafidz") {
					proses_DT($kondisi, "(ppdb=4)", "(ppdb>4)");
				} else if ($atribut == "PPDB Afirmasi") {
					proses_DT($kondisi, "(ppdb=5)", "(ppdb>5)");
				} else if ($atribut == "PPDB Zonasi") {
					proses_DT($kondisi, "(ppdb=6)", "(ppdb>6)");
				} else if ($atribut == "PPDB PPLP") {
					proses_DT($kondisi, "(ppdb=7)", "(ppdb>7)");
				}
				//BAHASA INDONESIA TERPILIH
				else if ($atribut == "Bahasa Indonesia Nilai A") {
					proses_DT($kondisi, "(bhs_indonesia<=92)", "(bhs_indonesia>92)");
				} else if ($atribut == "Bahasa Indonesia Nilai B") {
					proses_DT($kondisi, "(bhs_indonesia<=84)", "(bhs_indonesia>84)");
				} else if ($atribut == "Bahasa Indonesia Nilai C") {
					proses_DT($kondisi, "(bhs_indonesia<=76)", "(bhs_indonesia>76)");
				} else if ($atribut == "Bahasa Indonesia Nilai D") {
					proses_DT($kondisi, "(bhs_indonesia<=70)", "(bhs_indonesia>70)");
				}
				// MATEMATIKA TERPILIH
				else if ($atribut == "Matematika Nilai A") {
					proses_DT($kondisi, "(matematika<=92)", "(matematika>92)");
				} else if ($atribut == "Matematika Nilai B") {
					proses_DT($kondisi, "(matematika<=84)", "(matematika>84)");
				} else if ($atribut == "Matematika Nilai C") {
					proses_DT($kondisi, "(matematika<=76)", "(matematika>76)");
				} else if ($atribut == "Matematika Nilai D") {
					proses_DT($kondisi, "(matematika<=70)", "(matematika>70)");
				}
				//BAHASA INGGRIS TERPILIH
				else if ($atribut == "Bahasa Inggris Nilai A") {
					proses_DT($kondisi, "(bhs_inggris<=92)", "(bhs_inggris>92)");
				} else if ($atribut == "Bahasa Inggris Nilai B") {
					proses_DT($kondisi, "(bhs_inggris<=84)", "(bhs_inggris>84)");
				} else if ($atribut == "Bahasa Inggris Nilai C") {
					proses_DT($kondisi, "(bhs_inggris<=76)", "(bhs_inggris>76)");
				} else if ($atribut == "Bahasa Inggris Nilai D") {
					proses_DT($kondisi, "(bhs_inggris<=70)", "(bhs_inggris>70)");
				}
				//IPA TERPILIH
				else if ($atribut == "Ipa Nilai A") {
					proses_DT($kondisi, "(ipa<=92)", "(ipa>92)");
				} else if ($atribut == "Ipa Nilai B") {
					proses_DT($kondisi, "(ipa<=84)", "(ipa>84)");
				} else if ($atribut == "Ipa Nilai C") {
					proses_DT($kondisi, "(ipa<=76)", "(ipa>76)");
				} else if ($atribut == "Ipa Nilai D") {
					proses_DT($kondisi, "(ipa<=70)", "(ipa>70)");
				}
				//IPS TERPILIH
				else if ($atribut == "Ips Nilai A") {
					proses_DT($kondisi, "(ips<=92)", "(ips>92)");
				} else if ($atribut == "Ips Nilai B") {
					proses_DT($kondisi, "(ips<=84)", "(ips>84)");
				} else if ($atribut == "Ips Nilai C") {
					proses_DT($kondisi, "(ips<=76)", "(ips>76)");
				} else if ($atribut == "Ips Nilai D") {
					proses_DT($kondisi, "(ips<=70)", "(ips>70)");
				}
				// SKHU TERPILIH
				else if ($atribut == "Skhu Nilai A") {
					proses_DT($kondisi, "(skhu<=92)", "(skhu>92)");
				} else if ($atribut == "Skhu Nilai B") {
					proses_DT($kondisi, "(skhu<=84)", "(skhu>84)");
				} else if ($atribut == "Skhu Nilai C") {
					proses_DT($kondisi, "(skhu<=76)", "(skhu>76)");
				} else if ($atribut == "Skhu Nilai D") {
					proses_DT($kondisi, "(skhu<=70)", "(skhu>70)");
				}

				//JURUSAN TERPILIH
				// else if ($atribut == "jurusan") {
				// 	proses_DT($kondisi, "($atribut='MIPA')", "($atribut='IPS')");
				// }
			}
		}
	}
