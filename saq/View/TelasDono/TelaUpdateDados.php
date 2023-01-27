<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tela-de-atualização-de-Cadastro-do-Dono</title>
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
        <div class="opt_centralizar opt_atualizar">
	        <form method="POST" action="../../Model/UpdateDados.php">
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/Dono.php';

                        $conexao = new Conexao;
                        $d = new Dono;

                        session_start();
                        if(!isset($_SESSION['ID_Dono'])) //Se o usuário não estiver logado
                        {
                            header("location: TelaLoginDono.php"); //redirecionar para a tela de login
                            exit; //Não executar mais nada depois disso
                        }

                        $conexao->conectar("saq", "localhost", "root", "");
                        $email_cookie = $_COOKIE['Email_dono'];
                        global $pdo;
                        $sql = $pdo->prepare("SELECT Nome_dono, Email_dono, CPF_dono, Telefone_dono, Nome_quadra FROM dono WHERE Email_dono = '$email_cookie'");
                        $sql->execute();
                        list($Nome_dono, $Email_dono, $CPF_dono, $Telefone_dono, $Nome_quadra)=$sql->fetch();          
                    ?>
                    <div class="opt_alinhar">
                        <div>
                        <h3>Nome</h3>
                        <input class="caixa_atualizar" type="text" id="inputNome" name="Nome_dono"  placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_dono; ?>" required autofocus>
                        </div>

                        <div>
                        <h3>Email</h3> 
                        <input class="caixa_atualizar" type="email" id="inputEmail" name="Email_dono"  placeholder="Email" maxlength="30" value="<?php echo $Email_dono; ?>" required autofocus>
                        </div>
                    </div>
                
                    <div class="opt_alinhar">
                        <div>
                        <h3>Telefone</h3> 
                        <input class="caixa_atualizar" type="tel" id="inputTelefone" name="Telefone_dono"  placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_dono; ?>" pattern="\d{11}" required>
                        </div>
                        <div>
                        <h3>CPF</h3> 
                        <input class="caixa_atualizar" type="number_format" id="inputCPF" name="CPF_dono"  placeholder="CPF" maxlength="11" value="<?php echo $CPF_dono; ?>" pattern="\d{3}.?\d{3}.?\d{3}-?\d{2}" required>
                        </div>
                    </div>

                    <div>
                    <h3>Nome Da Quadra</h3> 
                    <input class="caixa_atualizar" type="text" id="inputNomeQuadra" name="Nome_quadra"  placeholder="Nome da Quadra Esportiva" value="<?php echo $Nome_quadra; ?>" maxlength="30" required autofocus>
                    </div>
                    
                    <button class="entrar" name="Atualizar_Dono" type="submit">Atualizar</button>
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