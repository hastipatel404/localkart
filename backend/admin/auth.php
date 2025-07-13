<?php
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username, $data->password)) {
    echo json_encode(["status" => false, "message" => "Missing username or password"]);
    exit;
}

$username = $data->username;
$password = $data->password;

$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch();

if ($admin && password_verify($password, $admin['password'])) {
    echo json_encode(["status" => true, "message" => "Login successful", "admin_id" => $admin['id']]);
} else {
    echo json_encode(["status" => false, "message" => "Invalid credentials"]);
}
