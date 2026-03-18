<?php
// Inclui o cabeçalho, que inicia a sessão
require_once '../includes/header.php';
require_once '../includes/conexao.php';

// --- Proteção da Página ---
// 1. Redireciona para o login se o usuário não estiver logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php?redirect=checkout"); // O redirect ajuda a voltar aqui depois do login
    exit();
}
// 2. Redireciona para o carrinho se ele estiver vazio
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
// -------------------------

$id_usuario = $_SESSION['id_usuario'];
$cart_items = [];
$subtotal = 0;

// Busca os dados do usuário para preencher o formulário
$stmt_user = $db->prepare("SELECT nome, email, telefone FROM usuario WHERE id_usuario = :id");
$stmt_user->bindParam(':id', $id_usuario);
$stmt_user->execute();
$usuario = $stmt_user->fetch(PDO::FETCH_ASSOC);

// Busca os itens do carrinho para o resumo (mesma lógica do cart.php)
$product_ids = array_keys($_SESSION['cart']);
$id_list = implode(',', $product_ids);
$stmt_products = $db->query("SELECT id, nome, valor FROM produtos WHERE id IN ($id_list)");
$products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    $quantity = $_SESSION['cart'][$product['id']];
    $subtotal += $product['valor'] * $quantity;
}
?>

<title>Finalizar Compra - E-commerce Eniac</title>
<link rel="stylesheet" href="../assets/css/checkout.css"> <h1 class="page-title">Finalizar Compra</h1>

<form action="../includes/process_order.php" method="POST" class="checkout-form">
    <div class="form-section">
        <h3>1. Seus Dados</h3>
        <label>Nome Completo</label>
        <input type="text" value="<?php echo htmlspecialchars($usuario['nome']); ?>" disabled>
        
        <label>E-mail</label>
        <input type="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" disabled>

        <label for="telefone">Telefone para Contato</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>" required>
    </div>

    <div class="form-section">
        <h3>2. Resumo do Pedido</h3>
        <div class="summary-row">
            <span>Subtotal</span>
            <strong>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></strong>
        </div>
        <div class="summary-row">
            <span>Frete</span>
            <strong>Grátis</strong>
        </div>
        <hr>
        <div class="summary-row total">
            <span>Total</span>
            <strong>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></strong>
        </div>
    </div>

    <button type="submit" class="btn-confirm-order">Confirmar e Finalizar Pedido</button>
</form>

<?php require_once '../includes/footer.php'; ?>