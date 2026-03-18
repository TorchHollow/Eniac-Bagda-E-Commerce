<div class="modal fade" id="addProductModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Adicionar Novo Produto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="../process/handle_admin.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" name="action" value="add_product">
            <div class="mb-3"><label class="form-label">Nome</label><input type="text" name="nome" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Descrição</label><textarea name="descricao" class="form-control" required></textarea></div>
            <div class="row"><div class="col-md-4"><label class="form-label">Condição</label><input type="text" name="condicao" class="form-control" required></div><div class="col-md-4"><label class="form-label">Preço</label><input type="number" name="preco" step="0.01" class="form-control" required></div><div class="col-md-4"><label class="form-label">Estoque</label><input type="number" name="estoque" class="form-control" required></div></div>
            <div class="mt-3"><label class="form-label">Imagem</label><input type="file" name="imagem" class="form-control"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
    </form>
</div></div></div>

<div class="modal fade" id="editProductModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Editar Produto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <form action="../process/handle_admin.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" name="action" value="update_product"><input type="hidden" id="edit_product_id" name="product_id">
            <div class="mb-3"><label class="form-label">Nome</label><input type="text" id="edit_nome" name="nome" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Descrição</label><textarea id="edit_descricao" name="descricao" class="form-control" required></textarea></div>
            <div class="row"><div class="col-md-4"><label class="form-label">Condição</label><input type="text" id="edit_condicao" name="condicao" class="form-control" required></div><div class="col-md-4"><label class="form-label">Preço</label><input type="number" id="edit_preco" name="preco" step="0.01" class="form-control" required></div><div class="col-md-4"><label class="form-label">Estoque</label><input type="number" id="edit_estoque" name="estoque" class="form-control" required></div></div>
            <div class="mt-3"><label class="form-label">Trocar Imagem (opcional)</label><input type="file" name="imagem" class="form-control"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
      </form>
</div></div></div>

<div class="modal fade" id="editUserModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Gerenciar Usuário</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <form action="../process/handle_admin.php" method="POST">
        <div class="modal-body">
            <input type="hidden" name="action" value="update_user"><input type="hidden" id="edit_user_id" name="user_id">
            <p><strong>Nome:</strong> <span id="user_nome"></span></p><p><strong>Email:</strong> <span id="user_email"></span></p><hr>
            <div class="mb-3"><label class="form-label">Permissão:</label><select id="edit_is_admin" name="is_admin" class="form-select"><option value="0">Usuário</option><option value="1">Admin</option></select></div>
            <div class="mb-3"><label class="form-label">Status:</label><select id="edit_is_blocked" name="is_blocked" class="form-select"><option value="0">Ativo</option><option value="1">Bloqueado</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button><button type="submit" class="btn btn-primary">Atualizar</button></div>
      </form>
</div></div></div>