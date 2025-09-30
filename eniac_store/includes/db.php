<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'eniac_store';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>