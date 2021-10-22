

# Instalação 
   * O BIND9 é a aplicação de DNS que roda no servidor.
   * Instalar o bind9 via apt-get
```bash
$ sudo apt-get install bind9 dnsutils bind9-doc 
```
   * Verifique o status do serviço:
```bash
$ sudo systemctl status bind9
```
   * Se não estiver rodando:
```bash
$ sudo systemctl enable bind9
```



## Diretórios do bind
   * Os arquivos do bind ficam na no diretório **/etc/bind**. 
```bash
$ ls /etc/bind
```
```
total 64
drwxr-sr-x  3 root bind 4096 Oct 15 09:06 .
drwxr-xr-x 94 root root 4096 Oct  8 23:29 ..
-rw-r--r--  1 root root 2761 Aug  7 14:43 bind.keys
-rw-r--r--  1 root root  237 Aug  7 14:43 db.0
-rw-r--r--  1 root root  271 Aug  7 14:43 db.127
-rw-r--r--  1 root root  237 Aug  7 14:43 db.255
-rw-r--r--  1 root root  353 Aug  7 14:43 db.empty
-rw-r--r--  1 root root  270 Aug  7 14:43 db.local
-rw-r--r--  1 root root 3171 Aug  7 14:43 db.root
-rw-r--r--  1 root bind  463 Aug  7 14:43 named.conf
-rw-r--r--  1 root bind  490 Aug  7 14:43 named.conf.default-zones
-rw-r--r--  1 root bind  468 Oct 15 05:42 named.conf.local
-rw-r--r--  1 root bind  881 Sep 19 15:08 named.conf.options
-rw-r-----  1 bind bind   77 Sep 19 14:48 rndc.key
-rw-r--r--  1 root root 1317 Aug  7 14:43 zones.rfc1918
```

### Zonas
   * As zonas são especificadas em arquivos **db**. Vamos criar um diretório para armazendar os arquivos de zonas, que sera o diretório ***/etc/bind/zones***  
```bash
$ sudo mkdir /etc/bind/zones
```

#### Criar arquivos db
   * Criar o arquivo **db** no diretório ***/etc/bind/zones***. 
   * Os arquivos **db** são bancos de dados de resolução de nomes, ou seja, quando se sabe o nome da máquina mas não se conhece o IP. Cada zona no DNS deve ter seu próprio arquivo **db**, por exemplo: a zona *meusite.com.br* terá o arquivo **db.meusite.com.br**, já a zona *outrosite.net* terá o arquivo **db.outrosite.net**. 
   * No nosso caso o domínio/zona local será labredes.ifalarapiraca.local. Assim o arquivo db será db.labredes.ifalarapiraca.local
   
##### zona direta
   * o arquivo db.labredes.ifalarapiraca.local conterá os nomes das máquinas do domínio labredes.ifalarapiraca.local
   * Para isso faremos uma cópia do arquivo /etc/bind/db.empty
```bash
$ sudo cp /etc/bind/db.empty /etc/bind/zones/db.labredes.ifalarapiraca.local 
```

##### zona reversa
   * Utilizado quando não se conhece o IP mas sabe-se o nome do host.
   * vamos criar a zona reversa a partir do arquivo /etc/bind/db.127
```bash
  $ sudo cp /etc/bind/db.127 /etc/bind/zones/db.10.9.14.rev
```

   * Assim, o arquivo **db.10.9.14.rev** conterá a zona reversa da rede 10.9.14.0. 

   
### Editar arquivos db:

   #### zona direta: db.labredes.ifalarapiraca.local
   * edite o arquivo  **db.labredes.ifalarapiraca.local** para adcionar as informações do seu domínio
      * As linhas iniciadas com **;** são comentários 
      
```bash   
    $ sudo nano db.labredes.ifalarapiraca.local 
```
---
```
;
; BIND data file for internal network
;
$ORIGIN labredes.ifalarapiraca.local.
$TTL	3h
@	IN	SOA	ns1.labredes.ifalarapiraca.local. root.labredes.ifalarapiraca.local. (
			      1		; Serial
			      3h	; Refresh
			      1h	; Retry
			      1w	; Expire
			      1h )	; Negative Cache TTL
;nameservers
@	IN	NS	ns1.labredes.ifalarapiraca.local.
@	IN	NS	ns2.labredes.ifalarapiraca.local.
;hosts
ns1.labredes.ifalarapiraca.local.	  IN	A	10.9.14.10
ns2.labredes.ifalarapiraca.local.	  IN	A	10.9.14.11
dh1.labredes.ifalarapiraca.local.	  IN	A	10.9.14.100
gw.labredes.ifalarapiraca.local.	  IN 	A	10.9.14.1          
desktophost1    CNAME     dh1                 ; CNAME é um apelido
```

