<?php 
require_once '../includes/header.php'; 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

require_once '../includes/conexao.php';
$id_usuario = $_SESSION['id_usuario'];

$stmt_usuario = $db->prepare("SELECT nome, email, telefone FROM usuario WHERE id_usuario = :id");
$stmt_usuario->bindParam(':id', $id_usuario);
$stmt_usuario->execute();
$usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

$stmt_vendas = $db->prepare(
    "SELECT v.id, v.valor_total, v.status, DATE_FORMAT(v.data_venda, '%d/%m/%Y') AS data_formatada, 
            GROUP_CONCAT(vi.nome_produto SEPARATOR ', ') as nomes_produtos
     FROM vendas v
     JOIN venda_itens vi ON v.id = vi.id_venda
     WHERE v.id_usuario = :id_usuario
     GROUP BY v.id
     ORDER BY v.data_venda DESC"
);
$stmt_vendas->bindParam(':id_usuario', $id_usuario);
$stmt_vendas->execute();
$vendas = $stmt_vendas->fetchAll(PDO::FETCH_ASSOC);
?>

<title>Minha Conta</title>
<link rel="stylesheet" href="../assets/css/usuario.css"> 
<h1 class="page-title">Minha Conta</h1>

<div class="user-content">
    <div class="perfil-card">
        <h3>Meus Dados</h3>
        <?php if ($usuario): ?>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['telefone'] ?? 'Não informado'); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="pedidos-card">
        <h3>Meus Pedidos</h3>
        
        <?php if (empty($vendas)): ?>
            <p>Você ainda não tem pedidos registrados.</p>
        <?php else: ?>
            <?php foreach ($vendas as $venda): ?>
                <div class="pedido-item">
                    <p><strong>Pedido #<?php echo $venda['id']; ?></strong></p>
                    <p><strong>Itens:</strong> <?php echo htmlspecialchars($venda['nomes_produtos']); ?></p>
                    <p>Data: <?php echo $venda['data_formatada']; ?></p>
                    <p>Valor Total: R$ <?php echo number_format($venda['valor_total'], 2, ',', '.'); ?></p>
                    <p>Status: <?php echo htmlspecialchars(ucfirst($venda['status'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>