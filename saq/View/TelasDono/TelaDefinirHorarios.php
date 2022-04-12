<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAQ-Dono</title>   
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
        <p>Disponibilizar Horários</p> 
        <a id ='iconevoltar' href="TelaDono.php"><img src="../assets/img/voltar.png" width="35" alt="Voltar"></a>
    </div>

    <section class="corpo">
        <br><br><br>
        <p id="titulo">Informe os Horários Que a Quadra Funcionará</p>
        <div>  <!--Tirei a class mid pra estilizar uma nova  -->
	        <form method="POST" action="../../Model/DefinirHorarios.php">
                <div class="form-login">
                    <div class="meio_dono">
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

                            global $pdo;
                            $sql = $pdo->prepare("SELECT Horario_Inicio_Segunda, Horario_Fim_Segunda, Horario_Inicio_Terca, Horario_Fim_Terca,
                            Horario_Inicio_Quarta, Horario_Fim_Quarta, Horario_Inicio_Quinta, Horario_Fim_Quinta, Horario_Inicio_Sexta,
                            Horario_Fim_Sexta, Horario_Inicio_Sabado, Horario_Fim_Sabado, Horario_Inicio_Domingo, Horario_Fim_Domingo FROM disponibilidade_quadra");
                            $sql->execute();
                            list($H_I_Segunda, $H_F_Segunda, $H_I_Terca, $H_F_Terca, $H_I_Quarta, $H_F_Quarta, $H_I_Quinta, $H_F_Quinta,
                            $H_I_Sexta, $H_F_Sexta, $H_I_Sabado, $H_F_Sabado, $H_I_Domingo, $H_F_Domingo)=$sql->fetch();          
                        ?>

                        <div class="tabeladias">
                            <h1 class="dias">Segunda-Feira</h1>
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Segunda" maxlength="5" value="<?php echo $H_I_Segunda; ?>"> 
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Segunda" maxlength="5" value="<?php echo $H_F_Segunda; ?>"> <br>
                        </div>

                        <div class="tabeladias">
                            <h1 class="dias">Terça-Feira</h1>		
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Terca" maxlength="5" value="<?php echo $H_I_Terca; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Terca" maxlength="5" value="<?php echo $H_F_Terca; ?>"> <br>				
                        </div>

                        <div class="tabeladias">
                        <h1 class="dias">Quarta-Feira</h1> 
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Quarta" maxlength="5" value="<?php echo $H_I_Quarta; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Quarta" maxlength="5" value="<?php echo $H_F_Quarta; ?>"> <br>
                        </div>

                        <div class="tabeladias">
                        <h1 class="dias">Quinta-Feira</h1>                     
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Quinta" maxlength="5" value="<?php echo $H_I_Quinta; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Quinta" maxlength="5" value="<?php echo $H_F_Quinta; ?>"> <br>
                        </div>

                        <div class="tabeladias">
                        <h1 class="dias">Sexta  -Feira</h1>                    
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Sexta" maxlength="5" value="<?php echo $H_I_Sexta; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Sexta" maxlength="5" value="<?php echo $H_F_Sexta; ?>"> <br>
                        </div>

                        <div class="tabeladias">
                        <h1 class="dias">Sábado-Feira</h1>                       
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Sabado" maxlength="5" value="<?php echo $H_I_Sabado; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Sabado" maxlength="5" value="<?php echo $H_F_Sabado; ?>"> <br>
                        </div>

                        <div class="tabeladias">
                        <h1 class="dias">Domingo</h1>                     
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Domingo" maxlength="5" value="<?php echo $H_I_Domingo; ?>"> <br>
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Domingo" maxlength="5" value="<?php echo $H_F_Domingo; ?>"> <br>
                        </div>
                    </div>
                </div>
                <div id="buttondono">
                    <button class="buttonoptions" name="Definir" type="submit">Definir</button> <br><br>           
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