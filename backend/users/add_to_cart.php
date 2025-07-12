<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->user_id, $data->product_id)) {
    echo json_encode(["status" => false, "message" => "Missing required data."]);
    exit;
}

$user_id = $data->user_id;
$product_id = $data->product_id;

// Check if product already in cart
$stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
$item = $stmt->fetch();

if ($item) {
    // Already exists → update quantity
    $newQty = $item['quantity'] + 1;
    $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $success = $update->execute([$newQty, $item['id']]);
} else {
    // Not exists → insert new
    $insert = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
    $success = $insert->execute([$user_id, $product_id]);
}

echo json_encode([
    "status" => $success,
    "message" => $success ? "Added to cart." : "Failed to add."
]);
