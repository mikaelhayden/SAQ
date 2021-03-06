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
        <a class="principal" href="TelaDono.php">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />     
            </nav>
        </a>

        <?php
            if($sql->rowCount()>0)
            {
                list($nome)=$sql->fetch();              	
                echo"  <div class='informacao'>
                <div id='texto'>Bem Vindo, $nome</div>
                <div id='texto'>Área Do Proprietário</div>
                <div id='texto'>Hoje: $date ás $hora</div>
                </div>";                  
            }
        ?>

    </div>   
    <section class= "corpo">
        <br><br><br>
        <div class="opt_centralizar">	
            <div class="opt">
                <a href="TelaDefinirHorarios.php"><img src="../assets/img/reservado.png" alt="Inserir" width="55  "> Definir Horários de funcionamento</a>
            </div>

            <div class="opt">    
                <a  href="TelaGroupBy.php"><img src="../assets/img/contadordia.png" alt="Inserir" width="55">  Quantidade de reservas de cada dia</a>
            </div>

        
        
            <div class="opt">
                <a  href="TelaLike.php"><img src="../assets/img/lupa.png" alt="Inserir" width="50"> Pesquisar clientes por letras</a>
            </div>
        
            <div class="opt_central">	
                <div class="opt">
                    <a  href="TelaUnion.php"><img src="../assets/img/livro-de-contato.png" alt="Inserir" width="50"><p id="op_cntt"> Contato dos clientes e funcionários</p></a>
                </div>

            </div>
           
    
            <div class="opt">
                <a  href="TelaUpdateDados.php"><img src="../assets/img/gear.png" alt="Inserir" width="55"> Alterar Dados</a>
            </div>

            <div class="opt">
                <a  href="TelaUpdateSenha.php"><img src="../assets/img/mostrar-senha.png" alt="Inserir" width="55"> Alterar Senha</a>
            </div>
	
            <div class="opt">
                <a  href="../../Model/SairDono.php" ><img src="../assets/img/log-out.png" alt="Inserir" width="55"> Sair da Sessão</a> 
            </div>
            
        </div>  

        <br><br><br>
    </section>
    <footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>   
</body>
</html>