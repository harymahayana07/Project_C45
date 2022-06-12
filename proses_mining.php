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
			mysql_query("INSERT INTO pohon_keputusan (parent,akar,keputusan) VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")");
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

				$nilai_jk = array();
				$nilai_jk = cek_nilaiAtribut('jk', $kondisi);
				$jmlJk = count($nilai_jk);
				// atribut nilai ppdb
				$nilai_ppdb = array();
				$nilai_ppdb = cek_nilaiAtribut('ppdb', $kondisi);
				$jmlPpdb = count($nilai_ppdb);

				//hapus table gain dan hitung gain atribut
				mysql_query("TRUNCATE gain");

				if ($jmlJk != 1) {
                    $NA1Jk = "jk='$nilai_jk[0]'";
                    $NA2Jk = "jk='$nilai_jk[1]'";
                    hitung_gain($kondisi, "jk", $entropy_all, $NA1Jk, $NA2Jk, "", "", "", "", "");
                }

				//ppdb
				if ($jmlPpdb != 1) {
					$NA1Ppdb = "ppdb='$nilai_ppdb[0]'";
					$NA2Ppdb = "";
					$NA3Ppdb = "";
					$NA4Ppdb = "";
					$NA5Ppdb = "";
					$NA6Ppdb = "";
					$NA7Ppdb = "";
					if ($jmlPpdb == 2) {
						$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
					} else if ($jmlPpdb == 3) {
						$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
						$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
					} else if ($jmlPpdb == 4) {
						$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
						$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
						$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
					} else if ($jmlPpdb == 5) {
						$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
						$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
						$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
						$NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
					} else if ($jmlPpdb == 6) {
						$NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
						$NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
						$NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
						$NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
						$NA6Ppdb = "ppdb='$nilai_ppdb[5]'";
					} else if ($jmlPpdb == 7) {
					 $NA2Ppdb = "ppdb='$nilai_ppdb[1]'";
					 $NA3Ppdb = "ppdb='$nilai_ppdb[2]'";
					 $NA4Ppdb = "ppdb='$nilai_ppdb[3]'";
					 $NA5Ppdb = "ppdb='$nilai_ppdb[4]'";
					 $NA6Ppdb = "ppdb='$nilai_ppdb[5]'";
					 $NA7Ppdb = "ppdb='$nilai_ppdb[6]'";
					}
					hitung_gain($kondisi, "ppdb", $entropy_all, $NA1Ppdb, $NA2Ppdb, $NA3Ppdb, $NA4Ppdb, $NA5Ppdb, $NA6Ppdb, $NA7Ppdb);
				}

				//jenis kelamin
				// hitung_gain($kondisi, "Jenis Kelamin Laki-laki", $entropy_all, "jk<=1", "jk>1", "", "", "", "", "");
				// hitung_gain($kondisi, "Jenis Kelamin Perempuan", $entropy_all, "jk<=2", "jk>2", "", "", "", "", "", "");
				
				//ppdb
				// hitung_gain($kondisi, "PPDB Perpindahan Orang tua", $entropy_all, "ppdb<=1", "ppdb>1", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB Prestasi Akademik", $entropy_all, "ppdb<=2", "ppdb>2", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB Prestasi Non Akademik", $entropy_all, "ppdb<=3", "ppdb>3", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB Prestasi Thafidz", $entropy_all, "ppdb<=4", "ppdb>4", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB Afirmasi", $entropy_all, "ppdb<=5", "ppdb>5", "", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB Zonasi", $entropy_all, "ppdb<=6", "ppdb>6", "", "", "", "", "");
				// hitung_gain($kondisi, "PPDB PPLP", $entropy_all, "ppdb<=7", "ppdb>7", "", "", "", "", "");

				// bhs_indonesia
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Bahasa Indonesia C", $entropy_all, "bhs_indonesia<=78", "bhs_indonesia>78", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Bahasa Indonesia B", $entropy_all, "bhs_indonesia<=84", "bhs_indonesia>84", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Bahasa Indonesia A", $entropy_all, "bhs_indonesia<=92", "bhs_indonesia>92", "", "", "", "", "");

				// matematika
				// hitung gain  (78 - 84)
				hitung_gain($kondisi, "Matematika C", $entropy_all, "matematika<=78", "matematika>78", "", "", "", "", "");
				// hitung gain  (84 - 87)
				hitung_gain($kondisi, "Matematika B", $entropy_all, "matematika<=84", "matematika>84", "", "", "", "", "");
				//hitung gain  (93)
				hitung_gain($kondisi, "Matematika A", $entropy_all, "matematika<=92", "matematika>92", "", "", "", "", "");

				// bhs_inggris
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Bahasa Inggris C", $entropy_all, "bhs_inggris<=78", "bhs_inggris>78", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Bahasa Inggris B", $entropy_all, "bhs_inggris<=84", "bhs_inggris>84", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Bahasa Inggris A", $entropy_all, "bhs_inggris<=92", "bhs_inggris>92", "", "", "", "", "");

				// ipa
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Ipa C", $entropy_all, "ipa<=78", "ipa>78", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Ipa B", $entropy_all, "ipa<=84", "ipa>84", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Ipa A", $entropy_all, "ipa<=92", "ipa>92", "", "", "", "", "");

				// ips
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Ips C", $entropy_all, "ips<=78", "ips>78", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Ips B", $entropy_all, "ips<=84", "ips>84", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Ips A", $entropy_all, "ips<=92", "ips>92", "", "", "", "", "");

				// skhu
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Skhu C", $entropy_all, "skhu<=78", "skhu>78", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Skhu B", $entropy_all, "skhu<=84", "skhu>84", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Skhu A", $entropy_all, "skhu<=92", "skhu>92", "", "", "", "", "");

				//Ambil Nilai gain tertinggi
				$sql_max = mysql_query("SELECT MAX(gain) FROM gain");
				$row_max = mysql_fetch_array($sql_max);
				$max_gain = $row_max['0'];
				$sql = mysql_query("SELECT * FROM gain WHERE gain=$max_gain");
				$row = mysql_fetch_array($sql);
				$atribut = $row['1'];
				echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
				echo "<br>================================<br>";

				// JENIS KELAMIN TERPILIH
				if ($atribut == "jk") {
					proses_DT($kondisi, "($atribut='$nilai_jk[0]')", "($atribut='$nilai_jk[1]')");
				}
			
				// PPDB TERPILIH
				else if ($atribut == "ppdb") {
					//jika nilai atribut 5
					if ($jmlPpdb == 7) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5], $nilai_ppdb[6]);
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
					} else if ($jmlPpdb == 6) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5],'');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
					} else if ($jmlPpdb == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					} else if ($jmlPpdb == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					} else if ($jmlPpdb == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					} 
					else if ($jmlPpdb == 2) {
						proses_DT($kondisi, "($atribut='$nilai_ppdb[0]')", "($atribut='$nilai_ppdb[1]')");
					} 
				}
					// if ($jmlPpdb == 7) {
					// 	//hitung rasio
					// 	$cabang = array();
					// 	$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5], $nilai_ppdb[6]);
					// 	$exp_cabang = explode(" , ", $cabang[1]);
					// 	proses_DT(
					// 		$kondisi,
					// 		"($atribut='$cabang[0]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')"
					// 	);
					// } 
					// else if ($jmlPpdb == 6) {
					// 	//hitung rasio
					// 	$cabang = array();
					// 	$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5], $nilai_ppdb[6]);
					// 	$exp_cabang = explode(" , ", $cabang[1]);
					// 	proses_DT(
					// 		$kondisi,
					// 		"($atribut='$cabang[0]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]')",
					// 		"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')",
					// 	);
					// }
					//jika nilai atribut 2
					// else if ($jmlPpdb == 2) {
					// 	proses_DT($kondisi, "($atribut='$nilai_ppdb[0]')", "($atribut='$nilai_ppdb[1]')");
					// }
				

				// else if ($atribut == "PPDB Perpindahan Orang tua") {
				// 	proses_DT($kondisi, "(ppdb<=1)", "(ppdb>1)");
				// } else if ($atribut == "PPDB Prestasi Akademik") {
				// 	proses_DT($kondisi, "(ppdb<=2)", "(ppdb>2)");
				// } else if ($atribut == "PPDB Prestasi Non Akademik") {
				// 	proses_DT($kondisi, "(ppdb<=3)", "(ppdb>3)");
				// } else if ($atribut == "PPDB Prestasi Thafidz") {
				// 	proses_DT($kondisi, "(ppdb<=4)", "(ppdb>4)");
				// } else if ($atribut == "PPDB Afirmasi") {
				// 	proses_DT($kondisi, "(ppdb<=5)", "(ppdb>5)");
				// } else if ($atribut == "PPDB Zonasi") {
				// 	proses_DT($kondisi, "(ppdb<=6)", "(ppdb>6)");
				// } else if ($atribut == "PPDB PPLP") {
				// 	proses_DT($kondisi, "(ppdb<=7)", "(ppdb>7)");
				// }
				//BAHASA INDONESIA TERPILIH
				else if ($atribut == "Bahasa Indonesia C") {
					proses_DT($kondisi, "(bhs_indonesia<=78)", "(bhs_indonesia>78)");
				} else if ($atribut == "Bahasa Indonesia B") {
					proses_DT($kondisi, "(bhs_indonesia<=84)", "(bhs_indonesia>84)");
				} else if ($atribut == "Bahasa Indonesia A") {
					proses_DT($kondisi, "(bhs_indonesia<=92)", "(bhs_indonesia>92)");
				} 
				
				// MATEMATIKA TERPILIH
				else if ($atribut == "Matematika C") {
					proses_DT($kondisi, "(matematika<=78)", "(matematika>78)");
				} else if ($atribut == "Matematika B") {
					proses_DT($kondisi, "(matematika<=84)", "(matematika>84)");
				} else if ($atribut == "Matematika A") {
					proses_DT($kondisi, "(matematika<=92)", "(matematika>92)");
				}

				//BAHASA INGGRIS TERPILIH
				else if ($atribut == "Bahasa Inggris C") {
					proses_DT($kondisi, "(bhs_inggris<=78)", "(bhs_inggris>78)");
				} else if ($atribut == "Bahasa Inggris B") {
					proses_DT($kondisi, "(bhs_inggris<=84)", "(bhs_inggris>84)");
				} else if ($atribut == "Bahasa Inggris A") {
					proses_DT($kondisi, "(bhs_inggris<=92)", "(bhs_inggris>92)");
				} 

				//IPA TERPILIH
				else if ($atribut == "Ipa C") {
					proses_DT($kondisi, "(ipa<=78)", "(ipa>78)");
				} else if ($atribut == "Ipa B") {
					proses_DT($kondisi, "(ipa<=84)", "(ipa>84)");
				} else if ($atribut == "Ipa A") {
					proses_DT($kondisi, "(ipa<=92)", "(ipa>92)");
				} 

				//IPS TERPILIH
				else if ($atribut == "Ips C") {
					proses_DT($kondisi, "(ips<=78)", "(ips>78)");
				} else if ($atribut == "Ips B") {
					proses_DT($kondisi, "(ips<=84)", "(ips>84)");
				} else if ($atribut == "Ips A") {
					proses_DT($kondisi, "(ips<=92)", "(ips>92)");
				}

				// SKHU TERPILIH
				else if ($atribut == "Skhu C") {
					proses_DT($kondisi, "(skhu<=78)", "(skhu>78)");
				} else if ($atribut == "Skhu B") {
					proses_DT($kondisi, "(skhu<=84)", "(skhu>84)");
				}else if ($atribut == "Skhu A") {
					proses_DT($kondisi, "(skhu<=92)", "(skhu>92)");
				}   
			}
		}
	}