---
   #### zona reversa: db.10.9.14.rev
   * edite o arquivo **db.10.9.14.rev** para adcionar as informações da zona reversa
      * As linhas iniciadas com **;** são comentários.
   
---
```
;
; BIND reverse data file of reverse zone for local area network 10.9.14.0/24
;
$TTL    604800
@       IN      SOA     labredes.ifalarapiraca.local. root.labredes.ifalarapiraca.local. (
                              1         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL

; name servers
@      IN      NS      ns1.labredes.ifalarapiraca.local.
@      IN      NS      ns2.labredes.ifalarapiraca.local.

; PTR Records
10   IN      PTR     ns1.labredes.ifalarapiraca.local.              ; 10.9.14.10
11   IN      PTR     ns2.labredes.ifalarapiraca.local.              ; 10.9.14.11
100  IN      PTR     dh1.labredes.ifalarapiraca.local.    	    ; 10.9.14.100
1    IN      PTR     gw.labredes.ifalarapiraca.local.               ; 10.9.14.1
```
---

### Configuração do named.conf.local
   * Para ativar as zonas descritas nos arquivos **db** deve-se editar o arquivo de configuracão do bind para informar onde eles foram salvos. As zonas são adicionadas em **/etc/bind/named.conf.local**.
   
```bash
$ sudo nano /etc/bind/named.conf.local
```
---
```
//
// Do any local configuration here
//

// Consider adding the 1918 zones here, if they are not used in your
// organization
//include "/etc/bind/zones.rfc1918";

zone "labredes.ifalarapiraca.local" {
	type master;
	file "/etc/bind/zones/db.labredes.ifalarapiraca.local";
	allow-transfer{ 10.9.14.11; };  
	allow-query{any;};
};

zone "14.9.10.in-addr.arpa" IN {
	type master;
	file "/etc/bind/zones/db.10.9.14.rev";
	allow-transfer{ 10.9.14.11; };
};
```
---

### Verificação de sintaxe 
   * Para checar a sintaxe de configuração do BIND deve-se executar o comando named-checkconf. Este scritp checa os arquivos /etc/bind/named.conf.local.*

```bash
$sudo named-checkconf
```

###  Verificar a sintaxe dos arquivos de dados
   * Para verificar se a formatação da sintaxe dos arquivos db está correta, utiliza-se o script named-checkconf da seguinte forma: ***named-check-zone <zone> <db_file>***

```bash
$ cd /etc/bind/zones
$ sudo named-checkzone labredes.ifalarapiraca.local db.labredes.ifalarapiraca.local
zone labredes.ifalarapiraca.local/IN: loaded serial 1
OK
$ sudo named-checkzone 14.9.10.in-addr.arpa db.10.9.14.rev
zone 14.9.10.in-addr.arpa/IN: loaded serial 1
OK
```

### Configure para somente resolver endereços IPv4

```bash
$sudo nano /etc/default/named
```
- adicione a linha ***OPTIONS="-4 -u bind"***
```#
# run resolvconf?
RESOLVCONF=no

# startup options for the server
OPTIONS="-4 -u bind"
```


### Execute o BIND 
```bash
$ sudo systemctl enable bind9
$ sudo systemctl restart bind9
```

### Configuração dos clientes
   * Configure o dns no nas máquina ns1, ns2 e us adicionando os campos abaixo na interface de rede local deses servidores. Observe que na máquina gw essa configuração deve ser inserida na interface de rede local (enp0s8)
```
            nameservers: 
                addresses:
                - 10.9.14.10
                - 10.9.14.11
                search: [labredes.ifalarapiraca.local]
```
   * O arquivo de configuração do netplan ficará da seguinte forma:

```bash
$ sudo nano /etc/netplan/50-cloud-init.yaml 

network:
    ethernets:
        enp0s3:                        # interface local
            addresses: [10.9.14.10/24]  # ip/mascara
            gateway4: 10.9.14.1         # ip do gateway
            dhcp4: false               # 'false' para conf. estatica 
            nameservers:               # servidores dns
                addresses:
                - 10.9.14.10            # ip do ns1
                - 10.9.14.11            # ip do ns2
                search: [labredes.ifalarapiraca.local]  # domínio
    version: 2
```

   * o campo search indica o nome do domínio no qual a máquina pertence.
   
   
---
### Testando o servidor DNS:

#### Teste de configuração como cliente. 
   * Observe se os campos **DNS servers** e **DNS Domain** estão corretos.
