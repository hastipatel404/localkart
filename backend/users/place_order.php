<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->user_id)) {
    echo json_encode(["status" => false, "message" => "User ID is missing"]);
    exit;
}

$user_id = $data->user_id;

// Fetch cart items with vendor info
$stmt = $conn->prepare("
    SELECT c.id AS cart_id, c.quantity, p.id AS product_id, p.price, p.vendor_id
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll();

if (count($items) === 0) {
    echo json_encode(["status" => false, "message" => "Cart is empty."]);
    exit;
}

// Group items by vendor
$grouped = [];
foreach ($items as $item) {
    $vendorId = $item['vendor_id'];
    if (!isset($grouped[$vendorId])) {
        $grouped[$vendorId] = [];
    }
    $grouped[$vendorId][] = $item;
}

$conn->beginTransaction();

try {
    foreach ($grouped as $vendor_id => $vendorItems) {
        // Create new order for each vendor
        $stmtOrder = $conn->prepare("INSERT INTO orders (user_id, vendor_id) VALUES (?, ?)");
        $stmtOrder->execute([$user_id, $vendor_id]);
        $order_id = $conn->lastInsertId();

        // Insert order items
        $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($vendorItems as $item) {
            $stmtItem->execute([
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $item['price']
            ]);
        }
    }

    // Clear cart
    $conn->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);

    $conn->commit();
    echo json_encode(["status" => true, "message" => "Order placed successfully!"]);

} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(["status" => false, "message" => "Order failed: " . $e->getMessage()]);
}
