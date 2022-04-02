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
	public function groupby()
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT Data_Reserva, COUNT(Data_Reserva) AS cont_Data_Reserva FROM `horario_reserva` GROUP BY Data_Reserva");
		$sql->execute();

		$tabela_reserva="";
		if($sql->rowCount()>0)
		{
			$tabela_reserva = "<font color='black'><center><table border=3>";
			$tabela_reserva.="
					
			<tr>
				<th>Data da reserva</th>
				<th>Quantidade de reservas</th>	
			</tr>";

			while(list($Data_Reserva, $q)=$sql->fetch())
			{
				$Data_Reserva=date('d/m/Y', strtotime($Data_Reserva));
            	$tabela_reserva.=" 
						        			
				<tr>
					<th>$Data_Reserva</th>
					<th>$q</th>				
				</tr>";
			}
			$tabela_reserva.="</table></font>";

			if($tabela_reserva!="")
			{
				echo $tabela_reserva;	        				
          		return true;     				
			}
			else
			{
				
				return false;
			}
		}
	}
	public function union()
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT Nome_cliente, Email_cliente, Telefone_cliente FROM cliente UNION
		SELECT Nome_Funcionario, Email_Funcionario, Telefone_Funcionario FROM funcionario");
		$sql->execute();

		$tabela_union="";
		if($sql->rowCount()>0)
		{
			$tabela_union = "<font color='black'><center><table border=3>";
			$tabela_union.="
					
			<tr>
				<th>Nomes</th>
				<th>Email</th>
				<th>Contatos</th>		
			</tr>";

			while(list($nome, $email, $telefone)=$sql->fetch())
			{
            	$tabela_union.=" 
						        			
				<tr>
					<th>$nome</th>
					<th>$email</th>
					<th>$telefone</th>		
				</tr>";
			}
			$tabela_union.="</table></font>";

			if($tabela_union!="")
			{
				echo $tabela_union;	        				
          		return true;     				
			}
			else
			{
				return false;
			}
		}
	}
	public function like($letra)
	{		
		global $pdo;	
        
    	$sql=$pdo->prepare("SELECT Nome_cliente, Email_cliente FROM cliente WHERE Nome_cliente LIKE '$letra%'"); //Comando sql (Selecionar registro)								
		$sql->execute();

		$tabela="";
		if($sql->rowCount()>0)
		{
			$tabela = "<font color='black'><center><table border=3>";
			$tabela.="
					
			<tr>
				<th>Nomes</th>
				<th>Email</th>
		
			</tr>";

			while(list($nome, $email)=$sql->fetch())
			{
            	$tabela.=" 
						        			
				<tr>
					<th>$nome</th>
					<th>$email</th>
						
				</tr>";
			}
			$tabela.="</table></font>";

			if($tabela!="")
			{
				echo $tabela;	        				
          		return true;     				
			}
			else
			{
				return false;
			}
		}
	}						
}

?>