-- Cria o database do projeto final.
CREATE DATABASE projetofinal_sred;
-- Acessa a database do projeto final
use projetofinal_sred;
-- Cria as tabelas aluno, grupo e host
CREATE TABLE aluno (UID int(10) unsigned NOT NULL AUTO_INCREMENT, Nome varchar (255), Email varchar (255), GID int,PRIMARY KEY (`UID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE grupo (GID int(10) unsigned NOT NULL, Nome varchar (255), Dominio varchar (255), PRIMARY KEY (`GID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE host (HID int(10) unsigned NOT NULL AUTO_INCREMENT, VmName varchar (255), FQDName varchar (255), GID int, PRIMARY KEY (`HID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- mostra as tabelas e os registros armazenados em cada tabela
SHOW TABLES;
SELECT * FROM aluno;
SELECT * FROM grupo;
SELECT * FROM host;
-- cria o usuario um com acesso pelo localhost: user: 'pfadmin' e senha '4dm1n@BD'
CREATE USER 'pfadmin'@'localhost' IDENTIFIED BY '4dm1n@BD';
-- concede privilegios de acesso a todas as tabelas do mysql ao usuario 'pfadmin'
GRANT ALL PRIVILEGES ON *.* TO 'pfadmin'@'localhost' WITH GRANT OPTION;

-- cria o usuario um com acesso pelo servidor web: user: 'pfadmin' e senha '4dm1n@BD'. Então coloque o IP do servidor web
CREATE USER 'pfadmin'@'10.9.14.54' IDENTIFIED BY '4dm1n@BD';
-- concede privilegios de acesso a todas as tabelas do mysql ao usuario 'pfadmin' logando remotamente pelo ip 10.9.14.54.
-- Use o IP do servidor Web do seu grupo
GRANT ALL PRIVILEGES ON *.* TO 'pfadmin'@'10.9.14.54' WITH GRANT OPTION;
exit
