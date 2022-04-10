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
        <a class="principal" href="TelaDono.php">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />      
            </nav>
        </a>
        <p>Pesquisar Clientes por letras</p> 
        <a id ='iconevoltar' href="TelaDono.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>
    <section class= "corpo">
        <br><br><br>
        <div class="meio2">
            <form method="POST">
                <div class="form-loginrelatorio">
                    <input type="text" id="inputEmail" name="letra" placeholder="Insira a inicial do nome desejado" maxlength="1" required autofocus> <br>
                    <input class="buttonoptions" name="buscar" value="Buscar" type="submit">
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
        <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
        <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
        <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
        <i class="bi bi-diamond-half"></i>
        <i class="bi bi-diamond-half"></i>
</footer>
</html>