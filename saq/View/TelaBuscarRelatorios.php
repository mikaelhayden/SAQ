<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Buscar Relatorios</title>   
    
    <link rel="shortcut icon" href="assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="text-center">
        <a class="principal" href="../index.html">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" /> 
                <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
            </nav>
        </a>
        <p>Verificar Relatórios</p> 
        <a id ='iconevoltar' href="TelaFuncionario.php"><img src="assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>

    <section class= "corpo">
        <br><br><br>
        <div class="meio2">
            <form method="POST">
                <div class="form-loginrelatorio">
                    <input type="email" id="inputEmail" name="Email_cliente" placeholder="Insira o email do Cliente" maxlength="30" required autofocus> <br>
                    <input class="buttonoptions" name="verificar" value="Verificar relatórios" type="submit">
                </div>
            </form> 
        </div>
     
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
                    echo "<div id='erro'><p>Não há reservas de clientes com esse email!</p></div>";
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