# Scritp para criar uma database demo 
## Este script é um exemplo de database para ser utilizado no SiteDemo disponível na página do projeto final de serviços de redes.
### OBS: O database e o site demo, são somente um exemplo de aplicação PHP para testar a comunicação em rede dos servidores LAMP. Lembrando que temos um servidor de banco de dados (MySQL) em uma máquina e o servidor Web (Apache+PHP) em outra máquina como requisitos de instalação.
### OBS-2: O aluno não é obrigado a implementar a mesma aplicação Web PHP Demo deste Exemplo. O aluno está livre para implementar qualquer aplicação PHP+Mysql que deseje, desde que apresente-a no seu relatório de projeto final de serviços de redes..


###Relembre as definições de rede na Tabelas 1 e 2, relativas as turams 914 e 924, respectivamente.

<p><center> Tabela 1: Definições da rede interna turma 914</center></p>

| DESCRIÇÃO   | IP (external) | Nome FQDN                                 |
|:------------|:------------- |:------------------------------------------|
| rede        | 10.9.14.0     |                                           |
| máscara     | 255.255.255.0 |                                           |
| Broadcast   | 10.9.14.255   |                                           |
| Gateway     | 10.9.14.1     | gw-labredes.grupox.turma914.ifalara.local |
| gw          | 10.9.14.51    | gw.grupox.turma914.ifalara.local          |
| ns1         | 10.9.14.52    | ns1.grupox.turma914.ifalara.local         |
| ns2         | 10.9.14.53    | ns2.grupox.turma914.ifalara.local         |
| www         | 10.9.14.54    | www.grupox.turma914.ifalara.local         |
| bd          | 10.9.14.55    | bd.grupox.turma914.ifalara.local          |
| samba       | 10.9.14.56    | samba.grupox.turma914.ifalara.local       |

<p><center> Tabela 2: Definições da rede interna turma 924</center></p>

| DESCRIÇÃO   | IP (external) | Nome FQDN                                 |
|:------------|:------------- |:------------------------------------------|
| rede        | 10.9.24.0     |                                           |
| máscara     | 255.255.255.0 |                                           |
| Broadcast   | 10.9.24.255   |                                           |
| Gateway     | 10.9.24.1     | gw-labredes.grupox.turma924.ifalara.local |
| gw          | 10.9.24.51    | gw.grupox.turma924.ifalara.local          |
| ns1         | 10.9.24.52    | ns1.grupox.turma924.ifalara.local         |
| ns2         | 10.9.24.53    | ns2.grupox.turma924.ifalara.local         |
| www         | 10.9.24.54    | www.grupox.turma924.ifalara.local         |
| bd          | 10.9.24.55    | bd.grupox.turma924.ifalara.local          |

* Acesse a máquina que será utilizada em seu projeto final para o banco de dados MySQL. Consulte a sua própria tabela de Nomes e Endereços IPs.
* Aqui nosso servidor de banco de dados de teste está o bd da turma 914 ``IP: 10.9.14.55`` conforme a Tabela 1. O nome FQDN deste servidor é ``bd.grupox.turma914.ifalara.local``.

* carregue o script demo no seu banco de dados mysql
```bash
$ sudo mysql
mysql> source createdb.sql
mysql> exit
```
* Quais são as tabelas criadas pelo script?

* Database: ``projetofinal_sred``

1. Table ``grupo``
   Atributos:
      * **GID**: é o ID do GRUPO
      * **Nome**: é o nome do Grupo
      * **Domínio**: é o nome do domínio em formato FQDN
```
mysql> select * from grupo;
+-----+----------+--------------------------------+
| GID | Nome     | Dominio                        |
+-----+----------+--------------------------------+
|  32 | Grupo 32 | grupo32.turma914.ifalara.local |
+-----+----------+--------------------------------+
1 row in set (0.00 sec)

```
2. Table ``aluno``
   Atributos:
      * **UID**: é o ID do aluno ao ser inserido no banco
      * **Nome**: é o nome do aluno
      * **Email**: é o nome do domínio em formato FQDN
      * **GID**: é o ID do grupo no qual o aluno está vinculado
```
mysql> select * from aluno;
+-----+-----------------+----------------------+------+
| UID | Nome            | Email                | GID  |
+-----+-----------------+----------------------+------+
|   6 | Alaelson Jatoba | alaelson@ifal.edu.br |   32 |
+-----+-----------------+----------------------+------+
1 row in set (0.00 sec)

```
3. Table ``host``
   Atributos:
      * **HID**: é o ID do host
      * **VmName**: é o nome da máquina virtual que geralmetne é divulgado nas planilhas da disciplina
      * **FQDName**: é o nome da máquina atribuída na tabela de definições e nomes, a exemplo das Tabelas 1 e 2.
      * **GID**: é o ID do grupo no qual esta máquina está vinculada
```
mysql> select * from host;
+-----+--------------+------------------------------------+------+
| HID | VmName       | FQDName                            | GID  |
+-----+--------------+------------------------------------+------+
|   8 | Servidor Web | www.grupo32.turma914.ifalara.local |   32 |
+-----+--------------+------------------------------------+------+
1 row in set (0.00 sec)

```

* O script cria um usuário no mysql chamado ``pfadmin`` com senha ``4dm1n@BD``, e dá permissão de acesso a este usuário a partir do localhost e também da máquina onde irá rodar o servidor web ``IP:10.9.14.54``, conforme apresentado na Tabela 1. 

* código do arquivo createdb.sql:

```sql
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
```

* Para testar o seu banco de dados, use os scrips de teste. Para isso baixe o zip e unzip para descompactar o arquivo [script_teste_db.zip]( https://github.com/alaelson/labredes2021/blob/main/network/lamp/testedb/script_teste_db.zip) na máquina do seu servidor Web.
* Neste caso é o máquina ``10.9.14.54`` ou ``www.grupox.turma914.ifalara.local``, conforme a Tabela 1.

```bash
 $ sudo apt install zip unzip -y
```
* baixe o scritp demo para a criação do database no servidor de banco de dados do projeto final.
```bash
$ cd ~
$ curl https://github.com/alaelson/labredes2021/blob/main/network/lamp/testedb/script_teste_db.zip
$ unzip scrip_teste_db.zip
```

* Execute os scripts de teste:
* para inserir uma entrada no bd
```bash
$ sudo php insert.php
```
* para consultar a entrada no bd
```bash
$ sudo php select.php
```
* para deletar a entrada no bd
```bash
$ sudo php del.php
```
* ou para alterar a entrada no bd
```bash
$ sudo php update.php
```


#### Os grupos do projeto final de redes podem usar os códigos livremente, ou implementar novos. Contribuições também são bem vindas!!!!

Boa Sorte!


