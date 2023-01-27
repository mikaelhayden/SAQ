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
        <a class="principal" href="../../index.html">
            <nav class="cabecario">
                <img src="../assets/img/futebol (1).png" alt="" width="35px"><h2>SAQ</h2>
            </nav>
        </a>
    </div>

    <section class="corpo">
	        <form class="tabelas" method="POST" action="../../Model/DefinirHorarios.php">
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

                        <div class="dias">
                            <h1>Segunda-Feira</h1>
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Segunda" maxlength="5" value="<?php echo $H_I_Segunda; ?>"> 
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Segunda" maxlength="5" value="<?php echo $H_F_Segunda; ?>">
                        </div>

                        <div class="dias">
                            <h1>Terça-Feira</h1>		
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Terca" maxlength="5" value="<?php echo $H_I_Terca; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Terca" maxlength="5" value="<?php echo $H_F_Terca; ?>">
                        </div>

                        <div class="dias">
                        <h1>Quarta-Feira</h1> 
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Quarta" maxlength="5" value="<?php echo $H_I_Quarta; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Quarta" maxlength="5" value="<?php echo $H_F_Quarta; ?>">
                        </div>

                        <div class="dias">
                        <h1>Quinta-Feira</h1>                     
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Quinta" maxlength="5" value="<?php echo $H_I_Quinta; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Quinta" maxlength="5" value="<?php echo $H_F_Quinta; ?>">
                        </div>

                        <div class="dias">
                        <h1>Sexta-Feira</h1>                    
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Sexta" maxlength="5" value="<?php echo $H_I_Sexta; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Sexta" maxlength="5" value="<?php echo $H_F_Sexta; ?>">
                        </div>

                        <div class="dias">
                        <h1>Sábado</h1>                       
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Sabado" maxlength="5" value="<?php echo $H_I_Sabado; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Sabado" maxlength="5" value="<?php echo $H_F_Sabado; ?>">
                        </div>

                        <div class="dias">
                        <h1>Domingo</h1>                     
                            <h5> Horário de início </h5>            
                            <input type="time" name="Horario_Inicio_Domingo" maxlength="5" value="<?php echo $H_I_Domingo; ?>">
                            <h5> Horário do fim  </h5>     
                            <input type="time" name="Horario_Fim_Domingo" maxlength="5" value="<?php echo $H_F_Domingo; ?>">
                        </div>
                <div>
                    <button name="Definir" type="submit">Definir</button>          
                </div>
            </form>
    </section>

    <footer class="rodape">
            APP Desenvolvido por
            <a class="link" href="https://github.com/WALTER-OBS-DEBUG" target="_blank">Walter Jonas,</a>
            <a class="link" href="https://github.com/AntonyGuzma" target="_blank">Antony Gusmão,</a>
            <a class="link" href="https://github.com/mikaelhayden" target="_blank">e Mikael Hayden &copy;</a>
            <i class="bi bi-diamond-half"></i>
            <i class="bi bi-diamond-half"></i>
    </footer>   
</body>
</html>