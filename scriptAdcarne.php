<?php
include("conexao.php");

//imagem carninha

$novo_nome = md5(time()). ".jpg";

if(empty($_FILES['Prodfoto']['size']) !=1){

    $diretorio  ="imgProd/";

    $nomeCompleto = $diretorio.$novo_nome;

    move_uploaded_file($_FILES['Prodfoto']['tmp_name'],$nomeCompleto);


}

//variaveis------------------------------------------

$Nomeproduto = $_POST['Prodnome'];

$Precoproduto = $_POST['Prodpreco'];

$Tipoproduto = $_POST['Prodtipo'];

$Produnidade = $_POST['Produnidade'];

$Prodquant = $_POST['Prodquantidade'];

$barras = $_POST['Prodcodigobarras'];

$Prodmarca = $_POST['Prodmarca'];

$Desc = $_POST ['Proddescricao'];   

$Prodpesovenda = $_POST['Prodvalpeso'];



//----------------------------------------------------

//Mandar os valores para tabela produto

try{

    $comando = "INSERT INTO tb_produto (prod_codbarras, prod_desc, prod_img, prod_marca, prod_nome, prod_tipo, prod_valor, prod_unipeso, prod_pesoval ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $s = $con->prepare($comando);

    $s -> bindParam(1, $barras);

    $s -> bindParam(2, $Desc);

    $s -> bindParam(3, $novo_nome);

    $s -> bindParam(4, $Prodmarca);

    $s -> bindParam(5, $Nomeproduto);

    $s -> bindParam(6, $Tipoproduto);

    $s -> bindParam(7, $Precoproduto);

    $s -> bindParam(8, $Produnidade);

    $s -> bindParam(9, $Prodpesovenda);


    $s->execute();

//variavel chave estrangeira para estoque 

    $prod_id = $con->lastInsertId();


    $comando = "INSERT INTO tb_estoque(est_quant,prod_id) VALUES (?,?)";

    $sEst = $con ->prepare($comando);

    $sEst -> bindParam(1, $Prodquant);

    $sEst -> bindParam(2, $prod_id);

    $sEst ->execute();

    header("location:Edicao.php" );

}catch(PDOException $e){

    echo "Erro: " . $e->getMessage();

}

$con = null;

?>