<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Cliente</title>    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/nav_foot.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="text-center">
        <nav id="cabecario">
            <h2 >Sistema de Aluguel de Quadras Esportivas</h2>
            <img  src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
            <img  src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
            <img  src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
        </nav>
    </div>

    <h1>Login Cliente</h1>
    <form method="POST">
        <div class="form-login">
            <input type="email" id="inputEmail" name="Email_cliente"  placeholder="Entre com o email" required autofocus><br>

            <input type="password" id="inputPassword" name="Senha_cliente" placeholder="Entre com a senha" required><br>
                
            <button class="buttonoptions" name="entrar" type="submit">Entrar</button>
            <abbr title="Clique aqui para cadastrar-se"><a id="cadastrese" href="TelaCadastroCliente.php">Cadastre-se</a></abbr> <br><br>
       
            <?php
                //Conecta com os arquivos
                require_once '../Controller/Conexao.php';
                require_once '../Model/Cliente.php';

                //Instancias
                $c = new Cliente;
                $conexao = new Conexao;
                
                if(isset($_POST['entrar'])) //Se o usuário clicar no botão "entrar"
                {
                    //php recebe os dados do formulário
                    $email = addslashes($_POST["Email_cliente"]);
                    $senha = addslashes($_POST["Senha_cliente"]);
                    
                    //verifica se esta tudo preenchido
                    if(!empty($email) && !empty($senha))
                    {
                        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD
                        if($c -> logar($email, $senha)) //Se a função "logar" retornar "true"
                        {
                            setcookie("Email_cliente", $email); //Cria o cookie da sessão com o email
                            header("location: TelaCliente.php"); //Redireciona para a Tela do Cliente
                        }
                        else //Se a função "logar" retornar "false"
                        {
                            echo"<div id='erro'>Senha ou Email incorretos!</div>";
                        }
                    }
                }
            ?>
            <a href="../index.html"> Voltar para index </a>
        </div>
    </form>

</body>

<footer class="rodape">
    <div class="internorodape"><br>
    <p>APP Desenvolvido por</p><a href="https://github.com/WALTER-OBS-DEBUG" target="_blank" >Walter Jonas, Antony Gusmão e Mikael Hayden &copy; </a>
    <i class="bi bi-diamond-half"></i>
    </div>
</footer>
</html>