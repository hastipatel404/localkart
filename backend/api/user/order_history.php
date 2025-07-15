<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id ?? 0;

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "orders" => $orders]);
?>
