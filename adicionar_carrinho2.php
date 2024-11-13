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

$produtoJaNoCarrinho = false;

foreach ($_SESSION['carrinho'] as $indice => $item) {

    if ($item['id_produto'] == $produto['id_produto']) {

        $_SESSION['carrinho'][$indice]['quantidade'] += $produto['quantidade'];

        $produtoJaNoCarrinho = true;

        break;

    }

}

if (!$produtoJaNoCarrinho) {

    $_SESSION['carrinho'][] = $produto;

}

$total = 0;

foreach ($_SESSION['carrinho'] as $item) {

    $total += $item['preco'] * $item['quantidade'];


    echo "<li>

            <img src='imgProd/{$item['prod_img']}' width='50' height='50'>

            <span>{$item['prod_nome']} |</span>

            <span>R$ " . number_format($item['preco'], 2, ',', '.') . "</span>

            <span>Quantidade: {$item['quantidade']}</span>

            <a href='Deletaritem.php?id=" . $item["id_produto"] . "'>

                <img src='./img/excluir.png' width='25px' height='25px' class='mb-1 ms-2'>

            </a>

        </li>";

}

echo "<h4 style='text-decoration:underline' id='totalCarrinho'>Total: R$ " . number_format($total, 2, ',', '.') . "</h4>";

echo "<script>

        var totalOrcamento = " . $total . ";

        window.dispatchEvent(new CustomEvent('totalCarrinhoAtualizado', { detail: totalOrcamento }));

      </script>";
      
?>
