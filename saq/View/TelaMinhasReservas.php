<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Minhas-Reservas</title> 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/nav_foot.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-center">
    <div class="text-center">
        <nav id="cabecario">
            <h2 >Sistema de Aluguel de Quadras Esportivas</h2>
            <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
            <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
            <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
            <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
        </nav>
    </div>
    <h1 class="h3 mb-3 font-weight-normal">Minhas Reservas </h1>

    <?php
         //Conecta com os arquivos
        require_once '../Controller/Conexao.php';
        require_once '../Model/Cliente.php';
                
        //Instancias
        $c = new Cliente;
        $conexao = new Conexao;

        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD

        session_start();
        if(!isset($_SESSION['ID_Cliente']))
        {
            header("location: TelaLoginCliente.php");
            exit;
        }  
               
        $email_cookie = $_COOKIE['Email_cliente'];
        if($c->mostrarReserva($email_cookie)==false)
        {
            echo "<h2>Você não tem nenhuma reserva! </h2>";
        }
    ?>
    <br><br><a class='option' href='TelaCliente.php'>Voltar para tela principal</a>

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