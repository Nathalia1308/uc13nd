<?php 
include '../conn/connect.php';
$excluido = $conn->query("delete from tbprodutos where id_produto=".$_GET['id_produto']);
// var_dump($excluido);
if ($excluido){
    header("location: produtos_lista.php");
} else {
    header("location: produtos_lista.php?error=1");
}
// header("location: produtos_lista.php");
?>