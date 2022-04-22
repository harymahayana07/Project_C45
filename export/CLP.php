<?php
	include "../koneksi.php";
	$query=mysql_query("SELECT a.nim,b.nama,b.jenis_kelamin,b.angkatan,b.kelas,a.hasil 
							FROM hasil_prediksi a INNER JOIN mahasiswa b ON (a.nim=b.nim) 
							ORDER BY(a.nim)");
	$jumlah=mysql_num_rows($query);	
	
	$conten = "<center><h1>Laporan Hasil Prediksi Prestasi Akademik Mahasiswa</h1></center><br><br>Jumlah data : ".$jumlah."
	<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=600>";
	$conten .="
		<tr align='center'>
			<th>No</th><th>NIM</th><th>Nama</th><th>Jenis Kelamin</th><th>Angkatan</th><th>Kelas</th><th>Hasil Prediksi</th>
		</tr>";
	
		$warna1 = '#ffffff';
		$warna2 = '#f5f5f5';
		$warna  = $warna1; 	
		$no=1;
		while($row=mysql_fetch_array($query)){
			if($warna == $warna1){
				$warna = $warna2; 
			} else { 
				$warna = $warna1; 
			} 			
		$conten .="			
			<tr bgcolor=".$warna." align='center'>
				<td>".$no."</td>			
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>
				<td>".$row[2]."</td>
				<td>".$row[3]."</td>
				<td>".$row[4]."</td>						
				<td>".$row[5]."</td>		
			</tr>";		
			$no++;
		}
	$conten .="				
			</table>";

//ms word
if($_GET['format']=='1'){
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan_Hasil_Prediksi.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $conten;
}
//ms exel
elseif($_GET['format']=='2'){
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan_Hasil_Prediksi.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $conten;
}elseif($_GET['format']=='3') {
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
     
    $sql_que ="SELECT a.nim,b.nama,b.jenis_kelamin,b.angkatan,b.kelas,a.hasil 
							FROM hasil_prediksi a INNER JOIN mahasiswa b ON (a.nim=b.nim) 
							ORDER BY(a.nim)";
    $db_query = mysql_query($sql_que) or die("Query gagal");
    //Variabel untuk iterasi
    $i = 0;
    //Mengambil nilai dari query database
    while($data=mysql_fetch_row($db_query))
    {
        $cell[$i][0] = $data[0];
        $cell[$i][1] = $data[1];
        $cell[$i][2] = $data[2];
        $cell[$i][3] = $data[3];
		$cell[$i][4] = $data[4];
		$cell[$i][5] = $data[5];
        $i++;
    }
    //memulai pengaturan output PDF
    class PDF extends FPDF
    {
        //untuk pengaturan header halaman
        function Header()
        {
            //Pengaturan Font Header
            $this->SetFont('Times','B',14); //jenis font : Times New Romans, Bold, ukuran 14
            //untuk warna background Header
            $this->SetFillColor(255,255,255);
            //untuk warna text
            $this->SetTextColor(0,0,0);
            //Menampilkan tulisan di halaman
            $this->Cell(25,1,'Laporan Hasil Prediksi Prestasi Akademik Mahasiswa','',0,'C',1); //TBLR (untuk garis)=> B = Bottom,
            // L = Left, R = Right
            //untuk garis, C = center
        }
    }
    //pengaturan ukuran kertas P = Portrait
    $pdf = new PDF('P','cm','A4');
    $pdf->Open();
    $pdf->AddPage();
    //Ln() = untuk pindah baris
    $pdf->Ln();$pdf->Ln();
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(1,1,'No','LRTB',0,'C');
    $pdf->Cell(2,1,'NIM','LRTB',0,'C');
    $pdf->Cell(8,1,'Nama','LRTB',0,'C');
    $pdf->Cell(2,1,'Jenis Kelamin','LRTB',0,'C');
    $pdf->Cell(3,1,'Angkatan','LRTB',0,'C');
	$pdf->Cell(3,1,'Kelas','LRTB',0,'C');
	$pdf->Cell(5,1,'Hasil Prediksi','LRTB',0,'C');
    $pdf->Ln();
    $pdf->SetFont('Times',"",10);
    for($j=0;$j<$i;$j++)
    {
        //menampilkan data dari hasil query database
        $pdf->Cell(1,1,$j+1,'LBTR',0,'C');
        $pdf->Cell(2,1,$cell[$j][0],'LBTR',0,'C');
        $pdf->Cell(8,1,$cell[$j][1],'LBTR',0,'C');
        $pdf->Cell(2,1,$cell[$j][2],'LBTR',0,'C');
        $pdf->Cell(2,1,$cell[$j][3],'LBTR',0,'C');
		$pdf->Cell(2,1,$cell[$j][4],'LBTR',0,'C');
		$pdf->Cell(3,1,$cell[$j][5],'LBTR',0,'C');
        $pdf->Ln();
    }
    //menampilkan output berupa halaman PDF
    $pdf->Output();
}
?>