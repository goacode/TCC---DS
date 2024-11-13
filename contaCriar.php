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

    <link rel="stylesheet" href="styleConta.css">

    <link rel="icon" href="./img/Boii.png">

</head>

<body>

    <!-- Começo da Navbar -->

    <div class="Navegacao">

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">

        <div class="container-fluid">

            <a href="index.php"><img src="./img/Boii.png" height="90" width="90" alt="Logo" class="d-inline-block align-text-top"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

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

                        <a class="nav-link text-light" href="Kit.php">Kits / Evento</a>

                    </li>

                    <li class="nav-item me-3">

                        <a class="nav-link text-light" href="#">Outros</a>

                    </li>

                </ul>

            </div>

            <div class="d-flex ms-auto align-items-center">

                <div class="text-center mx-3">

                    <a class="navbar-brand account-link" href="Conta.php">

                        <img src="./img/user.png" alt="Logo" width="24" height="24"
                            class="d-inline-block align-text-top">

                        Conta

                    </a>

                </div>



                <div class="text-center mx-3 ">

                    <a class="navbar-brand cart-link" href="#" onclick="openCart()">

                        <img src="./img/Carrinho.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">

                        Carrinho

                    </a>

                </div>

            </div>

        </div>

    </nav>

    </div>
    <!-- Fim da Navbar -->


    <!-- Conteudo(Formulario Registro) -->


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



    <div class="content">



        <div class="d-flex justify-content-center">



            <div class="row justify-content-center">

                <div class="form-container">

                    <form id="registro" method="post" action="script.php" class="needs-validation" novalidate>

                        <div class="text-center">

                            <img src="./img/cad.png" alt="uslog" width="50px" height="50px">

                            <p><strong>Cadastro de Usuário</strong></p>

                            <p>Preencha as informações para cirar sua conta</p>

                            <div class="row">

                                <div class="col-md-8 ">

                                    <p><input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo"
                                            required></p>

                                </div>

                                
                                
                                <div class="col-md-4">

                                <input type="date" class="form-control mb-3" name="datanasc" id="datanasc" required >

                                </div>

                            </div>
                            
                            <p><input type="text" class="form-control" name="email" id="email" required
                                placeholder="E-mail"></p>

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

                            <div class="row">

                                <div class="col-md-6 ">

                                    <div class="input-group mb-3">

                                        <input type="password" class="form-control" name="senha" id="senha" required
                                            placeholder="Senha">

                                        <span class="input-group-text toggle-password"
                                            onclick="togglePassword('senha', this)">

                                            <img src="img/olho.png" alt="" width="24">

                                        </span>

                                    </div>

                                </div>

                                <div class="col-md-6 ">


                                    <div class="input-group mb-3">

                                        <input type="password" class="form-control" name="ConfSenha" id="ConfSenha"
                                            required placeholder="Confirmar Senha">

                                        <span class="input-group-text toggle-password"
                                            onclick="togglePassword('ConfSenha' , this)">

                                            <img src="img/olho.png" alt="" width="24">

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <div class="row">



                                <div class="col-md-4">


                                    <select class="form-select mb-3" aria-label="Default select example" id="pessoa" required name="pessoa">


                                        <option selected value="Fisica">Pessoa Física</option>

                                        <option value="Jurídica">Pessoa Jurídica</option>


                                    </select>


                                </div>


                                <div class="col-md-8">


                                    <p id="inputContainer"><input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF"
                                            required data-mask="000.000.000-00"></p>

                                </div>

                               

                            </div>


                                    <p><input type="text" class="form-control" name="cep" id="cep" placeholder="CEP"
                                            required data-mask="00000-000" oninput="debounceBuscarCep()"></p>



                                            <div class="row">

                                                    <div class="col-md-9 ">


                            <p><input disabled type="text" class="form-control" name="logradouro" id="logradouro"
                                    placeholder="Logradouro" required></p>


                                </div>


                                <div class="col-md-3 ">

                                <p><input   type="text" class="form-control" name="numero" id="numero" placeholder="Nº" required></p>


                            </div>

                            </div>


                            <p><input  disabled type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro"
                                    required></p>

                            <div class="row">

                                <div class="col-md-9 ">


                                    <p><input disabled type="text" class="form-control" name="localidade" id="localidade"
                                            placeholder="Localidade" required></p>

                                </div>


                                <div class="col-md-3 ">

                                    <p>
                                        <select  disabled class="form-control" name="UF" id="UF" required>

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

                            

                               

                                    <p><input   type="text" class="form-control" name="complemento" id="complemento"
                                            placeholder="Complemento"></p>

                           
                           

                         

                            <input type="submit" class="btn btn-success mt-3 w-100" value="Cadastrar-se">





                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- Conteudo(Formulario Registro)-End -->


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


    <!-- Footer Fim -->


    <!-- Scripts -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="personalizar.js"></script>

    <script src="javaSC.js"></script>

    <script src="javaTelefone.js"></script>

    <script src="carro.js"></script>


    <!-- Scripts -->


</body>

</html>