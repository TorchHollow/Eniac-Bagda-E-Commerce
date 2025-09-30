<?php
require_once '../includes/header.php';
require_once '../includes/functions.php';
$cart_total = calculate_cart_total($conn);
?>
<h1 class="page-title">Carrinho de Compras</h1>

<div class="row g-4">
    <div class="col-lg-8">
        <?php if (!empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $product_id => $quantity):
                $product = get_product_details($conn, $product_id);
                if ($product):
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <img src="/eniac_store/public/<?php echo !empty($product['imagem']) ? htmlspecialchars($product['imagem']) : 'uploads/placeholder.png'; ?>" alt="<?php echo htmlspecialchars($product['nome']); ?>" class="cart-item-img me-md-3 mb-3 mb-md-0" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.25rem;">
                    
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($product['nome']); ?></h5>
                        <p class="text-muted small mb-2"><?php echo htmlspecialchars($product['condicao']); ?></p>
                        <p class="h5 text-primary fw-bold mb-2">R$ <?php echo number_format($product['preco'], 2, ',', '.'); ?></p>
                    </div>

                    <div class="d-flex align-items-center mt-3 mt-md-0">
                        <form action="../process/handle_cart.php" method="POST" class="d-flex align-items-center">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>" min="1" max="<?php echo $product['estoque']; ?>" style="width: 70px;" onchange="this.form.submit()">
                        </form>
                        <form action="../process/handle_cart.php" method="POST" class="ms-3">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; endforeach; else: ?>
            <div class="alert alert-warning" role="alert">
              Seu carrinho está vazio. <a href="catalog.php" class="alert-link">Volte ao catálogo</a> para encontrar produtos!
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($_SESSION['cart'])): ?>
    <div class="col-lg-4">
        <div class="card position-sticky" style="top: 20px;">
            <div class="card-body">
                <h4 class="card-title">Resumo da Compra</h4>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span>Subtotal</span>
                    <strong>R$ <?php echo number_format($cart_total, 2, ',', '.'); ?></strong>
                </div>
                <div class="d-grid">
                    <a href="checkout.php" class="btn btn-lg btn-checkout">Finalizar Compra</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>