<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atualização-de-Cadastro-do-Cliente</title>
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">  
</head>
<body>
    <div class="text-center">
        <a class="principal" href="TelaCliente.php">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />   
            </nav>
        </a>
        <p>Atuzalize seus Dados </p>
        <a id ='iconevoltar' href="TelaCliente.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>    
    <section class= "corpo">
    <br><br><br>
        <div class="middados">
            
            <form method="POST" action="../../Model/UpdateDados.php">
                <div class="form-login">

                    <?php                       
                        require_once '../../Controller/Conexao.php';

                        $conexao = new Conexao;

                        session_start();
                        if(!isset($_SESSION['ID_Cliente'])) //Se o usuário não estiver logado
                        {
                            header("location: TelaLoginCliente.php"); //redirecionar para a tela de login
                            exit; //Não executar mais nada depois disso
                        }

                        $conexao->conectar("saq", "localhost", "root", "");
                        $email_cookie = $_COOKIE['Email_cliente'];
                        global $pdo;
                        $sql = $pdo->prepare("SELECT Nome_cliente, Email_cliente, CPF_Cliente, Telefone_cliente FROM cliente WHERE Email_cliente= '$email_cookie'");
                        $sql->execute();
                        list($Nome_cliente, $Email_cliente, $CPF_Cliente, $Telefone_cliente)=$sql->fetch();          
                    ?>

                    <h3>Nome</h3>
                    <input type="text" id="inputNome" name="Nome_cliente" placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_cliente; ?>" required autofocus><br>

                    <h3>CPF</h3>
                    <input type="number_format" id="inputCPF" name="CPF_Cliente" placeholder="CPF" maxlength="11" value="<?php echo $CPF_Cliente; ?>" pattern="\d{3}.?\d{3}.?\d{3}-?\d{2}" required><br>

                    <h3>Telefone</h3>
                    <input type="tel" id="inputTelefone" name="Telefone_cliente" placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_cliente; ?>" pattern="\d{11}" required> <br>
                    <input type="hidden" name="Email_cliente" value="<?php echo $email_cookie; ?>">                  
                    <button class="buttonoptions" name="Atualizar_Cliente" type="submit">Atualizar</button> <br> <br>
                    
                </div>
            </form>
            <form class="updatecliente" method="POST" action="../../Model/RemoverConta.php">
                <input type="hidden" name="Email_cliente" value="<?php echo $email_cookie; ?>">
                <button class="buttonremover" name="Remover_Cliente" type="submit"> Remover Conta</button>
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