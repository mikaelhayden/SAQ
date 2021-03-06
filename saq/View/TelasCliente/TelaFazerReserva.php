<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Solicitar-Reserva</title> 
    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="text-center">
    <div class="text-center">      
        <nav id="cabecario">
            <a class="principal" href="TelaCliente.php">
                <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />
            </a>
        </nav>     
        <p>Fazer Reservas  </p> 
        <a id ='iconevoltar' href="TelaCliente.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
        <abbr title="Clique Aqui Para Verificar Disponibilidade Da Quadra"><a id ='iconevisualizar' href="TelaHorarios.php"><img src="../assets/img/relogio.png" width="35" alt="Voltar"></a></abbr>

    </div>
    <section class="corpo">
        <br><br><br>     
        <div class= "midreserva">
            <h1>Faça a Reserva Inserindo os Dados:</h1>
            <br>
	        <form method="POST">
                <div class="form-login">
                    <h5> Horário de início da reserva </h5>            
                    <input type="time" id="#" name="Inicio_Reserva" required autofocus> <br>
                    <h5> Horário do fim da reserva </h5>     
                    <input type="time" id="#" name="Fim_Reserva" required autofocus> <br>
                    <h5> Data da Reserva </h5>
                    <input type="date" id="#" name="Data_Reserva" placeholder="Data da Reserva" required autofocus> <br>      
                    <button class="buttonoptions" name="solicitar" type="submit">Reservar</button> <br><br>
                       
                    <?php
                        //Conecta com os arquivos
                        require_once '../../Controller/Conexao.php';
                        require_once '../../Model/HorarioReserva.php';
                
                        //Instancias
                        $hr = new HorarioReserva;
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
                            $data_atual=date('Y-m-d');

                            if($Data_Reserva>=$data_atual)
                            {
                                //verifica se esta tudo preenchido
                                if(!empty($Inicio_Reserva) && !empty($Fim_Reserva) && !empty($Data_Reserva))
                                {
                                    $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD
                                    if($Inicio_Reserva<$Fim_Reserva)
                                    {               
                                        if($Inicio_Reserva != $Fim_Reserva) //Verifica se o inicio da reserva não é o mesmo que o fim da reserva
                                        {                           
                                            $email_cookie = $_COOKIE['Email_cliente'];
                                            if($hr->fazerReserva($Inicio_Reserva, $Fim_Reserva, $Data_Reserva, $email_cookie)) //Se a função "solicitarReserva" retornar "true"
                                            {
                                                echo "<div id='sucesso'><center>Reserva realizada! <script> alert('Reserva realizada com sucesso! </script></div><br><abbr title='Clique Para Visualizar Suas Reservas'><a id='iconerelatorio' href='TelaMeusRelatoriosReservas.php'><img src='../assets/img/olho.png' width='37' alt='Voltar'></a><br></abbr>"; //Aparece na tela
                                            }
                                            else //Se a função "solicitarReserva" retornar "false"
                                            {                    
                                                echo"<div id='erroreserva'><center>Já tem alguém reservando esse horário!</center></div>";
                                            }                                    
                                        }
                                        else 
                                        {
                                            echo"<div id='erroreserva'>Horário inválido!</div>";
                                        }
                                    } 
                                    else
                                    {
                                        echo"<div id='erroreserva'>Horário inválido!</div>";
                                    }               
                                }
                                else
                                {
                                    echo "<div id='erroreserva'>Preencha todos os campos!</div>";
                                }                             
                            }
                            else
                            {
                                echo "<div id='erroreserva'>Ops, esse dia já passou!</div>";
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
            <a href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
            <a href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
            <a href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>
</body>
</html>