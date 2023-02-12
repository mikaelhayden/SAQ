<?php 
    //Conecta com os arquivos
    require_once '../../Controller/Conexao.php';
    require_once '../../Model/Funcionario.php';

    $f = new Funcionario;
    $conexao = new Conexao;

    $conexao->conectar("saq", "localhost", "root", "");

    session_start();
    if(!isset($_SESSION['ID_Funcionario']))
    {
        header("location: TelaLoginFuncionario.php");
        exit;
    }
    else
    {
        $email_cookie = $_COOKIE['Email_Funcionario'];
        global $pdo;
        $sql = $pdo->prepare("SELECT Nome_Funcionario FROM funcionario WHERE Email_Funcionario = :e");
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
    <title>SAQ-Funcionário</title>    
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

        <?php
            if($sql->rowCount()>0)
            {
                list($nome)=$sql->fetch();
                echo"  <div class='informacao'>
                <div id='texto'>Bem Vindo, $nome</div>
                <div id='texto'>Área Do Funcionário</div>
                <div id='texto'>Hoje: $date ás $hora</div>
                </div>";          
            }
        ?>
    </div>

    <section class= "corpo">
        <div class="opt_centralizar">
            <div class="opt opt2">   
                <img src="../assets/img/lupa.png" alt="Inserir" width="30">
                <a href="TelaBuscarRelatorios.php" >Relatórios de Aluguel</a> 
            </div>

            <div class="opt opt2">	
                <img src="../assets/img/gear.png" alt="Inserir" width="30">
                <a href="TelaUpdateDados.php">Alterar Dados</a>
            </div>

            <div class="opt opt2">	
                <img src="../assets/img/mostrar-senha.png" alt="Inserir" width="30">
                <a  href="TelaUpdateSenha.php">Alterar Senha</a>
            </div>

            <div class="opt opt2">
                <img src="../assets/img/log-out.png" alt="Inserir" width="30">
                <a href="../../Model/SairFuncionario.php">Encerrar Sessão</a>
            </div>
        </div>
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