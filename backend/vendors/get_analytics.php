<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->vendor_id)) {
    echo json_encode(["status" => false, "message" => "Vendor ID required"]);
    exit;
}

$vendor_id = $data->vendor_id;

// Total Products
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_products FROM products WHERE vendor_id = ?");
$stmt1->execute([$vendor_id]);
$total_products = $stmt1->fetchColumn();

// Total Orders & Sales
$stmt2 = $conn->prepare("
    SELECT 
      COUNT(*) AS total_orders,
      SUM(oi.quantity * oi.price) AS total_sales
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE p.vendor_id = ?
");
$stmt2->execute([$vendor_id]);
$summary = $stmt2->fetch();

echo json_encode([
    "status" => true,
    "total_products" => $total_products,
    "total_orders" => $summary['total_orders'] ?? 0,
    "total_sales" => $summary['total_sales'] ?? 0
]);
