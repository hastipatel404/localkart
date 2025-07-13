<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->vendor_id, $data->name)) {
    echo json_encode(["status" => false, "message" => "Missing data"]);
    exit;
}

$vendor_id = $data->vendor_id;
$name = $data->name;

if (!empty($data->password)) {
    $password = password_hash($data->password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE vendors SET name = ?, password = ? WHERE id = ?");
    $success = $stmt->execute([$name, $password, $vendor_id]);
} else {
    $stmt = $conn->prepare("UPDATE vendors SET name = ? WHERE id = ?");
    $success = $stmt->execute([$name, $vendor_id]);
}

echo json_encode([
    "status" => $success,
    "message" => $success ? "Profile updated!" : "Failed to update"
]);
