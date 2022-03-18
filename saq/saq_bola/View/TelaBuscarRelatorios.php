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
            <img  src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
            <img  src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
            <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
            <img  src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />       
        </nav>
    </div>
    <h1 class="h3 mb-3 font-weight-normal">Relatórios de aluguel</h1>
    <form method="POST">
        <div class="form-login">
            <input type="email" id="inputEmail" name="Email_cliente" class="#" placeholder="Insira o email do Cliente" maxlength="30" required autofocus> <br>
            <input class="buttonoptions" name="verificar" value="Verificar relatórios" type="submit">
            <center><a class='option' href='TelaFuncionario.php'>Voltar para tela principal</a>
        </div>
    </form>   

    <?php
        //Conecta com os arquivos
        require_once '../Controller/Conexao.php';
        require_once '../Model/Funcionario.php';
                    
        //Instancias      
        $f = new Funcionario;
        $conexao = new Conexao;

        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD

        session_start();
        if(!isset($_SESSION['ID_Funcionario']))
        {
            header("location: TelaLoginFuncionario.php");
            exit;
        }  
            
        if (isset($_POST['verificar']))
        {
            $Email_cliente = $_POST['Email_cliente'];
            //$email_cookie = $_COOKIE['Email_dono'];
            if($f->relatorios($Email_cliente)==false)
            {
                echo "<h2><center>Não há reservas de clientes com esse email! </h2>";
            }
        }
    ?>
    
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