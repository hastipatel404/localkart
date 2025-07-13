<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->vendor_id)) {
    echo json_encode(["status" => false, "message" => "Vendor ID missing"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM products WHERE vendor_id = ?");
$stmt->execute([$data->vendor_id]);
$products = $stmt->fetchAll();

echo json_encode(["status" => true, "products" => $products]);
