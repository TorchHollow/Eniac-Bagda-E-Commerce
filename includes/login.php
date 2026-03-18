<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    try {
        $stmt = $db->prepare("SELECT id_usuario, nome, senha FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica a senha usando a função password_verify
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome'] = $usuario['nome'];
                // Redireciona para a página inicial após o login
                header("Location: ../pages/home.php");
                exit();
            } else {
                // Mensagem de erro genérica por segurança
                die("E-mail ou senha incorretos!");
            }
        } else {
            die("E-mail ou senha incorretos!");
        }
    } catch (PDOException $e) {
        // Em caso de erro no banco, exibe uma mensagem genérica
        die("Ocorreu um erro ao tentar fazer login. Tente novamente mais tarde.");
    }
}