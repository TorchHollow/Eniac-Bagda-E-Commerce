<?php
require_once '../includes/header.php';
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) { die("Acesso negado."); }

// Lógica de Filtro de Produtos (Executada apenas se o filtro for usado)
$searchTermProducts = $_GET['search_products'] ?? '';
$sqlProducts = "SELECT * FROM products";
if (!empty($searchTermProducts)) { $sqlProducts .= " WHERE nome LIKE ?"; }
$stmtProducts = $conn->prepare($sqlProducts . " ORDER BY id DESC");
if (!empty($searchTermProducts)) { $likeProducts = '%' . $searchTermProducts . '%'; $stmtProducts->bind_param("s", $likeProducts); }
$stmtProducts->execute();
$resultProducts = $stmtProducts->get_result();

// Lógica de Filtro de Usuários
$searchTermUsers = $_GET['search_users'] ?? '';
$sqlUsers = "SELECT * FROM users WHERE id != {$_SESSION['user_id']}";
if (!empty($searchTermUsers)) { $sqlUsers .= " AND (nome LIKE ? OR email LIKE ?)"; }
$stmtUsers = $conn->prepare($sqlUsers . " ORDER BY id DESC");
if (!empty($searchTermUsers)) { $likeUsers = '%' . $searchTermUsers . '%'; $stmtUsers->bind_param("ss", $likeUsers, $likeUsers); }
$stmtUsers->execute();
$resultUsers = $stmtUsers->get_result();

// Lógica de Filtro de Pedidos
$searchTermOrders = $_GET['search_orders'] ?? '';
$sqlOrders = "SELECT o.*, u.nome as user_nome FROM orders o JOIN users u ON o.user_id = u.id";
if (!empty($searchTermOrders)) { $sqlOrders .= " WHERE o.id = ? OR u.nome LIKE ?"; }
$stmtOrders = $conn->prepare($sqlOrders . " ORDER BY o.criado_em DESC");
if (!empty($searchTermOrders)) { $likeOrders = '%' . $searchTermOrders . '%'; $stmtOrders->bind_param("ss", $searchTermOrders, $likeOrders); }
$stmtOrders->execute();
$resultOrders = $stmtOrders->get_result();
?>
<h1 class="page-title">Painel do Administrador</h1>

<div class="admin-panel">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="admin-card">
                <h3>Gerenciar Produtos</h3>
                <ul>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal">Adicionar novo produto</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#listProductsModal">Listar / Editar / Remover produtos</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-card">
                <h3>Gerenciar Usuários</h3>
                <ul>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#listUsersModal">Listar / Gerenciar usuários</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-card">
                <h3>Pedidos</h3>
                <ul>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#listOrdersModal">Ver e atualizar pedidos</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-card">
                <h3>Relatórios</h3>
                <ul>
                    <li><a href="reports.php">Acessar página de relatórios</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</main> <div class="modal fade" id="listProductsModal" tabindex="-1"><div class="modal-dialog modal-xl"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Listar / Editar / Remover Produtos</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <form method="GET" action="index.php" class="mb-3"><div class="input-group"><input type="text" name="search_products" class="form-control" placeholder="Buscar produto..." value="<?php echo htmlspecialchars($searchTermProducts); ?>"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button></div></form>
        <div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Estoque</th><th class="text-end">Ações</th></tr></thead><tbody>
            <?php while ($product = $resultProducts->fetch_assoc()): ?>
            <tr>
                <td><?php echo $product['id']; ?></td><td><?php echo htmlspecialchars($product['nome']); ?></td><td>R$ <?php echo number_format($product['preco'], 2, ',', '.'); ?></td><td><?php echo $product['estoque']; ?></td>
                <td class="text-end actions">
                    <button class="btn btn-sm btn-warning edit-product-btn" data-bs-toggle="modal" data-bs-target="#editProductModal"
                        data-id="<?php echo $product['id']; ?>" data-nome="<?php echo htmlspecialchars($product['nome']); ?>" data-descricao="<?php echo htmlspecialchars($product['descricao']); ?>" data-condicao="<?php echo htmlspecialchars($product['condicao']); ?>" data-preco="<?php echo $product['preco']; ?>" data-estoque="<?php echo $product['estoque']; ?>"><i class="bi bi-pencil-fill"></i></button>
                    <form action="../process/handle_admin.php" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza?');"><input type="hidden" name="action" value="delete_product"><input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"><button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button></form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody></table></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></div>
