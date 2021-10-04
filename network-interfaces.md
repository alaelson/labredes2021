## Configuração estática do DNS na interface de rede do Ubuntu Server 20.04 

* Para que a máquina acesse os sites e hosts remotos por meio de nomes (Ex. www.google.com) é necessário adcionar os nameservers na configuração da interface de rede.
* Para isso é configure o arquivo YAML que encontra-se na pasta **/etc/netplan/**.
* Verifique o nome correto do arquivo no seu servidor. No exemplo a seguir, o nome do arquivo é ***00-installer-config.yaml***

-  Edite o arquivo  ***00-installer-config.yaml*** 

```bash
$ sudo nano /etc/netplan/00-installer-config.yaml
```

-  Adicione as linhas para a configuração estática do IP. [Baixe o arquivo 00-installer-config.yaml](https://github.com/alaelson/labredes2020/blob/master/network/interface-config/00-installer-config.yaml)
```
network:
    ethernets:
        ens160:                           # nome da interface que está sendo configurada. Verifique com o comando 'ifconfig -a'
            addresses: [10.0.0.11/24]     # IP e Máscara do Host. Aqui é só um exemplo, tenha certeza do IP do seu host, ou perderá o acesso remoto.
            gateway4: 10.0.0.1            # IP do Gateway, Aqui é só um exemplo, tenha certeza do IP do seu gateway, ou perderá o acesso remoto.
            dhcp4: false                  # dhcp4 false -> cliente DHCP está desabilitado, logo o utilizará o IP do campo 'addresses'
            nameservers:
                addresses:
                   - 8.8.8.8              # IP do servidor de nomes 1, neste caso é o IP de DNS do google
                   - 8.8.4.4              # IP do servidor de nomes 2, neste caso é outro IP de DNS do google
                search: []                # identificação do domínio, aqui neste caso está vazio.
    version: 2
```
-  Após salvar o arquivo é necessário aplicar as configurações, com o **netplan apply**. Depois veja a configuração das interfaces com ****ifconfig -a***

```bash
$ sudo netplan apply
$ ifconfig -a
```

## Configurar uma segunda interface de rede

- Para configurar uma segunda interface de rede devemos editar novamente o arquivo YAML com as informações da nova interface.
- Para isto digite o comando ***ifconfig -a*** e verifique o nome da interface. 
- então edite o arquivo YAML respeitando a hirarquia dada pela identação.

```bash
$ ifconfig -a 
ens160: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 10.9.14.20  netmask 255.255.255.0  broadcast 10.9.14.255
        inet6 fe80::20c:29ff:fec1:1772  prefixlen 64  scopeid 0x20<link>
        ether 00:0c:29:c1:17:72  txqueuelen 1000  (Ethernet)
        RX packets 848  bytes 62673 (62.6 KB)
        RX errors 0  dropped 10  overruns 0  frame 0
        TX packets 427  bytes 51479 (51.4 KB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

ens192: flags=4098<BROADCAST,MULTICAST>  mtu 1500
        ether 00:0c:29:c1:17:7c  txqueuelen 1000  (Ethernet)
        RX packets 0  bytes 0 (0.0 B)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 0  bytes 0 (0.0 B)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

lo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536
        inet 127.0.0.1  netmask 255.0.0.0
        inet6 ::1  prefixlen 128  scopeid 0x10<host>
        loop  txqueuelen 1000  (Local Loopback)
        RX packets 1076781  bytes 76483456 (76.4 MB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 1076781  bytes 76483456 (76.4 MB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
```

- O nome da nova inteface é **ens192**. Edite o arquivo YAML conforme o exemplo abaixo:
```
network:
  ethernets:
    ens160:
      dhcp4: false
      addresses: [10.0.0.11/24]
      gateway4: 10.0.0.1
      nameservers: 
        addresses:
           - 8.8.8.8
           - 8.8.4.4
        search: []
    ens192:
      addresses: [192.168.0.249/29]
  version: 2

```

- Vejam que a nova inteface recebeu o endereço **192.168.0.20**, com máscara **/29**, que equivale a uma máscara em formato decimal **255.255.255.248** .
