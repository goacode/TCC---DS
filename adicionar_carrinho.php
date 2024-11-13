<?php

session_start();

include("conexao.php");

if (!isset($_SESSION['carrinho'])) {
    
    $_SESSION['carrinho'] = [];
}

$produto = [

    'id_produto' => $_POST['id_produto'],

    'prod_nome' => $_POST['prod_nome'],

    'prod_img' => $_POST['prod_img'],

    'preco' => $_POST['preco'],

    'quantidade' => $_POST['quantidade']

];

$_SESSION['carrinho'][] = $produto;

header('Location: carnes.php');

exit();



  
?>