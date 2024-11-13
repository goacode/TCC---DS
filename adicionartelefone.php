<?php

session_start();

include ("conexao.php");

$id_cliente  =  filter_input(INPUT_POST, 'id_cliente');

$ramal = $_POST['ramal'];

$teltipo = $_POST['teltipo'];

if(isset($_POST['telefone'])){
    
    $telefone = $_POST['telefone'];

} else if (isset($_POST['telefonecel'])) {

    $telefone = $_POST['telefonecel'];

}else{

    echo '[ERR] Tente novamente';
}

try{
    
$comandoTeltipo = "INSERT INTO tb_teltipo (teltipo_tipo) VALUES (?)";
    
$sTipo = $con -> prepare ($comandoTeltipo);

$sTipo -> bindParam(1, $teltipo);

$sTipo -> execute();

$tipo_id = $con -> lastInsertId();


$comandoTelefone  = "INSERT INTO tb_telefone(tel_numero, tel_ramal, cli_id, teltipo_id) VALUES (?, ?, ?, ?)";

$sTel = $con -> prepare($comandoTelefone);

$sTel -> bindParam(1, $telefone);

$sTel -> bindParam(2, $ramal);

$sTel -> bindParam(3, $id_cliente);

$sTel -> bindParam(4, $tipo_id);

$sTel -> execute();

header("location:dados.php");

$_SESSION['Msg'] = 'Telefone adicionado com Sucesso!';

} catch(PDOException $e) {
    
    echo "Erro: " . $e->getMessage();
}




?>


