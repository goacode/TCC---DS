<?php

session_start();

include("conexao.php");

function buscarCarnesPorTipo($con, $tipo, $minValor = null, $maxValor = null) {

    $comando = "

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

    LEFT JOIN 

        tb_promocoes promo 

    ON 

        p.id_produto = promo.id_produto

    WHERE 

        p.prod_tipo = :tipo

    ";

    if ($minValor !== null && $maxValor === null) {

        $comando .= " AND (promo.promo_novovalor >= :min_valor OR p.prod_valor >= :min_valor)";

    } elseif ($minValor === null && $maxValor !== null) {

        $comando .= " AND (promo.promo_novovalor <= :max_valor OR p.prod_valor <= :max_valor)";

    } elseif ($minValor !== null && $maxValor !== null) {

        $comando .= " AND (promo.promo_novovalor BETWEEN :min_valor AND :max_valor OR p.prod_valor BETWEEN :min_valor AND :max_valor)";

    }

    $s = $con->prepare($comando);

    $s->bindValue(':tipo', $tipo);

    if ($minValor !== null) {
        $s->bindValue(':min_valor', $minValor);

    }

    if ($maxValor !== null) {

        $s->bindValue(':max_valor', $maxValor);

    }

    $s->execute();

    return $s->fetchAll(PDO::FETCH_ASSOC);
}

$minValor = isset($_GET['min_valor']) ? (float)$_GET['min_valor'] : null;

$maxValor = isset($_GET['max_valor']) ? (float)$_GET['max_valor'] : null;

$resultado1 = buscarCarnesPorTipo($con, 'bovino', $minValor, $maxValor);    

$resultado2 = buscarCarnesPorTipo($con, 'cordeiro', $minValor, $maxValor);  

$resultado3 = buscarCarnesPorTipo($con, 'suino', $minValor, $maxValor);     

$resultado4 = buscarCarnesPorTipo($con, 'linguicas', $minValor, $maxValor);  

$resultado5 = buscarCarnesPorTipo($con, 'frango', $minValor, $maxValor);     

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kital  Churras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> 

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="./img/Boii.png">


</head>

<body>

<!-- NavBar Inicio -->

<div class="Navegacao">

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">


    
        <div class="container-fluid">

        <a href="index.php"><img src="./img/Boii.png" height="90" width="90" alt="Logo" class="d-inline-block align-text-top"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">

                <ul class="navbar-nav">

                <li class="nav-item me-3">

                    <a class="nav-link text-light" href="index.php">Home</a>

                </li>

                <li class="nav-item dropdown me-3">

                    <a class="nav-link dropdown-toggle text-light flechacarne" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Carnes</a>

                    <ul class="dropdown-menu ">

                    <li><a class="dropdown-item" href="#Bovino">Bovino</a></li>

                    <li><a class="dropdown-item" href="#Suino">Suíno</a></li>

                    <li><a class="dropdown-item" href="#Cordeiro">Cordeiro</a></li>

                    <li><a class="dropdown-item" href="#Linguicas">Linguiças</a></li>

                    <li><a class="dropdown-item" href="#Frango">Frango</a></li>


                    </ul>

                    </li>

                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Kits / Evento</a>

                    </li>


                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Outros</a>

                    </li>

                </ul>

            </div>

            <div class="d-flex ms-auto align-items-center">


                    <?php if (isset($_SESSION['id_cliente'])): ?>

                        <div class="text-center mx-2">

                        <div class="dropdown">

                        <a class="navbar-brand dropdown-toggle flecha" href="#" role="button" id="configDropdown" data-bs-toggle="dropdown" aria-expanded="false">


                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            <?= htmlspecialchars($_SESSION['nome']) ?>


                        </a>

                        <ul class="dropdown-menu" aria-labelledby="configDropdown">

                            <li><a class="dropdown-item" href="#">Meus Pedidos</a></li>

                            <li><a class="dropdown-item" href="Dados.php">Meus Dados</a></li>

                        </ul>

                        </div>

                    <?php else: ?>

                        <a class="navbar-brand account-link" href="Conta.php">

                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            Conta

                        </a>

                    <?php endif; ?>

                </div>

                <div class="text-center mx-3 ">

                    <a class="navbar-brand cart-link" href="#"  onclick="openCart()">

                        <img src="./img/Carrinho.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                        Carrinho

                    </a>

                </div>

                <?php if (isset($_SESSION['id_cliente'])): ?>

                <div class="text-center mx-3">

                    <a class="navbar-brand cart-link" href="logout.php">

                        <img src="./img/Portalout.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                        Sair

                    </a>

                </div>

                <?php endif; ?>


            </div>

        </div>

    </nav>


