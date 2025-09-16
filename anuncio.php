<?php
include 'db.php';

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
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="cabecalho">
      <h1 class="logo"><a href="index.php">Eniac Bagdá</a></h1>

      <!-- Botão hambúrguer -->
      <button class="menu-toggle" aria-label="Abrir Menu">☰</button>

      <nav class="menu">
          <ul>
              <li><a href="login.php">Entrar</a></li>
              <li><a href="produtos.php">Catálogo</a></li>
          </ul>
      </nav>
  </header>

  <main class="container">

    <!-- Título do Produto -->
    <h1 class="titulo-produto"><?= htmlspecialchars($produto['titulo']) ?></h1>

    <!-- Galeria de Imagens -->
    <div class="galeria">
      <button class="nav-btn prev" aria-label="Imagem anterior">⬅️</button>

      <?php if ($produto['imagem_principal']): ?>
        <img src="uploads/<?= $produto['imagem_principal'] ?>" 
             alt="Imagem principal" 
             class="img-principal" 
             id="img-principal">
      <?php endif; ?>

      <button class="nav-btn next" aria-label="Próxima imagem">➡️</button>

      <div class="miniaturas">
        <?php if ($produto['imagem_principal']): ?>
          <img src="uploads/<?= $produto['imagem_principal'] ?>" alt="Miniatura" class="thumb">
        <?php endif; ?>
        <?php if ($produto['imagem_secundaria']): ?>
          <img src="uploads/<?= $produto['imagem_secundaria'] ?>" alt="Miniatura" class="thumb">
        <?php endif; ?>
        <?php if ($produto['imagem_terciaria']): ?>
          <img src="uploads/<?= $produto['imagem_terciaria'] ?>" alt="Miniatura" class="thumb">
        <?php endif; ?>
      </div>
    </div>

    <!-- Preço -->
    <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

    <!-- Botões -->
    <div class="acoes">
        <a href="checkout.php?produto=<?= $produto['id'] ?>" class="btn-comprar">Comprar</a>
        <a href="carrinho.php?add=<?= $produto['id'] ?>" class="btn-carrinho">Adicionar ao Carrinho</a>
    </div>

    <!-- Descrição -->
    <section class="descricao">
      <h2>Descrição do Produto</h2>
      <p><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
    </section>

  </main>

  <footer class="rodape">
      <p>&copy; <?= date("Y") ?> - Eniac Bagdá. Todos os direitos reservados.</p>
  </footer>

<script>
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.querySelector('.menu');
  toggle.addEventListener('click', () => {
    menu.classList.toggle('ativo');
  });

  const imgPrincipal = document.getElementById('img-principal');
  const thumbs = Array.from(document.querySelectorAll('.thumb'));
  const btnPrev = document.querySelector('.prev');
  const btnNext = document.querySelector('.next');
  
  let currentIndex = 0;

  function mostrarImagem(index) {
    if (index >= 0 && index < thumbs.length) {
      imgPrincipal.src = thumbs[index].src;
      currentIndex = index;
      imgPrincipal.classList.remove('zoom');
    }
  }

  thumbs.forEach((thumb, index) => {
    thumb.addEventListener('click', () => {
      mostrarImagem(index);
    });
  });

  btnPrev.addEventListener('click', () => {
    mostrarImagem((currentIndex - 1 + thumbs.length) % thumbs.length);
  });

  btnNext.addEventListener('click', () => {
    mostrarImagem((currentIndex + 1) % thumbs.length);
  });

  imgPrincipal.addEventListener('click', () => {
    imgPrincipal.classList.toggle('zoom');
  });

  let lastTap = 0;
  imgPrincipal.addEventListener('touchend', () => {
    const now = new Date().getTime();
    const timeSince = now - lastTap;
    if (timeSince < 400 && timeSince > 0) {
      imgPrincipal.classList.toggle('zoom');
    }
    lastTap = now;
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
      mostrarImagem((currentIndex - 1 + thumbs.length) % thumbs.length);
    } else if (e.key === 'ArrowRight') {
      mostrarImagem((currentIndex + 1) % thumbs.length);
    }
  });
</script>

</body>
</html>