<?php
#realiza conexão com o banco de dados
$link = mysqli_connect ("10.9.14.55", "pfadmin", "4dm1n@BD", "projetofinal_sred");
#mysqli_select_db ("projetofinal_sred", $link) ;
$GID = 1;
$nome = "Grupo32";
$dominio = "grup32.turma914.ifalarapiraca.local";
$newGID = 32;
# prepara a string com a operacao de insercao (SQL)
$query = "UPDATE grupo SET 
    Nome = '$nome', 
    Dominio = '$dominio',
    GID='$newGID' 
    WHERE 
    GID = '$GID'";
# realiza a operacao
$result = mysqli_query ($link,$query) ;
echo "codigo da query: $result \r\n";
# fecha a conexao com o mysq]
mysqli_close ($link) ;
echo "Operação de INSERT realizada com sucesso!\r\n";
?>
