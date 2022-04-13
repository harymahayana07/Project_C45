<?php
	include "koneksi.php";
	if(isset($_GET['act'])){
		$action=$_GET['act'];				
		//delete semua data
		if($action=='delete_all'){
			mysql_query("TRUNCATE hasil_prediksi");
			header('location:index.php?menu=hasil');
		}
	}else{
		$query=mysql_query("SELECT a.nim,b.nama,b.jenis_kelamin,b.angkatan,b.kelas,a.hasil 
								FROM hasil_prediksi a INNER JOIN mahasiswa b ON (a.nim=b.nim) 
								ORDER BY(a.nim)");
		$jumlah=mysql_num_rows($query);	
		//jika hasil_prediksi kosong
		if($jumlah==0){
			echo "<center><h3>Hasil Prediksi Kosong...</h3></center>";
		}
		//jika hasil prediksi sudah terisi
		else{
			echo "Jumlah data : ".$jumlah;	
?>
			<p>
				Opsi: 
				<a href="index.php?menu=hasil&act=delete_all" onClick="return confirm('Anda yakin akan hapus semua data?')">Hapus Semua Data</a> | 
				<a href="export/CLP.php?format=3">Download Laporan</a>
			</p>
			
			<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
				<tr align='center'>
					<th>No</th><th>NIM</th><th>Nama</th><th>Jenis Kelamin</th><th>Angkatan</th><th>Kelas</th><th>Hasil Prediksi</th>
				</tr>
			<?php
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
			?>
					<tr bgcolor=<?php echo $warna; ?> align=center>
						<td><?php echo $no;?></td>			
						<td><?php echo $row[0];?></td>
						<td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
						<td><?php echo $row[3];?></td>
						<td><?php echo $row[4];?></td>						
						<td><?php echo $row[5];?></td>		
					</tr>
				<?php
					$no++;
				}
				?>
			</table>		
<?php
		}
	}
?>