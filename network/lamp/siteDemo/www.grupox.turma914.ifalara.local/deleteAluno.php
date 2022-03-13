<html>
<body>

<?php
#realiza conexão com o banco de dados na maquina '10.9.14.55', usuário 'pfadmin', senha '4dm1n@BD', do banco de dados 'projetofinal_sred'
$server = "10.9.14.55";
$user = "pfadmin";
$pass = "4dm1n@BD";
$database = "projetofinal_sred";
$table = "aluno";
#$link = mysqli_connect ($server, $user ,$pass,$database);
$conn = mysqli_connect($server,$user,$pass);
if($conn) {
	$seldb = mysqli_select_db($conn, $database);
	if ($seldb) {
		# prepara query para remover registro de Aluno
		$uid = $_POST["UID"];
		#$fqdn = $_POST["FQDName"];
		$gid = $_POST["GID"];
		$query = "DELETE aluno FROM aluno INNER JOIN grupo INNER JOIN host WHERE aluno.UID=$uid AND aluno.GID=$gid AND aluno.GID=grupo.GID";
		#envia query
		$result = mysqli_query ($conn, $query) ;
	} else {
		die("database $database not selected");
	}
} else {
	die("connection to server $server by user $user has failed");
}
#fecha a conexao com o mysql
mysqli_close ($conn) ;
echo "Operação realizada com sucesso. Dados removidos!" . PHP_EOL;
?>

<form action="index.html" method="post">
	Voltar para Home: 
<input type="submit"/>
</form>
<form action="consult.php" method="post">
	Voltar para Consultar: 
<input type="submit"/>
</form>

</body>
</html>
