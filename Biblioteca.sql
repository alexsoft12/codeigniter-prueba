CREATE DATABASE IF NOT EXISTS Biblioteca
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE Biblioteca;

DROP TABLE IF EXISTS Prestamo;
DROP TABLE IF EXISTS Libro;
DROP TABLE IF EXISTS Socio;
DROP TABLE IF EXISTS Tema;
DROP TABLE IF EXISTS Editorial;
DROP TABLE IF EXISTS Autor;
DROP TABLE IF EXISTS Actualizaciones_Libro;

CREATE TABLE Autor
(
	idAutor     INT         NOT NULL AUTO_INCREMENT,
	NombreAutor VARCHAR(60) NOT NULL,
	PRIMARY KEY (idAutor)
) ENGINE = InnoDB;

CREATE TABLE Editorial
(
	idEditorial     INT          NOT NULL AUTO_INCREMENT,
	NombreEditorial VARCHAR(30)  NOT NULL,
	Direccion       VARCHAR(100) NOT NULL,
	Telefono        VARCHAR(15)  NOT NULL,
	PRIMARY KEY (idEditorial)
) ENGINE = InnoDB;

CREATE TABLE Tema
(
	idTema     INT         NOT NULL AUTO_INCREMENT,
	NombreTema VARCHAR(30) NOT NULL,
	PRIMARY KEY (idTema)
) ENGINE = InnoDB;

CREATE TABLE Socio
(
	idSocio        INT          NOT NULL AUTO_INCREMENT,
	NombreCompleto VARCHAR(60)  NOT NULL,
	Direccion      VARCHAR(100) NOT NULL,
	Correo         VARCHAR(25)  NULL DEFAULT 'Sin Correo',
	Telefono       VARCHAR(15)  NOT NULL,
	Foto           VARCHAR(20)  NOT NULL,
	PRIMARY KEY (idSocio)
) ENGINE = InnoDB;

CREATE TABLE Libro
(
	idLibro          INT         NOT NULL AUTO_INCREMENT,
	ISBN             VARCHAR(20) NOT NULL UNIQUE,
	Titulo           VARCHAR(65) NOT NULL,
	NumeroEjemplares TINYINT     NOT NULL,
	idAutor          INT         NOT NULL,
	idEditorial      INT         NOT NULL,
	idTema           INT         NOT NULL,
	PRIMARY KEY (idLibro),
	FOREIGN KEY (idAutor) REFERENCES Autor (idAutor) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idEditorial) REFERENCES Editorial (idEditorial) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idTema) REFERENCES Tema (idTema) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE Prestamo
(
	idPrestamo    INT  NOT NULL AUTO_INCREMENT,
	FechaPrestamo DATE NOT NULL,
	FechaEntrega  DATE NOT NULL,
	idSocio       INT  NOT NULL,
	idLibro       INT  NOT NULL,
	PRIMARY KEY (idPrestamo),
	FOREIGN KEY (idSocio) REFERENCES Socio (idSocio) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idLibro) REFERENCES Libro (idLibro) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE Actualizaciones_Libro
(
	idActualizacion          INT         NOT NULL AUTO_INCREMENT,
	idLibro                  INT         NOT NULL,
	ISBNAnterior             VARCHAR(20) NOT NULL,
	TituloAnterior           VARCHAR(65) NOT NULL,
	NumeroEjemplaresAnterior TINYINT     NOT NULL,
	FechaModificacion        DATETIME    NOT NULL,
	PRIMARY KEY (idActualizacion)
) ENGINE = InnoDB;

INSERT INTO Autor
VALUES (NULL, "Fernando López Segura");
INSERT INTO Autor
VALUES (NULL, "Eduardo Cruz Ruiz");
INSERT INTO Autor
VALUES (NULL, "Lilian Valecia Carrillo");
INSERT INTO Autor
VALUES (NULL, "Juan Carlos Segundo Elias");
INSERT INTO Autor
VALUES (NULL, "Jair Cuellar Artega");
INSERT INTO Autor
VALUES (NULL, "Karla Rojas García");
INSERT INTO Autor
VALUES (NULL, "ke ffhg fff");

INSERT INTO Editorial
VALUES (NULL, "Trillas", "AV. 20 DE NOVIEMBRE #61 Col. Centro", "23456789");
INSERT INTO Editorial
VALUES (NULL, "Pearson", "AV. INDEPENDENCIA #956 COL. PIRAGUA", "56565655");
INSERT INTO Editorial
VALUES (NULL, "McGrawHill", "AV. 5 DE MAYO #67 COL. TUXTEPEC", "32222224");
INSERT INTO Editorial
VALUES (NULL, "AlfaOmega", "BLVD. BENITO JUAREZ #78 COL. TUXTEPEC", "87876887");
INSERT INTO Editorial
VALUES (NULL, "Thomsomp", "ADOLFO LOPEZ MATEOS #12 COL. TUXTEPEC", "12345678");
INSERT INTO Editorial
VALUES (NULL, "Libertad", "AV. MANCILLA ESQ. ALDAMA COL. LAZARO CARDENAS", "98654332");

