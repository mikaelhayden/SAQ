<?php  
    //Conecta com os arquivos
    require_once '../Controller/Conexao.php';
    require_once '../Model/Dono.php';

    //Instancias
    $d = new Dono;                       
    $conexao = new Conexao;
    
    $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD 
    
    if(isset($_POST['Definir'])) 
    {
        //php recebe os dados do formulário
        $H_I_Segunda = addslashes($_POST["Horario_Inicio_Segunda"]);
        $H_F_Segunda = addslashes($_POST['Horario_Fim_Segunda']);

        $H_I_Terca = addslashes($_POST['Horario_Inicio_Terca']);
        $H_F_Terca = addslashes($_POST['Horario_Fim_Terca']);

        $H_I_Quarta = addslashes($_POST['Horario_Inicio_Quarta']);
        $H_F_Quarta = addslashes($_POST['Horario_Fim_Quarta']);

        $H_I_Quinta = addslashes($_POST['Horario_Inicio_Quinta']);
        $H_F_Quinta = addslashes($_POST['Horario_Fim_Quinta']);

        $H_I_Sexta = addslashes($_POST['Horario_Inicio_Sexta']);
        $H_F_Sexta = addslashes($_POST['Horario_Fim_Sexta']);

        $H_I_Sabado = addslashes($_POST['Horario_Inicio_Sabado']);
        $H_F_Sabado = addslashes($_POST['Horario_Fim_Sabado']);

        $H_I_Domingo = addslashes($_POST['Horario_Inicio_Domingo']);
        $H_F_Domingo = addslashes($_POST['Horario_Fim_Domingo']);        

        $d->Definir($H_I_Segunda, $H_F_Segunda, $H_I_Terca, $H_F_Terca, $H_I_Quarta, $H_F_Quarta,
        $H_I_Quinta, $H_F_Quinta, $H_I_Sexta, $H_F_Sexta, $H_I_Sabado, $H_F_Sabado, $H_I_Domingo, $H_F_Domingo);  
    }
?>