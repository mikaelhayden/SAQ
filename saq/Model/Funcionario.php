<?php

Class Funcionario
{
	private $pdo;

	public function cadastrar($nome, $email, $senha, $telefone, $inicio_expediente, $fim_expediente)
	{		
		global $pdo;
		$sql=$pdo->prepare("SELECT ID_Funcionario FROM funcionario WHERE Email_funcionario = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			return false;
		}
		else
		{
			$sql=$pdo->prepare("INSERT INTO funcionario(Nome_Funcionario, Email_Funcionario, Senha_Funcionario, Telefone_Funcionario, Inicio_Expediente, Fim_Expediente) VALUES(:n, :e, :s, :t, :ie, :fe)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":ie", $inicio_expediente);
			$sql->bindValue(":fe", $fim_expediente);
			$sql->execute();
			return true;
		}
	}
	public function logar($email, $senha)
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Funcionario FROM funcionario WHERE Email_funcionario = :e AND Senha_funcionario = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			//entrar no sistema (sessão)
			$dado=$sql->fetch();
			session_start();
			$_SESSION['ID_Funcionario']=$dado['ID_Funcionario'];
			return true;//logado com sucesso
		}
		else
		{
			return false; //nao foi possivel logar
		}
	}
	public function relatorios($Email_cliente)
	{		
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e");
	    $sql->bindValue(":e", $Email_cliente);
	    $sql->execute();	
        if($sql->rowCount()>0)
        {
        	while(list($ID_Cliente)=$sql->fetch())
            {
				$sql=$pdo->prepare("SELECT Inicio_Reserva, Fim_Reserva, Data_Reserva, Nome_cliente FROM cliente INNER JOIN horario_reserva ON cliente.ID_Cliente = horario_reserva.ID_Cliente WHERE horario_reserva.ID_Cliente = :id"); //Comando sql (Selecionar registro)								
				//Substitui as variáveis
				$sql->bindValue(":id", $ID_Cliente);
				$sql->execute(); //Executa o comando o sql e retorna alguma coisa

				$tabela_reserva="";
				if($sql->rowCount()>0)
				{
					$tabela_reserva = "<table>";
					$tabela_reserva.="
					
					<thead>
						<tr>
							<th>Cliente</th>
							<th>Inicio da Reserva</th>
							<th>Fim da Reserva</th>
							<th>Data da Reserva</th>
						</tr>
					</thead>	
					";
					while(list($Inicio_Reserva, $Fim_Reserva, $Data_Reserva, $Nome_cliente)=$sql->fetch())
					{
						$Data_Reserva=date('d/m/Y', strtotime($Data_Reserva));
            			$tabela_reserva.=" 
						        			
							<tr>
							<th>$Nome_cliente</th>
							<th>$Inicio_Reserva</th>
							<th>$Fim_Reserva</th>
							<th>$Data_Reserva</th>
							</tr>
							
						";
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
		}				
	}
	
	public function updateSenha($novaSenha, $confirmarSenha, $email_cookie)
	{		
		global $pdo;
		if ($novaSenha == $confirmarSenha)
    	{
			$sql = $pdo->prepare("UPDATE funcionario SET Senha_Funcionario = :sa WHERE Email_Funcionario = :e"); //UPDATE
			$sql->bindValue(":sa", $novaSenha);
			$sql->bindValue(":e", $email_cookie);
			$sql->execute();
			if($sql->rowCount()>0)
			{
				echo "<script> alert('Senha Atualizada, entre com a nova senha!'); window.location.href='TelaLoginFuncionario.php'; </script>";
			}		
			else
			{
				echo "<div id='erro'><p>Não Foi Possivel Atualizar!</p></div>";	
			}
		}
		else
		{
			echo "<div id='erro'><p>Senhas não correspondem!</p></div>";
		}
	}

	public function updateCadastro($nome, $telefone, $inicio_expediente, $fim_expediente, $email_cookie)
	{		
		global $pdo;
		
		$sql=$pdo->prepare("UPDATE funcionario SET Nome_Funcionario = :n, Telefone_Funcionario = :t, Inicio_Expediente = :ie, Fim_Expediente = :fe WHERE Email_Funcionario = :ek");
		$sql->bindValue(":n", $nome);		
		$sql->bindValue(":t", $telefone);
		$sql->bindValue(":ie", $inicio_expediente);
		$sql->bindValue(":fe", $fim_expediente);
		$sql->bindValue(":ek", $email_cookie);
		$sql->execute();
		if($sql->rowCount()>0)
		{		
			return true;	
		}
		else
		{
			return false;
		}		
	}
} 

?>