<?php

require_once 'conexao.php'; // Garante que a conexão PDO ($db) seja carregada

// Captura e limpa os dados do formulário
$nome            = trim($_POST["nome"]);
$email           = trim($_POST["email"]);
$cpf             = trim($_POST["cpf"]);
$data_nascimento = $_POST["data_nascimento"];
$telefone        = trim($_POST["telefone"]);
$senha_usuario   = password_hash($_POST["senha"], PASSWORD_DEFAULT);

// Criptografa o CPF usando hash
$cpfHash         = hash('sha256', $cpf);

try {
    // 1. Prepara a consulta para verificar se o e-mail já existe, usando PDO
    $check_stmt = $db->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
    $check_stmt->execute([':email' => $email]);

    // 2. Verifica o resultado
    if ($check_stmt->rowCount() > 0) {
        // Se rowCount() > 0, o e-mail já está cadastrado
        header("Location: ../pages/Login.php?msg=existe");
    } else {
        // 3. Se o e-mail não existe, insere o novo usuário
        $sql = "INSERT INTO usuario (nome, email, cpf, data_nascimento, telefone, senha) 
                VALUES (:nome, :email, :cpf, :data_nascimento, :telefone, :senha)";
        $stmt = $db->prepare($sql);
        
        // Executa a inserção passando os dados de forma segura
        $success = $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':cpf' => $cpfHash,
            ':data_nascimento' => $data_nascimento,
            ':telefone' => $telefone,
            ':senha' => $senha_usuario
        ]);

        if ($success) {
            header("Location: ../pages/Login.php?msg=sucesso");
        } else {
            header("Location: ../pages/Login.php?msg=erro");
        }
    }
} catch (PDOException $e) {
    // Em caso de erro com o banco de dados, redireciona para a página de erro
    // Para depuração, você pode registrar o erro: error_log($e->getMessage());
    header("Location: ../pages/Login.php?msg=erro");
}

exit;