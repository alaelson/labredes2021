# Configuração do servidor DNS com Bind9

## Relembre as definições de rede na Tabela 1


<p><center> Tabela 1: Definições da rede interna</center></p>

| DESCRIÇÃO   | IP            |
|:------------|:------------- |
| rede        | 10.9.14.0     |
| máscara     | 255.255.255.0 |
| Gateway     | 10.9.14.1     |
| Broadcast   | 10.9.14.255   |
| NameServer1 | 10.9.14.10    |
| NameServer2 | 10.9.14.11    |
| vm1         | 10.9.14.100   |

<p><center> Tabela 1: Definições da rede interna turma 924</center></p>

| DESCRIÇÃO   | IP            |
|:------------|:------------- |
| rede        | 10.9.24.0     |
| máscara     | 255.255.255.0 |
| Gateway     | 10.9.24.1     |
| Broadcast   | 10.9.24.255   |
| NameServer1 | 10.9.24.10    |
| NameServer2 | 10.9.24.11    |
| vm1         | 10.9.24.100   |



Os nomes das máquinas ou dispositivos que serão configuradas no DNS deverão ser nomeados de acordo com o domínio. A Tabela 2 apresenta os nomes das máquinas para o domínio de exemplo.

<p><center> Tabela 2: Definições do domínio: <b>labredes.ifalarapiraca.local</b></center></p>

|      Apelido      |               NOME               |
|:------------------|:---------------------------------|
| gateway (gw)      | gw.labredes.ifalarapiraca.local  |
| nameserver1 (ns1) | ns1.labredes.ifalarapiraca.local |
| nameserver2 (ns2) | ns2.labredes.ifalarapiraca.local |
| desktophost1 (dh1 | dh1.labredes.ifalarapiraca.local |

## Siga os roteiros a configuração de cada name-server

- Configurando o Servidor [DNS Master](https://github.com/alaelson/labredes2020/blob/master/network/bind9/master.md) (nameserver1)

- Configurando o Servidor [DNS Slave](https://github.com/alaelson/labredes2020/blob/master/network/bind9/slave.md) (nameserver1)

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


