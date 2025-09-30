<?php
require_once '../includes/db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) { die("Ação não autorizada."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'update_product':
            $id = $_POST['product_id']; $nome = $_POST['nome']; $desc = $_POST['descricao']; $cond = $_POST['condicao']; $preco = $_POST['preco']; $estoque = $_POST['estoque'];
            $sql = "UPDATE products SET nome=?, descricao=?, condicao=?, preco=?, estoque=? WHERE id=?";
            $params = ["sssdis", $nome, $desc, $cond, $preco, $estoque, $id];
            
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
                $target_dir = "../public/uploads/";
                // Garante que o nome do arquivo seja único para evitar substituição
                $image_name = time() . '_' . basename($_FILES["imagem"]["name"]);
                $target_file = $target_dir . $image_name;
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                    $imagem_path = "uploads/" . $image_name;
                    $sql = "UPDATE products SET nome=?, descricao=?, condicao=?, preco=?, estoque=?, imagem=? WHERE id=?";
                    $params = ["sssdissi", $nome, $desc, $cond, $preco, $estoque, $imagem_path, $id];
                }
            }
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(...$params);
            $stmt->execute();
            header("Location: ../admin/manage_products.php");
            break;

        case 'delete_product':
            $id = $_POST['product_id'];
            $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            header("Location: ../admin/manage_products.php");
            break;

        case 'update_user':
            $id = $_POST['user_id']; $is_admin = $_POST['is_admin']; $is_blocked = $_POST['is_blocked'];
            $stmt = $conn->prepare("UPDATE users SET is_admin=?, is_blocked=? WHERE id=?");
            $stmt->bind_param("iii", $is_admin, $is_blocked, $id);
            $stmt->execute();
            header("Location: ../admin/manage_users.php");
            break;

        case 'update_order_status':
            $id = $_POST['order_id']; $status = $_POST['status'];
            $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            header("Location: ../admin/manage_orders.php");
            break;
    }
    exit();
}
?>