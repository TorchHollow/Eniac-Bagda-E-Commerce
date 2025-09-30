<?php
require_once '../includes/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($user['is_blocked']) {
            $error = "Esta conta está bloqueada.";
        } elseif (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: ../public/user.php");
            exit();
        } else {
            $error = "E-mail ou senha inválidos!";
        }
    } else {
        $error = "E-mail ou senha inválidos!";
    }
}
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Login</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<div class="container" style="max-width: 500px; margin: 100px auto; background: white; padding: 20px; border-radius: 8px;">
    <h2 style="text-align: center;">Login - Eniac Store</h2>
    <?php if ($error): ?><p style="color:red; text-align:center;"><?php echo $error; ?></p><?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Seu E-mail" required style="width:100%; padding:10px; margin-bottom:10px; border: 1px solid #ccc; border-radius: 4px;">
        <input type="password" name="senha" placeholder="Sua Senha" required style="width:100%; padding:10px; margin-bottom:10px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" class="checkout-btn">Entrar</button>
    </form>
    <p style="text-align:center; margin-top: 15px;">Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
</div>
</body></html>