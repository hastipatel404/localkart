<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->cart_id)) {
    echo json_encode(["status" => false, "message" => "Cart ID is required"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
$success = $stmt->execute([$data->cart_id]);

echo json_encode([
  "status" => $success,
  "message" => $success ? "Item removed from cart." : "Failed to remove item."
]);
