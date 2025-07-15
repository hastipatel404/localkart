<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$cart_id = $data->cart_id ?? 0;

$stmt = $conn->prepare("DELETE FROM carts WHERE cart_id = ?");
$stmt->execute([$cart_id]);

echo json_encode(["success" => true, "message" => "Removed from cart"]);
?>
