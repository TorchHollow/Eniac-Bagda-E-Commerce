document.addEventListener('DOMContentLoaded', () => {

    // Função para adicionar ao carrinho via servidor
    function addToCart(productId) {
        if (!productId) {
            console.error("ID do produto não encontrado!");
            return;
        }

        // Envia uma requisição para o script PHP que manipula o carrinho
        fetch(`../includes/handle_cart.php?action=add&id=${productId}`)
            .then(response => {
                if (response.ok) {
                    // Se a resposta for bem-sucedida, mostra a mensagem
                    if (typeof mostrarMensagem === 'function') {
                        mostrarMensagem("Produto adicionado ao carrinho!");
                    } else {
                        alert("Produto adicionado ao carrinho!");
                    }
                } else {
                    alert("Houve um erro ao adicionar o produto.");
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert("Houve um erro de conexão.");
            });
    }

    // --- Event Listeners para os botões "Adicionar ao Carrinho" ---

    // Para os cards de "Recomendado para você"
    document.querySelectorAll(".card-produto .img-carrinho").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const card = btn.closest(".card-produto");
            const productId = card.dataset.id; // Pega o ID do produto
            addToCart(productId);
        });
    });

    // Para os cards de "Ofertas Hoje"
    document.querySelectorAll(".card-produto-oferta .img-carrinho").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const card = btn.closest(".card-produto-oferta");
            const productId = card.dataset.id; // Pega o ID do produto
            addToCart(productId);
        });
    });

    // A lógica dos favoritos pode continuar sendo apenas visual por enquanto
    // Se quiser que ela também salve no servidor, precisará de uma lógica similar à do carrinho
    document.querySelectorAll(".img-favorito").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (typeof mostrarMensagem === 'function') {
                mostrarMensagem("Produto adicionado aos favoritos!");
            }
        });
    });
});