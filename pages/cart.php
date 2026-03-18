<?php
require_once '../includes/header.php';
require_once '../includes/conexao.php';

$cart_items = [];
$subtotal = 0;

if (!empty($_SESSION['cart'])) {
    // Pega os IDs dos produtos do carrinho
    $product_ids = array_keys($_SESSION['cart']);
    $id_list = implode(',', $product_ids);

    // Busca os detalhes de todos os produtos no carrinho com uma única query
    $stmt = $db->query("SELECT id, nome, valor, imagem_1 FROM produtos WHERE id IN ($id_list)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcula o subtotal e organiza os itens
    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $total_item = $product['valor'] * $quantity;
        $subtotal += $total_item;
        
        $cart_items[] = [
            'id' => $product['id'],
            'nome' => $product['nome'],
            'valor' => $product['valor'],
            'imagem_1' => $product['imagem_1'],
            'quantity' => $quantity,
            'total_item' => $total_item
        ];
    }
}
?>

<title>Meu Carrinho - E-commerce Eniac</title>
<link rel="stylesheet" href="../assets/css/cart.css"> <h1 class="page-title">Meu Carrinho de Compras</h1>

<div class="cart-container">
    <div class="cart-items-list">
        <?php if (empty($cart_items)): ?>
            <p class="cart-empty">Seu carrinho está vazio. <a href="catalogo.php">Volte ao catálogo</a> para adicionar produtos!</p>
        <?php else: ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="../uploads/<?php echo htmlspecialchars($item['imagem_1']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                    <div class="item-info">
                        <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                        <p class="item-price">R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></p>
                    </div>
                    <div class="item-actions">
                        <form action="../includes/handle_cart.php?action=update&id=<?php echo $item['id']; ?>" method="post">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="item-quantity">
                            <button type="submit" class="btn-update">Atualizar</button>
                        </form>
                        <a href="../includes/handle_cart.php?action=remove&id=<?php echo $item['id']; ?>" class="btn-remove">Remover</a>
                    </div>
                    <p class="item-total">R$ <?php echo number_format($item['total_item'], 2, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($cart_items)): ?>
        <div class="cart-summary">
            <h2>Resumo do Pedido</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <strong>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></strong>
            </div>
            <hr>
            <a href="checkout.php" class="btn-checkout">Finalizar Compra</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>