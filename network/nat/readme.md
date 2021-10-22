# Introdução

   * O servidor de gateway pode através do NAT (Network Address Translation) fazer o roteamento todos as maquinas de uma rede interna (Ex.: Rede de MV no Virtualbox) para uma rede externa (Ex. Internet) utilizando somente um endereço de rede de saída. Para isso o NAT reescreve os enderecos da fonte (source address) de todos os pacotes de saída para o endereço da interface externa do gateway.

   * As definições de rede da rede externa ao gateway server estão exemplificadas na Tabela 1.

<p><center> Tabela 1: Definições da rede externa</center></p>

| DESCRIÇÃO   | IP            |
|:------------|:------------- |
| rede        | 10.0.2.0      |
| máscara     | 255.255.255.0 |
| VirtualBox (gateway)     | 10.0.2.2      |
| Broadcast   | 10.0.2.255    |

   * As definições de rede da rede interna ao gateway server estão exemplificadas na Tabela 2.

<p><center> Tabela 2: Definições da rede interna</center></p>

| DESCRIÇÃO   | IP            |
|:------------|:------------- |
| rede        | 10.0.0.0      |
| máscara     | 255.255.255.0 |
| Gateway     | 10.0.0.1      |
| Broadcast   | 10.0.0.255    |
| NameServer1 | 10.0.0.10     |
| NameServer2 | 10.0.0.11     |
| samba | 10.0.0.100   |




# Configuração do servidor Gateway como NAT

## Configuração do firewall/NAT

   * Para configurar um servidor como gateway de rede é necessário configurar o firewall do linux (iptables). 
   * as regras do iptables podem ser digitadas no terminal ou podem ser executadas em um script.
   * Com um script, pode-se inicializar as regras do firewall todas as vezes que a máquina for reinicializada.

### habilitar o firewall 
   * Vamos serguir os passos descritos em [1]:
   
   1. habilitar o firewall e permitir o acesso ssh:
