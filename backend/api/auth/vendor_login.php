<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$email = $data->email ?? '';
$password = $data->password ?? '';

if (!empty($email) && !empty($password)) {
    $stmt = $conn->prepare("SELECT * FROM vendors WHERE email = ?");
    $stmt->execute([$email]);
    $vendor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vendor && password_verify($password, $vendor['password'])) {
        if (!$vendor['is_approved']) {
            echo json_encode(["success" => false, "message" => "Account not approved by admin yet"]);
        } else {
            echo json_encode(["success" => true, "message" => "Login successful", "vendor_id" => $vendor['vendor_id']]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Email and password are required"]);
}
?>
