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

        $usuariodados = $comando->fetchAll(PDO::FETCH_ASSOC);

    }
    
}


$usuariotel =[];


if ($id) {

    $comando = $con->prepare("

        SELECT t.id_telefone, t.tel_numero, t.tel_ramal, tt.teltipo_tipo 

        FROM tb_telefone t

        JOIN tb_teltipo tt ON t.teltipo_id = tt.id_teltipo

        WHERE t.cli_id = :id_cliente

    ");

    $comando->bindValue(':id_cliente', $id);

    $comando->execute();

    if ($comando->rowCount() > 0) {

        $usuariotel = $comando->fetchAll(PDO::FETCH_ASSOC);

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

                        <a class="nav-link text-light" href="Kit.php">Kits / Evento</a>

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

                    <a class="navbar-brand cart-link" href="#" onclick="openCart()">

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


<div id="menudocarro" class="cart-menu">

    <h3 style="padding-left: 1em;">Seu Carrinho <img src="./img/Carrinho.png" width="25px" height="25px" class="mb-2">     <button class="btn btn-danger" onclick="closeCart()">Fechar</button>      <a  href="Deletartudo2.php"><button class="btn btn-warning">Limpar Carrinho</button></a>

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

<?php if (isset($_SESSION['Msg'])): ?>

<p class="Msg" id="Msg">

    <?php 

    echo $_SESSION['Msg'];


    unset($_SESSION['Msg']); 

    ?>

</p>

<?php endif; ?>


<div class="content">

<div class="Info">

    <h2 id="item1" onclick="mostrarformulario('formulario1')">Dados Pessoais</h2>

    <h2 id="item2" onclick="mostrarformulario('formulario2')">Endereços</h2>

    <h2 id="item3" onclick="mostrarformulario('formulario3')">Telefones</h2>

</div>


<div class="formularios">


<div id="formulario1" class="form" style="display: none;">

    <h3>Seus Dados</h3>

    <form id="formularioDados" method="post" action="editardados.php" class="needs-validation" novalidate>

    <input type="hidden" name="id_cliente" value="<?= $usuario['id_cliente']; ?>">

        <div class="row mb-2">

            <div class="col-md-6 mb-2">

                <input type="text" id="nomeusuario" class="form-control" name="nomeusuario" 

                       value="<?= htmlspecialchars($usuario['cli_nome']); ?>" readonly>

            </div>

            <div class="col-md-6">

                <input type="email" id="emailusuario" class="form-control" name="emailusuario" 

                       value="<?= htmlspecialchars($usuario['cli_email']); ?>" readonly>

            </div>

        </div>


        <div class="row mb-2">

            <div class="col-md-6 mb-2">

                <input type="text" id="cpf_cnpj" class="form-control" name="cpf_cnpj" 

                       value="<?= htmlspecialchars($usuario['cli_cpf_cnpj']); ?>" readonly>

            </div>

            <div class="col-md-6">

                <input type="date" id="datanasc" class="form-control" name="datanasc" 

                       value="<?= htmlspecialchars($usuario['cli_nasc']); ?>" readonly>

            </div>

        </div>


        <button type="button" class="btn btn-primary" id="btnAlterar">Alterar</button>

        <button type="submit" class="btn btn-success" id="btnSalvar" style="display: none;">Salvar</button>

    </form>

</div>

   
<div id="formulario2" class="form" style="display: none;">

    <h3>Seus Endereços</h3>

    <form id="formularioend" method="post" class="needs-validation" novalidate>


        <select class="form-select" aria-label="Default select example" name="Enderecos" id="enderecosSelect" required>

            <option value="">Selecione um endereço</option>

            <?php foreach ($usuariodados as $endereco): ?>

                <option value="<?php echo $endereco['id_endereco']; ?>">

                    <?php echo $endereco['end_logradouro'] . ', ' . $endereco['end_numero'] . ' - ' . $endereco['end_cidade'] . '/' . $endereco['end_uf'] . ' (' . $endereco['end_cep'] . ')'; ?>

                </option>

            <?php endforeach; ?>

        </select>

        <button type="button" class="btn btn-success mt-2" onclick="exibirFormularioEndereco()">Adicionar Endereço</button>

        <button type="button"  class="btn btn-danger mt-2"onclick="deletarEndereco()">Deletar Endereço</button>

    </form>

    <div id="formularioNovoEndereco" style="display: none;">

        <h3>Adicionar Novo Endereço</h3>

        <form id="novoEnderecoForm" method="post" action="adicionarendereco.php" class="needs-validation" novalidate>

        <input type="hidden" name="id_cliente" value="<?= $usuario['id_cliente']; ?>">

            <p><input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" required data-mask="00000-000" oninput="debounceBuscarCep()"></p>


            <div class="row">

                <div class="col-md-9">

                    <p><input disabled type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Logradouro" required></p>

                </div>

                <div class="col-md-3">

                    <p><input type="text" class="form-control" name="numero" id="numero" placeholder="Nº" required></p>

                </div>

            </div>


            <p><input disabled type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required></p>

            <div class="row">

                <div class="col-md-9">

                    <p><input disabled type="text" class="form-control" name="localidade" id="localidade" placeholder="Localidade" required></p>

                </div>

                <div class="col-md-3">

                    <p>

                        <select disabled class="form-control" name="UF" id="UF" required>

                            <option value="" disabled selected>UF</option>

                            <option value="AC">AC</option>

                            <option value="AL">AL</option>

                            <option value="AP">AP</option>

                            <option value="AM">AM</option>

                            <option value="BA">BA</option>

                            <option value="CE">CE</option>

                            <option value="DF">DF</option>

                            <option value="ES">ES</option>

                            <option value="GO">GO</option>

                            <option value="MA">MA</option>

                            <option value="MT">MT</option>

                            <option value="MS">MS</option>

                            <option value="MG">MG</option>

                            <option value="PA">PA</option>

                            <option value="PB">PB</option>

                            <option value="PR">PR</option>

                            <option value="PE">PE</option>

                            <option value="PI">PI</option>

                            <option value="RJ">RJ</option>

                            <option value="RN">RN</option>

                            <option value="RS">RS</option>

                            <option value="RO">RO</option>

                            <option value="RR">RR</option>

                            <option value="SC">SC</option>

                            <option value="SP">SP</option>

                            <option value="SE">SE</option>

                            <option value="TO">TO</option>

                        </select>

                    </p>

                </div>

            </div>

            <p><input type="text" class="form-control" name="complemento" id="complemento" placeholder="Complemento"></p>

            <button type="submit" class="btn btn-primary">Salvar novo Endereço</button>

        </form>

        

    </div>

</div>

<div id="formulario3" class="form" style="display: none;">

    <h3>Seus Telefones</h3>

    <form id="formulariotel" method="post" class="needs-validation" novalidate>

    
    <select class="form-select" aria-label="Default select example" name="telefone" id="telefoneSelect">

        <option value="">Selecione um telefone</option>


            <?php foreach ($usuariotel as $telefone): ?>

                <option value="<?php echo $telefone['id_telefone']; ?>">

                <?php echo $telefone['teltipo_tipo'] . ' - ' . $telefone['tel_numero']; ?>

                </option>

            <?php endforeach; ?>

       
    </select>

    <button type="button" class="btn btn-success mt-2" onclick="exibirFormularioTelefone()">Adicionar Telefone</button>

    <button type="button"  class="btn btn-danger mt-2"onclick="deletarTelefone()">Deletar Telefone</button>

    </form>

    <div id="formularioNovoTelefone" style="display: none;">

        <h3>Adicionar Novo Telefone</h3>

        <form id="novoTelefoneForm" method="post" action="adicionartelefone.php" class="needs-validation" novalidate>

        <input type="hidden" name="id_cliente" value="<?= $usuario['id_cliente']; ?>">

        <div class="row">

<div class="col-md-4">

<select class="form-select mb-3" aria-label="Default select example" id="teltipo" required name="teltipo">



<option selected value="Fixo">Telefone Fixo</option>

<option value="Celular">Telefone Celular</option>


</select>

</div>

<div class="col-md-5">

<p id="teleinput"><input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone Fixo" data-mask="(00)0000-0000" required></p> 


</div>

<div class="col-md-3">

<input type="text" class="form-control mb-3" id="ramal" name="ramal" pattern="\d{3,5}" maxlength="5" placeholder="Ramal" >

</div>
</div>

<button type="submit" class="btn btn-primary">Salvar novo Telefone</button>

        </div>

</div>


</div>

</div>

<!-- Conteudo Fim -->


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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="jquery.mask.min.js"></script>

<script type="text/javascript" src="personalizar.js"></script>

<script src="dados.js"></script>

<script src="alt.js"></script>

<script src="dadosend.js"></script>

<script src="telefonedado.js"></script>

<script src="javaTelefone.js"></script>

<script src="carro.js"></script>


<body>

</html>