```bash
 $ sudo ufw enable
 $ sudo ufw allow ssh
```
   2. habilitar o encaminhamento de pacotes das interfaces WAN para LAN, ajustando-se os parâmetros no arquivo **/etc/ufw/sysctl.conf**, removendo-se a marca de comentário (#) da seguinte linha _# net/ipv4/ip_forwarding=1_

```bash
$ sudo nano /etc/ufw/sysctl.conf
``` 
```
...
net/ipv4/ip_forwarding=1
...
```

   3. confira o nome das interfaces de rede
```bash
$ ifconfig -a
```
```
WAN interface: enp0s3 
LAN interface: enp0s8
```

   4. Configurar as interfaces de rede (netplan) 

```bash
$ sudo nano /etc/netplan/50-cloud-init.yaml 
```

```
network:
    ethernets:
        enp0s3:
            dhcp4: true
        enp0s8:
            addresses: [10.0.0.1/24]
            dhcp4: false              
    version: 2
```

```bash
$ sudo netplan apply
$ ifconfig -a
```

   5. no ubuntu 18.04 o arquivo /etc/rc.local não existe mais. Então é necessário recriá-lo.
```bash
$ sudo nano /etc/rc.local
```

   6. A seguir, adicione o seguinte script no arquivo [/etc/rc.local](rc.local)

---
```bash
#!/bin/bash

# /etc/rc.local

# Default policy to drop all incoming packets.
# Politica padrão para bloquear (drop) todos os pacotes de entrada
iptables -P INPUT DROP
iptables -P FORWARD DROP

# Accept incoming packets from localhost and the LAN interface.
# Aceita pacotes de entrada a partir das interfaces localhost e the LAN.
iptables -A INPUT -i lo -j ACCEPT
iptables -A INPUT -i enp0s8 -j ACCEPT

# Accept incoming packets from the WAN if the router initiated the connection.
# Aceita pacotes de entrada a partir da WAN se o roteador iniciou a conexao
iptables -A INPUT -i enp0s3 -m conntrack \
--ctstate ESTABLISHED,RELATED -j ACCEPT

# Forward LAN packets to the WAN.
# Encaminha os pacotes da LAN para a WAN
iptables -A FORWARD -i enp0s8 -o enp0s3 -j ACCEPT

# Forward WAN packets to the LAN if the LAN initiated the connection.
# Encaminha os pacotes WAN para a LAN se a LAN inicar a conexao.
iptables -A FORWARD -i enp0s3 -o enp0s8 -m conntrack \
--ctstate ESTABLISHED,RELATED -j ACCEPT

# NAT traffic going out the WAN interface.
# Trafego NAT sai pela interface WAN
iptables -t nat -A POSTROUTING -o enp0s3 -j MASQUERADE

# rc.local needs to exit with 0
# rc.local precisa sair com 0
exit 0
```
---
   7. converte o arquivo em executável e o torna inicializável no boot
```bash
$ sudo chmod 755 /etc/rc.local
```
   8. verificar se o firewall está funcionando
```bash
$ sudo ufw status
```
ou
```bash
$ systemctl status ufw.service
```

   9.  reiniciar a máquina
```bash
$ sudo reboot
```
   10. Nas máquinas SAMBA, NS1 e NS2 ativar o gateway (gateway4: 10.0.0.1) na interface de rede:
```bash
$ sudo nano /etc/netplan/50-cloud-init.yaml
```
```
network:
    ethernets:
        enp0s3:
            addresses: [10.0.0.11/24]
            gateway4: 10.0.0.1
            dhcp4: false
            nameservers:
                addresses:
                - 8.8.8.8
                - 8.8.4.4
                search: []
    version: 2
```


```bash
$ sudo netplan apply
$ ifconfig -a
```

  11. Encaminhamento de portas para acesso externo à serviços da rede interna.
  
  * Para permitir que o serviço de compartilhamento de arquivos esteja disponível externamente, adicione as informações do IPTABLES sobre portas, IP e Interface no arquivo /etc/rc.local conforme o exemplo abaixo, depois reinicie a máquina:
  
   a. SAMBA: Para permitir que o serviço de compartilhamento de arquivos esteja disponível externamente:
        * Portas: 445 e 139
        * Interface Externa aqui é a WAN: enp0s3
        * IP do servidor = 10.0.0.100
        
```bash
#Recebe pacotes na porta 445 da interface externa do gw e encaminha para o servidor interno na porta 445
iptables -A PREROUTING -t nat -i enp0s3 -p tcp –-dport 445 -j DNAT –-to 10.0.0.100:445
iptables -A FORWARD -p tcp -d 10.0.0.100 –-dport 445 -j ACCEPT

#Recebe pacotes na porta 139 da interface externa do gw e encaminha para o servidor interno na porta 139
iptables -A PREROUTING -t nat -i enp0s3 -p tcp –-dport 139 -j DNAT –-to 10.0.0.100:139
iptables -A FORWARD -p tcp -d 10.0.0.100 –-dport 445 -j ACCEPT
```
   b. DNS: Para permitir que o serviço de resolução de nomes (DNS) esteja disponível externamente:
        * Porta: 53
        * Interface Externa aqui é a WAN: enp0s3
        * IP do servidor nameserver1 = 10.0.0.10
        
```bash
#Recebe pacotes na porta 53 da interface externa do gw e encaminha para o servidor DNS Master interno na porta 53
iptables -A PREROUTING -t nat -i enp0s3 -p tcp –-dport 53 -j DNAT –-to 10.0.0.10:53
iptables -A FORWARD -p udp -d 10.0.0.10 –-dport 53 -j ACCEPT
```



# Referencias
   - [1] https://www.ascinc.com/blog/linux/how-to-build-a-simple-router-with-ubuntu-server-18-04-1-lts-bionic-beaver/
   - [2] https://www.thomaslaurenson.com/blog/2018/07/05/building-a-ubuntu-linux-gateway/#configure-network-address-translation


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


