# Configuração do servidor Web Apache 2.0

## Relembre as definições de rede na Tabela 1


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

<p><center> Tabela 1: Definições da rede interna turma 924</center></p>

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
   * Apache é o servidor HTTP mais utilizado no mundo, e tem distribuições para diversos sistemas operacionais.
   * Neste roteiro utilizaremos o Ubuntu Server 20.04.4 LTS
   * É sempre recomendado atualizar os pacotes de repositórios e software:
```bash
$ sudo apt update | sudo apt upgrade -y
```
   * Para instalar o apache digite:
```bash
$ sudo apt install -y apache2 apache2-utils
```
   * Verifique o status do serviço:
```bash
$systemctl status apache2
```

```
$ systemctl status apache2
● apache2.service - The Apache HTTP Server
     Loaded: loaded (/lib/systemd/system/apache2.service; enabled; vendor preset: enabled)
     Active: active (running) since Sun 2022-03-06 19:19:04 UTC; 24s ago
       Docs: https://httpd.apache.org/docs/2.4/
   Main PID: 10597 (apache2)
      Tasks: 55 (limit: 462)
     Memory: 5.3M
     CGroup: /system.slice/apache2.service
             ├─10597 /usr/sbin/apache2 -k start
             ├─10599 /usr/sbin/apache2 -k start
             └─10600 /usr/sbin/apache2 -k start

Mar 06 19:19:04 ubuntu-server-lts systemd[1]: Starting The Apache HTTP Server...
Mar 06 19:19:04 ubuntu-server-lts apachectl[10596]: AH00558: apache2: Could not reliably determine the server's>
Mar 06 19:19:04 ubuntu-server-lts systemd[1]: Started The Apache HTTP Server.
```
   * Se não estiver rodando:
```bash
$ sudo systemctl start apache2
```
   * Para permitir que o Apache inicie automaticamente no momento da inicialização do sistema, digite:
```bash
$ sudo systemctl enable apache2
```

```
$ systemctl enable apache2
Synchronizing state of apache2.service with SysV service script with /lib/systemd/systemd-sysv-install.
Executing: /lib/systemd/systemd-sysv-install enable apache2
==== AUTHENTICATING FOR org.freedesktop.systemd1.reload-daemon ===
Authentication is required to reload the systemd state.
Authenticating as: Administrador (administrador)
Password: 
==== AUTHENTICATION COMPLETE ===
```
   * Outros comandos de controle do Apache:
```bash
$ systemctl is-active apache2
$ systemctl is-enabled apache2
```
   * Stop Apache:
```bash
sudo systemctl stop apache2.service
```
   * Start Apache:
```bash
sudo systemctl start apache2.service
```
   * Restart Apache:
```bash
sudo systemctl restart apache2.service
```
   * Reload Apache:
```bash
sudo systemctl reload apache2.service
``` 
   * Disable Apache:
```bash
sudo systemctl disable apache2.service
``` 
   * Verifique a versão do Apache
```bash
$ apache2 -v
```

## Diretórios do Apache
   * Os arquivos do bind ficam na no diretório **/etc/bind**. 
```bash
$ ls -la /etc/apache2/
```

```
-rw-r--r--  1 root root  7224 Jan  5 14:49 apache2.conf
drwxr-xr-x  2 root root  4096 Mar  7 13:03 conf-available
drwxr-xr-x  2 root root  4096 Mar  7 13:03 conf-enabled
-rw-r--r--  1 root root  1782 Sep 30  2020 envvars
-rw-r--r--  1 root root 31063 Sep 30  2020 magic
drwxr-xr-x  2 root root 16384 Mar  7 12:50 mods-available
drwxr-xr-x  2 root root  4096 Mar  6 19:19 mods-enabled
-rw-r--r--  1 root root   320 Sep 30  2020 ports.conf
drwxr-xr-x  2 root root  4096 Mar  7 12:50 sites-available
drwxr-xr-x  2 root root  4096 Mar  6 19:19 sites-enabled
```
 * No diretório /etc/apache2 encontramos os principais arquivos de configuração do servidor Web Apache:

    * /etc/apache2/apache2.conf – Arquivo principal que contém todas as configurações do servidor Web.
    * /etc/apache2/conf-available – armazenda as configurações do sites available (que estão disponíveis no servidor).
    * /etc/apache2/conf-enabled – contém as configurações dos sites enabled (que estão habilitados para acesso).
    * /etc/apache2/mods-available – contém os módulos available (disponíveis no apache).
    * /etc/apache2/mods-enabled – contém os módulos (enabled) habilitados no servidor Web.
    * /etc/apache2/sites-available – contém os arquivos de configuração de virtual hosts dos sites-available.
    * /etc/apache2/sites-enabled – contém os arquivos de configuração de virtual hosts dos sites-enabled.


  * Os arquivos do site em si ficam localizados na pasta ```/var/www```. a exemplo da homepage padrão de instalação do Apache, que fica na pasta ```/var/www/html```.
  
```bash
$ ls -la /var/www
drwxr-xr-x  2 root root 4096 Mar  7 15:20 html
```
 
  * Vemos que a pasta html possui dono a some root ler e escrever. Vamos definir www-data (usuário do Apache) como o proprietário da raiz do documento (também conhecida como raiz da web). 
```bash
sudo chown www-data:www-data /var/www/html/ -R 
$ ls -la /var/www
drwxr-xr-x  2 www-data www-data 4096 Mar  7 15:21 html
```
  * Quando fazemos a instalação do Apache o home do host do sistema ainda não foi definido. Por isso acontece um erro quando executamos o comando ```apache2ctl -t ```
```bash
$ apache2ctl -t 
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 127.0.1.1. Set the 'ServerName' directive globally to suppress this message
Syntax OK 
```
  * Para corrigir deve-se alterar a configuração global do apache sentando-se a variável **ServerName**. Podemos fazer isso tanto no arquivo /etc/apache2/apache2.conf ou de forma mais elegante definindo como uma configuração em separado:
```bash
$ sudo tourch /etc/apache2/conf-available/servername.conf
```
  * Escreva a seguinte linha no arquivo servername.conf usando seu editor preferido (vi ou nano):
```
ServerName localhost
```

  * Salve e feche o arquivo.
  * Habilite este arquivo de configuração.
```bash
sudo a2enconf servername.conf
```
  * Recarregue o Apache para que a alteração tenha efeito.
```bash
sudo systemctl reload apache2
```
  * Verifique se há erros de sintax com:
```bash
$ apache2ctl -t 
```

 * OBS: Para desabilitar uma configuração use ```a2disconf```

Para acessar seu site use o ip do servidor no seu browser. 
Exemplo para acessar este servidor:
```
http://10.9.14.54
```

  * um browser bem legal de terminal é o Lynx que você pode instalar via apt.


# Exercícios

   1. Após instalar o apache2 no seu servidor altere o arquivo ```/var/www/html/index.html``` e adicione o código:
```html
<html>
<head>
<title>Hello World Home Page</title>
</head>
<body>
<h1>I'd like to say hello to every one in the world!</h1>
<h2>I'd link to thank my best professor in IFAL :)</h2>
</body>
</html>
```

