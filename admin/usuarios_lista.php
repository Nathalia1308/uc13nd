<?php
include "acesso_com.php";
include "../conn/connect.php";

$lista = $conn->query("select * from tbusuarios"); // orde by (tipo, destaque, etc) se quiser 
$row = $lista->fetch_assoc();
$nrows = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body class="fundofixo">
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">
            Lista de Usuarios
        </h2>
        <table class="table table-hover table-condensed tb-opacidade">
            <thead>
                <th class="hidden">ID</th>
                <th>LOGIN DO USUARIO</th>
                <th class="hidden">SENHA DO USUARIO</th>
                <th>NIVEL DE USUARIO</th>
                <th>
                    <a href="usuario_insere.php" target="_self" class="btn btn-block btn-primary btn-xs" role="button">
                        <span class="hidden-xs">ADICIONAR</span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
            </thead>
            <tbody>
                <?php do { ?>
                    <!-- inicio da estrutura de repetição -->
                    <tr>
                        <td class="hidden"><?php echo $row['id_usuario']; ?></td>
                        <td>
                            <span class="visible-xs"><?php echo $row['id_usuario']; ?></span>
                            <span class="hidden-xs"><?php echo $row['login_usuario']; ?></span>
                        </td>
                        <td>
                            <?php 
                            if ($row['nivel_usuario'] == 'sup') {
                                echo '<span class="glyphicon glyphicon-link text-danger" aria-hidden="true"></span>';
                            }else {
                                echo '<span class="glyphicon glyphicon-globe text-info" aria-hidden="true"></span>';
                            }
                            ?> 
                            <?php echo $row['nivel_usuario']; ?>
                        </td>
                        <td class="hidden">
                            <?php echo $row['senha_usuario']; ?>
                        </td>    
                        <td>
                            <a href="usuario_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>" role="button" class="btn btn-warning btn-block btn-xs">
                                <span class="hidden-xs">ALTERAR</span>
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            <button data-nome="<?php echo $row['login_usuario'];?>" data-id=<?php echo $row['id_usuario'];?> class="delete btn btn-xs btn-block btn-danger">
                                <span class="hidden-xs">EXCLUIR</span>
                                <span class="glyphicon glyphicon-trash"></span>
                        </td>
                    </tr>
                <?php } while ($row = $lista->fetch_assoc()); ?> <!-- dinal da estrutura de repetição -->
            </tbody> <!-- final corpo da tabela -->
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
                    Deseja mesmo excluir o usuario?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modaç">
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
        $('a.delete-yes').attr('href','usuarios_excluir.php?id_usuario='+id); //chama o arquivo php para excluir o produto
        $('#modalEdit').modal('show'); //chama o modal
    });
</script>
</html>