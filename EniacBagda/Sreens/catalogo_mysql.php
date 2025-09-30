<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database_mysql.php';

$max_price_db = 5000;
try {
    $stmt_max = $db->query("SELECT MAX(valor) AS max_valor FROM produtos");
    $result = $stmt_max->fetch(PDO::FETCH_ASSOC);
    
    if ($result && $result['max_valor'] !== null) {
        $max_price_db = ceil($result['max_valor'] / 100) * 100; 
        if ($max_price_db < 1000) {
            $max_price_db = 1000;
        }
    }
} catch (PDOException $e) {
}

$produtos = [];
try {
    $stmt = $db->query("SELECT id, nome, valor, condicao, categoria, image_data, mime_type FROM produtos ORDER BY id DESC");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "";
}

// Valores iniciais para os sliders (Mínimo: 0, Máximo: Dinâmico)
$initial_min_value = 0;
$initial_max_value = $max_price_db;

// Função auxiliar para formatar números (usada no HTML abaixo para o valor inicial)
function format_number_html($number) {
    return number_format($number, 0, '', '.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo de Produtos</title>
  <link rel="stylesheet" href="../CSS/catalogo.css">
</head>

<body>
  <header>
    <div class="logo">
      <img src="../IMGS/Logos-Eniac-2019.png" alt="Logo Eniac">
    </div>
    <nav>
      <a href="catalogo_mysql.php">Home</a>
      <a href="catalogo_mysql.php">Produtos</a>
      <a href="#" id="carrinhoBtn">Carrinho</a>
    </nav>
  </header>

  <main>
    <aside class="filtro">
      <h2>Filtro</h2>

      <div class="filtro-box">
       <h3>Faixa de preço</h3>
       <div class="price-range">
       <input type="range" id="minPrice" min="0" max="<?php echo $initial_max_value; ?>" value="<?php echo $initial_min_value; ?>">
       <input type="range" id="maxPrice" min="0" max="<?php echo $initial_max_value; ?>" value="<?php echo $initial_max_value; ?>">
    
       <p>R$ <span id="minValue"><?php echo format_number_html($initial_min_value); ?></span> - R$ <span id="maxValue"><?php echo format_number_html($initial_max_value); ?></span></p>

     <div class="precise-inputs">
      <div class="input-wrap">
        <label for="minInput">Mínimo</label>
        <input type="number" id="minInput" min="0" max="<?php echo $initial_max_value; ?>" value="<?php echo $initial_min_value; ?>">
      </div>
      
      <div class="input-wrap">
        <label for="maxInput">Máximo</label>
        <input type="number" id="maxInput" min="0" max="<?php echo $initial_max_value; ?>" value="<?php echo $initial_max_value; ?>">
      </div>
    </div>
  </div>
</div>

      <div class="filtro-box">
        <h3>Condição</h3>
        <label><input type="checkbox" value="novo"> Novo</label>
        <label><input type="checkbox" value="usado"> Usado</label>
        <label><input type="checkbox" value="semi-novo"> Semi-novo</label>
      </div>

      <div class="filtro-box">
        <h3>Categoria</h3>
        <label><input type="checkbox" value="Computadores"> Computadores</label>
        <label><input type="checkbox" value="perifericos"> Periféricos</label>
        <label><input type="checkbox" value="livros"> Livros</label>
        <label><input type="checkbox" value="moveis"> Móveis</label>
        <label><input type="checkbox" value="camras"> Câmeras</label>
        <label><input type="checkbox" value="outros"> Outros</label>
      </div>
      
    </aside>

    <section class="produtos">
      <?php if (!empty($produtos)): ?>
          <?php foreach ($produtos as $produto): 
              $preco_formatado = number_format($produto['valor'], 2, ',', '.'); 
              
              // Lógica para codificar o BLOB em Base64
              $image_src = 'data:' . htmlspecialchars($produto['mime_type']) . ';base64,' . base64_encode($produto['image_data']);
          ?>
              <div class="produto" 
                   data-price="<?php echo htmlspecialchars($produto['valor']); ?>" 
                   data-condicao="<?php echo htmlspecialchars($produto['condicao']); ?>" 
                   data-categoria="<?php echo htmlspecialchars($produto['categoria']); ?>">
                  
                  <img src="<?php echo $image_src; ?>" alt="Imagem de <?php echo htmlspecialchars($produto['nome']); ?>">
                  
                  <p><?php echo htmlspecialchars($produto['nome']); ?></p>
                  
                  <p class="preco">R$ <?php echo $preco_formatado; ?></p>
                  
                  <button class="addCarrinho">Adicionar</button>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p>Nenhum produto cadastrado ainda. Use a tela "Cadastrar Produto" para adicionar itens.</p>
      <?php endif; ?>
      
    </section>
  </main>
  
  <div id="carrinhoBox" class="carrinho-box">
    <h2>Meu Carrinho</h2>
    <ul id="carrinhoItens"></ul>
    <p><strong>Total:</strong> R$ <span id="carrinhoTotal">0</span></p>
    <button onclick="finalizarCompra()">Finalizar Compra</button>
    <button id="fecharCarrinho">Fechar</button>
  </div>
  
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section institucional">
        <img src="../IMGS/Logos-Eniac-2019.png" alt="ENIAC" class="footer-logo">
        <p>Centro Universitário ENIAC - Inovação e Educação de Qualidade em Guarulhos e além.</p>
      </div>
  
      <div class="footer-section nav-rapida">
        <h4>Institucional</h4>
        <ul>
          <li><a href="/sobre">Sobre o ENIAC</a></li>
          <li><a href="https://www.eniac.edu.br/blog">Blog</a></li>
        </ul>
      </div>
  
      <div class="footer-section politicas">
        <h4>Políticas</h4>
        <ul>
          <li><a href="/politica-de-privacidade">Política de Privacidade</a></li>
          <li><a href="/trocas-e-devolucoes">Trocas e Devoluções</a></li>
          <li><a href="/termos-de-uso">Termos de Uso</a></li>
        </ul>
      </div>
  
      <div class="footer-section contato">
        <h4>Contato</h4>
        <p>Telefone: (11) 2199-0988</p>
        <p>E-mail: contato@eniac.edu.br</p>
        <p>Endereço: Rua Força Pública, 89 - Centro, Guarulhos/SP</p>
      </div>
  
      <div class="footer-section redes-sociais">
        
        <a href="https://www.facebook.com/eniac.oficial" target="_blank" rel="noopener">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://www.instagram.com/eniac.oficial/" target="_blank" rel="noopener">
          <i class="fa-brands fa-linkedin"></i>
        </a>
      </div>
    </div>
  
    <div class="footer-copy">
      <p>&copy; 2025 ENIAC - Todos os direitos reservados | CNPJ: 43.133.260/0001-80</p>
    </div>
  </footer>

  <script src="../JS/catalogo.js"></script>
  <script src="https://kit.fontawesome.com/749fc0cbee.js" crossorigin="anonymous"></script>
</body>
</html>