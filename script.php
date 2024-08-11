<?php
session_start(); 

include("conexao.php");

$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

$nome = $_POST['nome'];

$email = $_POST['email'];

$cep = $_POST['cep'];

$logradouro = $_POST['logradouro'];

$bairro = $_POST['bairro'];

$localidade = $_POST['localidade'];

$uf = $_POST['UF'];

try{

    $comando = "INSERT INTO tb_usuario (Nome, Email, Senha, Cep, Logradouro, Bairro, Localidade, UF) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $s = $con->prepare($comando);

    $s->bindParam(1, $nome);

    $s->bindParam(2, $email);

    $s->bindParam(3, $senha_hash);

    $s->bindParam(4, $cep);

    $s->bindParam(5, $logradouro);

    $s->bindParam(6, $bairro);

    $s->bindParam(7, $localidade);

    $s->bindParam(8, $uf);


    $s->execute();

    $nome = $_POST['nome'];

    $partesNome = explode(' ', $nome);

    $primeiroNome = $partesNome[0];

    $inicialSobrenome = isset($partesNome[1]) ? substr($partesNome[1], 0, 1) . '.' : '';

    $nomeFormatado = $primeiroNome . ' ' . $inicialSobrenome;

    $_SESSION['nome'] = $nomeFormatado;

    
    header("location: index.php");

    exit();

} catch(PDOException $e) {
    
    echo "Erro: " . $e->getMessage();
}

$con = null;
?>

