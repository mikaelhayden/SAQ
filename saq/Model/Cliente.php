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
						<tr>
							<td>$Nome_cliente</th>
							<td>$Inicio_Reserva</th>
							<td>$Fim_Reserva</th>
							<td>$Data_Reserva</th>
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
					$tabela_reserva = "<table>";
					$tabela_reserva.="
					<thead>
						<tr>				
							<th>Início da reserva</td>
							<th>Fim da reserva</td>
							<th>Data da Reserva</td>
						</tr>
					</thead>	
					";
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
					$tabela_reserva.="</table>";

					if($tabela_reserva!="")
					{
						echo $tabela_reserva;
						echo "
						<br>
        				<a class='entrar' href='../TelasCliente/TelaCancelarReserva.php'>Cancelar Reserva</a>
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

	public function horarios()
	{		
		global $pdo;
			       
		$sql=$pdo->prepare("SELECT Horario_Inicio_Segunda,
		Horario_Fim_Segunda,
		Horario_Inicio_Terca,
		Horario_Fim_Terca,
		Horario_Inicio_Quarta,
		Horario_Fim_Quarta,
		Horario_Inicio_Quinta,
		Horario_Fim_Quinta,
		Horario_Inicio_Sexta,
		Horario_Fim_Sexta,
		Horario_Inicio_Sabado,
		Horario_Fim_Sabado,
		Horario_Inicio_Domingo,
		Horario_Fim_Domingo FROM Disponibilidade_quadra"); //Comando sql (Selecionar registro)	SELECT							
		//Substitui as variáveis
			
		$sql->execute(); //Executa o comando o sql e retorna alguma coisa

		$tabela="";
		if($sql->rowCount()>0)
		{
			$tabela = "<font color='black'><center><table border=3>";
			$tabela.="
			<tr>				
				<td>Segunda</td>
				<td>Terça-Feira</td>
				<td>Quarta-Feira</td>
				<td>Quinta-Feira</td>
				<td>Sexta-Feira</td>
				<td>Sábado</td>
				<td>Domingo</td>
			</tr>";
			while(list($H_I_Segunda, $H_F_Segunda, $H_I_Terca, $H_F_Terca, $H_I_Quarta, $H_F_Quarta,
			$H_I_Quinta, $H_F_Quinta, $H_I_Sexta, $H_F_Sexta, $H_I_Sabado, $H_F_Sabado, $H_I_Domingo, $H_F_Domingo)=$sql->fetch())
			{					
            	$tabela.="           			
		        <tr>
		            <td>De $H_I_Segunda até ás $H_F_Segunda</td>
		            <td>De $H_I_Terca até ás $H_F_Terca</td>
		            <td>De $H_I_Quarta até ás $H_F_Quarta</td>
					<td>De $H_I_Quinta até ás $H_F_Quinta</td>
					<td>De $H_I_Sexta até ás $H_F_Sexta</td>
					<td>De $H_I_Sabado até ás $H_F_Sabado</td>
					<td>De $H_I_Domingo até ás $H_F_Domingo</td>
		        </tr>";
			}
			$tabela.="</table></font>";
			if($tabela!="")
			{
				echo $tabela;						  	        			   				
			}					
		}		
	}

	public function updateCadastro($nome, $cpf, $telefone, $email_cookie)
	{		
		global $pdo;
		
		$sql=$pdo->prepare("UPDATE cliente SET Nome_cliente = :n, CPF_Cliente = :cpf, Telefone_cliente = :t WHERE Email_cliente = :ek");
		$sql->bindValue(":n", $nome);
		$sql->bindValue(":cpf", $cpf);		
		$sql->bindValue(":t", $telefone);
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