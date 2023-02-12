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
        <a class="principal" href="../../index.html">
            <nav class="cabecario">
                <img src="../assets/img/futebol (1).png" alt="" width="35px"><h2>SAQ</h2>
            </nav>
        </a>
    </div> 

    <section class= "corpo">
        <div class="opt_atualizar opt_dividir">   
            <form method="POST" action="../../Model/UpdateDados.php">
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

                    <div>
                    <h3>Nome</h3>
                    <input class="caixa_atualizar" type="text" id="inputNome" name="Nome_cliente" placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_cliente; ?>" required autofocus>
                    </div>


                    <div>
                        <h3>CPF</h3>
                        <input class="caixa_atualizar" type="number_format" id="inputCPF" name="CPF_Cliente" placeholder="CPF" maxlength="11" value="<?php echo $CPF_Cliente; ?>" pattern="\d{3}.?\d{3}.?\d{3}-?\d{2}" required>
                    </div>


                    <div>
                        <h3>Telefone</h3>
                        <input class="caixa_atualizar" type="tel" id="inputTelefone" name="Telefone_cliente" placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_cliente; ?>" pattern="\d{11}" required>
                        <input type="hidden" name="Email_cliente" value="<?php echo $email_cookie; ?>">
                    </div>

                    <button class="entrar" name="Atualizar_Cliente" type="submit">Atualizar</button>
                
            </form>
            <form method="POST" action="../../Model/RemoverConta.php">
                <input type="hidden" name="Email_cliente" value="<?php echo $email_cookie; ?>">
                <button class="removerconta" name="Remover_Cliente" type="submit"> Remover Conta</button>
            </form>
        </div>
        <a class="entrar" href="../TelasCliente/TelaCliente.php">Voltar</a>
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