</div>
    <!-- NavBar Fim -->


    <!-- Conteudo -->








    <div id="menudocarro" class="cart-menu">

    <h3 style="padding-left: 1em;">Seu Carrinho <img src="./img/Carrinho.png" width="25px" height="25px" class="mb-2">     <button class="btn btn-danger" onclick="closeCart()">Fechar</button>      <a  href="Deletartudo.php"><button class="btn btn-warning">Limpar Carrinho</button></a>

    </h3>

    <ul id="cartItemsList">

        <?php


 $total = 0;

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {

            foreach ($_SESSION['carrinho'] as $item) {

                $total += $item['preco'] * $item['quantidade'];

                echo "<li>

                        <img src='imgProd/{$item['prod_img']}' width='50' height='50'>

                        <span >{$item['prod_nome']} |</span>

                        <span>R$ " . number_format($item['preco'], 2, ',', '.') . "</span>

                        <span>Quantidade: {$item['quantidade']}</span>

                        <a href='Deletaritem.php?id=" . $item["id_produto"] . "'><img  src='./img/excluir.png' width='25px' height='25px' class='mb-1 ms-2'></a>

                    </li>";

            }

        } else {

            echo "<p>Carrinho vazio</p>";

        }

    echo "<h4 style='text-decoration:underline'>Total:" . number_format($total,2,',','.') .  "R$" . "</h4>"
        ?>

    </ul>

    
    <div id="butoesdelcarro">


<button class="btn btn-success"> Finalizar Compra</button>

</div>
</div>







    <div class="side-menu" id="sideMenu">

<div class="ms-3">

<form method="GET" action="carnes.php" class="mb-4">





        <label for="min_valor" class="form-label">Valor mínimo (R$)</label>

        <input type="number" class="form-control" id="min_valor" name="min_valor" 

               step="0.01" min="0" placeholder="Exemplo: 20.00" value="<?php echo isset($_GET['min_valor']) ? $_GET['min_valor'] : ''; ?>">

<div class="mt-5">


        <label for="max_valor" class="form-label">Valor máximo (R$)</label>

        <input type="number" class="form-control" id="max_valor" name="max_valor" 

               step="0.01" placeholder="Exemplo: 30.00" value="<?php echo isset($_GET['max_valor']) ? $_GET['max_valor'] : ''; ?>">

</div>

<div class="mt-5">

    <button type="submit" class="btn btn-primary">Aplicar</button>

</div>

</form>

</div>

</div>



<div class="butano">

<button class="btn btn-success" onclick="openMenu()">Filtro <img src="./img/filter.png" width="20px" height="20px" class="mb-1"></button>

<div class="overlay" id="overlay" onclick="closeMenu()"></div>


</div>

    <div class="content">

    <h2 id="Bovino">Bovino</h2>

    
    </div>


    <div class="produtos-container ms-3">

    <?php

if ($resultado1) {

    foreach ($resultado1 as $row) {

        echo '<div class="produto" style="position: relative; display: inline-block;">';

        $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

        echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

        echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

        echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

        echo '<div class="displayprod">';

        if ($row['promo_novovalor'] !== null) {

            echo '<span  id="precotag">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

            echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

            echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

        } else {

            echo '<h5 style="color:black;">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';
        }

        echo '</div>'; 

         echo '<form method="POST" action="adicionar_carrinho.php">';

         echo '<input type="hidden" name="id_produto" value="' . htmlspecialchars($row['id_produto']) . '">';

         echo '<input type="hidden" name="prod_nome" value="' . htmlspecialchars($row['prod_nome']) . '">';

         echo '<input type="hidden" name="prod_img" value="' . htmlspecialchars($row['prod_img']) . '">';

         echo '<input type="hidden" name="preco" value="' . ($row['promo_novovalor'] !== null ? $row['promo_novovalor'] : $row['prod_valor']) . '">';
         
         echo '<div class="row">';

         echo '<div class="col-md-3 mb-1">';

         echo '<input type="number" class="form-control" name="quantidade" value="1" min="1" style="width: 60px;">';

         echo '</div>'; 

         echo '<div class="col-md-9">';

         echo '<button type="submit" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;">Adicionar ao Carrinho</button>';

         echo '</div>'; 

         echo '</div>'; 

         echo '</form>';

         echo '</div>'; 
     }
 }



