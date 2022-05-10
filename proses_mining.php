	<?php
	$awal = microtime(true);
	include 'koneksi.php';
	include 'fungsi.php';
	mysql_query("TRUNCATE pohon_keputusan");
	pembentukan_tree("", "");
	echo "<br><h1><center>---PROSES SELESAI---</center></h1>";
	echo "<center><a href='index.php?menu=tree' accesskey='5' title='pohon keputusan'>Lihat pohon keputusan yang terbentuk</a></center>";

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
			$sql_keputusan = mysql_query("SELECT DISTINCT(jurusan) FROM data_training_konversi WHERE $kondisi");
			$row_keputusan = mysql_fetch_array($sql_keputusan);
			$keputusan = $row_keputusan['0'];
			//insert atau lakukan pemangkasan cabang
			pangkas($N_parent, $kasus, $keputusan);
		} //jika data masih heterogen
		else if ($cek == 'heterogen') {
			//cek jumlah data
			$jumlah = jumlah_data($kondisi);
			if ($jumlah < 8) {
				echo "<br>LEAF ";
				$Nmipa = $kondisi . " AND jurusan='mipa'";
				$Nips = $kondisi . " AND jurusan='ips'";
				$jumlahMipa = jumlah_data("$Nmipa");
				$jumlahIps = jumlah_data("$Nips");
				if ($jumlahMipa <= $jumlahIps) {
					$keputusan = 'Ips';
				} else {
					$keputusan = 'Mipa';
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
				$jml_mipa = jumlah_data("$kondisi_jurusan jurusan='Mipa'");
				$jml_ips = jumlah_data("$kondisi_jurusan jurusan='Ips'");
				$jml_total = $jml_mipa + $jml_ips;
				echo "Jumlah data = " . $jml_total . "<br>";
				echo "Jumlah Mipa = " . $jml_mipa . "<br>";
				echo "Jumlah Ips = " . $jml_ips . "<br>";

				//hitung entropy semua
				$entropy_all = hitung_entropy($jml_mipa, $jml_ips);
				echo "Entropy = " . $entropy_all . "<br>";

				//cek berapa nilai setiap atribut
				$nilai_ppdb = array();
				$nilai_ppdb = cek_nilaiAtribut('ppdb', $kondisi);
				$jmlPpdb = count($nilai_ppdb);
				$nilai_bindo = array();
				$nilai_bindo = cek_nilaiAtribut('bhs_indonesia', $kondisi);
				$jmlBindo = count($nilai_bindo);
				$nilai_mat = array();
				$nilai_mat = cek_nilaiAtribut('matematika', $kondisi);
				$jmlMat = count($nilai_mat);
				$nilai_bing = array();
				$nilai_bing = cek_nilaiAtribut('bhs_inggris', $kondisi);
				$jmlBing = count($nilai_bing);
				$nilai_mipa = array();
				$nilai_mipa = cek_nilaiAtribut('ipa', $kondisi);
				$jmlMipa = count($nilai_mipa);
				$nilai_ips = array();
				$nilai_ips = cek_nilaiAtribut('ips', $kondisi);
				$jmlIps = count($nilai_ips);
				$nilai_skhu = array();
				$nilai_skhu = cek_nilaiAtribut('skhu', $kondisi);
				$jmlSkhu = count($nilai_skhu);
				$nilai_jurusan = array();
				$nilai_jurusan = cek_nilaiAtribut('jurusan', $kondisi);
				$jmlJurusan = count($nilai_jurusan);

				//hitung gain atribut
				mysql_query("TRUNCATE gain");
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



				//BAHASA INDONESIA
				if ($jmlBindo != 1) {
					$NA1Bindo = "bhs_indonesia='$nilai_bindo[0]'";
					$NA2Bindo = "";
					$NA3Bindo = "";
					$NA4Bindo = "";
					$NA5Bindo = "";
					if ($jmlBindo == 2) {
						$NA2Bindo = "bhs_indonesia='$nilai_bindo[1]'";
					} else if ($jmlBindo == 3) {
						$NA2Bindo = "bhs_indonesia='$nilai_bindo[1]'";
						$NA3Bindo = "bhs_indonesia='$nilai_bindo[2]'";
					} else if ($jmlBindo == 4) {
						$NA2Bindo = "bhs_indonesia='$nilai_bindo[1]'";
						$NA3Bindo = "bhs_indonesia='$nilai_bindo[2]'";
						$NA4Bindo = "bhs_indonesia='$nilai_bindo[3]'";
					} else if ($jmlBindo == 5) {
						$NA2Bindo = "bhs_indonesia='$nilai_bindo[1]'";
						$NA3Bindo = "bhs_indonesia='$nilai_bindo[2]'";
						$NA4Bindo = "bhs_indonesia='$nilai_bindo[3]'";
						$NA5Bindo = "bhs_indonesia='$nilai_bindo[4]'";
					}
					hitung_gain($kondisi, "bhs_indonesia", $entropy_all, $NA1Bindo, $NA2Bindo, $NA3Bindo, $NA4Bindo, $NA5Bindo, "", "");
				}
				//MATEMATIKA
				if ($jmlMat != 1) {
					$NA1Mat = "matematika='$nilai_mat[0]'";
					$NA2Mat = "";
					$NA3Mat = "";
					$NA4Mat = "";
					$NA5Mat = "";
					if (
						$jmlMat == 2
					) {
						$NA2Mat = "matematika='$nilai_mat[1]'";
					} else if ($jmlMat == 3) {
						$NA2Mat = "matematika='$nilai_mat[1]'";
						$NA3Mat = "matematika='$nilai_mat[2]'";
					} else if ($jmlMat == 4) {
						$NA2Mat = "matematika='$nilai_mat[1]'";
						$NA3Mat = "matematika='$nilai_mat[2]'";
						$NA4Mat = "matematika='$nilai_mat[3]'";
					} else if ($jmlMat == 5) {
						$NA2Mat = "matematika='$nilai_mat[1]'";
						$NA3Mat = "matematika='$nilai_mat[2]'";
						$NA4Mat = "matematika='$nilai_mat[3]'";
						$NA5Mat = "matematika='$nilai_mat[4]'";
					}
					hitung_gain($kondisi, "matematika", $entropy_all, $NA1Mat, $NA2Mat, $NA3Mat, $NA4Mat, $NA5Mat, "", "");
				}
				//BAHASA INGGRIS
				if ($jmlBing != 1) {
					$NA1Bing = "bhs_inggris='$nilai_bing[0]'";
					$NA2Bing = "";
					$NA3Bing = "";
					$NA4Bing = "";
					$NA5Bing = "";
					if ($jmlBing == 2) {
						$NA2Bing = "bhs_inggris='$nilai_bing[1]'";
					} else if ($jmlBing == 3) {
						$NA2Bing = "bhs_inggris='$nilai_bing[1]'";
						$NA3Bing = "bhs_inggris='$nilai_bing[2]'";
					} else if ($jmlBing == 4) {
						$NA2Bing = "bhs_inggris='$nilai_bing[1]'";
						$NA3Bing = "bhs_inggris='$nilai_bing[2]'";
						$NA4Bing = "bhs_inggris='$nilai_bing[3]'";
					} else if ($jmlBing == 5) {
						$NA2Bing = "bhs_inggris='$nilai_bing[1]'";
						$NA3Bing = "bhs_inggris='$nilai_bing[2]'";
						$NA4Bing = "bhs_inggris='$nilai_bing[3]'";
						$NA5Bing = "bhs_inggris='$nilai_bing[4]'";
					}
					hitung_gain($kondisi, "bhs_inggris", $entropy_all, $NA1Bing, $NA2Bing, $NA3Bing, $NA4Bing, $NA5Bing, "", "");
				}
				//MIPA
				if ($jmlMipa != 1) {
					$NA1Mipa = "ipa='$nilai_mipa[0]'";
					$NA2Mipa = "";
					$NA3Mipa = "";
					$NA4Mipa = "";
					$NA5Mipa = "";
					if (
						$jmlMipa == 2
					) {
						$NA2Mipa = "ipa='$nilai_mipa[1]'";
					} else if ($jmlMipa == 3) {
						$NA2Mipa = "ipa='$nilai_mipa[1]'";
						$NA3Mipa = "ipa='$nilai_mipa[2]'";
					} else if ($jmlMipa == 4) {
						$NA2Mipa = "ipa='$nilai_mipa[1]'";
						$NA3Mipa = "ipa='$nilai_mipa[2]'";
						$NA4Mipa = "ipa='$nilai_mipa[3]'";
					} else if ($jmlMipa == 5) {
						$NA2Mipa = "ipa='$nilai_mipa[1]'";
						$NA3Mipa = "ipa='$nilai_mipa[2]'";
						$NA4Mipa = "ipa='$nilai_mipa[3]'";
						$NA5Mipa = "ipa='$nilai_mipa[4]'";
					}
					hitung_gain($kondisi, "ipa", $entropy_all, $NA1Mipa, $NA2Mipa, $NA3Mipa, $NA4Mipa, $NA5Mipa, "", "");
				}
				//IPS
				if ($jmlIps != 1) {
					$NA1Ips = "ips='$nilai_ips[0]'";
					$NA2Ips = "";
					$NA3Ips = "";
					$NA4Ips = "";
					$NA5Ips = "";
					if (
						$jmlIps == 2
					) {
						$NA2Ips = "ips='$nilai_ips[1]'";
					} else if ($jmlIps == 3) {
						$NA2Ips = "ips='$nilai_ips[1]'";
						$NA3Ips = "ips='$nilai_ips[2]'";
					} else if ($jmlIps == 4) {
						$NA2Ips = "ips='$nilai_ips[1]'";
						$NA3Ips = "ips='$nilai_ips[2]'";
						$NA4Ips = "ips='$nilai_ips[3]'";
					} else if ($jmlIps == 5) {
						$NA2Ips = "ips='$nilai_ips[1]'";
						$NA3Ips = "ips='$nilai_ips[2]'";
						$NA4Ips = "ips='$nilai_ips[3]'";
						$NA5Ips = "ips='$nilai_ips[4]'";
					}
					hitung_gain($kondisi, "ips", $entropy_all, $NA1Ips, $NA2Ips, $NA3Ips, $NA4Ips, $NA5Ips, "", "");
				}
				//SKHU
				if ($jmlSkhu != 1) {
					$NA1Skhu = "skhu='$nilai_skhu[0]'";
					$NA2Skhu = "";
					$NA3Skhu = "";
					$NA4Skhu = "";
					$NA5Skhu = "";
					if (
						$jmlSkhu == 2
					) {
						$NA2Skhu = "skhu='$nilai_skhu[1]'";
					} else if ($jmlSkhu == 3) {
						$NA2Skhu = "skhu='$nilai_skhu[1]'";
						$NA3Skhu = "skhu='$nilai_skhu[2]'";
					} else if ($jmlSkhu == 4) {
						$NA2Skhu = "skhu='$nilai_skhu[1]'";
						$NA3Skhu = "skhu='$nilai_skhu[2]'";
						$NA4Skhu = "skhu='$nilai_skhu[3]'";
					} else if ($jmlSkhu == 5) {
						$NA2Skhu = "skhu='$nilai_skhu[1]'";
						$NA3Skhu = "skhu='$nilai_skhu[2]'";
						$NA4Skhu = "skhu='$nilai_skhu[3]'";
						$NA5Skhu = "skhu='$nilai_skhu[4]'";
					}
					hitung_gain($kondisi, "skhu", $entropy_all, $NA1Skhu, $NA2Skhu, $NA3Skhu, $NA4Skhu, $NA5Skhu, "", "");
				}
				//jurusan
				if ($jmlJurusan != 1) {
					$NA1Jurusan = "jurusan='$nilai_jurusan[0]'";
					$NA2Jurusan = "";
					$NA3Jurusan = "";
					if ($jmlJurusan == 2) {
						$NA2Jurusan = "jurusan='$nilai_jurusan[1]'";
					}
					hitung_gain($kondisi, "jurusan", $entropy_all, $NA1Jurusan, $NA2Jurusan, "", "", "", "", "");
				}
				// 
				//hitung gain atribut Numerik										
				hitung_gain($kondisi, "A", $entropy_all, "bhs_indonesia", "rata_un>6.5", "", "", "", "", "");
				hitung_gain($kondisi, "B", $entropy_all, "rata_un<=6.75", "rata_un>6.75", "", "", "", "", "");
				hitung_gain($kondisi, "C", $entropy_all, "rata_un<=7", "rata_un>7", "", "", "", "", "");
				hitung_gain($kondisi, "D", $entropy_all, "rata_un<=7.25", "rata_un>7.25", "", "", "", "", "");
				hitung_gain($kondisi, "E", $entropy_all, "rata_un<=7.5", "rata_un>7.5", "", "", "", "", "");

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
				//PPDB TERPILIH
				if ($atribut == "ppdb") {
					//jika nilai atribut 3
					if ($jmlPpdb == 7) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ppdb', $max_gain, $nilai_ppdb[0], $nilai_ppdb[1], $nilai_ppdb[2], $nilai_ppdb[3], $nilai_ppdb[4], $nilai_ppdb[5], $nilai_ppdb[6]);
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT(
							$kondisi,
							"($atribut='$cabang[0]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')",
							"($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]'  OR $atribut='$exp_cabang[2]'  OR $atribut='$exp_cabang[3]'  OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')",
						);
					}
					//jika nilai atribut 2
					else if ($jmlPpdb == 2) {
						proses_DT($kondisi, "($atribut='$nilai_ppdb[0]')", "($atribut='$nilai_ppdb[1]')");
					}
				}
				//BAHASA INDONESIA TERPILIH
				else if ($atribut == "bhs_indonesia") {
					//jika nilai atribut 5
					if ($jmlBindo == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_indonesia', $max_gain, $nilai_bindo[0], $nilai_bindo[1], $nilai_bindo[2], $nilai_bindo[3], $nilai_bindo[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlBindo == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_indonesia', $max_gain, $nilai_bindo[0], $nilai_bindo[1], $nilai_bindo[2], $nilai_bindo[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlBindo == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_indonesia', $max_gain, $nilai_bindo[0], $nilai_bindo[1], $nilai_bindo[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlBindo == 2) {
						proses_DT($kondisi, "($atribut='$nilai_bindo[0]')", "($atribut='$nilai_bindo[1]')");
					}
				}
				//MATEMATIKA TERPILIH
				else if ($atribut == "matematika") {
					//jika nilai atribut 5
					if ($jmlMat == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'matematika', $max_gain, $nilai_mat[0], $nilai_mat[1], $nilai_mat[2], $nilai_mat[3], $nilai_mat[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlMat == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'matematika', $max_gain, $nilai_mat[0], $nilai_mat[1], $nilai_mat[2], $nilai_mat[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlMat == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'matematika', $max_gain, $nilai_mat[0], $nilai_mat[1], $nilai_mat[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlMat == 2) {
						proses_DT($kondisi, "($atribut='$nilai_mat[0]')", "($atribut='$nilai_mat[1]')");
					}
				}
				//BAHASA INGGRIS TERPILIH
				else if ($atribut == "bhs_inggris") {
					//jika nilai atribut 5
					if ($jmlBing == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_inggris', $max_gain, $nilai_bing[0], $nilai_bing[1], $nilai_bing[2], $nilai_bing[3], $nilai_bing[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlBing == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_inggris', $max_gain, $nilai_bing[0], $nilai_bing[1], $nilai_bing[2], $nilai_bing[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlBing == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'bhs_inggris', $max_gain, $nilai_bing[0], $nilai_bing[1], $nilai_bing[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlBing == 2) {
						proses_DT($kondisi, "($atribut='$nilai_bing[0]')", "($atribut='$nilai_bing[1]')");
					}
				}
				//MIPA TERPILIH
				else if ($atribut == "ipa") {
					//jika nilai atribut 5
					if ($jmlMipa == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ipa', $max_gain, $nilai_mipa[0], $nilai_mipa[1], $nilai_mipa[2], $nilai_mipa[3], $nilai_mipa[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlMipa == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ipa', $max_gain, $nilai_mipa[0], $nilai_mipa[1], $nilai_mipa[2], $nilai_mipa[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlMipa == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ipa', $max_gain, $nilai_mipa[0], $nilai_mipa[1], $nilai_mipa[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlMipa == 2) {
						proses_DT($kondisi, "($atribut='$nilai_mipa[0]')", "($atribut='$nilai_mipa[1]')");
					}
				}
				//IPS TERPILIH
				else if ($atribut == "ips") {
					//jika nilai atribut 5
					if ($jmlIps == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ips', $max_gain, $nilai_ips[0], $nilai_ips[1], $nilai_ips[2], $nilai_ips[3], $nilai_ips[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlIps == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ips', $max_gain, $nilai_ips[0], $nilai_ips[1], $nilai_ips[2], $nilai_ips[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlIps == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'ips', $max_gain, $nilai_ips[0], $nilai_ips[1], $nilai_ips[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlIps == 2) {
						proses_DT($kondisi, "($atribut='$nilai_ips[0]')", "($atribut='$nilai_ips[1]')");
					}
				}
				//SKHU TERPILIH
				else if ($atribut == "skhu") {
					//jika nilai atribut 5
					if ($jmlSkhu == 5) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'skhu', $max_gain, $nilai_skhu[0], $nilai_skhu[1], $nilai_skhu[2], $nilai_skhu[3], $nilai_skhu[4], '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
					}
					//jika nilai atribut 4
					else if ($jmlSkhu == 4) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'skhu', $max_gain, $nilai_skhu[0], $nilai_skhu[1], $nilai_skhu[2], $nilai_skhu[3], '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}
					//jika nilai atribut 3
					else if ($jmlSkhu == 3) {
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi, 'skhu', $max_gain, $nilai_skhu[0], $nilai_skhu[1], $nilai_skhu[2], '', '', '', '');
						$exp_cabang = explode(" , ", $cabang[1]);
						proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if ($jmlSkhu == 2) {
						proses_DT($kondisi, "($atribut='$nilai_skhu[0]')", "($atribut='$nilai_skhu[1]')");
					}
				}
				// 
				//RATA bhs_indonesia TERPILIH
				else if ($atribut == "A") {
					proses_DT($kondisi, "(bhs_indonesia>=92)", "(bhs_indonesia<=100)");
				} else if ($atribut == "B") {
					proses_DT($kondisi, "(bhs_indonesia>=84)", "(bhs_indonesia<92)");
				} else if ($atribut == "C") {
					proses_DT($kondisi, "(bhs_indonesia>=76)", "(bhs_indonesia<84)");
				} else if ($atribut == "D") {
					proses_DT($kondisi, "(bhs_indonesia>=70)", "(bhs_indonesia<76)");
				} else if ($atribut == "E") {
					proses_DT($kondisi, "(bhs_indonesia>=65)", "(bhs_indonesia<70)");
				} else if ($atribut == "Tidak Lulus") {
					proses_DT($kondisi, "(bhs_indonesia>=0)", "(bhs_indonesia<65)");
				}
				//JURUSAN TERPILIH
				else if ($atribut == "jurusan") {
					proses_DT($kondisi, "($atribut='Mipa')", "($atribut='Ips')");
				}
			}
		}
	}
