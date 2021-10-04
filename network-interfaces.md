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


