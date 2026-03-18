<?php 
require_once '../includes/header.php'; 
require_once '../includes/conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Produto inválido.");
}

try {
    $stmt = $db->prepare("SELECT nome, descricao, valor, imagem_1, imagem_2, imagem_3 FROM produtos WHERE id = :id");
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar o produto.");
}

if (!$produto) {
    die("Produto não encontrado!");
}
?>

<title><?php echo htmlspecialchars($produto['nome']); ?> - E-commerce Eniac</title>
<link rel="stylesheet" href="../assets/css/produto_detalhe.css">

<div class="produto-detalhe-container">
    <div class="galeria">
        <button class="nav-btn prev" aria-label="Imagem anterior">⬅️</button>
        
        <img src="../uploads/<?php echo htmlspecialchars($produto['imagem_1'] ?? 'placeholder.png'); ?>" 
             alt="Imagem principal do produto" 
             class="img-principal" 
             id="img-principal">
             
        <button class="nav-btn next" aria-label="Próxima imagem">➡️</button>
    </div>

    <div class="miniaturas">
        <?php if (!empty($produto['imagem_1'])): ?><img src="../uploads/<?php echo htmlspecialchars($produto['imagem_1']); ?>" alt="Miniatura 1" class="thumb"><?php endif; ?>
        <?php if (!empty($produto['imagem_2'])): ?><img src="../uploads/<?php echo htmlspecialchars($produto['imagem_2']); ?>" alt="Miniatura 2" class="thumb"><?php endif; ?>
        <?php if (!empty($produto['imagem_3'])): ?><img src="../uploads/<?php echo htmlspecialchars($produto['imagem_3']); ?>" alt="Miniatura 3" class="thumb"><?php endif; ?>
    </div>

    <div class="info-produto">
        <h1 class="titulo-produto"><?php echo htmlspecialchars($produto['nome']); ?></h1>
        <p class="preco">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
        
        <div class="acoes">
            <a href="checkout.php?id=<?php echo $id; ?>" class="btn-comprar">Comprar Agora</a>
            <a href="../includes/handle_cart.php?action=add&id=<?php echo $id; ?>" class="btn-carrinho">Adicionar ao Carrinho</a>
        </div>
        
        <section class="descricao">
            <h2>Descrição do Produto</h2>
            <p><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
        </section>
    </div>
</div>

<script src="../assets/js/produto_detalhe.js"></script>

<?php require_once '../includes/footer.php'; ?>