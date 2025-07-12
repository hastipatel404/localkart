<?php
require_once '../db.php';
header('Content-Type: application/json');

if (!isset($_GET['vendor_id'])) {
    echo json_encode(["status" => false, "message" => "Vendor ID is required."]);
    exit;
}

$vendor_id = $_GET['vendor_id'];

$stmt = $conn->prepare("SELECT id, name, price, image FROM products WHERE vendor_id = ?");
$stmt->execute([$vendor_id]);
$products = $stmt->fetchAll();

echo json_encode([
  "status" => true,
  "products" => $products
]);
