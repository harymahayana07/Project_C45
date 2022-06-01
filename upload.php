<?php
include "conn/koneksi.php";
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
		$jk = $data->val($i, 2);
		$ppdb = $data->val($i, 3);
		$bhs_indonesia = $data->val($i, 4);
		$matematika = $data->val($i, 5);
		$bhs_inggris = $data->val($i, 6);
		$ipa = $data->val($i, 7);
		$ips = $data->val($i, 8);
		$skhu = $data->val($i, 9);
		$jurusan = $data->val($i, 10);

		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_training (jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
			VALUES ('$jk','$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:data_training.php');
	// 
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
		$jk = $data->val($i, 2);
		$ppdb = $data->val($i, 3);
		$bhs_indonesia = $data->val($i, 4);
		$matematika = $data->val($i, 5);
		$bhs_inggris = $data->val($i, 6);
		$ipa = $data->val($i, 7);
		$ips = $data->val($i, 8);
		$skhu = $data->val($i, 9);
		$jurusan = $data->val($i, 10);
		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_uji (jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan_asli) 
			VALUES ('$jk','$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:uji_rule.php');

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
		$nisn = $data->val($i, 2);
		$nama = $data->val($i, 3);
		$jenis_kelamin = $data->val($i, 4);
		$asal_sekolah = $data->val($i, 5);
		//setelah data dibaca, sisipkan ke dalam tabel 
		mysql_query("INSERT INTO data_siswa VALUES ('$nisn','$nama','$jenis_kelamin','$asal_sekolah')");
		mysql_query("INSERT INTO user VALUES ('$nisn','$nama','$nisn','siswa')");
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:data_user.php');
}
