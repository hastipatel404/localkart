<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->vendor_id)) {
  echo json_encode(["status" => false, "message" => "Vendor ID missing"]);
  exit;
}

$vendor_id = $data->vendor_id;

// Join orders with products & order_items, filter by vendor
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
  WHERE p.vendor_id = ?
  ORDER BY o.created_at DESC
");
$stmt->execute([$vendor_id]);
$orders = $stmt->fetchAll();

echo json_encode([
  "status" => true,
  "orders" => $orders
]);
