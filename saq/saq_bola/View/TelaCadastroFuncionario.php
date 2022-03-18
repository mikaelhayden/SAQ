<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tela-de-Cadastro-do-Funcionário</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/nav_foot.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="text-center">
        <nav id="cabecario">
            <h2 >Sistema de Aluguel de Quadras Esportivas</h2>
            <img  src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
            <img  src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
            <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
            <img  src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
        </nav>
    </div>
    <h1 class="h3 mb-3 font-weight-normal">Cadastre-se como funcionário ou <a href="TelaLoginFuncionario.php"> Faça o Login </a></h1>
	<form method="POST">
        <div class="form-login">
        
            <input type="text" id="inputNome" name="Nome_Funcionario" class="#" placeholder="Nome Completo" maxlength="30" required autofocus> <br>

            <input type="email" id="inputEmail" name="Email_Funcionario" class="#" placeholder="Email" maxlength="30" required autofocus> <br>

            <input type="tel" id="inputTelefone" name="Telefone_Funcionario" class="#" placeholder="Telefone" maxlength="11" pattern="\d{11}" required> <br>

            <input type="time" id="inputInicioExpediente" name="Inicio_Expediente" class="#" placeholder="Inicio de Expediente" maxlength="30" required autofocus> <br>

            <input type="time" id="inputFimExpediente" name="Fim_Expediente" class="#" placeholder="Fim de Expediente" maxlength="30" required autofocus> <br>

            <input type="password" id="inputPassword" name="Senha_Funcionario" class="#" placeholder="Crie uma Senha" minlength="9"  required> <br>

            <input type="password" id="inputPassword" name="confsenha" class="#" placeholder="Confirmar senha" minlength="9"  required> <br>
            
            <button class="buttonoptions" name="cadastrar" type="submit">Cadastrar</button> <br> <br>
            
            <?php
                //Conecta com os arquivos
                require_once '../Controller/Conexao.php';
                require_once '../Model/Funcionario.php';

                 //Instancias
                $f = new Funcionario;
                $conexao = new Conexao;
                
                if(isset($_POST['cadastrar'])) //Se o usuário clicar no botão "cadastrar"
                {
                    //PHP recebe os seguintes dados via formulário
                    $nome = addslashes($_POST["Nome_Funcionario"]);
                    $email = addslashes($_POST['Email_Funcionario']);
                    $telefone = addslashes($_POST['Telefone_Funcionario']);
                    $inicio_expediente = addslashes($_POST['Inicio_Expediente']);
                    $fim_expediente = addslashes($_POST['Fim_Expediente']);
                    $senha = addslashes($_POST["Senha_Funcionario"]);
                    $confirmarSenha=addslashes($_POST["confsenha"]);
                   
                    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($telefone) && !empty($inicio_expediente) && !empty($fim_expediente)) //verifica se esta tudo preenchido
                    {
                        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com o banco de dados                   
                        if($senha == $confirmarSenha) //Verifica se as senhas conferem
                        {
                            if($f->cadastrar($nome, $email, $senha, $telefone, $inicio_expediente, $fim_expediente)) //Se a função cadastrar retornar "True"
                            {
                                echo "<div id='sucesso'><center>Cadastro realizado! <script> alert('Cadastro realizado! Faça o login e entre no sistema!'); window.location.href='TelaLoginFuncionario.php'; </script></div>"; //Aparece na tela
                            }
                            else //Se a função "cadastrar" retornar "false"
                            {
                                        
                                echo"<div id='erro'><center>Email já existe!</center></div>";
                            }
                        }
                        else //Se a senha e confimar não forem iguais
                        {
                            echo"<div id='erro'>Senhas não correspondem!</div>";
                        }               
                    }
                    else //Se faltar um campo para ser preenchido
                    {
                        echo "<div id='erro'>Preencha todos os campos!</div>";
                    }
                }
            ?>
            
        </div>
    </form>
</body>
<footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>
</html>