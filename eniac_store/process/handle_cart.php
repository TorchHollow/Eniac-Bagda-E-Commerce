<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = (int)($_POST['product_id'] ?? 0);

    if ($product_id <= 0) { header("Location: ../public/catalog.php"); exit(); }

    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

    switch ($action) {
        case 'add':
            $quantity = (int)($_POST['quantity'] ?? 1);
            if ($quantity <= 0) $quantity = 1;
            $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + $quantity;
            break;
        case 'update':
            $quantity = (int)($_POST['quantity'] ?? 1);
            if ($quantity > 0) { $_SESSION['cart'][$product_id] = $quantity; }
            else { unset($_SESSION['cart'][$product_id]); }
            break;
        case 'remove':
            unset($_SESSION['cart'][$product_id]);
            break;
    }
}
header("Location: ../public/cart.php");
exit();
?>