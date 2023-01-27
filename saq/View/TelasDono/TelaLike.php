<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Buscar Cliente</title>    
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

    </div>
    <section class= "corpo">
        <div class="login">
            <form method="POST">
                <h1>Pesquisar Cliente</h1>
                <div >
                    <input class="caixa__login-input" type="text" id="inputEmail" name="letra" placeholder="Insira a inicial do nome" maxlength="1" required autofocus> 
                    <button class="entrar" type="submit" name="buscar" value="buscar">buscar</button>
                </div>
            </form> 
        </div>
     
        <?php
            //Conecta com os arquivos
            require_once '../../Controller/Conexao.php';
            require_once '../../Model/Dono.php';

            $d = new Dono;
            $conexao = new Conexao;

            $conexao->conectar("saq", "localhost", "root", "");
            
            session_start();
            if(!isset($_SESSION['ID_Dono'])) //Se o usuário não estiver logado
            {
                header("location: TelaLoginDono.php"); //redirecionar para a tela de login
                exit; //Não executar mais nada depois disso
            } 
            
            if (isset($_POST['buscar']))
            {
                $letra = addslashes($_POST['letra']);
                //$email_cookie = $_COOKIE['Email_dono'];
                if($d->like($letra)==false)
                {
                    echo "<div id='erro'><p>Não há clientes com essa inicial!</p></div>";
                }
            }
        ?>

    </section>   
</body>
<footer class="rodape">
        APP Desenvolvido por
        <a class="link" href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
        <a class="link" href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
        <a class="link" href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
        <i class="bi bi-diamond-half"></i>
        <i class="bi bi-diamond-half"></i>
</footer>   
</html>