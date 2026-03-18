<?php
session_start();
require_once '../includes/conexao.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 1) {
    die("Acesso negado. Você precisa ser um administrador para acessar esta página.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars($_POST['nome'] ?? '');
    $descricao = htmlspecialchars($_POST['descricao'] ?? '');
    $valor = floatval($_POST['valor'] ?? 0.00);
    $condicao = htmlspecialchars($_POST['condicao'] ?? 'N/A');
    $categoria = htmlspecialchars($_POST['categoria'] ?? 'outros');

    $imagens_paths = [];
    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $image_fields = ['imagem_1', 'imagem_2', 'imagem_3'];
    foreach ($image_fields as $index => $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES[$field]['tmp_name'];
            $file_name = time() . '_' . basename($_FILES[$field]['name']);
            $dest_path = $upload_dir . $file_name;
            if (move_uploaded_file($file_tmp_path, $dest_path)) {
                $imagens_paths[$index] = $file_name;
            } else {
                $imagens_paths[$index] = null;
            }
        } else {
            $imagens_paths[$index] = null;
        }
    }

    try {
        $stmt = $db->prepare(
            "INSERT INTO produtos (nome, descricao, valor, condicao, categoria, imagem_1, imagem_2, imagem_3) 
             VALUES (:nome, :descricao, :valor, :condicao, :categoria, :img1, :img2, :img3)"
        );
        $stmt->execute([
            ':nome' => $nome, ':descricao' => $descricao, ':valor' => $valor,
            ':condicao' => $condicao, ':categoria' => $categoria, ':img1' => $imagens_paths[0],
            ':img2' => $imagens_paths[1], ':img3' => $imagens_paths[2]
        ]);
        echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href = 'cadastro_produto.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('ERRO: " . addslashes($e->getMessage()) . "');</script>";
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Produto</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/cadastroprod.css">
</head>
<body>
    <header>
        <div class="logo">Painel Admin</div>
        <nav>
            <a href="home.php">Ver Site</a>
            <a href="../admin/index.php">Voltar ao Painel</a>
            <a href="../includes/logout.php">Sair</a>
        </nav>
    </header>

    <main class="container">
        <h2 class="title">Cadastrar Novo Produto</h2>
        
        <form id="productForm" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            
            <section class="upload-card">
                <h3>Imagens do Produto</h3>
                <div class="field">
                    <label class="label">Imagem Principal</label>
                    <input type="file" name="imagem_1" class="file-input" accept="image/*">
                    <span class="file-name"></span> </div>
                <div class="field">
                    <label class="label">Imagem Secundária</label>
                    <input type="file" name="imagem_2" class="file-input" accept="image/*">
                    <span class="file-name"></span> </div>
                <div class="field">
                    <label class="label">Imagem Terciária</label>
                    <input type="file" name="imagem_3" class="file-input" accept="image/*">
                    <span class="file-name"></span> </div>
            </section>

            <section class="form-card">
                <h3>Detalhes do Produto</h3>
                <div class="field">
                    <label class="label">Nome do Produto:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="field">
                    <label class="label">Descrição do produto:</label>
                    <textarea name="descricao" rows="4"></textarea>
                </div>
                <div class="field">
                    <label class="label">Valor:</label>
                    <input type="number" step="0.01" name="valor" placeholder="Ex: 99.90" required>
                </div>
                <div class="field">
                    <label class="label">Condição:</label>
                    <select name="condicao" required>
                        <option value="novo">Novo</option>
                        <option value="semi-novo">Semi-novo</option>
                        <option value="usado">Usado</option>
                    </select>
                </div>
                <div class="field">
                    <label class="label">Categoria:</label>
                    <select name="categoria" required>
                        <option value="equipamentos_informatica">Equipamentos de Informática</option>
                        <option value="mobilia">Mobilia</option>
                        <option value="midias_fisicas">Mídias Físicas</option>
                        <option value="projetores">Projetores e dispositivos de exibição</option>
                        <option value="laboratorios">Equipamentos de Laboratórios</option>
                        <option value="audio_video">Equipamentos de Áudio e Vídeo</option>
                        <option value="livros_apostilas">Livros e Apostilas</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                <div class="actions">
                    <button type="submit" class="btn-primary">Cadastrar produto</button>
                </div>
            </section>
        </form>
    </main>

    <script src="../assets/js/cadastroprod.js"></script>
</body>
</html>