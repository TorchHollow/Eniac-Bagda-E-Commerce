<?php
$host = "localhost";
$user = "root"; // seu usuário do MySQL
$pass = "";     // sua senha do MySQL
$db   = "loja"; // nome do banco

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>