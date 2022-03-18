<?php
	session_start();
	unset($_SESSION['ID_Dono']);
	header("location: ../View/TelaLoginDono.php");
?>