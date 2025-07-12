<?php
require_once '../db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->name, $data->email, $data->password)) {
    echo json_encode(["status" => false, "message" => "Missing required fields."]);
    exit;
}

$name = $data->name;
$email = $data->email;
$password = password_hash($data->password, PASSWORD_DEFAULT);

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => false, "message" => "Email already registered."]);
    exit;
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
if ($stmt->execute([$name, $email, $password])) {
    echo json_encode(["status" => true, "message" => "User registered successfully."]);
} else {
    echo json_encode(["status" => false, "message" => "Registration failed."]);
}
