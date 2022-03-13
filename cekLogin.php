<?php
	include "koneksi.php";
    $userID=$_POST['user'];
    $password=$_POST['pass'];
    $query=mysql_query("select * from user where user_id='$userID' and password='$password'");    
    if (mysql_num_rows($query)==0){
        ?>
		User dan Password tidak cocok <a href="login.php">Kembali</a></div><?php
    }
    else{
        while($row=mysql_fetch_array($query)){
            session_start();
            $_SESSION['usr']=$row['user_id'];
			$_SESSION['nama']=$row['nama'];
            $_SESSION['pwd']=$row['password'];
			$_SESSION['lvl']=$row['type'];
            header("location:dashboard.php");
        }
    }
?>

