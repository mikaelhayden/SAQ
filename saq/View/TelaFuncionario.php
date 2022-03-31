<?php 
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Funcionario.php';

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
    <title>SAQ-</title>    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
                echo"  <div class='informacao'>
                <div id='texto'>Bem Vindo, $nome</div>
                <div id='texto'>Área Do Funcionário</div>
                <div id='texto'>Hoje: $date ás $hora</div>
        </div>";          
            }
        ?>
    </div>

    <section class= "corpo">
        <br><br><br>
        <div class="opt">   
            <a href="TelaBuscarRelatorios.php" ><img src="assets/img/lupa.png" alt="Inserir" width="65">Verificar relatórios de aluguel</a> 
        </div>
        <div class="opt">   
            <a href="../Model/SairFuncionario.php"><img src="assets/img/logout.png" alt="Inserir" width="75">>Encerrar Sessão</a>
        </div>
        <br><br><br>
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