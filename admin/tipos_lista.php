<?php
include "acesso_com.php";
include "../conn/connect.php";

$lista = $conn->query("select * from tbtipos");
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
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">
            Lista de Tipos
        </h2>
        <table class="table table-hover table-condensed tb-opacidade">
            <thead>
                <th class="hidden">ID</th>
                <th>Tipos</th>
                <th>
                    <a href="tipos_insere.php" target="_self" class="btn btn-block btn-primary btn-xs" role="button">
                        <span class="hidden-xs">ADICIONAR</span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
            </thead> <!-- inicio do corpo da tabela -->
            <tbody>
                <?php do { ?>
                    <!-- inicioda estrutura de repetição  -->
                    <tr>
                        <td class="hidden"><?php echo $row['id_produto']; ?></td>
                        <td>
                            <span class="visible-xs" <?php echo $row['sigla_tipo']; ?>role="button" class="btn btn-warning btn-block btn-xs"></span>
                            <span class="hidden-xs"><?php echo $row['rotulo_tipo']; ?></span>
                        </td>
                        <td>
                            <a href="tipos_atualiza.php?id_tipo=<?php echo $row['id_tipo']; ?>" role="button" class="btn btn-warning btn-block btn-xs">
                                <span class="hidden-xs">ALTERAR</span>
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            <button data-nome="<?php echo $row['rotulo_tipo']; ?>" role="button" class="delete btn btn-xs btn-block btn-danger">
                                <span class="hidden-xs">EXCLUIR</span>
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                <?php } while ($row = $lista->fetch_assoc()); ?>
                <!-- final da estrutura de repetição -->
            </tbody> <!-- finaldo do corpo da tabela -->
        </table>
    </main>
    <!-- inicio do modal para excluir -->
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir o item? 
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- fim do modal -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.delete').on('click',function(){
        var nome = $(this).data('nome'); // busca o nome com a descrição (data-nome)
        var id = $(this).data('id'); // busca o id (data-id)
        // console.log(id + '-' + nome)  // exibe no console
        $('span.nome').text(nome); // insere o nome do item na confirmação
        $('a.delete-yes').attr('href','tipos_excluir.php?id_produto='+id); //chama o arquivo php para excluir o produto
        $('#modalEdit').modal('show'); //chama o modal
    });
</script>
</html>