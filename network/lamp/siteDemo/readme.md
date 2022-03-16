# Site Demo para Integração do Serviço LAMP

* Faça o download do [Site Demo](https://github.com/alaelson/labredes2021/blob/551391a34728b53de28b2251ae206b17bedc277d/network/lamp/siteDemo/www.grupox.turma914.ifalara.local.zip) após as configuração do [Virtual-Host](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/virtual-host.md) no apache e da [Configuração](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/mysql-server.md) e [Teste](https://github.com/alaelson/labredes2021/blob/main/network/lamp/install/createdatabase.md) do Servidor de Banco de dados.

* Baixe um programa sFTP para enviar o arquivo zip para o servidor DB: como Filezilla ou o WinSCP.
* Conecte ao servidor usando a porta 22 (ssh) ou especifique o protocolo sFTP.
* Procure o arquivo zip que foi baixado, então arraste e solte (drag and drop) no servidor remoto.
<p><center> Figura 1: Exemplo de uso do Filezilla para enviar um arquivo via sFTP para o servidor</center></p>   
   <img src="https://github.com/alaelson/labredes2021/blob/main/network/lamp/filezilla_send_file_to_remote_site.png" alt="Enviar arquivo para o servidor via sFTP"
	title="Figura 1: Filezilla" width="1000" height="500" />

* Depois basta descompactar todos os arquivos no seu diretório e copiá-los para o ``DocumentoRoot`` do site no servidor web.

```bash
$ unzip www.grupox.turma914.ifalara.local.zip
$ sudo cp -r www.grupox.turma914.ifalara.local /var/www/
```
* Modifique as propriedade da pasta para o usuário do apache ``www-data``.
```bash
*
$ sudo chown www-data:www-data /var/www/www.grupox.turma914.ifalara.local
$ ls -la /var/www/
total 16
drwxr-xr-x  4 root     root     4096 Mar 12 14:45 .
drwxr-xr-x 14 root     root     4096 Mar  6 19:18 ..
drwxr-xr-x  2 www-data www-data 4096 Mar 12 14:48 html
drwxr-xr-x  3 www-data www-data 4096 Mar 12 23:08 www.grupox.turma914.ifalara.local
```



### Alguns _Screen Shots_ do Site Demo:

* Home Page
<p><center> Figura 1: Execução do arquivo ``index.html`` no browser</center></p>   
   <img src="sitedemo_homepage.png" alt="Home Page"
	title="Figura 1: Execução do arquivo index.html no browser" width="540" height="480" />
* Cadastrar Dados 
<p><center> Figura 2: execução do arquivo ``insert.html`` no browser</center></p>   
   <img src="sitedemo_cadastrardados.png" alt="Cadastrar Dados"
	title="Figura 2: Cadastro" width="540" height="500" />
* Consultar Dados
<p><center> Figura 3: execução do arquivo de consulta ``consult.php`` no browser</center></p>   
   <img src="sitedemo_consultar.png" alt="Consultar Dados"
	title="Figura 3: Consultar Dados" width="540" height="360" />
* Atualizar Dados
<p><center> Figura 4: execução do arquivo de atualização ``update.html`` no browser</center></p>   
   <img src="sitedemo_atualizardados.png" alt="Atualizar Dados"
	title="Figura 4: Atualizar Dados" width="540" height="500" />
* Deletar Dados
<p><center> Figura 5: execução do arquivo de atualização ``update.html`` no browser</center></p>   
   <img src="sitedemo_atualizardados.png" alt="Deletar Dados"
	title="Figura 5: Deletar Dados" width="540" height="500" />
