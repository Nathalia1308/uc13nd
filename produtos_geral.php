<?php

include "conn/connect.php";

$idProduto = $_GET['id_produto'];
$listaProduto = $conn->query("select * from vw_tbprodutos where id_produto = $idProduto");
$rowsGeral = $listaProduto->fetch_all();
$num_rows = $listaProduto->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protudos</title>
</head>

<body>
    <?php include "menu_publico.php" ?>

    <!-- Mostrar os registros se a consulta RETORNAR Vazio -->
    <?php if ($num_rows == 0) { ?>
        <h2 class="breadcrumb alert-danger">
            <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Em breve...
        </h2>
    <?php }; ?>
    <?php do if ($num_rows > 0) { ?>
    <div class="container">
        <h2 class="breadcrumb alert-danger">
            <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <strong><?php echo $rowGeral['rotulo_tipo']; ?></strong>
        </h2>
        <div class="row">
        <?php do { ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbail">
                    <a href="produto_detalhe.php?id_produto=<?php echo $rowsGeral['id_produto']; ?>">
                        <img src="images\<?php echo $rowsGeral['imagem_produto']; ?>" class="img-responsive img-rounded" style="height:20em" alt="">
                    </a>
                    <div class="caption text-right">
                        <h3 class="text-danger">
                            <strong><?php echo $rowsGeral['descri_produto']; ?></strong>
                        </h3>
                        <p class="text-warning">
                            <strong><?php echo $rowsGeral['rotulo_tipo']; ?></strong>
                        </p>
                        <p class="text-left">
                            <strong><?php echo mb_strimwidth($rowsGeral['resumo_produto'], 0, 42, '...'); ?></strong>
                        </p>
                        <button class="btn btn-default disable" role="button" style="cursor: default;">
                            <?php echo "R$" . number_format($rowsGeral['valor_produto'], 2, ',', '.'); ?>
                        </button>
                        <a href="produto_detalhe.php?id_produto=<?php echo $rowGeral['id_produto']; ?>">
                            <span class="hidden-xs">Saiba mais...</span>
                            <span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php } while ($rowsGeral = $listaProduto->fetch_all()); ?>
        </div>
    <?php } ?>
        <footer>
            <?php include "rodape.php" ?>
        </footer>
    </div>
</body>

</html>