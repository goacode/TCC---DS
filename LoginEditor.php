<?php
session_start();
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="./img/Boii.png">

    <link rel="stylesheet" href="stylelogEd.css">

</head>

<body>
    

<?php if (isset($_SESSION['error_message'])): ?>

<p class="error-message">

    <?php 

    echo $_SESSION['error_message'];

    echo '<img src="./img/erro.png" alt="Logo" width="25" height="25" >';

    unset($_SESSION['error_message']); 

    ?>

</p>

<?php endif; ?>

<div class="content">


    <div class="form-container">

    <h1 id="Ed">Login Editor</h1>

    <img class="mb-4 mt-4" src="./img/GearLog.png" alt="Gear" width="250px" height="250px">

    <form method="post" action="script_login_ed.php" class="needs-validation" novalidate>
        
        <input type="text" name="inputlogin" id="inputlogin" class="form-control mb-2" placeholder="E-mail ou CPF" required>

        <input type="text" name="senha" id="senha" class="form-control" placeholder="Senha" required>

        <input type="submit" class="btn btn-primary mt-3 w-100" value="Entrar">

    </form>

    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="personalizar.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>