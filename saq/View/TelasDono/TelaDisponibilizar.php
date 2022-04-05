<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Disponibilizar Horários</title> 

    <link rel="shortcut icon" href="../assets/img/futebol (1).png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">  
</head>
<body class="text-center">

    <div class="text-center">
        
            <nav id="cabecario">
                <a class="principal" href="TelaDono.php">
                    <h2 >SISTEMA DE ALUGUEL DE QUADRA ESPORTIVA</h2>
                    <img src="../assets/img/Bola-de-Futebol.png" alt="SAQ" width ="50" /> 
                    <img src="../assets/img/BolaDeBasquete-removebg-preview.png" alt="SAQ" width ="55" />
                    <img src="../assets/img/BoladeHandboll.png" alt="SAQ" width ="55" />
                    <img src="../assets/img/BolaDeVolei.png" alt="SAQ" width ="55" />    
                </a>
            </nav>
       
            <p>Disponibilizar Horários</p> 
            <a id ='iconevoltar' href="TelaDono.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>

    <section class="corpo">
        <br><br><br>
        <div class= "mid">
            <h1>Informe os horários que a quadra funcionará</h1>
	        <form method="POST">
                <div class="form-login">
                <label><br><b>Segunda-Feira:</label>
				
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Segunda" maxlength="5"> 
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Segunda" maxlength="5" > <br>

                <label><br>Terça-Feira:</label>
				
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Terca" maxlength="5"> <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Terca" maxlength="5" > <br>
				
                <label><br><b>Quarta-Feira:</label>  

                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Quarta" maxlength="5" > <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Quarta" maxlength="5" > <br>

                <label><br><b>Quinta-Feira:</label>   
                         
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Quinta" maxlength="5" > <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Quinta" maxlength="5"> <br>

                <label><br><b>Sexta-Feira:</label>
                         
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Sexta" maxlength="5"> <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Sexta" maxlength="5" > <br>

                <label><br><b>Sábado:</label>  
                         
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Sabado" maxlength="5" > <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Sabado" maxlength="5"> <br>

                <label><br><b>Domingo:</label>  
                         
                    <h5> Horário de início </h5>            
                    <input type="time" name="Horario_Inicio_Domingo" maxlength="5" > <br>
                    <h5> Horário do fim  </h5>     
                    <input type="time" name="Horario_Fim_Domingo" maxlength="5" > <br>
                
                <button class="buttonoptions" name="Definir" type="submit">Definir</button> <br><br>

                <?php
                    //Conecta com os arquivos
                    require_once '../../Controller/Conexao.php';
                    require_once '../../Model/Dono.php';

                    $d = new Dono;
                    $conexao = new Conexao;

                    $conexao->conectar("saq", "localhost", "root", "");
                        
                    /* session_start();
                    if(!isset($_SESSION['ID_Dono'])) //Se o usuário não estiver logado
                    {
                        header("location: TelaLoginDono.php"); //redirecionar para a tela de login
                        exit; //Não executar mais nada depois disso
                    }*/

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
                        
                        $conexao->conectar("saq", "localhost", "root", ""); //Conecta com BD               

                        $d->Disponibilizar($H_I_Segunda, $H_F_Segunda, $H_I_Terca, $H_F_Terca, $H_I_Quarta, $H_F_Quarta,
                        $H_I_Quinta, $H_F_Quinta, $H_I_Sexta, $H_F_Sexta, $H_I_Sabado, $H_F_Sabado, $H_I_Domingo, $H_F_Domingo);  
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