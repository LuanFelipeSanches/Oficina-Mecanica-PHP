<?php
require_once("../../conexao.php");

$id = $_POST['id'];

$res = $php->query("DELETE FROM mecanicos WHERE id = '$id'");

echo 'Excluido com Sucesso!'
?>