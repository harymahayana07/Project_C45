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
		$minat = $data->val($i, 9);

		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_training (ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,minat) 
			VALUES ('$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$minat')";
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
		$instansi = $data->val($i, 2);
		$status = $data->val($i, 3);
		$jurusan = $data->val($i, 4);
		$rataUN = $data->val($i, 5);
		$kerja = $data->val($i, 6);
		$motivasi = $data->val($i, 7);
		$ipk = $data->val($i, 8);
		//setelah data dibaca, sisipkan ke dalam tabel 
		$query = "INSERT INTO data_uji (instansi,status,jurusan,rata_un,kerja,motivasi,ipk_asli) 
			VALUES ('$instansi','$status','$jurusan','$rataUN','$kerja','$motivasi','$ipk')";
		$hasil = mysql_query($query);
		//menambah counter jika berhasil atau gagal
		if ($hasil) $sukses++;
		else $gagal++;
	}
	header('location:index.php?menu=uji_rule');
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
