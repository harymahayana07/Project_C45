
		<?php
		//fungsi cek nilai atribut
		function cek_nilaiAtribut($field, $kondisi)
		{
			//sql disticnt		
			$hasil = array();
			if ($kondisi == '') {
				$sql = mysql_query("SELECT DISTINCT($field) FROM data_training");
			} else {
				$sql = mysql_query("SELECT DISTINCT($field) FROM data_training WHERE $kondisi");
			}
			$a = 0;
			while ($row = mysql_fetch_array($sql)) {
				$hasil[$a] = $row['0'];
				$a++;
			}
			return $hasil;
		}
		//fungsi cek heterogen data
		function cek_heterohomogen($field, $kondisi)
		{
			//sql disticnt
			if ($kondisi == '') {
				$sql = mysql_query("SELECT DISTINCT($field) FROM data_training");
			} else {
				$sql = mysql_query("SELECT DISTINCT($field) FROM data_training WHERE $kondisi");
			}
			//jika jumlah data 1 maka homogen
			if (mysql_num_rows($sql) == 1) {
				$nilai = "homogen";
			} else {
				$nilai = "heterogen";
			}
			return $nilai;
		}
		//fungsi menghitung jumlah data
		function jumlah_data($kondisi)
		{
			//sql
			if ($kondisi == '') {
				$sql = mysql_query("SELECT COUNT(*) FROM data_training $kondisi");
			} else {
				$sql = mysql_query("SELECT COUNT(*) FROM data_training WHERE $kondisi");
			}
			$row = mysql_fetch_array($sql);
			$jml = $row['0'];
			return $jml;
		}
		//fungsi menghitung gain
		function hitung_gain($kasus, $atribut, $ent_all, $kondisi1, $kondisi2, $kondisi3, $kondisi4, $kondisi5, $kondisi6, $kondisi7)
		{
			$data_kasus = '';
			if ($kasus != '') {
				$data_kasus = $kasus . " AND ";
			}
			if ($kondisi2 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;

				//hitung entropy masing-masing kondisi
				$jml_total = $jml1;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);

				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1));
			}
			//untuk atribut 2 nilai atribut = ppdb
			else if ($kondisi3 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;

				//hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
			}
			//untuk atribut 3 nilai atribut
			else if ($kondisi4 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;
				// 
				$j_mipa3 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi3");
				$j_ips3 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi3");
				$jml3 = $j_mipa3 + $j_ips3;
				//hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2 + $jml3;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$ent3 = hitung_entropy($j_mipa3, $j_ips3);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
					+ (($jml3 / $jml_total) * $ent3));
			}
			//untuk atribut 4 nilai atribut
			else if ($kondisi5 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;
				// 
				$j_mipa3 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi3");
				$j_ips3 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi3");
				$jml3 = $j_mipa3 + $j_ips3;
				// 
				$j_mipa4 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi4");
				$j_ips4 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi4");
				$jml4 = $j_mipa4 + $j_ips4;
				//hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2 + $jml3 + $jml4;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$ent3 = hitung_entropy($j_mipa3, $j_ips3);
				$ent4 = hitung_entropy($j_mipa4, $j_ips4);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
					+ (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4));
			}
			// untuk atribut 5 nilai atribut	
			else if ($kondisi6 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;
				// 
				$j_mipa3 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi3");
				$j_ips3 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi3");
				$jml3 = $j_mipa3 + $j_ips3;
				// 
				$j_mipa4 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi4");
				$j_ips4 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi4");
				$jml4 = $j_mipa4 + $j_ips4;
				// 
				$j_mipa5 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi5");
				$j_ips5 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi5");
				$jml5 = $j_mipa5 + $j_ips5;

				// hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$ent3 = hitung_entropy($j_mipa3, $j_ips3);
				$ent4 = hitung_entropy($j_mipa4, $j_ips4);
				$ent5 = hitung_entropy($j_mipa5, $j_ips5);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
					+ (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5));
			}
			// untuk atribut 6 nilai atribut	
			else if ($kondisi7 == '') {
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;
				// 
				$j_mipa3 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi3");
				$j_ips3 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi3");
				$jml3 = $j_mipa3 + $j_ips3;
				// 
				$j_mipa4 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi4");
				$j_ips4 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi4");
				$jml4 = $j_mipa4 + $j_ips4;
				// 
				$j_mipa5 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi5");
				$j_ips5 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi5");
				$jml5 = $j_mipa5 + $j_ips5;
				//
				$j_mipa6 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi6");
				$j_ips6 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi6");
				$jml6 = $j_mipa6 + $j_ips6;

				//hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$ent3 = hitung_entropy($j_mipa3, $j_ips3);
				$ent4 = hitung_entropy($j_mipa4, $j_ips4);
				$ent5 = hitung_entropy($j_mipa5, $j_ips5);
				$ent6 = hitung_entropy($j_mipa6, $j_ips6);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
					+ (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6));
			}
			// untuk atribut nilai 7 atribut
			else{
				$j_mipa1 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi1");
				$j_ips1 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi1");
				$jml1 = $j_mipa1 + $j_ips1;
				// 
				$j_mipa2 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi2");
				$j_ips2 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi2");
				$jml2 = $j_mipa2 + $j_ips2;
				// 
				$j_mipa3 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi3");
				$j_ips3 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi3");
				$jml3 = $j_mipa3 + $j_ips3;
				// 
				$j_mipa4 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi4");
				$j_ips4 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi4");
				$jml4 = $j_mipa4 + $j_ips4;
				// 
				$j_mipa5 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi5");
				$j_ips5 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi5");
				$jml5 = $j_mipa5 + $j_ips5;
				//
				$j_mipa6 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi6");
				$j_ips6 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi6");
				$jml6 = $j_mipa6 + $j_ips6;
				//
				$j_mipa7 = jumlah_data("$data_kasus jurusan='MIPA' AND $kondisi7");
				$j_ips7 = jumlah_data("$data_kasus jurusan='IPS' AND $kondisi7");
				$jml7 = $j_mipa7 + $j_ips7;

				//hitung entropy masing-masing kondisi
				$jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
				$ent1 = hitung_entropy($j_mipa1, $j_ips1);
				$ent2 = hitung_entropy($j_mipa2, $j_ips2);
				$ent3 = hitung_entropy($j_mipa3, $j_ips3);
				$ent4 = hitung_entropy($j_mipa4, $j_ips4);
				$ent5 = hitung_entropy($j_mipa5, $j_ips5);
				$ent6 = hitung_entropy($j_mipa6, $j_ips6);
				$ent7 = hitung_entropy($j_mipa7, $j_ips7);
				$gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
					+ (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7));
			}
			//desimal 3 angka dibelakang koma
			$gain = round($gain, 3);
			
			if($gain>0){
				echo "Gain " . $atribut . " = " . $gain . "<br>";
			}
			mysql_query("INSERT INTO gain VALUES ('','$atribut','$gain')");
		}
		//fungsi menghitung entropy
		function hitung_entropy($nilai1, $nilai2)
		{
			$total = $nilai1 + $nilai2;
			//jika salah satu nilai 0, maka entropy 0
			if ($nilai1 == 0 or $nilai2 == 0) {
				$entropy = 0;
			} else {
				$entropy = (- ($nilai1 / $total) * (log(($nilai1 / $total), 3))) + (- ($nilai2 / $total) * (log(($nilai2 / $total), 3)));
			}
			//desimal 3 angka dibelakang koma
			$entropy = round($entropy, 3);
			return $entropy;
		}
		// tanggal 10 april 2022
		//fungsi hitung rasio
		function hitung_rasio($kasus, $atribut, $gain, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6, $nilai7)
		{
			$data_kasus = '';
			if ($kasus != '') {
				$data_kasus = $kasus . " AND ";
			}
			//menentukan jumlah nilai
			$jmlNilai = 7;
			//jika nilai 7 kosong maka nilai atribut-nya 5
			if ($nilai7 == '') {
				$jmlNilai = 6;
			}
			//jika nilai 6 kosong maka nilai atribut-nya 5
			if ($nilai6 == '') {
				$jmlNilai = 5;
			}
			//jika nilai 5 kosong maka nilai atribut-nya 4
			if ($nilai5 == '') {
				$jmlNilai = 4;
			}
			//jika nilai 4 kosong maka nilai atribut-nya 3
			if ($nilai4 == '') {
				$jmlNilai = 3;
			}
			if ($nilai3 == '') {
				$jmlNilai = 2;
			}

			mysql_query("TRUNCATE rasio_gain");

			if ($jmlNilai == 2) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;


				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));


				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);


				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;


				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);


				//cetak
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasio2')");
			} else if ($jmlNilai == 3) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;
				$opsi31 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
				$opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
				$tot_opsi3 = $opsi31 + $opsi32;

				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
				$opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));

				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);
				$opsi3 = round($opsi3, 3);

				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;
				$rasio3 = $gain / $opsi3;

				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);
				$rasio3 = round($rasio3, 3);

				//cetak
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";
				echo "Opsi 3 : <br>jumlah " . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
					"<br>jumlah " . $nilai3 . " = " . $opsi32 .
					"<br>Split = " . $opsi3 .
					"<br>Rasio = " . $rasio3 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasio2'),
						('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasio3')");
			} else if ($jmlNilai == 4) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;
				$opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai1' OR $atribut='$nilai2')");
				$opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
				$tot_opsi3 = $opsi31 + $opsi32;
				$opsi41 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
				$tot_opsi4 = $opsi41 + $opsi42;

				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
				$opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
				$opsi4 = (- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));

				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);
				$opsi3 = round($opsi3, 3);
				$opsi4 = round($opsi4, 3);

				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;
				$rasio3 = $gain / $opsi3;
				$rasio4 = $gain / $opsi4;

				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);
				$rasio3 = round($rasio3, 3);
				$rasio4 = round($rasio4, 3);

				//cetak					
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai4 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";
				echo "Opsi 3 : <br>jumlah " . $nilai4 . "/" . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
					"<br>jumlah " . $nilai3 . " = " . $opsi32 .
					"<br>Split = " . $opsi3 .
					"<br>Rasio = " . $rasio3 . "<br>";
				echo "Opsi 4 : <br>jumlah " . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . " = " . $opsi41 .
					"<br>jumlah " . $nilai4 . " = " . $opsi42 .
					"<br>Split = " . $opsi4 .
					"<br>Rasio = " . $rasio4 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai1' , '$rasio2'),
						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai1 , $nilai2' , '$rasio3'),
						('' , 'opsi4' , '$nilai4' , '$nilai1 , $nilai2 , $nilai3' , '$rasio4')");
			} else if ($jmlNilai == 5) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;
				$opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2')");
				$opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
				$tot_opsi3 = $opsi31 + $opsi32;
				$opsi41 = jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
				$tot_opsi4 = $opsi41 + $opsi42;
				$opsi51 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
				$opsi52 = jumlah_data("$data_kasus $atribut='$nilai5'");
				$tot_opsi5 = $opsi51 + $opsi52;

				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
				$opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
				$opsi4 = (- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));
				$opsi5 = (- ($opsi51 / $tot_opsi5) * (log(($opsi51 / $tot_opsi5), 2))) + (- ($opsi52 / $tot_opsi5) * (log(($opsi52 / $tot_opsi5), 2)));

				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);
				$opsi3 = round($opsi3, 3);
				$opsi4 = round($opsi4, 3);
				$opsi5 = round($opsi5, 3);

				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;
				$rasio3 = $gain / $opsi3;
				$rasio4 = $gain / $opsi4;
				$rasio5 = $gain / $opsi5;

				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);
				$rasio3 = round($rasio3, 3);
				$rasio4 = round($rasio4, 3);
				$rasio5 = round($rasio5, 3);

				//cetak
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";
				echo "Opsi 3 : <br>jumlah " . $nilai4 . "/" . $nilai5 . "/" . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
					"<br>jumlah " . $nilai3 . " = " . $opsi32 .
					"<br>Split = " . $opsi3 .
					"<br>Rasio = " . $rasio3 . "<br>";
				echo "Opsi 4 : <br>jumlah " . $nilai5 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . " = " . $opsi41 .
					"<br>jumlah " . $nilai4 . " = " . $opsi42 .
					"<br>Split = " . $opsi4 .
					"<br>Rasio = " . $rasio4 . "<br>";
				echo "Opsi 5 : <br>jumlah " . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . " = " . $opsi51 .
					"<br>jumlah " . $nilai5 . " = " . $opsi52 .
					"<br>Split = " . $opsi5 .
					"<br>Rasio = " . $rasio5 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai1' , '$rasio2'),
						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai1 , $nilai2' , '$rasio3'),
						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai1 , $nilai2 , $nilai3' , '$rasio4'),
						('' , 'opsi5' , '$nilai5' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , '$rasio5')");
			} else if($jmlNilai == 6) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;
				$opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2')");
				$opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
				$tot_opsi3 = $opsi31 + $opsi32;
				$opsi41 = jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
				$tot_opsi4 = $opsi41 + $opsi42;
				$opsi51 = jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
				$opsi52 = jumlah_data("$data_kasus $atribut='$nilai5'");
				$tot_opsi5 = $opsi51 + $opsi52;
				$opsi61 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
				$opsi62 = jumlah_data("$data_kasus $atribut='$nilai6'");
				$tot_opsi6 = $opsi61 + $opsi62;

				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
				$opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
				$opsi4 = (- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));
				$opsi5 = (- ($opsi51 / $tot_opsi5) * (log(($opsi51 / $tot_opsi5), 2))) + (- ($opsi52 / $tot_opsi5) * (log(($opsi52 / $tot_opsi5), 2)));
				$opsi6 = (- ($opsi61 / $tot_opsi6) * (log(($opsi61 / $tot_opsi6), 2))) + (- ($opsi62 / $tot_opsi6) * (log(($opsi62 / $tot_opsi6), 2)));

				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);
				$opsi3 = round($opsi3, 3);
				$opsi4 = round($opsi4, 3);
				$opsi5 = round($opsi5, 3);
				$opsi6 = round($opsi6, 3);

				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;
				$rasio3 = $gain / $opsi3;
				$rasio4 = $gain / $opsi4;
				$rasio5 = $gain / $opsi5;
				$rasio6 = $gain / $opsi6;

				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);
				$rasio3 = round($rasio3, 3);
				$rasio4 = round($rasio4, 3);
				$rasio5 = round($rasio5, 3);
				$rasio6 = round($rasio6, 3);

				//cetak
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";
				echo "Opsi 3 : <br>jumlah " . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . "/" . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
					"<br>jumlah " . $nilai3 . " = " . $opsi32 .
					"<br>Split = " . $opsi3 .
					"<br>Rasio = " . $rasio3 . "<br>";
				echo "Opsi 4 : <br>jumlah " . $nilai5 . "/" . $nilai6 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . " = " . $opsi41 .
					"<br>jumlah " . $nilai4 . " = " . $opsi42 .
					"<br>Split = " . $opsi4 .
					"<br>Rasio = " . $rasio4 . "<br>";
				echo "Opsi 5 : <br>jumlah " . $nilai6 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . " = " . $opsi51 .
					"<br>jumlah " . $nilai5 . " = " . $opsi52 .
					"<br>Split = " . $opsi5 .
					"<br>Rasio = " . $rasio5 . "<br>";
				echo "Opsi 6 : <br>jumlah " . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . " = " . $opsi61 .
					"<br>jumlah " . $nilai6 . " = " . $opsi62 .
					"<br>Split = " . $opsi6 .
					"<br>Rasio = " . $rasio6 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5 , $nilai6' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6 , $nilai1' , '$rasio2'),
						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai1 , $nilai2' , '$rasio3'),
						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai1 , $nilai2 , $nilai3' , '$rasio4'),
						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai1 , $nilai2 , $nilai3 , $nilai4' , '$rasio5'),
						('' , 'opsi6' , '$nilai6' , '$nilai1 , $nilai2 , $nilai3 , $nilai4 , $rasio5' , '$rasio6')");
			} else if($jmlNilai==7) {
				$opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
				$opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
				$tot_opsi1 = $opsi11 + $opsi12;
				$opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1')");
				$opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
				$tot_opsi2 = $opsi21 + $opsi22;
				$opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2')");
				$opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
				$tot_opsi3 = $opsi31 + $opsi32;
				$opsi41 = jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
				$opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
				$tot_opsi4 = $opsi41 + $opsi42;
				$opsi51 = jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
				$opsi52 = jumlah_data("$data_kasus $atribut='$nilai5'");
				$tot_opsi5 = $opsi51 + $opsi52;
				$opsi61 = jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
				$opsi62 = jumlah_data("$data_kasus $atribut='$nilai6'");
				$tot_opsi6 = $opsi61 + $opsi62;
				$opsi71 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
				$opsi72 = jumlah_data("$data_kasus $atribut='$nilai7'");
				$tot_opsi7 = $opsi71 + $opsi72;

				//hitung split info
				$opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
				$opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
				$opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
				$opsi4 = (- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));
				$opsi5 = (- ($opsi51 / $tot_opsi5) * (log(($opsi51 / $tot_opsi5), 2))) + (- ($opsi52 / $tot_opsi5) * (log(($opsi52 / $tot_opsi5), 2)));
				$opsi6 = (- ($opsi61 / $tot_opsi6) * (log(($opsi61 / $tot_opsi6), 2))) + (- ($opsi62 / $tot_opsi6) * (log(($opsi62 / $tot_opsi6), 2)));
				$opsi7 = (- ($opsi71 / $tot_opsi7) * (log(($opsi71 / $tot_opsi7), 2))) + (- ($opsi72 / $tot_opsi7) * (log(($opsi72 / $tot_opsi7), 2)));

				//desimal 3 angka dibelakang koma
				$opsi1 = round($opsi1, 3);
				$opsi2 = round($opsi2, 3);
				$opsi3 = round($opsi3, 3);
				$opsi4 = round($opsi4, 3);
				$opsi5 = round($opsi5, 3);
				$opsi6 = round($opsi6, 3);
				$opsi7 = round($opsi7, 3);

				//hitung rasio
				$rasio1 = $gain / $opsi1;
				$rasio2 = $gain / $opsi2;
				$rasio3 = $gain / $opsi3;
				$rasio4 = $gain / $opsi4;
				$rasio5 = $gain / $opsi5;
				$rasio6 = $gain / $opsi6;
				$rasio7 = $gain / $opsi7;

				//desimal 3 angka dibelakang koma
				$rasio1 = round($rasio1, 3);
				$rasio2 = round($rasio2, 3);
				$rasio3 = round($rasio3, 3);
				$rasio4 = round($rasio4, 3);
				$rasio5 = round($rasio5, 3);
				$rasio6 = round($rasio6, 3);
				$rasio7 = round($rasio7, 3);

				//cetak
				echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . "/" . $nilai7 . " = " . $opsi11 .
					"<br>jumlah " . $nilai1 . " = " . $opsi12 .
					"<br>Split = " . $opsi1 .
					"<br>Rasio = " . $rasio1 . "<br>";
				echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . "/" . $nilai7 . "/" . $nilai1 . " = " . $opsi21 .
					"<br>jumlah " . $nilai2 . " = " . $opsi22 .
					"<br>Split = " . $opsi2 .
					"<br>Rasio = " . $rasio2 . "<br>";
				echo "Opsi 3 : <br>jumlah " . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . "/" . $nilai7 . "/" . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
					"<br>jumlah " . $nilai3 . " = " . $opsi32 .
					"<br>Split = " . $opsi3 .
					"<br>Rasio = " . $rasio3 . "<br>";
				echo "Opsi 4 : <br>jumlah " . $nilai5 . "/" . $nilai6 . "/" . $nilai7 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . " = " . $opsi41 .
					"<br>jumlah " . $nilai4 . " = " . $opsi42 .
					"<br>Split = " . $opsi4 .
					"<br>Rasio = " . $rasio4 . "<br>";
				echo "Opsi 5 : <br>jumlah " . $nilai6 . "/" . $nilai7 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . " = " . $opsi51 .
					"<br>jumlah " . $nilai5 . " = " . $opsi52 .
					"<br>Split = " . $opsi5 .
					"<br>Rasio = " . $rasio5 . "<br>";
				echo "Opsi 6 : <br>jumlah " . $nilai7 . "/" . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . " = " . $opsi61 .
					"<br>jumlah " . $nilai6 . " = " . $opsi62 .
					"<br>Split = " . $opsi6 .
					"<br>Rasio = " . $rasio6 . "<br>";
				echo "Opsi 7 : <br>jumlah " . $nilai1 . "/" . $nilai2 . "/" . $nilai3 . "/" . $nilai4 . "/" . $nilai5 . "/" . $nilai6 . " = " . $opsi71 .
					"<br>jumlah " . $nilai7 . " = " . $opsi72 .
					"<br>Split = " . $opsi7 .
					"<br>Rasio = " . $rasio7 . "<br>";

				//insert 
				mysql_query("INSERT INTO rasio_gain VALUES 
						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5 , $nilai6 , $nilai7' , '$rasio1'),
						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6 , $nilai7 , $nilai1' , '$rasio2'),
						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7 , $nilai1 , $nilai2' , '$rasio3'),
						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai1 , $nilai2 , $nilai3' , '$rasio4'),
						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai1 , $nilai2 , $nilai3 , $nilai4' , '$rasio5'),
						('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai1 , $nilai2 , $nilai3 , $nilai4 , $nilai5' , '$rasio6'),
						('' , 'opsi7' , '$nilai7' , '$nilai1 , $nilai2 , $nilai3 , $nilai4 , $nilai5 , $nilai6' , '$rasio7')");
			}
			$sql_max = mysql_query("SELECT MAX(rasio_gain) FROM rasio_gain");
			$row_max = mysql_fetch_array($sql_max);
			$max_rasio = $row_max['0'];
			$sql = mysql_query("SELECT * FROM rasio_gain WHERE rasio_gain=$max_rasio");
			$row = mysql_fetch_array($sql);
			$opsiMax = array();
			$opsiMax[0] = $row[2];
			$opsiMax[1] = $row[3];
			echo "<br>=========================<br>";
			return $opsiMax;
		}
		?>
	