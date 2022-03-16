<?php
#realiza conexão com o banco de dados na maquina '10.9.14.55', usuário 'pfadmin', senha '4dm1n@BD', do banco de dados 'projetofinal_sred'
$server = "10.9.14.55";
$user = "pfadmin";
$pass = "4dm1n@BD";
$database = "projetofinal_sred";
$table = "grupo";
#$link = mysqli_connect ($server, $user ,$pass,$database);
$conn = mysqli_connect($server,$user,$pass);
if($conn) {
	$seldb = mysqli_select_db($conn, $database);
	if ($seldb) {
		#seleciona todos os registros na tabela 'grupo'
		$query = "SELECT * FROM $table";
		#realiza a consulta
		$result = mysqli_query ($conn, $query) ;
		if ($result) {
			echo "| GID | Nome do Grupo | Fully Qualified Domain Name (FQDN) |" . PHP_EOL;
			while ($line = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
				foreach ($line as $key => $value) {
					if ($key === array_key_last($line)) {
        				echo "| $value |" . PHP_EOL ;
    				} else {
						echo "| $value ";	
					}
				}
			}	
		} else {
			echo "Table $table not inserted" . PHP_EOL;
		}
	} else {
		die("database $database not selected");
	}
} else {
	die("connection to server $server by user $user has faild");
}


#libera o fluxo de resultados
mysqli_free_result($result);
#fecha a conexao com o mysql
mysqli_close ($conn) ;
echo "Consulta ao servidor '$server', pelo usuario '$user' na database '$database' tabela '$table', foi realizada com sucesso!" . PHP_EOL;
?>
