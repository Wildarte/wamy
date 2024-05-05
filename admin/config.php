<?php

session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "wamy";


try{

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("SET NAMES utf8");

}catch(PDOException $e){

    die("Erro ao se conectar ao banco de dados: ".$e->getMessage());

}


?>