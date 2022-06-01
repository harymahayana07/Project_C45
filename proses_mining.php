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
				//hapus table gain dan hitung gain atribut
				mysql_query("TRUNCATE gain");

				//hitung gain atribut Numerik	

				//jenis kelamin
				hitung_gain($kondisi, "Jenis Kelamin Laki-laki", $entropy_all, "jk<=1", "jk>1", "", "", "", "", "");
				hitung_gain($kondisi, "Jenis Kelamin Perempuan", $entropy_all, "jk<=2", "jk>2", "", "", "", "", "", "");
				
				//ppdb
				hitung_gain($kondisi, "PPDB Perpindahan Orang tua", $entropy_all, "ppdb<=1", "ppdb>1", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Akademik", $entropy_all, "ppdb<=2", "ppdb>2", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Non Akademik", $entropy_all, "ppdb<=3", "ppdb>3", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Prestasi Thafidz", $entropy_all, "ppdb<=4", "ppdb>4", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Afirmasi", $entropy_all, "ppdb<=5", "ppdb>5", "", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB Zonasi", $entropy_all, "ppdb<=6", "ppdb>6", "", "", "", "", "");
				hitung_gain($kondisi, "PPDB PPLP", $entropy_all, "ppdb<=7", "ppdb>7", "", "", "", "", "");


				// bhs_indonesia
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Bahasa Indonesia 78", $entropy_all, "bhs_indonesia<=78.00", "bhs_indonesia>78.00", "", "", "", "", "");
				// hitung gain (81 - 84)
				hitung_gain($kondisi, "Bahasa Indonesia 81", $entropy_all, "bhs_indonesia<=81.00", "bhs_indonesia>81.00", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Bahasa Indonesia 84", $entropy_all, "bhs_indonesia<=84.00", "bhs_indonesia>84.00", "", "", "", "", "");
				//hitung gain (87 - 90)
				hitung_gain($kondisi, "Bahasa Indonesia 87", $entropy_all, "bhs_indonesia<=87.00", "bhs_indonesia>87.00", "", "", "", "", "");
				//hitung gain (90 - 93)
				hitung_gain($kondisi, "Bahasa Indonesia 90", $entropy_all, "bhs_indonesia<=90.00", "bhs_indonesia>90.00", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Bahasa Indonesia 93", $entropy_all, "bhs_indonesia<=93.00", "bhs_indonesia>93.00", "", "", "", "", "");

				// matematika
				// hitung gain  (78 - 84)
				hitung_gain($kondisi, "Matematika 78", $entropy_all, "matematika<=78.00", "matematika>78.00", "", "", "", "", "");
				// hitung gain  (81 - 84)
				hitung_gain($kondisi, "Matematika 81", $entropy_all, "matematika<=81.00", "matematika>81.00", "", "", "", "", "");
				// hitung gain  (84 - 87)
				hitung_gain($kondisi, "Matematika 84", $entropy_all, "matematika<=84.00", "matematika>84.00", "", "", "", "", "");
				//hitung gain  (87 - 90)
				hitung_gain($kondisi, "Matematika 87", $entropy_all, "matematika<=87.00", "matematika>87.00", "", "", "", "", "");
				//hitung gain  (90 - 93)
				hitung_gain($kondisi, "Matematika 90", $entropy_all, "matematika<=90.00", "matematika>90.00", "", "", "", "", "");
				//hitung gain  (93)
				hitung_gain($kondisi, "Matematika 93", $entropy_all, "matematika<=93.00", "matematika>93.00", "", "", "", "", "");

				// bhs_inggris
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Bahasa Inggris 78", $entropy_all, "bhs_inggris<=78.00", "bhs_inggris>78.00", "", "", "", "", "");
				// hitung gain (81 - 84)
				hitung_gain($kondisi, "Bahasa Inggris 81", $entropy_all, "bhs_inggris<=81.00", "bhs_inggris>81.00", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Bahasa Inggris 84", $entropy_all, "bhs_inggris<=84.00", "bhs_inggris>84.00", "", "", "", "", "");
				//hitung gain (87 - 90)
				hitung_gain($kondisi, "Bahasa Inggris 87", $entropy_all, "bhs_inggris<=87.00", "bhs_inggris>87.00", "", "", "", "", "");
				//hitung gain (90 - 93)
				hitung_gain($kondisi, "Bahasa Inggris 90", $entropy_all, "bhs_inggris<=90.00", "bhs_inggris>90.00", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Bahasa Inggris 93", $entropy_all, "bhs_inggris<=93.00", "bhs_inggris>93.00", "", "", "", "", "");

				// ipa
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Ipa 78", $entropy_all, "ipa<=78.00", "ipa>78.00", "", "", "", "", "");
				// hitung gain (81 - 84)
				hitung_gain($kondisi, "Ipa 81", $entropy_all, "ipa<=81.00", "ipa>81.00", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Ipa 84", $entropy_all, "ipa<=84.00", "ipa>84.00", "", "", "", "", "");
				//hitung gain (87 - 90)
				hitung_gain($kondisi, "Ipa 87", $entropy_all, "ipa<=87.00", "ipa>87.00", "", "", "", "", "");
				//hitung gain (90 - 93)
				hitung_gain($kondisi, "Ipa 90", $entropy_all, "ipa<=90.00", "ipa>90.00", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Ipa 93", $entropy_all, "ipa<=93.00", "ipa>93.00", "", "", "", "", "");

				// ips
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Ips 78", $entropy_all, "ips<=78.00", "ips>78.00", "", "", "", "", "");
				// hitung gain (81 - 84)
				hitung_gain($kondisi, "Ips 81", $entropy_all, "ips<=81.00", "ips>81.00", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Ips 84", $entropy_all, "ips<=84.00", "ips>84.00", "", "", "", "", "");
				//hitung gain (87 - 90)
				hitung_gain($kondisi, "Ips 87", $entropy_all, "ips<=87.00", "ips>87.00", "", "", "", "", "");
				//hitung gain (90 - 93)
				hitung_gain($kondisi, "Ips 90", $entropy_all, "ips<=90.00", "ips>90.00", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Ips 93", $entropy_all, "ips<=93.00", "ips>93.00", "", "", "", "", "");

				// skhu
				// hitung gain (78 - 84)
				hitung_gain($kondisi, "Skhu 78", $entropy_all, "skhu<=78.00", "skhu>78.00", "", "", "", "", "");
				// hitung gain (81 - 84)
				hitung_gain($kondisi, "Skhu 81", $entropy_all, "skhu<=81.00", "skhu>81.00", "", "", "", "", "");
				// hitung gain (84 - 87)
				hitung_gain($kondisi, "Skhu 84", $entropy_all, "skhu<=84.00", "skhu>84.00", "", "", "", "", "");
				//hitung gain (87 - 90)
				hitung_gain($kondisi, "Skhu 87", $entropy_all, "skhu<=87.00", "skhu>87.00", "", "", "", "", "");
				//hitung gain (90 - 93)
				hitung_gain($kondisi, "Skhu 90", $entropy_all, "skhu<=90.00", "skhu>90.00", "", "", "", "", "");
				//hitung gain (93)
				hitung_gain($kondisi, "Skhu 93", $entropy_all, "skhu<=93.00", "skhu>93.00", "", "", "", "", "");

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
				if ($atribut == "Jenis Kelamin Laki-laki") {
					proses_DT($kondisi, "(jk<=1)", "(jk>1)");
				} else if ($atribut == "Jenis Kelamin Perempuan") {
					proses_DT($kondisi, "(jk<=2)", "(jk>2)");
				}
				// PPDB TERPILIH
				else if ($atribut == "PPDB Perpindahan Orang tua") {
					proses_DT($kondisi, "(ppdb<=1)", "(ppdb>1)");
				} else if ($atribut == "PPDB Prestasi Akademik") {
					proses_DT($kondisi, "(ppdb<=2)", "(ppdb>2)");
				} else if ($atribut == "PPDB Prestasi Non Akademik") {
					proses_DT($kondisi, "(ppdb<=3)", "(ppdb>3)");
				} else if ($atribut == "PPDB Prestasi Thafidz") {
					proses_DT($kondisi, "(ppdb<=4)", "(ppdb>4)");
				} else if ($atribut == "PPDB Afirmasi") {
					proses_DT($kondisi, "(ppdb<=5)", "(ppdb>5)");
				} else if ($atribut == "PPDB Zonasi") {
					proses_DT($kondisi, "(ppdb<=6)", "(ppdb>6)");
				} else if ($atribut == "PPDB PPLP") {
					proses_DT($kondisi, "(ppdb<=7)", "(ppdb>7)");
				}
				//BAHASA INDONESIA TERPILIH
				else if ($atribut == "Bahasa Indonesia 78") {
					proses_DT($kondisi, "(bhs_indonesia<=78.00)", "(bhs_indonesia>78.00)");
				} else if ($atribut == "Bahasa Indonesia 81") {
					proses_DT($kondisi, "(bhs_indonesia<=81.00)", "(bhs_indonesia>81.00)");
				} else if ($atribut == "Bahasa Indonesia 84") {
					proses_DT($kondisi, "(bhs_indonesia<=84.00)", "(bhs_indonesia>84.00)");
				} else if ($atribut == "Bahasa Indonesia 87") {
					proses_DT($kondisi, "(bhs_indonesia<=87.00)", "(bhs_indonesia>87.00)");
				} else if ($atribut == "Bahasa Indonesia 90") {
					proses_DT($kondisi, "(bhs_indonesia<=90.00)", "(bhs_indonesia>90.00)");
				} else if ($atribut == "Bahasa Indonesia 93") {
					proses_DT($kondisi, "(bhs_indonesia<=93.00)", "(bhs_indonesia>93.00)");
				} 
				
				// MATEMATIKA TERPILIH
				else if ($atribut == "Matematika 93") {
					proses_DT($kondisi, "(matematika<=93.00)", "(matematika>93.00)");
				} else if ($atribut == "Matematika 90") {
					proses_DT($kondisi, "(matematika<=90.00)", "(matematika>90.00)");
				} else if ($atribut == "Matematika 87") {
					proses_DT($kondisi, "(matematika<=87.00)", "(matematika>87.00)");
				} else if ($atribut == "Matematika 84") {
					proses_DT($kondisi, "(matematika<=84.00)", "(matematika>84.00)");
				} else if ($atribut == "Matematika 81") {
					proses_DT($kondisi, "(matematika<=81.00)", "(matematika>81.00)");
				} else if ($atribut == "Matematika 78") {
					proses_DT($kondisi, "(matematika<=78.00)", "(matematika>78.00)");
				}

				//BAHASA INGGRIS TERPILIH
				else if ($atribut == "Bahasa Inggris 78") {
					proses_DT($kondisi, "(bhs_inggris<=78.00)", "(bhs_inggris>78.00)");
				} else if ($atribut == "Bahasa Inggris 81") {
					proses_DT($kondisi, "(bhs_inggris<=81.00)", "(bhs_inggris>81.00)");
				} else if ($atribut == "Bahasa Inggris 84") {
					proses_DT($kondisi, "(bhs_inggris<=84.00)", "(bhs_inggris>84.00)");
				} else if ($atribut == "Bahasa Inggris 87") {
					proses_DT($kondisi, "(bhs_inggris<=87.00)", "(bhs_inggris>87.00)");
				} else if ($atribut == "Bahasa Inggris 90") {
					proses_DT($kondisi, "(bhs_inggris<=90.00)", "(bhs_inggris>90.00)");
				} else if ($atribut == "Bahasa Inggris 93") {
					proses_DT($kondisi, "(bhs_inggris<=93.00)", "(bhs_inggris>93.00)");
				} 

				//IPA TERPILIH
				else if ($atribut == "Ipa 78") {
					proses_DT($kondisi, "(ipa<=78.00)", "(ipa>78.00)");
				} else if ($atribut == "Ipa 81") {
					proses_DT($kondisi, "(ipa<=81.00)", "(ipa>81.00)");
				} else if ($atribut == "Ipa 84") {
					proses_DT($kondisi, "(ipa<=84.00)", "(ipa>84.00)");
				} else if ($atribut == "Ipa 87") {
					proses_DT($kondisi, "(ipa<=87.00)", "(ipa>87.00)");
				} else if ($atribut == "Ipa 90") {
					proses_DT($kondisi, "(ipa<=90.00)", "(ipa>90.00)");
				} else if ($atribut == "Ipa 93") {
					proses_DT($kondisi, "(ipa<=93.00)", "(ipa>93.00)");
				} 

				//IPS TERPILIH
				else if ($atribut == "Ips 78") {
					proses_DT($kondisi, "(ips<=78.00)", "(ips>78.00)");
				} else if ($atribut == "Ips 81") {
					proses_DT($kondisi, "(ips<=81.00)", "(ips>81.00)");
				} else if ($atribut == "Ips 84") {
					proses_DT($kondisi, "(ips<=84.00)", "(ips>84.00)");
				} else if ($atribut == "Ips 87") {
					proses_DT($kondisi, "(ips<=87.00)", "(ips>87.00)");
				} else if ($atribut == "Ips 90") {
					proses_DT($kondisi, "(ips<=90.00)", "(ips>90.00)");
				} else if ($atribut == "Ips 93") {
					proses_DT($kondisi, "(ips<=93.00)", "(ips>93.00)");
				}

				// SKHU TERPILIH
				else if ($atribut == "Skhu 78") {
					proses_DT($kondisi, "(skhu<=78.00)", "(skhu>78.00)");
				} else if ($atribut == "Skhu 81") {
					proses_DT($kondisi, "(skhu<=81.00)", "(skhu>81.00)");
				} else if ($atribut == "Skhu 84") {
					proses_DT($kondisi, "(skhu<=84.00)", "(skhu>84.00)");
				} else if ($atribut == "Skhu 87") {
					proses_DT($kondisi, "(skhu<=87.00)", "(skhu>87.00)");
				} else if ($atribut == "Skhu 90") {
					proses_DT($kondisi, "(skhu<=90.00)", "(skhu>90.00)");
				}else if ($atribut == "Skhu 93") {
					proses_DT($kondisi, "(skhu<=93.00)", "(skhu>93.00)");
				}   
			}
		}
	}
