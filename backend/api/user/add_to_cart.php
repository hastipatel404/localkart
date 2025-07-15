<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id ?? 0;
$product_id = $data->product_id ?? 0;
$quantity = $data->quantity ?? 1;

$stmt = $conn->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $product_id, $quantity]);

echo json_encode(["success" => true, "message" => "Added to cart"]);
?>
