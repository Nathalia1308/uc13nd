<?php 
// Incluindo o sistema de autentificação
include ("acesso_com.php");
// incluir o arquivo e fazer a conexão
include ("../conn/connect.php");

$id_usuario = $_POST['id_usuario'];
$login_usuario = $_POST['login_usuario'];
$senha_usuario = $_POST['senha_usuario'];

?>