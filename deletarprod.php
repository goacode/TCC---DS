<?php

include("conexao.php");

$id = filter_input(INPUT_GET, 'id');

if($id){

    $comandoEst = $con->prepare("DELETE FROM tb_estoque WHERE prod_id = :prod_id");

    $comandoEst->bindValue(':prod_id', $id);

    if($comandoEst->execute()){
        
        $comandoProd = $con->prepare("DELETE FROM tb_produto WHERE id_produto = :id_produto");

        $comandoProd->bindValue(':id_produto', $id);

        if($comandoProd->execute()){
          
            header("Location: produtolog.php");

        } else {
        
            echo "Erro ao excluir produto.";
        }
    } else {
        echo "Erro ao excluir registros do estoque.";
    }
    
} else {
    echo "ID de produto inválido.";
}

?>
