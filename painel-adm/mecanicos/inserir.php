<?php
require_once("../../conexao.php");
$nome = $_POST['nome-mec'];
$telefone = $_POST['telefone-mec'];
$cpf = $_POST['cpf-mec'];
$email = $_POST['email-mec'];
$endereco = $_POST['endereco-mec'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

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
} else {
    $res = $pdo->prepare("UPDATE mecanicos SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = :id");

    $res->bindValue(":id", $id);
}
$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);
$res->execute();
echo 'Salvo com Sucesso!';
