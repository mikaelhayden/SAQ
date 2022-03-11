<?php

Class Conexao
{
	private $pdo;
	public $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		//global $msgErro;
		try
		{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
		}
		catch (PDOException $e) 
		{
			$msgErro=$e->getMessage();
		}
	}
}

?>