<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Cliente</title>    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="text-center">
        <a class="principal" href="../index.html">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRAS ESPORTIVAS</h2>
                <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
            </nav>
        </a>
    </div>

    <div class="meio">
        <h1>Login Cliente</h1>
        <form method="POST">
            <div class="form-login">
                <input type="email" id="inputEmail" name="Email_cliente"  placeholder="Entre com o email" required autofocus><br>

                <input type="password" id="inputPassword" name="Senha_cliente" placeholder="Entre com a senha" required><br>
                
                <button class="buttonoptions" name="entrar" type="submit">Entrar</button>
                <a id="cadastrese" href="TelaCadastroCliente.php">Cadastre-se</a></abbr> <br><br>
       
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
            </div>
        </form>
    </div>

    <footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
    </footer>
</body>
</html>