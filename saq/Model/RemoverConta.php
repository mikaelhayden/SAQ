<?php
    require_once '../Controller/Conexao.php';

    $conexao = new Conexao;
    $conexao->conectar("saq", "localhost", "root", "");

    if(isset($_POST['Remover_Cliente']))
    {                         
        $email = addslashes($_POST["Email_cliente"]);

        global $pdo;
            
        $sql=$pdo->prepare("DELETE FROM cliente WHERE Email_cliente = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount()>0)
		{	
            session_start();
	        unset($_SESSION['ID_Cliente']);	
			echo "<script> alert('Você Removeu sua Conta!'); window.location.href='../View/TelasCliente/TelaLoginCliente.php'; </script>";
		}
		else
		{
			echo "<script> alert('Não foi possivel remover conta, remova todas as suas reservas primeiro!'); window.location.href='../View/TelasCliente/TelaCliente.php'; </script>";
		}
    }

    else if(isset($_POST['Remover_Funcionario']))
    {                         
        $email = addslashes($_POST["Email_Funcionario"]);

        global $pdo;
            
        $sql=$pdo->prepare("DELETE FROM funcionario WHERE Email_Funcionario = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount()>0)
		{	
            session_start();
	        unset($_SESSION['ID_Funcionario']);	
			echo "<script> alert('Você Removeu sua Conta!'); window.location.href='../View/TelasFuncionario/TelaLoginFuncionario.php'; </script>";
		}
		else
		{
			echo "<script> alert('Não foi possivel remover conta!'); window.location.href='../View/TelasFuncionario/TelaFuncionario.php'; </script>";
		}
    }
   
?>