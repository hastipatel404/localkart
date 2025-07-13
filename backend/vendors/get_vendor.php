<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->vendor_id)) {
    echo json_encode(["status" => false, "message" => "Vendor ID missing"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, email FROM vendors WHERE id = ?");
$stmt->execute([$data->vendor_id]);
$vendor = $stmt->fetch();

if ($vendor) {
    echo json_encode(["status" => true, "vendor" => $vendor]);
} else {
    echo json_encode(["status" => false, "message" => "Vendor not found"]);
}
