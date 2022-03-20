<a href="?menu=tree" >Lihat Rule/Aturan yang terbentuk</a><br><br>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "koneksi.php";
//select id dari pohon keputusan
$que_sql=mysql_query("SELECT id FROM pohon_keputusan");
$id=array();$l=0;
while($bar_row=mysql_fetch_array($que_sql)){
	$id[$l]=$bar_row[0];	
	$l++;
}

$query = mysql_query("SELECT * FROM pohon_keputusan ORDER BY(id)");
$temp_rule=array();
$temp_rule[0]='';
$ll=0;//variabel untuk iterasi id pohon keputusan
while($bar=mysql_fetch_array($query)){	
	//menampung rule
	if($bar[1]!=''){
		$rule=$bar[1]." AND ".$bar[2];
	}else{
		$rule=$bar[2];
	}
	
	$rule = str_replace("OR","/",$rule);
	//explode rule
	$exRule=explode(" AND ",$rule);
	$jml_ExRule=count($exRule);
	$jml_temp=count($temp_rule);
	
	$i=0;
	while($i<$jml_ExRule){				
		if($temp_rule[$i]==$exRule[$i]){
			$temp_rule[$i]=$exRule[$i];
			$exRule[$i]="---- ";
		}else{
			$temp_rule[$i]=$exRule[$i];
		}				
		
		if($i==($jml_ExRule-1)){
			$t=$i;
			while($t<$jml_temp){
				$temp_rule[$t]="";
				$t++;
			}
		}
				
		//jika terakhir tambah cetak keputusan
		if($i==($jml_ExRule-1)){			
			$strip='';
			for($x=1;$x<=$i;$x++){
				$strip=$strip."---- ";
			}
			$sql_que=mysql_query("SELECT keputusan FROM pohon_keputusan WHERE id=$id[$ll]");
			$row_bar=mysql_fetch_array($sql_que);
			if($exRule[$i-1]=="---- "){
				echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <i>Maka prestasi = </i><strong>".$row_bar[0]." (".$id[$ll].")</strong>";
			}else if($exRule[$i-1]!="---- "){
				echo "<br>".$strip."<font color='#336699'><b>".$exRule[$i]."</b></font> <i>Maka prestasi = </i><strong>".$row_bar[0]."  (".$id[$ll].")</strong>";
			}
		}
		//jika pertama
		else if($i==0){
			if($ll==1){
				echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <b>: ?</b>";
			}else{
				echo $exRule[$i]." ";
			}			
		}
		//jika ditengah
		else{
			if($exRule[$i]=="---- "){
				echo $exRule[$i]." ";
			}else{
				if($exRule[$i-1]=="---- "){
					echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <b>: ?</b>";
				}else{
					$strip='';
					for($x=1;$x<=$i;$x++){
						$strip=$strip."---- ";
					}
					echo "<br>".$strip."<font color='#336699'><b>".$exRule[$i]."</b></font> <b>: ?</b>";
				}				
			}			
		}
		$i++;
	}
	echo "<br>";
	$ll++;
}
?>		