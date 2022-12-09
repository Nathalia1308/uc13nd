<?php 
include '../conn/connect.php';
$excluido = $conn->query("delete from tbusuarios where id_usuario".$_GET['id_usuario']);
// var_dump($excluido);
if ($excluido) {
    header("location: usuarios_lista.php");
}

?>