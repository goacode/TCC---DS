<?php

include("conexao.php");




$id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_NUMBER_INT);
$nome_produto = filter_input(INPUT_POST, 'Prodnome', FILTER_SANITIZE_STRING);
$preco_antigo = filter_input(INPUT_POST, 'Prodpreco', FILTER_SANITIZE_STRING);
$desconto = filter_input(INPUT_POST, 'Porcpromo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$data_inicio = filter_input(INPUT_POST, 'datainicio', FILTER_SANITIZE_STRING);
$data_fim = filter_input(INPUT_POST, 'datafim', FILTER_SANITIZE_STRING);


$newvalue =  $preco_antigo - (($desconto/100) * $preco_antigo);

try{

    $comando = "INSERT INTO tb_promocoes( id_produto, promo_porcento, promo_novovalor, promo_datainicio, promo_datatermino) VALUES (?, ?, ?, ?, ?)";

    $s = $con ->prepare($comando);

    $s->bindParam(1, $id_produto);

    $s->bindParam(2, $desconto);

    $s->bindParam(3, $newvalue);

    $s->bindParam(4, $data_inicio);

    $s->bindParam(5, $data_fim);

    $s ->execute();


 header("location: produtolog.php");

}catch(PDOException $E){

echo "Erro: " . $e ->getMessage();

}

$con = null;

?>

