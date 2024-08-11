<?php
session_start();

include("conexao.php");

$email = $_POST['email'];

$senha = $_POST['senha'];

try {

    $comando = "SELECT * FROM tb_usuario WHERE Email = ?";

    $s = $con->prepare($comando);

    $s->bindParam(1, $email);

    $s->execute();

    if ($s->rowCount() > 0) {

        $usuario = $s->fetch(PDO::FETCH_ASSOC);

        if (password_verify($senha, $usuario['Senha'])) {

            $nomeCompleto = $usuario['Nome'];

            $partesNome = explode(' ', $nomeCompleto);

            $primeiroNome = $partesNome[0];

            $inicialSobrenome = isset($partesNome[1]) ? substr($partesNome[1], 0, 1) . '.' : '';

            $nomeFormatado = $primeiroNome . ' ' . $inicialSobrenome;

            $_SESSION['nome'] = $nomeFormatado;

            header("Location: index.php");

            exit();

        } else {

            echo "Senha incorreta.";
        }
        
    } else {

        echo "E-mail não encontrado.";

    }
} catch(PDOException $e) {

    echo "Erro: " . $e->getMessage();
}

$con = null;
?>