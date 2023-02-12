<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Funcionário</title>
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
            <h1>Login Funcionário</h1>
            <form method="POST">
                <div>
                    <input class="caixa__login-input"  type="email" id="inputEmail" name="Email_Funcionario"  placeholder="Entre com o email" required autofocus>
            
                    <input class="caixa__login-input"  type="password" id="inputPassword" name="Senha_Funcionario"  placeholder="Entre com a senha" required>
            
                    <button class="entrar" name="entrar" type="submit">Entrar</button>
                    <a class="entrar cadastrese" href="TelaCadastroFuncionario.html">Cadastre-se</a>
        
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/Funcionario.php';
                    
                        $f = new Funcionario;
                        $conexao = new Conexao;

                        if(isset($_POST['entrar']))
                        {
                            $email = addslashes($_POST["Email_Funcionario"]);
                            $senha = addslashes($_POST["Senha_Funcionario"]);
                    
                            if(!empty($email) && !empty($senha))
                            {
                                $conexao->conectar("saq", "localhost", "root", "");
                                if($f -> logar($email, $senha))
                                {
                                    setcookie("Email_Funcionario", $email);
                                    header("location: TelaFuncionario.php");
                                }
                                else
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
            <a class="link" href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
            <a class="link" href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
            <a class="link" href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>  
</body>
</html>