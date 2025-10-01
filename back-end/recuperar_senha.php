<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    $stmt = $conn->prepare("SELECT id_usuario FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $novaSenha = substr(bin2hex(random_bytes(4)), 0, 8);
        $hashSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE usuario SET senha = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashSenha, $email);
        $stmt->execute();

        require_once __DIR__ . '/enviar_email.php';
        $resultado = enviarEmailRecuperacao($email, $novaSenha);
    }

    $_SESSION['mensagem'] = "Caso o e-mail seja válido, você receberá uma nova senha (cheque a caixa de spam).";
    $_SESSION['tipo'] = "sucesso";

    $conn->close();

    header("Location: /pages/Login.php");
    exit();
}
