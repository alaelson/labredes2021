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
		# prepara os dados para inserir no banco de dados
		$nome = $_POST["Nome"];
		$email = $_POST["Email"];
		$gid = $_POST["GID"];
		$query = "INSERT INTO aluno (Nome, Email, GID) VALUES ('$nome' , '$email', '$gid')";
		#realiza a consulta
		$result = mysqli_query ($conn, $query) ;
	} else {
		die("database $database not selected");
	}
} else {
	die("connection to server $server by user $user has failed");
}
#fecha a conexao com o mysql
mysqli_close ($conn) ;
echo "Operação realizada com sucesso! Dados inseridos na base $database" . PHP_EOL;
?>

<form action="insert.html" method="post">
	Voltar: 
<input type="submit"/>
</form>

</body>
</html>
