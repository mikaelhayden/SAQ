<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Cliente</title>    
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
            <h1>Login Cliente</h1>
            <form method="POST">
                <div>
                    <input class="caixa__login-input" type="email" id="inputEmail" name="Email_cliente"  placeholder="Entre com o email" required autofocus>
                    <input class="caixa__login-input" type="password" id="inputPassword" name="Senha_cliente" placeholder="Entre com a senha" required>               
                    <button class="entrar" name="entrar" type="submit">Entrar</button>
                    <a class="entrar cadastrese" href="TelaCadastroCliente.html">Cadastre-se</a>
       
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/Cliente.php';

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