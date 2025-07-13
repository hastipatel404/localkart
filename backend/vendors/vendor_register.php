<?php
require_once '../db.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));
$name = $data->name ?? '';
$email = $data->email ?? '';
$password = $data->password ?? '';

if (!$name || !$email || !$password) {
    echo json_encode(["status" => false, "message" => "All fields are required"]);
    exit;
}

// check if already exists
$check = $conn->prepare("SELECT id FROM vendors WHERE email = ?");
$check->execute([$email]);
if ($check->rowCount() > 0) {
    echo json_encode(["status" => false, "message" => "Email already registered"]);
    exit;
}

// hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO vendors (name, email, password) VALUES (?, ?, ?)");
$stmt->execute([$name, $email, $hashed]);

echo json_encode(["status" => true, "message" => "Registered successfully"]);
