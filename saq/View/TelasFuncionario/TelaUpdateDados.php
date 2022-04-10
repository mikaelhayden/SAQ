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
        <a class="principal" href="TelaFuncionario.php">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />   
            </nav>
        </a>
        <p>Atualize seus dados </p>
        <a id ='iconevoltar' href="TelaFuncionario.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>  
    <section class= "corpo">
    <br><br><br>
        <div class="mid">       
	        <form method="POST" action="../../Model/UpdateDados.php">
                <div class="form-login">

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

                    <label> Nome </label><br>
                    <input type="text" id="inputNome" name="Nome_Funcionario" placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_Funcionario; ?>" required autofocus><br>               
                    <label> Telefone </label><br>
                    <input type="tel" id="inputTelefone" name="Telefone_Funcionario"  placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_Funcionario; ?>" pattern="\d{11}" required><br>
                    <label> Inicio de Expediente </label><br>
                    <input type="time" name="Inicio_Expediente" value="<?php echo $Inicio_Expediente; ?>" pattern="\d{11}" required><br>
                    <label> Fim de Expediente </label><br>
                    <input type="time" name="Fim_Expediente" value="<?php echo $Fim_Expediente; ?>" pattern="\d{11}" required><br>                
                    <input type="hidden" name="Email_Funcionario" value="<?php echo $email_cookie; ?>">
                    <button class="buttonoptions" name="Atualizar_Funcionario" type="submit">Atualizar</button> <br> <br>           
                </div>
            </form>
        </div>
    <br><br><br>
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