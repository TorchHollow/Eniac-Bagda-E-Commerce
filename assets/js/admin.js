document.addEventListener("DOMContentLoaded", () => {
    // Instancia os modais do Bootstrap
    const editProductModal = new bootstrap.Modal(document.getElementById('editProductModal'));
    const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));

    // --- Lógica para abrir o modal de Edição de Produto ---
    document.querySelectorAll('.edit-product-btn').forEach(button => {
        button.addEventListener('click', () => {
            const modalEl = document.getElementById('editProductModal');
            // Pega os dados dos atributos data-* do botão
            const id = button.dataset.id;
            const nome = button.dataset.nome;
            const descricao = button.dataset.descricao;
            const condicao = button.dataset.condicao;
            const preco = button.dataset.preco;
            const estoque = button.dataset.estoque;

            // Preenche o formulário do modal com os dados
            modalEl.querySelector('#edit_product_id').value = id;
            modalEl.querySelector('#edit_nome').value = nome;
            modalEl.querySelector('#edit_descricao').value = descricao;
            modalEl.querySelector('#edit_condicao').value = condicao;
            modalEl.querySelector('#edit_preco').value = preco;
            modalEl.querySelector('#edit_estoque').value = estoque;

            editProductModal.show();
        });
    });

    // --- Lógica para abrir o modal de Gerenciamento de Usuário ---
    document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', () => {
            const modalEl = document.getElementById('editUserModal');
            const id = button.dataset.id;
            const nome = button.dataset.nome;
            const email = button.dataset.email;
            const isAdmin = button.dataset.is_admin;
            const isBlocked = button.dataset.is_blocked;

            modalEl.querySelector('#edit_user_id').value = id;
            modalEl.querySelector('#user_nome').textContent = nome;
            modalEl.querySelector('#user_email').textContent = email;
            modalEl.querySelector('#edit_is_admin').value = isAdmin;
            modalEl.querySelector('#edit_is_blocked').value = isBlocked;

            editUserModal.show();
        });
    });
});