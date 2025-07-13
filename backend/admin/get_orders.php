<?php
require_once '../db.php';
header('Content-Type: application/json');

// Fetch all orders
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC")->fetchAll();
$allOrders = [];

foreach ($orders as $o) {
    $stmt = $conn->prepare("
        SELECT oi.quantity, p.name
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = ?
    ");
    $stmt->execute([$o['id']]);
    $items = $stmt->fetchAll();

    $allOrders[] = [
        "id" => $o['id'],
        "user_id" => $o['user_id'],
        "created_at" => $o['created_at'],
        "items" => $items
    ];
}

echo json_encode(["status" => true, "orders" => $allOrders]);
