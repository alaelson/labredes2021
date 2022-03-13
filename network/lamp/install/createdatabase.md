# Scritp para criar uma database demo como exemplo de aplicação no projeto final de serviços de redes.
### OBS: O database e o site demo, são somente um exemplo de aplicação PHP para testar a comunicação em rede dos servidores LAMP, que neste caso, temos um servidor de banco de dados (MySQL) em uma máquina e o servidor Web (Apache+PHP) em outra máquina.
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



* 
* baixe o scritp demo para a criação do database no servidor de banco de dados do projeto final.
* 
* 
```bash
$ cd ~
$ curl https://github.com/alaelson/labredes2021/blob/main/network/lamp/testedb/script_teste_db.zip
```
* carregue o script demo no seu banco de dados mysql
```bash
$ sudo mysql
mysql> source createdb.sql
mysql> exit
```


