<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Alterar-Senha</title>      
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
        <p>Atualizar Senha</p> 
        <a id ='iconevoltar' href="TelaDono.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>
    <section class= "corpo">
        <br><br><br>
        <div class="meio2">
            <form  method="POST">
                <div class="formupdate">
                    <input type="password" name="Senha_Nova" minlength="9" maxlength="15" required placeholder="Insira uma Nova Senha"><br>
		            <input type="password" name="confSenha" minlength="9" maxlength="15" required placeholder="Confirmar Nova Senha" > <br> 
                    <button class="buttonoptions" name="update" type="submit">Alterar</button>        
                </div>
            </form> 
        </div>
     
        <?php
            //Conecta com os arquivos
            require_once '../../Controller/Conexao.php';
            require_once '../../Model/Dono.php';
                    
            //Instancias      
            $d = new Dono;
            $conexao = new Conexao;

            $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD

            session_start();
            if(!isset($_SESSION['ID_Dono'])) //Se o usuário não estiver logado
            {
                header("location: TelaLoginDono.php"); //redirecionar para a tela de login
                exit; //Não executar mais nada depois disso
            }
            
            if (isset($_POST['update']))
            {
                $novaSenha = addslashes($_POST['Senha_Nova']);
                $confirmarSenha = addslashes($_POST["confSenha"]);
                $email_cookie = $_COOKIE['Email_dono'];
                $d->updateSenha($novaSenha, $confirmarSenha, $email_cookie);            
            }
        ?>

    </section>   
</body>
<footer class="rodape">
    APP Desenvolvido por
    <a href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
    <a href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
    <a href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
    <i class="bi bi-diamond-half"></i>
    <i class="bi bi-diamond-half"></i>
</footer>
</html>