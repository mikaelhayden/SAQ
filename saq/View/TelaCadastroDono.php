<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tela-de-Cadastro-do-Dono</title>
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
            <img  src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
        </nav>
    </div>
    <h1 class="h3 mb-3 font-weight-normal">Cadastre-se como o dono da quadra ou <a href="TelaLoginDono.php"> Faça o Login </a></h1>
	<form method="POST">
        <div class="form-login">

            <input type="text" id="inputNome" name="Nome_dono" class="#" placeholder="Nome Completo" maxlength="30" required autofocus> <br>

            <input type="email" id="inputEmail" name="Email_dono" class="#" placeholder="Email" maxlength="30" required autofocus> <br>

            <input type="number_format" id="inputCPF" name="CPF_dono" class="#" placeholder="Cpf" maxlength="11" pattern="\d{3}.?\d{3}.?\d{3}-?\d{2}" required> <br>

            <input type="tel" id="inputTelefone" name="Telefone_dono" class="#" placeholder="Telefone" maxlength="11" pattern="\d{11}" required> <br>

            <input type="text" id="inputNomeQuadra" name="Nome_quadra" class="#" placeholder="Nome da Quadra Esportiva" maxlength="30" required autofocus> <br>

            <input type="password" id="inputPassword" name="Senha_dono" class="#" placeholder="Crie uma Senha" minlength="9"  required> <br>
            <input type="password" id="inputPassword" name="confsenha" class="#" placeholder="Confirmar senha" minlength="9"  required> <br>

            <br>
            <h1 class="h3 mb-3 font-weight-normal">Informações de Conta Bancária</h1>

            <input type="number_format" id="inputAgenciaContaDono" name="Ag_Conta_dono" class="#" placeholder="N° da Agência" maxlength="5" required>

            <input type="number_format" id="inputNumContaDono" name="Num_Conta_dono" class="#" placeholder="N° da Conta: Ex: 000***" maxlength="15" pattern="\d{15}" required>

            <input type="text" id="inputBanco" name="Banco" class="#" placeholder="Banco" maxlength="30" required autofocus>

            <input type="text" id="inputTipoContaDono" name="Tipo_Conta_dono" class="#" placeholder="Tipo de Conta" maxlength="30" required autofocus>  
            <br>
            <button class="buttonoptions" name="cadastrar" type="submit">Cadastrar</button> <br> <br>
            
            <?php
                //Conecta com os arquivos
                require_once '../Controller/Conexao.php';
                require_once '../Model/Dono.php';
                
                //Instancias
                $d = new Dono;
                $conexao = new Conexao;

                if(isset($_POST['cadastrar'])) //Se o usuário clicar no botão "cadastrar"
                {
                    //php recebe os dados do formulário
                    $nome = addslashes($_POST["Nome_dono"]);
                    $email = addslashes($_POST['Email_dono']);
                    $cpf = addslashes($_POST['CPF_dono']);
                    $telefone = addslashes($_POST['Telefone_dono']);
                    $nome_quadra = addslashes($_POST['Nome_quadra']);
                    $ag_Conta_dono = addslashes($_POST['Ag_Conta_dono']);
                    $num_Conta_dono = addslashes($_POST['Num_Conta_dono']);
                    $banco = addslashes($_POST['Banco']);
                    $tipo_Conta_dono = addslashes($_POST['Tipo_Conta_dono']);
                    $senha = addslashes($_POST["Senha_dono"]);
                    $confirmarSenha=addslashes($_POST["confsenha"]);

                    //verifica se esta preenchido
                    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf) && !empty($telefone) && !empty($nome_quadra) && !empty($ag_Conta_dono) && !empty($num_Conta_dono) && !empty($banco) && !empty($tipo_Conta_dono))
                    {
                            $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD                   
                            if($senha == $confirmarSenha) //Verifica se a senha que usuário digitou confere com a senha que ele confirmou
                            {
                                if($d->cadastrar($nome,  $cpf, $email, $senha, $telefone, $nome_quadra, $ag_Conta_dono, $num_Conta_dono, $banco, $tipo_Conta_dono)) //Se a função "cadastrar" retornar "true"
                                {
                                    echo "<div id='sucesso'><center>Cadastro realizado! <script> alert('Cadastro realizado! Faça o login e entre no sistema!'); window.location.href='TelaLoginDono.php'; </script></div>"; //Aparece na tela
                                }
                                else //Se a função "cadastrar" retornar "false"
                                {
                                        
                                    echo"<div id='erro'>Email já existe!</div>";
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
    <div class="internorodape"><br>
    <p>APP Desenvolvido por</p><a href="https://github.com/WALTER-OBS-DEBUG" target="_blank" >Walter Jonas, Antony Gusmão e Mikael Hayden &copy; </a>
    <i class="bi bi-diamond-half"></i>
    </div>
</footer>
</html>