<?php
//KONVERSI PHP KE PHP 7
require_once "parser-php-version.php";

	$host="localhost";
	$user="root";
	$password="";
	$database="c45";
	$koneksi=mysql_connect($host,$user,$password);
	mysql_select_db($database,$koneksi);
?>