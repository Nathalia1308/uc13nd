<?php 
include "acesso_com.php";
include "../conn/connect.php";

$lista = $conn->query("select * select * from tbtipos");
$row = $lista->fetch_assoc();
$nrows = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body class="fundofixo">
    
</body>
</html>