```bash
$ systemd-resolve --status enp0s3
```
```
Link 2 (enp0s3)
      Current Scopes: DNS
       LLMNR setting: yes
MulticastDNS setting: no
      DNSSEC setting: no
    DNSSEC supported: no
         DNS Servers: 10.9.14.10
                      10.9.14.11
         DNS Domain: labredes.ifalarapiraca.local
```
---
#### Teste o serviço DNS para a máquina ns1. 
   * Veja a resposta em **ANSWER SECTION**.
```bash
$ dig ns1.labredes.ifalarapiraca.local
```

```
; <<>> DiG 9.11.3-1ubuntu1.9-Ubuntu <<>> ns1.labredes.ifalarapiraca.local
;; global options: +cmd
;; Got answer:
;; WARNING: .local is reserved for Multicast DNS
;; You are currently testing what happens when an mDNS query is leaked to DNS
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 47542
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 65494
;; QUESTION SECTION:
;ns1.labredes.ifalarapiraca.local. IN	A

;; ANSWER SECTION:
ns1.labredes.ifalarapiraca.local. 5204 IN A	10.9.14.10

;; Query time: 0 msec
;; SERVER: 127.0.0.53#53(127.0.0.53)
;; WHEN: Tue Oct 15 06:02:20 UTC 2019
;; MSG SIZE  rcvd: 7
```
---

#### Teste o serviço DNS reverso para a máquina ns1. 
```bash    
$ dig -x 10.9.14.10
```
```
; <<>> DiG 9.11.3-1ubuntu1.9-Ubuntu <<>> -x 10.9.14.10
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 48674
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 65494
;; QUESTION SECTION:
;10.9.14.10.in-addr.arpa.		IN	PTR

;; ANSWER SECTION:
10.9.14.10.in-addr.arpa.	6141	IN	PTR	ns1.labredes.ifalarapiraca.local.

;; Query time: 0 msec
;; SERVER: 127.0.0.53#53(127.0.0.53)
;; WHEN: Tue Oct 15 06:01:23 UTC 2019
;; MSG SIZE  rcvd: 97
```
---
#### Teste o serviço DNS reverso para a máquina ns2. 
```bash  
$ dig -x 10.9.14.11
```
```
; <<>> DiG 9.11.3-1ubuntu1.9-Ubuntu <<>> -x 10.9.14.11
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 56462
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 65494
;; QUESTION SECTION:
;11.14.9.10.in-addr.arpa.		IN	PTR

;; ANSWER SECTION:
11.14.9.10.in-addr.arpa.	6177	IN	PTR	ns2.labredes.ifalarapiraca.local.

;; Query time: 0 msec
;; SERVER: 127.0.0.53#53(127.0.0.53)
;; WHEN: Tue Oct 15 06:01:01 UTC 2019
;; MSG SIZE  rcvd: 97
```
---

# Exercícios

   1. Faça login no *gw* e **ping** para as máquinas *ns1*, *ns2*, e *dh1*.
   2. Faça login no *ns1* e **ping** para as máquinas *ns2*, *gw*, e *dh1*.
   3. Faça login no *ns2* e **ping** para as máquinas *ns1*, *gw*, e *dh1*.
   4. Faça login no *dh1* e **ping** para as máquinas *gw*, *ns1* e *ns2*.
   5. Faça login no *gw* e **nslookup** para *ns1*, *ns2*, e *dh1*.
   6. Faça login no *ns1* e **nslookup** para as máquinas *ns2*, *gw*, e *dh1*.
   7. Faça login no *ns2* e **nslookup** para as máquinas *ns1*, *gw*, e *dh1*.
   8. Faça login no *dh1* e **nslookup** para as máquinas *gw*, *ns1* e *ns2*.
   9. Faça login no *gw* e **dig** para *ns1*, *ns2*, e *dh1*.
   10. Faça login no *ns1* e **dig** para as máquinas *ns2*, *gw*, e *dh1*.
   11. Faça login no *ns2* e **dig** para as máquinas *ns1*, *gw*, e *dh1*.
   12. Faça login no *dh1* e **dig** para as máquinas *gw*, *ns1* e *ns2*.
   13. Faça login no *gw* e **dig -x** para os IPs de *ns1*, *ns2*, e *dh1*.
   14. Faça login no *ns1* e **dig -x** para os IPs de *ns2*, *gw*, e *dh1*.
   15. Faça login no *ns2* e **dig -x** para os IPs de *ns1*, *gw*, e *dh1*.
   16. Faça login no *dh1* e **dig -x** para os IPs de *gw*, *ns1* e *ns2*.

