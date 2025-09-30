<?php require_once '../includes/header.php'; ?>
<title>Catálogo de Produtos</title>
<link rel="stylesheet" href="../assets/css/style.css">
<main class="container">
    <section class="cart-items" style="flex-basis: 100%;">
        <h2 style="margin-bottom: 20px;">Catálogo de Produtos</h2>
        <?php
        $result = $conn->query("SELECT * FROM products WHERE estoque > 0");
        if ($result->num_rows > 0):
        while ($product = $result->fetch_assoc()):
        ?>
        <div class="cart-item">
            <img src="/eniac_store/public/<?php echo !empty($product['imagem']) ? htmlspecialchars($product['imagem']) : 'uploads/placeholder.png'; ?>" alt="<?php echo htmlspecialchars($product['nome']); ?>" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="cart-item-info">
                <h3><?php echo htmlspecialchars($product['nome']); ?></h3>
                <p><strong>Condição:</strong> <?php echo htmlspecialchars($product['condicao']); ?></p>
                <p><?php echo htmlspecialchars($product['descricao']); ?></p>
                <p class="price">R$ <?php echo number_format($product['preco'], 2, ',', '.'); ?></p>
                <form action="../process/handle_cart.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="quantity">
                        Quantidade: <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['estoque']; ?>">
                    </div>
                    <button type="submit" class="checkout-btn" style="width: auto; padding: 8px 12px; margin-top: 10px;">Adicionar ao Carrinho</button>
                </form>
            </div>
        </div>
        <?php endwhile; else: ?>
            <p>Nenhum produto disponível no momento.</p>
        <?php endif; ?>
    </section>
</main>
</body></html>