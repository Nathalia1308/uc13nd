<?php

include "conn/connect.php";

$listaProduto = $conn->query("select * from vw_tbprodutos");
$rowsGeral = $listaProduto->fetch_assoc();
$num_rows = $listaProduto->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Protudos</title>
</head>

<body class="fundofixo">
    
    <div class="container">
        <h2 class="breadcrumb alert-danger">

            </a>
            Produtos
        </h2>
        <div class="row">
        <?php do { ?>
            <div class="col-sm-6 col-md-4">
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
            <?php } while ($rowsGeral = $listaProduto->fetch_assoc()); ?>
        </div>
    
    </div>
</body>
!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</html>