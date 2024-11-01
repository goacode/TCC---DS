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

    <title>Adicionar Carne</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="styleEd.css" rel="stylesheet">

    <link rel="icon" href="./img/Boii.png">


</head>

<body>

<!-- inicio nav ---->

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

<div >

 <a class="btn btn-primary mt-3 ms-3"  href="Edicao.php" role="button" > <img src="./img/Setaback.png" height="20px" height="20px"> Voltar</a>

 </div>
    <div class="d-flex justify-content-center">

        <div class="row justify-content-center">

            <div class="form-container">

                <form enctype="multipart/form-data" id="Adcarne" method="post" action="scriptAdcarne.php" class="needs-validation" novalidate>

                    <div class="text-center">

                    <input type="text" class="form-control mt-3" name="Prodnome" id="Prodnome" placeholder="Nome do Produto" required>


                    <select class="form-select mt-3" aria-label="Default select example" name="Prodtipo" id="Prodtipo" required>

                        <option value="bovino">Bovino</option>

                        <option value="cordeiro">Cordeiro</option>

                        <option value="suino">Suíno</option>

                        <option value="linguicas">Linguiças</option>

                        <option value="frango">Frango</option>

                    </select>

                    <select class="form-select mt-3" name="Produnidade" id="Produnidade" required>

                        <option   selected value="kg">Quilo (kg)</option>

                        <option  value="unidade">Unidade</option>

                        <option value="g">Grama</option>

                    </select>

                    
                    <input type="text" class="form-control mt-3" name="Prodpreco" id="Prodpreco" placeholder="Preço do Produto" required>

                    <input type="text" class="form-control mt-3" name="Prodvalpeso" id="Prodvalpeso" placeholder="Peso pelo Valor" required>

                    <input type="text" class="form-control mt-3" name="Prodquantidade" id="Prodquantidade" placeholder="Quantidade Disponível" min="1" required>

                    <input type="text" class="form-control mt-3" name="Prodcodigobarras" id="Prodcodigobarras" placeholder="Código de Barras" required maxlength="13" required>

                    <input type="text" class="form-control mt-3" name="Prodmarca" id="Prodmarca"    placeholder="Marca do Produto"  >

                    <input type="file" class="form-control mt-3" name="Prodfoto" id="Prodfoto" accept="image/jpeg, image/png" required>

                    <textarea class="form-control mt-3" name="Proddescricao" id="Proddescricao"  placeholder="Descrição do Produto" rows="3" required></textarea>

                    <input type="submit" class="btn btn-primary mt-3 w-100" value="Cadastrar Produto">

                </div>

                </form>


            </div>

        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="personalizar.js"></script>

    <script src="ProdutoAdd.js"></script>

</body>

</html>