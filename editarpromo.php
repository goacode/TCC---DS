<?php

session_start();


include("conexao.php");


if(!isset($_SESSION['id_cliente'])){

    header('location:LoginEditor.php');
    exit();
}


$produto =[];

$id = filter_input(INPUT_GET, 'id');

if($id){

    $comando = $con->prepare("SELECT * FROM tb_produto WHERE id_produto = :id_produto");

    $comando->bindValue(':id_produto', $id);

    $comando->execute();

    if($comando->rowCount() > 0){

        $produto = $comando ->fetch(PDO::FETCH_ASSOC);

    }else{

        header("location: produtolog.php");

        exit;
    }
}else{

    header("location: produtolog.php");
}
?>








<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Promoção</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <a href="produtolog.php"><button class="btn btn-success mt-3 ms-3"> <img src="./img/Setaback.png" height="20px" height="20px"> Voltar</button></a>
  
<div class="d-flex justify-content-center ">

<div class="row justify-content-center">

    <div class="form-container">

        <form enctype="multipart/form-data" id="Adcarne" method="post" action="editarpromoscript.php" class="needs-validation" novalidate>

            <div class="text-center">

            <input type="hidden" class="form-control" name="id_produto" maxlength="500"   value="<?=$produto['id_produto'];?>" >

            <input type="hidden" class="form-control mt-3" name="Prodnome" id="Prodnome" placeholder="Nome do Produto"  value="<?=$produto['prod_nome'];?>" >

            <input type="hidden" class="form-control mt-3" name="Prodpreco" id="Prodpreco" placeholder="Preço do Produto" value="<?=$produto['prod_valor'];?>">


            <label for="porcpromo" class="col-form-label mt-3">Desconto a ser Aplicado (%)</label>

            <input type="number" class="form-control mt-3" name="Porcpromo" id="Porcpromo" placeholder="Porcentagem Disconto" required>

            <label for="datainicio" class="col-form-labeo mt-3">Data de Inicio da Promoção</label>

            <input type="date" class="form-control mt-3" name="datainicio" id="datainicio"  required>

            <label for="datafim" class="col-form-labeo mt-3">Data de Fim da Promoção</label>

            <input type="date" class="form-control mt-3" name="datafim" id="datafim"  required>

            <input type="submit" class="btn btn-success mt-3 w-100" value="Realizar Promoção">

        </div>

        </form>


    </div>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>