<?php

Class HorarioReserva
{
	private $pdo;

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
}