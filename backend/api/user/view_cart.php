<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id ?? 0;

$stmt = $conn->prepare("
    SELECT c.cart_id, c.product_id, c.quantity, p.product_name, p.price, (c.quantity * p.price) AS total_price
    FROM carts c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "cart" => $cart
]);
?>
