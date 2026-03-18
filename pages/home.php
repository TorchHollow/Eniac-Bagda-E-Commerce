<?php 
require_once '../includes/header.php'; 
require_once '../includes/conexao.php';

try {
    // ALTERAÇÃO: Removido o LIMIT 10 para buscar mais produtos e garantir que a seção de Destaque seja preenchida.
    $stmt_produtos = $db->query("SELECT id, nome, valor, imagem_1 FROM produtos WHERE imagem_1 IS NOT NULL ORDER BY id DESC");
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produtos = [];
}
?>

<div id="mensagens"></div>

<div class="endereco">
    <img src="<?php echo BASE_URL; ?>/assets/images/pin.png" alt="" class="map">
    <a href="#" class="cep">Digite seu CEP </a>
</div>
<div class="box-cep">
    <p>Adicione o seu CEP</p>
    <input type="text" placeholder="Digite seu CEP" id="inputCep" maxlength="9">
    <button id="btnAdicionar">Adicionar</button>
</div>

<section class="container">
    <div class="banner">
        <img src="<?php echo BASE_URL; ?>/assets/images/banner.jpg" alt="Banner Promocional">
    </div>
    
    <div class="slider-wrapper">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <div class="slider">
            <div class="slide">
                <div class="card"><a class="card-img" href="#"><img src="<?php echo BASE_URL; ?>/assets/images/desk-chair.png"></a><a href="#"><h3>Cadeiras</h3></a></div>
                <div class="card"><a class="card-img" href="#"><img src="<?php echo BASE_URL; ?>/assets/images/stack-of-books.png"></a><a href="#"><h3>Livros</h3></a></div>
                <div class="card"><a class="card-img3" href="#"><img src="<?php echo BASE_URL; ?>/assets/images/computer-mouse.png"></a><a href="#"><h3>Mouses</h3></a></div>
                <div class="card"><a class="card-img" href="#"><img src="<?php echo BASE_URL; ?>/assets/images/laptop-computer.png"></a><a href="#"><h3>Notebooks</h3></a></div>
                <div class="card"><a class="card-img" href="<?php echo BASE_URL; ?>/pages/catalogo.php"><img src="<?php echo BASE_URL; ?>/assets/images/caixas.png"></a><a href="<?php echo BASE_URL; ?>/pages/catalogo.php"><h3>Ver Catálogo</h3></a></div>
            </div>
        </div>
    </div>

    <h2 class="tittle-slide">Recomendado para você</h2>
    <div class="slider-produto">
        
        <button class="prev-produto" onclick="plusSlidesProduto(-1)">&#10094;</button>
        <button class="next-produto" onclick="plusSlidesProduto(1)">&#10095;</button>
        <div class="slide-produto">
            <?php if (!empty($produtos)): ?>
                <?php foreach (array_slice($produtos, 0, 5) as $produto): ?>
                    <div class="card-produto" data-id="<?php echo $produto['id']; ?>">
                        <div class="card-img-produto">
                            <a href="produto_detalhe.php?id=<?php echo $produto['id']; ?>"><img src="../uploads/<?php echo htmlspecialchars($produto['imagem_1']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>"></a>
                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar"><img src="<?php echo BASE_URL; ?>/assets/images/heart.png" alt="Favoritar"></button>
                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-produto">
                            <div class="categoria-produto"><a href="#"><span>PRODUTOS</span></a><h3><?php echo htmlspecialchars($produto['nome']); ?></h3></div>
                            <div class="condicoes">
                                <div class="condicao-produto"><div class="estrelas-produto">★★★★☆</div><span>(Condição: 4/5)</span></div>
                                <div class="preco-status">
                                    <span class="preco-produto">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto com desconto encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="ofertas">
        <div class="menu-ofertas">
            <h2>Produstos em destaque</h2>
            <div class="navegacao">
                <a href="#">Ver Todas</a><a href="#">Cadeiras</a><a href="#">Monitores</a><a href="#">Livros</a>
            </div>
        </div>
        <div class="catalogo-ofertas">
            <?php if (!empty($produtos) && count($produtos) > 5): ?>
                <?php foreach (array_slice($produtos, 5) as $produto): ?>
                    <div class="card-produto-oferta" data-id="<?php echo $produto['id']; ?>">
                        <div class="card-img-oferta">
                            <a href="produto_detalhe.php?id=<?php echo $produto['id']; ?>"><img src="../uploads/<?php echo htmlspecialchars($produto['imagem_1']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>"></a>
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar"><img src="<?php echo BASE_URL; ?>/assets/images/heart.png" alt="Favoritar"></button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#"><span class="categoria-oferta">OFERTAS</span></a>
                            <h3 class="nome-oferta"><?php echo htmlspecialchars($produto['nome']); ?></h3>
                            <div class="condicao-oferta"><div class="estrelas-oferta">★★★★☆</div><span class="nota-oferta">(Condição: 4/5)</span></div>
                            <span class="preco-oferta">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: white; text-align: center; width: 100%;">Nenhuma oferta encontrada hoje.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php 
require_once '../includes/footer.php'; 
?>