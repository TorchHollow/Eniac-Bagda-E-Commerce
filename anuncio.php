<?php
include 'db.php';

// Captura o ID do produto via GET (ex: anuncio.php?id=1)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo "Produto não encontrado!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($produto['titulo']) ?></title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <header class="cabecalho">
      <h1 class="logo"><a href="index.php">Minha Loja</a></h1>
      <nav>
          <ul>
              <li><a href="index.php">Início</a></li>
              <li><a href="produtos.php">Produtos</a></li>
              <li><a href="contato.php">Contato</a></li>
          </ul>
      </nav>
  </header>

  <main class="container">

    <!-- Título do Produto -->
    <h1 class="titulo-produto"><?= htmlspecialchars($produto['titulo']) ?></h1>

    <!-- Galeria de Imagens -->
    <div class="galeria">
      <?php if ($produto['imagem_principal']): ?>
        <img src="uploads/<?= $produto['imagem_principal'] ?>" alt="Imagem principal" class="img-principal">
      <?php endif; ?>

      <div class="miniaturas">
        <?php if ($produto['imagem_secundaria']): ?>
          <img src="uploads/<?= $produto['imagem_secundaria'] ?>" alt="Imagem secundária">
        <?php endif; ?>
        <?php if ($produto['imagem_terciaria']): ?>
          <img src="uploads/<?= $produto['imagem_terciaria'] ?>" alt="Imagem terciária">
        <?php endif; ?>
      </div>
    </div>

    <!-- Preço -->
    <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

    <!-- Descrição -->
    <section class="descricao">
      <h2>Descrição do Produto</h2>
      <p><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
    </section>

    <!-- Botão Comprar -->
    <div class="acoes">
        <a href="checkout.php?produto=<?= $produto['id'] ?>" class="btn-comprar">Comprar</a>
        <a href="carrinho.php?add=<?= $produto['id'] ?>" class="btn-carrinho">Adicionar ao Carrinho</a>
    </div>

  </main>

  <footer class="rodape">
      <p>&copy; <?= date("Y") ?> - Minha Loja. Todos os direitos reservados.</p>
  </footer>
</body>
</html>
