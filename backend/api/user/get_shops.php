<?php
require_once '../../config/db.php';

$stmt = $conn->query("SELECT vendor_id, shop_name, owner_name FROM vendors WHERE is_approved = 1");
$shops = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "shops" => $shops
]);
?>
