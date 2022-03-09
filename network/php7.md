# Configuração do servidor Web para suporte ao PHP 7.4

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
   * O PHP7.4 é a versão mais recente do PHP7, é estável e é a versão mais utilizada para aplicações Web baseadas em PHP. Para informações e outras versões do PHP consulte a página [php.net](https://www.php.net/).
   * Neste roteiro utilizaremos o Ubuntu Server 20.04.4 LTS
   * É sempre recomendado atualizar os pacotes de repositórios e software:
```bash
$ sudo apt update | sudo apt upgrade -y
```
   * Para instalar o php7.4 digite:
```bash
$ sudo apt install php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-common php7.4-json php7.4-opcache php7.4-readline
```
   * Carregue php7.4 no apache2 e reinicio o serviço.

```bash
sudo a2enmod php7.4

sudo systemctl restart apache2
```
 
  * O seu servidor WEB com php já está funcionando. Para realizar o primeiro teste crie uma página info do php que irá exibir todas as features do seu servidor WEB.
  * Crie um arquivo ```info.php``` na pasta raíz ```/var/www/html``` do seu servidor.
```bash
sudo touch /var/www/html/info.php
```
  * Edite o arquivo ```info.php``` adicinando a seguinte linha:
```
<?php phpinfo(); ?>
```

  * agora é só acessar o seu site apartir do endereço ip do seu servidor Web.
  * Neste nosso caso: 10.9.14.54

````
http://10.9.14.54/info.php
````

<p><center> Figura 1: Carregamento do arquivo info.php no servidor Web</center></p>   
   <img src="info.php.png" alt="PHP rodando com sucesso!"
	title="Informações do php7.4 no servidor Web" width="540" height="480" />

