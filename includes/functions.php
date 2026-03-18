<?php
function get_product_details($conn, $product_id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function calculate_cart_total($conn) {
    $total = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = get_product_details($conn, $product_id);
            if ($product) {
                $total += $product['preco'] * $quantity;
            }
        }
    }
    return $total;
}
?>