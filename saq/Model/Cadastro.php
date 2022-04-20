<?php
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Cliente.php';
    require_once '../Model/Funcionario.php';

    //Instancias
    $f = new Funcionario;                       
    $c = new Cliente;
    $conexao = new Conexao;

    if(isset($_POST['cadastrar_cliente'])) //Se o usuário clicar no botão "cadastrar"
    {
        //php recebe os dados do formulário
        $nome = addslashes($_POST["Nome_cliente"]);
        $email = addslashes($_POST['Email_cliente']);
        $cpf = addslashes($_POST['CPF_Cliente']);
        $telefone = addslashes($_POST['Telefone_cliente']);
        $senha = addslashes($_POST["Senha_cliente"]);
        $confirmarSenha=addslashes($_POST["confsenha"]);

        //verifica se esta tudo preenchido
        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf) && !empty($telefone))
        {
            $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD               
            if($senha == $confirmarSenha) //Verifica se a senha que usuário digitou confere com a senha que ele confirmou
            {
                if($c->cadastrar($nome,  $cpf, $email, $senha, $telefone)) //Se a função "cadastrar" retornar "true"
                {
                    echo "<script> alert('Cadastro realizado! Faça o login e entre no sistema!'); window.location.href='../View/TelasCliente/TelaLoginCliente.php'; </script>"; //Aparece na tela
                }
                else //Se a função "cadastrar" retornar "false"
                {                                  
                    echo"<script> alert('Email já existe!'); window.location.href='../View/TelasCliente/TelaCadastroCliente.php'; </script>";
                }
            }
            else //Se a senha e confimar não forem iguais
            {
                echo"<script> alert('Senhas não correspondem!'); window.location.href='../View/TelasCliente/TelaCadastroCliente.php'; </script>";  
            }                
        }
        else //Se faltar um campo para ser preenchido
        {
            echo"<script> alert('Preencha todos os campos!'); window.location.href='../View/TelasCliente/TelaCadastroCliente.php'; </script>";                                 
        }
    }

    else if(isset($_POST['cadastrar_funcionario'])) //Se o usuário clicar no botão "cadastrar"
    {
        //PHP recebe os seguintes dados via formulário programador123 Flamenguista123@
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
                    echo "<div id='sucesso'><center>Cadastro realizado! <script> alert('Cadastro realizado! Faça o login e entre no sistema!'); window.location.href='../View/TelasFuncionario/TelaLoginFuncionario.php'; </script></div>"; //Aparece na tela
                }
                else //Se a função "cadastrar" retornar "false"
                {                                         
                    echo"<script> alert('Email já existe!'); window.location.href='../View/TelasFuncionario/TelaCadastroFuncionario.php'; </script>";
                }
            }
            else //Se a senha e confimar não forem iguais
            {
                echo"<script> alert('Senhas não correspondem!'); window.location.href='../View/TelasFuncionario/TelaCadastroFuncionario.php'; </script>";
            }               
        }
        else //Se faltar um campo para ser preenchido
        {
            echo"<script> alert('Preencha todos os campos!'); window.location.href='../View/TelasFuncionario/TelaCadastroFuncionario.php'; </script>";  
        }
    }
?>  