?>
    </div>

    <div class="content">

    <h2 id="Cordeiro">Cordeiro</h2>

    </div>

    <div class="produtos-container ms-3">

<?php

if ($resultado2) {

foreach ($resultado2 as $row) {


    echo '<div class="produto" style="position: relative; display: inline-block;">';

    $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

    echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

    echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

    echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

    echo '<div class="displayprod">';

    if ($row['promo_novovalor'] !== null) {

        echo '<span  id="precotag">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

        echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

        echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

    } else {

        echo '<h5 style="color:black;">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';
    }

    echo '</div>'; 

    
    echo '<form method="POST" action="adicionar_carrinho.php">';

    echo '<input type="hidden" name="prod_nome" value="' . htmlspecialchars($row['prod_nome']) . '">';

    echo '<input type="hidden" name="prod_img" value="' . htmlspecialchars($row['prod_img']) . '">';

    echo '<input type="hidden" name="preco" value="' . ($row['promo_novovalor'] !== null ? $row['promo_novovalor'] : $row['prod_valor']) . '">';
    
    echo '<div class="row">';

    echo '<div class="col-md-3 mb-1">';

    echo '<input type="number" class="form-control" name="quantidade" value="1" min="1" style="width: 60px;">';

    echo '</div>'; 

    echo '<div class="col-md-9">';

    echo '<button type="submit" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;">Adicionar ao Carrinho</button>';

    echo '</div>'; 

    echo '</div>'; 

    echo '</form>';

    echo '</div>'; 
}

}

    echo '</div>';



?>

</div>

<div class="content">

    <h2 id="Suino">Suino</h2>

    </div>


    <div class="produtos-container ms-3">

<?php

if ($resultado3) {

foreach ($resultado3 as $row) {

    echo '<div class="produto" style="position: relative; display: inline-block;">';

    $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

    echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

    echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

    echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

    echo '<div class="displayprod">';

    if ($row['promo_novovalor'] !== null) {

        echo '<span  id="precotag">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

        echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

        echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

    } else {

        echo '<h5 style="color:black;">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';
    }

    echo '</div>'; 

    
    echo '<form method="POST" action="adicionar_carrinho.php">';

    echo '<input type="hidden" name="prod_nome" value="' . htmlspecialchars($row['prod_nome']) . '">';

    echo '<input type="hidden" name="prod_img" value="' . htmlspecialchars($row['prod_img']) . '">';

    echo '<input type="hidden" name="preco" value="' . ($row['promo_novovalor'] !== null ? $row['promo_novovalor'] : $row['prod_valor']) . '">';
    
    echo '<div class="row">';

    echo '<div class="col-md-3 mb-1">';

    echo '<input type="number" class="form-control" name="quantidade" value="1" min="1" style="width: 60px;">';

    echo '</div>'; 

    echo '<div class="col-md-9">';

    echo '<button type="submit" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;">Adicionar ao Carrinho</button>';

    echo '</div>'; 

    echo '</div>'; 

    echo '</form>';

    echo '</div>'; 
}

}

    echo '</div>';




?>

</div>

<div class="content">

    <h2 id="Linguicas">Linguiças</h2>

    </div>



    <div class="produtos-container ms-3">

<?php

if ($resultado4) {

foreach ($resultado4 as $row) {

    echo '<div class="produto" style="position: relative; display: inline-block;">';

    $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

    echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

    echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

    echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

    echo '<div class="displayprod">';

    if ($row['promo_novovalor'] !== null) {

        echo '<span  id="precotag">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

        echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

        echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

    } else {

        echo '<h5 style="color:black;">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';
    }

    echo '</div>'; 

    
    echo '<form method="POST" action="adicionar_carrinho.php">';

    echo '<input type="hidden" name="prod_nome" value="' . htmlspecialchars($row['prod_nome']) . '">';

    echo '<input type="hidden" name="prod_img" value="' . htmlspecialchars($row['prod_img']) . '">';

    echo '<input type="hidden" name="preco" value="' . ($row['promo_novovalor'] !== null ? $row['promo_novovalor'] : $row['prod_valor']) . '">';
    
    echo '<div class="row">';

    echo '<div class="col-md-3 mb-1">';

    echo '<input type="number" class="form-control" name="quantidade" value="1" min="1" style="width: 60px;">';

    echo '</div>'; 

    echo '<div class="col-md-9">';

    echo '<button type="submit" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;">Adicionar ao Carrinho</button>';

    echo '</div>'; 

    echo '</div>'; 

    echo '</form>';

    echo '</div>'; 
}

}

    echo '</div>';



