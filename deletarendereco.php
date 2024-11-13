<?php

session_start();

include ("conexao.php");

$idend = filter_input(INPUT_GET, 'id');

if($idend){

    $comando = $con->prepare("DELETE FROM tb_endereco WHERE id_endereco = :id_endereco");

    $comando->bindValue(':id_endereco', $idend);

    if($comando->execute()){

      
        header("Location: Dados.php");


    } else {
    
        echo "Erro ao deletar endereço.";
    }
}

?>




