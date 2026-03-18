<?php
$host = 'localhost';
$db_name = 'eniac_ecommerce';
$user = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>