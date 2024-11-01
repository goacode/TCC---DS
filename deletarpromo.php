<?php

include("conexao.php");

$id = filter_input(INPUT_GET, 'id');

if($id){

    $comando = $con->prepare("DELETE FROM tb_promocoes WHERE id_produto = :id_produto");

    $comando->bindValue(':id_produto', $id);

    if($comando->execute()){
      
        header("Location: produtolog.php");

    } else {
    
        echo "Erro ao excluir promoção.";
    }
} else {
 
    echo "ID de produto inválido.";
}

?>