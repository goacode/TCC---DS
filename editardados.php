<?php

session_start();

include("conexao.php");

$id_cliente  =   filter_input(INPUT_POST, 'id_cliente');

$novonome =  filter_input(INPUT_POST, 'nomeusuario');

$novoemail =  filter_input(INPUT_POST, 'emailusuario');

$cpf_cnpj =  filter_input(INPUT_POST, 'cpf_cnpj');

$datanasc =  filter_input(INPUT_POST, 'datanasc');



if ($novonome && $novoemail && $cpf_cnpj && $datanasc && $id_cliente) {

    $comando = $con->prepare("UPDATE tb_cliente SET cli_nome = :cli_nome, cli_email = :cli_email, cli_cpf_cnpj = :cli_cpf_cnpj, cli_nasc = :cli_nasc WHERE id_cliente = :id_cliente");

    $comando->bindValue(':cli_nome', $novonome);

    $comando->bindValue(':cli_email', $novoemail);

    $comando->bindValue(':cli_cpf_cnpj', $cpf_cnpj);

    $comando->bindValue(':cli_nasc', $datanasc);

    $comando->bindValue(':id_cliente', $id_cliente);

    $comando->execute();

    $partesNome = explode(' ', $novonome);
    
    $primeiroNome = $partesNome[0];

    $inicialSobrenome = isset($partesNome[1]) ? substr($partesNome[1], 0, 1) . '.' : '';


    $nomeFormatado = $primeiroNome . ' ' . $inicialSobrenome;

    $_SESSION['nome'] = htmlspecialchars($nomeFormatado);

    $_SESSION['Msg'] = 'Dados atualizados com Exito!';
    
    header("location: dados.php");

    exit;

} else {
    
    header("location: dados.php");

    exit;
}

?>
