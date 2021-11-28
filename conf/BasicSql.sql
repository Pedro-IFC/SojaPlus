CREATE DATABASE SOJAPLUS;

#DROP DATABASE SOJAPLUS;

USE SOJAPLUS;

#DROP DATABASE SOJAPLUS;
CREATE TABLE USUARIO(
	id INT AUTO_INCREMENT, 
	nome VARCHAR(40) NOT NULL,
	sobrenome VARCHAR(50) NOT NULL,
    dataNasc DATE NOT NULL,
    email varchar(80) NOT NULL,
    CPF VARCHAR(14) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    genero ENUM("M", "F") NOT NULL,
    CNPJ VARCHAR(14) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE cidade(
	id INT AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);
select * from cidade;
INSERT INTO CIDADE VALUES
(NULL, "Agrolândia"),
(NULL, "Agronômica"),
(NULL, "Atalanta"),
(NULL, "Aurora"),
(NULL, "Braço do Trombudo"),
(NULL, "Chapadão do Lageado"),
(NULL, "Dona Emma"),
(NULL, "Ibirama"),
(NULL, "Imbuia"),
(NULL, "José Boiteux"),
(NULL, "Laurentino"),
(NULL, "Lontras"),
(NULL, "Mirim Doce"),
(NULL, "Petrolândia"),
(NULL, "Pouso Redondo"),
(NULL, "Presidente"),
(NULL, "Presidente Nereu"),
(NULL, "Rio do Campo"),
(NULL, "Rio do Oeste"),
(NULL, "Rio do Sul"),
(NULL, "Salete"),
(NULL, "Santa Terezinha"),
(NULL, "Taió"),
(NULL, "Trombudo Central"),
(NULL, "Vidal Ramos"),
(NULL, "Vitor Meireles"),
(NULL, "Witmarsum");

CREATE TABLE HistoricoUmidadeTemp(
	id INT AUTO_INCREMENT NOT NULL,
    idCidade INT NOT NULL,
    `data` DATE NOT NULL,
    umidade FLOAT NOT NULL,
    temperatura FLOAT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (idCidade) REFERENCES cidade(id)
);

CREATE TABLE PeriodosDeChuva(
	id INT AUTO_INCREMENT,
    idCidade INT NOT NULL,
    `data` DATE NOT NULL, 
    quant FLOAT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (idCidade) REFERENCES cidade(id)
);
select * from lavoura;
CREATE TABLE LAVOURA(
	id INT AUTO_INCREMENT,
    idUsuario INT NOT NULL,
    idCidade INT NOT NULL,
    hectares INT NOT NULL,
    dataPlantio DATE NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (idUsuario) REFERENCES usuario(id),
    FOREIGN KEY (idCidade) REFERENCES cidade(id)
);

CREATE TABLE SOJA(
	idLavoura INT,
    estagio VARCHAR(2) NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(idLavoura)
);

CREATE TABLE `LOGS`(
	id INT AUTO_INCREMENT,
	idLavoura INT NOT NULL,
    `log` VARCHAR(70) NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);

CREATE TABLE CORRECAO(
	id INT AUTO_INCREMENT,
    idLavoura INT NOT NULL,
    `data` DATETIME NOT NULL,
    retorno VARCHAR(255) NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);

CREATE TABLE DOCANALISE(
	id INT AUTO_INCREMENT NOT NULL,
    idLavoura INT NOT NULL,
    `data` DATE NOT NULL,
    N FLOAT NOT NULL,
    P FLOAT NOT NULL,
    K FLOAT NOT NULL,
    Ca FLOAT NOT NULL,
    Mg FLOAT NOT NULL,
    MO FLOAT NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);

CREATE TABLE PRODUTOSQUIMICOS(
	id INT AUTO_INCREMENT,
    idLavoura INT NOT NULL,
    area FLOAT NOT NULL,
    subs ENUM("N", "P", "K", "Ca", "Mg") NOT NULL,
    quant FLOAT NOT NULL,
    `data` DATE NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);

CREATE TABLE HISTORICO(
	id INT AUTO_INCREMENT NOT NULL,
    idLavoura INT NOT NULL,
    dados VARCHAR(255) NOT NULL,
    `data` DATE NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);

CREATE TABLE SENSORESHISTORICO(
	id INT AUTO_INCREMENT,
    idLavoura INT NOT NULL,
    umidade FLOAT NOT NULL,
    umidadeAr FLOAT NOT NULL,
    temp FLOAT NOT NULL,
    FOREIGN KEY (idLavoura) REFERENCES lavoura(id),
    PRIMARY KEY(id)
);