<?php
include_once("../conn/koneksi.php");
$query = mysql_query("SELECT a.nisn,b.nama,b.jenis_kelamin,b.asal_sekolah,a.hasil 
							FROM hasil_prediksi a INNER JOIN data_siswa b ON (a.nisn=b.nisn) 
							ORDER BY(a.nisn)");
$jumlah = mysql_num_rows($query);

$conten = "<center><h3>LAPORAN HASIL PREDIKSI PENJURUSAN SISWA</h3></center>
			<p style='margin-left: 5px;'>Jumlah data : " . $jumlah . "</p>" . "
	
<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=600>";
$conten .= "
		<tr align='center'>
			<th>No</th>
			<th>Nisn</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Asal Sekolah</th>
			<th>Hasil Prediksi</th>
		</tr>";

$warna1 = '#ffffff';
$warna2 = '#f5f5f5';
$warna  = $warna1;
$no = 1;
while ($row = mysql_fetch_array($query)) {
	if ($warna == $warna1) {
		$warna = $warna2;
	} else {
		$warna = $warna1;
	}
	$conten .= "			
			<tr bgcolor=" . $warna . " align='center'>
				<td>" . $no . "</td>			
				<td>" . $row[0] . "</td>
				<td>" . $row[1] . "</td>
				<td>" . $row[2] . "</td>
				<td>" . $row[3] . "</td>
				<td>" . $row[4] . "</td>						
			</tr>";
	$no++;
}
$conten .= "				
			</table>";

//ms word
if ($_GET['format'] == '1') {
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan_Hasil_Prediksi.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $conten;
}
//ms exel
elseif ($_GET['format'] == '2') {
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan_Hasil_Prediksi.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $conten;

} elseif ($_GET['format'] == '3') {
	/*define('FPDF_FONTPATH','pdftable/font/');
	require('pdftable/pdftable.inc.php');
	$pdf=new PDFTable('P');
	$pdf->AddFont('vni_times');
	$pdf->AddFont('vni_times', 'B');
	$pdf->AddFont('vni_times', 'I');
	$pdf->AddFont('vni_times', 'BI');
	$pdf->SetMargins(0,0,0,0);
	$pdf->AddPage();
	$pdf->defaultFontFamily = 'arial';
	$pdf->defaultFontStyle  = '';
	$pdf->defaultFontSize   = 11;
	$pdf->SetFont($pdf->defaultFontFamily, $pdf->defaultFontStyle, $pdf->defaultFontSize);
	$pdf->htmltable($conten);
	$pdf->Output('laporan_Hasil_Prediksi.pdf', 'I');*/
	require('fpdf16/fpdf.php');

	$sql_que = "SELECT a.nisn,b.nama,b.jenis_kelamin,b.asal_sekolah,a.hasil 
							FROM hasil_prediksi a INNER JOIN data_siswa b ON (a.nisn=b.nisn) 
							ORDER BY(a.nisn)";
	$db_query = mysql_query($sql_que) or die("Query gagal");
	//Variabel untuk iterasi
	$i = 0;
	//Mengambil nilai dari query database
	while ($data = mysql_fetch_row($db_query)) {
		$cell[$i][0] = $data[0];
		$cell[$i][1] = $data[1];
		$cell[$i][2] = $data[2];
		$cell[$i][3] = $data[3];
		$cell[$i][4] = $data[4];
		$i++;
	}
	//memulai pengaturan output PDF
	class PDF extends FPDF
	{
		//untuk pengaturan header halaman
		function Header()
		{
			//Pengaturan Font Header
			$this->SetFont('Times', 'B', 13); //jenis font : Times New Romans, Bold, ukuran 14
			//untuk warna background Header
			$this->SetFillColor(255, 255, 255);
			//untuk warna text
			$this->SetTextColor(0, 0, 0);
			//Menampilkan tulisan di halaman
			$this->Cell(19, 1, 'LAPORAN HASIL PREDIKSI PENJURUSAN SISWA', '', 0, 'C', 1); //TBLR (untuk garis)=> B = Bottom,
			// L = Left, R = Right
			//untuk garis, C = center
		}
	}
	//pengaturan ukuran kertas P = Portrait
	$pdf = new PDF('P', 'cm', 'A4');
	$pdf->Open();
	$pdf->AddPage();
	//Ln() = untuk pindah baris
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Times', 'B', 11);
	$pdf->Cell(1, 1, 'No', 'LRTB', 0, 'C');
	$pdf->Cell(2, 1, 'NISN', 'LRTB', 0, 'C');
	$pdf->Cell(7, 1, 'Nama', 'LRTB', 0, 'C');
	$pdf->Cell(1, 1, 'JK', 'LRTB', 0, 'C');
	$pdf->Cell(6, 1, 'Asal Sekolah', 'LRTB', 0, 'C');
	$pdf->Cell(2, 1, 'Hasil', 'LRTB', 0, 'C');
	$pdf->Ln();
	$pdf->SetFont('Times', "", 10);
	for ($j = 0; $j < $i; $j++) {
		//menampilkan data dari hasil query database
		$pdf->Cell(1, 1, $j + 1, 'LBTR', 0, 'C');
		$pdf->Cell(2, 1, $cell[$j][0], 'LBTR', 0, 'C');
		$pdf->Cell(7, 1, $cell[$j][1], 'LBTR', 0, 'C');
		$pdf->Cell(1, 1, $cell[$j][2], 'LBTR', 0, 'C');
		$pdf->Cell(6, 1, $cell[$j][3], 'LBTR', 0, 'C');
		$pdf->Cell(2, 1, $cell[$j][4], 'LBTR', 0, 'C');
		$pdf->Ln();
	}
	//menampilkan output berupa halaman PDF
	$pdf->Output();
}else if ($_GET['format'] == '4') {
	require_once("print.php");
}
?>