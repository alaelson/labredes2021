## Definição dos endereços de sub-rede e nomes FQDN dos hosts. 

- Endereçamento IP e nome do grupo será identificado pelo par nome-número do grupo (exemplo Grupo1), lembrando que o primeiro IP é o IP de rede, e o último é o IP de broadcast.

Criar uma tabela com as definições dos IPs das MVs com a máscara de rede /29 (255.255.255.248).
A Turma 914 usará a rede **192.168.14.0/24** para criar as subredes de grupos.
A Turma 924 usará a rede **192.168.24.0/24** para criar as subredes de grupos.
Exemplos: 
  - O **Grupo 1** da turma 914 usará a subrede **192.168.14.[0-7]/29** 
  - O **Grupo 4** da turma 924 usará a faixa **192.168.24.[24-31]/29**

- Cada grupo deve incluir preencher a planilha de definições com as informações do seu grupo. 
- [Clique aqui para ver a planilha](https://docs.google.com/spreadsheets/d/1v7yQ4PUAS3-zk9Er5c272DlYeSziiAeLsHLEXdynTu4/edit?usp=sharing)

### Exemplo de preenchimento para o **Grupo 32**

- Nome dos integrantes:
  - Aluno 1: **Fulano da Silva**
  - Aluno 2: **Beltrano de Souza**
  - Aluno 3: **Cicrano dos Santos**
  - Aluno 4: **Virgulino Lampiao**

- Subrede 32: **192.168.0.248/29**
  - IP da Subrede: **192.168.0.248**
  - IP de Broadcast: **192.168.0.255**
  - IP do GW: **192.168.0.249**
  - IP do SAMBA: **192.168.0.250**
  - IP do NS1: **192.168.0.252**
  - IP do NS2: **192.168.0.243**

- Definição de Nomes e Domínio (padrão: <grupo>.<turma>.ifalarapiraca.local):
  - Domínio do grupo: **grupo32.turma9x4.ifalarapiraca.local**
  - FQDN do GW: **frances.grupo32.turma9x4.ifalarapiraca.local**
  - FQDN do SAMBA: **maragogi.grupo32.turma9x4.ifalarapiraca.local**
  - FQDN do NS1: **pajucara.grupo32.turma9x4.ifalarapiraca.local**
  - FQDN do NS2: **peba.grupo32.turma9x4.ifalarapiraca.local**



### OBS: Eu escolhi nomes de praias para as os nomes dos meus servidores no exemplo acima. Vocês podem escolher os nomes que quiserem. O importante é documentar os nomes e os IPs das máquinas .