</div></div></div>

<div class="modal fade" id="listUsersModal" tabindex="-1"><div class="modal-dialog modal-xl"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Listar / Gerenciar Usuários</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <form method="GET" action="index.php" class="mb-3"><div class="input-group"><input type="text" name="search_users" class="form-control" placeholder="Buscar usuário..." value="<?php echo htmlspecialchars($searchTermUsers); ?>"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button></div></form>
        <div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Permissão</th><th>Status</th><th class="text-end">Ações</th></tr></thead><tbody>
            <?php while ($user = $resultUsers->fetch_assoc()): ?>
            <tr>
                <td><?php echo $user['id']; ?></td><td><?php echo htmlspecialchars($user['nome']); ?></td><td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo $user['is_admin'] ? '<span class="badge bg-success">Admin</span>' : '<span class="badge bg-secondary">Usuário</span>'; ?></td>
                <td><?php echo $user['is_blocked'] ? '<span class="badge bg-danger">Bloqueado</span>' : '<span class="badge bg-info">Ativo</span>'; ?></td>
                <td class="text-end actions"><button class="btn btn-sm btn-info edit-user-btn" data-bs-toggle="modal" data-bs-target="#editUserModal"
                        data-id="<?php echo $user['id']; ?>" data-nome="<?php echo htmlspecialchars($user['nome']); ?>" data-email="<?php echo htmlspecialchars($user['email']); ?>" data-is_admin="<?php echo $user['is_admin']; ?>" data-is_blocked="<?php echo $user['is_blocked']; ?>"><i class="bi bi-gear-fill"></i></button></td>
            </tr>
            <?php endwhile; ?>
        </tbody></table></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></div>
</div></div></div>

<div class="modal fade" id="listOrdersModal" tabindex="-1"><div class="modal-dialog modal-xl"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Ver e Atualizar Pedidos</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <form method="GET" action="index.php" class="mb-3"><div class="input-group"><input type="text" name="search_orders" class="form-control" placeholder="Buscar pedido..." value="<?php echo htmlspecialchars($searchTermOrders); ?>"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button></div></form>
        <div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th># Pedido</th><th>Cliente</th><th>Total</th><th>Data</th><th>Status</th></tr></thead><tbody>
            <?php while ($order = $resultOrders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td><td><?php echo htmlspecialchars($order['user_nome']); ?></td><td>R$ <?php echo number_format($order['total'], 2, ',', '.'); ?></td><td><?php echo date('d/m/Y H:i', strtotime($order['criado_em'])); ?></td>
                <td><form action="../process/handle_admin.php" method="POST"><input type="hidden" name="action" value="update_order_status"><input type="hidden" name="order_id" value="<?php echo $order['id']; ?>"><select name="status" class="form-select form-select-sm" onchange="this.form.submit()"><option value="Em Processamento" <?php if($order['status'] == 'Em Processamento') echo 'selected';?>>Em Processamento</option><option value="Enviado" <?php if($order['status'] == 'Enviado') echo 'selected';?>>Enviado</option><option value="Entregue" <?php if($order['status'] == 'Entregue') echo 'selected';?>>Entregue</option><option value="Cancelado" <?php if($order['status'] == 'Cancelado') echo 'selected';?>>Cancelado</option></select></form></td>
            </tr>
            <?php endwhile; ?>
        </tbody></table></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></div>
</div></div></div>

<?php include 'modals_forms.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/admin.js"></script>
</body></html>