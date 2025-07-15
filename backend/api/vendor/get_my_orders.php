<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$vendor_id = $data->vendor_id ?? 0;

$stmt = $conn->prepare("
    SELECT o.order_id, o.user_id, o.total_price, o.status, o.order_date
    FROM orders o
    WHERE o.vendor_id = ?
    ORDER BY o.order_date DESC
");
$stmt->execute([$vendor_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "orders" => $orders]);
?>
