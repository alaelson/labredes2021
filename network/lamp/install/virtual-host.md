# Configuração do Virtual-Host no Apache

* Recordemos as tabelas de definições de nomes e endereços IP.
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

* Para que seu site passa rodar uma url no browser ao invés do IP, são necessárias algumas configurações:
  * Seu domínio deve estar funcional no seu servidor DNS.
    * Exemplo: o ``www.grupox.turma914.ifalara.local`` é um host configurado no DNS com o IP ``10.9.14.54``.
  * Quando executamos um ping para ``www.grupox.turma914.ifalara.local`` o seu servidor DNS deve retornar o IP e depois disparar as mensagens ICMP-echo. 
  * Se esta operação der certo seu dns estará configurado certinho para o servidor web. Se falhar, verifique as configurações das interfaces de rede (clientes) e ou do serviço Bind9 (Servidor DNS).
  * Considerando que seu DNS está operacional, temos que configurar o servidor apache para que ele reconheça o nome da máquina www (ex.: ``www.grupox.turma914.ifalara.local``) como sendo a URL raíz da página, como geralmente acessamos um endereço na Internet. 

  * No servidor ``www.grupox.turma914.ifalara.local`` faça:

```bash
$ cd /etc/apache2/sites-available
$ ls -la
-rw-r--r-- 1 root root 1332 Mar 12 15:02 000-default.conf
-rw-r--r-- 1 root root 6338 Sep 30  2020 default-ssl.conf
```

  * Faça uma cópia do arquivo ``000-default.conf``para o ``www.grupox.turma914.ifalara.local.conf``, lembre-se de utilizar o nome número do seu GRUPO!!!
```bash
$ cp 000-default.conf www.grupox.turma914.ifalara.local.conf
```
  * Edite o arquivo ``www.grupox.turma914.ifalara.local.conf`` e adicione as seguintes linhas dentro o escopo ``<VirtualHost>``

```
<VirtualHost *:80>
	ServerAdmin webmaster@localhost                              # Pessoa que administra o site
	DocumentRoot /var/www/www.grupox.turma914.ifalara.local      # Diretório onde os arquivos do site ficarão
	ServerName www.grupox.turma914.ifalara.local                 # Nome do servidor, ou seja, a url raíz do site.
<\VirtualHost>
```
 * Não remover as linhas de log de erros:
```
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
```
 * Habilite seu arquivo de configuração do seu site  o seu apache:
```bash
$ sudo a2ensite www.grupox.turma914.ifalara.local.conf
Enabling site www.grupox.turma914.ifalara.local.
To activate the new configuration, you need to run:
  systemctl reload apache2
```

 * Recarregue o seu apache:
```bash
$ sudo systemclt reload apache2
```

 * Crie a pasta que vai armazenar seus arquivos do site conforme especificado no ``DocumentRoot`` no arquivo de virtual-host ``/etc/apache2/sites-available/www.grupox.turma914.ifalara.local.conf``

```
$ cd /var/www/
$ sudo mkdir www.grupox.turma914.ifalara.local
$ ls -la
```

* Modifique as permissões de dono da pasta ``DocumentRoot`` para ``www-data``, que é o usuário do apache.
```bash
$ cd /var/www
$ chown -R www-data:www-data www.grupox.turma914.ifalara.local
```
* **DICA**: sempre que adicionar arquivos ou subpastas na pasta ``DocumentRoot`` do seu site verifique as permissões dos arquivos e as modifique para ``www-data``.

* Recarregue o seu apache:
```bash
$ sudo systemclt reload apache2
```

* Agora é somente colocar os arquivos da sua página dentro da pasta ``DocumentRoot`` !!!

## Exercícios

1. Crie um arquivo ``index.html`` e insira no ``DocumentRoot`` do seu grupo. Acesse pelo browser usando a url do seu site por exemplo ``www.grupox.turma914.ifalara.local``.
2. Instale o browser de terminal ``lynx`` e acesse o seu site a partir de uma outra VM do seu grupo.
```bash
$ sudo apt install lynx -y
$ lynx www.grupox.turma914.ifalara.local
```
  * para sair pressione `q`. 

