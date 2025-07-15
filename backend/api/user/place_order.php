<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id ?? 0;

$stmt = $conn->prepare("SELECT c.*, p.vendor_id, p.price FROM carts c JOIN products p ON c.product_id = p.product_id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($items) == 0) {
    echo json_encode(["success" => false, "message" => "Cart is empty"]);
    exit;
}

$vendor_id = $items[0]['vendor_id']; // assuming same vendor per cart
$total = 0;

foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Insert order
$stmt = $conn->prepare("INSERT INTO orders (user_id, vendor_id, total_price) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $vendor_id, $total]);
$order_id = $conn->lastInsertId();

// Insert order items
foreach ($items as $item) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
}

// Clear cart
$stmt = $conn->prepare("DELETE FROM carts WHERE user_id = ?");
$stmt->execute([$user_id]);

echo json_encode(["success" => true, "message" => "Order placed successfully"]);
?>
