<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link rel="stylesheet" href="/eniac_store/assets/css/main.css">
  
  <title>Eniac Store</title>
</head>
<body>

<header>
    <div class="header-main py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a href="/eniac_store/public/catalog.php" class="text-white text-decoration-none h4 fw-bold">ENIAC</a>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-6 col-6 order-md-2 order-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar produtos...">
                        <button class="btn bg-light" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 order-md-3 text-md-end mt-2 mt-lg-0">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/eniac_store/public/user.php" class="text-white text-decoration-none me-3"><i class="bi bi-person-fill"></i> Minha Conta</a>
                        <a href="/eniac_store/auth/logout.php" class="text-white text-decoration-none"><i class="bi bi-box-arrow-right"></i> Sair</a>
                    <?php else: ?>
                        <a href="/eniac_store/auth/login.php" class="text-white text-decoration-none"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <nav class="header-nav navbar navbar-expand-lg py-1">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100">
                    <li class="nav-item"><a class="nav-link px-3" href="/eniac_store/public/catalog.php">Catálogo</a></li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="/eniac_store/public/cart.php">
                            <i class="bi bi-cart-fill"></i> Carrinho
                            <span class="badge bg-danger rounded-pill"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li class="nav-item"><a class="nav-link px-3" href="/eniac_store/admin/index.php">Painel Admin</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container my-4 my-md-5">