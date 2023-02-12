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

    <section class="corpo">
        <div class=" opt_atualizar opt_dividir">       
	        <form method="POST" action="../../Model/UpdateDados.php">
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/Funcionario.php';

                        $conexao = new Conexao;
                        $f = new Funcionario;

                        session_start();
                        if(!isset($_SESSION['ID_Funcionario'])) //Se o usuário não estiver logado
                        {
                            header("location: TelaLoginFuncionario.php"); //redirecionar para a tela de login
                            exit; //Não executar mais nada depois disso
                        }

                        $conexao->conectar("saq", "localhost", "root", "");
                        $email_cookie = $_COOKIE['Email_Funcionario'];
                        global $pdo;
                        $sql = $pdo->prepare("SELECT Nome_Funcionario, Telefone_Funcionario, Inicio_Expediente, Fim_Expediente FROM funcionario WHERE Email_Funcionario = '$email_cookie'");
                        $sql->execute();
                        list($Nome_Funcionario, $Telefone_Funcionario, $Inicio_Expediente, $Fim_Expediente)=$sql->fetch();          
                    ?>
                    
                    <div class="opt_alinhar">
                        <div>
                        <h3>Nome</h3>
                        <input class="caixa_atualizar" type="text" id="inputNome" name="Nome_Funcionario" placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_Funcionario; ?>" required autofocus>
                        </div>

                        <div>
                        <h3>Telefone</h3>  
                        <input class="caixa_atualizar" type="tel" id="inputTelefone" name="Telefone_Funcionario"  placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_Funcionario; ?>" pattern="\d{11}" required>
                        </div>
                    </div>
                    
                    <div>
                    <h3>Inicio Expediente</h3>  
                    <input class="caixa_atualizar" type="time" name="Inicio_Expediente" value="<?php echo $Inicio_Expediente; ?>" pattern="\d{11}" required>
                    </div>

                    <div>
                    <h3>Fim Expediente</h3>
                    <input class="caixa_atualizar" type="time" name="Fim_Expediente" value="<?php echo $Fim_Expediente; ?>" pattern="\d{11}" required> 
                    </div>     
                    
                    <input class="caixa_atualizar" type="hidden" name="Email_Funcionario" value="<?php echo $email_cookie; ?>">
                    <button class="entrar" name="Atualizar_Funcionario" type="submit">Atualizar</button>
            </form>

            <form method="POST" action="../../Model/RemoverConta.php">
                <input type="hidden" name="Email_Funcionario" value="<?php echo $email_cookie; ?>">
                <button class="removerconta" name="Remover_Funcionario" type="submit"> Remover Conta</button>
            </form>      
        </div>
        <a class="entrar" href="../TelasFuncionario/TelaFuncionario.php">Voltar</a>
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