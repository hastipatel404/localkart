<?php
require_once '../../config/db.php';

$stmt = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
  "success" => true,
  "orders" => $orders
]);
?>
