<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->name, $data->email, $data->password)) {
    echo json_encode(["status" => false, "message" => "Missing required fields."]);
    exit;
}

$name = trim($data->name);
$email = trim($data->email);
$password = password_hash($data->password, PASSWORD_DEFAULT);

// Check for duplicate email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => false, "message" => "Email already registered."]);
    exit;
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$success = $stmt->execute([$name, $email, $password]);

echo json_encode([
    "status" => $success,
    "message" => $success ? "User registered successfully." : "Registration failed."
]);
