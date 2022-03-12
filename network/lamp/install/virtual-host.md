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

  * No servidor www.grupox.turma914.ifalara.local faça:

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
  * Edite o arquivo ``www.grupox.turma914.ifalara.local.conf`` como segue:

@include[www.grupox.turma914.ifalara.local.conf](https://github.com/alaelson/labredes2021/blob/main/network/lamp/siteDemo/www.grupox.turma914.ifalara.local.conf)




        
