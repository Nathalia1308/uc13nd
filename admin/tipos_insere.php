<?php
// Incluindo o sistema de autentificação
include("acesso_com.php");
// incluir o arquivo e fazer a conexão
include("../conn/connect.php");

if ($_POST) {
    # code...
}
$id_usuario = $_POST['id_usuario'];
$login_usuario = $_POST['login_usuario'];
$senha_usuario = $_POST['senha_usuario'];
$nivel_usuario = $_POST['nivel_usuario'];

// consulta sql para inserção de dados
$insertSQL = "INSERT INTO tbprodutos (id_usuario, login_usuario, senha_usuario, nivel_usuario)
              VALUES ('$id_usuario','$login_usuario','$senha_usuario','$nivel_usuario')";
$resultado = $conn->query($insertSQL);
//apos a ação a pagina sera redirecionada
if (mysqli_insert_id($conn)) {
    header("location: tipos_lista.php");
} else {
    header("location: tipos_lista.php");
};

?>