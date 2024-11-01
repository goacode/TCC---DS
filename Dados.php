<?php

session_start();
include("conexao.php");

$usuario = [];

$id = $_SESSION['id_cliente'];

if ($id) {

    $comando = $con->prepare("SELECT * FROM tb_cliente WHERE id_cliente = :id_cliente");

    $comando->bindValue(':id_cliente', $id);

    $comando->execute();

    if ($comando->rowCount() > 0) {

        $usuario = $comando->fetch(PDO::FETCH_ASSOC);

    } 

}


$usuariodados = [];

if ($id) {

    $comando = $con->prepare("SELECT * FROM tb_endereco WHERE cli_id = :id_cliente");

    $comando->bindValue(':id_cliente', $id);

    $comando->execute();

    if ($comando->rowCount() > 0) {

        $usuariodados = $comando->fetch(PDO::FETCH_ASSOC);

    } 

}


?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kital Churras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <link rel="stylesheet" href="styledado.css">

    <link rel="icon" href="./img/Boii.png">


</head>


<div class="Navegacao">

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">

        <div class="container-fluid">

            <a href="index.php"><img src="./img/Boii.png" height="90" width="90" alt="Logo"
                    class="d-inline-block align-text-top"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse justify-content-center mx-2" id="navbarNavDropdown">

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

                        <a class="navbar-brand dropdown-toggle flecha" href="#" role="button" id="configDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">


                            <img src="./img/user.png" alt="Logo" width="24" height="24"
                                class="d-inline-block align-text-top">

                            <?= htmlspecialchars($_SESSION['nome']) ?>


                        </a>

                        <ul class="dropdown-menu" aria-labelledby="configDropdown">

                            <li><a class="dropdown-item" href="#">Meus Pedidos</a></li>

                            <li><a class="dropdown-item" href="Dados.php">Meus Dados</a></li>

                        </ul>

                    </div>

                    <?php else: ?>

                    <a class="navbar-brand  account-link" href="Conta.php">

                        <img src="./img/user.png" alt="Logo" width="24" height="24"
                            class="d-inline-block align-text-top">

                        Conta

                    </a>

                    <?php endif; ?>

                </div>

                <div class="text-center mx-3  ">

                    <a class="navbar-brand cart-link" href="#">

                        <img src="./img/Carrinho.png" alt="Logo" width="24" height="24"
                            class="d-inline-block align-text-top">

                        Carrinho

                    </a>


                </div>


                <?php if (isset($_SESSION['id_cliente'])): ?>

                <div class="text-center mx-3">

                    <a class="navbar-brand cart-link" href="logout.php">

                        <img src="./img/Portalout.png" alt="Logo" width="24" height="24"
                            class="d-inline-block align-text-top">

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



<div class="Info">

    <h2 id="item1" onclick="mostrarformulario('formulario1')">Dados Pessoais</h2>

    <h2 id="item2" onclick="mostrarformulario('formulario2')">Endereços</h2>

    <h2 id="item3" onclick="mostrarformulario('formulario3')">Telefones</h2>

</div>


<div class="formularios">


    <div id="formulario1" class="form" style="display: none;">

        <h3>Seus Dados</h3>

        <form id="formularioDados" method="post" action="" class="needs-validation" novalidate>

            <div class="row mb-2">

                <div class="col-md-6 mb-2">

                    <input type="text" id="nomeusuario" class="form-control" name="id_cliente"
                        value="<?= htmlspecialchars($usuario['cli_nome']); ?>">

                </div>

                <div class="col-md-6">

                    <input type="text" id="emailusuario" class="form-control" name="id_cliente"
                        value="<?= htmlspecialchars($usuario['cli_email']); ?>">

                </div>

            </div>

            <div>

                <div class="row mb-2">

                    <div class="col-md-6 mb-2">

                        <input type="text" id="cpf_cnpj" class="form-control" name="id_cliente"
                            value="<?= htmlspecialchars($usuario['cli_cpf_cnpj']); ?>">

                    </div>

                    <div class="col-md-6">

                        <input type="date" id="datanasc" class="form-control" name="id_cliente"
                            value="<?= htmlspecialchars($usuario['cli_nasc']); ?>">

                    </div>

                </div>

            </div>
            
            <button type="button" class="btn btn-primary">Salvar</button>

        </form>
    </div>


    <div id="formulario2" class="form" style="display: none;">

        <h3>Seus Endereços</h3>

    </div>


    <div id="formulario3" class="form" style="display: none;">

        <h3>Seus Telefones</h3>

    </div>

</div>

<div class="content">
</div>
<!-- Conteudo Fim -->


<!-- Footer Inicio -->

<div id="footer">

    <div class="row">

        <div class="col-md-4">

            <div class="d-flex justify-content-center">

                <div class="col-md-6">

                    <h4>Contate-nos</h4>


                </div>

            </div>

            <div class="d-flex justify-content-center">

                <p>(11)XXXXX-XXXX</p>

                <img src="./img/whatsapp.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1 mt-1">

            </div>


            <div class="d-flex justify-content-center">

                <p>ContatoChurras@gmail.com</p>

                <img src="./img/mail.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1 mt-1">

            </div>

            <div class="d-flex justify-content-center">

                <p>SAC:(11)XXXXX-XXXX</p>

                <img src="./img/whatsapp.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1 mt-1">

            </div>

            <div class="d-flex justify-content-center">

                <p>Av. Santos Drummond 859.</p>

                <img src="./img/web-house.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1 mt-1">


            </div>

        </div>

        <div class="col-md-4">


            <div class="d-flex justify-content-center">

                <div class="col-md-6">

                    <h4>Desenvolvido Por</h4>


                </div>

            </div>

            <p>Gustavo O. Andrade <img src="./img/hub.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1"> | Back-End </p>




            <p>João M. Lopes Montes <img src="./img/hub.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1"> | Front-End </p>

            <p> Mariane M. <img src="./img/hub.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1"> | Design Director </p>

            <p> Sheila S. <img src="./img/hub.png" alt="Logo" width="24" height="24"
                    class="d-inline-block align-text-top ms-1"> | Documentation</p>

        </div>

        <div class="col-md-4">


            <div class="d-flex justify-content-center">

                <div class="col-md-6">

                    <h4>Aceitamos</h4>


                </div>


            </div>



            <img src="./img/card.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1">

            <img src="./img/bitcoin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1">

            <img src="./img/vr.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-1">

        </div>

    </div>

    <p>Siga-nos nas redes sociais:

        <a href="#">Facebook <img src="./img/facebook.png" alt="Logo" width="24" height="24"
                class="d-inline-block align-text-top "> </a> |

        <a href="#">Twitter <img src="./img/twitter.png" alt="Logo" width="24" height="24"
                class="d-inline-block align-text-top "> </a> |

        <a href="#">Instagram <img src="./img/instagram.png" alt="Logo" width="24" height="24"
                class="d-inline-block align-text-top "> </a>

    </p>

</div>

<!-- Footer Fim  -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="dados.js"></script>

<body>

</html>