<?php
require_once("../../conexao.php");
$nome = $_POST['nome_mec'];
$telefone = $_POST['telefone_mec'];
$cpf = $_POST['cpf_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

if ($nome == "") {
    echo 'O nome e Obrigatório!';
    exit();
}
if ($email == "") {
    echo 'O email e Obrigatório!';
    exit();
}
if ($cpf == "") {
    echo 'O cpf e Obrigatório!';
    exit();
}
//VERFICA SE O REGISTRO JA EXISTE NO BANCO DE DADOS
if ($antigo != $cpf) {


    $query = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo 'O CPF já está Cadastrado';
    }
}

if ($id == "") {
    $res = $pdo->prepare("INSERT INTO mecanicos SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone ");

    $res_usuario = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, nivel = :nivel ");
    $res_usuario->bindValue(":senha", 123);
    $res_usuario->bindValue(":nivel",'mecanico');

} else {
    $res = $pdo->prepare("UPDATE mecanicos SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = '$id'");

    $res_usuario = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf  = '$antigo'");
}
$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);

$res_usuario->bindValue(":nome", $nome);
$res_usuario->bindValue(":cpf", $cpf);
$res_usuario->bindValue(":email", $email);


$res->execute();
$res_usuario->execute();
echo 'Salvo com Sucesso!';


?>