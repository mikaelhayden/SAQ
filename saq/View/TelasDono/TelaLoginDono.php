<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Login-Dono</title>
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="text-center">
        <a class="principal" href="../../index.html">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />       
            </nav>
        </a>
    </div>
    <section class= "corpo">
    <br><br><br>
        <div class="meio">
            <h1>Login Dono</h1>
            <form method="POST">
                <div class="form-login">         
                    <input type="email" id="inputEmail" name="Email_dono" placeholder="Entre com o email" required autofocus> <br>          
                    <input type="password"  id="inputPassword" name="Senha_dono"  placeholder="Entre com a senha" required><br>           
                    <button class="buttonlogin" name="entrar" type="submit">Entrar</button><br><br> 
       
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/Dono.php';
                
                        //Instancias
                        $d = new Dono;
                        $conexao = new Conexao;
                
                        if(isset($_POST['entrar'])) //Se o usuário clicar no botão "entrar"
                        {
                            //php recebe os dados do formulário
                            $email = addslashes($_POST["Email_dono"]);
                            $senha = addslashes($_POST["Senha_dono"]);
                    
                            //verifica se esta tudo preenchido
                            if(!empty($email) && !empty($senha))
                            {
                                $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD
                                if($d -> logar($email, $senha)) //Se a função "logar" retornar "true"
                                {
                                    //session_start();
                                    setcookie("Email_dono", $email); //Cria o cookie da sessão com o email
                                    header("location: TelaDono.php"); //Redireciona para a Tela do Dono
                                }
                                else //Se a função "logar" retornar "false"
                                {
                                    echo"<div id='erro'><p>Senha ou Email incorretos!</p></div>";
                                }
                            }
                        }
                    ?>

                </div>        
            </form>
        </div>
        <br><br><br><br>
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
