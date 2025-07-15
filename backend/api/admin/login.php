<?php
// Hardcoded admin credentials
$admin_email = "admin@localkart.com";
$admin_password = "admin123";

// Get posted data
$data = json_decode(file_get_contents("php://input"));

$email = $data->email ?? '';
$password = $data->password ?? '';

if ($email === $admin_email && $password === $admin_password) {
    echo json_encode([
        "success" => true,
        "message" => "Admin login successful"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid admin credentials"
    ]);
}
?>
