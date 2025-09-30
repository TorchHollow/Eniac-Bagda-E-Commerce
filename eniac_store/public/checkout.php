<?php
require_once '../includes/header.php'; require_once '../includes/functions.php';
if (!isset($_SESSION['user_id'])) { header("Location: ../auth/login.php?redirect=checkout"); exit(); }
if (empty($_SESSION['cart'])) { header("Location: cart.php"); exit(); }

$user = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['user_id']}")->fetch_assoc();
$cart_total = calculate_cart_total($conn);
?>
<h1 class="page-title">Finalizar Compra</h1>

<form action="../process/process_order.php" method="POST">
    <div class="row g-4 g-lg-5">
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">1. Dados de Contato e Entrega</h4>
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nome']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="telefone" id="telefone" value="<?php echo htmlspecialchars($user['telefone']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço Completo</label>
                        <textarea class="form-control" name="endereco" id="endereco" rows="3" required><?php echo htmlspecialchars($user['endereco']); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">2. Método de Entrega</h4>
                    <div class="form-check"><input class="form-check-input" type="radio" name="entrega_tipo" id="entrega_envio" value="envio" checked><label class="form-check-label" for="entrega_envio">Entregar no endereço (Frete Fixo: R$ 15,00)</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="entrega_tipo" id="entrega_retirada" value="retirada"><label class="form-check-label" for="entrega_retirada">Retirar na faculdade (Grátis)</label></div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">3. Forma de Pagamento</h4>
                    <div class="form-check"><input class="form-check-input" type="radio" name="forma_pagamento" id="pag_dinheiro" value="dinheiro" checked><label class="form-check-label" for="pag_dinheiro">Dinheiro na entrega/retirada</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="forma_pagamento" id="pag_pix" value="pix"><label class="form-check-label" for="pag_pix">Pix</label></div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card position-sticky" style="top: 20px;">
                <div class="card-body">
                    <h4 class="card-title">Resumo do Pedido</h4>
                    <hr>
                    <ul class="list-group list-group-flush">
                        <?php foreach($_SESSION['cart'] as $product_id => $quantity): 
                            $product = get_product_details($conn, $product_id);
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><?php echo htmlspecialchars($product['nome']); ?> (x<?php echo $quantity; ?>)</span>
                            <strong>R$ <?php echo number_format($product['preco'] * $quantity, 2, ',', '.'); ?></strong>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold h5 mt-3">
                        <span>Total (sem frete)</span>
                        <span>R$ <?php echo number_format($cart_total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-lg btn-confirm">Confirmar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>