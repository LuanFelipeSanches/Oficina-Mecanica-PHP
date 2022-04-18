<?php   

require_once("config.php"); 
date_default_timezone_set('America/Campo_Grande');

try {
    $pdo = new PDO("mysql:dbname=$banco;hostname=$servidor;charset=utf8","$usuario","$senha");

    //Conexão mysql para backup 
$conn = mysqli_connect($servidor,$usuario,$senha,$banco);

}catch(Exception $e){
    echo "Erro ao conectar com o banco de dados! ". $e;
}
?>