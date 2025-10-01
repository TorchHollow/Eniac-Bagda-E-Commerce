<?php

include 'conexao.php';

$nome            = trim($_POST["nome"]);
$email           = trim($_POST["email"]);
$cpf             = trim($_POST["cpf"]);

$cpfHash         = hash('sha256', $cpf);

$data_nascimento = $_POST["data_nascimento"];
$telefone        = trim($_POST["telefone"]);
$senha_usuario   = password_hash($_POST["senha"], PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT id_usuario FROM usuario WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    header("Location: ../pages/Login.php?msg=existe");
} else {
    $sql = "INSERT INTO usuario (nome, email, cpf, data_nascimento, telefone, senha) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $email, $cpfHash, $data_nascimento, $telefone, $senha_usuario);

    if ($stmt->execute()) {
        header("Location: ../pages/Login.php?msg=sucesso");
    } else {
        header("Location: ../pages/Login.php?msg=erro");
    }
    $stmt->close();
}

$check->close();
$conn->close();
exit;
