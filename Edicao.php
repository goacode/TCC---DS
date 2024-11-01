<?php

session_start();


if(!isset($_SESSION['id_cliente'])){

    header('location:LoginEditor.php');

    exit();

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edição</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="styleEd.css" rel="stylesheet">

    <link rel="icon" href="./img/Boii.png">

</head>

<body>

<!----- Inicio da nav ------>

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

<!----- Fim da nav ------>


<div class="d-grid gap-2 col-6 mx-auto mt-4">
  <a class="btn btn-primary" href="ProdutoAdd.php" role="button">Adicionar Produto</button>
  <a class="btn btn-primary" href="produtolog.php" role="button">Gerenciamento de Produto</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>






</body>

</html>
