<?php

session_start();

include("conexao.php");

$input = $_POST['inputlogin'];

$senha = $_POST['senha'];



function padronizar($input) {

    if (isEmail($input)) {

        return $input; 
    }
    return preg_replace('/\D/', '', $input); 
}


function isEmail($input) {

    return filter_var($input, FILTER_VALIDATE_EMAIL);
}

try {

    if (isEmail($input)) {

        // Se for  email, verificar se o email existe

        $s = $con->prepare("SELECT * FROM tb_cliente WHERE cli_email = ?");

    } else {

        // Se não email, vai ver se o cpf exist

        $s = $con->prepare("SELECT * FROM tb_cliente WHERE cli_cpf_cnpj = ?");
    }

    $s->bindParam(1, $input);

    $s->execute();


    if ($s->rowCount() > 0) {

        $usuario = $s->fetch(PDO::FETCH_ASSOC);

        if (password_verify($senha, $usuario['cli_senha'])) {

            if ($usuario['cli_role'] !== 'edit') {

                $_SESSION['error_message'] = 'Acesso negado.';

                header("Location:LoginEditor.php");

                exit();
            }

            $_SESSION['id_cliente'] = $usuario['id_cliente']; 

            $nomeCompleto = $usuario['cli_nome'];

            $partesNome = explode(' ', $nomeCompleto);

            $primeiroNome = $partesNome[0];

            $inicialSobrenome = isset($partesNome[1]) ? substr($partesNome[1], 0, 1) . '.' : '';

            $nomeFormatado = $primeiroNome . ' ' . $inicialSobrenome;

            $_SESSION['nome'] = $nomeFormatado;

            header("Location:Edicao.php");

            exit();

        } else {

            $_SESSION['error_message'] = 'Acesso Negado.';
            header("Location:LoginEditor.php");
            exit();
        }
        
    } else {

        $_SESSION['error_message'] = 'Acesso Negado.';
        header("Location:LoginEditor.php");
        exit();

    }
} catch(PDOException $e) {

    $_SESSION['error_message'] = "Erro: " . $e->getMessage();
    header("Location:LoginEditor.php");
    exit();
}

$con = null;




?>