<?php
session_start();

include("conexao.php");


?>





<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kital  Churras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> 

    <link rel="stylesheet" href="stylekit.css">

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

                    <a class="nav-link text-light" href="Carnes.php" >Carnes</a>   

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

        echo "<h4 style='text-decoration:underline'>Total:" . "R$ " .  number_format($total,2,',','.') . "</h4>"

        ?>

    </ul>

    
    <div id="butoesdelcarro">


<button class="btn btn-success"> Finalizar Compra</button>

</div>
</div>



<div class="content">



<div class="container my-5 p-5 rounded shadow formularioo">

    <h2 class="text-center mb-4">Planeje seu Evento</h2>

    <form action="evento.php" method="post" class="needs-validation" novalidate>

        
        <div class="mb-4">

            <label for="quantidade_pessoas" class="form-label">Quantidade de Pessoas</label>

            <input type="number" class="form-control" id="quantidade_pessoas" name="quantidade_pessoas" placeholder="Ex: 20" required>

        </div>
        
        <div class="mb-4">
            <label class="form-label">Tipos de Carne que você prefere</label>

            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="carne[]" value="Bovino" id="carneBovino">

                <label class="form-check-label" for="carneBovino">Bovino</label>

            </div>

            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="carne[]" value="Suíno" id="carneSuino">

                <label class="form-check-label" for="carneSuino">Suíno</label>

            </div>

            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="carne[]" value="Cordeiro" id="carneCordeiro">

                <label class="form-check-label" for="carneCordeiro">Cordeiro</label>

            </div>

            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="carne[]" value="Linguiça" id="carneLinguiça">

                <label class="form-check-label" for="carneLinguiça">Linguiça</label>

            </div>

            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="carne[]" value="Frango" id="carneFrango">

                <label class="form-check-label" for="carneFrango">Frango</label>

            </div>

        </div>

        <div class="mb-4">

            <label for="data_evento" class="form-label">Data do Evento</label>

            <input type="date" class="form-control" id="data_evento" name="data_evento" required>

        </div>

        <div class="mb-4">

            <label for="orcamento" class="form-label">Orçamento (R$)</label>

            <input type="number" class="form-control" id="orcamento" name="orcamento" placeholder="Ex: 500" required>

        </div>

        <div class="text-center">

            <button type="submit" class="btn btn-primary btn-lg">Enviar Informações</button>

        </div>

    </form>

</div>


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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="jquery.mask.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="personalizar.js"></script>

<script src="sidemenu.js"></script>

<script src="carro.js"></script>
            <!-- Scripts -->


</body>

</html>