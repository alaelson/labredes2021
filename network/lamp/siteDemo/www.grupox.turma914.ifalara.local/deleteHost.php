<html>
<body>

<?php
#realiza conexão com o banco de dados na maquina '10.9.14.55', usuário 'pfadmin', senha '4dm1n@BD', do banco de dados 'projetofinal_sred'
$server = "10.9.14.55";
$user = "pfadmin";
$pass = "4dm1n@BD";
$database = "projetofinal_sred";
$table = "host";
#$link = mysqli_connect ($server, $user ,$pass,$database);
$conn = mysqli_connect($server,$user,$pass);
if($conn) {
	$seldb = mysqli_select_db($conn, $database);
	if ($seldb) {
		# prepara query para remover registro de Host
		$hid = $_POST["HID"];
		#$fqdn = $_POST["FQDName"];
		$gid = $_POST["GID"];
		$query = "DELETE host FROM host INNER JOIN grupo INNER JOIN aluno WHERE host.GID=grupo.GID AND host.GID=$gid AND host.HID=$hid";
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
