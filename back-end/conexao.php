<?php
$conn = new mysqli(
    "localhost", 
    "root", 
    "", 
    "e-commerce-eniac");

if ($conn->connect_error) {
    header("Location: ../pages/Login.php?msg=erro");
    exit;
}
