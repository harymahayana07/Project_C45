<?php
	$awal = microtime(true); 
	include 'koneksi.php';
	include 'fungsi.php';
	mysql_query("TRUNCATE pohon_keputusan");	
	pembentukan_tree("","");
	echo "<br><h1><center>---PROSES SELESAI---</center></h1>";
	echo "<center><a href='index.php?menu=tree' accesskey='5' title='pohon keputusan'>Lihat pohon keputusan yang terbentuk</a></center>";
	
	$akhir = microtime(true);
	$lama = $akhir - $awal;
	//echo "<br>Lama eksekusi script adalah: ".$lama." detik";
		
	
	//fungsi utama
	function proses_DT($parent , $kasus_cabang1 , $kasus_cabang2){	
		echo "cabang 1<br>";
		pembentukan_tree($parent , $kasus_cabang1);		
		echo "cabang 2<br>";
		pembentukan_tree($parent , $kasus_cabang2);		
	}		
	
	function pangkas($PARENT, $KASUS, $LEAF){
		//PEMANGKASAN CABANG
		$sql_pangkas = mysql_query("SELECT * FROM pohon_keputusan WHERE parent=\"$PARENT\" AND keputusan=\"$LEAF\"");
		$row_pangkas = mysql_fetch_array($sql_pangkas);
		$jml_pangkas = mysql_num_rows($sql_pangkas);
		//jika keputusan dan parent belum ada maka insert
		if($jml_pangkas==0){			
			mysql_query("INSERT INTO pohon_keputusan (parent,akar,keputusan)VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")");
		}
		//jika keputusan dan parent sudah ada maka delete
		else{			
			mysql_query("DELETE FROM pohon_keputusan WHERE id='$row_pangkas[0]'");
			
			$exPangkas = explode(" AND ",$PARENT);
			$jmlEXpangkas = count($exPangkas);
			$temp=array();
			for($a=0;$a<($jmlEXpangkas-1);$a++){
				$temp[$a]=$exPangkas[$a];
			}
			$imPangkas = implode(" AND ",$temp);
			$akarPangkas = $exPangkas[$jmlEXpangkas-1];
			
			$que_pangkas = mysql_query("SELECT * FROM pohon_keputusan WHERE parent=\"$imPangkas\" AND keputusan=\"$LEAF\"");
			$baris_pangkas = mysql_fetch_array($que_pangkas);
			$jumlah_pangkas = mysql_num_rows($que_pangkas);
			
			if($jumlah_pangkas==0){		
				mysql_query("INSERT INTO pohon_keputusan (parent,akar,keputusan)VALUES (\"$imPangkas\" , \"$akarPangkas\" , \"$LEAF\")");
				//mysql_query("UPDATE pohon_keputusan SET parent=\"$imPangkas\" , akar=\"$akarPangkas\" , keputusan=\"$LEAF\" WHERE id=\"$row_pangkas[0]\"");
			}else{
				pangkas($imPangkas,$akarPangkas,$LEAF);
			}								
		}
		echo "Keputusan = ".$LEAF."<br>================================<br>";		
	}
	
	//fungsi proses dalam suatu kasus data
	function pembentukan_tree($N_parent , $kasus){
		//mengisi kondisi
		if($N_parent!=''){
			$kondisi = $N_parent." AND ".$kasus;
		}else{
			$kondisi = $kasus;
		}		
		echo $kondisi."<br>";
		//cek data heterogen / homogen???
		$cek = cek_heterohomogen('ipk',$kondisi);		
		if($cek=='homogen'){
			echo "<br>LEAF ";
			$sql_keputusan = mysql_query("SELECT DISTINCT(ipk) FROM data_training WHERE $kondisi");
			$row_keputusan = mysql_fetch_array($sql_keputusan);	
			$keputusan = $row_keputusan['0'];
			//insert atau lakukan pemangkasan cabang
			pangkas($N_parent , $kasus , $keputusan);
			
		}//jika data masih heterogen
		else if($cek=='heterogen'){
			//cek jumlah data
			$jumlah = jumlah_data($kondisi);				
			if($jumlah<8){
				echo "<br>LEAF ";
				$Ntinggi = $kondisi." AND ipk='tinggi'";
				$Nrendah = $kondisi." AND ipk='rendah'";
				$jumlahTinggi = jumlah_data("$Ntinggi");
				$jumlahRendah = jumlah_data("$Nrendah");				
				if($jumlahTinggi <= $jumlahRendah){
					$keputusan = 'Rendah';
				}else{
					$keputusan = 'Tinggi';
				}				
				//insert atau lakukan pemangkasan cabang
				pangkas($N_parent , $kasus , $keputusan);		
			}
			//lakukan perhitungan
			else{			
				//jika kondisi tidak kosong kondisi_ipk=tambah and
				$kondisi_ipk='';
				if($kondisi!=''){
					$kondisi_ipk=$kondisi." AND ";
				}
				$jml_tinggi = jumlah_data("$kondisi_ipk ipk='Tinggi'");
				$jml_rendah = jumlah_data("$kondisi_ipk ipk='Rendah'");
				$jml_total = $jml_tinggi + $jml_rendah;
				echo "Jumlah data = ".$jml_total."<br>";
				echo "Jumlah tinggi = ".$jml_tinggi."<br>";
				echo "Jumlah rendah = ".$jml_rendah."<br>";
				
				//hitung entropy semua
				$entropy_all = hitung_entropy($jml_tinggi , $jml_rendah);
				echo "Entropy = ".$entropy_all."<br>";
				
				//cek berapa nilai setiap atribut
				$nilai_instansi = array();
				$nilai_instansi = cek_nilaiAtribut('instansi',$kondisi);								
				$jmlInstansi = count($nilai_instansi);								
				$nilai_status = array();
				$nilai_status = cek_nilaiAtribut('status',$kondisi);								
				$jmlStatus = count($nilai_status);
				$nilai_jurusan = array();
				$nilai_jurusan = cek_nilaiAtribut('jurusan',$kondisi);								
				$jmlJurusan = count($nilai_jurusan);
				$nilai_kerja = array();
				$nilai_kerja = cek_nilaiAtribut('kerja',$kondisi);								
				$jmlKerja = count($nilai_kerja);
				$nilai_motivasi = array();
				$nilai_motivasi = cek_nilaiAtribut('motivasi',$kondisi);								
				$jmlMotivasi = count($nilai_motivasi);				
							
			//hitung gain atribut
				mysql_query("TRUNCATE gain");
				//instansi
				if($jmlInstansi!=1){
					$NA1Instansi="instansi='$nilai_instansi[0]'";
					$NA2Instansi="";
					$NA3Instansi="";
					if($jmlInstansi==2){
						$NA2Instansi="instansi='$nilai_instansi[1]'";
					}else if ($jmlInstansi==3){
						$NA2Instansi="instansi='$nilai_instansi[1]'";
						$NA3Instansi="instansi='$nilai_instansi[2]'";
					}				
					hitung_gain($kondisi , "instansi"	, $entropy_all , $NA1Instansi, $NA2Instansi, $NA3Instansi, "" , "");	
				}
				//status
				if($jmlStatus!=1){
					$NA1Status="status='$nilai_status[0]'";
					$NA2Status="status='$nilai_status[1]'";
					hitung_gain($kondisi , "status" , $entropy_all , $NA1Status , $NA2Status , "" , "" , "");
				}
				//jurusan
				if($jmlJurusan!=1){
					$NA1Jurusan="jurusan='$nilai_jurusan[0]'";
					$NA2Jurusan="";
					$NA3Jurusan="";
					$NA4Jurusan="";
					$NA5Jurusan="";
					if($jmlJurusan==2){
						$NA2Jurusan="jurusan='$nilai_jurusan[1]'";
					}else if($jmlJurusan==3){
						$NA2Jurusan="jurusan='$nilai_jurusan[1]'";
						$NA3Jurusan="jurusan='$nilai_jurusan[2]'";
					}else if($jmlJurusan==4){
						$NA2Jurusan="jurusan='$nilai_jurusan[1]'";
						$NA3Jurusan="jurusan='$nilai_jurusan[2]'";
						$NA4Jurusan="jurusan='$nilai_jurusan[3]'";
					}else if($jmlJurusan==5){
						$NA2Jurusan="jurusan='$nilai_jurusan[1]'";
						$NA3Jurusan="jurusan='$nilai_jurusan[2]'";
						$NA4Jurusan="jurusan='$nilai_jurusan[3]'";
						$NA5Jurusan="jurusan='$nilai_jurusan[4]'";
					}
					hitung_gain($kondisi , "jurusan" , $entropy_all , $NA1Jurusan , $NA2Jurusan , $NA3Jurusan , $NA4Jurusan , $NA5Jurusan);
				}				
				//kerja
				if($jmlKerja!=1){
					$NA1Kerja="kerja='$nilai_kerja[0]'";
					$NA2Kerja="kerja='$nilai_kerja[1]'";
					hitung_gain($kondisi , "kerja"	 , $entropy_all , $NA1Kerja , $NA2Kerja , "" , "" , "");
				}
				//motivasi
				if($jmlMotivasi!=1){
					$NA1Motivasi="motivasi='$nilai_motivasi[0]'";
					$NA2Motivasi="";
					$NA3Motivasi="";
					if($jmlMotivasi==2){
						$NA2Motivasi="motivasi='$nilai_motivasi[1]'";
					}else if ($jmlMotivasi==3){
						$NA2Motivasi="motivasi='$nilai_motivasi[1]'";
						$NA3Motivasi="motivasi='$nilai_motivasi[2]'";
					}
					hitung_gain($kondisi , "motivasi" , $entropy_all , $NA1Motivasi, $NA2Motivasi, $NA3Motivasi, "" , "");
				}																																				
				//hitung gain atribut Numerik										
					hitung_gain($kondisi , "rata UN posisi 6.5"	, $entropy_all , "rata_un<=6.5"	, "rata_un>6.5" , "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 6.75"	, $entropy_all , "rata_un<=6.75", "rata_un>6.75", "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 7"		, $entropy_all , "rata_un<=7"	, "rata_un>7"	, "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 7.25"	, $entropy_all , "rata_un<=7.25", "rata_un>7.25", "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 7.5" 	, $entropy_all , "rata_un<=7.5" , "rata_un>7.5" , "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 7.75"	, $entropy_all , "rata_un<=7.75", "rata_un>7.75", "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 8"		, $entropy_all , "rata_un<=8"	, "rata_un>8" 	, "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 8.25"	, $entropy_all , "rata_un<=8.25", "rata_un>8.25", "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 8.5"	, $entropy_all , "rata_un<=8.5" , "rata_un>8.5" , "" , "" , "");
					hitung_gain($kondisi , "rata UN posisi 8.75"	, $entropy_all , "rata_un<=8.75", "rata_un>8.75", "" , "" , "");
					
				//ambil nilai gain tertinggi
					$sql_max = mysql_query("SELECT MAX(gain) FROM gain");
					$row_max = mysql_fetch_array($sql_max);	
					$max_gain = $row_max['0'];
					$sql = mysql_query("SELECT * FROM gain WHERE gain=$max_gain");
					$row = mysql_fetch_array($sql);	
					$atribut = $row['1'];
					echo "Atribut terpilih = ".$atribut.", dengan nilai gain = ".$max_gain."<br>";					
					echo "<br>================================<br>";
				//percabangan jika nilai atribut lebih dari 2 hitung rasio terlebih dahulu
				//INSTANSI TERPILIH
				if($atribut=="instansi"){
					//jika nilai atribut 3
					if($jmlInstansi==3){
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi , 'instansi',$max_gain,$nilai_instansi[0],$nilai_instansi[1],$nilai_instansi[2],'','');
						$exp_cabang = explode(" , ",$cabang[1]);						
						proses_DT($kondisi , "($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");						
					}
					//jika nilai atribut 2
					else if($jmlInstansi==2){
						proses_DT($kondisi , "($atribut='$nilai_instansi[0]')" , "($atribut='$nilai_instansi[1]')");
					}
				}				
				//STATUS TERPILIH
				else if($atribut=="status"){					
					proses_DT($kondisi , "($atribut='Negeri')","($atribut='Swasta')");										
				}
				//JURUSAN TERPILIH
				else if($atribut=="jurusan"){
					//jika nilai atribut 5
					if($jmlJurusan==5){
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi , 'jurusan',$max_gain,$nilai_jurusan[0],$nilai_jurusan[1],$nilai_jurusan[2],$nilai_jurusan[3],$nilai_jurusan[4]);
						$exp_cabang = explode(" , ",$cabang[1]);						
						proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
					}					
					//jika nilai atribut 4
					else if($jmlJurusan==4){
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi , 'jurusan',$max_gain,$nilai_jurusan[0],$nilai_jurusan[1],$nilai_jurusan[2],$nilai_jurusan[3],'');
						$exp_cabang = explode(" , ",$cabang[1]);
						proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
					}					
					//jika nilai atribut 3
					else if($jmlJurusan==3){
						//hitung rasio
						$cabang = array();
						$cabang = hitung_rasio($kondisi , 'jurusan',$max_gain,$nilai_jurusan[0],$nilai_jurusan[1],$nilai_jurusan[2],'','');
						$exp_cabang = explode(" , ",$cabang[1]);
						proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
					}
					//jika nilai atribut 2
					else if($jmlJurusan==2){
						proses_DT($kondisi,"($atribut='$nilai_jurusan[0]')" , "($atribut='$nilai_jurusan[1]')");
					}
				}
				//RATA UN TERPILIH
				else if($atribut=="rata UN posisi 6.5"){					
					proses_DT($kondisi,"(rata_un<=6.5)","(rata_un>6.5)");					
				}
				else if($atribut=="rata UN posisi 6.75"){					
					proses_DT($kondisi,"(rata_un<=6.75)","(rata_un>6.75)");					
				}
				else if($atribut=="rata UN posisi 7"){					
					proses_DT($kondisi,"(rata_un<=7)","(rata_un>7)");					
				}
				else if($atribut=="rata UN posisi 7.25"){					
					proses_DT($kondisi,"(rata_un<=7.25)","(rata_un>7.25)");					
				}
				else if($atribut=="rata UN posisi 7.5"){					
					proses_DT($kondisi,"(rata_un<=7.5)","(rata_un>7.5)");			
				}
				else if($atribut=="rata UN posisi 7.75"){					
					proses_DT($kondisi,"(rata_un<=7.75)","(rata_un>7.75)");					
				}
				else if($atribut=="rata UN posisi 8"){					
					proses_DT($kondisi,"(rata_un<=8)","(rata_un>8)");					
				}
				else if($atribut=="rata UN posisi 8.25"){					
					proses_DT($kondisi,"(rata_un<=8.25)","(rata_un>8.25)");					
				}
				else if($atribut=="rata UN posisi 8.5"){					
					proses_DT($kondisi,"(rata_un<=8.5)","(rata_un>8.5)");					
				}
				else if($atribut=="rata UN posisi 8.75"){					
					proses_DT($kondisi,"(rata_un<=8.75)","(rata_un>8.75)");					
				}
				//KERJA TERPILIH
				else if($atribut=="kerja"){					
					proses_DT($kondisi,"($atribut='Sudah')","($atribut='Belum')");					
				}
				//MOTIVASI TERPILIH
				else if($atribut=="motivasi"){
					//jika nilai atribut 3
					if($jmlMotivasi==3){
						$cabang = array();
						$cabang = hitung_rasio($kondisi , 'motivasi',$max_gain,$nilai_motivasi[0],$nilai_motivasi[1],$nilai_motivasi[2],'','');
						$exp_cabang = explode(" , ",$cabang[1]);							
						proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");						
					}
					//jika nilai atribut 2
					else if($jmlMotivasi==2){
						proses_DT($kondisi,"($atribut='$nilai_motivasi[0]')" , "($atribut='$nilai_motivasi[1]')");
					}
				}				
			}
		}						
	}
?>