<?php 
include '../conn/connect.php';
$excluido = $conn->query("delete from tbtipos where id_tipo".$_GET['id_tipo']);
// var_dump($excluido);
if ($excluido) {
    header("location: tipos_lista.php");
}else{
    header("location: tipos_lista.php?error=1");
}
// header("location: tipos_lista.php");

?>