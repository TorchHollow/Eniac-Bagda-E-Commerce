<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database_mysql.php';

$submission_message = '';
$should_continue_to_db = true; 
$default_img_path = '../IMGS/Logos-Eniac-2019.png';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars($_POST['nome'] ?? '');
    $descricao = htmlspecialchars($_POST['descricao'] ?? '');
    $valor = floatval($_POST['valor'] ?? 0.00); 
    $condicao = strtolower(htmlspecialchars($_POST['condicao'] ?? 'N/A'));
    
    $image_data = null;
    $mime_type = null;
    
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['fileInput']['tmp_name'];
        
        if (function_exists('mime_content_type')) {
            $mime_type = mime_content_type($file_tmp_path);
        } else {
            $mime_type = $_FILES['fileInput']['type'] ?? 'image/jpeg';
        }
        
        $image_data = file_get_contents($file_tmp_path);
        
    } 
    elseif (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] !== UPLOAD_ERR_NO_FILE) {
        
        $error_code = $_FILES['fileInput']['error'];
        $error_message = '';
        
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                $error_message = "ERRO: O arquivo é muito grande. Limite: " . ini_get('upload_max_filesize') . ".";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = "ERRO: O arquivo excede o limite MAX_FILE_SIZE do formulário.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = "ERRO: O upload da imagem foi interrompido.";
                break;
            default:
                $error_message = "ERRO: Falha desconhecida no upload (Código: $error_code).";
                break;
        }
        
        $submission_message .= "<script>alert('ALERTA DE DIAGNÓSTICO: " . addslashes($error_message) . "\\nPor favor, escolha um arquivo menor.');</script>";
        
        $should_continue_to_db = false; // Impede o salvamento no banco se houver erro

    } 
    else {
        $image_data = file_get_contents($default_img_path);
        $mime_type = 'image/png'; 
    }

    if ($should_continue_to_db) {
        try {
            // Query SQL para inserir dados
            $stmt = $db->prepare("INSERT INTO produtos (nome, descricao, valor, condicao, image_data, mime_type) 
                                     VALUES (:nome, :descricao, :valor, :condicao, :image_data, :mime_type)");
            
            $stmt->execute([
                ':nome' => $nome,
                ':descricao' => $descricao,
                ':valor' => $valor,
                ':condicao' => $condicao,
                ':image_data' => $image_data,
                ':mime_type' => $mime_type
            ]);
            
            $submission_message .= "<script>
                alert('Produto cadastrado com imagem BLOB no banco de dados MySQL!');
                window.location.href = 'cadastroprod_mysql.php'; 
            </script>";
            
        } catch (PDOException $e) {
            $submission_message = "<script>
                alert('ERRO SQL/DB: Não foi possível salvar no banco. Mensagem: " . addslashes($e->getMessage()) . "');
            </script>";
        }
    }
}
echo $submission_message;
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastrar Produto – ENIAC</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/cadastroprod.css">
</head>
<body>
  
  <header class="topbar">
    <div class="topbar__inner">

        <img src="../IMGS/Logos-Eniac-2019.png" class="brand" aria-label="ENIAC">
      </a>

      <nav class="menu">
        <a class="menu__item active" href="cadastroprod_mysql.php" data-action="cadastrar">cadastrar<br>Produto</a>
        <a class="menu__item" href="catalogo_mysql.php" data-action="catalogo">Catálogo<br>Produtos</a>
        <a class="menu__item" href="#" data-action="vendas">Gerenciamento de<br>vendas</a>
        <a class="menu__item" href="#" data-action="dashboard">dashboard</a>
      </nav>
    </div>
  </header>
  
  <form id="productForm" method="POST" enctype="multipart/form-data" novalidate>
    <main class="container">
      
      <section class="upload-card" aria-label="Imagem do produto">
        <input id="fileInput" type="file" name="fileInput" accept="image/*" hidden>
        <div id="dropZone" class="dropzone" tabindex="0">
          
          <svg class="img-icon" viewBox="0 0 48 48" aria-hidden="true">
            <rect x="4" y="6" width="40" height="36" rx="4" ry="4" fill="none" stroke="currentColor" stroke-width="2.5"/>
            <circle cx="33" cy="18" r="4" fill="none" stroke="currentColor" stroke-width="2.5"/>
            <path d="M8 36l11-13 9 9 5-5 7 9" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <p class="hint">Arraste uma imagem aqui ou <button id="chooseBtn" type="button" class="link-btn">clique para selecionar</button></p>

          <img id="preview" class="preview" alt="Pré-visualização da imagem" hidden>
        </div>
      </section>

      <section class="form-card">
          
        <label class="field">
          <span class="label">Nome do Produto:</span>
          <input type="text" name="nome" placeholder="Ex.: Teclado Mecânico" required>
        </label>

        <label class="field">
          <span class="label">Descrição do produto:</span>
          <textarea name="descricao" placeholder="Detalhes, cor, marca..." rows="3"></textarea>
        </label>

        <label class="field">
          <span class="label">Valor:</span>
          <input type="number" step="0.01" min="0" name="valor" placeholder="Ex.: 199.90" required>
        </label>

        <label class="field">
          <span class="label">Condição</span>
          <div class="select-wrap">
            <select name="condicao" required>
              <option value="" selected disabled>Selecione...</option>
              <option>Novo</option>
              <option>Semi-novo</option>
              <option>Usado</option>
            </select>
            
            <span class="select-caret" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </div>
        </label>

        <div class="actions">
          <button type="submit" class="btn-primary">Cadastrar produto</button>
          <button type="reset" class="btn-ghost">Limpar</button>
        </div>
      </section>

    </main>
  </form>

  <script src="../JS/cadastroprod.js"></script>
</body>
</html>