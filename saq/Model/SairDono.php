<?php
	session_start();
	unset($_SESSION['ID_Dono']);
	header("location: ../View/TelasDono/TelaLoginDono.php");
?>