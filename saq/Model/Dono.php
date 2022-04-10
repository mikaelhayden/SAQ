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
	
	public function Definir($H_I_Segunda, $H_F_Segunda, $H_I_Terca, $H_F_Terca, $H_I_Quarta, $H_F_Quarta,
	$H_I_Quinta, $H_F_Quinta, $H_I_Sexta, $H_F_Sexta, $H_I_Sabado, $H_F_Sabado, $H_I_Domingo, $H_F_Domingo)
	{		
		global $pdo;
		
		if($H_I_Segunda == NULL)
		{
			$H_I_Segunda = "(Horario nao definido!)";	
		}
		if($H_F_Segunda == NULL)
		{
			$H_F_Segunda = "(Horario nao definido!)";	
		}

		if($H_I_Terca == NULL)
		{
			$H_I_Terca = "(Horario nao definido!)";	
		}
		if($H_F_Terca == NULL)
		{
			$H_F_Terca = "(Horario nao definido!)";	
		}

		if($H_I_Quarta == NULL)
		{
			$H_I_Quarta="(Horario nao definido!)";	
		}
		if($H_F_Quarta == NULL)
		{
			$H_F_Quarta = "Horario nao definido!";	
		}

		if($H_I_Quinta == NULL)
		{
			$H_I_Quinta = "(Horario nao definido!)";	
		}
		if($H_F_Quinta == NULL)
		{
			$H_F_Quinta = "(Horario nao definido!)";	
		}

		if($H_I_Sexta == NULL)
		{
			$H_I_Sexta = "(Horario nao definido!)";	
		}
		if($H_F_Sexta == NULL)
		{
			$H_F_Sexta = "(Horario nao definido!)";	
		}

		if($H_I_Sabado == NULL)
		{
			$H_I_Sabado = "(Horario nao definido!)";	
		}
		if($H_F_Sabado == NULL)
		{
			$H_F_Sabado = "(Horario nao definido!)";	
		}

		if($H_I_Domingo == NULL)
		{
			$H_I_Domingo = "(Horario nao definido!)";	
		}
		if($H_F_Domingo == NULL)
		{
			$H_F_Domingo = "(Horario nao definido!)";	
		}

		$sql = $pdo->prepare("UPDATE disponibilidade_quadra SET Horario_Inicio_Segunda = :hi_s, Horario_Fim_Segunda = :hf_s,
		Horario_Inicio_Terca = :hi_t, Horario_Fim_Terca = :hf_t, Horario_Inicio_Quarta = :hi_qua, Horario_Fim_Quarta = :hf_qua,
		Horario_Inicio_Quinta = :hi_qui, Horario_Fim_Quinta= :hf_qui, Horario_Inicio_Sexta = :hi_sex,
		Horario_Fim_Sexta = :hf_sex, Horario_Inicio_Sabado = :hi_sab, Horario_Fim_Sabado = :hf_sab,
		Horario_Inicio_Domingo = :hi_d, Horario_Fim_Domingo = :hf_d WHERE ID_Disponibilidade = 1"); //UPDATE

		$sql->bindValue(":hi_s", $H_I_Segunda);
		$sql->bindValue(":hf_s", $H_F_Segunda);
		$sql->bindValue(":hi_t", $H_I_Terca);
		$sql->bindValue(":hf_t", $H_F_Terca);
		$sql->bindValue(":hi_qua", $H_I_Quarta);
		$sql->bindValue(":hf_qua", $H_F_Quarta);
		$sql->bindValue(":hi_qui", $H_I_Quinta);
		$sql->bindValue(":hf_qui", $H_F_Quinta);
		$sql->bindValue(":hi_sex", $H_I_Sexta);
		$sql->bindValue(":hf_sex", $H_F_Sexta);
		$sql->bindValue(":hi_sab", $H_I_Sabado);
		$sql->bindValue(":hf_sab", $H_F_Sabado);
		$sql->bindValue(":hi_d", $H_I_Domingo);
		$sql->bindValue(":hf_d", $H_F_Domingo);	
		$sql->execute();
		if($sql->rowCount()>0)
		{
			echo "<script> alert('Horário de funcionamento definido!'); window.location.href='../View/TelasDono/TelaDefinirHorarios.php'; </script>";			
		}
		else
		{
			echo "<script> window.location.href='../View/TelasDono/TelaDefinirHorarios.php'; </script>";
		}		
	}

	public function updateSenha($novaSenha, $confirmarSenha, $email_cookie)
	{		
		global $pdo;
		if ($novaSenha == $confirmarSenha)
    	{
			$sql = $pdo->prepare("UPDATE dono SET Senha_dono = :sa WHERE Email_dono = :e"); //UPDATE
			$sql->bindValue(":sa", $novaSenha);
			$sql->bindValue(":e", $email_cookie);
			$sql->execute();
			if($sql->rowCount()>0)
			{
				echo "<script> alert('Senha Atualizada, entre com a nova senha!'); window.location.href='TelaLoginDono.php'; </script>";
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

	public function updateCadastro($nome, $cpf, $email, $telefone, $nome_quadra, $email_cookie)
	{		
		global $pdo;

		$sql=$pdo->prepare("UPDATE dono SET Nome_dono = :n, CPF_dono = :cpf, Email_dono = :e, Telefone_dono = :t, Nome_quadra = :nq WHERE Email_dono = :ek");
		$sql->bindValue(":n", $nome);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":e", $email);
		$sql->bindValue(":t", $telefone);
		$sql->bindValue(":nq", $nome_quadra);
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