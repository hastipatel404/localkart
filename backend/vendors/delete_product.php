<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->product_id)) {
    echo json_encode(["status" => false, "message" => "Product ID required"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$success = $stmt->execute([$data->product_id]);

echo json_encode([
    "status" => $success,
    "message" => $success ? "Product deleted" : "Delete failed"
]);
