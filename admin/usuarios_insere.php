<?php
// Incluindo o Sistema de autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../conn/connect.php");

if ($_POST) {

    // Organizar os campos na mesma ordem
    $id_usuario    =   $_POST['id_usuario'];
    $login_usuario   =   $_POST['login_usuario'];
    $senha_usuario    =   $_POST['senha_usuario'];
    $nivel_usuario     =   $_POST['nivel_usuario'];

    // Consulta SQL para inserção de dados
    $insertSQL  =   "INSERT INTO tbusuarios
                        (id_usuario, login_usuario, senha_usuario, nivel_usuario)
                    VALUES
                        ('$id_usuario','$login_usuario', '$senha_usuario','$nivel_usuario')
                    ";
    $resultado  =   $conn->query($insertSQL);

    // Após a ação a página será redirecionada
    if (mysqli_insert_id($conn)) {
        header("Location: usuarios_lista.php");
    } else {
        header("Location: usuarios_lista.php");
    };
};

// Selecionar os dados da chave estrangeira
$consulta_fk    =   "SELECT * FROM tbusuarios  ORDER BY login_usuario ASC ";
$lista_fk       =   $conn->query($consulta_fk);
$row_fk         =   $lista_fk->fetch_assoc();
$totalRows_fk   =   ($lista_fk)->num_rows;

?>
<!-- html:5 -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Usuarios - Insere</title>
    <meta charset="UTF-8">
    <!-- Link arquivos Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS específico -->
    <link rel="stylesheet" href="../css/estilo.css" type="text/css">
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
                    Inserindo Usuarios
                </h2>
                <!-- Abre thumbnail -->
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="usuarios_insere.php" id="form_usuarios_insere" name="form_usuarios_insere" method="post" enctype="multipart/form-data">
                            <!-- text descri_produto -->
                            <label for="login_usuario">Login Usuario:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="login_usuario" id="login_usuario" class="form-control" placeholder="Digite o usuario." maxlength="15" required>
                            </div><!-- fecha input-group -->
                            <!-- input senha_usuario -->
                            <label for="senha_usuario">Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="senha_usuario" id="senha_usuario" class="form-control" placeholder="Digite a senha usuario." maxlength="15" required>
                            </div><!-- fecha input-group -->

                            <!-- input senha_usuario -->
                            <label for="nivel_usuario">Nivel usuario:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-education" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="nivel_usuario" id="nivel_usuario" class="form-control" placeholder="Digite o nivel usuario." maxlength="15" required>
                            </div><!-- fecha input-group -->
                            <br>
                            <!-- Fecha textarea resumo_produto -->
                            <br>
                            <!-- Fecha file imagem_produto -->

                            <!-- btn enviar -->
                            <input type="submit" value="Cadastrar" name="enviar" id="enviar" class="btn btn-danger btn-block">
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