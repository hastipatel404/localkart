<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->user_id)) {
  echo json_encode(["status" => false, "message" => "User ID missing"]);
  exit;
}

$user_id = $data->user_id;

// Join orders, order_items, products to show details
$stmt = $conn->prepare("
  SELECT 
    o.id AS order_id, 
    o.created_at, 
    p.name AS product_name, 
    oi.quantity, 
    oi.price
  FROM orders o
  JOIN order_items oi ON o.id = oi.order_id
  JOIN products p ON oi.product_id = p.id
  WHERE o.user_id = ?
  ORDER BY o.created_at DESC
");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();

echo json_encode([
  "status" => true,
  "orders" => $orders
]);
