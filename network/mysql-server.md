# Configuração do servidor de banco de dados com MySQL 8

## Relembre as definições de rede na Tabelas 1 e 2, relativas as turams 914 e 924, respectivamente.


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
| samba       | 10.9.24.56    | samba.grupox.turma924.ifalara.local       |

# Instalação 
   * O MySQL server é um dos Sistemas de Gerenciamento de Banco de Dados (SGBD) mais utilizados no mundo, e tem distribuições para diversos sistemas operacionais.
   * Neste roteiro utilizaremos o Ubuntu Server 20.04.4 LTS
   * É sempre recomendado atualizar os pacotes de repositórios e software:
```bash
$ sudo apt update | sudo apt upgrade -y
```
   * Para instalar o mysql digite:
```bash
$ sudo apt install mysql-server
```
   * Verifique o status do serviço:
```bash
$ systemctl status mysql
● mysql.service - MySQL Community Server
     Loaded: loaded (/lib/systemd/system/mysql.service; enabled; vendor preset: enabled)
     Active: active (running) since Tue 2022-03-08 12:28:49 UTC; 3h 3min ago
   Main PID: 17038 (mysqld)
     Status: "Server is operational"
      Tasks: 37 (limit: 462)
     Memory: 56.0M
     CGroup: /system.slice/mysql.service
             └─17038 /usr/sbin/mysqld
```
  * O MySQL roda na porta 3306, para verificar se está recebendo conexões, use o netstat:

```bash
$ netstat -an | grep LISTEN
tcp        0      0 127.0.0.1:33060         0.0.0.0:*               LISTEN     
tcp        0      0 127.0.0.1:3306          0.0.0.0:*               LISTEN
tcp        0      0 127.0.0.53:53           0.0.0.0:*               LISTEN     
tcp        0      0 0.0.0.0:22              0.0.0.0:*               LISTEN     
tcp6       0      0 :::22                   :::*                    LISTEN     
```
  * Note que a porta 3306 e a porta 33060 estão recebendo conexões TCP somente na interface 127.0.0.1. Então é preciso liberar acesso nas demais interfaces.
  * O MySQL faz isso linkando o acesso na porta 33060 às interfaces de rede.
  * Para isso edite o arquivo ```/etc/mysql/mysql.conf.d/mysqld.cnf```.
  * Encontre:
```bash
# localhost which is more compatible and is not less secure.
bind-address            = 127.0.0.1
mysqlx-bind-address     = 127.0.0.1
```
  * Então edite a linha ``mysqlx-bind-address     = 127.0.0.1`` para ``mysqlx-bind-address     = 0.0.0.0``.
```bash
# localhost which is more compatible and is not less secure.
bind-address            = 127.0.0.1
mysqlx-bind-address     = 0.0.0.0
```
  * restart o mysql:
```bash
$ systemctl restart mysql
```
  * agora o MySQL está recendo conexões em todas as interface através o IP coringa 0.0.0.0
```bash
$ netstat -an | grep LISTEN
tcp        0      0 0.0.0.0:33060           0.0.0.0:*               LISTEN     
tcp        0      0 127.0.0.1:3306          0.0.0.0:*               LISTEN
tcp        0      0 127.0.0.53:53           0.0.0.0:*               LISTEN     
tcp        0      0 0.0.0.0:22              0.0.0.0:*               LISTEN     
tcp6       0      0 :::22                   :::*                    LISTEN     
```
 ### Segurança
 * É sempre importante utilizar senhas fortes em qualquer serviço remoto. Para tal o MySQL provê uma interface de configuração de segurança de senha: ```mysql_secure_installation```

```bash
$ sudo mysql_secure_installation

Securing the MySQL server deployment.

Connecting to MySQL using a blank password.

VALIDATE PASSWORD COMPONENT can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD component?

Press y|Y for Yes, any other key for No:
```
 * Ao digitar **Yes** será inicada a configuração da política de senhas, há 3 opções:

```
Press y|Y for Yes, any other key for No: y

There are three levels of password validation policy:

LOW    Length >= 8
MEDIUM Length >= 8, numeric, mixed case, and special characters
STRONG Length >= 8, numeric, mixed case, special characters and dictionary                  file

Please enter 0 = LOW, 1 = MEDIUM and 2 = STRONG: 

```
  * Digitando a opção **2=STRONG** será precico fornecer uma senha com números, letras maiúsculas de minúsculas e com caracteres especiais para root: ``S3nh4@ifal`` e responda as outras perguntas.

```
Please set the password for root here.

New password: 

Re-enter new password: 

Estimated strength of the password: 100 
Do you wish to continue with the password provided?(Press y|Y for Yes, any other key for No) : y
By default, a MySQL installation has an anonymous user,
allowing anyone to log into MySQL without having to have
a user account created for them. This is intended only for
testing, and to make the installation go a bit smoother.
You should remove them before moving into a production
environment.

Remove anonymous users? (Press y|Y for Yes, any other key for No) : y
Success.


Normally, root should only be allowed to connect from
'localhost'. This ensures that someone cannot guess at
the root password from the network.

Disallow root login remotely? (Press y|Y for Yes, any other key for No) : y
Success.

By default, MySQL comes with a database named 'test' that
anyone can access. This is also intended only for testing,
and should be removed before moving into a production
environment.


Remove test database and access to it? (Press y|Y for Yes, any other key for No) : n

 ... skipping.
Reloading the privilege tables will ensure that all changes
made so far will take effect immediately.

Reload privilege tables now? (Press y|Y for Yes, any other key for No) : y
Success.

All done! 
```

