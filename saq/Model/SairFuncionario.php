<?php
	session_start();
	unset($_SESSION['ID_Funcionario']);
	header("location: ../View/TelasFuncionario/TelaLoginFuncionario.php");
?>