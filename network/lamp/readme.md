# Servidor Web com LAMP (Linux+Apache+PHP+MySQL)

* O primeiro passo é definir as informações de nomes e endereços IP para cada host/servidor que pertence a sua rede.
* As configurações do servidor Web requer estão de acordo com os requisitos do projeto final, em que os servidores web (www) e de banco de dados (mysql) devem ser instalados em máquinas diferentes. 
* As configurações de segurança nos dois servidores ficarão a cargo do firewall que irá rodar o servidor de NAT/Gateway da rede. Criando então uma DMZ para os servidores WEB e BD. Por isso, não irei ativar qualquer fiwewall nas máquinas de BD e WWW. 
* Relembre as definições de rede nas Tabelas 1 e 2, relativas as turams 914 e 924, respectivamente.


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

* O primeiro passo é instalar o servidor web Apache. Para isso deve-se utilizar a máquina que foi selecionada para ser o servidor www do seu grupo, conforme as Tabelas 1 e 2. 

### Configuração do Apache 2

* Para a instalação e configuração básica do servidor web Apache, [clique aqui](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/apache2-server.md)

### Configuração do PHP7.4

* Para a instalação e configuração básica do compilador PHP7.4 e do módulo para o Apache, [clique aqui](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/php7.md)

### Configuração do Virtual-Host no Servidor Web

* Para configurar a url do seu site web no Apache, [clique aqui](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/virtual-host.md)

### Configuração do Web LAMP (Linux+Apache+PHP+Mysql)

* Para realizar a configuração do serviço Web com LAMP, [clique aqui](https://github.com/alaelson/labredes2021/blob/master/network/lamp/readme.md)

### Configuração do gateway server/NAT

* Para realizar a configuração de um servidor de gateway com Iptables/NAT, [clique aqui](https://github.com/alaelson/labredes2021/blob/master/network/nat/readme.md)
