DROP DATABASE base;
CREATE DATABASE base;
USE base;
CREATE TABLE tabla (IDobj INT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(16), edad INT(2));
INSERT INTO tabla (IDobj, nombre, edad) VALUES (0, "hola", 100);
INSERT INTO tabla (nombre, edad) VALUES ("hola", 100);
INSERT INTO tabla (nombre, edad) VALUES ("asdfasfd", 1500);
INSERT INTO tabla (nombre, edad) VALUES ("aaaaa", 40);
CREATE TABLE archivos (IDobj INT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(16), tipo VARCHAR(16), contenido LONGBLOB)
/*--borrando lo que ya haya
asdf*/