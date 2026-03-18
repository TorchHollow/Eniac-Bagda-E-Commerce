<?php
session_start();
// Usa a conexão PDO padrão do projeto, que define a variável $db
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    try {
        // Prepara a consulta usando a variável $db (PDO)
        $stmt = $db->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verifica se o usuário foi encontrado
        if ($stmt->rowCount() === 1) {
            // Gera uma nova senha aleatória de 8 caracteres
            $novaSenha = substr(bin2hex(random_bytes(4)), 0, 8);
            $hashSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

            // Atualiza a senha do usuário no banco de dados
            $update_stmt = $db->prepare("UPDATE usuario SET senha = :senha WHERE email = :email");
            $update_stmt->execute([':senha' => $hashSenha, ':email' => $email]);

            // Tenta enviar o e-mail com a nova senha
            require_once __DIR__ . '/enviar_email.php';
            $resultado_email = enviarEmailRecuperacao($email, $novaSenha);
            // Nota: Para o envio de e-mail funcionar, as configurações em 'enviar_email.php' devem estar corretas.
        }

        // Define a mensagem de sucesso/aviso para o usuário
        $_SESSION['mensagem'] = "Caso o e-mail informado esteja em nosso sistema, você receberá uma nova senha. Verifique também sua caixa de spam.";
        $_SESSION['tipo'] = "sucesso";

    } catch (PDOException $e) {
        // Em caso de erro de banco de dados, define uma mensagem de erro
        $_SESSION['mensagem'] = "Ocorreu um erro ao processar sua solicitação. Tente novamente.";
        $_SESSION['tipo'] = "erro";
    }

    // Redireciona de volta para a página de login para exibir a mensagem
    header("Location: ../pages/Login.php");
    exit();
}