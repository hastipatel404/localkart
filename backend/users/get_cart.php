<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
if (!isset($data->user_id)) {
  echo json_encode(["status" => false, "message" => "Missing user ID"]);
  exit;
}

$user_id = $data->user_id;

$stmt = $conn->prepare("
  SELECT c.id AS cart_id, c.quantity, p.id AS product_id, p.name, p.price, p.image
  FROM cart c
  JOIN products p ON c.product_id = p.id
  WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll();

echo json_encode([
  "status" => true,
  "items" => $items
]);
