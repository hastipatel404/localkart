<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email, $data->password)) {
    echo json_encode(["status" => false, "message" => "Email and password required"]);
    exit;
}

$email = $data->email;
$password = $data->password;

$stmt = $conn->prepare("SELECT id, name, email, password FROM vendors WHERE email = ?");
$stmt->execute([$email]);
$vendor = $stmt->fetch();

if ($vendor && password_verify($password, $vendor['password'])) {
    echo json_encode([
        "status" => true,
        "message" => "Login successful",
        "vendor" => [
            "id" => $vendor['id'],
            "name" => $vendor['name'],
            "email" => $vendor['email']
        ]
    ]);
} else {
    echo json_encode(["status" => false, "message" => "Invalid credentials"]);
}
