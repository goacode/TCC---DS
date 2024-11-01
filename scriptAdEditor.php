<?php



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

$datanasc = $_POST['datanasc'];

$pessoa = $_POST['pessoa'];

$role = 'edit';

if (isset($_POST['cpf'])){


$cpf_cnpj = $_POST['cpf'];

}else if(isset($_POST['cnpj'])) {

    $cpf_cnpj = $_POST["cnpj"];
    
} else {
    
    echo '[ERRO] Tente Novamente'; 
}

if(isset($_POST['telefone'])){
    
    $telefone = $_POST['telefone'];

} else if (isset($_POST['telefonecel'])) {

    $telefone = $_POST['telefonecel'];

}else{

    echo '[ERR] Tente novamente';
}

$ramal = $_POST['ramal'];

$teltipo = $_POST['teltipo'];




$complemento = $_POST['complemento'];

$numeroLocal = $_POST['numero'];


function padronizar($cpf_cnpj) {

    return preg_replace('/\D/', '', $cpf_cnpj); 
}

$cpf_cnpjFormatado = padronizar($cpf_cnpj);


try{

    // Inserção na tabela cliente

    $comando = "INSERT INTO tb_cliente ( cli_email, cli_senha, cli_nome, cli_nasc, cli_cpf_cnpj, cli_tipo, cli_role) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $s = $con->prepare($comando);

    $s->bindParam(1, $email);

    $s->bindParam(2, $senha_hash);

    $s->bindParam(3, $nome);

    $s->bindParam(4, $datanasc);

    $s->bindParam(5, $cpf_cnpjFormatado);

    $s->bindParam(6, $pessoa);

    $s->bindParam(7, $role);

    $s->execute();

   //------------------ 

    $cli_id = $con->lastInsertId();

    $_SESSION['id_cliente'] = $cli_id;


    $comandoTeltipo = "INSERT INTO tb_teltipo (teltipo_tipo) VALUES (?)";
    
    $sTipo = $con -> prepare ($comandoTeltipo);

    $sTipo -> bindParam(1, $teltipo);

    $sTipo -> execute();

    $tipo_id = $con -> lastInsertId();


    $comandoTelefone  = "INSERT INTO tb_telefone(tel_numero, tel_ramal, cli_id, teltipo_id) VALUES (?, ?, ?, ?)";

    $sTel = $con -> prepare($comandoTelefone);

    $sTel -> bindParam(1, $telefone);

    $sTel -> bindParam(2, $ramal);

    $sTel -> bindParam(3, $cli_id);

    $sTel -> bindParam(4, $tipo_id);

    $sTel -> execute();

    // Inserção na tabela endereço

    $comandoEnd = "INSERT INTO tb_endereco(end_cep,end_logradouro,end_numero,end_bairro,end_cidade,end_uf,end_complemento,cli_id) VALUES (?,?,?,?,?,?,?,?)";

    $sEnd = $con->prepare($comandoEnd);

    $sEnd -> bindParam(1, $cep);

    $sEnd -> bindParam(2, $logradouro);

    $sEnd -> bindParam(3, $numeroLocal);

    $sEnd -> bindParam(4, $bairro);

    $sEnd -> bindParam(5, $localidade);

    $sEnd -> bindParam(6, $uf);

    $sEnd -> bindParam(7, $complemento);

    $sEnd -> bindParam(8, $cli_id);

    $sEnd->execute();
    
    //--------------

    $nome = $_POST['nome'];

    $partesNome = explode(' ', $nome);

    $primeiroNome = $partesNome[0];

    $inicialSobrenome = isset($partesNome[1]) ? substr($partesNome[1], 0, 1) . '.' : '';

    $nomeFormatado = $primeiroNome . ' ' . $inicialSobrenome;

    $_SESSION['nome'] = $nomeFormatado;

    exit();

    header("location: AdicionarEditor.html");

} catch(PDOException $e) {
    
    echo "Erro: " . $e->getMessage();
}

$con = null;










?>