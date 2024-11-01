<?php
session_start();
    $id_produto = $_GET['id'];
    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $index => $item) {
            if ($item['id_produto'] == $id_produto) {
                unset($_SESSION['carrinho'][$index]);
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
                break;
            }
        }
    }
header('Location: carnes.php');
exit();

?>