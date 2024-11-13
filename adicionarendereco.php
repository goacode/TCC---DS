<?php

session_start();

include ("conexao.php");


$id_cliente  =   filter_input(INPUT_POST, 'id_cliente');

$complemento = $_POST['complemento'];

$numeroLocal = $_POST['numero'];

$cep = $_POST['cep'];

$logradouro = $_POST['logradouro'];

$bairro = $_POST['bairro'];

$localidade = $_POST['localidade'];

$uf = $_POST['UF'];

try{

    $comandoEnd = "INSERT INTO tb_endereco(end_cep,end_logradouro,end_numero,end_bairro,end_cidade,end_uf,end_complemento,cli_id) VALUES (?,?,?,?,?,?,?,?)";

    $sEnd = $con->prepare($comandoEnd);

    $sEnd -> bindParam(1, $cep);

    $sEnd -> bindParam(2, $logradouro);

    $sEnd -> bindParam(3, $numeroLocal);

    $sEnd -> bindParam(4, $bairro);

    $sEnd -> bindParam(5, $localidade);

    $sEnd -> bindParam(6, $uf);

    $sEnd -> bindParam(7, $complemento);

    $sEnd -> bindParam(8, $id_cliente);

    $sEnd->execute();
    
    header ("location:Dados.php");

    $_SESSION['Msg'] = 'Endereço adicionado com Sucesso!';

} catch(PDOException $e) {
    
    echo "Erro: " . $e->getMessage();
}

?>
