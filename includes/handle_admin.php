<?php
session_start();
require_once 'conexao.php';

// Proteção
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 1) {
    die("Ação não autorizada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'delete_product':
            if (isset($_POST['id_produto'])) {
                $id_produto = $_POST['id_produto'];
                try {
                    $stmt = $db->prepare("DELETE FROM produtos WHERE id = :id");
                    $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
                    $stmt->execute();
                } catch (PDOException $e) {
                }
            }
            header("Location: ../admin/index.php");
            exit();
            break;

    }
}
?>