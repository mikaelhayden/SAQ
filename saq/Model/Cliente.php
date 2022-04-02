<?php

Class Cliente
{
	private $pdo;

	public function cadastrar($nome, $cpf, $email, $senha, $telefone)
	{		
		global $pdo;
		$sql=$pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e"); //Comando sql (consultar email)
		$sql->bindValue(":e", $email); //Substitui a variável
		$sql->execute(); //Executa o comando o sql e retorna alguma coisa
		if($sql->rowCount()>0) //Conta a quantidade de linhas que retornou do BD
		{
			return false; //Retorna falso, se esse email já tiver cadastrado no BD
		}
		else //Se o email não tiver cadastrado ainda, vai exutar o processo de cadastramento abaixo
		{
			$sql=$pdo->prepare("INSERT INTO cliente(Nome_cliente, CPF_Cliente, Email_cliente, Senha_cliente, Telefone_cliente) VALUES(:n, :cpf, :e, :s, :t)"); //Comando sql (Inserir um registro)
			
			//Substitui as variáveis
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":cpf", $cpf);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->bindValue(":t", $telefone);
			$sql->execute(); //Executa o comando o sql e retorna alguma coisa
			return true; //Retorna true
		}
	}
	public function logar($email, $senha) //Email e senha por parametro
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e AND Senha_cliente = :s"); //Comando sql

		//Substitui as variáveis
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha);
		$sql->execute(); //Executa o comando o sql e retorna alguma coisa
		if($sql->rowCount()>0) //Conta a quantidade de linhas que retornou do BD (Se retornar algo ele vai logar)
		{
			//entrar no sistema (sessão)
			$dado=$sql->fetch(); //Transforma os dados que retornaram do BD em um vetor
			session_start(); //Inicia uma sessão
			$_SESSION['ID_Cliente']=$dado['ID_Cliente']; //Inicia sessão com ID_Cliente
			return true; //logado com sucesso
		}
		else
		{
			return false; //nao foi possivel logar (Não achou o email e senha no BD)
		}
	}
	public function fazerReserva($Inicio_Reserva, $Fim_Reserva, $Data_Reserva, $email_cookie)
	{		
		global $pdo;
		$sql=$pdo->prepare("SELECT ID_Reserva FROM horario_reserva WHERE ((:i>=Inicio_Reserva AND :i<Fim_Reserva AND Data_Reserva = :dr) OR (:f>Inicio_Reserva AND :f <=Fim_Reserva AND Data_Reserva = :dr)) OR (:i<Inicio_Reserva AND :f>Fim_Reserva AND Data_Reserva = :dr)"); //Comando sql (consultar horários)
		$sql->bindValue(":i", $Inicio_Reserva); //Substitui a variável
		$sql->bindValue(":f", $Fim_Reserva);
		$sql->bindValue(":dr", $Data_Reserva);
		$sql->execute(); //Executa o comando o sql e retorna alguma coisa
		if($sql->rowCount()>0) //Conta a quantidade de linhas que retornou do BD
		{
			return false; //Retorna falso, se horário já tiver reservado
		}
		else
		{
	        $sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e");
	        $sql->bindValue(":e", $email_cookie);
	        $sql->execute();	
            if($sql->rowCount()>0)
            {
                list($ID_Cliente)=$sql->fetch();        
				$sql=$pdo->prepare("INSERT INTO horario_reserva(Inicio_Reserva, Fim_Reserva, Data_Reserva, ID_Cliente) VALUES(:i, :f, :d, :idc)"); //Comando sql (Inserir um registro) INSERT				
				//Substitui as variáveis
				$sql->bindValue(":i", $Inicio_Reserva);
				$sql->bindValue(":f", $Fim_Reserva);
				$sql->bindValue(":d", $Data_Reserva);
				$sql->bindValue(":idc", $ID_Cliente);
				$sql->execute(); //Executa o comando o sql e retorna alguma coisa
				return true; //Retorna true				
			}
		}
	} 

	public function deleteReserva($email_cookie)
	{		
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e");
	    $sql->bindValue(":e", $email_cookie);
	    $sql->execute();	
        if($sql->rowCount()>0)
        {
            while(list($ID_Cliente)=$sql->fetch())
            {
				$sql=$pdo->prepare("SELECT ID_Reserva, Inicio_Reserva, Fim_Reserva, Data_Reserva FROM horario_reserva WHERE ID_Cliente = :id"); //Comando sql (Selecionar registro)								
				//Substitui as variáveis
				$sql->bindValue(":id", $ID_Cliente);
				$sql->execute(); //Executa o comando o sql e retorna alguma coisa

				$tabela_reserva="";
				if($sql->rowCount()>0)
				{
					$tabela_reserva = "<font color='black'><center><table>";
					$tabela_reserva.="
					<tr>
						<td>Selecione</td>
						<td>Horário de início da reserva</td>
						<td>Horário do fim da reserva</td>
						<td>Data da Reserva</td>
					</tr>";
					while(list($ID_Reserva, $Inicio_Reserva, $Fim_Reserva, $Data_Reserva)=$sql->fetch())
					{
						$Data_Reserva=date('d/m/Y', strtotime($Data_Reserva));
            			$tabela_reserva.="
            			
		                <tr>
		                	<td><center><input type='radio' name='ID_Reserva' value='$ID_Reserva'></td>
		                	<td>$Inicio_Reserva</td>
		                	<td>$Fim_Reserva</td>
		                	<td>$Data_Reserva</td>
		                </tr>";
					}
					$tabela_reserva.="</table></font>";

					if($tabela_reserva!="")
					{
						echo "<form method='POST'>";
						echo $tabela_reserva;
						echo "<br>
						
        				<input type='submit'id='cancelarreserva' name='delete' value='Cancelar Reserva'>
        				</form>";
        	
        				if(isset($_POST["delete"]))
        				{
        					$ID_Reserva=$_POST["ID_Reserva"];
        					$sql = $pdo->prepare("DELETE FROM horario_reserva WHERE ID_Reserva = :idr"); //DELETE
						    $sql->bindValue(":idr", $ID_Reserva);
						    $sql->execute();	
					        if($sql->rowCount()>0)
					        {
					        	echo "<script> alert('Reserva Cancelada!'); window.location.href='TelaMinhasReservas.php'; </script>";
					        }
					        else
							{
								echo "<script> alert('Erro ao Cancelar!'); window.location.href='TelaCancelarReserva.php'; </script>";
							}
        				} 
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
	public function relatorios($email_cookie)
	{		
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e");
	    $sql->bindValue(":e", $email_cookie);
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
					$tabela_reserva = "<font color='black'><center><table border=3>";
					$tabela_reserva.="
					<table> 
					<tr>
						<th>Nome do cliente</th>
						<th>Horários de Inicio da Reserva</th>
						<th>Horário de Fim da Reserva</th>
						<th>Data da Reserva</th>
					</tr>";
					while(list($Inicio_Reserva, $Fim_Reserva, $Data_Reserva, $Nome_cliente)=$sql->fetch())
					{
						$Data_Reserva=date('d/m/Y', strtotime($Data_Reserva));
            			$tabela_reserva.="           			
		                <tr>
						<tr>
							<th>$Nome_cliente</th>
							<th>$Inicio_Reserva</th>
							<th>$Fim_Reserva</th>
							<th>$Data_Reserva</th>
						</tr>
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
		}		
	}
	public function mostrarReserva($email_cookie)
	{		
		global $pdo;
		$sql = $pdo->prepare("SELECT ID_Cliente FROM cliente WHERE Email_cliente = :e");
	    $sql->bindValue(":e", $email_cookie);
	    $sql->execute();	
        if($sql->rowCount()>0)
        {
            while(list($ID_Cliente)=$sql->fetch())
            {
				$sql=$pdo->prepare("SELECT Inicio_Reserva, Fim_Reserva, Data_Reserva FROM horario_reserva WHERE ID_Cliente = :id"); //Comando sql (Selecionar registro)	SELECT							
				//Substitui as variáveis
				$sql->bindValue(":id", $ID_Cliente);
				$sql->execute(); //Executa o comando o sql e retorna alguma coisa

				$tabela_reserva="";
				if($sql->rowCount()>0)
				{
					$tabela_reserva = "<font color='black'><center><table border=3>";
					$tabela_reserva.="
					<tr>				
						<td>Horário de início da reserva</td>
						<td>Horário do fim da reserva</td>
						<td>Data da Reserva</td>
					</tr>";
					while(list($Inicio_Reserva, $Fim_Reserva, $Data_Reserva)=$sql->fetch())
					{
						$Data_Reserva=date('d/m/Y', strtotime($Data_Reserva));
            			$tabela_reserva.="           			
		                <tr>
		                	<td>$Inicio_Reserva</td>
		                	<td>$Fim_Reserva</td>
		                	<td>$Data_Reserva</td>
		                </tr>";
					}
					$tabela_reserva.="</table></font>";

					if($tabela_reserva!="")
					{
						echo $tabela_reserva;
						echo "
        				<div id='bntcancelarreserva'><a id='cancelarreserva' href='../View/TelaCancelarReserva.php'>Cancelar Reserva</a></div>
        				</form>";   	        				
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
			$sql = $pdo->prepare("UPDATE cliente SET Senha_cliente = :sa WHERE Email_cliente = :e"); //UPDATE
			$sql->bindValue(":sa", $novaSenha);
			$sql->bindValue(":e", $email_cookie);
			$sql->execute();
			if($sql->rowCount()>0)
			{
				echo "<script> alert('Senha Atualizada, entre com a nova senha!'); window.location.href='TelaLoginCliente.php'; </script>";
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
}

?>