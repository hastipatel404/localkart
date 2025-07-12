<?php
require_once '../db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email, $data->password)) {
    echo json_encode(["status" => false, "message" => "Missing credentials."]);
    exit;
}

$email = $data->email;
$password = $data->password;

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "status" => true,
        "message" => "Login successful.",
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $email
        ]
    ]);
} else {
    echo json_encode(["status" => false, "message" => "Invalid email or password."]);
}
