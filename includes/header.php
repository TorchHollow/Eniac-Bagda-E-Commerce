<?php
session_start();
require_once 'config.php';

$usuario_logado = isset($_SESSION['nome']) ? explode(" ", $_SESSION['nome'])[0] : null;
$pageName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/home.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/catalogo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/produto_detalhe.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/usuario.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/cart.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="page-<?php echo $pageName; ?>">
    <header class="header">
        <a href="<?php echo BASE_URL; ?>/pages/home.php">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/Logo Eniac.webp" alt="Logo Eniac">
            </div>
        </a>

        <form class="pesquisar" action="<?php echo BASE_URL; ?>/pages/catalogo.php" method="GET" style="position: relative;">
            <input placeholder="Pesquisar Produtos..." type="text" name="q" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
            <div class="bar"></div>
            <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                <img src="<?php echo BASE_URL; ?>/assets/images/search.png" style="width:20px; height:20px;">
            </button>
        </form>

        <div class="dropdown-container">
            <a href="#" class="categoria">
                Categorias
            <img src="<?php echo BASE_URL; ?>/assets/images/down-arrow.png" alt="seta">
        </a>
        <div class="dropdown-categorias">
            <div class="categorias-lista">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=equipamentos_informatica">Equipamentos de Informática</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=mobilia">Mobilia</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=midias_fisicas">Mídias Físicas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=projetores">Projetores e dispositivos de exibição</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=laboratorios">Equipamentos de Laboratórios</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=audio_video">Equipamentos de Áudio e Vídeo</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=livros_apostilas">Livros e Apostilas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pages/catalogo.php?categoria=outros">Outros</a></li>
                </ul>
            </div>
                <div class="categorias-cards">
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/monitor.png" alt="Monitor"><span>Monitor</span></div>
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/teclado.png" alt="Teclado"><span>Teclado</span></div>
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/mouse.png" alt="Mouse"><span>Mouse</span></div>
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/gabinete.png" alt="Gabinete"><span>Gabinete</span></div>
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/processador.png" alt="Processador"><span>Processador</span></div>
                    <div class="card-categoria"><img src="<?php echo BASE_URL; ?>/assets/images/placa-mae.png" alt="Placa mãe"><span>Placa mãe</span></div>
                </div>
            </div>
        </div>

        <div class="icons">
            <div class="dropdown-container">
                <button class="btn-header" id="btn-cart" onclick="window.location.href='<?php echo BASE_URL; ?>/pages/cart.php'">
                    <img class="icons-kart" src="<?php echo BASE_URL; ?>/assets/images/shopping-cart.png" alt="Carrinho">
                </button>
            </div>
            <div class="dropdown-container">
                <button class="btn-header" id="btn-fav">
                    <img class="icons-fav" src="<?php echo BASE_URL; ?>/assets/images/heart.png" alt="Favoritos">
                </button>
            </div>
        </div>

        <div class="perfil" id="profile-btn">
            <?php if ($usuario_logado): ?>
                <p class="nome-perfil">Olá, <?php echo htmlspecialchars($usuario_logado); ?>!</p>
                <img src="<?php echo BASE_URL; ?>/assets/images/down-chevron.png" alt="" class="arrow-perfil">
                <div id="dropdown-menu" class="dropdown-menu">
                    <a href="<?php echo BASE_URL; ?>/pages/perfil.php">Meu Perfil</a>
                    <a href="<?php echo BASE_URL; ?>/includes/logout.php">Sair</a>
                </div>
            <?php else: ?>
                <p class="nome-perfil">Olá!</p>
                <img src="<?php echo BASE_URL; ?>/assets/images/down-chevron.png" alt="" class="arrow-perfil">
                <div id="dropdown-menu" class="dropdown-menu">
                    <a href="<?php echo BASE_URL; ?>/pages/Login.php">Login/Cadastro</a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    
    <main class="container">