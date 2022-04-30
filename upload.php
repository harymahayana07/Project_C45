<?php
include "koneksi.php";
//menggunakan class phpExcelReader
include "import/excel_reader2.php";

$dataUpload = $_GET['data'];
if ($dataUpload == 'training') {
	//membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	//membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index = 0);
	//nilai awal counter jumlah data yang sukses dan yang gagal diimport
	$sukses = 0;
	$gagal = 0;
	//import data excel dari baris kedua, karena baris pertama adalah nama kolom
	for ($i = 2; $i <= $baris; $i++) {
		$ppdb = $data->val($i, 2);
		$bhs_indonesia = $data->val($i, 3);
		$matematika = $data->val($i, 4);
		$bhs_inggris = $data->val($i, 5);
		$ipa = $data->val($i, 6);
		$ips = $data->val($i, 7);
		$skhu = $data->val($i, 8);
		$jurusan = $data->val($i, 9);

		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_training (ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
			VALUES ('$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:index.php?menu=data');
} else if ($dataUpload == 'uji') {
	//membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	//membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index = 0);
	//nilai awal counter jumlah data yang sukses dan yang gagal diimport
	$sukses = 0;
	$gagal = 0;
	//import data excel dari baris kedua, karena baris pertama adalah nama kolom
	for ($i = 2; $i <= $baris; $i++) {
		$ppdb = $data->val($i, 2);
		// 
		$bhs_indonesia = $data->val($i, 3);
		if ($bhs_indonesia >= 92 && $bhs_indonesia <= 100) {
			return $bhs_indonesia = "A";
		} else if ($bhs_indonesia >= 84 && $bhs_indonesia < 92) {
			return $bhs_indonesia = "B";
		} else if ($bhs_indonesia >= 76 && $bhs_indonesia <= 84) {
			return $bhs_indonesia = "C";
		} else if ($bhs_indonesia >= 70 && $bhs_indonesia <= 76) {
			return $bhs_indonesia = "D";
		} else if ($bhs_indonesia >= 65  && $bhs_indonesia <= 70) {
			return $bhs_indonesia = "E";
		} else {
			return $bhs_indonesia = "Tidak Lulus";
		}
		// 
		$matematika = $data->val($i, 4);
		if ($matematika >= 92 && $matematika <= 100) {
			return $matematika = "A";
		} else if ($matematika >= 84 && $matematika < 92) {
			return $matematika = "B";
		} else if ($matematika >= 76 && $matematika <= 84) {
			return $matematika = "C";
		} else if ($matematika >= 70 && $matematika <= 76) {
			return $matematika = "D";
		} else if ($matematika >= 65  && $matematika <= 70) {
			return $matematika = "E";
		} else {
			return $matematika = "Tidak Lulus";
		}
		// 
		$bhs_inggris = $data->val($i, 5);
		if ($bhs_inggris >= 92 && $bhs_inggris <= 100) {
			return $bhs_inggris = "A";
		} else if ($bhs_inggris >= 84 && $bhs_inggris < 92) {
			return $bhs_inggris = "B";
		} else if ($bhs_inggris >= 76 && $bhs_inggris <= 84) {
			return $bhs_inggris = "C";
		} else if ($bhs_inggris >= 70 && $bhs_inggris <= 76) {
			return $bhs_inggris = "D";
		} else if ($bhs_inggris >= 65  && $bhs_inggris <= 70) {
			return $bhs_inggris = "E";
		} else {
			return $bhs_inggris = "Tidak Lulus";
		}
		// 
		$ipa = $data->val($i, 6);
		if ($ipa >= 92 && $ipa <= 100) {
			return $ipa = "A";
		} else if ($ipa >= 84 && $ipa < 92) {
			return $ipa = "B";
		} else if ($ipa >= 76 && $ipa <= 84) {
			return $ipa = "C";
		} else if ($ipa >= 70 && $ipa <= 76) {
			return $ipa = "D";
		} else if ($ipa >= 65  && $ipa <= 70) {
			return $ipa = "E";
		} else {
			return $ipa = "Tidak Lulus";
		}
		// 
		$ips = $data->val($i, 7);
		if ($ips >= 92 && $ips <= 100) {
			return $ips = "A";
		} else if ($ips >= 84 && $ips < 92) {
			return $ips = "B";
		} else if ($ips >= 76 && $ips <= 84) {
			return $ips = "C";
		} else if ($ips >= 70 && $ips <= 76) {
			return $ips = "D";
		} else if ($ips >= 65  && $ips <= 70) {
			return $ips = "E";
		} else {
			return $ips = "Tidak Lulus";
		}
		// 
		$skhu = $data->val($i, 8);
		if ($skhu >= 92 && $skhu <= 100) {
			return $skhu = "A";
		} else if ($skhu >= 84 && $skhu < 92) {
			return $skhu = "B";
		} else if ($skhu >= 76 && $skhu <= 84) {
			return $skhu = "C";
		} else if ($skhu >= 70 && $skhu <= 76) {
			return $skhu = "D";
		} else if ($skhu >= 65  && $skhu <= 70) {
			return $skhu = "E";
		} else {
			return $skhu = "Tidak Lulus";
		}
		$jurusan = $data->val($i, 9);
		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_uji (ppdb,skhu,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
			VALUES ('$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:index.php?menu=uji_rule');
} else if ($dataUpload == 'data_training_konversi') {
	//membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	//membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index = 0);
	//nilai awal counter jumlah data yang sukses dan yang gagal diimport
	$sukses = 0;
	$gagal = 0;
	//import data excel dari baris kedua, karena baris pertama adalah nama kolom
	for ($i = 2; $i <= $baris; $i++) {
		$ppdb = $data->val($i, 2);
		// 
		$bhs_indonesia = $data->val($i, 3);
		if ($bhs_indonesia >= 92 && $bhs_indonesia <= 100) {
			return $bhs_indonesia = "A";
		} else if ($bhs_indonesia >= 84 && $bhs_indonesia < 92) {
			return $bhs_indonesia = "B";
		} else if ($bhs_indonesia >= 76 && $bhs_indonesia <= 84) {
			return $bhs_indonesia = "C";
		} else if ($bhs_indonesia >= 70 && $bhs_indonesia <= 76) {
			return $bhs_indonesia = "D";
		} else if ($bhs_indonesia >= 65  && $bhs_indonesia <= 70) {
			return $bhs_indonesia = "E";
		} else {
			return $bhs_indonesia = "Tidak Lulus";
		}
		// 
		$matematika = $data->val($i, 4);
		if ($matematika >= 92 && $matematika <= 100) {
			return $matematika = "A";
		} else if ($matematika >= 84 && $matematika < 92) {
			return $matematika = "B";
		} else if ($matematika >= 76 && $matematika <= 84) {
			return $matematika = "C";
		} else if ($matematika >= 70 && $matematika <= 76) {
			return $matematika = "D";
		} else if ($matematika >= 65  && $matematika <= 70) {
			return $matematika = "E";
		} else {
			return $matematika = "Tidak Lulus";
		}
		// 
		$bhs_inggris = $data->val($i, 5);
		if ($bhs_inggris >= 92 && $bhs_inggris <= 100) {
			return $bhs_inggris = "A";
		} else if ($bhs_inggris >= 84 && $bhs_inggris < 92) {
			return $bhs_inggris = "B";
		} else if ($bhs_inggris >= 76 && $bhs_inggris <= 84) {
			return $bhs_inggris = "C";
		} else if ($bhs_inggris >= 70 && $bhs_inggris <= 76) {
			return $bhs_inggris = "D";
		} else if ($bhs_inggris >= 65  && $bhs_inggris <= 70) {
			return $bhs_inggris = "E";
		} else {
			return $bhs_inggris = "Tidak Lulus";
		}
		// 
		$ipa = $data->val($i, 6);
		if ($ipa >= 92 && $ipa <= 100) {
			return $ipa = "A";
		} else if ($ipa >= 84 && $ipa < 92) {
			return $ipa = "B";
		} else if ($ipa >= 76 && $ipa <= 84) {
			return $ipa = "C";
		} else if ($ipa >= 70 && $ipa <= 76) {
			return $ipa = "D";
		} else if ($ipa >= 65  && $ipa <= 70) {
			return $ipa = "E";
		} else {
			return $ipa = "Tidak Lulus";
		}
		// 
		$ips = $data->val($i, 7);
		if ($ips >= 92 && $ips <= 100) {
			return $ips = "A";
		} else if ($ips >= 84 && $ips < 92) {
			return $ips = "B";
		} else if ($ips >= 76 && $ips <= 84) {
			return $ips = "C";
		} else if ($ips >= 70 && $ips <= 76) {
			return $ips = "D";
		} else if ($ips >= 65  && $ips <= 70) {
			return $ips = "E";
		} else {
			return $ips = "Tidak Lulus";
		}
		// 
		$skhu = $data->val($i, 8);
		if ($skhu >= 92 && $skhu <= 100) {
			return $skhu = "A";
		} else if ($skhu >= 84 && $skhu < 92) {
			return $skhu = "B";
		} else if ($skhu >= 76 && $skhu <= 84) {
			return $skhu = "C";
		} else if ($skhu >= 70 && $skhu <= 76) {
			return $skhu = "D";
		} else if ($skhu >= 65  && $skhu <= 70) {
			return $skhu = "E";
		} else {
			return $skhu = "Tidak Lulus";
		}
		$jurusan = $data->val($i, 9);
		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_training_konversi (ppdb,skhu,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
			VALUES ('$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:index.php?menu=training_konversi');
} else if ($dataUpload == 'user') {

	//membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	//membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index = 0);
	//nilai awal counter jumlah data yang sukses dan yang gagal diimport
	$sukses = 0;
	$gagal = 0;
	//import data excel dari baris kedua, karena baris pertama adalah nama kolom
	for ($i = 2; $i <= $baris; $i++) {
		$nisn = $data->val($i, 1);
		$nama = $data->val($i, 2);
		$jenis_kelamin = $data->val($i, 3);
		$asal_sekolah = $data->val($i, 4);
		//setelah data dibaca, sisipkan ke dalam tabel 
		mysql_query("INSERT INTO data_siswa VALUES ('$nisn','$nama','$jenis_kelamin','$asal_sekolah')");
		mysql_query("INSERT INTO user VALUES ('$nisn','$nama','$nisn','siswa')");
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:index.php?menu=user');
}
