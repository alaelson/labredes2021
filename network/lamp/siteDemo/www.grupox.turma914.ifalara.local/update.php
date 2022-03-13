<!DOCTYPE html>
<html>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>Consulta Dados</title> 
<!-- Include CSS File Here-->
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="main">
<h2>Selecione o tipo de consulta:</h2>
<form action="consult.php" method="post">
<!----- Select Option Fields Starts Here ----->
<label class="heading">Selecione uma ou mais opções:</label>
<select multiple name="options[]">
<option value="grupo">Grupo</option>
<option value="aluno">Aluno</option>
<option value="host">Host</option>
</select>
<?php
$server = "10.9.14.55";
$user = "pfadmin";
$pass = "4dm1n@BD";
$database = "projetofinal_sred";
$table = "grupo";

$conn = mysqli_connect($server,$user,$pass);
$seldb = mysqli_select_db($conn, $database);
if(isset($_POST['submit'])){
    if(!empty($_POST['options'])) {
        echo "<span>Selecione pelo menos uma opção:</span><br/>";
        foreach ($_POST['options'] as $select) {
            $table=$select;
            if($conn) {
                if ($seldb) {
                    #seleciona todos os registros na tabela 'grupo'
                    $query = "SELECT * FROM $table";
                    #realiza a consulta
                    $result = mysqli_query ($conn, $query) ;
                    if ($result) {
                        // echo <div style="overflow-x:auto;">;
                        echo "<table>" . PHP_EOL;
                        if($select=="grupo"){
                            echo "<tr>";
                            echo "<th>GID</th>";
                            echo "<th>Nome do Grupo</th>";
                            echo "<th>Domínio</th>";
                            echo "<th></th>";
                            echo  "</tr>";
                        } else if($select=="aluno"){
                            echo "<tr>";
                            echo "<th>UID</th>";
                            echo "<th>Nome</th>";
                            echo "<th>e-mail</th>";
                            echo "<th>GID</th>";
                            echo  "</tr>"; 
                        } else if($select=="host"){
                            echo "<tr>";
                            echo "<th>HID</th>";
                            echo "<th>Nome da VM</th>";
                            echo "<th>Nome FQDN</th>";
                            echo "<th>GID</th>";
                            echo  "</tr>"; 
                        }
                        while ($line = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
                            echo "<tr>";
                            foreach ($line as $key => $value) {
                                if ($key === array_key_last($line)) {
                                    echo "<td>$value</td>"; 
                                } else {
                                  echo "<td>$value</td>"; 
                                }
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        // echo </div>;
                    } else {
                      echo "Table $table not inserted" . PHP_EOL;
                    }
                } else {
                  die("database $database not selected");
                }
            } else {
              die("connection to server $server by user $user has failed");
            }
        }
    } else { echo "<span>Por favor, selecione pelo menos uma opção!</span><br/>";}
}

#libera o fluxo de resultados
mysqli_free_result($result);
#fecha a conexao com o mysql
mysqli_close ($conn) ;
#echo "Consulta ao servidor '$server', pelo usuario '$user' na database '$database' tabela '$table', foi realizada com sucesso!" . PHP_EOL;
?>
<input name="submit" type="submit" value="consultar">
</form>
</div>
</div>
</body>
</html>



