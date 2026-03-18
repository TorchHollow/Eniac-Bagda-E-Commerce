<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_GET['action'] ?? 'view';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($id > 0) {
    switch ($action) {
        case 'add':
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $quantity;
            } else {
                $_SESSION['cart'][$id] = $quantity;
            }
            break;

        case 'update':
            if (isset($_SESSION['cart'][$id]) && $quantity > 0) {
                $_SESSION['cart'][$id] = $quantity;
            }
            break;

        case 'remove':
            if (isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
            }
            break;
    }
}

header("Location: ../pages/cart.php");
exit();
?>