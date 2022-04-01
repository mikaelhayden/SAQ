<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Minhas-Reservas</title> 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-center">
   <div class="text-center">
           <nav id="cabecario">
               <a class="principal" href="../index.html">
                   <h2 >SISTEMA DE ALUGUEL DE QUADRAS ESPORTIVAS</h2>
                   <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                   <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                   <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" /> 
                   <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />
               </a>
           </nav>
           <p>Cancelar Reservas</p> 
    </div>

    <section class= "corpo">
        <br><br><br><br>
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
        if($c->deleteReserva($email_cookie)==false)
        {
            echo "<h2>Você não fez nenhuma reserva! </h2>";
        }
    ?>
    <br><br><br><a href='TelaMinhasReservas.php'>Voltar para minhas reservas</a><br><br>
    <a href='TelaCliente.php'>Voltar para tela principal</a><br>
    <br>
    </section>

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