<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quantidade de reservas diárias</title> 
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body class="text-center">
    <div class="text-center">
        <a class="principal" href="../../index.html">
            <nav class="cabecario">
                <img src="../assets/img/futebol (1).png" alt="" width="35px"><h2>SAQ</h2>
            </nav>
        </a>
    </div>
    
    </div>
    <section class= "corpo">
        <br><br><br><br>

        <?php
            //Conecta com os arquivos
            require_once '../../Controller/Conexao.php';
            require_once '../../Model/Dono.php';
                
            //Instancias
            $d = new Dono;
            $conexao = new Conexao;

            $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD

            session_start();
            if(!isset($_SESSION['ID_Dono']))
            {
                header("location: TelaLoginDono.php");
                exit;
            }  
               
            //$email_cookie = $_COOKIE['Email_dono'];
            if($d->groupby()==false)
            {
                echo "<div> <p id='semrelatorios'>Não Existe Nenhuma Reserva :(</p></div>";
            }   
        ?>

        <br><br>
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