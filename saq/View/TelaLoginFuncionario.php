<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Funcionário</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
    </div>
    
    <section class= "corpo">
    <br><br><br>
        <div class="meio">
            <h1>Login Funcionário</h1>
            <form method="POST">
                <div class="form-login">
                    <input type="email" id="inputEmail" name="Email_Funcionario"  placeholder="Entre com o email" required autofocus><br>
            
                    <input type="password" id="inputPassword" name="Senha_Funcionario"  placeholder="Entre com a senha" required><br>
            
                    <button class="buttonlogin" name="entrar" type="submit">Entrar</button>
                    <a id="cadastrese" href="TelaCadastroFuncionario.php">Cadastre-se</a><br><br>
        
                    <?php
                        //Conecta com os arquivos
                        require_once '../Controller/Conexao.php';
                        require_once '../Model/Funcionario.php';
                    
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