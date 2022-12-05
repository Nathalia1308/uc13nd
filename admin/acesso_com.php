<?php 
session_name('chulettaaa');

if(!isset($_SESSION)){
    session_start();
}
// Segurança digital...

// Verificar se o usuário está logado na sessão
if(!isset($_SESSION['login_usuario'])){
    // Se não existir rdirecionamos a sessão por segurança
    header('location: login.php');
    exit;
}
$nome_da_sessao = session_name();

if(!isset($_SESSION['nome_da_sessao']) or ($_SESSION['nome_da_sessao']!=$nome_da_sessao) ){
    session_destroy();
    header('location: login.php');
}

if(!isset($_SESSION['login_usuario'])){
    session_destroy();
    header('location: login.php');
}
?>