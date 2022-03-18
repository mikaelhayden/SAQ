<?php 
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Cliente.php';

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/nav_foot.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="text-center">
        <nav id="cabecario">
            <h2>Sistema de Aluguel de Quadras Esportivas</h2>
            <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
            <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
            <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
            <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />       
        </nav>

        <?php
            if($sql->rowCount()>0)
            {
                list($nome)=$sql->fetch();
                echo"<h1 class='h3 mb-3 font-weight-normal'> Bem vindo, $nome <font color='#3EF079'>___________</font> Area do Cliente <font color='#3EF079'>__________________</font> Hoje: $date ás $hora</h1>";          
            }
        ?>

    </div>
    <div class="optionlog"> 
        <a class="option" href="TelaFazerReserva.php"><button type="button" class="btn btn-outline-secondary">Fazer Reserva</button></a>
        <a class="option" href="TelaMinhasReservas.php"><button type="button" class="btn btn-outline-secondary">Minhas Reserva</button></a>  
        <a class="option" href="TelaMeusRelatoriosReservas.php"><button type="button" class="btn btn-outline-secondary">Relatórios de aluguel</button></a>  
        <a class="option" href="../Model/SairCliente.php"><button type="button" class="btn btn-outline-secondary">Encerrar Sessão</button></a>
    </div>
</body>

<footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
</footer>
</html>