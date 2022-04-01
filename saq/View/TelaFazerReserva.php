<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Solicitar-Reserva</title> 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-center">

    <div class="text-center">
        
            <nav id="cabecario">
                <a class="principal" href="../index.html">
                    <h2 >SISTEMA DE ALUGUEL DE QUADRAS ESPORTIVAS</h2>
                    <img src="assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                    <img src="assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                    <img src="assets/img/BoladeHandboll.png" alt="SAQ" width ="55" /> 
                    <img src="assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />
                </a>
            </nav>
       
            <p>Solicitar Reservas</p> 
            <a id ='iconevoltar' href="TelaCliente.php"><img src="assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>

    <section class="corpo">
        <br><br><br>
        <div class= "mid">
            <h1>Solicite as reservas inserindo os dados: </h1>
            <br>
	        <form method="POST">
                <div class="form-login">
                    <h5> Horário de início da reserva </h5>            
                    <input type="time" id="#" name="Inicio_Reserva" class="#" placeholder="Inisira no formato: 00:00" maxlength="5" pattern="\d{2}:?\d{2}" required autofocus> <br>

                    <h5> Horário do fim da reserva </h5>     
                    <input type="time" id="#" name="Fim_Reserva" class="#" placeholder="Inisira no formato: 00:00" maxlength="5" pattern="\d{2}:?\d{2}" required autofocus> <br>
                    <h5> Data da Reserva </h5>
                    <input type="date" id="#" name="Data_Reserva" class="#" placeholder="Data da Reserva" required autofocus> <br>
           
                    <button class="buttonoptions" name="solicitar" type="submit">Solicitar</button> <br><br>

                    <?php
                        //Conecta com os arquivos
                        require_once '../Controller/Conexao.php';
                        require_once '../Model/Cliente.php';
                
                        //Instancias
                        $c = new Cliente;
                        $conexao = new Conexao;

                        session_start();
                        if(!isset($_SESSION['ID_Cliente']))
                        {
                            header("location: TelaLoginCliente.php");
                            exit;
                        }  

                        if(isset($_POST['solicitar'])) //Se o usuário clicar no botão "cadastrar"
                        {
                            //php recebe os dados do formulário
                            $Inicio_Reserva = addslashes($_POST["Inicio_Reserva"]);
                            $Fim_Reserva = addslashes($_POST['Fim_Reserva']);
                            $Data_Reserva = addslashes($_POST['Data_Reserva']);

                            //verifica se esta tudo preenchido
                            if(!empty($Inicio_Reserva) && !empty($Fim_Reserva) && !empty($Data_Reserva))
                            {
                                $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD               
                                if($Inicio_Reserva != $Fim_Reserva) //Verifica se o inicio da reserva não é o mesmo que o fim da reserva
                                {
                                    $email_cookie = $_COOKIE['Email_cliente'];
                                    if($c->solicitarReserva($Inicio_Reserva, $Fim_Reserva, $Data_Reserva, $email_cookie)) //Se a função "solicitarReserva" retornar "true"
                                    {
                                        echo "<div id='sucesso'><center>Reserva realizada! <script> alert('Reserva realizada com sucesso! </script></div><br><a class='option' href='TelaMeusRelatoriosReservas.php'>Ver relatórios de aluguel</a><br>"; //Aparece na tela
                                    }
                                    else //Se a função "solicitarReserva" retornar "false"
                                    {                    
                                        echo"<div id='erro'><center>Já tem alguém reservando esse horário!</center></div>";
                                    }
                                }
                                else 
                                {
                                        echo"<div id='erro'>Horário inválido!</div>";
                                }                
                            }
                            else
                            {
                                echo "<div id='erro'>Preencha todos os campos!</div>";
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
        <br><br><br>
    </section>
    
    <footer class="rodape">
            APP Desenvolvido por
            <a href="https://github.com/WALTER-OBS-DEBUG">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>
</body>
</html>