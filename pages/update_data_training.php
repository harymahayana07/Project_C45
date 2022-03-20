<?php
$sql = mysql_query("SELECT * FROM data_training WHERE id='$_GET[id]'");
$row = mysql_fetch_array($sql);	
$instansi=$row[1];
$status=$row[2];
$jurusan=$row[3];
$rataUN=$row[4];
$kerja=$row[5];
$motivasi=$row[6];
$ipk=$row[7];
if (isset($_POST['submit'])) {
	mysql_query("UPDATE data_training SET 
		instansi = '$_POST[instansi]',
		status = '$_POST[status]',
		jurusan = '$_POST[jurusan]',
		rata_un = '$_POST[rataUN]',
		kerja = '$_POST[kerja]',
		motivasi = '$_POST[motivasi]',
		ipk = '$_POST[prestasi]'
		WHERE id      = '$_GET[id]'");
	echo "<center><h3>Berhasil update</h3></center>";
}else{
?>
<form method=POST action='' >
	<table align='center' >
		<tr>
			<td colspan=2><b><center>Edit Data Training</center></b></td>
		</tr>
		<tr>
			<td>Instansi</td>        
			<td>: </td>
			<td>	<input type='radio' name='instansi' value='SMA' <?php if($instansi=='SMA'){ echo 'checked'; } ?> >SMA </td>
			<td>	<input type='radio' name='instansi' value='SMK' <?php if($instansi=='SMK'){ echo 'checked'; } ?> >SMK </td>
			<td>	<input type='radio' name='instansi' value='MA' <?php if($instansi=='MA'){ echo 'checked'; } ?> >MA 	</td>						
		</tr>

		<tr>
			<td>Status</td>        
			<td>: </td>
			<td>	<input type='radio' name='status' value='Negeri' <?php if($status=='Negeri'){ echo 'checked'; } ?> >Negeri </td>
			<td>	<input type='radio' name='status' value='Swasta' <?php if($status=='Swasta'){ echo 'checked'; } ?> >Swasta </td>
		</tr>

		<tr>
			<td>Jurusan</td>        
			<td>: </td>
			<td>	<input type='radio' name='jurusan' value='IPA' <?php if($jurusan=='IPA'){ echo 'checked'; } ?> >IPA </td>
			<td>	<input type='radio' name='jurusan' value='IPS' <?php if($jurusan=='IPS'){ echo 'checked'; } ?> >IPS </td>
			<td>	<input type='radio' name='jurusan' value='Bahasa' <?php if($jurusan=='Bahasa'){ echo 'checked'; } ?> >Bahasa </td>
			<td>	<input type='radio' name='jurusan' value='Teknik' <?php if($jurusan=='Teknik'){ echo 'checked'; } ?> >Teknik </td>
			<td>	<input type='radio' name='jurusan' value='Administrasi' <?php if($jurusan=='Administrasi'){ echo 'checked'; } ?> >Administrasi </td>
		</tr>

		<tr>
			<td>Nilai Rata UN</td>        
			<td>: </td>
			<td>	<input name='rataUN' type='text' style="width:50px;" value=<?php echo $rataUN; ?> > </td>
		</tr>		

		<tr>
			<td>Kerja</td>        
			<td>: </td>
			<td>	<input type='radio' name='kerja' value='Sudah' <?php if($kerja=='Sudah'){ echo 'checked'; } ?> >Sudah </td>
			<td>	<input type='radio' name='kerja' value='Belum' <?php if($kerja=='Belum'){ echo 'checked'; } ?> >Belum </td>
		</tr>
		<tr>
			<td>Motivasi</td>        
			<td>: </td>
			<td>	<input type='radio' name='motivasi' value='Sendiri' <?php if($motivasi=='Sendiri'){ echo 'checked'; } ?> >Sendiri </td>
			<td>	<input type='radio' name='motivasi' value='Orang Tua' <?php if($motivasi=='Orang Tua'){ echo 'checked'; } ?> >Orang tua </td>
			<td>	<input type='radio' name='motivasi' value='Orang Lain' <?php if($motivasi=='Orang Lain'){ echo 'checked'; } ?> >Orang lain </td>
		</tr>
		<tr>
			<td><b>Prestasi</b></td>        
			<td>: </td>
			<td>	<input type='radio' name='prestasi' value='Tinggi' <?php if($ipk=='Tinggi'){ echo 'checked'; } ?> >Tinggi </td>
			<td>	<input type='radio' name='prestasi' value='Rendah' <?php if($ipk=='Rendah'){ echo 'checked'; } ?> >Rendah </td>
		</tr>
		<tr>
			<td colspan=2>
				<input type=submit name=submit value=Submit>
				<input type='reset' value='Batal'>
			</td>
		</tr>
	</table>
</form>
<?php
}
?>
<a href='index.php?menu=data' accesskey='5' title='Kembali'><< kembali</a>