INSERT INTO Tema
VALUES (NULL, "Programación");
INSERT INTO Tema
VALUES (NULL, "Biología");
INSERT INTO Tema
VALUES (NULL, "Economía / Marketing");
INSERT INTO Tema
VALUES (NULL, "Administración de empresas");
INSERT INTO Tema
VALUES (NULL, "Química");
INSERT INTO Tema
VALUES (NULL, "Ingeniería");

INSERT INTO Socio
VALUES (NULL, "Alfredo Hernández Mendoza", "Dirección 1", "alfred123@gmail.com", "12345678", 'Foto_1.png');
INSERT INTO Socio
VALUES (NULL, "Juan Alberto Ramírez Sandoval", "Dirección 2", "juanal_66@hotmail.com", "91847567", 'Foto_2.png');
INSERT INTO Socio
VALUES (NULL, "Enrique Alberto García Aguado", "Dirección 3", "", "22885534", 'Foto_3.png');
INSERT INTO Socio
VALUES (NULL, "Esmeralda López Cabrera", "Dirección 4", "esme27_p@yahoo.com.mx", "45263489", 'Foto_4.png');
INSERT INTO Socio
VALUES (NULL, "Janeth Soto Cruz", "Dirección 5", "janeth11@hotmail.com", "64829164", 'Foto_5.png');
INSERT INTO Socio
VALUES (NULL, "Marco Antonio Pérez Díaz", "Dirección 6", "makr@gmail.com", "88335522", 'Foto_6.png');

INSERT INTO Libro
VALUES (NULL, "1234567891", "El Lengu de Prgramación C", 27, 1, 4, 1);
INSERT INTO Libro
VALUES (NULL, "1357935799", "Fundamentos de Programación", 12, 1, 6, 1);
INSERT INTO Libro
VALUES (NULL, "1010345655", "The Book of Ruby", 9, 1, 5, 1);
INSERT INTO Libro
VALUES (NULL, "3456789212", "Programación en C/C++", 25, 1, 3, 1);
INSERT INTO Libro
VALUES (NULL, "7578799145", "Introducción a la teoría general de la administración", 45, 6, 2, 4);
INSERT INTO Libro
VALUES (NULL, "3238845533", "Administración Moderna", 12, 6, 1, 4);
INSERT INTO Libro
VALUES (NULL, "5267174899", "Generación de Modelos de Negocio", 16, 6, 1, 4);
INSERT INTO Libro
VALUES (NULL, "2456789011", "Fundamentos de Administración Financiera", 99, 6, 1, 4);
INSERT INTO Libro
VALUES (NULL, "3454565890", "Invitación a la Biología", 11, 3, 1, 2);
INSERT INTO Libro
VALUES (NULL, "2224579900", "Biología molecular de la célula", 14, 3, 1, 2);
INSERT INTO Libro
VALUES (NULL, "0988277777", "Biología: ciencia y naturaleza", 22, 3, 1, 2);
INSERT INTO Libro
VALUES (NULL, "6372653847", "Atlas de Biología", 1, 3, 1, 2);
INSERT INTO Libro
VALUES (NULL, "9823525255", "Sistemas de Control para Ingeniería", 5, 4, 1, 6);
INSERT INTO Libro
VALUES (NULL, "2324611234", "Circuitos Eléctricos", 10, 4, 1, 6);
INSERT INTO Libro
VALUES (NULL, "7774828288", "Sismas de Comunicaciones", 7, 4, 1, 6);
INSERT INTO Libro
VALUES (NULL, "2343454577", "Química General", 2, 5, 1, 5);
INSERT INTO Libro
VALUES (NULL, "5568883333", "Química Orgánica", 3, 5, 1, 5);
INSERT INTO Libro
VALUES (NULL, "1111166988", "Principios de Economía", 1, 2, 1, 3);
INSERT INTO Libro
VALUES (NULL, "0044523255", "La riqueza de las naciones", 4, 2, 1, 3);
INSERT INTO Libro
VALUES (NULL, "5767676722", "Economía y Sociedad", 17, 2, 1, 3);
INSERT INTO Libro
VALUES (NULL, "3235567986", "Marketi de Guerra", 1, 2, 1, 3);
INSERT INTO Libro
VALUES (NULL, "32358667986", "sdsdsadsa", 1, 2, 1, 3);

INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 1, 6);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-24", 4, 4);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-27", 5, 1);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-01-14", 1, 2);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 3, 3);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 1, 5);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-31", 4, 3);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-12-28", 5, 19);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-02-20", 4, 5);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-02-21", 1, 12);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 1, 15);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-24", 4, 4);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-27", 5, 1);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-01-14", 1, 7);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 3, 8);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-25", 1, 9);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2016-12-31", 4, 10);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-12-28", 5, 11);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-02-20", 4, 18);
INSERT INTO Prestamo
VALUES (NULL, NOW(), "2017-02-21", 1, 20);


-- select Libro join Autor (name), Editorial (name) and Tema (name) and filter by ISBN
select idLibro, ISBN, Titulo, NumeroEjemplares,  A.NombreAutor, E.NombreEditorial, T.NombreTema from Libro
inner join Autor A on A.idAutor = Libro.idAutor
inner join Editorial E on E.idEditorial = Libro.idEditorial
inner join Tema T on T.idTema = Libro.idTema
where ISBN  like '%123%'
order by Libro.idLibro desc ;


select * from Libro;
