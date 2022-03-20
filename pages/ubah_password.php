<?php
if (isset($_POST['submit'])) {
	include "koneksi.php";
	$lama = $_POST['lama'];
	$baru = $_POST['baru'];
	$konfirm = $_POST['konfirm'];
	$sql = mysql_query("SELECT * FROM user WHERE password='$lama'");
	$row = mysql_fetch_array($sql);
	if (mysql_num_rows($sql) == 1) {                      
		if($baru==$konfirm){
			mysql_query("UPDATE user SET password='$baru' WHERE user_id='$row[0]'");
			echo "Berhasil ubah password";
		}else{
			echo "Password baru Anda tidak sama dengan konfirmasi password..";
		}
	}else{
		echo "Password lama Anda salah..";
	}   
}else{
?>
	<form method=POST action='' >
		<table align='center' >
			
			<tr>
				<td>Password Lama</td>        
				<td>: </td>
				<td> <input name='lama' type='text' style="width:250px;" required="required"> </td>			
			</tr>
			<tr>
				<td>Password Baru</td>        
				<td>: </td>
				<td> <input name='baru' type='password' style="width:250px;" required="required"> </td>			
			</tr>		
			<tr>
				<td>Password Konfirmasi</td>        
				<td>: </td>
				<td> <input name='konfirm' type='password' style="width:250px;" required="required"> </td>
			</tr>					
			<tr>
				<td>
					<input type=submit name=submit value=Submit>
					<input type='reset' value='Batal'>
				</td>
			</tr>
		</table>
	</form>
<?php
}
?>