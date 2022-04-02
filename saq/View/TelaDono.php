<?php
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Dono.php';

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">     
    <style>
      .opt{
    position: relative;
    width: 450px;
    height: 130px;
    margin-top: 20px;
    text-align: justify;
}
    </style>
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

        <?php
            if($sql->rowCount()>0)
            {
                list($nome)=$sql->fetch();              	
                echo"  <div class='informacao'>
                <div id='texto'>Bem Vindo, $nome</div>
                <div id='texto'>Área Do Dono</div>
                <div id='texto'>Hoje: $date ás $hora</div>
                </div>";                  
            }
        ?>
    </div>   

    <section class= "corpo">
        <br><br><br>
            
                <div class="opt">	
                    <a href="#"><img src="assets/img/reserva.png" alt="Inserir" width="75"> Inserir Dias e Horarios</a>
                </div>

                <div class="opt">	
                    <a  href="TelaGroupBy.php"><img src="assets/img/contador.png" alt="Inserir" width="75"> Quantidade de reservas de cada dia</a>
                </div>

                <div class="opt">	
                    <a  href="TelaLike.php"><img src="assets/img/lupa.png" alt="Inserir" width="75"> Pesquisar clientes por letras</a>
                </div>

                <div class="opt">	
                    <a  href="TelaUnion.php"><img src="assets/img/livro-de-contato.png" alt="Inserir" width="75"> Contato dos clientes e funcionários</a>
                </div>

                <div class="opt">	
                    <a  href="../Model/SairDono.php" ><img src="assets/img/logout.png" alt="Inserir" width="75"> Sair da Sessão</a> 
                </div>
        
        <br><br><br>
    </section>

    <footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>   
</body>
</html>