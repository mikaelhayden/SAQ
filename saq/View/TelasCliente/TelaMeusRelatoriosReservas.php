<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus relatórios de aluguel</title>      
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="text-center">
        <a class="principal" href="../../index.html">
            <nav class="cabecario">
                <img src="../assets/img/futebol (1).png" alt="" width="35px"><h2>SAQ</h2>
            </nav>
        </a>
    </div>

    <section class="corpo">
        <?php
            //Conecta com os arquivos
            require_once '../../Controller/Conexao.php';
            require_once '../../Model/Cliente.php';
                
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
            if($c->relatorios($email_cookie)==false)
            {
                echo "<div> <p id='semrelatorios'>Você Não Possui Relatórios :(</p></div>";
            }
        ?>
        <br><a class="entrar" href="../TelasCliente/TelaCliente.php">Voltar</a>
    </section>
    
    <footer class="rodape">
        APP Desenvolvido por
        <a class="link" href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
        <a class="link" href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
        <a class="link" href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
        <i class="bi bi-diamond-half"></i>
        <i class="bi bi-diamond-half"></i>
    </footer>  
</body>
</html>