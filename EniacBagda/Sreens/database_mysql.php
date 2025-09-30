<?php
// Arquivo: database_mysql.php

// Configurações do Banco de Dados MySQL no XAMPP
$host = 'localhost';
$db_name = 'eniac_ecommerce'; // O nome do banco que você criou no phpMyAdmin
$user = 'root'; // Usuário padrão do XAMPP
$password = ''; // Senha padrão do XAMPP

// Tenta conectar ao banco de dados usando PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $password);
    // Configura o PDO para lançar exceções em caso de erros
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configura para que as strings não sejam emuladas
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    // Exibe um erro amigável se a conexão falhar
    die("Erro de conexão com o MySQL. Verifique se o MySQL no XAMPP está rodando e se o banco de dados '{$db_name}' foi criado no phpMyAdmin.");
}
// A variável $db contém a conexão ativa.
?>