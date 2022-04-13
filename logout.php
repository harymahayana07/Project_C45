<?php
    session_start();
    unset($_SESSION['usr']);
    unset($_SESSION['pwd']);
	unset($_SESSION['lvl']);
    session_destroy();
    header("location:login-form.php");
?>