<?php 
include "acesso_com.php";
include "../conn/connect.php";

$lista = $conn->query("select * from vw_tbprodutos"); // orde by (tipo, destaque, etc)
$row = $lista->fetch_assoc();
$nrows = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body class="fundofixo">
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">
            Lista de Produtos 
        </h2>
        <table class="table table-hover table-condensed tb-opacidade">
            <thead>
                <th class="hidden">ID</th>
                <th>TIPO</th>
                <th>DESCRIÇÃO</th>
                <th>RESUMO</th>
                <th>VALOR</th>
                <th>IMAGEM</th>
                <th>
                    <a href="produtos_insere.php" target="_self" class="btn btn-block btn-primary btn-xs" role="button">
                        <span class="hidden-xs">ADICIONAR</span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
                <th></th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </main>
</body>
</html>