?>

</div>

<div class="content">

    <h2 id="Frango">Frango</h2>

    </div>

    
    <div class="produtos-container ms-3">

<?php

if ($resultado5) {

foreach ($resultado5 as $row) {

    echo '<div class="produto" style="position: relative; display: inline-block;">';

    $imagemSrc = 'imgProd/' . htmlspecialchars($row['prod_img']);

    echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($row['prod_nome']) . '" width="250px" height="250px">';

    echo '<h2 style="color:black;">' . htmlspecialchars($row['prod_nome']) . '</h2>';

    echo '<h5 style="color:black;">' . htmlspecialchars($row['prod_pesoval']) . ' ' . htmlspecialchars($row['prod_unipeso']) . '</h5>';

    echo '<div class="displayprod">';

    if ($row['promo_novovalor'] !== null) {

        echo '<span  id="precotag">' . htmlspecialchars($row['promo_porcento']) . '% OFF</span>';

        echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';

        echo '<h5 style="color:black;">R$ ' . number_format($row['promo_novovalor'], 2, ',', '.') . '</h5>';

    } else {

        echo '<h5 style="color:black;">R$ ' . number_format($row['prod_valor'], 2, ',', '.') . '</h5>';
    }

    echo '</div>'; 


    
    echo '<form method="POST" action="adicionar_carrinho.php">';

    echo '<input type="hidden" name="prod_nome" value="' . htmlspecialchars($row['prod_nome']) . '">';

    echo '<input type="hidden" name="prod_img" value="' . htmlspecialchars($row['prod_img']) . '">';

    echo '<input type="hidden" name="preco" value="' . ($row['promo_novovalor'] !== null ? $row['promo_novovalor'] : $row['prod_valor']) . '">';
    
    echo '<div class="row">';

    echo '<div class="col-md-3 mb-1">';

    echo '<input type="number" class="form-control" name="quantidade" value="1" min="1" style="width: 60px;">';

    echo '</div>'; 

    echo '<div class="col-md-9">';

    echo '<button type="submit" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;">Adicionar ao Carrinho</button>';

    echo '</div>'; 

    echo '</div>'; 

    echo '</form>';

    echo '</div>'; 
}

}

    echo '</div>';



?>

</div>

        <!-- Conteudo Fim -->


        <!-- Footer Inicio -->

    <div id="footer">

    <div class="row">

    <div class="col-md-4">

        <div class="d-flex justify-content-center" >

        <div class="col-md-6">

        <h4>Contate-nos</h4>
        

        </div>

        </div>

        <div class="d-flex justify-content-center" >

        <p>(11) XXXXX-XXXX</p>  

        <img src="./img/whatsapp.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1 mt-1">

        </div>
    

        <div class="d-flex justify-content-center" >

        <p>ContatoChurras@gmail.com</p>  

        <img src="./img/mail.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1 mt-1">

        </div>

        <div class="d-flex justify-content-center" >

    <p>SAC:(11)XXXXX-XXXX</p>  

    <img src="./img/whatsapp.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1 mt-1">

    </div>

    <div class="d-flex justify-content-center" >

    <p>Av. Santos Drummond 859.</p>

    <img src="./img/web-house.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1 mt-1">


    </div>

        </div>

        <div class="col-md-4">


        <div class="d-flex justify-content-center" >

        <div class="col-md-6">

        <h4>Desenvolvido Por</h4> 


        </div>

        </div>

        <p>Gustavo O. Andrade  <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1"> | Back-End </p>

        


        <p>João M. Lopes Montes  <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1">  | Front-End </p>

        <p> Mariane M.   <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1">  | Design Director </p>

        <p> Sheila S.   <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1"> | Documentation</p>

        </div>

        <div class="col-md-4">


        <div class="d-flex justify-content-center" >

        <div class="col-md-6">

        <h4>Aceitamos</h4> 


        </div>


        </div>
        
      

       <img src="./img/card.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

       <img src="./img/bitcoin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

       <img src="./img/vr.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

       </div>

       </div>
       
        <p >Siga-nos nas redes sociais:

            <a href="#">Facebook <img src="./img/facebook.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ">  </a> |

            <a href="#">Twitter <img src="./img/twitter.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ">  </a> |

            <a href="#">Instagram <img src="./img/instagram.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ">  </a>

        </p>

    </div>

            <!-- Footer Fim  -->


            <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidemenu.js"></script>
    
    <script src="carro.js"></script>
                <!-- Scripts -->


</body>

</html>