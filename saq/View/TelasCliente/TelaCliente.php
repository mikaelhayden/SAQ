<?php 
    //Conecta com os arquivos
    require_once '../../Controller/Conexao.php';
    require_once '../../Model/Cliente.php';

    $c = new Cliente;
    $conexao = new Conexao;

    $conexao->conectar("saq", "localhost", "root", "");
    
    session_start();
    if(!isset($_SESSION['ID_Cliente']))
    {
        header("location: TelaLoginCliente.php");
        exit;
    }
    else
    {
        $email_cookie = $_COOKIE['Email_cliente'];
        global $pdo;
        $sql = $pdo->prepare("SELECT Nome_cliente FROM cliente WHERE Email_cliente = :e");
        $sql->bindValue(":e", $email_cookie);
        $sql->execute();
    } 

    //Pega a data e a hora do computador
    date_default_timezone_set('America/Manaus');
    $date = date('d/m/Y');
    $hora= date('H:i');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Cliente</title>    
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="text-center">
        <a class="principal" href="TelaCliente.php">
            <nav id="cabecario">
                <h2>SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />
            </nav>
        </a>

        <?php
            if($sql->rowCount()>0)
            {
                list($nome)=$sql->fetch();
                echo"  <div class='informacao'>
                <div id='texto'>Bem Vindo, $nome</div>
                <div id='texto'>Área Do Cliente</div>
                <div id='texto'>Hoje: $date ás $hora</div>
                </div>";          
            }
        ?>

    </div>
    <section class= "corpo">
        <br><br>
        <div class="opt_centralizar">	
            
            <div class="opt"> 
                <a href="TelaFazerReserva.php"><img src="../assets/img/reservado.png" alt="Inserir" width="55"> Fazer Reserva</a>
            </div>
            <div class="opt"> 
                <a href="TelaMinhasReservas.php"><img src="../assets/img/lupa.png" alt="Inserir" width="55"> Minhas Reserva</a>  <br>
            </div>
            <div class="opt"> 
                <a href="TelaMeusRelatoriosReservas.php"><img src="../assets/img/editar.png" alt="Inserir" width="55"> Relatórios de aluguel</a>  
            </div>
            <div class="opt">	
                <a  href="TelaUpdateDados.php"><img src="../assets/img/gear.png" alt="Inserir" width="55"> Alterar Dados</a>
            </div>
            <div class="opt">	
                <a  href="TelaUpdateSenha.php"><img src="../assets/img/mostrar-senha.png" alt="Inserir" width="55"> Alterar Senha</a>
            </div>
            <div class="opt"> 
                <a href="../../Model/SairCliente.php"><img src="../assets/img/log-out.png" alt="Inserir" width="55"> Encerrar Sessão</a>
            </div>

        </div>  
        <br>    
    </section>
</body>
<footer class="rodape">
    APP Desenvolvido por
    <a href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
    <a href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
    <a href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
    <i class="bi bi-diamond-half"></i>
    <i class="bi bi-diamond-half"></i>
</footer>
</html>