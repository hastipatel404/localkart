<?php
require_once '../../config/db.php';

// Get raw JSON input
$data = json_decode(file_get_contents("php://input"));

// Extract and sanitize data
$name = $data->name ?? '';
$email = $data->email ?? '';
$password = $data->password ?? '';

if (!empty($name) && !empty($email) && !empty($password)) {
    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkStmt->execute([$email]);

    if ($checkStmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered"]);
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);

        echo json_encode(["success" => true, "message" => "User registered successfully"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
}
?>
