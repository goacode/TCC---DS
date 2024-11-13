<?php

include("conexao.php");

session_start();


$orcamento = $_POST['orcamento'];

$pessoas = $_POST ['quantidade_pessoas'];

$quantidade_por_pessoa = 500; 

$total_carne = $pessoas * $quantidade_por_pessoa; 

$total_carne_kg = $total_carne / 1000; 


$carne_preferida = $_POST['carne']; 



$num_tipos_carne = count($carne_preferida);

if ($num_tipos_carne > 0) {

    $quantidade_por_tipo = $total_carne_kg / $num_tipos_carne; 

} else {

    $quantidade_por_tipo = 0; 

}

$tipos_carne = implode("','", $carne_preferida);

$query = "SELECT 

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

            p.prod_tipo IN ('$tipos_carne')"; 

$stmt = $con->prepare($query);

$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kital  Churras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> 

    <link rel="stylesheet" href="styleb.css">

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

                <li class="nav-item me-3">

                    <a class="nav-link text-light" href="Carnes.php">Carnes</a>

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

        ?>

<h4 id="total" style="text-decoration:underline" data-total="<?php echo $total; ?>">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h4>

    </ul>

    
    <div id="butoesdelcarro">


<button class="btn btn-success"> Finalizar Compra</button>

</div>

</div>



<div id="mySideMenu" class="side-nav">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a>

    <div id="specificationsContent">

        <?php
     
        echo  '<h3 id="Rec">' . "Recomendamos aproximadamente: " . number_format($total_carne_kg, 1, ',', '.') . " kg de carne para o seu evento." . '</h3>';

        echo  '<h3 id="Rec">' . "Cada tipo de carne (". implode(", ", $carne_preferida) .") receberá aproximadamente " . number_format($quantidade_por_tipo, 2) . " kg de carne." . '</h3>';
        
        echo  '<h2 id="Aviso">' . "Isso é apenas uma recomendação, fique livre para fazer alterações conforme seus gostos." .'</h2>'
        ?>

    </div>
    
</div>


<div class="d-flex justify-content-start">

<button class="btn btn-primary butam" onclick="openNav()"  width="20px" height="20px">Recomendações</button>

</div>

<div class="content">

<div class="Topo">


<div class="d-flex justify-content-center">

<h2 id="orcamento" class="orcamento me-5" data-orcamento="<?php echo $orcamento; ?>">Orçamento: R$ <?php echo number_format($orcamento, 2, ',', '.'); ?></h2>

    </div>


    </div>

    </div>

    <div class="produtos-container ms-3">

    <?php

if ($produtos) {

    foreach ($produtos as $produto) {

        $preco = isset($produto['promo_novovalor']) && $produto['promo_novovalor'] > 0 ? $produto['promo_novovalor'] : $produto['prod_valor'];


        echo '<div class="produto" style="position: relative; display: inline-block;">';

        $imagemSrc = 'imgProd/' . htmlspecialchars($produto['prod_img']);

        echo '<img src="' . $imagemSrc . '" alt="' . htmlspecialchars($produto['prod_nome']) . '" width="250px" height="250px">';

        echo '<h2 style="color:black;">' . htmlspecialchars($produto['prod_nome']) . '</h2>';

        echo '<h5 style="color:black;">' . htmlspecialchars($produto['prod_pesoval']) . ' ' . htmlspecialchars($produto['prod_unipeso']) . '</h5>';


        echo '<div class="displayprod">';

        if (isset($produto['promo_novovalor']) && $produto['promo_novovalor'] > 0) {

            echo '<span id="precotag">' . htmlspecialchars($produto['promo_porcento']) . '% OFF</span>';

            echo '<h5 style="text-decoration: line-through; color: rgb(130,130,130);">R$ ' . number_format($produto['prod_valor'], 2, ',', '.') . '</h5>';

            echo '<h5 style="color:black;">R$ ' . number_format($produto['promo_novovalor'], 2, ',', '.') . '</h5>';

        } else {

            echo '<h5 style="color:black;">R$ ' . number_format($produto['prod_valor'], 2, ',', '.') . '</h5>';

        }
        echo '</div>';

        echo '<div class="row">';

        echo '<div class="col-md-3 mb-1">';

        echo '<input type="number" class="form-control" id="quantidade_' . htmlspecialchars($produto['id_produto']) . '" value="1" min="1" style="width: 60px;">';

        echo '</div>';

        echo '<div class="col-md-9">';

        echo '<button type="button" class="btn btn-primary" style="font-size: 18px; padding: 4px 8px;" onclick="adicionarAoCarrinho(' 

             . htmlspecialchars($produto['id_produto']) . ', \'' 

             . htmlspecialchars($produto['prod_nome']) . '\', \'' 

             . htmlspecialchars($produto['prod_img']) . '\', ' 

             . ($produto['promo_novovalor'] !== null ? $produto['promo_novovalor'] : $produto['prod_valor']) . ', document.getElementById(\'quantidade_' 

             . htmlspecialchars($produto['id_produto']) . '\').value)">Adicionar ao Carrinho</button>';

        echo '</div>';

        echo '</div>';

        echo '</div>';

    }

}

?>

    </div>






        <!-- Footer Inicio -->

        <div id="footer">

<div class="row">

<div class="col-md-4">

    <div class="d-flex justify-content-center" >

    <div class="col-md-6">

    <h4 style="text-decoration:underline;">Contate-nos</h4>
    

    </div>

    </div>      

    <div class="d-flex justify-content-center" >

    <p>(11)XXXXX-XXXX</p>  

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

    <h4 style="text-decoration:underline;">Desenvolvido Por</h4> 


    </div>

    </div>

    <p>Gustavo O. Andrade  <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1"> | Back-End </p>

    


    <p>João M. Lopes Montes  <img src="./img/hub.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top ms-1">  | Front-End </p>

    </div>

    <div class="col-md-4">


    <div class="d-flex justify-content-center" >

    <div class="col-md-6">

    <h4 style="text-decoration:underline;">Aceitamos</h4> 


    </div>


    </div>
    
  

   <img src="./img/card.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

   <img src="./img/bitcoin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

   <img src="./img/vr.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1"> 

   
   <div>

    <h4 style="text-decoration:underline;" class="mt-2">Parcerias</h4> 

    <img src="./img/BOILAB.png" alt="Logo" width="150" height="100" class="d-inline-block align-text-top "> 

    </div>

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="sidemenu.js"></script>

<script src="carro.js"></script>

<script src="AJAX.js"></script>

<script src="AJAXCARRINHO.js"></script>

<script src="orcamento.js"></script>

<script src="sidemenu2.js"></script>

            <!-- Scripts -->


</body>

</html>