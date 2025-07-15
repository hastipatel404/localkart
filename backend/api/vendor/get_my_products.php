<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$vendor_id = $data->vendor_id ?? 0;

$stmt = $conn->prepare("SELECT * FROM products WHERE vendor_id = ?");
$stmt->execute([$vendor_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "products" => $products
]);
?>
