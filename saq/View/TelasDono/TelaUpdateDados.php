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
        <a class="principal" href="TelaDono.php">
            <nav id="cabecario">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />   
            </nav>
        </a>
        <p>Atualize seus dados </p>
        <a id ='iconevoltar' href="TelaDono.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div> 
    <section class= "corpo">
    <br><br><br>
        <div class="mid">
            
            
	        <form method="POST" action="../../Model/UpdateDados.php">
                <div class="form-login">

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

                    <h3>Nome</h3>
                    <input type="text" id="inputNome" name="Nome_dono"  placeholder="Nome Completo" maxlength="30" value="<?php echo $Nome_dono; ?>" required autofocus><br>

                    <h3>Email</h3> 
                    <input type="email" id="inputEmail" name="Email_dono"  placeholder="Email" maxlength="30" value="<?php echo $Email_dono; ?>" required autofocus><br>

                    <h3>CPF</h3> 
                    <input type="number_format" id="inputCPF" name="CPF_dono"  placeholder="CPF" maxlength="11" value="<?php echo $CPF_dono; ?>" pattern="\d{3}.?\d{3}.?\d{3}-?\d{2}" required><br>

                    <h3>Telefone</h3> 
                    <input type="tel" id="inputTelefone" name="Telefone_dono"  placeholder="Telefone" maxlength="11" value="<?php echo $Telefone_dono; ?>" pattern="\d{11}" required><br> 

                    <h3>Nome Da Quadra</h3> 
                    <input type="text" id="inputNomeQuadra" name="Nome_quadra"  placeholder="Nome da Quadra Esportiva" value="<?php echo $Nome_quadra; ?>" maxlength="30" required autofocus><br>
                    
                    <button class="buttonoptions" name="Atualizar_Dono" type="submit">Atualizar</button> <br> <br>
            
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