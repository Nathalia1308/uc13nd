<?php 
include '../conn/connect.php';
$excluido = $conn->query("delete from tbtipos where id_tipo=".$_GET['id_tipo']);
header("location: tipos_lista.php");

?>