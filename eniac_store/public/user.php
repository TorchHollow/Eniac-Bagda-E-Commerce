<?php
require_once '../includes/header.php';
if (!isset($_SESSION['user_id'])) { header("Location: ../auth/login.php"); exit(); }
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
$orders_result = $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY criado_em DESC");
?>
<h1 class="page-title">Minha Conta</h1>

<div class="row g-4 g-lg-5">
    <div class="col-lg-4">
        <div class="card card-custom">
            <div class="card-body">
                <h4 class="card-title">Meu Perfil</h4>
                <p><strong>Nome:</strong><br> <?php echo htmlspecialchars($user['nome']); ?></p>
                <p><strong>E-mail:</strong><br> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Telefone:</strong><br> <?php echo htmlspecialchars($user['telefone'] ?? 'Não informado'); ?></p>
                <p><strong>Endereço:</strong><br> <?php echo htmlspecialchars($user['endereco'] ?? 'Não informado'); ?></p>
                </div>
        </div>
    </div>

    <div class="col-lg-8">
        <h4>Meus Pedidos</h4>
        <?php if($orders_result->num_rows > 0): 
            while($order = $orders_result->fetch_assoc()): ?>
            <div class="card card-custom mb-3">
                <div class="card-header d-flex justify-content-between flex-wrap">
                    <strong>Pedido #<?php echo $order['id']; ?></strong>
                    <span class="text-muted">Data: <?php echo date('d/m/Y', strtotime($order['criado_em'])); ?></span>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary"><?php echo htmlspecialchars($order['status']); ?></span>
                    </div>
                    <div class="text-end">
                        <span class="text-muted">Total</span>
                        <h5 class="mb-0">R$ <?php echo number_format($order['total'], 2, ',', '.'); ?></h5>
                    </div>
                </div>
            </div>
            <?php endwhile; 
        else: ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php endif; ?>
    </div>
</div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>