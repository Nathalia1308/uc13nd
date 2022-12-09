<?php
// incluindo o sistema de autentificação
include("acesso_com.php");
// incluir o arquivo e fazer a conexão
include("../conn/connect.php");

if ($_POST) {
    // Organizar os campos na mesma ordem
    $id_usuario    =   $_POST['id_usuario'];
    $login_usuario   =   $_POST['login_usuario'];
    $senha_usuario    =   $_POST['senha_usuario'];
    $nivel_usuario     =   $_POST['nivel_usuario'];

    // campo do formulario para filtrar o resgistro (where)
    $id = $_POST['id_usuario'];

    // consulta sql para atualização de dados 
    $updateSQL = "UPDATE tbusuarios
                SET  id_usuario = '$id_usuario', 
                     login_usuario = '$login_usuario',
                     senha_usuario = '$senha_usuario'
                WHERE id_usuario = $id ";
    $resultado = $conn->query($updateSQL);
    if ($resultado) {
        header("Location: usuarios_lista.php");
    }
}
//  consulta para trazer e filtrar os dados
if ($_GET) {
    $id_form = $_GET['id_usuario'];
} else {
    $id_form = 0;
}
$lista = $conn->query("SELECT * FROM tbusuarios WHERE id_usuario = $id_form");
$row = $lista->fetch_assoc();
$totalRows = ($lista)->num_rows;

// selecionar os dados da chave estrangeira 
$tabela_fk      =   "tbusuarios";
$ordenar_por    =   "login_usuario ASC";
$consulta_fk    =   "SELECT *
                    FROM " . $tabela_fk . "
                    ORDER BY " . $ordenar_por . " ";
// Fazer a lista completa dos dados
$lista_fk       =   $conn->query($consulta_fk);
// Separar os dados em linhas(row)
$row_fk         =   $lista_fk->fetch_assoc();
// Contar o total de linhas
$totalRows_fk   =   ($lista_fk)->num_rows;
?>

<!-- html:5 -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Atualiza</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>

<body class="fundofixo">
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <div class="row">
            <!-- Abre row -->
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                <!-- Dimensionamento -->
                <h2 class="breadcrumb text-danger">
                    <a href="produtos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizar Tipo
                </h2>
                <!-- abre thumbnail -->

                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="usuario_atualiza.php" id="form_usuario_atuliaza" name="form_usuario_atualiza" method="post" enctype="multipart/form-data">
                            <!-- inserir o campo id_usuario oculto para uso em filtros -->
                            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo  $row['id_usuario']; ?>">
                            <!-- select nivel_usuario -->
                            <label for="nivel_usuario">Nivel do Usuario:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <!-- select>option*2 -->
                                <select name="nivel_usuario" id="nivel_usuario" class="form-control" required>
                                    <!-- Abre estrutura de repetição -->
                                    <?php do { ?>
                                        <option value="<?php echo $row_fk['id_usuario']; ?>" 
                                        <?php
                                            if (!(strcmp($row_fk['id_usuario'], $row['nivel_usuario']))) {
                                              echo "selected=\"selected\"";
                                             };?>>
                                            <?php echo $row_fk['nivel_usuario']; ?>
                                        </option>
                                    <?php } while ($row_fk = $lista_fk->fetch_assoc());
                                    $rows_fk = mysqli_num_rows($lista_fk);
                                    if ($rows_fk > 0) {
                                        mysqli_data_seek($lista_fk, 0);
                                        $rows_fk = $lista_fk->fetch_assoc();
                                    };
                                    ?>
                                    <!-- Fecha estrutura de repetição -->
                                </select>
                                <br>
                            </div>
                        <label for="login_usuario">Nome de login do usuario:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="login_usuario" id="login_usuario" class="form-control" placeholder="Digite o nome do usuario." maxlength="30" required value="<?php echo $row['login_usuario']; ?>">
                        </div>
                        <br>
                        <label for="senha_usuario">Digite a senha:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="senha_usuario" id="senha_usuario" class="form-control" placeholder="Digite a senha." maxlength="50" required value="<?php echo $row['senha_usuario']; ?>">
                        </div>
                        <!-- btn enviar -->
                        <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                    </form>
                </div><!-- Fecha alert -->
            </div><!-- Fecha thumbnail -->
        </div><!-- Fecha Dimensionamento -->
    </div><!-- Fecha row -->
</main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    mysqli_free_result($lista_fk);
    mysqli_free_result($lista);
?>
