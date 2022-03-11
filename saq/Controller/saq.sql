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

CREATE TABLE Endereço_Quadra (
    ID_Endereco_Quadra INTEGER AUTO_INCREMENT PRIMARY KEY,
    ID_Dono INTEGER,
    Bairro_Quadra varchar(30),
    Rua_Quadra varchar(30),
    CEP_Quadra INTEGER
);

CREATE TABLE Cliente (
    ID_Cliente INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nome_cliente varchar(30),
    CPF_Cliente varchar(11),
    Email_cliente varchar(30),
    Senha_cliente varchar(30),
    Telefone_cliente varchar(11),
    Ag_Conta_Cliente INTEGER,
    Num_Conta_Cliente varchar(15),
    Banco varchar(15),
    Tipo_Conta_Cliente varchar(30)
);

CREATE TABLE Horario_Reserva (
    ID_Reserva INTEGER AUTO_INCREMENT PRIMARY KEY,
    Inicio_Reserva varchar(15),
    Fim_Reserva varchar(15),
    Data_Reserva date,
    ID_Cliente INTEGER,
    ID_Funcionario INTEGER,
    ID_Dono INTEGER
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

CREATE TABLE Cliente_Hr_Reserva (
    ID_Cliente INTEGER,
    ID_Reserva INTEGER,
    PRIMARY KEY (ID_Cliente, ID_Reserva)
);

CREATE TABLE Pagamento (
    ID_Pag INTEGER AUTO_INCREMENT PRIMARY KEY,
    Forma_Pag varchar(10),
    ID_Dono INTEGER,
    ID_Funcionario INTEGER,
    ID_Cliente INTEGER
);


ALTER TABLE Endereço_Quadra ADD CONSTRAINT FK_Endereço_Quadra_2
    FOREIGN KEY (ID_Dono)
    REFERENCES Dono (ID_Dono);
 
ALTER TABLE Horario_Reserva ADD CONSTRAINT FK_Horario_Reserva_2
    FOREIGN KEY (ID_Cliente)
    REFERENCES Cliente (ID_Cliente)
    ON DELETE CASCADE;
 
ALTER TABLE Horario_Reserva ADD CONSTRAINT FK_Horario_Reserva_3
    FOREIGN KEY (ID_Funcionario)
    REFERENCES Funcionario (ID_Funcionario)
    ON DELETE RESTRICT;
 
ALTER TABLE Horario_Reserva ADD CONSTRAINT FK_Horario_Reserva_4
    FOREIGN KEY (ID_Dono)
    REFERENCES Dono (ID_Dono)
    ON DELETE RESTRICT;

ALTER TABLE Cliente_Hr_Reserva ADD CONSTRAINT FK_Cliente_Hr_Reserva_2
    FOREIGN KEY (ID_Cliente)
    REFERENCES Cliente (ID_Cliente);

ALTER TABLE Cliente_Hr_Reserva ADD CONSTRAINT FK_Cliente_Hr_Reserva_3
    FOREIGN KEY (ID_Reserva)
    REFERENCES Horario_Reserva (ID_Reserva);

ALTER TABLE Pagamento ADD CONSTRAINT FK_Pagamento_2
    FOREIGN KEY (ID_Dono)
    REFERENCES Dono (ID_Dono)
    ON DELETE RESTRICT;
 
ALTER TABLE Pagamento ADD CONSTRAINT FK_Pagamento_3
    FOREIGN KEY (ID_Funcionario)
    REFERENCES Funcionario (ID_Funcionario)
    ON DELETE RESTRICT;
 
ALTER TABLE Pagamento ADD CONSTRAINT FK_Pagamento_4
    FOREIGN KEY (ID_Cliente)
    REFERENCES Cliente (ID_Cliente);

INSERT INTO `cliente` (`Nome_cliente`, `CPF_Cliente`, `Email_cliente`, `Senha_cliente`, `Telefone_cliente`, `Ag_Conta_Cliente`, `Num_Conta_Cliente`, `Banco`, `Tipo_Conta_Cliente`) VALUES
('Adlucio Guimarães', 21474836472, 'guimaraes@gmail.com', '123', 999446420, 14, 74360, 'Bradesco SA', 'Poupança'),
('Victor Fernando', 21474836473, 'fernandovito@gmail.com', '1234', 992887878, 15, 35361, 'Banco do Brasil', 'Corrente'),
('Roberto alberto', 49584725, 'albertooo@gmail.com', '123456alberto', 979841224, 14, 74362, 'Bradesco SA', 'Poupança'),
('João gomes', 12334433, 'joãogomescantor@gmai.com', 'pegadadovaqueiro', 979344333, 15, 35353, 'Banco do Brasil', 'Corrente'),
('Neymar da silva junior', 49584102, 'NJ@gmail.com', 'adultoney', 912233222, 14, 74364, 'Bradesco SA', 'Poupança');

INSERT INTO `dono` (`Nome_dono`, `CPF_dono`, `Email_dono`, `Senha_dono`, `Telefone_dono`, `Nome_quadra`, `Ag_Conta_dono`, `Num_Conta_dono`, `Banco`, `Tipo_Conta_dono`) VALUES
('Walter Jonas', 2147483647, 'jonasdowalter@gmail.com', 'mengawn', 985307588, 'Maracanazin', 1422, 67670, 'Caixa Econômica', 'Poupança/Corrente');

INSERT INTO `funcionario` (`Nome_Funcionario`, `Email_Funcionario`, `Senha_Funcionario`, `Telefone_Funcionario`, `Inicio_Expediente`, `Fim_Expediente`) VALUES
('Gabriel Pantoja', 'gabrielpantoja7@gmail.com', 'sasuke', 993456789, '07:00 horas', '13:00 horas'),
('Romario Guapari', 'romariog@gmail.com', 'romaiomariodd', 99223377, '18:00', '22:00');

INSERT INTO `endereço_quadra` (`ID_Dono`, `Bairro_Quadra`, `Rua_Quadra`, `CEP_Quadra`) VALUES
(1, 'Alvorada', 'Clordovil', 69150150);

INSERT INTO `horario_reserva` (`Inicio_Reserva`, `Fim_Reserva`, `Data_Reserva`, `ID_Cliente`, `ID_Funcionario`, `ID_Dono`) VALUES
('08:00 horas', '10:00 horas', '2021-10-30', 1, 1, 1),
('10:00 horas', '13:00 horas', '2021-10-29', 2, 1, 1);

INSERT INTO `cliente_hr_reserva` (`ID_Cliente`, `ID_Reserva`) VALUES
(1, 1);

INSERT INTO `pagamento` (`Forma_Pag`, `ID_Dono`, `ID_Funcionario`, `ID_Cliente`) VALUES
('Cartão', NULL, NULL, 1),
('Cartão', NULL, NULL, 2);