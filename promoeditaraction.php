<?php

include("conexao.php");

$id_produto = filter_input(INPUT_POST, 'id_produto');

$precoantigo =  $_POST['Prodpreco'];

$porc = filter_input(INPUT_POST, 'Porcpromo');

$datain = filter_input(INPUT_POST, 'datainicio');

$datafim = filter_input(INPUT_POST, 'datafim');

$newvalue =  $precoantigo - (($porc / 100) * $precoantigo);


if($porc && $newvalue && $datain && $datafim && $id_produto) {

    $comando = $con->prepare("UPDATE tb_promocoes SET promo_porcento = :promo_porcento, promo_novovalor = :promo_novovalor, promo_datainicio = :promo_datainicio, promo_datatermino = :promo_datatermino WHERE id_produto = :id_produto");

    $comando->bindValue(':promo_porcento', $porc);

    $comando->bindValue(':promo_novovalor', $newvalue);

    $comando->bindValue(':promo_datainicio', $datain);

    $comando->bindValue(':promo_datatermino', $datafim);

    $comando->bindValue(':id_produto', $id_produto);

    $comando->execute();

    header("location: produtolog.php");

    exit;

} else {

    header("location: produtolog.php");

    exit;
}

?>