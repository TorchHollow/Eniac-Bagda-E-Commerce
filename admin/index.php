<?php
session_start();
require_once '../includes/conexao.php';

// Proteção para garantir que apenas o admin (ID 1) acesse
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 1) {
    die("Acesso negado.");
}

// Busca produtos
$stmt_produtos = $db->query("SELECT id, nome, valor FROM produtos ORDER BY id DESC");
$produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);

// Busca usuários
$stmt_usuarios = $db->query("SELECT id_usuario, nome, email FROM usuario ORDER BY id_usuario DESC");
$usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <div class="logo">Painel Admin</div>
        <nav>
            <a href="../pages/home.php">Ver Site</a>
            <a href="../includes/logout.php">Sair</a>
        </nav>
    </header>

    <main class="container">
        <h2 class="title">Gerenciamento</h2>

        <div class="admin-card">
            <h3>Ações Rápidas</h3>
            <nav>
                <a href="../pages/cadastro_produto.php" style="margin-right: 20px;">Cadastrar Novo Produto</a>
                <a href="exportar_vendas.php">Exportar Relatório de Vendas</a>
            </nav>
        </div>

        <div class="admin-card">
            <h3>Produtos Cadastrados</h3>
            <table>
                <thead>
                    <tr><th>ID</th><th>Nome</th><th>Valor</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
                        <td>
                            <form action="../includes/handle_admin.php" method="POST" onsubmit="return confirm('Tem certeza?');">
                                <input type="hidden" name="action" value="delete_product">
                                <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                                <button type="submit" class="btn-delete">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-card">
            <h3>Usuários</h3>
            <table>
                <thead>
                    <tr><th>ID</th><th>Nome</th><th>Email</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id_usuario']; ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>