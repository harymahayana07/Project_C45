<?php
include "conn/koneksi.php";
include "import/excel_reader2.php";

$dataUpload = $_GET['data'];
if ($dataUpload == 'training') {
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index = 0);
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
		if ($baris) {
			$import = mysql_query(
				"INSERT INTO data_training (jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
					 VALUES ('$jk','$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')"
			);

			if ($import) {
				$sts[] = 'Data berhasil disimpan';
				header('location:data_training.php?status_import=sukses-import');
			} else {
				header('location:data_training.php?status_import=gagal-import');
				$sts[] = 'Data gagal disimpan';
			}
		}
	}
} else if ($dataUpload == 'user') {
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index = 0);
	$sukses = 0;
	$gagal = 0;
	for ($i = 2; $i <= $baris; $i++) {
		$nisn = $data->val($i, 2);
		$nama = $data->val($i, 3);
		$jenis_kelamin = $data->val($i, 4);
		$asal_sekolah = $data->val($i, 5);

		if ($baris) {
			$import = mysql_query("INSERT INTO data_siswa VALUES ('$nisn','$nama','$jenis_kelamin','$asal_sekolah')");
			$import2 = mysql_query("INSERT INTO user VALUES ('$nisn','$nama','$nisn','siswa')");

			if ($import && $import2) {
				$sts[] = 'Data berhasil disimpan';
				header('location:data_user.php?status_import=sukses-import');
			} else {
				header('location:data_user.php?status_import=gagal-import');
				$sts[] = 'Data gagal disimpan';
			}
		}
	}
} else if ($dataUpload == 'uji') {
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index = 0);
	$sukses = 0;
	$gagal = 0;
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

		if ($baris) {
			$import = mysql_query("INSERT INTO data_uji (jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan_asli) 
			VALUES ('$jk','$ppdb','$bhs_indonesia','$matematika','$bhs_inggris','$ipa','$ips','$skhu','$jurusan')");

			if ($import) {
				$sts[] = 'Data berhasil disimpan';
				header('location:uji_rule.php?status_import=sukses-import');
			} else {
				header('location:uji_rule.php?status_import=gagal-import');
				$sts[] = 'Data gagal disimpan';
			}
		}
	}
}
