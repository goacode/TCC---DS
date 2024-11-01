
<?php


session_start();

include ('conexao.php');

if(!isset($_SESSION['id_cliente'])){

    header('location:LoginEditor.php');
    exit();
}



$comando = "SELECT * FROM tb_produto WHERE id_produto NOT IN (SELECT id_produto FROM tb_promocoes)";

$s = $con->prepare($comando);

$s->execute();

$resultado = $s->fetchAll(PDO::FETCH_ASSOC);


$comando2 = "

    SELECT 

        p.id_produto,

        p.prod_nome, 

        p.prod_img, 

        p.prod_pesoval, 

        p.prod_unipeso, 

        p.prod_valor, 

        promo.promo_novovalor, 

        promo.promo_porcento

    FROM 

        tb_produto p

    INNER JOIN 

        tb_promocoes promo 

    ON 

        p.id_produto = promo.id_produto

";


$s = $con->prepare($comando2);

$s->execute();

$resultado2 = $s->fetchAll(PDO::FETCH_ASSOC);



?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Gerenciamento Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="styleProdlog.css" rel="stylesheet">

    <link rel="icon" href="./img/Boii.png">


</head>

<body>

<!-- nav inicio ---->


<div class="Navegacao">

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">

          <div class="container-fluid">

            <img src="./img/Boii.png" height="90" width="90" alt="Logo" class="d-inline-block align-text-top">
   
            <div class="d-flex ms-auto align-items-center">

                <div class="text-center mx-2">

                    <?php if (isset($_SESSION['id_cliente'])): ?>

                        <span class="navbar-brand account-link">

                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            <?= htmlspecialchars($_SESSION['nome']) ?>

                        </span>

                    <?php else: ?>

                        <a class="navbar-brand account-link" href="Conta.php">

                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            Conta

                        </a>

                    <?php endif; ?>

                </div>

                <?php if (isset($_SESSION['id_cliente'])): ?>

                <div class="text-center mx-3">

                    <a class="navbar-brand cart-link" href="logout2.php">

                        <img src="./img/Portalout.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                        Sair

                    </a>

                </div>

                <?php endif; ?>


            </div>

        </div>

    </nav>


</div>


<!--  nav fim ---->

<a class="btn btn-primary mt-3 ms-3"  href="Edicao.php" role="button" > <img src="./img/Setaback.png" height="20px" height="20px"> Voltar</a>

<div class="content">

<h1> Produtos fora de Promoção</h1>

</div>

<div class="produtos-container ms-3">

<?php

if ($resultado) {

    foreach ($resultado as $row) {

        echo '<div class="produto">';

        
        $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

        if (file_exists($imagemSrc)) {

            echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

        }

        echo '<h2>' . htmlspecialchars($row['prod_nome']) . '</h2>';

        echo '<h5>' . htmlspecialchars($row['prod_pesoval']) .  htmlspecialchars($row['prod_unipeso']) . ' </h5>';

        echo '<h5>Preço: R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

        echo "<a class='btn btn-primary btn-sm mt-2'  href='editarpromo.php?id=" . $row["id_produto"] . "'>Realizar Promoção</a> ";

        echo "<a class='btn btn-danger btn-sm mt-2'  style='width:60px;' href='deletarprod.php?id=" . $row["id_produto"] . "'>Excluir</a> ";

        echo '</div>';
    }

}else{

    echo '<h2 style="color:black;"> Sem produtos </h2>'; 

}

?>

</div>

<div class="content">

<h1>Produtos em Promoção</h1>

</div>


<div class="produtos-container ms-3">

<?php

if ($resultado2) {

foreach ($resultado2 as $row) {

    echo '<div class="produto" style="position: relative; display: inline-block;">';

    $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

    echo '<span style="position: absolute;  align-content:left; background-color: red; color: white; padding: 3px; font-size: 1.0em;">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

    echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

    echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

    echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

    echo '<div class="displayprod">';

    echo '<h5 style="text-decoration: line-through;color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

    echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

    echo "<a class='btn btn-success btn-sm'  style='width:80px;' href='promoeditar.php?id=" . $row["id_produto"] . "'>Editar</a> ";

    echo "<a class='btn btn-danger btn-sm' style='width:80px;' href='deletarpromo.php?id=" . $row["id_produto"] . "'>Excluir</a> ";

    echo '</div>';

    echo '</div>';
}

}else{

    echo '<h2 style="color:black;"> Sem produtos </h2>'; 

}


?>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>