<?php
#realiza conexão com o banco de dados
$link = mysqli_connect ("10.9.14.55", "pfadmin", "4dm1n@BD", "projetofinal_sred");
$query = "DELETE FROM grupo WHERE GID=1";
#DELETE FROM products WHERE product_id=1
$result = mysqli_query ($link,$query) ;
echo "resultado da query: $result" . PHP_EOL;
# fecha a conexao com o mysq]
mysqli_close ($link) ;
echo "Operação de DELETE realizada com sucesso!" . PHP_EOL;
?>