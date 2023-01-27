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
    else //Se o usuário estiver logado
    {
        $email_cookie = $_COOKIE['Email_dono'];
        global $pdo;
        $sql = $pdo->prepare("SELECT Nome_dono FROM dono WHERE Email_dono = :e"); //Busca o nome do usuário no banco de dados
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
    <title>SAQ-Dono</title>   
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
                echo"<div class='informacao'>
                <div >Bem Vindo, $nome</div>
                <div >Área Do Proprietário</div>
                <div>$date ás $hora </div>
                </div>";                  
            }
        ?>

    </div>   

    <section class= "corpo">
        <div class="opt_centralizar">	
            <div class="opt">
                <img src="../assets/img/reservado.png" alt="Inserir" width="30">
                <a href="TelaDefinirHorarios.php">Definir Horários de funcionamento</a>
            </div>

            <div class="opt">    
                <img src="../assets/img/contadordia.png" alt="Inserir" width="30">
                <a  href="TelaGroupBy.php">Quantidade de reservas de cada dia</a>
            </div>
        
            <div class="opt">
                <img src="../assets/img/lupa.png" alt="Inserir" width="30">
                <a  href="TelaLike.php">Pesquisar clientes por letras</a>
            </div>
        
        	
            <div class="opt">
                <img src="../assets/img/livro-de-contato.png" alt="Inserir" width="30">
                <a  href="TelaUnion.php">Contato dos clientes e funcionários</a>
            </div>

           
            <div class="opt">
                <img src="../assets/img/gear.png" alt="Inserir" width="30">
                <a  href="TelaUpdateDados.php">Alterar Dados</a>
            </div>

            <div class="opt">
                <img src="../assets/img/mostrar-senha.png" alt="Inserir" width="30">
                <a  href="TelaUpdateSenha.php">Alterar Senha</a>
            </div>
	
            <div class="opt">
                <img src="../assets/img/log-out.png" alt="Inserir" width="30">
                <a  href="../../Model/SairDono.php">Sair da Sessão</a> 
            </div>
            
        </div>  
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