<?php
include "koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['usr'])){
	header("location:login.php");
}	

$s_Query=mysql_query("SELECT * FROM pohon_keputusan");
$jml_tree=mysql_num_rows($s_Query);

if($jml_tree==0){
	echo "<center><h3>Anda tidak bisa melakukan prediksi,<br>
			Karena Pohon Keputusan belum terbentuk...</h3></center>";
}else{
	$nim=$_SESSION['usr'];
	$query=mysql_query("SELECT * FROM hasil_prediksi WHERE nim='$nim'");
	$baris=mysql_fetch_array($query);
	$jmlque=mysql_num_rows($query);
	if($jmlque==1){
		echo "<center><h1>Anda sudah melakukan prediksi..<br></h1>
			<strong>Jawaban Anda sebelumnya:<br>
			Instansi = ".$baris['instansi']."<br>
			Status = ".$baris['status']."<br>
			Jurusan = ".$baris['jurusan']."<br>
			Rata UN = ".$baris['rata_un']."<br> 
			Status kerja = ".$baris['kerja']."<br>
			Motivasi = ".$baris['motivasi']."</strong><br> 
			<h1>Prediksi prestasi Anda adalah ".$baris['hasil']."</h1></center>";	
		
		//menyajikan rule
		$n_instansi = $baris['instansi'];
		$n_status = $baris['status'];
		$n_jurusan = $baris['jurusan'];
		$n_rataUN = $baris['rata_un'];
		$n_kerja = $baris['kerja'];
		$n_motivasi = $baris['motivasi'];
		$sql=mysql_query("SELECT * FROM pohon_keputusan");	
		$id_rule="";
		$keputusan="";
		while($row=mysql_fetch_array($sql)){
			//menggabungkan parent dan akar dengan kata AND
			if($row[1]!=''){
				$rule=$row[1]." AND ".$row[2];
			}else{
				$rule=$row[2];
			}
			//mengubah parameter
			$rule=str_replace("<="," k ",$rule);
			$rule=str_replace("="," s ",$rule);
			$rule=str_replace(">"," l ",$rule);		
			//mengganti nilai
			$rule=str_replace("instansi","'$n_instansi'",$rule);
			$rule=str_replace("status","'$n_status'",$rule);
			$rule=str_replace("jurusan","'$n_jurusan'",$rule);
			$rule=str_replace("rata_un","$n_rataUN",$rule);
			$rule=str_replace("kerja","'$n_kerja'",$rule);
			$rule=str_replace("motivasi","'$n_motivasi'",$rule);		
			//menghilangkan '
			$rule=str_replace("'","",$rule);
			//menggabungkan kata ortu dan orang lain
			$rule=str_replace("Orang Tua","OrangTua",$rule);
			$rule=str_replace("Orang Lain","OrangLain",$rule);
			//explode and
			$explodeAND = explode(" AND ",$rule);
			$jmlAND = count($explodeAND);				
			//menghilangkan ()
			$explodeAND=str_replace("(","",$explodeAND);
			$explodeAND=str_replace(")","",$explodeAND);			
			//deklarasi bol
			$bolAND=array();
			$n=0;
			while($n<$jmlAND){
				//explode or
				$explodeOR = explode(" OR ",$explodeAND[$n]);
				$jmlOR = count($explodeOR);	
				//deklarasi bol
				$bol=array();
				$a=0;
				while($a<$jmlOR){				
					//pecah  dengan spasi
					$exrule2 = explode(" ",$explodeOR[$a]);
					$parameter = $exrule2[1];				
					if($parameter=='s'){
						//pecah  dengan s
						$explodeRule = explode(" s ",$explodeOR[$a]);
						//nilai true false						
						if($explodeRule[0]==$explodeRule[1]){
							$bol[$a]="Benar";
						}else if($explodeRule[0]!=$explodeRule[1]){
							$bol[$a]="Salah";
						}
					}else if($parameter=='k'){
						//pecah  dengan k
						$explodeRule = explode(" k ",$explodeOR[$a]);
						//nilai true false
						if($explodeRule[0]<=$explodeRule[1]){
							$bol[$a]="Benar";
						}else{
							$bol[$a]="Salah";
						}
					}else if($parameter=='l'){
						//pecah dengan s
						$explodeRule = explode(" l ",$explodeOR[$a]);
						//nilai true false
						if($explodeRule[0]>$explodeRule[1]){
							$bol[$a]="Benar";
						}else{
							$bol[$a]="Salah";
						}
					}
					//cetak nilai bolean				
					$a++;
				}
				//isi false
				$bolAND[$n]="Salah";
				$b=0;			
				while($b<$jmlOR){
					//jika $bol[$b] benar bolAND benar
					if($bol[$b]=="Benar"){
						$bolAND[$n]="Benar";
					}
					$b++;
				}			
				$n++;
			}
			//isi boolrule
			$boolRule="Benar";
			$a=0;
			while($a<$jmlAND){			
				//jika ada yang salah boolrule diganti salah
				if($bolAND[$a]=="Salah"){
					$boolRule="Salah";
				}						
				$a++;
			}		
			if($boolRule=="Benar"){
				$keputusan=$row[3];
				$id_rule=$row[0];
			}			
		}
		if($keputusan==''){		
			echo "<h4><center>Rule terpilih adalah rule yang terakhir karena tidak memenuhi semua rule</center></h4>";			
		}else{		
			$sql_que=mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");			
			$row_bar=mysql_fetch_array($sql_que);
			$rule_terpilih = "IF ".$row_bar[1]." AND ".$row_bar[2]." THEN prestasi = ".$row_bar[3];
			echo "<h4><center>Rule yang terpilih adalah rule ke-".$row_bar[0]."<br>".$rule_terpilih."</center></h4>";						
		}
		echo "<center><a href='delete_prediksi.php?id=$nim' accesskey='5' title='ubah jawaban' onClick=\"return confirm('Anda yakin akan mengedit data?')\">Klik disini untuk kembali lakukan prediksi</a></center>";	
	}
	//jika belum melakukan prediksi
	else if($jmlque==0){
		if (!isset($_POST['submit'])) {
		?>
		<center><b>Jawab pertanyaan berikut dengan benar!</b></center>
		<form method=POST action='' >
			<table align='center'>
				<tr>
					<td colspan=2></td>
				</tr>		
				<tr>
					<td colspan=3>1. Apa instansi sekolahan asal Anda?</td>  
				</tr>
				<tr>			
					<td> &nbsp;&nbsp;<input type='radio' name='instansi' value='SMA' required="required">SMA </td>
					<td> <input type='radio' name='instansi' value='SMK' >SMK </td>
					<td> <input type='radio' name='instansi' value='MA' >MA 	</td>						
				</tr>
				<tr>
					<td colspan=3>2. Apa status sekolahan asal Anda?</td>
				</tr>
				<tr>			
					<td> &nbsp;&nbsp;<input type='radio' name='status' value='Negeri' required="required">Negeri </td>
					<td> <input type='radio' name='status' value='Swasta'>Swasta </td>
				</tr>
				<tr>
					<td colspan = 3>3. Apa jurusan Anda ketika SMA?</td>        
				</tr>
				<tr>
					<td> &nbsp;&nbsp;<input type='radio' name='jurusan' value='IPA' required="required">IPA </td>
					<td> <input type='radio' name='jurusan' value='IPS'>IPS </td>
					<td> <input type='radio' name='jurusan' value='Bahasa'>Bahasa </td>
					<td> <input type='radio' name='jurusan' value='Teknik'>Teknik </td>
					<td> <input type='radio' name='jurusan' value='Administrasi'>Administrasi </td>
				</tr>
				<tr>
					<td colspan=3>4. Berapa nilai Rata UN Anda ketika SMA?</td>        
				</tr>
				<tr>
					<td> &nbsp;&nbsp;<input name='rataUN' type='text' style="width:50px;" required="required"> </td>
				</tr>		
				<tr>
					<td colspan=3>5. Apa status kerja Anda?</td>
				</tr>
				<tr>			
					<td> &nbsp;&nbsp;<input type='radio' name='kerja' value='Sudah' required="required">Sudah </td>
					<td> <input type='radio' name='kerja' value='Belum'>Belum </td>
				</tr>
				<tr>
					<td colspan=4>6. Siapa yang memotivasi Anda untuk memilih kuliah?</td>        
				</tr>
				<tr>			
					<td> &nbsp;&nbsp;<input type='radio' name='motivasi' value='Sendiri' required="required">Sendiri </td>
					<td> <input type='radio' name='motivasi' value='OrangTua'>Orang tua </td>
					<td> <input type='radio' name='motivasi' value='OrangLain'>Orang lain </td>
				</tr>		
				<tr>
					<td colspan=2>
						<input type=submit name=submit value=Submit >
						<input type='reset' value='Batal'>
					</td>
				</tr>
			</table>
		</form>

		<?php
		}else{
			$n_instansi = $_POST['instansi'];
			$n_status = $_POST['status'];
			$n_jurusan = $_POST['jurusan'];
			$n_rataUN = $_POST['rataUN'];
			$n_kerja = $_POST['kerja'];
			$n_motivasi = $_POST['motivasi'];
			echo "<h4><center>Hasil Jawaban Anda...<br>";
			echo "Instansi: ".$n_instansi."<br>";
			echo "Status: ".$n_status."<br>";
			echo "Jurusan: ".$n_jurusan."<br>";
			echo "Rata UN: ".$n_rataUN."<br>";
			echo "Kerja: ".$n_kerja."<br>";
			echo "Motivasi: ".$n_motivasi."<br><br><br></center></h4>";	
					
			$sql=mysql_query("SELECT * FROM pohon_keputusan");	
			$id_rule="";
			$keputusan="";
			while($row=mysql_fetch_array($sql)){
				//menggabungkan parent dan akar dengan kata AND
				if($row[1]!=''){
					$rule=$row[1]." AND ".$row[2];
				}else{
					$rule=$row[2];
				}
				//mengubah parameter
				$rule=str_replace("<="," k ",$rule);
				$rule=str_replace("="," s ",$rule);
				$rule=str_replace(">"," l ",$rule);		
				//mengganti nilai
				$rule=str_replace("instansi","'$n_instansi'",$rule);
				$rule=str_replace("status","'$n_status'",$rule);
				$rule=str_replace("jurusan","'$n_jurusan'",$rule);
				$rule=str_replace("rata_un","$n_rataUN",$rule);
				$rule=str_replace("kerja","'$n_kerja'",$rule);
				$rule=str_replace("motivasi","'$n_motivasi'",$rule);		
				//menghilangkan '
				$rule=str_replace("'","",$rule);
				//menggabungkan kata ortu dan orang lain
				$rule=str_replace("Orang Tua","OrangTua",$rule);
				$rule=str_replace("Orang Lain","OrangLain",$rule);
				//explode and
				$explodeAND = explode(" AND ",$rule);
				$jmlAND = count($explodeAND);				
				//menghilangkan ()
				$explodeAND=str_replace("(","",$explodeAND);
				$explodeAND=str_replace(")","",$explodeAND);			
				//deklarasi bol
				$bolAND=array();
				$n=0;
				while($n<$jmlAND){
					//explode or
					$explodeOR = explode(" OR ",$explodeAND[$n]);
					$jmlOR = count($explodeOR);	
					//deklarasi bol
					$bol=array();
					$a=0;
					while($a<$jmlOR){				
						//pecah  dengan spasi
						$exrule2 = explode(" ",$explodeOR[$a]);
						$parameter = $exrule2[1];				
						if($parameter=='s'){
							//pecah  dengan s
							$explodeRule = explode(" s ",$explodeOR[$a]);
							//nilai true false						
							if($explodeRule[0]==$explodeRule[1]){
								$bol[$a]="Benar";
							}else if($explodeRule[0]!=$explodeRule[1]){
								$bol[$a]="Salah";
							}
						}else if($parameter=='k'){
							//pecah  dengan k
							$explodeRule = explode(" k ",$explodeOR[$a]);
							//nilai true false
							if($explodeRule[0]<=$explodeRule[1]){
								$bol[$a]="Benar";
							}else{
								$bol[$a]="Salah";
							}
						}else if($parameter=='l'){
							//pecah dengan s
							$explodeRule = explode(" l ",$explodeOR[$a]);
							//nilai true false
							if($explodeRule[0]>$explodeRule[1]){
								$bol[$a]="Benar";
							}else{
								$bol[$a]="Salah";
							}
						}
						//cetak nilai bolean				
						$a++;
					}
					//isi false
					$bolAND[$n]="Salah";
					$b=0;			
					while($b<$jmlOR){
						//jika $bol[$b] benar bolAND benar
						if($bol[$b]=="Benar"){
							$bolAND[$n]="Benar";
						}
						$b++;
					}			
					$n++;
				}
				//isi boolrule
				$boolRule="Benar";
				$a=0;
				while($a<$jmlAND){			
					//jika ada yang salah boolrule diganti salah
					if($bolAND[$a]=="Salah"){
						$boolRule="Salah";
					}						
					$a++;
				}		
				if($boolRule=="Benar"){
					$keputusan=$row[3];
					$id_rule=$row[0];
				}			
			}				
			
			if($keputusan==''){
				$que=mysql_query("SELECT parent FROM pohon_keputusan");				
				$jml=array();
				$exParent=array();
				$i=0;
				while($bar=mysql_fetch_array($que)){
					$exParent=explode(" AND ",$bar['parent']);								
					$jml[$i] = count($exParent);	
					$i++;
				}
				$maxParent=max($jml);
				$sql_query=mysql_query("SELECT * FROM pohon_keputusan");				
				while($bar_row=mysql_fetch_array($sql_query)){
					$explP=explode(" AND ",$bar_row['parent']);
					$jmlT=count($explP);
					if($jmlT==$maxParent){
						$keputusan=$bar_row['keputusan'];
						$id_rule=$bar_row['id'];
					}
				}			
				echo "<h1><center>Anda diprediksi memiliki prestasi ".$keputusan."</center></h1>";			
				echo "<h4><center>Rule terpilih adalah rule yang terakhir karena tidak memenuhi semua rule</center></h4>";	
				mysql_query("INSERT INTO hasil_prediksi (nim,instansi,status,jurusan,rata_un,kerja,motivasi,hasil) VALUES 
				('$nim','$n_instansi','$n_status','$n_jurusan','$n_rataUN','$n_kerja','$n_motivasi','$keputusan')");
			}else{
				echo "<h1><center>Anda diprediksi memiliki prestasi ".$keputusan."</center></h1>";
				$sql_que=mysql_query("SELECT * FROM pohon_keputusan WHERE id=$id_rule");			
				$row_bar=mysql_fetch_array($sql_que);
				$rule_terpilih = "IF ".$row_bar[1]." AND ".$row_bar[2]." THEN prestasi = ".$row_bar[3];
				echo "<h4><center>Rule yang terpilih adalah rule ke-".$row_bar[0]."<br>".$rule_terpilih."</center></h4>";	
				mysql_query("INSERT INTO hasil_prediksi (nim,instansi,status,jurusan,rata_un,kerja,motivasi,hasil) VALUES 
				('$nim','$n_instansi','$n_status','$n_jurusan','$n_rataUN','$n_kerja','$n_motivasi','$keputusan')");				
			}		
		}
	}
}
?>