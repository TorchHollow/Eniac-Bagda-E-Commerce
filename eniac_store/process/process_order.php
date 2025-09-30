<?php
require_once '../includes/header.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id']) || empty($_SESSION['cart'])) { header("Location: ../public/cart.php"); exit(); }

$user_id = $_SESSION['user_id'];
$cart_total = calculate_cart_total($conn);
$telefone = $_POST['telefone']; $endereco = $_POST['endereco'];
$entrega_tipo = $_POST['entrega_tipo']; $forma_pagamento = $_POST['forma_pagamento'];

// Lógica simples de frete
if ($entrega_tipo == 'envio') { $cart_total += 15.00; }

$conn->begin_transaction();
try {
    $stmt = $conn->prepare("UPDATE users SET telefone = ?, endereco = ? WHERE id = ?");
    $stmt->bind_param("ssi", $telefone, $endereco, $user_id);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, forma_pagamento, entrega_tipo, endereco_entrega) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $user_id, $cart_total, $forma_pagamento, $entrega_tipo, $endereco);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $product = get_product_details($conn, $product_id);
        if ($product) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, nome_produto, quantidade, preco_unit) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisid", $order_id, $product_id, $product['nome'], $quantity, $product['preco']);
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE products SET estoque = estoque - ? WHERE id = ?");
            $stmt->bind_param("ii", $quantity, $product_id);
            $stmt->execute();
        }
    }
    $conn->commit();
    unset($_SESSION['cart']);

    echo "<!DOCTYPE html><html lang='pt-BR'><head><title>Compra Realizada!</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>";
    echo "<div class='container' style='text-align:center; background: white; padding: 40px; margin-top: 50px; border-radius: 8px;'><h1>Compra Realizada com Sucesso!</h1>";
    echo "<p>Obrigado por comprar na Eniac Store. Seu pedido #{$order_id} está sendo processado.</p>";
    echo "<a href='../public/user.php' class='checkout-btn' style='text-decoration: none;'>Ver Meus Pedidos</a></div>";
    echo "</body></html>";

} catch (Exception $e) {
    $conn->rollback();
    echo "Erro ao processar pedido: " . $e->getMessage();
}
?>