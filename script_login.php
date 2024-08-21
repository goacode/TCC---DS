<?php
session_start();

include("conexao.php");

$input = $_POST['inputLog'];

$senha = $_POST['senha'];


function padronizar($input) {

    return preg_replace('/\D/', '', $input); 
}

$inputFormatado = padronizar($input);




function isEmail($inputFormatado) {

    return filter_var($inputFormatado, FILTER_VALIDATE_EMAIL);
}

try {

    if (isEmail($inputFormatado)) {

        // Se for  email, verificar se o email existe

        $s = $con->prepare("SELECT * FROM tb_usuario WHERE Email = ?");

    } else {

        // Se não email, vai ver se o cpf exist

        $s = $con->prepare("SELECT * FROM tb_usuario WHERE CPF = ?");
    }

    $s->bindParam(1, $inputFormatado);

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

        echo "E-mail  ou CPF nao encontrado.";

    }
} catch(PDOException $e) {

    echo "Erro: " . $e->getMessage();
}

$con = null;
?>