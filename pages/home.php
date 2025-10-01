<?php
session_start();
$usuario_logado = isset($_SESSION['nome']) ? explode(" ", $_SESSION['nome'])[0] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Eniac</title>
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <div id="mensagens"></div>
    <main>
        <div class="menu">
            <div class="menu-mobile1"></div>
            <div class="menu-mobile2"></div>
            <div class="menu-mobile3"></div>
        </div>

        <header class="header">

            <a href="../pages/home.php">
                <div class="logo">
                    <img src="../assets/Logo Eniac.webp" alt="">
                </div>
            </a>

            <div class="pesquisar" style="position: relative;">

                <input placeholder="Pesquisar Produtos..." type="text" name="pesquisar">

                <div class="bar"></div>

                <button type="button"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                    <img src="../assets/search.png" style="width:20px; height:20px;">
                </button>

            </div>

            <div class="dropdown-container">
                <a href="#" class="categoria">
                    Categorias
                    <img src="../assets/down-arrow.png" alt="seta">
                </a>

                <div class="dropdown-categorias">
                    <div class="categorias-lista">
                        <ul>
                            <li>Equipamentos de Informática</li>
                            <li>Mobilia</li>
                            <li>Mídias Físicas</li>
                            <li>Projetores e dispositivos de exibição</li>
                            <li>Equipamentos de Laboratórios</li>
                            <li>Equipamentos de Áudio e Vídeo</li>
                            <li>Livros e Apostilas</li>
                        </ul>
                    </div>

                    <div class="categorias-cards">
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/monitor.png" alt="Monitor">
                            <span>Monitor</span>
                        </div>
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/teclado.png" alt="Teclado">
                            <span>Teclado</span>
                        </div>
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/mouse.png" alt="Mouse">
                            <span>Mouse</span>
                        </div>
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/gabinete.png" alt="Gabinete">
                            <span>Gabinete</span>
                        </div>
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/processador.png" alt="Processador">
                            <span>Processador</span>
                        </div>
                        <div class="card-categoria">
                            <img src="../assets/imagem-produtos/placa-mae.png" alt="Placa mãe">
                            <span>Placa mãe</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="icons">

                <div class="dropdown-container">
                    <button class="btn-header" id="btn-cart">
                        <img class="icons-kart" src="../assets/shopping-cart.png" alt="">
                    </button>
                    <div class="dropdown" id="cart-dropdown">
                        <p class="empty">Seu carrinho está vazio</p>
                        <ul></ul>
                        <div class="cart-footer">
                            <span class="total">Total: R$ 0,00</span>
                            <button id="checkout-btn">Finalizar Compra</button>
                        </div>
                    </div>
                </div>

                <div class="dropdown-container">
                    <button class="btn-header" id="btn-fav">
                        <img class="icons-fav" src="../assets/heart.png" alt="">
                    </button>
                    <div class="dropdown-list" id="fav-dropdown">
                        <p class="empty">Nenhum favorito ainda</p>
                        <ul></ul>
                    </div>
                </div>

            </div>

            <div class="perfil" id="profile-btn">
                <?php if ($usuario_logado): ?>
                    <p class="nome-perfil">Olá, <?= htmlspecialchars($usuario_logado) ?>!</p>
                    <img src="../assets/down-chevron.png" alt="" class="arrow-perfil">

                    <div id="dropdown-menu" class="dropdown-menu">
                        <a href="#">Meu Perfil</a>
                        <a href="#">Compras</a>
                        <a href="#">Histórico</a>
                        <a href="../back-end/logout.php">Sair</a>
                    </div>
                <?php else: ?>
                    <p class="nome-perfil">Olá!</p>
                    <img src="../assets/down-chevron.png" alt="" class="arrow-perfil">

                    <div id="dropdown-menu" class="dropdown-menu">
                        <a href="../pages/Login.php">Login/Cadastro</a>
                    </div>
                <?php endif; ?>
            </div>

        </header>

        <div class="endereco">
            <img src="../assets/pin.png" alt="" class="map">
            <a href="" class="cep">Digite seu CEP ></a>
        </div>
        <div class="box-cep">
            <P>Adicione o seu CEP</P>
            <input type="text" placeholder="Digite seu CEP" id="inputCep" maxlength="9">
            <button id="btnAdicionar">Adicionar</button>
        </div>

        <section class="container">

            <div class="banner">
                <img src="../assets/banner.jpg" alt="Banner Promocional">
            </div>

            <div class="slider-wrapper">

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                
                <div class="slider">


                    <div class="slide">

                        <div class="card">
                            <a class="card-img" href="#">
                                <img src="../assets/icons/desk-chair.png" alt="">
                            </a>

                            <a href="">
                                <h3>Cadeiras</h3>
                            </a>
                        </div>

                        <div class="card">
                            <a class="card-img" href="">
                                <img src="../assets/icons/stack-of-books.png" alt="">
                            </a>

                            <a href="">
                                <h3>Livros</h3>
                            </a>
                        </div>

                        <div class="card">
                            <a class="card-img3" href="">
                                <img src="../assets/icons/computer-mouse.png" alt="">
                            </a>

                            <a href="">
                                <h3>Mouses</h3>
                            </a>
                        </div>

                        <div class="card">
                            <a class="card-img" href="">
                                <img src="../assets/icons/laptop-computer.png" alt="">
                            </a>

                            <a href="">
                                <h3>Notebooks</h3>
                            </a>
                        </div>

                        <div class="card">
                            <a class="card-img" href="">
                                <img src="../assets/icons/caixas.png" alt="">
                            </a>

                            <a href="">
                                <h3>Categorias</h3>
                            </a>
                        </div>
                        <div class="card">
                            <a class="card-img" href="">
                                <img src="../assets/icons/caixas.png" alt="">
                            </a>

                            <a href="">
                                <h3>Categorias</h3>
                            </a>
                        </div>

                    </div>

                </div>

            </div>


            <a class="prev-produto" onclick="plusSlidesProduto(-1)"><i class="fa-solid fa-arrow-right"></i></a>
            <a class="next-produto" onclick="plusSlidesProduto(1)"><i class="fa-solid fa-arrow-right-long"></i></a>

            <h2 class="tittle-slide">Maiores Descontos</h2>

            <div class="slider-produto">

                <div class="slide-produto">

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-produto">
                        <div class="card-img-produto">
                            <img src="../assets/imagem-produtos/Cadeira-Escritorio.jpg" alt="Cadeira de Escritório">

                            <button class="btn-icon btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-produto img-carrinho">Adicionar ao Carrinho</button>
                        </div>

                        <div class="card-info-produto">
                            <div class="categoria-produto">
                                <a href="#">
                                    <span>Cadeiras</span>
                                </a>
                                <h3>Cadeira de Escritório</h3>
                            </div>

                            <div class="condicoes">
                                <div class="condicao-produto">
                                    <div class="estrelas-produto">★★★★☆</div>
                                    <span>(Condição: 4/5)</span>
                                </div>

                                <div class="preco-status">
                                    <span class="preco-produto">R$ 80,00</span>
                                    <h3 class="status-produto">Em estoque</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="ofertas">
                <div class="menu-ofertas">

                    <h2>Ofertas Hoje</h2>

                    <div class="navegacao">
                        <a href="#">Ver Todas</a>
                        <a href="#">Cadeiras</a>
                        <a href="#">Monitores</a>
                        <a href="#">Livros</a>
                    </div>

                </div>

                <div class="catalogo-ofertas">

                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">

                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">

                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>

                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>

                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>
                    <div class="card-produto-oferta">
                        <div class="card-img-oferta">
                            <img src="../assets/imagem-produtos/livros.jpg" alt="Livro usado">
                            <button class="btn-icon-oferta btn-favorito img-favorito" aria-label="Favoritar">
                                <img src="../assets/heart.png" alt="Favoritar">
                            </button>
                            <button class="btn-carrinho-oferta img-carrinho">Adicionar ao Carrinho</button>
                        </div>
                        <div class="card-info-oferta">
                            <a href="#">
                                <span class="categoria-oferta">LIVROS</span>
                            </a>
                            <h3 class="nome-oferta">Livro de Programação</h3>
                            <div class="condicao-oferta">
                                <div class="estrelas-oferta">★★★★☆</div>
                                <span class="nota-oferta">(Condição: 4/5)</span>
                            </div>
                            <span class="preco-oferta">R$ 80,00</span>
                            <span class="status-oferta">Em estoque</span>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>

    <footer>
        <div class="contato">

            <div class="sobre">

                <h2>Sobre</h2>

                <p>
                    O Centro Universitário de Excelência Eniac é uma instituição de ensino comprometida com a excelência acadêmica e a formação de profissionais preparados para os desafios do mercado.
                </p>

            </div>

            <div class="cursos">
                <h2>Cursos</h2>

                <a href="#">Pós Graduação</a>
                <a href="#">Graduação</a>
                <a href="#">Técnico</a>
                <a href="#">Colégio</a>
                <a href="#">Saúde</a>

            </div>

            <div class="links-rapidos">
                <h2>Links Rápidos</h2>

                <a href="#">Blog</a>
                <a href="#">Bolsas</a>
                <a href="#">Empregos</a>
                <a href="#">Indique Um Amigo</a>
                <a href="#">Polos</a>

            </div>

            <div class="redes">

                <h2>Redes Sociais</h2>

                <div class="images">

                    <a href="">
                        <img src="../assets/icons/facebook.png" alt="">
                    </a>

                    <a href="">
                        <img src="../assets/icons/002-instagram.png" alt="">
                    </a>

                    <a href="">
                        <img src="../assets/icons/001-youtube.png" alt="">
                    </a>

                    <a href="">
                        <img src="../assets/icons/003-linkedin.png" alt="">
                    </a>

                    <a href="">
                        <img src="../assets/icons/004-twitter.png" alt="">
                    </a>

                </div>

            </div>

        </div>
    </footer>

    <script src="../home.js"></script>
    <script src="../script-home-icon.js"></script>


</body>

</html>