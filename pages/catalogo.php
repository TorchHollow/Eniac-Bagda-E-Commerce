<?php 
require_once '../includes/header.php'; 
require_once '../includes/conexao.php';
require_once '../includes/functions.php';

// Verifica se há um termo de busca OU uma categoria na URL
$search_query = $_GET['q'] ?? '';
$category_filter = $_GET['categoria'] ?? ''; // Captura o filtro de categoria

try {
    // Monta a base da consulta SQL
    $sql = "SELECT id, nome, valor, condicao, categoria, imagem_1, descricao FROM produtos WHERE imagem_1 IS NOT NULL";
    
    // 1. Filtro por Termo de Busca (da barra de pesquisa)
    if (!empty($search_query)) {
        $sql .= " AND (nome LIKE :query OR descricao LIKE :query)";
    }

    // 2. Filtro por Categoria (dos links do header)
    if (!empty($category_filter)) {
        $sql .= " AND categoria = :category_filter"; 
    }
    
    $sql .= " ORDER BY id DESC";

    // Prepara a consulta
    $stmt_produtos = $db->prepare($sql);

    // Binde os parâmetros
    if (!empty($search_query)) {
        $like_query = '%' . $search_query . '%';
        $stmt_produtos->bindParam(':query', $like_query);
    }
    
    if (!empty($category_filter)) {
        $stmt_produtos->bindParam(':category_filter', $category_filter);
    }
    
    $stmt_produtos->execute();
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);

    // Lógica para o preço máximo para o range slider
    $stmt_max_price = $db->query("SELECT MAX(valor) AS max_valor FROM produtos");
    $max_price_result = $stmt_max_price->fetch(PDO::FETCH_ASSOC);
    $max_price_db = $max_price_result ? (int)ceil($max_price_result['max_valor']) : 5000; 

} catch (PDOException $e) {
    $produtos = [];
    $max_price_db = 5000; 
}
?>

<title>Catálogo de Produtos - E-commerce Eniac</title>

<div class="catalogo-container">
    <aside class="filtro">
        <h2>Filtros</h2>
        
        <div class="filtro-box">
            <a href="catalogo.php" style="display: block; margin-bottom: 15px; color: #3698d4; text-decoration: none; font-weight: bold;">
                <i class="fas fa-times-circle"></i> Limpar Filtros
            </a>
        </div>
        <div class="filtro-box">
            <h3>Faixa de preço</h3>
            <div class="price-range">
                <input type="range" id="minPrice" min="0" max="<?php echo $max_price_db; ?>" value="0">
                <input type="range" id="maxPrice" min="0" max="<?php echo $max_price_db; ?>" value="<?php echo $max_price_db; ?>">
                <p>R$ <span id="minValue">0</span> - R$ <span id="maxValue"><?php echo number_format($max_price_db, 0, '', '.'); ?></span></p>
            </div>
        </div>

        <div class="filtro-box">
            <h3>Condição</h3>
            <label><input type="checkbox" value="novo"> Novo</label>
            <label><input type="checkbox" value="semi-novo"> Semi-novo</label>
            <label><input type="checkbox" value="usado"> Usado</label>
        </div>

        <div class="filtro-box">
            <h3>Categoria</h3>
            <label><input type="checkbox" value="equipamentos_informatica" <?php echo ($category_filter == 'equipamentos_informatica') ? 'checked' : ''; ?>> Equipamentos de Informática</label>
            <label><input type="checkbox" value="mobilia" <?php echo ($category_filter == 'mobilia') ? 'checked' : ''; ?>> Mobilia</label>
            <label><input type="checkbox" value="midias_fisicas" <?php echo ($category_filter == 'midias_fisicas') ? 'checked' : ''; ?>> Mídias Físicas</label>
            <label><input type="checkbox" value="projetores" <?php echo ($category_filter == 'projetores') ? 'checked' : ''; ?>> Projetores e dispositivos de exibição</label>
            <label><input type="checkbox" value="laboratorios" <?php echo ($category_filter == 'laboratorios') ? 'checked' : ''; ?>> Equipamentos de Laboratórios</label>
            <label><input type="checkbox" value="audio_video" <?php echo ($category_filter == 'audio_video') ? 'checked' : ''; ?>> Equipamentos de Áudio e Vídeo</label>
            <label><input type="checkbox" value="livros_apostilas" <?php echo ($category_filter == 'livros_apostilas') ? 'checked' : ''; ?>> Livros e Apostilas</label>
            <label><input type="checkbox" value="outros" <?php echo ($category_filter == 'outros') ? 'checked' : ''; ?>> Outros</label>
        </div>
    </aside>

    <section class="produtos-grid">
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
                <a href="produto_detalhe.php?id=<?php echo $produto['id']; ?>" class="produto-link">
                    <div class="produto-card" 
                         data-price="<?php echo htmlspecialchars($produto['valor']); ?>" 
                         data-condicao="<?php echo htmlspecialchars($produto['condicao']); ?>"
                         data-categoria="<?php echo htmlspecialchars($produto['categoria']); ?>">
                        
                        <img src="../uploads/<?php echo htmlspecialchars($produto['imagem_1']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p class="preco">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
                        <span class="ver-detalhes-btn">Ver Detalhes</span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center;">Nenhum produto encontrado.</p>
        <?php endif; ?>
    </section>
</div>

<script src="../assets/js/catalogo.js"></script>

<?php require_once '../includes/footer.php'; ?>