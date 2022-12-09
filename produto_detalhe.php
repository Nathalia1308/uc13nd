<?php
// Incluir arquivo para fazer a conexão
include("conn/connect.php");

// Consulta para trazer os dados e se necessário filtrar
$id = $_GET['id_produto'];
$lista_destaque      =   $conn->query("SELECT * FROM vw_tbprodutos WHERE id_produto = $id  order by descri_produto ASC;");
$row_destaque        =   $lista_destaque->fetch_assoc();
$totalRows_destaque  =   ($lista_destaque)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Detalhes dos Produtos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="fundofixo">
    <?php include 'menu_publico.php'?>
    <div class="container">
        <h2 class="breadcrumb alert-danger">
            <a href="index.php">
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
            <strong>Detalhes dos Produtos</strong>
        </h2>

        <div class="row">
            <?php do { ?>
                <!-- abre thumbnail/card -->
                <div class="col-sm-12 col-md-12 ">
                    <!-- dimensionamento -->
                    <div class="thumbnail">
                        <a href="produto_detalhe.php?id_produto=<?php echo $row_destaque['id_produto']; ?>">
                            <img src="images/<?php echo $row_destaque['imagem_produto']; ?>" alt="" class="img-responsive img-rounded " style="height: 20em;">
                        </a>
                        <div class="caption text-center">
                            <h3 class="text-danger">
                                <strong><?php echo $row_destaque['descri_produto']; ?></strong>
                            </h3>
                            <p class="text-warning">
                                <strong><?php echo $row_destaque['rotulo_tipo']; ?></strong>
                            </p>
                            <p class="text-center">
                                <?php echo $row_destaque['resumo_produto']; ?>
                            </p>
                            <p>
                                <a href="index.php" class="btn btn-danger" role="button">
                                    <span class="hidden-xs">Retornar</span>
                                    <span class="visible-xs glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                </a>
                            </p>
                        </div><!-- fecha caption -->
                    </div><!-- fecha thumbnail -->
                </div><!-- fecha dimensionamento -->
                <!-- fecha thumbnail/card -->
            <?php } while ($row_destaque = $lista_destaque->fetch_assoc()); ?>
            <!-- fecha a estrutura de repetição -->

        </div><!-- fecha row -->
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_free_result($lista_destaque); ?>