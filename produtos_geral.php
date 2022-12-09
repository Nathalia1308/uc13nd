<?php 
include 'conn/connect.php';
$lista = $conn->query("select * from vw_tbprodutos");
$row_destaque = $lista->fetch_assoc();
$num_linhas = $lista->num_rows;
// print_r($row_destaque);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <h2 class="breadcrumb alert-danger"><strong>Produtos</h2>
    <div class="row">
    <?php do{?> <!--inicio da estrutura de repetição-->
        <div class="col-sm-6 col-md-4">
        <div class="thumbnail"> <!-- Abre thumbnail/card -->
            <a href="produto_detalhe.php?id_produto=<?php echo $row_destaque['id_produto']; ?>">
                <img src="images/<?php echo $row_destaque['imagem_produto']; ?>" alt=""
                class="img-reponsive img-rounded" style="height: 20em;">
            </a>
            <div class="caption text-right">
                <h3 class="text-danger">
                    <strong> <?php echo $row_destaque['descri_produto']; ?></strong>
                </h3>
                <p class="text-warning">
                <strong> <?php echo $row_destaque['rotulo_tipo']; ?></strong>
                </p>
                <p class="text-left">
                    <?php echo mb_strimwidth ($row_destaque['resumo_produto'],0,40,'...') ; ?>
                </p>
                <p>
                    <button class="btn btn-default disabled" role="button" style="cursor: default;">
                        <?php echo "R$".number_format ($row_destaque['valor_produto'], 2,',','.'); ?>
                    </button>
                    <a href="produto_detalhe.php?id_produto=<?php echo $row_destaque['id_produto']; ?>">
                        <span class="hidden-xs">Saiba mais...</span>
                        <span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </p>
            </div>
        </div> <!-- fechar thumbnail/card -->
        </div>
        <?php } while($row_destaque = $lista->fetch_assoc())?>  <!--final da estrutura de repetição-->
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