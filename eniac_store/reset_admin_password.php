<?php
// Inclui sua conexão com o banco de dados
require_once 'includes/db.php';

echo "<h1>Resetando a Senha do Administrador</h1>";

// --- Configurações ---
$admin_email = 'admin@eniac.com';
$nova_senha_plana = 'admin123';
// --------------------

// Gera um novo hash 100% compatível
$novo_hash = password_hash($nova_senha_plana, PASSWORD_DEFAULT);

echo "<p>Tentando atualizar a senha para o usuário: <strong>" . htmlspecialchars($admin_email) . "</strong></p>";
echo "<p>Com a nova senha criptografada: " . htmlspecialchars($novo_hash) . "</p>";

// Prepara e executa o comando SQL para atualizar a senha
$stmt = $conn->prepare("UPDATE users SET senha = ? WHERE email = ?");
$stmt->bind_param("ss", $novo_hash, $admin_email);

if ($stmt->execute()) {
    // Verifica se alguma linha foi realmente alterada
    if ($stmt->affected_rows > 0) {
        echo "<h2 style='color:green;'>SUCESSO! A senha do administrador foi atualizada no banco de dados.</h2>";
        echo "<p>Agora você já pode tentar fazer o login novamente.</p>";
    } else {
        echo "<h2 style='color:orange;'>AVISO: O comando foi executado, mas nenhum usuário com o email '" . htmlspecialchars($admin_email) . "' foi encontrado para atualizar. Verifique se o email está correto.</h2>";
    }
} else {
    echo "<h2 style='color:red;'>ERRO: Falha ao executar o comando para atualizar a senha.</h2>";
    echo "<p>Erro: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$conn->close();

echo "<hr><p><strong>Próximo Passo:</strong> <a href='auth/login.php'>Clique aqui para ir para a página de login e testar.</a></p>";
echo "<p>Após confirmar que o login funciona, delete este arquivo ('reset_admin_password.php') por segurança.</p>";
?>