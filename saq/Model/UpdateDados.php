<?php
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Cliente.php';
    require_once '../Model/Dono.php';
    require_once '../Model/Funcionario.php';
    
    $conexao = new Conexao;
    $c = new Cliente;
    $d = new Dono;
    $f = new Funcionario;

    if(isset($_POST['Atualizar_Cliente'])) //Se o usuário clicar no botão "cadastrar"
    {
        //php recebe os dados do formulário
        $nome = addslashes($_POST["Nome_cliente"]);       
        $cpf = addslashes($_POST['CPF_Cliente']);
        $telefone = addslashes($_POST['Telefone_cliente']);
        $email = addslashes($_POST["Email_cliente"]);
                            
        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD                   
        
        if($c->updateCadastro($nome, $cpf, $telefone, $email)) //Se a função "Atualizar" retornar "true"
        {
            echo "<script> alert('Cadastro Atualizado!'); window.location.href='../View/TelasCliente/TelaUpdateDados.php'; </script>"; //Aparece na tela
        }
        else
        {
            echo "<script> window.location.href='../View/TelasCliente/TelaUpdateDados.php'; </script>";
        }
    }

    if(isset($_POST['Atualizar_Dono']))  
    {
        //php recebe os dados do formulário
        $nome = addslashes($_POST["Nome_dono"]);
        $email = addslashes($_POST['Email_dono']);
        $cpf = addslashes($_POST['CPF_dono']);
        $telefone = addslashes($_POST['Telefone_dono']);
        $nome_quadra = addslashes($_POST['Nome_quadra']);
        
        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD                   
        
        if($d->updateCadastro($nome, $cpf, $email, $telefone, $nome_quadra, $email)) 
        {
            echo "<script> alert('Cadastro Atualizado!'); window.location.href='../View/TelasDono/TelaUpdateDados.php'; </script>"; //Aparece na tela
        }
        else
        {
            echo "<script> window.location.href='../View/TelasDono/TelaUpdateDados.php'; </script>";
        }
    }

    if(isset($_POST['Atualizar_Funcionario'])) //Se o usuário clicar no botão "cadastrar"
    {
        //php recebe os dados do formulário
        $nome = addslashes($_POST["Nome_Funcionario"]);
        $telefone = addslashes($_POST['Telefone_Funcionario']);
        $Inicio_Expediente = addslashes($_POST['Inicio_Expediente']);
        $Fim_Expediente = addslashes($_POST['Fim_Expediente']);
        $email = addslashes($_POST["Email_Funcionario"]);
                            
        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD                   
                       
        if($f->updateCadastro($nome, $telefone, $Inicio_Expediente, $Fim_Expediente, $email)) 
        {
            echo "<script> alert('Cadastro Atualizado!'); window.location.href='../View/TelasFuncionario/TelaUpdateDados.php'; </script>"; //Aparece na tela
        }
        else
        {
            echo "<script> window.location.href='../View/TelasFuncionario/TelaUpdateDados.php'; </script>";
        }
                  
    }
?>