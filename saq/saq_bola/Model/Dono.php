<?php

Class Dono
{
	private $pdo;

	public function cadastrar($nome, $cpf, $email, $senha, $telefone, $nome_quadra, $ag_Conta_dono, $num_Conta_dono, $banco, $tipo_Conta_dono)
	{		
		global $pdo;
		$sql=$pdo->prepare("SELECT ID_Dono FROM dono WHERE Email_dono = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			return false;
		}
		else
		{
			$sql=$pdo->prepare("INSERT INTO dono(Nome_dono, CPF_dono, Email_dono, Senha_dono, Telefone_dono, Nome_quadra, Ag_Conta_dono, Num_Conta_dono, Banco, Tipo_Conta_dono) VALUES(:n, :cpf, :e, :s, :t, :nq, :acd, :ncd, :b, :tcd)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":cpf", $cpf);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":nq", $nome_quadra);
			$sql->bindValue(":acd", $ag_Conta_dono);
			$sql->bindValue(":ncd", $num_Conta_dono);
			$sql->bindValue(":b", $banco);
			$sql->bindValue(":tcd", $tipo_Conta_dono);
			$sql->execute();
			return true;
		}
	}
	public function logar($email, $senha)
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Dono FROM dono WHERE Email_dono = :e AND Senha_dono = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			//entrar no sistema (sessão)
			$dado=$sql->fetch();
			session_start();
			$_SESSION['ID_Dono']=$dado['ID_Dono'];
			return true;//logado com sucesso
		}
		else
		{
			return false; //nao foi possivel logar
		}
	}	
} 

?>