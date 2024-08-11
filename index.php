<?php

session_start();

include("conexao.php");

?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kital Um Churras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> 

    <link rel="stylesheet" href="style.css">

</head>

<body>

<!-- NavBar Inicio -->

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">

        <div class="container-fluid">

            <img src="./img/Boii.png" height="90" width="90" alt="Logo" class="d-inline-block align-text-top">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">

                <ul class="navbar-nav">

                    <li class="nav-item dropdown me-3">

                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Carnes</a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Bovino</a></li>

                            <li><a class="dropdown-item" href="#">Suíno</a></li>

                            <li><a class="dropdown-item" href="#">Cordeiro</a></li>

                            <li><a class="dropdown-item" href="#">Linguiças</a></li>

                            <li><a class="dropdown-item" href="#">Frango</a></li>

                            <li><a class="dropdown-item" href="#">Outros</a></li>

                        </ul>

                    </li>

                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Kits / Evento</a>

                    </li>

                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Promoções</a>

                    </li>

                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Outros</a>

                    </li>

                </ul>

            </div>

            <div class="d-flex ms-auto align-items-center">

                <div class="text-center mx-2">

                    <?php if (isset($_SESSION['nome'])): ?>

                        <span class="navbar-brand account-link">

                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            <?= htmlspecialchars($_SESSION['nome']) ?>

                        </span>

                    <?php else: ?>

                        <a class="navbar-brand account-link" href="Conta.html">

                            <img src="./img/user.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                            Conta

                        </a>

                    <?php endif; ?>

                </div>

                <div class="text-center mx-3">

                    <a class="navbar-brand cart-link" href="#">

                        <img src="./img/Carrinho.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                        Carrinho

                    </a>

                </div>

                <div class="text-center mx-3">

                    <a class="navbar-brand support-link" href="#">

                        <img src="./img/help.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">
                        Suporte

                    </a>

                </div>

                <?php if (isset($_SESSION['nome'])): ?>

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

    <!-- NavBar Fim -->


    <!-- Conteudo -->

    <div class="content">
     
    </div>

        <!-- Conteudo Fim -->


        <!-- Footer Inicio -->

    <div id="footer">

        <p>Projeto Foda</p>

        <p>Desenvolvido por Boligas e Little Beauty</p>

        <p>Contato: PauloViado@gmail.com</p>

        <p>Siga-nos nas redes sociais:

            <a href="#">Facebook</a> |

            <a href="#">Twitter</a> |

            <a href="#">Instagram</a>

        </p>

    </div>

            <!-- Footer Fim  -->


            <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Scripts -->


</body>

</html>