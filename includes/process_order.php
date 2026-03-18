<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_usuario']) || empty($_SESSION['cart'])) {
    header("Location: ../pages/cart.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$telefone = $_POST['telefone'] ?? '';

$db->beginTransaction();

try {
    $stmt_update_user = $db->prepare("UPDATE usuario SET telefone = :telefone WHERE id_usuario = :id");
    $stmt_update_user->execute([':telefone' => $telefone, ':id' => $id_usuario]);

    $product_ids = array_keys($_SESSION['cart']);
    $id_list = implode(',', array_fill(0, count($product_ids), '?'));
    $stmt_products = $db->prepare("SELECT id, nome, valor FROM produtos WHERE id IN ($id_list)");
    $stmt_products->execute($product_ids);
    $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
    
    $valor_total = 0;
    $produtos_vendidos = [];
    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $valor_total += $product['valor'] * $quantity;
        for ($i=0; $i < $quantity; $i++) { 
            $produtos_vendidos[] = ['id' => $product['id'], 'nome' => $product['nome'], 'valor' => $product['valor']];
        }
    }

    $stmt_insert_venda = $db->prepare("INSERT INTO vendas (id_usuario, valor_total, status, data_venda) VALUES (:id_usuario, :valor_total, 'concluido', NOW())");
    $stmt_insert_venda->execute([':id_usuario' => $id_usuario, ':valor_total' => $valor_total]);
    $id_venda = $db->lastInsertId();

    $stmt_insert_item = $db->prepare("INSERT INTO venda_itens (id_venda, id_produto, nome_produto, valor_produto) VALUES (:id_venda, :id_produto, :nome_produto, :valor_produto)");
    foreach ($produtos_vendidos as $item) {
        $stmt_insert_item->execute([
            ':id_venda' => $id_venda,
            ':id_produto' => $item['id'],
            ':nome_produto' => $item['nome'],
            ':valor_produto' => $item['valor']
        ]);
    }
    
    $db->commit();

    unset($_SESSION['cart']);
    header("Location: ../pages/compra_sucesso.php");
    exit();

} catch (Exception $e) {
    $db->rollBack();
    die("Erro ao processar seu pedido. Detalhe: " . $e->getMessage());
}
?>