CREATE DATABASE SAQ;

CREATE TABLE Dono (
    ID_Dono INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nome_dono varchar(30),
    CPF_dono varchar(11),
    Email_dono varchar(30),
    Senha_dono varchar(30),
    Telefone_dono varchar(11),
    Nome_quadra varchar(30),
    Ag_Conta_dono INTEGER,
    Num_Conta_dono varchar(15),
    Banco varchar(30),
    Tipo_Conta_dono varchar(30)
);

CREATE TABLE Cliente (
    ID_Cliente INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nome_cliente varchar(30),
    CPF_Cliente varchar(11),
    Email_cliente varchar(30),
    Senha_cliente varchar(30),
    Telefone_cliente varchar(11)
);

CREATE TABLE Horario_Reserva (
    ID_Reserva INTEGER AUTO_INCREMENT PRIMARY KEY,
    Inicio_Reserva varchar(15),
    Fim_Reserva varchar(15),
    Data_Reserva date,
    ID_Cliente INTEGER
);

CREATE TABLE Funcionario (
    ID_Funcionario INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nome_Funcionario varchar(30),
    Email_Funcionario varchar(30),
    Senha_Funcionario varchar(30),
    Telefone_Funcionario varchar(11),
    Inicio_Expediente varchar(15),
    Fim_Expediente varchar(15)
);

CREATE TABLE Disponibilidade_quadra(
    ID_Disponibilidade INTEGER AUTO_INCREMENT PRIMARY KEY,  
    Horario_Inicio_Segunda varchar(30),
    Horario_Fim_Segunda varchar(30),
    Horario_Inicio_Terca varchar(30),
    Horario_Fim_Terca varchar(30),
    Horario_Inicio_Quarta varchar(30),
    Horario_Fim_Quarta varchar(30),
    Horario_Inicio_Quinta varchar(30),
    Horario_Fim_Quinta varchar(30),
    Horario_Inicio_Sexta varchar(30),
    Horario_Fim_Sexta varchar(30),
    Horario_Inicio_Sabado varchar(30),
    Horario_Fim_Sabado varchar(30),
    Horario_Inicio_Domingo varchar(30),
    Horario_Fim_Domingo varchar(30)
);

CREATE TABLE Cliente_Hr_Reserva (
    ID_Cliente INTEGER,
    ID_Reserva INTEGER,
    PRIMARY KEY (ID_Cliente, ID_Reserva)
);

ALTER TABLE Horario_Reserva ADD CONSTRAINT FK_Horario_Reserva_2
    FOREIGN KEY (ID_Cliente)
    REFERENCES Cliente (ID_Cliente)
    ON DELETE CASCADE;

ALTER TABLE Cliente_Hr_Reserva ADD CONSTRAINT FK_Cliente_Hr_Reserva_2
    FOREIGN KEY (ID_Cliente)
    REFERENCES Cliente (ID_Cliente);

ALTER TABLE Cliente_Hr_Reserva ADD CONSTRAINT FK_Cliente_Hr_Reserva_3
    FOREIGN KEY (ID_Reserva)
    REFERENCES Horario_Reserva (ID_Reserva);
 
INSERT INTO `cliente` (`Nome_cliente`, `CPF_Cliente`, `Email_cliente`, `Senha_cliente`, `Telefone_cliente`) VALUES
('Adlucio Guimarães', 11122233344, 'guimaraes@gmail.com', '123456789', 999446420);

INSERT INTO `dono` (`Nome_dono`, `CPF_dono`, `Email_dono`, `Senha_dono`, `Telefone_dono`, `Nome_quadra`, `Ag_Conta_dono`, `Num_Conta_dono`, `Banco`, `Tipo_Conta_dono`) VALUES
('Walter Jonas', 2147483647, 'jonasdowalter@gmail.com', 'mengawn', 985307588, 'Maracanazin', 1422, 67670, 'Caixa Econômica', 'Poupança/Corrente');

INSERT INTO `funcionario` (`Nome_Funcionario`, `Email_Funcionario`, `Senha_Funcionario`, `Telefone_Funcionario`, `Inicio_Expediente`, `Fim_Expediente`) VALUES
('Gabriel Pantoja', 'gabrielpantoja7@gmail.com', 'sasuke', 993456789, '07:00', '13:00');

INSERT INTO `horario_reserva` (`Inicio_Reserva`, `Fim_Reserva`, `Data_Reserva`, `ID_Cliente`) VALUES
('08:00', '10:00', '2021-10-30', 1);

INSERT INTO `cliente_hr_reserva` (`ID_Cliente`, `ID_Reserva`) VALUES
(1, 1);

INSERT INTO disponibilidade_quadra (Horario_Inicio_Segunda, Horario_Fim_Segunda, Horario_Inicio_Terca,
		Horario_Fim_Terca,
		Horario_Inicio_Quarta,
		Horario_Fim_Quarta,
		Horario_Inicio_Quinta,
		Horario_Fim_Quinta,
		Horario_Inicio_Sexta,
		Horario_Fim_Sexta,
		Horario_Inicio_Sabado,
		Horario_Fim_Sabado,
		Horario_Inicio_Domingo,
		Horario_Fim_Domingo) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
