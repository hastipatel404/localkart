<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$shop_name = $data->shop_name ?? '';
$owner_name = $data->owner_name ?? '';
$email = $data->email ?? '';
$password = $data->password ?? '';
$latitude = $data->latitude ?? null;
$longitude = $data->longitude ?? null;

if ($shop_name && $owner_name && $email && $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO vendors (shop_name, owner_name, email, password, latitude, longitude) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$shop_name, $owner_name, $email, $hashedPassword, $latitude, $longitude]);

    echo json_encode(["success" => true, "message" => "Vendor registered successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
}
?>
