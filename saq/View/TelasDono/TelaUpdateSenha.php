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
        <a class="principal" href="../../index.html">
            <nav class="cabecario">
                <img src="../assets/img/futebol (1).png" alt="" width="35px"><h2>SAQ</h2>
            </nav>
        </a>
    </div>
    
    <section class= "corpo">
        <div class="login">
            <h1>Alteração de Senha</h1>
            <form  method="POST">
                <div class="formupdate">
                    <input class="caixa__login-input" type="password" name="Senha_Nova" minlength="9" maxlength="15" required placeholder="Insira uma Nova Senha">
		            <input class="caixa__login-input" type="password" name="confSenha" minlength="9" maxlength="15" required placeholder="Confirmar Nova Senha" >
                    <button class="entrar" name="update" type="submit">Alterar</button>        
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