<?php

session_start();

include ("conexao.php");

$idtel = filter_input(INPUT_GET, 'id');

if ($idtel) {

    $comando = $con->prepare("SELECT teltipo_id FROM tb_telefone WHERE id_telefone = :id_telefone");

    $comando->bindValue(':id_telefone', $idtel);

    $comando->execute();

    if ($comando->rowCount() > 0) {

        $telefone = $comando->fetch(PDO::FETCH_ASSOC);

        $teltipo_id = $telefone['teltipo_id']; 
        
       
        $comandoDeleteTelefone = $con->prepare("DELETE FROM tb_telefone WHERE id_telefone = :id_telefone");

        $comandoDeleteTelefone->bindValue(':id_telefone', $idtel);

        $comandoDeleteTelefone->execute();
        
        $comandoVerificaTeltipo = $con->prepare("SELECT COUNT(*) AS total FROM tb_telefone WHERE teltipo_id = :teltipo_id");

        $comandoVerificaTeltipo->bindValue(':teltipo_id', $teltipo_id);

        $comandoVerificaTeltipo->execute();

        $result = $comandoVerificaTeltipo->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] == 0) {

            $comandoDeleteTeltipo = $con->prepare("DELETE FROM tb_teltipo WHERE id_teltipo = :id_teltipo");

            $comandoDeleteTeltipo->bindValue(':id_teltipo', $teltipo_id);

            $comandoDeleteTeltipo->execute();

        }

        header("location:dados.php");
        
    } else {

        echo "Telefone não encontrado.";

    }
}

?>
